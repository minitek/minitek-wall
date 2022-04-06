<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibSource
{
	public function getItems($isCount, $source_params, $startLimit, $pageLimit, $globalLimit, $filters)
	{
		// Get source type from content plugin
		$source_type = $source_params['source_type'];

		// Register plugin source class
		$class = 'MSource'.$source_type.'Source';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/source.php');

		$source = new $class;
		$result = $source->getItems($isCount, $source_params, $startLimit, $pageLimit, $globalLimit, $filters);

		return $result;
	}
}
