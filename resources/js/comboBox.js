$(function(){
  // カテゴリーフォーム部分をクリックするとフォーカスが当たる
  $('.category-form').on('click', function(){
    $('.category-input').focus();
  })

  // フォーカスが当たるとリスト表示
  $('.category-input').on('focusin', function(){
    $('.category-list').show();
  });

  // リストクリック時の挙動
  $(document).on('click',function(e) {
    if(!$(e.target).closest('.category-list').length && !$(e.target).closest('.category-input').length && !$(e.target).closest('.category-form').length) {
      if($('.category-input').val()) {
        let categoryName = $('.category-input').val();
        insertCategoryElem(categoryName);
        $('.category-input').val('');
      }
      $('.category-list').hide();
    } else if($(e.target).closest('.category-list').length) {
      let statusOfCheckbox = $(e.target).children('.category-checkbox').prop('checked');
      $('.category-input').focus();
      $(e.target).children('.category-checkbox').prop('checked', !statusOfCheckbox).change();
    } else {
      $('.category-input').focus();
    }
  });

  // チェックボックスチェック操作の挙動
  $('.category-checkbox').change(function(){
    let categoryName = $(this).data('name');
    if($(this).prop('checked')) {
      let categoryBadge = createBadge(categoryName);
      $('.category-input').before(categoryBadge);
    } else {
      let elementId = `#category-badge-${categoryName}`;
      $(elementId).remove();
    }
  })

  // カテゴリーの配列を作成
  let categoryItems = [];
  $('.category-name').each(function(i, val) {
    categoryItems.push($(val).text());
  })

  // 入力後のEnter時の挙動
  $('.category-input').on('keypress', function(e){
    if(e.key === 'Enter'){
      let categoryName = $('.category-input').val();
      if($(`#category-badge-${categoryName}`).length) {
        $('.category-input').val('');
        return false;
      }
      insertCategoryElem(categoryName);
      $('.category-input').val('');
      return false;
    };
  })

  // backspaceによるタグ削除
  $('.category-input').on('keydown', function(e){
    if(e.key === 'Backspace' && $(this).get(0).selectionStart === 0){
      let categoryName = $('.added-category-badge').last().text()
      let hiddenId = `#hiddeninput${categoryName}`;
      $(hiddenId).remove();
      $('.added-category-badge').last().remove();
      if(categoryItems.includes(categoryName)) {
        categoryCheckbox = $(`#category-name-${categoryName}`).prev();
        categoryCheckbox.prop('checked', false);
      }
    };
  })

  // タグ作成の関数
  function createBadge(categoryName) {
    return `<div class="added-category-badge badge rounded-pill bg-secondary bg-opacity-25 me-1 text-dark" id="category-badge-${categoryName}">${categoryName}</div>`;
  }

  function createHiddenInput(categoryName) {
    return `<input name="new-categories[]" type="hidden" value="${categoryName}" id="hiddeninput${categoryName}">`;
  }

  function insertCategoryElem(categoryName) {
    let categoryBadge = createBadge(categoryName);
    $('.category-input').before(categoryBadge);
    if(categoryItems.includes(categoryName)) {
      categoryCheckbox = $(`#category-name-${categoryName}`).prev();
      categoryCheckbox.prop('checked', true);
    } else {
      let newCategory = createHiddenInput(categoryName);
      $('.category-input').after(newCategory);
    }
  }
})