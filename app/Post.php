<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'category_id', 'photo_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photo()
    {
        return $this->morphOne('App\Photo', 'imageable');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function delete()
    {
        // if the post has a photo, delete it before deleting the post
        if($this->photo)
        {
            $this->photo->delete();
        }
         // delete the post
        return parent::delete();
    }
}
