<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $guarded = [];
    protected $dates = [
        'seen_at',
    ];
    public function members()
    {
        return $this->belongsToMany('App\Member')->withPivot(['id', 'quantity', 'amount','status','withdraw_date','withdraw_month','withdraw_order','monthly_withdraw_date','withdraw'])->withTimestamps();
    }
}
