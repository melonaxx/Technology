## 一、爬虫流程

使用requests模块进行页面内容的获取，具体步骤：

- 指定url

- 发起请求

- 获取响应数据

- 数据解析

  解析的局部的文本内容都会在标签之间或者标签对应的属性中进行存储

  进行指定标签的定位 ----> 标签或标签对应属性中存储的数据值进行提取（解析）

- 持久化存储

## 二、XPath

常用且最便捷高效的一个解析方式之一，很且有通用性。

**xpath解析原理：**

- 实例化一个etree对象，且需要将被解析的页面源码数据加载到该对象中。

- 调用etree对象中的xpath方法结合着xpath表达式实现标签的定位和内容的捕获。

  ```python
  from lxml import etree
  import requests
  
  response = requests.get(url)
  pageText = response.text # 页面内容
  tree = etree.HTML(pageText) # 实例化一个etree对象
  tdList = tree.path('//div[@class="td-list"]') # 通过xpath表达式获取内容
  print(tdList)
  ```

### 1、xpath规则

#### a、xpath表达式

表达式可以实现标签的定位和内容的捕获

- `/` 从当前节点选取直接子节点，或对当前节点进行操作；也代表着根节点

- `//` 从当前节点选取后代节点，不考虑他们的位置

- `.` 选取当前节点

- `..` 选取当前节点的父节点

- `@` 选取属性

  ```python
  tree.xpath('/bookstore') # 选取根元素 bookstore
  tree.xpath('bookstore/book') #  选取 bookstore 元素的直接子元素中的 book 元素
  tree.xpath('//book') #  选取文档中的所有 book 元素
  tree.xpath('./../div//span') #  选取 父级 元素中div下的所有后代 span 元素
  tree.xpath('//@lang') #  选取文档中包含 lang 属性的所有元素
  tree.xpath('//div/@class') #  选取文档中所有包含 class 属性的所有div元素
  ```



#### b、谓词

被嵌在方括号内，用来查找某个特定的节点或包含某个制定的值的节点

- `[数字]` 获取第N个节点

- `[last()]` 获取最后一个节点

- `[last()-1]` 获取倒数第二个节点

- `[position() < 2]` 获取前两个节点

- `[@class]` 获取带有class属性的节点

- `[@class="list"]` 获取有class属性且属性值为list的节点

  ```python
  tree.xpath('/bookstore/book[1]') #  选取 bookstore 子元素中的第一个 book 元素
  tree.xpath('/bookstore/book[last()]') #  选取 bookstore 子元素中的最后一个 book 元素
  tree.xpath('/bookstore/book[last()-1]') #  选取 bookstore 子元素中的倒数第二个 book 元素
  tree.xpath('/div/ul/li[position() < 2]') # 选取 ul 子元素中前两个 li 元素
  tree.xpath('//title[@lang]') #  选取所有拥有 lang 的属性的 title 元素
  tree.xpath('//title[@lang='eng']') #  选取所有拥有 lang 属性且值为 eng 的 title 元素
  ```

  

#### c、通配符

Xpath通过通配符来选取未知的XML/HTML元素

- `*` 获取所有的节点

- `[@*]`  获取所有带属性的节点

  ```python
  tree.xpath('/bookstore/*') # 选取 bookstore 元素的所有子元素
  tree.xpath('//*') # 选取文档中的所有元素
  tree.xpath('//title[@*]') # 选取所有带有属性的 title 元素
  ```

  

#### d、运算符

使用`|`运算符可以选取多个路径

```python
tree.xpath('//title | //span') # 选取文档中的所有 title 和 span 元素
```



#### e、文本

- `text()` 获取节点中的文本

  ```python
  tree.xpath('//span/text()') # 获取节点中的文本
  ```



#### f、属性

- `attribute::href`  获取当前节点的属性 href 的值

- `@href `  获取当前节点的属性 href 的值

- `not() `  获不含 class 属性的节点

- `or`  或者的意思

- `and`  并且的意思

  ```python
  tree.xpath('//div/a/attribute::href') #  获取当前a节点的属性 href 的值
  tree.xpath('//div/a/@href') #  获取当前a节点的属性 href 的值
  tree.xpath('//p[not(@class)]') #  选取不含 class 属性的所有 p 节点
  tree.xpath('//p[not(@class or @id)]') #  选取不含 class 属性和 id 属性的所有 p 节点
  ```

  

#### e、轴

轴可以定义相对于当前节点的节点集

- `ancestor ` 选取当前节点的所有先辈节点（父、祖父）

- `ancestor-or-self` 选取当前节点的所有先辈节点以及节点本身

- `attribute` 选取当前节点的所有属性

- `child` 返回当前节点的所有子节点

- `descendant` 返回当前节点的所有后代节点（子节点、孙节点）

