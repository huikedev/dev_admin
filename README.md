DevAdmin
===============
## 介绍
开发辅助后台是基于`huikedev/huike_base`和`ant.design pro v5`开发而成开发者辅助系统，服务于前后端开发人员，后续版本会提供更多的辅助功能来提升开发效率和规范逻辑代码。

它可以帮你管理后端的模块、逻辑分层、模型、数据表、门面以及路由。

相比`huikedev/huike_base`而言，本项目要求更为严格的逻辑分层规范。

## 主要功能

+ 管理模型
+ 管理迁移文件和种子文件
+ 管理门面
+ 管理模块
+ 管理控制器
+ 管理方法
+ 生成路由

**注意，目前版本逻辑分层功能仅支持创建和追加，后续版本会提供修改功能**


## 环境要求

+ php7.1+
+ mysql 5.7+
+ ThinkPHP 6.0.*

## 项目地址

后端代码 : [Github](https://github.com/huikedev/dev_admin) [Gitee](https://gitee.com/huikedev/dev_admin)

前端代码 : [Github](https://github.com/huikedev/dev_admin_front) [Gitee](https://gitee.com/huikedev/dev_admin_front)


## 文档地址

[HuikeDev](https://huike.dev)

## 后端安装

**安装前请保证数据库正常连接，开发辅助功能依赖数据库**

### 第一步：安装扩展

```bash
composer require huikedev/dev_admin
```

### 第二步：执行安装命令

```bash
php think DevAdminInstall
```


## 前端安装
**前端项目依赖`node.js`环境，请提前安装配置`node.js`环境**
### 第一步：拉取代码

```bash
git clone https://github.com/huikedev/dev_admin_front.git
```

或

```bash
git clone https://gitee.com/huikedev/dev_admin_front.git
```

**此操作会创建一个项目目录**

### 第二步：安装前端依赖

```bash
cd dev_admin_front && npm install
# or
cd dev_admin_front && yarn
```

### 第三步：修改配置文件

找到`dev_admin_front\src\common\AppConfig.ts`文件，修改接口配置：

```typescript
export default class AppConfig{

  public static devHost='http://huike.local/'

  public static productionHost='https://dev.api.huike.dev/'

  public static tokenName = 'authorization';

  public static tokenCacheName = 'authorization'

  public static localStoragePrefix = 'huike_'

  public static version = '0.0.1-beta';

}
```

`devHost`为开发环境下的接口地址，即后端安装时绑定的主域名

`productionHost`为生产环境下的接口地址，此项目一般用不到

### 第四步：启动项目

```bash
npm start
# or
yarn start
```

在浏览器里打开 http://localhost:8000/ ，即可访问开发辅助后台

## issues与交流

+ 您可以通过Github的issues来反馈您的意见、建议或BUG
+ 您也可以通过Github的Pull Requests来提交您的代码
+ QQ交流群：16117272

<Alert type="error">
注意：Gitee仓库仅作为同步使用，issues与pr请到Github仓库提交
</Alert>


## 赞赏一下
<img alt="赞赏一下" src="https://huikedev-1255741738.cos.ap-shanghai.myqcloud.com/donate/donate.jpg" style="text-align: center;max-width: 750px;" />

## 鸣谢开源

+ [ThinkPHP](https://github.com/top-think/framework)
+ [Ant.Design](https://ant.design/)
+ [UmiJS](https://umijs.org/)
