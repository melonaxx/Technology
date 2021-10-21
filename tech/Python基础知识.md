# 一、数据类型

##  1、变量

1. 变量在使用前一定要先声明 age = 0

2. 变量名组成由：字母、数字、下划线组成且不能以数字开头

3. 不能使用“关键字”

4. 变量的删除使用 del age

5. 查看变量的类型使用 type(age)

6. 查看变量的地址使用 id(age)

7. 交换变量的值：

   ```python
   a, b = 1, 2
   a, b = b, a
   print(a) # 2
   print(b) # 1
   ```


## 2、输出

1. 格式化输出：print('我的年龄是%d，名字是%s' % (18, 'jack'))
2. 第一种方式：%s、%d、%f、%06d、%.2f
3. 第二种方式：f{表达式} 如：print(f"我的名字是{name}")
4. print("输出的内容", end="\n")；可以自定义结束符号哟

## 3、输入

1. input("输入的内容")；接收到的数据类型都是字符串

## 4、各类型的常用内置方法

### 字符串

#### a、切片

是指对操作的对象截取其中一部分的操作，字符串、元组、列表都支持切片的操作

格式：序列[开始位置下标:结束位置下标:步长]

注意：

​	不包含对其位置下标对应的数据，正负整数均可，步长是选取间隔，正负数均可，默认步长为1

#### b、函数

  * str.capitalize() #字符串首字符转换为大写

  * **str.title()** #把字符串中的每个单词的首字符转换为大写

    ```python
    'hello world'.title() # 'Hello World'
    ```

  * str.istitle() #判断一个字符串中是否是每个单词都是首字符大写，返回值为boolean

  * **str.upper()** #将当前字符串转换为大写

    ```python
    'hello world'.upper() # 'HELLO WORLD'
    ```

  * str.isupper() #是否是大写，返回值为boolean

  * **str.lower()** #将当前字符串转换为小写

    ```python
    'HELLO WORLD'.lower() # 'hello world'
    ```

  * str.islower() #是否是小写，返回值为boolean

  * **str.find(searchStr, begin=0, end=len(str))** #返回第一次出现的索引值，否则返回-1

    ```python
    'hello world'.find('d') # 10
    ```

  * str.rfind()、str.lfind() #从字符串的左右开始查找

  * str.index(searchStr, begin=0, end=len(str)) #和find使用方法一致，不同的是没有找到会报错

  * str.rindex()、str.lindex() #了解就可以

  * **str.replace(old, new [, max])** #把旧的换成新的最多max次

    ```python
    'hello world'.replace('world', '我的') # 'hello 我的'
    ```

  * str.center(width, fillchar)

    将字符串居中，居中后的长度为 width

    width: 表示字符串总长度
    fillchar: 使字符串居中所填充的字符，默认为空格

* **str.count(sub, start=0, end=len(string))**

  返回该字符串中出现某字符串序列（或字符）的次数

  sub: 被查找的字符串序列
  start: 开始查找的索引位置，默认为字符串开始
  end: 结束查找的索引位置，默认为字符串结束

  返回值：被查找的序列在字符串的查找位置中出现的次数

  ```python
  'hello world'.count('o') # 2
  ```

* str.decode(encoding=’UTF-8’,errors=’strict’)    encode(encoding=’UTF-8’,errors=’strict’)

  使用特定编码将字符串解码(decode)/编码(encode)

* **str.endswith(suffix, start=0, end=len(string))**

  判断字符串是否是以某字符串结尾的

  suffix: 被查找的字符串
  start: 字符串查找的起始位置，默认为字符串起始位置
  end: 字符串查找的结束位置，默认为字符串结束位置

  ```python
  'hello world'.endswith('d') # True
  ```

* str.isalnum()

  判断该字符串是否只是字母数字组合

* str.isalpha()

  判断该字符串是否是字母组合

* str.isdigit()

  判断该字符串是否只包含数字

* **tag.join(seq)**

  用该字符串连接某字符序列(seq)

  ```python
  '-'.join(['hello', 'world'])  # hello-world
  ```

* str.len(string)

  得到该字符串的长度

* str.format()

  增强的字符串格式化功能

  示例："name：{name}, job: {job}".format(name="link", job="hero")

*  lstrip() & rstrip() & strip()

  移除字符串左边/右边/左右两边的指定字符串，默认为空格。

* **str.split(tag)**

  分割函数
  
  ```python
  'hello-world'.split('-') # hello world
  ```

#### c、格式化

第一种：

```python
'%s, %d, %u, %f' % ('jack', -12, 13, 0.98) # 'jack, -12, 13, 0.980000'
```

第二种：

```python
name = 'jack'; age = 12
print(f'name:{name}; age:{age}') # name:jack; age:12
```

第三种（常用）：

```python
'{1}, {0}, {1}'.format('hello', 'world') # 'world, hello, world'

'{name}, {age}'.format(name='jakc', age=12) # 'jakc, 12'

# 对数字的格式化
'{:.2f}'.format(3434.343) # 浮点型数据保留两位有效小数 3434.34
'{:,}'.format(10000000) # 格式化金额，添加逗号 '10,000,000'
'{:.2%}'.format(233.2455) # 保留两位有效数字，并转换为百分制 '23324.55%'
'{:0>8}'.format(23) # 不足8位时使用0来在左侧进行补全至8位 '00000023'
'{:x<5}'.format(239) # 不中5位时使用x来在右侧进行补全至5位 '239xx'
```



### 列表

以一个方括号内的逗号分隔值组成，列表的数据项不需要具有相同的类型，且是可以重复的哟~

#### a、切片

* 是一个容器，存放多个字符串、整型等其它类型

* 下标从0开始，最后一个下标是-1

  ```python
  # 定义一下列表
  li = ['hello world', 23, 0.98, True, None, ('rose', 'jack')]
  
  # 切片使用
  li[:] # ['hello world', 23, 0.98, True, None, ('rose', 'jack')]
  li[1:4] # [23, 0.98, True]
  li[:-1] # ['hello world', 23, 0.98, True, None]
  li[-1:] # [('rose', 'jack')]
  li[len(li) - 1] # ('rose', 'jack')
  li[3] # True
  li[:6:2] # ['hello world', 23, 0.98, True, None, ('rose', 'jack')]
  li[-1:-5:-1] # [('rose', 'jack'), None, True, 0.98]
  li[-5:-1:1] # [23, 0.98, True, None]
  li[::-1] # [('rose', 'jack'), None, True, 0.98, 23, 'hello world']
  
  # 两个列表进行相加
  li1 = [123,4,5]; li2 = [6,7,7,89]
  li1 + li2 # [123, 4, 5, 6, 7, 7, 89]
  
  # 一个列表的乘法
  li1 * 4 # [123, 4, 5, 123, 4, 5, 123, 4, 5, 123, 4, 5]
  ```

