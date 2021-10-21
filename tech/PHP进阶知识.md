# 一、变量

 变量的作用域global/local/static

- global是全局变量，local是函数内局部变量，static是函数内局部变量

- 全局变量要是局部使用需要用global关键字
- 局部变量不能在全局使用

echo , print 和 print_r的区别:

- echo  - 可以输出一个或多个字符串，没有返回值
- print  - 只能输出一个简单类型变量的值,如int,string，返回值为1
- print_r - 可以输出一个复杂类型变量的值,如数组,对象

# 二、运算符

逻辑运算符:

| 运算符  | 名称 | 描述                                         | 实例                                 |
| :------ | :--- | :------------------------------------------- | :----------------------------------- |
| x and y | 与   | 如果 x 和 y 都为 true，则返回 true           | x=6 y=3 (x < 10 and y > 1) 返回 true |
| x or y  | 或   | 如果 x 和 y 至少有一个为 true，则返回 true   | x=6 y=3 (x\==6 or y==5) 返回 true    |
| x xor y | 异或 | 如果 x 和 y 有且仅有一个为 true，则返回 true | x=6 y=3 (x\==6 xor y==3) 返回 false  |

# 三、php配置

`php.ini`文件内部分参数使用说明

## 1、安全参数

```ini
;disable_function 设置禁用系统内的某些函数
disable_function=sysytem phpinfo exec mkdir
;expose_php是否在head头内显示php引擎信息(建议关闭)
expose_php=Off
;register_argc_argv 使post get的参数都设置为全局变量（建议关闭）
register_argc_argv=Off
;display_errors 不显示报错信息
display_errors = Off
;error_reporting 设置报错级别
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
;开启日志记录
log_errors = On
;设置错误日志记录的文件地址
error_log = /data/web_logs/php_errors.log
```

## 2、资源参数

```ini
;每个脚本运行的最大时长（秒）0表示没有限制；该指令只影响脚本本身的运行时长，花费在脚本之外的时间不计（如：sleep、数据库查询、）
max_execution_time = 30
;单个脚本能够申请到的最大内存，-1表示不进行限制
memory_limit = 512M
;开启文件上载
file_uploads = On
;上载文件大小限制
upload_max_filesize = 512M
;最大的文件上载数量
max_file_uploads = 50
;禁远程使用url打开文件
allow_url_fopen = Off
```

# 四、php扩展

php常用的扩展

```shell
[PHP Modules]
bcmath #
bz2
calendar
Core
ctype
curl
date
dom
fileinfo
filter
ftp
gd
gettext
hash
iconv
igbinary
json
libxml
mbstring
mcrypt
memcached
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
pdo_sqlite
Phar
posix
redis
Reflection
session
shmop
SimpleXML
soap
sockets
SPL
sqlite3
standard
sysvsem
tokenizer
wddx
xml
xmlreader
xmlrpc
xmlwriter
yaconf
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```



# PHP8

新特性：[视频](https://www.youtube.com/watch?v=uU1-ZqIbYes) [引用](http://blog.yhuan195.top/index.php/2021/07/06/%e4%bb%8e-php5-%e5%88%b0-php8/)

- Just-In-Time(JIT)
- Names Arguments
- Unin Types
- Constructor Property Promotion
- Null-Safe Operator
- Trailing Comma in Parameters
- Match Experssion
- Attributes
- WeakMaps
- Mixed Type
- Throw Exception From New Places
- Call::class on objects
- Non-Capturing Catch
