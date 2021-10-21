# 一、ES6部分

## 1、let和var和const

**var** 针对if、for 是没有块级作用域，var命令会发生“变量提升”现象，即变量可以在声明之前使用，值为undefined

**let**所声明的变量只在let命令所在的代码块内有效(包含if、for)

**const**是声明常量时使用的关键字

- 函数有自己的作用域，var let都能够在函数内限定其作用域只在函数内部使用
- let声明变量存在暂时性死区（即变量会绑定某个区域，不受外部影响）
- let在变量没有声明时使用，使用会报错；var会返回undefind
- const 修饰的的标识符不可再次赋值，以保证数据的安全性
- const的含意是指向的对象不能进行修改，但是可以改变对象内部的属性

```js
var btns = document.getElementsByTagName('button');
// for (var i=0; i < btns.length; i++) { // 点击所有的按钮后打印的都是相同的结果（使用闭包来解决）
for (let i=0; i < btns.length; i++) { // 使用let后for内形成自己的作用域，会打印出各自的内容
    btns[i].addEventListener('click', function(){
        console.log('第' + i + '个按钮被点击');
    });
}

// const使用注意
const name = 'jack';
name = 'rose'; // 错误不可修改

const age; // 错误 必须要进行赋值
```

## 2、对象增强写法

#### 属性

```js
// ES6之前
let name = 'jack';
let age = 18;
let obj1 = {name: name, age: age};

// ES6之后
let obj2 = {name, age}; // 和上面obj1结果是一样的
```

#### 方法

```js
// ES6之前
let obj1 = {
    getName: function(){
        console.log('my name is jack');
    }
}

// ES6之后
let obj2 = {
    getName() {
        console.log('my name is rose'); // 和上面的结果是一样的
    }
}

```

#### 解构

有对象、数组解构

```js
// 对象的解构
const obj = {name: 'jack', age: 12}
const {name, age} = obj
console.log(name, age) // 'jack' 12

// 数组的解构
const arr = [12,23]
const {arr1, arr2} = arr
console.log(arr1, arr2) // 12 13
```



# 二、Vue基础

### 1、常用指令

#### v-on

绑定事件监听，缩写是@，参数为event

**参数传递**

```js
//<button v-on:click="myClick">点我</button>

<button @click="myClick">点我</button>
// 1、写方法时省略了小括号，但是方法本身是需要一个参数的，这个时候，Vue会默认将浏览器产生的event事件对象作为参数传递到方法内

<button @click="myClick('jack', $event)">点我</button>
// 2、定义方法时，若同时需要event对象和其它参数时，使用$event
```

**修饰符**

在拿到event时可以进行一些事件处理，Vue也提供了一些修饰符来帮助我们方便处理一些事件

- .stop -- 调用event.stopPropagation()
- .prevent -- 调用event.preventDefault()
- .enter -- 特定键触发
- .once -- 只触发一次

```js
// 停止冒泡
<button @click.stop="myClick">点我</button>

// 阻止默认行为,如表单提交
<button @click.prevent="myClick">点我</button>

// 关联修饰符
<button @click.stop.prevent="myClick">点我</button>

// 键别名
<button @keyup.enter="myClick">点我</button>
<button @keyup.13="myClick">点我</button>

// 只触发一次
<button @click.once="myClick">点我</button>
```



#### v-if-ifelse-else



#### v-show



#### v-for



#### v-model

对表单元素进行双向数据绑定。

**原理：**v-model 双向绑定实际上就是通过子组件中的$emit方法派发 input 事件，父组件监听 input 事件中传递的 value 值，并存储在父组件 data 中；然后父组件再通过 prop 的形式传递给子组件 value 值，再子组件中绑定 input 的 value 属性即可。

也可理解为分两步进行操作，第一步使用v-bind为表单元素绑定属性，第二步使用v-on监听表单元素的input的事件，并在事件内重新设置值，从而实现双向数据绑定

```js
<input type='test' :value='message' @input='valueChange'> // 第一种方式
<input type='test' :value='message' @input='message = $event.target.value'> // 第二种方式
<input type='test' v-model='message'> // 第三种方式
    
<script>
    const app = Vue({
        data: {
            message: 'yes',
        }
        methods: {
        	valueChange(event) {
        		this.message = event.target.value;
    		}
        }
    })
</script>
```

**修饰符：**

**lazy：** v-model.lazy 可以让数据在失去焦点呀回车时才会更新

**number：** v-model.number 默认情况下输入的内容都会认为是字符串；number可以让在输入框中输入的内容自动的转换为数字类型

**trim：** v-model.trim 如果在输入时首尾都有很多的空格，trim修饰符可以过滤左右两边的空格。

```js
<input type='text' name="name" v-model.lazy='age'>
<input type='text' name="name" v-model.number='age'>
<input type='text' name="name" v-model.trim='age'>
```





### 2、常用操作

#### a、splice

Vue中对数组的操作中哪些方法是响应式的呢？

以下方法Vue内部是已经添加的监听的，所以可以使用并能生效

- arr.push(...items) 在数组最后添加一个或多个元素

- arr.pop(...items) 删除数组中最后一个元素

- arr.shift() 删除数组中第一个元素

- arr.unshift(...items) 在数组最前面添加一个或多个元素

