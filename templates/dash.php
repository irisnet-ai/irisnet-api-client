<div class="wrap">
	<h1>Irisnet Dashboard</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Overview</a></li>
		<li><a href="#tab-2">Example Usage</a></li>
		<li><a href="#tab-3">Documentation</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<?php
				if (isset($_POST["refresh_credits"]) && $_POST["refresh_credits"] === 'refresh') {
					IrisnetAPIConnector::refreshCredits();
				}

				$licenses = get_option( 'irisnet_plugin_licenses' ) ?: array();
				$activeLicenses = 0;
				$usedCredits = 0;
				$totalCredits = 0;
				foreach ($licenses as $license) {
					if (!isset($license['is_active']) || $license['is_active'] == false)
						continue;
					
					$activeLicenses++;
					
					$totalCredits += $license['total_credits'];
					$usedCredits +=  $license['credits_used'];
				}
				
				$rules = get_option( 'irisnet_plugin_rules' ) ?: array();
			?>

			<div class="flex-container">
				<div class="flex-item panel">
					<h3>Credits</h3>
					<div class="panel-body">
						<p class="peak text-center"><?php echo $usedCredits ?> / <?php echo $activeLicenses > 0 && $totalCredits == 0 ? '&infin;' : $totalCredits ?></p>
						<p class="text-center">Consumed credits out of total of active Licenses.</p>
					</div>
					<div class="panel-footer">
						<div class="text-center">
							<?php
								echo '<form method="post" class="inline-block">';
								echo '<input type="hidden" name="refresh_credits" value="refresh">';
								submit_button( 'Refresh', 'secondary small', 'submit', false);
								echo '</form> ';
							?>
						</div>
					</div>
				</div>
				<div class="flex-item panel">
					<h3>Licenses</h3>
					<div class="panel-body">
						<p class="peak text-center"><?php echo $activeLicenses ?> / <?php echo count($licenses) ?></p>
						<p class="text-center">Active licenses out of total saved.</p>
					</div>
					<div class="panel-footer">
						<div class="text-center">
							<a href="https://www.irisnet.de/prices/" class="button button-primary button-small">Buy a License</a>
							<a href="admin.php?page=irisnet_licenses" class="button button-secondary button-small">Manage Licenses</a>
						</div>
					</div>
				</div>
				<div class="flex-item panel">
					<h3>Rules</h3>
					<div class="panel-body">
						<p class="peak text-center"><?php echo count($rules)?></p>
						<p class="text-center">Total rules saved.</p>
					</div>
					<div class="panel-footer">
						<div class="text-center">
							<a href="https://www.irisnet.de/api/" class="button button-primary button-small">API Documentation</a>
							<a href="admin.php?page=irisnet_rules" class="button button-secondary button-small">Manage Rules</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="tab-2" class="tab-pane">
			<p>To make use of the irisnet API use the IrisnetAPIConnector helper class. The class can be called from any Wordpress- or plugin hook that fits your need. Go to Design -> Theme-Editor. Select your current Theme and use one of the following example snippets to get you started.</p>
			<p>The following examples are meant to get you started. We do not guarantee that these examples will work for you. In any case the examples listed below require you to make some changes to fit your case.</p>
			
			<div class="panel">
				<h3>Adding a custom shortcode to show an image only if the rules are not broken</h3>
				<pre class="prettyprint">
// Declare shortcode function
function check_compliant($atts, $content = null) {
	$image_path = $atts['image'];

	try {
		// Check the image using the IrisnetAPIConnector class.
		// See Documentation tab for more details.
		$aiResult = IrisnetAPIConnector::processImage($image_path, 1, 'given_ruleset_name');
	} catch(IrisnetException $e) {
		// Check for possible errors according to the Documentation tab.
	}

	// do your custom check on $aiResult (example)
	$failed = !(isset($aiResult) && $aiResult->getRulesBroken() == 0);

	if ($failed) {
		return sprintf($content, '/path/to/placeholder/image.png');
	} else {
		return sprintf($content, $image_path);
	}
}
add_shortcode('show_image_if_compliant', 'check_compliant');
				</pre>
				<p>Using the shortcode</p>
				<pre class="prettyprint">
[show_image_if_compliant image="/path/to/image.png"]
	&lt;img src="%s"&gt;
[/show_image_if_compliant]
				</pre>
			</div>

<div class="panel">
	<h3>Checking multiple pictures with the same rule set (eg. for a gallery upload)</h3>
	<pre class="prettyprint">
function check_compliant($imageArray) {
	
	// Set the rules outside of the loop
	IrisnetAPIConnector::setRules('given_ruleset_name');
	
	// Iterate over all images an make the check
	foreach($imageArray as $image) {
		try {
			// Call to processImage function w/o passing the rule set name.
			// This way you can minimize the number of api calls.
			// The AI always takes the last given set of rules to make the check.
			$aiResult = IrisnetAPIConnector::processImage($image);
		} catch(IrisnetException $e) {
			// Check for possible errors according to the Documentation tab.
		}

		// do your custom check on $aiResult (example)
		$failed = !(isset($aiResult) && $aiResult->getRulesBroken() == 0);

		if ($failed) {
			// Image is not compliant. Delete image form server...
		}
	}

}
	</pre>
