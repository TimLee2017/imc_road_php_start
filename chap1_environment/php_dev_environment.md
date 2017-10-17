# php 开发环境

## 1 安装 nginx


### 1.1 安装
查看是否存在
```
apt-cache search nginx
```
安装
```
sudo apt-get install nginx
```


### 1.2 查看是否安装成功
```
$ nginx -v
nginx version: nginx/1.10.3 (Ubuntu)
```

### 1.3 测试nginx
```
$ curl -I 'http://127.0.0.1/'
HTTP/1.1 200 OK
Server: nginx/1.10.3 (Ubuntu)
Date: Mon, 16 Oct 2017 13:32:01 GMT
Content-Type: text/html
Content-Length: 612
Last-Modified: Mon, 16 Oct 2017 13:29:53 GMT
Connection: keep-alive
ETag: "59e4b451-264"
Accept-Ranges: bytes
```

### 1.4 停止nginx
```
vagrant@vagrant:~$ sudo /etc/init.d/nginx stop
[ ok ] Stopping nginx (via systemctl): nginx.service.
```

测试是否停止。本机停止。但是百度可以。
```
$ curl -I 'http://127.0.0.1/'
curl: (7) Failed to connect to 127.0.0.1 port 80: Connection refused

$ curl -I 'http://www.baidu.com/'
HTTP/1.1 200 OK
Server: bfe/1.0.8.18
Date: Mon, 16 Oct 2017 13:35:38 GMT
Content-Type: text/html
Content-Length: 277
Last-Modified: Mon, 13 Jun 2016 02:50:26 GMT
Connection: Keep-Alive
ETag: "575e1f72-115"
Cache-Control: private, no-cache, no-store, proxy-revalidate, no-transform
Pragma: no-cache
Accept-Ranges: bytes
```


## 2 安装 php

### 2.1 命令行
```
sudo apt-get install php7.0-cli
```
### 2.2 扩展
```
sudo apt-get install php7.0-mcrypt
sudo apt-get install php7.0-mysql
sudo apt-get install php7.0-gd
```
### 2.3 Apache 的 php 模块
```
sudo apt-get install libapache2-mod-php7.0
```

### 2.4 nginx 的 fastcgi
```
sudo apt-get install php7.0-cgi
sudo apt-get install php7.0-fpm
```


## 3 配置 LNMP 环境

参考 [ubuntu下安装LNMP](http://www.jianshu.com/p/8caa53830b8d)

主要是 nginx 的参数、以及 php-fpm 的参数。

php-fpm 的配置文件，php5为：
```
/etc/php5/fpm/pool.d/www.conf
```
或者 php7对应是：
```
/etc/php/7.0/fpm/pool.d/www.conf
```

把`listen=/var/run/php` 修改为 `listen = 127.0.0.1:9000`
```
; listen = /run/php/php7.0-fpm.sock
listen = 127.0.0.1:9000
```

最后启动 php-fpm
```
$ sudo /etc/init.d/php7.0-fpm start
[ ok ] Starting php7.0-fpm (via systemctl): php7.0-fpm.service.
```



nginx 的配置文件
```
/etc/nginx/sites-available/default
```


更改 root
```
 # root /var/www/html;
        root /phpdev
```
增加 index.php
```
 # Add index.php to the list if you are using PHP
        index index.php index.html index.htm index.nginx-debian.html;
```

取消注释
```
 location ~ \.php$ {
                include snippets/fastcgi-php.conf;

                # With php7.0-cgi alone:
                fastcgi_pass 127.0.0.1:9000;
        #       # With php7.0-fpm:
        #       fastcgi_pass unix:/run/php/php7.0-fpm.sock;
        }
```




重载
```
sudo systemctl reload nginx
```
或者
```
sudo /etc/init.d/nginx reload
```
查看服务状态
```
systemctl status nginx
```

保险起见，再重启 php-fpm
```
$ sudo /etc/init.d/php7.0-fpm restart
[ ok ] Restarting php7.0-fpm (via systemctl): php7.0-fpm.service.
```


## 4 测试
在 nginx 设置的 root 目录下新建 `t.php` 文件。
里面写
```
<?php
echo 'hello world'
?>
```

然后在浏览器输入 127.0.0.1:11035
（11035端口是我的虚拟机80端口转发到宿主机11035端口）

浏览器就会出现
```
hello world
```

或者写
```
<?php
echo phpinfo();
?>
```
会显示 php 的相关信息。