- arr.splice(start, deleteCount, ...items) 删除元素/插入元素/替换元素

  ```js
  var arr = ['a', 'b', 'c', 'd', 'e', 'f'];
  // 删除元素: 第一个位置为开始位置，第二个参数传入要删除的元素个数（若没有传递，则删除后面所有的元素）
  arr.splice(1, 3) // ['a', 'e', 'f']
  // 插入元素：第一个位置为开始位置，第二个参数传入0表示不进行删除，后面跟上要插入的元素
  arr.splice(1, 0, 'g', 'i', 'h') // ['a', 'g', 'i', 'h', 'b', 'c', 'd', 'e', 'f']
  // 替换元素：第一个位置为开始位置，第二个参数为要替换的元素个数，后面是要替换的元素
  arr.aplice(2, 2, 'm', 'n') // ['a', 'b', 'm', 'n', 'c', 'd', 'e', 'f']
  
  // 注：在Vue中使用索引对数组进行变更值时，是不能生效的
  arr[0] = 'aaaa';  // 在页面上是不生效的
  ```


#### b、filter/map/reduce

**Vue中高阶函数的使用：**

**filter：** callback(currentValue,index,arr) 其参数为回调函数，回调函数必须要返回一个布尔值；返回值为一个新的数组。

```js
const arr = [10, 20, 40, 80, 100, 120];
// 过滤小于100的数
let newArr = arr.filter(function(n){return n < 100}); // [10, 20, 40, 80]
let newArr = arr.filter(n => n < 100); // [10, 20, 40, 80]
```

**map：** callback(currentValue, index,arr)，内部是映射，返回对原数据处理后的数据，法返回一个新数组，数组中的元素为原始数组元素调用函数处理后的值。方法按照原始数组元素顺序依次处理元素。

```js
const arr = [10, 20, 40, 80, 100, 120];
// 对每一个元素进行乘2
let newArr = arr.map(function(n) {return n*2}); // [20, 40, 80, 160, 200, 240]
let newArr = arr.map(n => n*2) // [20, 40, 80, 160, 200, 240]
```

**reduce：**callback(total,currentValue, index,arr)，要传递两个值，total为计算结束后的返回值；currentValue为当前元素；返回值为计算结果。

```js
const arr = [10, 20, 40, 80, 100, 120];
// 对一个数组进行累加
let count = arr.reduce(function(total, n){return total + n}) // 370
let count = arr.reduce((total, n) => total + n); // 370
```



### 3、Vue组件

组件是可复用的 Vue 实例，组件分为全局组件和局部组件；组件内的data必须是一个函数

- 定义组件

  ```js
  // 原始定义
  const component1 = Vue.extend({
      template: `<h2>你好</h2>`,
      // components: {other: otherComponent,} // 这里可以定义子组件
  })
  // 简化定义，又称组件的语法糖写法
  Vue.components({
      component1: {
          template: `<div>{{name}}</div>`,
          // components: {other: otherComponent,} // 这里可以定义子组件
      },
      data() {
          reutrn {
              name: '你好呀',
          }
      }
  });
  ```

- 注册组件

  ```js
  // 若使用extend 定义的组件注册时使用下面的方式
  Vue.components({
      component1: component1,
  });
  
  // 另一种就是定义的同时就进行了注册，如上面的简化定义
  ```

- 使用组件

  ```js
  // 若组件定义且注册好后就可以在模板中使用了
  <compnent1></component1>
  
  // 注：组件在哪里注册了就只能在哪里使用，如：在子组件内注册了就不能在父组件内使用，反之在父组件内注册了是可以在子组件内使用的
  ```

- 模板抽离

  在组件中把模板进行分离出来会使用逻辑更加的清晰

  ```js
  // 分离后的模板
  <template id="tep1">
  	<div>
      	<h2>你好呀，这是一个分离的模板</h2>
      </div>
  </template>
  
  const app = new Vue({
      el:'#app',
      data: {
          message: '我的消息'
      },
      components:{
          'component1': {
  			template: '#tep1', // 绑定分离的模板
          }
      },
  });
  ```

  **问题：组件内的data为什么要是个函数呢？**

  当一个组件在页面上多次使用时，每一个组件都有自己的data，若不是一个函数时，则就会使数据变乱而使数据交叉使用，而函数内部有自己的作用域。

### 4、父子组件

在子组件中是不能引用父组件或都Vue实例的数据的；

两种情况：

**父传子：** 通过props向子组件专递数据

**子传父：** 通过$emit event事件向父组件发送消息



#### a、父传子

```js
// 父传子
/*父组件中使用v-bind来进行数据绑定到子组件上*/
<component1 v-bind:message='maessage' :name='name' :age='23 + 12'></component1>

/*在子组件内接收值的时候使用props关键字*/
Vue.component(
    'component1': {
    // props: ['message', 'name', 'age']
    props: {
        message: {
            type: String, // 类型
            required: true, // 是否是必须的
            default: 'jack' // 默认值
        },
        name: String,
        age: [String, Number] // 多种数据类型
    } // 可以是一个数组或是一个对象
    data() {
        return {}
    },
    created: {},
    methods: {},
});
```

props中的验证支持的数据类型有：

- String

- Number

- boolean

- Array 若有默认值时，那么默认值就需要是一个函数，函数的返回值是一个数组

