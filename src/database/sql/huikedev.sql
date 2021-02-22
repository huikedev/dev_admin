/*
 Navicat MySQL Data Transfer

 Source Server         : Ubuntu
 Source Server Type    : MySQL
 Source Server Version : 50730
 Source Host           : 192.168.80.128:3306
 Source Schema         : huikedev

 Target Server Type    : MySQL
 Target Server Version : 50730
 File Encoding         : 65001

 Date: 23/02/2021 04:09:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for huike_actions
-- ----------------------------
DROP TABLE IF EXISTS `huike_actions`;
CREATE TABLE `huike_actions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '方法名',
  `action_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '方法名称',
  `controller_id` int(11) NOT NULL COMMENT '控制器ID',
  `route_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '路由别名',
  `request_method` tinyint(4) NOT NULL DEFAULT 0 COMMENT '请求类型',
  `service_return_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '返回类型',
  `is_need_permission` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否需要权限',
  `notice_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '前端操作反馈',
  `response_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '响应类型',
  `remind_msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '提示消息',
  `is_private` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否公开访问',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `creator_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后更新时间',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '软删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `controller_id`(`controller_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '控制器方法' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_actions
-- ----------------------------
INSERT INTO `huike_actions` VALUES (1, 'index', '登录', 5, 'index', 1, 'array_object', 0, 3, 1, '登录成功，请稍后', 0, '', 1, 1612119224, 1612119224, 0);
INSERT INTO `huike_actions` VALUES (2, 'getUserInfo', '用户详情', 6, 'getUserInfo', 0, 'array_object', 1, 0, 1, '', 1, '', 1, 1612119395, 1612119395, 0);
INSERT INTO `huike_actions` VALUES (3, 'Test', '测试', 5, 'test', 0, 'mixed', 1, 0, 1, '', 1, '', 1, 1612119546, 1612155488, 1612155488);
INSERT INTO `huike_actions` VALUES (4, 'index', '列表', 7, 'index', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1612179281, 1612179281, 0);
INSERT INTO `huike_actions` VALUES (5, 'create', '新增', 7, 'create', 1, 'bool', 1, 9, 1, '门面创建成功', 1, '', 1, 1612179338, 1612179338, 0);
INSERT INTO `huike_actions` VALUES (6, 'delete', '删除', 7, 'delete', 1, 'bool', 1, 9, 1, '门面删除成功', 1, '', 1, 1612179383, 1612179383, 0);
INSERT INTO `huike_actions` VALUES (7, 'refresh', '刷新', 7, 'refresh', 1, 'bool', 1, 9, 1, '门面刷新成功', 1, '', 1, 1612179418, 1612179418, 0);
INSERT INTO `huike_actions` VALUES (8, 'create', '新增', 8, 'create', 1, 'bool', 1, 9, 1, '数据库迁移文件创建成功', 1, '', 1, 1612179446, 1612179446, 0);
INSERT INTO `huike_actions` VALUES (9, 'run', '执行', 8, 'run', 1, 'bool', 1, 9, 1, '数据库迁移执行成功', 1, '', 1, 1612179476, 1612179476, 0);
INSERT INTO `huike_actions` VALUES (10, 'index', '列表', 9, 'index', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1612179492, 1612179492, 0);
INSERT INTO `huike_actions` VALUES (11, 'simpleList', '简单列表', 9, 'simpleList', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612179512, 1612179512, 0);
INSERT INTO `huike_actions` VALUES (12, 'create', '新增', 9, 'create', 1, 'bool', 1, 9, 1, '模型创建成功', 1, '', 1, 1612179533, 1612179533, 0);
INSERT INTO `huike_actions` VALUES (13, 'updateAnnotation', '更新注解', 9, 'updateAnnotation', 1, 'bool', 1, 6, 1, '模型注解更新成功', 1, '', 1, 1612179557, 1612179557, 0);
INSERT INTO `huike_actions` VALUES (14, 'delete', '删除', 9, 'delete', 1, 'bool', 1, 9, 1, '模型删除成功', 1, '', 1, 1612179574, 1612179574, 0);
INSERT INTO `huike_actions` VALUES (15, 'read', '详情', 9, 'read', 0, 'model', 1, 0, 1, '', 1, '', 1, 1612179592, 1612179592, 0);
INSERT INTO `huike_actions` VALUES (16, 'syncProperty', '同步属性', 9, 'syncProperty', 1, 'bool', 1, 6, 1, '模型属性同步成功', 1, '', 1, 1612179613, 1612179613, 0);
INSERT INTO `huike_actions` VALUES (17, 'getFields', '字段列表', 9, 'getFields', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612179631, 1612179631, 0);
INSERT INTO `huike_actions` VALUES (18, 'index', '列表', 10, 'index', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1612179644, 1612179644, 0);
INSERT INTO `huike_actions` VALUES (19, 'create', '新增', 10, 'create', 1, 'array_object', 1, 0, 1, '', 1, '', 1, 1612179675, 1612179675, 0);
INSERT INTO `huike_actions` VALUES (20, 'edit', '修改', 10, 'edit', 1, 'bool', 1, 9, 1, '修改逻辑方法成功', 1, '', 1, 1612179706, 1612179706, 0);
INSERT INTO `huike_actions` VALUES (21, 'delete', '删除', 10, 'delete', 1, 'bool', 1, 9, 1, '删除逻辑方法成功', 1, '', 1, 1612179724, 1612179724, 0);
INSERT INTO `huike_actions` VALUES (22, 'unSynced', '未同步列表', 10, 'unSynced', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1612179743, 1612179743, 0);
INSERT INTO `huike_actions` VALUES (23, 'sync', '同步方法', 10, 'sync', 1, 'bool', 1, 6, 1, '同步逻辑方法成功', 1, '', 1, 1612179770, 1612179770, 0);
INSERT INTO `huike_actions` VALUES (24, 'speedCreate', '一键创建', 10, 'speedCreate', 1, 'array_object', 1, 0, 1, '', 1, '', 1, 1612179807, 1612179807, 0);
INSERT INTO `huike_actions` VALUES (25, 'index', '列表', 11, 'index', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1612179819, 1612179819, 0);
INSERT INTO `huike_actions` VALUES (26, 'create', '新增', 11, 'create', 1, 'bool', 1, 9, 1, '控制器创建成功', 1, '', 1, 1612179840, 1612179840, 0);
INSERT INTO `huike_actions` VALUES (27, 'edit', '修改', 11, 'edit', 1, 'bool', 1, 9, 1, '控制器修改成功', 1, '', 1, 1612179860, 1612179860, 0);
INSERT INTO `huike_actions` VALUES (28, 'delete', '删除', 11, 'delete', 1, 'bool', 1, 9, 1, '控制器删除成功', 1, '', 1, 1612179877, 1612179877, 0);
INSERT INTO `huike_actions` VALUES (29, 'unSynced', '未同步列表', 11, 'unSynced', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612179894, 1612179894, 0);
INSERT INTO `huike_actions` VALUES (30, 'sync', '同步', 11, 'sync', 1, 'bool', 1, 6, 1, '控制器同步成功', 1, '', 1, 1612179914, 1612179914, 0);
INSERT INTO `huike_actions` VALUES (31, 'checkException', '查询异常码', 11, 'checkException', 0, 'array_object', 1, 0, 1, '', 1, '', 1, 1612179937, 1612179937, 0);
INSERT INTO `huike_actions` VALUES (32, 'simpleList', '简单列表', 11, 'simpleList', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612179955, 1612179955, 0);
INSERT INTO `huike_actions` VALUES (33, 'pathList', '目录列表', 11, 'pathList', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612179980, 1612179980, 0);
INSERT INTO `huike_actions` VALUES (34, 'index', '列表', 12, 'index', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1612179992, 1612179992, 0);
INSERT INTO `huike_actions` VALUES (35, 'create', '新增', 12, 'create', 1, 'bool', 1, 9, 1, '模块创建成功', 1, '', 1, 1612180010, 1612180010, 0);
INSERT INTO `huike_actions` VALUES (37, 'simpleList', '简单列表', 12, 'simpleList', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612180052, 1612180052, 0);
INSERT INTO `huike_actions` VALUES (38, 'updateServiceFacade', '刷新服务门面', 7, 'updateServiceFacade', 1, 'bool', 1, 6, 1, '刷新服务门面成功', 1, '', 1, 1612357988, 1612357988, 0);
INSERT INTO `huike_actions` VALUES (40, 'extendModules', '第三方模块列表', 12, 'extendModules', 0, 'array', 1, 0, 1, '', 1, '', 1, 1612795237, 1612795237, 0);
INSERT INTO `huike_actions` VALUES (42, 'edit', '修改', 12, 'edit', 1, 'bool', 1, 9, 1, '修改模块设置成功', 1, '修改模块设置', 1, 1612873972, 1612873972, 0);
INSERT INTO `huike_actions` VALUES (43, 'refreshRoutes', '刷新路由配置', 12, 'refreshRoutes', 1, 'bool', 1, 9, 1, '路由生成成功，请前往对应的模块目录查看', 1, '路由生成', 1, 1612875222, 1612875222, 0);
INSERT INTO `huike_actions` VALUES (44, 'index', '列表', 17, 'index', 0, 'paginator', 1, 0, 1, '', 1, '', 1, 1613536801, 1613536801, 0);
INSERT INTO `huike_actions` VALUES (45, 'update', '修改', 17, 'update', 1, 'bool', 1, 9, 1, '开发者信息修改成功', 1, '', 1, 1613562995, 1613562995, 0);
INSERT INTO `huike_actions` VALUES (46, 'delete', '删除', 17, 'delete', 1, 'bool', 1, 9, 1, '开发者删除成功', 1, '', 1, 1613563038, 1613563038, 0);
INSERT INTO `huike_actions` VALUES (47, 'positionList', '岗位列表', 17, 'positionList', 0, 'array', 1, 0, 1, '', 1, '', 1, 1613623640, 1613623640, 0);
INSERT INTO `huike_actions` VALUES (48, 'create', '新增', 17, 'create', 1, 'bool', 1, 9, 1, '开发者添加成功', 1, '', 1, 1613631699, 1613631699, 0);
INSERT INTO `huike_actions` VALUES (49, 'tableToMigration', '表字段生成迁移文件', 8, 'tableToMigration', 1, 'bool', 1, 6, 1, '从表字段生成迁移文件成功', 1, '', 1, 1613748224, 1613748224, 0);
INSERT INTO `huike_actions` VALUES (50, 'tableToSeeds', '表数据生成种子文件', 8, 'tableToSeeds', 1, 'bool', 1, 6, 1, '表数据生成种子文件成功！', 1, '', 1, 1613751850, 1613751850, 0);
INSERT INTO `huike_actions` VALUES (51, 'index', '首页', 21, 'index', 0, 'paginator', 1, 0, 1, '', 1, '首页', 1, 1613797768, 1613797768, 0);
INSERT INTO `huike_actions` VALUES (52, 'create', '新增', 21, 'create', 1, 'bool', 1, 6, 1, '控制器目录创建成功！', 1, '新增', 1, 1613797768, 1613797768, 0);
INSERT INTO `huike_actions` VALUES (53, 'edit', '修改', 21, 'edit', 1, 'bool', 1, 6, 1, '控制器目录修改成功！', 1, '修改', 1, 1613797768, 1613797768, 0);
INSERT INTO `huike_actions` VALUES (54, 'delete', '删除', 21, 'delete', 1, 'bool', 1, 9, 1, '控制器目录删除成功！', 1, '删除', 1, 1613797768, 1613797768, 0);
INSERT INTO `huike_actions` VALUES (55, 'simpleList', '简单列表', 21, 'simpleList', 0, 'array', 1, 0, 1, '', 1, '', 1, 1613804705, 1614015881, 0);
INSERT INTO `huike_actions` VALUES (56, 'refreshException', '刷新异常配置', 12, 'refreshException', 1, 'bool', 1, 6, 1, '刷新异常配置文件成功', 1, '', 1, 1614006250, 1614006250, 0);

-- ----------------------------
-- Table structure for huike_controllers
-- ----------------------------
DROP TABLE IF EXISTS `huike_controllers`;
CREATE TABLE `huike_controllers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '控制器标识',
  `controller_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '控制器名称',
  `path_id` int(11) NOT NULL DEFAULT 0 COMMENT '上级目录ID',
  `module_id` int(11) UNSIGNED NOT NULL COMMENT '模块ID',
  `route_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '路由标识',
  `is_static_service` tinyint(4) NOT NULL DEFAULT 0 COMMENT '静态服务代理模式',
  `created_by_huike` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否为自动生成',
  `exception_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '异常key',
  `exception_code` int(11) NULL DEFAULT NULL COMMENT '异常code',
  `exception_msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '异常message',
  `creator_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '软删除时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后更新时间',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `exception_key`(`exception_key`) USING BTREE,
  UNIQUE INDEX `exception_code`(`exception_code`) USING BTREE,
  INDEX `module_id`(`module_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后端控制器节点' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_controllers
-- ----------------------------
INSERT INTO `huike_controllers` VALUES (1, '/', '模块根目录', 0, 1, '', 0, 1, NULL, NULL, '', 1, 0, 1612095224, 1612095224);
INSERT INTO `huike_controllers` VALUES (2, 'generate', '代码生成', 0, 1, 'generate', 0, 1, NULL, NULL, '', 1, 0, 1613885227, 1612102562);
INSERT INTO `huike_controllers` VALUES (3, 'system', '系统设置', 0, 1, 'system', 0, 1, NULL, NULL, '', 1, 0, 1612102659, 1612102659);
INSERT INTO `huike_controllers` VALUES (4, 'user', '管理用户', 0, 1, '', 0, 1, NULL, NULL, '', 1, 0, 1612102673, 1612102673);
INSERT INTO `huike_controllers` VALUES (5, 'Login', '登录', 4, 1, 'login', 0, 1, 'dev login exception', -1000, '系统错误，请稍候再试', 1, 0, 1612102944, 1612102944);
INSERT INTO `huike_controllers` VALUES (6, 'User', '用户', 4, 1, 'user', 0, 1, 'dev user exception', -1100, '系统错误，请稍候再试', 1, 0, 1612875654, 1612103316);
INSERT INTO `huike_controllers` VALUES (7, 'Facade', '门面', 2, 1, 'facade', 0, 1, 'dev facade exception', -1200, '系统错误，请稍候再试', 1, 0, 1612103372, 1612103372);
INSERT INTO `huike_controllers` VALUES (8, 'Migrate', '数据库迁移', 2, 1, 'migrate', 0, 1, 'dev migrate exception', -1500, '系统错误，请稍候再试', 1, 0, 1612103423, 1612103423);
INSERT INTO `huike_controllers` VALUES (9, 'Model', '模型', 2, 1, 'model', 0, 1, 'dev model exception', -1300, '系统错误，请稍候再试', 1, 0, 1612103468, 1612103468);
INSERT INTO `huike_controllers` VALUES (10, 'Actions', '逻辑方法', 3, 1, 'actions', 0, 1, 'dev actions exception', -1800, '系统错误，请稍候再试', 1, 0, 1612103800, 1612103800);
INSERT INTO `huike_controllers` VALUES (11, 'Controllers', '控制器', 3, 1, 'controllers', 0, 1, 'dev controllers exception', -1700, '系统错误，请稍候再试', 1, 0, 1612103955, 1612103955);
INSERT INTO `huike_controllers` VALUES (12, 'Module', '模块管理', 3, 1, 'modules', 0, 1, 'dev module exception', -1600, '系统错误，请稍候再试', 1, 0, 1612875494, 1612103994);
INSERT INTO `huike_controllers` VALUES (17, 'Developer', '开发者', 4, 1, 'developer', 1, 1, 'dev developer exception', -2300, '系统错误，请稍候再试', 1, 0, 1613535981, 1613535981);
INSERT INTO `huike_controllers` VALUES (21, 'ControllerPath', '控制器目录', 3, 1, 'controller_path', 1, 1, 'dev controller path exception', -2400, '系统错误，请稍候再试', 1, 0, 1614000779, 1613797119);

-- ----------------------------
-- Table structure for huike_developer
-- ----------------------------
DROP TABLE IF EXISTS `huike_developer`;
CREATE TABLE `huike_developer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录密码',
  `position_id` tinyint(4) NOT NULL DEFAULT 0 COMMENT '职位ID',
  `last_login_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `login_time` int(11) NOT NULL DEFAULT 0 COMMENT '当次登录时间',
  `login_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '当次登录IP',
  `last_login_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '删除时间',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '管理员用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_developer
-- ----------------------------
INSERT INTO `huike_developer` VALUES (1, 'huikedev', '$2y$10$SU1k1zhH3dodNXXmspk0nORR9N.2GrbTGH0N.FF4E5HB8PPxBDV9u', 9, '127.0.0.1', 1614022825, '127.0.0.1', 1614016233, 1, 0, 1589639264, 1614022825);
INSERT INTO `huike_developer` VALUES (2, 'admin', '$2y$10$QB01lb3vLTomVF7qy/dSB.FaQ5ZNUzxMQiotbkYDbaKllYrDNac/W', 19, '', 0, '', 0, 1, 1613645933, 1613645831, 1613645933);

-- ----------------------------
-- Table structure for huike_extend_modules
-- ----------------------------
DROP TABLE IF EXISTS `huike_extend_modules`;
CREATE TABLE `huike_extend_modules`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '模块根目录',
  `root_namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '根命名空间',
  `root_base_exception` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '模块异常基类',
  `root_base_model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '模块模型基类',
  `root_base_controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '模块控制器基类',
  `root_base_logic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '模块控制器基类',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '三方模块' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_extend_modules
-- ----------------------------
INSERT INTO `huike_extend_modules` VALUES (1, 'huikedev/wap', 'huikedev/wap', '', '', '', '');
INSERT INTO `huike_extend_modules` VALUES (2, 'huikedev\\wap', 'huikedev\\wap', '', '', '', '');
INSERT INTO `huike_extend_modules` VALUES (3, 'huikedev\\dev_admin\\src', 'huikedev\\dev_admin', 'huikedev\\dev_admin\\common\\exception\\DevServiceException', 'huikedev\\dev_admin\\common\\DevModel', 'huikedev\\dev_admin\\common\\DevController', '');
INSERT INTO `huike_extend_modules` VALUES (4, 'huikedev\\web\\src', 'huikedev\\web', '', '', '', '');
INSERT INTO `huike_extend_modules` VALUES (5, 'huikedev\\web\\src', 'huikedev\\web', '', '', '', '');

-- ----------------------------
-- Table structure for huike_facades
-- ----------------------------
DROP TABLE IF EXISTS `huike_facades`;
CREATE TABLE `huike_facades`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '原始类名称',
  `facade_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '门面类名称',
  `facade_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '门面路径',
  `facade_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '门面中文名称',
  `type_id` tinyint(4) NOT NULL DEFAULT 1 COMMENT '门面类型',
  `action_count` tinyint(4) NOT NULL DEFAULT 0 COMMENT '门面类方法数量',
  `update_times` tinyint(4) NOT NULL DEFAULT 1 COMMENT '更新次数',
  `creator_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '标记删除',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `origin_class`(`origin_class`) USING BTREE,
  INDEX `facade_class`(`facade_class`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_facades
-- ----------------------------
INSERT INTO `huike_facades` VALUES (1, 'huikedev\\dev_admin\\common\\caching\\provider\\routes\\DevActionsCache', 'huikedev\\dev_admin\\common\\caching\\facade\\DevActionsCache', 'huikedev\\dev_admin\\src\\common\\caching\\facade', '路由方法缓存', 3, 7, 2, 1, 0, 1613731609, 1613731659);
INSERT INTO `huike_facades` VALUES (2, 'huikedev\\dev_admin\\common\\caching\\provider\\user\\DeveloperCache', 'huikedev\\dev_admin\\common\\caching\\facade\\DeveloperCache', 'huikedev\\dev_admin\\src\\common\\caching\\facade', '开发者信息', 3, 8, 1, 1, 0, 1613731764, 1613731764);

-- ----------------------------
-- Table structure for huike_models
-- ----------------------------
DROP TABLE IF EXISTS `huike_models`;
CREATE TABLE `huike_models`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '模型名称',
  `model_full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '模型全名',
  `module_id` int(11) NOT NULL DEFAULT 0 COMMENT '模块ID',
  `base_model_id` tinyint(4) NOT NULL DEFAULT 1 COMMENT '模型基类0=think\\Model 1=huike\\base\\Model 2=第三方模块模型基类',
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '模型对应的表名称',
  `pk_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '主键名称',
  `connection_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '数据库连接名称',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `is_json_assoc` tinyint(4) NOT NULL DEFAULT 0,
  `is_delete_time` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否包含软删除时间字段',
  `is_create_time` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否包含创建时间字段',
  `is_update_time` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否包含更新时间字段',
  `is_creator_id` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否包含创建人字段',
  `migrate_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '数据库迁移版本',
  `migrate_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '数据库迁移文件',
  `seed_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '数据库种子文件',
  `creator_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '标记删除',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `model_name`(`model_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_models
-- ----------------------------
INSERT INTO `huike_models` VALUES (1, 'HuikeModules', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeModules', 1, 1, '', '', '', '应用模块', 1, 1, 1, 1, 0, '16140243892549', '16140243892549_huike_modules', 'HuikeModulesUswntj', 1, 0, 1610780264, 1614024421);
INSERT INTO `huike_models` VALUES (2, 'HuikeControllers', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeControllers', 1, 1, '', '', '', '后端控制器', 0, 1, 1, 1, 0, '16140243934350', '16140243934350_huike_controllers', 'HuikeControllersCmbxfp', 1, 0, 1610780264, 1614024425);
INSERT INTO `huike_models` VALUES (3, 'HuikeActions', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeActions', 1, 1, '', '', '', '逻辑方法', 1, 1, 1, 1, 0, '16140243992269', '16140243992269_huike_actions', 'HuikeActionsTspqze', 1, 0, 1610780264, 1614024428);
INSERT INTO `huike_models` VALUES (4, 'HuikeDeveloper', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeDeveloper', 1, 1, '', '', '', '开发者信息', 0, 1, 1, 1, 0, '16140244043294', '16140244043294_huike_developer', 'HuikeDeveloperNjywvg', 1, 0, 1610780264, 1614024433);
INSERT INTO `huike_models` VALUES (5, 'HuikeExtendModules', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeExtendModules', 1, 1, '', '', '', '第三方模块信息', 0, 0, 0, 0, 0, '16140243808384', '16140243808384_huike_extend_modules', 'HuikeExtendModulesQvrosa', 1, 0, 1610780264, 1614024414);
INSERT INTO `huike_models` VALUES (6, 'HuikeFacades', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeFacades', 1, 1, '', '', '', '应用门面', 0, 1, 1, 1, 0, '16140243848677', '16140243848677_huike_facades', 'HuikeFacadesKqsnpe', 1, 0, 1610780264, 1614024417);
INSERT INTO `huike_models` VALUES (7, 'HuikeModels', 'huikedev\\dev_admin\\common\\model\\huike\\HuikeModels', 1, 1, '', '', '', '应用模型', 0, 1, 1, 1, 1, '16140244083162', '16140244083162_huike_models', 'HuikeModelsDbvals', 1, 0, 1610780264, 1614024436);

-- ----------------------------
-- Table structure for huike_modules
-- ----------------------------
DROP TABLE IF EXISTS `huike_modules`;
CREATE TABLE `huike_modules`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '模块名称（英文），即目录名称',
  `module_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '模块名称（中文）',
  `route_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '路由名称（英文）',
  `route_middleware` json NULL COMMENT '路由中间件',
  `bind_domain` json NULL COMMENT '绑定域名',
  `extend_module_id` int(11) NOT NULL DEFAULT 0 COMMENT '第三方模块扩展ID',
  `creator_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后更新时间',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '软删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `module_name`(`module_name`) USING BTREE,
  UNIQUE INDEX `route_name`(`route_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '应用模块' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huike_modules
-- ----------------------------
INSERT INTO `huike_modules` VALUES (1, 'dev', '开发辅助', 'dev', '[\"huikedev\\\\dev_admin\\\\common\\\\middlewares\\\\DevRouteMiddleware\"]', '[\"huike.local\"]', 3, 1, 1612095224, 1614000712, 0);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `start_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `end_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (16139306879133, 'HuikeExtendModules', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);
INSERT INTO `migrations` VALUES (16139306981403, 'HuikeFacades', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);
INSERT INTO `migrations` VALUES (16139307019311, 'HuikeModules', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);
INSERT INTO `migrations` VALUES (16139307057018, 'HuikeControllers', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);
INSERT INTO `migrations` VALUES (16139307106177, 'HuikeActions', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);
INSERT INTO `migrations` VALUES (16139307147027, 'HuikeDeveloper', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);
INSERT INTO `migrations` VALUES (16139311122396, 'HuikeModels', '2021-02-22 02:17:13', '2021-02-22 02:17:13', 0);

SET FOREIGN_KEY_CHECKS = 1;
