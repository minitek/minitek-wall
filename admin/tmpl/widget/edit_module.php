<?php

/**
 * @title        Minitek Wall
 * @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
 * @license      GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

$isNew = ($this->item->id == 0);
$moduleInstalled = $this->moduleInstalled;

$body = '<div class="container-fluid">'
	. '<div class="row">';

if (!$moduleInstalled) {
	$body .= '<div class="col-12 text-center">'
		. '<h3 class="m-3">' . Text::_('COM_MINITEKWALL_MODAL_MODULE_NOT_FOUND') . '</h3>'
		. '<p>' . Text::_('COM_MINITEKWALL_MODAL_MODULE_NOT_FOUND_DESC') . '</p>'
		. '<a class="button-success btn btn-sm btn-success m-3" href="https://www.minitek.gr/downloads/minitek-wall-module" target="_blank">'
		. '<span class="icon-download" aria-hidden="true"></span>'
		. Text::_('COM_MINITEKWALL_DASHBOARD_DOWNLOAD')
		. '</a>'
		. '</div>';
} else if ($moduleInstalled && !$isNew) {
	$body .= '<div class="col-12 col-md-6">'
		. '<div class="text-center">'
		. '<h3 class="m-3">' . Text::_('COM_MINITEKWALL_MODAL_IN_MODULE_POSITION') . '</h3>'
		. '<p>' . Text::_('COM_MINITEKWALL_MODAL_IN_MODULE_POSITION_DESC') . '</p>'
		. '<button class="button-success btn btn-sm btn-success m-2" data-toggle="modal" data-target="#createModule" onclick="Joomla.submitbutton(\'widget.createModule\')">'
		. '<span class="icon-ok" aria-hidden="true"></span>'
		. Text::_('COM_MINITEKWALL_MODAL_CREATE_MODULE')
		. '</button>'
		. '</div>'
		. '</div>'
		. '<div class="col-12 col-md-6">'
		. '<div class="text-center">'
		. '<h3 class="m-3">' . Text::_('COM_MINITEKWALL_MODAL_LOAD_POSITION_PLUGIN') . '</h3>'
		. '<p>' . Text::_('COM_MINITEKWALL_MODAL_LOAD_POSITION_PLUGIN_DESC') . '</p>'
		. '<button class="button-success btn btn-sm btn-success m-2" data-toggle="modal" data-target="#createModule" onclick="Joomla.submitbutton(\'widget.createModuleforPlugin\')">'
		. '<span class="icon-ok" aria-hidden="true"></span>'
		. Text::_('COM_MINITEKWALL_MODAL_CREATE_MODULE')
		. '</button>'
		. '<div class="alert alert-info" role="alert">'
		. '<p><small>' . Text::_('COM_MINITEKWALL_MODAL_MODULE_SYNTAX') . '</small></p>'
		. '<p class="lead">&#123;loadposition minitekwall-' . $this->item->id . '&#125;</p>'
		. '</div>'
		. '</div>'
		. '</div>';
}

$body .= '</div>'
	. '</div>';

echo HTMLHelper::_(
	'bootstrap.renderModal',
	'createModule',
	[
		'title'       => Text::_('COM_MINITEKWALL_MODAL_PUBLISH_WIDGET_IN_MODULE'),
		'height'      => '100%',
		'width'       => '100%',
		'modalWidth'  => 80,
		'bodyHeight'  => 60,
		'closeButton' => true
	],
	$body
);
