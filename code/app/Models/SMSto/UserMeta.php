<?php

namespace App\Models\SMSto;

class UserMeta extends BaseModel
{
    protected $table = 'user_metas';
    
    protected $fillable = [
        'user_id',
        'key',
        'value',
    ];

    /**
     * Belongs to User
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfKey($query, $key)
    {
        return $query->where('key', $key);
    }

}
