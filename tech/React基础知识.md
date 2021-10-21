## 一、关于React

React不是一个完整的MVC框架，最多可以认为是MVC中的V（view），甚至React并不非常认可MVC开发模式，React是构建页面UI的库，可以认为React将页面分成了各个独立的小块，第一个块就是一个组件，这些组件之间可以组合、嵌套，就成了页面。

**特点：**

- 虚拟DOM

  其定义了一套变量形式的Dom模型，一切操作和换算直接在变量中操作，减少操作真实的dom

- 组件系统

  将页面中的任何一个区域或者元素都可以看做一个组件Component（html,css,js,image元素的聚合体）

- 单向的数据流

- JSX语法  

### 1、安装

```js
// 全局安装 create-react-app
npm install -g create-react-app

// 创建一个项目
create-react-app your-app
/*
等待一段时间，这个过程会安装三个东西
1、react: react的顶级库
2、react-dom: react有很多的运行环境，如：app端的react-native; web端的使用react-dom
3、react-script: 包含运行和打包react应用程序的所有脚本及配置

安装成功后：
npm start
npm run build
npm test
npm run eject

*/
```



## 二、元素与组件

react中元素和组件的区别

元素：是小写格式的 dev 

组件：是大写的驼峰命名ClassCom

## 1、元素

是React组成应用最小的单元，和Html标签一至，全小写。

## 2、组件

分为两种：函数式组件、类组件

### 函数式组件

以函数的方式定义组件，其返回一个JSX对象

```jsx
// 定义函数式组件
function Childcom(props){
    //这里还可以书写其它的逻辑
    let title = <h2>函数式组件</h2>
    let isShow = true ? <span>这是一个显示的文本</span> : ''
    let myName = props.myName
    return (
        /*这里必须有且只有一个根元素*/
    	<div>
	        {title}
    		this is my name : {myName}
            {/*这里进行注释的书写*/}
            <h1>hello jsx</h1>
    		{isShow}
        </div>
    )
}

// 把组件渲染出来
ReactDOM.rander(
	<Childcom myName="jack"/>
    document.querySelector('#root')
)
```



### 类组件

类组件是要继承React.Component类

```jsx
Class Person extends React.Component{
    // 使用render函数来进行渲染
    render(){
        // 这里同样返回一个JSX对象
        return (
        	<div>
                <h1>hello 类组件</h1>
            </div>
        )
    }
}
```



## 三、JSX原理

JSX 是一个看起来很像 XML 的 JavaScript 语法扩展，JSX 是在 JavaScript 内部实现的

JSX 就是用来声明 React 当中的元素

**原理：**

要明白JSX的原理，需要先明白如何用JavaScript对象来表现一个DOM元素的结构？

```jsx
// 这是一个Html信息
`<div class="app" id="appRoot">
	<h1 class="title">go home</h1>
</div>`
// 其对应的javascript对象如下（也就是虚拟DOM）
{
    tag: 'div',
    attrs: {className: 'app', id: 'appRoot'},
	childen: [
        {
            tag: 'h1',
            attrs: {className: 'title'},
            childen: ['go home']
        }
    ]
}

// 但是用javascript写起来太长了，结构看起来又不清晰，用Html的方式写起来就比较方便。于是React.js就把Javascript的语法扩展了一下，让JavaScript语言能够支持这种直接在JavaScript代码里编写类似Html标签结构的语法，这样写起来就方便多了。编译的过程会把类似Html的JSX结构转换成JavaScript的对象结构。
```



```jsx
let exampleStyle = {background: 'skyblue'}
let className = ['one', 'tow'].join(",")
// 这是一个jsx对象，可使用圆括号进行包括
let element = (
	<div>
    	{/*这里进行注释的书写*/}
    	<h1 className={className} style={exampleStyle}>hello jsx</h1>
    </div>
)

// 上面的elemment变量对应的JSX转换为虚拟DOM后的结构如下：
React.createElement(
	'div', // 标签名
    null, // 标签属性
    React.createElement( // 子组件
		'h1', // 标签名
        {className:'yes', style="color:red;"}, // 属性
        'hello jsx', // 内容
    )
)
```

## 四、组件中DOM样式

### 1、行内样式

想给虚拟DOM添加行内样式，需要使用表达式传入样式对象的方式来实现；

