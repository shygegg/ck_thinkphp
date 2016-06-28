<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    预定义常量、系统常量、路径常量
    <pre style='color:#000000;background:#f1f0f0;'>
    THINK_VERSION 框架版本号  

    /ck_thinkphp 网站根目录地址
    /ck_thinkphp/index.php 当前应用（入口文件）地址
    /ck_thinkphp/index.php/Home 当前模块的URL地址
    /ck_thinkphp/index.php/Home/Index 当前控制器的URL地址
    /ck_thinkphp/index.php/Home/Index/thinkphp_5 当前操作的URL地址
    /ck_thinkphp/index.php/Index/thinkphp_5.html 当前URL地址
    __INFO__ 当前的PATH_INFO字符串
    __EXT__ 当前URL地址的扩展名
    MODULE_NAME 当前模块名
    MODULE_PATH 当前模块路径
    CONTROLLER_NAME 当前控制器名
    CONTROLLER_PATH 当前控制器路径 3.2.3新增
    ACTION_NAME 当前操作名

    THINK_PATH 框架系统目录
    APP_PATH 应用目录（默认为入口文件所在目录）
    LIB_PATH 系统类库目录（默认为 THINK_PATH.'Library/'）
    CORE_PATH 系统核心类库目录 （默认为 LIB_PATH.'Think/'）
    MODE_PATH 系统应用模式目录 （默认为 THINK_PATH.'Mode/'）
    BEHAVIOR_PATH 行为目录 （默认为 LIB_PATH.'Behavior/'）
    COMMON_PATH 公共模块目录 （默认为 APP_PATH.'Common/'）
    VENDOR_PATH 第三方类库目录（默认为 LIB_PATH.'Vendor/'）
    RUNTIME_PATH 应用运行时目录（默认为 APP_PATH.'Runtime/'）
    HTML_PATH 应用静态缓存目录（默认为 APP_PATH.'Html/'）
    CONF_PATH 应用公共配置目录（默认为 COMMON_PATH.'Conf/'）
    LANG_PATH 公共语言包目录 （默认为 COMMON_PATH.'Lang/'）
    LOG_PATH 应用日志目录 （默认为 RUNTIME_PATH.'Logs/'）
    CACHE_PATH 项目模板缓存目录（默认为 RUNTIME_PATH.'Cache/'）
    TEMP_PATH 应用缓存目录（默认为 RUNTIME_PATH.'Temp/'）
    DATA_PATH 应用数据目录 （默认为 RUNTIME_PATH.'Data/'）
    ADDON_PATH 插件控制器目录 （默认为 APP_PATH.'Addon'） 3.2.3新增
    </pre>
</body>
</html>