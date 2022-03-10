# mysql install function
function mysql_ins {
    local IN_LOG=$LOGPATH/${logpre}_mysql_install.log
    echo
    [ -f $mysql_inf ] && return
    echo "installing mysql,this may take a few minutes,hold on plz..."
    cd $IN_SRC
    fileurl=$MYS_URL && filechk
    tar zvxf mysql-$MYS_VER.tar.gz
    cd mysql-$MYS_VER/
    make_clean
    echo "configure in progress ..."
	cmake . -DCMAKE_INSTALL_PREFIX=$IN_DIR/mysql-$MYS_VER \
	-DMYSQL_DATADIR=$IN_DIR/mysql-$MYS_VER/data \
	-DSYSCONFDIR=/www/wdlinux/etc \
	-DWITH_INNOBASE_STORAGE_ENGINE=1 \
	-DWITH_PARTITION_STORAGE_ENGINE=1 \
	-DWITH_FEDERATED_STORAGE_ENGINE=1 \
	-DWITH_BLACKHOLE_STORAGE_ENGINE=1 \
	-DWITH_MYISAM_STORAGE_ENGINE=1 \
	-DWITH_ARCHIVE_STORAGE_ENGINE=1 \
	-DWITH_READLINE=1 \
	-DENABLED_LOCAL_INFILE=1 \
	-DENABLE_DTRACE=0 \
	-DDEFAULT_CHARSET=utf8mb4 \
	-DDEFAULT_COLLATION=utf8mb4_general_ci \
	-DWITH_EMBEDDED_SERVER=1
    [ $? != 0 ] && err_exit "mysql configure err"
    echo "make in progress ..."
    make -j $CPUS
    [ $? != 0 ] && err_exit "mysql make err"
    echo "make install in progress ..."
    make install 
    [ $? != 0 ] && err_exit "mysql install err"
    ln -sf $IN_DIR/mysql-$MYS_VER $IN_DIR/mysql
    [ -f /etc/my.cnf ] && mv /etc/my.cnf /etc/my.cnf.old
    cp support-files/mysql.server $IN_DIR/init.d/mysqld
    file_cp my.cnf $IN_DIR/etc/my.cnf
    ln -sf $IN_DIR/etc/my.cnf /etc/my.cnf
    $IN_DIR/mysql-$MYS_VER/scripts/mysql_install_db --basedir=$IN_DIR/mysql-$MYS_VER --datadir=$IN_DIR/mysql-$MYS_VER/data
    chown -R mysql.mysql $IN_DIR/mysql/data
    chmod 755 $IN_DIR/init.d/mysqld
    ln -sf $IN_DIR/init.d/mysqld /etc/init.d/mysqld
    if [ $OS_RL == 2 ]; then
        update-rc.d -f mysqld defaults
    else
        chkconfig --add mysqld
        chkconfig --level 35 mysqld on
    fi
    ln -sf $IN_DIR/mysql/bin/mysql /bin/mysql
    mkdir -p /var/lib/mysql
    service mysqld start
    echo "PATH=\$PATH:$IN_DIR/mysql/bin" > /etc/profile.d/mysql.sh
    echo "$IN_DIR/mysql" > /etc/ld.so.conf.d/mysql-wdl.conf
    ldconfig 
    $IN_DIR/mysql/bin/mysqladmin -u root password "wdlinux.cn"
    /www/wdlinux/mysql/bin/mysql -uroot -p"wdlinux.cn" -e \
        "use mysql;update user set password=password('wdlinux.cn') where user='root';
        delete from user where user='';
        DROP DATABASE test;
        drop user ''@'%';flush privileges;"
    ln -sf /tmp/mysql.sock /var/lib/mysql/
    cd $IN_SRC
    rm -fr mysql-$MYS_VER
    touch $mysql_inf
}

