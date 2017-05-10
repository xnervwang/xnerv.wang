(function ($, undefined) {
	$(function() {
		"use strict";

		$(document).on('change', 'select[name="hh_x_frame_options_value"]', function () {
			var $el = $('input[name="hh_x_frame_options_domain"]'),
				disabled = $(this).find('option:selected').val() != 'allow-from' || this.disabled;
			if ($el.length) {
				$el.prop('disabled', disabled).toggle(!disabled);
			}
		}).on('change', 'select[name="hh_access_control_allow_origin_value"]', function () {
			var $el = $('input[name="hh_access_control_allow_origin_url"]'),
				disabled = $(this).find('option:selected').val() != 'origin' || this.disabled;
			if ($el.length) {
				$el.prop('disabled', disabled).toggle(!disabled);
			}
		}).on('change', '.http-header', function () {
			var $this = $(this),
				$el = $this.closest('tr').find('.http-header-value');
			
			if (!$el.length) {
				return;
			}
			
			if (Number($this.val()) === 1) {
				$el.prop('disabled', false);
			} else {
				$el.prop('disabled', true);
			}
		}).on('change', 'input[name="hh_x_frame_options"]', function () {
			$('select[name="hh_x_frame_options_value"]').trigger('change');
		}).on('change', 'input[name="hh_access_control_allow_origin"]', function () {
			$('select[name="hh_access_control_allow_origin_value"]').trigger('change');
		});
	});
})(jQuery);