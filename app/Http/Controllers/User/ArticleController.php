<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $article;
    private $comment;
    private $category;

    public function __construct(Article $article, Comment $comment, Category $category)
    {
        $this->article = $article;
        $this->comment = $comment;
        $this->category = $category;
    }

    public function create(Request $request)
    {
        $categories = $this->category->all();
        $teamIdData = $request->session()->get('team_id');
        $teamId = $teamIdData['id'];
        return view('article.create', compact('categories', 'teamId'));
    }

    public function store(ArticleRequest $request)
    {
        $input = $request->validated();
        $teamId = $request->session()->get('team_id');
        if(isset($input['new-categories'])) {
            $newCategoriesInput = $input['new-categories'];
            unset($input['new-categories']);
            $newCategoryIds = $this->category->saveNewAndGetIds($newCategoriesInput);
        } else {
            $newCategoryIds = null;
        }
        $newArticleInput = $input;
        $this->article->saveNewArticle($newArticleInput, $newCategoryIds, $teamId['id']);

        return redirect()->route('team.show', $teamId['id']);
    }

    public function edit($id)
    {
        $article = $this->article->find($id);
        $categories = $this->category->all();
        return view('article.edit', compact('article', 'categories'));
    }

    public function update(ArticleRequest $request, $articleId)
    {
        $input = $request->validated();
        if(isset($input['new-categories'])) {
            $newCategoriesInput = $input['new-categories'];
            unset($input['new-categories']);
            $newCategoryIds = $this->category->saveNewAndGetIds($newCategoriesInput);
        } else {
            $newCategoryIds = null;
        }
        $this->article->updateArticle($articleId, $input, $newCategoryIds);

        return redirect()->route('article.show', $articleId);
    }

    public function show($id)
    {
        $article = $this->article->find($id);
        $comments = $this->comment->getComments($id);
        return view('article.show', compact('article', 'comments'));
    }
}
