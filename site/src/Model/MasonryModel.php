<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
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

	public function getItems($widgetID)
	{
		// Get source params
		$source_id = $this->utilities->getSourceID($widgetID);
		$source_params = $this->utilities->getSourceParams($widgetID);

		// Limits
		$masonry_params = $this->utilities->getMasonryParams($widgetID);
		$startLimit = (int)$masonry_params['mas_starting_limit'];

		// Get items
		$result = $this->source->getItems(false, $source_params, $startLimit, false, false);

		if (isset($result))
		{
			return $result;
		}

		return false;
	}

	public function getDisplayOptions($widgetID, $items, $detailBoxParams, $hoverBoxParams)
	{
		// Get items from content plugin
		$source_type = $this->utilities->getSourceID($widgetID);

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
