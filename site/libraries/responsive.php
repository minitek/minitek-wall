<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibResponsive
{
	function __construct($utilitiesLib)
	{
		$this->utilitiesLib = $utilitiesLib;

		return;
	}
	
	public function masonryItemCss($masonry_params, $widgetID)
	{
		$utilities = new \MinitekWallLibUtilities;
		$document = \JFactory::getDocument();
		$mwall = 'mwall_items_'.$widgetID;
		$css = '';

		// Detail box text color - Columns/List
		if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'light-text')
			$db_color = '255,255,255';
		else if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'dark-text')
			$db_color = '0,0,0';
		else 
			$db_color = $utilities->hex2RGB($masonry_params->get('mas_db_color_columns', '#ffffff'), true);

		$css .= '
		#'.$mwall.' .mwall-detail-box h3.mwall-title a,
		#'.$mwall.' .mwall-detail-box h3.mwall-title span {
			color: rgba('.$db_color.', 0.9);
		}

		#'.$mwall.' .mwall-detail-box h3.mwall-title a:hover,
		#'.$mwall.' .mwall-detail-box h3.mwall-title a:focus {
			color: rgba('.$db_color.', 1);
		}

		#'.$mwall.' .mwall-detail-box .mwall-item-info {
			color: rgba('.$db_color.', 0.7);
		}

		#'.$mwall.' .mwall-detail-box .mwall-item-info a {
			color: rgba('.$db_color.', 0.8);
		}

		#'.$mwall.' .mwall-detail-box .mwall-item-info a:hover,
		#'.$mwall.' .mwall-detail-box .mwall-item-info a:focus {
			color: rgba('.$db_color.', 1);
			border-bottom: 1px dotted rgba('.$db_color.', 0.8);
		}

		#'.$mwall.' .mwall-detail-box .mwall-s-desc,
		#'.$mwall.' .mwall-detail-box .mwall-desc,
		#'.$mwall.' .mwall-detail-box .mwall-price,
		#'.$mwall.' .mwall-detail-box .mwall-hits,
		#'.$mwall.' .mwall-detail-box .mwall-count {
			color: rgba('.$db_color.', 0.8);
		}

		#'.$mwall.' .mwall-detail-box .mwall-date {
			color: rgba('.$db_color.', 0.7);
		}

		#'.$mwall.' .mwall-detail-box .mwall-readmore a {
			color: rgba('.$db_color.', 0.7);
			border: 1px solid rgba('.$db_color.', 0.7);
		}

		#'.$mwall.' .mwall-detail-box .mwall-readmore a:hover,
		#'.$mwall.' .mwall-detail-box .mwall-readmore a:focus {
			color: rgba('.$db_color.', 1);
			border: 1px solid rgba('.$db_color.', 1);
		}';

		// Detail box - Big
		if (!$masonry_params->get('mas_db_title_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_introtext_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_date_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_category_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_author_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_tags_big', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_hits_big', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_count_big', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_readmore_big', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Big
		if ($masonry_params->get('mas_db_color_big', '#ffffff') == 'light-text')
			$db_color_big = '255,255,255';
		else if ($masonry_params->get('mas_db_color_big', '#ffffff') == 'dark-text')
			$db_color_big = '0,0,0';
		else 
			$db_color_big = $utilities->hex2RGB($masonry_params->get('mas_db_color_big', '#ffffff'), true);

		$css .= '
		#'.$mwall.' .mwall-big .mwall-detail-box h3.mwall-title a,
		#'.$mwall.' .mwall-big .mwall-detail-box h3.mwall-title span {
			color: rgba('.$db_color_big.', 0.9);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box h3.mwall-title a:hover,
		#'.$mwall.' .mwall-big .mwall-detail-box h3.mwall-title a:focus {
			color: rgba('.$db_color_big.', 1);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-info {
			color: rgba('.$db_color_big.', 0.7);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-info a {
			color: rgba('.$db_color_big.', 0.8);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-info a:hover,
		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-info a:focus {
			color: rgba('.$db_color_big.', 1);
			border-bottom: 1px dotted rgba('.$db_color_big.', 0.8);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-s-desc,
		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-desc,
		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-price,
		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-hits,
		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-count {
			color: rgba('.$db_color_big.', 0.8);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-date {
			color: rgba('.$db_color_big.', 0.7);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-readmore a {
			color: rgba('.$db_color_big.', 0.7);
			border: 1px solid rgba('.$db_color_big.', 0.7);
		}

		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-readmore a:hover,
		#'.$mwall.' .mwall-big .mwall-detail-box .mwall-readmore a:focus {
			color: rgba('.$db_color_big.', 1);
			border: 1px solid rgba('.$db_color_big.', 1);
		}';

		// Images and dimensions - Big
		$bg_big = $utilities->hex2RGB($masonry_params->get('mas_db_bg_big', '#dd5f5f'), true);
		$bg_opacity_big = !$masonry_params->get('mas_full_width_image', 1) && $masonry_params->get('mas_db_position_big', 'left') != 'cover'
			? 1 
			: number_format((float)$masonry_params->get('mas_db_bg_opacity_big', 0.75), 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-big .mwall-item-inner-cont {	
			background-color: rgba('.$bg_big.','.$bg_opacity_big.');
		}';

		if ($masonry_params->get('mas_db_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-item-inner {	
				background-color: rgba('.$bg_big.','.$bg_opacity_big.');
			}';

			if ($masonry_params->get('mas_db_position_big', 'left') == 'left')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-big .mwall-photo-link {	
						right: 0;
						left: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-big .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					left: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_big', 'left') == 'right')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-big .mwall-photo-link {	
						left: 0;
						right: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-big .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					right: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_big', 'left') == 'top')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-big .mwall-photo-link {	
						right: 0;
						left: 0;
						top: auto;
						bottom: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-big .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					top: 0;
					height: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_big', 'left') == 'bottom')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-big .mwall-photo-link {	
						right: 0;
						left: 0;
						bottom: auto;
						top: 0;
						height: 50%;
					}';
				}

				$css .= '
				#'.$mwall.' .mwall-big .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					bottom: 0;
					top: auto;
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params->get('mas_db_big', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-item-inner {
				display: none;
			}

			#'.$mwall.' .mwall-big .mwall-item-inner.mwall-no-image {
				display: block;
				background-color: rgba('.$bg_big.','.$bg_opacity_big.');
			}';
		}

		// Detail box - Landscape 
		if (!$masonry_params->get('mas_db_title_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_introtext_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_date_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_category_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_author_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_tags_lscape', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_hits_lscape', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_count_lscape', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_readmore_lscape', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Landscape
		if ($masonry_params->get('mas_db_color_lscape', '#ffffff') == 'light-text')
			$db_color_lscape = '255,255,255';
		else if ($masonry_params->get('mas_db_color_lscape', '#ffffff') == 'dark-text')
			$db_color_lscape = '0,0,0';
		else 
			$db_color_lscape = $utilities->hex2RGB($masonry_params->get('mas_db_color_lscape', '#ffffff'), true);

		$css .= '
		#'.$mwall.' .mwall-horizontal .mwall-detail-box h3.mwall-title a,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box h3.mwall-title span {
			color: rgba('.$db_color_lscape.', 0.9);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box h3.mwall-title a:hover,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box h3.mwall-title a:focus {
			color: rgba('.$db_color_lscape.', 1);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-info {
			color: rgba('.$db_color_lscape.', 0.7);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-info a {
			color: rgba('.$db_color_lscape.', 0.8);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-info a:hover,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-info a:focus {
			color: rgba('.$db_color_lscape.', 1);
			border-bottom: 1px dotted rgba('.$db_color_lscape.', 0.8);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-s-desc,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-desc,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-price,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-hits,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-count {
			color: rgba('.$db_color_lscape.', 0.8);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-date {
			color: rgba('.$db_color_lscape.', 0.7);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-readmore a {
			color: rgba('.$db_color_lscape.', 0.7);
			border: 1px solid rgba('.$db_color_lscape.', 0.7);
		}

		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-readmore a:hover,
		#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-readmore a:focus {
			color: rgba('.$db_color_lscape.', 1);
			border: 1px solid rgba('.$db_color_lscape.', 1);
		}';
		
		// Images and dimensions - Landscape
		$bg_lscape = $utilities->hex2RGB($masonry_params->get('mas_db_bg_lscape', '#1b98e0'), true);
		$bg_opacity_lscape = !$masonry_params->get('mas_full_width_image', 1) && $masonry_params->get('mas_db_position_lscape', 'left') != 'cover'
			? 1
			: number_format((float)$masonry_params->get('mas_db_bg_opacity_lscape', 0.75), 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-horizontal .mwall-item-inner-cont {	
			background-color: rgba('.$bg_lscape.','.$bg_opacity_lscape.');
		}';

		if ($masonry_params->get('mas_db_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-item-inner {	
				background-color: rgba('.$bg_lscape.','.$bg_opacity_lscape.');
			}';

			if ($masonry_params->get('mas_db_position_lscape', 'left') == 'left')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-horizontal .mwall-photo-link {	
						right: 0;
						left: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-horizontal .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					left: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_lscape', 'left') == 'right')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-horizontal .mwall-photo-link {	
						left: 0;
						right: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-horizontal .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					right: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_lscape', 'left') == 'top')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-horizontal .mwall-photo-link {	
						right: 0;
						left: 0;
						top: auto;
						bottom: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-horizontal .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					top: 0;
					height: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_lscape', 'left') == 'bottom')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-horizontal .mwall-photo-link {	
						right: 0;
						left: 0;
						bottom: auto;
						top: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-horizontal .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					bottom: 0;
					top: auto;
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params->get('mas_db_lscape', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-item-inner {
				display: none;
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-inner.mwall-no-image {
				display: block;
				background-color: rgba('.$bg_lscape.','.$bg_opacity_lscape.');
			}';
		}

		// Detail box - Portrait 
		if (!$masonry_params->get('mas_db_title_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_introtext_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_date_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_category_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_author_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_tags_portrait', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_hits_portrait', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_count_portrait', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_readmore_portrait', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Portrait
		if ($masonry_params->get('mas_db_color_portrait', '#ffffff') == 'light-text')
			$db_color_portrait = '255,255,255';
		else if ($masonry_params->get('mas_db_color_portrait', '#ffffff') == 'dark-text')
			$db_color_portrait = '0,0,0';
		else 
			$db_color_portrait = $utilities->hex2RGB($masonry_params->get('mas_db_color_portrait', '#ffffff'), true);

		$css .= '
		#'.$mwall.' .mwall-vertical .mwall-detail-box h3.mwall-title a,
		#'.$mwall.' .mwall-vertical .mwall-detail-box h3.mwall-title span {
			color: rgba('.$db_color_portrait.', 0.9);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box h3.mwall-title a:hover,
		#'.$mwall.' .mwall-vertical .mwall-detail-box h3.mwall-title a:focus {
			color: rgba('.$db_color_portrait.', 1);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-info {
			color: rgba('.$db_color_portrait.', 0.7);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-info a {
			color: rgba('.$db_color_portrait.', 0.8);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-info a:hover,
		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-info a:focus {
			color: rgba('.$db_color_portrait.', 1);
			border-bottom: 1px dotted rgba('.$db_color_portrait.', 0.8);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-s-desc,
		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-desc,
		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-price,
		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-hits,
		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-count {
			color: rgba('.$db_color_portrait.', 0.8);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-date {
			color: rgba('.$db_color_portrait.', 0.7);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-readmore a {
			color: rgba('.$db_color_portrait.', 0.7);
			border: 1px solid rgba('.$db_color_portrait.', 0.7);
		}

		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-readmore a:hover,
		#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-readmore a:focus {
			color: rgba('.$db_color_portrait.', 1);
			border: 1px solid rgba('.$db_color_portrait.', 1);
		}';

		// Images and dimensions - Portrait
		$bg_portrait = $utilities->hex2RGB($masonry_params->get('mas_db_bg_portrait', '#e66eb8'), true);
		$bg_opacity_portrait = !$masonry_params->get('mas_full_width_image', 1) && $masonry_params->get('mas_db_position_portrait', 'bottom') != 'cover'
			? 1
			: number_format((float)$masonry_params->get('mas_db_bg_opacity_portrait', 0.75), 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-vertical .mwall-item-inner-cont {	
			background-color: rgba('.$bg_portrait.','.$bg_opacity_portrait.');
		}';

		if ($masonry_params->get('mas_db_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-item-inner {	
				background-color: rgba('.$bg_portrait.','.$bg_opacity_portrait.');
			}';

			if ($masonry_params->get('mas_db_position_portrait', 'bottom') == 'left')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-vertical .mwall-photo-link {	
						right: 0;
						left: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-vertical .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					left: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_portrait', 'bottom') == 'right')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-vertical .mwall-photo-link {	
						left: 0;
						right: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-vertical .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					right: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_portrait', 'bottom') == 'top')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-vertical .mwall-photo-link {	
						right: 0;
						left: 0;
						top: auto;
						bottom: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-vertical .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					top: 0;
					height: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_portrait', 'bottom') == 'bottom')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-vertical .mwall-photo-link {	
						right: 0;
						left: 0;
						bottom: auto;
						top: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-vertical .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					bottom: 0;
					top: auto;
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params->get('mas_db_portrait', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-item-inner {
				display: none;
			}

			#'.$mwall.' .mwall-vertical .mwall-item-inner.mwall-no-image {
				display: block;
				background-color: rgba('.$bg_portrait.','.$bg_opacity_portrait.');
			}';
		}

		// Detail box - Small
		if (!$masonry_params->get('mas_db_title_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_introtext_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_date_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_category_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_author_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_tags_small', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_hits_small', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_count_small', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params->get('mas_db_readmore_small', 0))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Small
		if ($masonry_params->get('mas_db_color_small', '#ffffff') == 'light-text')
			$db_color_small = '255,255,255';
		else if ($masonry_params->get('mas_db_color_small', '#ffffff') == 'dark-text')
			$db_color_small = '0,0,0';
		else 
			$db_color_small = $utilities->hex2RGB($masonry_params->get('mas_db_color_small', '#ffffff'), true);

		$css .= '
		#'.$mwall.' .mwall-small .mwall-detail-box h3.mwall-title a,
		#'.$mwall.' .mwall-small .mwall-detail-box h3.mwall-title span {
			color: rgba('.$db_color_small.', 0.9);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box h3.mwall-title a:hover,
		#'.$mwall.' .mwall-small .mwall-detail-box h3.mwall-title a:focus {
			color: rgba('.$db_color_small.', 1);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-info {
			color: rgba('.$db_color_small.', 0.7);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-info a {
			color: rgba('.$db_color_small.', 0.8);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-info a:hover,
		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-info a:focus {
			color: rgba('.$db_color_small.', 1);
			border-bottom: 1px dotted rgba('.$db_color_small.', 0.8);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-s-desc,
		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-desc,
		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-price,
		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-hits,
		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-count {
			color: rgba('.$db_color_small.', 0.8);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-date {
			color: rgba('.$db_color_small.', 0.7);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-readmore a {
			color: rgba('.$db_color_small.', 0.7);
			border: 1px solid rgba('.$db_color_small.', 0.7);
		}

		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-readmore a:hover,
		#'.$mwall.' .mwall-small .mwall-detail-box .mwall-readmore a:focus {
			color: rgba('.$db_color_small.', 1);
			border: 1px solid rgba('.$db_color_small.', 1);
		}';
		
		// Images and dimensions - Small
		$bg_small = $utilities->hex2RGB($masonry_params->get('mas_db_bg_small', '#24a9b7'), true);
		$bg_opacity_small = !$masonry_params->get('mas_full_width_image', 1) && $masonry_params->get('mas_db_position_small', 'cover') != 'cover'
			? 1
			: number_format((float)$masonry_params->get('mas_db_bg_opacity_small', 0.75), 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-small .mwall-item-inner-cont {	
			background-color: rgba('.$bg_small.','.$bg_opacity_small.');
		}';

		if ($masonry_params->get('mas_db_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-inner {	
				background-color: rgba('.$bg_small.','.$bg_opacity_small.');
			}';

			if ($masonry_params->get('mas_db_position_small', 'cover') == 'left')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-small .mwall-photo-link {	
						right: 0;
						left: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-small .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					left: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_small', 'cover') == 'right')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-small .mwall-photo-link {	
						left: 0;
						right: auto;
						top: 0;
						bottom: 0;
						width: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-small .mwall-item-outer-cont .mwall-item-inner {
					bottom: 0;
					right: 0;
					top: 0;
					width: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_small', 'cover') == 'top')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-small .mwall-photo-link {	
						right: 0;
						left: 0;
						top: auto;
						bottom: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-small .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					top: 0;
					height: 50%;
				}';
			}
			else if ($masonry_params->get('mas_db_position_small', 'cover') == 'bottom')
			{
				if (!$masonry_params->get('mas_full_width_image', 1))
				{
					$css .= '
					#'.$mwall.' .mwall-small .mwall-photo-link {	
						right: 0;
						left: 0;
						bottom: auto;
						top: 0;
						height: 50%;
					}';
				}
				
				$css .= '
				#'.$mwall.' .mwall-small .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					bottom: 0;
					top: auto;
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params->get('mas_db_small', 1))
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-inner {
				display: none;
			}

			#'.$mwall.' .mwall-small .mwall-item-inner.mwall-no-image {
				display: block !important;
				background-color: rgba('.$bg_small.','.$bg_opacity_small.');
			}';
		}

		// Hover box text color
		if ($masonry_params->get('mas_hb_text_color', '#ffffff') == '2')
			$hb_color = '255,255,255';
		else if ($masonry_params->get('mas_hb_text_color', '#ffffff') == '1')
			$hb_color = '0,0,0';
		else 
			$hb_color = $utilities->hex2RGB($masonry_params->get('mas_hb_text_color', '#ffffff'), true);

		$css .= '
		#'.$mwall.' .mwall-hover-box h3.mwall-title a,
		#'.$mwall.' .mwall-hover-box h3.mwall-title span {
			color: rgba('.$hb_color.', 0.9);
		}

		#'.$mwall.' .mwall-hover-box h3.mwall-title a:hover,
		#'.$mwall.' .mwall-hover-box h3.mwall-title a:focus {
			color: rgba('.$hb_color.', 1);
		}

		#'.$mwall.' .mwall-hover-box .mwall-item-info {
			color: rgba('.$hb_color.', 0.7);
		}

		#'.$mwall.' .mwall-hover-box .mwall-item-info a {
			color: rgba('.$hb_color.', 0.8);
		}

		#'.$mwall.' .mwall-hover-box .mwall-item-info a:hover,
		#'.$mwall.' .mwall-hover-box .mwall-item-info a:focus {
			color: rgba('.$hb_color.', 1);
			border-bottom: 1px dotted rgba('.$hb_color.', 0.8);
		}

		#'.$mwall.' .mwall-hover-box .mwall-s-desc,
		#'.$mwall.' .mwall-hover-box .mwall-desc,
		#'.$mwall.' .mwall-hover-box .mwall-price,
		#'.$mwall.' .mwall-hover-box .mwall-hits,
		#'.$mwall.' .mwall-hover-box .mwall-count {
			color: rgba('.$hb_color.', 0.8);
		}

		#'.$mwall.' .mwall-hover-box .mwall-date {
			color: rgba('.$hb_color.', 0.7);
		}

		#'.$mwall.' .mwall-hover-box .mwall-readmore a {
			color: rgba('.$hb_color.', 0.7);
			border: 1px solid rgba('.$hb_color.', 0.7);
		}

		#'.$mwall.' .mwall-hover-box .mwall-readmore a:hover,
		#'.$mwall.' .mwall-hover-box .mwall-readmore a:focus {
			color: rgba('.$hb_color.', 1);
			border: 1px solid rgba('.$hb_color.', 1);
		}';

		$document->addStyleDeclaration($css);
	}

	public function loadResponsiveMasonry($masonry_params, $widgetID)
	{
		$utilities = new \MinitekWallLibUtilities;
		$document = \JFactory::getDocument();
		$mwall = 'mwall_items_'.$widgetID;
		$css = '';

		// Responsive settings
		$responsive_lg = (int)$masonry_params->get('mas_responsive_lg', 1139);
		$responsive_lg_min = $responsive_lg - 1;
		$lg_cell_height = '240';
		$lg_cell_height = (int)$masonry_params->get('mas_lg_cell_height', 240);
		$md_type = $masonry_params->get('mas_md_type', 0);
		$responsive_md_num = (int)$masonry_params->get('mas_responsive_md_num', 3);
		$responsive_md = (int)$masonry_params->get('mas_responsive_md', 939);
		$responsive_md_min = $responsive_md - 1;
		$md_cell_height = '240';
		$md_hide_images = $masonry_params->get('mas_md_hide_images', 0);
		$md_cell_height = (int)$masonry_params->get('mas_md_cell_height', 240);
		$sm_type = $masonry_params->get('mas_sm_type', 1);
		$responsive_sm_num = (int)$masonry_params->get('mas_responsive_sm_num', 2);
		$responsive_sm = (int)$masonry_params->get('mas_responsive_sm', 719);
		$responsive_sm_min = $responsive_sm - 1;
		$sm_cell_height = '240';
		$sm_hide_images = $masonry_params->get('mas_sm_hide_images', 0);
		$sm_cell_height = (int)$masonry_params->get('mas_sm_cell_height', 240);
		$xs_type = $masonry_params->get('mas_xs_type', 1);
		$responsive_xs_num = (int)$masonry_params->get('mas_responsive_xs_num', 2);
		$responsive_xs = (int)$masonry_params->get('mas_responsive_xs', 479);
		$responsive_xs_min = $responsive_xs - 1;
		$xs_cell_height = '240';
		$xs_hide_images = $masonry_params->get('mas_xs_hide_images', 0);
		$xs_cell_height = (int)$masonry_params->get('mas_xs_cell_height', 240);
		$xxs_type = $masonry_params->get('mas_xxs_type', 1);
		$responsive_xxs_num = (int)$masonry_params->get('mas_responsive_xxs_num', 1);
		$xxs_cell_height = '240';
		$xxs_hide_images = $masonry_params->get('mas_xxs_hide_images', 0);
		$xxs_cell_height = (int)$masonry_params->get('mas_xxs_cell_height', 240);
		$detail_box_column = $masonry_params->get('mas_db_columns', 1);
		$show_title_column = $masonry_params->get('mas_db_title_columns', 1);
		$show_introtext_column = $masonry_params->get('mas_db_introtext_columns', 1);
		$show_date_column = $masonry_params->get('mas_db_date_columns', 1);
		$show_category_column = $masonry_params->get('mas_db_category_columns', 1);
		$show_author_column = $masonry_params->get('mas_db_author_columns', 1);
		$show_tags_column = $masonry_params->get('mas_db_tags_columns', 0);
		$show_hits_column = $masonry_params->get('mas_db_hits_columns', 0);
		$show_count_column = $masonry_params->get('mas_db_count_columns', 0);
		$show_readmore_column = $masonry_params->get('mas_db_readmore_columns', 0);
		$bg_columns = $utilities->hex2RGB($masonry_params->get('mas_db_bg_columns', '#1b98e0'), true);
		$bg_opacity_columns = number_format((float)$masonry_params->get('mas_db_bg_opacity_columns', 0.75), 2, '.', '');

		// Media CSS - Large
		$css .= '@media only screen and (min-width:'.$responsive_lg.'px)
		{';
			$css .= '
			#'.$mwall.' .mwall-big {
				height: '.(2*$lg_cell_height).'px;
			}
			#'.$mwall.' .mwall-horizontal {
				height: '.($lg_cell_height).'px;
			}
			#'.$mwall.' .mwall-vertical {
				height: '.(2*$lg_cell_height).'px;
			}
			#'.$mwall.' .mwall-small {
				height: '.($lg_cell_height).'px;
			}';
			
			if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
			{
				$css .= '
				.mwall-columns #'.$mwall.' .mwall-photo-link {
					height: '.$lg_cell_height.'px !important;
				}';
			}
		$css .= '
		}';

		// Media CSS - Medium
		if (!$md_type)
		{
			$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{';
				$css .= '
				#'.$mwall.' .mwall-big {
					height: '.(2*$md_cell_height).'px;
				}
				#'.$mwall.' .mwall-horizontal {
					height: '.($md_cell_height).'px;
				}
				#'.$mwall.' .mwall-vertical {
					height: '.(2*$md_cell_height).'px;
				}
				#'.$mwall.' .mwall-small {
					height: '.($md_cell_height).'px;
				}

				#'.$mwall.' .mwall-big .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-big .mwall-item-inner .mwall-title span {
					font-size: 24px;
					line-height: 28px;
				}
				#'.$mwall.' .mwall-horizontal .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-horizontal .mwall-item-inner .mwall-title span,
				#'.$mwall.' .mwall-vertical .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-vertical .mwall-item-inner .mwall-title span,
				#'.$mwall.' .mwall-small .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-small .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 20px;
				}';

				if ($masonry_params->get('mas_grid', 7) == '98o')
				{
					if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
					{
						$css .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$md_cell_height.'px !important;
						}';
					}
				}
			$css .= '
			}';
		}
		
		// Media CSS - Medium - Equal columns
		if ($md_type)
		{
			$items_width = number_format((float)(100 / $responsive_md_num), 2, '.', '');
			
			$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{ ';
				if ($masonry_params->get('mas_grid', 7) != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}
					#'.$mwall.' .mwall-item-inner-cont {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params->get('mas_db_position_columns', 'below') == 'below')
				{
					$css .= '
					#'.$mwall.' .mwall-item {
						height: auto !important;
					}
					#'.$mwall.' .mwall-item-inner {
						position: static;
						width: 100% !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						z-index: 1;
						width: 100%;
						position: relative;
						display: flex;
						justify-content: center;
						align-items: center;
						overflow: hidden;
						height: '.$md_cell_height.'px !important;
					}';
				} 
				else 
				{
					$css .= '
					.mwall-masonry #'.$mwall.' .mwall-item {
						height: '.$md_cell_height.'px !important;
					}
					#'.$mwall.' .mwall-item-inner {
						width: 100% !important;
						top: auto !important;
						bottom: 0 !important;
						left: 0 !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						width: 100%;
						height: 100%;
					}';

					if ($masonry_params->get('mas_db_position_columns', 'below') == 'bottom')
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
				{
					$css .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$md_cell_height.'px !important;
					}';
				}

				$css .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 24px;
				}';

				// Detail box text color
				if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params->get('mas_db_color_columns', '#ffffff'), true);

				$css .= '
				#'.$mwall.' .mwall-detail-box h3.mwall-title a,
				#'.$mwall.' .mwall-detail-box h3.mwall-title span {
					color: rgba('.$db_color.', 0.9) !important;
				}

				#'.$mwall.' .mwall-detail-box h3.mwall-title a:hover,
				#'.$mwall.' .mwall-detail-box h3.mwall-title a:focus {
					color: rgba('.$db_color.', 1) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-item-info a:focus {
					color: rgba('.$db_color.', 1) !important;
					border-bottom: 1px dotted rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-s-desc,
				#'.$mwall.' .mwall-detail-box .mwall-desc,
				#'.$mwall.' .mwall-detail-box .mwall-price,
				#'.$mwall.' .mwall-detail-box .mwall-hits,
				#'.$mwall.' .mwall-detail-box .mwall-count {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-date {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a {
					color: rgba('.$db_color.', 0.7) !important;
					border: 1px solid rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-readmore a:focus {
					color: rgba('.$db_color.', 1) !important;
					border: 1px solid rgba('.$db_color.', 1) !important;
				}';

				// Hide media
				if ($md_hide_images) 
				{
					$css .= '
					#'.$mwall.' .mwall-cover,
					#'.$mwall.' .mwall-photo-link,
					#'.$mwall.' .mwall-item-video {
						display: none !important;
					}';
				}
			$css .= '}';

			if ($detail_box_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}

			if ($show_title_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			if ($show_introtext_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			if ($show_date_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			if ($show_category_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			if ($show_author_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			if ($show_tags_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			if ($show_hits_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			if ($show_count_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			if ($show_readmore_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}
		}

		// Media CSS - Small
		if (!$sm_type)
		{
			$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{';
				$css .= '
				#'.$mwall.' .mwall-big {
					height: '.(2*$sm_cell_height).'px;
				}
				#'.$mwall.' .mwall-horizontal {
					height: '.($sm_cell_height).'px;
				}
				#'.$mwall.' .mwall-vertical {
					height: '.(2*$sm_cell_height).'px;
				}
				#'.$mwall.' .mwall-small {
					height: '.($sm_cell_height).'px;
				}

				#'.$mwall.' .mwall-big .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-big .mwall-item-inner .mwall-title span {
					font-size: 22px;
					line-height: 26px;
				}
				#'.$mwall.' .mwall-horizontal .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-horizontal .mwall-item-inner .mwall-title span,
				#'.$mwall.' .mwall-vertical .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-vertical .mwall-item-inner .mwall-title span,
				#'.$mwall.' .mwall-small .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-small .mwall-item-inner .mwall-title span {
					font-size: 17px;
					line-height: 20px;
				}';

				if ($masonry_params->get('mas_grid') == '98o')
				{
					if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
					{
						$css .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$sm_cell_height.'px !important;
						}';
					}
				}
			$css .= '
			}';
		}

		// Media CSS - Small - Equal columns
		if ($sm_type)
		{
			$items_width = number_format((float)(100 / $responsive_sm_num), 2, '.', '');
			
			$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{ ';
				if ($masonry_params->get('mas_grid', 7) != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}
					#'.$mwall.' .mwall-item-inner-cont {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params->get('mas_db_position_columns', 'below') == 'below')
				{
					$css .= '
					#'.$mwall.' .mwall-item {
						height: auto !important;
					}
					#'.$mwall.' .mwall-item-inner {
						position: static;
						width: 100% !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						z-index: 1;
						width: 100%;
						position: relative;
						display: flex;
						justify-content: center;
						align-items: center;
						overflow: hidden;
						height: '.$sm_cell_height.'px !important;
					}';
				} 
				else 
				{
					$css .= '
					.mwall-masonry #'.$mwall.' .mwall-item {
						height: '.$sm_cell_height.'px !important;
					}
					#'.$mwall.' .mwall-item-inner {
						width: 100% !important;
						top: auto !important;
						bottom: 0 !important;
						left: 0 !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						width: 100%;
						height: 100%;
					}';

					if ($masonry_params->get('mas_db_position_columns', 'below') == 'bottom')
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
				{
					$css .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$sm_cell_height.'px !important;
					}';
				}

				$css .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px !important;
					line-height: 24px;
				}';

				// Detail box text color
				if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params->get('mas_db_color_columns', '#ffffff'), true);

				$css .= '
				#'.$mwall.' .mwall-detail-box h3.mwall-title a,
				#'.$mwall.' .mwall-detail-box h3.mwall-title span {
					color: rgba('.$db_color.', 0.9) !important;
				}

				#'.$mwall.' .mwall-detail-box h3.mwall-title a:hover,
				#'.$mwall.' .mwall-detail-box h3.mwall-title a:focus {
					color: rgba('.$db_color.', 1) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-item-info a:focus {
					color: rgba('.$db_color.', 1) !important;
					border-bottom: 1px dotted rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-s-desc,
				#'.$mwall.' .mwall-detail-box .mwall-desc,
				#'.$mwall.' .mwall-detail-box .mwall-price,
				#'.$mwall.' .mwall-detail-box .mwall-hits,
				#'.$mwall.' .mwall-detail-box .mwall-count {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-date {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a {
					color: rgba('.$db_color.', 0.7) !important;
					border: 1px solid rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-readmore a:focus {
					color: rgba('.$db_color.', 1) !important;
					border: 1px solid rgba('.$db_color.', 1) !important;
				}';

				// Hide media
				if ($sm_hide_images) 
				{
					$css .= '
					#'.$mwall.' .mwall-cover,
					#'.$mwall.' .mwall-photo-link,
					#'.$mwall.' .mwall-item-video {
						display: none !important;
					}';
				}
			$css .= '}';

			if ($detail_box_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}

			if ($show_title_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			if ($show_introtext_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			if ($show_date_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			if ($show_category_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			if ($show_author_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			if ($show_tags_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			if ($show_hits_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			if ($show_count_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			if ($show_readmore_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}
		}

		// Media CSS - Extra small
		if (!$xs_type)
		{
			$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{';
				$css .= '
				#'.$mwall.' .mwall-big {
					height: '.(2*$xs_cell_height).'px;
				}
				#'.$mwall.' .mwall-horizontal {
					height: '.($xs_cell_height).'px;
				}
				#'.$mwall.' .mwall-vertical {
					height: '.(2*$xs_cell_height).'px;
				}
				#'.$mwall.' .mwall-small {
					height: '.($xs_cell_height).'px;
				}

				#'.$mwall.' .mwall-photo-link {
					width: 100% !important;
					height: 100% !important;
				}';

				if ($masonry_params->get('mas_grid') == '98o')
				{
					if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
					{
						$css .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$xs_cell_height.'px !important;
						}';
					}
				}
			$css .= '
			}';
		}

		// Media CSS - Extra small - Equal columns
		if ($xs_type)
		{
			$items_width = number_format((float)(100 / $responsive_xs_num), 2, '.', '');
			
			$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{ ';
				if ($masonry_params->get('mas_grid', 7) != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}
					#'.$mwall.' .mwall-item-inner-cont {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params->get('mas_db_position_columns', 'below') == 'below')
				{
					$css .= '
					#'.$mwall.' .mwall-item {
						height: auto !important;
					}
					#'.$mwall.' .mwall-item-inner {
						position: static;
						width: 100% !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						z-index: 1;
						width: 100%;
						position: relative;
						display: flex;
						justify-content: center;
						align-items: center;
						overflow: hidden;
						height: '.$xs_cell_height.'px !important;
					}';
				} 
				else 
				{
					$css .= '
					.mwall-masonry #'.$mwall.' .mwall-item {
						height: '.$xs_cell_height.'px !important;
					}
					#'.$mwall.' .mwall-item-inner {
						width: 100% !important;
						top: auto !important;
						bottom: 0 !important;
						left: 0 !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						width: 100%;
						height: 100%;
					}';

					if ($masonry_params->get('mas_db_position_columns', 'below') == 'bottom')
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
				{
					$css .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$xs_cell_height.'px !important;
					}';
				}

				$css .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 24px;
				}';

				// Detail box text color
				if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params->get('mas_db_color_columns', '#ffffff'), true);

				$css .= '
				#'.$mwall.' .mwall-detail-box h3.mwall-title a,
				#'.$mwall.' .mwall-detail-box h3.mwall-title span {
					color: rgba('.$db_color.', 0.9) !important;
				}

				#'.$mwall.' .mwall-detail-box h3.mwall-title a:hover,
				#'.$mwall.' .mwall-detail-box h3.mwall-title a:focus {
					color: rgba('.$db_color.', 1) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-item-info a:focus {
					color: rgba('.$db_color.', 1) !important;
					border-bottom: 1px dotted rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-s-desc,
				#'.$mwall.' .mwall-detail-box .mwall-desc,
				#'.$mwall.' .mwall-detail-box .mwall-price,
				#'.$mwall.' .mwall-detail-box .mwall-hits,
				#'.$mwall.' .mwall-detail-box .mwall-count {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-date {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a {
					color: rgba('.$db_color.', 0.7) !important;
					border: 1px solid rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-readmore a:focus {
					color: rgba('.$db_color.', 1) !important;
					border: 1px solid rgba('.$db_color.', 1) !important;
				}';

				// Hide media
				if ($xs_hide_images) 
				{
					$css .= '
					#'.$mwall.' .mwall-cover,
					#'.$mwall.' .mwall-photo-link,
					#'.$mwall.' .mwall-item-video {
						display: none !important;
					}';
				}
			$css .= '}';

			if ($detail_box_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}
			
			if ($show_title_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			if ($show_introtext_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			if ($show_date_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			if ($show_category_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			if ($show_author_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			if ($show_tags_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			if ($show_hits_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			if ($show_count_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			if ($show_readmore_column) 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}
		}

		// Media CSS - Extra extra small
		if (!$xxs_type)
		{
			$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{';
				$css .= '
				#'.$mwall.' .mwall-big {
					height: '.(2*$xxs_cell_height).'px;
				}
				#'.$mwall.' .mwall-horizontal {
					height: '.($xxs_cell_height).'px;
				}
				#'.$mwall.' .mwall-vertical {
					height: '.(2*$xxs_cell_height).'px;
				}
				#'.$mwall.' .mwall-small {
					height: '.($xxs_cell_height).'px;
				}

				#'.$mwall.' .mwall-photo-link {
					width: 100% !important;
					height: 100% !important;
				}';

				if ($masonry_params->get('mas_grid', 7) == '98o')
				{
					if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
					{
						$css .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$xxs_cell_height.'px !important;
						}';
					}
				}
			$css .= '
			}';
		}

		// Media CSS - Extra extra small - Equal columns
		if ($xxs_type)
		{
			$items_width = number_format((float)(100 / $responsive_xxs_num), 2, '.', '');
			
			$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{ ';
				if ($masonry_params->get('mas_grid', 7) != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}
					#'.$mwall.' .mwall-item-inner-cont {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params->get('mas_db_position_columns', 'below') == 'below')
				{
					$css .= '
					#'.$mwall.' .mwall-item {
						height: auto !important;
					}
					#'.$mwall.' .mwall-item-inner {
						position: static;
						width: 100% !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						z-index: 1;
						width: 100%;
						position: relative;
						display: flex;
						justify-content: center;
						align-items: center;
						overflow: hidden;
						height: '.$xxs_cell_height.'px !important;
					}';
				} 
				else 
				{
					$css .= '
					.mwall-masonry #'.$mwall.' .mwall-item {
						height: '.$xxs_cell_height.'px !important;
					}
					#'.$mwall.' .mwall-item-inner {
						width: 100% !important;
						top: auto !important;
						bottom: 0 !important;
						left: 0 !important;
					}
					.mwall-masonry #'.$mwall.' .mwall-item-outer-cont .mwall-photo-link {
						width: 100%;
						height: 100%;
					}';

					if ($masonry_params->get('mas_db_position_columns', 'below') == 'bottom')
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$css .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if (!$masonry_params->get('mas_preserve_aspect_ratio', 0))
				{
					$css .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$xxs_cell_height.'px !important;
					}
					';
				}

				$css .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 24px;
				}';

				// Detail box text color
				if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params->get('mas_db_color_columns', '#ffffff') == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params->get('mas_db_color_columns', '#ffffff'), true);

				$css .= '
				#'.$mwall.' .mwall-detail-box h3.mwall-title a,
				#'.$mwall.' .mwall-detail-box h3.mwall-title span {
					color: rgba('.$db_color.', 0.9) !important;
				}

				#'.$mwall.' .mwall-detail-box h3.mwall-title a:hover,
				#'.$mwall.' .mwall-detail-box h3.mwall-title a:focus {
					color: rgba('.$db_color.', 1) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-item-info a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-item-info a:focus {
					color: rgba('.$db_color.', 1) !important;
					border-bottom: 1px dotted rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-s-desc,
				#'.$mwall.' .mwall-detail-box .mwall-desc,
				#'.$mwall.' .mwall-detail-box .mwall-price,
				#'.$mwall.' .mwall-detail-box .mwall-hits,
				#'.$mwall.' .mwall-detail-box .mwall-count {
					color: rgba('.$db_color.', 0.8) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-date {
					color: rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a {
					color: rgba('.$db_color.', 0.7) !important;
					border: 1px solid rgba('.$db_color.', 0.7) !important;
				}

				#'.$mwall.' .mwall-detail-box .mwall-readmore a:hover,
				#'.$mwall.' .mwall-detail-box .mwall-readmore a:focus {
					color: rgba('.$db_color.', 1) !important;
					border: 1px solid rgba('.$db_color.', 1) !important;
				}';

				// Hide media
				if ($xxs_hide_images) 
				{
					$css .= '
					#'.$mwall.' .mwall-cover,
					#'.$mwall.' .mwall-photo-link,
					#'.$mwall.' .mwall-item-video {
						display: none !important;
					}';
				}
			$css .= '}';

			if ($detail_box_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}

			if ($show_title_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			if ($show_introtext_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			if ($show_date_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			if ($show_category_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			if ($show_author_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			if ($show_tags_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			if ($show_hits_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			if ($show_count_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			if ($show_readmore_column) 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}
		}

		// Columns/list photo-link background color
		if ($masonry_params->get('mas_grid', 7) == '98o')
		{
			$css .= '
			#'.$mwall.' .mwall-item-inner-cont {	
				background-color: rgba('.$bg_columns.','.$bg_opacity_columns.');
			}';
		}

		// List items - Responsive configuration
		if ($masonry_params->get('mas_grid', 7) == '99v')
		{
			$css .= '
			.mwall-list #'.$mwall.' .mwall-item {
				width: 100% !important;
				height: auto !important;
			}
			.mwall-list #'.$mwall.' .mwall-item-inner {
				width: auto !important;
			}
			.mwall-list #'.$mwall.' .mwall-photo-link {
				height: auto !important;
			}
			.mwall-list #'.$mwall.' .mwall-item-inner .mwall-title a,
			.mwall-list #'.$mwall.' .mwall-item-inner .mwall-title span {
				font-size: 18px;
			}
			@media only screen and (max-width: 550px)
			{
				.mwall-list #'.$mwall.' .mwall-cover {
					display: none;
				}
				.mwall-list #'.$mwall.' .mwall-cover.with-video,
				.mwall-list #'.$mwall.' .mwall-cover.with-audio
				{
					display: block;
				}
				.mwall-list #'.$mwall.' .mwall-cover.with-video
				{
					max-width: 100%;
				}
			}';
		}

		$document->addStyleDeclaration( $css );
	}
}
