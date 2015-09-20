<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks
 * @version 1.0
 */

namespace CEOS\WPi10n\Pages;

function mainPage() {
	$langs = \CEOS\WPi10n\Language::all();
?>

<div class="ceos-wp-i10n">
	<?php include('header.php') ?>
	
	<section id="main-page" class="page-content">
		<div id="main-left">
			<h3 class="title"><?= __('Languages', $domain) ?></h3>
			<p class="desc"><?= __('Select one of the languages below to edit its entries. You can start supporting a new language by clicking the "Add new language" button.', $domain) ?></p>
			
			<ul id="langs-list">
			<?php if(is_array($langs) && sizeof($langs) > 0) : ?>
				<?php foreach($langs as $lang) : ?>
					<li class="lang">
						<a href="" class="lang-link">
							<span class="lang-title"><?= __($lang->englishName, $domain) ?></span>
							<span class="lang-code">(<?= $lang->code ?>)</span>
							<span class="lang-status"><?= __($lang->status, $domain) ?></span>
						</a>
					</li>
				<?php endforeach ?>
			<?php else: ?>
				<li class="empty">
					<div class="inner"><?= __('No languages available.<br /><small>Click the button below to add a new language.</small>', $domain) ?></div>
				</li>
			<?php endif ?>
			</ul>

			<a id="add-lang-link" class="button button-primary"><?= __('Add new language', $domain) ?></a>
		</div>

		<form id="main-right" action="" method="GET">
			<h3 class="title"><?= __('Settings', $domain) ?></h3>

			<div class="content table" id="settings">
				<div class="row">
					<div class="cell desc">
						<label for="def-lang"><?= __('Default website language', $domain) ?></label>
					</div>
					<div class="cell setting">
						<select class="ceos-select" id="def-lang" name="def-lang">
							<?php if(is_array($langs) && sizeof($langs) > 0) : ?>
								<?php foreach($langs as $lang) : ?>
									<option value="<?= $lang->code ?>"><?= __($lang->englishName, $domain) ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
					</div>
				</div>
			</div>
			
			<input type="submit" class="save-link button button-primary" value="<?= __('Save settings', $domain) ?>">
		</form>
	</section>
	
	<?php include('footer.php') ?>
</div>

<?php
}