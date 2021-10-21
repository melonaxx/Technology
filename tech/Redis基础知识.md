# 一、为什么要使用NoSQL

## 1、MySQL的演进史

### a、单机时代架构

APP应用  —>  数据访问层DAL —> MySQL

90年代一个网站的访问量不会太大， 一个数据库就搞定了，那个时候使用静态网页Html服务器根本没有太太的压力。

当遇到下面的情形时，会出现什么情况？

- 数据量如果太大，一台机器已经放不下了？
- 数据库有索引（index）一台机器内存已经放不下了？
- 访问量（读写混合），一台服务器扛不了了？

出现上面的情况时就需要进行晋级~

### b、Memecach + MySQL + 垂直拆分

​																| ——>  MySQL从库（与主库同步）

APP应用  —>  数据访问层DAL —> Memecach —> MySQL主库

​																|——->  MySQL从库（与主库同步）

80%的请求都是在读取数据，每次都要从库内查询比较麻烦，为了减轻库有压力使用缓存来保证效率~

**缓存发展历程：** 优化数据库索引 ——> 文件缓存（IO） ——->  memecache缓存（当时最热门的技术！）

### c、分库分表 + 水平拆分 + MySQL集群

​																		 				| ——>  MySQL从库（与主库同步）

​															（集群1）|———-| ——> Memecach —> MySQL主库

​																			|			|——->  MySQL从库（与主库同步）

​																			|

​																			|			| ——>  MySQL从库（与主库同步）

APP应用  —>  数据访问层DAL —> 缓存  ——> |———-|—> MySQL主库

​																			|			|——->  MySQL从库（与主库同步）

​																			|

​																			|			| ——>  MySQL从库（与主库同步）

​															（集群2）| ———|—-—> MySQL主库

​																						|——->  MySQL从库（与主库同步）

### d、最近年代（大数据）

2010-至今，当今时代会产生数量庞大的数据，如：用户位置、操作记录、热榜。

MySQL对于大量的数据存储已经力不从心了~

于是乎就出现了NoSQL，这就是为什么要引入NoSQL的原因。

NoSQL = not only SQL (不仅仅是SQL) 泛指非关系型数据库。

随着web2.0互联网的诞生，传统的关系型数据库不能满足web2.0时代。尤其是在大数据时代~暴露出来很多难以克服的问题，NoSQL在当今大数据环境下发展的十分迅速，Redis是发展最快的，而且是我们当下必要掌握的一个技术!

## 2、NoSQL

特点：

- 方便扩展（数据之间没有关系，很好扩展）
- 大数据量高性能（一秒写8万次，读取11万次）
- 数据结构是多样性型的（不需要设计数据库，随取随用）

SQL **VS** NoSQl

```shell
# 传统的SQL
1. 结构化组织
2. SQL语句
3. 数据和关系都存在于表内 col row
4. 操作数据定义语句
5. 严格的一致性
6. 基础的事务

# NoSQL
1. 不仅仅是数据
2. 没有固定的查询语句
3. 键值对存储，列存储、文档存储、图形数据库
4. 最终一致性
5. 高性能、高可用、高可扩（三高）
```

**应用到实际解决的问题：**

```shell
# 3V: 主要描述的问题
海量Velume
多样Variety
实时Velocity

# 3高：主要对程序的要求
高并发
高可扩
高性能 
```

**NoSQL配合其它数据库的使用案例：**

```shell
# 业务模型的各个字段公布在不同的数据源中
商品信息：
基本信息 ------> mysql
spu属性(SPU = Standard Product Unit 标准化产品单元) ------> Document DB 
图片 ------> OSS
相关关键字 ------> Search Engine

# 1、商品的基本信息
名称、价格、商家信息。使用关系型数据库就可以解决
# 2、商品的描述、评论（文字较多）
文档型数据库，MongoDB
# 3、商品图片
分布式的文件系统，如阿里云的OSS、淘宝的TFS
# 4、商品的关键字（搜索）
搜索引擎 elasticsearch
# 5、商品热门的波段信息
内存数据库，Redis/Memecache
```

