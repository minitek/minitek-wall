<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

// Active sorting direction
$asc_dir_active = '';
$desc_dir_active = '';

if ($this->active_direction == 'ASC')
{
	$asc_dir_active = 'mwall-filter-active';
}
else
{
	$desc_dir_active = 'mwall-filter-active';
}

// Active sorting
$title_sort_active = '';
$date_sort_active = '';
$hits_sort_active = '';

switch ($this->active_ordering)
{
	case 'title':
		$title_sort_active = 'mwall-filter-active';
		break;
	case 'date':
	case 'modified':
	case 'start':
	case 'finish':
		$date_sort_active = 'mwall-filter-active';
		break;
	case 'hits':
		$hits_sort_active = 'mwall-filter-active';
		break;
}

if ($this->masonry_params->get('mas_sorting_type', 1) == 1)
{
	// Inline sortings
	?><div class="mwall-sortings-group sorting-group sorting-group-filters mwall-buttons">
		<span><?php echo \JText::_('COM_MINITEKWALL_SORT_BY'); ?></span>
		<ul><?php 

			if ($this->masonry_params->get('mas_title_sorting', 1))
			{
				?><li>
					<a href="#" data-sort-value="title" class="mwall-filter <?php echo $title_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_TITLE'); 
					?></a>
				</li><?php 
			}

			if ($this->masonry_params->get('mas_date_sorting', 1))
			{
				$date_sort_value = in_array($this->active_ordering, ['modified', 'start', 'finish']) 
					? $this->active_ordering
					: 'date';

				?><li>
					<a href="#" data-sort-value="<?php echo $date_sort_value; ?>" class="mwall-filter <?php echo $date_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_DATE'); 
					?></a>
				</li><?php 
			}

			if ($this->masonry_params->get('mas_hits_sorting', 0))
			{
				?><li>
					<a href="#" data-sort-value="hits" class="mwall-filter <?php echo $hits_sort_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_HITS_SORTING'); 
					?></a>
				</li><?php
			}

		?></ul>
	</div><?php 

	if ($this->masonry_params->get('mas_sorting_direction', 0))
	{
		// Inline Direction
		?><div class="mwall-sortings-group sorting-group sorting-group-direction mwall-buttons">
			<span><?php echo JText::_('COM_MINITEKWALL_SORT_DIRECTION'); ?></span>
			<ul>
				<li>
					<a href="#" data-sort-value="asc" class="mwall-filter <?php echo $asc_dir_active; ?>"><?php
						echo JText::_('COM_MINITEKWALL_ASC');
					?></a>
				</li>
				<li>
					<a href="#" data-sort-value="desc" class="mwall-filter <?php echo $desc_dir_active; ?>"><?php 
						echo \JText::_('COM_MINITEKWALL_DESC'); 
					?></a>
				</li>
			</ul>
		</div><?php 
	}
}

if ($this->masonry_params->get('mas_sorting_type', 1) == 2)
{
	// Dropdown sortings
	?><div class="mwall-sortings-group">
		<div class="mwall-dropdown">
			<div class="dropdown-label sorting-label">
				<span data-label="<?php echo \JText::_('COM_MINITEKWALL_SORT_BY'); ?>">
					<i class="fa fa-angle-down"></i><span><?php 
						echo \JText::_('COM_MINITEKWALL_SORT_BY'); 
					?></span>
				</span>
			</div>
			<ul class="sorting-group sorting-group-filters"><?php 

				if ($this->masonry_params->get('mas_title_sorting', 1))
				{
					?><li>
						<a href="#" data-sort-value="title" class="mwall-filter <?php echo $title_sort_active; ?>"><?php 
							echo \JText::_('COM_MINITEKWALL_TITLE'); 
						?></a>
					</li><?php 
				}

				if ($this->masonry_params->get('mas_date_sorting', 1))
				{
					$date_sort_value = in_array($this->active_ordering, ['modified', 'start', 'finish']) 
						? $this->active_ordering
						: 'date';

					?><li>
						<a href="#" data-sort-value="<?php echo $date_sort_value; ?>" class="mwall-filter <?php echo $date_sort_active; ?>"><?php 
							echo \JText::_('COM_MINITEKWALL_DATE'); 
						?></a>
					</li><?php 
				}

				if ($this->masonry_params->get('mas_hits_sorting', 0))
				{
					?><li>
						<a href="#" data-sort-value="hits" class="mwall-filter <?php echo $hits_sort_active; ?>"><?php 
							echo \JText::_('COM_MINITEKWALL_HITS_SORTING'); 
						?></a>
					</li><?php 
				}
			?></ul>
		</div>
	</div><?php 

	if ($this->masonry_params->get('mas_sorting_direction', 0))
	{
		// Dropdown direction
		?><div class="mwall-sortings-group">
			<div class="mwall-dropdown">
				<div class="dropdown-label sorting-label">
					<span data-label="<?php echo \JText::_('COM_MINITEKWALL_SORT_DIRECTION'); ?>">
						<i class="fa fa-angle-down"></i><span><?php 
							echo \JText::_('COM_MINITEKWALL_SORT_DIRECTION'); 
						?></span>
					</span>
				</div>
				<ul class="sorting-group sorting-group-direction">
					<li>
						<a href="#" data-sort-value="asc" class="mwall-filter <?php echo $asc_dir_active; ?>"><?php 
							echo \JText::_('COM_MINITEKWALL_ASC'); 
						?></a>
					</li>
					<li>
						<a href="#" data-sort-value="desc" class="mwall-filter <?php echo $desc_dir_active; ?>"><?php 
							echo \JText::_('COM_MINITEKWALL_DESC'); 
						?></a>
					</li>
				</ul>
			</div>
		</div><?php 
	}
}
