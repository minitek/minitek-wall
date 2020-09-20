<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Controller\AdminController;

/**
 * Widgets list controller class.
 *
 * @since  4.0.0
 */
class WidgetsController extends AdminController
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   4.0.0
	 */
	public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
	{
		parent::__construct($config, $factory, $app, $input);
	}

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  The array of possible config values. Optional.
	 *
	 * @return  JModel
	 *
	 * @since   4.0.0
	 */
	public function getModel($name = 'Widget', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

	/**
	 * Method to delete cropped images.
	 *
	 * @since   4.0.12
	 */
	public function deleteCroppedImages()
 	{
 		// Delete images folder
 		jimport('joomla.filesystem.folder');
		\JSession::checkToken('request') or jexit('Invalid token');
		$app = \JFactory::getApplication();

 		$tmppath = JPATH_SITE.DS.'images'.DS.'mnwallimages'.DS;

		if (file_exists($tmppath))
		{
			if (\JFolder::delete($tmppath))
			{
				$this->setMessage(\JText::_('COM_MINITEKWALL_CROPPED_IMAGES_DELETED'), 'message');
				$this->setRedirect(\JRoute::_('index.php?option=com_minitekwall&view=widgets', false));
			}
		}
		else
		{
			$this->setMessage(\JText::_('COM_MINITEKWALL_CROPPED_IMAGES_NOT_FOUND'), 'notice');
			$this->setRedirect(\JRoute::_('index.php?option=com_minitekwall&view=widgets', false));
		}
 	}
}
