<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2019/4/19
 * Time: 下午4:55
 */

namespace thl;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use thl\common\YmlTool;

class ThlBase
{
    public function __construct()
    {
        require_once  dirname(__DIR__) . '/app/bootstrap.php';
        try {
            $parameters = Yaml::parse(dirname(__DIR__).'/config/thlConfig.yml');
            dump($parameters);exit();
        } catch (ParseException $exception) {
            throw new ThlResultException(ResultEnum::PARAM_PARSE_ERROR_CODE,ResultEnum::PARAM_PARSE_ERROR_MSG);
        }
    }
}