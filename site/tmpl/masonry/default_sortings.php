<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

// Active sorting direction
$asc_dir_active = '';
$desc_dir_active = '';

if ($this->active_direction == 'ASC')
{
	$asc_dir_active = 'mnw_filter_active';
}
else
{
	$desc_dir_active = 'mnw_filter_active';
}

// Active sorting
$title_sort_active = '';
$category_sort_active = '';
$author_sort_active = '';
$date_sort_active = '';
$hits_sort_active = '';

switch ($this->active_ordering)
{
	case 'title':
		$title_sort_active = 'mnw_filter_active';
		break;
	case 'category':
		$category_sort_active = 'mnw_filter_active';
		break;
	case 'author':
		$author_sort_active = 'mnw_filter_active';
		break;
	case 'date':
		$date_sort_active = 'mnw_filter_active';
		break;
	case 'hits':
		$hits_sort_active = 'mnw_filter_active';
		break;
}

if ($this->masonry_params['mas_sorting_type'] == 1)
{
	// Inline sortings
	?><div class="sorting-group sorting-group-filters mnwall_iso_buttons">
		<span><?php echo \JText::_('COM_MINITEKWALL_SORT_BY'); ?></span>
		<ul><?php 
			if ($this->masonry_params['mas_title_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="title" class="mnwall-filter <?php echo $title_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_TITLE'); 
					?></a>
				</li><?php 
			}
			if ($this->masonry_params['mas_category_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="category" class="mnwall-filter <?php echo $category_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_CATEGORY'); 
					?></a>
				</li><?php
			}
			if ($this->masonry_params['mas_author_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="author" class="mnwall-filter <?php echo $author_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_AUTHOR'); 
					?></a>
				</li><?php
			}
			if ($this->masonry_params['mas_date_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="date" class="mnwall-filter <?php echo $date_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_DATE'); 
					?></a>
				</li><?php 
			}
			if (isset($this->masonry_params['mas_hits_sorting']) && $this->masonry_params['mas_hits_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="hits" class="mnwall-filter <?php echo $hits_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_HITS_SORTING');
					?></a>
				</li><?php 
			}
		?></ul>
	</div><?php

	if ($this->masonry_params['mas_sorting_direction'])
	{
		// Inline Direction
		?><div class="sorting-group sorting-group-direction mnwall_iso_buttons">
			<span><?php echo JText::_('COM_MINITEKWALL_SORT_DIRECTION'); ?></span>
			<ul>
				<li>
					<a href="#" data-sort-value="asc" class="mnwall-filter <?php echo $asc_dir_active; ?>"><?php 
						echo JText::_('COM_MINITEKWALL_ASC');
					?></a>
				</li>
				<li>
					<a href="#" data-sort-value="desc" class="mnwall-filter <?php echo $desc_dir_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_DESC'); 
					?></a>
				</li>
			</ul>
		</div><?php 
	}
}

if ($this->masonry_params['mas_sorting_type'] == 2)
{
	// Dropdown sortings
	?><div class="mnwall_iso_dropdown">
		<div class="dropdown-label sorting-label">
			<span data-label="<?php echo \JText::_('COM_MINITEKWALL_SORT_BY'); ?>">
				<i class="fa fa-angle-down"></i><span><?php echo \JText::_('COM_MINITEKWALL_SORT_BY'); ?></span>
			</span>
		</div>
		<ul class="sorting-group sorting-group-filters"><?php 
			if ($this->masonry_params['mas_title_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="title" class="mnwall-filter <?php echo $title_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_TITLE'); 
					?></a>
				</li><?php 
			}
			if ($this->masonry_params['mas_category_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="category" class="mnwall-filter <?php echo $category_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_CATEGORY'); 
					?></a>
				</li><?php 
			}
			if ($this->masonry_params['mas_author_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="author" class="mnwall-filter <?php echo $author_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_AUTHOR'); 
					?></a>
				</li><?php 
			}
			if ($this->masonry_params['mas_date_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="date" class="mnwall-filter <?php echo $date_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_DATE'); 
					?></a>
				</li><?php 
			}
			if (isset($this->masonry_params['mas_hits_sorting']) && $this->masonry_params['mas_hits_sorting'])
			{
				?><li>
					<a href="#" data-sort-value="hits" class="mnwall-filter <?php echo $hits_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_HITS_SORTING'); 
					?></a>
				</li><?php 
			}
		?></ul>
	</div><?php 

	if ($this->masonry_params['mas_sorting_direction'])
	{
		// Dropdown direction
		?><div class="mnwall_iso_dropdown">
			<div class="dropdown-label sorting-label">
				<span data-label="<?php echo \JText::_('COM_MINITEKWALL_SORT_DIRECTION'); ?>">
					<i class="fa fa-angle-down"></i><span><?php echo \JText::_('COM_MINITEKWALL_SORT_DIRECTION'); ?></span>
				</span>
			</div>
			<ul class="sorting-group sorting-group-direction">
				<li>
					<a href="#" data-sort-value="asc" class="mnwall-filter <?php echo $asc_dir_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_ASC'); 
					?></a>
				</li>
				<li>
					<a href="#" data-sort-value="desc" class="mnwall-filter <?php echo $desc_dir_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_DESC'); 
					?></a>
				</li>
			</ul>
		</div><?php
	}
}
