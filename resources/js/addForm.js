$(function(){
  let memberCount = $('.email-form').length;

  $('.btn-add-form').on('click', function () {
    let formMember =
    `
    <input type="email" id="email${memberCount}" name="emails[]" class="form-first-member form-control mt-2" placeholder="招待するユーザーのメールアドレスを入力">
    `
    $('.message-email').before(formMember);
    memberCount++;
  });
})