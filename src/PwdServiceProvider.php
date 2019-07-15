<?php

namespace Yjtec\Lpwd;
use Illuminate\Support\Facades\Validator;
use DB;
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
        
        Validator::resolver(function($translator, $data, $rules, $messages){
            return new PwdValidator($translator, $data, $rules, $messages);
        });
        //Validator::extend('pwd','Yjtec\Lpwd\PwdValidator');
        // Validator::replacer('pwd', function ($message, $attribute, $rule, $parameters) {
        //     return '密码错误';
        //     //return str_replace(...);
        // });
        // Validator::extend('pwd', function ($attribute, $value, $parameters, $validator) {
        //     list($table) = $parameters;
        //     dd($attribute);
        //     dd($validator);
        //     return false;
            //dd($this);
            //select a.account,a.`password`,b.pwd from  ad_users a left join (select md5(concat('e10adc3949ba59abbe56e057f20f883e',salt)) as pwd,id from ad_users ) b  on a.id = b.id where a.`password` = b.pwd and a.account = 'admin'
            //
            /*
            DB::connection()->enableQueryLog();
            $re = DB::table($table)
                ->leftJoin(
                    DB::raw("(select md5(concat('$value',salt)) as pwd,id from ad_users ) b"),
                    DB::raw('`b`.`id`'),
                    '=',
                    'users.id'
                )
                ->where(DB::raw('`b`.`pwd`'),'=',DB::raw('password'))
                ->get();
            $queries = DB::getQueryLog(); // 获取查询日志
            print_r($queries);
            dd($re);
            */
            
            // DB::connection()->enableQueryLog();
            // $re = DB::table($table)
            //     ->select('password','salt')
            //     //->select(DB::raw("password where password = md5(concat('$value',salt))"))
            //     ->where('password',"md5(concat('$value',salt))")
            //     ->get();
            // $queries = DB::getQueryLog(); // 获取查询日志

            // print_r($queries); // 即可查看执行的sql，执行的时间，传入的参数等等
            // //dd(DB::getLastSql());
            // dd($re);
        //     return $re > 0;
        // });        
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
