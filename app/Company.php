<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot(['member_id', 'company_id', 'role_id']);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
