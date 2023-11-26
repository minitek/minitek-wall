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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\Field\ListField;

class SourceidField extends ListField
{
	protected $type = 'SourceId';

	public function getOptions()
	{
		$options = array(
			array(
				'value' => '',
				'text' => Text::_('COM_MINITEKWALL_SELECT_SOURCE_ID')
			)
		);

		// Get all sources from content plugins
		$app = Factory::getApplication();
		$sources = (array)$app->triggerEvent('onWidgetPrepareSource', array());

		foreach ($sources as $source) {
			if ($source['type'] == 'content') {
				$options[] = array(
					'value' => $source['type'],
					'text' => $source['title']
				);
			}
		}

		return $options;
	}
}
