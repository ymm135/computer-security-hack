# zendopcache install function
function zendopc_ins {
	local IN_LOG=$LOGPATH/${logpre}_zendopcache_install.log
	echo
	echo "install zendopcache..."
	[ -f $zendopc_inf ] && return
	cd $IN_SRC
	fileurl=$ZENDOPC_URL && filechk
	tar xf zendopcache-${ZENDOPC_VER}.tgz
	cd zendopcache-${ZENDOPC_VER}
	$IN_DIR/php/bin/phpize
	./configure  --with-php-config=$IN_DIR/php/bin/php-config
	make
	[ $? != 0 ] && err_exit "zendopcache make err"
	make install
	[ $? != 0 ] && err_exit "zendopcache install err"
	local ext_dir=`/www/wdlinux/php/bin/php-config --extension-dir`	
	echo '
[opcache]
zend_extension="'$ext_dir'/opcache.so"
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=2000
opcache.revalidate_freq=60
opcache.save_comments=0
opcache.fast_shutdown=1
opcache.enable_cli=1' >> $IN_DIR/etc/php.ini

	cd $IN_SRC
	rm -fr zendopcache-${ZENDOPC_VER}
	touch $zendopc_inf
}
