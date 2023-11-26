<?php

/**
 * @title		Minitek Wall
 * @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
 * @license   	GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

namespace Joomla\Component\MinitekWall\Administrator\View\Widget;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\URI\URI;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\Component\MinitekWall\Administrator\Helper\MinitekWallHelper;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Router\Route;

/**
 * Widget view class for Minitek Wall.
 *
 * @since  4.0.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The \Joomla\CMS\Form\Form object
	 *
	 * @var  \Joomla\CMS\Form\Form
	 */
	protected $form;

	/**
	 * The masonry \Joomla\CMS\Form\Form object
	 *
	 * @var  \Joomla\CMS\Form\Form
	 */
	protected $masonryform;

	/**
	 * The active item
	 *
	 * @var  object
	 */
	protected $item;

	/**
	 * The model state
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * The actions the user is authorised to perform
	 *
	 * @var  \Joomla\CMS\Object\CMSObject
	 */
	protected $canDo;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since   4.0.0
	 */
	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->masonryform = $this->get('MasonryForm');
		$this->item = $this->get('Item');
		$this->state = $this->get('State');
		$this->canDo = ContentHelper::getActions('com_minitekwall', 'widget', $this->item->id);
		$this->app = Factory::getApplication();

		$this->source_id = $this->app->getUserState('com_minitekwall.source_id', '') ? $this->app->getUserState('com_minitekwall.source_id', '') : $this->item->source_id;

		// Core source types
		$this->coreTypes = [
			'content',
			'folder',
			'rss',
			'custom'
		];

		// Core plugins
		$this->corePlugins = [
			[
				'type' => 'content',
				'title' => Text::_('PLG_CONTENT_MSOURCECONTENT_SOURCE_TITLE'),
				'image' => URI::root(true) . '/media/com_minitekwall/images/source/content.png',
				'downloadurl' => 'https://www.minitek.gr/downloads/minitek-source-content'
			],
			[
				'type' => 'folder',
				'title' => Text::_('PLG_CONTENT_MSOURCEFOLDER_SOURCE_TITLE'),
				'image' => URI::root(true) . '/media/com_minitekwall/images/source/images.png',
				'downloadurl' => 'https://www.minitek.gr/joomla/extensions/minitek-wall#subscriptionPlans'
			],
			[
				'type' => 'rss',
				'title' => Text::_('PLG_CONTENT_MSOURCERSS_SOURCE_TITLE'),
				'image' => URI::root(true) . '/media/com_minitekwall/images/source/rss.png',
				'downloadurl' => 'https://www.minitek.gr/joomla/extensions/minitek-wall#subscriptionPlans'
			],
			[
				'type' => 'custom',
				'title' => Text::_('PLG_CONTENT_MSOURCECUSTOM_SOURCE_TITLE'),
				'image' => URI::root(true) . '/media/com_minitekwall/images/source/custom.png',
				'downloadurl' => 'https://www.minitek.gr/joomla/extensions/minitek-wall#subscriptionPlans'
			]
		];

		// Get all sources from content plugins
		$this->sources = (array)$this->app->triggerEvent('onWidgetPrepareSource', array());

		foreach ($this->sources as $key => $source) {
			if ($this->source_id != $source['type']) {
				continue;
			} else {
				$this->source = $source;
				$this->source['key'] = $key;
				$this->source['name'] = $source['title'];
			}
		}

		$this->moduleInstalled = MinitekWallHelper::getModule();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		$this->addToolbar();

		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	protected function addToolbar()
	{
		Factory::getApplication()->input->set('hidemainmenu', true);
		$user       = Factory::getUser();
		$userId     = $user->id;
		$isNew      = ($this->item->id == 0);
		$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

		// Built the actions for new and existing records.
		$canDo = $this->canDo;

		// Get the toolbar object instance
		$toolbar = Toolbar::getInstance('toolbar');

		ToolbarHelper::title(
			Text::_('COM_MINITEKWALL_WIDGET_TITLE_' . ($checkedOut ? 'VIEW_WIDGET' : ($isNew ? 'NEW_WIDGET' : 'EDIT_WIDGET'))),
			'pencil-2 article-add'
		);

		// For new records, check the create permission.
		if ($canDo->get('core.create') && $isNew) {
			if ($this->source_id && $this->app->input->get('page') != 'source') {
				$toolbar->apply('widget.apply');

				$saveGroup = $toolbar->dropdownButton('save-group');

				$saveGroup->configure(
					function (Toolbar $childBar) use ($user) {
						$childBar->save('widget.save');
						$childBar->save2new('widget.save2new');
					}
				);
			}

			$toolbar->cancel('widget.cancel', 'JTOOLBAR_CLOSE');
		} else {
			// Don't show if page=source
			if ($this->app->input->get('page') != 'source') {
				// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
				$itemEditable = $canDo->get('core.edit');

				// Can't save the record if it's checked out and editable
				if (!$checkedOut && $itemEditable) {
					$toolbar->apply('widget.apply');
				}

				$saveGroup = $toolbar->dropdownButton('save-group');

				$saveGroup->configure(
					function (Toolbar $childBar) use ($checkedOut, $itemEditable, $canDo, $user) {
						// Can't save the record if it's checked out and editable
						if (!$checkedOut && $itemEditable) {
							$childBar->save('widget.save');

							// We can save this record, but check the create permission to see if we can return to make a new one.
							if ($canDo->get('core.create')) {
								$childBar->save2new('widget.save2new');
							}
						}

						// If checked out, we can still save
						if ($canDo->get('core.create')) {
							$childBar->save2copy('widget.save2copy');
						}
					}
				);

				$toolbar->cancel('widget.cancel', 'JTOOLBAR_CLOSE');
			} else {
				ToolbarHelper::custom('widget.cancelSource', 'cancel.png', 'cancel_f2.png', 'JTOOLBAR_CANCEL', false);
			}
		}

		// Publish in Module
		if ($canDo->get('core.create') && !$isNew && $this->app->input->get('page') != 'source') {
			$toolbar->popupButton('createModule')
				->text('COM_MINITEKWALL_WIDGET_TOOLBAR_PUBLISH_IN_MODULE')
				->icon('icon-ok')
				->selector('createModule');
		}

		if (!$isNew) {
			$url = 'index.php?option=com_minitekwall&view=masonry&widget_id=' . $this->item->id . '&tmpl=component';

			$toolbar->preview(URI::root() . $url, 'JGLOBAL_PREVIEW')
				->bodyHeight(80)
				->modalWidth(90);
		}
	}
}
