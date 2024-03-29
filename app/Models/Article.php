<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    const ARTICLES_PER_PAGE = 20;

    protected $fillable = [
        'title',
        'abstract',
        'content',
        'user_id',
        'team_id',
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)
                    ->latest()
                    ->paginate(self::ARTICLES_PER_PAGE, ['id', 'title', 'abstract']);
    }

    public function getByTeamId($id)
    {
        return $this->where('team_id', $id)
                    ->latest()
                    ->paginate(self::ARTICLES_PER_PAGE, ['id', 'title', 'abstract']);
    }

    public function saveNewArticle($newArticleInput, $newCategoryIds = null, $teamId)
    {
        $newArticleInput['user_id'] = Auth::id();
        $newArticleInput['team_id'] = $teamId;

        if(!array_key_exists('categories', $newArticleInput)) {
            $newArticleInput['categories'] = $newCategoryIds;
        } elseif($newCategoryIds) {
            $newArticleInput['categories'] = array_merge($newArticleInput['categories'], $newCategoryIds);
        }

        $categories = $newArticleInput['categories'];
        unset($newArticleInput['categories']);

        DB::transaction(function () use ($newArticleInput, $categories) {
            $this->create($newArticleInput)
                 ->categories()
                 ->sync($categories);
        });
    }

    public function updateArticle($articleId, $articleInput, $newCategoryIds = null)
    {
        if(!array_key_exists('categories', $articleInput)) {
            $articleInput['categories'] = $newCategoryIds;
        } elseif($newCategoryIds) {
            $articleInput['categories'] = array_merge($articleInput['categories'], $newCategoryIds);
        }

        $categories = $articleInput['categories'];
        unset($articleInput['categories']);

        DB::transaction(function () use ($articleId, $articleInput, $categories) {
            $article = $this->find($articleId);
            $article->fill($articleInput)->save();
            $article->categories()->sync($categories);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
