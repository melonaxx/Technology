# rsync

文件时实同步工具

**选项：**

- -p 复制文件过程中保持文件的属性不变
- -v 显示复制过程信息
- -a 使用归档模式（如复制目录必须使用些选项）
- -z 在传输过程中以压缩方式进行传输

## 工作模式一

使用local模式，同步本地文件到本地其它目录。

- 格式：rsync [OPTION]... SRC [SRC]... DEST

## 工作模式二

通过远程shell访问，可以拉取远程信息，也可以把本地信息推送到远程。

在文件传递过程中，会首先对比源文件和目的文件的特征码，只有当特征码不一样的时候才会进行传递。

工作中最常用的是rsync+ssh密钥认证方式，目的是为了免密登录。

- 格式：
  - rsync [OPTION]... SRC [SRC]... [USER@]HOST:DEST
  - rsync [OPTION]... [USER@]HOST:SRC [DEST]

## 配置文件

默认的配置文件名为rsyncd.conf 此配置文件默认是没有进行创建的（默认的路径为/etc/rayncd.conf）

**rsyncd.conf配置文件的基本构成：**

```shell
全局参数
.....
[模块1]
模块参数
....
[模块2]
模块参数
....
```

### 全局参数

- pid file：指定rsync进程的pid文件的路径和名称
- lock file：指定rsync进程锁文件的路径和名称
- log file：rsync日志文件路径和名称

### 模块参数

可以写在全局部分，如果写在全局部分，则对所有的模块都生效。

- **path**：指定备份目录的路径
- use chroot：是否将用户锁定在家目录中（用户只能在其家目录内才能进行同步文件）
- max connections：指定可以进行同时链接的最大用户数
- read only：本模块只读
- write only：本模块只可写
- list：设置是否可以显示全部的模块列表
- auth users：指定访问模块时需要使用的用户名，这里的用户是虚拟用户（不存在于/etc/passwd内）
- secrets file：指定保存虚拟用户名和密码的数据文件（其文件权限必须为600）
- **host allow**：指定可以访问rsync模块的IP地址
- host deny：黑名单
- **exclude**：要指定排除的文件列表，列表中的内容以空格为分隔符

**补充：**

host allow 和host deny的使用

- 两个参数都没有的时候，那么所有的用户都可以随意访问
- 只有allow时，仅仅允许白名单的IP进行访问
- 只有deny时，仅仅允许黑名单内的IP进行访问
- 两个参数都存在时，优先使用白名单，之后再使用黑名单，若都不存在于两个内，则允许其访问模块

## 使用步骤

### rsync服务端设置

- 创建rsyncd.conf配置文件 

  ```shell
  uid = rsync
  gid = rsync
  use chroot = no
  max connections = 100
  tiemout = 60
  pid file = /var/lock/rsync.pid
  lock file = /var/lock/rsync.lock
  log file = /var/log/rsync.log
  
  [mod1]
  path = /path/to/youdir
  read only = false
  hosts allow = 10.0.0.0/24
  list = false
  ```

- 创建目录

  mkdir -pv /path/to/youdir

- 创建运行rsync的系统用户

  ```shell
  groupadd -r rsync
  useradd -r -s /sbin/nologin -g rsync rsync
  ```

- 启动rsync

  ```shell
  rsync --deamon # 使用后台守护进程的方式进行启动
  # 若要指定配置文件则使用 --config
  rsync --deamon --config=/path/to/you/config
  ```

### rsync客户端使用

**格式：**

rsync [options] /path/ [user@]host::modulename[/path/]

rsync [options] [user@]host::modulename[/path/] /path/ 

如：rsync -avz /home/ vuser1@109.04.04.0::mod1/home/ –passwd-file=/etc/rsync.passwd

**高级用法:**

- –passwd-file 指定虚拟用户的密码

- –delete 服务端的文件和客户端完全一致（客户端上传时，若服务端上存在客户端上没有的文件则删除）

- –exclude 在进行文件传输的时候，排除指定的文件

  ```shell
  # 方式一：排除一个文件
  --exclude=file
  # 方式二：排除多个文件
  --exclude={file1,file2}
  # 方式三：通配符方式
  --exclude=*.php
  ```

  



## rsync小结

**服务端配置：**

- 创建配置文件rsyncd.conf
- 创建密码文件并设置权限为600（若用不到则不进行填写）
- 创建系统用户（用于以守护进程的方式运行rsync）
- 创建模块对应的目录，修改目录的属主属组为系统用户
- 以deamon的形式启动

**客户端配置：**

- 创建虚拟用户的密码文件并把文件权限设置为600（若需要时进行设置）
- 向模块传递文件或者从目录内拉取文件



