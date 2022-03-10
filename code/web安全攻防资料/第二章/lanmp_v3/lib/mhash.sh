# mhash install function
function mhash_ins {
    local IN_LOG=$LOGPATH/${logpre}_mhash_install.log
    echo
    [ -f $mhash_inf ] && return
    echo "installing mhash..."
    cd $IN_SRC
    fileurl=$MHASH_URL && filechk
    tar xf mhash-$MHASH_VER.tar.gz
    cd mhash-$MHASH_VER
    ./configure --prefix=/usr
    [ $? != 0 ] && err_exit "mhash configure err"
    make
    [ $? != 0 ] && err_exit "mhash make err"
    make install
    [ $? != 0 ] && err_exit "mhash install err"
    ldconfig
    cd $IN_SRC
    rm -fr mhash-$MHASH_VER
    touch $mhash_inf
}