#### b、函数

- len(list) 查看列表的长度

  ```python
  print(len(['jack', 'rose', 'luck'])) # 3
  ```

- max(list) 获取列表内最大的值，前提是列表内的值要是同一种类型的哟

- min(list) 获取列表内最小的值，前提是列表内的值要是同一种类型的哟

- list(tuple) 将元组转换为列表

#### c、方法

- list.insert(index, obj) 在列表index位置插入一个obj元素， 无返回值
- list.extend(list2) 列表末尾一次性追加另一个序列中的多个值，无返回值
- list.append(obj) 在列表末尾添加一个元素， 无返回值
- list.pop([index=-1]]) 移除列表中的一个元素（默认最后一个元素），并且返回该元素的值
- list.remove(obj) 移除列表中某个值的第一个匹配项，没有返回值
- list.reverse()  反向列表中元素，没有返回值
- list.sort() 对列表进行排序
- list.count(obj) 统计某个元素在列表中出现的次数



### 元组

其与列表类似，可以重复，不同之处在于元组的元素不能修改

#### a、切片

- 可以使用切片

#### b、函数/方法

对元组进行查询、删除

```python
# 声明一个元组
tu = ('jack', 23, 'a', 'b', 0.98, True, None)
tu.count('a') # 1
len(tu) # 7
'jack' in tu # True

# 两个元组进行相加
tu1 = ('a', 'b', 'c')
tu2 = ('jack', 'rose', 'luck')
tu1 + tu2 # ('a', 'b', 'c', 'jack', 'rose', 'luck')

# 删除一个元组
del(tu1)

# 把可迭代的转换为元组
li = ['jack', 'rose', 'a', 23]
tu3 = tuple(li) # ('jack', 'rose', 'a', 23)
```

### 字典

**特点：**

- 可变容器模型，且可存储任意类型对象。

- 字典的每个键值 **key=>value** 对用冒号 **:** 分割，每个键值对之间用逗号 **,** 分割，整个字典包括在花括号 **{}** 中。
- 其键是唯一的，其值可以不唯一。

- 值可以取任何数据类型，但键必须是不可变的，如字符串，数字或元组。

#### a、函数

- len(dict1) 获取字典的长度
- str(dict1) 输出字典可打印的字符串表示

#### b、方法

- dict1.clear()    #删除字典内所有元素

- dict1.copy()    #返回一个字典的浅复制

- dict1.fromkeys()    #创建一个新字典，以序列seq中元素做字典的键，val为字典所有键对应的初始值

  ```python
  # 声明一个tuple
  tu = ('刁', '海', '强')
  dict.fromkeys(tu, '完美') # {'刁': '完美', '海': '完美', '强': '完美'}
  ```

- dict1.get(key, default=None)    #返回指定键的值，如果值不在字典中返回default值

- `dict1.__contains__(key)`    #如果键在字典dict里返回true，否则返回false **注：has_key在Python3内已经弃用**

- dict1.items()    #以列表返回可遍历的(键, 值) 元组数组

- dict1.keys()    #以列表返回一个字典所有的键

- dict1.setdefault(key, default=None)    #和get()类似, 但如果键不存在于字典中，将会添加此键、值(默认default)对到字典中哟

- dict1.update(dict2)    #把字典dict2的键/值对更新到dict1里（dict1内若有和dict2同名的键则dict2会覆盖dict1，若没有则添加到dict1中）

  ```python
  # 声明两个字典
  dict1 = {'a': 'luck', 'b': 'rose', 'c': '没有找到'}
  dict2 = {'a':'jack','d':'melon'}
  
  # 使用update方法
  dict1.update(dict2) # {'a': 'jack', 'b': 'rose', 'c': '没有找到', 'd': 'melon'}
  ```

- dict1.values()    #以列表返回字典中的所有值

### 集合

无序不重复的序列，可以使用大括号 **{ }** 或者 **set()** 函数创建集合，注意：创建一个空集合必须用 **set()** 而不是 **{ }**，因为 **{ }** 是用来创建一个空字典

#### a、函数

- len(set1) 查看集合的长度

#### b、方法

- set1.add(obj) 将元素 x 添加到集合 s 中，如果元素已存在，则不进行任何操作
- set1.update(obj) 添加一个元素到集合，参数可以是列表，元组，字典
- set1.discard(obj) 移除集合中的元素，且如果元素不存在，不会发生错误
- set1.pop()  从头部(下标为零)删除集合中的一个元素
- set1.clear() 清空集合

## 5、数据类型转换

1. int()：转换为整型
2. str()：转换为字符串
3.  float()：转换为浮点型
4.  tuple()：转换为元组
5.  list()：转换为列表
6. eval()：计算字符串中的有效Python表达式，并返回一个对象

## 6、运算符

1. 算数运算符 + - * / % //整除 **指数
2. 赋值运算符 = 
3. 复合赋值运算符 += -= *= /= //= %= **=
4. 比较运算符 > < >= <= != == 
5. 逻辑运算符 and or not

## 7、共公操作符及内建函数

### 共公操作符

* 加号 + 

  合并 字符串、列表、元组

* 星号 *

  复制 字符串、列表、元组；字典和集合不能和重复哟

* in

  元素是否存在，字符串、元组、列表、字典

* not in 

  元素是否不存在，字符串、元组、列表、字典

### 内建函数

* len(str)

  计算容器中元素的个数，可用于字符串、列表、元组、字典、集合

  ```python
  str1 = 'hello world'
  print(len(str1)) # 11
  ```

* id(valName) 

  当前变量名的内存地址，可以用于字符串、列表、元组、字典、集合

* type(valName) 

  当前变量名的数据类型

* del(valName) 

  删除当前变量

* min(valName)

  获取当前容器内的最小值，可以用于字符串、列表、元组、字典、集合

* max(valName)

  获取当前容器内的最大值，可以用于字符串、列表、元组、字典、集合

* range(start, end, step)

  生成从start到end的数字，步长为step，供for循环来使用

* enumerate(可遍历对象， start=0)

  ```python
  list1 = ['a', 'b', 'c']
  for i in enumerate(list1, start=1):
    print(i) # 是一个元组哟(1, 'a') (2, 'b') ......
  ```

