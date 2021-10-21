## 一、docker三要素

**镜像：**images 

- 一个集成的应用模板，可以看成是一个只读的模板（包含环境及代码）

- 镜像可以创建Docker容器，一个镜像可以创建出来多个容器。
- 类比面向对象中的 **类**

**容器：**Container

- 容器是一个或一组独立运行的应用，一个软件即是容器
- 可以看成是镜像的实例（有自己所依赖的库和自己的数据；如：mysql/nginx/redis）
- 可以把容器看作是一个简易版的Linux环境（包括root用户权限、进程空间、用户空间、网络空间等）和运行在其中的应用程序。

- 类比面向对象中的 **实例**
- **和镜像的区别：**几乎是一模一样，不同点是容器是可读可写的。

**仓库：**

- 是集中存放镜像文件的场所
- 仓库（Repository）和仓库注册服务（Registry）是有区别的；仓库注册服务器往往存放着多个仓库，每个仓库又包含了多个镜像，每个镜像下有不同的标签（tag）
- 仓库又分为公开仓库和私有仓库，最大的公开仓库是 [Docker Hub](https://www.hub.docker.com)     国内最大的公开库有阿里云、网易云等。

**Docker：**

本身是一个容器运行的载体或称之为管理引擎。

我们把应用程序和配置依赖打包形成一个可交付的运行环境，这个打包好的运行环境就是images，只有通过这个images才能生成Container。images文件可以看作是Container的的模板，一个Container运行一种服务，当我们需要的时候，就可以通过Docker客户端创建一个对应的运行实例(也就是Container)

**logo的解读：**

- 鲸鱼背着好多个集装箱
- 蓝色的大海 ----> 宿主机系统
- 鲸鱼 ---> Docker
- 集装箱 ---> 容器实例(container) from 镜像(images)

## 二、常用命令

docker 的信息都存放在宿主机的`/var/lib/docker/`目录下

### 1、帮助命令

- docker version 

- docker into

- docker --help 

  ```shell
  docker images --help # 查看当前命令的文档
  ```


### 2、镜像命令

- docker images

  查看本地的镜像信息

  ```
  REPOSITORY    TAG       IMAGE ID       CREATED        SIZE
  hello-world   latest    d1165f221234   4 months ago   13.3kB
  
  镜像的仓库源    镜像的标签  镜像ID          镜像创建时间     镜像大小
  ```

  **参数**

  -a  all

  -q quiet 只显示 镜像ID

- docker search

  查询镜像（去hub.docker.com查询）

  **参数**

  -s start 标记星的个数 如： -s 30 为星号大于30的镜像

- docker pull

  下载镜像，从远程仓库内下载

  ```shell
  # docker pull 镜像名称[:TAG]
  ```

- docker rmi

  删除镜像。i指image的意思

  ```shell
  docker rmi -f mysql nginx
  docker rmi -f $(docker images -aq)
  ```

  

  **参数**

  -f force 强制删除运行中的镜像

### 3、容器命令

#### 常用

- docker run

  新建并启动容器（有镜像才能创建容器）

  ```shell
  # 格式 ：docker run [OPTION] image [COMMAND][TAG] 
  # image为镜像的名称
  ```

  **参数**

  -d daemon 后台守护进程方式启动运行

  -p publish  发布一个容器端口到宿主机端口；宿主机端口:docker容器端口

  -P publish all 随机分配端口

  -i interactive 交互的

  -t tty 一个命令终端

  -v volume 卷

  --name 定制一个容器别名

  -- volumes-from 另一个容器名    把当前容器挂载到另一个容器上

- docker ps 

  列出当前所有正在运行的容器，解读：也就是查看鲸鱼背上有哪几个集装箱在运行

  ```shell
  # 格式 ：docker ps [OPTION] [镜像名称]
  # 镜像名称用于检索
  ```

  

  **参数**

  -l latest 列出上一次运行的容器

  -a all 列出所有历史运行过的容器

  -n  number 列出指定个数的历史容器

- 退出容器

  ```shell
  # 基于docker run -it
  
  # exit 容器停止且退出
  # Ctrl + p + q 容器退出且不停止
  ```

- docker start

  启动容器

  ```shell
  # 基于docker ps -n 3
  # docker start 容器ID或容器名
  ```

- docker restart

  重新启动容器

  ```shell
  # 基于 docker ps 
  docker restart 容器ID或容器名 # 重新启动后可以通过状中的时间来进行查看，时间重新开始计时
  ```

- docker stop

  平滑停止容器。解读：有点类似于电脑关机

  ```shell
  # 基于 docker ps 
  docker stop 容器ID或容器名
  ```

  

- docker kill 

  强制停止容器。解读： 有点类似于通过拔掉电源来进行电脑关机

  ```shell
  # 基于 docker ps 
  docker kill 容器ID或容器名
  ```

- docker rm

  删除已经停止的容器

  ```shell
  # 基于 docker ps 
  docker rm 容器ID或容器名
  ```

  

#### 高级

- docker logs

  查看容器日志

  ```shell
  docker -t -f --tail 容器ID
  ```

  **参数**

  -t time 时间

  -f follow 实时的跟随

- docker top

  查看容器内运行的进程

  ```shell
  # 格式 ：docker top 容器ID
  ```

- docker inspect

  查看容器内容细节（检查）。解读：查看千层饼(容器是一层一层的嵌套的)的结构

  ```shell
  # 格式 ：docker inspect 容器ID
  ```

- 进入后台正在运行（守护进程）的容器并以命令行交互

  ```shell
  # 第一种 docker attach 容器ID
  # 直接进入容器启动命令的终端，不会启动新的进程
  
  # 第二种 docker exec -t 容器ID 要执行的命令bashShell
  # -t tty 是在容器外打开新的终端，并且可以启动新的进程
  # 也可以不使用-t 
  ```

- 从容器内拷贝文件到宿主机上 docker cp

  ```shell
  # 格式： docker cp 容器ID:容器内路径 目的的主机路径
  ```

- docker commit 

  提交容器副本使之成为一个新的镜像

  ```shell
  docker commit -m '提交的描述信息' -a '作者' 容器ID 要创建的目标镜像名[:TAG]
  ```

  

### 4、容器数据卷

- 卷就是文件或目录，存在于一个或多个容器中，由docker挂载到容器，但不属于联合文件系统，因此能够绕过Union File System提供一些用于持续存储或共享数据的特性。

- 卷的设计目的就是数据的持久化，完全独立于容器的生命周期，因些Docker不会在删除容器时删除其挂载的数据卷
- 宿主机和容器的数据可以互相的获取信息通信
- 容器到容器之间也可以互相获取信息通信

**特点**

1. 数据卷可在容器之间共享或重用数据
2. 卷中的更改可直接生效
3. 数据卷中有更改不会包含在镜像的更新中
4. 数据卷的生命周期一直持续到没有容器使用它为止

**命令**

- `docker volumes` 

  查看当前的卷信息

  ```shell
  # 格式： docker volumes [OPTION] 卷名
  # docker volumes --help 查看参数
  # 卷名可以通过 docker volumes ls 进行查看
  ```



#### 1、数据卷绑定一

```shell
# 格式一可读可写： docker run -it -v /宿主机的绝对路径目录:/容器的绝对路径目录 镜像名
# 格式二只读(read only)： docker run -it -v /宿主机的绝对路径目录:/容器的绝对路径目录:ro （只能通过宿主机来操作，容器内部是不能操作的）
# 格式二可读可写(read write)： docker run -it -v /宿主机的绝对路径目录:/容器的绝对路径目录:rw （宿主机的容器都是可以操作的）

# 查看是否挂载成功
docker inspect 容器ID

# 容器停止后，在宿主机上进行修改，同一个容器再次启动时会不会信息同步（会的）
docker stop 容器ID
docker ps -l # 查看上一次运行的容器
docker restart 容器ID # 重新启动容器
docker attatch 容器ID # 进入交互式的命令行
```

#### 2、数据卷绑定二

使用DockerFile进行添加设置(使用**数据卷绑定一**方法时，由于宿主机目录是依赖于特定的宿主机的，并不能保证所有的宿主机上都存在这样的目录)

```shell
docker build -f /mydocker/Dockerfile -t edcoor/contos .
# -f 为指定Dockerfile的文件路径
# -t tag 指定构建镜像的名字及版本号
# . 表示当前目录，即Dockerfile所在目录
```



- 创建目录mydocker并进入目录，创建文件Dockerfile使用`VOLUME`指令来给镜像添加一个或多个数据卷

- 编写Dockerfile文件内容

  ```shell
  FROM centos
  VOLUNS ["/containerA", "/containerB"]
  CMD echo "create file success..."
  CMD /bin/bash
  ```

- 进行`docker build -f ` 进行构建 --> 获得一个新的镜像文件

- 运行新生成的镜像就是定制好的运行环境 docker run 

- 容器内的卷地址已经知道（containerA/containerB），对应宿主机上的目录卷地址是随机生成的（通过`docker inspect`进行查看）

**结论：容器之间配置信息的传递，数据卷的生命周期一直持续到没有容器使用它为止。**

#### 3、Dockerfile

是用来构建docker镜像的配置文件，是由一系列命令和参数构成的脚本。

##### 构建过程解析步骤

```shell
# 按file规范编写Dockerfile文件 --> docker build ---> docker run 
# 使用Dockkerfile定义一个文件之后，docker build会产生一个Docker镜像， 当运行Docker镜像时，会真正开始提供服务（容器是直接提供服务的）
```

##### 体系结构

或者收保留字指令

- `FROM`基础镜像，当前镜像是基于哪个镜像的
- `MAINTAINER`镜像的维护者的姓名和邮箱地址
- `RUN` 容器构建时需要运行的命令
- `EXPOSE` 当前容器对外暴露的端口
- `WORKDIR` 指定在容器创建后，终端默认登录后所在的目录，第一个落脚点
- `ENV` 用来在构建镜像过程中设置环境变量
- `ADD` 将宿主机目录下的文件拷贝进镜像且ADD命令会自动处理URL和解压tar压缩包
- `COPY` 类似ADD，拷贝文件或目录到镜像中。将从构建上下文目录中<源路径>的文件/目录-----复制 ---->新的一层的镜像内的<目标路径>位置
- `VOLUME` 容器数据卷，用于数据保存和持久化工作
- `CMD` 指定一个容器启动时要运行的命令。Dockerfile中可以有多个CMD，但只有最后一个生效，CMD会被 docker run 之后的参数覆盖
- `ENTRYPOINT` 定一个容器启动时要运行的命令。和ADD一样，但不会被docker run 之后的参数覆盖（而是追加）
- `ONBUILD` 当构建一个被继承的Dockerfile时运行命令，父镜像在被子继承后父镜像的onbuild被触发



##### 查看构建历史

列出镜像的变更历史

```shell
docker history 容器ID
```

![image-20210718213049981](/Users/melon/Library/Application Support/typora-user-images/image-20210718213049981.png)

#### 4、匿名挂载/具名挂载

- 匿名挂载(不推荐使用)

  卷挂载时不写宿主机的名字，只写容器内对应路径；这时在宿主机上会随机生成一个hash名字对容器内的设置路径形成映射。

  ```shell
  # -v 参数后是容器内的路径
  docker run -it -P --name nginx01 -v /etc/nginx/ nginx
  
  # 宿主机生成的随机目录在 /var/lib/docker/volume/_data/目录内
  ```

  

- 具名挂载（推荐使用）

  卷挂载时不写具体的宿主机的路径，而是使用一个名字进行代替（名字和路径的区别是前面有没有/）

  ```shell
  # -v 参数后是 宿主机具名:容器内的路径
  docker run -it -P --name nginx01 -v nginx-conf:/etc/nginx/ nginx
  
  # 宿主机生成的具名目录在 /var/lib/docker/volume/_data/目录内
  ```

- 指定路径挂载（推荐使用）

  ```shell
  # -v 参数后是 宿主机路径:容器内的路径
  docker run -it -P --name nginx01 -v /home/melon/nginx/:/etc/nginx/ nginx
  ```

  

### 5、联合文件系统

镜像文件是一层一层的，每一个命令会生成一个层（反之每个个层对应一个操作）。

Docker镜像是只读的，当容器启动时，一个新的可写层被加载到镜像的顶部，这一层我们就称这容器层，容器之下的都叫镜像层。

![image-20210722213716134](/Users/melon/Library/Application Support/typora-user-images/image-20210722213716134.png)
