<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRelation extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        $user = $this->belongsTo(User::class);
        return $user;
    }
}
