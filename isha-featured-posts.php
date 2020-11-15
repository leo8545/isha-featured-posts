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
		add_filter('manage_post_posts_columns', [$this, 'set_post_columns']);
		add_filter('manage_post_posts_custom_column', [$this, 'set_post_columns_content'], 10, 2);
	}

	public function define_public_hooks()
	{

	}

	public function set_post_columns($columns)
	{
		$columns['isha_feature_post'] = __('Featured', 'isha_fp');
		return $columns;
	}

	public function set_post_columns_content($column, $post_id)
	{
		switch($column) {
			case 'isha_feature_post':
				?>
					<input type="radio" name="isha_fp[is_featured]" value="yes" id="isha_fp_is_featured_yes">
					<label for="isha_fp_is_featured_yes">Yes</label>
					<input type="radio" name="isha_fp[is_featured]" value="no" id="isha_fp_is_featured_no">
					<label for="isha_fp_is_featured_no">No</label>
					<input type="hidden" name="isha_fp[post_id]" value="<?php echo $post_id ?>">
				<?php
			break;
		}
	}
}

new Isha_Featured_Posts;