<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function saveNewAndGetIds($newCategoryInput)
    {
        $newCategories = [];
        DB::transaction(function() use ($newCategoryInput, $newCategories) {
            foreach($newCategoryInput as $newCategory) {
                $newId = $this->create(['name' => $newCategory])->id;
                array_push($newCategories, $newId);
            };
        });

        return $newCategories;
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
