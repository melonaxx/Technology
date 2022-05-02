# 一、Postman界面介绍

- Home主页
  - Collection (项目)
  - APIs(ApI文档)
  - Environments(环境变量)
    - Globals 全局变量
    - 自定义环境变量
  - Mock servers(虚拟服务器)
  - Minitors（监听器）
  - History(历史记录)
- WorkSpace 工作空间
- Api Network（API）
- Preports报告(需要升级到企业版)
- explore(探索其它的API)

# 二、执行接口测试

## 1、请求信息

- Params：Query params 是带上url链接后的key-value键值对参数
- Authorization：鉴权使用
- Headers：请求头信息
- Body：Post请求传参
  - none 没有参数
  - From-data 即可以传递键值对也可以传递文件
  - X-www-form-urlencoded 只能够传递键值对
  - raw 可以传递多种类型 json/xml/text/script/html
  - binary 以二进制的方式传递
- Pre-requestion script：请求之前的脚本
- Tests：请求之后的断言
- Settings：对当前请求的相关设置
- Cookie：用于管理请求的cookie

## 2、响应信息

- Body：响应体
  - Pretty 美化后的信息展示（如：json/html/xml/text/script）
  - Raw 原始信息形式
  - Preview 使用浏览器的网页打开查看的形式
  - Visualize不常用 
- Cookies：响应的Cookie信息
- Headers：响应头信息
- TestResult：断言结果信息

# 三、环境变量的使用

## 1、全局变量

全局变量可以在所有的接口内都可以使用

## 2、环境变量

环境变量其实就是全局变量，可以切换不同的环境来切换环境变量的值。

全局变量和自定义的环境变量通过{{varName}}来进行获取

# 四、接口关联

## 1、使用Json提取器实现接口关联

```js
// 使用json提取器
console.log(responseBody);
// 把字符串转换为json对象 方法一：
var data = JSON.parse(responseBody);
// 方法二：
var data = pm.response.json();
pm.global.set("key", data.Key);

pm.test("HTTP响应状态码是否为200", function () {
    pm.response.to.have.status(200);
});

// 在第二个接口内使用上面设置好的环境变量值
{{key}}
```



## 2、使用正则表达式提取器实现接口关联

```js
//使用正则匹配
var result = responseBody.match(new RegExp('"key":"(.*?)"'))
console.log(result)
// 设置环境变量
pm.global.set("key", result[1]);

// 在第二个接口内使用上面设置的环境变量值
{{key}}
```

# 五、内置动态参数及自定义动态参数

## 1、内置动态参数

格式：是以“$”开头

```js
{{$timestemp}} 生成当前时间的时间戳
{{$randomInt}} 生成0-1000之间的随机数
{{$guid}} 生成随机GUID字符串
```

## 2、自定义动态参数

在pre-request-script中定义动态参数

```js
// 生成自定义动态参数
var times = Date.now();
pm.global.set("times", times)

// 第二个接口内调用上面生成的环境变量
{{times}}
```

# 六、断言的使用

断言在请求选项卡中的Test进行设置，断言也就是请求成功后对结果做进一步的验证。

**常用：**

Status code: code is 200	检查返回的状态码是否为200

Response body: Contains string	检查响应信息中是否包含某个字符串

Response body: JSON value check	检查响应信息中某个JSON的值是否为具体的值

Response body: is equal to a string	检查响应值是否等于某一个字符串

**不常用：**

Response header: Content-Type header check	检查响应头是否包含content-type

Response time is less than 200ms	检查响应时间是否小于200ms

Status code: Successful POST reuqest	检查响应码是否在指定的状态码列表内



**注意：**

在断言中获取自定义的动态变量时使用：pm.globals.get("times")

若每个接口内都需要使用的断言可以放到全局断言内（对当前组进行编辑后会有一个pre-request-script 和 tests）
