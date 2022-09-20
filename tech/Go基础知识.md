## 一、开发环境

### 1、配置

- 在电脑上新建一个目录，来存放编写的Go语言代码（编译目录）
- 在环境变量里添加Go（mac不需要处理）
- 在新建的目录内建三个文件：`src`,`pak`,`bin`
- 使用命令查看Go版本号`go version`
- 使用命令查看环境变量`go env`

### 2、跨平台

windows下编译一个linux下可执行文件

```go
SET CGO_ENABLED=0  // 禁用CGO
SET GOOS=linux  // 目标平台是linux
SET GOARCH=amd64  // 目标处理器架构是amd64
```

Mac 下编译 Linux平台 64位

```go
CGO_ENABLED=0 GOOS=linux GOARCH=amd64 go build
CGO_ENABLED=0 GOOS=windows GOARCH=amd64 go build
```

Mac 下编译Windows平台 64位

```go
CGO_ENABLED=0 GOOS=darwin GOARCH=amd64 go build
CGO_ENABLED=0 GOOS=windows GOARCH=amd64 go build
```

Windows下编译Mac平台64位

```go
SET CGO_ENABLED=0
SET GOOS=darwin
SET GOARCH=amd64
go build
```

### 3、开发命令

- `go build`（常用）
- `go run`（常用）
- `go install`(不常用)

## 二、基础语法

### 1、变量

- 非全局变量在声明后必须要使用，不使用则编译不过去

- 声明变量时Go会自动对变量的内存区进行初始化，每个变量会被初始化成其类型的值（整型为0，布尔为false等）

- 可以在声明的时候为其指定初始值或初始化多个变量

  ``` go
  	// var 变量名 类型 = 表达式
  
  	// 声明变量同时赋值
  	var name string = "jack"
  	var age, nick = 20, "rose"
  	// 类型推导（根据值来判断该变量是什么类型）
  	var str1 = "string01"
  	// 简短变量声明
  	str2 := "string02"
  	// 批量声明
  	var (
  		str3 string
  		age1 int
  	)
  	str3 = "melon"
  	age1 = 21
  
  	println(name)
  	println(age, nick)
  	println(str1)
  	println(str2, str3, age1)
  ```

- 匿名变量

  在使用多个变量赋值时，如果想忽略某个变量，可以使用匿名变量(`anonymous variable`)匿名变量是用一个下划线来`_`表示，其不占用内存空间所以不存在重复声明

  ```go
  func foo() (int, string) {
  	return 23, "yeah"
  }
  
  // 匿名变量
  _, name3 := foo()
  
  println(name3)
  ```

  

- 注意事项

  - 函数个的每个语句都必须以关键字开始（var 、const、func等）
  - := 不能在函数个使用
  - _ 多用于占位符，表示忽略值
  - 在同一个作用域内一个变量名不能重复的定义

### 2、常量

相对于变量，常量是相对不变的值，多用于定义程序运行期间不会变的值

```go
// 单个常量的定义
const pi = 3.14
// 多个常量的定义
const (
    m = 3
    n // 多个常量定义时，若省略了值则和上面一行的值相同
    e = 4
    f
)
println(pi, m, n, e, f)
```

**iota**

是go语言的常量计数器，只能在常量的表达式中使用。在const关键字出现时将被重置为0。const中每新增一行常量声明将使`iota`计数一次(iota可理解为const语句块中的行索引)。 使用iota能简化定义，在定义枚举时很有用。

```go
// 单个常量的定义
const pi = 3.14
// 多个常量的定义
const (
    m = 3
    n // 多个常量定义时，若省略了值则和上面一行的值相同
    e = 4
    f
)

// iota --> 0 1 2
const (
    a1 = iota
    a2
    a3 = iota
)
// 跳过某个值 ---> 0 3
const (
    b1 = iota
    _
    _ = iota
    b3 = iota
)
// 插值 --> 0 100 100 3 4
const (
    c1 = iota
    c2 = 100
    c3
    c4 = iota
    c5
)
// 示例 ---> 1024 1048576 1073741824 1099511627776 1125899906842624
const (
    _  = iota
    KB = 1 << (10 * iota)
    MB = 1 << (10 * iota)
    GB = 1 << (10 * iota)
    TB = 1 << (10 * iota)
    PB = 1 << (10 * iota)
)
println(pi, m, n, e, f)
println(a1, a2, a3)
println(b1, b3)
println(c1, c2, c3, c4, c5)
println(KB, MB, GB, TB, PB)
```

### 3、数据类型

Go语言中有丰富的数据类型，除了基本的整型、浮点型、布尔型、字符串外，还有数组、切片、结构体、函数、map、通道（channel）等

