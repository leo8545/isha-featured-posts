<?php

/**
 * Template for list layout for shortcode isha_featured_posts
 * @since 1.0.0
 */

if(!defined('ABSPATH')) exit();

$query = new WP_Query([
	'post_type' => 'post',
	'meta_key' => 'isha_fp_isFeatured',
	'meta_value' => 'yes'
]);
?>
<ul class="isha-fp-posts-list-container">
	<?php
		if($query->have_posts()) : 
			while($query->have_posts()) : $query->the_post();
				?>
					<li class="isha-fp-single-post-card">
						<?php if(get_the_post_thumbnail_url()) : ?>
							<div class="post-thumbnail">
								<a href="<?php get_the_permalink() ?>">
									<img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
								</a>
							</div>
							<div class="post-body">
								<div class="post-title">
									<a href="<?php echo get_the_permalink() ?>">
										<?php echo get_the_title() ?>
									</a>
								</div>
								<?php if($atts['show_meta']) : ?>
									<div class="post-meta">
										<div class="post-date"><?php echo get_the_date() ?></div>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</li>
				<?php
			endwhile;
		endif;
	?>
</ul>