<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

// Start output
$output = '';

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
		$output .= '<div class="sorting-group sorting-group-filters mnwall_iso_buttons">';
			$output .= '<span>'.\JText::_('COM_MINITEKWALL_SORT_BY').'</span>';
			$output .= '<ul>';
				if ($this->masonry_params['mas_title_sorting'])
				{
					$output .= '<li>';
					$output .= '<a href="#" data-sort-value="title" class="mnwall-filter '.$title_sort_active.'">'.\JText::_('COM_MINITEKWALL_TITLE').'</a>';
					$output .= '</li>';
				}
				if ($this->masonry_params['mas_category_sorting'])
				{
					$output .= '<li>';
					$output .= '<a href="#" data-sort-value="category" class="mnwall-filter '.$category_sort_active.'">'.\JText::_('COM_MINITEKWALL_CATEGORY').'</a>';
					$output .= '</li>';
				}
				if ($this->masonry_params['mas_author_sorting'])
				{
					$output .= '<li>';
					$output .= '<a href="#" data-sort-value="author" class="mnwall-filter '.$author_sort_active.'">'.\JText::_('COM_MINITEKWALL_AUTHOR').'</a>';
					$output .= '</li>';
				}
				if ($this->masonry_params['mas_date_sorting'])
				{
					$output .= '<li>';
					$output .= '<a href="#" data-sort-value="date" class="mnwall-filter '.$date_sort_active.'">'.\JText::_('COM_MINITEKWALL_DATE').'</a>';
					$output .= '</li>';
				}
				if (isset($this->masonry_params['mas_hits_sorting']) && $this->masonry_params['mas_hits_sorting'])
				{
					$output .= '<li>';
					$output .= '<a href="#" data-sort-value="hits" class="mnwall-filter '.$hits_sort_active.'">'.\JText::_('COM_MINITEKWALL_HITS_SORTING').'</a>';
					$output .= '</li>';
				}
			$output .= '</ul>';
		$output .= '</div>';

		if ($this->masonry_params['mas_sorting_direction'])
		{
			// Inline Direction
			$output .= '<div class="sorting-group sorting-group-direction mnwall_iso_buttons">';
				$output .= '<span>'.JText::_('COM_MINITEKWALL_SORT_DIRECTION').'</span>';
				$output .= '<ul>';
					$output .= '<li>';
						$output .= '<a href="#" data-sort-value="asc" class="mnwall-filter '.$asc_dir_active.'">';
							$output .= JText::_('COM_MINITEKWALL_ASC');
						$output .= '</a>';
					$output .= '</li>';
					$output .= '<li>';
						$output .= '<a href="#" data-sort-value="desc" class="mnwall-filter '.$desc_dir_active.'">'.\JText::_('COM_MINITEKWALL_DESC').'</a>';
					$output .= '</li>';
				$output .= '</ul>';
			$output .= '</div>';
		}
	}

	if ($this->masonry_params['mas_sorting_type'] == 2)
	{
		// Dropdown sortings
		$output .= '<div class="mnwall_iso_dropdown">';
			$output .= '<div class="dropdown-label sorting-label">';
				$output .= '<span data-label="'.\JText::_('COM_MINITEKWALL_SORT_BY').'">';
					$output .= '<i class="fa fa-angle-down"></i><span>'.\JText::_('COM_MINITEKWALL_SORT_BY').'</span>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<ul class="sorting-group sorting-group-filters">';
				if ($this->masonry_params['mas_title_sorting'])
				{
					$output .= '<li><a href="#" data-sort-value="title" class="mnwall-filter '.$title_sort_active.'">'.\JText::_('COM_MINITEKWALL_TITLE').'</a></li>';
				}
				if ($this->masonry_params['mas_category_sorting'])
				{
					$output .= '<li><a href="#" data-sort-value="category" class="mnwall-filter '.$category_sort_active.'">'.\JText::_('COM_MINITEKWALL_CATEGORY').'</a></li>';
				}
				if ($this->masonry_params['mas_author_sorting'])
				{
					$output .= '<li><a href="#" data-sort-value="author" class="mnwall-filter '.$author_sort_active.'">'.\JText::_('COM_MINITEKWALL_AUTHOR').'</a></li>';
				}
				if ($this->masonry_params['mas_date_sorting'])
				{
					$output .= '<li><a href="#" data-sort-value="date" class="mnwall-filter '.$date_sort_active.'">'.\JText::_('COM_MINITEKWALL_DATE').'</a></li>';
				}
				if (isset($this->masonry_params['mas_hits_sorting']) && $this->masonry_params['mas_hits_sorting'])
				{
					$output .= '<li><a href="#" data-sort-value="hits" class="mnwall-filter '.$hits_sort_active.'">'.\JText::_('COM_MINITEKWALL_HITS_SORTING').'</a></li>';
				}
			$output .= '</ul>';
		$output .= '</div>';

		if ($this->masonry_params['mas_sorting_direction'])
		{
			// Dropdown direction
			$output .= '<div class="mnwall_iso_dropdown">';
				$output .= '<div class="dropdown-label sorting-label">';
					$output .= '<span data-label="'.\JText::_('COM_MINITEKWALL_SORT_DIRECTION').'">';
						$output .= '<i class="fa fa-angle-down"></i><span>'.\JText::_('COM_MINITEKWALL_SORT_DIRECTION').'</span>';
					$output .= '</span>';
				$output .= '</div>';
				$output .= '<ul class="sorting-group sorting-group-direction">';
					$output .= '<li><a href="#" data-sort-value="asc" class="mnwall-filter '.$asc_dir_active.'">'.\JText::_('COM_MINITEKWALL_ASC').'</a></li>';
					$output .= '<li><a href="#" data-sort-value="desc" class="mnwall-filter '.$desc_dir_active.'">'.\JText::_('COM_MINITEKWALL_DESC').'</a></li>';
				$output .= '</ul>';
			$output .= '</div>';
		}
	}

echo $output;
