# think-filesystem-driver-oss

这是一个基于阿里云对象存储的thinkphp6.0 Filesystem驱动，支持阿里云函数计算。

## 安装

```shell script
    composer require liuwave/think-filesystem-driver-oss
```

在`config/filesystem.php`中添加配置:

```
'oss' => [
    'type'         => \liuwave\think\filesystem\driver\Oss::class,
    'accessId'     => '******',//为空则使用函数计算 runtime context提供的 credentials
    'accessSecret' => '******',//使用函数计算credentials时，可以为空
    'bucket'       => 'bucket',
    'endpoint'     => 'oss-cn-hongkong.aliyuncs.com',
    'url'          => '//oss-test-for-all.oss-cn-beijing.aliyuncs.com'
],
```
    
## oss访问权限

### 使用 函数计算 runtime context 提供的 credentials

函数计算的入口函数中需要将 context 绑定到 request header上。另外，需要在函数访问的服务中的服务配置中给对应角色授权 读写 对应的oss bucket。

相关文档

- [函数计算权限简介](https://help.aliyun.com/document_detail/52885.html)
- [liuwave/fc-thinkphp](https://github.com/liuwave/fc-thinkphp)
- [函数计算PHP运行环境](https://help.aliyun.com/document_detail/89032.html)


### 通用(同样适用于函数计算)

accessId对应的用户需要 对应的oss bucket访问授权。

相关文档

- [使用RAM对OSS进行权限管理](https://help.aliyun.com/knowledge_detail/58905.html)



## 使用

```php
//默认$file为单文件。$file为多文件时file为数组，需要进行遍历处理
$file=\request()->file('file');
$filesystem     = \think\facade\Filesystem::disk('oss');
$saveName       = $filesystem->putFile('/path/to/save/file', $file, 'md5');
$saveName       = str_replace('\\', '/', $saveName);
$fullName = think\facade\Filesystem::getDiskConfig('oss', 'url').'/'.$saveName;
```


## 授权

MIT


## 参考

- thinkphp
- xxtime/flysystem-aliyun-oss




## 更多

- [腾讯云liuwave/think-filesystem-driver-cos](https://github.com/liuwave/think-filesystem-driver-cos)
- [七牛云liuwave/think-filesystem-driver-kodo](https://github.com/liuwave/think-filesystem-driver-kodo)

