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
	public function masonryItemCss($masonry_params, $widgetID)
	{
		$utilities = new \MinitekWallLibUtilities;
		$document = \JFactory::getDocument();
		$mwall = 'mwall_items_'.$widgetID;
		$css = '';

		// Big
		$bg_big = $utilities->hex2RGB($masonry_params['mas_db_bg_big'], true);
		$bg_opacity_big = number_format((float)$masonry_params['mas_db_bg_opacity_big'], 2, '.', '');

		if (!$masonry_params['mas_db_title_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-item-author {
				display: none;
			}';
		}

		if (isset($masonry_params['mas_db_tags_big']) && !$masonry_params['mas_db_tags_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-readmore {
				display: none;
			}';
		}

		if ($masonry_params['mas_db_color_big'] == 'light-text')
		{
			$css .= '
			#'.$mwall.' .mwall-big h3.mwall-title a,
			#'.$mwall.' .mwall-big h3.mwall-title span {
				color: rgba(255, 255, 255, 0.9);
			}

			#'.$mwall.' .mwall-big h3.mwall-title a:hover,
			#'.$mwall.' .mwall-big h3.mwall-title a:focus {
				color: #fff;
			}

			#'.$mwall.' .mwall-big .mwall-item-info {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-big .mwall-item-info a {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-big .mwall-item-info a:hover,
			#'.$mwall.' .mwall-big .mwall-item-info a:focus {
				color: #fff;
				border-bottom: 1px dotted rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-big .mwall-s-desc,
			#'.$mwall.' .mwall-big .mwall-desc,
			#'.$mwall.' .mwall-big .mwall-price,
			#'.$mwall.' .mwall-big .mwall-hits,
			#'.$mwall.' .mwall-big .mwall-count {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-big .mwall-date {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-big .mwall-readmore a {
				color: rgba(255, 255, 255, 0.7);
				border: 1px solid rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-big .mwall-readmore a:hover,
			#'.$mwall.' .mwall-big .mwall-readmore a:focus {
				color: #fff;
				border: 1px solid #fff;
			}';
		}
		else if ($masonry_params['mas_db_color_big'] == 'dark-text')
		{
			$css .= '
			#'.$mwall.' .mwall-big h3.mwall-title a,
			#'.$mwall.' .mwall-big h3.mwall-title span {
				color: #333;
			}

			#'.$mwall.' .mwall-big h3.mwall-title a:hover,
			#'.$mwall.' .mwall-big h3.mwall-title a:focus {
				color: #000;
			}

			#'.$mwall.' .mwall-big .mwall-item-info {
				color: #555;
			}

			#'.$mwall.' .mwall-big .mwall-item-info a {
				color: #555;
			}

			#'.$mwall.' .mwall-big .mwall-item-info a:hover,
			#'.$mwall.' .mwall-big .mwall-item-info a:focus {
				color: #333;
				border-bottom: 1px dotted #333;
			}

			#'.$mwall.' .mwall-big .mwall-s-desc,
			#'.$mwall.' .mwall-big .mwall-desc,
			#'.$mwall.' .mwall-big .mwall-price,
			#'.$mwall.' .mwall-big .mwall-hits,
			#'.$mwall.' .mwall-big .mwall-count {
				color: #555;
			}

			#'.$mwall.' .mwall-big .mwall-date {
				color: #666;
			}

			#'.$mwall.' .mwall-big .mwall-readmore a {
				color: #555;
				border: 1px solid #777;
			}

			#'.$mwall.' .mwall-big .mwall-readmore a:hover,
			#'.$mwall.' .mwall-big .mwall-readmore a:focus {
				color: #000;
				border: 1px solid #111;
			}';
		}

		if ($masonry_params['mas_db_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-item-inner {	
				background-color: rgba('.$bg_big.','.$bg_opacity_big.');
			}';

			if ($masonry_params['mas_db_position_big'] == 'left')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_big'] == 'right')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_big'] == 'top')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_big'] == 'bottom')
			{
				if (!$masonry_params['mas_full_width_image'])
				{
					$css .= '
					#'.$mwall.' .mwall-big .mwall-photo-link {	
						right: 0;
						left: 0;
						bottom: auto;
						top: 0;
						height: 50%;
					}';
					
					$css .= '
					#'.$mwall.' .mwall-big .mwall-item-outer-cont .mwall-item-inner {
						right: 0;
						left: 0;
						bottom: 0;
						height: 50%;
					}';
				}
			}
		}
		else if (!$masonry_params['mas_db_big'])
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

		// Landscape 
		$bg_lscape = $utilities->hex2RGB($masonry_params['mas_db_bg_lscape'], true);
		$bg_opacity_lscape = number_format((float)$masonry_params['mas_db_bg_opacity_lscape'], 2, '.', '');

		if (!$masonry_params['mas_db_title_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-item-author {
				display: none;
			}';
		}

		if (isset($masonry_params['mas_db_tags_lscape']) && !$masonry_params['mas_db_tags_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-readmore {
				display: none;
			}';
		}

		if ($masonry_params['mas_db_color_lscape'] == 'light-text')
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal h3.mwall-title a,
			#'.$mwall.' .mwall-horizontal h3.mwall-title span {
				color: rgba(255, 255, 255, 0.9);
			}

			#'.$mwall.' .mwall-horizontal h3.mwall-title a:hover,
			#'.$mwall.' .mwall-horizontal h3.mwall-title a:focus {
				color: #fff;
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-info {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-info a {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-info a:hover,
			#'.$mwall.' .mwall-horizontal .mwall-item-info a:focus {
				color: #fff;
				border-bottom: 1px dotted rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-horizontal .mwall-s-desc,
			#'.$mwall.' .mwall-horizontal .mwall-desc,
			#'.$mwall.' .mwall-horizontal .mwall-price,
			#'.$mwall.' .mwall-horizontal .mwall-hits,
			#'.$mwall.' .mwall-horizontal .mwall-count {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-horizontal .mwall-date {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-horizontal .mwall-readmore a {
				color: rgba(255, 255, 255, 0.7);
				border: 1px solid rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-horizontal .mwall-readmore a:hover,
			#'.$mwall.' .mwall-horizontal .mwall-readmore a:focus {
				color: #fff;
				border: 1px solid #fff;
			}';
		}
		else if ($masonry_params['mas_db_color_lscape'] == 'dark-text')
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal h3.mwall-title a,
			#'.$mwall.' .mwall-horizontal h3.mwall-title span {
				color: #333;
			}

			#'.$mwall.' .mwall-horizontal h3.mwall-title a:hover,
			#'.$mwall.' .mwall-horizontal h3.mwall-title a:focus {
				color: #000;
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-info {
				color: #555;
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-info a {
				color: #555;
			}

			#'.$mwall.' .mwall-horizontal .mwall-item-info a:hover,
			#'.$mwall.' .mwall-horizontal .mwall-item-info a:focus {
				color: #333;
				border-bottom: 1px dotted #333;
			}

			#'.$mwall.' .mwall-horizontal .mwall-s-desc,
			#'.$mwall.' .mwall-horizontal .mwall-desc,
			#'.$mwall.' .mwall-horizontal .mwall-price,
			#'.$mwall.' .mwall-horizontal .mwall-hits,
			#'.$mwall.' .mwall-horizontal .mwall-count {
				color: #555;
			}

			#'.$mwall.' .mwall-horizontal .mwall-date {
				color: #666;
			}

			#'.$mwall.' .mwall-horizontal .mwall-readmore a {
				color: #555;
				border: 1px solid #777;
			}

			#'.$mwall.' .mwall-horizontal .mwall-readmore a:hover,
			#'.$mwall.' .mwall-horizontal .mwall-readmore a:focus {
				color: #000;
				border: 1px solid #111;
			}';
		}

		if ($masonry_params['mas_db_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-item-inner {	
				background-color: rgba('.$bg_lscape.','.$bg_opacity_lscape.');
			}';

			if ($masonry_params['mas_db_position_lscape'] == 'left')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_lscape'] == 'right')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_lscape'] == 'top')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_lscape'] == 'bottom')
			{
				if (!$masonry_params['mas_full_width_image'])
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
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params['mas_db_lscape'])
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

		// Portrait 
		$bg_portrait = $utilities->hex2RGB($masonry_params['mas_db_bg_portrait'], true);
		$bg_opacity_portrait = number_format((float)$masonry_params['mas_db_bg_opacity_portrait'], 2, '.', '');

		if (!$masonry_params['mas_db_title_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-item-author {
				display: none;
			}';
		}

		if (isset($masonry_params['mas_db_tags_portrait']) && !$masonry_params['mas_db_tags_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-readmore {
				display: none;
			}';
		}

		if ($masonry_params['mas_db_color_portrait'] == 'light-text')
		{
			$css .= '
			#'.$mwall.' .mwall-vertical h3.mwall-title a,
			#'.$mwall.' .mwall-vertical h3.mwall-title span {
				color: rgba(255, 255, 255, 0.9);
			}

			#'.$mwall.' .mwall-vertical h3.mwall-title a:hover,
			#'.$mwall.' .mwall-vertical h3.mwall-title a:focus {
				color: #fff;
			}

			#'.$mwall.' .mwall-vertical .mwall-item-info {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-vertical .mwall-item-info a {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-vertical .mwall-item-info a:hover,
			#'.$mwall.' .mwall-vertical .mwall-item-info a:focus {
				color: #fff;
				border-bottom: 1px dotted rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-vertical .mwall-s-desc,
			#'.$mwall.' .mwall-vertical .mwall-desc,
			#'.$mwall.' .mwall-vertical .mwall-price,
			#'.$mwall.' .mwall-vertical .mwall-hits,
			#'.$mwall.' .mwall-vertical .mwall-count {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-vertical .mwall-date {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-vertical .mwall-readmore a {
				color: rgba(255, 255, 255, 0.7);
				border: 1px solid rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-vertical .mwall-readmore a:hover,
			#'.$mwall.' .mwall-vertical .mwall-readmore a:focus {
				color: #fff;
				border: 1px solid #fff;
			}';
		}
		else if ($masonry_params['mas_db_color_portrait'] == 'dark-text')
		{
			$css .= '
			#'.$mwall.' .mwall-vertical h3.mwall-title a,
			#'.$mwall.' .mwall-vertical h3.mwall-title span {
				color: #333;
			}

			#'.$mwall.' .mwall-vertical h3.mwall-title a:hover,
			#'.$mwall.' .mwall-vertical h3.mwall-title a:focus {
				color: #000;
			}

			#'.$mwall.' .mwall-vertical .mwall-item-info {
				color: #555;
			}

			#'.$mwall.' .mwall-vertical .mwall-item-info a {
				color: #555;
			}

			#'.$mwall.' .mwall-vertical .mwall-item-info a:hover,
			#'.$mwall.' .mwall-vertical .mwall-item-info a:focus {
				color: #333;
				border-bottom: 1px dotted #333;
			}

			#'.$mwall.' .mwall-vertical .mwall-s-desc,
			#'.$mwall.' .mwall-vertical .mwall-desc,
			#'.$mwall.' .mwall-vertical .mwall-price,
			#'.$mwall.' .mwall-vertical .mwall-hits,
			#'.$mwall.' .mwall-vertical .mwall-count {
				color: #555;
			}

			#'.$mwall.' .mwall-vertical .mwall-date {
				color: #666;
			}

			#'.$mwall.' .mwall-vertical .mwall-readmore a {
				color: #555;
				border: 1px solid #777;
			}

			#'.$mwall.' .mwall-vertical .mwall-readmore a:hover,
			#'.$mwall.' .mwall-vertical .mwall-readmore a:focus {
				color: #000;
				border: 1px solid #111;
			}';
		}

		if ($masonry_params['mas_db_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-item-inner {	
				background-color: rgba('.$bg_portrait.','.$bg_opacity_portrait.');
			}';

			if ($masonry_params['mas_db_position_portrait'] == 'left')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_portrait'] == 'right')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_portrait'] == 'top')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_portrait'] == 'bottom')
			{
				if (!$masonry_params['mas_full_width_image'])
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
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params['mas_db_portrait'])
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

		// Small
		$bg_small = $utilities->hex2RGB($masonry_params['mas_db_bg_small'], true);
		$bg_opacity_small = number_format((float)$masonry_params['mas_db_bg_opacity_small'], 2, '.', '');

		if (!$masonry_params['mas_db_title_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-author {
				display: none;
			}';
		}

		if (isset($masonry_params['mas_db_tags_small']) && !$masonry_params['mas_db_tags_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-readmore {
				display: none;
			}';
		}

		if ($masonry_params['mas_db_color_small'] == 'light-text')
		{
			$css .= '
			#'.$mwall.' .mwall-small h3.mwall-title a,
			#'.$mwall.' .mwall-small h3.mwall-title span {
				color: rgba(255, 255, 255, 0.9);
			}

			#'.$mwall.' .mwall-small h3.mwall-title a:hover,
			#'.$mwall.' .mwall-small h3.mwall-title a:focus {
				color: #fff;
			}

			#'.$mwall.' .mwall-small .mwall-item-info {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-small .mwall-item-info a {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-small .mwall-item-info a:hover,
			#'.$mwall.' .mwall-small .mwall-item-info a:focus {
				color: #fff;
				border-bottom: 1px dotted rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-small .mwall-s-desc,
			#'.$mwall.' .mwall-small .mwall-desc,
			#'.$mwall.' .mwall-small .mwall-price,
			#'.$mwall.' .mwall-small .mwall-hits,
			#'.$mwall.' .mwall-small .mwall-count {
				color: rgba(255, 255, 255, 0.8);
			}

			#'.$mwall.' .mwall-small .mwall-date {
				color: rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-small .mwall-readmore a {
				color: rgba(255, 255, 255, 0.7);
				border: 1px solid rgba(255, 255, 255, 0.7);
			}

			#'.$mwall.' .mwall-small .mwall-readmore a:hover,
			#'.$mwall.' .mwall-small .mwall-readmore a:focus {
				color: #fff;
				border: 1px solid #fff;
			}';
		}
		else if ($masonry_params['mas_db_color_small'] == 'dark-text')
		{
			$css .= '
			#'.$mwall.' .mwall-small h3.mwall-title a,
			#'.$mwall.' .mwall-small h3.mwall-title span {
				color: #333;
			}

			#'.$mwall.' .mwall-small h3.mwall-title a:hover,
			#'.$mwall.' .mwall-small h3.mwall-title a:focus {
				color: #000;
			}

			#'.$mwall.' .mwall-small .mwall-item-info {
				color: #555;
			}

			#'.$mwall.' .mwall-small .mwall-item-info a {
				color: #555;
			}

			#'.$mwall.' .mwall-small .mwall-item-info a:hover,
			#'.$mwall.' .mwall-small .mwall-item-info a:focus {
				color: #333;
				border-bottom: 1px dotted #333;
			}

			#'.$mwall.' .mwall-small .mwall-s-desc,
			#'.$mwall.' .mwall-small .mwall-desc,
			#'.$mwall.' .mwall-small .mwall-price,
			#'.$mwall.' .mwall-small .mwall-hits,
			#'.$mwall.' .mwall-small .mwall-count {
				color: #555;
			}

			#'.$mwall.' .mwall-small .mwall-date {
				color: #666;
			}

			#'.$mwall.' .mwall-small .mwall-readmore a {
				color: #555;
				border: 1px solid #777;
			}

			#'.$mwall.' .mwall-small .mwall-readmore a:hover,
			#'.$mwall.' .mwall-small .mwall-readmore a:focus {
				color: #000;
				border: 1px solid #111;
			}';
		}

		if ($masonry_params['mas_db_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-inner {	
				background-color: rgba('.$bg_small.','.$bg_opacity_small.');
			}
			';

			if ($masonry_params['mas_db_position_small'] == 'left')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_small'] == 'right')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_small'] == 'top')
			{
				if (!$masonry_params['mas_full_width_image'])
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
			else if ($masonry_params['mas_db_position_small'] == 'bottom')
			{
				if (!$masonry_params['mas_full_width_image'])
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
					height: 50%;
				}';
			}
		}
		else if (!$masonry_params['mas_db_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-inner {
				display: none;
			}

			#'.$mwall.' .mwall-small .mwall-item-inner.mwall-no-image {
				display: block;
				background-color: rgba('.$bg_small.','.$bg_opacity_small.');
			}';
		}

		$document->addStyleDeclaration($css);
	}

	public function initCustomGridWidths($masonry_params, $elements, $columns, $widgetID)
	{
		$document = \JFactory::getDocument();
		$mwall = 'mwall_items_'.$widgetID;
		$column_percent = number_format((100 / $columns), 2, '.', '');
		$dimensions_css = '';

		foreach ($elements as $elem)
		{
			// Width
			$width = (int)$elem->width;
			$percent = (float)($width * $column_percent);

			$dimensions_css .= '
			#'.$mwall.' .mwall-item'.$elem->index.' {
				width: '.$percent.'%;
			}';

			// Height
			$height = (int)$elem->height;

			// Large screen
			$responsive_lg = (int)$masonry_params['mas_responsive_lg'];
			$lg_cell_height = (int)$masonry_params['mas_lg_cell_height'];

			$dimensions_css .= '
			@media only screen and (min-width:'.$responsive_lg.'px) {
				#'.$mwall.' .mwall-item'.$elem->index.' {
					height: '.($height * $lg_cell_height).'px;
				}
			}';

			// Medium screen
			$responsive_lg_min = $responsive_lg - 1;
			$responsive_md = (int)$masonry_params['mas_responsive_md'];
			$md_cell_height = (int)$masonry_params['mas_md_cell_height'];

			$dimensions_css .= '
			@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px) {
				#'.$mwall.' .mwall-item'.$elem->index.' {
					height: '.($height * $md_cell_height).'px;
				}
			}';

			// Small screen
			$responsive_md_min = $responsive_md - 1;
			$responsive_sm = (int)$masonry_params['mas_responsive_sm'];
			$sm_cell_height = (int)$masonry_params['mas_sm_cell_height'];

			$dimensions_css .= '
			@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px) {
				#'.$mwall.' .mwall-item'.$elem->index.' {
					height: '.($height * $sm_cell_height).'px;
				}
			}';

			// Extra small screen
			$responsive_sm_min = $responsive_sm - 1;
			$responsive_xs = (int)$masonry_params['mas_responsive_xs'];
			$xs_cell_height = (int)$masonry_params['mas_xs_cell_height'];

			$dimensions_css .= '
			@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px) {
				#'.$mwall.' .mwall-item'.$elem->index.' {
					height: '.($height * $xs_cell_height).'px;
				}
			}';

			// Extra extra small screen
			$responsive_xs_min = $responsive_xs - 1;
			$xxs_cell_height = (int)$masonry_params['mas_xxs_cell_height'];

			$dimensions_css .= '
			@media only screen and (max-width:'.$responsive_xs_min.'px) {
				#'.$mwall.' .mwall-item'.$elem->index.' {
					height: '.($height * $xxs_cell_height).'px;
				}
			}';
		}

		$document->addStyleDeclaration( $dimensions_css );
	}

	public function loadResponsiveMasonry($masonry_params, $widgetID)
	{
		$utilities = new \MinitekWallLibUtilities;
		$document = \JFactory::getDocument();
		$mwall = 'mwall_items_'.$widgetID;

		// Responsive settings
		$responsive_lg = (int)$masonry_params['mas_responsive_lg'];
		$responsive_lg_min = $responsive_lg - 1;
		$lg_cell_height = '240';

		if (array_key_exists('mas_lg_cell_height', $masonry_params))
		{
			$lg_cell_height = (int)$masonry_params['mas_lg_cell_height'];
		}

		$md_type = $masonry_params['mas_md_type'];
		$responsive_md_num = (int)$masonry_params['mas_responsive_md_num'];
		$responsive_md = (int)$masonry_params['mas_responsive_md'];
		$responsive_md_min = $responsive_md - 1;
		$md_cell_height = '240';

		if (array_key_exists('mas_md_cell_height', $masonry_params))
		{
			$md_cell_height = (int)$masonry_params['mas_md_cell_height'];
		}

		$sm_type = $masonry_params['mas_sm_type'];
		$responsive_sm_num = (int)$masonry_params['mas_responsive_sm_num'];
		$responsive_sm = (int)$masonry_params['mas_responsive_sm'];
		$responsive_sm_min = $responsive_sm - 1;
		$sm_cell_height = '240';

		if (array_key_exists('mas_sm_cell_height', $masonry_params))
		{
			$sm_cell_height = (int)$masonry_params['mas_sm_cell_height'];
		}

		$xs_type = $masonry_params['mas_xs_type'];
		$responsive_xs_num = (int)$masonry_params['mas_responsive_xs_num'];
		$responsive_xs = (int)$masonry_params['mas_responsive_xs'];
		$responsive_xs_min = $responsive_xs - 1;
		$xs_cell_height = '240';

		if (array_key_exists('mas_xs_cell_height', $masonry_params))
		{
			$xs_cell_height = (int)$masonry_params['mas_xs_cell_height'];
		}

		$xxs_type = $masonry_params['mas_xxs_type'];
		$responsive_xxs_num = (int)$masonry_params['mas_responsive_xxs_num'];
		$xxs_cell_height = '240';

		if (array_key_exists('mas_xxs_cell_height', $masonry_params))
		{
			$xxs_cell_height = (int)$masonry_params['mas_xxs_cell_height'];
		}

		$detail_box_column = $masonry_params['mas_db_columns'];
		$show_title_column = $masonry_params['mas_db_title_columns'];
		$show_introtext_column = $masonry_params['mas_db_introtext_columns'];
		$show_date_column = $masonry_params['mas_db_date_columns'];
		$show_category_column = $masonry_params['mas_db_category_columns'];
		$show_author_column = $masonry_params['mas_db_author_columns'];
		$show_tags_column = isset($masonry_params['mas_db_tags_columns']) ? $masonry_params['mas_db_tags_columns'] : false;
		$show_hits_column = $masonry_params['mas_db_hits_columns'];
		$show_count_column = $masonry_params['mas_db_count_columns'];
		$show_readmore_column = $masonry_params['mas_db_readmore_columns'];
		$bg_columns = $utilities->hex2RGB($masonry_params['mas_db_bg_columns'], true);
		$bg_opacity_columns = number_format((float)$masonry_params['mas_db_bg_opacity_columns'], 2, '.', '');

		// Media CSS - Large
		$lg_media = '@media only screen and (min-width:'.$responsive_lg.'px)
		{';
			$lg_media .= '
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
			
			if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
				|| !$masonry_params['mas_preserve_aspect_ratio']))
			{
				$lg_media .= '
				.mwall-columns #'.$mwall.' .mwall-photo-link {
					height: '.$lg_cell_height.'px !important;
				}';
			}
		$lg_media .= '
		}';

		$document->addStyleDeclaration( $lg_media );

		// Media CSS - Medium
		if (!$md_type)
		{
			$md_media_jf = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{';
				$md_media_jf .= '
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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
					{
						$md_media_jf .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$md_cell_height.'px !important;
						}';
					}
				}
			$md_media_jf .= '
			}';

			$document->addStyleDeclaration( $md_media_jf );
		}

		// Media CSS - Medium - Equal columns
		if ($md_type)
		{
			$items_width = number_format((float)(100 / $responsive_md_num), 2, '.', '');
			
			$md_media = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{ ';
				$md_media .= '
				#'.$mwall.' .mwall-item-inner {	
					background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
				}';

				if ($masonry_params['mas_db_position_columns'] == 'below')
				{
					$md_media .= '
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
					$md_media .= '
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
					{
						$md_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$md_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
				{
					$md_media .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$md_cell_height.'px !important;
					}';
				}

				$md_media .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 24px;
				}
			}';

			$document->addStyleDeclaration( $md_media );

			if ($detail_box_column) 
			{
				$detail_box_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$detail_box_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $detail_box_column_css );

			if ($show_title_column) 
			{
				$show_title_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_title_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_title_column_css );

			if ($show_introtext_column) 
			{
				$show_introtext_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_introtext_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_introtext_column_css );

			if ($show_date_column) 
			{
				$show_date_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_date_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_date_column_css );

			if ($show_category_column) 
			{
				$show_category_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_category_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_category_column_css );

			if ($show_author_column) 
			{
				$show_author_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_author_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_author_column_css );

			if ($show_tags_column) 
			{
				$show_tags_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_tags_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_tags_column_css );

			if ($show_hits_column) 
			{
				$show_hits_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_hits_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_hits_column_css );

			if ($show_count_column) 
			{
				$show_count_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_count_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_count_column_css );

			if ($show_readmore_column) 
			{
				$show_readmore_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_readmore_column_css = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_readmore_column_css );
		}

		// Media CSS - Small
		if (!$sm_type)
		{
			$sm_media_jf = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{';
				$sm_media_jf .= '
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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
					{
						$sm_media_jf .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$sm_cell_height.'px !important;
						}';
					}
				}
			$sm_media_jf .= '
			}';

			$document->addStyleDeclaration( $sm_media_jf );
		}

		// Media CSS - Small - Equal columns
		if ($sm_type)
		{
			$items_width = number_format((float)(100 / $responsive_sm_num), 2, '.', '');
			
			$sm_media = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{ ';
				$sm_media .= '
				#'.$mwall.' .mwall-item-inner {	
					background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
				}';

				if ($masonry_params['mas_db_position_columns'] == 'below')
				{
					$sm_media .= '
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
					$sm_media .= '
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
					{
						$sm_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$sm_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
				{
					$sm_media .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$sm_cell_height.'px !important;
					}';
				}

				$sm_media .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px !important;
					line-height: 24px;
				}
			}';

			$document->addStyleDeclaration( $sm_media );

			if ($detail_box_column) 
			{
				$detail_box_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$detail_box_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $detail_box_column_css );

			if ($show_title_column) 
			{
				$show_title_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_title_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_title_column_css );

			if ($show_introtext_column) 
			{
				$show_introtext_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_introtext_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_introtext_column_css );

			if ($show_date_column) 
			{
				$show_date_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_date_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_date_column_css );

			if ($show_category_column) 
			{
				$show_category_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_category_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_category_column_css );

			if ($show_author_column) 
			{
				$show_author_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_author_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_author_column_css );

			if ($show_tags_column) 
			{
				$show_tags_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_tags_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_tags_column_css );

			if ($show_hits_column) 
			{
				$show_hits_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_hits_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_hits_column_css );

			if ($show_count_column) 
			{
				$show_count_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_count_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_count_column_css );

			if ($show_readmore_column) 
			{
				$show_readmore_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_readmore_column_css = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_readmore_column_css );
		}

		// Media CSS - Extra small
		if (!$xs_type)
		{
			$xs_media_jf = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{';
				$xs_media_jf .= '
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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
					{
						$xs_media_jf .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$xs_cell_height.'px !important;
						}';
					}
				}
			$xs_media_jf .= '
			}';

			$document->addStyleDeclaration( $xs_media_jf );
		}

		// Media CSS - Extra small - Equal columns
		if ($xs_type)
		{
			$items_width = number_format((float)(100 / $responsive_xs_num), 2, '.', '');
			
			$xs_media = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{ ';
				$xs_media .= '
				#'.$mwall.' .mwall-item-inner {	
					background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
				}';

				if ($masonry_params['mas_db_position_columns'] == 'below')
				{
					$xs_media .= '
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
					$xs_media .= '
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
					{
						$xs_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$xs_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
				{
					$xs_media .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$xs_cell_height.'px !important;
					}';
				}

				$xs_media .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 24px;
				}
			}';

			$document->addStyleDeclaration( $xs_media );

			if ($detail_box_column) 
			{
				$detail_box_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$detail_box_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}
			
			$document->addStyleDeclaration( $detail_box_column_css );

			if ($show_title_column) 
			{
				$show_title_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_title_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_title_column_css );

			if ($show_introtext_column) 
			{
				$show_introtext_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_introtext_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_introtext_column_css );

			if ($show_date_column) 
			{
				$show_date_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_date_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_date_column_css );

			if ($show_category_column) 
			{
				$show_category_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_category_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_category_column_css );

			if ($show_author_column) 
			{
				$show_author_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_author_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_author_column_css );

			if ($show_tags_column) 
			{
				$show_tags_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_tags_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_tags_column_css );

			if ($show_hits_column) 
			{
				$show_hits_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_hits_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_hits_column_css );

			if ($show_count_column) 
			{
				$show_count_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_count_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_count_column_css );

			if ($show_readmore_column) 
			{
				$show_readmore_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_readmore_column_css = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_readmore_column_css );
		}

		// Media CSS - Extra extra small
		if (!$xxs_type)
		{
			$xxs_media_jf = '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{';
				$xxs_media_jf .= '
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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
					{
						$xxs_media_jf .= '
						.mwall-columns #'.$mwall.' .mwall-photo-link {
							height: '.$xxs_cell_height.'px !important;
						}';
					}
				}
			$xxs_media_jf .= '
			}';

			$document->addStyleDeclaration( $xxs_media_jf );
		}

		// Media CSS - Extra extra small - Equal columns
		if ($xxs_type)
		{
			$items_width = number_format((float)(100 / $responsive_xxs_num), 2, '.', '');
			
			$xxs_media = '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{ ';
				$xxs_media .= '
				#'.$mwall.' .mwall-item-inner {	
					background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
				}';

				if ($masonry_params['mas_db_position_columns'] == 'below')
				{
					$xxs_media .= '
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
					$xxs_media .= '
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
					{
						$xxs_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: auto !important;
						}
						#'.$mwall.' .mwall-item-inner.mwall-no-image {
							height: 100% !important;
						}';
					} 
					else 
					{
						$xxs_media .= '
						#'.$mwall.' .mwall-item-inner {
							height: 100% !important;
						}';
					}
				}

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
				{
					$xxs_media .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$xxs_cell_height.'px !important;
					}
					';
				}

				$xxs_media .= '
				#'.$mwall.' .mwall-item {
					width: '.$items_width.'% !important;
				}
				#'.$mwall.' .mwall-item-inner .mwall-title a,
				#'.$mwall.' .mwall-item-inner .mwall-title span {
					font-size: 18px;
					line-height: 24px;
				}
			}';

			$document->addStyleDeclaration( $xxs_media );

			if ($detail_box_column) 
			{
				$detail_box_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$detail_box_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $detail_box_column_css );

			if ($show_title_column) 
			{
				$show_title_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_title_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-title {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_title_column_css );

			if ($show_introtext_column) 
			{
				$show_introtext_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_introtext_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-desc {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_introtext_column_css );

			if ($show_date_column) 
			{
				$show_date_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_date_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-date {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_date_column_css );

			if ($show_category_column) 
			{
				$show_category_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_category_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-category {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_category_column_css );

			if ($show_author_column) 
			{
				$show_author_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_author_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-author {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_author_column_css );

			if ($show_tags_column) 
			{
				$show_tags_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_tags_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-item-tags {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_tags_column_css );

			if ($show_hits_column) 
			{
				$show_hits_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_hits_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-hits {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_hits_column_css );

			if ($show_count_column) 
			{
				$show_count_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_count_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-count {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_count_column_css );

			if ($show_readmore_column) 
			{
				$show_readmore_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: block !important;
					}
				}';
			} 
			else 
			{
				$show_readmore_column_css = '@media only screen and (max-width:'.$responsive_xs_min.'px)
				{
					#'.$mwall.' .mwall-detail-box .mwall-readmore {
						display: none !important;
					}
				}';
			}

			$document->addStyleDeclaration( $show_readmore_column_css );
		}

		// List items - Responsive configuration
		if ($masonry_params['mas_grid'] == '99v')
		{
			$list_items_media = '
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
					width: 100%;
					max-width: inherit;
				}
				.mwall-list #'.$mwall.' .mwall-photo-link img {
					width: 100%;
					max-width: 100%;
				}
			}';

			$document->addStyleDeclaration( $list_items_media );
		}
	}
}
