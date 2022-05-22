import { marked } from 'marked';

$(function(){
  $('.nav-link').on('click', function(){
    $('.nav-link.active').removeClass('active');
    $(this).addClass('active');
    let tabId = $(this).data('tabId');
    $('.tab-pane.active').removeClass('active');
    $(tabId).addClass('active');
    return false;
  });

  let oldHeight = $('.article-content').innerHeight();

  $('.article-content').on('input', function(){
    $('.article-content').innerHeight(oldHeight);
    let height = $(this).get(0).scrollHeight;
    $('.article-content').innerHeight(height);

    let compiledMarkdown = marked($(this).val());
    $('.preview').html(compiledMarkdown);
  });
})