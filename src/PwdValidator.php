<?php
namespace Yjtec\Lpwd;

use DB;
use Illuminate\Validation\Validator;

class PwdValidator extends Validator
{
    public function __construct($translator, $data, $rules, $messages)
    {
        parent::__construct($translator, $data, $rules, $messages);
    }

    public function validatePwd($attribute, $value, $parameters, $validator)
    {
        list($table, $user) = $parameters;
        $compireField       = isset($parameters[2]) && $parameters[2] ? $parameters[2] : 'password';
        $re                 = DB::table($table)
            ->select(DB::raw("md5(concat('$value',salt)) as $attribute ,$compireField"))
            ->where($user, $this->getValue($user))
            ->first();
        if (!$re) {
            return false;
        }

        $re = collect($re);

        $attributeValue = $re->get($attribute);
        $compireValue   = $re->get($compireField);
        return $attributeValue === $compireValue;
    }
}
