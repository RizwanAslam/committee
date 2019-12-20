<?php

namespace App;

use App\Notifications\MemberInvitationNotification;
use App\Observers\CommonObserver;
use App\Scopes\CompanyScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Member extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'first_name', 'last_name', 'email', 'cnic', 'address', 'password'];
    protected $dates = [
        'seen_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        if (auth()->check()) {
            static::addGlobalScope(new CompanyScope());
        }
        static::observe(CommonObserver::class);

    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function committees()
    {
        return $this->belongsToMany('App\Committee')->withPivot(['id', 'quantity', 'amount', 'status', 'withdraw_date', 'withdraw_month', 'withdraw_order', 'monthly_withdraw_date', 'withdraw'])->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberInvitationNotification($token));
    }
}
