<?php

namespace Yjtec\Lpwd;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class PwdServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('pwd', function ($attribute, $value, $parameters, $validator) {
            list($table, $user) = $parameters;
            $compireField       = isset($parameters[2]) && $parameters[2] ? $parameters[2] : 'password';
            $pwdValidate        = $this->app->makeWith(
                'Yjtec\Lpwd\PwdRule',
                [
                    'table'        => $table,
                    'user'         => $user,
                    'compireField' => $compireField,
                ]
            );

            return $pwdValidate->passes($attribute, $value);

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
