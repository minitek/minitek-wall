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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\MinitekWall\Administrator\Helper\MinitekWallHelper;

$localVersion = MinitekWallHelper::localVersion();
$latestVersion = MinitekWallHelper::latestVersion();
$type = Factory::getApplication()->input->get('type', 'auto');

if ($latestVersion && version_compare($latestVersion, $localVersion, '>')) { ?>
<div class="alert alert-success text-center mt-0" id="update-box">
  <div class="update-info">
    <div>
      <span><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_A_NEW_VERSION_IS_AVAILABLE'); ?></span>
      <span class="badge badge-success"><?php echo $latestVersion; ?></span> <span class="badge badge-success">Free</span>
    </div>
    <div class="mt-2">
      <a class="button-success btn btn-sm btn-success" href="<?php echo Route::_('index.php?option=com_installer&view=update'); ?>">
        <span class="icon-refresh" aria-hidden="true"></span>
        <?php echo Text::_('COM_MINITEKWALL_DASHBOARD_UPDATE_NOW'); ?>
      </a>
    </div>
  </div>
</div>
<?php } else if ($type == 'check') { ?>
  <?php if ($latestVersion) { ?>
  <div class="alert alert-success text-center mt-0" id="update-box">
    <div class="update-info">
      <div>
        <?php if ($latestVersion == $localVersion) { ?>
          <span><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_YOU_HAVE_THE_LATEST_VERSION'); ?></span>
        <?php } else { ?>
          <span><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_YOU_HAVE_A_DEVELOPMENT_VERSION'); ?></span>
        <?php } ?>
        <span class="badge badge-success"><?php echo $latestVersion; ?></span> <span class="badge badge-success">Free</span>
      </div>
    </div>
  </div>
  <?php } else { ?>
    <div class="alert alert-danger text-center mt-0" id="update-box">
      <div class="update-info">
        <div>
          <span><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_COULD_NOT_FETCH_UPDATE_INFO'); ?></span>
        </div>
      </div>
    </div>
  <?php } ?>
<?php }