**架构师最简单的标准：** 没有什么时不能加一层来解决的，如果有就再加一层~

```shell
# 架构示例
应用网站
	 |
	 |
统一数据服务平台（UDSL）
	 |
	 |
热点缓存平台（UDSL的二级缓存）
- 热点规则、KEY规则、过期规则
- 热点匹配、Key生成、缓存读写
- 事件过期、自动过期
  |
  |
热点数据库
```

# 二、NoSQL的四大分类

**KV键值对：**

**Redis**、Memecache

**文档型数据库**（bson和json一样）

**MongeDB**: 是一个基于分布式文件存储系统，主要用来处理大量的文档

其是一个介于关系型数据库和非关系型数据库之间的产品，MongoDB是非关系型数据库中最像关系型数据库的！

**列存储数据库**

**HBase**、分布式文件系统

**图关系数据库**

**Neo4j**、InfoGrid

它不是存储图形的，存储是的关系，比如：朋友圈的社交网络，广告推荐~

# 三、Redis入门

## 1、概述

Redis是什么？*Redis*（==Re==mote ==Di==ctionary ==S==erver )，即远程字典服务。

## 2、安装

```bash
# 第一步
# 下载安装包到linux上[官方文档](http://redis.cn/)

# 第二步
# 移动安装包到`/opt`下并解压Redis安装包，进入解压后的安装包执行安装命令
install gcc-c++
make
make install

# 第三步
# 默认的安装目录为`/usr/local/bin`

# 第四步
# 将解压目录内的配置文件`redis.conf`复制到自定义的配置目录内，并打开配置文件修改如下：
deamonize yes

# 第五步
# 使用自定义的配置文件启动redis
redis-server /my/path/to/redis/redis.conf

# 第六步
# 使用redis-cli进行连接测试
redis-cli
ping

# 第七步
# 关闭redis-server
# 在第六步的基础上执行命令
shutdown
exit

# 第八步
# 查看redis-server是否存在
ps -ef | grep redis
```

## 3、测试性能工具

`redis-benchmark` 是一个压力测试工具

| 1    | **-h** | 指定服务器主机名                      | 127.0.0.1 |
| ---- | ------ | ------------------------------------- | --------- |
| 2    | **-p** | 指定服务器端口                        | 6379      |
| 3    | **-s** | 指定服务器 socket                     |           |
| 4    | **-c** | 指定并发连接数                        | 50        |
| 5    | **-n** | 指定请求数                            | 10000     |
| 6    | **-d** | 以字节的形式指定 SET/GET 值的数据大小 | 3         |
| 7    | **-k** | 1=keep alive 0=reconnect              | 1         |

```bash
redis-benchmark -h 127.0.0.1 -p 6379 -c 100 -n 100000 -t set,get
```

## 4、基础知识

默认有16个数据库，在配置文件内`database 16`。默认使用的是第0个数据库

端口号为6379，按键手机的MERZ(外国的明星)对应的数字

```bash
# 切换数据库
select 2
# 当前数据库中数据的大小
DBSIZE
# 清除当前所在数据库中的所有数据
flushdb
# 清除所有数据库中的数据
flushall
# 查看当前库中有所有Key
keys *
```

**Redis是单线程的**，为什么单线程还这么的快？

基于内存操作，CPU不是其性能瓶颈，其性能瓶颈是内存大小和网络带宽。官方提供的数据为100000+ QPS

误区1：高性能的服务一定是多线程？

误区2：多线程（CPU上下文会切换）一定比单线程效率高？

核心：Redis是将数据全部放在内存中，使用单线程去操作效率是最高的，多线程会有上下文的切换耗时操作！

对于内存来说没有上下文切换效率就是最高的，多次的读写都是在一个CPU上对于内存来说就是最佳的方案。

