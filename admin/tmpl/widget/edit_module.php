<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$isNew = ($this->item->id == 0);
$moduleInstalled = $this->moduleInstalled;
?>

<div class="modal fade" id="createModule" role="dialog" aria-labelledby="createModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg jviewport-width80" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h3 class="modal-title" id="createModuleLabel">
					<?php echo Text::_('COM_MINITEKWALL_MODAL_PUBLISH_WIDGET_IN_MODULE'); ?>
				</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="<?php echo Text::_('COM_MINITEKWALL_MODAL_CLOSE'); ?>">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="mn-modal">

					<div class="row">

						<?php if (!$moduleInstalled) { ?>

							<div class="col-12 text-center">
								<h3 class="m-3"><?php echo Text::_('COM_MINITEKWALL_MODAL_MODULE_NOT_FOUND'); ?></h3>
								<p><?php echo Text::_('COM_MINITEKWALL_MODAL_MODULE_NOT_FOUND_DESC'); ?></p>
								<a class="button-success btn btn-sm btn-success m-3" href="<?php echo JRoute::_('index.php?option=com_installer'); ?>">
									<span class="icon-download" aria-hidden="true"></span>
									<?php echo JText::_('COM_MINITEKWALL_MODAL_MODULE_INSTALL'); ?>
								</a>
							</div>

						<?php } else if ($moduleInstalled && !$isNew) { ?>

							<div class="col-12 col-md-6">
								<div class="text-center">
									<h3 class="m-3"><?php echo Text::_('COM_MINITEKWALL_MODAL_IN_MODULE_POSITION'); ?></h3>
									<p><?php echo Text::_('COM_MINITEKWALL_MODAL_IN_MODULE_POSITION_DESC'); ?></p>
									<button class="button-success btn btn-sm btn-success m-2" data-toggle="modal" data-target="#createModule" onclick="Joomla.submitbutton('widget.createModule')">
										<span class="icon-ok" aria-hidden="true"></span>
										<?php echo Text::_('COM_MINITEKWALL_MODAL_CREATE_MODULE'); ?>
									</button>
								</div>
							</div>

							<div class="col-12 col-md-6">
								<div class="text-center">
									<h3 class="m-3"><?php echo Text::_('COM_MINITEKWALL_MODAL_LOAD_POSITION_PLUGIN'); ?></h3>
									<p><?php echo Text::_('COM_MINITEKWALL_MODAL_LOAD_POSITION_PLUGIN_DESC'); ?></p>
									<button class="button-success btn btn-sm btn-success m-2" data-toggle="modal" data-target="#createModule" onclick="Joomla.submitbutton('widget.createModuleforPlugin')">
										<span class="icon-ok" aria-hidden="true"></span>
										<?php echo Text::_('COM_MINITEKWALL_MODAL_CREATE_MODULE'); ?>
									</button>
									<div class="alert alert-info" role="alert">
										<p><small><?php echo Text::_('COM_MINITEKWALL_MODAL_MODULE_SYNTAX'); ?></small></p>
										<p class="lead">&#123;loadposition minitekwall-<?php echo $this->item->id; ?>&#125;</p>
									</div>
								</div>
							</div>

						<?php } ?>

					</div>

				</div>

			</div>

		</div>
	</div>
</div>