- Object 若有默认值时，默认值就需要是一个函数，函数的返回值是一个对象

- Date

- Function

  

**注：** 在父向子传递参数的时候，使用全小写的驼峰的命名方式是不一样的哟

```js
// 父组件传递值时要使用和中划线时，子组件才能以驼峰的方式来接收参数哟
<component1 :my-name='name' :myage="age"></component1>

// 在子组件内接收时，若使用驼峰时来接收时，父传递值时就要使用中划线来进行分隔，如：my-name
Vue.component({
    'component1': {
        template: '#tpm',
        props: {
            myName: { // 此时的驼峰命名才是可以使用的
                type: String
            },
            myage:{
                type: Number
            }
        },
        data() {
            reutrn {}
        },
        created: {}
    }
});
```

#### b、子传父

需要用到自定义事件来传递值。v-on不仅仅可以用于监听DOM事件，也可以用于组件间的自定义事件。

**注：**在子组件内的事件名称最好不要使用驼峰命名，建议使用中划线（在脚手架内是可以使用驼峰的）。

- 在子组件内，通过使用$emit()来触发事件
- 在父组件内，通过v-on来监听子组件事件

```js
// 在子组件内
Vue.component({
    'component1': {
        props: ['name'],
        methods: {
            getName() {
                var name = 'jack';
                this.$emit('get-name', name);
            }
        }
    }
});

// 在父组件内 通过v-on来监听子组件的事件，并绑定到自己的方法上做进一步的处理
<component1 :get-name='getName' :name="age"></component1>
const app = new Vue({
    el: '#app',
    data() {},
    methods: {
        getName(name) {
           consoel.log(name); // jack
        }
    }
});
```

#### c、父组件访问子组件

**$ref：** vue中我们可以使用$ref来获取dom节点，进行一些dom的操作。

若使用在子组件上，可以用来获取子组件的属性（那么通过ref就能获取到子组件中的data和methods）

```js
<h1 ref="h1Ele">这是H1</h1>
<hello ref="ho"></hello>

// ref的使用
methods: {
    getRef () {
        this.$refs.h1Ele.style.color = 'red' // 修改html样式
        console.log(this.$refs.ho.msg);// 获取组件数据
        console.log(this.$refs.ho.test);// 获取组件的方法
    }
}
```



### 5、计算属性

computed其是被动的，若其所依赖的数据发生变动时其值就会发生变化。

**特点：**

- 支持缓存，只有依赖数据发生改变，才会重新进行计算。
- 不支持异步，当computed内有异步操作时无效，无法监听数据的变化。
- computed 属性值会默认走缓存，计算属性是基于它们的响应式依赖进行缓存的，也就是基于data中声明过或者父组件传递的props中的数据通过计算得到的值。
- 如果一个属性是由其他属性计算而来的，这个属性依赖其他属性，一般使用computed。

**本质：** funName() {set(),get()} 里面有set、get方法，但是set方法不常用通常会写成简洁的写法：

```js
// 这是简洁的写法
conputed: {
    getName: function() {},
    getAge: function() {}
}

// 这是原始的写法
computed: {
    getName: {
        set() {},
        get() {}
    },
    getAge: {
        set() {},
        get() {}
    }
}
```

**计算属性VS方法：**

- 计算属性在多次使用时只会调用一次，而methods会多次调用
- 计算属性是自带缓存的，而方法是没有缓存的

### 6、侦听属性

watch其是主动的，若其本身发生变化时，可以在其方法内处理依赖它的其它数据，使其它数据随自身变化而变化。

**特点：**

- 支持缓存，数据变，直接会触发相应的操作。
- watch支持异步。
- 监听的函数接收两个参数，第一个参数是最新的值；第二个参数是输入之前的值。
- 当一个属性发生变化时，需要执行对应的操作，一对多关系。
- 监听数据必须是data中声明过或者父组件传递过来的props中的数据，当数据变化时，触发其他操作。

```js
watch: {
    name: function(newVlaue, oldValue) {
        console.log(newValue, oldValue) // newValue是新的数据，oldValue是旧的数据
    }
}
```

## 三、Vue路由

