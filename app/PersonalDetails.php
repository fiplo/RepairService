<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDetails extends Model
{
    //
    protected $fillable = [
        'name', 'surname', 'address', 'PhoneNumber'
    ];
    protected $touches = ['User'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
