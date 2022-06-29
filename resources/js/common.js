const bootstrap = require('bootstrap');

$(function(){
  var dropdownElementList = [].slice.call($('.dropdown-toggle'))
  var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
    return new bootstrap.Dropdown(dropdownToggleEl)
  })
})