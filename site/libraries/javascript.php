<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibJavascript
{
	public function loadMasonryJavascript($masonry_params, $widgetID)
	{
		$document = \JFactory::getDocument();

		$javascript = "
		(function(document, Joomla) {
			'use strict';
			
			var createSpinner = function(divIdentifier)
			{
				var spinner_options = {
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

				var target = divIdentifier;

				if (target)
				{
					var spinner = new Spinner(spinner_options).spin();
					target.innerHTML = '';
					target.appendChild(spinner.el);
				}

				return;
			}

			document.addEventListener('DOMContentLoaded', function() 
			{
		";

			$javascript .= $this->loadJavascriptVars($masonry_params, $widgetID);

			$javascript .= $this->initializeWall($masonry_params, $widgetID);

			if ($masonry_params['mas_hb'])
			{
				$javascript .= $this->initializeHoverBox($masonry_params['mas_hb_effect']);
			}

			$javascript .= $this->initializeFiltersSortings($widgetID);

			$javascript .= "
				// Handle modal images 
				var zoomImage = document.querySelector('#zoomImage_".$widgetID."');

				if (!zoomImage)
					return;

				zoomImage.addEventListener('show.bs.modal', function(event)
				{
					// Button that triggered the modal
					var button = event.relatedTarget;

					// Extract info from data-* attributes
					var title = button.getAttribute('data-title');
					var image = button.getAttribute('data-src');

					// Update the title 
					zoomImage.querySelector('.modal-title').textContent = title;

					// Update the image
					zoomImage.querySelector('img').setAttribute('src', image);
				})
			});

		})(document, Joomla);
		";

		$document->addCustomTag('<script type="text/javascript">'.$javascript.'</script>');

	}

	public function loadJavascriptVars($masonry_params, $widgetID)
	{
		$utilities = new MinitekWallLibUtilities;
		$source_id = $utilities->getSourceID($widgetID);
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

		if (array_key_exists('mas_layout_mode', $masonry_params)) 
		{
			$layoutMode = $masonry_params['mas_layout_mode'];
		}

		$wall_category_filters = $masonry_params['mas_category_filters'];
		$wall_tag_filters = $masonry_params['mas_tag_filters'];
		$wall_date_filters = $masonry_params['mas_date_filters'];
		$wall_sortings = 
			($masonry_params['mas_title_sorting']
			|| $masonry_params['mas_category_sorting']
			|| $masonry_params['mas_author_sorting']
			|| $masonry_params['mas_date_sorting']
			|| $masonry_params['mas_hits_sorting']
			|| $masonry_params['mas_sorting_direction'])
			? true : false;

		$filters_enabled = ($wall_category_filters || $wall_tag_filters || $wall_date_filters || $wall_sortings) ? 'true' : 'false';
		$filters_mode = isset($masonry_params['mas_filters_mode']) ? $masonry_params['mas_filters_mode'] : 'dynamic';
		$closeFilters = isset($masonry_params['mas_close_filters']) ? $masonry_params['mas_close_filters'] : 0;
		$equalHeight = isset($masonry_params['mas_force_equal_height']) ? $masonry_params['mas_force_equal_height'] : 0;

		$javascript = "
			// Global variables
			var site_path = '".$site_path."';
			var filtersEnabled = '".$filters_enabled."';
			var filtersMode = '".$filters_mode."';
			var closeFilters = ".$closeFilters.";
			var _container = document.querySelector('#mnwall_container_".$widgetID."');
			var gridType = parseInt('".$gridType."', 10);
			var grid_type = '".$grid_type."';
			var layoutMode = '".$layoutMode."';
			var hoverBox = '".$hoverBox."';
			var db_position_columns = '".$masonry_params['mas_db_position_columns']."';
			var equalHeight = '".$equalHeight."';
			var sortBy = _container.getAttribute('data-order');
			var sortDirection = _container.getAttribute('data-direction');
			sortDirection = (sortDirection == null) ? '' : sortDirection = sortDirection.toLowerCase();
			var sortAscending = sortDirection == 'asc' ? true : false;
			var source_id = '".$source_id."';

			if (sortBy == 'RAND()' || sortBy == 'rand' || sortBy == 'random' || source_id == 'rss')
			{
				sortBy = ['index'];
				sortAscending = true;
			}
			else
			{
				sortBy = [sortBy, 'id', 'title'];
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
					$hiddenStyle .= "transform: 'scale(0.001)'";
					$visibleStyle .= "transform: 'scale(1)'";
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
			var transitionDuration = ".$transitionDuration.";
			var transitionStagger = ".$transitionStagger.";
			var iso_container = document.querySelector('#mnwall_iso_container_".$widgetID."');
			var _wall;

			createSpinner(document.querySelector('#mnwall_loader_".$widgetID."'));
			document.querySelector('#mnwall_loader_".$widgetID."').style.display = 'block';

			imagesLoaded(iso_container, function()
			{
				_wall = new Isotope(iso_container, 
				{
					itemSelector: '.mnwall-item',
					layoutMode: layoutMode,
					vertical: {
						horizontalAlignment: 0
					},
					initLayout: false,
					stagger: transitionStagger,
					transitionDuration: transitionDuration,
					".$effect.",
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
						index: '[data-index] parseInt',
					}
				});

				_container.style.display = 'block';

				_wall.arrange({
					sortBy: sortBy,
					sortAscending: sortAscending
				});

				fixEqualHeights('all');
				_container.style.opacity = 1;
				document.querySelector('#mnwall_loader_".$widgetID."').style.display = 'none';
			});

			// Handle resize
			var _resize;

			window.addEventListener('resize', function() 
			{
				clearTimeout(_resize);
				_resize = setTimeout(doneBrowserResizing, 500);
			});

			function doneBrowserResizing()
			{
				fixEqualHeights('all');
				_wall.arrange();
			}

			function fixEqualHeights(items)
			{
				if (gridType == '98' && layoutMode == 'fitRows' && db_position_columns == 'below' && equalHeight > 0)
				{
					var max_height = 0;

					if (items == 'all')
					{
						_container.querySelectorAll('.mnwall-item-inner').forEach(function(a)
						{
							a.style.height = 'auto';

							if (a.offsetHeight > max_height)
							{
								max_height = a.offsetHeight;
							}
						});
					}
					else
					{
						items.forEach(function(a)
						{
							var _this_item_inner = a.querySelector('.mnwall-item-inner');
							_this_item_inner.style.height = 'auto';

							if (_this_item_inner.offsetHeight > max_height)
							{
								max_height = _this_item_inner.offsetHeight;
							}
						});
					}

					_container.querySelectorAll('.mnwall-item-inner').forEach(function(a)
					{
						a.style.height = max_height + 'px';
					});

					setTimeout(function(){ _wall.arrange(); }, 1);
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
			if (hoverBox == '1') 
			{
				var triggerHoverBox = function triggerHoverBox()
				{
					if (gridType == 99 || gridType == 98) 
					{
						// Hover effects
						_container.querySelectorAll('.mnwall-item').forEach(function(a)
						{
							a.addEventListener('mouseenter', function(e)
							{
								if (hoverBoxEffect == 'no')
								{
									this.querySelector('.mnwall-hover-box').classList.add('hoverShow');
								}
								else if (hoverBoxEffect == '1')
								{
									this.querySelector('.mnwall-hover-box').classList.add('hoverFadeIn');
								}
								else if (hoverBoxEffect == '2')
								{
									this.querySelector('.mnwall-cover').classList.add('perspective');
									this.querySelector('.mnwall-img-div').classList.add('flip flipY hoverFlipY');
								}
								else if (hoverBoxEffect == '3')
								{
									this.querySelector('.mnwall-cover').classList.add('perspective');
									this.querySelector('.mnwall-img-div').classList.add('flip flipX hoverFlipX');
								}
								else if (hoverBoxEffect == '4')
								{
									this.querySelector('.mnwall-hover-box').classList.add('slideInRight');
								}
								else if (hoverBoxEffect == '5')
								{
									this.querySelector('.mnwall-hover-box').classList.add('slideInLeft');
								}
								else if (hoverBoxEffect == '6')
								{
									this.querySelector('.mnwall-hover-box').classList.add('slideInTop');
								}
								else if (hoverBoxEffect == '7')
								{
									this.querySelector('.mnwall-hover-box').classList.add('slideInBottom');
								}
								else if (hoverBoxEffect == '8')
								{
									this.querySelector('.mnwall-hover-box').classList.add('mnwzoomIn');
								}
							});
							
							a.addEventListener('mouseleave', function(e)
							{
								if (hoverBoxEffect == 'no')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('hoverShow');
								}
								else if (hoverBoxEffect == '1')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('hoverFadeIn');
								}
								else if (hoverBoxEffect == '2')
								{
									this.querySelector('.mnwall-img-div').classList.remove('hoverFlipY');
								}
								else if (hoverBoxEffect == '3')
								{
									this.querySelector('.mnwall-img-div').classList.remove('hoverFlipX');
								}
								else if (hoverBoxEffect == '4')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInRight');
								}
								else if (hoverBoxEffect == '5')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInLeft');
								}
								else if (hoverBoxEffect == '6')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInTop');
								}
								else if (hoverBoxEffect == '7')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInBottom');
								}
								else if (hoverBoxEffect == '8')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('mnwzoomIn');
								}
							});
						});
					}

					if (gridType != 98 && gridType != 99)
					{
						// Hover effects
						_container.querySelectorAll('.mnwall-item').forEach(function(a)
						{
							a.addEventListener('mouseenter', function(e)
							{
								if (hoverBoxEffect == 'no')
								{
									this.querySelector('.mnwall-hover-box').classList.add('hoverShow');
								}
								else if (hoverBoxEffect == '1')
								{
									this.querySelector('.mnwall-hover-box').classList.add('hoverFadeIn');
								}
								else if (hoverBoxEffect == '2')
								{
									this.classList.add('perspective');
									this.querySelector('.mnwall-item-outer-cont').classList.add('flip flipY hoverFlipY');
								}
								else if (hoverBoxEffect == '3')
								{
									this.classList.add('perspective');
									this.querySelector('.mnwall-item-outer-cont').classList.add('flip flipX hoverFlipX');
								}
								else if (hoverBoxEffect == '4')
								{
									this.querySelector('.mnwall-hover-box').classList.add('animated slideInRight');
								}
								else if (hoverBoxEffect == '5')
								{
									this.querySelector('.mnwall-hover-box').classList.add('animated slideInLeft');
								}
								else if (hoverBoxEffect == '6')
								{
									this.querySelector('.mnwall-hover-box').classList.add('animated slideInTop');
								}
								else if (hoverBoxEffect == '7')
								{
									this.querySelector('.mnwall-hover-box').classList.add('animated slideInBottom');
								}
								else if (hoverBoxEffect == '8')
								{
									this.querySelector('.mnwall-hover-box').classList.add('animated mnwzoomIn');
								}
							});
							
							a.addEventListener('mouseleave', function(e)
							{
								if (hoverBoxEffect == 'no')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('hoverShow');
								}
								else if (hoverBoxEffect == '1')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('hoverFadeIn');
								}
								else if (hoverBoxEffect == '2')
								{
									this.querySelector('.mnwall-item-outer-cont').classList.remove('hoverFlipY');
								}
								else if (hoverBoxEffect == '3')
								{
									this.querySelector('.mnwall-item-outer-cont').classList.remove('hoverFlipX');
								}
								else if (hoverBoxEffect == '4')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInRight');
								}
								else if (hoverBoxEffect == '5')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInLeft');
								}
								else if (hoverBoxEffect == '6')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInTop');
								}
								else if (hoverBoxEffect == '7')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('slideInBottom');
								}
								else if (hoverBoxEffect == '8')
								{
									this.querySelector('.mnwall-hover-box').classList.remove('mnwzoomIn');
								}
							});
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

			// Bind filter button click
			if (_container.querySelector('.mnwall_iso_filters_cont'))
			{
				_container.querySelector('.mnwall_iso_filters_cont').addEventListener('click', function(e)
				{
					e.preventDefault();

					if (e.target && e.target.classList.contains('mnwall-filter'))
					{
						var _this = e.target;
						
						// Show filter name in dropdown
						if (_this.closest('.mnwall_iso_dropdown'))
						{
							var data_filter_attr = _this.getAttribute('data-filter');

							if (typeof data_filter_attr !== typeof undefined && data_filter_attr !== false)
							{
								if (data_filter_attr.length)
								{
									var filter_text = _this.textContent;
								}
								else
								{
									var filter_text = _this.closest('.mnwall_iso_dropdown').querySelector('.dropdown-label span').getAttribute('data-label');
								}

								_this.closest('.mnwall_iso_dropdown').querySelector('.dropdown-label span span').textContent = filter_text;
							}
						}

						// Get group key
						var filterGroup = _this.closest('.button-group').getAttribute('data-filter-group');

						// Set filter for group
						filters[ filterGroup ] = _this.getAttribute('data-filter');

						// Combine filters
						var filterValue = '';

						for (var prop in filters)
						{
							filterValue += filters[ prop ];
						}

						// Set filter for Isotope
						_wall.arrange({
							filter: filterValue
						});
					}
				});
			}

			// Change active class on filter buttons
			var active_Filters = function active_Filters()
			{
				_container.querySelectorAll('.button-group').forEach(function(buttonGroup)
				{
					buttonGroup.querySelectorAll('.mnwall-filter').forEach(function(a)
					{
						a.addEventListener('click', function(e)
						{
							e.preventDefault();
					
							buttonGroup.querySelector('.mnw_filter_active').classList.remove('mnw_filter_active');
							a.classList.add('mnw_filter_active');
						});
					});
				});
			};

			active_Filters();

			// Dropdown filter list
			var dropdown_Filters = function dropdown_Filters()
			{
				_container.querySelector('.mnwall_iso_filters_cont').querySelectorAll('.mnwall_iso_dropdown').forEach(function(dropdownGroup)
				{
					dropdownGroup.querySelector('.dropdown-label').addEventListener('click', function(e)
					{
						e.preventDefault();

						if (this.closest('.mnwall_iso_dropdown').classList.contains('expanded'))
						{
							var filter_open = true;
						}
						else
						{
							var filter_open = false;
						}

						_container.querySelectorAll('.mnwall_iso_dropdown').forEach(function(a)
						{
							a.classList.remove('expanded');
						});

						if (!filter_open)
						{
							this.closest('.mnwall_iso_dropdown').classList.add('expanded');
						}
					});
				});

				// Close dropdowns
				document.addEventListener('mouseup', function(e)
				{
					var _target = e.target;
					var dropdowncontainers = _container.querySelectorAll('.mnwall_iso_dropdown');

					if (!dropdowncontainers)
						return;

					if (closeFilters === 0)
					{
						// Close when click outside
						if (!_target.closest('.mnwall_iso_dropdown'))
						{
							dropdowncontainers.forEach(function(a)
							{
								a.classList.remove('expanded');
							});
						}
					}
					else
					{
						// Close when click inside
						if (_target.closest('.mnwall_iso_dropdown') && !_target.closest('.dropdown-label'))
						{
							dropdowncontainers.forEach(function(a)
							{
								a.classList.remove('expanded');
							});
						}
					}
				});
			};

			dropdown_Filters();

			// Bind sort button click
			if (_container.querySelector('.sorting-group-filters'))
			{
				_container.querySelector('.sorting-group-filters').querySelectorAll('.mnwall-filter').forEach(function(a) 
				{
					a.addEventListener('click', function(e)
					{
						e.preventDefault();
						var sortValue = this.getAttribute('data-sort-value');

						// Add second ordering: id
						sortValue = [sortValue, 'id'];

						// set filter for Isotope
						_wall.arrange({
							sortBy: sortValue
						});

						// Change active class on sorting filters
						_container.querySelector('.sorting-group-filters').querySelector('.mnw_filter_active').classList.remove('mnw_filter_active');
						this.classList.add('mnw_filter_active');
					});
				});
			}

			// Bind sorting direction button click
			if (_container.querySelector('.sorting-group-direction'))
			{
				_container.querySelector('.sorting-group-direction').querySelectorAll('.mnwall-filter').forEach(function(a)
				{
					a.addEventListener('click', function(e)
					{
						e.preventDefault();

						var sortDirection = this.getAttribute('data-sort-value');
						var sort_Direction;

						if (sortDirection == 'asc')
						{
							sort_Direction = true;
						} 
						else
						{
							sort_Direction = false;
						}

						// set direction
						_wall.arrange({
							sortAscending: sort_Direction
						});

						// Change active class on sorting direction
						_container.querySelector('.sorting-group-direction').querySelector('.mnw_filter_active').classList.remove('mnw_filter_active');
						this.classList.add('mnw_filter_active');
					});
				});
			}

			// Dropdown sorting list
			var dropdown_Sortings = function dropdown_Sortings()
			{
				_container.querySelector('.mnwall_iso_sortings').querySelectorAll('.mnwall_iso_dropdown').forEach(function(dropdownSorting)
				{
					dropdownSorting.querySelector('.dropdown-label').addEventListener('click', function(e)
					{
						e.preventDefault();

						if (this.closest('.mnwall_iso_dropdown').classList.contains('expanded'))
						{
							var sorting_open = true;
						}
						else
						{
							var sorting_open = false;
						}

						_container.querySelectorAll('.mnwall_iso_dropdown').forEach(function(a)
						{
							a.classList.remove('expanded');
						});

						if (!sorting_open)
						{
							this.closest('.mnwall_iso_dropdown').classList.add('expanded');
						}
					});
				});
			};

			dropdown_Sortings();

			// Reset Filters and sortings
			function reset_filters()
			{
				_container.querySelectorAll('.button-group').forEach(function(buttonGroup)
				{
					buttonGroup.querySelector('.mnw_filter_active').classList.remove('mnw_filter_active');
					buttonGroup.querySelector('li:first-child a').classList.add('mnw_filter_active');

					// Reset filters
					var filterGroup = buttonGroup.getAttribute('data-filter-group');
					filters[ filterGroup ] = '';
				});

				// Reset dropdown filters text
				_container.querySelectorAll('.mnwall_iso_dropdown').forEach(function(dropdownGroup)
				{
					var filter_text = dropdownGroup.querySelector('.dropdown-label span').getAttribute('data-label');
					dropdownGroup.querySelector('.dropdown-label span span').textContent = filter_text;
				});

				// Get first item in sortBy array
				_container.querySelectorAll('.sorting-group-filters').forEach(function(sortingGroup)
				{
					sortingGroup.querySelector('.mnw_filter_active').classList.remove('mnw_filter_active');
					sortingGroup.querySelector('li a[data-sort-value=\"'+sortBy[0]+'\"]').classList.add('mnw_filter_active');
				});

				_container.querySelectorAll('.sorting-group-direction').forEach(function(sortingGroupDirection)
				{
					sortingGroupDirection.querySelector('.mnw_filter_active').classList.remove('mnw_filter_active');
					sortingGroupDirection.querySelector('li a[data-sort-value=\"'+sortDirection+'\"]').classList.add('mnw_filter_active');
				});

				// set filter for Isotope
				_wall.arrange({
					filter: '',
					sortBy: sortBy,
					sortAscending: sortAscending
				});
			}

			document.querySelectorAll('#mnwall_reset_".$widgetID.", #mnwall_container_".$widgetID." .mnwall-reset-btn').forEach(function(a)
			{
				a.addEventListener('click', function(e)
				{
					e.preventDefault();

					reset_filters();
				});
			});
		";

		return $javascript;
	}
}
