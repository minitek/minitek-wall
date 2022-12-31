<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekWallLibSource
{
	public function getItems($isCount, $params, $filters)
	{
		$source_type = $params->get('source_type');

		// Register plugin source class
		$class = 'MSource'.$source_type.'Source';
		$plugin = 'msource'.$source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/source.php');

		$source = new $class;
		$result = $source->getItems('com_minitekwall', $isCount, $params, $filters);

		return $result;
	}
}
