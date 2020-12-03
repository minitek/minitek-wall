<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

// Start output
$output = '';

// Category Filters
if ($this->masonry_params['mas_category_filters'])
{
	$cat_array = array();

	if (isset($this->masonry_params['mas_filters_mode']) && $this->masonry_params['mas_filters_mode'] == 'dynamic')
	{
		// Dynamic filters
		foreach($this->wall as $key=>$wall_item)
		{
			if (isset($wall_item->itemCategoryRaw))
			{
				array_push($cat_array, $wall_item->itemCategoryRaw);
			}
			else if (isset($wall_item->itemCategoriesRaw))
			{
				foreach ($wall_item->itemCategoriesRaw as $key=>$itemCategory)
				{
					if (is_array($itemCategory))
					{
						array_push($cat_array, $itemCategory['category_name']);
					}
				}
			}
		}

		$cat_array = array_unique($cat_array);
	}
	else if (isset($this->masonry_params['mas_filters_mode']) && $this->masonry_params['mas_filters_mode'] == 'static')
	{
		// Static filters
		$cat_ids = array();

		// Register plugin source class
		$source_type = $this->source_params['source_type'];
		$class = 'MSource'.$source_type.'Source';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE .DS. 'plugins' .DS. 'content' .DS. $plugin .DS. 'helpers' .DS. 'source.php');

		$source = new $class;
		$cat_ids = $source->getStaticCategories($this->source_params);

		if (!empty($cat_ids))
		{
			$cat_array = $source->getCategoriesNames($cat_ids);
		}
	}
	else
	{
		// Fallback to dynamic filters if categories type is not set
		foreach($this->wall as $key=>$wall_item)
		{
			if (isset($wall_item->itemCategoryRaw))
			{
				array_push($cat_array, $wall_item->itemCategoryRaw);
			}
			else if (isset($wall_item->itemCategoriesRaw))
			{
				foreach ($wall_item->itemCategoriesRaw as $key=>$itemCategory)
				{
					if (is_array($itemCategory))
					{
						array_push($cat_array, $itemCategory['category_name']);
					}
				}
			}
		}

		$cat_array = array_unique($cat_array);
	}

	asort($cat_array);
	$cat_array = array_values($cat_array);

	if ($this->masonry_params['mas_filter_type'] == '1')
	{
		// Inline filters
		$output .= '<div class="button-group button-group-category mnwall_iso_buttons" data-filter-group="category">';
		
		if ($this->masonry_params['mas_category_filters_label'])
		{
			$output .= '<span>'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']).'</span>';
		}

		$output .= '<ul>';
			$output .= '<li>';
			$output .= '<a href="#" data-filter="" class="mnwall-filter mnw_filter_active">'.\JText::_('COM_MINITEKWALL_SHOW_ALL').'</a>';
			$output .= '</li>';

			foreach ($cat_array as $category)
			{
				$cat_name_fixed = $this->utilities->cleanName($category);
				$category = htmlspecialchars($category);
				$output .= '<li>';
				$output .= '<a href="#" data-filter=".cat-'.$cat_name_fixed.'" class="mnwall-filter">'.$category.'</a>';
				$output .= '</li>';
			}

		$output .= '</ul>';
		$output .= '</div>';
	}

	if ($this->masonry_params['mas_filter_type'] == '2')
	{
		// Dropdown filters
		$output .= '<div class="mnwall_iso_dropdown">';
			$output .= '<div class="dropdown-label cat-label">';
				$output .= '<span data-label="'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']).'">';
				$output .= '<i class="fa fa-angle-down"></i><span>'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']).'</span>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<ul class="button-group button-group-category" data-filter-group="category">';
				$output .= '<li><a href="#" data-filter="" class="mnwall-filter mnw_filter_active">'.\JText::_('COM_MINITEKWALL_SHOW_ALL').'</a></li>';
				
				foreach ($cat_array as $category)
				{
					$cat_name_fixed = $this->utilities->cleanName($category);
					$category = htmlspecialchars($category);
					$output .= '<li><a href="#" data-filter=".cat-'.$cat_name_fixed.'" class="mnwall-filter">'.$category.'</a></li>';
				}

			$output .= '</ul>';
		$output .= '</div>';
	}
}

