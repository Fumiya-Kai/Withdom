const { marked } = require('marked')
const highlight = require('highlight.js')

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

  // デフォルトのテキストエリアの高さ
  let oldHeight = $('.article-content').innerHeight();

  // シンタックスハイライトの設定
  marked.setOptions({
    highlight: code => {
      return highlight.highlightAuto(code).value
    }
  })

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

  // テキストエリア入力時の機能
  $('.article-content').on('input', function(){

    // テキストエリアの高さが自動で変わる機能
    $(this).innerHeight(oldHeight);
    let height = $(this).get(0).scrollHeight;
    $(this).innerHeight(height);

    // マークダウンのコンパイル機能
    let compiledMarkdown = marked($(this).val());
    $('.preview').html(compiledMarkdown);

    // mathjaxの適用
    let div=$('.preview').html();
    MathJax.Hub.Configured();
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, div]);
  });
})