[官方文档](https://router.vuejs.org/zh/)

前端路由，通过hash/history把单页面通过路由实现多页面

- 安装Vue-router  npm install vue-router --save

- 在模块化工程中使用它(因为是一个插件，所以可以通过Vue.use()来安装路由功能)

  - 导入路由对象且调用 Vue.use(VueRouter)
  - 创建路由实例，并且传入路由映射配置
  - 在Vue实例中挂载上一步创建的路由实例

- 使用路由

  - 创建路由组件（也就是一个普通的组件）

  - 配置路由映射（组件和路径映射关系）

  - 使用路由：通过<router-link> 和 <router-view> 两个组件来使用路由
  
    **router-link** 该标签是一个vue-router内已经内置的组件，它会被默认渲染成一个<a>标签
  
    - tag 可以指定router-link 渲染成什么标签 如：tag='li' 就会渲染成为li标签
    - replace 不会留下history记录，前进后退都不可用（history.replaceState）
    - active-class 当对应的路由匹配成功时会自动的为当前元素添加一个对应的类名；如：active-class='active'
  
    **router-view** 该标签会根据当前的路径动态渲染出不同的组件，路由切换时，切换的是router-view挂载的组件，其它内容不会发生变化

```js
// 和主入口文件同级创建router文件夹，之后在router文件夹内创建index.js文件作为路由文件
// index.js 文件内如：
Vue.use(VueRouter)
let routes: [
    {
        path: '/', // 默认的首页是定向到home页
        redirect: '/home'
    }
    {
        path: '/home',
        component: Home
    }
    {
        path: '/about',
        component: About
    }
]
const router = new VueRouter({
  mode: 'history', // 模式，默认是hash模式
  routes, // 路由配置
  linkActiveCalss: 'active' //当前路由选中时添加的类名
    
})

export default router


// main.js 主入口文件内如：
<template>
    <div id="app">
    	<router-link to="home">首页</router-link>
    	<router-link to="about">关于</router-link>
    </div>
</template>
```

### 1、$router

$router是vue-router注册到全局的变量，可以使用$router直接进行操作路由跳转

$router是注册的整个路由对象，$route是当前活跃的路由对象

```js
// 跳转到指定页面
this.$router.push('/home') // 相当于histroy.pushState()
this.$router.replace('/about') // 相当于history.replaceState()
```

### 2、$route

表示当前活跃的那个路由，可以通过$route获取当前路由的参数

```js
// 在注册路由时为路由动态的添加参数（router/index.js文件内）
let routes: [
    {
        path: '/user:userId',
        component: About
    }
]

// 在user对应的组件内user.vue中获取路由的参数
console.log(this.$route.params.userId) // 获取到路由的参数
```

### 3、路由懒加载

路由懒加载的主要作用就是将路由对应的组件打包成一个一个js代码块，只有这个路由被访问到时才加载对应的组件。

使用懒加载可以提高首次加载时的效率。

```js
// 使用路由懒加载（router/index.js文件内）
Vue.use(VueRouter)
const Usre = () => import('../component/User') // 实现路由懒加载
let routes: [
    {
        path: '/user',
        component: User
        // component: () => import('../components/User') // 或这种方式
    }
]
const router = new VueRouter({
  mode: 'history', // 模式，默认是hash模式
  routes, // 路由配置
  linkActiveCalss: 'active' //当前路由选中时添加的类名
    
})

// 打包时就会把每个路由对应的组件打包成单独的一个js代码块(命名为0.XXXXX.js   1.XXXXX.js  2.XXXXX.js .....)
```

### 4、子路由

子路由，也叫路由嵌套，采用在children后跟路由数组来实现，数组里和其他配置路由基本相同，需要配置path和component，然后在相应部分添加<router-view/>来展现子页面信息，相当于嵌入iframe。

```js
// 在router/index.js文件内
Vue.use(VueRouter)
const Usre = () => import('../component/User') // 实现路由懒加载
const UsreOne = () => import('../component/UserOne') // 实现路由懒加载
let routes: [
    {
        path: '/user',
        component: User,
        children: [
            {
                path: '', // 设置默认值
                component: UsreOne
            },
            {
                path: 'userOne', // 以“/”开头的嵌套路径会被当作根路径，所以子路由上不用加“/”;在生成路由时，主路由上的path会被自动添加到子路由之前，所以子路由上的path不用在重新声明主路由上的path了
                component: UsreOne
            }
        ]
    }
]
```

### 5、参数传递

参数传递主要有两种方式：params和query

**params类型：**

- 配置路由格式：/router/:id
- 传递方式：在path后面跟上对应的值
- 传递后形成路径：/router/123，/router/abc
- 获取参数值：$route.params.id

**query类型：**

- 配置路由格式：就是普通的配置/router
- 传递方式：对象中使用query的key-value形式传递
- 传递后形成的路径：/router?id=123，/router?name=jack
- 获取参数值：$route.query.id  $route.query.name

```js
// 第一种方式 params
// 在注册路由时为路由动态的添加参数（router/index.js文件内）
let routes: [
    {
        path: '/user:userId',
        component: User
    }
]

// 在user对应的组件内user.vue中获取路由的参数
console.log(this.$route.params.userId) // 获取到路由的参数

// 第二种方式：query
// 在Home.vue组件内传递值时
<template>
    <div>
    	<router-link :to="{path: '/home', query: {name: 'jack', age: 12}}">关于</router-link> // 对to使用v-bind进行绑定值
    </div>
</template>
// 获取参数值时
methods: {
    getName () {
        console.log($route.query.name)
    }
}

// 更多用法
// 不使用router-link进行跳转的情况：
methods: {
    // 使用params方式
    goUser () {
        this.$router.push('/user/' + 12)
    },
    // 使用query方式
    goHome () {
        this.$router.push({
            path: '/home',
            query: {
                name: 'jack',
                age: 12
            }
        })
    }
}
```

### 6、路由守卫beforeEach

或者叫 **全局钩子** 、**导航守卫**

用动态路由，判断用户是否登录跳转登录页面还是主页面，判断是否登录，判断页面是否存在，不存在跳转登录页面；或为每一个页面设置自己的title及keywords。优点是能适用多钟情况，体验感好。

- 全局前置守卫beforeEach：当一个导航触发时，路由跳转前执行的。
- 全局后置守卫afterEach：当一个导航触发时，路由跳转后执行的。

```js
// 在route/index.js文件内操作

// to: Route: 即将要进入的目标 路由对象
// from: Route: 当前导航正要离开的路由
// next: Function: 一定要调用该方法使执行继续运行，next('/') 或者 next({ path: '/' }): 跳转到一个不同的地址。当前的导航被中断，然后进行一个新的导航。
const routes = [
    {
        path: '/user:userId',
        component: User
    }
]
router.beforeEach((to, from, next) => {
    // 此处可以进行一些值的获取，如：获取title、keywords并进行设置
    // 也可以进行一些特殊逻辑的判断，如：对某个路由进行处理、或进行登录的验证
	console.log(to); // 其是routes数组中定义的某个元素
    console.log(from);// 其是routes数组中定义的某个元素
    next(); // 一定要调用此方法，否则路由就会中断
},
  
// 全局后置守卫，但没有next参数  
router.aftrEach((to, from) => {
	//同上面一样
}
```

### 7、路由独享钩子

给某个路由单独使用的，是特指的某个路由，一般定义在router当中。

- beforeEnter：前置钩子函数，使用如：未登录去下单，跳转到登录页面
- beforeLeave：后置钩子函数，使用如：改变浏览器title

```js
// 在route/index.js文件内操作，准确来说对定义的const routes进行操作
// to: Route: 即将要进入的目标 路由对象
// from: Route: 当前导航正要离开的路由
// next: Function: 一定要调用该方法使执行继续运行，next('/') 或者 next({ path: '/' }): 跳转到一个不同的地址。当前的导航被中断，然后进行一个新的导航。

const routes = [
    {
        path: '/user:userId',
        component: User,
        beforeEnter: (to, from, next) => {
			// 此处可以进行一些值的获取，如：获取title、keywords并进行设置
            // 也可以进行一些特殊逻辑的判断，如：对某个路由进行处理、或进行登录的验证
            console.log(to); // 其是routes数组中定义的某个元素
            console.log(from);// 其是routes数组中定义的某个元素
            next(); // 一定要调用此方法，否则路由就会中断
        },
        beforeLeave: (to, from, next) => {
			// 此处可以进行一些值的获取，如：获取title、keywords并进行设置
            // 也可以进行一些特殊逻辑的判断，如：对某个路由进行处理、或进行登录的验证
        }
    }
]
```



### 8、组件路由钩子

监听页面进入，修改，和离开的功能。

- beforeRouteEnter：页面路由进入时
- beforeRouteUpdate：页面路由变更时
- beforeRouteLeave： 页面路由离开时

```js
// 组件路由是在各自己的组件内进行操作的，和created、method等属性并列
// 参数同上面一样

created: {},   
computed: {},
method: {}
beforeRouteLeave(to, from, next) {
	// ....
	next()
},
beforeRouteEnter(to, from, next) {
	// ....
	next()
},
beforeRouteUpdate(to, from, next) {
	// ....
	next()
}
```

### 9、router-view遇见keep-alive

若不希望组件被重新渲染影响使用体验；或者处于性能考虑，避免多次重复渲染降低性能。而是希望组件可以缓存下来,维持当前的状态。这时候就可以用到keep-alive组件。

- 当组件在 <keep-alive> 内被切换，它的 activated 和 deactivated 这两个生命周期钩子函数将会被对应执行。

- activated 和 deactivated 将会在 <keep-alive> 树内的所有嵌套组件中触发。 主要用于保留组件状态或避免重新渲染

**使用场景：**商品列表页点击商品跳转到商品详情，返回后仍显示原有信息；多级菜单下选中某个二级菜单再次回到菜单时还是原来的选中状态

**补充：**keep-alive有两个重要的属性

​	属性对应的值就是每个组件内的name名

- include 字符串或正则表达式，只有匹配的组件会被缓存
- declude 字符串或正则表达式，任何匹配的组件都不会被缓存

```js
// 在某个组件内的模板中使用keep-alive
<div id="app" class='wrapper'>
    <keep-alive exclude="user,about">
        <!-- 需要缓存的视图组件就使用keep-alive进行包裹 --> 
        <router-view></router-view>
     </keep-alive>
      <!-- 不需要缓存的视图组件就不需要使用keep-alive包裹 -->
     <router-view></router-view>
</div>

export default {
  name: 'Dialog8',
  data () {},
  created () {
    console.log('created')
  },
  activated () {
      // 前提：当组件被keep-alive包裹时此方法才会生效
      // 被调用时机：当前组件处于激活状态时
      console.log('activated ...')
  },
  deactivated () {
      // 前提：当组件被keep-alive包裹时此方法才会生效
      // 被调用时机：当前组件从激活状态变为非激活状态时
      console.log('deactivated ...')
  }
}
```

# 四、promise

Promise意在让异步代码变得干净和直观，让异步代码变得井然有序。Promise是一个构造函数，所以可以 **new** 出一个Promise的实例。

其有两个函数 **resolve** (成功之后的回调函数)和 **reject** (失败后的回调函数)

- 状态1：异步执行 **成功**，需要在内部调用成功的回调函数resolve把结果返回给调用者
- 状态2：异步执行 **失败**，需要在内部调用失败的回调函数reject把结果返回调用者

```js
// 使用promise来进行异步的操作

// ####--> 第一种方式：在then里放置两个函数来处理成功和失败
new Promise((resolve, reject) => {
    // 假设setTimeout是异步的请求操作
    setTimeout(function(){
        const name = 'jack'
        if (name === 'jack') {
            // 成功时
            resolve(name)
        } else {
            // 失败时
            reject(name)
        }
    }, 1000)
}).then(data => {
    // 成功时会执行
    console.log(data)
}, error => {
    // 失败时会执行
    console.log(data)
})

// ####--> 第二种方式：使用then catch 来处理成功和失败
new Promise((resolve, reject) => {
    // 假设setTimeout是异步的请求操作
    setTimeout(function(){
        const name = 'jack'
        if (name === 'jack') {
            // 成功时
            resolve(name)
        } else {
            // 失败时
            reject(name)
        }
    }, 1000)
}).then(data => {
    // 成功时会执行
    console.log(data)
}).cache(data => {
    // 失败时选择
    console.log(data)
})
```

## 1、promise链式调用

在使用中会发现无论是then还是catch都可以返回一个Promise对象，所以代码就可以进行链式调用了。

```js
// #### ---> 链式调用的正常写法
new Promise((resolve, reject) => {
    // 假设setTimeout是异步的请求操作
    setTimeout(function(){
        resolve('promise')
    }, 1000)
}).then(data => {
    // 成功时会执行
    console.log(data) // promise
    return Promise.resolve(data + '111')
}).then(data => {
    // 成功时会执行
    console.log(data) // promise111
    return Promise.resolve(data + '222')
}).then(data => {
    // 成功时会执行
    console.log(data) // promise111222
    return Promise.reject(data + 'error')
}).then(data => {
    // 这部分不会执行，因为上面的reject调用了
    console.log(data) // 这一步不会执行
    return Promise.reject(data + '333')
}).catch(data => {
    // 失败时执行
    console.log(data) // promise111222error
    return Promise.resolve(data + '444')
}).then(data => {
    // 成功时会执行
    console.log(data) // promise111222error4444
})

// #### ---> 链式调用的简化写法，可以把Promise.resolve省略了
new Promise((resolve, reject) => {
    // 假设setTimeout是异步的请求操作
    setTimeout(function(){
        resolve('promise')
    }, 1000)
}).then(data => {
    // 成功时会执行
    console.log(data) // promise
    return data + '111'
}).then(data => {
    // 成功时会执行
    console.log(data) // promise111
    return data + '222'
}).then(data => {
    // 成功时会执行
    console.log(data) // promise111222
})
```

## 2、promise的all方法

当一个页面可能有多个并发请求(异步请求)，我们想在所有请求完成后去处理一些逻辑，`promise.all`很好解决这个问题。

```js
// 当一个页面有多个异步请求时，下面来模拟一下（如在methods方法内）
methods: {
    init () {
      // 里面以数组的形式，可以放好多个异步请求哟
      Promise.all([
        // 这是第一个异步请求
        new Promise((resolve, reject) => {
          setTimeout(() => {
            const data = {name: 'jack', age: 18}
            resolve(data)
          }, 3000)
        }),
        // 这是第二个异步请求
        new Promise((resolve, reject) => {
          setTimeout(() => {
            const data = {name: 'rose', age: 17}
            resolve(data)
          }, 3000)
        }),
      ]).then(res => {
        console.log(res) // 此处的res为数组 [{name: 'jack', age: 18},{name: 'rose', age: 17}]
      })
    }
```

# 五、vuex

vuex是一个专门为Vue.js应用程序开发的**状态管理模式**

**状态管理、集中式存储管理**这些名词听起来高大上，让人捉摸不透。可以简单的将其看成，把需要多个组件共享的变量全部存储到一个对象里面（全局变量）核心也是使用Vue.prototype.paramName = paramValue

使用场景：

- 用户的登录状态、用户名、头像、地理位置
- 商品的收藏、购物车

## 1、state

状态管理工具的唯一的数据源，所有的共享数据都储存在里面（ 类似于组件内的data）

在组件内使用的时候方式：this.$store.state.数据名

```js
// 使用vuex时和使用router是一样的步骤，因为同样都是插件
// 创建store文件夹，在其内创建index.js文件（这里写vux的内容）

import Vue from 'vue'
import Vuex from 'vuex'

// 第一步：安装插件
Vue.use(Vuex)

// 第二步：创建对象
const store = new Vuex.store({
    // 状态管理工具的唯一的数据源，所有的共享数据都储存在里面（ 类似data）
    // 使用: 在组件内this.$store.state.数据名
    state: {
        name: 'jack',
        count: 0,
        id: [23,34,45,56,78,89],
        info: {
            age: 18, // Vuex会为每一个值创建一个对应的Watcher来观察其变化，以便实现响应式
            height: 1.88 // Dep => [Watcher1, Watcher2, ......]
        }
    },
    // mutations使用与事件处理函数非常相似，都具有类型和回调函数(类似methods，不过获取state中的变量不是this.变量名，而是state.变量名)
    // 使用：在组件内this.$store.commit('方法名')
    mutations: {
        incrCount (state) {
            state.count++
        }
    },
    actions: {},
    // getters属性类似组件中的计算属性（computed）,当数据被调用过且没发生改变时，之后的调用就到缓存区中找
    // 使用：在组件内this.$store.getters.方法名
    getters: {
        getAgeBy (state) {
            // 此处若有参数要返回一个函数来进行接收参数并进行处理
            reutrn (age) => {
                return state.id.filter(i => i >= age)
            }
        },
        // 第一个参数必为state,第二个参数必为getters
        getAgeLenght (state, getters) {
            return getters.getAgeBy(50).length
        },
        getMultiParam (state) {
            reutrn (payload) => {
                console.log(payload) // 这是一个对象，内部有多个参数
            }
        }
    },
    modules: {}
})

// 第三步： 导出store
export default store
```

```js
// vuex注册到全局后就可以使用了（相当于Vue.prototype.$store = store）
// 可以在各组件内使用$store
methods: {
    getName () {
        const name = this.$store.state.name // 从Vuex中获取数据
        console.log(name)
    },
    addCount () {
        // 第一种方式
        this.$store.commit('incrCount') // 调用Vuex中的方法
    },
    getAgeLg (age) {
        reutrn this.$store.getters.getAgeBy(age) // 调用Vuex中的方法并传递参数
        return this.$store.getters.getMultiParam({name: 'jack', age: 14}) // 调用Vuex中的方法传递多个参数
    }    
}


```

## 2、getters

getters属性类似组件中的计算属性（computed）,当数据被调用过且没发生改变时，之后的调用就到缓存区中找

在组件内使用方式：this.$store.getters.方法名

getter内的方法有两个参数（且只能有两个参数）

- state 数据对象
- getters 其本身的对象

若要携带参数时可返回一个匿名函数

```js
getters: {
    // 获取年龄大于某个值的用户列表
    getIdLt (state) {
        return (reload) {
            return this.id.filter(id => id >= reload)
        }
    }
}

// 在组件内使用
methods: {
    getId () {
        this.$store.getters.getIdLt(12) // 使用Vuex中的getters
    }
}
```

## 3、mutations

mutations使用与事件处理函数非常相似，都具有类型和回调函数(类似methods，不过获取state中的变量不是this.变量名，而是state.变量名)

结构组成：

- 字符串的事件类型（type）
- 一个回调函数（handler），该回调函数的第一个参数就是state

使用方式：在组件内this.$store.commit('方法名')

**注：**其是Vuex中对state值进行更新的唯一方式

**建议：**把mutations内的方法名写成常量的方式（在一个单独的文件内定义），这样就能更好的实现方法名的统一（减少多次写方法名）

```js
mutations: {
    addCount (state, payload) {
        state.count++
        
        // payload(负载)是一个对象
        // 第一种方式调用时
        console.log(payload) // 12
        // 第一种方式调用时
        console.log(payload) // {type: 'addCount', count: 12}
    },
    updateInfo (state, payload) {
        state.info.age = payload.age
        // 可以使用Vue内置的方式来变更值
        Vue.set(state.info, 'age', payload.age)
        Vue.delete(state.info, 'age')
    },
    // 此处可以以方括号的形式来把方法名变为常量
    [FunName] (state) {
        cosole.log(state.name)
    }
}


// 在组件内使用
methods: {
    addCount () {
        // 第一种方式
        this.$store.commit('addCount', 12)
        // 第二种使用方式
        this.$store.commit({
            type: 'addCount',
            count: 12
        })
    },
    updateInfo () {
        this.$store.commit({
            type: 'updateInfo',
            age: 19
        })
    },
    test () {
        this.$store.commit(FunName)
    }
}
```

## 4、actions

当有异步的数据时，需要把异步的请求放到actions内来处理，这样的目的是为人让devTool这个工具能够监听到数据的变化

```js
mutations: {
    initData (state, payload) {
        console.log(payload)
    }
},
actions: {
    // 第一种方式（普通）
    // 第一个参数为上下文，第二个参数为负载
    getUrlData (context, payload) {
        setTimeout(() => {
            context.commit('initData') // 调用mutations里的方法
            console.log()
        }, 1000)
    },
    // 第二种方式（优雅）
    getUrldata1 (context, payload) {
        return new Promise((resolve, reject) => {
            setTimeout((res) => {
                context.commit('initData', payload) // 调用mutations里的方法
                resolve(res)
            }, 1000)
        });
    }
}

// 在组件内使用
methods: {
    testActions () {
        payload = {}
        // 对应第一种方式（普通）
        this.$store.despatch('getUrlData', payload)
        // 对应第二种方式（优雅）
        this.$store.despatch('getUrlData1')
        .then(res => {
            // 成功时
            console.log(res)
        })
        .catch(res => {
            // 失败时
            console.log(res)
        })
    }
}
```

## 5、modules

当项目越来越大时，都在state/getter/mutations/actions里写时会显的很臃肿，这时使用modules进行模块的划分就是很有必要的了。

当要使用到根中的state时使用rootState

注：各模块中有mutations的名字不要和主中的一至

```js
// 模块一
const modulesA = {
    state: {},
    getters: {
        getM (state, getter, rootState) {
            // rootState可以获取根内的state数据
            console.log(rootState.name)
        }
    },
    mutations: {},
 	...
}
// 模块二
const modulesB = {
    state: {},
    getters: {},
    mutations: {},
 	...
}
    
// 在Vuex中的modules中关联多个模块
modules: {
    modulesA, // 相当于modulesA: mudulesA
    modulesB
}


// 在组件内使用模块
// state使用
this.$store.modulesA.属性名
// mutations使用,和主的是一样的用法
this.$store.commit('方法名')
// getter使用，和主的是一样的用法
this.$store.getter.方法名

```

## 6、Vuex目录结构

若全部在一个文件内(stroe/index.js)写会使文件显的臃肿，可以对文件进行规划

```js
store
|----index.js  # 组装模块并导出的地方
|----actions.js # 根级别的 action
|----mutations.js # 根级别的 mutations
|----modules
	|----modulesA.js # 模块A
	|----modulesB.js # 模块B
    ......
```



# 六、axios

axios 是一个基于Promise 用于浏览器和 nodejs 的 HTTP 客户端。

**特点：**

- 从 node.js 发出 http 请求
- 支持 Promise API
- 拦截请求和响应
- 转换请求和响应数据

**请求方式：**

- axios(config)
- axios.request(config)
- axios.get(url[,config])
- axios.post(url[,data [,config]])
- axios.delete(url[,config])
- axios.head(url[,config])
- axios.put(url[,data [,config]])
- axios.patch(url[,data [,config]])

## 1、安装

```js
// npm安装到线上环境，因为上线后依然要使用 --save-dev为开发环境
npm install axios --save

```

## 2、使用

```js
import axios from 'axios'
// 最简单的使用
axios({
    url: '接口链接',
    method: 'post', // 不写的话默认是get请求
    params: { // 传递参数
        name: 'jack',
        age: 18
    }
}).then(res => {
    console.log(res) // 接口返回的数据
})


// 假如有多个请求同时进行时（并发请求）
axios.all([
    axios.get({url: 'url1'}),
    axios.get({url: 'url2'}),
]).then(result => {
    console.log(result) // 返回一个数组
})

// 可以使用axios.spread将结果数组进行展开[res1,res2] ====>  res1, res2
axios.all([
    axios.get({url: 'url1'}),
    axios.get({url: 'url2'}),
]).then(axios.spread((res1, res2) => {
    console.log(res1)
    console.log(res2)
}))
```

## 3、全局配置

开发中可能很多参数都是固定的（域名，请求头，超时时间，参数等），所以就可以对其进行一些抽离，使用axios的全局配置。

**常用的配置：**

- 请求地址：url
- 请求类型： method
- 请求路径：baseURL
- 自定义的请求头：headers
- URL查询对象：params   --> 对应的get请求的参数
- request body: data  -----> 对应的是post的请求参数

```js
axios.default.baseURL = 'https://melon.com'
axios.default.timeout = 5000
axios({
    url: '路径',
}).then(res => {
    console.log(res) // 接口返回的数据
})
```

## 4、axios实例

当有多个接口时（域名不一样），为了方便管理使用axios实例更为方便。

```js
// 创建一个axios实例
const instance1 = axios.create({
    baseURL: 'url1',
    timeout: 3000
})

// 使用实例
instance1({
    url: '/path1',
}).then(res => {
    console.log(res)
})
instance1({
    url: '/path2',
}).then(res => {
    console.log(res)
})
```

## 5、对axios封装

有时候封装成一个工具是有必要的。

```js
import axios from 'axios'

// 第一种封装方式
export default request(config, success, faild) {
    // 创建axios实例
    const instance = axios.create({
        baseURL: 'url',
        timeout: 2000
    })
    
    instance(config)
        .then(res => {
        	// 成功时
        	success(res)
    	})
        .catch(res => {
        	// 失败时
        	faild(res)
    	})
}

// 第二种封装方式
export default request(config) {
    // 使用promise,并返回
    return new Promise((resolve, reject) => {
        // 创建axios实例
        const instance = axios.create({
            baseURL: 'url',
            timeout: 2000
        })
        instance(config)
        .then(res => {
            // 成功时
            resolve(res)
        })
        .catch(res => {
            // 失败时
            reject(res)
        })
    })
}
// 第二种方式在组件内使用
request({
    url: 'url',
}).then(res => {
    // 成功时
    console.log(res)
})
.catch(res => {
    // 失败时
    console.log(res)
})


// 第三种封装方式
export default request(config) {
    // 创建axios实例
    const instance = axios.create({
        baseURL: 'url',
        timeout: 2000
    })
    
    return instance(config) // 因为axios实例返回的是一个promise对象
}
// 第三种封装方式在组件内的使用和第二种封装方式在组件内的使用是一样的
```

## 6、axios拦截器

拦截器可以让我们在每次请求前、得到响应后进行一些逻辑的处理。

发出请求时：instance.interceptors.request

获得响应时：instance.interceptors.response

**作用：**

- 可以在发出请求时带一些参数
- 可以在发出请求时设置header头信息
- 可以对获取响应数据时做一些逻辑处理

```js
const instance = axiox.create({
    baseURL: 'url',
    timeout: 2000
})

// 发出请求时的拦截
instance.interceptors.request.use(config => {
    console.log(config)
   	// 发出请求时成功
    reutrn config // 必须要返回config以便程度的继续执行
}, err => {
    console.log(err) // 发出请求时失败
})

// 获得响应时的拦截
instance.interceptors.response.use(response => {
    console.log(response.data)
   	// 获得响应时成功
    reutrn response.data // 必须要返回config以便程度的继续执行
}, err => {
    console.log(err) // 获得响应时失败
})
```

