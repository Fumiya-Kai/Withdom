$(function(){
  let memberCount = 1;

  $('.btn-add-form').on('click', function () {
    let formMember =
    `
    <input type="email" id="email${memberCount}" name="emails[]" class="form-first-member form-control mt-2" placeholder="招待するユーザーのメールアドレスを入力">
    `
    $('.invalid-feedback').before(formMember);
    memberCount++;
  });
})