### rsync 安装和配置

### 安装
yum install rsync

```
wget http://rsync.samba.org/ftp/rsync/src/rsync-3.1.0.tar.gz
cd rsync-3.1.0/
./configure --prefix=/usr/local/rsync
make
make install
```

### 参数
```
-a 参数，相当于-rlptgoD，-r 是递归 -l 是链接文件，意思是拷贝链接文件；-p 表示保持文件原有权限；-t 保持文件原有时间；-g 保持文件原有用户组；-o 保持文件原有属主；-D 相当于块设备文件；
-z 传输时压缩；
-P 传输进度；
-v 传输时的进度等信息，和-P有点关系，自己试试。可以看文档
```

### 配置

```
mkdir /etc/rsyncd
touch /etc/rsyncd/rsyncd.conf
ln -s /etc/rsyncd/rsyncd.conf /etc/rsyncd.conf
```

###rsync的六种不同的工作模式
```
1）拷贝本地文件；
当SRC和DES路径信息中不包含冒号":"分隔符时，就启用这种工作模式：
[root@cmmailapp1 /]# rsync -avSH /home/coremail/ /cmbak/

2）使用一个远程shell程序（如rsh、ssh）来实现将本地机器的内容拷贝到远程机器，当DST路径地址包括冒号":"分隔符时启动该模式；
[root@cmmailapp1 /]# rsync -avSH /home/coremail/ 192.168.11.12:/home/coremail/

3）使用一个远程shell程序（如rsh、ssh）来实现将远程机器的内容拷贝到本地机器，当SRC地址路径包括冒号":"分隔符时启动该模式；
[root@cmmailapp2 /]# rsync -avSH 192.168.11.11:/home/coremail/ /home/coremail/

4)从远程rsync服务器中拷贝文件到本地机。当SRC路径信息包含"::"分隔符时启动该模式。
如：rsync -av root@172.16.78.192::www /databack

5)从本地机器拷贝文件到远程rsync服务器中。当DST路径信息包含"::"分隔符时启动该模式。
如：rsync -av /databack root@172.16.78.192::www

6)列远程机的文件列表。这类似于rsync传输，不过只要在命令中省略掉本地机信息即可。
如：rsync -v rsync://192.168.11.11/data
```

### 加入计划任务
```
启动rsync服务并将其设置为开启启动
/usr/bin/rsync --daemon
(可以通过ps aux |grep rsync)
echo "/usr/bin/rsync --daemon" >> /etc/rc.local
```

kill `cat /var/run/rsyncd.pid`

### 例子
rsync -avz  /root/lnmp-install.log 120.76.123.86:/var/