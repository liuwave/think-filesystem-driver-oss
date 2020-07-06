# think-filesystem-driver-oss

这是一个基于阿里云对象存储的thinkphp6.0 Filesystem驱动，支持阿里云函数计算

## 安装

```shell script
    composer require liuwave/think-filesystem-driver-oss
```

在`config/filesystem.php`中添加配置:

```
'oss' => [
    'type'         => \liuwave\think\filesystem\driver::class,
    'accessId'     => '******',//为空则使用函数计算提供的 credentials
    'accessSecret' => '******',
    'bucket'       => 'bucket',
    'endpoint'     => 'oss-cn-hongkong.aliyuncs.com',
],
```
    


## 授权

MIT


## 参考

- thinkphp
- xxtime/flysystem-aliyun-oss
- [函数计算PHP运行环境](https://help.aliyun.com/document_detail/89032.html)



