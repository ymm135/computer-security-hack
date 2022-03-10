# pcre install function
function pcre_ins {
    local IN_LOG=$LOGPATH/${logpre}_pcre_install.log
    [ -f $pcre_inf ] && return
    echo
    echo "pcre installing..."
    cd $IN_SRC
    fileurl=$PCRE_URL && filechk
    tar xf pcre-$PCRE_VER.tar.gz
    cd pcre-$PCRE_VER
    ./configure --prefix=/usr
    [ $? != 0 ] && err_exit "pcre configure err"
    make
    [ $? != 0 ] && err_exit "pcre make err"
    make install
    [ $? != 0 ] && err_exit "pcre install err"
    ldconfig
    cd $IN_SRC
    rm -fr pcre-$PCRE_VER
    touch $pcre_inf
}

