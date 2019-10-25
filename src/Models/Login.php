<?php

namespace Harlekoy\LastLogin\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip_address'];

    /**
     * Set updated_at as null
     *
     * @var null
     */
    const UPDATED_AT = null;

    /**
     * Get user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('lastlogin.user_model'));
    }
}
