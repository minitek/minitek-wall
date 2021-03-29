(function (document, Joomla) {
	'use strict';

  function checkForUpdate(type)
	{
    Joomla.request({
      url: 'index.php?option=com_minitekwall&task=checkForUpdate&type='+type,
      method: 'GET',
      onSuccess: (response, xhr) => {
        var dashboard = document.querySelector('.minitek-dashboard');

        if (response && dashboard)
        {
          var htmlObject = document.createElement('div');
          htmlObject.id = 'update-box-div';
          htmlObject.innerHTML = response;
          dashboard.insertBefore(htmlObject, dashboard.firstChild);

          var check_version = document.querySelector('#check-version');
          check_version.querySelectorAll('.fas').forEach(function(a)
          {
            a.classList.remove('fa-spin');
          });
        }
      },
      onError: (xhr) => {
        console.log(xhr);
      }
    });
	}

  document.addEventListener('DOMContentLoaded', function () 
	{
    checkForUpdate('auto');
    var check_version = document.querySelector('#check-version');

    if (check_version)
    {
      check_version.addEventListener('click', function (e) 
      {
        e.preventDefault();

        var update_box = document.querySelector('#update-box-div');

        if (update_box)
          update_box.remove();
        
        check_version.querySelectorAll('.fas').forEach(function(a)
        {
          a.classList.add('fa-spin');
        });
        
        checkForUpdate('check');
      });
    }
  });

})(document, Joomla);
