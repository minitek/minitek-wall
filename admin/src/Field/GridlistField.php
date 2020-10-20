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

\JFormHelper::loadFieldClass('radio');

class GridListField extends \JFormFieldRadio
{
	public $type = 'GridList';

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
		foreach ($options as $i => $option)
		{
			// Initialize some option attributes.
			$checked = ((string) $option->value == (string) $this->value) ? ' checked="checked"' : '';
			$class = !empty($option->class) ? ' class="' . $option->class . '"' : '';

			$disabled = !empty($option->disable) || ($readonly && !$checked);

			$disabled = $disabled ? ' disabled' : '';

			// Initialize some JavaScript option attributes.
			$onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';
			$onchange = !empty($option->onchange) ? ' onchange="' . $option->onchange . '"' : '';

			$html[] = '<div class="grid-radio">';

				$html[] = '<label for="' . $this->id . $i . '"' . $class . ' >';

					$html[] = '<p>';
						$html[] = \JText::alt($option->text, preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname));
					$html[] = '</p>';

					$html[] = '<div class="grid-radio-demo-cont">';
						$html[] = '<div class="grid-radio-demo">';
							if ($option->image)
							{
								$html[] = '<img src="components/com_minitekwall/assets/images/masonry/'.$option->image.'">';
							}
							else
							{
								$html[] = '<i class="icon icon-grid-2"></i>';
							}
						$html[] = '</div>';
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
		$elements = Array(
			Array(
				'value' => '999c',
				'image' => '',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_OPTION_CUSTOM_GRID'),
				'class' => 'grid-radio-input grid-radio-custom'
			),
			Array(
				'value' => '1',
				'image' => 'grid1.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_1'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '3a',
				'image' => 'grid3a.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_3A'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '3b',
				'image' => 'grid3b.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_3B'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '3c',
				'image' => 'grid3c.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_3C'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '4',
				'image' => 'grid4.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_4'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '5',
				'image' => 'grid5a.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_5'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '5b',
				'image' => 'grid5b.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_5B'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '6',
				'image' => 'grid6.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_6'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '7',
				'image' => 'grid7.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_7'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '8',
				'image' => 'grid8.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_8'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '9',
				'image' => 'grid9.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_9'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '98o',
				'image' => 'gridc.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_MASONRY_E'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '9r',
				'image' => 'gridr9.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_ROWS_9'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '12r',
				'image' => 'gridr12.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_ROWS_12'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '16r',
				'image' => 'gridr16.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_ROWS_16'),
				'class' => 'grid-radio-input'
			),
			Array(
				'value' => '99v',
				'image' => 'gridv.jpg',
				'text' => \JText::_('COM_MINITEKWALL_FIELD_VERTICAL_LIST'),
				'class' => 'grid-radio-input'
			)
		);

		foreach ($elements as $option)
		{
			$disabled = false;

			// Create a new option object based on the <option /> element.
			$tmp = \JHtml::_(
				'select.option', (string) $option['value'], trim((string) $option['text']), 'value', 'text',
				$disabled
			);

			// Set some option attributes.
			$tmp->class = $option['class'];
			$tmp->image = $option['image'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}
}
