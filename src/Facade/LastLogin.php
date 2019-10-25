<?php

namespace Harlekoy\LastLogin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Harlekoy\LastLogin\SkeletonClass
 */
class LastLogin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'skeleton';
    }
}
