<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Model\AdminModel;

/**
 * Model for a Widget.
 *
 * @since  4.0.0
 */
class WidgetModel extends AdminModel
{
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	protected $text_prefix = 'COM_MINITEKWALL';

	/**
	 * The type alias for this content type.
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	public $typeAlias = 'com_minitekwall.widget';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 *
	 * @since   4.0.0
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->state != -2)
			{
				return false;
			}

			return \JFactory::getUser()->authorise('core.delete', 'com_minitekwall');
		}

		return false;
	}

	/**
	 * Method to test whether a record can have its state edited.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
	 *
	 * @since   4.0.0
	 */
	protected function canEditState($record)
	{
		$user = \JFactory::getUser();

		// Check for existing widget.
		if (!empty($record->id))
		{
			return $user->authorise('core.edit.state', 'com_minitekwall.widget.' . (int) $record->id);
		}

		// Default to component settings if widget unknown.
		return parent::canEditState($record);
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  \Joomla\CMS\Table\Table  A JTable object
	 *
	 * @since   4.0.0
	 */
	public function getTable($type = 'Widget', $prefix = 'Administrator', $config = array())
	{
		return parent::getTable($type, $prefix, $config);
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk))
		{
			$db = \JFactory::getDBO();

			// Convert the masonry_params to an array.
			if ($item->id)
			{
				$query = $db->getQuery(true);
				$query->select('*')
					->from('#__minitek_wall_widgets');
				$query->where($db->quoteName('id').' = '.(int) $item->id);
				$db->setQuery($query);
				$masonry_params = $db->loadObject()->masonry_params;

				$registry = new Registry;
				$registry->loadString($masonry_params);
				$item->masonry_params = $registry->toArray();
			}

			// Get source_params from widgets_source table and convert to an array.
			$item->source_params = '';
			$query = $db->getQuery(true);
			$query->select('*')
				->from('#__minitek_wall_widgets_source');
			$query->where($db->quoteName('widget_id').' = '.(int) $item->id);
			$db->setQuery($query);
			if ($item->id)
			{
				$source_params = $db->loadObject()->source_params;

				// Check that selected widget source is relevant to saved source_params
				if ($item->get('source_id') == 'content') {
					$registry = new Registry;
					$registry->loadString($source_params);
					$item->source_params = $registry->toArray();
				}
			}
		}

		return $item;
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  \JForm|boolean  A \JForm object on success, false on failure
	 *
	 * @since   4.0.0
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_minitekwall.widget', 'widget', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		$jinput = \JFactory::getApplication()->input;

		/*
		 * The front end calls this model and uses a_id to avoid id clashes so we need to check for that first.
		 * The back end uses id so we use that the rest of the time and set it to 0 by default.
		 */
		$id = $jinput->get('a_id', $jinput->get('id', 0));

		// Determine correct permissions to check.
		if ($this->getState('widget.id'))
		{
			$id = $this->getState('widget.id');
		}

		$user = \JFactory::getUser();

		// Check for existing widget.
		// Modify the form based on Edit State access controls.
		if ($id != 0 && (!$user->authorise('core.edit.state', 'com_minitekwall.widget.' . (int) $id))
			|| ($id == 0 && !$user->authorise('core.edit.state', 'com_minitekwall')))
		{
			// Disable fields for display.
			$form->setFieldAttribute('state', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a widget you can edit.
			$form->setFieldAttribute('state', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   4.0.0
	 */
	public function getMasonryForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_minitekwall.masonry', 'masonry', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   4.0.0
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = \JFactory::getApplication()->getUserState('com_minitekwall.edit.widget.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		$this->preprocessData('com_minitekwall.widget', $data);

		return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   4.0.0
	 */
	public function save($data)
	{
		$app = \JFactory::getApplication();
		$input = $app->input;
		$formData = new Registry($input->get('jform', '', 'array'));

		// Masonry params
		$masonry_params = $formData->get('masonry_params', false);
		if ($masonry_params && is_object($masonry_params))
		{
			$registry = new Registry($masonry_params);
			$data['masonry_params'] = (string) $registry; // Saves to table
		}

		if (parent::save($data))
		{
			$table = $this->getTable();
			$key = $table->getKeyName();
			$pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');

			// Save source params to widgets_source table
			$source_id = $data['source_id'];
			$source_params = json_encode($data['source_params']);

			$db = \JFactory::getDbo();

			// Widget is new - insert source params
			// First check if source_id == source_type field in source_params
			if (array_key_exists('source_type', $data['source_params']) && ($source_id == $data['source_params']['source_type']))
			{
				if (!$data['id'])
				{
					$query = $db->getQuery(true);
					$columns = array(
						$db->quoteName('widget_id'),
						$db->quoteName('source_params')
					);
					$values = array(
						$db->quote($pk),
						$db->quote($source_params)
					);
					$query
						->insert($db->quoteName('#__minitek_wall_widgets_source'))
						->columns($columns)
						->values(implode(',', $values));
					$db->setQuery($query);
					$db->execute();
				}
				else // Existing widget - update source
				{
					$query = $db->getQuery(true);
					$fields = array(
						$db->quoteName('source_params') . ' = ' . $db->quote($source_params)
					);
					$conditions = array(
						$db->quoteName('widget_id') . ' = ' . $db->quote($pk)
					);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($fields)
						->where($conditions);

					$db->setQuery($query);
					$db->execute();
				}
			}

			return true;
		}

		return false;
	}

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   \Joomla\CMS\Table\Table  $table  A Table object.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	protected function prepareTable($table)
	{
		$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
	}

	/**
	 * Method to create a Module.
	 *
	 * @since   4.0.0
	 */
	public function createModule($id, $position)
	{
		$db = \JFactory::getDbo();

		// Get widget name
		$query = $db->getQuery(true);
		$query->select('*')
			->from('#__minitek_wall_widgets AS s');
		$query->where('s.id = ' . (int) $id);

		// Setup the query
		$db->setQuery($query);

		$widget = $db->loadObject();
		if (!$widget)
		{
			return false;
		}
		else
		{
			$widget_name = $widget->name;
		}

		// Create module
		$widget_params = '{"widget_id":"'.$id.'"}';
		$query = $db->getQuery(true);
		$columns = array('title', 'content', 'position', 'module', 'access', 'params', 'language');
		$values = array($db->quote($widget_name), $db->quote(''), $db->quote($position), $db->quote('mod_minitekwall'), $db->quote('1'), $db->quote($widget_params), $db->quote('*'));

		$query
			->insert($db->quoteName('#__modules'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		$db->setQuery($query);
		$db->execute();
		$module_id = $db->insertid();

		// Handle db error
		if(!$module_id)
		{
			return false;
		}
		else
		{
			return $module_id;
		}
	}
}
