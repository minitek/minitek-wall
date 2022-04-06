<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

// Category Filters
if ($this->masonry_params['mas_category_filters'])
{
	$cat_array = array();

	// Dynamic filters
	foreach ($this->wall as $key => $item)
	{
		if (isset($item->itemCategoriesRaw) && $item->itemCategoriesRaw)
		{
			foreach ($item->itemCategoriesRaw as $key => $itemCategory)
			{
				if (is_array($itemCategory))
					$cat_array[$itemCategory['id']] = $itemCategory;
			}
		}
	}

	// Sort array
	$column = array();
	$id = array();
	$field = isset($this->masonry_params['mas_filters_ordering']) ? $this->masonry_params['mas_filters_ordering'] : 'title';
	$direction = isset($this->masonry_params['mas_filters_ordering_dir']) ? $this->masonry_params['mas_filters_ordering_dir'] : 'asc';
	$direction = $direction == 'asc' ? SORT_ASC : SORT_DESC;
	$keys = array_keys($cat_array); // Store original keys

	foreach ($cat_array as $key => $cat)
	{
		$column[$key] = $cat[$field];
		$id[$key] = $cat['id'];
	}

	array_multisort(
		$column, $direction, 
		$id, $direction, 
		$cat_array, $keys
	);
	$cat_array = array_combine($keys, $cat_array);

	// Inline filters
	if ($cat_array && $this->masonry_params['mas_filter_type'] == '1')
	{
		?><div class="mwall-filters-group button-group button-group-category mwall-buttons" data-filter-group="category"><?php
		
			if ($this->masonry_params['mas_category_filters_label'])
			{
				?><span><?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']); ?></span><?php
			}
			
			?><ul>
				<li>
					<a href="#" data-id="0" data-filter="" class="mwall-filter mwall-filter-active"><?php
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 

				foreach ($cat_array as $key => $category)
				{
					$class = $this->utilities->cleanName($category['title']);
					$title = htmlspecialchars($category['title']);

					?><li>
						<a href="#" data-id="<?php echo $key; ?>" data-filter=".cat-<?php echo $class; ?>" class="mwall-filter"><?php 
							echo $title; 
						?></a>
					</li><?php
				}
			?></ul>
		</div><?php
	}

	// Dropdown filters
	if ($cat_array && $this->masonry_params['mas_filter_type'] == '2')
	{
		?><div class="mwall-filters-group">
			<div class="mwall-dropdown">
				<div class="dropdown-label cat-label">
					<span data-label="<?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']); ?>">
						<i class="fa fa-angle-down"></i><span><?php 
							echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_category_filters_label']); 
						?></span>
					</span>
				</div>
				<ul class="button-group button-group-category" data-filter-group="category">
					<li>
						<a href="#" data-id="0" data-filter="" class="mwall-filter mwall-filter-active"><?php
							echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
						?></a>
					</li><?php 

					foreach ($cat_array as $key => $category)
					{
						$class = $this->utilities->cleanName($category['title']);
						$title = htmlspecialchars($category['title']);
						
						?><li>
							<a href="#" data-id="<?php echo $key; ?>" data-filter=".cat-<?php echo $class; ?>" class="mwall-filter"><?php
								echo $title; 
							?></a>
						</li><?php 
					}
				?></ul>
			</div>
		</div><?php
	}
}

