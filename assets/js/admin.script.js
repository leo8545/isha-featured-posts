(function ($) { 
	$(document).ready(function () {
		$('.isha_fp_is_featured').on('click', e => {
			e.preventDefault();
			let anchor = e.target.parentNode;
			let postId = parseInt(anchor.getAttribute('data-post_id'));
			let isFeatured = anchor.getAttribute('data-is_featured') === 'yes';
			if (isFeatured) {
				// Unfeature it
				anchor.querySelector('i').classList.remove('fas');
				anchor.querySelector('i').classList.add('far');
				anchor.setAttribute('data-is_featured', 'no');
				e.target.title = 'No';
			} else {
				// Feature it
				anchor.querySelector('i').classList.remove('far');
				anchor.querySelector('i').classList.add('fas');
				anchor.setAttribute('data-is_featured', 'yes');
				e.target.title = 'Yes';
			}
			$.ajax({
				type : "post",
				data: {
					action: 'isha_fp_action',
					postId,
					isFeatured: anchor.getAttribute('data-is_featured') === 'yes'
				},
				url: ajax_object.ajax_url
			}).success(response => {
				console.log(response);
			})
		})
	})
})(jQuery);