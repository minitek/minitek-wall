<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Administrator\View\Widget;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Component\MinitekWall\Administrator\Helper\MinitekWallHelper;
use Joomla\CMS\MVC\View\GenericDataException;

/**
 * Widget view class for Minitek Wall.
 *
 * @since  4.0.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The \JForm object
	 *
	 * @var  \JForm
	 */
	protected $form;

	/**
	 * The masonry \JForm object
	 *
	 * @var  \JForm
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
	 * @var  \JObject
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
		$this->canDo = MinitekWallHelper::getActions('com_minitekwall', 'widget', $this->item->id);
		$this->app = Factory::getApplication();

		$this->source_id = $this->app->getUserState( 'com_minitekwall.source_id', '' ) ? $this->app->getUserState( 'com_minitekwall.source_id', '' ) : $this->item->source_id;

		// Get all sources from content plugins
		$this->sources = (array)$this->app->triggerEvent('onWidgetPrepareSource', array());
		foreach ($this->sources as $source)
		{
			if ($this->source_id == $source['type'])
			{
				$this->source_icon = $source['image'];
				$this->source_name = $source['title'];
			}
		}

		$this->moduleIsInstalled = MinitekWallHelper::checkModuleIsInstalled();

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
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

		\JToolbarHelper::title(
			\JText::_('COM_MINITEKWALL_WIDGET_TITLE_' . ($checkedOut ? 'VIEW_WIDGET' : ($isNew ? 'NEW_WIDGET' : 'EDIT_WIDGET'))),
			'pencil-2 article-add'
		);

		// For new records, check the create permission.
		if ($canDo->get('core.create') && $isNew)
		{
			if ($this->source_id && $this->app->input->get('page') != 'source')
			{
				\JToolbarHelper::saveGroup(
					[
						['apply', 'widget.apply'],
						['save', 'widget.save'],
						['save2new', 'widget.save2new']
					],
					'btn-success'
				);
			}

			\JToolbarHelper::cancel('widget.cancel');
		}
		else
		{
			// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
			$itemEditable = $canDo->get('core.edit');

			$toolbarButtons = [];

			// Can't save the record if it's checked out and editable
			if (!$checkedOut && $itemEditable)
			{
				$toolbarButtons[] = ['apply', 'widget.apply'];
				$toolbarButtons[] = ['save', 'widget.save'];

				// We can save this record, but check the create permission to see if we can return to make a new one.
				if ($canDo->get('core.create'))
				{
					$toolbarButtons[] = ['save2new', 'widget.save2new'];
				}
			}

			// If checked out, we can still save
			if ($canDo->get('core.create'))
			{
				$toolbarButtons[] = ['save2copy', 'widget.save2copy'];
			}

			// Don't show if page=source
			if ($this->app->input->get('page') != 'source')
			{
				\JToolbarHelper::saveGroup(
					$toolbarButtons,
					'btn-success'
				);

				\JToolbarHelper::cancel('widget.cancel', 'JTOOLBAR_CLOSE');
			}
			else
			{
				\JToolbarHelper::custom('widget.cancelSource', 'cancel.png', 'cancel_f2.png', 'JTOOLBAR_CANCEL', false);
			}
		}

		// Publish in Module
		if ($canDo->get('core.create') && !$isNew && $this->app->input->get('page') != 'source')
		{
			\JToolbarHelper::modal('createModule', 'icon-ok', \JText::_('COM_MINITEKWALL_WIDGET_TOOLBAR_PUBLISH_IN_MODULE'));
		}
	}
}
