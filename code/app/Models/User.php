<?php

namespace App\Models;

use App\Traits\MapStd;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, MapStd, HasRoles;

    /**
     * Default connection of the model
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $connection = 'auth_mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        '_id',
        'username',
        'password',
        'first_name',
        'last_name',
        'email',
        'confirm_code',
        'confirmed_at',
        'created_by',
        'updated_by',
        'cash_balance',
        'timezone',
        'disable_transcode',
        'is_approved_by_admin',
        'phone',
        'avatar',
        'is_banned',
        'date_banned',
        'banned_reason',
        'approved_at',
        'disapproved_at',
        'is_verified',
        'twofa_verified',
        'twofa_verified_at',
        'country',
        'currency',
        'ip_address',
        'queue',
        'settings',
        'viber_settings',
        'user_smsto'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Has one Models\SMSto\User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_smsto()
    {
        return $this->hasOne(SMSto\User::class, '_id', 'id');
    }
}
