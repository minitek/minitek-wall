<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
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
		$background_color = $masonry_params['mas_filters_bg'];
		$border_radius = (int)$masonry_params['mas_filters_border_radius'];

		$css = '
		#'.$mwall.' .mwall_iso_buttons a {
			border-radius: '.$border_radius.'px;
		}
		#'.$mwall.' .mwall_iso_buttons a.mnw_filter_active {
			background-color: '.$background_color.';
			border-color: '.$background_color.';
		}
		#'.$mwall.' .mwall_iso_reset .btn-reset {
			border-radius: '.$border_radius.'px;
		}
		#'.$mwall.' .mwall_iso_reset .btn-reset:hover,
		#'.$mwall.' .mwall_iso_reset .btn-reset:focus {
			background-color: '.$background_color.';
			border-color: '.$background_color.';
		}

		#'.$mwall.' .mwall_iso_dropdown .dropdown-label {
			border-radius: '.$border_radius.'px;
		}
		#'.$mwall.' .mwall_iso_dropdown.expanded .dropdown-label {
			border-radius: '.$border_radius.'px '.$border_radius.'px 0 0;
			background-color: '.$background_color.';
			border-color: '.$background_color.';
		}
		#'.$mwall.' .mwall_iso_dropdown ul li a.mnw_filter_active {
			color: '.$background_color.';
		}
		#'.$mwall.' .mwall_iso_dropdown:hover .dropdown-label {
			color: '.$background_color.';
		}
		';

		$document->addStyleDeclaration( $css );
	}
}
