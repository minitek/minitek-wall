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

class ProFeatureField extends FormField
{
	public $type = 'profeature';
	private $params = null;

	protected function getInput()
	{
		$this->params = $this->element->attributes();

		$title = $this->get('title') ? Text::_($this->get('title')) : '';
		$class = $this->get('class');

		$html = '<div class="alert alert-' . $class . '">
		<i class="fa fa-lock"></i>&nbsp;&nbsp;' . $title . '
		<a href="https://www.minitek.gr/joomla/extensions/minitek-wall#subscriptionPlans">
		' . Text::_('COM_MINITEKWALL_DASHBOARD_UPGRADE_TO_PRO') . '
		</a>
		</div>';

		return $html;
	}

	private function get($val, $default = '')
	{
		return (isset($this->params[$val]) && (string) $this->params[$val] != '') ? (string) $this->params[$val] : $default;
	}
}
