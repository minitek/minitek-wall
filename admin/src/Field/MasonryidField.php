<?php
/**
* @title		Minitek Wall
* @copyright	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Administrator\Field;

defined('_JEXEC') or die;

\JFormHelper::loadFieldClass('list');

class MasonryIdField extends \JFormFieldList
{
	protected $type = 'MasonryId';

	protected function getOptions()
	{
		$db = \JFactory::getDBO();
		$query = 'SELECT w.id as value, w.name as text FROM #__minitek_wall_widgets w WHERE state = 1 ORDER BY w.name';
		$db->setQuery($query);
		$widgets = $db->loadObjectList();
		$options = array();

		foreach ($widgets as $widget)
		{
			$options[] = \JHTML::_('select.option', $widget->value, $widget->text);
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
