import { marked } from 'marked';

// タブの切り替わり機能
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

    // テキストエリアの高さが自動で変わる機能
    $('.article-content').innerHeight(oldHeight);
    let height = $(this).get(0).scrollHeight;
    $('.article-content').innerHeight(height);

    // マークダウンのコンパイル機能
    let compiledMarkdown = marked($(this).val());
    $('.preview').html(compiledMarkdown);
  });
})