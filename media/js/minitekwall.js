((document, Joomla) => {
  "use strict";

  class Mwall {
    /*
     * Constructor
     */
    constructor(options, id) {
      const self = this;
      this.options = options;
      this.widgetId = parseInt(id, 10);

      var wallSortings =
        this.options.mas_title_sorting != 0 ||
        this.options.mas_category_sorting != 0 ||
        this.options.mas_author_sorting != 0 ||
        this.options.mas_date_sorting != 0 ||
        this.options.mas_hits_sorting != 0 ||
        this.options.mas_sorting_direction != 0
          ? true
          : false;
      this.filtersEnabled =
        this.options.mas_category_filters != 0 ||
        this.options.mas_tag_filters != 0 ||
        this.options.mas_date_filters != 0 ||
        wallSortings
          ? true
          : false;
      this.hoverBox = this.options.mas_hb != 0 ? true : false;

      // Handle resize
      var _resize;

      window.addEventListener("resize", function () {
        clearTimeout(_resize);

        _resize = setTimeout(function () {
          self.doneBrowserResizing(self);
        }, 500);
      });

      // Initialize wall
      this.initializeWall();

      // Filters
      if (this.filtersEnabled) this.filtersSortings();

      // Hover box
      if (this.hoverBox) {
        this.triggerHoverBox();

        // Modal images
        if (parseInt(this.options.mas_hb_zoom, 10)) this.initModalMessages();
      }
    }

    initializeWall() {
      const self = this;
      this.startLimit = parseInt(this.options.mas_starting_limit, 10);
      this.filtersMode = this.options.mas_filters_mode;
      this.closeFilters = this.options.mas_close_filters != 0 ? true : false;
      this.container = document.querySelector(
        "#mnwall_container_" + this.widgetId
      );
      this.gridType = parseInt(this.options.mas_grid, 10);

      switch (this.gridType) {
        case 98:
          this.layoutType = "columns";
          break;
        case 99:
          this.layoutType = "list";
          break;
        default:
          this.layoutType = "masonry";
          break;
      }

      this.layoutMode = this.options.mas_layout_mode;
      this.dbPosition = this.options.mas_db_position_columns;
      this.equalHeight =
        this.options.mas_force_equal_height != 0 ? true : false;
      this.sortBy = this.container.getAttribute("data-order");
      this.sortDirection =
        this.container.getAttribute("data-direction") == null
          ? ""
          : this.container.getAttribute("data-direction").toLowerCase();
      this.sortAscending = this.sortDirection == "asc" ? true : false;

      if (
        this.sortBy == "RAND()" ||
        this.sortBy == "rand" ||
        this.sortBy == "random"
      ) {
        this.sortBy = ["index"];
        this.sortAscending = true;
      } else this.sortBy = [this.sortBy, "id", "title"];

      this.createSpinner(
        document.querySelector("#mnwall_loader_" + this.widgetId)
      );
      document.querySelector("#mnwall_loader_" + this.widgetId).style.display =
        "block";
      this.transitionDuration = parseInt(
        this.options.mas_transition_duration,
        10
      );
      this.transitionStagger = parseInt(
        this.options.mas_transition_stagger,
        10
      );
      this.iso_container = document.querySelector(
        "#mnwall_iso_container_" + this.widgetId
      );
      this.wall;
      var effects = this.options.mas_effects
        ? this.options.mas_effects
        : ["fade"];
      var hiddenOpacity = 1;
      var hiddenTransform = "scale(1)";

      if (effects.includes("fade")) hiddenOpacity = 0;

      if (effects.includes("scale")) hiddenTransform = "scale(0.001)";

      // Initialize wall
      imagesLoaded(self.iso_container, function () {
        self.wall = new Isotope(self.iso_container, {
          itemSelector: ".mnwall-item",
          layoutMode: self.layoutMode,
          vertical: {
            horizontalAlignment: 0,
          },
          initLayout: false,
          stagger: self.transitionStagger,
          transitionDuration: self.transitionDuration,
          hiddenStyle: {
            opacity: hiddenOpacity,
            transform: hiddenTransform,
          },
          visibleStyle: {
            opacity: 1,
            transform: "scale(1)",
          },
          getSortData: {
            ordering: "[data-ordering] parseInt",
            fordering: "[data-fordering] parseInt",
            hits: "[data-hits] parseInt",
            title: "[data-title]",
            id: "[data-id] parseInt",
            alias: "[data-alias]",
            date: "[data-date]",
            modified: "[data-modified]",
            start: "[data-start]",
            finish: "[data-finish]",
            category: "[data-category]",
            author: "[data-author]",
            index: "[data-index] parseInt",
          },
        });

        self.container.style.display = "block";

        self.wall.arrange({
          sortBy: self.sortBy,
          sortAscending: self.sortAscending,
        });

        self.fixEqualHeights("all");
        self.container.style.opacity = 1;
        document.querySelector(
          "#mnwall_loader_" + self.widgetId
        ).style.display = "none";
      });
    }

    filtersSortings() {
      const self = this;
      var filters = {};

      // Bind filter button click
      if (self.container.querySelector(".mnwall_iso_filters_cont")) {
        self.container
          .querySelector(".mnwall_iso_filters_cont")
          .addEventListener("click", function (e) {
            e.preventDefault();

            if (e.target && e.target.classList.contains("mnwall-filter")) {
              var _this = e.target;

              // Show filter name in dropdown
              if (_this.closest(".mnwall_iso_dropdown")) {
                var data_filter_attr = _this.getAttribute("data-filter");

                if (
                  typeof data_filter_attr !== typeof undefined &&
                  data_filter_attr !== false
                ) {
                  var filter_text;

                  if (data_filter_attr.length) filter_text = _this.textContent;
                  else
                    filter_text = _this
                      .closest(".mnwall_iso_dropdown")
                      .querySelector(".dropdown-label span")
                      .getAttribute("data-label");

                  _this
                    .closest(".mnwall_iso_dropdown")
                    .querySelector(".dropdown-label span span").textContent =
                    filter_text;
                }
              }

              // Get group key
              var filterGroup = _this
                .closest(".button-group")
                .getAttribute("data-filter-group");

              // Set filter for group
              filters[filterGroup] = _this.getAttribute("data-filter");

              // Combine filters
              var filterValue = "";

              for (var prop in filters) {
                filterValue += filters[prop];
              }

              // Set filter for Isotope
              self.wall.arrange({
                filter: filterValue,
              });
            }
          });
      }

      // Change active class on filter buttons
      this.activeFilters = function activeFilters() {
        self.container
          .querySelectorAll(".button-group")
          .forEach(function (buttonGroup) {
            buttonGroup
              .querySelectorAll(".mnwall-filter")
              .forEach(function (a) {
                a.addEventListener("click", function (e) {
                  e.preventDefault();

                  if (buttonGroup.querySelector(".mnw_filter_active"))
                    buttonGroup
                      .querySelector(".mnw_filter_active")
                      .classList.remove("mnw_filter_active");

                  a.classList.add("mnw_filter_active");
                });
              });
          });
      };

      this.activeFilters();

      // Dropdown filter list
      this.dropdownFilters = function dropdownFilters() {
        self.container
          .querySelector(".mnwall_iso_filters_cont")
          .querySelectorAll(".mnwall_iso_dropdown")
          .forEach(function (dropdownGroup) {
            dropdownGroup
              .querySelector(".dropdown-label")
              .addEventListener("click", function (e) {
                e.preventDefault();
                var filter_open;

                if (
                  this.closest(".mnwall_iso_dropdown").classList.contains(
                    "expanded"
                  )
                )
                  filter_open = true;
                else filter_open = false;

                self.container
                  .querySelectorAll(".mnwall_iso_dropdown")
                  .forEach(function (a) {
                    a.classList.remove("expanded");
                  });

                if (!filter_open)
                  this.closest(".mnwall_iso_dropdown").classList.add(
                    "expanded"
                  );
              });
          });

        // Close dropdowns
        document.addEventListener("mouseup", function (e) {
          var _target = e.target;
          var dropdowncontainers = self.container.querySelectorAll(
            ".mnwall_iso_dropdown"
          );

          if (!dropdowncontainers) return;

          if (!this.closeFilters) {
            // Close when click outside
            if (!_target.closest(".mnwall_iso_dropdown")) {
              dropdowncontainers.forEach(function (a) {
                a.classList.remove("expanded");
              });
            }
          } else {
            // Close when click inside
            if (
              _target.closest(".mnwall_iso_dropdown") &&
              !_target.closest(".dropdown-label")
            ) {
              dropdowncontainers.forEach(function (a) {
                a.classList.remove("expanded");
              });
            }
          }
        });
      };

      this.dropdownFilters();

      // Bind sort button click
      if (self.container.querySelector(".sorting-group-filters")) {
        self.container
          .querySelector(".sorting-group-filters")
          .querySelectorAll(".mnwall-filter")
          .forEach(function (a) {
            a.addEventListener("click", function (e) {
              e.preventDefault();

              // Show sorting name in dropdown
              if (this.closest(".mnwall_iso_dropdown")) {
                var sorting_text = this.textContent;
                this.closest(".mnwall_iso_dropdown").querySelector(
                  ".dropdown-label span span"
                ).textContent = sorting_text;
              }

              var sortValue = this.getAttribute("data-sort-value");

              // Add second ordering: id
              sortValue = [sortValue, "id"];

              // set filter for Isotope
              self.wall.arrange({
                sortBy: sortValue,
              });

              // Change active class on sorting filters
              self.container
                .querySelector(".sorting-group-filters")
                .querySelectorAll(".mnwall-filter")
                .forEach(function (a) {
                  a.classList.remove("mnw_filter_active");
                });
              this.classList.add("mnw_filter_active");
            });
          });
      }

      // Bind sorting direction button click
      if (self.container.querySelector(".sorting-group-direction")) {
        self.container
          .querySelector(".sorting-group-direction")
          .querySelectorAll(".mnwall-filter")
          .forEach(function (a) {
            a.addEventListener("click", function (e) {
              e.preventDefault();

              // Show sorting name in dropdown
              if (this.closest(".mnwall_iso_dropdown")) {
                var sorting_text = this.textContent;
                this.closest(".mnwall_iso_dropdown").querySelector(
                  ".dropdown-label span span"
                ).textContent = sorting_text;
              }

              var sortDirection = this.getAttribute("data-sort-value");
              var sort_Direction;

              if (sortDirection == "asc") sort_Direction = true;
              else sort_Direction = false;

              // set direction
              self.wall.arrange({
                sortAscending: sort_Direction,
              });

              // Change active class on sorting direction
              self.container
                .querySelector(".sorting-group-direction")
                .querySelectorAll(".mnwall-filter")
                .forEach(function (a) {
                  a.classList.remove("mnw_filter_active");
                });
              this.classList.add("mnw_filter_active");
            });
          });
      }

      // Dropdown sorting list
      var dropdownSortings = function dropdownSortings() {
        if (self.container.querySelector(".mnwall_iso_sortings")) {
          self.container
            .querySelector(".mnwall_iso_sortings")
            .querySelectorAll(".mnwall_iso_dropdown")
            .forEach(function (dropdownSorting) {
              dropdownSorting
                .querySelector(".dropdown-label")
                .addEventListener("click", function (e) {
                  e.preventDefault();
                  var sorting_open;

                  if (
                    this.closest(".mnwall_iso_dropdown").classList.contains(
                      "expanded"
                    )
                  )
                    sorting_open = true;
                  else sorting_open = false;

                  self.container
                    .querySelectorAll(".mnwall_iso_dropdown")
                    .forEach(function (a) {
                      a.classList.remove("expanded");
                    });

                  if (!sorting_open)
                    this.closest(".mnwall_iso_dropdown").classList.add(
                      "expanded"
                    );
                });
            });
        }
      };

      dropdownSortings();

      // Reset Filters and sortings
      this.resetFilters = function resetFilters() {
        self.container
          .querySelectorAll(".button-group")
          .forEach(function (buttonGroup) {
            if (buttonGroup.querySelector(".mnw_filter_active"))
              buttonGroup
                .querySelector(".mnw_filter_active")
                .classList.remove("mnw_filter_active");

            buttonGroup
              .querySelector("li:first-child a")
              .classList.add("mnw_filter_active");

            // Reset filters
            var filterGroup = buttonGroup.getAttribute("data-filter-group");
            filters[filterGroup] = "";
          });

        // Reset dropdown filters text
        self.container
          .querySelectorAll(".mnwall_iso_dropdown")
          .forEach(function (dropdownGroup) {
            var filter_text = dropdownGroup
              .querySelector(".dropdown-label span")
              .getAttribute("data-label");
            dropdownGroup.querySelector(
              ".dropdown-label span span"
            ).textContent = filter_text;
          });

        // Get first item in sortBy array
        self.container
          .querySelectorAll(".sorting-group-filters")
          .forEach(function (sortingGroup) {
            sortingGroup
              .querySelectorAll(".mnwall-filter")
              .forEach(function (a) {
                a.classList.remove("mnw_filter_active");
              });
            if (
              sortingGroup.querySelector(
                'li a[data-sort-value="' + self.sortBy[0] + '"]'
              )
            ) {
              sortingGroup
                .querySelector('li a[data-sort-value="' + self.sortBy[0] + '"]')
                .classList.add("mnw_filter_active");
            }
          });

        self.container
          .querySelectorAll(".sorting-group-direction")
          .forEach(function (sortingGroupDirection) {
            sortingGroupDirection
              .querySelector(".mnw_filter_active")
              .classList.remove("mnw_filter_active");
            sortingGroupDirection
              .querySelector(
                'li a[data-sort-value="' + self.sortDirection + '"]'
              )
              .classList.add("mnw_filter_active");
          });

        // set filter for Isotope
        self.wall.arrange({
          filter: "",
          sortBy: self.sortBy,
          sortAscending: self.sortAscending,
        });
      };

      document
        .querySelectorAll(
          "#mnwall_reset_" +
            this.widgetId +
            ", #mnwall_container_" +
            this.widgetId +
            " .mnwall-reset-btn"
        )
        .forEach(function (a) {
          a.addEventListener("click", function (e) {
            e.preventDefault();

            self.resetFilters();
          });
        });
    }

    triggerHoverBox() {
      const self = this;

      if (self.gridType == 99 || self.gridType == 98) {
        self.container.querySelectorAll(".mnwall-item").forEach(function (a) {
          a.addEventListener("mouseenter", function (e) {
            switch (self.options.mas_hb_effect) {
              case "no":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "hoverShow"
                );
                break;
              case "1":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "hoverFadeIn"
                );
                break;
              case "2":
                this.querySelector(".mnwall-cover").classList.add(
                  "perspective"
                );
                this.querySelector(".mnwall-img-div").classList.add(
                  "flip",
                  "flipY",
                  "hoverFlipY"
                );
                break;
              case "3":
                this.querySelector(".mnwall-cover").classList.add(
                  "perspective"
                );
                this.querySelector(".mnwall-img-div").classList.add(
                  "flip",
                  "flipX",
                  "hoverFlipX"
                );
                break;
              case "4":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "slideInRight"
                );
                break;
              case "5":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "slideInLeft"
                );
                break;
              case "6":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "slideInTop"
                );
                break;
              case "7":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "slideInBottom"
                );
                break;
              case "8":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "mnwzoomIn"
                );
                break;
              default:
                this.querySelector(".mnwall-hover-box").classList.add(
                  "hoverFadeIn"
                );
                break;
            }
          });

          a.addEventListener("mouseleave", function (e) {
            switch (self.options.mas_hb_effect) {
              case "no":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "hoverShow"
                );
                break;
              case "1":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "hoverFadeIn"
                );
                break;
              case "2":
                this.querySelector(".mnwall-img-div").classList.remove(
                  "hoverFlipY"
                );
                break;
              case "3":
                this.querySelector(".mnwall-img-div").classList.remove(
                  "hoverFlipX"
                );
                break;
              case "4":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInRight"
                );
                break;
              case "5":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInLeft"
                );
                break;
              case "6":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInTop"
                );
                break;
              case "7":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInBottom"
                );
                break;
              case "8":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "mnwzoomIn"
                );
                break;
              default:
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "hoverFadeIn"
                );
                break;
            }
          });
        });
      }

      if (self.gridType != 98 && self.gridType != 99) {
        self.container.querySelectorAll(".mnwall-item").forEach(function (a) {
          a.addEventListener("mouseenter", function (e) {
            switch (self.options.mas_hb_effect) {
              case "no":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "hoverShow"
                );
                break;
              case "1":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "hoverFadeIn"
                );
                break;
              case "2":
                this.classList.add("perspective");
                this.querySelector(".mnwall-item-outer-cont").classList.add(
                  "flip",
                  "flipY",
                  "hoverFlipY"
                );
                break;
              case "3":
                this.classList.add("perspective");
                this.querySelector(".mnwall-item-outer-cont").classList.add(
                  "flip",
                  "flipX",
                  "hoverFlipX"
                );
                break;
              case "4":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "animated",
                  "slideInRight"
                );
                break;
              case "5":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "animated",
                  "slideInLeft"
                );
                break;
              case "6":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "animated",
                  "slideInTop"
                );
                break;
              case "7":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "animated",
                  "slideInBottom"
                );
                break;
              case "8":
                this.querySelector(".mnwall-hover-box").classList.add(
                  "animated",
                  "mnwzoomIn"
                );
                break;
              default:
                this.querySelector(".mnwall-hover-box").classList.add(
                  "hoverFadeIn"
                );
                break;
            }
          });

          a.addEventListener("mouseleave", function (e) {
            switch (self.options.mas_hb_effect) {
              case "no":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "hoverShow"
                );
                break;
              case "1":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "hoverFadeIn"
                );
                break;
              case "2":
                this.querySelector(".mnwall-item-outer-cont").classList.remove(
                  "hoverFlipY"
                );
                break;
              case "3":
                this.querySelector(".mnwall-item-outer-cont").classList.remove(
                  "hoverFlipX"
                );
                break;
              case "4":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInRight"
                );
                break;
              case "5":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInLeft"
                );
                break;
              case "6":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInTop"
                );
                break;
              case "7":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "slideInBottom"
                );
                break;
              case "8":
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "mnwzoomIn"
                );
                break;
              default:
                this.querySelector(".mnwall-hover-box").classList.remove(
                  "hoverFadeIn"
                );
                break;
            }
          });
        });
      }
    }

    doneBrowserResizing(_this) {
      _this.fixEqualHeights("all");
      _this.wall.arrange();
    }

    fixEqualHeights(items) {
      const self = this;

      if (
        this.gridType == 98 &&
        this.layoutMode == "fitRows" &&
        this.dbPosition == "below" &&
        this.equalHeight
      ) {
        var max_height = 0;

        if (items == "all") {
          this.container
            .querySelectorAll(".mnwall-item-inner")
            .forEach(function (a) {
              a.style.height = "auto";

              if (a.offsetHeight > max_height) max_height = a.offsetHeight;
            });
        } else {
          items.forEach(function (a) {
            var _this_item_inner = a.querySelector(".mnwall-item-inner");
            _this_item_inner.style.height = "auto";

            if (_this_item_inner.offsetHeight > max_height)
              max_height = _this_item_inner.offsetHeight;
          });
        }

        this.container
          .querySelectorAll(".mnwall-item-inner")
          .forEach(function (a) {
            a.style.height = max_height + "px";
          });

        setTimeout(function () {
          self.wall.arrange();
        }, 1);
      }
    }

    createSpinner(divIdentifier) {
      var spinner_options = {
        lines: 9,
        length: 4,
        width: 3,
        radius: 3,
        corners: 1,
        rotate: 0,
        direction: 1,
        color: "#000",
        speed: 1,
        trail: 52,
        shadow: false,
        hwaccel: false,
        className: "spinner",
        zIndex: 2e9,
        top: "50%",
        left: "50%",
      };

      var target = divIdentifier;

      if (target) {
        var spinner = new Spinner(spinner_options).spin();
        target.innerHTML = "";
        target.appendChild(spinner.el);
      }

      return;
    }

    initModalMessages() {
      var zoomWall = document.querySelector("#zoomWall_" + this.widgetId);

      if (!zoomWall) return;

      zoomWall.addEventListener("show.bs.modal", function (e) {
        // Button that triggered the modal
        var button = e.relatedTarget;

        // Update the title
        if (zoomWall.querySelector(".modal-title")) {
          var title = button.getAttribute("data-title");
          zoomWall.querySelector(".modal-title").textContent = title;
        }

        // Update the image
        var image = button.getAttribute("data-src");
        zoomWall.querySelector("img").setAttribute("src", image);
      });
    }
  }

  window.Mwall = {
    initialise: (options, id) => new Mwall(options, id),
  };
})(document, Joomla);
