# 员工管理系统

一个基于PHP和MySQL的简单员工管理系统，提供基本的员工信息管理功能。
本项目仅用于做Linux大作业使用，因为要用到git所以只能把项目弄到github上。

## 功能特点

- 添加新员工
- 查看员工列表
- 删除员工信息
- 数据验证和安全处理
- 响应式界面设计

## 技术栈

- 后端：PHP 7.4+
- 数据库：MySQL 5.7+
- 前端：
  - HTML5
  - CSS3 (Bootstrap 5)
  - JavaScript (原生)
- 其他：
  - PDO数据库操作
  - RESTful API设计

## 系统要求

- PHP >= 7.4
- MySQL >= 5.7
- Web服务器 (Apache/Nginx)
- 现代浏览器支持

## 目录结构

```
employee-management/
├── api/                # API接口文件
│   ├── create.php     # 创建员工
│   ├── read.php       # 读取员工列表
│   └── delete.php     # 删除员工
├── config/            # 配置文件
│   ├── config.php     # 数据库配置
│   └── Database.php   # 数据库连接类
├── models/            # 数据模型
│   └── Employee.php   # 员工模型类
├── utils/             # 工具类
│   └── Validator.php  # 数据验证类
├── js/               # JavaScript文件
│   └── main.js       # 主要JS逻辑
├── database/         # 数据库相关
│   └── schema.sql    # 数据库结构
├── index.html        # 主页面
└── README.md         # 项目文档
```

## 安装步骤

1. **克隆项目**
   ```bash
   git clone [项目地址]
   cd employee-management
   ```

2. **配置数据库**
   - 创建MySQL数据库
   - 导入数据库结构
   ```bash
   mysql -u root -p < database/schema.sql
   ```
   - 修改数据库配置
   ```php
   // config/config.php
   return [
       'db' => [
           'host' => 'localhost',
           'database' => 'employee_management',
           'username' => 'your_username',
           'password' => 'your_password'
       ]
   ];
   ```

3. **配置Web服务器**
   - 将项目文件放置在Web服务器目录下
   - 确保PHP有适当的执行权限
   - 配置虚拟主机（可选）

## 使用说明

1. **添加员工**
   - 填写员工信息表单
   - 所有带星号(*)的字段为必填
   - 提交后系统会自动验证数据

2. **查看员工**
   - 员工列表显示在主页面
   - 按ID倒序排列
   - 支持响应式显示

3. **删除员工**
   - 点击员工列表中的"删除"按钮
   - 确认后永久删除该员工信息

## 安全特性

- SQL注入防护
- XSS攻击防护
- 输入数据验证
- 错误处理机制

## 注意事项

1. 确保PHP开启了PDO扩展
2. 数据库配置信息需要适当保护
3. 生产环境建议关闭错误显示
4. 定期备份数据库

## 贡献指南

1. Fork 项目
2. 创建功能分支
3. 提交更改
4. 推送到分支
5. 创建Pull Request
6. 本项目仅用于做Linux大作业使用，基本上不会维护更新。

## 许可证

MIT License - 详见 LICENSE 文件
