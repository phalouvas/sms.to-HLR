<?php

namespace App\Models\SMSto;

class User extends BaseModel
{
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
     * Has many UserMeta
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany(UserMeta::class);
    }

    /**
     * Get the related shortlinks.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shortLinks()
    {
        return $this->hasMany(Shortlink::class)->where('is_enabled', true);
    }
}
