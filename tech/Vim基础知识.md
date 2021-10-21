### 一、常用命令

 变量的作用域global/local/static

- global是全局变量，local是函数内局部变量，static是函数内局部变量

- 全局变量要是局部使用需要用global关键字
- 局部变量不能在全局使用

echo , print 和 print_r的区别:

- echo  - 可以输出一个或多个字符串，没有返回值
- print  - 只能输出一个简单类型变量的值,如int,string，返回值为1
- print_r - 可以输出一个复杂类型变量的值,如数组,对象

### 二、命令全称

#### r/R
replace 替换

#### i/I

insert 插入

#### a/A

append 追加

#### u/U

undo 撤回；`ctrl + r` redo 重新执行

#### ^/$

^加到行首；$回到行尾

#### b/B

before 向前；b为小步；B为大步；

#### e/E

end 向后；e为小步；E为大步；

#### r/R

replace 替换；r为替换一个字母；R为不断的进行替换；

#### f

find 发现；命令`:f`查看当前行的状态

#### d/D

delete 删除；dd删除一行且光标定位到第二行--命令行模式；D删除当前位置到本行尾且光标定位在当前不动--命令行模式；

#### c/C

change 改变；`cc`为删除当前行且光标在当前行首--插入模式；`C`和`cc`作用一样；

#### v/V

visual  视觉的；v普通选择模式；`ctrl + v` 为块选择方式；`V`为行选择方式；

#### y

yank 猛拉；yank === copy

#### p/P

paste 粘贴；p粘贴到当前光标后面；P粘贴到当前光标前面；

#### o/O

open 打开一行；o为open above在上一行添加一行；O为open below在下一行添加一行；



| 运算符  | 名称 | 描述                                         | 实例                                 |
| :------ | :--- | :------------------------------------------- | :----------------------------------- |
| x and y | 与   | 如果 x 和 y 都为 true，则返回 true           | x=6 y=3 (x < 10 and y > 1) 返回 true |
| x or y  | 或   | 如果 x 和 y 至少有一个为 true，则返回 true   | x=6 y=3 (x==6 or y==5) 返回 true     |
| x xor y | 异或 | 如果 x 和 y 有且仅有一个为 true，则返回 true | x=6 y=3 (x==6 xor y==3) 返回 false   |