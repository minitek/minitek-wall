<?php
/**
* @title		Minitek Wall
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekWall\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\URI\URI;

class MinitekWallHelper
{
	public static $extension = 'com_minitekwall';

	/**
	 * Get latest version.
	 *
	 * @return  Version number
	 *
	 * @since   4.0.0
	 */
	public static function latestVersion()
 	{
 		$params = \JComponentHelper::getParams('com_minitekwall');
 		$version = 0;

		$xml_file = @file_get_contents('https://update.minitek.gr/joomla-extensions/minitek_wall.xml');

		if ($xml_file)
		{
			$updates = new \SimpleXMLElement($xml_file);

			foreach ($updates as $key => $update)
			{
				$platform = (array)$update->targetplatform->attributes()->version;

				if ($platform[0] == '4.*')
				{
					$version = (string)$update->version;
					break;
				}
			}
		}

 		return $version;
	}

	/**
	 * Get local version.
	 *
	 * @return  Version number
	 *
	 * @since   4.0.0
	 */
	public static function localVersion()
 	{
		$xml = simplexml_load_file(JPATH_ADMINISTRATOR .'/components/com_minitekwall/minitekwall.xml');
		$version = (string)$xml->version;

		return $version;
	}
	 
	/**
	 * Method to clear user state variables.
	 *
	 * @since   4.0.0
	 */
	public static function clearWidgetStateVariables()
	{
		$app = Factory::getApplication();

		$app->setUserState('com_minitekwall.source_id', '');
	}

	/**
	 * Check if Minitek Wall Module is installed.
	 *
	 * @return  bool
	 *
	 * @since   4.0.0
	 */
	public static function getModule()
 	{
 		$db = Factory::getDBO();
 		$query = $db->getQuery(true)
 			->select('*')
 			->from($db->quoteName('#__extensions'))
 			->where($db->quoteName('element') . ' = ' . $db->quote('mod_minitekwall'));
 		$db->setQuery($query);

 		if ($module_exists = $db->loadObject())
 			return true;

 		return false;
	}
	
	/**
	 * Check if source plugin is installed.
	 *
	 * @return  bool
	 *
	 * @since   4.0.15
	 */
	public static function getSourcePlugin($type)
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from($db->quoteName('#__extensions'))
			->where($db->quoteName('folder') . ' = ' . $db->quote('content'))
			->where($db->quoteName('element') . ' = ' . $db->quote('msource'.$type));
		$db->setQuery($query);

		if (!$result = $db->loadObject())
			return false;

		return $result;
	}
}
