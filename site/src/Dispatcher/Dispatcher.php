<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Site\Dispatcher;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Dispatcher\ComponentDispatcher;

/**
 * ComponentDispatcher class for com_minitekwall
 *
 * @since  4.0.0
 */
class Dispatcher extends ComponentDispatcher
{
	/**
	 * Dispatch a controller task. Redirecting the user if appropriate.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function dispatch()
	{
		// Get component params
		jimport( 'joomla.application.component.helper' );
		$params = \JComponentHelper::getParams('com_minitekwall');
		
		// Load Font Awesome
		$wa = Factory::getDocument()->getWebAssetManager();

		if ($params->get('load_fontawesome', 1))
			$wa->useScript('com_minitekwall.fontawesome');

		parent::dispatch();
	}
}
