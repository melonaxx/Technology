# 一、前置认识

官网：[Nginx](https://nginx.org/)

## 1、优势

- **高性能：** 处理高并发能力很强（IO 模型：Nginx epoll模型；apache select 模型）

- **高扩展性：** 模块化的程序，根据企业业务需求添加响应模块

- **高可用：** 多台服务中，若有某台服务挂掉时，会备用的的服务立即替补来保证服务正常运行（三个9、四个9、五个9）

- **支持热部署：** nginx版本平滑升级（不影响对外提供服务）

## 2、应用场景

- **静态资源服务：** web服务
- **负载均衡：** 实现集群化管理

- **代理服务：** 将动态资源请求（第二次进行缓存）转发给 FastCGI  —》 后端语言 –》数据库 

- **安全控制：** 针对用户访问进行权限控制，https加密处理的安全认证，结合`Lua`语言实现waf防护（网页防火墙）

# 二、安装

## 1、编译安装方式

```shell
# 安装前的依赖添加
yum install -y openssl-devel pcre-devel gcc

# 预编译(重要参数): [参考链接](http://nginx.org/en/docs/configure.html)
--prefix=path
定义将保存服务文件的目录。这个相同的目录也将用于由configure（库源的路径除外）和nginx.conf配置文件中设置的所有相对路径 。/usr/local/nginx默认设置为目录。
--sbin-path=path
设置 nginx 可执行文件的名称。此名称仅在安装期间使用。默认情况下，文件名为 prefix/sbin/nginx.
--modules-path=path
定义将安装 nginx 动态模块的目录。默认情况下使用prefix/modules目录。
--conf-path=path
设置nginx.conf配置文件的名称。如果需要，nginx 始终可以使用不同的配置文件启动，方法是在命令行参数中指定它 。默认情况下，文件名为 . -c fileprefix/conf/nginx.conf
--error-log-path=path
设置主要错误、警告和诊断文件的名称。安装后，始终可以nginx.conf使用error_log指令在配置文件中 更改文件名 。默认情况下，文件名为 prefix/logs/error.log.
--pid-path=path
设置nginx.pid将存储主进程的进程 ID的文件的名称。安装后，始终可以nginx.conf使用pid指令在配置文件中 更改文件名 。默认情况下，文件名为 prefix/logs/nginx.pid.
--lock-path=path
为锁定文件的名称设置前缀。安装后，始终可以nginx.conf使用lock_file指令在配置文件中 更改该值 。默认情况下，该值为 prefix/logs/nginx.lock。
--user=name
设置非特权用户的名称，其凭据将由工作进程使用。安装后，始终可以nginx.conf使用user指令在配置文件中 更改名称 。默认用户名是nobody。
--group=name
设置工作进程将使用其凭据的组的名称。安装后，始终可以nginx.conf使用user指令在配置文件中 更改名称 。默认情况下，组名设置为非特权用户的名称。

./configure --prefix=/usr/local/nginx --sbin-path=/bin/ --user=www --group=www --with-http_ssl_module --with-http_stub_status_module --with-http_gzip_static_module --with-http_v2_module --with-http_realip_module

# 添加设置好的用户(若用户已经存在则不需要添加)
adduser www -m -s /sbin/nologin

# 编译安装
make && make install

# 启动服务
/bin/nginx
```

# 2、自动化安装

使用Contos带的自动化管理工具yum

方式参考 [yum安装nginx](https://nginx.org/en/linux_packages.html#RHEL-CentOS)

```shell
# 配置yum源
sudo yum install yum-utils
touch /etc/yum.repos.d/nginx.repo

# 添加yum源到文件内 /etc/yum.repos.d/nginx.repo
[nginx-stable]
name=nginx stable repo
baseurl=http://nginx.org/packages/centos/$releasever/$basearch/
gpgcheck=1
enabled=1
gpgkey=https://nginx.org/keys/nginx_signing.key
module_hotfixes=true

[nginx-mainline]
name=nginx mainline repo
baseurl=http://nginx.org/packages/mainline/centos/$releasever/$basearch/
gpgcheck=1
enabled=0
gpgkey=https://nginx.org/keys/nginx_signing.key
module_hotfixes=true
```



## 3、命令

查看安装后的命令

```shell
# 查看安装信息
/usr/local/nginx/sbin/nginx -V
```