#### a、整型

整型分为以下两个大类： 按长度分为：int8、int16、int32、int64 对应的无符号整型：uint8、uint16、uint32、uint64

```go
// 而且还允许我们用 _ 来分隔数字，比如说： v := 123_456 表示 v 的值等于 123456。
int1 := 23
int2 := 123_456
println(int1, int2)
```

#### b、浮点型

Go语言支持两种浮点型数：`float32`和`float64`。

```go
import "fmt"
import "math"
fmt.Printf("%f\n", math.Pi)
fmt.Printf("%.2f\n", math.Pi)
```

#### c、布尔型

Go语言中以`bool`类型进行声明布尔型数据，布尔型数据只有`true（真）`和`false（假）`两个值。

**注意：**

1. 布尔类型变量的默认值为`false`。
2. Go 语言中不允许将整型强制转换为布尔型.
3. 布尔型无法参与数值运算，也无法与其他类型进行转换。

#### d、字符串

Go语言中字符串使用双引号来包括起来，单引号包括起来的是单个字符而不是字符串

**常用的转义字符**

| `\r` | 回车符（返回行首）                 |
| ---- | :--------------------------------- |
| `\n` | 换行符（直接跳到下一行的同列位置） |
| `\t` | 制表符                             |
| `\'` | 单引号                             |
| `\"` | 双引号                             |
| `\\` | 反斜杠                             |

**多行字符串**

要定义一个多行字符串时，就必须使用`反引号`字符

```go
s1 := `第一行
第二行
第三行
`
fmt.Println(s1)
```

### 4、流程控制

#### a、if条件

Go语言规定与`if`匹配的左括号`{`必须与`if和表达式`放在同一行，`{`放在其他位置会触发编译错误。 同理，与`else`匹配的`{`也必须与`else`写在同一行，`else`也必须与上一个`if`或`else if`右边的大括号在同一行。

```go
// 若在条件1前面写上初始值的话，此值只会在if条件体内使用（是局部变量）
if a := 1;条件1 {
    语句1
} else if 条件2 { // else 和 if之间必须要有空格分离
    语句2
} else {
    语句3
}
```



#### b、for循环

Go内没有while循环，可以使用for来实现相同的功能（见用法三）

```go
/*
基本语法
for 初始语句;条件表达式;结束语句{
    循环体语句
}

*/
// 第一种用法
for i := 1; i < 10; i++ { // i只在循环内有效
    println(i)
}
// 第二种用法
var i = 1; // i为函数内的变量，可以在其后逻辑中使用
for ; i < 10; i++ {
    if i == 5 {
        break
    }
    println(i)
}
var j = 1;
for ;j < 10;{ // 初始化和增加可以写到其它地方，但分隔的两个分号要么同时有要么同时省略
    if i == 5 {
        continue
    }
    println(j)
    j++
}

// 第三种用法
// 这种写法类似于其他编程语言中的while，在while后添加一个条件表达式，满足条件表达式时持续循环，否则结束循环。
m := 1
for m < 10 {
    println(m)
    m++
}
// 第四种用法
for {
    println("这是死循环")
}
// 第五种用法 --> 键值循环
for _,v := range "hello" {
    fmt.Printf("%c %T\n", v, v)
}
```

#### c、for range

Go语言中可以使用`for range`遍历数组、切片、字符串、map 及通道（channel）。 通过`for range`遍历的返回值有以下规律：

1. 数组、切片、字符串返回索引和值。
2. map返回键和值。
3. 通道（channel）只返回通道内的值

```go
for _,v := range "hello" {
    fmt.Printf("%c %T\n", v, v)
}
```

#### d、switch case

使用`switch`语句可方便地对大量的值进行条件判断。Go语言规定每个`switch`只能有一个`default`分支。

```go
// 分支还可以使用表达式，这时候switch语句后面不需要再跟判断变量。
s := 3
switch {
    case 0 < s && s < 2:
    println("小于3")
    case s < 5:
    println("小于5")
    default:
    println("默认")
} // 输出 小于5

// 一个分支可以有多个值，多个case值中间使用英文逗号分隔。
switch s1 := 4; s1 {
    case 3,4:
    println("第一组")
    case 5,6:
    println("第二组")
    default:
    println("默认")
} // 输出 第一组

// fallthrough语法可以执行满足条件的case的下一个case，是为了兼容C语言中的case设计的。
s2 := 3
switch s2 {
    case 3:
    println("第一组")
    fallthrough
    case 4:
    println("第二组")
    case 5:
    println("第三组")
    default:
    println("默认")
} // 输出 第一组 第二组
```