## 5、五大数据类型

Redis 是一个开源（BSD许可）的，内存中的数据结构存储系统，它可以用作数据库、缓存和消息中间件。 它支持多种类型的数据结构，如 [字符串（strings）](http://redis.cn/topics/data-types-intro.html#strings)， [散列（hashes）](http://redis.cn/topics/data-types-intro.html#hashes)， [列表（lists）](http://redis.cn/topics/data-types-intro.html#lists)， [集合（sets）](http://redis.cn/topics/data-types-intro.html#sets)， [有序集合（sorted sets）](http://redis.cn/topics/data-types-intro.html#sorted-sets) 与范围查询， [bitmaps](http://redis.cn/topics/data-types-intro.html#bitmaps)， [hyperloglogs](http://redis.cn/topics/data-types-intro.html#hyperloglogs) 和 [地理空间（geospatial）](http://redis.cn/commands/geoadd.html) 索引半径查询。 Redis 内置了 [复制（replication）](http://redis.cn/topics/replication.html)，[LUA脚本（Lua scripting）](http://redis.cn/commands/eval.html)， [LRU驱动事件（LRU eviction）](http://redis.cn/topics/lru-cache.html)，[事务（transactions）](http://redis.cn/topics/transactions.html) 和不同级别的 [磁盘持久化（persistence）](http://redis.cn/topics/persistence.html)， 并通过 [Redis哨兵（Sentinel）](http://redis.cn/topics/sentinel.html)和自动 [分区（Cluster）](http://redis.cn/topics/cluster-tutorial.html)提供高可用性（high availability）。

### Redis-Key

```sh
# 查看所有的key 
keys *
# 移除key
move keyName
# 为key设置过期时间
expire keyName second
# 查看key的剩余时间
ttl keyName
# 判断当前key是否存在
exists keyName
# 查看当前key的类型
type keyName
```

### String（字符串）

**应用场景**

- 计数器
- 统计多单元的数量 (uid:3353:watch)
- 对象缓存存储

```sh
# 设置key的值
set name 'jack'
# 获取key的值
get name
# 判断Key是否存在
exists name
# 向key对应的值字符串后追加内容
append name otherStr
# 获取key对应值的长度
strlen name
---------------------------
# 自增一个数字
incr num
# 自增两个数字（步长为2）
incrby num 2
# 自减一个数字
decr num
# 自减三个数字（步长为3）
decrby num 3
------------字符串范围---------------
# 截取0-3个字符【前闭后闭】
getrange str1 0 3
# 获取所有的字符串内容
getrange str1 0 -1
------------字符串替换---------------
# setrange key offset value  替换指定位置的字符串
set key2 aaaaa
setrange key2 1 xx
get key2 ----> axxaa
---------------------------
# setex (set with expire) 设置过期时间 
setex key second value
set key3 10 myexpirestr
# setnx (set if not exist) 不存在再设置 在分布式锁中会常常使用
setnx key value
setnx key4 strkey4
setnx key4 strkey3
-----------批量操作----------------
# 批量设置值
mset key value key1 value1 key2 value2 .....
mset k1 v1 k2 v2
keys *
# 批量获取值
mget key key1 key2....
mget k1 k2
# 原子操作批量 (要么一块成功~ 要么一块失败~)
msetnx key value key1 value1 key2 value2 .....
msetnx k1 v1 k5 v5 # k1 已经存在所以都会失败
-----------组合操作----------------
# 先获取再设置，若值不存在，则返回nil，如果存在则返回原来的值再设置新的值
getset key value
getset name jack
```



### List（列表）

在Redis中我们可以把List玩成 `栈`、`队列`、`阻塞队列`！

- 命令不区分大小写
- 实际是一个链表，before NODE after ， left， right 都可以插入
- 如果key不存在，创建新的链表，存在则新增内容
- 如果移除了链表内有所有数据，空链表也代表不存在！
- 在两边插入或改动值效率最高！操作中间元素效率相对会低一点~

**应用场景**

- 消息队列（Lpush Rpop）
- 栈（Lpush Lpop）

```sh
# 判断key存在与否，返回0和非0
# 格式： exists key
exists k3
# 将一下值或多个插入到列表的内（左侧）
# 格式： LPUSH key value [value1....]
lpush k1 v1 v2
# 获取列表内的值，也可以通过区间获取列表内的值
# 格式： LRANGE key start stop
lrange k1 0 -1
lrange k1 0 1
# 将一下值或多个插入到列表的内（右侧）
# 格式： RPUSH key value [value ...]
rpush k1 v3
# 通过下标来设置值（前提是列表key已经存在且下标也存在，否则会报错）
# 格式： lset key index value
lset k1 0 other
lset k1 100 count
# 在列表指定的值前、后插入一个值
# 格式：linsert key BEFORE|AFTER pivot value
linset k1 before v2 myInsertValue
linset k1 after v2 youInsertValue

-----------移除操作----------------
# 从左侧移除列表内一个元素，返回移除后的元素值
# 格式： lpop key
lpop k1
# 从右侧移除列表内一个元素，返回移除后的元素值
# 格式： rpop key
rpop k1
# 通过值来删除，若有多个值相同可以指定删除的值个数, 若实际个数据小于删除个数则以实际个数据为准
# 格式： lrem key count value
lrem k1 1 v1
lrem k1 2 v1
# 截取通过下标，前半后闭；会改变原list的值，原list只剩下截的内容；返回值为OK
# ltrim key start stop
ltrim k1 1 2
-----------下标取值----------------
# 通过下标取值，若没有值则返回nil, 可以应用到阻塞队列场景中
# 格式： lindex key index
lindex k1 0
lindex k1 1
# 返回列表的长度
# 格式： llen key
llen k1
-----------组合操作----------------
# 移动列表的第一个元素到新的另一个列表内；移动后两个列表内的值相加就是原始列表
# 格式： rpoplpush source destination
rpoplpush k1 k2
```

### Set（集合）

**特点：**无序的集合，没有重复值

**应用场景：**

- 粉丝关注、共同关注
- 做了A，又做了B，同时做了A和B的用户

```sh
# 向集合内添加元素，添加重复的值会返回零，成功则返回非零
# 格式：sadd key member [member ...]
sadd s1 1
# 获取集合内的所有元素
# 格式：smembers key
smembers s1
# 判断value是否是集合内有元素,返回非零和零
# 格式：sismember key member
sismember s1 2
sismember s1 1
---------------------------
# 获取集合内元素的个数
# 格式：scard key
scard s1
--------------删除操作-------------
# 移除集合中的指定元素
# 格式： srem key member [member ...]
srem s1 1

# 随机删除集合中的指定个数的元素, 返回删除的元素
# 格式： spop key [count]
spop s1 2
--------------随机取值操作-------------
# 随机抽选出集合中的指定个数的元素
# 格式：srandmember key [count]
srandmember s1 2
--------------复合操作-------------
# 把s集合中的member元素移动到d集合内
# 格式：smove source destination member
smove s1 s2 'jack'

# 应用场景，粉丝的关注，共同关注、全部关注
# 集合的差集,以第一个key为参照
# 格式： sdiff key [key ...]
sdiff s1 s2
# 集合的交集
# 格式： sinter key [key ...]
sinter s1 s2
# 集合的并集
# 格式： sdiff key [key ...]
sunion s1 s2
```



### Hash（散列）

Map集合 ——->  key：Map   相当于值是一个map

**应用场景：**

- 适用于对象的存储
- 适用于标记每个用户的信息

```sh
# 设置一个map
# 格式：hset key filed value
hset h1 name jack

# 获取一个map值
# 格式： hget key filed
hget h1 name

# 对一个键设置多个值
# 格式： hmset key filed1 value filed2 value [filed value ...]
hmset h2 name rose age 12

# 获取一个键设置多个值
# 格式： hmget key filed1 filed2 [filed ...]
hmget h2 name age

# 获取所有的key, 返回key:value
# 格式：hgetall key
hgetall h1

# 获取长度
# 格式： hlen key
hlen h1

# 判断是否存在,若存在则不再进行设置，返回零和非零
# 格式：hsetnx key field value
hsetnx h2 name melon
--------------删除操作-------------
# 删除哈希指定的key的filed，对应的value也就消失了，成功则返回非零
# 格式： hdel key field [field ...]
hdel h1 name age
---------------------------
# 判断hash的key中指定的字段是否存在, 返回零或非零
# 格式：hexists key field
hexists h1 name
hexists h1 name1

# 获取key的所有字段
# 格式： hkeys key
hkeys h1

# 获取key的所有字段对应的值
# 格式： hvals key
hvals h1
--------------自增自减-------------
# 自增
# 格式：hincrby key field increament
hincrby h2 index 1

# 自减
# 格式：hdecrby key field decreament
hdecrby h2 index 2
```



### Zset（有序集合）

在set的基础上添加了一个值（用来进行排序）

**应用场景：**

- 排行榜
- 成绩表
- 加权判断

```sh
# 向集合内添加一个元素
# 格式：zadd key score member [score member ...]
zadd z1 2 jack 3 rose

# 获取集合内值升序(前闭后闭)
# 格式：zrange key start stop
zrange z1 0 -1
zrange z1 0 1

# 获取集合内值降序(前闭后闭)
# 格式：zrevrange key start stop
zrevrange z1 0 -1
zrevrange z1 0 1

# 获取排序好的集合
# 格式： zrangebyscore key min max [withscores] [limit offset count]
# 格式： zrevrangebyscore key max min [withscores] [limit offset count]
zrangebyscore z1 -inf +inf withscores
zrangebyscore z1 -inf +inf withscores limit 0 1
ZREVRANGEBYSCORE z1 +inf -inf withscores Limit 0 1

# 查看集合的长度
# 格式：zcard key
zcard z1

# 获取序号在指定范围区间元素的个数
# 格式：zcount key min max
zcount z1 2 3

# 变更序号值
# 格式：zincrby key increament mumber
zincrby z1 2 name

--------------移除操作-------------
# 从集合内移除指定的元素
# 格式：zrem key member [member ...]
zadd z2 2 name 3 age
zrem z2 name age
```



## 6、三种特殊类型

### geospatial（地理位置）

Redis在3.2版本推出了geo，这个功能可以推算地理位置的信息，两地之间的距离，方圆几里的人。

```sh
# 添加位置信息
# 格式：geoadd key longitude latitude member [longitude latitude member ...]
geoadd china:city 116.40 39.90 beijing
geoadd china:city 121.47 31.23 shanghai 120.16 30.24 hangzhou

# 从key里返回所有给定位置元素的位置（longitude latitude）
# 格式：geopos key member [member ...]
geopos china:city beijing shanghai

# 返回两个位置之间的距离
# 格式：geodist key member1 member2 [unit]
指定单位的参数 unit 必须是以下单位的其中一个(默认是m)：
m 表示单位为米。
km 表示单位为千米。
mi 表示单位为英里。
ft 表示单位为英尺。
geodist key beijing shanghai

# 以给定的经纬度为中心， 返回键包含的位置元素当中， 与中心的距离不超过给定最大距离的所有位置元素。（我附近的人，通过半径来查询）
# 格式：GEORADIUS key longitude latitude radius m|km|ft|mi [WITHCOORD] [WITHDIST] [COUNT count]
GEORADIUS china:city 116 38 1000 km
GEORADIUS china:city 116 38 800 km withcoord
GEORADIUS china:city 116 38 1000 km withcoord withdist count 2

# 中心点是由给定的位置元素决定的， 而不是像 GEORADIUS 那样， 使用输入的经度和纬度来决定中心点
# 格式：GEORADIUSBYMEMBER key member radius m|km|ft|mi [WITHCOORD] [WITHDIST] [WITHHASH] [COUNT count]
GEORADIUSBYMEMBER china:city shanghai 300 km withcoord withdist
GEORADIUSBYMEMBER china:city shanghai 300 km withcoord withdist count 1

# geo 底层原理是有序集合zset, 我们可以使用zset来操作geo
ZRANGE china:city 0 -1 withscores
zrem china:city beijing
```



### hyperloglog（超级日志）

Redis在2.8.9就集成了Hyperloglog数据结构，其是基数统计的算法.

**优点：** 占用内存是固定的，2^26个元素的个数，只需要12kB的内存！如果要从内存角度来比较的话Hyperloglog是首选！

- 基数不大，数据量不大就用不上，会有点大材小用浪费空间
- 有局限性，就是只能统计基数数量，而没办法去知道具体的内容是什么
- 和bitmap相比，属于两种特定统计情况，简单来说，HyperLogLog 去重比 bitmap 方便很多
- 一般可以bitmap和hyperloglog配合使用，bitmap标识哪些用户活跃，hyperloglog计数

**应用场景：**网页的UV（一个人访问一个网站多次，但是还是算作一个人）

传统的方式会使用set来保存用户UID,通过总数据量来计数，我们的目的是用为计数而不是保存用户UID。

- 统计注册 IP 数
- 统计每日访问 IP 数
- 统计页面实时 UV 数
- 统计在线用户数
- 统计用户每天搜索不同词条的个数

**缺点：** 如果允许容错，那么一定使用Hyperloglog

```sh
# 创建一组元素
# 格式：PFADD key element [element ...]
PFADD p1 a b c d e f g

# 查看从个组内的元素个数（个数和）
# 格式：PFCOUNT key [key ...]
PFCOUNT p1

# 合并多个组的数据并去重 key1 + key2 + ... ==> keyN
# 格式：PFMERGE destkey sourcekey [sourcekey ...]
PFMERGE key3 key1 key2
PFCOUNT key3
```



### bitmaps（位存储）

**应用场景：**统计用户登录、未登录；打卡、未打卡；只有两个状态的都可以使用Bitmaps

**特点：**位图数据结构。都是操作二进制位来进行记录。只有0和1两个状态！

365天 = 365bit  1字节=8bit  约46个字节左右~

**案例：**

很多应用的用户id以一个指定数字（例如10000） 开头， 直接将用户id和Bitmaps的偏移量对应势必会造成一定的浪费， 通常的做法是每次做setbit操作时将用户id减去这个指定数字。
在第一次初始化Bitmaps时， 假如偏移量非常大， 那么整个初始化过程执行会比较慢， 可能会造成Redis的阻塞。

```sh
# 示例：记录打卡数 offset为某一天，value为0或1表示打卡与否
# 添加标记
# 格式：setbit key offset value
SETBIT bit 1 0
SETBIT bit 2 1
SETBIT bit 3 1
SETBIT bit 4 0
SETBIT unique:users:2016-04-05 8 0 # 记录用户1000008在这一天打卡

# 查看某一天是否打卡
# 格式：getbit key offset
GETBIT bit1 1
GETBIT unique:users:2016-04-05 8 # 用户1000008在这一天是否打卡

# 统计操作 [start]和[end]代表起始和结束字节数，注意不是偏移量
# 格式：bitcount key [start end]
bitcount bit1 

# 复合操作 它可以做多个Bitmaps的and（交集） 、 or（并集） 、 not（非） 、 xor（异或） 操作并将结果保存在destkey中。分别使用的是位运算
# 格式：bitop destkey key [key ...]
bitop and resultKey bit1 bit2
```

但Bitmaps并不是万金油， 假如该网站每天的独立访问用户很少， 例如只有10万（大量的僵尸用户） ， 那么两者的对比如表3-5所示， 很显然， 这时候使用Bitmaps就不太合适了， 因为基本上大部分位都是0。

**庞大的用户量**

| 数据类型 | 每个用户id占用空间 | 需要存储的用户量 | 全部内存量              |
| -------- | ------------------ | ---------------- | ----------------------- |
| 集合类型 | 64位               | 50,000,000       | 64 * 50,000,000 = 400M  |
| Bitmaps  | 1位                | 100,000,000      | 1 * 100,000,000 = 12.5M |

**较少的用户量**

| 数据类型 | 每个用户id占用空间 | 需要存储的用户量 | 全部内存量              |
| -------- | ------------------ | ---------------- | ----------------------- |
| 集合类型 | 64位               | 100,000          | 64 * 100,000 = 800KB    |
| Bitmaps  | 1位                | 100,000,000      | 1 * 100,000,000 = 12.5M |

# 四、Redis高级

## 1、事务

**事务的本质：**一组命令的集合。一个事务中的所有命令都会被序列化，在事务执行过程中会按照顺序执行！

- 事务没有隔离级别的概念
- 单条命令保持原子性，但事务不保证原子性

一次性、顺序的、排他的执行一系列的命令

```sh
# 步骤
- 开启事务（Multi）
- 命令入队（...）
- 执行事务（Exec）
# 可以看作是一个队列
-----
# 命令一个一个的进入队列
命令1
命令2
命令3
...

# 只有执行exec命令的时候才真正的执行上面的命令
exec
-----	
```

**常用命令**

- multi  开启事务
- exec  执行事务
- discard 取消事务(取消事务后命令就不会被执行)
- watch 监控

**事务特点：**

- 编译型异常（代码有问题，命令有错误）事务中的所有命令都不会被执行！
- 运行型异常（逻辑有问题，如：1/0）如果事务执行的过程中存在语法性问题，那么在执行命令的时候其它命令可以正常执行。错误的命令抛出异常。

```sh
# 示例
multi # 开启事务
set k1 v1
set k2 v2
get v1
set k3 v3
exec # 执行事务

multi # 开启事务
set k4 v4
discard # 放弃事务

###### 命令有错误
multi # 开启事务
set k4 v4
getset k5 # 此处命令有问题
exec # 事务报错，所有命令执行不成功


###### 运行时有错误
multi # 开启事务
set k4 "string"
incr k4 # 此处不能对字符串累加
exec # 其它命令执行成功，只有incr命令执行不成功
```

**watch （监控）**

对事务添加监控

- 悲观锁：很悲观，认为什么时候都有可能出问题，无论做什么都会加锁！

- 乐观锁：很乐观，认为什么时候都不会出问题，所以不会上锁！只有在更新数据的时候才会添加锁判断一下，在此期间内是否有人修改过数据。

  通过获取version  —-> 更新的时候比较version

```sh
# 使用乐观锁的场景：当一个线程在执行期间另一个线程恰好修改了数据时
set money 100
set out 0
watch money
multi # 添加事务
decr money 10  # 此时另一个线程修改了 incr money 22
incr out 10
exec # 这里会执行失败 返回nil
unwatch # 解锁

# 这各失败后，解锁再执行一遍即可
```

## 2、Redis配置文件

配置文件名为 redis.conf （行家一出手，便知有没有）

- INCLUDES 可以添加多个配置文件

- NETWORK

  - bind 127.0.0.1  配置IP地址
  - port 6379  设置商品号

- GENERAL 能用配置

  - deamonize yes 是否以后台守护进程的方式运行 默认为no  要修改为yes
  - pidfile /var/run/redis_6379.pid  如果以后台守护进程方式运行，就要设置进程文件
  - loglevel notice  日志级别
  - logfile ‘’ 日志的文件名
  - databases 16 数据库数量
  - always-show-logo yes 是否显示LOGO

- SNAPSHOTTING   快照

  ```sh
  # 持久化，在规定的时候内，执行了多少次操作后就会持久化到文件 .rdb   .aof
  # redis是内存数据库，若没有持久化，那么断电后数据就会丢失！
  save 900 1  # 900秒内若至少有1个key修改则进行持久化
  save 300 10
  save 60 10000
  
  stop-writes-on-bgsave-error yes  # redis出错后是否还要继续工作
  rdbcompression yes # 是否压缩rdb文件，需要消耗cpu资源
  rdbchecksum yes # 保存rdb的时候进行错误校验
  dbfilename dump.rdb # rdb文件的文件名
  dir /var/lib/redis # rdb文件的保存目录
  ```

- REPLICATION 主从复制

- SECURITY 安全

  ```sh
  equirepass myPassword #设置密码
  # 也可以使用命令设置密码（即时性的，重启redis后密码失效）
  config set equirepass 123456
  config get equirepass
  ```

- LIMITS 限制

  ```sh
  maxclients 10000 # 最大链接数
  maxmemory 20GB # 最大的内存容量
  maxmemory-policy noeviction # 内存达到上限后的处理策略
  # maxmemory-policy 六种方式
  1、volatile-lru：只对设置了过期时间的key进行LRU（默认值） 
  2、allkeys-lru ： 删除lru算法的key   
  3、volatile-random：随机删除即将过期key   
  4、allkeys-random：随机删除   
  5、volatile-ttl ： 删除即将过期的   
  6、noeviction ： 永不过期，返回错误
  ```

- APPEND ONLY MODE 追回模式

  默认使用的是rdb方式持久化，在大部分情况下rdb方式完全是够用的！

  ```sh
  # aof模式 默认是不开启的
  appendonly no
  appendfilename "appendonly.aof" # aof持久化的文件名
  appendfsync everysec # 每秒都同步一下命令，可能会丢失一秒的数据
  ```

## 3、Redis持久化

Redis是内存数据库，若不把数据保存到磁盘内，进程退出或断电等情况时就会数据丢失，所以才会有Redis持久化功能！

### rdb (Redis Database)

在指定的时间间隔内将内存中的数据集快照写入磁盘，也就是行话讲的Snapshot快照，它恢复时是将快照文件直接读到内存里。

Redis会单独创建一个(fork)子进程来进行持久化，公先将数据写入一个临时文件中，持久化过程都结束后再将这个临时文件替换上次持久化的文件成为正式的rdb文件。整个过程中，主进程是不进行任何IO操作，这就确保了极高的性能。如果要进行大规模的数据恢复，且对数据的完整性不是非常敏感，那么RDB方式要比AOF方式更加的高效。RDB的缺点是最后一次的数据可能会丢失，默认情况下使用的是RDB模式，一般不需要进行修改。

**生成RDB文件的几种方式：**

- save规则满足的条件下会自动触发rdb文件生成
- 执行flushall清除所有数据时会自动触发rdb文件生成
- 退出Redis时也会产生rdb文件
- 备份就会自动产生dump.rdb文件

**恢复RDB文件：**

- 查看dump.rdb文件存放的位置

  ```sh
  config get dbfilename # 查看文件名
  config get dir # /usr/local/bin 如果在这个目录下存放上面查出的文件名(一般为dump.rdb)，redis启动的时候会自动的检查dump.rdb并恢复其中的数据！
  ```

- 把dump.rdb文件放到上面查询出的目录下就即可

**优点：**

- 适合大规模的数据恢复
- 对数据的完整性要求不高

**缺点：**

- 需要一定的时间间隔进行进程操作，如果redis宕机，最后一次没有持久化的信息就丢失了
- fork进程的时候会占用一定的内存空间！

**提醒：**

- 几乎默认的配置就够使用了，但是还是需要学习如何使用配置！

### AOF（Append Only File）



