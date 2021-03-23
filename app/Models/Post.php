<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug'
    ];

    public function user() //foreign key user_id
    {
        return $this->belongsTo(User::class);
    }

   

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


}
