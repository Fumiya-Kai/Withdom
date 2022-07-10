$(function(){
  let memberCount = $('.email-form').length;

  $('.btn-add-form').on('click', function () {
    let formMember =
    `
    <input type="email" id="email${memberCount}" name="emails[]" class="email-form form-control mt-2" placeholder="招待するユーザーのメールアドレスを入力">
    `
    $('.message-email').before(formMember);
    memberCount++;
  });

  $('.submit').on('click', function () {
    $('.email-form').each(function (index, elem) {
      if($(elem).val() === '') {
        $(elem).remove();
      }
    })
  })
})