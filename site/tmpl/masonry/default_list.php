<?php

/**
 * @title        Minitek Wall
 * @copyright    Copyright (C) 2011-2023 Minitek, All rights reserved.
 * @license      GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\URI\URI;

if (!empty($this->wall) ||  $this->wall !== 0) {
	$options = $this->getColumnsItemOptions();

	// Extra css
	$this->model->responsiveLib->masonryItemCss($this->params, $this->item->id, $this->item->source_id);

	foreach ($this->wall as $key => $item) {
		// Cat Filters
		$catfilter = '';

		if (!empty($item->itemCategoriesRaw)) {
			foreach ($item->itemCategoriesRaw as $category) {
				if (is_array($category) && isset($category['title'])) {
					$catfilter .= ' cat-' . $this->utilitiesLib->cleanName($category['title']);
				}
			}
		}

		// Tag Filters
		$tagfilter = '';

		if (!empty($item->itemTags)) {
			foreach ($item->itemTags as $tag_name) {
				$tagfilter .= ' tag-' . $this->utilitiesLib->cleanName($tag_name->title);
			}
		}

		// Date Filters
		$datefilter = '';

		if (!empty($item->itemDateRaw)) {
			$datefilter .= ' date-' . HTMLHelper::_('date', $item->itemDateRaw, 'Y-m');
		}

		$empty_media = empty($item->itemImage);
		$item_classes = $catfilter . ' '
			. $tagfilter . ' '
			. $datefilter . ' '
			. $this->hoverOffset;
		$item_style = 'padding:' . (int)$this->gutter . 'px;';

		// Data attributes
		$data_id = isset($item->itemID) ? 'data-id="' . (int)$item->itemID . '"' : '';
		$data_mw_title = 'data-mw-title="' . $item->itemTitleRaw . '"';
		$data_date = isset($item->itemDateRaw) ? 'data-date="' . $item->itemDateRaw . '"' : '';
		$data_hits = isset($item->itemHits) ? 'data-hits="' . (int)$item->itemHits . '"' : '';
		$data_ordering = isset($item->itemOrdering) ? 'data-ordering="' . (int)$item->itemOrdering . '"' : '';
		$data_fordering = isset($item->itemFOrdering) ?  'data-fordering="' . (int)$item->itemFOrdering . '"' : '';
		$data_alias = isset($item->itemAlias) ? 'data-alias="' . $item->itemAlias . '"' : '';
		$data_modified = isset($item->itemModified) ? 'data-modified="' . $item->itemModified . '"' : '';
		$data_start = isset($item->itemStart) ? 'data-start="' . $item->itemStart . '"' : '';
		$data_finish = isset($item->itemFinish) ? 'data-finish="' . $item->itemFinish . '"' : '';
		$data_index = isset($item->rawIndex) ? 'data-index="' . $item->rawIndex . '"' : '';
		$item_data_attributes = $data_id . ' '
			. $data_mw_title . ' '
			. $data_date . ' '
			. $data_hits . ' '
			. $data_ordering . ' '
			. $data_fordering . ' '
			. $data_alias . ' '
			. $data_modified . ' '
			. $data_start . ' '
			. $data_finish . ' '
			. $data_index;

		$position_class = ($this->detailBoxColumns && !$empty_media) ? $options['position_class'] : '';

		$outer_cont_style = '';
		if ($this->mas_border_radius) {
			$outer_cont_style .= 'border-radius: ' . $this->mas_border_radius . 'px; ';
		}
		if ($this->mas_border) {
			$outer_cont_style .= 'border: ' . $this->mas_border . 'px solid ' . $this->mas_border_color . ';';
		}

		$inner_cont_style = 'background-color: rgba(' . $options['db_bg_class'] . ',' . $options['db_bg_opacity_class'] . ');';

		$cover_classes = $this->hoverOffset . ' '
			. $this->perspective;
		if (!$this->detailBoxColumns) {
			$cover_classes .= ' no-detail-box';
		} ?>

		<div class="mwall-item <?php echo $item_classes; ?>" style="<?php echo $item_style; ?>" <?php echo $data_attributes; ?>>
			<div class="mwall-item-outer-cont <?php echo $position_class; ?>" style="<?php echo $outer_cont_style ?> <?php echo $this->animated_flip; ?>">
				<div class="mwall-item-inner-cont" style="<?php echo $inner_cont_style; ?>">
					<?php if (!$empty_media) { ?>
						<div class="mwall-cover <?php echo $this->hoverOffset; ?> <?php echo $cover_classes; ?>">
							<div class="mwall-img-div <?php echo $this->flipBase; ?> <?php echo $this->flipClass; ?>" style="<?php echo $this->animated_flip; ?>">
								<div class="mwall-item-img">
									<?php if (isset($item->itemLink) && $this->mas_image_link) { ?>
										<a href="<?php echo $item->itemLink; ?>" class="mwall-photo-link">
											<img src="<?php echo $item->itemImage; ?>" alt="<?php echo $item->itemTitleRaw; ?>" />
										</a>
									<?php } else { ?>
										<div class="mwall-photo-link">
											<img src="<?php echo $item->itemImage; ?>" alt="<?php echo $item->itemTitleRaw; ?>" />
										</div>
									<?php } ?>
								</div>
								<?php if ($this->hoverBox) {
									$hover_style = $this->animated . ' background-color: rgba(' . $this->hb_bg_class . ',' . $this->hb_bg_opacity_class . ');'; ?>
									<div class="mwall-hover-box <?php echo $this->hoverClass; ?>" style="<?php echo $hover_style; ?>">
										<div class="mwall-hover-box-content">
											<?php if ($this->hoverBoxDate && isset($item->itemDate)) { ?>
												<div class="mwall-date">
													<?php echo $item->itemDate; ?>
												</div>
											<?php }

											if ($this->hoverBoxTitle) { ?>
												<h3 class="mwall-title">
													<?php if (isset($item->itemLink) && $this->detailBoxTitleLink) { ?>
														<a href="<?php echo $item->itemLink; ?>">
															<?php echo $item->hover_itemTitle; ?>
														</a>
													<?php } else { ?>
														<span><?php echo $item->hover_itemTitle; ?></span>
													<?php } ?>
												</h3>
											<?php }

											if ($this->hoverBoxCategory || $this->hoverBoxAuthor) { ?>
												<div class="mwall-item-info">
													<?php if (!empty($item->itemCategoriesRaw) && $this->hoverBoxCategory) { ?>
														<p class="mwall-item-category">
															<span><?php echo Text::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?> </span>
														</p>
													<?php }

													if (!empty($item->itemAuthorRaw) && $this->hoverBoxAuthor) { ?>
														<p class="mwall-item-author">
															<span><?php echo Text::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span>
														</p>
													<?php } ?>
												</div>
												<?php
											}

											if ($this->hoverBoxIntrotext) {
												if (!empty($item->hover_itemIntrotext)) { ?>
													<div class="mwall-desc">
														<?php echo $item->hover_itemIntrotext; ?>
													</div>
												<?php }
											}

											if ($this->hoverBoxHits && isset($item->itemHits)) { ?>
												<div class="mwall-hits">
													<p><?php echo $item->itemHits; ?>&nbsp;<?php echo Text::_('COM_MINITEKWALL_HITS'); ?></p>
												</div>
											<?php }

											if ($this->hoverBoxLinkButton || $this->hoverBoxZoomButton) { ?>
												<div class="mwall-item-icons">
													<?php if ($this->hoverBoxLinkButton) {
														if (isset($item->itemLink)) { ?>
															<a href="<?php echo $item->itemLink; ?>" class="mwall-item-link-icon">
																<i class="fa fa-link"></i>
															</a>
														<?php }
													}

													if ($this->hoverBoxZoomButton && !empty($item->itemImage)) { ?>
														<a data-bs-toggle="modal" data-bs-target="#zoomWall_<?php echo $this->item->id; ?>" class="mwall-zoom mwall-item-zoom-icon" data-src="<?php echo URI::root() . '' . $item->itemImageRaw; ?>" data-mw-title="<?php echo $item->itemTitle; ?>">
															<i class="fa fa-search"></i>
														</a>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php }

					$item_inner_class =  $options['title_class'] . ' '
						. $options['introtext_class'] . ' '
						. $options['date_class'] . ' '
						. $options['category_class'] . ' '
						. $options['author_class'] . ' '
						. $options['tags_class'] . ' '
						. $options['hits_class'] . ' '
						. $options['readmore_class'];

					if ($empty_media) {
						$item_inner_class .= ' mwall-no-image';
					}

					if ($this->detailBoxAll) { ?>
						<div class="mwall-item-inner mwall-detail-box <?php echo $item_inner_class; ?>">
							<?php if ($this->detailBoxDateAll && isset($item->itemDate)) { ?>
								<div class="mwall-date">
									<?php echo $item->itemDate; ?>
								</div>
							<?php }

							if ($this->detailBoxTitleAll) { ?>
								<h3 class="mwall-title">
									<?php if (isset($item->itemLink) && $this->detailBoxTitleLink) { ?>
										<a href="<?php echo $item->itemLink; ?>">
											<?php echo $item->itemTitle; ?>
										</a>
									<?php } else { ?>
										<span><?php echo $item->itemTitle; ?></span>
									<?php } ?>
								</h3>
							<?php }

							if (($this->detailBoxCategoryAll && !empty($item->itemCategoriesRaw)) ||
								($this->detailBoxAuthorAll && !empty($item->itemAuthorRaw)) ||
								($this->detailBoxTagsAll && !empty($item->itemTags) && isset($item->itemTagsLayout))
							) { ?>
								<div class="mwall-item-info">
									<?php if ($this->detailBoxCategoryAll && !empty($item->itemCategoriesRaw)) { ?>
										<p class="mwall-item-category">
											<span><?php echo Text::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?> </span>
										</p>
									<?php }

									if ($this->detailBoxAuthorAll && !empty($item->itemAuthorRaw)) { ?>
										<p class="mwall-item-author">
											<span><?php echo Text::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span>
										</p>
									<?php }

									if ($this->detailBoxTagsAll && !empty($item->itemTags) && isset($item->itemTagsLayout)) { ?>
										<div class="mwall-item-tags">
											<?php echo $item->itemTagsLayout; ?>
										</div>
									<?php } ?>
								</div>
							<?php }

							if ($this->detailBoxIntrotextAll && !empty($item->itemIntrotext)) { ?>
								<div class="mwall-desc">
									<?php echo $item->itemIntrotext; ?>
								</div>
							<?php }

							if ($this->detailBoxHitsAll && isset($item->itemHits)) { ?>
								<div class="mwall-hits">
									<p><?php echo $item->itemHits; ?>&nbsp;<?php echo Text::_('COM_MINITEKWALL_HITS'); ?></p>
								</div>
								<?php
							}

							if ($this->detailBoxReadmoreAll) {
								if (isset($item->itemLink)) { ?>
									<div class="mwall-readmore">
										<a href="<?php echo $item->itemLink; ?>"><?php echo Text::_('COM_MINITEKWALL_READ_MORE'); ?></a>
									</div>
							<?php
								}
							} ?>
						</div>
						<?php
					}

					if ($empty_media) {
						if ($this->hoverBox) {
							$hover_style = $this->animated . ' background-color: rgba(' . $this->hb_bg_class . ',' . $this->hb_bg_opacity_class . ');'; ?>
							<div class="mwall-hover-box <?php echo $this->hoverClass; ?>" style="<?php echo $hover_style; ?>">
								<div class="mwall-hover-box-content">
									<?php if ($this->hoverBoxDate && isset($item->itemDate)) { ?>
										<div class="mwall-date">
											<?php echo $item->itemDate; ?>
										</div>
									<?php }

									if ($this->hoverBoxTitle) { ?>
										<h3 class="mwall-title">
											<?php if (isset($item->itemLink) && $this->detailBoxTitleLink) { ?>
												<a href="<?php echo $item->itemLink; ?>">
													<?php echo $item->hover_itemTitle; ?>
												</a>
											<?php } else { ?>
												<span><?php echo $item->hover_itemTitle; ?></span>
											<?php } ?>
										</h3>
									<?php }

									if ($this->hoverBoxCategory || $this->hoverBoxAuthor) { ?>
										<div class="mwall-item-info">
											<?php if (!empty($item->itemCategoriesRaw) && $this->hoverBoxCategory) { ?>
												<p class="mwall-item-category">
													<span><?php echo Text::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?> </span>
												</p>
											<?php }

											if (!empty($item->itemAuthorRaw) && $this->hoverBoxAuthor) { ?>
												<p class="mwall-item-author">
													<span><?php echo Text::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span>
												</p>
											<?php } ?>
										</div>
										<?php
									}

									if ($this->hoverBoxIntrotext) {
										if (!empty($item->hover_itemIntrotext)) { ?>
											<div class="mwall-desc">
												<?php echo $item->hover_itemIntrotext; ?>
											</div>
										<?php }
									}

									if ($this->hoverBoxHits && isset($item->itemHits)) { ?>
										<div class="mwall-hits">
											<p><?php echo $item->itemHits; ?>&nbsp;<?php echo Text::_('COM_MINITEKWALL_HITS'); ?></p>
										</div>
									<?php }

									if ($this->hoverBoxLinkButton || $this->hoverBoxZoomButton) { ?>
										<div class="mwall-item-icons">
											<?php if ($this->hoverBoxLinkButton) {
												if (isset($item->itemLink)) { ?>
													<a href="<?php echo $item->itemLink; ?>" class="mwall-item-link-icon">
														<i class="fa fa-link"></i>
													</a>
												<?php }
											}

											if ($this->hoverBoxZoomButton && !empty($item->itemImage)) { ?>
												<a data-bs-toggle="modal" data-bs-target="#zoomWall_<?php echo $this->item->id; ?>" class="mwall-zoom mwall-item-zoom-icon" data-src="<?php echo URI::root() . '' . $item->itemImageRaw; ?>" data-mw-title="<?php echo $item->itemTitle; ?>">
													<i class="fa fa-search"></i>
												</a>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							</div>
					<?php
						}
					} ?>
				</div>
			</div>
		</div>
<?php
	}
} else {
	echo '-'; // =0 // for javascript purposes - Do not remove
}
