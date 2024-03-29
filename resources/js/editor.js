const { marked } = require('marked');
const highlight = require('highlight.js');
const sanitizeHtml = require('sanitize-html');
const bootstrap = require('bootstrap');

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

  //読み込み時のコンパイル(編集時)
  compile($('.article-content'));

  // テキストエリア入力時の機能
  $('.article-content').on('input', function(){
    compile($(this));
  });

  var offcanvasElementList = [].slice.call($('.offcanvas'));
  var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
    return new bootstrap.Offcanvas(offcanvasEl)
  });

  function compile(elem) {
    // マークダウンのコンパイル機能
    let compiledMarkdown = marked(elem.val());
    let html =sanitizeHtml(compiledMarkdown, {
      allowedTags: sanitizeHtml.defaults.allowedTags.concat([ 'font' ]),
      allowedAttributes: false
    });
    $('.preview').html(html);

    // mathjaxの適用
    let div=$('.preview').html();
    MathJax.Hub.Configured();
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, div]);
  }
})