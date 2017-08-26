<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    //
    use SoftDeletes;

    protected $table = 'authors';
    
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'user_id', 'name'
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    /**
     * @return mixed
     */
    public function books()
    {
        return $this->hasMany('App\Models\Book')->withTrashed();
    }

    public static function getSelectbox(){
        return Author::orderBy('name')->get()->pluck('name','id');
    }

}
