(function( $ ) {
	'use strict';

	$(function() {

		checkForUpdate('auto');

    $('#check-version').on('click', function(event) {
      $('#update-box').remove();
      $('#check-version').find('.fas').addClass('fa-spin');
      checkForUpdate('check');
    });

	});

	function checkForUpdate(type)
	{
    $.ajax({
      type : 'GET',
      url : 'index.php?option=com_minitekwall&task=checkForUpdate&type='+type,
      success: function(response) {
        $('.minitek-dashboard').prepend(response);
        $('#check-version').find('.fas').removeClass('fa-spin');
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
	}

})( jQuery );
