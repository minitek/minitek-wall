<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

if (!empty($this->wall) ||  $this->wall!== 0)
{
	$options = $this->getColumnsItemOptions();

	// Extra css
	$this->model->responsive_masonry->masonryItemCss($this->masonry_params, $this->widgetID);

	foreach ($this->wall as $key => $item)
	{
		// Cat Filters
		$catfilter = '';

		if (!empty($item->itemCategoriesRaw))
		{
			foreach ($item->itemCategoriesRaw as $category)
			{
				if (is_array($category) && isset($category['title']))
				{
					$catfilter .= ' cat-'.$this->utilities->cleanName($category['title']);
				}
			}
		}

		// Tag Filters
		$tagfilter = '';

		if (!empty($item->itemTags))
		{
			foreach ($item->itemTags as $tag_name)
			{
				$tagfilter .= ' tag-'.$this->utilities->cleanName($tag_name->title);
			}
		}

		// Date Filters
		$datefilter = '';

		if (!empty($item->itemDateRaw))
		{
			$datefilter .= ' date-'.\JHTML::_('date', $item->itemDateRaw, 'Y-m');
		}

		$empty_media = !$this->mas_images || ($this->mas_images == '1' && empty($item->itemImage));

		?><div class="mwall-item <?php 
			echo $catfilter; ?> <?php 
			echo $tagfilter; ?> <?php 
			echo $datefilter; ?> <?php 
			echo $this->hoverOffset; ?>" style="padding: <?php 
			echo (int)$this->gutter; ?>px; <?php 
			echo $this->cols; ?>" <?php 
			if (isset($item->itemID)) 
			{
				?>data-id="<?php echo (int)$item->itemID; ?>" <?php 
			}
			?>data-mw-title="<?php echo $item->itemTitleRaw; ?>" <?php 
			if (isset($item->itemDateRaw)) 
			{
				?>data-date="<?php echo $item->itemDateRaw; ?>" <?php
			}
			if (isset($item->itemHits)) 
			{
				?>data-hits="<?php echo (int)$item->itemHits; ?>" <?php 
			}
			if (isset($item->itemOrdering)) 
			{
				?>data-ordering="<?php echo (int)$item->itemOrdering; ?>" <?php 
			}
			if (isset($item->itemFOrdering)) 
			{
				?>data-fordering="<?php echo (int)$item->itemFOrdering; ?>" <?php 
			}
			if (isset($item->itemAlias)) 
			{
				?>data-alias="<?php echo $item->itemAlias; ?>" <?php 
			}
			if (isset($item->itemModified)) 
			{
				?>data-modified="<?php echo $item->itemModified; ?>" <?php 
			}
			if (isset($item->itemStart)) 
			{
				?>data-start="<?php echo $item->itemStart; ?>" <?php 
			}
			if (isset($item->itemFinish)) 
			{
				?>data-finish="<?php echo $item->itemFinish; ?>" <?php 
			}
			if (isset($item->rawIndex)) 
			{
				?>data-index="<?php echo $item->rawIndex; ?>"<?php 
			} 
			?>><?php 

			?><div class="mwall-item-outer-cont <?php
				if ($this->detailBoxColumns && !$empty_media)
				{
					echo $options['position_class'];
				}
				?>" style="<?php echo $this->animated_flip; ?>"><?php 

				?><div class="mwall-item-inner-cont" style="<?php 
					if ($this->mas_border_radius) 
					{
						?>border-radius: <?php echo $this->mas_border_radius; ?>px; <?php 
					}
					if ($this->mas_border) 
					{
						?>border: <?php echo $this->mas_border; ?>px solid <?php echo $this->mas_border_color; ?>;<?php 
					}
					?>"><?php

					if (!$empty_media) 
					{
						?><div class="mwall-cover <?php echo $this->hoverOffset; ?> <?php echo $this->perspective; ?>">
							<div class="mwall-img-div <?php echo $this->flipBase; ?> <?php echo $this->flipClass; ?>" style="<?php 
								echo $this->animated_flip;
								
								if ($options['position_class'] != 'content-below') 
								{
									if ($this->mas_border_radius) 
									{
										?> border-radius: <?php echo $this->mas_border_radius; ?>px;<?php 
									}
									if ($this->mas_border) 
									{
										?> border: <?php echo $this->mas_border; ?>px solid <?php echo $this->mas_border_color; ?>;<?php 
									}
								}
								?>"><?php

								?><div class="mwall-item-img"><?php 
									if (isset($item->itemLink) && $this->mas_image_link) 
									{
										?><a href="<?php echo $item->itemLink; ?>" class="mwall-photo-link">
											<img src="<?php echo $item->itemImage; ?>" alt="<?php echo $item->itemTitleRaw; ?>" />
										</a><?php 
									} 
									else 
									{
										?><div class="mwall-photo-link">
											<img src="<?php echo $item->itemImage; ?>" alt="<?php echo $item->itemTitleRaw; ?>" />
										</div><?php 
									}
								?></div><?php

								if ($options['position_class'] != 'content-below' && $this->detailBoxAll) 
								{
									?><div class="mwall-item-inner mwall-detail-box <?php 
										echo $options['title_class']; ?> <?php 
										echo $options['introtext_class']; ?> <?php 
										echo $options['date_class']; ?> <?php 
										echo $options['category_class']; ?> <?php 
										echo $options['author_class']; ?> <?php 
										echo $options['tags_class']; ?> <?php 
										echo $options['hits_class']; ?> <?php 
										echo $options['count_class']; ?> <?php 
										echo $options['readmore_class']; ?> <?php 

										if ($empty_media)
										{
											echo 'mwall-no-image';
										}
										?>" style="background-color: rgba(<?php echo $options['db_bg_class']; ?>,<?php echo $options['db_bg_opacity_class']; ?>);"><?php 
										
										if ($this->detailBoxDateAll && isset($item->itemDate)) 
										{
											?><div class="mwall-date"><?php 
												echo $item->itemDate; 
											?></div><?php 
										}

										if ($this->detailBoxTitleAll) 
										{
											?><h3 class="mwall-title"><?php 
												if (isset($item->itemLink) && $this->detailBoxTitleLink) 
												{
													?><a href="<?php echo $item->itemLink; ?>"><?php 
														echo $item->itemTitle; 
													?></a><?php 
												} 
												else 
												{
													?><span><?php 
														echo $item->itemTitle; 
													?></span><?php 
												}
											?></h3><?php
										}

										if (($this->detailBoxCategoryAll && !empty($item->itemCategoriesRaw)) || 
											($this->detailBoxAuthorAll && !empty($item->itemAuthorRaw)) || 
											($this->detailBoxTagsAll && !empty($item->itemTags) && isset($item->itemTagsLayout))) 
										{
											?><div class="mwall-item-info"><?php 
												if ($this->detailBoxCategoryAll && !empty($item->itemCategoriesRaw)) 
												{
													?><p class="mwall-item-category">
														<span><?php echo \JText::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?></span><?php 
													?></p><?php 
												}

												if ($this->detailBoxAuthorAll && !empty($item->itemAuthorRaw)) 
												{
													?><p class="mwall-item-author">
														<span><?php echo \JText::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span><?php 
													?></p><?php 
												}

												if ($this->detailBoxTagsAll && !empty($item->itemTags) && isset($item->itemTagsLayout)) 
												{
													?><div class="mwall-item-tags"><?php
														echo $item->itemTagsLayout;
													?></div><?php
												}
											?></div><?php 
										}

										if ($this->detailBoxIntrotextAll && !empty($item->itemIntrotext)) 
										{
											?><div class="mwall-desc"><?php 
												echo $item->itemIntrotext; 
											?></div><?php 
										}

										if ($this->detailBoxHitsAll && isset($item->itemHits)) 
										{
											?><div class="mwall-hits">
												<p><?php echo $item->itemHits; ?>&nbsp;<?php echo \JText::_('COM_MINITEKWALL_HITS'); ?></p>
											</div><?php 
										}

										if ($this->detailBoxCountAll && isset($item->itemCount)) 
										{
											?><div class="mwall-count">
												<p><?php echo $item->itemCount; ?></p>
											</div><?php 
										}

										if ($this->detailBoxReadmoreAll) 
										{
											if (isset($item->itemLink)) 
											{
												?><div class="mwall-readmore">
													<a href="<?php echo $item->itemLink; ?>"><?php echo \JText::_('COM_MINITEKWALL_READ_MORE'); ?></a>
												</div><?php 
											}
										}
									?></div><?php 
								}

								if ($this->hoverBox) 
								{
									?><div class="mwall-hover-box <?php echo $this->hoverClass; ?>" style="<?php 
										echo $this->animated;
										?> background-color: rgba(<?php echo $this->hb_bg_class; ?>,<?php echo $this->hb_bg_opacity_class; ?>);"><?php

										?><div class="mwall-hover-box-content"><?php 
											if ($this->hoverBoxDate && isset($item->itemDate)) 
											{
												?><div class="mwall-date"><?php 
													echo $item->itemDate; 
												?></div><?php 
											}

											if ($this->hoverBoxTitle) 
											{
												?><h3 class="mwall-title"><?php 
													if (isset($item->itemLink) && $this->detailBoxTitleLink) 
													{
														?><a href="<?php echo $item->itemLink; ?>"><?php 
															echo $item->hover_itemTitle; ?>
														</a><?php 
													} 
													else 
													{
														?><span><?php 
															echo $item->hover_itemTitle; 
														?></span><?php 
													}
												?></h3><?php 
											}

											if ($this->hoverBoxCategory || $this->hoverBoxAuthor) 
											{
												?><div class="mwall-item-info"><?php 
													if (!empty($item->itemCategoriesRaw) && $this->hoverBoxCategory) 
													{
														?><p class="mwall-item-category">
															<span><?php echo \JText::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?> </span><?php 
														?></p><?php 
													}

													if (!empty($item->itemAuthorRaw) && $this->hoverBoxAuthor) 
													{
														?><p class="mwall-item-author">
															<span><?php echo \JText::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span><?php 
														?></p><?php 
													}
												?></div><?php 
											}

											if ($this->hoverBoxIntrotext) 
											{
												if (!empty($item->hover_itemIntrotext)) 
												{
													?><div class="mwall-desc"><?php 
														echo $item->hover_itemIntrotext; 
													?></div><?php 
												}
											}

											if ($this->hoverBoxHits && isset($item->itemHits)) 
											{
												?><div class="mwall-hits">
													<p><?php echo $item->itemHits; ?>&nbsp;<?php echo \JText::_('COM_MINITEKWALL_HITS'); ?></p>
												</div><?php 
											}

											if ($this->hoverBoxLinkButton || $this->hoverBoxZoomButton) 
											{
												?><div class="mwall-item-icons"><?php 
													if ($this->hoverBoxLinkButton) 
													{
														if (isset($item->itemLink)) 
														{
															?><a href="<?php echo $item->itemLink; ?>" class="mwall-item-link-icon">
																<i class="fa fa-link"></i>
															</a><?php 
														}
													}

													if ($this->hoverBoxZoomButton && $this->mas_images == '1' && !empty($item->itemImage)) 
													{
														?><a data-bs-toggle="modal" data-bs-target="#zoomWall_<?php echo $this->widgetID; ?>" class="mwall-zoom mwall-item-zoom-icon" data-src="<?php echo JURI::root().''.$item->itemImageRaw; ?>" data-title="<?php echo $item->itemTitle; ?>">
															<i class="fa fa-search"></i>
														</a><?php 
													}
												?></div><?php 
											}
										?></div>
									</div><?php 
								}
							?></div>
						</div><?php 
					}

					if ($empty_media || ($this->detailBoxAll && ($options['position_class'] == 'content-below')))
					{
						?><div class="mwall-item-inner mwall-detail-box <?php 
							echo $options['title_class']; ?> <?php 
							echo $options['introtext_class']; ?> <?php 
							echo $options['date_class']; ?> <?php 
							echo $options['category_class']; ?> <?php 
							echo $options['author_class']; ?> <?php 
							echo $options['tags_class']; ?> <?php 
							echo $options['hits_class']; ?> <?php 
							echo $options['count_class']; ?> <?php 
							echo $options['readmore_class']; ?> <?php 

							if ($empty_media)
							{
								echo 'mwall-no-image';
							}
							?>" style="background-color: rgba(<?php echo $options['db_bg_class']; ?>,<?php echo $options['db_bg_opacity_class']; ?>);"><?php 
							
							if ($this->detailBoxDateAll && isset($item->itemDate)) 
							{
								?><div class="mwall-date"><?php 
									echo $item->itemDate; 
								?></div><?php 
							}

							if ($this->detailBoxTitleAll) 
							{
								?><h3 class="mwall-title"><?php 
									if (isset($item->itemLink) && $this->detailBoxTitleLink) 
									{
										?><a href="<?php echo $item->itemLink; ?>"><?php 
											echo $item->itemTitle; 
										?></a><?php 
									} 
									else 
									{
										?><span><?php 
											echo $item->itemTitle; 
										?></span><?php 
									}
								?></h3><?php 
							}

							if (($this->detailBoxCategoryAll && !empty($item->itemCategoriesRaw)) || 
								($this->detailBoxAuthorAll && !empty($item->itemAuthorRaw)) ||
								($this->detailBoxTagsAll && !empty($item->itemTags) && isset($item->itemTagsLayout))) 
							{
								?><div class="mwall-item-info"><?php 
									if ($this->detailBoxCategoryAll && !empty($item->itemCategoriesRaw))
									{
										?><p class="mwall-item-category">
											<span><?php echo \JText::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?> </span><?php 
										?></p><?php 
									}

									if ($this->detailBoxAuthorAll && !empty($item->itemAuthorRaw)) 
									{
										?><p class="mwall-item-author">
											<span><?php echo \JText::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span><?php 
										?></p><?php 
									}

									if ($this->detailBoxTagsAll && !empty($item->itemTags) && isset($item->itemTagsLayout)) 
									{
										?><div class="mwall-item-tags"><?php
											echo $item->itemTagsLayout;
										?></div><?php
									}
								?></div><?php 
							}
							
							if ($this->detailBoxIntrotextAll && !empty($item->itemIntrotext)) 
							{
								?><div class="mwall-desc"><?php 
									echo $item->itemIntrotext; 
								?></div><?php 
							}

							if ($this->detailBoxHitsAll && isset($item->itemHits)) 
							{
								?><div class="mwall-hits">
									<p><?php echo $item->itemHits; ?>&nbsp;<?php echo \JText::_('COM_MINITEKWALL_HITS'); ?></p>
								</div><?php 
							}

							if ($this->detailBoxCountAll && isset($item->itemCount)) 
							{
								?><div class="mwall-count">
									<p><?php echo $item->itemCount; ?></p>
								</div><?php 
							}

							if ($this->detailBoxReadmoreAll) 
							{
								if (isset($item->itemLink)) 
								{
									?><div class="mwall-readmore">
										<a href="<?php echo $item->itemLink; ?>"><?php echo \JText::_('COM_MINITEKWALL_READ_MORE'); ?></a>
									</div><?php 
								}
							}
						?></div><?php 
					}

					if ($empty_media)
					{
						if ($this->hoverBox) 
						{
							?><div class="mwall-hover-box <?php echo $this->hoverClass; ?>" style="<?php 
								echo $this->animated; 
								?> background-color: rgba(<?php echo $this->hb_bg_class; ?>,<?php echo $this->hb_bg_opacity_class; ?>);"><?php 

								?><div class="mwall-hover-box-content"><?php 
									if ($this->hoverBoxDate && isset($item->itemDate)) 
									{
										?><div class="mwall-date"><?php 
											echo $item->itemDate; 
										?></div><?php 
									}

									if ($this->hoverBoxTitle) 
									{
										?><h3 class="mwall-title"><?php 
											if (isset($item->itemLink) && $this->detailBoxTitleLink) 
											{
												?><a href="<?php echo $item->itemLink; ?>"><?php 
													echo $item->hover_itemTitle; 
												?></a><?php 
											}
											else 
											{
												?><span><?php 
													echo $item->hover_itemTitle; 
												?></span><?php 
											}
										?></h3><?php 
									}

									if ($this->hoverBoxCategory || $this->hoverBoxAuthor) 
									{
										?><div class="mwall-item-info"><?php 
											if (!empty($item->itemCategoriesRaw) && $this->hoverBoxCategory) 
											{
												?><p class="mwall-item-category">
													<span><?php echo \JText::sprintf('COM_MINITEKWALL_IN_CATEGORIES', $item->itemCategory); ?> </span><?php 
												?></p><?php 
											}

											if (!empty($item->itemAuthorRaw)  && $this->hoverBoxAuthor) 
											{
												?><p class="mwall-item-author">
													<span><?php echo \JText::sprintf('COM_MINITEKWALL_BY_AUTHOR', $item->itemAuthor); ?> </span>
												</p><?php 
											}
										?></div><?php 
									}

									if ($this->hoverBoxIntrotext) 
									{
										if (!empty($item->hover_itemIntrotext)) 
										{
											?><div class="mwall-desc"><?php 
												echo $item->hover_itemIntrotext; 
											?></div><?php 
										}
									}

									if ($this->hoverBoxHits && isset($item->itemHits)) 
									{
										?><div class="mwall-hits">
											<p><?php echo $item->itemHits; ?>&nbsp;<?php echo \JText::_('COM_MINITEKWALL_HITS'); ?></p>
										</div><?php 
									}

									if ($this->hoverBoxLinkButton || $this->hoverBoxZoomButton) 
									{
										?><div class="mwall-item-icons"><?php 
											if ($this->hoverBoxLinkButton) 
											{
												if (isset($item->itemLink)) 
												{
													?><a href="<?php echo $item->itemLink; ?>" class="mwall-item-link-icon">
														<i class="fa fa-link"></i>
													</a><?php 
												}
											}

											if ($this->hoverBoxZoomButton && $this->mas_images == '1' && !empty($item->itemImage)) 
											{
												?><a data-bs-toggle="modal" data-bs-target="#zoomWall_<?php echo $this->widgetID; ?>" class="mwall-zoom mwall-item-zoom-icon" data-src="<?php echo JURI::root().''.$item->itemImageRaw; ?>" data-title="<?php echo $item->itemTitle; ?>">
													<i class="fa fa-search"></i>
												</a><?php 
											}
										?></div><?php 
									}
								?></div>
							</div><?php 
						}
					}
				?></div>
			</div>
		</div><?php
	}
} 
else 
{
	echo '-'; // =0 // for javascript purposes - Do not remove
}
