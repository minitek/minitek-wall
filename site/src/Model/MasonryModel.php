<?php

/**
 * @title		Minitek Wall
 * @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
 * @license   	GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

namespace Joomla\Component\MinitekWall\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Registry\Registry;

/**
 * MinitekWall Component Masonry Model
 *
 * @since  4.0.0
 */
class MasonryModel extends BaseDatabaseModel
{
	var $utilitiesLib = null;
	var $sourceLib = null;
	var $optionsLib = null;
	var $filtersLib = null;
	var $responsiveLib = null;

	function __construct()
	{
		$this->utilitiesLib = new \MinitekWallLibUtilities;
		$this->sourceLib = new \MinitekWallLibSource;
		$this->optionsLib = new \MinitekWallLibOptions($this->utilitiesLib);
		$this->filtersLib = new \MinitekWallLibFilters;
		$this->responsiveLib = new \MinitekWallLibResponsive($this->utilitiesLib);

		parent::__construct();
	}

	/**
	 * Method to get widget.
	 *
	 * @param   integer  $pk  The id of the widget.
	 *
	 * @return  object|boolean|Exception  Object on success, boolean false or JException instance on error
	 */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('widget.id');

		if (!isset($this->_item[$pk])) {
			try {
				$db = $this->getDbo();
				$query = $db->getQuery(true)
					->select('a.*, s.*');
				$query->from('#__minitek_wall_widgets AS a')
					->join('LEFT', '#__minitek_wall_widgets_source AS s ON s.widget_id = a.id')
					->where('a.id = ' . (int) $pk);

				// Filter by published state.
				$published = $this->getState('filter.published');
				$archived = $this->getState('filter.archived');

				if (is_numeric($published))
					$query->where('(a.state = ' . (int) $published . ' OR a.state =' . (int) $archived . ')');

				$db->setQuery($query);
				$data = $db->loadObject();

				if (empty($data))
					throw new \Exception(Text::_('COM_MINITEKWALL_ERROR_WIDGET_NOT_FOUND'), 404);

				// Check for published state if filter set.
				if ((is_numeric($published) || is_numeric($archived)) && (($data->state != $published) && ($data->state != $archived)))
					throw new \Exception(Text::_('COM_MINITEKWALL_ERROR_WIDGET_NOT_FOUND'), 404);

				$this->_item[$pk] = $data;
			} catch (\Exception $e) {
				if ($e->getCode() == 404)
					throw new \Exception($e->getMessage(), 404);
				else {
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

	public function getItems($params, $filters)
	{
		$result = $this->sourceLib->getItems(false, $params, $filters);

		if (isset($result))
			return $result;

		return false;
	}

	public function getDisplayOptions($items, $params)
	{
		$source_type = $params->get('source_type');

		// Register plugin source class
		$class = 'MSource' . $source_type . 'Options';
		$plugin = 'msource' . $source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/options.php');

		$options = new $class;
		$wall = $options->getDisplayOptions($items, $params, 'com_minitekwall');

		return $wall;
	}

	// Get ordering from data source
	public static function getItemsOrdering($params)
	{
		$source_type = $params->get('source_type');

		// Register plugin source class
		$class = 'MSource' . $source_type . 'Source';
		$plugin = 'msource' . $source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/source.php');

		$source = new $class;
		$ordering = $source->getItemsOrdering($params);

		return $ordering;
	}

	// Get ordering direction from data source
	public static function getItemsDirection($params)
	{
		$source_type = $params->get('source_type');

		// Register plugin source class
		$class = 'MSource' . $source_type . 'Source';
		$plugin = 'msource' . $source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/source.php');

		$source = new $class;
		$direction = $source->getItemsDirection($params);

		return $direction;
	}
}
