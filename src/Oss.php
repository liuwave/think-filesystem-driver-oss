<?php

/**
 * Created by PhpStorm.
 * User: liuwave
 * Date: 2020/7/6 17:53
 * Description:
 */
declare(strict_types=1);

namespace liuwave\think\filesystem\driver;

use League\Flysystem\FilesystemAdapter;
use OSS\OssClient;
use think\filesystem\Driver;
use Zing\Flysystem\Oss\OssAdapter;


class Oss extends Driver
{

    /**
     * @return FilesystemAdapter
     */
    protected function createAdapter(): FilesystemAdapter
    {

        $config = [
            'bucket' => $this->config['bucket'],
            'endpoint' => $this->config['endpoint'],
            'host' => $this->config['host'],
        ];

        if (empty($this->config['credentials'])) {
            //使用 函数计算 中的 credentials
            $config['accessKeyId'] = getenv('accessKeyID') ?: '';
            $config['accessKeySecret'] = getenv('accessKeySecret') ?: '';
            $config['token'] = getenv('securityToken') ?: '';
        } else {
            $config['accessKeyId'] = $this->config['credentials']['accessKeyId'] ?? '';
            $config['accessKeySecret'] = $this->config['credentials']['accessKeySecret'] ?? '';
        }

        $client = new OssClient(
            $config['accessKeyId'], $config['accessKeySecret'], $config['endpoint'],
            !empty($config['host'])
        );

        $config['options'] = [
            'url' => $this->config['url'] ?? '',
            'endpoint' => $config['endpoint'],
            'bucket_endpoint' => '',
            'temporary_url' => '',
        ];


        return new OssAdapter($client, $config['bucket'], $config['prefix'], null, null, $config['options']);
    }
}