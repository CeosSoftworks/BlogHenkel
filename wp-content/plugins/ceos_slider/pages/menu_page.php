<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks <contato@ceossoftwork.com.br>
 * @version  1.0
 */

namespace CEOS\Slider\Pages;

function menuPage() {
	include('header.php');

	$sliders = \CEOS\Slider\Slider::getSliders();

	?>
	
	<div class="ceos-slider admin-page menu-page">

		<div class="ceos-table">
			<div class="ceos-table-header">
				<span class="ceos-table-hd"><?= __('Slider') ?></span>
				<span class="ceos-table-hd"><?= __('ID') ?></span>
				<span class="ceos-table-hd"><?= __('Items') ?></span>
			</div>
			<?php if($sliders && sizeof($sliders) > 0) : ?>
			
				<?php foreach($sliders as $slider) : ?>
					<div class="ceos-table-row">
						<span class="ceos-table-td title">
							<b><a href="<?= admin_url('admin.php?page='.\CEOS\Slider\PLUGIN_PREFIX.'create&edit=' . $slider->slid_id) ?>"><?= $slider->slid_title ?></a></b>
							<div class="actions">
								<a href="<?= admin_url('admin.php?page='.\CEOS\Slider\PLUGIN_PREFIX.'create&edit=' . $slider->slid_id) ?>" class="edit"><?= __('Edit') ?></a>
								<span class="sep">|</span>
								<a href="<?= admin_url('admin.php?page='.\CEOS\Slider\PLUGIN_PREFIX.'menu_page&remove=' . $slider->slid_id) ?>" class="trash"><?= __('Remove') ?></a>
							</div>
						</span>
						<span class="ceos-table-td id"><?= $slider->slid_id ?></span>
						<span class="ceos-table-td count"><?= $slider->count ?></span>
					</div>
				<?php endforeach ?>

			<?php else : ?>
				
				<div class="ceos-empty">
					<div><?= __('There are no sliders available. <a href="'.admin_url('admin.php?page='.\CEOS\Slider\PLUGIN_PREFIX.'create').'">Click here</a> to create a new one.') ?></div>
				</div>
			
			<?php endif ?>
		</div>

	</div>

	<?php include('footer.php');
}