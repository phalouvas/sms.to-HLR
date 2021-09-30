<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class ApiCredential extends BaseModel
{
    use Authenticatable, Authorizable;

    protected $connection ='auth_mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $table = 'api_credentials';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
