<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function company()
    {
        return $this->belongsToMany(Company::class);
    }
}

