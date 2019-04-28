# PhalApi 2.x 的第三方翻译接口扩展
PhalApi 2.x扩展类库，第三方翻译接口扩展，支持百度翻译、阿里云翻译。

## 安装和配置
修改项目下的composer.json文件，并添加：  
```
    "vivlong/phalapi-xtranslate":"dev-master"
```
然后执行```composer update```。  

## 注册
在./config/di.php文件中，注册翻译服务：  
```php
    $di->xtranslate = function() {
        return new \PhalApi\Xtranslate\Lite();
    };
```

## 使用
如下代码示例：
```php
    $di = \PhalApi\DI();
    $di->xtranslate->set('baidu');
    $rs = $di->xtranslate->baiduTranslate($query, 'zh', 'auto');
    // OR
    $di->xtranslate->set('aliyun');
    $rs = $di->xtranslate->getGeneral($query, 'text', 'auto', 'zh');
    $rs = $di->xtranslate->getECommerce($query, 'text', 'auto', 'zh', $scene);
```