```jsx
// 这里有两个花括号，第一个表示我们要在jsx中插入js，第二个表示对象的括号
<p style="{{color:'red', fontSize:'14px'}}">hello react</p>

// 行内样式需要要写入一个对象，这个对象可以写在很多的地方，比如：render函数内，组件原型上，外链js文件中
let myStyle = {color:'red', fontSize:'14px'}
<p style="{myStyle}">hello react</p>
```



### 2、使用`class`

React推荐我们使用行内样式，因为React觉得每一个组件都是一个独立的整体，注：`class`需要写成`className`（毕竟是在写类js，而class是一个关键字）

```jsx
<p className="hello" style="{myStyle}">hello react</p>
```



### 3、不同条件下添加不同样式

有时候需要根据不同的条件添加不同的样式，推荐使用[classnames](https://www.npmjs.com/package/classnames)这个包

### 4、css-in-js

其是针对React写的一套css-in-js框架（在js中写样式），[styled-components](https://styled-components.com/)包

```jsx
// 定义
import styled from 'styled-components'
const DivContainer = styled.div`
	font-size: 100px;
	color: greenyellow;
`
export {
	DivContainer
}

// 使用,当作是组件来进行使用
<DivContainer>
	this si styled-components
</DivContainer>
```



## 五、组件的数据挂载方式

### 1、属性(props)

`props`正常是外部传入的，组件内部也可以通过一些方式来做初始化的设置，属性不能被组件自己更改，但是可以通过父组件主动重新渲染的方式来传入新的`props`，其是描述性质、特点的，组件自己不能随意的变更。

**获取方式：**

把参数放在标签的属性当中，所有的属性都会作为组件`props`对象的键值，通过箭头函数创建的组件，需要通过函数的参数来接收props;

#### a、设置组件的默认props

```jsx
// 当为类组件时，有两种方式
// 第一种方式在类组件内：为props设置默认值
static defaultProps = {
    title: 'this si defaultProps'
}
// 第二种方式在类组件外：为props设置默认值
ClassCom.defaultProps = {
    title: 'this is out defaultProps'
}


// 当为函数组时
// 为props设置默认值
FunctionCom.defaultProps = {
    title: 'this is out defaultProps'
}

```



#### b、props.children

组件是可以嵌套的，若在使用自定义的组件时需要获取子组件时就需要使用`props.children`

```jsx
// this.props.children为本组件内的内容，有点类似于vue中的<solt>插槽
```

#### c、使用prop-style检查props

vue中有检查及预定props的语法，react中也可以使用[props-types](https://www.npmjs.com/package/prop-types)来检查props的参数类型

```jsx
import PropTypes from 'prop-types'

// 在类组件内对props进行类型的验证
static propTypes = {
    title: PropTypes.string
}
```



### 2、状态（state）

是组件描述某种显示情况的数据，由组件自己设置和更改，也就是由组件自己进行维护，使用状态的目的就是在不同的状态下使组件显示不同(自己管理)

```jsx
class ClassCom extends Component {
    // 定义组件state的第一种方式，在构造函数内定义(推荐)
    constructor(props) {
        super(props)
        this.state = {
            name: 'jack',
            age: 18
        }
    }
    
    // 定义组件的第二种方式，直接进行定义
    /*state = {
        name = 'jack',
        age = 23
    }*/
	
    // 添加一个事件
    handleBtnClick = () => {
        this.setState({
    		name: 'rose'        
        })
    }
    
	render() {
        return (
        	<div>
                hello this is my name: {this.state.name}
                <button onclick={this.handleBtnClick}></button>
            </div>
        )
    }
}
```

`this.props`和`this.state`是纯js对象，在vue中data属性是利用`object.defineProperty`处理过的，更改data的数据时会触发数据的`getter`和`setter`方法；React中没有做这样的处理，若直接进行修改的话，React是无法得知的，所以要使用特殊的更改状态的方法`setState`

setState有两个参数，第一个参数可以是一个对象，也可以是方法return一个对象，我们把这个参数叫做updater

- 参数是一个对象

  ```jsx
  this.setState({
      name: 'melon'
  })
  ```

- 参数是方法

  ```jsx
  // 方法的第一个参数是上一次的state，第二个参数是props
  this.setState((prevState, props) => {
      return {
       	name: prevState + ' rose'   
      }
  })
  ```

- 第二个参数

  setState是异步的，所以要想获取到最新的state，是没有办法获取的，于是就有了第二个参数（回调函数，当state更新成功后会回调此函数）

  ```jsx
  this.setState({
      name: 'melon'
  }, () => {
      console.log('state 更新成功后的回调', this.state.name)
  })
  ```

  

### 3、属性VS状态

**相同点：**都是纯js对象，都会触发render更新

**不同点：**

- 属性能从父元素获取，状态不能
- 属性可以由父组件修改，状态不能
- 属性可以在组件内部设置默认值，状态也可以
- 属性不能在组件内部修改，状态可以
- 属性可以设置/修改子组件的值，状态不可以

`state`的主要作用是用于组件保存、控制、修改自己的可变状态。其在组件内部进行初始化，可以被组件自身修改，而外部不能访问也不能修改，其值可以通过setState方法来更新，setState方法会员导致组件的重新渲染。

`props`的主要作用是让使用该组件的父组件可以传入参数来配置该组件。外部传入的值组件内部是无法控制也无法修改（除非外部组件主动的传入新的props否则组件的props永远保持不变）

**提示：** 尽量少使用`state`，多使用`props`。尽量多写无状态的组件，少写有状态的组件。

### 4、状态提升

如果有多个组件共享一个数据，把这个数据放到共同的父级组件中来管理

```jsx
// 父组件内
state = {
    data: ''
}
child1Click = (data) => {
    tihs.setState({
        data
    })
}
// 通过第一个子组件内接收到父组件的函数，触发后来改变第二个子组件内的显示数据
<child1 changeState="{this.child1Click.bind(this)}"></child1>
<child2 data="{this.state.data}"></child2>
```

### 5、受控组件与非受控组件

组件的数据渲染是否被调用者传递的`props`完全控制，控制内里为受控组件，否则为非受控组件。

```jsx
// 一个组件内
constructo(props) {
    super(props)
    this.ipt = createRef() // 从React中导入  import createRef from 'React'
}
handleChange = () => {
    this.setState({
        data: 'yes'
    })
}

render() {
    return () {
        <div>
            {/*这个input 是一个受控组件*/}
			<input type="text" value="{this.state.data}" onChange={this.handleChange}/>
            
            {/*这个input 是一个非受控组件 使用createRef*/}
			<input type="text" onInput={this.handleChange} ref={this.int}/>
		</div>
    }
}
```

### 6、渲染数据

- 条件渲染

  ```jsx
  // state中
  state = {
      name: condition ? 'jack' : 'rose'
  }
  ```

- 列表渲染

  ```jsx
  render() {
      return () {
          lists.map(item => {
              return (
                  {/*key 就是每一个元素的标识*/}
              	<li key={item.id}>
                      <span>{item.name}</span>
                  </li>
              )
          })
      }
  }
  ```

- dangerouslySetInnerHTML

  第三方来的数据都是不可信的，使用dangerouslySetInnerHTML可以使用html代码生效


## 六、事件处理

### 1、绑定事件

React中的事件采用“on+事件名” 的方式来绑定一个事件，要注意和原生事件的区别，原生事件全是小写如：`onclick`；React事件是驼峰写法`onClick`；

React的事件并不是原生事件，而是合成事件。

### 2、事件handler的写法

- 在组件内使用箭头函数定义一个方法（推荐）
- 直接在组件内容定义一个非箭头函数的方法，然后在constructor里bind(this) （推荐）
- 直接在render里写行内的箭头函数(不推荐)
- 直接在组件内定义一个非箭头函数的方法，然后在render里直接使用onClick={tihs.handleClick.bind(this)} （不推荐）

```jsx
class clickHandle extends React.Component{
    constructor(props){
        super(props)
        
        // 直接在组件内容定义一个非箭头函数的方法，然后在constructor里bind(this) （推荐）
        this.myClick001 = this.myClick001.bind(this)
    }
    
    // 在组件内使用箭头函数定义一个方法（推荐） 同时也支持参数的传递
    myClick = (params) => {
        return () => {
            console.log(params)
        }
    }
    
    myClick001(event) {
        console.log('my-click-001')
        console.log(event.target)
    }
    myClick002() {
        console.log('my-click-002')
    }
    
    render() {
        return () {
            <div>
                <button onClick={this.myClick('yes')}></button>
                <button onClick={this.myClick001}></button>
                <button onClick={this.myClick002.bind(this)}></button>
            </div>
        }
    }
}
```

### 3、Event对象

和普通浏览器一样，事件handler会被自动传入一个`envent`对象，这个对象和普通和浏览器`envent`对象所包含的方法和属性都基本一致，不同的是React中的`envent`对象不是浏览器提供的，而是它自己内部所构建的，它同样具有和浏览器一样的常用方法

## 七、表单

## 八、Hooks

