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

class SourceidField extends \JFormFieldList
{
	protected $type = 'SourceId';

	public function getOptions()
	{
		$options = Array(
			Array(
				'value' => '',
				'text' => \JText::_('COM_MINITEKWALL_SELECT_SOURCE_ID')
			)
		);

		// Get all sources from content plugins
		$app = \JFactory::getApplication();
		$sources = (array)$app->triggerEvent('onWidgetPrepareSource', array());

		foreach ($sources as $source)
		{
			if ($source['type'] == 'content')
			{
				$options[] = Array(
					'value' => $source['type'],
					'text' => $source['title']
				);
			}
		}

		return $options;
	}
}
