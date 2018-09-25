<div class="wrap">
	<h1>SendinBlue Advance Tracker</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php 
			settings_fields( 'sbwp_settings_group' );
			do_settings_sections( 'sendinblue-wp-plugin' );
			submit_button();
		?>
	</form>

	<h3>How To Use SendinBlue Advance Tracker</h3>
	<h4>Setup</h4>
	<p>Add your SendinBlue Api key and save it. Then this plugin start to track page and post views of your website. To get your Api Key, login to your sendinblue account, Goto Automation -> Settings -> Tracker Code. Your Api Key is available at "Marketing Automation Tracking ID". Copy and insert it to Api Key in this page.</p>
	<h4>How To Track User Events</h4>
	<p>You need to add the below shortcodes to track user events.</p>
	<p>
		<ol>
			<li>Identify User : <code>[sb-tracker type="identify"]</code></li>
			<li>Track Page : <code>[sb-tracker type="page" data="PAGE_NAME"]</code></li>
			<li>Track Link : <code>[sb-tracker type="link" data="URL"]</code></li>
			<li>Track Event : <code>[sb-tracker type="track" data="TRACK_DATA"]</code></li>
			<li>Track Cart : <code>[sb-tracker type="cart" data="EVENT_NAME"]</code></li>
			<li>Track Product : <code>[sb-tracker type="track" data="EVENT_NAME" p-id="PRODUCT_ID" p-name="PRODUCT_NAME" p-amount="AMOUNT" p-price="UNIT_PRICE"]</code></li>
		</ol>
	</p>
	<p>You can add any data to <strong>data field</strong>. This is useful to identify the event in your logs. You can add extra info to tracker. You need to add them as <strong>Key Value</strong> pairs.</p>
	<p>Example : More Tracker Data</p>
	<p>Website owner want to specify some information in the page.</p>
	<p>Track Page : <code>[sb-tracker type="page" data="PAGE_NAME" category="news" contains="new product release"]</code></p>
	<p><strong>category="news" contains="new product release"</strong> are the extra data we sent with the normal tracker.</p>

	<h3>About Us</h3>
	<p>Softink Lab is focusing on developing most innovative and comprehensive software and web tools, research about electronic and computers and provide learning resources about computer science.</p>
	<p><a href="https://www.softinklab.com/contact-us" target="_blank">Contact Us</a> | <a href="https://www.softinklab.com" target="_blank">Visit Website</a></p>

</div>