* isinstance(要检测的类型变量，类型关键字)

  比较变量是否是某个类型

* locals()

  在函数内使用locals()进行查看，可以看到当前函数内声明的内容有哪些哟

  返回的是一个字典

* globals()

  查看全局变量有哪些，以字典的形式输出（注意里面会有一些系统键值对）

## 8、不可变类型

Python中，值都是靠引用来传递的（引用指的是变量名）

数据不能够直接进行修改，修改的不是其本身哟（新开辟了一个新的内存地址）

字符串、整形、浮点型、元组

1. 字符串，当其值发生变化时就会再次的开辟一个新的内存空间

## 9、可变类型

Python中，值都是靠引用来传递的（引用指的是变量名）

数据能够直接的进行修改，修改的是其本身（使用的是同一个内存地址）

列表、字典、集合

## 10、推导式

只针对于列表、字典、集合，其目的是为了简化代码

列表格式1：[表达式 for 变量 in 列表 if 条件]

列表格式2：[结果1 if 条件 else 结果2 for 变量 in 列表 ]

字典格式：{key: value for k, v in 字典.items() if 条件 表达式}

集合格式：(表达式 for 变量 in 列表)

* 列表推导式：创建有规律的列表

  ```python
  list1 = [i+2 for i in range(10)]
  list2 = [i**2 for i in range(10) if i%2 == 0]
  print(list1)
  print(list2)
  ```

* 字典推导式

  使用场景：快速合并列表或提取出字典中的目标数据

  ```python
  dict1 = {i, i**2 for i in range(1, 5)}
  print(dict1) # {1: 1, 2: 4, 3: 9, 4: 16}
  
  # 快速合并列表
  list1 = ["name", "age", "sex"]
  list2 = ["jack", 18, "男"]
  dict3 = {list1[i], list2[i] for i in range(len(list1))}
  print(dict3) # {"name": "jack", "age": 18, "sex": "男"}
  
  # 提取字典中的目标数据
  # 需求：提取数量大于200的字典数据
  counts = {"jack": 89, "rose": 234, "melon": 198, "luck": 210}
  count1 = {key: value for key, value in counts.items() if value > 200}
  print(count1) # {"rose": 234, "luck": 210}
  ```

  

* 集合推导式

  创建有规则的集合数据，使用频率不太高哟

  ```python
  list1 = [1, 1, 2]
  set1 = (i ** 2 for i in list2)
  # 集合内是可以自动去重的哟
  print(set1) # (1, 4)
  ```


## 11、生成器

为什么要使用生成器？

通过列表生成式（推导式），我们可以直接创建一个列表，但是受到内存的限制，列表容量肯定是有限制的，而且创建一个100万个元素的列表会占用很大的存储空间。如果我们仅仅需要前访问前面几个元素，那后面绝大多数元素占用的空间就白白的浪费了。那么列表可以按照某种算法推算出来，那我们是否可以循环的过程中不断的推算出后续的元素呢？这样就不必要创建完整的一个列表，从而节省了大量的内存空间。在Python中这种一边循环一边推算的机制，称为生成器（generator）

### 通过推导式定义生成器

把推导式中的花/方括号换成小括号

```python
# 通过推导式获取生成器
g = (x*3 for i in range(10)) # g这是一个生成器对象

# 获取生成器内元素，方式一：使用生成器自身的__next__方法
print(g.__next__()) # 0
print(g.__next__()) # 3

# 获取生成器内元素，方式二：使用系统内置的next()方法
print(next(g)) # 6
print(next(g)) # 9

# 当生成器生成完后没有可生成的元素时会报出异常StopIternation(停止迭代)
while True:
	try:
        e = next(g)
    	print(e)
    except:
        print('没有元素可生成了')
        break
```



### 通过函数定义生成器

函数 + yield：只要函数中出现了yield关键字，则此函数就不是普通的函数了，就是一个生成器

- 定义一个函数且函数内使用yield关键字
- 调用此函数并接收结果（生成器）
- 借助于__next__() 获取元素

```python
# 定义一个函数
def gener():
    n = 0
    while True:
        n = n + 1
        yeild n  # 此处的yeild相当于是 return + 暂停  暂停到此时，当下一个next()来时接着开始执行
        n = n + 2 # yeild之后还是可以执行一些逻辑哟
        
g = gener() # 生成器
print(next(g)) # 1
print(next(g)) # 2

```



## 12、迭代器

可以通过next()方法调用的就叫迭代器

**可迭代的** ：通过isinstance(要判断的对象, Iterable)的返回值(bool)来判断一个变量是否是可迭代的

**注：**可迭代的并不一定是迭代器（如列表、字典、集合、元组），迭代器一定是可迭代的

```python
# 通过Interable()函数来判断一个变量是否是可以迭代的哟
from collection import Iterable

list1 = [1,34,3,5,4,5,4,2]
print(isinstance(list1, Iterable)) # True

Int1 = 10
print(isinstance(Int1, Iterable))  # False
```



迭代器分类：

  1. 生成器是一个类别

  2. 通过Iter(变量)来转换的是一个类别

     如：列表、集合、字典、元组、字符串都可以通过Iter()来转化为迭代器

```python
# 通过系统的Iter()方法来转换为迭代器
list1 = [1,2,4,3,4,35,4,5]
list1 = Iter(list1)

string1 = 'jack'
string1 = Iter(string1)
print(next(string1))

# 其它类型等等。。。。。
```



# 二、开发环境

## 1、交互模式

1. 可以直接书写Python代码哟，一般不会用于开发

# 三、流程控制

## 1、条件

```python
if 条件一:
		# 要执行的语句一
elif 条件二:
		# 要执行的语句二
else:
		# 要执行的语句三

# 这是一个示例哟
if 'a' in 'melon':
  	print('在melon内哟')

# 这是三元运算符哟
print('是的') if 0 < 1 else print('不是的')
```

## 2、循环

# 四、函数

## 1、声明

```python
def funName (param1, param1):
  	print('this is function content')
```

注意：必须使用def来定义；必须要有缩进哟；必须要使用funName (): 格式

## 2、说明文档

* 在函数体的第一行默认为函数的说明文档

* 使用"""  这是书写函数的文档 """

* 也可以是多行的哟

  ```python
  def userInfo():
  	""" 这是写函数的使用说明文档 """
    print('this is function body')
    
  def getName():
  	"""
  		也可以是多行的哟
  	"""
    print('this is function body')
  ```

  

## 3、参数

