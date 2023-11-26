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

use Joomla\CMS\Form\Field\RadioField;
use Joomla\CMS\HTML\HTMLHelper;

class ArrowsListField extends RadioField
{
	public $type = 'ArrowsList';

	protected function getInput()
	{
		$html = array();

		// Initialize some field attributes.
		$class     = !empty($this->class) ? ' class="radio ' . $this->class . '"' : ' class="radio"';
		$required  = $this->required ? ' required aria-required="true"' : '';
		$autofocus = $this->autofocus ? ' autofocus' : '';
		$disabled  = $this->disabled ? ' disabled' : '';
		$readonly  = $this->readonly;

		// Start the radio field output.
		$html[] = '<fieldset id="' . $this->id . '"' . $class . $required . $autofocus . $disabled . ' >';

		// Get the field options.
		$options = $this->getOptions();

		// Build the radio field output.
		foreach ($options as $i => $option) {
			// Initialize some option attributes.
			$checked = ((string) $option->value == (string) $this->value) ? ' checked="checked"' : '';
			$class = 'class= "grid-radio-input"';

			$disabled = !empty($option->disable) || ($readonly && !$checked);

			$disabled = $disabled ? ' disabled' : '';

			// Initialize some JavaScript option attributes.
			$onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';
			$onchange = !empty($option->onchange) ? ' onchange="' . $option->onchange . '"' : '';

			$html[] = '<div class="grid-radio arrow-radio">';

			$html[] = '<label for="' . $this->id . $i . '"' . $class . ' >';

			$html[] = '<div class="grid-radio-demo-cont">';
			$html[] = '<i class="fa fa-' . $option->value . '-left"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-' . $option->value . '-right"></i>';
			$html[] = '</div>';

			$html[] = '</label>';

			$html[] = '<div>';
			$html[] = '<input type="radio" id="' . $this->id . $i . '" name="' . $this->name . '" value="'
				. htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $required . $onclick
				. $onchange . $disabled . ' />';
			$html[] = '</div>';

			$html[] = '</div>';

			$required = '';
		}

		// End the radio field output.
		$html[] = '</fieldset>';

		return implode($html);
	}

	protected function getOptions()
	{
		$elements = array(
			array(
				'value' => 'angle-double'
			),
			array(
				'value' => 'angle'
			),
			array(
				'value' => 'arrow-circle'
			),
			array(
				'value' => 'arrow-circle-o'
			),
			array(
				'value' => 'arrow'
			),
			array(
				'value' => 'caret'
			),
			array(
				'value' => 'caret-square-o'
			),
			array(
				'value' => 'chevron-circle'
			),
			array(
				'value' => 'chevron'
			),
			array(
				'value' => 'hand-o'
			),
			array(
				'value' => 'long-arrow'
			)
		);

		foreach ($elements as $option) {
			$disabled = false;

			// Create a new option object based on the <option /> element.
			$tmp = HTMLHelper::_(
				'select.option',
				(string) $option['value'],
				trim((string) $option['value']),
				'value',
				'text',
				$disabled
			);

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}
}
