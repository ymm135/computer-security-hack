# autoconf install function
function autoconf_ins {
    local IN_LOG=$LOGPATH/${logpre}_autoconf_install.log
    [ -f $autoconf_inf ] && return
    echo
    echo "autoconf installing..."
    cd $IN_SRC
    fileurl=$AUTOCONF_URL && filechk
    tar xf autoconf-$AUTOCONF_VER.tar.gz
    cd autoconf-$AUTOCONF_VER
    ./configure --prefix=/usr
    [ $? != 0 ] && err_exit "autoconf configure err"
    make
    [ $? != 0 ] && err_exit "autoconf make err"
    make install
    [ $? != 0 ] && err_exit "autoconf install err"
    cd $IN_SRC
    rm -fr pcre-$AUTOCONF_VER
    touch $autoconf_inf
}