* 位置参数

  占位的参数，要严格按照其位置进行传递参数

  ```python
  def userInfo(name, age):
  	print("这里是函数体")
  ```

  

* 关键字参数

  通过“键=值”的形式加以指定，参数参数之前位置可以调整，但关键字参数必须要放在位置参数以后来使用

  ```python
  def userInfo(name, age, sex):
  	print('this is function body')
    
  # 函数的调用
  userInfo('jack', sex='男', age='12')
  ```

  

* 缺省参数（默认参数）

  调用函数时可以不传默认参数，但默认参数必须要放到位置参数之后

  ```python
  def userInfo(name, age=12, sex='未知'):
    print('this is function body')
    
  # 函数的调用
  userInfo('rose', 18)
  userInfo('rose', sex='18')
  ```



* 不定长参数（可变参数）

  用于不确定调用时会传递多少个参数（不传递参数也是可以的）的场景

  

  包裹位置参数：使用*号来标识可变参数

  函数内接收到的args为一个元组，没有传递参数时接收到的是一个空的元组

  

  这叫包裹关键字参数：使用**号来标识可变参数

  函数内接收到的kwargs为一个字典，没有传递参数时接收到的是一个空的字典

  ```python
  def userInfo(*args):
    """这叫包裹位置参数"""
    print('this is function body')
    print(args)
    
  # 函数的调用 
  userInfo('jack', 23, '男')
  userInfo('rose')
  
  
  def getName(**kwargs):
    """这叫包裹关键字参数"""
    print('this is function body')
    print(kwargs)
    
  # 函数的调用 
  userInfo(name='jack', age=23, sex='男')
  userInfo()
  ```



* 拆包

  对元组、字典进行折包

  ```python
  def getNumber():
    """返回的是一个元组哟"""
    return 100, 200
  
  num1, num2 = getNumber()
  print(num1) # 100
  print(num2) # 200
  
  ## 字典的拆包
  dict1 = {'name': 'jack', 'age': 12}
  a, b = dict1
  print(a) # name
  print(b) # age
  ```

  

## 4、作用域

1. 全局：函数体内外都能够生效
2. 局部：当前函数体内部生效
3. 若要在函数体内使用全局变量就要使用global关键字哟
4. 若在函数内使用全局变量时就要使用global
5. 函数内嵌套函数时第二层的函数要使用第一层函数变量时使用nonlocal关键字
6. globals() 查看全局的变量，locals()查看局部的变量

**作用域的范围：** 

从 L > E > G > B 结束

- L：local 本地，局部变量
- E：encloseing 嵌套
- G：Global 全局
- B：built-in 内置的

## 5、多返回值

多返回值以逗号进行分隔

```python
def userInfo():
	name = 'jack'
  	age = 12
  return name, age
```

## 6、闭包

符合条件：

- 外部函数中定义了内部函数
- 外部函数是有返回值的
- 外部返回值是内部函数
- 内部函数使用了外部变量

```python
def outFun():
 
	name = 'jack'
	
  def inFun():
    
    print('this in in function', name)
    
  return inFun
```

**特点：**

- 保存参数的状态（多次调用返回的内部函数其返回值都有各自的状态）
- 可以使用同级的作用域
- 读取其它元素的内部变量
- 延长作用域

使用场景：

- 闭包看似优化了变量，原来需要类对象来完成的工作闭包也可以完成
- 由于闭包引用了外部函数的局部变量，则外部函数的的局部变量没有及时的释放，消耗内存
- 其好处是使代码变得简洁，易于阅读
- 其是理解装饰器的基础
- 外部函数的局部变量是可以保存状态的（例如：计数器）

## 7、装饰器

特点：

- 必须要使用函数作为参数来进行传递（函数B接收函数A作为参数传递）
- 要和闭包的的特点
- 不改变原函数名的情况下可以进一步的加工
- 使用方式在被装饰的函数上面使用@装饰函数名
- 若被装饰的函数有多个参数时，可以在装饰器中使用可变参数*args, **args
- 若多个装饰器同时装饰一个函数时执行顺序是先近后远
- 装饰器带参数时在原来两层的基础之上再添加一层（用来接收装饰器的参数，一共三层）

```python
def decorate(func):
  ```我是装饰器```
  inName = 100
  print('这里外层的代码就会执行哟')
  def wrapper(*args, **args):
    func(*args, **args)
    print('这里进一步的加工')
    
  return wrapper


# 使用装饰器
@decorate
def house():
  ```我的被装饰的函数```
  print('我的简单的房子，需要装饰哟')
  
house()
```

装饰器干了什么

- 将被装饰的函数（house为被装饰的函数）作为参数传给了装饰器decorate
- 执行装饰器函数体内容
- 把装饰器的返回值又赋给了被装饰的函数（house = wrapper）

**使用类作为装饰器**

若要使用类作为装饰器的话，那么这个类就要重写`__call()__(self)`方法，否则就不能使用此类作为装饰器

```python
# 定义一个类
class Decorator():
    def __init__(self, func):
        self.func = func
	
    # 重写了__call__方法，类的对象就能够被调用，直接使用对象加()来调用类,并打印__call__方法里面的内容
    def __call__(self, *args, **kwargs):
        print('this is dog call')
        return self.func

# 使用类作为装饰器对函数进行装饰
@Decorator
def dog():
    return 'this is dog function'

if __name__ == '__main__':
    dog() # this is dog call
```

**为类添加装饰器**

```python
# 定义一个类的装饰器
def decorator(cls):
    print('this is a class 装饰器')
    return cls

# 对类使用装饰器
@decorator
class Dog():
    name = 'jack'

if __name__ == '__main__':
    d = Dog() # this is a class 装饰器
```



## 8、匿名函数

目的：为了简化代码

使用场景：一般用在系统内置函数中作为参数来使用

格式：lambda 参数1,参数2..... : 不需要return的函数体

```python
#这是一个匿名函数的示例哟
l = lambda a, b : a + b
print(l(1, 2)) # 3

list1 = [1,2,3,4,5,6]
dict1 = {"name": 'jack', 'age': '12'}
tuple1 = (2,5,7,8,9)
list2 = map(lambda i: i**2, list1)
print(list(list2))
dict2 = map(lambda v: (v, v), dict1)
print(dict(dict2))
tuple2 = map(lambda i:i*2, tuple1)
print(tuple(tuple2))

list3 = filter(lambda i: i>3, list1)
print(list(list3))
dict3 = filter(lambda v: v == 'name', dict1)
print(list(dict3))
tuple3 = filter(lambda i: i < 8, tuple1)
print(tuple(tuple3))

print(sorted([2, 1, -3, 8, -5], key = lambda x: abs(x)))
print(sorted(['cat', 'bird', 'dog', 'bira', 'animal'], key=lambda x: len(x)))
print(sorted({'a':1,'b':2}.items(),reverse=True,key=lambda x:x[0]))
print(sorted({'a':1,'b':2}.items(),reverse=False,key=lambda x:x[1]))
```



