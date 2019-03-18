<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function planets()
    {
        $planet = $this->hasMany(Devoutee::class);
        return $planet;
    }

    public function matches()
    {
        $match = $this->hasMany(UsersRelation::class);
        return $match;
    }
}
