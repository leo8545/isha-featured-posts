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
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	public function define_admin_hooks()
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
		add_filter('manage_post_posts_columns', [$this, 'set_post_columns']);
		add_filter('manage_post_posts_custom_column', [$this, 'set_post_columns_content'], 10, 2);
		add_action('wp_ajax_isha_fp_action', [$this, 'ajax_handler']);
	}

	public function define_public_hooks()
	{
		add_shortcode('isha_featured_posts', [$this, 'feature_post_shortcode_cb']);
		add_action('wp_enqueue_scripts',[$this, 'enqueue_public_scripts'] );
	}

	public function enqueue_admin_scripts($hook)
	{
		$uri = ISHA_FP_URI . 'assets/';
		wp_enqueue_style('isha_fp_style', $uri . 'css/admin.style.css', [], ISHA_FP_VERSION);
		if('edit.php' === $hook) {
			wp_enqueue_style( 'font-awesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css' );
		}
		wp_enqueue_script('isha_fp_script', $uri . 'js/admin.script.js', ['jquery'], ISHA_FP_VERSION, true);
		wp_localize_script('isha_fp_script', 'ajax_object', [
			'ajax_url' => admin_url( 'admin-ajax.php' )
		]);
	}

	public function enqueue_public_scripts($hook)
	{
		$uri = ISHA_FP_URI . 'assets/';

		wp_enqueue_style('isha_fp_style', $uri . 'css/public.style.min.css', [], ISHA_FP_VERSION);
	}

	public function load_dependencies()
	{}

	public function set_post_columns($columns)
	{
		$columns['isha_feature_post'] = '<i class="fas fa-star" title="Featured"></i>';
		return $columns;
	}

	public function set_post_columns_content($column, $post_id)
	{
		switch($column) {
			case 'isha_feature_post':
				$isFeatured = get_post_meta($post_id, 'isha_fp_isFeatured', true) ?: 'no';
				?>
				<a 
					href="#"
					id="isha_fp_is_featured-<?php echo $post_id; ?>" 
					class="isha_fp_is_featured" 
					data-post_id="<?php echo $post_id; ?>"
					data-is_featured="<?php echo $isFeatured; ?>"
				>
					<i 
						class="<?php echo $isFeatured === 'yes' ? 'fas' : 'far' ?> fa-star" 
						title="<?php echo ucfirst($isFeatured) ?>"
					></i>
				</a> 
				<?php
			break;
		}
	}

	public function ajax_handler()
	{
		$post_id = (int) $_POST['postId'];
		$isFeatured = $_POST['isFeatured'] === 'true' ? 'yes' : 'no';
		if($post_id) {
			update_post_meta($post_id, 'isha_fp_isFeatured', $isFeatured);
		}
		wp_die();
	}

	public function feature_post_shortcode_cb($atts)
	{
		$atts = shortcode_atts([
			'layout' => 'grid',
			'show_meta' => true,
			'show_read_more' => true
		], $atts);

		$dir = ISHA_FP_DIR . 'templates/';
		
		ob_start();

		if($atts['layout'] === 'grid') {
			require $dir . 'isha-layout-grid.php';
		} else {
			require $dir . 'isha-layout-list.php';
		}

		$output = ob_get_clean();
		return $output;
	}
}

new Isha_Featured_Posts;