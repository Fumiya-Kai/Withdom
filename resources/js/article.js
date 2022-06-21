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

  let markdownData = $('.article').text();
  let compiledMarkdown = marked(markdownData);
  $('.article').text('');
  $('.article').html(compiledMarkdown);
  let div = $('.article').html();
  MathJax.Hub.Configured();
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, div]);
})