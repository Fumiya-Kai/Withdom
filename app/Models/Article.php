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
                    ->paginate(self::ARTICLES_PER_PAGE);
    }

    public function getByTeamId($id)
    {
        return $this->where('team_id', $id)
                    ->latest()
                    ->paginate(self::ARTICLES_PER_PAGE);
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

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams()
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
