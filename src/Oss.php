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
        $config = [
          'bucket'   => $this->config[ 'bucket' ],
          'endpoint' => $this->config[ 'endpoint' ],
        ];
        if (empty($this->config[ 'credentials' ])) {
            //使用 函数计算 中的 credentials
            $config[ 'accessId' ]     = getenv('accessKeyID') ? : '';
            $config[ 'accessSecret' ] = getenv('accessKeySecret') ? : '';
            $config[ 'token' ]        = getenv('securityToken') ? : '';
        }
        else {
            $config[ 'accessId' ]     = $this->config[ 'credentials' ][ 'accessId' ] ?? '';
            $config[ 'accessSecret' ] = $this->config[ 'credentials' ][ 'accessSecret' ] ?? '';
        }
        
        return new OssAdapter($config);
    }
}