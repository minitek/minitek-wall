<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\GenericDataException;

jimport('joomla.filesystem.folder');

if (!defined('DS'))
	define('DS',DIRECTORY_SEPARATOR);

class com_minitekwallInstallerScript
{
	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * preflight runs before anything else and while the extracted files are in the uploaded temp folder.
	 * If preflight returns false, Joomla will abort the update and undo everything already done.
	 */
	function preflight($type, $parent)
	{
		if (is_object($this->getOldVersion()))
		{
			// Get old version
			$this->old_version = $this->getOldVersion()->version;

			// Get new version
			$this->new_version = $parent->manifest->version;

			// Get Joomla version
			$version = new \JVersion();
			$sversion = $version->getShortVersion();

			// Abort if Joomla 3 is detected
			if (isset($sversion) && $sversion && version_compare($sversion, '4.0.0-dev', '<'))
			{
				throw new GenericDataException('Cannot install Minitek Wall version <strong>'.$this->new_version.'</strong> over <strong>Joomla 3</strong>. Please update to <strong>Joomla 4</strong> first.', 500);
				return false;
			}

			// Abort if Alpha version is detected (< 4.0.14)
			if (isset($this->old_version) && $this->old_version && version_compare($this->old_version, '4.0.14', '<'))
			{
				throw new GenericDataException('Cannot install Minitek Wall version <strong>'.$this->new_version.'</strong> over version <strong>'.$this->old_version.'</strong>. Please uninstall version <strong>'.$this->old_version.'</strong> first.', 500);
				return false;
			}
		}
	}

	/*
	 * $parent is the class calling this method.
	 * install runs after the database scripts are executed.
	 * If the extension is new, the install method is run.
	 * If install returns false, Joomla will abort the install and undo everything already done.
	 */
	function install($parent)
	{}

	/*
	 * $parent is the class calling this method.
	 * update runs after the database scripts are executed.
	 * If the extension exists, then the update method is run.
	 * If this returns false, Joomla will abort the update and undo everything already done.
	 */
	function update($parent)
	{}

	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * postflight is run after the extension is registered in the database.
	 */
	function postflight($type, $parent)
	{}

	/*
	 * $parent is the class calling this method
	 * uninstall runs before any other action is taken (file removal or database processing).
	 */
	function uninstall($parent)
	{}

	/*
	 * $parent is the class calling this method
	 * get old version (installed version).
	 */
	private static function getOldVersion()
	{
		$db = \JFactory::getDBO();
		$query = 'SELECT manifest_cache FROM '. $db->quoteName( '#__extensions' );
		$query .= ' WHERE ' . $db->quoteName( 'element' ) . ' = '. $db->quote('com_minitekwall').' ';
		$db->setQuery($query);
		$row = $db->loadObject();

		if ($row)
		{
			$manifest_cache = json_decode($row->manifest_cache, false);

			return $manifest_cache;
		}
		else
		{
			return false;
		}
	}
}
