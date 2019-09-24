<?php

namespace Yjtec\Lpwd;

use DB;
use Illuminate\Contracts\Validation\Rule;
use Request;

class PwdRule implements Rule
{

    private $db;
    private $compireField;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $user, $compireField = 'password')
    {
        if (strpos($table, '.')) {
            list($con, $tab) = explode('.', $table);
            $this->db        = DB::connection($con)->table($tab);
        } else {
            $this->db = DB::table($table);
        }

        $this->compireField = $compireField;

        $userField = $user;
        $userValue = $user;
        if (strpos($user, '.')) {
            list($userField, $userValue) = explode('.', $user);
        }

        $this->userField = $userField;
        $this->userValue = $userValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $compireField = $this->compireField;
        $re = $this->db
            ->select(DB::raw("md5(concat('$value',salt)) as $attribute ,$compireField"))
            ->where($this->userField, Request::get($this->userValue))
            ->first();

        if (!$re) {
            return false;
        }
        $re = collect($re);

        $attributeValue = $re->get($attribute);
        $compireValue   = $re->get($compireField);
        return $attributeValue === $compireValue;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '账号密码错误';
    }
}
