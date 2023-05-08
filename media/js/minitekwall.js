((document, Joomla) => {
    "use strict";

    class Mwall {
        /*
         * Constructor
         */
        constructor(options, id, source, path) {
            this.options = options;
            this.widgetId = parseInt(id, 10);
            this.sourceId = source;
            this.path = path;

            this.filtersMode = "dynamic";
            var wallSortings =
                this.options.mas_title_sorting != 0 ||
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

            // Initialize wall
            this.initializeWall();

            // Initialize filters
            this.filters = {
                category: [],
                tag: [],
                date: [],
                ordering: "",
                direction: "",
            };

            // Dynamic filters
            if (
                this.container &&
                this.filtersEnabled &&
                this.filtersMode == "dynamic"
            )
                this.dynamicFilters();

            // Modal images
            if (this.container && this.hoverBox) {
                if (parseInt(this.options.mas_hb_zoom, 10))
                    this.initModalMessages();
            }

            // Check if we are inside an iframe
            this.isIframe = window.frameElement ? true : false;

            if (this.isIframe) {
                if (document.querySelector(".mwall-description"))
                    document.querySelector(".mwall-description").style.padding =
                        "20px";

                if (document.querySelector(".mwall-results-empty-results"))
                    document.querySelector(
                        ".mwall-results-empty-results"
                    ).style.padding = "20px";
                else if (this.container) this.container.style.padding = "20px";
            }
        }

        initializeWall() {
            const self = this;

            this.pageLimit = parseInt(this.options.mas_page_limit, 10);
            this.closeFilters =
                this.options.mas_close_filters != 0 ? true : false;
            this.scrollToTop =
                this.options.mas_pag_scroll_to_top != 0 ? true : false;
            this.container = document.querySelector(
                "#mwall_container_" + this.widgetId
            );

            if (this.container == null) return;

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
                    : this.container
                          .getAttribute("data-direction")
                          .toLowerCase();
            this.sortAscending = this.sortDirection == "asc" ? true : false;

            if (
                this.sortBy == "RAND()" ||
                this.sortBy == "rand" ||
                this.sortBy == "random" ||
                this.sourceId == "rss"
            ) {
                this.sortBy = ["index"];
                this.sortAscending = true;
            } else this.sortBy = [this.sortBy, "id", "title"];

            this.createSpinner(
                document.querySelector("#mwall_loader_" + this.widgetId)
            );
            document.querySelector(
                "#mwall_loader_" + this.widgetId
            ).style.display = "block";
            this.transitionDuration = parseInt(
                this.options.mas_transition_duration,
                10
            );
            this.transitionStagger = parseInt(
                this.options.mas_transition_stagger,
                10
            );
            this.scrollThreshold = 100;
            this.iso_container = document.querySelector(
                "#mwall_items_" + this.widgetId
            );
            this.wall;
            var effects = this.options.mas_effects
                ? this.options.mas_effects
                : ["fade"];
            var hiddenOpacity = 1;
            var hiddenTransform = "scale(1)";

            if (effects.includes("fade")) hiddenOpacity = 0;

            if (effects.includes("scale")) hiddenTransform = "scale(0.001)";

            imagesLoaded(
                self.iso_container,
                { background: ".mwall-photo-link" },
                function () {
                    self.wall = new Isotope(self.iso_container, {
                        itemSelector: ".mwall-item",
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
                            title: function (itemElem) {
                                if (itemElem.querySelector(".mwall-title")) {
                                    let title =
                                        itemElem.querySelector(
                                            ".mwall-title"
                                        ).textContent;

                                    return self.removeAccents(title);
                                }
                            },
                            id: "[data-id] parseInt",
                            alias: "[data-alias]",
                            date: "[data-date]",
                            modified: "[data-modified]",
                            start: "[data-start]",
                            finish: "[data-finish]",
                            index: "[data-index] parseInt",
                        },
                    });

                    self.container.style.display = "block";

                    if (self.filtersEnabled && self.filtersMode == "static") {
                        self.wall.arrange({
                            sortBy: ["index"],
                            sortAscending: { index: true },
                        });
                    } else {
                        self.wall.arrange({
                            sortBy: self.sortBy,
                            sortAscending: self.sortAscending,
                        });
                    }

                    self.fixEqualHeights("all");
                    self.container.style.opacity = 1;
                    document.querySelector(
                        "#mwall_loader_" + self.widgetId
                    ).style.display = "none";
                }
            );

            // Handle resize
            var _resize;

            window.addEventListener("resize", function () {
                clearTimeout(_resize);

                _resize = setTimeout(function () {
                    self.doneBrowserResizing(self);
                }, 500);
            });
        }

        removeAccents(string) {
            return string
                .toLowerCase()
                .replace(/[áàãâä]/gi, "a")
                .replace(/[éèëê]/gi, "e")
                .replace(/[íìïî]/gi, "i")
                .replace(/[óòöôõø]/gi, "o")
                .replace(/[úùüû]/gi, "u")
                .replace(/[ç]/gi, "c")
                .replace(/[ñ]/gi, "n");
        }

        resultsMessage(self, items) {
            if (items.length == 0) {
                self.container.querySelector(".mwall-no-items").style.display =
                    "block";
            } else {
                self.container.querySelector(".mwall-no-items").style.display =
                    "none";
            }
        }

        reindexItem(grid, index) {
            const self = this;

            if (index > grid) {
                index = index - grid;
                index = self.reindexItem(grid, index);
            }

            return index;
        }

        resizeItem(grid, index) {
            const self = this;
            let size;

            switch (grid) {
                // Preset grids
                case "1":
                    size = "mwall-big";
                    break;

                case "3a":
                    if (index == "1") {
                        size = "mwall-big";
                    } else {
                        size = "mwall-horizontal";
                    }
                    break;

                case "3b":
                    if (index == "2") {
                        size = "mwall-big";
                    } else {
                        size = "mwall-horizontal";
                    }
                    break;

                case "3c":
                    if (index == "1") {
                        size = "mwall-big";
                    } else {
                        size = "mwall-vertical";
                    }
                    break;

                case "4":
                    if (index == "1") {
                        size = "mwall-big";
                    } else if (index == "2") {
                        size = "mwall-horizontal";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "5":
                    if (index == "1" || index == "5") {
                        size = "mwall-horizontal";
                    } else if (index == "2" || index == "4") {
                        size = "mwall-small";
                    } else {
                        size = "mwall-big";
                    }
                    break;

                case "5b":
                    if (index == "3") {
                        size = "mwall-big";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "6":
                    if (index == "1") {
                        size = "mwall-big";
                    } else if (index == "3") {
                        size = "mwall-horizontal";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "7":
                    if (index == "1") {
                        size = "mwall-big";
                    } else if (index == "2") {
                        size = "mwall-horizontal";
                    } else if (index == "4") {
                        size = "mwall-vertical";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "8":
                    if (index == "1" || index == "7" || index == "8") {
                        size = "mwall-horizontal";
                    } else if (index == "2") {
                        size = "mwall-big";
                    } else if (index == "6") {
                        size = "mwall-vertical";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "9":
                    if (index == "1") {
                        size = "mwall-big";
                    } else if (index == "2") {
                        size = "mwall-horizontal";
                    } else if (index == "4" || index == "5" || index == "6") {
                        size = "mwall-vertical";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "9r":
                    if (index == "1" || index == "2" || index == "3") {
                        size = "mwall-horizontal";
                    } else if (index == "4" || index == "5") {
                        size = "mwall-big";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "12r":
                    if (
                        index == "1" ||
                        index == "2" ||
                        index == "3" ||
                        index == "4"
                    ) {
                        size = "mwall-horizontal";
                    } else if (
                        index == "10" ||
                        index == "11" ||
                        index == "12"
                    ) {
                        size = "mwall-big";
                    } else {
                        size = "mwall-small";
                    }
                    break;

                case "16r":
                    if (
                        index == "1" ||
                        index == "5" ||
                        index == "7" ||
                        index == "15"
                    ) {
                        size = "mwall-horizontal";
                    } else {
                        size = "mwall-small";
                    }
                    break;
            }

            return size;
        }

        resizeItems() {
            const self = this;
            let items = self.wall.getFilteredItemElements();

            // Resize items
            if (self.layoutType == "masonry") {
                items.forEach((item, i) => {
                    // Remove classes
                    item.classList.remove(
                        "mwall-small",
                        "mwall-horizontal",
                        "mwall-vertical",
                        "mwall-big",
                        "mwall-item1",
                        "mwall-item2",
                        "mwall-item3",
                        "mwall-item4",
                        "mwall-item5",
                        "mwall-item6",
                        "mwall-item7",
                        "mwall-item8",
                        "mwall-item9",
                        "mwall-item10",
                        "mwall-item11",
                        "mwall-item12",
                        "mwall-item13",
                        "mwall-item14",
                        "mwall-item15",
                        "mwall-item16"
                    );

                    // Re-index
                    let index = i + 1;
                    item.setAttribute("data-index", index);
                    index = self.reindexItem(self.gridType, index);

                    // Resize
                    let size = self.resizeItem(self.options.mas_grid, index);

                    // Add new classes
                    item.classList.add(size, "mwall-item" + index);
                });
            }

            self.wall.arrange();
        }

        // Set active filters
        activeFilters() {
            const self = this;

            self.container
                .querySelectorAll(".button-group")
                .forEach(function (buttonGroup) {
                    buttonGroup
                        .querySelectorAll(".mwall-filter")
                        .forEach(function (a) {
                            a.addEventListener("click", function (e) {
                                e.preventDefault();

                                var filter = this.getAttribute("data-filter");
                                var filterGroup =
                                    buttonGroup.getAttribute(
                                        "data-filter-group"
                                    );

                                if (
                                    buttonGroup.querySelector(
                                        ".mwall-filter-active"
                                    )
                                )
                                    buttonGroup
                                        .querySelector(".mwall-filter-active")
                                        .classList.remove(
                                            "mwall-filter-active"
                                        );

                                // Toggle active filter
                                if (self.filters[filterGroup].includes(filter))
                                    a.classList.remove("mwall-filter-active");
                                else a.classList.add("mwall-filter-active");

                                if (
                                    !buttonGroup.querySelectorAll(
                                        ".mwall-filter-active"
                                    ).length
                                )
                                    buttonGroup
                                        .querySelector(
                                            ".mwall-filter[data-filter='']"
                                        )
                                        .classList.add("mwall-filter-active");
                            });
                        });
                });
        }

        // Activate dropdown filters actions
        dropdownFilters() {
            const self = this;

            if (self.container.querySelector(".mwall-filters-container")) {
                self.container
                    .querySelector(".mwall-filters-container")
                    .querySelectorAll(".mwall-dropdown")
                    .forEach(function (dropdownGroup) {
                        dropdownGroup
                            .querySelector(".dropdown-label")
                            .addEventListener("click", function (e) {
                                e.preventDefault();
                                var filter_open;

                                if (
                                    this.closest(
                                        ".mwall-dropdown"
                                    ).classList.contains("expanded")
                                )
                                    filter_open = true;
                                else filter_open = false;

                                self.container
                                    .querySelectorAll(".mwall-dropdown")
                                    .forEach(function (a) {
                                        a.classList.remove("expanded");
                                    });

                                if (!filter_open)
                                    this.closest(
                                        ".mwall-dropdown"
                                    ).classList.add("expanded");
                            });
                    });
            }

            // Close dropdowns
            document.addEventListener("mouseup", function (e) {
                var _target = e.target;
                var dropdowncontainers =
                    self.container.querySelectorAll(".mwall-dropdown");

                if (!dropdowncontainers) return;

                if (!this.closeFilters) {
                    // Close when click outside
                    if (!_target.closest(".mwall-dropdown")) {
                        dropdowncontainers.forEach(function (a) {
                            a.classList.remove("expanded");
                        });
                    }
                } else {
                    // Close when click inside
                    if (
                        _target.closest(".mwall-dropdown") &&
                        !_target.closest(".dropdown-label")
                    ) {
                        dropdowncontainers.forEach(function (a) {
                            a.classList.remove("expanded");
                        });
                    }
                }
            });
        }

        // Activate dropdown sortings actions
        dropdownSortings() {
            const self = this;

            if (self.container.querySelector(".mwall-sortings")) {
                self.container
                    .querySelector(".mwall-sortings")
                    .querySelectorAll(".mwall-dropdown")
                    .forEach(function (dropdownSorting) {
                        dropdownSorting
                            .querySelector(".dropdown-label")
                            .addEventListener("click", function (e) {
                                e.preventDefault();
                                var sorting_open;

                                if (
                                    this.closest(
                                        ".mwall-dropdown"
                                    ).classList.contains("expanded")
                                )
                                    sorting_open = true;
                                else sorting_open = false;

                                self.container
                                    .querySelectorAll(".mwall-dropdown")
                                    .forEach(function (a) {
                                        a.classList.remove("expanded");
                                    });

                                if (!sorting_open)
                                    this.closest(
                                        ".mwall-dropdown"
                                    ).classList.add("expanded");
                            });
                    });
            }
        }

        dynamicFilters() {
            const self = this;

            // Filters
            if (self.container.querySelector(".mwall-filters-container")) {
                self.container
                    .querySelector(".mwall-filters-container")
                    .addEventListener("click", function (e) {
                        e.preventDefault();

                        self.container.querySelector(
                            ".mwall-no-items"
                        ).style.display = "none";

                        if (
                            e.target &&
                            e.target.classList.contains("mwall-filter")
                        ) {
                            var _this = e.target;
                            var data_filter = _this.getAttribute("data-filter");

                            // Get group key
                            var filterGroup = _this
                                .closest(".button-group")
                                .getAttribute("data-filter-group");

                            // Check whether filter exists
                            let index =
                                self.filters[filterGroup].indexOf(data_filter);

                            // Add filter to group if it does not exist
                            if (index === -1) {
                                if (data_filter)
                                    self.filters[filterGroup] = [data_filter];
                                else self.filters[filterGroup] = [];
                            } else {
                                self.filters[filterGroup] = [];
                            }

                            var filterValue = "";

                            for (var prop in self.filters) {
                                for (var filter in prop) {
                                    if (self.filters[prop][filter])
                                        filterValue +=
                                            self.filters[prop][filter];
                                }
                            }

                            // Show filter name in dropdown
                            if (_this.closest(".mwall-dropdown")) {
                                if (
                                    typeof data_filter_attr !==
                                        typeof undefined &&
                                    data_filter_attr !== false
                                ) {
                                    var filter_text;

                                    if (data_filter_attr.length) {
                                        if (index === -1)
                                            filter_text = _this.textContent;
                                        // Deselect filter
                                        else if (index >= 0) {
                                            filter_text = _this
                                                .closest(".mwall-dropdown")
                                                .querySelector(
                                                    ".dropdown-label span"
                                                )
                                                .getAttribute("data-label");
                                        }
                                    } else
                                        filter_text = _this
                                            .closest(".mwall-dropdown")
                                            .querySelector(
                                                ".dropdown-label span"
                                            )
                                            .getAttribute("data-label");

                                    _this
                                        .closest(".mwall-dropdown")
                                        .querySelector(
                                            ".dropdown-label span span"
                                        ).textContent = filter_text;
                                }
                            }

                            // Show results message
                            self.wall.once("layoutComplete", function (items) {
                                self.resultsMessage(self, items);
                            });

                            // Update Isotope
                            self.wall.arrange({
                                filter: filterValue,
                            });

                            self.resizeItems();
                        }
                    });
            }

            self.activeFilters();
            self.dropdownFilters();

            // Ordering
            if (self.container.querySelector(".sorting-group-filters")) {
                self.container
                    .querySelector(".sorting-group-filters")
                    .querySelectorAll(".mwall-filter")
                    .forEach(function (a) {
                        a.addEventListener("click", function (e) {
                            e.preventDefault();

                            // Show sorting name in dropdown
                            if (this.closest(".mwall-dropdown")) {
                                var sorting_text = this.textContent;
                                this.closest(".mwall-dropdown").querySelector(
                                    ".dropdown-label span span"
                                ).textContent = sorting_text;
                            }

                            var sortValue =
                                this.getAttribute("data-sort-value");

                            // Add second ordering: id
                            sortValue = [sortValue, "id"];

                            // Update Isotope
                            self.wall.arrange({
                                sortBy: sortValue,
                            });

                            self.resizeItems();

                            // Change active class on sorting filters
                            self.container
                                .querySelector(".sorting-group-filters")
                                .querySelectorAll(".mwall-filter")
                                .forEach(function (a) {
                                    a.classList.remove("mwall-filter-active");
                                });
                            this.classList.add("mwall-filter-active");
                        });
                    });
            }

            // Direction
            if (self.container.querySelector(".sorting-group-direction")) {
                self.container
                    .querySelector(".sorting-group-direction")
                    .querySelectorAll(".mwall-filter")
                    .forEach(function (a) {
                        a.addEventListener("click", function (e) {
                            e.preventDefault();

                            // Show sorting name in dropdown
                            if (this.closest(".mwall-dropdown")) {
                                var sorting_text = this.textContent;
                                this.closest(".mwall-dropdown").querySelector(
                                    ".dropdown-label span span"
                                ).textContent = sorting_text;
                            }

                            var sortDirection =
                                this.getAttribute("data-sort-value");
                            var sort_Direction;

                            if (sortDirection == "asc") sort_Direction = true;
                            else sort_Direction = false;

                            // Update Isotope
                            self.wall.arrange({
                                sortAscending: sort_Direction,
                            });

                            self.resizeItems();

                            // Change active class on sorting direction
                            self.container
                                .querySelector(".sorting-group-direction")
                                .querySelectorAll(".mwall-filter")
                                .forEach(function (a) {
                                    a.classList.remove("mwall-filter-active");
                                });
                            this.classList.add("mwall-filter-active");
                        });
                    });
            }

            self.dropdownSortings();

            // Reset dynamic filters and sortings
            this.resetFilters = function resetFilters() {
                self.container.querySelector(".mwall-no-items").style.display =
                    "none";

                // Reset active buttons
                self.container
                    .querySelectorAll(".button-group")
                    .forEach(function (buttonGroup) {
                        if (buttonGroup.querySelector(".mwall-filter-active"))
                            buttonGroup
                                .querySelector(".mwall-filter-active")
                                .classList.remove("mwall-filter-active");

                        buttonGroup
                            .querySelector("li:first-child a")
                            .classList.add("mwall-filter-active");

                        // Reset filters
                        var filterGroup =
                            buttonGroup.getAttribute("data-filter-group");
                        self.filters[filterGroup] = [];
                    });

                // Reset dropdown filters text
                self.container
                    .querySelectorAll(".mwall-dropdown")
                    .forEach(function (dropdownGroup) {
                        var filter_text = dropdownGroup
                            .querySelector(".dropdown-label span")
                            .getAttribute("data-label");
                        dropdownGroup.querySelector(
                            ".dropdown-label span span"
                        ).textContent = filter_text;
                    });

                // Reset sortings
                self.container
                    .querySelectorAll(".sorting-group-filters")
                    .forEach(function (sortingGroup) {
                        sortingGroup
                            .querySelectorAll(".mwall-filter")
                            .forEach(function (a) {
                                a.classList.remove("mwall-filter-active");
                            });
                        if (
                            sortingGroup.querySelector(
                                'li a[data-sort-value="' + self.sortBy[0] + '"]'
                            )
                        ) {
                            sortingGroup
                                .querySelector(
                                    'li a[data-sort-value="' +
                                        self.sortBy[0] +
                                        '"]'
                                )
                                .classList.add("mwall-filter-active");
                        }
                    });

                self.container
                    .querySelectorAll(".sorting-group-direction")
                    .forEach(function (sortingGroupDirection) {
                        sortingGroupDirection
                            .querySelector(".mwall-filter-active")
                            .classList.remove("mwall-filter-active");
                        sortingGroupDirection
                            .querySelector(
                                'li a[data-sort-value="' +
                                    self.sortDirection +
                                    '"]'
                            )
                            .classList.add("mwall-filter-active");
                    });

                // Update Isotope
                self.wall.arrange({
                    filter: "",
                    sortBy: self.sortBy,
                    sortAscending: self.sortAscending,
                });

                self.resizeItems();
            };

            document
                .querySelectorAll(
                    "#mwall_reset_" +
                        this.widgetId +
                        ", #mwall_container_" +
                        this.widgetId +
                        " .mwall-reset-btn"
                )
                .forEach(function (a) {
                    a.addEventListener("click", function (e) {
                        e.preventDefault();

                        self.resetFilters();
                    });
                });
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
                        .querySelectorAll(".mwall-item-inner")
                        .forEach(function (a) {
                            a.style.height = "auto";

                            if (a.offsetHeight > max_height)
                                max_height = a.offsetHeight;
                        });
                } else {
                    items.forEach(function (a) {
                        var _this_item_inner =
                            a.querySelector(".mwall-item-inner");
                        _this_item_inner.style.height = "auto";

                        if (_this_item_inner.offsetHeight > max_height)
                            max_height = _this_item_inner.offsetHeight;
                    });
                }

                this.container
                    .querySelectorAll(".mwall-item-inner")
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

        htmlToElements(htmlString, selector) {
            var div = document.createElement("div");
            div.innerHTML = htmlString.trim();

            return div.querySelectorAll(selector);
        }

        initModalMessages() {
            var zoomWall = document.querySelector("#zoomWall_" + this.widgetId);

            if (!zoomWall) return;

            zoomWall.addEventListener("show.bs.modal", function (e) {
                // Button that triggered the modal
                var button = e.relatedTarget;

                // Update the title
                if (zoomWall.querySelector(".modal-title")) {
                    var title = button.getAttribute("data-mw-title");
                    zoomWall.querySelector(".modal-title").textContent = title;
                }

                // Update the image
                var image = button.getAttribute("data-src");
                zoomWall.querySelector("img").setAttribute("src", image);
            });

            zoomWall.addEventListener("hidden.bs.modal", function (e) {
                zoomWall.querySelector("img").setAttribute("src", "");
            });
        }
    }

    window.Mwall = {
        initialise: (options, id, source, path) =>
            new Mwall(options, id, source, path),
    };
})(document, Joomla);
