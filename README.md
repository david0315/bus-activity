##问题描述

PHP版本（全平台通用，PHP>=7.2 && Swoole>=4.4）
基于Swoole的Process/Timer/Event实现，定时扫描文件并监听文件变动重启服务

##下载watch：
>下载地址->右键另存为

##启动监听：
> 请把文件watch放在项目根目录上，并在项目根目录下启动命令行终端

> php watch

启动监听并删除代理类缓存(./runtime/container)：
> php watch -c

Shell版本（不再维护，仅推荐MacOS用户使用，需要安装fswatch扩展）
基于fswatch扩展监听文件变化，性能上较好，体验一般（运行日志无法挂载在控制台上输出）

如果没有安装fswatch，需要先安装fswatch：
🍎 MacOS用户:

> brew install fswatch


## 功能
> 家长接送人设置

supervisor 部署 hyperf 

https://www.bookstack.cn/read/Hyperf-1.1.1/tutorial-daocloud.md

# 新建一个应用并设置一个名称，这里设置为 hyperf
[program:hyperf]
# 设置命令在指定的目录内执行
directory=/home/nginx/ganor-service-api/
# 这里为您要管理的项目的启动命令
command=php ./bin/hyperf.php start
# 以哪个用户来运行该进程
user=root
# supervisor 启动时自动该应用
autostart=true
# 进程退出后自动重启进程
autorestart=true
# 进程持续运行多久才认为是启动成功
startsecs=1
# 重试次数
startretries=3
# stderr 日志输出位置
stderr_logfile=/home/logs/nginx/hyperf-runtime-stderr.log
# stdout 日志输出位置
stdout_logfile=/home/logs/nginx/hyperf-runtime-stdout.log

supervisord -c /etc/supervisord.d/supervisord.conf


# 启动 hyperf 应用
supervisorctl start hyperf
# 重启 hyperf 应用
supervisorctl restart hyperf   [不能加载配置文件的问题:  rm -rf runtime/container]
# 停止 hyperf 应用
supervisorctl stop hyperf  
# 查看所有被管理项目运行状态
supervisorctl status
# 重新加载配置文件
supervisorctl update
# 重新启动所有程序
supervisorctl reload
