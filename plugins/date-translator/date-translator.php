<?php
	/*
		Plugin Name: Date Translator 
		Plugin URI: http://www.SuperbCodes.com/
		Description: This plugin will help you to display date in any language.Using the option page user can translate dates to wanted language.
		Tags: date,translator,translate,Nazmul,Hossain,Nihal,SuperbCodes,calender,bangla
		Version: 1.0
		Author: Nazmul Hossain Nihal
		Author URI: http://www.SuperbCodes.com/
		License: GPLv2 or later
		License URI: http://www.gnu.org/licenses/gpl-2.0.html
	*/


	/******************************
	* global variables
	******************************/

	$nhndt_options = get_option('nhndt_settings');

	/******************************
	* includes
	******************************/

	require_once('inc/admin.php'); //Admin Panel

	require_once('inc/display.php'); //Displaying the date

	/*
		To remove the meta tags just delete the line number 26.
	*/

?>