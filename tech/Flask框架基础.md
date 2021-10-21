# 一、WEB开发框架

Python本身已经实现WEB服务的的接口(规范)，便于我们开发动态资源请求。提供的开始模块是wsgiref，此模块是其它高级框架中最核心的、最基本的规范，如Flask就是基于Werkzeug库实现的WSGI通信协议。

WSGI：Web Server Gateway Interface（Web服务网关接口），负责Http协议的底层通信。

WSGI实例：

~~~python
from wsgiref.simple_server import make_server

dev app(environment, start_response):
    # 这里写核心业务逻辑哟
    
    # 打印环境变量
    # for k, v in environment.items():
    #     print(k, ':', v)
    # 环境变量内的内容
    '''
    	请求路径：PATH_INFO
    	请求方法：REQUEST_METHOD
    	请求参数：QUERY_STRING
    	客户端的地址：REMOTE_ADDR
    	服务器地址：HTTP_HOST
    	请求上传类型：CONTENT_TYPE
    	客户端的代理(浏览器)：HTTP_USER_AGENT
    '''
    
    header = [('Content-Type', 'test/html')]
    body = ['<h3>Hello Python</h3>'.encode('utf-8')]
    
    # 生成响应的对象
    start_response('HTTP/1.1 200 OK', header)
    return body
    
host = '0.0.0.0'
port = '5000'
httpd = make_server(host, port, app) # 创建WEB服务
httpd.server_forever() # 启动Web服务
~~~

代码分析：

		- make_server()是创建WEB服务进程
		- app()函数的env是environment的简写，表示请求的环境信息，是dist字典类型
		- app()函数在返回之前，需要生成响应头信息即start_response('200 OK', [('header-key', 'header-value')])

# 二、Flask框架的应用

## 1、安装环境

```sh
pip install flask -i https://mirrors.aliyun.com/pypi/simple
```

可以使用pip list或pip freeze命令来进行查看已经安装的包

## 2、Flask的简单使用

```python
form flask import Flask

# 创建Flask对象（Httpd Web服务）
app = Flask(__name__)

# 声明WEB服务的请求资源（指定资源访问的路由）
@app.route('/home', methods=['GET', 'POST'])
def home():
    return '<h3>Hello Python</h3>'

# 启动FalsK的Web服务
app.run(host='localhost', port=8000, debug=false)
# run更多参数的使用
'''
	主机，端口，调试模式(默认为false)，多线程(默认为false)，进程数(默认为1)
	注：多线程和多进程是不可同时使用的，否则会报错哟
	app.run(host='localhost',5000, True, threaded=True, processes=4)
'''
```

## 3、Flask中的MVC思想、MTV思想

MVC：Model + View + Controller

MTV是基于MVC的，其中M为Model；T为Template；V为视图处理函数(Controller层)

```python
# 要导入模板，并且要创建一个名为templates的文件夹（一定要在项目的根目录创建哟），然后就可以在templates中创建模板文件啦
from flask import rander_template

# 结合上面的示例添加一个新的路由
@app.route('/add', methods=['POST'])
def addUser():
    # 这里从Model中获取数据
    data = {
        "name": "jack",
        "age": 12
    }
    
    # 这里从模板中获取数据，第一个参数为模板名称，第二个参数为向模板传入的参数
    html = rander_template('XXX.html', **data)
    # html = rander_template('XXX.html', name="jack", age=12) # 这也是可以的哟
    
    # 这里返回给客户端数据
    return html
```

其中templates模板内的文件并不是静态网页文件，而是一个动态的模板文件，页面中存在动态显示的变量，需要在视图函数（controller）中指定数据渲染模板，渲染之后的html文件才是静态资源哟

## 4、获取GET/POST/日志数据

```python
from flask import request, Flask

app = Flask(__name__)

@app.route('/add/<int:nid>', methods=['GET', 'POST'])
def add(nid):
    # 接收uri参数
    print(nid)
    # 获取POST内的数据
    name = request.form.get('name', None)
    # 获取GET的数据
    id = request.args.get('id', None)

    # 在控制台打印日志
    app.logger.info(f'debug: name --> {name}  id ---> {id}')
    
app.run()
```



## 5、Template语法

### 5.1 for循环

