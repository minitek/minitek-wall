<?php

/**
 * @title		Minitek Wall
 * @copyright	Copyright (C) 2011-2023 Minitek, All rights reserved.
 * @license		GNU General Public License version 3 or later.
 * @author url	https://www.minitek.gr/
 * @developers	Minitek.gr
 */

namespace Joomla\Component\MinitekWall\Administrator\Field;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;

class MasonryIdField extends ListField
{
	protected $type = 'MasonryId';

	protected function getOptions()
	{
		$db = Factory::getDBO();
		$query = 'SELECT w.id as value, w.name as text FROM #__minitek_wall_widgets w WHERE state = 1 ORDER BY w.name';
		$db->setQuery($query);
		$widgets = $db->loadObjectList();
		$options = array();

		foreach ($widgets as $widget) {
			$options[] = HTMLHelper::_('select.option', $widget->value, $widget->text);
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
