<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\MinitekWall\Administrator\Helper\MinitekWallHelper;

/**
 * The widget controller
 *
 * @since  4.0.0
 */

class WidgetController extends FormController
{
	/**
	 * Constructor.
	 *
	 * @param   array                $config   An optional associative array of configuration settings.
	 * Recognized key values include 'name', 'default_task', 'model_path', and
	 * 'view_path' (this list is not meant to be comprehensive).
	 * @param   MVCFactoryInterface  $factory  The factory.
	 * @param   CmsApplication       $app      The JApplication for the dispatcher
	 * @param   \JInput              $input    Input
	 *
	 * @since   4.0.0
	 */
	public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
	{
		parent::__construct($config, $factory, $app, $input);
	}

	/**
	 * Method override to check if you can add a new record.
	 *
	 * @param   array  $data  An array of input data.
	 *
	 * @return  boolean
	 *
	 * @since   4.0.0
	 */
	protected function allowAdd($data = array())
	{
		$allow = null;

		if ($allow === null)
		{
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd();
		}

		return $allow;
	}

	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param   array   $data  An array of input data.
	 * @param   string  $key   The name of the key for the primary key.
	 *
	 * @return  boolean
	 *
	 * @since   4.0.0
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Since there is no asset tracking, revert to the component permissions.
		return parent::allowEdit($data, $key);
	}

	/**
	 * Method to cancel changing widget source.
	 *
	 * @since   4.0.0
	 */
	public function cancelSource()
	{
		// Set user variable
		$app = \JFactory::getApplication();
		$this_id = $app->input->get('id');

		// Redirect
		$app->redirect('index.php?option=com_minitekwall&view=widget&layout=edit&id='.$this_id);
	}

	/**
	 * Method to select widget source.
	 *
	 * @since   4.0.0
	 */
	public function selectSource()
	{
		// Set user variable
		$app = \JFactory::getApplication();
		$source_type = $app->input->get('source_type');
		$this_id = $app->input->get('id');
		$app->setUserState('com_minitekwall.source_id', $source_type);

		// Redirect
		if ($this_id && $this_id !== 0)
		{
			$app->redirect('index.php?option=com_minitekwall&view=widget&layout=edit&id='.$this_id);
		}
		else
		{
			$app->redirect('index.php?option=com_minitekwall&view=widget&layout=edit');
		}
	}

	/**
	 * Method to create a Module.
	 *
	 * @since   4.0.0
	 */
	public function createModule()
	{
		\JSession::checkToken('request') or jexit('Invalid token');

		$app = \JFactory::getApplication();
		$jinput = $app->input;
		$id = $jinput->get('id');

		$model = $this->getModel('Widget');
		$position = '';

		if ($id)
		{
			$data = $model->createModule($id, $position);
			if ($data)
			{
				// Redirect to module
				$app->enqueueMessage(\JText::_('COM_MINITEKWALL_WIDGET_MODULE_CREATED'), 'Message');
				$app->redirect('index.php?option=com_modules&filter.search=id:'.$data);
			}
			else
			{
				// Redirect to widgets
				$app->enqueueMessage(\JText::_('COM_MINITEKWALL_WIDGET_ERROR_WHILE_CREATING_MODULE'), 'Notice');
				$app->redirect('index.php?option=com_minitekwall&view=widgets');
			}
		}
		else
		{
			// Redirect to widgets
			$app->enqueueMessage(\JText::_('COM_MINITEKWALL_WIDGET_ERROR_WHILE_CREATING_MODULE'), 'Notice');
			$app->redirect('index.php?option=com_minitekwall&view=widgets');
		}
	}

	/**
	 * Method to create a Module for {loadmodule} plugin.
	 *
	 * @since   4.0.0
	 */
	public function createModuleforPlugin()
	{
		\JSession::checkToken('request') or jexit('Invalid token');

		$app = \JFactory::getApplication();
		$jinput = $app->input;
		$id = $jinput->get('id');

		$model = $this->getModel('Widget');
		$position = 'minitekwall-'.$id;

		if ($id)
		{
			$data = $model->createModule($id, $position);
			if ($data)
			{
				// Redirect to module
				$app->enqueueMessage(\JText::_('COM_MINITEKWALL_WIDGET_MODULE_CREATED'), 'Message');
				$app->redirect('index.php?option=com_modules&filter.search=id:'.$data);
			}
			else
			{
				// Redirect to widgets
				$app->enqueueMessage(\JText::_('COM_MINITEKWALL_WIDGET_ERROR_WHILE_CREATING_MODULE'), 'Notice');
				$app->redirect('index.php?option=com_minitekwall&view=widgets');
			}
		}
		else
		{
			// Redirect to widgets
			$app->enqueueMessage(\JText::_('COM_MINITEKWALL_WIDGET_ERROR_WHILE_CREATING_MODULE'), 'Notice');
			$app->redirect('index.php?option=com_minitekwall&view=widgets');
		}
	}
}
