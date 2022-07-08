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
})