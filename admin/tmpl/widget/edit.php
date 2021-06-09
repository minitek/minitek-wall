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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');

$user = Factory::getUser();
$canCreate = $user->authorise('core.create', 'com_minitekwall');
$isNew = ($this->item->id == 0);
?>

<?php // Select Source
if (!$this->source_id || $this->app->input->get('page') == 'source') {
	echo $this->loadTemplate('source');
	return;
}

// Module (modal)
if ($canCreate && !$isNew) {
	echo $this->loadTemplate('module');
}
?>

<form action="<?php echo Route::_('index.php?option=com_minitekwall&view=widget&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="widget-form" class="form-validate">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div class="card mb-4">
		<div class="card-header">
			<div class="w-100">
				<?php if ($isNew) {
					$link = Route::_('index.php?option=com_minitekwall&view=widget&layout=edit&page=source');
				} else {
					$link = Route::_('index.php?option=com_minitekwall&view=widget&layout=edit&page=source&id=' . (int) $this->item->id);
				} ?>
				<h3 class="m-0 float-start">
					<span class="text-muted" style="font-weight: 500;"><?php echo Text::_('COM_MINITEKWALL_WIDGET_DATA_SOURCE'); ?>:</span>&nbsp;
					<?php echo $this->source_name; ?>
				</h3>
				<a href="<?php echo $link; ?>" class="btn btn-info btn-sm float-end">
					<span class="icon-edit" aria-hidden="true"></span>&nbsp;
					<?php echo Text::_('COM_MINITEKWALL_WIDGET_CHANGE_DATA_SOURCE'); ?>
				</a>
			</div>
		</div>
	</div>

	<div class="main-card">
		<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'general', Text::_('COM_MINITEKWALL_FIELDSET_GENERAL')); ?>
		<div class="row">
			<div class="col-lg-9">
				<div>
					<div class="card-body">
						<fieldset class="adminform">
							<?php echo $this->form->renderField('description'); ?>
						</fieldset>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="bg-white px-3">
					<?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
				</div>
			</div>
		</div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'datasource', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_DATA_SOURCE')); ?>
		<?php foreach ($this->sources as $source) { ?>
			<?php if ($this->source_id == $source['type']) { ?>
				<div class="row">
					<div class="col-12">
						<?php foreach ($this->form->getFieldset($source['type'] . '_source') as $field) : ?>
							<?php if ($field->name == 'jform[source_params][source_type]') {
								continue;
							} ?>
							<?php echo $field->renderField(); ?>
						<?php endforeach; ?>
						<input type="hidden" name="jform[source_params][source_type]" value="<?php echo $source['type']; ?>">
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php echo $this->loadTemplate('masonry'); ?>

		<?php echo HTMLHelper::_('uitab.endTabSet'); ?>

		<input type="hidden" name="source_type" value="" />
		<input type="hidden" name="task" value="">
		<input type="hidden" id="jform_source_id" name="jform[source_id]" value="<?php echo $this->source_id; ?>">

		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>