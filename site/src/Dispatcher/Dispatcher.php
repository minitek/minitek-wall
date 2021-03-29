<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Site\Dispatcher;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\Language\Text;

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
		if ($params->get('load_fontawesome'))
		{
			$document = \JFactory::getDocument();
			$document->addStyleSheet('https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css');
		}

		parent::dispatch();
	}
}
