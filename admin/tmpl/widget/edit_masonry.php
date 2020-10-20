<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_layout', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_LAYOUT')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_layout" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_layout'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_image_settings', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_IMAGES')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_image_settings" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_image_settings'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_detailbox', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_DETAIL_BOX')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_detailbox_general" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_detailbox_general'); ?>
				</div>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_detailbox_big" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_detailbox_big'); ?>
				</div>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_detailbox_landscape" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_detailbox_landscape'); ?>
				</div>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_detailbox_portrait" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_detailbox_portrait'); ?>
				</div>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_detailbox_small" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_detailbox_small'); ?>
				</div>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_detailbox_column" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_detailbox_column'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_hoverbox', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_HOVER_BOX')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_hoverbox" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_hoverbox'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_pagination', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_PAGINATION')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_pagination" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_pagination'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_filters', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_FILTERS_AND_SORTINGS')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_filters" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_filters'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_effects', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_EFFECTS')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_effects" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_effects'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'masonry_responsive_settings', Text::_('COM_MINITEKWALL_WIDGET_FIELDSET_RESPONSIVE')); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-masonry_responsive_settings" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->masonryform->renderFieldset('masonry_responsive_settings'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>
