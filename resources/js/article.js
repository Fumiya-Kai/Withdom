const { marked } = require('marked');
const highlight = require('highlight.js');
const sanitizeHtml = require('sanitize-html');

$(function(){
  // シンタックスハイライトの設定
  marked.setOptions({
    highlight: code => {
      return highlight.highlightAuto(code).value
    }
  });

  // mathjaxの設定
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX", "output/HTML-CSS"],
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
      processEscapes: true
    },
    "HTML-CSS": {
      availableFonts: ["TeX"]
    }
  });

  let markdownData = $('.article-content').text();
  let compiledMarkdown = marked(markdownData);
  let html =sanitizeHtml(compiledMarkdown, {
    allowedTags: sanitizeHtml.defaults.allowedTags.concat([ 'font' ]),
    allowedAttributes: false
  });
  $('.article-content').text('');
  $('.article-content').html(html);
  let div = $('.article-content').html();
  MathJax.Hub.Configured();
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, div]);

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
  });

  $('.comment-btn').on('click', function(){
    let clickedDom = this;
    $.ajax(location.origin + '/article/' + $(clickedDom).data('articleId') + '/comment',
           {
             type: 'post',
             data: {
               content: $('#comment').val()
             }
           })
    .done(function(data){
      $('.submit').css({
        pointerEvents : 'auto',
        opacity : '1'
      });
      $('#comment').removeClass('is-invalid');
      let newComment =
      `
      <div class="w-auto mt-3">
        <img src="https://icongr.am/fontawesome/user.svg?size=30&color=70e6a9" class="w-auto" alt="ユーザーアイコン">
        <span class="h5">${data.user}</span>
        <div class="fs-4 mt-2 pb-3 border-bottom">${data.content}</div>
      </div>
      `
      $('.comment-form').before(newComment);
      $('#comment').val('');
    })
    .fail((error) => {
      $('.submit').css({
        pointerEvents : 'auto',
        opacity : '1'
      });
      $('#comment').addClass('is-invalid');
      $('.invalid-feedback').text(error.responseJSON.message);
    });
  })
})