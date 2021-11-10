<?php

/**
 * @title        Minitek Wall
 * @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
 * @license      GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

// Page title
if ($this->mas_page_title) {
	if ($this->params->get('show_page_heading', 1)) {
		$app = \JFactory::getApplication();
		$menu = $app->getMenu();
		$active = $menu->getActive();

		if ($active->params->get('page_heading')) {
			$page_heading = $active->params->get('page_heading');
		} else {
			$doc = \JFactory::getDocument();
			$page_heading = $doc->getTitle();
		}

?><div class="page-header">
			<h1><?php echo $this->escape($page_heading); ?></h1>
		</div><?php
			}
		}

		// Suffix
		$suffix = '';

		if (isset($this->suffix)) {
			$suffix = $this->suffix;
		}

				?><div class="mnwall_loader mas_loader" id="mnwall_loader_<?php echo $this->widgetID; ?>"> </div>
<div id="mnwall_container_<?php echo $this->widgetID;
							?>" class="mnwall_container mnwall-<?php echo $this->mnwall_layout;
																?> <?php echo $this->mnwall_grid;
																	?> <?php echo $suffix;
																		?>" data-order="<?php echo $this->active_ordering;
																						?>" data-direction="<?php
																											echo $this->active_direction; ?>">
	<?php

	if (isset($this->filters) || isset($this->sortings)) {
	?><div class="mnwall_filters_sortings">
			<?php

			// Filters
			if (isset($this->filters)) {
			?><div id="mnwall_iso_filters_cont_<?php
												echo $this->widgetID; ?>" class="mnwall_iso_filters_cont">
					<div id="mnwall_iso_filters_<?php
												echo $this->widgetID; ?>" class="mnwall_iso_filters">
						<?php
						echo $this->loadTemplate('filters');
						?></div>
				</div>
			<?php
			}

			// Sortings
			if (isset($this->sortings)) {
			?><div id="mnwall_iso_sortings_cont_<?php
												echo $this->widgetID; ?>" class="mnwall_iso_sortings_cont">
					<div id="mnwall_iso_sortings_<?php
													echo $this->widgetID; ?>" class="mnwall_iso_sortings">
						<?php
						echo $this->loadTemplate('sortings');
						?></div>
				</div>
			<?php
			}

			// Reset button
			if ($this->resetButton && (isset($this->filters) || isset($this->sortings))) {
			?><div class="mnwall_iso_reset_cont">
					<div class="mnwall_iso_reset">
						<button class="btn-reset" id="mnwall_reset_<?php echo $this->widgetID; ?>">
							<i class="fa fa-times"></i> <?php echo \JText::_('COM_MINITEKWALL_RESET'); ?>
						</button>
					</div>
				</div>
			<?php
			}

			?></div>
	<?php
	}

	// Masonry Container
	?><div id="mnwall_iso_container_<?php
									echo $this->widgetID; ?>" class="mnwall_iso_container" style="margin: -<?php echo (int)$this->gutter; ?>px;">
		<?php
		echo $this->loadTemplate($this->mnwall_layout);
		?></div>
	<?php

	// Modal images
	if ($this->hoverBox && $this->hoverBoxZoomButton && $this->mas_images) {
		echo HTMLHelper::_(
			'bootstrap.renderModal',
			'zoomWall_' . $this->widgetID,
			[
				'title'       => $this->modalTitle ? '' : null,
				'closeButton' => true,
				'height'      => '100%',
				'width'       => 'auto',
			],
			'<img src="">'
		);
	}
	?></div>