<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    //
	protected $table = 'borrowers';

	protected $fillable = [
		'user_id','book_id','customer_id','issue_at','return_at','status'
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
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer')->withTrashed();
    }

}