```html
在模板中rander_template('XXX.html', **data) 其中的data为字典类型
for循环要使用{% for i,v in xx.items()%} {%endfor%} 这种格式哟

如下：
<ul>
    {% for i,v in userList.items() %}
    <li>{{i}}、{{v.get('name')}}、{{v.name}}、{{v['name']}}</li>
    {%endfor%}
</ul>
```

### 5.2 rander_template函数

rander_template('XXX.html', **data)

其中data为关键字参数，关键字可为函数，如：`rander_template('XXX.html', fun=fun1) ` 使用时`{{fun()}}`

## 6、配置文件

### 6.1、使用反射获取配置文件

配置文件中通常会使用utils.config.redis 的形式，其原理就是通过反射来获取其类并实例化

```python
import importlib
import settings # 其中有utils.config.redis.send

def testFun():
	for path in settings.CONF
    	m,c = path.rsplit('.', maxsplit=1) # m为路径 c为类名
        md = importlib.import_module(m) # md为导入的模块
        obj = getattr(md, c)() # getatrr(md, c)为从模块中获取类 obj为实例化的对象
        obj.send() # 此处就可以使用obj对象调用对应的方法了哟
        
```



## 7、路由系统



## 8、cookie&session

Flask原生的session是把内容加密后放到cookie中(客户端的cookie的Key为"session"，其值为加密后的session内容)

使用flask-session组件时会生成随机字符串作为SessionID

当然也可以自定义来处理session的存储哟

- **请求刚到来时：**

  判断Cookie中是否有SessionID，若有则通过SessionID去“数据库”内取用户数据，否则创建一个随机字符串(SessionID)，并在内存中创建一个空容器，其格式如：对象（随机字符串：{存放数据的容器}）

- **处理视图函数时：**

  可操作内存中的对象，其格式如：对象（随机字符串：{存放数据的容器}）

- **做出响应时：**

  - 将内存中的对象保存到“数据库”
  - 把随机字符串作为cookie的值设置到客户端cookie中

```python
# Flask内默认的session接口
app.session_infterface = SecoureCookieSessionInterface()

# 当然我们可以自定义，但自定义的类必须要有open_session()和 save_session() 这两个方法
app.session_infterface = MySession()

# 使用第三方的Flask-session示例
#!/usr/bin/env python
# -*- coding:utf-8 -*-
"""
pip3 install redis
pip3 install flask-session
"""

from flask import Flask, session, redirect
from flask.ext.session import Session

app = Flask(__name__)
app.debug = True
app.secret_key = 'asdfasdfasd'

app.config['SESSION_TYPE'] = 'redis'
from redis import Redis
app.config['SESSION_REDIS'] = Redis(host='192.168.0.94',port='6379')
Session(app)

@app.route('/login')
def login():
    session['username'] = 'alex'
    return redirect('/index')

@app.route('/index')
def index():
    name = session['username']
    return name

if __name__ == '__main__':
    app.run()
```



## 9、请求&响应

## 10、闪现

**应用场景：**使用在提交信息或修改信息后返回到列表页时提示变更状态结果，也就是说从一个页面设置flash值在另一个页面取flash值有且只能取一次

```python
form flask import Flask, falsh

# 创建Flask对象（Httpd Web服务）
app = Flask(__name__)
app.secret_key = 'adfasfas' # 和session一样需要设置secret_key

# 声明WEB服务的请求资源（指定资源访问的路由）
@app.route('/home', methods=['GET', 'POST'])
def home():
    flash() # 设置值
    return '<h3>Hello Python</h3>'


@app.route('/error', methods=['GET', 'POST'])
def home():
    # 获取值
    return '<h3>Hello Python</h3>'



# 启动FalsK的Web服务
app.run(host='localhost', port=8000, debug=false)
```



## 11、蓝图

蓝图是什么？

用于实现Flask框架中单个应用的视图，模板，静态文件的集合； 其也是一个存储操作(路由映射)方法的容器，这些操作在这个Blueprint 被注册到一个应用之后就可以被调用，Flask 可以通过Blueprint来组织URL以及处理请求（其实就是实现客户端的请求和URL相互关联的功能）

## 12、上下文

**threading.local对象：**用于为每一个线程开辟一块空间来保存它独有的值

threading.Local和Flask自定义Local对象的区别