</div>

			<div class="panel">
				<h3>Integrating image check after form submission (Gravity Forms)</h3>
				<pre class="prettyprint">
function ai_image_check_after_submission( $entry, $form ) {
 
	$id = '1'; // Update this number to your field id number
	
	// Get path and url of uploaded file
	$upload_path = GFFormsModel::get_upload_path($entry[ 'form_id' ]);
	$upload_url = GFFormsModel::get_upload_url($entry[ 'form_id' ]);

	// Generate absolute file path
	$image_path = str_replace($upload_url, $upload_path, $entry[ $id ]);
	
	try {
		// Check the image using the IrisnetAPIConnector class.
		// See Documentation tab for more details.
		$aiResult = IrisnetAPIConnector::processImage($image_path, 1, 'given_ruleset_name');
	} catch(IrisnetException $e) {
		// Check for possible errors according to the Documentation tab.
	}

	// do your custom check on $aiResult (example)
	$failed = !(isset($aiResult) && $aiResult->getRulesBroken() == 0);

	if ($failed) {
		// One or more rules were broken in the uploaded image :(
	} else {
		// Uploaded image passed with flying colors :)
	}
	
}
add_action('gform_after_submission', 'ai_image_check_after_submission', 10, 2);
				</pre>
			</div>
		</div>

		<div id="tab-3" class="tab-pane">
			<?php
				$xml = simplexml_load_file(plugin_dir_path(__FILE__) . "usage/structure.xml");
				$class = $xml->file->class;
				$className = $class->name->__toString();
				$methods = $class->method;
			?>

			<div class="panel">
				<h3><?php echo $className ?></h3>
				<h4>Description:</h4>
				<p class="indent"><?php echo $class->docblock->description ?></p>
				<h4>Methods:</h4>

				<?php foreach ($methods as $method): ?>
					<div class="panel-body indent">
						<?php 
							$attributes = $method->attributes();
							$arguments = $method->argument;
							$description = $method->docblock->description;
							$tags = $method->docblock->tag;

							$args = '';
							$i = count($arguments);
							foreach ($arguments as $arg) {
								$args .= !empty($arg->type) ? $arg->type . ' ' : '';
								$args .= $arg->name;
								$args .= (!empty($arg->default) ? ' = ' . $arg->default : '');
								$last_iteration = !(--$i);
								if (!$last_iteration) {
									$args .= ', ';
								}
							}

							$returnType = null;
							$return = null;
							$params = array();
							$exceptionType = null;
							$throws = array();
							foreach ($tags as $tag) {
								if ($tag->attributes()->name == "return") {
									$return = $tag;
									$charPos = strrpos($tag->type, '\\');
									if ($charPos) {
										$returnType = substr($tag->type, $charPos + 1);
									} else {
										$returnType = $tag->type;
									}
								} else if ($tag->attributes()->name == "param") {
									$params[] = $tag;
								} else if ($tag->attributes()->name == "throws") {
									$throws[] = $tag;
									$charPos = strrpos($tag->type, '\\');
									if ($charPos) {
										$exceptionType = substr($tag->type, $charPos + 1);
									} else {
										$exceptionType = $tag->type;
									}
								}
							}
						?>

						<code class="prettyprint">
							<?php 
							echo 
								$attributes->visibility . ' ' .
								(filter_var($attributes->final, FILTER_VALIDATE_BOOLEAN) ? 'final ' : '' ) .
								(filter_var($attributes->abstract, FILTER_VALIDATE_BOOLEAN) ? 'abstract ' : '') .
								(filter_var($attributes->static, FILTER_VALIDATE_BOOLEAN) ? 'static ' : '') .
								'function ' .
								$method->name .
								'(' . $args . ')' . 
								(filter_var($attributes->final, FILTER_VALIDATE_BOOLEAN) ? 'final ' : '' ) .
								($returnType != null ? ' : ' . $returnType : '');

							?>
						</code>
						<p class="indent"><?php echo $method->docblock->description ?></p>

						<h4>Parameters:</h4>
						<?php foreach ($params as $param): ?>
							<p class="indent"><b><?php echo $param->attributes()->variable ?></b> <em>: <?php echo $param->attributes()->type ?></em></p>
							<div class="indent-2"><?php echo $param->attributes()->description ?></div>
						<?php endforeach; ?>
						
						<h4>Returns:</h4>
						<p class="indent"><b><em><?php echo $returnType ?></em></b></p>
						<div class="indent-2"><?php echo $return->attributes()->description ?></div>

						<h4>Throws:</h4>
						<?php foreach ($throws as $throw): ?>
						<p class="indent"><b><em><?php echo $exceptionType ?></em></b></p>
							<div class="indent-2"><?php echo $throw->attributes()->description ?></div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>