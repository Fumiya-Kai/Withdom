<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'article_id',
    ];

    public function saveNewComment($input)
    {
        $this->fill($input)->save();
        return $this;
    }

    public function getComments($articleId)
    {
        return $this->where('article_id', $articleId)
                    ->with('user')
                    ->get(['content', 'created_at', 'user_id']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
