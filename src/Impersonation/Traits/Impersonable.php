<?php

namespace LaraComponents\Impersonation\Traits;

use Illuminate\Support\Facades\Session;

trait Impersonable
{
    /**
     * Start impersonating this user
     *
     * @return $this
     */
    public function impersonate()
    {
        Session::put($this->getImpersonatingKey(), $this->getKey());

        return $this;
    }

    /**
     * Stop impersonating
     *
     * @return $this
     */
    public function unimpersonate()
    {
        Session::forget($this->getImpersonatingKey());

        return $this;
    }

    /**
     * Check if user is impersonating
     *
     * @return boolean
     */
    public function isImpersonating()
    {
        return Session::has($this->getImpersonatingKey());
    }

    /**
     * Get impersonating user id
     *
     * @return int
     */
    public function getImpersonatingId()
    {
        return Session::get($this->getImpersonatingKey());
    }

    /**
     * Get impersonating key
     *
     * @return string
     */
    public function getImpersonatingKey()
    {
        return 'impersonate_id';
    }
}
