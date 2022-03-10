# eaccelerator install function
function eaccelerator_ins {
    local IN_LOG=$LOGPATH/${logpre}_eaccelerator_install.log
    [ -f $eac_inf ] && return
    [[ $R6 == 1 ]] && return
    [ $OS_RL = 2 ] && return
    return
    echo
    echo "installing eaccelerator..."
    cd $IN_SRC
    fileurl=$EAC_URL && filechk
    tar xf eaccelerator-$EAC_VER.tar.bz2
    cd eaccelerator-$EAC_VER/
    make_clean
    $IN_DIR/php/bin/phpize
    ./configure --enable-eaccelerator=shared \
        --with-eaccelerator-shared-memory \
        --with-php-config=$IN_DIR/php/bin/php-config
    [ $? != 0 ] && err_exit "eaccelerator configure err"
    make 
    [ $? != 0 ] && err_exit "eaccelerator make err"
    make install
    [ $? != 0 ] && err_exit "eaccelerator install err"
    mkdir $IN_DIR/eaccelerator_cache
    local EA_DIR=`/www/wdlinux/php/bin/php-config --extension-dir`
    echo '[eaccelerator]
extension_dir="'$EA_DIR'"
extension="/eaccelerator.so"
eaccelerator.shm_size="8"
eaccelerator.cache_dir="'$IN_DIR'/eaccelerator_cache"
eaccelerator.enable="1"
eaccelerator.optimizer="1"
eaccelerator.check_mtime="1"
eaccelerator.debug="0"
eaccelerator.filter=""
eaccelerator.shm_max="0"
eaccelerator.shm_ttl="3600"
eaccelerator.shm_prune_period="3600"
eaccelerator.shm_only="0"
eaccelerator.compress="1"
eaccelerator.compress_level="9"' >> $IN_DIR/etc/php.ini
    cd $IN_SRC
    rm -fr eaccelerator-$EAC_VER/
    touch $eac_inf
}

