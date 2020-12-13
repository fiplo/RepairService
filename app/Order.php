<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];
    protected $table = 'orders';
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
