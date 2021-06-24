<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'slug', 'parent_id', 'fa_icon_class'
    ];

    protected $hidden = [

    ];

    protected $with = [
        'parent'
    ];

    public function parent(){
        return $this->belongsTo('App\Category','parent_id');
    }

}
