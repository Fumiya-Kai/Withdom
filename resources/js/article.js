const { marked } = require('marked');
const highlight = require('highlight.js');

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
  $('.article-content').text('');
  $('.article-content').html(compiledMarkdown);
  let div = $('.article-content').html();
  MathJax.Hub.Configured();
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, div]);
})