// Tag Filters
if ($this->masonry_params['mas_tag_filters'])
{
	$tag_array = array();

	if (isset($this->masonry_params['mas_filters_mode']) && $this->masonry_params['mas_filters_mode'] == 'dynamic')
	{
		// Dynamic filters
		foreach($this->wall as $key=>$wall_item)
		{
			if (isset($wall_item->itemTags))
			{
				foreach($wall_item->itemTags as $key=>$itemTag)
				{
					array_push($tag_array, $itemTag->title);
				}
			}
		}

		$tag_array = array_unique($tag_array);
	}
	else if (isset($this->masonry_params['mas_filters_mode']) && $this->masonry_params['mas_filters_mode'] == 'static')
	{
		// Static filters
		$tag_ids = array();

		// Register plugin source class
		$source_type = $this->source_params['source_type'];
		$class = 'MSource'.$source_type.'Source';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE .DS. 'plugins' .DS. 'content' .DS. $plugin .DS. 'helpers' .DS. 'source.php');

		$source = new $class;
		$tag_ids = $source->getStaticTags($this->source_params);

		if (!empty($tag_ids))
		{
			$tag_array = $source->getTagsNames($tag_ids);
		}
	}
	else
	{
		// Fallback to dynamic filters if tags type is not set
		foreach($this->wall as $key=>$wall_item)
		{
			if (isset($wall_item->itemTags))
			{
				foreach($wall_item->itemTags as $key=>$itemTag)
				{
					array_push($tag_array, $itemTag->title);
				}
			}
		}

		$tag_array = array_unique($tag_array);
	}

	asort($tag_array);
	$tag_array = array_values($tag_array);

	if ($this->masonry_params['mas_filter_type'] == '1')
	{
		// Inline filters
		$output .= '<div class="button-group button-group-tag mnwall_iso_buttons" data-filter-group="tag">';
		
		if ($this->masonry_params['mas_tag_filters_label'])
		{
			$output .= '<span>'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']).'</span>';
		}

		$output .= '<ul>';
			$output .= '<li>';
			$output .= '<a href="#" data-filter="" class="mnwall-filter mnw_filter_active">'.\JText::_('COM_MINITEKWALL_SHOW_ALL').'</a>';
			$output .= '</li>';

			foreach ($tag_array as $tagName)
			{
				$tag_name_fixed = $this->utilities->cleanName($tagName);
				$tag = htmlspecialchars($tagName);
				$output .= '<li>';
				$output .= '<a href="#" data-filter=".tag-'.$tag_name_fixed.'" class="mnwall-filter">'.$tag.'</a>';
				$output .= '</li>';
			}

		$output .= '</ul>';
		$output .= '</div>';
	}

	if ($this->masonry_params['mas_filter_type'] == '2')
	{
		// Dropdown filters
		$output .= '<div class="mnwall_iso_dropdown">';
			$output .= '<div class="dropdown-label tag-label">';
				$output .= '<span data-label="'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']).'">';
				$output .= '<i class="fa fa-angle-down"></i><span>'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']).'</span>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<ul class="button-group button-group-tag" data-filter-group="tag">';
				$output .= '<li><a href="#" data-filter="" class="mnwall-filter mnw_filter_active">'.\JText::_('COM_MINITEKWALL_SHOW_ALL').'</a></li>';
				
				foreach ($tag_array as $tagName)
				{
					$tag_name_fixed = $this->utilities->cleanName($tagName);
					$tag = htmlspecialchars($tagName);
					$output .= '<li><a href="#" data-filter=".tag-'.$tag_name_fixed.'" class="mnwall-filter">'.$tag.'</a></li>';
				}

			$output .= '</ul>';
		$output .= '</div>';
	}
}

// Date Filters
if ($this->masonry_params['mas_date_filters'])
{
	// Create date filters
	$date_array = array();

	foreach($this->wall as $key=>$wall_item)
	{
		if (isset($wall_item->itemDateRaw))
		{
			array_push($date_array, \JHTML::_('date', $wall_item->itemDateRaw, 'Y-m'));
		}
	}

	$date_array = array_unique($date_array);
	rsort($date_array);
	$date_array = array_values($date_array);

	if ($this->masonry_params['mas_filter_type'] == '1')
	{
		// Inline filters
		$output .= '<div class="button-group button-group-date mnwall_iso_buttons" data-filter-group="date">';
		
		if ($this->masonry_params['mas_date_filters_label'])
		{
			$output .= '<span>'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']).'</span>';
		}

		$output .= '<ul>';
			$output .= '<li>';
			$output .= '<a href="#" data-filter="" class="mnwall-filter mnw_filter_active">'.\JText::_('COM_MINITEKWALL_SHOW_ALL').'</a>';
			$output .= '</li>';
			
			foreach ($date_array as $date)
			{
				$date_name_fixed = $this->utilities->cleanName($date);
				$date = \JHTML::_('date', $date, 'M Y');
				$output .= '<li>';
				$output .= '<a href="#" data-filter=".date-'.$date_name_fixed.'" class="mnwall-filter">'.$date.'</a>';
				$output .= '</li>';
			}

		$output .= '</ul>';
		$output .= '</div>';
	}

	if ($this->masonry_params['mas_filter_type'] == '2')
	{
		// Dropdown filters
		$output .= '<div class="mnwall_iso_dropdown">';
			$output .= '<div class="dropdown-label date-label">';
				$output .= '<span data-label="'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']).'">';
				$output .= '<i class="fa fa-angle-down"></i><span>'.\JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']).'</span>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<ul class="button-group button-group-date" data-filter-group="date">';
				$output .= '<li><a href="#" data-filter="" class="mnwall-filter mnw_filter_active">'.JText::_('COM_MINITEKWALL_SHOW_ALL').'</a></li>';
				
				foreach ($date_array as $date)
				{
					$date_name_fixed = $this->utilities->cleanName($date);
					$date = \JHTML::_('date', $date, 'M Y');

					$output .= '<li><a href="#" data-filter=".date-'.$date_name_fixed.'" class="mnwall-filter">'.$date.'</a></li>';
				}
				
			$output .= '</ul>';
		$output .= '</div>';
	}
}

echo $output;
