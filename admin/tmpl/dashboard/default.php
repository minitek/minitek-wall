<?php

/**
 * @title        Minitek Wall
 * @copyright    Copyright (C) 2011-2021 Minitek, All rights reserved.
 * @license      GNU General Public License version 3 or later.
 * @author url   https://www.minitek.gr/
 * @developers   Minitek.gr
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\URI\URI;
use Joomla\CMS\Session\Session;
use Joomla\Component\MinitekWall\Administrator\Helper\MinitekWallHelper;

$localVersion = MinitekWallHelper::localVersion();
$moduleInstalled = MinitekWallHelper::getModule();
?>

<div class="minitek-dashboard mt-3">
	<?php if (!$moduleInstalled) { ?>
		<joomla-alert type="danger" dismiss="true" class="p-3 text-center" style="animation-name: joomla-alert-fade-in;" role="alert">
			<div class="alert-heading"><span class="danger"></span><span class="visually-hidden">error</span></div>
			<div class="alert-wrapper">
				<div class="alert-message">
					<div><span><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_MODULE_NOT_INSTALLED'); ?></span></div>
					<div class="mt-2">
						<a class="button-success btn btn-sm btn-success" href="https://www.minitek.gr/downloads/minitek-wall-module" target="_blank">
							<span class="icon-download" aria-hidden="true"></span>
							<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_DOWNLOAD'); ?>
						</a>
					</div>
				</div>
			</div>
		</joomla-alert>
	<?php } ?>

	<div class="row g-3">
		<div class="col-12 col-lg-8">
			<div class="brand card mb-3 p-3">
				<div class="d-flex">
					<div class="me-4">
						<img src="<?php echo URI::root(true) . '/media/com_minitekwall/images/logo.png'; ?>">
					</div>
					<div class="py-3">
						<h2 class="mb-3"><?php echo Text::_('COM_MINITEKWALL'); ?> <span class="badge bg-success">Free</span></h2>
						<p class="m-0"><?php echo Text::_('COM_MINITEKWALL_DESC'); ?></p>
					</div>
				</div>
			</div>

			<div class="dashboard-cards row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-3 mb-3 text-center">
				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="<?php echo Route::_('index.php?option=com_minitekwall&task=widget.add'); ?>">
								<div class="mt-1 mb-3"><i class="icon icon-new"></i></div>
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_NEW_WIDGET'); ?></div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="<?php echo Route::_('index.php?option=com_minitekwall&view=widgets'); ?>">
								<div class="mt-1 mb-3"><i class="icon icon-grid"></i></div>
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_WIDGETS'); ?></div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="#" class="disabled" onclick="return: false;">
								<div class="mt-1 mb-3"><i class="icon icon-folder"></i></div>
								<div>
									<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_GROUPS'); ?>
									<span class="badge bg-danger">Pro</span>
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="#" class="disabled" onclick="return: false;">
								<div class="mt-1 mb-3"><i class="icon icon-pencil"></i></div>
								<div>
									<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_CUSTOM_ITEMS'); ?>
									<span class="badge bg-danger">Pro</span>
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="#" class="disabled" onclick="return: false;">
								<div class="mt-1 mb-3"><i class="icon icon-grid-2"></i></div>
								<div>
									<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_CUSTOM_GRIDS'); ?>
									<span class="badge bg-danger">Pro</span>
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="<?php echo Route::_('index.php?option=com_config&view=component&component=com_minitekwall&path=&return=' . base64_encode(URI::getInstance()->toString())); ?>">
								<div class="mt-1 mb-3"><i class="icon icon-cog"></i></div>
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_CONFIGURATION'); ?></div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="<?php echo Route::_('index.php?option=com_minitekwall&task=widgets.deleteCroppedImages&' . Session::getFormToken() . '=1'); ?>">
								<div class="mt-1 mb-3"><i class="icon icon-trash"></i></div>
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_DELETE_CROPPED_IMAGES'); ?></div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card border h-100 py-2">
						<div class="card-body">
							<a href="https://extensions.joomla.org/extension/news-display/articles-display/minitek-wall-pro/" target="_blank">
								<div class="mt-1 mb-3"><i class="icon icon-star" style="color: #ffcb52;"></i></div>
								<div>
									<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_LIKE_THIS_EXTENSION'); ?><br>
									<div class="small"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_LEAVE_A_REVIEW_ON_JED'); ?></div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-4">
			<div class="dashboard-module">
				<div class="card border mb-3 overflow-hidden">
					<div class="card-header">
						<h4 class="m-0"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_ABOUT'); ?></h4>
					</div>
					<div class="card-body p-0">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_EXTENSION'); ?></div>
								<div><a href="https://www.minitek.gr/joomla/extensions/minitek-wall" target="_blank"><?php echo Text::_('COM_MINITEKWALL'); ?></a></div>
							</li>
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_VERSION'); ?></div>
								<div>
									<span class="badge bg-success"><?php echo $localVersion; ?></span> <span class="badge bg-success">Free</span>
									<a id="check-version" href="#" class="btn btn-info btn-sm float-end">
										<i class="fas fa-sync"></i>&nbsp;&nbsp;<?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_CHECK_VERSION'); ?>
									</a>
								</div>
							</li>
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_DEVELOPER'); ?></div>
								<div><a href="https://www.minitek.gr/" target="_blank">Minitek</a></div>
							</li>
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_LICENSE'); ?></div>
								<div><a href="https://www.minitek.gr/terms-of-service" target="_blank">GNU GPLv3 Commercial</a></div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="dashboard-module">
				<div class="card border mb-3 overflow-hidden">
					<div class="card-header">
						<h4 class="m-0"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_QUICK_LINKS'); ?></h4>
					</div>
					<div class="card-body p-0">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<span class="me-2 icon-book icon-fw" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/documentation/joomla/minitek-wall" target="_blank"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_DOCUMENTATION'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="me-2 icon-list icon-fw" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/changelogs/joomla/minitek-wall" target="_blank"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_CHANGELOG'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="me-2 icon-support icon-fw" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/forum/joomla/minitek-wall" target="_blank"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_TECHNICAL_SUPPORT'); ?></a>
									<span class="badge bg-danger">Pro</span>
								</span>
							</li>
							<li class="list-group-item">
								<span class="me-2 icon-help icon-fw" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/documentation/joomla/minitek-wall/faq" target="_blank"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_FAQ'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="me-2 icon-question icon-fw" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/documentation/joomla/minitek-wall/free-vs-pro" target="_blank"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_SIDEBAR_FREE_VS_PRO'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="me-2 icon-lock icon-fw" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/joomla/extensions/minitek-wall#subscriptionPlans" target="_blank"><?php echo Text::_('COM_MINITEKWALL_DASHBOARD_UPGRADE_TO_PRO'); ?></a>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>