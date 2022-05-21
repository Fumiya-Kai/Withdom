$(function(){
  $('.category-form').on('click', function(){
    $('.category-input').focus();
  })

  $('.category-input').on('focusin', function(){
    $('.category-list').show();
  });

  // $('.category-input').on('click', function(e){
  //   e.stopPropagation();
  // });

  // $('.category-input').on('focusout', function(){
  //   $('.category-item').on('click', function(){
  //     $('.category-input').focus();
  //     $(this).children('.category-checkbox').prop('checked', true).change();
  //     return;
  //   })
  //   $('.category-list').hide();
  // });

  $(document).on('click',function(e) {
    if(!$(e.target).closest('.category-list').length && !$(e.target).closest('.category-input').length && !$(e.target).closest('.category-form').length) {
      $('.category-list').hide();
    } else if($(e.target).closest('.category-list').length) {
      let statusOfCheckbox = $(e.target).children('.category-checkbox').prop('checked');
      $('.category-input').focus();
      $(e.target).children('.category-checkbox').prop('checked', !statusOfCheckbox).change();
    } else {
      $('.category-input').focus();
    }
  });

  $('.category-checkbox').change(function(){
    if($(this).prop('checked')) {
      let categoryName = $(this).val();
      let categoryId = $(this).data('id');
      let categoryBadge = createBadge(categoryName, categoryId);
      $('.category-input').before(categoryBadge);
    } else {
      let categoryId = `#${$(this).data('id')}`;
      $(categoryId).remove();
    }
  })

  $('.category-input').on('keypress', function(e){
    if(e.key === 'Enter'){
      let categoryName = $('.category-input').val();
      let categoryBadge = createBadge(categoryName);
      $(this).before(categoryBadge);
      $('.category-input').val('');
      return false;
    };
  })

  $('.category-input').on('keydown', function(e){
    if(e.key === 'Backspace' && $(this).get(0).selectionStart === 0){
      $('.added-category-badge').last().remove();
    };
  })

  function createBadge(categoryName, categoryId = null) {
    return `<div class="added-category-badge badge rounded-pill bg-secondary bg-opacity-25 me-1 text-dark" id="${categoryId}">${categoryName}</div>`;
  }
})