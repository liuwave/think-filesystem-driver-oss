<?php

/**
 * Created by PhpStorm.
 * User: liuwave
 * Date: 2020/7/6 17:53
 * Description:
 */
declare(strict_types=1);

namespace liuwave\think\filesystem\driver;

use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;
use Xxtime\Flysystem\Aliyun\OssAdapter;

/**
 * Class Oss
 * @package liuwave\think\filesystem\driver
 */
class Oss extends Driver
{
    
    /**
     * @return \League\Flysystem\AdapterInterface
     * @throws \Exception
     */
    protected function createAdapter() : AdapterInterface
    {
        
        $config=[
          'accessId'     => $this->config['accessId'],
          'accessSecret' => $this->config['accessSecret'],
          'bucket'       => $this->config['bucket'],
          'endpoint'     => $this->config['endpoint'],
        ];
        if(!empty($config['accessId'])){
            //使用 函数计算 中的 credentials
            $context=request()->header('context');
            if(!empty($context['credentials'])){
                $config['accessId']=$context['credentials']['accessKeyId'];
                $config['accessSecret']=$context['credentials']['accessKeySecret'];
                $config['token']=$context['credentials']['securityToken'];
            }
        }
        return new OssAdapter($config);
        
    }
}