// Tag Filters
if ($this->masonry_params['mas_tag_filters'])
{
	$tag_array = array();

	// Dynamic filters
	foreach ($this->wall as $key => $item)
	{
		if (isset($item->itemTagsRaw) && $item->itemTagsRaw)
		{
			foreach ($item->itemTagsRaw as $key => $itemTag)
			{
				$tag_array[$itemTag['id']] = $itemTag;
			}
		}
	}

	// Sort array
	$column = array();
	$id = array();
	$field = isset($this->masonry_params['mas_filters_ordering']) ? $this->masonry_params['mas_filters_ordering'] : 'title';
	$direction = isset($this->masonry_params['mas_filters_ordering_dir']) ? $this->masonry_params['mas_filters_ordering_dir'] : 'asc';
	$direction = $direction == 'asc' ? SORT_ASC : SORT_DESC;
	$keys = array_keys($tag_array); // Store original keys

	foreach ($tag_array as $key => $tag)
	{
		$column[$key] = $tag[$field];
		$id[$key] = $tag['id'];
	}

	array_multisort(
		$column, $direction, 
		$id, $direction, 
		$tag_array, $keys
	);
	$tag_array = array_combine($keys, $tag_array);

	// Inline filters
	if ($tag_array && $this->masonry_params['mas_filter_type'] == '1')
	{
		?><div class="mwall-filters-group button-group button-group-tag mwall-buttons" data-filter-group="tag"><?php

			if ($this->masonry_params['mas_tag_filters_label'])
			{
				?><span><?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']); ?></span><?php
			}

			?><ul>
				<li>
					<a href="#" data-id="0" data-filter="" class="mwall-filter mwall-filter-active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php

				foreach ($tag_array as $key => $tag)
				{
					$class = $this->utilities->cleanName($tag['title']);
					$title = htmlspecialchars($tag['title']);
					
					?><li>
						<a href="#" data-id="<?php echo $key; ?>" data-filter=".tag-<?php echo $class; ?>" class="mwall-filter"><?php 
							echo $title; 
						?></a>
					</li><?php
				}
			?></ul>
		</div><?php 
	}
	// Dropdown filters
	if ($tag_array && $this->masonry_params['mas_filter_type'] == '2')
	{
		?><div class="mwall-filters-group">
			<div class="mwall-dropdown">
				<div class="dropdown-label tag-label">
					<span data-label="<?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']); ?>">
						<i class="fa fa-angle-down"></i><span><?php 
							echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_tag_filters_label']); 
						?></span>
					</span>
				</div>
				<ul class="button-group button-group-tag" data-filter-group="tag">
					<li>
						<a href="#" data-id="0" data-filter="" class="mwall-filter mwall-filter-active"><?php 
							echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
						?></a>
					</li><?php 

					foreach ($tag_array as $key => $tag)
					{
						$class = $this->utilities->cleanName($tag['title']);
						$title = htmlspecialchars($tag['title']);
						
						?><li>
							<a href="#" data-id="<?php echo $key; ?>" data-filter=".tag-<?php echo $class; ?>" class="mwall-filter"><?php 
								echo $title; 
							?></a>
						</li><?php 
					}
				?></ul>
			</div>
		</div><?php
	}
}

// Date Filters
if ($this->masonry_params['mas_date_filters'])
{
	$date_array = array();

	// Dynamic filters
	foreach ($this->wall as $key => $item)
	{
		if (isset($item->itemDateRaw) && $item->itemDateRaw)
			array_push($date_array, \JHTML::_('date', $item->itemDateRaw, 'Y-m'));
	}

	$date_array = array_unique($date_array);

	// Sort array
	$direction = isset($this->masonry_params['mas_filters_ordering_dir']) ? $this->masonry_params['mas_filters_ordering_dir'] : 'asc';

	if ($direction == 'asc')
		sort($date_array);
	else 
		rsort($date_array);

	// Inline filters
	if ($date_array && $this->masonry_params['mas_filter_type'] == '1')
	{
		?><div class="mwall-filters-group button-group button-group-date mwall-buttons" data-filter-group="date"><?php 

			if ($this->masonry_params['mas_date_filters_label'])
			{
				?><span><?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']); ?></span><?php 
			}

			?><ul>
				<li>
					<a href="#" data-id="0" data-filter="" class="mwall-filter mwall-filter-active"><?php 
						echo \JText::_('COM_MINITEKWALL_SHOW_ALL'); 
					?></a>
				</li><?php 

				foreach ($date_array as $date)
				{
					$class = $this->utilities->cleanName($date);
					$date = \JHTML::_('date', $date, 'M Y');
					
					?><li>
						<a href="#" data-id="<?php echo $class; ?>" data-filter=".date-<?php echo $class; ?>" class="mwall-filter"><?php 
							echo $date; ?></a>
					</li><?php 
				}
			?></ul>
		</div><?php 
	}

	// Dropdown filters
	if ($date_array && $this->masonry_params['mas_filter_type'] == '2')
	{
		?><div class="mwall-filters-group">
			<div class="mwall-dropdown">
				<div class="dropdown-label date-label">
					<span data-label="<?php echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']); ?>">
						<i class="fa fa-angle-down"></i><span><?php 
							echo \JText::_('COM_MINITEKWALL_'.$this->masonry_params['mas_date_filters_label']); 
						?></span>
					</span></div>
				<ul class="button-group button-group-date" data-filter-group="date">
					<li>
						<a href="#" data-id="0" data-filter="" class="mwall-filter mwall-filter-active"><?php 
							echo JText::_('COM_MINITEKWALL_SHOW_ALL'); 
						?></a>
					</li><?php 

					foreach ($date_array as $date)
					{
						$class = $this->utilities->cleanName($date);
						$date = \JHTML::_('date', $date, 'M Y');

						?><li>
							<a href="#" data-id="<?php echo $class; ?>" data-filter=".date-<?php echo $class; ?>" class="mwall-filter"><?php 
								echo $date; 
							?></a>
						</li><?php 
					}
				?></ul>
			</div>
		</div><?php
	}
}