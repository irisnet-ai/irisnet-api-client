<div class="wrap">
    <h1>Licenses</h1>
    <?php settings_errors() ?>
    <?php $options = get_option( 'irisnet_plugin_licenses' ) ?: array(); ?>

    <ul class="nav nav-tabs">
        <li class="<?php echo !isset($_POST["edit_license"]) && !empty($options) ? 'active' : '' ?>">
            <a href="#tab-1">Manage Licenses</a>
        </li>
        <li class="<?php echo isset($_POST["edit_license"]) || empty($options) ? 'active' : '' ?>">
            <a href="#tab-2"><?php echo isset($_POST["edit_license"]) ? 'Edit' : 'Add New' ?> License</a>
        </li>
    </ul>

    <div class="tab-content">
		<div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_license"]) && !empty($options) ? 'active' : '' ?>">
			<?php if (!empty($options)): ?>
				<table class="license-table panel">
					<tr>
						<th>ID</th>
						<th>License Key</th>
						<th class="text-center">Credits</th>
						<th class="text-center">Is Active</th>
						<th class="text-center">Actions</th>
					</tr>

					<?php 
						foreach ($options as $key => $option) {
							$is_active = isset($option['is_active']) ? "<span class='positive'>&#10004;</span>" : "<span class='negative'>&#10008;</span>";
							$credits_info = 'N/A';
							if (isset($option['credits_used'])) {
								$credits_info = $option['credits_used'] . ' / ' . $option['total_credits'];
							}
						

							echo "<tr>";
								echo "<td>{$key}</td>";
								echo "<td>{$option['license']}</td>";
								echo "<td class=\"text-center\">{$credits_info}</td>";
								echo "<td class=\"text-center\">{$is_active}</td>";
								echo "<td class=\"text-center\">";

									echo '<form method="post" action="" class="inline-block">';
									echo '<input type="hidden" name="edit_license" value="' . $key . '">';
									submit_button( 'Edit', 'primary small', 'submit', false);
									echo '</form> ';

									echo '<form method="post" action="options.php" class="inline-block">';
									settings_fields( 'irisnet_plugin_licenses_settings' );
									echo '<input type="hidden" name="remove" value="' . $key . '">';
									submit_button( 'Delete', 'delete small', 'submit', false, array(
										'onclick' => 'return confirm("Are you sure you want to remove this License Key?");'
									));
									echo '</form>';

								echo "</td>";
							echo "</tr>";
						}
					?>
				</table>
			<?php else:?>
				<p class="panel">No license keys found.</p>
			<?php endif; ?>
        </div>
        <div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_license"]) || empty($options) ? 'active' : '' ?>">
            <form method="post" action="options.php" class="panel">
				<?php 
					settings_fields( 'irisnet_plugin_licenses_settings' );
					do_settings_sections( 'irisnet_licenses' );
					submit_button();
				?>
			</form>
        </div>
    </div>
</div>