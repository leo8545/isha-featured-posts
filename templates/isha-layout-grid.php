<?php

/**
 * Template for grid layout for shortcode isha_featured_posts
 * @since 1.0.0
 */

if(!defined('ABSPATH')) exit();

$query = new WP_Query([
	'post_type' => 'post',
	'meta_key' => 'isha_fp_isFeatured',
	'meta_value' => 'yes',
	'posts_per_page' => !empty($atts['count']) ? (int) $atts['count'] : -1
]);
$show_read_more = 'yes';
$show_meta = 'yes';
if(@$atts) {
	if(@$atts['show_read_more'] && in_array($atts['show_read_more'], ['yes', 'no'])) {
		$show_read_more = $atts['show_read_more'];
	}
	if(@$atts['show_meta'] && in_array($atts['show_meta'], ['yes', 'no'])) {
		$show_meta = $atts['show_meta'];
	}
}

?>
<ul class="isha-fp-posts-grid-container">
	<?php
		if($query->have_posts()) : 
			while($query->have_posts()) : $query->the_post();
				?>
					<li class="isha-fp-single-post-card">
						<?php if(get_the_post_thumbnail_url()) : ?>
							<header class="isha-fp-single-post-header">
								<div class="post-thumbnail">
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
									</a>
								</div>
							</header>
						<?php endif; ?>
						<div class="post-body">
							<?php if($show_meta === 'yes') : ?>
								<div class="post-meta">
									<div class="post-date"><?php echo get_the_date() ?></div>
								</div>
							<?php endif; ?>
							<div class="post-title">
								<a href="<?php echo get_the_permalink() ?>">
									<?php echo get_the_title() ?>
								</a>
							</div>
							<div class="post-excerpt">
								<p><?php 
									echo substr(get_the_excerpt(), 0, 100); 
									if(strlen(get_the_excerpt()) > 100) echo '...';
									if($show_read_more === 'yes') {
										echo sprintf(' <a href="%s" class="read-more">%s</a>', get_the_permalink(), apply_filters('isha_fp_read_more_text', 'Read more'));
									}
								?></p>
							</div>
						</div>
					</li>
				<?php
			endwhile;
		endif;
		wp_reset_postdata();
	?>
</ul>