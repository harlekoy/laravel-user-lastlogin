<?php

namespace Harlekoy\LastLogin\Traits;

use Harlekoy\LastLogin\Models\Login;
use Illuminate\Support\Str;

trait HasLogins
{
    /**
     * Boot `HasLogin` trait.
     *
     * @return void
     */
    protected static function bootHasLogins()
    {
        static::addGlobalScope(function ($query) {
            $query->withLastLogin();
        });
    }

    /**
     * Get user logins.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    /**
     * Get the user last login.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastLogin()
    {
        return $this->belongsTo(Login::class);
    }

    /**
     * Scope a query to include user last login.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithLastLogin($query)
    {
        $table = config('lastlogin.user_table_name');
        $id = Str::singular($table).'_id';

        $query->addSelect(['last_login_id' => Login::select('id')
            ->whereColumn($id, $table.'.id')
            ->latest()
        ])->with('lastLogin');
    }
}
