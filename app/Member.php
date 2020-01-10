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
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot(['member_id', 'company_id', 'role_id']);
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

    public function isAdmin()
    {
        if (auth()->user()->companies()->where('company_id', \Session::get('company_id'))->where('member_id', auth()->user()->id)->where('role_id', 1))
            return true;
    }

    public function isMember()
    {
        $checkMember = auth()->user()->companies()->where('company_id', \auth()->user()->company_id)->first();
        if ($checkMember->pivot->role_id == 2) {
            return true;
        }
    }

    public function is_permission()
    {
        $member_companies = $this->companies->pluck('id')->toArray();
        $login_user_companies = auth()->user()->companies()->where('role_id', 1)->get()->pluck('id')->toArray();
        return (count(array_intersect($member_companies, $login_user_companies)) > 0) ? true : false;
    }


}
