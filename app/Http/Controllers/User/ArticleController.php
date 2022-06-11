<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $article;
    private $category;

    public function __construct(Article $article, Category $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('article_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $teamId = $request->session()->get('team_id');
        $newCategoriesInput = $request->only('new-categories');
        $newArticleInput = $request->except('new-categories');
        $newCategoryIds = $this->category->saveNewAndGetIds($newCategoriesInput);
        $this->article->saveNewArticle($newArticleInput, $newCategoryIds, $teamId);
    }
}
