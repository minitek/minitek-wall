<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2022 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\String\StringHelper;
use Joomla\CMS\Image\Image;

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

	public static function cleanName($name)
	{
		$name_fixed = preg_replace('/(?=\P{Nd})\P{L}/u', '-', $name);
		$name_fixed = preg_replace('/[\s-]{2,}/u', '-', $name_fixed);
		$name_fixed = htmlspecialchars($name_fixed);
		$name_fixed = trim($name_fixed, "-");

		return $name_fixed;
	}

	public static function getItemIndex($item_index, $gridType)
	{
		$item_index = $item_index - $gridType;

		if ($item_index > $gridType)
		{
			$item_index = self::getItemIndex($item_index, $gridType);
		}

		return $item_index;
	}

	public static function hex2RGB($hexStr, $returnAsString = false, $separator = ',')
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

		return $returnAsString ? implode($separator, $rgbArray) : $rgbArray;
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
		$img = HTMLHelper::cleanImageURL($imgSource);
		
		if (file_exists($img->url))
		{
			$clean_name = str_replace(JPATH_SITE.'/', '', $img->url);
			$new_path =  $width.'x'.$height.DS.$clean_name;
			$clean_cropped_path = JPATH_SITE.DS.'images'.DS.'mwall'.DS.$new_path;
			
			if (!file_exists($clean_cropped_path))
			{
				if (!self::makeDir($new_path))
					return '';

				$image = new Image();
				$image->loadFile($img->url);
				$properties = $image->getImageFileProperties($img->url);

				switch ($properties->mime) {
                    case 'image/webp':
                        $imageType = \IMAGETYPE_WEBP;
                        break;
                    case 'image/png':
                        $imageType = \IMAGETYPE_PNG;
                        break;
                    case 'image/gif':
                        $imageType = \IMAGETYPE_GIF;
                        break;
                    default:
                        $imageType = \IMAGETYPE_JPEG;
                }

				// $image->crop($width, $height, null, null, false);
				// $image->resize($width, $height, false);
				$image->cropResize($width, $height, false);
                $image->toFile($clean_cropped_path, $imageType);
			}

			$url = \JURI::base().'images'.DS.'mwall'.DS.$new_path;

			return $url;
		}
		else
		{
			return false;
		}
	}

	// Get custom grid
	public static function getCustomGrid($id)
	{
		$db = \JFactory::getDBO();
		$query = ' SELECT * '
			. ' FROM '. $db->quoteName('#__minitek_wall_grids')
			. ' WHERE '. $db->quoteName('id').' = '. $db->Quote($id);

		$db->setQuery($query);
		$result = $db->loadObject();

		return $result;
	}
}