# 五、文件操作

## 1、读文件

**格式：**open(文件, 模式, buffering, coding)

**模式**(mode)

​	默认是“rt”文本模式

- r:  read 读取
- w：write 写入

- b：binary 二进制

- rb：以二进制流方式读取

- wb：以二进制流方式读取

**方法**：

```python
# 读取一个文件

# 返回一个管道，若没有此文件则会报FileNotFoundError，若文件读取模式不对则报UnicodeDecodeError
stream = open('./test.txt')

content = stream.read() # 从管道内读取内容

print(stream.readable()) # True 是否是可读取的

# 表示只读取一行内容(默认添加一个换行符)，前提是管道里面有内容时才可读，若已被读取则就获取不到内容
print(stream.readline())

print(stream.readlines()) # 表示读取所有行，返回一个列表

stream.close() # 关闭管道


# 高级使用 使用with as 可以自动的关闭文件管道(句柄)
with open('./test.txt') as r_stream:
	content = r_stream.read()
    print(content)
```

## 2、写文件

open(文件， 'wb')

**特点：**

write()：每次(open---close之间)都会把原来的内容清空，重新写入新的内容

**模式：**

wb： 二进制写入模式

a：append追加模式，不会把原来的内容清空哟

```python
# 向一个文件写入内容
stream = open(r'./test.txt', 'rb')

content = '你好呀，我来写入点内容'
result = stream.write(content)
print(result) #  74

# writelines(可迭代的)，不会自动的换行哟，需要手动的换行
stream.writelines(['jack\n', 'rose\n', 'luck', 'melon'])

print(stream.writeable) # True 是否是可写入的

stream.close() # 关闭管道


# 高级使用 使用with as 可以自动的关闭文件管道(句柄)
with open('./test.txt') as w_stream:
	w_stream.write('hello Python')
```

## 3、OS模块

**常用函数**

```python
import os

# 获取指定文件的目录
os.path.dirname(__File__)

# 拼接获取新的路径
os.path.join(文件/目录路径, 拼接1, 拼接2)

# 分割目录与文件名，返回一个元组 （目录，文件名.扩展名）
os.path.split(文件/目录路径)

# 分割目录与文件扩展名，返回一个元组（目录，扩展名）
os.path.splittext(文件路径)

# 获取当前文件路径所指文件的大小
os.path.getsize(文件路径)

# 判断当前路径是否是目录 bool
os.path.isdir(目录路径)

# 判断当前路径是否是文件 bool
os.path.isfile(文件路径)

# 判断当前路径是否是绝对路径 bool
os.path.isabs(文件/目录路径)

# 获取当前目录
path = os.path.getcwd()

# 浏览文件夹，类似于ls  返回一个列表['aa.txt', 'bb.doc', 'cc']
file_list = os.path.listdir()

# 创建一个新的文件夹
os.path.mkdir('doc')

# 删除空的文件夹
os.path.rmdir('pp')

# 删除一个文件
os.path.remove(文件路径)

# 切换目录
os.path.chdir(目标路径)
```



# 六、异常

## 1、异常捕获

**目的：**处理可能要发生的异常错误

当我们认为某些代码可能会出错时，就可以用try来运行这段代码，如果执行出错，则后续代码不会继续执行，而是直接跳转至错误处理代码，即except语句块，执行完except后，如果有finally语句块，则执行finally语句块，至此，执行完毕。

注：使用try except 后，若有异常出现时就可以执行其后的逻辑了（正常情况下有异常就会终止程序）

**特点：**

- 只要使用finally则try/except/else 内的return的值就不会被返回，都会使用finall中的
- 具体的错误类型一定要放到Exception之前，否则具体的类型就会执行不到的哟（因为有继承关系）
- 若使用else的话则try内和else内则只能有一个地方使用return哟（建议在else内使用return）
- except Exception as err  其中的err为具体的错误内容

```python
# 异常处理 try 不能单独使用，必须要和except配合使用哟
try:
    # 可能出现异常的代码
	pass
except 错误类型1:
	# 如果有异常执行的代码，可通过不同的类型来做不同的区分，except可以有多个哟
    # 错误类型，如：ZeroDivisionError、ValueError等
	pass
except 错误类型2:
	# 如果有异常执行的代码，可通过不同的类型来做不同的区分，except可以有多个哟
    # 错误类型，如：ZeroDivisionError、ValueError等
	pass
except Exception as err:
	'''
    1、继承关系：ValueException --> Exception --> BaseException --> Object
    2、具体的错误类型一定要放到Exception之前，否则具体的类型就会执行不到的哟（因为有继承关系）
    3、也可以自定义所需要的异常类（如：class MyError(Exception)）
    '''
    print('错误内容为：{}'.format(err))
	pass
else:
    # 如果try中没有发生异常，将会执行else语句 
    # 若使用else的话则try内和else内则只能有一个地方使用return哟（建议在else内使用return）
    pass
finally:
    # 无论是否有异常都会被执行的代码
    # finally有一个特点：只要使用finally则try/except/else 内的return的值就不会被返回，都会使用finall中的
    pass
```

## 2、抛出异常

**关键字：**raise

**格式：**raise Exception(异常的内容)

使用raise可以自定义的抛出异常，开发中不常使用，多数是在查看源码时辅助理解

```python
def fun1(age):
    if age < 10:
        # 抛出异常
        raise Exception('年龄不能小于10岁哟')
    else:
        print('输入年龄为{}'.format(age))
    
# 捕获异常
try:
    fun1(3)
except Exception as err
	print(err)
```



# 七、类与对象

## 1、声明

关键字: class 

类名： 首字母要大写

```python
# 声明类 class 类名[(父类)]:
class Phone:
  	brand = 'xiao mi' # 类属性
    def getBrand(self): 
      print('this is body' , self)
```

## 2、生成对象

在类名后添加小括号，就是使用类生成对象

每一个对象都会新开辟一个新的内存空间

```python
iPhone = Phone()
iPhone.brand = 'hua wei' # 对象属性
print(iPhone)
```

## 3、属性

