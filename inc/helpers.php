<?php

function isha_get_featured_posts($args = []) {
	$args = [
		'post_type' => 'post',
		'meta_key' => 'isha_fp_isFeatured',
		'meta_value' => 'yes'
	];

	$query = new WP_Query($args);

	return $query->posts;
}