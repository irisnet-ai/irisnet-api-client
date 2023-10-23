<div class="wrap">
	<h1>Rules</h1>
	<?php settings_errors(); ?>
    <?php $options = get_option( 'irisnet_plugin_rules' ) ?: array(); ?>

	<ul class="nav nav-tabs">
		<li class="<?php echo !isset($_POST["edit_rule"]) && !empty($options) ? 'active' : '' ?>"><a href="#tab-1">Manage Rules</a></li>
		<li class="<?php echo isset($_POST["edit_rule"]) || empty($options) ? 'active' : '' ?>">
			<a href="#tab-2">
				<?php echo isset($_POST["edit_rule"]) ? 'Edit' : 'Add New' ?> Rule
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_rule"]) && !empty($options) ? 'active' : '' ?>">
			<?php if (!empty($options)): ?>
				<table class="rules-table panel">
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>License Key</th>
						<th class="text-center">Cost</th>
						<th class="text-center">Actions</th>
						
					</tr>

					<?php 
						foreach ($options as $name => $option) {
							$name = esc_attr($name);
							$id = $option['id'];
							$license = $option['license'];
							$license = substr($license, 0, 10) . '...' . substr($license, -10);
							$description = isset($option['description']) ? esc_attr($option['description']) : '';
							$cost = isset($option['cost']) ? $option['cost'] : 'N/A';

							echo "<tr>";
								echo "<td><b>{$name}</b><br><small><em>ID: {$id}</em></small></td>";
								echo "<td>{$description}</td>";
								echo "<td>{$license}</td>";
								echo "<td class=\"text-center\">{$cost}</td>";
								echo "<td class=\"text-center\">";

									echo '<form method="post" action="" class="inline-block">';
									echo '<input type="hidden" name="edit_rule" value="' . $name . '">';
									submit_button( 'Edit', 'primary small', 'submit', false);
									echo '</form> ';

									echo '<form method="post" action="options.php" class="inline-block">';
									settings_fields( 'irisnet_plugin_rules_settings' );
									echo '<input type="hidden" name="remove" value="' . $name . '">';
									submit_button( 'Delete', 'delete small', 'submit', false, array(
										'onclick' => 'return confirm("Are you sure you want to remove this rule?");'
									));
									echo '</form>';

								echo "</td>";
							echo "</tr>";
						}
					?>
				</table>
			<?php else:?>
				<p class="panel">No rules found.</p>
			<?php endif; ?>
		</div>

		<div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_rule"]) || empty($options) ? 'active' : '' ?>">
			<form method="post" action="options.php" class="panel">
				<?php 
					settings_fields( 'irisnet_plugin_rules_settings' );
					do_settings_sections( 'irisnet_rules' );
					submit_button();
				?>
			</form>
		</div>
	</div>
</div>