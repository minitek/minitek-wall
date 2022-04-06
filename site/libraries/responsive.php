<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibResponsive
{
	public function initCustomGridWidths($masonry_params, $elements, $columns, $widgetID)
	{
		$document = \JFactory::getDocument();
		$mwall = 'mwall_iso_container_'.$widgetID;
		$column_percent = number_format((100 / $columns), 2, '.', '');
		$dimensions_css = '';

		foreach ($elements as $elem)
		{
			// Width
			$width = (int)$elem->width;
			$percent = (float)($width * $column_percent);

			$dimensions_css .= '
			#'.$mwall.' .mnwitem'.$elem->index.' {
				width: '.$percent.'%;
			}';

			// Height
			$height = (int)$elem->height;

			// Large screen
			$responsive_lg = (int)$masonry_params['mas_responsive_lg'];
			$lg_cell_height = (int)$masonry_params['mas_lg_cell_height'];

			$dimensions_css .= '@media only screen and (min-width:'.$responsive_lg.'px)
			{
				#'.$mwall.' .mnwitem'.$elem->index.' {
					height: '.($height * $lg_cell_height).'px;
				}
			}';

			// Medium screen
			$responsive_lg_min = $responsive_lg - 1;
			$responsive_md = (int)$masonry_params['mas_responsive_md'];
			$md_cell_height = (int)$masonry_params['mas_md_cell_height'];

			$dimensions_css .= '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{
				#'.$mwall.' .mnwitem'.$elem->index.' {
					height: '.($height * $md_cell_height).'px;
				}
			}';

			// Small screen
			$responsive_md_min = $responsive_md - 1;
			$responsive_sm = (int)$masonry_params['mas_responsive_sm'];
			$sm_cell_height = (int)$masonry_params['mas_sm_cell_height'];

			$dimensions_css .= '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{
				#'.$mwall.' .mnwitem'.$elem->index.' {
					height: '.($height * $sm_cell_height).'px;
				}
			}';

			// Extra small screen
			$responsive_sm_min = $responsive_sm - 1;
			$responsive_xs = (int)$masonry_params['mas_responsive_xs'];
			$xs_cell_height = (int)$masonry_params['mas_xs_cell_height'];

			$dimensions_css .= '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{
				#'.$mwall.' .mnwitem'.$elem->index.' {
					height: '.($height * $xs_cell_height).'px;
				}
			}';

			// Extra extra small screen
			$responsive_xs_min = $responsive_xs - 1;
			$xxs_cell_height = (int)$masonry_params['mas_xxs_cell_height'];

			$dimensions_css .= '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{
				#'.$mwall.' .mnwitem'.$elem->index.' {
					height: '.($height * $xxs_cell_height).'px;
				}
			}';
		}

		$document->addStyleDeclaration( $dimensions_css );
	}

	public function loadResponsiveMasonry($masonry_params, $widgetID)
	{
		$document = \JFactory::getDocument();
		$mwall = 'mwall_iso_container_'.$widgetID;

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
		$show_hits_column = $masonry_params['mas_db_hits_columns'];
		$show_count_column = $masonry_params['mas_db_count_columns'];
		$show_readmore_column = $masonry_params['mas_db_readmore_columns'];

		// Media CSS - L screen
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
				}
			';

			if ((!isset($masonry_params['mas_preserve_aspect_ratio'])
				|| !$masonry_params['mas_preserve_aspect_ratio']))
			{
				$lg_media .= '
					.mwall-columns #'.$mwall.' .mwall-photo-link {
						height: '.$lg_cell_height.'px !important;
					}
				';
			}

		$lg_media .= '
		}';

		$document->addStyleDeclaration( $lg_media );

		// Media CSS - M screen
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

		// Media CSS - M screen - Equal columns
		if ($md_type)
		{
			$items_width = number_format((float)(100 / $responsive_md_num), 2, '.', '');
			$md_media = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{ ';
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
						#'.$mwall.' .mwall-item-inner.mnw-no-image {
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

		// Media CSS - S screen
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

		// Media CSS - S screen - Equal columns
		if ($sm_type)
		{
			$items_width = number_format((float)(100 / $responsive_sm_num), 2, '.', '');
			$sm_media = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{ ';
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
						#'.$mwall.' .mwall-item-inner.mnw-no-image {
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

		// Media CSS - XS screen
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

		// Media CSS - XS screen - Equal columns
		if ($xs_type)
		{
			$items_width = number_format((float)(100 / $responsive_xs_num), 2, '.', '');
			$xs_media = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{ ';
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
						#'.$mwall.' .mwall-item-inner.mnw-no-image {
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
					}
					';
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

		// Media CSS - XXS screen
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

		// Media CSS - XXS screen - Equal columns
		if ($xxs_type)
		{
			$items_width = number_format((float)(100 / $responsive_xxs_num), 2, '.', '');
			$xxs_media = '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{ ';
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
						#'.$mwall.' .mwall-item-inner.mnw-no-image {
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
					}';
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

			if ($show_author_column) {
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