- 对象中属性的查的顺序：先从本对象内查找，若没有找到，则到其类里面进行查找，若都没有找到则会报出AttributeError
- 对象内的属性是可以动态添加的，使用赋值操作来添加对象属性 iPhone.brand = 'hua wei'

## 4、方法

分类：普通方法、类方法、静态方法、魔术方法

格式：def 方法名(self[,参数1, 参数2....]):

```python
# 类的声明
class Phone:
  name = 'hua wei'
  weight = 12
  
  # 此为魔术方法, 类似于构造方法
  # 此方法会在为对象分配好内存后执行同时把对象地址给self,之后把地址再赋值给对象变量名
  # 此方法作用可统一对象的属性，规定规则，在开发中很常用哟
  def __init__(self, age):
    self.age = age
    print(self)
  
  # 此为普通方法
  def call(self): # self代表的是当前调用此方法的对象
    print(self.name)
  
  # 此为类方法，要使用装饰器来指定
  @classmethod
  def classFun(cls):
    print(cls) # 是指的当前的类Phone
```

### 普通方法

普通方法(对象可使用的方法)，其使用只能是对象可调用的，其参数self指的是当前调用的那个对象本身

可以在普通方法中使用类属性、类方法

```python
# 类的声明
class Phone:
  name = 'hua wei'
  weight = 12
  
  def call(self): # self代表的是当前调用此方法的对象
    print(self.name)
    
    
# 使用类生成对象
phone1 = Phone()
phone1.name = 'xiao mi'
phone1.call()
```

### 类方法

类方法在没有生成对象时可以直接进行调用，其在类声明时就已经加载好了

**特点：**

- 定义类方法需要依赖装饰器@classmethod
- 类方法中参数不是一个对象，而是一个类
- 类方法中只可以使用类属性、类方法，不可以访问普通方法

**作用：**

- 在对象创建之前，如果需要完成一些动作就可以使用类方法

```python
class Phone:
    # 使用装饰器classmethod
    @classmethod
    def getName(cls):
        ```其中的cls参数为必填参数，不可以省去```
        print(cls) # cls是当前类本身
        
# 类方法的调用，使用类直接进行调用
p1 = Phone.getName()

# 类方法也可以使用对象对其调用
p2 = Phone()
p2.getName()
```



### 静态方法

和类方法一样，在类声明时就已经加载好了

**特点：**

- 需要装饰器@staticmethod
- 静态方法是无需传递参数的（cls 、self）
- 只能访问类属性和类方法，不能访问对象属性和对象方法

**静态方法对比类方法：**

- 相同：
  - 只能访问类属性和类方法，对象的是不能访问的
  - 都可以通过类名及对象名来进行调用
  - 都可以在创建对象之前调用（因为不依赖于对象）

- 不同：
  - 装饰器不同@classmethod @staticmethod
  - 类方法有参数，静态方法没有参数

**普通方法VS静态、类方法**

- 不同：
  - 普通方法没有装饰器，后两者是有装饰器
  - 普通方法永远是依赖于对象的（有self参数），后两者是不依赖于对象
  - 只能创建了对象，使用对象才能调用普通方法，后两者可以使用类名直接调用
- 相同：
  - 都可以使用对象来进行调用

```python
class Phone:
    # 使用装饰器staticmethod
    @staticmethod
    def getName():
        pass # 其不需要有cls或self参数
        
# 静态方法的调用，使用类直接进行调用
p1 = Phone.getName()

# 静态方法也可以使用对象对其调用
p2 = Phone()
p2.getName()
```



### 魔术方法

系统定义的，在特定条件下可以被自动的调用

- `__new__(cls)`在实例化时触发（申请内存空间），至少一个cls参数，必须返回一个对象实例，先实例化(new)后初始化(init)

- `__init__(self)` 构造器，在初始化对象时触发（等到内存空间后第一个被调用），至少有一个self参数，没有返回值，使用该方式初始化的成员都是直接写入对象中，类中无法具有
- `__del__(self) `析构器，当一个实例被销毁的时候调用的方法，也就是说在断开对其的引用时或已经没有被引用时
- `__call__(self)` 允许一个类的实例像函数一样被调用：x(a, b) 调用 x.`__call__`(a, b)
- `__getattr__(self, name)` 定义当用户试图获取一个不存在的属性时的行为
- `___setattr__(self, name, value)` 定义当一个属性被设置时的行为
- `__getattribute__(self, name)` 定义当该类的属性被访问时的行为
- `__delattr__(self, name)` 定义当一个属性被删除时的行为
- `__enter__(self)` 定义当使用 with 语句时的初始化行为
- `__exit__(self, exc_type, exc_value, traceback)` 定义当一个代码块被执行或者终止后上下文管理器应该做什么

```python
class Phone:
    # 可以看成是构造方法，对象中的属性可以在此进行定义
    # 当对象被生成后被调用
    def ___init___(self):
        print(self.name) # 必须有self参数， self为当前调用的对象本身
    
    # 打印对象时自动的调用此函数
    def ___str___(self):
        print(self.name)
    
    # 生成对象并为对象开辟内存空间时自动调用，一般不常用
    def ___new___(cls): #cls为必传参数，表示类本身
        print(cls)
        
    # 把对象当作时一个函数来调用时会自动被调用
    def ___call___(self):
        print(self)
        
    # 当对象没有被引用时(销毁时)被自动调用
    def ___del___(self):
        print(self)
        
```



## 5、私有化

将类的属性私有化，访问范围仅仅限于类中；

好处：

- 隐藏属性不被外界随意的修改

- 也可以修改，通过set/get进行修改获取值

  ```python
  class Phone:
      def ___init___(self, name):
          self.__name = name
          
      def setName(self, name):
          # 在这里可以做条件的限制哟
          self.__name = name
          return self.__name
      
      def getName(self):
          return self.__name
      
  p = Phone('rose')
  p.setName('jack')
  p.getName()
  ```

- @property 装饰器私有化， 来替换使用get/set的方式来操作私有属性

  ```python
  class Phone:
      def ___init___(self):
          self.__name = 'xiao mi'
      
      # 使用property装饰器来实现getName获取私有属性
      @property
      def name(self):
          return self.__name
      
      # 使用XXX.setter来实现设置私有属性
      @name.setter
      def name(self, name):
          return self.__name = name
      
      
  # 调用
  p = Phone()
  p.name = 'hua wei'
  print(p.name) # hua wei
  ```

  

## 6、关联关系

- **A** is a **B** 

  说明B是A的父级

  如：A是B的父级