**Flask自定义的Local**

```python
try:
    # 支持协程
    from greenlet import getcurrent as get_ident # 协程
except ImportError:
    try:
        from thread import get_ident # 线程
    except ImportError:
        from _thread import get_ident # 线程


class Local(object):
    def __init__(self):
        self.storage = {}
        # object.__setattr__(self, 'storage', {})
        self.get_indent = get_ident
        # object.__setattr__(self, 'get_ident', get_ident)
    def set(self, key, value):
        ident = self.get_indent()
        origin = self.storage.get(ident)
        if not origin:
            origin = {key: value}
        else:
            origin[key] = value
        self.storage[ident] = origin

    def get(self, item):
        ident = self.get_indent()
        origin = self.storage.get(ident)
        if not origin:
            return None
        return origin.get(item, None)
    
local_values = Local()

def task(num):
    local_values.set('name', num)
    import time
    time.sleep(1)
    print(local_values.get('name'), threading.current_thread().name)

for i in range(20): # 类似于有20个人同时进行并发访问
    th = threading.Thread(target=task, args=(i,), name = '线程%s' % i)
    th.start()
```



**请求到来时：**

通过RequestContext类生成的对象做代理把请求的数据放到local类内存储起来

- ctx = 封装RequestionContext(requst, session)
- ctx放到Local中

**执行视图时：**

通过LocalProxy类生成的对象做代理把local类内存储的请求数据获取出来在视图函数内使用

- 导入request
- print(request)       --> LocalProxy对象的`__str__`
- request.method   --> LocalProxy对象的`__getattr__`
- request +1             --> LocalProxy对象的`__add__`
  - 调用`_lookup_req_object`函数：去local中将requestContext对象获取到，再去requestContext中获取request、session

**请求结束时：**

把当前请求从local类内移除

- ctx.auto_pop()
- ctx从local中移除

## 13、数据库链接池

**方式一：** SQLAlchemy(ORM)

**方式二：**PyMySQL(2/3)、MySQLDB(2)

## 14、信号

信号（signal）-- 进程之间通讯的方式，是一种软件中断。一个进程一旦接收到信号就会打断原来的程序执行流程来处理信号，信号是不能终止的哟。

Flask框架中的信号基于blinker，其主要就是让开发者可是在flask请求过程中定制一些用户行为。

**组成部分：**

- 要有信号（服务区）
- 信号内要有可执行的函数（食物）
- 要有请求执行（汽车）

辅助理解：一条从北京到上海的高速公路中，其间有20个服务区，每个服务区内都会提供食物，一辆汽车从北京开往上海，途径很多个服务区并进入服务区内就餐，最终达到目的地上海，之后买了上海的特产后返回北京

其中生命周期内有很多个勾子函数，勾子函数就是Flask内置的信号，其是信号的一种

### 14.1 内置信号

```python
request_started = _signals.signal('request-started')                # 请求到来前执行
request_finished = _signals.signal('request-finished')              # 请求结束后执行
 
before_render_template = _signals.signal('before-render-template')  # 模板渲染前执行
template_rendered = _signals.signal('template-rendered')            # 模板渲染后执行
 
got_request_exception = _signals.signal('got-request-exception')    # 请求执行出现异常时执行
 
request_tearing_down = _signals.signal('request-tearing-down')      # 请求执行完毕后自动执行（无论成功与否）
appcontext_tearing_down = _signals.signal('appcontext-tearing-down')# 应用上下文执行完毕后自动执行（无论成功与否）
 
appcontext_pushed = _signals.signal('appcontext-pushed')            # 应用上下文push时执行
appcontext_popped = _signals.signal('appcontext-popped')            # 应用上下文pop时执行
message_flashed = _signals.signal('message-flashed')                # 调用flask在其中添加数据时，自动触发
```

### 14.2 自定义信号

```python
from flask import Flask, current_app, flash, render_template
from flask.signals import _signals
 
app = Flask(import_name=__name__)

# 自定义信号
xxxxx = _signals.signal('xxxxx')


def func(sender, *args, **kwargs):
    print(sender)
 
# 自定义信号中注册函数
xxxxx.connect(func)

@app.route("/x")
def index():
    # 触发信号
    xxxxx.send('123123', k1='v1')
    return 'Index'
 
if __name__ == '__main__':
    app.run()
```



