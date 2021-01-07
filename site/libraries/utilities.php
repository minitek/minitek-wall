<?php
/**
* @title        Minitek Wall
* @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license      GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

use Joomla\String\StringHelper;
use Joomla\Image\Image;

if (!defined('DS')) {
	define('DS',DIRECTORY_SEPARATOR);
}

jimport('joomla.filesystem.folder');

class MinitekWallLibUtilities
{
	public static function getParams($option)
	{
		$app = \JFactory::getApplication();

		if ($app->isClient('site'))
		{
			$params = $app->getParams($option);
		}
		else
		{
			$params = \JComponentHelper::getParams($option);
		}

		return $params;
	}

	// Get source id
	public static function getSourceID($widgetID)
	{
		$db = \JFactory::getDBO();
		$query = ' SELECT * '
			. ' FROM '. $db->quoteName('#__minitek_wall_widgets') . ' '
			. ' WHERE '.$db->quoteName('id').' = ' . $db->Quote($widgetID);
		$db->setQuery($query);
		$source_id = $db->loadObject()->source_id;

		return $source_id;
	}

	// Get source
	public static function getSourceParams($widgetID)
	{
		$db = \JFactory::getDBO();
		$query = ' SELECT * '
			. ' FROM '. $db->quoteName('#__minitek_wall_widgets_source') . ' '
			. ' WHERE '.$db->quoteName('widget_id').' = ' . $db->Quote($widgetID);
		$db->setQuery($query);
		$source_params = $db->loadObject()->source_params;

		return self::decodeJSONParams($source_params);
	}

	// Decode json params
	public static function decodeJSONParams($json)
	{
		$params = json_decode($json, true);

		return $params;
	}

	// Get masonry_params
	public static function getMasonryParams($widgetID)
	{
		$db = \JFactory::getDBO();
		$query = ' SELECT * '
			. ' FROM '. $db->quoteName('#__minitek_wall_widgets')
			. ' WHERE '. $db->quoteName('state').' = '. $db->Quote('1')
			. ' AND '. $db->quoteName('id').' = '. $db->Quote($widgetID);

		$db->setQuery($query);
		$result = $db->loadObject();
		$masonry_params = $result->masonry_params;

		return self::decodeJSONParams($masonry_params);
	}

	public static function cleanName($name)
	{
		$name_fixed = preg_replace('/(?=\P{Nd})\P{L}/u', '-', $name);
		$name_fixed = preg_replace('/[\s-]{2,}/u', '-', $name_fixed);
		$name_fixed = htmlspecialchars($name_fixed);
		$name_fixed = trim($name_fixed, "-");

		return $name_fixed;
	}

	public static function recurseMasItemIndex($item_index, $gridType)
	{
		$item_index = $item_index - $gridType;

		if ($item_index > $gridType)
		{
			$item_index = self::recurseMasItemIndex($item_index, $gridType);
		}

		return $item_index;
	}

	public static function hex2RGB($hexStr, $returnAsString = false, $seperator = ',')
	{
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
		$rgbArray = array();

		if (strlen($hexStr) == 6)
		{
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		}
		elseif (strlen($hexStr) == 3)
		{
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		}
		else
		{
			return false;
		}

		return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
	}

	public static function wordLimit($str, $limit = 100, $end_char = '&#8230;')
	{
		if (StringHelper::trim($str) == '')
		{
			return $str;
		}

		$str = strip_tags($str);
		$find = array("/\r|\n/u", "/\t/u", "/\s\s+/u");
		$replace = array(" ", " ", " ");
		$str = preg_replace($find, $replace, $str);
		$str = preg_replace("/\{\w+\}/", "", $str);
		preg_match('/\s*(?:\S*\s*){'.(int)$limit.'}/u', $str, $matches);

		if (StringHelper::strlen($matches[0]) == StringHelper::strlen($str))
		{
			$end_char = '';
		}

		return StringHelper::rtrim($matches[0]).$end_char;
	}

	public static function makeDir($path)
	{
		$folders = explode('/', ($path));
		$tmppath = JPATH_SITE.DS.'images'.DS.'mwall'.DS;

		if (!file_exists($tmppath))
		{
			\JFolder::create( $tmppath, 0755 );
		}

		for ($i = 0; $i < count($folders) - 1; $i++)
		{
			if (!file_exists($tmppath.$folders[$i]) && !\JFolder::create($tmppath.$folders[$i], 0755))
			{
				return false;
			}

			$tmppath = $tmppath.$folders[$i].DS;
		}

		return true;
	}

	public static function cropImages($path, $width, $height)
	{
		$path = str_replace(\JURI::base(), '', $path);
		$imgSource = JPATH_SITE.DS. str_replace('/', DS, $path);

		if (file_exists($imgSource))
		{
			$path =  $width."x".$height.'/'.$path;
			$cropPath = JPATH_SITE.DS.'images'.DS.'mwall'.DS. str_replace('/', DS, $path);

			if (!file_exists($cropPath))
			{
				if (!self::makeDir($path))
				{
					return '';
				}

				$image = new \JImage();
				$image->loadFile($imgSource);
				$thumbs = $image->generateThumbs($width.'x'.$height, 5);

				foreach ($thumbs as $thumb)
				{
					$thumb->toFile($cropPath);
				}
			}

			$path = \JURI::base().'images/mwall/'.$path;
		}

		return $path;
	}
}
