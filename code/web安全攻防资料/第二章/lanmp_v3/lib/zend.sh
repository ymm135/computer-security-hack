# zend install function
function zend_ins {
    local IN_LOG=$LOGPATH/${logpre}_zend_install.log
    echo
    [ -f $zend_inf ] && return
    [ $ZENDIN == 0 ] && return
    echo "Zend installing..."
    cd $IN_SRC
    local ext_dir=`/www/wdlinux/php/bin/php-config --extension-dir`
    if [ $X86 == "1" ]; then
	if [ $PHP_ID == 1 ];then
	fileurl=${DL_URL}/files/zend/ZendGuardLoader-php-5.3-linux-glibc23-x86_64.tar.gz && filechk
        tar xzf ZendGuardLoader-php-5.3-linux-glibc23-x86_64.tar.gz
        cp ZendGuardLoader-php-5.3-linux-glibc23-x86_64/php-5.3.x/ZendGuardLoader.so $ext_dir
        rm -rf ZendGuardLoader-php-5.3-linux-glibc23-x86_64
	fi
	if [ $PHP_ID == 2 ];then
	fileurl=${DL_URL}/files/zend/ZendGuardLoader-70429-PHP-5.4-linux-glibc23-x86_64.tar.gz && filechk
        tar xzf ZendGuardLoader-70429-PHP-5.4-linux-glibc23-x86_64.tar.gz
        cp ZendGuardLoader-70429-PHP-5.4-linux-glibc23-x86_64/php-5.4.x/ZendGuardLoader.so $ext_dir
        rm -rf ZendGuardLoader-70429-PHP-5.4-linux-glibc23-x86_64
	fi
	if [ $PHP_ID == 3 ];then
        fileurl=${DL_URL}/files/zend/zend-loader-php5.5-linux-x86_64.tar.gz && filechk
        tar xzf zend-loader-php5.5-linux-x86_64.tar.gz
        cp zend-loader-php5.5-linux-x86_64/ZendGuardLoader.so $ext_dir
        rm -rf zend-loader-php5.5-linux-x86_64
	fi
	if [ $PHP_ID == 4 ];then
        fileurl=${DL_URL}"/files/zend/zend-loader-php5.6-linux-x86_64.tar.gz" && filechk
        tar zxvf zend-loader-php5.6-linux-x86_64.tar.gz
	cp zend-loader-php5.6-linux-x86_64/ZendGuardLoader.so $ext_dir
        rm -fr zend-loader-php5.6-linux-x86_64
	fi
    else
	if [ $PHP_ID == 1 ];then
        fileurl=${DL_URL}/files/zend/ZendGuardLoader-php-5.3-linux-glibc23-i386.tar.gz && filechk
        tar xzf ZendGuardLoader-php-5.3-linux-glibc23-i386.tar.gz
        cp ZendGuardLoader-php-5.3-linux-glibc23-i386/php-5.3.x/ZendGuardLoader.so $ext_dir
        rm -rf ZendGuardLoader-php-5.3-linux-glibc23-i386	
	fi
	if [ $PHP_ID == 2 ];then
        fileurl=${DL_URL}/files/zend/ZendGuardLoader-70429-PHP-5.4-linux-glibc23-i386.tar.gz && filechk
        tar xzf ZendGuardLoader-70429-PHP-5.4-linux-glibc23-i386.tar.gz
        cp ZendGuardLoader-70429-PHP-5.4-linux-glibc23-i386/php-5.4.x/ZendGuardLoader.so $ext_dir
        rm -rf ZendGuardLoader-70429-PHP-5.4-linux-glibc23-i386
	fi
	if [ $PHP_ID == 3 ];then
        fileurl=${DL_URL}/files/zend/zend-loader-php5.5-linux-i386.tar.gz && filechk
        tar xzf zend-loader-php5.5-linux-i386.tar.gz
        cp zend-loader-php5.5-linux-i386/ZendGuardLoader.so $ext_dir
        rm -rf zend-loader-php5.5-linux-x386
	fi
	if [ $PHP_ID == 4 ];then
        fileurl=${DL_URL}"/files/zend/zend-loader-php5.6-linux-i386.tar.gz" && filechk
        tar zxvf zend-loader-php5.6-linux-i386.tar.gz
	cp zend-loader-php5.6-linux-i386/ZendGuardLoader.so $ext_dir
        rm -fr zend-loader-php5.6-linux-i386
	fi
    fi
    echo '[Zend Guard Loader]
zend_extension="'$ext_dir'/ZendGuardLoader.so"
zend_loader.enable=1
zend_loader.disable_licensing=0
zend_loader.obfuscation_level_support=3' >> $IN_DIR/etc/php.ini
    touch $zend_inf
}

