# memcache install function
function memcache_ins {
	local IN_LOG=$LOGPATH/${logpre}_memcached_install.log
	echo
	echo "install memcache..."
	if [ ! -f $libevent_inf ];then
		cd $IN_SRC
		fileurl=$LIBEVENT_URL && filechk
		tar xf libevent-${LIBEVENT_VER}.tar.gz
		cd libevent-${LIBEVENT_VER}
		./configure --prefix=/usr
		make -j $CPUS
		[ $? != 0 ] && err_exit "libevent make err"
		make install
		[ $? != 0 ] && err_exit "libevent install err"
		cd $IN_SRC
		rm -fr libevent-${LIBEVENT_VER}
		touch $libevent_inf
	fi

	if [ ! -f $memcached_inf ];then
		cd $IN_SRC
		fileurl=$MEMCACHED_URL && filechk
		tar xf memcached-${MEMCACHED_VER}.tar.gz
		cd memcached-${MEMCACHED_VER}
		./configure --prefix=/www/wdlinux/memcached --with-libevent=/usr
		make -j $CPUS
		[ $? != 0 ] && err_exit "memcached make err"
		make install
		[ $? != 0 ] && err_exit "memcached install err"

		if grep -qi 'debian\|ubuntu' /etc/issue; then
		    file_cp init.memcached-ubuntu /www/wdlinux/init.d/memcached
		    chmod 755 /www/wdlinux/init.d/memcached
		    ln -s /www/wdlinux/init.d/memcached /etc/init.d/memcached
		    update-rc.d -f memcached defaults
		    update-rc.d -f memcached enable 235
		else
		    file_cp init.memcached /www/wdlinux/init.d/memcached
		    chmod 755 /www/wdlinux/init.d/memcached
		    Checkinitd memcached
		    chkconfig --level 35 memcached on
		fi
		touch /www/wdlinux/etc/memcached.conf
		#service memcached start
		cd $IN_SRC
		rm -fr memcached-${MEMCACHED_VER}
		touch $memcached_inf
	fi

	if [ ! -f $memcache_inf ];then
		cd $IN_SRC
		if [ $P7 == 1 ];then
		fileurl=$MEMCACHE7_URL && filechk
		tar zxvf pecl-memcache-php7.tgz
		cd pecl-memcache-php7
		else
		fileurl=$MEMCACHE_URL && filechk
		tar zxvf memcache-${MEMCACHE_VER}.tgz
		cd memcache-${MEMCACHE_VER}
		fi
		/www/wdlinux/php/bin/phpize
		./configure --enable-memcache --with-php-config=/www/wdlinux/php/bin/php-config --with-zlib-dir
		make -j $CPUS
		[ $? != 0 ] && err_exit "memcache make err"
		make install
		[ $? != 0 ] && err_exit "memcache install err"

		grep -q 'memcache.so' /www/wdlinux/etc/php.ini
		if [ $? != 0 ]; then
		    local ext_dir=`/www/wdlinux/php/bin/php-config --extension-dir`
		    echo "
[memcache]
extension_dir ="$ext_dir"
extension=memcache.so" >> /www/wdlinux/etc/php.ini
		fi
		cd $IN_SRC
		rm -fr memcache-${MEMCACHE_VER}
		touch $memcache_inf
	fi
}
