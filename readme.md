# 创蓝短信

## 安装

```json
composer require eddie/chuanglan
```

或 在composer.json 添加 

```json
"eddie/chuanglan": "~v1.0"
```

运行 ```composer update```

下载完毕后, 在`.env`文件中添加配置项: 

```json
CHUANGLAN_UN=创蓝账号
CHUANGLAN_PW=创蓝密码

```

然后再配置 `config/app.php` 文件中的 `providers`, 加上:

```json
Eddie\Chuanglan\ChuanglanServiceProvider::class,

```
