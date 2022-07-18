<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * MinitekWall Component Masonry Model
 *
 * @since  4.0.0
 */
class MasonryModel extends BaseDatabaseModel
{
	var $utilities = null;
	var $source = null;
	var $masonry_options = null;
	var $masonry_filters = null;
	var $responsive_masonry = null;

	function __construct()
	{
		$jinput = Factory::getApplication()->input;
		$widgetID = $jinput->get('widget_id');
		$this->utilities = $this->getUtilitiesLib();
		$this->source = $this->getSourceLib();
		$this->masonry_options = $this->getMasonryOptionsLib();
		$this->masonry_filters = $this->getMasonryFiltersLib();
		$this->responsive_masonry = $this->getResponsiveMasonryLib();

		parent::__construct();
	}

	/**
	 * Method to get widget.
	 *
	 * @param   integer  $pk  The id of the widget.
	 *
	 * @return  object|boolean|JException  Object on success, boolean false or JException instance on error
	 */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('widget.id');

		if (!isset($this->_item[$pk]))
		{
			try
			{
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
			}
			catch (\Exception $e)
			{
				if ($e->getCode() == 404)
					throw new \Exception($e->getMessage(), 404);
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

	public function getUtilitiesLib()
	{
		$utilities = new \MinitekWallLibUtilities;

		return $utilities;
	}

	public function getSourceLib()
	{
		$data_source = new \MinitekWallLibSource;

		return $data_source;
	}

	public function getMasonryOptionsLib()
	{
		$options = new \MinitekWallLibOptions;

		return $options;
	}

	public function getMasonryFiltersLib()
	{
		$options = new \MinitekWallLibFilters;

		return $options;
	}

	public function getResponsiveMasonryLib()
	{
		$options = new \MinitekWallLibResponsive;

		return $options;
	}

	public function getItems($widgetID, $filters)
	{
		$item = $this->getItem($widgetID);
		$source_params = json_decode($item->source_params, true);
		$masonry_params = json_decode($item->masonry_params, true);
		$startLimit = (int)$masonry_params['mas_starting_limit'];

		// Get items
		$result = $this->source->getItems(false, $source_params, $startLimit, false, false, $filters);

		if (isset($result))
		{
			return $result;
		}

		return false;
	}

	public function getDisplayOptions($widgetID, $items, $detailBoxParams, $hoverBoxParams)
	{
		$item = $this->getItem($widgetID);
		$source_type = $item->source_id;		

		// Register plugin source class
		$class = 'MSource'.$source_type.'Options';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/options.php');

		$options = new $class;
		$wall = $options->getDisplayOptions($widgetID, $items, $detailBoxParams, $hoverBoxParams, false, 'com_minitekwall');

		return $wall;
	}

	// Get ordering from data source
	public static function getItemsOrdering($source_params)
	{
		// Get source type from content plugin
		$source_type = $source_params['source_type'];

		// Register plugin source class
		$class = 'MSource'.$source_type.'Source';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/source.php');

		$source = new $class;
		$ordering = $source->getItemsOrdering($source_params);

		return $ordering;
	}

	// Get ordering direction from data source
	public static function getItemsDirection($source_params)
	{
		// Get source type from content plugin
		$source_type = $source_params['source_type'];

		// Register plugin source class
		$class = 'MSource'.$source_type.'Source';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/source.php');

		$source = new $class;
		$direction = $source->getItemsDirection($source_params);

		return $direction;
	}
}
