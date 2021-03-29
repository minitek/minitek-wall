<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Site\View\Masonry;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\MVC\View\GenericDataException;

/**
 * HTML Masonry View class for the MinitekWall component
 *
 * @since  4.0.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
 	{
		$document = \JFactory::getDocument();
		$this->model = $this->getModel();
		$this->masonry_options = $this->model->masonry_options;
		$this->utilities = $this->model->utilities;
		$this->params = $this->utilities->getParams('com_minitekwall');
		$jinput = \JFactory::getApplication()->input;
		$this->widgetID = $jinput->get('widget_id', '', 'INT');
		$page = $jinput->get('page', '1', 'INT');

		// Get masonry parameters
		$masonry_params = $this->utilities->getMasonryParams($this->widgetID);
		$this->masonry_params = $masonry_params;

		// Get Grid
		$this->gridType = $masonry_params['mas_grid'];
		$this->suffix = '';

		if (array_key_exists('mas_suffix', $masonry_params))
		{
			$this->suffix = $masonry_params['mas_suffix'];
		}

		$masCols = $masonry_params['mas_cols'];
		$masColsper = 100 / $masCols;
		$this->gutter = $masonry_params['mas_gutter'];
		$this->mas_border_radius = (int)$masonry_params['mas_border_radius'];
		$this->mas_border = (int)$masonry_params['mas_border'];
		$this->mas_border_color = $masonry_params['mas_border_color'];

		// Layout/Grid class
		if ($this->gridType == '99v')
		{
			$this->mnwall_layout = 'list';
			$this->mnwall_grid = '';
		}
		else if ($this->gridType == '98o')
		{
			$this->mnwall_layout = 'columns';
			$this->mnwall_grid = '';
		}
		else
		{
			$this->mnwall_layout = 'masonry';
			$this->mnwall_grid = 'mnwall-grid'.$this->gridType;
		}

		// Columns
		$this->cols = '';
		$masColsper = number_format((float)$masColsper, 4, '.', '');
		$this->cols = 'width: '.$masColsper.'%;';

		// Images
		$this->mas_images = $masonry_params['mas_images'];
		$this->mas_image_link = true;

		if (array_key_exists('mas_image_link', $masonry_params))
		{
			$this->mas_image_link = $masonry_params['mas_image_link'];
		}

		$mas_crop_images = $masonry_params['mas_crop_images'];
		$mas_image_width = $masonry_params['mas_image_width'];
		$mas_image_height = $masonry_params['mas_image_height'];
		$this->full_width_image = $masonry_params['mas_full_width_image'];

		// Get Total count - Arrows pagination
		$startLimit = $masonry_params['mas_starting_limit'];

		if ($page === '1')
		{
			// Load masonry css
			$document->addStyleSheet(\JURI::base(true).'/components/com_minitekwall/assets/css/masonry.css');

			// Add scripts
			$document->addCustomTag('<script src="'.\JURI::base(true).'/components/com_minitekwall/assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>');
			$document->addCustomTag('<script src="'.\JURI::base(true).'/components/com_minitekwall/assets/js/isotope.pkgd.min.js" type="text/javascript"></script>');
			$document->addCustomTag('<script src="'.\JURI::base(true).'/components/com_minitekwall/assets/js/packery-mode.pkgd.min.js" type="text/javascript"></script>');
			$document->addCustomTag('<script src="'.\JURI::base(true).'/components/com_minitekwall/assets/js/spin.min.js" type="text/javascript"></script>');
			$document->addCustomTag('<script src="'.\JURI::base(true).'/components/com_minitekwall/assets/js/mwall.js" type="text/javascript"></script>');

			// Initialize Mwall
			$document->addCustomTag("<script>
			document.addEventListener('DOMContentLoaded', function() 
			{
				Mwall.initialise(
					".json_encode($masonry_params).", 
					".$this->widgetID."
				);
			});
			</script>");

			// Responsive Utilities
			$responsive_masonry = $this->model->responsive_masonry;

			if (array_key_exists('mas_enable_responsive', $masonry_params))
			{
				if ($masonry_params['mas_enable_responsive'])
				{
					$responsive_masonry->loadResponsiveMasonry($masonry_params, $this->widgetID);
				}
			}
			else
			{
				$responsive_masonry->loadResponsiveMasonry($masonry_params, $this->widgetID);
			}
		}

		// Detail box
		$detailBoxTitleLimit = $masonry_params['mas_db_title_limit'];
		$this->detailBoxTitleLink = true;

		if (array_key_exists('mas_db_title_link', $masonry_params))
		{
			$this->detailBoxTitleLink = $masonry_params['mas_db_title_link'];
		}

		$detailBoxIntrotextLimit = $masonry_params['mas_db_introtext_limit'];
		$detailBoxStripTags = $masonry_params['mas_db_strip_tags'];
		$detailBoxDateFormat = $masonry_params['mas_db_date_format'];

		// Big
		$this->detailBoxBig = $masonry_params['mas_db_big'];
		$this->detailBoxPositionBig = $masonry_params['mas_db_position_big'];
		$this->detailBoxBackgroundBig = $masonry_params['mas_db_bg_big'];
		$this->detailBoxBackgroundOpacityBig = $masonry_params['mas_db_bg_opacity_big'];
		$this->detailBoxTextColorBig = $masonry_params['mas_db_color_big'];
		$this->detailBoxTitleBig = $masonry_params['mas_db_title_big'];
		$this->detailBoxIntrotextBig = $masonry_params['mas_db_introtext_big'];
		$this->detailBoxDateBig = $masonry_params['mas_db_date_big'];
		$this->detailBoxCategoryBig = $masonry_params['mas_db_category_big'];
		$this->detailBoxTypeBig = $masonry_params['mas_db_content_type_big'];
		$this->detailBoxAuthorBig = $masonry_params['mas_db_author_big'];
		$this->detailBoxHitsBig = $masonry_params['mas_db_hits_big'];
		$this->detailBoxCountBig = $masonry_params['mas_db_count_big'];
		$this->detailBoxReadmoreBig = $masonry_params['mas_db_readmore_big'];

		// Landscape
		$this->detailBoxLscape = $masonry_params['mas_db_lscape'];
		$this->detailBoxPositionLscape = $masonry_params['mas_db_position_lscape'];
		$this->detailBoxBackgroundLscape = $masonry_params['mas_db_bg_lscape'];
		$this->detailBoxBackgroundOpacityLscape = $masonry_params['mas_db_bg_opacity_lscape'];
		$this->detailBoxTextColorLscape = $masonry_params['mas_db_color_lscape'];
		$this->detailBoxTitleLscape = $masonry_params['mas_db_title_lscape'];
		$this->detailBoxIntrotextLscape = $masonry_params['mas_db_introtext_lscape'];
		$this->detailBoxDateLscape = $masonry_params['mas_db_date_lscape'];
		$this->detailBoxCategoryLscape = $masonry_params['mas_db_category_lscape'];
		$this->detailBoxTypeLscape = $masonry_params['mas_db_content_type_lscape'];
		$this->detailBoxAuthorLscape = $masonry_params['mas_db_author_lscape'];
		$this->detailBoxHitsLscape = $masonry_params['mas_db_hits_lscape'];
		$this->detailBoxCountLscape = $masonry_params['mas_db_count_lscape'];
		$this->detailBoxReadmoreLscape = $masonry_params['mas_db_readmore_lscape'];

		// Portrait
		$this->detailBoxPortrait = $masonry_params['mas_db_portrait'];
		$this->detailBoxPositionPortrait = $masonry_params['mas_db_position_portrait'];
		$this->detailBoxBackgroundPortrait = $masonry_params['mas_db_bg_portrait'];
		$this->detailBoxBackgroundOpacityPortrait = $masonry_params['mas_db_bg_opacity_portrait'];
		$this->detailBoxTextColorPortrait = $masonry_params['mas_db_color_portrait'];
		$this->detailBoxTitlePortrait = $masonry_params['mas_db_title_portrait'];
		$this->detailBoxIntrotextPortrait = $masonry_params['mas_db_introtext_portrait'];
		$this->detailBoxDatePortrait = $masonry_params['mas_db_date_portrait'];
		$this->detailBoxCategoryPortrait = $masonry_params['mas_db_category_portrait'];
		$this->detailBoxTypePortrait = $masonry_params['mas_db_content_type_portrait'];
		$this->detailBoxAuthorPortrait = $masonry_params['mas_db_author_portrait'];
		$this->detailBoxHitsPortrait = $masonry_params['mas_db_hits_portrait'];
		$this->detailBoxCountPortrait = $masonry_params['mas_db_count_portrait'];
		$this->detailBoxReadmorePortrait = $masonry_params['mas_db_readmore_portrait'];

		// Small
		$this->detailBoxSmall = $masonry_params['mas_db_small'];
		$this->detailBoxPositionSmall = $masonry_params['mas_db_position_small'];
		$this->detailBoxBackgroundSmall = $masonry_params['mas_db_bg_small'];
		$this->detailBoxBackgroundOpacitySmall = $masonry_params['mas_db_bg_opacity_small'];
		$this->detailBoxTextColorSmall = $masonry_params['mas_db_color_small'];
		$this->detailBoxTitleSmall = $masonry_params['mas_db_title_small'];
		$this->detailBoxIntrotextSmall = $masonry_params['mas_db_introtext_small'];
		$this->detailBoxDateSmall = $masonry_params['mas_db_date_small'];
		$this->detailBoxCategorySmall = $masonry_params['mas_db_category_small'];
		$this->detailBoxTypeSmall = $masonry_params['mas_db_content_type_small'];
		$this->detailBoxAuthorSmall = $masonry_params['mas_db_author_small'];
		$this->detailBoxHitsSmall = $masonry_params['mas_db_hits_small'];
		$this->detailBoxCountSmall = $masonry_params['mas_db_count_small'];
		$this->detailBoxReadmoreSmall = $masonry_params['mas_db_readmore_small'];

		// Columns
		$this->detailBoxColumns = $masonry_params['mas_db_columns'];
		$this->detailBoxPositionColumns = $masonry_params['mas_db_position_columns'];
		$this->detailBoxBackgroundColumns = $masonry_params['mas_db_bg_columns'];
		$this->detailBoxBackgroundOpacityColumns = $masonry_params['mas_db_bg_opacity_columns'];
		$this->detailBoxTextColorColumns = $masonry_params['mas_db_color_columns'];
		$this->detailBoxTitleColumns = $masonry_params['mas_db_title_columns'];
		$this->detailBoxIntrotextColumns = $masonry_params['mas_db_introtext_columns'];
		$this->detailBoxDateColumns = $masonry_params['mas_db_date_columns'];
		$this->detailBoxCategoryColumns = $masonry_params['mas_db_category_columns'];
		$this->detailBoxTypeColumns = $masonry_params['mas_db_content_type_columns'];
		$this->detailBoxAuthorColumns = $masonry_params['mas_db_author_columns'];
		$this->detailBoxHitsColumns = $masonry_params['mas_db_hits_columns'];
		$this->detailBoxCountColumns = $masonry_params['mas_db_count_columns'];
		$this->detailBoxReadmoreColumns = $masonry_params['mas_db_readmore_columns'];

		// Detail box overall vars
		$this->detailBoxAll = true;
		$this->detailBoxTitleAll = true;
		$this->detailBoxIntrotextAll = true;
		$this->detailBoxDateAll = true;
		$this->detailBoxCategoryAll = true;
		$this->detailBoxTypeAll = true;
		$this->detailBoxAuthorAll = true;
		$this->detailBoxHitsAll = true;
		$this->detailBoxCountAll = true;
		$this->detailBoxReadmoreAll = true;

		if ((int)$this->gridType != '98' && (int)$this->gridType != '99')
		{
			if (!$this->detailBoxBig &&
				!$this->detailBoxLscape &&
				!$this->detailBoxPortrait &&
				!$this->detailBoxSmall &&
				!$this->detailBoxColumns)
			{
				$this->detailBoxAll = false;
			}

			if (!$this->detailBoxTitleBig &&
				!$this->detailBoxTitleLscape &&
				!$this->detailBoxTitlePortrait &&
				!$this->detailBoxTitleSmall &&
				!$this->detailBoxTitleColumns)
			{
				$this->detailBoxTitleAll = false;
			}

			if (!$this->detailBoxIntrotextBig &&
				!$this->detailBoxIntrotextLscape &&
				!$this->detailBoxIntrotextPortrait &&
				!$this->detailBoxIntrotextSmall &&
				!$this->detailBoxIntrotextColumns)
			{
				$this->detailBoxIntrotextAll = false;
			}

			if (!$this->detailBoxDateBig &&
				!$this->detailBoxDateLscape &&
				!$this->detailBoxDatePortrait &&
				!$this->detailBoxDateSmall &&
				!$this->detailBoxDateColumns)
			{
				$this->detailBoxDateAll = false;
			}

			if (!$this->detailBoxCategoryBig &&
				!$this->detailBoxCategoryLscape &&
				!$this->detailBoxCategoryPortrait &&
				!$this->detailBoxCategorySmall &&
				!$this->detailBoxCategoryColumns)
			{
				$this->detailBoxCategoryAll = false;
			}

			if (!$this->detailBoxTypeBig &&
				!$this->detailBoxTypeLscape &&
				!$this->detailBoxTypePortrait &&
				!$this->detailBoxTypeSmall &&
				!$this->detailBoxTypeColumns)
			{
				$this->detailBoxTypeAll = false;
			}

			if (!$this->detailBoxAuthorBig &&
				!$this->detailBoxAuthorLscape &&
				!$this->detailBoxAuthorPortrait &&
				!$this->detailBoxAuthorSmall &&
				!$this->detailBoxAuthorColumns)
			{
				$this->detailBoxAuthorAll = false;
			}

			if (!$this->detailBoxHitsBig &&
				!$this->detailBoxHitsLscape &&
				!$this->detailBoxHitsPortrait &&
				!$this->detailBoxHitsSmall &&
				!$this->detailBoxHitsColumns)
			{
				$this->detailBoxHitsAll = false;
			}

			if (!$this->detailBoxCountBig &&
				!$this->detailBoxCountLscape &&
				!$this->detailBoxCountPortrait &&
				!$this->detailBoxCountSmall &&
				!$this->detailBoxCountColumns)
			{
				$this->detailBoxCountAll = false;
			}

			if (!$this->detailBoxReadmoreBig &&
				!$this->detailBoxReadmoreLscape &&
				!$this->detailBoxReadmorePortrait &&
				!$this->detailBoxReadmoreSmall &&
				!$this->detailBoxReadmoreColumns)
			{
				$this->detailBoxReadmoreAll = false;
			}
		}
		else
		{
			if (!$this->detailBoxColumns)
			{
				$this->detailBoxAll = false;
			}

			if (!$this->detailBoxTitleColumns)
			{
				$this->detailBoxTitleAll = false;
			}

			if (!$this->detailBoxIntrotextColumns)
			{
				$this->detailBoxIntrotextAll = false;
			}

			if (!$this->detailBoxDateColumns)
			{
				$this->detailBoxDateAll = false;
			}

			if (!$this->detailBoxCategoryColumns)
			{
				$this->detailBoxCategoryAll = false;
			}

			if (!$this->detailBoxTypeColumns)
			{
				$this->detailBoxTypeAll = false;
			}

			if (!$this->detailBoxAuthorColumns)
			{
				$this->detailBoxAuthorAll = false;
			}

			if (!$this->detailBoxHitsColumns)
			{
				$this->detailBoxHitsAll = false;
			}

			if (!$this->detailBoxCountColumns)
			{
				$this->detailBoxCountAll = false;
			}

			if (!$this->detailBoxReadmoreColumns)
			{
				$this->detailBoxReadmoreAll = false;
			}
		}

		// Hover box
		$this->hoverBox = $masonry_params['mas_hb'];
		$this->hoverBoxBg = $masonry_params['mas_hb_bg'];
		$this->hoverBoxBgOpacity = $masonry_params['mas_hb_bg_opacity'];
		$this->hoverBoxTextColor = $masonry_params['mas_hb_text_color'];
		$this->hoverBoxEffect = $masonry_params['mas_hb_effect'];
		$this->hoverBoxEffectSpeed = $masonry_params['mas_hb_effect_speed'];
		$hoverBoxEffectEasing = $masonry_params['mas_hb_effect_easing'];
		$this->hoverBoxTitle = $masonry_params['mas_hb_title'];
		$hoverBoxTitleLimit = $masonry_params['mas_hb_title_limit'];
		$this->hoverBoxIntrotext = $masonry_params['mas_hb_introtext'];
		$hoverBoxIntrotextLimit = $masonry_params['mas_hb_introtext_limit'];
		$hoverBoxStripTags = $masonry_params['mas_hb_strip_tags'];
		$this->hoverBoxDate = $masonry_params['mas_hb_date'];
		$hoverBoxDateFormat = $masonry_params['mas_hb_date_format'];
		$this->hoverBoxCategory = $masonry_params['mas_hb_category'];
		$this->hoverBoxType = $masonry_params['mas_hb_type'];
		$this->hoverBoxAuthor = $masonry_params['mas_hb_author'];
		$this->hoverBoxHits = $masonry_params['mas_hb_hits'];
		$this->hoverBoxLinkButton = $masonry_params['mas_hb_link'];
		$this->hoverBoxZoomButton = false;

		if (isset($masonry_params['mas_hb_zoom']))
		{
			$this->hoverBoxZoomButton = $masonry_params['mas_hb_zoom'];
		}

		// Hover effects
		$this->hoverEffectClass = '';

		if ($this->hoverBoxEffect == '4')
		{
			$this->hoverEffectClass = 'slideInRight';
		}

		if ($this->hoverBoxEffect == '5')
		{
			$this->hoverEffectClass = 'slideInLeft';
		}

		if ($this->hoverBoxEffect == '6')
		{
			$this->hoverEffectClass = 'slideInTop';
		}

		if ($this->hoverBoxEffect == '7')
		{
			$this->hoverEffectClass = 'slideInBottom';
		}

		if ($this->hoverBoxEffect == '8')
		{
			$this->hoverEffectClass = 'mnwzoomIn';
		}

		// Transition styles
		$this->animated = '';

		if ($this->hoverBoxEffect != 'no' && $this->hoverBoxEffect != '2' && $this->hoverBoxEffect != '3')
		{
			$this->animated = '
			transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-webkit-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-o-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-ms-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			';
		}

		$this->animated_flip = '';

		if ($this->hoverBoxEffect == '2' || $this->hoverBoxEffect == '3')
		{
			$this->animated_flip = '
			transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-webkit-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-o-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-ms-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			';
		}

		// Hover box background
		$this->hb_bg_class = $this->utilities->hex2RGB($this->hoverBoxBg, true);
		$this->hb_bg_opacity_class = number_format((float)$this->hoverBoxBgOpacity, 2, '.', '');

		// Hover box text color
		if ($this->hoverBoxTextColor == '1') 
		{
			$this->hoverTextColor = 'dark-text';
		} 
		else 
		{
			$this->hoverTextColor = 'light-text';
		}

		// Get wall
		if ($page === '1')
		{
			$this->items = $this->model->getItems($this->widgetID);
		}
		else
		{
			$this->items = $this->model->getItemsAjax($this->widgetID);
		}

		// Create display params
		$detailBoxParams = array();
		$detailBoxParams['images'] = $this->mas_images;
		$detailBoxParams['crop_images'] = $mas_crop_images;
		$detailBoxParams['image_width'] = $mas_image_width;
		$detailBoxParams['image_height'] = $mas_image_height;
		$detailBoxParams['fallback_image'] = '';

		if (array_key_exists('mas_fallback_image', $masonry_params))
		{
			$detailBoxParams['fallback_image'] = $masonry_params['mas_fallback_image'];
		}

		$detailBoxParams['detailBoxTitleLimit'] = $detailBoxTitleLimit;
		$detailBoxParams['detailBoxIntrotextLimit'] = $detailBoxIntrotextLimit;
		$detailBoxParams['detailBoxStripTags'] = $detailBoxStripTags;
		$detailBoxParams['detailBoxDateFormat'] = $detailBoxDateFormat;

		$hoverBoxParams = array();
		$hoverBoxParams['hoverBox'] = $this->hoverBox;
		$hoverBoxParams['hoverBoxTitle'] = $this->hoverBoxTitle;
		$hoverBoxParams['hoverBoxTitleLimit'] = $hoverBoxTitleLimit;
		$hoverBoxParams['hoverBoxIntrotext'] = $this->hoverBoxIntrotext;
		$hoverBoxParams['hoverBoxIntrotextLimit'] = $hoverBoxIntrotextLimit;
		$hoverBoxParams['hoverBoxStripTags'] = $hoverBoxStripTags;
		$hoverBoxParams['hoverBoxDate'] = $this->hoverBoxDate;
		$hoverBoxParams['hoverBoxDateFormat'] = $hoverBoxDateFormat;

		// Get widget with display options
		$this->wall = $this->model->getDisplayOptions($this->widgetID, $this->items, $detailBoxParams, $hoverBoxParams);

		// Assign a grid item number to each item
		if (isset($this->wall))
		{
			if ($this->gridType === '999c') // custom grid
			{
				$this->custom_grid_id = isset($masonry_params['mas_custom_grid']) ? $masonry_params['mas_custom_grid'] : false;
				$custom_grid = $this->utilities->getCustomGrid($this->custom_grid_id);
				$grid_elements = json_decode($custom_grid->elements, false);

				// Init custom grid widths
				if ($page === '1' && !empty($grid_elements))
				{
					$grid_columns = $custom_grid->columns;
					$responsive_masonry->initCustomGridWidths($masonry_params, $grid_elements, $grid_columns, $this->widgetID);
				}

				// Get number of items in custom grid
				$grid = isset($grid_elements) ? count($grid_elements) : false;

				if (!$grid)
				{
					throw new GenericDataException(\JText::_('COM_MINITEKWALL_GRID_NOT_FOUND'), 500);

					return false;
				}
			}
			else
			{
				$this->custom_grid_id = false;
				$grid = (int) $this->gridType;
			}

			foreach ($this->wall as $key => $item)
			{
				// Item sizes
				if ($page === '1')
				{
					$index = $key + 1;
				}
				else
				{
					$index = $startLimit + (($page - 2) * $pageLimit) + ($key + 1);
				}

				$item->rawIndex = $index;

				if ($index > $grid)
				{
					$item->itemIndex = $this->utilities->recurseMasItemIndex($index, $grid);
				}
				else
				{
					$item->itemIndex = $index;
				}
			}
		}

		if ((!$this->wall || $this->wall == '' || $this->wall == 0))
		{
			if ($page === '1')
			{
				if (!array_key_exists('mas_empty_message', $masonry_params))
				{
					$masonry_params['mas_empty_message'] = true;
				}

				if ($masonry_params['mas_empty_message'])
				{
					$output = '<div class="mnw-results-empty-results">';
					$output .= '<span>'.Text::_('COM_MINITEKWALL_NO_ITEMS').'</span>';
					$output .= '</div>';

					echo $output;
				}
			}
		}
		else
		{
			// Check for errors.
			if (count($errors = $this->get('Errors')))
			{
				throw new GenericDataException(implode("\n", $errors), 500);

				return false;
			}

			if ($page === '1')
			{
				// Get source params
				$source_params = $this->utilities->getSourceParams($this->widgetID);
				$this->source_params = $source_params;

				// Get items ordering
				$this->active_ordering = $this->model->getItemsOrdering($source_params);
				$this->active_direction = $this->model->getItemsDirection($source_params);

				// Get Filters
				if ($masonry_params['mas_category_filters'] ||
					$masonry_params['mas_tag_filters'] ||
					$masonry_params['mas_date_filters'])
				{
					$this->filters = true;
				}
				else
				{
					$this->filters = NULL;
				}

				// Get Sortings
				if ($masonry_params['mas_title_sorting'] ||
					$masonry_params['mas_category_sorting'] ||
					$masonry_params['mas_author_sorting'] ||
					$masonry_params['mas_date_sorting'] ||
					$masonry_params['mas_hits_sorting'])
				{
					$this->sortings = true;
				}
				else
				{
					$this->sortings = NULL;
				}

				if (isset($this->filters) || isset($this->sortings))
				{
					$masonry_filters = $this->model->masonry_filters;
					$masonry_filters->getFiltersCss($masonry_params, $this->widgetID);
				}

				// Reset button
				$this->resetButton = $masonry_params['mas_reset_filters'];

				// Set page meta data
				$this->setPageMeta($masonry_params, $this->params);

				// Set layout
				$layout = $masonry_params['mas_layout'];

				if ($layout)
				{
					$this->setLayout($layout);
					$viewName = $jinput->get('view', 'masonry', 'WORD');
					$layoutTemplate = $this->getLayoutTemplate(); // This is empty if using a module and the override has the name 'default'. Use another name.
					$this->addTemplatePath(JPATH_SITE.'/templates/'.$layoutTemplate.'/html/com_minitekwall/'.$viewName);
				}
			}

			parent::display($tpl);
		}
 	}

 	public function setPageMeta($masonry_params, $params)
 	{
		$document = \JFactory::getDocument();
		$app = \JFactory::getApplication();
		$menus = $app->getMenu();
		$menu = $menus->getActive();

		$this->mas_page_title = false;

		if (array_key_exists('mas_page_title', $masonry_params) && $masonry_params['mas_page_title'])
		{
			$this->mas_page_title = true;

			if ($menu)
			{
				$params->def('page_heading', $params->get('page_title', $menu->title));
			}

			$title = $params->get('page_title', '');

			// Check for empty title and add site name if param is set
			if (empty($title))
			{
				$title = $app->get('sitename');
			}
			else if ($app->get('sitename_pagetitles', 0) == 1)
			{
				$title = Text::sprintf('JPAGETITLE', $app->get('sitename'), $title);
			}
			else if ($app->get('sitename_pagetitles', 0) == 2)
			{
				$title = Text::sprintf('JPAGETITLE', $title, $app->get('sitename'));
			}

			$document->setTitle($title);

			if ($params->get('menu-meta_description'))
			{
				$document->setDescription($params->get('menu-meta_description'));
			}

			if ($params->get('menu-meta_keywords'))
			{
				$document->setMetadata('keywords', $params->get('menu-meta_keywords'));
			}

			if ($params->get('robots'))
			{
				$document->setMetadata('robots', $params->get('robots'));
			}
		}

		if (isset($menu->query['option']) && $menu->query['option'] == 'com_minitekwall')
		{
			$title = $params->get('page_title', '');

			// Check for empty title and add site name if param is set
			if (empty($title))
			{
				$title = $app->get('sitename');
			}
			else if ($app->get('sitename_pagetitles', 0) == 1)
			{
				$title = Text::sprintf('JPAGETITLE', $app->get('sitename'), $title);
			}
			else if ($app->get('sitename_pagetitles', 0) == 2)
			{
				$title = Text::sprintf('JPAGETITLE', $title, $app->get('sitename'));
			}

			$document->setTitle($title);
		}
 	}

 	public function getColumnsItemOptions()
 	{
		$options = array(
			"db_class" => "",
			"title_class" => "",
			"introtext_class" => "",
			"date_class" => "",
			"category_class" => "",
			"type_class" => "",
			"author_class" => "",
			"hits_class" => "",
			"count_class" => "",
			"readmore_class" => "",
			"db_bg_class" => "",
			"db_bg_opacity_class" => "",
			"db_color_class" => "",
			"position_class" => ""
		);

		$options['db_bg_class'] = $this->utilities->hex2RGB($this->detailBoxBackgroundColumns, true);
		$options['db_bg_opacity_class'] = number_format((float)$this->detailBoxBackgroundOpacityColumns, 2, '.', '');
		$options['db_color_class'] = $this->detailBoxTextColorColumns;
		$options['position_class'] = 'content-'.$this->detailBoxPositionColumns;

		if (!$this->detailBoxColumns)
		{
			$options['db_class'] = 'db-hidden';
		}

		if (!$this->detailBoxTitleColumns)
		{
			$options['title_class'] = 'title-hidden';
		}

		if (!$this->detailBoxIntrotextColumns)
		{
			$options['introtext_class'] = 'introtext-hidden';
		}

		if (!$this->detailBoxDateColumns)
		{
			$options['date_class'] = 'date-hidden';
		}

		if (!$this->detailBoxCategoryColumns)
		{
			$options['category_class'] = 'category-hidden';
		}

		if (!$this->detailBoxTypeColumns)
		{
			$options['type_class'] = 'type-hidden';
		}

		if (!$this->detailBoxAuthorColumns)
		{
			$options['author_class'] = 'author-hidden';
		}

		if (!$this->detailBoxHitsColumns)
		{
			$options['hits_class'] = 'hits-hidden';
		}

		if (!$this->detailBoxCountColumns)
		{
			$options['count_class'] = 'count-hidden';
		}

		if (!$this->detailBoxReadmoreColumns)
		{
			$options['readmore_class'] = 'readmore-hidden';
		}

		return $options;
 	}

 	public function getMasonryItemOptions($item_size)
 	{
		$options = array(
			"detail_box" => "",
			"db_class" => "",
			"title_class" => "",
			"introtext_class" => "",
			"date_class" => "",
			"category_class" => "",
			"type_class" => "",
			"author_class" => "",
			"hits_class" => "",
			"count_class" => "",
			"readmore_class" => "",
			"db_bg_class" => "",
			"db_bg_opacity_class" => "",
			"db_color_class" => "",
			"position_class" => ""
		);

		switch ($item_size)
		{
			case 'mnwall-big':
				$options['detail_box'] = $this->detailBoxBig;
				$options['db_bg_class'] = $this->utilities->hex2RGB($this->detailBoxBackgroundBig, true);
				$options['db_bg_opacity_class'] = number_format((float)$this->detailBoxBackgroundOpacityBig, 2, '.', '');
				$options['db_color_class'] = $this->detailBoxTextColorBig;
				$options['position_class'] = 'content-'.$this->detailBoxPositionBig;

				if (!$this->detailBoxBig)
				{
					$options['db_class'] = 'db-hidden';
				}

				if (!$this->detailBoxTitleBig)
				{
					$options['title_class'] = 'title-hidden';
				}

				if (!$this->detailBoxIntrotextBig)
				{
					$options['introtext_class'] = 'introtext-hidden';
				}

				if (!$this->detailBoxDateBig)
				{
					$options['date_class'] = 'date-hidden';
				}

				if (!$this->detailBoxCategoryBig)
				{
					$options['category_class'] = 'category-hidden';
				}

				if (!$this->detailBoxTypeBig)
				{
					$options['type_class'] = 'type-hidden';
				}

				if (!$this->detailBoxAuthorBig)
				{
					$options['author_class'] = 'author-hidden';
				}

				if (!$this->detailBoxHitsBig)
				{
					$options['hits_class'] = 'hits-hidden';
				}

				if (!$this->detailBoxCountBig)
				{
					$options['count_class'] = 'count-hidden';
				}

				if (!$this->detailBoxReadmoreBig)
				{
					$options['readmore_class'] = 'readmore-hidden';
				}

				break;

			case 'mnwall-horizontal':
				$options['detail_box'] = $this->detailBoxLscape;
				$options['db_bg_class'] = $this->utilities->hex2RGB($this->detailBoxBackgroundLscape, true);
				$options['db_bg_opacity_class'] = number_format((float)$this->detailBoxBackgroundOpacityLscape, 2, '.', '');
				$options['db_color_class'] = $this->detailBoxTextColorLscape;
				$options['position_class'] = 'content-'.$this->detailBoxPositionLscape;

				if (!$this->detailBoxLscape)
				{
					$options['db_class'] = 'db-hidden';
				}

				if (!$this->detailBoxTitleLscape)
				{
					$options['title_class'] = 'title-hidden';
				}

				if (!$this->detailBoxIntrotextLscape)
				{
					$options['introtext_class'] = 'introtext-hidden';
				}

				if (!$this->detailBoxDateLscape)
				{
					$options['date_class'] = 'date-hidden';
				}

				if (!$this->detailBoxCategoryLscape)
				{
					$options['category_class'] = 'category-hidden';
				}

				if (!$this->detailBoxTypeLscape)
				{
					$options['type_class'] = 'type-hidden';
				}

				if (!$this->detailBoxAuthorLscape)
				{
					$options['author_class'] = 'author-hidden';
				}

				if (!$this->detailBoxHitsLscape)
				{
					$options['hits_class'] = 'hits-hidden';
				}

				if (!$this->detailBoxCountLscape)
				{
					$options['count_class'] = 'count-hidden';
				}

				if (!$this->detailBoxReadmoreLscape)
				{
					$options['readmore_class'] = 'readmore-hidden';
				}

				break;

			case 'mnwall-vertical':
				$options['detail_box'] = $this->detailBoxPortrait;
				$options['db_bg_class'] = $this->utilities->hex2RGB($this->detailBoxBackgroundPortrait, true);
				$options['db_bg_opacity_class'] = number_format((float)$this->detailBoxBackgroundOpacityPortrait, 2, '.', '');
				$options['db_color_class'] = $this->detailBoxTextColorPortrait;
				$options['position_class'] = 'content-'.$this->detailBoxPositionPortrait;

				if (!$this->detailBoxPortrait)
				{
					$options['db_class'] = 'db-hidden';
				}

				if (!$this->detailBoxTitlePortrait)
				{
					$options['title_class'] = 'title-hidden';
				}

				if (!$this->detailBoxIntrotextPortrait)
				{
					$options['introtext_class'] = 'introtext-hidden';
				}

				if (!$this->detailBoxDatePortrait)
				{
					$options['date_class'] = 'date-hidden';
				}

				if (!$this->detailBoxCategoryPortrait)
				{
					$options['category_class'] = 'category-hidden';
				}

				if (!$this->detailBoxTypePortrait)
				{
					$options['type_class'] = 'type-hidden';
				}

				if (!$this->detailBoxAuthorPortrait)
				{
					$options['author_class'] = 'author-hidden';
				}

				if (!$this->detailBoxHitsPortrait)
				{
					$options['hits_class'] = 'hits-hidden';
				}

				if (!$this->detailBoxCountPortrait)
				{
					$options['count_class'] = 'count-hidden';
				}

				if (!$this->detailBoxReadmorePortrait)
				{
					$options['readmore_class'] = 'readmore-hidden';
				}

				break;

			case 'mnwall-small':
				$options['detail_box'] = $this->detailBoxSmall;
				$options['db_bg_class'] = $this->utilities->hex2RGB($this->detailBoxBackgroundSmall, true);
				$options['db_bg_opacity_class'] = number_format((float)$this->detailBoxBackgroundOpacitySmall, 2, '.', '');
				$options['db_color_class'] = $this->detailBoxTextColorSmall;
				$options['position_class'] = 'content-'.$this->detailBoxPositionSmall;

				if (!$this->detailBoxSmall)
				{
					$options['db_class'] = 'db-hidden';
				}

				if (!$this->detailBoxTitleSmall)
				{
					$options['title_class'] = 'title-hidden';
				}

				if (!$this->detailBoxIntrotextSmall)
				{
					$options['introtext_class'] = 'introtext-hidden';
				}

				if (!$this->detailBoxDateSmall)
				{
					$options['date_class'] = 'date-hidden';
				}

				if (!$this->detailBoxCategorySmall)
				{
					$options['category_class'] = 'category-hidden';
				}

				if (!$this->detailBoxTypeSmall)
				{
					$options['type_class'] = 'type-hidden';
				}

				if (!$this->detailBoxAuthorSmall)
				{
					$options['author_class'] = 'author-hidden';
				}

				if (!$this->detailBoxHitsSmall)
				{
					$options['hits_class'] = 'hits-hidden';
				}

				if (!$this->detailBoxCountSmall)
				{
					$options['count_class'] = 'count-hidden';
				}

				if (!$this->detailBoxReadmoreSmall)
				{
					$options['readmore_class'] = 'readmore-hidden';
				}

				break;
		}

		return $options;
 	}
}