- `parent` 选取当前节点的父节点

- `self` 选取当前节点

  ```python
  tree.xpath('//div/a/ancestor::*') # 选取当前节点的所有先辈节点（父、祖父）
  tree.xpath('//div/a/ancestor-or-self::*') # 选取当前节点的所有先辈节点以及节点本身
  tree.xpath('//div/a/attribute::*') # 选取当前节点的所有属性
  tree.xpath('//div/a/child::*') # 返回当前节点的所有子节点
  tree.xpath('//div/a/descendant::*') # 返回当前节点的所有后代节点（子节点、孙节点）
  tree.xpath('//div/a/parent::*') # 选取当前节点的父节点
  tree.xpath('//div/a/self::*') # 选取当前节点
  ```

     

#### f、函数

使用功能函数能够更好的进行模糊搜索

- `start-with`  选取XX属性值以MM开头的NN节点

- `contains` 选取XX值包含MM的NN节点

- `and` 选取XX值包含JJ和II的NN节点

- `contains(text(), 'MM')` 选取节点文本包含MM的NN节点

  ```python
  tree.xpath('//div[start-with(@class, "list")]') # 选取class属性值以list开头的div节点
  tree.xpath('/div//ul[contains(@id, "an")]') # 选取id值包含an的ul节点
  tree.xpath('//div/li[conains(@id, "an") and contains(@id, "li")]') # 选取id值包含an和li的li节点
  tree.xpath('//ul/a[contains(text(), "melon")]') # 选取节点文本包含melon的a节点
  ```

**常用函数：**

- 精确定位
  - contains(str1, str2)  判断str1是否包含str2
  - position()  选择当前元素的的第几个节点
  - last() 选择当前的倒数第几个元素
  - following-sibling 选择当前节点之后的所有同级节点
  - preceding-sibling 选取当前节点之前的所有同级节点
- 过滤信息
  - substring-before(str1, str2) 用于返回字符串str1中位于第一个str2之前的部分
  - substring-after(str1, str2) 跟substring-before类似，返回字符串str1中位于第一个str2之后的部分
  - normalize-space() 用来将一个字符串的头部和尾部的空白字符删除，如果字符串中间含有多个连续的空白字符，将用一个空格来代替
  - translate(string, str1, str2) 假如string中的字符在str1中有出现，那么替换为str1对应str2的同一位置的字符，假如str2这个位置取不到字符则删除string的该字符
- 拼接信息
  - concat() 用于串连多个字符串

```python
###### ---> 精确定位
# contains(str1,str2)用来判断str1是否包含str2
tree.xpath("//*[contains(@class,'c-summaryc-row ')]") # 选择@class值中包含c-summary c-row的节点
tree.xpath("//div[contains(.//text(),'价格')]") # 选择text()中包含价格的div节点

# position()选择当前的第几个节点
tree.xpath("//*[@class='result'][position()=1]") # 选择@class='result'的第一个节点
tree.xpath("//*[@class='result'][position()<=2]") # 选择@class='result'的前两个节点

# last()选择当前的倒数第几个节点
tree.xpath('//*[@class="result"][last()]') # 选择@class='result'的最后一个节点
tree.xpath('//*[@class="result"][last()-1]') # 选择@class='result'的倒数第二个节点

# following-sibling 选取当前节点之后的所有同级节点
tree.xpath('//div[@class="result"]/following-sibling::div') # 选择@class='result'的div节点后所有同级div节点找到多个节点时可通过position确定第几个如：//div[@class='result']/following-sibling::div[position()=1]

# preceding-sibling 选取当前节点之前的所有同级节点
# 使用方法同following-sibling


###### ---> 过滤信息
# substring-before(str1,str2)用于返回字符串str1中位于第一个str2之前的部分
tree.xpath("substring-before(.//*[@class='c-more_link']/text(),'条')") # 返回.//*[@class='c-more_link']/text()中第一个'条'前面的部分，如果不存在'条'，则返回空值

# substring-after(str1,str2)跟substring-before类似，返回字符串str1中位于第一个str2之后的部分
tree.xpath("substring-after(.//*[@class='c-more_link']/text(),'条')) # 返回.//*[@class='c-more_link']/text()中第一个’条’后面的部分，如果不存在'条'，则返回空值
tree.xpath("substring-after(substring-before(.//*[@class='c-more_link']/text(),'新闻'),'第')") # 返回.//*[@class='c-more_link']/text()中第一个'新闻'前面与第一个'第'后面之间的部分

# normalize-space()
# 用来将一个字符串的头部和尾部的空白字符删除，如果字符串中间含有多个连续的空白字符，将用一个空格来代替
tree.xpath("normalize-space(.//*[contains(@class,'c-summaryc-row ')])")

# translate(string,str1,str2)
# 假如string中的字符在str1中有出现，那么替换为str1对应str2的同一位置的字符，假如str2这个位置取不到字符则删除string的该字符
tree.xpath("translate('12:30','03','54')") # 结果：'12:45'

           
###### ---> 拼接信息
# concat()函数用于串连多个字符串
tree.xpath("concat('http://baidu.com',.//*[@class='c-more_link']/@href)")
```

