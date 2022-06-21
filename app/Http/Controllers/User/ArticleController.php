<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
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
    }

    public function show($id)
    {
        $article = $this->article->find($id);
        return view('article', compact('article'));
    }
}
