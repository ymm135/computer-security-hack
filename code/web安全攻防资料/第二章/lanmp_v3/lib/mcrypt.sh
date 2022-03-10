# mcrypt install function
function mcrypt_ins {
    local IN_LOG=$LOGPATH/${logpre}_mcrypt_install.log
    echo
    [ -f $mcrypt_inf ] && return
    echo "installing mcrypt..."
    cd $IN_SRC
    fileurl=$MCRYPT_URL && filechk
    tar xf libmcrypt-$MCRYPT_VER.tar.gz
    cd libmcrypt-$MCRYPT_VER
    ./configure --prefix=/usr
    [ $? != 0 ] && err_exit "mcrypt configure err"
    make
    [ $? != 0 ] && err_exit "mcrypt make err"
    make install
    [ $? != 0 ] && err_exit "mcrypt install err"
    ldconfig
    cd libltdl
    ./configure --enable-ltdl-install && make && make install
    [ $? != 0 ] && err_exit "mcrypt ltdl install err"
    cd $IN_SRC
    rm -fr libmcrypt-$MCRYPT_VER
    touch $mcrypt_inf
}

