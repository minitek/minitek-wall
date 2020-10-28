<?php
/**
* @title		Minitek Wall
* @copyright   	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license   	GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\Component\Installer\Administrator\Model\InstallModel;
use Joomla\Component\Installer\Administrator\Model\ManageModel;

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
		// Get new version
		$this->new_version = $parent->manifest->version;

		// Get Joomla version
		$version = new \JVersion();
		$sversion = $version->getShortVersion();

		// Abort if Joomla 3 is detected
		if (isset($sversion) && $sversion && version_compare($sversion, '4.0.0-dev', '<'))
		{
			throw new GenericDataException('Cannot install Minitek Wall version <strong>'.$this->new_version.'</strong> in <strong>Joomla 3</strong>. Please update to <strong>Joomla 4</strong> first.', 500);
			
			return false;
		}

		if (is_object($this->getInstalledVersion()))
		{
			// Get installed version
			$this->installed_version = $this->getInstalledVersion()->version;

			// v4.0.15 - Run update script if installed version is older than 4.0.0
			if (isset($this->installed_version) && $this->installed_version && version_compare($this->installed_version, '4.0.0', '<'))
			{
				self::update4015($parent);
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
	{
		if ($type != 'uninstall')
		{
			// Install Minitek Wall Module
			self::installModule();
			
			// Install Content Source Plugin
			self::installContentSource();
		}
	}

	/*
	 * $parent is the class calling this method
	 * uninstall runs before any other action is taken (file removal or database processing).
	 */
	function uninstall($parent)
	{}

	/**
	 * $parent is the class calling this method
	 * get installed version.
	 */
	private static function getInstalledVersion()
	{
		$db = Factory::getDBO();
		$query = 'SELECT '.$db->quoteName('manifest_cache').' FROM '.$db->quoteName('#__extensions');
		$query .= ' WHERE ' . $db->quoteName('element').' = '.$db->quote('com_minitekwall');
		$db->setQuery($query);

		if ($row = $db->loadObject())
		{
			$manifest_cache = json_decode($row->manifest_cache, false);

			return $manifest_cache;
		}
		
		return false;
	}

	/**
	 * $parent is the class calling this method.
	 * update runs if old version is older than 4.0.0.
	 */
	private static function update4015($parent)
	{
		/*
		 * Migrate database tables
		 */ 

		$db = Factory::getDbo();

		// Get all widgets
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from($db->quoteName('#__minitek_wall_widgets'));
		$db->setQuery($query);

		try 
		{
			$widgets = $db->loadObjectList();
		}
		catch (\Exception $e)
		{
			throw new GenericDataException('Error 4.0.15: Could not read widgets.', 500);

			return false;
		}
		
		if ($widgets)
		{
			foreach ($widgets as $widget)
			{
				if ($widget->type_id != 'scroller')
				{
					continue;
				}

				// Delete all scroller widgets records in #__minitek_wall_widgets_source
				$query = $db->getQuery(true);
				$conditions = array(
					$db->quoteName('widget_id').' = '.$db->quote($widget->id)
				);
				$query->delete($db->quoteName('#__minitek_wall_widgets_source'));
				$query->where($conditions);
				$db->setQuery($query);
				$result = $db->execute();

				// Delete all scroller widgets in #__minitek_wall_widgets
				$query = $db->getQuery(true);
				$conditions = array(
					$db->quoteName('id').' = '.$db->quote($widget->id)
				);
				$query->delete($db->quoteName('#__minitek_wall_widgets'));
				$query->where($conditions);
				$db->setQuery($query);
				$result = $db->execute();
			}
		}

		/* 
		 * Update __minitek_wall_widgets
		 */

		$widgets_columns = $db->getTableColumns('#__minitek_wall_widgets');

		// Delete column 'type_id' in #__minitek_wall_widgets
		if (isset($widgets_columns['type_id']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets` ";
			$query .= " DROP COLUMN `type_id` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column type_id.', 500);

				return false;
			}
		}		

		// Delete column 'slider_params' in #__minitek_wall_widgets
		if (isset($widgets_columns['slider_params']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets` ";
			$query .= " DROP COLUMN `slider_params` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column slider_params.', 500);

				return false;
			}
		}

		// Delete column 'scroller_params' in #__minitek_wall_widgets
		if (isset($widgets_columns['scroller_params']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets` ";
			$query .= " DROP COLUMN `scroller_params` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column scroller_params.', 500);

				return false;
			}
		}

		// Rename source_id: 'joomla' to 'content'
		$query = $db->getQuery(true);
		$fields = array(
			$db->quoteName('source_id').' = '.$db->quote('content')
		);
		$conditions = array(
			$db->quoteName('source_id').' = '.$db->quote('joomla'),
		);
		$query->update($db->quoteName('#__minitek_wall_widgets'))
			->set($fields)
			->where($conditions);
		$db->setQuery($query);
		$result = $db->execute();
		
		/* 
		 * Update __minitek_wall_widgets_source
		 */

		$widgets_source_columns = $db->getTableColumns('#__minitek_wall_widgets_source');

		// Add column 'source_params' in #__minitek_wall_widgets_source
		if (!isset($widgets_source_columns['source_params']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " ADD COLUMN `source_params` text DEFAULT NULL ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not add column source_params.', 500);

				return false;
			}
		}

		// Get all widgets sources
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from($db->quoteName('#__minitek_wall_widgets_source'));
		$db->setQuery($query);

		try 
		{
			$sources = $db->loadObjectList();
		}
		catch (\Exception $e)
		{
			throw new GenericDataException('Error 4.0.15: Could not read widgets sources.', 500);

			return false;
		}

		// Update source_params
		if ($sources)
		{
			foreach ($sources as $source)
			{
				// joomla_source
				if ($source->joomla_source)
				{
					$joomla_source = json_decode($source->joomla_source, true);
					$source_type = array('source_type' => 'content');
					$joomla_source = $source_type + $joomla_source;
					$source_params = json_encode($joomla_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// k2_source
				if ($source->k2_source)
				{
					$k2_source = json_decode($source->k2_source, true);
					$source_type = array('source_type' => 'k2');
					$k2_source = $source_type + $k2_source;
					$source->source_params = json_encode($k2_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// virtuemart_source
				if ($source->virtuemart_source)
				{
					$virtuemart_source = json_decode($source->virtuemart_source, true);
					$source_type = array('source_type' => 'virtuemart');
					$virtuemart_source = $source_type + $virtuemart_source;
					$source->source_params = json_encode($virtuemart_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// jomsocial_source
				if ($source->jomsocial_source)
				{
					$jomsocial_source = json_decode($source->jomsocial_source, true);
					$source_type = array('source_type' => 'jomsocial');
					$jomsocial_source = $source_type + $jomsocial_source;
					$source->source_params = json_encode($jomsocial_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// easyblog_source
				if ($source->easyblog_source)
				{
					$easyblog_source = json_decode($source->easyblog_source, true);
					$source_type = array('source_type' => 'easyblog');
					$easyblog_source = $source_type + $easyblog_source;
					$source->source_params = json_encode($easyblog_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// folder_source
				if ($source->folder_source)
				{
					$folder_source = json_decode($source->folder_source, true);
					$source_type = array('source_type' => 'folder');
					$folder_source = $source_type + $folder_source;
					$source->source_params = json_encode($folder_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// rss_source
				if ($source->rss_source)
				{
					$rss_source = json_decode($source->rss_source, true);
					$source_type = array('source_type' => 'rss');
					$rss_source = $source_type + $rss_source;
					$source->source_params = json_encode($rss_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// easysocial_source
				if ($source->easysocial_source)
				{
					$easysocial_source = json_decode($source->easysocial_source, true);
					$source_type = array('source_type' => 'easysocial');
					$easysocial_source = $source_type + $easysocial_source;
					$source->source_params = json_encode($easysocial_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}

				// custom_source
				if ($source->custom_source)
				{
					$custom_source = json_decode($source->custom_source, true);
					$source_type = array('source_type' => 'custom');
					$custom_source = $source_type + $custom_source;
					$source->source_params = json_encode($custom_source);

					$query = $db->getQuery(true);
					$query
						->update($db->quoteName('#__minitek_wall_widgets_source'))
						->set($db->quoteName('source_params').' = '.$db->quote($source_params))
						->where($db->quoteName('widget_id').' = '.$db->quote($source->widget_id));			
					$db->setQuery($query);
					$db->execute();

					continue;
				}
			}
		}		
		
		// Delete column 'joomla_source'
		if (isset($widgets_source_columns['joomla_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `joomla_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column joomla_source.', 500);

				return false;
			}
		}

		// Delete column 'k2_source'
		if (isset($widgets_source_columns['k2_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `k2_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column k2_source.', 500);

				return false;
			}
		}

		// Delete column 'virtuemart_source'
		if (isset($widgets_source_columns['virtuemart_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `virtuemart_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column virtuemart_source.', 500);

				return false;
			}
		}

		// Delete column 'jomsocial_source'
		if (isset($widgets_source_columns['jomsocial_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `jomsocial_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column jomsocial_source.', 500);

				return false;
			}
		}

		// Delete column 'easyblog_source'
		if (isset($widgets_source_columns['easyblog_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `easyblog_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column easyblog_source.', 500);

				return false;
			}
		}

		// Delete column 'folder_source'
		if (isset($widgets_source_columns['folder_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `folder_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column folder_source.', 500);

				return false;
			}
		}

		// Delete column 'rss_source'
		if (isset($widgets_source_columns['rss_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `rss_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column rss_source.', 500);

				return false;
			}
		}

		// Delete column 'easysocial_source'
		if (isset($widgets_source_columns['easysocial_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `easysocial_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column easysocial_source.', 500);

				return false;
			}
		}

		// Delete column 'custom_source'
		if (isset($widgets_source_columns['custom_source']))
		{
			$query = $db->getQuery(true);
			$query = " ALTER TABLE `#__minitek_wall_widgets_source` ";
			$query .= " DROP COLUMN `custom_source` ";
			$db->setQuery($query);

			if (!$result = $db->execute())
			{
				throw new GenericDataException('Error 4.0.15: Could not delete column custom_source.', 500);

				return false;
			}
		}
	}

	/**
	 * Install Minitek Wall Module.
	 * 
	 * @since   4.0.15
	 */
	private static function installModule()
	{
		$db = Factory::getDBO();
 		$query = $db->getQuery(true)
 			->select('*')
 			->from($db->quoteName('#__extensions'))
 			->where($db->quoteName('element').' = '.$db->quote('mod_minitekwall'));
 		$db->setQuery($query);

		if (!$result = $db->loadObject())
		{
			$app = Factory::getApplication();
			$input = $app->input;
			$xml = 'https://www.minitek.gr/index.php?option=com_ars&view=update&task=stream&format=xml&id=31';

			if (!$url = self::getInstallUrl($xml))
			{
				return false;
			}

			$input->set('installtype', 'url', 'STRING');
			$input->set('install_url', $url, 'STRING');
			$installModel = new InstallModel;
			$installModel->install();
		}
	}

	/**
	 * Install Content Source Plugin.
	 * 
	 * @since   4.0.15
	 */
	private static function installContentSource()
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from($db->quoteName('#__extensions'))
			->where($db->quoteName('folder').' = '.$db->quote('content'))
			->where($db->quoteName('element').' = '.$db->quote('msourcecontent'));
		$db->setQuery($query);

		if (!$result = $db->loadObject())
		{
			$app = Factory::getApplication();
			$input = $app->input;
			$xml = 'https://www.minitek.gr/index.php?option=com_ars&view=update&task=stream&format=xml&id=37';

			if (!$url = self::getInstallUrl($xml))
			{
				return false;
			}

			$input->set('installtype', 'url', 'STRING');
			$input->set('install_url', $url, 'STRING');
			$installModel = new InstallModel;

			if ($installModel->install())
			{
				// Enable plugin
				$query = $db->getQuery(true)
					->update($db->quoteName('#__extensions'))
					->set($db->quoteName('enabled').' = '.$db->quote(1))
					->where($db->quoteName('element').' = '.$db->quote('msourcecontent'))
					->where($db->quoteName('type').' = '.$db->quote('plugin'));
				$db->setQuery($query);
				$db->execute();
			}
		}
	}

	/**
	 * Get extension install url.
	 *
	 * @return  mixed	install url or false.
	 *
	 * @since   4.0.15
	 */
	public static function getInstallUrl($xml_url)
	{
		$xml_file = @file_get_contents($xml_url);

		if ($xml_file)
		{
			$updates = new \SimpleXMLElement($xml_file);
			
			foreach ($updates as $key => $update)
			{
				$platform = (array)$update->targetplatform->attributes()->version;

				if ($platform[0] == '4.*')
				{
					foreach ($update->downloads as $key => $download)
					{
						$url = (string)$download->downloadurl;

						return $url;
					}	
				}
			}
		}

		return false;
	}
}
