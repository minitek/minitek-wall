<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibJavascript
{
	public function loadMasonryJavascript($masonry_params, $widgetID)
	{
		$document = \JFactory::getDocument();

		$this->loadJavascriptVars($masonry_params, $widgetID);

		$javascript = "jQuery(function(){";

			$javascript .= $this->loadJavascriptVars($masonry_params, $widgetID);

			$javascript .= $this->initializeWall($masonry_params, $widgetID);

			if ($masonry_params['mas_hb'])
			{
				$javascript .= $this->initializeHoverBox($masonry_params['mas_hb_effect']);
			}

			$javascript .= $this->initializeFiltersSortings($widgetID);

		$javascript .= "});";

		$document->addCustomTag('<script type="text/javascript">'.$javascript.'</script>');

	}

	public function loadJavascriptVars($masonry_params, $widgetID)
	{
		$site_path = \JURI::root();
		$startLimit = $masonry_params['mas_starting_limit'];
		$gridType = $masonry_params['mas_grid'];
		if ($gridType === '98o')
		{
			$grid_type = 'columns';
		}
		else if ($gridType === '99v')
		{
			$grid_type = 'list';
		}
		else
		{
			$grid_type = 'masonry';
		}
		$hoverBox = $masonry_params['mas_hb'];
		$layoutMode = 'packery';
		if (array_key_exists('mas_layout_mode', $masonry_params)) {
			$layoutMode = $masonry_params['mas_layout_mode'];
		}
		$filtersActive = 'yes';
		if (array_key_exists('mas_pag_keep_active', $masonry_params)) {
			if (!$masonry_params['mas_pag_keep_active'])
			{
				$filtersActive = 'no';
			}
		}
		$closeFilters = isset($masonry_params['mas_close_filters']) ? $masonry_params['mas_close_filters'] : 0;
		$equalHeight = isset($masonry_params['mas_force_equal_height']) ? $masonry_params['mas_force_equal_height'] : 0;

		$javascript = "

			// Global variables
			var site_path = '".$site_path."';
			var filtersActive = '".$filtersActive."';
			var closeFilters = ".$closeFilters.";
			var _container = jQuery('#mnwall_container_".$widgetID."');
			var gridType = '".$gridType."';
			gridType = parseInt(gridType);
			var grid_type = '".$grid_type."';
			var layoutMode = '".$layoutMode."';
			var hoverBox = '".$hoverBox."';
			var db_position_columns = '".$masonry_params['mas_db_position_columns']."';
			var equalHeight = '".$equalHeight."';
			var sortBy = _container.attr('data-order');
			if (sortBy == 'RAND()' || sortBy == 'rand' || sortBy == 'random')
			{
				sortBy = ['index'];
			}
			else
			{
				sortBy = [sortBy, 'id', 'title'];
			}
			var sortDirection = _container.attr('data-direction');
			sortDirection = (sortDirection == null) ? '' : sortDirection = sortDirection.toLowerCase();
			sortAscending = false;
			if (sortDirection == 'asc')
			{
				sortAscending = true;
			}
			else
			{
				sortAscending = false;
			}

		";

		return $javascript;
	}

	public function initializeWall($masonry_params, $widgetID)
	{
		$hiddenStyle = '';
		$visibleStyle = '';
		if (array_key_exists('mas_effects', $masonry_params))
		{
			$mas_effects = $masonry_params['mas_effects'];
			if (is_array($mas_effects))
			{
				if (in_array('fade', $mas_effects))
				{
					$hiddenStyle .= 'opacity: 0, ';
					$visibleStyle .= 'opacity: 1, ';
				}
				if (in_array('scale', $mas_effects))
				{
					$hiddenStyle .= 'transform: \'scale(0.001)\'';
					$visibleStyle .= 'transform: \'scale(1)\'';
				}
			}
			else
			{
				$hiddenStyle .= 'opacity: 0';
				$visibleStyle .= 'opacity: 1';
			}
		}
		else
		{
			$hiddenStyle .= 'opacity: 0';
			$visibleStyle .= 'opacity: 1';
		}

		$effect = "
			hiddenStyle: {
				".$hiddenStyle."
			},
			visibleStyle: {
				".$visibleStyle."
			}
		";

		$transitionDuration = 400;
		if (array_key_exists('mas_transition_duration', $masonry_params))
		{
			$transitionDuration = (int)$masonry_params['mas_transition_duration'];
		}
		$transitionStagger = 0;
		if (array_key_exists('mas_transition_stagger', $masonry_params))
		{
			$transitionStagger = (int)$masonry_params['mas_transition_stagger'];
		}

		$javascript = "

			// Create spinner
			var loader_opts = {
				lines: 9,
				length: 4,
				width: 3,
				radius: 3,
				corners: 1,
				rotate: 0,
				direction: 1,
				color: '#000',
				speed: 1,
				trail: 52,
				shadow: false,
				hwaccel: false,
				className: 'spinner',
				zIndex: 2e9,
				top: '50%',
				left: '50%'
			};
			jQuery('#mnwall_loader_".$widgetID."').append(new Spinner(loader_opts).spin().el).show();

			var transitionDuration = ".$transitionDuration.";
			var transitionStagger = ".$transitionStagger.";

			// Initialize wall
			var _wall = jQuery('#mnwall_iso_container_".$widgetID."').imagesLoaded( function()
			{
				// Instantiate isotope
				_wall.isotope({
					// General
					itemSelector: '.mnwall-item',
					layoutMode: layoutMode,
					// Vertical list
					vertical: {
						horizontalAlignment: 0
					},
					initLayout: false,
					stagger: transitionStagger,
					transitionDuration: transitionDuration,
					".$effect."
				});
			});

			// Initiate layout
			jQuery('.mnwall_container').show();
			_wall.isotope({
				getSortData: {
					ordering: '[data-ordering] parseInt',
					fordering: '[data-fordering] parseInt',
					hits: '[data-hits] parseInt',
					title: '[data-title]',
					id: '[data-id] parseInt',
					alias: '[data-alias]',
					date: '[data-date]',
					modified: '[data-modified]',
					start: '[data-start]',
					finish: '[data-finish]',
					category: '[data-category]',
					author: '[data-author]',
					rating: '[data-rating] parseFloat',
					comments: '[data-comments] parseInt',
					sales: '[data-sales] parseInt',
					points: '[data-points] parseInt',
					friends: '[data-friends] parseInt',
					members: '[data-members] parseInt',
					confirmed: '[data-confirmed] parseInt',
					tickets: '[data-tickets] parseInt',
					index: '[data-index] parseInt',
				},
				sortBy: sortBy,
				sortAscending: sortAscending
			});

			_wall.one('arrangeComplete', function() {
			  fixEqualHeights('all');
				_container.css('opacity', 1);
				jQuery('#mnwall_loader_".$widgetID."').hide();
			});

			// Handle resize
			var wall_id;
			jQuery(window).resize(function(){
				fixEqualHeights('all');
				clearTimeout(wall_id);
				wall_id = setTimeout(doneBrowserResizing, 500);
			});

			function doneBrowserResizing(){
  			_wall.isotope();
			}

			function fixEqualHeights(items)
			{
				if (gridType == '98' && layoutMode == 'fitRows' && db_position_columns == 'below' && equalHeight > 0)
				{
					var max_height = 0;
					if (items == 'all')
					{
						_container.find('.mnwall-item-inner').each(function(index, item) {
							var _this_item_inner = jQuery(this);
							_this_item_inner.css('height', 'auto');
							if (_this_item_inner.outerHeight() > max_height)
							{
								max_height = _this_item_inner.outerHeight();
							}
						});
					}
					else
					{
						jQuery(items).each(function(index, item) {
							var _this_item_inner = jQuery(this).find('.mnwall-item-inner');
							_this_item_inner.css('height', 'auto');
							if (_this_item_inner.outerHeight() > max_height)
							{
								max_height = _this_item_inner.outerHeight();
							}
						});
					}

					_container.find('.mnwall-item-inner').css('height', max_height + 'px');
					setTimeout(function(){ _wall.isotope(); }, 1);
				}
			}

		";

		return $javascript;
	}

	public function initializeHoverBox($hoverBoxEffect)
	{
		$javascript = "

			// Hover effects
			var hoverBoxEffect = '".$hoverBoxEffect."';

			// Hover box trigger
			if (hoverBox == '1') {

				var triggerHoverBox = function triggerHoverBox() {

					if (gridType == 99 || gridType == 98) {
						// Hover effects
						_container.find('.mnwall-item-inner-cont')
						.mouseenter(function(e) {

							if (hoverBoxEffect == 'no') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('hoverShow');
							}
							if (hoverBoxEffect == '1') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('hoverFadeIn');
							}
							if (hoverBoxEffect == '2') {
								jQuery(this).closest('.mnwall-item').find('.mnwall-cover').stop().addClass('perspective');
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-img-div').stop().addClass('flip flipY hoverFlipY');
							}
							if (hoverBoxEffect == '3') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-cover').stop().addClass('perspective');
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-img-div').stop().addClass('flip flipX hoverFlipX');
							}
							if (hoverBoxEffect == '4') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('slideInRight');
							}
							if (hoverBoxEffect == '5') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('slideInLeft');
							}
							if (hoverBoxEffect == '6') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('slideInTop');
							}
							if (hoverBoxEffect == '7') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('slideInBottom');
							}
							if (hoverBoxEffect == '8') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().addClass('mnwzoomIn');
							}

						}).mouseleave(function (e) {

							if (hoverBoxEffect == 'no') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('hoverShow');
							}
							if (hoverBoxEffect == '1') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('hoverFadeIn');
							}
							if (hoverBoxEffect == '2') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-img-div').stop().removeClass('hoverFlipY');
							}
							if (hoverBoxEffect == '3') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-img-div').stop().removeClass('hoverFlipX');
							}
							if (hoverBoxEffect == '4') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('slideInRight');
							}
							if (hoverBoxEffect == '5') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('slideInLeft');
							}
							if (hoverBoxEffect == '6') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('slideInTop');
							}
							if (hoverBoxEffect == '7') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('slideInBottom');
							}
							if (hoverBoxEffect == '8') {
								jQuery(this).closest('.mnwall-item-outer-cont').find('.mnwall-hover-box').stop().removeClass('mnwzoomIn');
							}

						});
					}

					if (gridType != 98 && gridType != 99) {
						// Hover effects
						_container.find('.mnwall-item')
						.mouseenter(function(e) {

							if (hoverBoxEffect == 'no') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('hoverShow');
							}
							if (hoverBoxEffect == '1') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('hoverFadeIn');
							}
							if (hoverBoxEffect == '2') {
								jQuery(this).stop().addClass('perspective');
								jQuery(this).find('.mnwall-item-outer-cont').stop().addClass('flip flipY hoverFlipY');
							}
							if (hoverBoxEffect == '3') {
								jQuery(this).stop().addClass('perspective');
								jQuery(this).find('.mnwall-item-outer-cont').stop().addClass('flip flipX hoverFlipX');
							}
							if (hoverBoxEffect == '4') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('animated slideInRight');
							}
							if (hoverBoxEffect == '5') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('animated slideInLeft');
							}
							if (hoverBoxEffect == '6') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('animated slideInTop');
							}
							if (hoverBoxEffect == '7') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('animated slideInBottom');
							}
							if (hoverBoxEffect == '8') {
								jQuery(this).find('.mnwall-hover-box').stop().addClass('animated mnwzoomIn');
							}

						}).mouseleave(function (e) {

							if (hoverBoxEffect == 'no') {

								jQuery(this).find('.mnwall-hover-box').stop().removeClass('hoverShow');
							}
							if (hoverBoxEffect == '1') {
								jQuery(this).find('.mnwall-hover-box').stop().removeClass('hoverFadeIn');
							}
							if (hoverBoxEffect == '2') {
								jQuery(this).find('.mnwall-item-outer-cont').stop().removeClass('hoverFlipY');
							}
							if (hoverBoxEffect == '3') {
								jQuery(this).find('.mnwall-item-outer-cont').stop().removeClass('hoverFlipX');
							}
							if (hoverBoxEffect == '4') {
								jQuery(this).find('.mnwall-hover-box').stop().removeClass('slideInRight');
							}
							if (hoverBoxEffect == '5') {
								jQuery(this).find('.mnwall-hover-box').stop().removeClass('slideInLeft');
							}
							if (hoverBoxEffect == '6') {
								jQuery(this).find('.mnwall-hover-box').stop().removeClass('slideInTop');
							}
							if (hoverBoxEffect == '7') {
								jQuery(this).find('.mnwall-hover-box').stop().removeClass('slideInBottom');
							}
							if (hoverBoxEffect == '8') {
								jQuery(this).find('.mnwall-hover-box').stop().removeClass('mnwzoomIn');
							}

						});
					}
				}
				triggerHoverBox();
			}

		";

		return $javascript;
	}

	public function initializeFiltersSortings($widgetID)
	{
		$javascript = "

			// Filters
			var filters = {};
			jQuery('#mnwall_iso_filters_".$widgetID."').on( 'click', '.mnwall-filter', function(event)
			{
				event.preventDefault();

				// Show filter name in dropdown
				if (jQuery(this).parents('.mnwall_iso_dropdown').length)
				{
					var data_filter_attr = jQuery(this).attr('data-filter');
					if (typeof data_filter_attr !== typeof undefined && data_filter_attr !== false) {
    					if (data_filter_attr.length)
						{
							var filter_text = jQuery(this).text();
						}
						else
						{
							var filter_text = jQuery(this).closest('.mnwall_iso_dropdown').find('.dropdown-label span').attr('data-label');
						}
						jQuery(this).closest('.mnwall_iso_dropdown').find('.dropdown-label span span').text(filter_text);
					}
				}

				var \$this = jQuery(this);
				// get group key
				var \$buttonGroup = \$this.parents('.button-group');
				var filterGroup = \$buttonGroup.attr('data-filter-group');
				// set filter for group
				filters[ filterGroup ] = \$this.attr('data-filter');
				// combine filters
				var filterValue = '';
				for ( var prop in filters ) {
					filterValue += filters[ prop ];
				}
				// set filter for Isotope
				_wall.isotope({
					filter: filterValue
				});
			});

			// Change active class on filter buttons
			var active_Filters = function active_Filters() {
				var \$activeFilters = _container.find('.button-group').each( function( i, buttonGroup ) {
					var \$buttonGroup = jQuery( buttonGroup );
					\$buttonGroup.on( 'click', 'a', function(event) {
						event.preventDefault();
						\$buttonGroup.find('.mnw_filter_active').removeClass('mnw_filter_active');
						jQuery( this ).addClass('mnw_filter_active');
					});
				});
			};
			active_Filters();

			// Dropdown filter list
			var dropdown_Filters = function dropdown_Filters() {
				var \$dropdownFilters = _container.find('.mnwall_iso_filters .mnwall_iso_dropdown').each( function( i, dropdownGroup ) {
					var \$dropdownGroup = jQuery( dropdownGroup );
					\$dropdownGroup.on( 'click', '.dropdown-label', function(event) {
						event.preventDefault();
						if (jQuery(this).closest('.mnwall_iso_dropdown').hasClass('expanded'))
						{
							var filter_open = true;
						}
						else
						{
							var filter_open = false;
						}
						jQuery('.mnwall_iso_dropdown').removeClass('expanded');
						if (!filter_open)
						{
							jQuery(this).closest('.mnwall_iso_dropdown').addClass('expanded');
						}
					});
				});
				jQuery(document).mouseup(function (e)
				{
					_target = e.target;
					var \$dropdowncontainer = _container.find('.mnwall_iso_dropdown');
					var \$filtercontainer = _container.find('.button-group');
					var \$sortingcontainer = _container.find('.sorting-group');

					if (closeFilters === 0)
					{
						// Close dropdown when click outside
						if (\$filtercontainer.has(e.target).length === 0
							&& \$sortingcontainer.has(e.target).length === 0
							&& _target.closest('div')
							&& !_target.closest('div').classList.contains('dropdown-label')
							&& \$dropdowncontainer.has(e.target).length === 0
							)
						{
							\$dropdowncontainer.removeClass('expanded');
						}
					}
					else
					{
						// Close dropdown when click inside
						if ((\$filtercontainer.has(e.target).length === 0
							&& \$sortingcontainer.has(e.target).length === 0
							&& _target.closest('div')
							&& !_target.closest('div').classList.contains('dropdown-label')
							&& \$dropdowncontainer.has(e.target).length === 0)
							|| _target.classList.contains('mnwall-filter')
							)
						{
							\$dropdowncontainer.removeClass('expanded');
						}
					}
				});
			};
			dropdown_Filters();

			// Bind sort button click
			_container.find('.sorting-group-filters').on( 'click', '.mnwall-filter', function(event) {
				event.preventDefault();
				var sortValue = jQuery(this).attr('data-sort-value');
				// Add second ordering: id
				sortValue = [sortValue, 'id'];
				// set filter for Isotope
				_wall.isotope({
					sortBy: sortValue
				});
			});

			// Change active class on sorting filters
			_container.find('.sorting-group-filters').each( function( i, sortingGroup ) {
				var \$sortingGroup = jQuery( sortingGroup );
				\$sortingGroup.on( 'click', '.mnwall-filter', function() {
					\$sortingGroup.find('.mnw_filter_active').removeClass('mnw_filter_active');
					jQuery( this ).addClass('mnw_filter_active');
				});
			});

			// Bind sorting direction button click
			_container.find('.sorting-group-direction').on( 'click', '.mnwall-filter', function(event) {
				event.preventDefault();
				var sortDirection = jQuery(this).attr('data-sort-value');
				if (sortDirection == 'asc') {
					sort_Direction = true;
				} else {
					sort_Direction = false;
				}
				// set direction
				_wall.isotope({
					sortAscending: sort_Direction
				});
			});

			// Change active class on sorting direction
			_container.find('.sorting-group-direction').each( function( i, sortingDirection ) {
				var \$sortingDirection = jQuery( sortingDirection );
				\$sortingDirection.on( 'click', '.mnwall-filter', function() {
					\$sortingDirection.find('.mnw_filter_active').removeClass('mnw_filter_active');
					jQuery( this ).addClass('mnw_filter_active');
				});
			});

			// Dropdown sorting list
			var dropdown_Sortings = function dropdown_Sortings() {
				var \$dropdownSortings = _container.find('.mnwall_iso_sortings .mnwall_iso_dropdown').each( function( i, dropdownSorting ) {
					var \$dropdownSorting = jQuery( dropdownSorting );
					\$dropdownSorting.on( 'click', '.dropdown-label', function(event) {
						event.preventDefault();
						if (jQuery(this).closest('.mnwall_iso_dropdown').hasClass('expanded'))
						{
							var sorting_open = true;
						}
						else
						{
							var sorting_open = false;
						}
						jQuery('.mnwall_iso_dropdown').removeClass('expanded');
						if (!sorting_open)
						{
							jQuery(this).closest('.mnwall_iso_dropdown').addClass('expanded');
						}
					});
				});
			};
			dropdown_Sortings();

			// Reset Filters and sortings
			function reset_filters()
			{
				var \$resetFilters = _container.find('.button-group').each( function( i, buttonGroup ) {
					var \$buttonGroup = jQuery( buttonGroup );
					\$buttonGroup.find('.mnw_filter_active').removeClass('mnw_filter_active');
					\$buttonGroup.find('li:first-child a').addClass('mnw_filter_active');

					// Reset filters
					var filterGroup = \$buttonGroup.attr('data-filter-group');
					filters[ filterGroup ] = '';
					var filterValue = '';
					// set filter for Isotope
					_wall.isotope({
						filter: filterValue,
						sortBy: sortBy,
						sortAscending: sortAscending
					});

					// Reset dropdown filters text
					_container.find('.mnwall_iso_dropdown').each( function( i, dropdownGroup ) {
						var filter_text = jQuery(dropdownGroup).find('.dropdown-label span').attr('data-label');
						jQuery(dropdownGroup).find('.dropdown-label span span').text(filter_text);
					});
				});

				// Get first item in sortBy array
				var \$resetSortings = _container.find('.sorting-group-filters').each( function( i, sortingGroup ) {
					var \$sortingGroup = jQuery( sortingGroup );
					\$sortingGroup.find('.mnw_filter_active').removeClass('mnw_filter_active');
					\$sortingGroup.find('li a[data-sort-value=\"'+sortBy[0]+'\"]').addClass('mnw_filter_active');
				});
				var \$resetSortingDirection = _container.find('.sorting-group-direction').each( function( i, sortingGroupDirection ) {
					var \$sortingGroupDirection = jQuery( sortingGroupDirection );
					\$sortingGroupDirection.find('.mnw_filter_active').removeClass('mnw_filter_active');
					\$sortingGroupDirection.find('li a[data-sort-value=\"'+sortDirection+'\"]').addClass('mnw_filter_active');
				});
			}

			jQuery('#mnwall_reset_".$widgetID.", #mnwall_container_".$widgetID." .mnwall-reset-btn').on( 'click', '', function(event)
			{
				reset_filters();
			});

		";

		return $javascript;
	}
}
