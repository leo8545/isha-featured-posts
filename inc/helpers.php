<?php

function isha_fp_get_template($file, $atts = [])
{
	
	switch($file) {
		case 'grid':
			$atts;
			require $dir . 'isha-layout-grid.php';
		break;
		default:
			require $dir . $file;
	}
}