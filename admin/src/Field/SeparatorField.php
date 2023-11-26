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

use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;

class SeparatorField extends FormField
{
	protected $type = 'Separator';

	protected function getInput()
	{
		$text  	= (string) $this->element['text'];

		return '<div id="' . $this->id . '" class="mmSeparator' . (($text != '') ? ' hasText' : '') . '" title="' . Text::_($this->element['desc']) . '"><span>' . Text::_($text) . '</span></div>';
	}
}
