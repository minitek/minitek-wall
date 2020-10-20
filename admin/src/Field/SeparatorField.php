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

use Joomla\CMS\Form\FormField;

class SeparatorField extends FormField
{
	protected $type = 'Separator';

	protected function getInput()
	{
		$text  	= (string) $this->element['text'];

		return '<div id="'.$this->id.'" class="mmSeparator'.(($text != '') ? ' hasText' : '').'" title="'. \JText::_($this->element['desc']) .'"><span>' . \JText::_($text) . '</span></div>';
	}
}
