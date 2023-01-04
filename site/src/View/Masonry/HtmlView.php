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
use Joomla\Registry\Registry;

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
		$this->optionsLib = $this->model->optionsLib;
		$this->utilitiesLib = $this->model->utilitiesLib;
		$this->componentParams = $this->utilitiesLib->getParams('com_minitekwall');
		$input = Factory::getApplication()->input;
		$id = $input->get('widget_id', '', 'INT');
		$this->item = $this->model->getItem($id);
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

		// Merge masonry_params with source_params
		$_params = array_merge(
			json_decode($this->item->masonry_params, true), 
			json_decode($this->item->source_params, true)
		);
		$params = new Registry(json_encode($_params));
		$this->params = $params;

		// Pagination
		$startLimit = $params->get('mas_starting_limit', 7);

		// Get Grid
		$this->gridType = $params->get('mas_grid', 7);
		$this->suffix = $params->get('mas_suffix', '');
		$column_percentage = 100 / $params->get('mas_cols', 4);
		$this->gutter = $params->get('mas_gutter', 5);
		$this->mas_border_radius = (int)$params->get('mas_border_radius', 0);
		$this->mas_border = (int)$params->get('mas_border', 0);
		$this->mas_border_color = $params->get('mas_border_color', '#eeeeee');

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
		$column_percentage = number_format((float)$column_percentage, 4, '.', '');
		$this->cols = 'width: '.$column_percentage.'%;';

		// Images
		$this->mas_image_link = $params->get('mas_image_link', 1);

		// Detail box
		$this->detailBoxTitleLink = $params->get('mas_db_title_link', 1);

		// Columns
		$this->detailBoxColumns = $params->get('mas_db_columns', 1);
		$this->detailBoxPositionColumns = $params->get('mas_db_position_columns', 'below');
		$this->detailBoxBackgroundColumns = $params->get('mas_db_bg_columns', '#1b98e0');
		$this->detailBoxBackgroundOpacityColumns = $params->get('mas_db_bg_opacity_columns', 0.75);
		$this->detailBoxTitleColumns = $params->get('mas_db_title_columns', 1);
		$this->detailBoxIntrotextColumns = $params->get('mas_db_introtext_columns', 1);
		$this->detailBoxDateColumns = $params->get('mas_db_date_columns', 1);
		$this->detailBoxCategoryColumns = $params->get('mas_db_category_columns', 1);
		$this->detailBoxAuthorColumns = $params->get('mas_db_author_columns', 1);
		$this->detailBoxTagsColumns = $params->get('mas_db_tags_columns', 0);
		$this->detailBoxHitsColumns = $params->get('mas_db_hits_columns', 0);
		$this->detailBoxReadmoreColumns = $params->get('mas_db_readmore_columns', 0);

		// Detail box overall vars
		$this->detailBoxAll = true;
		$this->detailBoxTitleAll = true;
		$this->detailBoxIntrotextAll = true;
		$this->detailBoxDateAll = true;
		$this->detailBoxCategoryAll = true;
		$this->detailBoxAuthorAll = true;
		$this->detailBoxTagsAll = true;
		$this->detailBoxHitsAll = true;
		$this->detailBoxReadmoreAll = true;
		
		if ((int)$this->gridType != '98' && (int)$this->gridType != '99')
		{
			if (!$params->get('mas_db_big', 1) &&
				!$params->get('mas_db_lscape', 1) &&
				!$params->get('mas_db_portrait', 1) &&
				!$params->get('mas_db_small', 1) &&
				!$this->detailBoxColumns)
			{
				$this->detailBoxAll = false;
			}

			if (!$params->get('mas_db_title_big', 1) &&
				!$params->get('mas_db_title_lscape', 1) &&
				!$params->get('mas_db_title_portrait', 1) &&
				!$params->get('mas_db_title_small', 1) &&
				!$this->detailBoxTitleColumns)
			{
				$this->detailBoxTitleAll = false;
			}

			if (!$params->get('mas_db_introtext_big', 1) &&
				!$params->get('mas_db_introtext_lscape', 1) &&
				!$params->get('mas_db_introtext_portrait', 1) &&
				!$params->get('mas_db_introtext_small', 1) &&
				!$this->detailBoxIntrotextColumns)
			{
				$this->detailBoxIntrotextAll = false;
			}

			if (!$params->get('mas_db_date_big', 1) &&
				!$params->get('mas_db_date_lscape', 1) &&
				!$params->get('mas_db_date_portrait', 1) &&
				!$params->get('mas_db_date_small', 1) &&
				!$this->detailBoxDateColumns)
			{
				$this->detailBoxDateAll = false;
			}

			if (!$params->get('mas_db_category_big', 1) &&
				!$params->get('mas_db_category_lscape', 1) &&
				!$params->get('mas_db_category_portrait', 1) &&
				!$params->get('mas_db_category_small', 1) &&
				!$this->detailBoxCategoryColumns)
			{
				$this->detailBoxCategoryAll = false;
			}

			if (!$params->get('mas_db_author_big', 1) &&
				!$params->get('mas_db_author_lscape', 1) &&
				!$params->get('mas_db_author_portrait', 1) &&
				!$params->get('mas_db_author_small', 1) &&
				!$this->detailBoxAuthorColumns)
			{
				$this->detailBoxAuthorAll = false;
			}

			if (!$params->get('mas_db_tags_big', 0) &&
				!$params->get('mas_db_tags_lscape', 0) &&
				!$params->get('mas_db_tags_portrait', 0) &&
				!$params->get('mas_db_tags_small', 0) &&
				!$this->detailBoxTagsColumns)
			{
				$this->detailBoxTagsAll = false;
			}

			if (!$params->get('mas_db_hits_big', 0) &&
				!$params->get('mas_db_hits_lscape', 0) &&
				!$params->get('mas_db_hits_portrait', 0) &&
				!$params->get('mas_db_hits_small', 0) &&
				!$this->detailBoxHitsColumns)
			{
				$this->detailBoxHitsAll = false;
			}

			if (!$params->get('mas_db_readmore_big', 0) &&
				!$params->get('mas_db_readmore_lscape', 0) &&
				!$params->get('mas_db_readmore_portrait', 0) &&
				!$params->get('mas_db_readmore_small', 0) &&
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
			
			if (!$this->detailBoxReadmoreColumns)
				$this->detailBoxReadmoreAll = false;
		}

		// Hover box
		$this->hoverBox = $params->get('mas_hb', 0);
		$hoverBoxBg = $params->get('mas_hb_bg', '#eb885e');
		$hoverBoxBgOpacity = $params->get('mas_hb_bg_opacity', 0.75);
		$hoverBoxEffect = $params->get('mas_hb_effect', 1);
		$hoverBoxEffectSpeed = $params->get('mas_hb_effect_speed', 0.4);
		$hoverBoxEffectEasing = $params->get('mas_hb_effect_easing', 'cubic-bezier(0.445, 0.05, 0.55, 0.95)');
		$this->hoverBoxTitle = $params->get('mas_hb_title', 1);
		$hoverBoxTitleLimit = $params->get('mas_hb_title_limit', 15);
		$this->hoverBoxIntrotext = $params->get('mas_hb_introtext', 0);
		$hoverBoxIntrotextLimit = $params->get('mas_hb_introtext_limit', 15);
		$hoverBoxStripTags = $params->get('mas_hb_strip_tags', 1);
		$this->hoverBoxDate = $params->get('mas_hb_date', 0);
		$hoverBoxDateFormat = $params->get('mas_hb_date_format', 'F d, Y');
		$this->hoverBoxCategory = $params->get('mas_hb_category', 1);
		$this->hoverBoxAuthor = $params->get('mas_hb_author', 0);
		$this->hoverBoxHits = $params->get('mas_hb_hits', 0);
		$this->hoverBoxLinkButton = $params->get('mas_hb_link', 1);
		$this->hoverBoxZoomButton = false;
		$this->modalTitle = $params->get('mas_modal_title', 1);
		$this->hoverBoxZoomButton = $params->get('mas_hb_zoom', 1);

		// Hover effects
		$this->hoverOffset = '';
		$this->hoverClass = '';
		$this->flipBase = '';
		$this->perspective = '';
		$this->flipClass = '';

		if ($this->hoverBox)
		{
			if ($hoverBoxEffect == 'no')
				$this->hoverClass = 'hoverShow';
			else if ($hoverBoxEffect == '1')
				$this->hoverClass = 'hoverFadeIn';
			else if ($hoverBoxEffect == '2')
			{
				$this->flipBase = 'flipBase';
				$this->perspective = 'perspective';
				$this->flipClass = 'flipY';
			}
			else if ($hoverBoxEffect == '3')
			{
				$this->flipBase = 'flipBase';
				$this->perspective = 'perspective';
				$this->flipClass = 'flipX';
			}
			else if ($hoverBoxEffect == '4') {
				$this->hoverOffset = 'rightOffset';
				$this->hoverClass = 'slideInRight';
			}
			else if ($hoverBoxEffect == '5')
			{
				$this->hoverOffset = 'leftOffset';
				$this->hoverClass = 'slideInLeft';
			}
			else if ($hoverBoxEffect == '6') 
			{
				$this->hoverOffset = 'topOffset';
				$this->hoverClass = 'slideInTop';
			}
			else if ($hoverBoxEffect == '7')
			{
				$this->hoverOffset = 'bottomOffset';
				$this->hoverClass = 'slideInBottom';
			}
			else if ($hoverBoxEffect == '8')
			{
				$this->hoverOffset = 'zoomOffset';
				$this->hoverClass = 'zoomIn';
			}
		}

		// Transition styles
		$this->animated = '';
		
		if ($hoverBoxEffect != 'no' && $hoverBoxEffect != '2' && $hoverBoxEffect != '3')
		{
			$this->animated = '
			transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-webkit-transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-o-transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-ms-transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			';
		}

		$this->animated_flip = '';

		if ($hoverBoxEffect == '2' || $hoverBoxEffect == '3')
		{
			$this->animated_flip = '
			transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-webkit-transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-o-transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			-ms-transition: all '.$hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
			';
		}

		// Hover box background
		$this->hb_bg_class = $this->utilitiesLib->hex2RGB($hoverBoxBg, true);
		$this->hb_bg_opacity_class = number_format((float)$hoverBoxBgOpacity, 2, '.', '');

		// Get wall
		if ($page === 1 && $input->get('task') != 'getFilters')
			$this->items = $this->model->getItems($params, $filters);

		// Get widget with display options
		$this->wall = $this->model->getDisplayOptions($this->items, $params);

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
						$item->itemIndex = $this->utilitiesLib->getItemIndex($index, $grid);
					else
						$item->itemIndex = $index;
				}
			}
		}

		if ($page === 1 && $input->get('task') != 'getFilters')
		{
			// Add assets
			$wa = $document->getWebAssetManager();
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
					".json_encode($params).", 
					".$id.", 
					'".$this->item->source_id."',
					'".$site_path."',
				);
			});
			");

			if ($params->get('mas_enable_responsive', 1))
				$this->model->responsiveLib->loadResponsiveMasonry($params, $id);
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

			$this->filters = false;
			$this->sortings = false;

			if ($page === 1 && $input->get('task') != 'getFilters')
			{
				$this->active_ordering = $this->model->getItemsOrdering($this->params);
				$this->active_direction = $this->model->getItemsDirection($this->params);

				// Get Filters
				if ($params->get('mas_category_filters', 1) ||
					$params->get('mas_tag_filters', 1) ||
					$params->get('mas_date_filters', 0))
				{
					$this->filters = true;
				}

				// Get Sortings
				if ($params->get('mas_title_sorting', 1) ||
					$params->get('mas_date_sorting', 1) ||
					$params->get('mas_hits_sorting', 0))
				{
					$this->sortings = true;
				}

				if ($this->filters || $this->sortings)
				{
					$this->model->filtersLib->getFiltersCss($params, $id);
				}

				// Reset button
				$this->resetButton = $params->get('mas_reset_filters', 0);

				// Set page meta data
				$this->setPageMeta($this->componentParams, $params->get('mas_page_title', 0));

				// Set layout
				$layout = $params->get('mas_layout', '');

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

 	public function setPageMeta($params, $page_title)
 	{
		$document = Factory::getDocument();
		$app = Factory::getApplication();
		$menus = $app->getMenu();
		$menu = $menus->getActive();

		$this->mas_page_title = false;

		if ($page_title)
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
		"readmore_class" => "",
		"db_bg_class" => "",
		"db_bg_opacity_class" => "",
		"position_class" => ""
		);

		$options['db_bg_class'] = $this->utilitiesLib->hex2RGB($this->detailBoxBackgroundColumns, true);
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

		if (!$this->detailBoxReadmoreColumns)
			$options['readmore_class'] = 'readmore-hidden';

		return $options;
 	}
}