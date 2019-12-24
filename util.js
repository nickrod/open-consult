// ajax request

function ajax(reqListener, params, method = 'GET', file = 'ajax.php')
{
  var oReq = new XMLHttpRequest();
  oReq.addEventListener('load', reqListener);
  oReq.open(method, file + '?' + params);
  oReq.send();
}

// load function on start

function onStart(func)
{
  document.addEventListener('DOMContentLoaded', func);
}

