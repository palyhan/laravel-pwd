# 1.yjtec密码操作

## 1.1 laravel验证
```
pubilc function rules(){
    return [
        'pwd' => 'require|pwd:users,account,password'
    ]
}
```

参数说明

## users 对比的表
## account 在request字段中需要对比的值，数据库也用此字段对比
## [password] 需要对比的字段 默认为password 可不填
