<h1 align="center"> reporting-issues </h1>

<p align="center"> A Report SDK From IssueSystem For Other Projects.</p>


## Installing

```shell
$ composer require catname/reporting-issues -vvv
```

## Usage

### 发布配置文件

```shell
$ php artisan vendor:publish --provider="Catname\ReportingIssues\ReportServiceProvider"
```

### 在 .env 中添加必要的配置项
具体配置值可以从后台获取

```dotenv
#工单相关
#工单系统的域名
REPORT_HOST=
REPORT_ID=
REPORT_SECRET=
REPORT_SIGN_SALT=
#测试模式 首次安装先测试能否上报成功，成功后改为 false
REPORT_TEST_MODE=true
```

### 示例

参数类型与 Laravel Log 一致

```php
<?php

use Catname\ReportingIssues\reportIssues;
...
reportIssues::report(string 'messages', array '系统报错');
...
```

返回值示例


```json
{
    "code": 200,
    "messages": "成功！",
    "data": []
}
```

## 注意事项
### 通过宝塔面板搭建的环境可能出现 cURL 证书错误
#### 解决方案：
[手动安装证书](https://docs.guzzlephp.org/en/stable/request-options.html#verify)
### 该包依赖于 Laravel 8
## License

MIT