- **A** has a **B** 

  说明A包含了B

  如：B是A的属性

## 7、继承

继承是一种创建新的类的方式，新创建的叫子类，继承的叫父类、超类、基类。

**特点**：

- 子类可以使用父类的属性（特征、技能），可以单继承，也可以多继承(不常用)

- 继承是类与类之间的关系
- **子类对象查找属性及方法的顺序是**：先从本身查找、之后向上级一层一层的查找，若没有找到则报错
- 子类中使用父类中的方法时使用**关键字super**

**目的**：减少代码冗余、提高重用性

所有的类都会继承Object类

格式：class 类名(父类名):

```python
class Person:
    def __init__(self, name):
        self.name = name
	def eat(self, food):
        print(f'小海在吃{food}')
        
# 子类继承父类        
class Tom(Person):
    def __init__(self, name):
        super().__init__(name)
		self.name = name
        
    # 子类重写父类的方法
    def eat(self, food):
        super().eat(food)
        print(f'{self.name}和小海吃{food}了')
        
# 调用
t = Tom('tom')
t.eat('屎')
```



**多继承**：

​	如： class D(A, B, C):

​	特点：广度优先

​	其查找顺序是 D > A > B > C > Object

## 8、模块

模块就是一个包含了python定义和声明的文件，文件名就是模块的名字加上.py后缀

**格式：**

​	import 包名[.模块名 [as 别名]]
​	from 包名 import 模块名 [as 别名]
​	from 包名.模块名 import 成员名 [as 别名]

**目的**

​	代码可以重用，把相关的功能进行分离,以便我们的日常维护,以及新项目的开发

**导入模块的时候都做了些什么? **

​	首先,在导入模块的一瞬间,python解释器会先通过sys.modules来判断该模块是否已经导入了该模块,如果已经导	入了则不再导入,如果该模块还未导入过,则系统会做三件事.

```python
- 为导入的模块创立新的名称空间
- 在新创建的名称空间中运行该模块中的代码
- 创建模块的名字,并使用该名称作为该模块在当前模块中引用的名字.
```

# 八、数据库

操作数据库的两种方式：

- 原生SQL
  - pymysql： python2/python3 都可以使用，一般要配合DBUtils来使用
  - MySQLdb：只支持python2
- ORM
  - SQLachemy（其内部原理还是调用pymysql/MySQLdb）
    - 其功能是把模型对象和表的字段对应，操作时生成对应的SQL语句，其它工作交由Pymysql处理
    - 其可以生成、删除表（不能修改表结构）或操作CURD

## 1、mysql

**数据库：**数据的仓库(集散地)，实现数据持久化和数据管理

**持久化：**将数据从内存转移到能够长久保存数据的存储介质的过程

**完整性：**

- 实体完整性 - 每一个实体都是独一无二的，没有冗余（主键、唯一索引）
- 参照完整性 - 外键
- 域的完整性 - 存储的数据都是有效的（数据类型、长度、非空约束、默认值）

**一致性：**事务，要么全成功要么全失败，操作是不可分割的（ACID特性）

- A - Atomicity - 原子性 - 不可分割
- C - Consistency - 一致性 - 事务前后数据状态要一致
- I - Isolation - 隔离性 - 并发的多个事务不知道彼此的中间状态
- D - Duration - 持久性 - 事务完成后数据要做持久化

## 2、pymysql

**安装：** pip install pymysql

**使用：**

```python
# 1、创建链接对象
conn = pymysql.connect(host="127.0.0.1", port=3306, user="root", password='123456', database='rooms', charset='utf8')

try:
    # 2、获得游标对象
    with conn.cursor() as cursor:
        # 3、使用游标进行操作SQL得到结果
        result = cursor.execute('insert into rooms (29,"", "")')
        if result == 1:
            print('添加成功')
            
        # 4、操作成功后进行提交(因为不会自动进行提交)
        conn.commit()
        
    # 这里是查询操作
    with conn.cursor() as cursor:
        # 3、使用游标进行操作SQL得到结果
        cursor.execute('select * from rooms')
        for row in cursor.fatchall:
            # 这里的row是一个二级的无组哟, 如：(('jack', 23), ('rose', 12), ('melon', 12))
            print(f'字段一：{row[0]}')
            # 这里可以和下面的room对象进行绑定哟(得把cursorclass设置为DistCursor)
            room(**row)
        
except pymysql.MySQLError as error:
    print(error)
    # 5、若异常进行回滚
    conn.rollback()
finally:
    # 6、最终关闭链接，释放资源
    conn.close()
```

和对象进行关联：

```python
class room():
    def __init_(self, name, age):
        self.name = name
        self.age = age
        
    def __str__():
        print(f"{self.name}\t{self.age}")
```



**使用原生的SQL可能会出现那些问题？**

- 每一个人来就会创建一个数据库链接（数据库的可链接数有限的哟）

- 如果把链接放到全局会如何呢 - 多个人并发时第一个人已经查出来信息并关闭链接了，同时第二个人刚查出来数据，此时就会报错哟

- **问题一：**不能为每一个用户都去创建一个链接

- **问题二：**创建一定数量的链接，以便来重复使用（用完就还回去不进行断开链接）

- **方案一：**可以放到全局的同时使用threading.Lock()加锁限制，这样是可以的，但不能实现并发操作，数据库只能一个一个来处理

