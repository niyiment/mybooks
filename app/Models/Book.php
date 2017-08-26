<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    //
    use SoftDeletes;

    protected $table = 'books';
    
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'user_id', 'author_id','title','isbn','edition','status'
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
    public function author()
    {
        return $this->belongsTo('App\Models\Author')->withDefault(['name' => 'Guest Author']);
    }

    /**
     * @return mixed
     */
    public function customers()
    {
        return $this->hasMany('App\Models\Customer')->withTrashed();
    }

    /**
     * @return mixed
     */
    public function borrowers()
    {
        return $this->hasMany('App\Models\Borrower')->withTrashed();
    }

    /*/**
     * @return mixed
     */
    /*public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher')->withDefault(['name' => 'Guest Publisher']);
    }*/

    public static function getSelectbox(){
        return Book::where('status','=','Available')->orderBy('title')->get()->pluck('title','id');
    }
}
