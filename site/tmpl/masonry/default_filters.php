<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

// Category Filters
if ($this->masonry_params['mas_category_filters'])
{
	$cat_array = array();

	// Dynamic filters
	foreach($this->wall as $key=>$wall_item)
	{
		if (isset($wall_item->itemCategoryRaw) && $wall_item->itemCategoryRaw)
		{
			array_push($cat_array, $wall_item->itemCategoryRaw);
		}
		else if (isset($wall_item->itemCategoriesRaw) && $wall_item->itemCategoriesRaw)
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
	asort($cat_array);
	$cat_array = array_values($cat_array);

	if ($this->masonry_params['mas_filter_type'] == '1')
	{
		// Inline filters
		?><div class="button-group button-group-category mwall_iso_buttons" data-filter-group="category"><?php
		
			if ($this->masonry_params['mas_category_filters_label'])
			{
				?><span><?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']); ?></span><?php
			}

			?><ul>
				<li>
					<a href="#" data-filter="" class="mwall-filter mnw_filter_active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 

				foreach ($cat_array as $category)
				{
					$cat_name_fixed = $this->utilities->cleanName($category);
					$category = htmlspecialchars($category);
					
					?><li>
						<a href="#" data-filter=".cat-<?php echo $cat_name_fixed; ?>" class="mwall-filter"><?php 
							echo $category; 
						?></a>
					</li><?php
				}

			?></ul>
		</div><?php
	}

	if ($this->masonry_params['mas_filter_type'] == '2')
	{
		// Dropdown filters
		?><div class="mwall_iso_dropdown">
			<div class="dropdown-label cat-label">
				<span data-label="<?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']); ?>">
					<i class="fa fa-angle-down"></i><span><?php 
						echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']); 
					?></span>
				</span>
			</div>
			<ul class="button-group button-group-category" data-filter-group="category">
				<li>
					<a href="#" data-filter="" class="mwall-filter mnw_filter_active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 
				
				foreach ($cat_array as $category)
				{
					$cat_name_fixed = $this->utilities->cleanName($category);
					$category = htmlspecialchars($category);

					?><li>
						<a href="#" data-filter=".cat-<?php echo $cat_name_fixed; ?>" class="mwall-filter"><?php 
							echo $category; 
						?></a>
					</li><?php 
				}

			?></ul>
		</div><?php 
	}
}

// Tag Filters
if ($this->masonry_params['mas_tag_filters'])
{
	$tag_array = array();

	// Dynamic filters
	foreach($this->wall as $key=>$wall_item)
	{
		if (isset($wall_item->itemTags) && $wall_item->itemTags)
		{
			foreach($wall_item->itemTags as $key=>$itemTag)
			{
				array_push($tag_array, $itemTag->title);
			}
		}
	}

	$tag_array = array_unique($tag_array);
	asort($tag_array);
	$tag_array = array_values($tag_array);

	if ($this->masonry_params['mas_filter_type'] == '1')
	{
		// Inline filters
		?><div class="button-group button-group-tag mwall_iso_buttons" data-filter-group="tag"><?php
		
		if ($this->masonry_params['mas_tag_filters_label'])
		{
			?><span><?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']); ?></span><?php
		}

			?><ul>
				<li>
					<a href="#" data-filter="" class="mwall-filter mnw_filter_active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 

				foreach ($tag_array as $tagName)
				{
					$tag_name_fixed = $this->utilities->cleanName($tagName);
					$tag = htmlspecialchars($tagName);

					?><li>
						<a href="#" data-filter=".tag-<?php echo $tag_name_fixed; ?>" class="mwall-filter"><?php 
							echo $tag; 
						?></a>
					</li><?php 
				}

			?></ul>
		</div><?php 
	}

	if ($this->masonry_params['mas_filter_type'] == '2')
	{
		// Dropdown filters
		?><div class="mwall_iso_dropdown">
			<div class="dropdown-label tag-label">
				<span data-label="<?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']); ?>">
					<i class="fa fa-angle-down"></i><span><?php 
						echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']); 
					?></span>
				</span>
			</div>
			<ul class="button-group button-group-tag" data-filter-group="tag">
				<li>
					<a href="#" data-filter="" class="mwall-filter mnw_filter_active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 
				
				foreach ($tag_array as $tagName)
				{
					$tag_name_fixed = $this->utilities->cleanName($tagName);
					$tag = htmlspecialchars($tagName);

					?><li>
						<a href="#" data-filter=".tag-<?php echo $tag_name_fixed; ?>" class="mwall-filter"><?php 
							echo $tag; 
						?></a>
					</li><?php 
				}

			?></ul>
		</div><?php 
	}
}

// Date Filters
if ($this->masonry_params['mas_date_filters'])
{
	// Create date filters
	$date_array = array();

	foreach($this->wall as $key=>$wall_item)
	{
		if (isset($wall_item->itemDateRaw) && $wall_item->itemDateRaw)
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
		?><div class="button-group button-group-date mwall_iso_buttons" data-filter-group="date"><?php 
		
			if ($this->masonry_params['mas_date_filters_label'])
			{
				?><span><?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']); ?></span><?php 
			}

			?><ul>
				<li>
					<a href="#" data-filter="" class="mwall-filter mnw_filter_active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 
				
				foreach ($date_array as $date)
				{
					$date_name_fixed = $this->utilities->cleanName($date);
					$date = \JHTML::_('date', $date, 'M Y');

					?><li>
						<a href="#" data-filter=".date-<?php echo $date_name_fixed; ?>" class="mwall-filter"><?php
							echo $date; 
						?></a>
					</li><?php
				}

			?></ul>
		</div><?php 
	}

	if ($this->masonry_params['mas_filter_type'] == '2')
	{
		// Dropdown filters
		?><div class="mwall_iso_dropdown">
			<div class="dropdown-label date-label">
				<span data-label="<?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']); ?>">
					<i class="fa fa-angle-down"></i><span><?php 
						echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']); 
					?></span>
				</span>
			</div>
			<ul class="button-group button-group-date" data-filter-group="date">
				<li>
					<a href="#" data-filter="" class="mwall-filter mnw_filter_active"><?php 
						echo JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 
				
				foreach ($date_array as $date)
				{
					$date_name_fixed = $this->utilities->cleanName($date);
					$date = \JHTML::_('date', $date, 'M Y');

					?><li>
						<a href="#" data-filter=".date-<?php echo $date_name_fixed; ?>" class="mwall-filter"><?php 
							echo $date; 
						?></a>
					</li><?php 
				}
				
			?></ul>
		</div><?php 
	}
}
