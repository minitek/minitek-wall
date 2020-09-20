<?php
/**
* @title				Minitek Wall
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

// Page title
if ($this->mas_page_title)
{
	if ($this->params->get('show_page_heading', 1)) {
		$app = \JFactory::getApplication();
		$menu = $app->getMenu();
		$active = $menu->getActive();
		if ($active->params->get('page_heading'))
		{
			$page_heading = $active->params->get('page_heading');
		} else {
			$doc = \JFactory::getDocument();
			$page_heading = $doc->getTitle();
		}
	?>
		<div class="page-header">
			<h1> <?php echo $this->escape($page_heading); ?> </h1>
		</div>
	<?php }
}

// Suffix
$suffix = '';
if (isset($this->suffix))
{
	$suffix = $this->suffix;
}
?>

<div class="mnwall_loader mas_loader" id="mnwall_loader_<?php echo $this->widgetID; ?>"> </div>
<div
	id="mnwall_container_<?php echo $this->widgetID; ?>"
	class="mnwall_container mnwall-<?php echo $this->mnwall_layout; ?> <?php echo $this->mnwall_grid; ?> <?php echo $suffix; ?>"
	data-order="<?php echo $this->active_ordering; ?>"
	data-direction="<?php echo $this->active_direction; ?>"
>

	<?php if (isset($this->filters) || isset($this->sortings)) { ?>

		<div class="mnwall_filters_sortings">

		<?php
		////////////////////////////////////////////////////////////////
		// Filters
		////////////////////////////////////////////////////////////////

		if (isset($this->filters))
		{ ?>

			<div id="mnwall_iso_filters_cont_<?php echo $this->widgetID; ?>" class="mnwall_iso_filters_cont">
				<div id="mnwall_iso_filters_<?php echo $this->widgetID; ?>" class="mnwall_iso_filters">
					<?php echo $this->loadTemplate('filters'); ?>
				</div>
			</div>

		<?php }

		////////////////////////////////////////////////////////////////
		// Sortings
		////////////////////////////////////////////////////////////////

		if (isset($this->sortings))
		{ ?>

			<div id="mnwall_iso_sortings_cont_<?php echo $this->widgetID; ?>" class="mnwall_iso_sortings_cont">
				<div id="mnwall_iso_sortings_<?php echo $this->widgetID; ?>" class="mnwall_iso_sortings">
					<?php echo $this->loadTemplate('sortings'); ?>
				</div>
			</div>

		<?php }

		////////////////////////////////////////////////////////////////
		// Reset button
		////////////////////////////////////////////////////////////////

		if ($this->resetButton && (isset($this->filters) || isset($this->sortings)))
		{ ?>

			<div class="mnwall_iso_reset_cont">
				<div class="mnwall_iso_reset">
					<button class="btn-reset" id="mnwall_reset_<?php echo $this->widgetID; ?>">
						<i class="fa fa-times"></i> <?php echo \JText::_('COM_MINITEKWALL_RESET'); ?>
					</button>
				</div>
			</div>

		<?php } ?>

		</div>

	<?php }
	////////////////////////////////////////////////////////////////
	// Masonry Container
	////////////////////////////////////////////////////////////////
	?>

    <div
		id="mnwall_iso_container_<?php echo $this->widgetID; ?>"
		class="mnwall_iso_container"
		style="margin: -<?php echo (int)$this->gutter; ?>px;"
	>
		<?php echo $this->loadTemplate($this->mnwall_layout); ?>
    </div>

	<?php
	////////////////////////////////////////////////////////////////
	// Pagination
	////////////////////////////////////////////////////////////////

	// Append / Infinite pagination
	if (isset($this->pagination) && ($this->pagination == '1' || $this->pagination == '4'))
	{ ?>

		<div class="mnwall_more_results">
			<a href="#" class="more-results mnw-all" data-page="2">
				<span class="more-results">
					<?php echo \JText::_('COM_MINITEKWALL_LOAD_MORE_ITEMS'); ?>
					<?php if (isset($this->pagination) && $this->pagination == '1' && $this->showRemaining) { ?>
						(<span class="mnw-total-items"><?php echo $this->remainingCount; ?></span>)
					<?php } ?>
				</span>
				<span class="no-results"><?php echo \JText::_('COM_MINITEKWALL_NO_MORE_ITEMS'); ?></span>
				<div class="mnwall_append_loader mas_loader"> </div>
			</a>
			<?php if ($this->mas_pag_reset_filters) { ?>
				<a href="#" class="mnwall-reset-btn">
					<span><?php echo \JText::_('COM_MINITEKWALL_RESET_FILTERS'); ?></span>
				</a>
			<?php } ?>
		</div>

	<?php }
	// Arrows pagination
	else if (isset($this->pagination) && $this->pagination == '2')
	{ ?>

		<div class="mnwall_arrows">
			<a href="#" class="mnwall_arrow mnwall_arrow_prev disabled" data-page="0" title="<?php echo \JText::_('COM_MINITEKWALL_PREVIOUS_PAGE'); ?>">
				<span class="more-results"><?php echo '<i class="fa fa-'.$this->arrows.'-left"></i>'; ?></span>
				<div class="mnwall_arrow_loader mas_loader"> </div>
			</a>
			<?php
			$next_class = '';
			if ($this->totalPages == 1) {
				$next_class = 'disabled';
			} ?>
			<a href="#" class="mnwall_arrow mnwall_arrow_next <?php echo $next_class; ?>" data-page="2" title="<?php echo \JText::_('COM_MINITEKWALL_NEXT_PAGE'); ?>">
				<span class="more-results"><?php echo '<i class="fa fa-'.$this->arrows.'-right"></i>'; ?></span>
				<div class="mnwall_arrow_loader mas_loader"> </div>
			</a>
			<?php if ($this->mas_pag_reset_filters) { ?>
				<a href="#" class="mnwall-reset-btn">
					<span><?php echo \JText::_('COM_MINITEKWALL_RESET_FILTERS'); ?></span>
				</a>
			<?php } ?>
		</div>

	<?php }
	// Pages pagination
	else if (isset($this->pagination) && $this->pagination == '3')
	{ ?>

		<div class="mnwall_pages">
			<?php for ($i = 1; $i <= (int)$this->totalPages; $i++) { ?>
				<?php if ($i == 1) {
					$active_page = 'mnw_active';
				} else {
					$active_page = '';
				} ?>
    			<a href="#" class="mnwall_page <?php echo $active_page; ?>" data-page="<?php echo $i; ?>">
					<span class="page-number"><?php echo $i; ?></span>
					<div class="mnwall_page_loader mas_loader"> </div>
				</a>
			<?php } ?>
			<?php if ($this->mas_pag_reset_filters) { ?>
				<a href="#" class="mnwall-reset-btn">
					<span><?php echo \JText::_('COM_MINITEKWALL_RESET_FILTERS'); ?></span>
				</a>
			<?php } ?>
		</div>

	<?php } ?>

</div>
