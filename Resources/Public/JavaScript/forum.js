jQuery(document).ready(function() {
	forum.newPost();
	forum.newComment();

	jQuery('.down').css('display', 'none');
	jQuery('.up').css('display', 'block');
	jQuery('#collapse0').removeClass('collapse');
	jQuery('#collapse0').css('height', 'auto');
	jQuery('#collapse0').addClass('collapse in');
	jQuery('.accordion-toggle').addClass('collapsed');
	jQuery('.accordion-toggle').each(function() {
		if (jQuery(this).attr('href') === '#collapse0') {
			jQuery(this).removeClass('collapsed');
			jQuery(this).find('.down').css('display', 'block');
			jQuery(this).find('.up').css('display', 'none');
		}
	});
	jQuery('.accordion-toggle').click(function() {
		if (jQuery(this).hasClass('collapsed')) {
			jQuery(this).find('.up').css('display', 'none');
			jQuery(this).find('.down').css('display', 'block');

		} else {
			jQuery(this).find('.down').css('display', 'none');
			jQuery(this).find('.up').css('display', 'block');
		}
	});
});

//* validation
forum = {
	newPost: function() {
		newPostValidator = jQuery('#createPost').validate({
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			highlight: function(element) {
				jQuery(element).closest('div').parent('div').addClass("has-error");
			},
			unhighlight: function(element) {
				jQuery(element).closest('div').parent('div').removeClass("has-error");
			},
			errorPlacement: function(error, element) {
				jQuery(element).closest('div').after(error);
			},
			rules: {
				'--lelesys_plugin_forum-forum[newPost][title]': {
					required: true
				},
				'--lelesys_plugin_forum-forum[newPost][description]': {
					required: true
				},
				'--lelesys_plugin_forum-forum[captcha]': {
					required: true
				}
			},
			messages: {
				'--lelesys_plugin_forum-forum[newPost][title]': {
					required: 'Please fill title.'
				},
				'--lelesys_plugin_forum-forum[newPost][description]': {
					required: 'Please write description.'
				},
				'--lelesys_plugin_forum-forum[captcha]': {
					required: 'Please fill captcha.'
				}
			}
		});
	},
	newComment: function() {
		newCommentValidator = jQuery('#newComment').validate({
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			highlight: function(element) {
				jQuery(element).closest('div').parent('div').addClass("has-error");
			},
			unhighlight: function(element) {
				jQuery(element).closest('div').parent('div').removeClass("has-error");
			},
			errorPlacement: function(error, element) {
				jQuery(element).closest('div').after(error);
			},
			rules: {
				'--lelesys_plugin_forum-post[newComment][description]': {
					required: true
				},
				'--lelesys_plugin_forum-post[captcha]': {
					required: true
				}
			},
			messages: {
				'--lelesys_plugin_forum-post[newComment][description]': {
					required: 'Please write comment.'
				},
				'--lelesys_plugin_forum-post[captcha]': {
					required: 'Please fill captcha.'
				}
			}
		});
	}
};