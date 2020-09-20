<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

Factory::getDocument()->addScriptDeclaration("
(function( $ ) {
	'use strict';

	$(function() {
		$('.btn-source').click(function () {
			var data_source = $(this).attr('data-source');
			$('input[name=\"source_type\"]').val(data_source);
			Joomla.submitbutton('widget.selectSource');
		});
	});

})( jQuery );
");
?>

<div class="card">
	<div class="card-header">
		<div class="d-flex justify-content-between">
			<h3 class="mb-0" style="line-height: 1.4;"><?php echo Text::_('COM_MINITEKWALL_WIDGET_SELECT_DATA_SOURCE'); ?></h3>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo Route::_('index.php?option=com_minitekwall&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="widget-form" class="form-validate">
			<?php if (isset($this->sources) && $this->sources && count($this->sources)) { ?>
				<div class="row">
					<?php foreach ($this->sources as $key => $source) { ?>
						<div class="col-12 col-md-4">
							<div class="source-tile p-4 text-center">
								<div class="source-icon mb-3">
									<img src="<?php echo $source['image']; ?>" alt="" />
								</div>
								<div class="source-title">
									<h4><?php echo $source['title']; ?></h4>
								</div>
								<?php if ($source['type'] == 'content') { ?>
									<button class="btn btn-success btn-source mt-3" data-source="content">
										<?php echo Text::_('COM_MINITEKWALL_SELECT'); ?>
									</button>
								<?php } else { ?>
									<a class="btn btn-info mt-3" href="https://www.minitek.gr/joomla/extensions/minitek-wall#subscriptionPlans" target="_blank">
										<span class="icon-lock"></span>&nbsp;&nbsp;<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_UPGRADE_TO_PRO'); ?>
									</a>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } else { ?>
				<div class="text-center">
					<h4 class="m-3"><?php echo Text::_('COM_MINITEKWALL_SOURCE_PLUGINS_NOT_INSTALLED'); ?></h4>
					<a href="<?php echo Route::_('index.php?option=com_plugins&view=plugins&filter[search]=Minitek%20Source&filter[folder]=content'); ?>" class="btn btn-info m-3" target="_blank">
						<span class="icon-cog" aria-hidden="true"></span>&nbsp;
						<?php echo Text::_('COM_MINITEKWALL_MANAGE_PLUGINS'); ?>
					</a>
					<a href="https://www.minitek.gr/joomla/source-plugins" class="btn btn-success m-3" target="_blank">
						<span class="icon-new" aria-hidden="true"></span>&nbsp;
						<?php echo Text::_('COM_MINITEKWALL_ADD_SOURCE_PLUGIN'); ?>
					</a>
				</div>
			<?php } ?>

			<input type="hidden" name="source_type" value="" />
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>
