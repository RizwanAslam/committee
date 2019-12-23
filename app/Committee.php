<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $guarded = [];
    protected $dates = [
        'seen_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope());

    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot(['id', 'quantity', 'amount', 'status', 'withdraw_date', 'withdraw_month', 'withdraw_order', 'monthly_withdraw_date', 'withdraw'])->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
