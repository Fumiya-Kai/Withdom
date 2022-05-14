$(function(){
  let memberCount = 1;

  $('.btn-add-form').on('click', function () {
    let formFirstMember =
    `
    <input type="email" id="email" name="emails[${memberCount}]" class="form-first-member form-control mt-2" placeholder="招待するユーザーのメールアドレスを入力">
    `
    $('.first-members').append(formFirstMember);
    memberCount++;
  });
})