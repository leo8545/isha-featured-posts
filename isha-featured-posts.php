<?php
/**
 * Plugin Name: Isha Featured Posts
 * Author: Sharjeel Ahmad
 * Description: Adds ability to feature wordpress posts and shows them via shortcodes.
 */

if(!defined('ABSPATH')) exit();

define('ISHA_FP_URI', plugin_dir_url(__FILE__));
define('ISHA_FP_DIR', plugin_dir_path(__FILE__));
define('ISHA_FP_VERSION', '1.0.0');

final class Isha_Featured_Posts
{
	public function __construct()
	{
		$this->define_public_hooks();
		$this->define_admin_hooks();
	}

	public function define_admin_hooks()
	{
		
	}

	public function define_public_hooks()
	{

	}
}

new Isha_Featured_Posts;