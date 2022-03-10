# perl install function
function perl_ins {
    local IN_LOG=$LOGPATH/${logpre}_perl_install.log
    [ -f $perl_inf ] && return
    echo
    echo "perl installing..."
    cd $IN_SRC
    fileurl=$PERL_URL && filechk
    tar xf perl-$PERL_VER.tar.gz
    cd perl-$PERL_VER
    ./Configure -des -Dprefix=/usr
    [ $? != 0 ] && err_exit "perl configure err"
    make
    [ $? != 0 ] && err_exit "perl make err"
    make install
    [ $? != 0 ] && err_exit "perl install err"
    cd $IN_SRC
    rm -fr pcre-$PERL_VER
    touch $perl_inf
}