#### e、退出循环

- `goto`语句通过标签进行代码间的无条件跳转。`goto`语句可以在快速跳出循环、避免重复退出上有一定的帮助。适用于`for`、`switch`和`select`的代码块，后可跟结束后跳转出的标签
- `break`语句可以结束`for`、`switch`和`select`的代码块，后可跟结束后跳转出的标签，标签要求必须定义在对应的`for`、`switch`和 `select`的代码块上。
- `continue`语句可以结束当前循环，开始下一次的循环迭代过程，仅限在`for`循环内使用。后可跟结束后跳转出的标签，标签要求必须定义在对应的`for`代码块上。

### 5、数组

数组是同一种数据类型元素的集合。 数组从声明时就确定，使用时可以修改数组成员，但是数组大小不可变化。

`定义：` var 变量名 [数组长度]变量类型

```go
// 数组的长度必须是常量，并且长度是数组类型的一部分。一旦定义，长度不能变
// [5]int和[10]int是不同的类型
var int1 [5]int
var int2 [10]int

printf(int1[0]) // 数组可以通过下标进行访问,访问越界会panic
```

**初始化：**

- 方法一

  使用初始化列表来设置元素的值

  ```go
  var testArray [3]int                        //数组会初始化为int类型的零值
  var numArray = [3]int{1, 2}                 //使用指定的初始值完成初始化
  
  fmt.Println(testArray)                      //[0 0 0]
  fmt.Println(numArray)                       //[1 2 0]
  ```

- 方法二

  一般情况下我们可以让编译器根据初始值的个数自行推断数组的长度

  ```go
  var testArray [3]int
  var numArray = [...]int{1, 2}
  var cityArray = [...]string{"北京", "上海", "深圳"}
  fmt.Println(testArray)                          //[0 0 0]
  fmt.Println(numArray)                           //[1 2]
  fmt.Printf("type of numArray:%T\n", numArray)   //type of numArray:[2]int
  fmt.Println(cityArray)                          //[北京 上海 深圳]
  fmt.Printf("type of cityArray:%T\n", cityArray) //type of cityArray:[3]string
  
  ```

- 方法三

  我们还可以使用指定索引值的方式来初始化数组

  ```go
  a := [...]int{1: 1, 3: 5}
  fmt.Println(a)                  // [0 1 0 5]
  fmt.Printf("type of a:%T\n", a) //type of a:[4]int
  
  ```

  

### 6、切片

### 7、map

### 8、函数

## 三、常用包

### times包

```go

	// 获取当前时间戳
	fmt.Println(time.Now().Unix())
	fmt.Println(time.Now().Local().Unix())
	// 获取当前时间（有格式）
	fmt.Println(time.Now().Format("2006-01-02 15:04:05"))
	// 时间戳转换为时间格式
	fmt.Println(time.Unix(1652919398, 0).Format("2006-01-02 15:04:05"))
	// 时间格式转换为时间戳
	t, _ := time.Parse("2006-01-02 15:04:05", "2022-05-19 08:35:54")
	fmt.Println(t.Unix())
	// 时间戳延长一周、一月、一年
	fmt.Println(time.Unix(1652949354, 0).UTC().Add(2 * time.Hour).Format("2006-01-02 15:04:05"))
	fmt.Println(time.Now().Add(2 * time.Hour).Format("2006-01-02 15:04:05"))
	// 时间戳后退一周、一月、一年
	fmt.Println(time.Now().Add(-1 * time.Hour).Format("2006-01-02 15:04:05"))
	fmt.Println(time.Unix(1652949354, 0).UTC().Add(-1 * time.Hour).Format("2006-01-02 15:04:05"))

	// 时间格式延长一周、一月、一年
	timeStr := "2022-05-19 08:03:51"
	t, _ = time.Parse("2006-01-02 15:04:05", timeStr)
	fmt.Println(t.Add(3 * time.Hour).Format("2006-01-02 15:04:05"))

	t, _ = time.Parse("2006-01-02 15:04:05", time.Now().Format("2006-01-02 15:04:05"))
	fmt.Println(t.Add(1 * time.Hour).Format("2006-01-02 15:04:05"))
	// 时间格式后退一周、一月、一年
	t, _ = time.Parse("2006-01-02 15:04:05", timeStr)
	fmt.Println(t.Add(-3 * time.Hour).Format("2006-01-02 15:04:05"))

	t, _ = time.Parse("2006-01-02 15:04:05", time.Now().Format("2006-01-02 15:04:05"))
	fmt.Println(t.Add(-1 * time.Hour).Format("2006-01-02 15:04:05"))
```

