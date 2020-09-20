(function($) {
	$(function(){

		checkGridRadio();

		function checkGridRadio()
		{
			$('.grid-radio-input:checked').parents('.grid-radio').addClass('active');

			$('.grid-radio-input').change(function() {
				$(this).parents('.controls').find('.grid-radio').removeClass('active');
				var checked = $(this).attr('checked', true);
				if(checked){
					$(this).parents('.grid-radio').addClass('active');
				}
			});
		}

	})
})(jQuery);
