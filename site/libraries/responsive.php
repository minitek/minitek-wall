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

		// Detail box text color - Columns/List
		if ($masonry_params['mas_db_color_columns'] == 'light-text')
			$db_color = '255,255,255';
		else if ($masonry_params['mas_db_color_columns'] == 'dark-text')
			$db_color = '0,0,0';
		else 
			$db_color = $utilities->hex2RGB($masonry_params['mas_db_color_columns'], true);

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
		if (!$masonry_params['mas_db_title_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_tags_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_big'])
		{
			$css .= '
			#'.$mwall.' .mwall-big .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Big
		if ($masonry_params['mas_db_color_big'] == 'light-text')
			$db_color_big = '255,255,255';
		else if ($masonry_params['mas_db_color_big'] == 'dark-text')
			$db_color_big = '0,0,0';
		else 
			$db_color_big = $utilities->hex2RGB($masonry_params['mas_db_color_big'], true);

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
		$bg_big = $utilities->hex2RGB($masonry_params['mas_db_bg_big'], true);
		$bg_opacity_big = number_format((float)$masonry_params['mas_db_bg_opacity_big'], 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-big .mwall-item-inner-cont {	
			background-color: rgba('.$bg_big.','.$bg_opacity_big.');
		}';

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
				}

				$css .= '
				#'.$mwall.' .mwall-big .mwall-item-outer-cont .mwall-item-inner {
					right: 0;
					left: 0;
					bottom: 0;
					height: 50%;
				}';
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

		// Detail box - Landscape 
		if (!$masonry_params['mas_db_title_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_tags_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_lscape'])
		{
			$css .= '
			#'.$mwall.' .mwall-horizontal .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Landscape
		if ($masonry_params['mas_db_color_lscape'] == 'light-text')
			$db_color_lscape = '255,255,255';
		else if ($masonry_params['mas_db_color_lscape'] == 'dark-text')
			$db_color_lscape = '0,0,0';
		else 
			$db_color_lscape = $utilities->hex2RGB($masonry_params['mas_db_color_lscape'], true);

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
		$bg_lscape = $utilities->hex2RGB($masonry_params['mas_db_bg_lscape'], true);
		$bg_opacity_lscape = number_format((float)$masonry_params['mas_db_bg_opacity_lscape'], 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-horizontal .mwall-item-inner-cont {	
			background-color: rgba('.$bg_lscape.','.$bg_opacity_lscape.');
		}';

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

		// Detail box - Portrait 
		if (!$masonry_params['mas_db_title_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_tags_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_portrait'])
		{
			$css .= '
			#'.$mwall.' .mwall-vertical .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Portrait
		if ($masonry_params['mas_db_color_portrait'] == 'light-text')
			$db_color_portrait = '255,255,255';
		else if ($masonry_params['mas_db_color_portrait'] == 'dark-text')
			$db_color_portrait = '0,0,0';
		else 
			$db_color_portrait = $utilities->hex2RGB($masonry_params['mas_db_color_portrait'], true);

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
		$bg_portrait = $utilities->hex2RGB($masonry_params['mas_db_bg_portrait'], true);
		$bg_opacity_portrait = number_format((float)$masonry_params['mas_db_bg_opacity_portrait'], 2, '.', '');

		$css .= '
		#'.$mwall.' .mwall-vertical .mwall-item-inner-cont {	
			background-color: rgba('.$bg_portrait.','.$bg_opacity_portrait.');
		}';

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

		// Detail box - Small
		if (!$masonry_params['mas_db_title_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-title {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_introtext_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-desc {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_date_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-date {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_category_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-category {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_author_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-author {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_tags_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-item-tags {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_hits_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-hits {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_count_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-count {
				display: none;
			}';
		}

		if (!$masonry_params['mas_db_readmore_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-detail-box .mwall-readmore {
				display: none;
			}';
		}

		// Detail box text color - Small
		if ($masonry_params['mas_db_color_small'] == 'light-text')
			$db_color_small = '255,255,255';
		else if ($masonry_params['mas_db_color_small'] == 'dark-text')
			$db_color_small = '0,0,0';
		else 
			$db_color_small = $utilities->hex2RGB($masonry_params['mas_db_color_small'], true);

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
		$bg_small = $utilities->hex2RGB($masonry_params['mas_db_bg_small'], true);
		$bg_opacity_small = number_format((float)$masonry_params['mas_db_bg_opacity_small'], 2, '.', '');

		$css .= '
			#'.$mwall.' .mwall-small .mwall-item-inner-cont {	
				background-color: rgba('.$bg_small.','.$bg_opacity_small.');
			}';

		if ($masonry_params['mas_db_small'])
		{
			$css .= '
			#'.$mwall.' .mwall-small .mwall-item-inner {	
				background-color: rgba('.$bg_small.','.$bg_opacity_small.');
			}';

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

		// Hover box text color
		if ($masonry_params['mas_hb_text_color'] == '2')
			$hb_color = '255,255,255';
		else if ($masonry_params['mas_hb_text_color'] == '1')
			$hb_color = '0,0,0';
		else 
			$hb_color = $utilities->hex2RGB($masonry_params['mas_hb_text_color'], true);

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
		$show_tags_column = $masonry_params['mas_db_tags_columns'];
		$show_hits_column = $masonry_params['mas_db_hits_columns'];
		$show_count_column = $masonry_params['mas_db_count_columns'];
		$show_readmore_column = $masonry_params['mas_db_readmore_columns'];
		$bg_columns = $utilities->hex2RGB($masonry_params['mas_db_bg_columns'], true);
		$bg_opacity_columns = number_format((float)$masonry_params['mas_db_bg_opacity_columns'], 2, '.', '');

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
			
			if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
				|| !$masonry_params['mas_preserve_aspect_ratio']))
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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_grid'] != '99v')
				{
					$css .= 
					'#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params['mas_db_position_columns'] == 'below')
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
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

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_db_color_columns'] == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params['mas_db_color_columns'] == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params['mas_db_color_columns'], true);

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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_grid'] != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params['mas_db_position_columns'] == 'below')
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
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

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_db_color_columns'] == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params['mas_db_color_columns'] == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params['mas_db_color_columns'], true);

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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_grid'] != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params['mas_db_position_columns'] == 'below')
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
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

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_db_color_columns'] == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params['mas_db_color_columns'] == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params['mas_db_color_columns'], true);

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

				if ($masonry_params['mas_grid'] == '98o')
				{
					if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
						|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_grid'] != '99v')
				{
					$css .= '
					#'.$mwall.' .mwall-item-inner {	
						background-color: rgba('.$bg_columns.','.$bg_opacity_columns.') !important;
					}';
				}

				if ($masonry_params['mas_db_position_columns'] == 'below')
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

					if ($masonry_params['mas_db_position_columns'] == 'bottom')
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

				if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
					|| !$masonry_params['mas_preserve_aspect_ratio']))
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
				if ($masonry_params['mas_db_color_columns'] == 'light-text')
					$db_color = '255,255,255';
				else if ($masonry_params['mas_db_color_columns'] == 'dark-text')
					$db_color = '0,0,0';
				else 
					$db_color = $utilities->hex2RGB($masonry_params['mas_db_color_columns'], true);

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

		// Columns photo-link background color
		if ($masonry_params['mas_grid'] == '98o')
		{
			$css .= '
			#'.$mwall.' .mwall-item-inner-cont {
				background-color: rgba('.$bg_columns.','.$bg_opacity_columns.');
			}';
		}

		// List items - Responsive configuration
		if ($masonry_params['mas_grid'] == '99v')
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
					width: 100%;
					max-width: inherit;
				}
				.mwall-list #'.$mwall.' .mwall-photo-link img {
					width: 100%;
					max-width: 100%;
				}
			}';
		}

		$document->addStyleDeclaration( $css );
	}
}
