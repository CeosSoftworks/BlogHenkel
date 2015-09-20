<?php

if(isset($_GET['remove']) && !empty($_GET['remove'])) : ?>

	<span class="ceos-header-msg error">
		<form class="inner" method="POST" action="<?= \CEOS\Slider\PLUGIN_PATH_URL ?>services/remove_slider.php">
			<input type="hidden" name="nonce" value="<?= wp_create_nonce(\CEOS\Slider\PLUGIN_PREFIX . '_remove_' . $_GET['remove'] . get_current_user_id()) ?>">
			<input type="hidden" name="id" value="<?= $_GET['remove'] ?>">

			<span class="icon"></span>
			<span class="text"><?= __('Are you sure you want to the remove "<b>' . \CEOS\Slider\Slider::getSliderTitle($_GET['remove']) . '</b>"?') ?></span>
			<span class="controls">
				<input type="submit" class="button button-secondary" value="<?= __('Yes') ?>">
				<a id="msg-cancel" href="javascript:void(0)" class="button button-primary"><?= __('No') ?></a>
			</span>
		</form>

		<script type="text/javascript">
			document.getElementById('msg-cancel')
				.addEventListener('click', function () {
				document.getElementsByClassName('ceos-header-msg error')[0].remove();
			})
		</script>
	</span>

<? endif;

if(isset($_GET['status'])) :
	
	switch ($_GET['status']) {
		case 'invalid_verification':
			$class = 'error';
			$msg = 'Invalid verification number sent. Please verify if you still logged and that you have the proper permissions to execute this action.';
			break;

		case 'remove_error':
			$class = 'error';
			$msg = 'An error occurred while removing a slider. Please try again.';
			break;

		case 'success':
			$class = 'success';
			$msg = 'Action performed successfully.';
	}

	?>

	<span class="ceos-header-msg <?= $class ?>">
		<div class="inner">
			<span class="icon"></span>
			<span class="text"><?= __($msg) ?></span>
			
			<span class="controls">
				<a id="msg-close" href="javascript:void(0)" class="button button-primary"><?= __('OK') ?></a>
			</span>
		</div>

		<script type="text/javascript">
			document.getElementById('msg-close')
				.addEventListener('click', function () {
				document.getElementsByClassName('ceos-header-msg')[0].remove();
			})
		</script>
	</span>

	<?php

endif;