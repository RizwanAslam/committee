<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
