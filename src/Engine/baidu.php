<?php

namespace PhalApi\Xtranslate\Engine;

class Baidu
{
	protected $config;

	public function __construct($config = NULL) {
		if (is_null($config)) {
			$config = \PhalApi\DI()->config->get('app.Xtranslate.baidu');
		} else {
			$this->config = $config;
		}
	}

    public function baiduTranslate($query, $to = 'zh', $from = 'auto'){
        $query = utf8_encode($query);
        if($query) {
            $appid = $this->config['app_id'];
            $salt = rand(10000, 99999);
            $sign = $this->buildSign($query, $appid, $salt, $this->config['app_key']);
            $params = 'q='.urlencode($query).'&from='.$from.'&to='.$to.'&appid='.$appid.'&salt='.$salt.'&sign='.$sign;
            $url = 'http://api.fanyi.baidu.com/api/trans/vip/translate?'.$params;
            \PhalApi\DI()->logger->log('TRACE', 'Xtranslate\baidu', array('urlParams' => $data));
            $curl = new \PhalApi\CUrl(1);
            $rs = $curl->get($url, 3000);
            \PhalApi\DI()->logger->log('TRACE', 'Xtranslate\baidu', array('rs' => $rs));
            return json_decode($rs, true);
        }
        return null;
    }

    protected function buildSign($query, $appID, $salt, $secKey) {
        $str = $appID . $query . $salt . $secKey;
        $ret = md5($str);
        return $ret;
    }
}