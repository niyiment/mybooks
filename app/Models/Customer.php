<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use SoftDeletes;

    protected $table = 'customers';
    
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'user_id', 'name','phone'
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
    public function book()
    {
        return $this->belongsTo('App\Models\Book')->withTrashed();
    }

     /**
     * @return mixed
     */
    public function borrowers()
    {
        return $this->hasMany('App\Models\Borrower')->withTrashed();
    }
    
    public static function getSelectbox(){
        return Customer::orderBy('name')->get()->pluck('name','id');
    }
}
