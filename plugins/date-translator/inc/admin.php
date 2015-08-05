<?php
	/*Admin option page function*/
	function nhndt_options_page() {
		global $nhndt_options;
		$datas = array(
					array(
							"title" => "Translate the months",
							"fields" => array(
									array("name" => "January","deafult" => "January"),
									array("name" => "February","deafult" => "February"),
									array("name" => "March","deafult" => "March"),
									array("name" => "April","deafult" => "April"),
									array("name" => "May","deafult" => "May"),
									array("name" => "June","deafult" => "June"),
									array("name" => "July","deafult" => "July"),
									array("name" => "August","deafult" => "August"),
									array("name" => "September","deafult" => "September"),
									array("name" => "October","deafult" => "October"),
									array("name" => "November","deafult" => "November"),
									array("name" => "December","deafult" => "December")
								),
						),
					array(
							"title" => "Translate the months (Short Forms)",
							"fields" => array(
									array("name" => "Jan","deafult" => "Jan"),
									array("name" => "Feb","deafult" => "Feb"),
									array("name" => "Mar","deafult" => "Mar"),
									array("name" => "Apr","deafult" => "Apr"),
									array("name" => "May2","deafult" => "May"),
									array("name" => "Jun","deafult" => "Jun"),
									array("name" => "Jul","deafult" => "Jul"),
									array("name" => "Aug","deafult" => "Aug"),
									array("name" => "Sep","deafult" => "Sep"),
									array("name" => "Oct","deafult" => "Oct"),
									array("name" => "Nov","deafult" => "Nov"),
									array("name" => "Dec","deafult" => "Dec")
								),
						),
					array(
							"title" => "Translate the Day names",
							"fields" => array(
									array("name" => "Saturday","deafult" => "Saturday"),
									array("name" => "Sunday","deafult" => "Sunday"),
									array("name" => "Monday","deafult" => "Monday"),
									array("name" => "Tuesday","deafult" => "Tuesday"),
									array("name" => "Wednesday","deafult" => "Wednesday"),
									array("name" => "Thursday","deafult" => "Thursday"),
									array("name" => "Friday","deafult" => "Friday")
								),
						),
					array(
							"title" => "Translate the Day names (Short Forms)",
							"fields" => array(
									array("name" => "Sat","deafult" => "Sat"),
									array("name" => "Sun","deafult" => "Sun"),
									array("name" => "Mon","deafult" => "Mon"),
									array("name" => "Tue","deafult" => "Tue"),
									array("name" => "Wed","deafult" => "Wed"),
									array("name" => "Thu","deafult" => "Thu"),
									array("name" => "Fri","deafult" => "Fri")
								),
						),
					array(
							"title" => "Am and Pm",
							"fields" => array(
									array("name" => "Am","deafult" => "Am"),
									array("name" => "Pm","deafult" => "Pm"),
								),
						),
					array(
							"title" => "Translate the numbers",
							"fields" => array(
									array("name" => "0","deafult" => "0"),
									array("name" => "1","deafult" => "1"),
									array("name" => "2","deafult" => "2"),
									array("name" => "3","deafult" => "3"),
									array("name" => "4","deafult" => "4"),
									array("name" => "5","deafult" => "5"),
									array("name" => "6","deafult" => "6"),
									array("name" => "7","deafult" => "7"),
									array("name" => "8","deafult" => "8"),
									array("name" => "9","deafult" => "9")
								),
						),
				);
		ob_start(); ?>
		<div class="wrap">
			<div>
				<h1>Date Translator</h1>
				<h3 id="content">Table of Contents</h3>
				<?php foreach($datas as $data): ?>
					<a style="text-decoration:none;" href="#<?php echo $data["title"]; ?>"><b><?php echo $data["title"]; ?></b></a><br />
				<?php endforeach; ?>
				<form action="options.php" method="post" >
					<?php settings_fields('nhndt_settings_group'); ?>
					<?php do_settings_sections('nhndt_settings_group'); ?>
					<?php foreach($datas as $data): ?>
					<h3 id="<?php echo $data["title"] ?>"><?php echo $data["title"] ?></h3>
					<table>
						<?php $fields = $data["fields"]; ?>
						<?php foreach($fields as $field): ?>
						<tr>
							<td><label for="<?php echo $field["name"]; ?>"><?php echo $field["name"]; ?></label></td>
							<td><input id="nhndt_settings[<?php echo $field["name"]; ?>]" size="30" name="nhndt_settings[<?php echo $field["name"]; ?>]" type="text" value="<?php if(empty($nhndt_options[$field["name"]])){echo "";}else{ echo $nhndt_options[$field["name"]];} ?>" placeholder="<?php echo $field["deafult"]; ?>"/></td>
						</tr>
						<?php endforeach; ?>
					</table>
					<a style="text-decoration:none;" href="#content">Back to Top</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a style="text-decoration:none;" href="#submit">Go to Bottom</a>
					<?php endforeach; ?>
					<br />
					<br />
					<table>
						<tr>
							<td></td>
							<td>
								<iframe src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Fnazmul.hossain.nihal&amp;width&amp;height=35&amp;colorscheme=light&amp;layout=standard&amp;show_faces=false&amp;appId=715408735224516" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
								<br />
								If you find this plugin useful then please rate this plugin <a style="text-decoration:none;" href="http://wordpress.org/extend/plugins/date-translator/" target="_blank">here</a> <br /> and don't forget to visit my website <a style="text-decoration:none;" href="http://www.SuperbCodes.com/" target="_blank">SuperbCodes.com</a>.
								<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FYMPLJ69H9EM6" target="_blank"><img style="width:100px;height:30px;" alt="Donate" src="<?php echo plugin_dir_url( __FILE__ ); ?>images/donate.gif" /></a></p>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input id="submit" type='submit' class='button-primary' id='submitbutton'/></td>
						</tr>
					</table>
					
				</form>
			</div>
		</div>
		
	<?php
		echo ob_get_clean();
	}
	/*Admin option link add function*/
	function nhndt_add_options_link() {
		add_options_page('Date Translator', 'Translate Date', 'manage_options', 'nhndt-options', 'nhndt_options_page');
	}
	add_action('admin_menu', 'nhndt_add_options_link');
	
	/*Settings variable register function*/
	function nhndt_register_settings() {
		register_setting('nhndt_settings_group', 'nhndt_settings');
	}
	add_action('admin_init', 'nhndt_register_settings');
	
?>