# GitHub使用技巧

github[文档地址](https://docs.github.com/cn/get-started)

## 1、搜索

- 在网页内按下`s`就可以定位到搜索框内进行搜索
- 进入[搜索页面](https://github.com/search/)后可以进行高级搜索，对想要的项目进行筛选
- 进入单个项目后按下`t`键就可以在本项目内进行文件搜索

## 2、项目调研

**编辑器内查看源码**

打开单个项目后按下`。`就可以在VS编辑器内打开项目进行查看了

**运行源码**

在项目地址前添加`gitpod.id/#/`就可以在线运行项目了

```curl
https://github.com/bnkamalesh/webgo
添加后的地址
https://gitpod.io/#/github.com/bnkamalesh/webgo
```



# Git使用

```go

+---------------+--------------+------------------------+-----------------------+----------------------+
|        work directory        |    staging area        |      repository       ||  remote repository  |
|_______________|______________|                        |                       ||                     |
|added git file |edit/add file |                        |                       ||                     |
|               |              |                        |                       ||                     |
|     ---(1)auto check--->     |                        |                       ||                     |
|               |              |                        |                       ||                     |
|               |      ---(2)--git add--->              |                       ||                     |
|               |              |                        |                       ||                     |
|               |              |               ---(3)--git commit--->           ||                     |
|               |              |                        |                       ||                     |
|               |              |                        |     ---(4)--git push origin XXbranch--->     |
|               |              |                        |                       ||                     |
|               |              |                        |     ---(5)--git fetch origin XXbranch--->    |
|               |              |                        |                       ||                     |
|               |              |      <---(6)--git reset --soft XXversion---    ||                     |
|               |              |                        |                       ||                     |
|               |      <---(7)--git reset HEAD---       |                       ||                     |
|               |              |                        |                       ||                     |
|      <---(8)git checkout---  |                        |                       ||                     |
|               |              |                        |                       ||                     |
|               |      <----(9)--git reset --mix XXversion-----                 ||                     |
|               |              |                        |                       ||                     |
|      <---------(10)--git reset --head XXversion----------------               ||                     |
|               |              |                        |                       ||                     |
|      <----(11)--git merge origin/XXbranch  git rebase origin/XXbranch------   ||                     |
|               |              |                        |                       ||                     |
|      <----------------------------(12)--git pull origin XXbranch----------------------------         |
|               |              |                        |                       ||                     |
+---------------+--------------+------------------------+-----------------------+----------------------+

```





