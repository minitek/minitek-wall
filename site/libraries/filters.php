<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibFilters
{
	public function getFiltersCss($masonry_params, $widgetID)
	{
		$document = \JFactory::getDocument();
		$mwall = 'mwall_container_'.$widgetID;
		$background_color = $masonry_params->get('mas_filters_bg', '#dd5f5f');
		$border_radius = (int) $masonry_params->get('mas_filters_border_radius', 3);

		$css = '
		#'.$mwall.' .mwall-buttons a {
			border-radius: '.$border_radius.'px;
		}
		#'.$mwall.' .mwall-buttons a.mwall-filter-active {
			background-color: '.$background_color.';
			border-color: '.$background_color.';
		}
		#'.$mwall.' .mwall-reset .btn-reset {
			border-radius: '.$border_radius.'px;
		}
		#'.$mwall.' .mwall-reset .btn-reset:hover,
		#'.$mwall.' .mwall-reset .btn-reset:focus {
			background-color: '.$background_color.';
			border-color: '.$background_color.';
		}

		#'.$mwall.' .mwall-dropdown .dropdown-label {
			border-radius: '.$border_radius.'px;
		}
		#'.$mwall.' .mwall-dropdown.expanded .dropdown-label {
			border-radius: '.$border_radius.'px '.$border_radius.'px 0 0;
			background-color: '.$background_color.';
			border-color: '.$background_color.';
		}
		#'.$mwall.' .mwall-dropdown ul li a.mwall-filter-active {
			color: '.$background_color.';
		}
		#'.$mwall.' .mwall-dropdown:hover .dropdown-label {
			color: '.$background_color.';
		}
		';

		$document->addStyleDeclaration( $css );
	}
}
