# UbanLogin

uban邮件发送项目提取

本项目依赖于thinkphp6.0

使用说明

> composer require phpmailer/phpmailer dev-master
> composer require uban/mail dev-master
>
## 后台发送邮件
> 两个重点   
>1：如何后台执行命令   
>2：如何把php生成的邮件信息发送给命令行，这里通过redis传递

1：复制 tool/SendMail.php 到项目中app/command文件夹中   
2：修改config/console.php 添加命令   
3：复制sendMail.sh 到项目根目录   
4：调用```UbanMail::backSendByRedis()```
> 暂时仅支持redis方式传递邮件信息