###########################################################
安装方法:
###########################################################
将shell文件夹复制到cmsware根目录下
{cmsware}/admin
{cmsware}/shell
...
..
.
###########################################################
使用方法
例如Linux下
/usr/local/php/php cron.php -refreshNodeIndex 0 1

Cron使用方法:
5 * * * * cd /home/digi/cms/digicms/shell && /usr/local/bin/php cron.php -refreshNodeContent 82
###########################################################
Usage: php cron.php [options] [args...]
  -config  <file>                        Load Cron job from a config file. 从配置文件加载计划任务
  -refreshNodeIndex   NodeID[=1] Sub[=0] updating Node Index. 更新结点首页,NodeID为要更新的结点,多个结点用逗号分隔,Sub为是否更新子结点
  -refreshNodeExtra   NodeID[=1] Sub[=0] updating Node Exra. 更新结点附加发布,其他同上
  -refreshNodeContent NodeID[=1] Sub[=0] Level[=20] updating Node Content. 更新结点内容,其他同上, Level为系统负载度
  -publishNodeContent NodeID[=1] Sub[=0] Level[=20] publishing Node Content. 发布结点内容,其他同上,Level为系统负载度
  -refreshExtra       PublishID[=1]      updating PublishID Exra. 更新PublishID=x的附加发布,多个PublishID使用逗号分隔
  -refreshContent     IndexID[=1]        updating PublishID Exra. 更新IndexID=x的内容页,多个IndexID使用逗号分隔
  -collection     CateID[=1]  Sub[=0]     collection CateID . 启动CateID为x的采集进程,多个CateID使用逗号分隔
  -h               This help
  -v               Version number


更新所有首页     cron.php -refreshNodeIndex   0 1
更新所有附加发布 cron.php -refreshNodeExtra   0 1
更新所有内容页   cron.php -refreshNodeContent 0 1

更新结点NodeID[=1]的首页 cron.php -refreshNodeIndex  1
更新结点NodeID[=1,2,3]的首页 cron.php -refreshNodeIndex  1,2,3
更新结点NodeID[=1](含子结点)的首页 cron.php -refreshNodeIndex  1 1
更新结点NodeID[=1,2,3](含子结点)下的所有首页 cron.php -refreshNodeIndex  1,2,3 1

更新结点NodeID[=1]的附加发布 cron.php -refreshNodeExtra  1
更新结点NodeID[=1,2,3]的附加发布 cron.php -refreshNodeExtra  1,2,3
更新结点NodeID[=1](含子结点)的附加发布 cron.php -refreshNodeExtra  1 1
更新结点NodeID[=1,2,3](含子结点)下的所有附加发布 cron.php -refreshNodeExtra  1,2,3 1

更新结点NodeID[=1]的内容页 cron.php -refreshNodeContent  1
更新结点NodeID[=1,2,3]的内容页 cron.php -refreshNodeContent  1,2,3
更新结点NodeID[=1](含子结点)的内容页 cron.php -refreshNodeContent  1 1
更新结点NodeID[=1,2,3](含子结点)下的所有内容页 cron.php -refreshNodeContent  1,2,3 1

更新结点NodeID[=1]的所有内容页,系统负载度为10 cron.php -refreshNodeContent  1 0 10
更新结点NodeID[=1](含子结点)的所有内容页,系统负载度为20 cron.php -refreshNodeContent  1 1 20

更新PublishID[=5]的附加发布 cron.php -refreshExtra 5
更新PublishID[=6,7,8]的附加发布 cron.php -refreshExtra 6,7,8

更新IndexID[=88]的内容页 cron.php -refreshContent 88
更新IndexID[=198,268]的附加内容页 cron.php -refreshContent 198,268

发布结点NodeID[=1]的所有未发布内容页 cron.php -publishNodeContent  1
发布结点NodeID[=1,2,3]的所有未发布内容页 cron.php -publishNodeContent  1,2,3
发布结点NodeID[=1](含子结点)的所有未发布内容页 cron.php -publishNodeContent  1 1
发布结点NodeID[=1,2,3](含子结点)下的所有未发布内容页 cron.php -publishNodeContent  1,2,3 1

发布结点NodeID[=1]的所有未发布内容页,系统负载度为10 cron.php -publishNodeContent  1 0 10
发布结点NodeID[=1](含子结点)的所有未发布内容页,系统负载度为20 cron.php -publishNodeContent  1 1 20


启动全站采集进程 cron.php -collection  0 1
启动采集分类(CateID=3)的采集进程 cron.php -collection  3

[系统负载度: 内容更新时对系统资源的占用度.低负载度更新的时间较长,但可以降低运行时对系统资源的消耗.负载度范围为1~N,1为最低负载,默认为20,夜间运行shell更新,可以使用较高的系统负载度]
