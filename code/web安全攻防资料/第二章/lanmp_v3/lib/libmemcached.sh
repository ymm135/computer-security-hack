# libmemcached install function
function libmemcached_ins {
    local IN_LOG=$LOGPATH/${logpre}_libmemcached_install.log
    echo
    [ -f $libmemcached_inf ] && return
    echo "installing libmemcached..."
    cd $IN_SRC
    fileurl=$LIBMEMCACHED_URL && filechk
    tar xf libmemcached-$LIBMEMCACHED_VER.tar.gz
    cd libmemcached-$LIBMEMCACHED_VER
    ./configure --with-memcached=/www/wdlinux/memcached --prefix=/usr
    [ $? != 0 ] && err_exit "libmemcached configure err"
    make
    [ $? != 0 ] && err_exit "libmemcached make err"
    make install
    [ $? != 0 ] && err_exit "libmemcached install err"
    cd $IN_SRC
    rm -fr libmemcached-$LIBMEMCACHED_VER
    touch $libmemcached_inf
}

