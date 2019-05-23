<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2019/5/22
 * Time: 下午12:23
 */

namespace thl\common;


use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use thl\enum\ThlResultEnum;
use thl\exception\ThlResultException;

class YmlTool
{
    /**
     * @param $key
     * @param $ymlName
     * @return string
     * @throws ThlResultException
     */
    public static function getParameters($key,$ymlName = ''){
        $documentRoot = $_SERVER['DOCUMENT_ROOT']."/thl/";
        require_once $documentRoot . 'app/bootstrap.php';

        $params = null;
        try {
            if (empty($ymlName)){
                $ymlName = 'thlConfig.yml';
            }
            $params = Yaml::parse($documentRoot. 'config/'.$ymlName);

            if (!is_array($params)){
                throw new ThlResultException(
                    ThlResultEnum::PARAM_PARSE_ERROR_CODE,
                    ThlResultEnum::PARAM_PARSE_ERROR_MSG
                );
            }

        } catch (ParseException $exception) {
            throw new ThlResultException(
                ThlResultEnum::PARAM_PARSE_ERROR_CODE,
                ThlResultEnum::PARAM_PARSE_ERROR_MSG
            );
        }
        if (!array_key_exists("parameters",$params)){
            throw new ThlResultException(
                ThlResultEnum::PARAM_CONFIG_FORMAT_ERROR_CODE,
                ThlResultEnum::PARAM_CONFIG_FORMAT_ERROR_MSG
            );
        }

        $values =$params['parameters'];
        if (empty($values) || !array_key_exists($key,$values)){
            return "";
        }

        return $values[$key];
    }
}