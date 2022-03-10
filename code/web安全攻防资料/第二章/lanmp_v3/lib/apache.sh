# apache install function
function apache_ins {
    local IN_LOG=$LOGPATH/${logpre}_apache_install.log
    echo
    [ -f $httpd_inf ] && return
    [ $PCREIN==1 ] && pcre_ins
    echo "installing httpd..."
    cd $IN_SRC
    fileurl=$APA_URL && filechk
    tar xf httpd-${APA_VER}.tar.gz
    cd httpd-$APA_VER
    make_clean
    ./configure --prefix=${IN_DIR}/httpd-${APA_VER} \
	--with-mpm=$AMPM \
        --enable-rewrite --enable-deflate \
        --disable-userdir --enable-so \
        --enable-expires --enable-headers \
        --with-included-apr --enable-ssl \
	--enable-mime-magic --enable-ssl --with-crypto \
        --with-ssl --enable-static-support
    [ $? != 0 ] && err_exit "apache configure err"
    make -j $CPUS
    [ $? != 0 ] && err_exit "apache make err"
    make install 
    [ $? != 0 ] && err_exit "apache install err"
    ln -sf $IN_DIR/httpd-$APA_VER $IN_DIR/apache
    sed -i 's/User daemon/User www/g' $IN_DIR/apache/conf/httpd.conf
    sed -i 's/Group daemon/Group www/g' $IN_DIR/apache/conf/httpd.conf
    sed -i 's@^#LoadModule rewrite_module@LoadModule rewrite_module@' $IN_DIR/apache/conf/httpd.conf
    sed -i 's@^#LoadModule expires_module@LoadModule expires_module@' $IN_DIR/apache/conf/httpd.conf
    sed -i 's@^#LoadModule\(.*\)mod_deflate.so@LoadModule\1mod_deflate.so@' $IN_DIR/apache/conf/httpd.conf
    sed -i 's@DirectoryIndex index.html@DirectoryIndex index.html index.php index.htm@' $IN_DIR/apache/conf/httpd.conf

    [ $APA_ID == 1 ] && echo "NameVirtualHost *:80" >> $IN_DIR/apache/conf/httpd.conf
    echo "Include conf/httpd-wdl.conf" >> $IN_DIR/apache/conf/httpd.conf
    #echo "Include conf/default.conf" >> $IN_DIR/apache/conf/httpd.conf
    #echo "Include conf/wdcp.conf" >> $IN_DIR/apache/conf/httpd.conf
    echo "Include conf/vhost/*.conf" >> $IN_DIR/apache/conf/httpd.conf
    mkdir -p $IN_DIR/apache/conf/{vhost,rewrite}
    sed -i '/#ServerName/a\
ServerName localhost
' $IN_DIR/apache/conf/httpd.conf
    mkdir -p /www/{web/default,web_logs}    
    file_cp phpinfo.php /www/web/default/phpinfo.php
    file_cp iProber2.php /www/web/default/iProber2.php
    file_cp wdlinux_a.php /www/web/default/index.php
    chown -R www.www /www/web
    file_cp httpd-wdl.conf $IN_DIR/apache/conf/httpd-wdl.conf
    [ $APA_ID == 1 ] && file_cp defaulta.conf $IN_DIR/apache/conf/vhost/00000.default.conf
    [ $APA_ID == 2 ] && file_cp defaulta2.conf $IN_DIR/apache/conf/vhost/00000.default.conf
    file_cp dz7_apache.conf $IN_DIR/apache/conf/rewrite/dz7_apache.conf
    file_cp dzx15_apache.conf $IN_DIR/apache/conf/rewrite/dzx15_apache.conf
    if [ $OS_RL == 2 ]; then
        file_cp init.httpd-ubuntu $IN_DIR/init.d/httpd
    else
        file_cp init.httpd $IN_DIR/init.d/httpd
    fi
    chmod 755 $IN_DIR/init.d/httpd
    Checkinitd httpd
    if [ $OS_RL == 2 ]; then
        update-rc.d -f httpd defaults
    else
        chkconfig --add httpd
        chkconfig --level 35 httpd on
    fi
    mkdir -p $IN_DIR/apache/conf/vhost
    [ $IN_DIR_ME == 1 ] && sed -i "s#/www/wdlinux#$IN_DIR#g" /etc/init.d/httpd
    cd $IN_SRC
    rm -fr httpd-$APA_VER
    touch $httpd_inf
}
