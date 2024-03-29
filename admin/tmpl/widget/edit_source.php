<?php

/**
 * @title        Minitek Wall
 * @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
 * @license      GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\MinitekWall\Administrator\Helper\MinitekWallHelper;
?>

<div class="card">
	<div class="card-header">
		<div class="w-100">
			<h3 class="mb-0 float-start"><?php echo Text::_('COM_MINITEKWALL_WIDGET_SELECT_DATA_SOURCE'); ?></h3>
			<a href="https://www.minitek.gr/joomla/source-plugins" class="btn btn-info btn-sm float-end" target="_blank">
				<span class="fas fa-search" aria-hidden="true"></span>&nbsp;
				<?php echo Text::_('COM_MINITEKWALL_WIDGET_BROWSE_SOURCE_PLUGINS'); ?>
			</a>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo Route::_('index.php?option=com_minitekwall&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="widget-form" class="form-validate"><?php 
			// Core plugins 
			?><h4 class="header mx-3 my-0 p-3"><?php echo Text::_('COM_MINITEKWALL_WIDGET_CORE_PLUGINS'); ?></h4>
			<div class="row"><?php
				foreach ($this->corePlugins as $corePlugin) 
				{
					$corePluginEnabled = false;

					foreach ($this->sources as $source) 
					{
						// Is it a core plugin ?
						if ($corePlugin['type'] == $source['type']) 
						{
							if ($source['type'] == 'content') 
							{
								?><div class="col-12 col-md-3">
									<div class="source-tile p-4 text-center">
										<div class="source-icon mb-3">
											<img src="<?php echo $corePlugin['image']; ?>" alt="" />
										</div>
										<div class="source-title">
											<h4><?php echo $corePlugin['title']; ?></h4>
										</div>
										<button class="btn btn-success btn-source mt-3" data-source="<?php echo $corePlugin['type']; ?>">
											<span class="fas fa-check" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo Text::_('COM_MINITEKWALL_WIDGET_SELECT'); ?>
										</button>
									</div>
								</div><?php
							} 
							else 
							{
								?><div class="col-12 col-md-3">
									<div class="source-tile p-4 text-center">
										<div class="source-icon mb-3">
											<img src="<?php echo $corePlugin['image']; ?>" alt="" />
										</div>
										<div class="source-title">
											<h4><?php echo $corePlugin['title']; ?></h4>
										</div>
										<a href="<?php echo $corePlugin['downloadurl']; ?>" class="btn btn-info mt-3" target="_blank">
											<span class="fas fa-lock" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_UPGRADE_TO_PRO'); ?>
										</a>
									</div>
								</div><?php
							}

							$corePluginEnabled = true;

							break;
						}
					}

					if (!$corePluginEnabled) 
					{
						if ($corePlugin['type'] == 'content') 
						{
							// Installed and disabled
							if ($sourcePlugin = MinitekWallHelper::getSourcePlugin($corePlugin['type'])) 
							{
								$title = Text::_('COM_MINITEKWALL_WIDGET_PUBLISH');
								$icon = 'check';
								$url = Route::_('index.php?option=com_plugins&view=plugins&filter[search]=Minitek%20Source%20-%20' . $corePlugin['type'] . '&filter[folder]=content');
							} 
							else
							// Not installed
							{
								$title = Text::_('COM_MINITEKWALL_WIDGET_INSTALL');
								$icon = 'download';
								$url = $corePlugin['downloadurl'];
							}

							?><div class="col-12 col-md-3">
								<div class="source-tile p-4 text-center">
									<div class="source-icon mb-3">
										<img src="<?php echo $corePlugin['image']; ?>" alt="" />
									</div>
									<div class="source-title">
										<h4><?php echo $corePlugin['title']; ?></h4>
									</div>
									<a href="<?php echo $url; ?>" class="btn btn-info mt-3" target="_blank">
										<span class="fas fa-<?php echo $icon; ?>" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo $title; ?>
									</a>
								</div>
							</div><?php
						} 
						else 
						{
							?><div class="col-12 col-md-3">
								<div class="source-tile p-4 text-center">
									<div class="source-icon mb-3">
										<img src="<?php echo $corePlugin['image']; ?>" alt="" />
									</div>
									<div class="source-title">
										<h4><?php echo $corePlugin['title']; ?></h4>
									</div>
									<a href="<?php echo $corePlugin['downloadurl']; ?>" class="btn btn-info mt-3" target="_blank">
										<span class="fas fa-lock" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_UPGRADE_TO_PRO'); ?>
									</a>
								</div>
							</div><?php
						}
					}
				}
			?></div>

			<input type="hidden" name="source_type" value="" />
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>

<script>
	(function(document) {
		'use strict';

		document.addEventListener('DOMContentLoaded', function() {
			var btn_sources = document.querySelectorAll('.btn-source');

			if (btn_sources) {
				btn_sources.forEach(function(a) {
					a.addEventListener('click', function(e) {
						e.preventDefault();

						var data_source = a.getAttribute('data-source');
						document.querySelector('input[name=\"source_type\"]').value = data_source;
						Joomla.submitbutton('widget.selectSource');
					});
				});
			}
		});
	})(document);
</script><?php