- **方案二：**使用DBUtils模块，可参考 [链接](https://www.cnblogs.com/wupeiqi/articels/8184686.html)

  ```python
  # 下载DBUtils模块，到其setup.py所在目录下
  
  # 执行命令一：python setup.py build
  
  # 执行命令二：python setup.py install
  
  # 使用DBUtils 有两种链接模式 可参考https://www.cnblogs.com/wupeiqi/articles/8184686.html,推荐使用第二种模式（惰性创建）
  ```

## 3、SQLAlchemy

是一个基于Python实现的ORM框架。该框架建立在 DB API之上，使用关系对象映射进行数据库操作，简言之便是：将类和对象转换成SQL，然后使用数据API执行SQL并获取执行结果。

#### 字段类型

- Integer					-- int 整型数字类型，普通整数，一般是32位
- SmallInteger          -- int 取值范围小的整数，一般是16位
- BigInteger              -- int/long 不限制精度的整数
- Float                        -- float 浮点数
- Numeric                 -- decimal.Decimal 普通整数，一般是32位
- String                      -- 变长字符串，一般String(10)注明长度
- Text                         -- 变长字符串，对较长或不限长度的字符串做了优化，不用指明长度
- Unicode                 -- 变长Unicode字符串
- UnicodeText          -- 变长Unicode字符串，对较长或不限长度的字符串做了优化
- Date                        -- datetime.date 时间
- DateTime               -- 时间和日期
- Boolean                 -- boolean 布尔值

#### 列选项

- primary_key          -- 主键，True、False
- unique                   -- 如果为True，代表这列不允许出现重复的值
- index                      -- 如果为True，为这列创建索引，提高查询效率
- nullable                 -- 如果为True，允许有空值，如果为False，不允许有空值
- default                   -- 定义默认值 

可参考： [链接](https://www.cnblogs.com/wupeiqi/articles/8259356.html)

# 九、Redis

**Redis：** REmote DIctionary Server（远程字典式服务）

下载地址 [链接](https://redis.io/)

文档地址 [链接](http://redisdoc.com)

## 1、应用场景 

主要应用对象是“热数据”，冷数据（不经常使用的）/ 热数据（经常使用的）

- 高速缓存服务（用户经常访问的数据从数据库搬到内存）
- 实时排行榜
- 投票点赞
- 消息队列

## 2、常用命令

- port -- 端口号
- version -- 查看版本号
- requirepass -- 设置密码
- appenonly -- 记录命令日志

```python
# 在命令行进行执行

# 启动服务的命令
redis-server --port 6379 --requirepass 1qaz2wsx
redis-server /data/www/redis/redis.conf &
redis-server > redis.log &

# 查看后台启动的服务
jobs -l # 查看服务列表
fg %[number] # 把服务放到前台
bg %[number] # 把服务放到后台

# 启动Redis客户端的命令
redis-cli -h 主机IP地址 -p 端口号
主机:端口> auth 密码
主机:端口> ping
PONG

# 停止Redis服务
# 在Redis客户端中执行shutdown 后就可以停止Redis服务
kill 进程号

# 测试Redis的性能
 redis-benchmark

# 查看版本号
redis-server --version
redis-cle --version

# 查看当前有没有启动Redis
netstat -nap | grep redis

```



# 十、Session

**使用场景：**用户登录、登出、验证用户、城市定位

# 十一、Cookie

Cookie数据存储技术，它的数据存储在客户端（浏览器），在浏览器中会为每个站点（host）创建存储Cookie的空间出来，Cookie的数据存储以Key=Value形式进行存储的，但是每个Key都有生命周期（有效期）。一个完整的Cookie信息包含：名称、内容、域名、路径(/)、有效时间（创建时间、到期时间）

**特点：**

- cookie有有效期：服务器可以设置cookie的有效期，以后浏览器会自动的清除过期的cookie。
- cookie有域名的概念：只有访问同一个域名，才会把之前相同域名返回的cookie携带给服务器。也就是说，访问谷歌的时候，不会把百度的cookie发送给谷歌。

## 1、 向客户端写入Cookie

**格式：**

```python
def set_cookie(
    self,
    key, # 要设置的Key
    value="", # 对应的Value值
    max_age=None, # 以秒为单位，距离现在多少秒后cookie会过期，若expires同时存在则以expires为准
    expires=None, # 为datetime类型。这个时间需要设置为格林尼治时间，也就是要距离北京少8个小时的时间，如果没有显示的指定过期时间，那么这个cookie将会在浏览器关闭后过期
    path="/",
    domain=None, # 默认是只能在主域名下使用。如果想要在子域名下使用，那么应该给`set_cookie`传递一个`domain='.demo.com'`，这样其他子域名才能访问到这个cookie信息。
    secure=False,
    httponly=False,
    samesite=None,
):pass

# 需要使用响应对象来调用set_cookie 或 delete_cookie方法
```

## 2、获取Cookie

```python
# 客户端的cookie信息随着请求发送，自动将浏览器中的Cookie附加到请求头中
# 可以在请求对象中获取浏览器的Cookie值信息
from false import request

co = request.cookies.get('yes') # 获取Cookie值
```



## 3、删除Cookie

```python
def delete_cookie(
    self, 
    key, 
    path="/", 
    domain=None
):pass
```



# 十二、包管理器

- **作用：**Python库是指那些被开发并且为了其他人来使用而发布的东西，可以在 [PyPI](https://pypi.org/)找到很多Python库，**目的是为了解决"不重复的造轮子"**

- **发展：**按时间(由新到旧)：pip --> setuptools(easy_install) --> distutils

  - **distutils：**最古老的方式，通过setup.py来安装与发布

    ```
    python setup.py install
    ```

  - **setuptools：**是一个为了增强 distutils 而开发的集合，它包含了 `easy_install` 这个工具

  - **pip：**是目前 python 包管理的事实标准，它被用作 `easy_install` 的替代品，但是它仍有大量的功能建立在setuptools 组件之上

- 相关文件

  - setup.py

    Python库会包含很多的信息，比如它的名字，版本号，依赖等等。而 setup.py 就是用来提供这些信息的

    可以理解为是"抽象的依赖"

    ```python
    from setuptools import setup
    
    setup(
        name="MyLibrary",
        version="1.0",
        install_requires=[
            "requests",
            "bcrypt",
        ],
        # ...
    )
    ```

    

  - requirements.txt

    一般一个**Python库**对依赖的版本比较宽松，而一个**应用**则会依赖比较具体的版本号

    可以理解为是"具体的依赖"

    ```txt
    # This is an implicit value, here for clarity
    --index https://pypi.python.org/simple/
    
    MyPackage==1.0
    requests==1.2.0
    bcrypt==1.0.2
    ```

    文件的头部有一个 `--index https://pypi.python.org/simple/` ，一般你不用声明这项，除非你使用的不是PyPI

## 常用命令

使用pip(包管理器) 来管理应用的依赖包

```shell
# 使用帮助
pip --help

# 从PyPI安装软件包
pip install SomePackage

# 卸载软件包
pip uninstall SomePackage

# 查看以安装软件包
pip list

# 查看可升级软件包
pip list --outdated

# 升级软件包
pip install --upgrade SomePackage

# 查看软件包安装了哪些文件及路径等信息
pip show --files SomePackage

# 安装软件包的指定版本号

pip install SomePackage # latest version
pip install SomePackage==1.0.4 # specific version
pip install 'SomePackage>=1.0.4' # minimum version

# 根据依赖文件安装软件包
pip freeze > requirements.txt # 使用pip导出依赖文件列表
pip install -r requirements.txt # 根据依赖文件列表，自动安装对应的软件包
```

