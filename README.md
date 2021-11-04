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
REPORT_HOST=
REPORT_ID=
REPORT_SECRET=
REPORT_SIGN_SALT=
```

## License

MIT