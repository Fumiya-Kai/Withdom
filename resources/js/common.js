const bootstrap = require('bootstrap');

$(function(){
  var dropdownElementList = [].slice.call($('.dropdown-toggle'))
  var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
    return new bootstrap.Dropdown(dropdownToggleEl)
  })

  $('.submit').on('click', function(){
    //pointer-eventsをnoneに
    $(this).css('pointer-events', 'none');

    //disabledしてるっぽい色に変更
    $(this).css('opacity', '0.7');
  })
})