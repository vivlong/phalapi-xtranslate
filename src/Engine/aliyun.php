<?php

namespace PhalApi\Xtranslate\Engine;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class Aliyun
{
    protected $config;

    public function __construct($config = null)
    {
        $di = \PhalApi\DI();
        $this->config = $config;
        if (null == $this->config) {
            $this->config = $di->config->get('app.Xtranslate.aliyun');
        }
        AlibabaCloud::accessKeyClient($config['accessKeyId'], $config['accessKeySecret'])
            ->regionId($config['regionId'])	// 设置客户端区域，使用该客户端且没有单独设置的请求都使用此设置
            ->timeout(6) 					// 超时10秒，使用该客户端且没有单独设置的请求都使用此设置
            ->connectTimeout(10) 			// 连接超时10秒，当单位小于1，则自动转换为毫秒，使用该客户端且没有单独设置的请求都使用此设置
            //->debug(true) 				// 开启调试，CLI下会输出详细信息，使用该客户端且没有单独设置的请求都使用此设置
            ->asDefaultClient();
    }

    public function getGeneral($sourceText, $formatType, $from, $to)
    {
        $di = \PhalApi\DI();
        try {
            $result = AlibabaCloud::alimt()
                ->v20181012()
                ->translateGeneral()						//通用版本
                ->method('POST')            		//设置请求POST
                ->withSourceLanguage($from) 		//原文语言
                ->withSourceText($sourceText)   //原文
                ->withFormatType($formatType) 	//翻译文本的格式，html（ 网页格式。设置此参数将对待翻译文本以及翻译后文本按照html格式进行处理）、text（文本格式。设置此参数将对传入待翻译文本以及翻译后结果不做文本格式处理，统一按纯文本格式处理。
                ->withTargetLanguage($to) 			//目标语言
                ->request();
            if ($result->isSuccess()) {
                return $result->toArray();
            } else {
                return $result;
            }
        } catch (ClientException $e) {
            $di->logger->error(__NAMESPACE__.DIRECTORY_SEPARATOR.__CLASS__.DIRECTORY_SEPARATOR.__FUNCTION__, ['ClientException' => $e->getErrorMessage()]);

            return null;
        } catch (ServerException $e) {
            $di->logger->error(__NAMESPACE__.DIRECTORY_SEPARATOR.__CLASS__.DIRECTORY_SEPARATOR.__FUNCTION__, ['ServerException' => $e->getErrorMessage()]);

            return null;
        }
    }

    public function getECommerce($sourceText, $formatType, $from, $to, $scene)
    {
        $di = \PhalApi\DI();
        try {
            $result = AlibabaCloud::alimt()
                ->v20181012()
                ->translateECommerce() 					//电商版本
                ->method('POST')            		//设置请求POST
                ->withSourceLanguage($from) 		//原文语言
                ->withScene($scene)      				//设置场景，商品标题:title，商品描述:description，商品沟通:communication
                ->withSourceText($sourceText)   //原文
                ->withFormatType($formatType) 	//翻译文本的格式，html（ 网页格式。设置此参数将对待翻译文本以及翻译后文本按照html格式进行处理）、text（文本格式。设置此参数将对传入待翻译文本以及翻译后结果不做文本格式处理，统一按纯文本格式处理。
                ->withTargetLanguage($to) 			//目标语言
                ->request();
            if ($result->isSuccess()) {
                return $result->toArray();
            } else {
                return $result;
            }
        } catch (ClientException $e) {
            $di->logger->error(__NAMESPACE__.DIRECTORY_SEPARATOR.__CLASS__.DIRECTORY_SEPARATOR.__FUNCTION__, ['ClientException' => $e->getErrorMessage()]);

            return null;
        } catch (ServerException $e) {
            $di->logger->error(__NAMESPACE__.DIRECTORY_SEPARATOR.__CLASS__.DIRECTORY_SEPARATOR.__FUNCTION__, ['ServerException' => $e->getErrorMessage()]);

            return null;
        }
    }
}
