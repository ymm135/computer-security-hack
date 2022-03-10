# libiconv install function
function libiconv_ins {
    local IN_LOG=$LOGPATH/${logpre}_libiconv_install.log
    echo
    [ -f $libiconv_inf ] && return
    echo "installing libiconv..."
    cd $IN_SRC
    fileurl=$ICONV_URL && filechk
    tar xf libiconv-$ICONV_VER.tar.gz
    cd libiconv-$ICONV_VER
    if [ $R7 == 1 ] || [ $OS_RL == 2 ];then
    cd srclib
    sed -i -e '/gets is a security/d' stdio.in.h
    cd ..
    fi
    ./configure --prefix=/usr
    [ $? != 0 ] && err_exit "libiconv configure err"
    make -j $CPUS
    [ $? != 0 ] && err_exit "libiconv make err"
    make install
    [ $? != 0 ] && err_exit "libiconv install err"
    ldconfig
    cd $IN_SRC
    rm -fr libiconv-$ICONV_VER
    touch $libiconv_inf
}

