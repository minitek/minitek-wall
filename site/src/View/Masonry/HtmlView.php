<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Site\View\Masonry;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\URI\URI;
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
		$document = Factory::getDocument();
		$site_path = URI::root();
		$this->model = $this->getModel();
		$this->masonry_options = $this->model->masonry_options;
		$this->utilities = $this->model->utilities;
		$this->params = $this->utilities->getParams('com_minitekwall');
		$input = Factory::getApplication()->input;
		$this->widgetID = $input->get('widget_id', '', 'INT');
		$this->item  = $this->model->getItem($this->widgetID);
		$source_id = $this->item->source_id;
		$page = $input->get('page', 1, 'INT');

		// Get filter data
		$category = $input->json->get('category', [], 'ARRAY');
		$tag = $input->json->get('tag', [], 'ARRAY');
		$date = $input->json->get('date', '', 'CMD');
		$ordering = $input->json->get('ordering', '', 'CMD');
		$direction = $input->json->get('direction', '', 'CMD');

		$filters = [
			'category' => $category,
			'tag' => $tag,
			'date' => $date,
			'ordering' => $ordering,
			'direction' => $direction
		];

		// Get masonry parameters
		$masonry_params = json_decode($this->item->masonry_params, true);
		$this->masonry_params = $masonry_params;

		// Pagination
		$startLimit = $masonry_params['mas_starting_limit'];

		// Get Grid
		$this->gridType = $masonry_params['mas_grid'];
		$this->suffix = '';

		if (array_key_exists('mas_suffix', $masonry_params))
			$this->suffix = $masonry_params['mas_suffix'];

		$masCols = $masonry_params['mas_cols'];
		$masColsper = 100 / $masCols;
		$this->gutter = $masonry_params['mas_gutter'];
		$this->mas_border_radius = (int)$masonry_params['mas_border_radius'];
		$this->mas_border = (int)$masonry_params['mas_border'];
		$this->mas_border_color = $masonry_params['mas_border_color'];

		// Layout/Grid class
		if ($this->gridType == '99v')
		{
			$this->mwall_layout = 'list';
			$this->mwall_grid = '';
		}
		else if ($this->gridType == '98o')
		{
			$this->mwall_layout = 'columns';
			$this->mwall_grid = '';
		}
		else
		{
			$this->mwall_layout = 'masonry';
			$this->mwall_grid = 'mwall-grid'.$this->gridType;
		}

		// Columns
		$this->cols = '';
		$masColsper = number_format((float)$masColsper, 4, '.', '');
		$this->cols = 'width: '.$masColsper.'%;';

		// Images
		$this->mas_images = $masonry_params['mas_images'];
		$this->mas_image_link = true;

		if (array_key_exists('mas_image_link', $masonry_params))
			$this->mas_image_link = $masonry_params['mas_image_link'];

		$mas_crop_images = $masonry_params['mas_crop_images'];
		$mas_image_width = $masonry_params['mas_image_width'];
		$mas_image_height = $masonry_params['mas_image_height'];

		// Detail box
		$detailBoxTitleLimit = $masonry_params['mas_db_title_limit'];
		$this->detailBoxTitleLink = isset($masonry_params['mas_db_title_link']) ? $masonry_params['mas_db_title_link'] : true;
		$detailBoxIntrotextLimit = $masonry_params['mas_db_introtext_limit'];
		$detailBoxStripTags = $masonry_params['mas_db_strip_tags'];
		$detailBoxDateFormat = $masonry_params['mas_db_date_format'];

		// Big
		$this->detailBoxBig = $masonry_params['mas_db_big'];
		$this->detailBoxTitleBig = $masonry_params['mas_db_title_big'];
		$this->detailBoxIntrotextBig = $masonry_params['mas_db_introtext_big'];
		$this->detailBoxDateBig = $masonry_params['mas_db_date_big'];
		$this->detailBoxCategoryBig = $masonry_params['mas_db_category_big'];
		$this->detailBoxAuthorBig = $masonry_params['mas_db_author_big'];
		$this->detailBoxTagsBig = isset($masonry_params['mas_db_tags_big']) ? $masonry_params['mas_db_tags_big'] : false;
		$this->detailBoxHitsBig = $masonry_params['mas_db_hits_big'];
		$this->detailBoxCountBig = $masonry_params['mas_db_count_big'];
		$this->detailBoxReadmoreBig = $masonry_params['mas_db_readmore_big'];

		// Landscape
		$this->detailBoxLscape = $masonry_params['mas_db_lscape'];
		$this->detailBoxTitleLscape = $masonry_params['mas_db_title_lscape'];
		$this->detailBoxIntrotextLscape = $masonry_params['mas_db_introtext_lscape'];
		$this->detailBoxDateLscape = $masonry_params['mas_db_date_lscape'];
		$this->detailBoxCategoryLscape = $masonry_params['mas_db_category_lscape'];
		$this->detailBoxAuthorLscape = $masonry_params['mas_db_author_lscape'];
		$this->detailBoxTagsLscape = isset($masonry_params['mas_db_tags_lscape']) ? $masonry_params['mas_db_tags_lscape'] : false;
		$this->detailBoxHitsLscape = $masonry_params['mas_db_hits_lscape'];
		$this->detailBoxCountLscape = $masonry_params['mas_db_count_lscape'];
		$this->detailBoxReadmoreLscape = $masonry_params['mas_db_readmore_lscape'];

		// Portrait
		$this->detailBoxPortrait = $masonry_params['mas_db_portrait'];
		$this->detailBoxTitlePortrait = $masonry_params['mas_db_title_portrait'];
		$this->detailBoxIntrotextPortrait = $masonry_params['mas_db_introtext_portrait'];
		$this->detailBoxDatePortrait = $masonry_params['mas_db_date_portrait'];
		$this->detailBoxCategoryPortrait = $masonry_params['mas_db_category_portrait'];
		$this->detailBoxAuthorPortrait = $masonry_params['mas_db_author_portrait'];
		$this->detailBoxTagsPortrait = isset($masonry_params['mas_db_tags_portrait']) ? $masonry_params['mas_db_tags_portrait'] : false;
		$this->detailBoxHitsPortrait = $masonry_params['mas_db_hits_portrait'];
		$this->detailBoxCountPortrait = $masonry_params['mas_db_count_portrait'];
		$this->detailBoxReadmorePortrait = $masonry_params['mas_db_readmore_portrait'];

		// Small
		$this->detailBoxSmall = $masonry_params['mas_db_small'];
		$this->detailBoxTitleSmall = $masonry_params['mas_db_title_small'];
		$this->detailBoxIntrotextSmall = $masonry_params['mas_db_introtext_small'];
		$this->detailBoxDateSmall = $masonry_params['mas_db_date_small'];
		$this->detailBoxCategorySmall = $masonry_params['mas_db_category_small'];
		$this->detailBoxAuthorSmall = $masonry_params['mas_db_author_small'];
		$this->detailBoxTagsSmall = isset($masonry_params['mas_db_tags_small']) ? $masonry_params['mas_db_tags_small'] : false;
		$this->detailBoxHitsSmall = $masonry_params['mas_db_hits_small'];
		$this->detailBoxCountSmall = $masonry_params['mas_db_count_small'];
		$this->detailBoxReadmoreSmall = $masonry_params['mas_db_readmore_small'];

		// Columns
		$this->detailBoxColumns = $masonry_params['mas_db_columns'];
		$this->detailBoxPositionColumns = $masonry_params['mas_db_position_columns'];
		$this->detailBoxBackgroundColumns = $masonry_params['mas_db_bg_columns'];
		$this->detailBoxBackgroundOpacityColumns = $masonry_params['mas_db_bg_opacity_columns'];
		$this->detailBoxTitleColumns = $masonry_params['mas_db_title_columns'];
		$this->detailBoxIntrotextColumns = $masonry_params['mas_db_introtext_columns'];
		$this->detailBoxDateColumns = $masonry_params['mas_db_date_columns'];
		$this->detailBoxCategoryColumns = $masonry_params['mas_db_category_columns'];
		$this->detailBoxAuthorColumns = $masonry_params['mas_db_author_columns'];
		$this->detailBoxTagsColumns = isset($masonry_params['mas_db_tags_columns']) ? $masonry_params['mas_db_tags_columns'] : false;
		$this->detailBoxHitsColumns = $masonry_params['mas_db_hits_columns'];
		$this->detailBoxCountColumns = $masonry_params['mas_db_count_columns'];
		$this->detailBoxReadmoreColumns = $masonry_params['mas_db_readmore_columns'];

		// Detail box overall vars
		$this->detailBoxAll = true;
		$this->detailBoxTitleAll = true;
		$this->detailBoxIntrotextAll = true;
		$this->detailBoxDateAll = true;
		$this->detailBoxCategoryAll = true;
		$this->detailBoxAuthorAll = true;
		$this->detailBoxTagsAll = true;
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

			if (!$this->detailBoxAuthorBig &&
				!$this->detailBoxAuthorLscape &&
				!$this->detailBoxAuthorPortrait &&
				!$this->detailBoxAuthorSmall &&
				!$this->detailBoxAuthorColumns)
			{
				$this->detailBoxAuthorAll = false;
			}

			if (!$this->detailBoxTagsBig &&
				!$this->detailBoxTagsLscape &&
				!$this->detailBoxTagsPortrait &&
				!$this->detailBoxTagsSmall &&
				!$this->detailBoxTagsColumns)
			{
				$this->detailBoxTagsAll = false;
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
				$this->detailBoxAll = false;

			if (!$this->detailBoxTitleColumns)
				$this->detailBoxTitleAll = false;

			if (!$this->detailBoxIntrotextColumns)
				$this->detailBoxIntrotextAll = false;

			if (!$this->detailBoxDateColumns)
				$this->detailBoxDateAll = false;

			if (!$this->detailBoxCategoryColumns)
				$this->detailBoxCategoryAll = false;

			if (!$this->detailBoxAuthorColumns)
				$this->detailBoxAuthorAll = false;

			if (!$this->detailBoxTagsColumns)
				$this->detailBoxTagsAll = false;

			if (!$this->detailBoxHitsColumns)
				$this->detailBoxHitsAll = false;

			if (!$this->detailBoxCountColumns)
				$this->detailBoxCountAll = false;
			
			if (!$this->detailBoxReadmoreColumns)
				$this->detailBoxReadmoreAll = false;
		}

		// Hover box
		$this->hoverBox = $masonry_params['mas_hb'];
		$this->hoverBoxBg = $masonry_params['mas_hb_bg'];
		$this->hoverBoxBgOpacity = $masonry_params['mas_hb_bg_opacity'];
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
		$this->hoverBoxAuthor = $masonry_params['mas_hb_author'];
		$this->hoverBoxHits = $masonry_params['mas_hb_hits'];
		$this->hoverBoxLinkButton = $masonry_params['mas_hb_link'];
		$this->hoverBoxZoomButton = false;
		$this->modalTitle = isset($masonry_params['mas_modal_title']) ? $masonry_params['mas_modal_title'] : true;

		if (isset($masonry_params['mas_hb_zoom']))
		{
			$this->hoverBoxZoomButton = $masonry_params['mas_hb_zoom'];
		}

		// Hover effects
		$this->hoverOffset = '';
		$this->hoverClass = '';
		$this->flipBase = '';
		$this->perspective = '';
		$this->flipClass = '';

		if ($this->hoverBox)
		{
			if ($this->hoverBoxEffect == 'no')
				$this->hoverClass = 'hoverShow';
			else if ($this->hoverBoxEffect == '1')
				$this->hoverClass = 'hoverFadeIn';
			else if ($this->hoverBoxEffect == '2')
			{
				$this->flipBase = 'flipBase';
				$this->perspective = 'perspective';
				$this->flipClass = 'flipY';
			}
			else if ($this->hoverBoxEffect == '3')
			{
				$this->flipBase = 'flipBase';
				$this->perspective = 'perspective';
				$this->flipClass = 'flipX';
			}
			else if ($this->hoverBoxEffect == '4') {
				$this->hoverOffset = 'rightOffset';
				$this->hoverClass = 'slideInRight';
			}
			else if ($this->hoverBoxEffect == '5')
			{
				$this->hoverOffset = 'leftOffset';
				$this->hoverClass = 'slideInLeft';
			}
			else if ($this->hoverBoxEffect == '6') 
			{
				$this->hoverOffset = 'topOffset';
				$this->hoverClass = 'slideInTop';
			}
			else if ($this->hoverBoxEffect == '7')
			{
				$this->hoverOffset = 'bottomOffset';
				$this->hoverClass = 'slideInBottom';
			}
			else if ($this->hoverBoxEffect == '8')
			{
				$this->hoverOffset = 'zoomOffset';
				$this->hoverClass = 'zoomIn';
			}
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

		// Get wall
		if ($page === 1 && $input->get('task') != 'getFilters')
			$this->items = $this->model->getItems($this->widgetID, $filters);
		else
			$this->items = $this->model->getItemsAjax($this->widgetID, $filters);

		// Create display params
		$detailBoxParams = array();
		$detailBoxParams['images'] = $this->mas_images;
		$detailBoxParams['crop_images'] = $mas_crop_images;
		$detailBoxParams['image_width'] = $mas_image_width;
		$detailBoxParams['image_height'] = $mas_image_height;
		$detailBoxParams['fallback_image'] = '';

		if (array_key_exists('mas_fallback_image', $masonry_params))
			$detailBoxParams['fallback_image'] = $masonry_params['mas_fallback_image'];

		$detailBoxParams['detailBoxTitleLimit'] = $detailBoxTitleLimit;
		$detailBoxParams['detailBoxIntrotextLimit'] = $detailBoxIntrotextLimit;
		$detailBoxParams['detailBoxStripTags'] = $detailBoxStripTags;
		$detailBoxParams['detailBoxDateFormat'] = $detailBoxDateFormat;
		$detailBoxParams['detailBoxCategoryLink'] = isset($masonry_params['mas_db_category_link']) ? $masonry_params['mas_db_category_link'] : true;
		$detailBoxParams['detailBoxAuthorLink'] = isset($masonry_params['mas_db_author_link']) ? $masonry_params['mas_db_author_link'] : true;

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
			$this->custom_grid_id = false;
			$grid = (int) $this->gridType;

			if ($this->wall)
			{
				foreach ($this->wall as $key => $item)
				{
					// Item sizes
					if ($page === 1)
						$index = $key + 1;
					else
						$index = $startLimit + (($page - 2) * $pageLimit) + ($key + 1);

					$item->rawIndex = $index;

					if ($index > $grid)
						$item->itemIndex = $this->utilities->getItemIndex($index, $grid);
					else
						$item->itemIndex = $index;
				}
			}
		}

		if ($page === 1 && $input->get('task') != 'getFilters')
		{
			// Add assets
			$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
			$wa->useStyle('com_minitekwall.minitekwall')
				->useScript('com_minitekwall.imagesloaded')
				->useScript('com_minitekwall.isotope')
				->useScript('com_minitekwall.packery-mode');
						
			$wa->useScript('com_minitekwall.spin')
				->useScript('com_minitekwall.minitekwall');

			// Initialize wall
			$document->addScriptDeclaration("
			document.addEventListener('DOMContentLoaded', function() 
			{
				Mwall.initialise(
					".json_encode($masonry_params).", 
					".$this->widgetID.", 
					'".$source_id."',
					'".$site_path."',
				);
			});
			");

			if (array_key_exists('mas_enable_responsive', $masonry_params))
			{
				if ($masonry_params['mas_enable_responsive'])
					$this->model->responsive_masonry->loadResponsiveMasonry($masonry_params, $this->widgetID);
			}
			else
				$this->model->responsive_masonry->loadResponsiveMasonry($masonry_params, $this->widgetID);
		}

		if ((!$this->wall || $this->wall == '' || $this->wall == 0))
		{
			if ($page === 1)
			{
				$output = '<div class="mwall-results-empty-results">';
				$output .= '<span>'.Text::_('COM_MINITEKWALL_NO_ITEMS').'</span>';
				$output .= '</div>';

				echo $output;
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

			if ($page === 1 && $input->get('task') != 'getFilters')
			{
				// Get source params
				$this->source_params = json_decode($this->item->source_params, true);

				// Get items ordering
				$this->active_ordering = $this->model->getItemsOrdering($this->source_params);
				$this->active_direction = $this->model->getItemsDirection($this->source_params);

				// Get Filters
				if ($masonry_params['mas_category_filters'] ||
					$masonry_params['mas_tag_filters'] ||
					$masonry_params['mas_date_filters'])
				{
					$this->filters = true;
				}
				else
					$this->filters = NULL;

				// Get Sortings
				if ($masonry_params['mas_title_sorting'] ||
					$masonry_params['mas_date_sorting'] ||
					$masonry_params['mas_hits_sorting'])
				{
					$this->sortings = true;
				}
				else
					$this->sortings = NULL;

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
					$viewName = $input->get('view', 'masonry', 'WORD');
					$layoutTemplate = $this->getLayoutTemplate(); // This is empty if using a module and the override has the name 'default'. Use another name.
					$this->addTemplatePath(JPATH_SITE.'/templates/'.$layoutTemplate.'/html/com_minitekwall/'.$viewName);
				}
			}

			parent::display($tpl);
		}
 	}

 	public function setPageMeta($masonry_params, $params)
 	{
		$document = Factory::getDocument();
		$app = Factory::getApplication();
		$menus = $app->getMenu();
		$menu = $menus->getActive();

		$this->mas_page_title = false;

		if (array_key_exists('mas_page_title', $masonry_params) && $masonry_params['mas_page_title'])
		{
			$this->mas_page_title = true;

			if ($menu)
				$params->def('page_heading', $params->get('page_title', $menu->title));

			$title = $params->get('page_title', '');

			// Check for empty title and add site name if param is set
			if (empty($title))
				$title = $app->get('sitename');
			else if ($app->get('sitename_pagetitles', 0) == 1)
				$title = Text::sprintf('JPAGETITLE', $app->get('sitename'), $title);
			else if ($app->get('sitename_pagetitles', 0) == 2)
				$title = Text::sprintf('JPAGETITLE', $title, $app->get('sitename'));

			$document->setTitle($title);

			if ($params->get('menu-meta_description'))
				$document->setDescription($params->get('menu-meta_description'));

			if ($params->get('menu-meta_keywords'))
				$document->setMetadata('keywords', $params->get('menu-meta_keywords'));

			if ($params->get('robots'))
				$document->setMetadata('robots', $params->get('robots'));
		}

		if (isset($menu->query['option']) && $menu->query['option'] == 'com_minitekwall')
		{
			$title = $params->get('page_title', '');

			// Check for empty title and add site name if param is set
			if (empty($title))
				$title = $app->get('sitename');
			else if ($app->get('sitename_pagetitles', 0) == 1)
				$title = Text::sprintf('JPAGETITLE', $app->get('sitename'), $title);
			else if ($app->get('sitename_pagetitles', 0) == 2)
				$title = Text::sprintf('JPAGETITLE', $title, $app->get('sitename'));

			$document->setTitle($title);
		}
 	}

 	public function getColumnsItemOptions()
 	{
		$options = array(
		"title_class" => "",
		"introtext_class" => "",
		"date_class" => "",
		"category_class" => "",
		"author_class" => "",
		"tags_class" => "",
		"hits_class" => "",
		"count_class" => "",
		"readmore_class" => "",
		"db_bg_class" => "",
		"db_bg_opacity_class" => "",
		"position_class" => ""
		);

		$options['db_bg_class'] = $this->utilities->hex2RGB($this->detailBoxBackgroundColumns, true);
		$options['db_bg_opacity_class'] = number_format((float)$this->detailBoxBackgroundOpacityColumns, 2, '.', '');
		$options['position_class'] = 'content-'.$this->detailBoxPositionColumns;

		if (!$this->detailBoxTitleColumns)
			$options['title_class'] = 'title-hidden';

		if (!$this->detailBoxIntrotextColumns)
			$options['introtext_class'] = 'introtext-hidden';

		if (!$this->detailBoxDateColumns)
			$options['date_class'] = 'date-hidden';

		if (!$this->detailBoxCategoryColumns)
			$options['category_class'] = 'category-hidden';

		if (!$this->detailBoxAuthorColumns)
			$options['author_class'] = 'author-hidden';

		if (!$this->detailBoxTagsColumns)
			$options['tags_class'] = 'tags-hidden';

		if (!$this->detailBoxHitsColumns)
			$options['hits_class'] = 'hits-hidden';

		if (!$this->detailBoxCountColumns)
			$options['count_class'] = 'count-hidden';

		if (!$this->detailBoxReadmoreColumns)
			$options['readmore_class'] = 'readmore-hidden';

		return $options;
 	}
}