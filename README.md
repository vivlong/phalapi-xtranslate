# PHPMailer
PhalApi 2.x扩展类库，第三方翻译接口扩展。

## 安装和配置
修改项目下的composer.json文件，并添加：  
```
    "vivlong/phalapi-xtranslate":"dev-master"
```
然后执行```composer update```，如果PHP版本过低，可使用```composer update --ignore-platform-reqs```。  

安装成功后，添加以下配置到./config/app.php文件：  
```php
    
```

## 注册
在./config/di.php文件中，注册邮件服务：  
```php
$di->mailer = function() {
    return new \PhalApi\PHPMailer\Lite(true);
};
```

## 使用
如下代码示例：
```php
\PhalApi\DI()->$mailer->send('chanzonghuang@gmail.com', 'Test PHPMailer Lite', 'something here ...');
```

如果需要发送邮件给多个邮箱时，可以使用数组，如：  
```php
$addresses = array('chanzonghuang@gmail.com', 'test@phalapi.com');
\PhalApi\DI()->mailer->send($addresses, 'Test PHPMailer Lite', 'something here ...');
```

## 调试日志
在注册初始化时，传入true可开启调试日志，并可以看到类如：  
```
2017-09-03 10:10:58|DEBUG|Succeed to send email|{"addresses":["chanzonghuang@gmail.com"],"title":"Test PHPMailer Lite"}
```