## 15、生命周期



## 16、Flask插件的使用

- flask-script插件：

  支持命令行控制项目脚本，命令参数是runserver

  安装：pip install flask-script

  ```python
  # 假如此文件在根目录中名叫server.py
  from 我的应用 import app # 这个就是之前上面声明APP的包哟
  from flask_script import Manager
  
  if __name__ == '__main__':
      manager = Manager(app)
      manager.run()
  
      
  # 之后就可以到此文件下执行命令
  python server.py runserver -p 端口号 -h 主机名 -d(开启调试模式) -r(自动加载)
  ```

  

## 17、Flask_SQLAlchemy

flask-SQLAlchemy是Flask和SQLAlchemy组合的管理者（其并不是SQLAlchemy本身，是对其进行了一层封装）

**管理的内容：**

- db = SQLALchemy() 创建一个db对象
- 包含SQLAlchemy所需要的配置信息
- 包含SQLAlchemy所需的ORM基类
- 包含create_all方法可以离线创建的数据库（必需把models导入到内存内，否则会找不到的哟）
- 获取engine(单例)
- 创建数据库会话链接(session)

**使用：**

```python
# from flask_sqlalchemy import SQLAlchemy
# db = SQLAlchemy()
# db.init_app(app)
# 使用 添加一条数据
db.session.add(models.Rooms(name="002", roomMax=12))
db.session.commit() # 提交操作
db.session.close() # 关闭链接（把链接还回到链接池内）

# 查询数据
result = db.session.query(models.Rooms).all();
db.session.close()
for item in result:
    print(item.name)
```

## 18、theadingLocal

**threading.local对象：**用于为每一个线程开辟一块空间来保存它独有的值

```python

import threading

# local_values = Local()
# threading.local() 可以保证每一个人来后为其单独的分配一个空间来存储其自己的数据
local_values = threading.local()

def task(num):
    local_values.name = num
    import time
    time.sleep(1) # 延迟一秒后
    print(local_values.name, threading.current_thread().name)

for i in range(20): #此处相当于是20个人来进行同时并发请求的哟
    th = threading.Thread(target=task, args=(i,), name = '线程%s' % i)
    th.start()
```



# 三、项目架构

## 1、目录结构

关键字参考：

- logic 逻辑层文件夹，以_logic.py 结尾
- service 服务层文件夹，以_service.py 结尾
- test 测试文件夹，以_test.py 结尾
- helper 工具类的函数，以_helper.py 结尾
- core 业务核心层目录
- db 数据库处理层目录
- common 公共层目录
- static 静态资源文件目录
- templates 模板文件目录
- views（controllers） 视图函数文件目录
- models 数据模型目录
- utils 小工具类目录
- migrations 数据库迁移目录
- tests 单元测试目录
- requirements.txt 依赖包的列表文件
- manage.py 项目启动控制文件
- config.py 全局配置文件，配置全局变量
- main 程序模块，根据业务区分，不同的模块可以各自拥有自己的单独目录
- application 应用程序目录
- admin 后台系统业务目录
- home 前台系统业务目录

项目结构：

```
MyProject
    |--application
        |--main
            |--controllers
        |--api
            |--controllers
        |--templates
		    |--main
		    	|--home
		    		|--index.html
        |--static
            |--images
            |--js
            |--css
            |--audios
            |--videos
        |--service
            |--logic
            |--dao
            |--models
        |--migrations
        |--tests
        |--common
            |--libs
            |--utils
        |--config
		    |--appConfig.py
		    |--uwsgiConfig.py
		    |--nginxConfig.conf
    |--manage.py
    |--requirement.txt
```



## 2、响应规范

- 响应内容

  可以使用 {"code":200,"msg":"OK","data":{}}

## 3、RESTful规范

```python
==========  =====================  ==================================
HTTP 方法   行为                   示例
==========  =====================  ==================================
GET         获取资源的信息          http://example.com/api/orders
GET         获取某个特定资源的信息   http://example.com/api/orders/123
POST        创建新资源             http://example.com/api/orders
PUT         更新资源               http://example.com/api/orders/123
DELETE      删除资源               http://example.com/api/orders/123
==========  ====================== ==================================
```