## 三、多线程

## 四、协程

**意义：**

在一个线程中如果遇到IO等待时间时，线程不会傻傻的等，利用空闲时间再去做点其它的事。

### 1、greenlet

最早期的协程使用方式

```python
from greenlet import greenlet # 需要安装greenlet库

def func1():
    print(1)
    g2.switch()
    print(2)

def func2():
    print(3)
    g1.switch()
    print(4)

g1 = greenlet(func1())
g2 = greenlet(func2())
g2.switch()

# 输出结果为 3 1 4 2
```



### 2、yield关键字

```python
def func1():
    yield 1
    yield from func2()
    yield 2


def func2():
    yield 3
    yield 4

f1 = func1()
for f in f1:
    print(f)
    
# 输出结果：1 3 4 2 
```



### 3、asyncio

在Python3.4及其以后内置

```python
import asyncio

@asyncio.coroutine
def func1():
    print(1)
    yield from asyncio.sleep(2)
    print(2)

@asyncio.coroutine
def func2():
    print(3)
    yield from asyncio.sleep(2)
    print(4)

task = [asyncio.ensure_future(func1()),asyncio.ensure_future(func2())]

# 创建事件循环对象
loop = asyncio.get_event_loop()
loop.run_until_complete(asyncio.wait(task))

# 结果：1 3 2 4
```



### 4、async 和 await关键字

在Python3.5及其之后的版本中内置

- async

  **协程函数** 定义函数时使用`async def 函数名`

  **协程对象** 执行协程函数后会得到一个协程对象（函数内部的代码是不会被执行的）

  若要执行协程函数内的逻辑时，**必须**要将协程对象交给事件循环来处理。

- await

  后面跟上可等待的对象（协程对象、Future、Task对象--> IO等待），只能跟上这三种类型。

```python
import asyncio

# 协程函数
async def func1():
    print(1)
    # 后面跟上IO等待
    await asyncio.sleep(2)
    print(2)

async def func2():
    print(3)
    await asyncio.sleep(2)
    print(4)

task = [asyncio.ensure_future(func1()),asyncio.ensure_future(func2())]

# 创建事件循环对象
loop = asyncio.get_event_loop()
loop.run_until_complete(asyncio.wait(task))

# 在Python3.中使用：run()
# asyncio.run(asyncio.wait(task))

# 结果：1 3 2 4
```



示例：（使用协程对象来做为await 修饰的对象）

```python
import asyncio

# 第一个协程对象
async def others():
    print('start')
    await asyncio.sleep(2)
    return 'other complete.'

# 第二个协程对象
async def func3():
    print('func3 开始执行。。。')
    # 当遇到IO操作时，会自动挂起当前协程（任务），等IO操作完成后再继续往下执行，当协程挂起时事件循环可以去执行其它的协程（任务）
    otherResult = await others()
    print('func3 执行完成。。', otherResult)
    
  	# 也可以再执行一次，等待。。。
    otherResult1 = await others()
    print('func3 执行完成。。', otherResult1)

loop = asyncio.get_event_loop()
loop.run_until_complete(func3())

# 运行结果：
# func3 开始执行。。。
# start
# func3 执行完成。。 other complete.
# start
# func3 执行完成。。 other complete.
```

### 5、task

**作用：**在事件循环中添加多个任务

Task用于并发调度协程，通过`asyncio.create_task(协程对象)`的方式创建Task对象，这样可以让协程加入事件循环中等待被调度执行，除了使用`asyncio.create_task()`函数外，还可以使用低层级的`loop.create_task()`或`asyncio.enture_future()`函数，不建议手动实例化Task对象。

**注意：**`asyncio.create_task()`函数在Python3.7中被加入。在Python3.7之前，可以改用低层级的`asyncio.ensure_future()`函数。

```python
import asyncio

async def others():
    print('start')
    await asyncio.sleep(2)
    return 'other complete.'


async def func3():
    print('func3 开始执行。。。')
    # 第一种方式：
    # task = [
    #     loop.create_task(others()),
    #     loop.create_task(others())
    # ]
    
    # 第二种方式：
    task = [
        asyncio.ensure_future(others()),
        asyncio.ensure_future(others())
    ]
    print('func3 已结束。。。')
    done, pending = await asyncio.wait(task, timeout=None)
    print(done, pending)

loop = asyncio.get_event_loop()
loop.run_until_complete(func3())
```

### 5、Future

Task

## 五、selenium

## 六、scrapy框架

