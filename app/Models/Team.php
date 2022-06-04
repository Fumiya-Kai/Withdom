<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    const TEAMS_PER_PAGE = 10;

    protected $fillable = [
        'name',
        'description',
        'document',
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)
                    ->latest()
                    ->paginate(self::TEAMS_PER_PAGE);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'team_id');
    }
}
