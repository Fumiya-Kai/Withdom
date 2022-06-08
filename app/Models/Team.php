<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory;

    const TEAMS_PER_PAGE = 10;

    protected $fillable = [
        'name',
        'description',
        'document',
    ];

    public $timestamps = false;

    public function getMembers($id)
    {
        return $this->find($id)->users;
    }

    public function createTeam($teamInput, $userId)
    {
        DB::transaction(function () use ($teamInput, $userId) {
            $this->create($teamInput)
                 ->users()
                 ->sync($userId);
        });
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
