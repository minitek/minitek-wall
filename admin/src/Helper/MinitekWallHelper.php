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

 		if (self::isDomainAvailable('http://update.minitek.gr'))
 		{
 			if (self::isXMLAvailable('http://update.minitek.gr/joomla-extensions/minitek_wall.xml'))
 			{
 				$xml_file = @file_get_contents('http://update.minitek.gr/joomla-extensions/minitek_wall.xml');

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
	 * Check if a valid url is provided.
	 *
	 * @return  bool
	 *
	 * @since   4.0.0
	 */
	public static function isDomainAvailable($domain)
	{
		// Check if a valid url is provided
		if (!filter_var($domain, FILTER_VALIDATE_URL))
		{
			return false;
		}

		// Initialize curl
		$curlInit = curl_init($domain);
		curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
		curl_setopt($curlInit,CURLOPT_HEADER,true);
		curl_setopt($curlInit,CURLOPT_NOBODY,true);
		curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

		// Get answer
		$response = curl_exec($curlInit);
		curl_close($curlInit);

		if ($response)
			return true;

		return false;
	}

	/**
	 * Check if a valid xml is provided.
	 *
	 * @return  bool
	 *
	 * @since   4.0.0
	 */
	public static function isXMLAvailable($file)
	{
		$ch = curl_init($file);

		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($response >= 400)
		{
			return false;
		}
		else if ($response = 200)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Check if Minitek Wall Module is installed.
	 *
	 * @return  bool
	 *
	 * @since   4.0.0
	 */
	public static function checkModuleIsInstalled()
 	{
 		$db = Factory::getDBO();
 		$query = $db->getQuery(true);

 		// Construct the query
 		$query->select('*')
 			->from('#__extensions AS e');
 		$query->where('e.element = ' . $db->quote('mod_minitekwall'));

 		// Setup the query
 		$db->setQuery($query);

 		$moduleExists = $db->loadObject();

 		if ($moduleExists)
 			return true;

 		return false;
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
}
