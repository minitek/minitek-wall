<?php

/**
 * @title		Minitek Wall
 * @copyright	Copyright (C) 2011-2023 Minitek, All rights reserved.
 * @license		GNU General Public License version 3 or later.
 * @author url	https://www.minitek.gr/
 * @developers	Minitek.gr
 */

namespace Joomla\Component\MinitekWall\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Component\ComponentHelper;

/**
 * Component Controller
 *
 * @since  4.0.0
 */
class DisplayController extends BaseController
{
	/**
	 * The default view.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	protected $default_view = 'dashboard';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link FilterInput::clean()}.
	 *
	 * @return  BaseController|bool  This object to support chaining.
	 *
	 * @since   4.0.0
	 */
	public function display($cachable = false, $urlparams = array())
	{
		return parent::display();
	}

	/**
	 * Method to check for latest version.
	 *
	 * @since   4.0.12
	 */
	public function checkForUpdate()
	{
		$app = Factory::getApplication();
		$input = $app->input;

		$type = $input->get('type', 'auto');
		$params = ComponentHelper::getParams('com_minitekwall');
		$version_check = $params->get('version_check', 1);

		// Don't allow auto if version checking is disabled
		if ($type == 'auto' && !$version_check) {
			$app->close();
		}

		$input->set('view', 'dashboard', 'STRING');
		$input->set('layout', 'update', 'STRING');

		// Display
		parent::display();

		// Exit
		$app->close();
	}
}
