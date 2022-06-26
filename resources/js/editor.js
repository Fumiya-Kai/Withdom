const { marked } = require('marked');
const highlight = require('highlight.js');
const sanitizeHtml = require('sanitize-html');

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

  // マークダウンのカスタマイズ
  var renderer = new marked.Renderer();
  renderer.em = function(text) {
    var indexNumber = text.indexOf('/');
    if (indexNumber !== -1 && text.substr(indexNumber - 1, 1) !== "\\") {
      console.log('1');
      return '<span style="color:' + text.substr(0, indexNumber) + ';">' + text.substr(indexNumber + 1) + '</span>';
    }
    return '<em>' + text.replace('\\/', '/') + '</em>';
  };
  marked.use({ renderer });

  // テキストエリア入力時の機能
  $('.article-content').on('input', function(){

    // テキストエリアの高さが自動で変わる機能
    $(this).innerHeight(oldHeight);
    let height = $(this).get(0).scrollHeight;
    $(this).innerHeight(height);

    // マークダウンのコンパイル機能
    let compiledMarkdown = marked($(this).val());
    let html =sanitizeHtml(compiledMarkdown, {
                allowedAttributes: {
                  'span': [ 'style' ]
                }
              });
    $('.preview').html(html);

    // mathjaxの適用
    let div=$('.preview').html();
    MathJax.Hub.Configured();
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, div]);
  });
})