function make_clean {
    if [ $RE_INS == 1 ]; then
        make clean >/dev/null 2>&1
    fi
}

function wget_down {
    if [ $SOFT_DOWN == 1 ]; then
        echo "start down..."
        for i in $*; do
            [ $(wget -c $i) ] && exit
        done
    fi
}

function filechk {
    [ -s "${fileurl##*/}" ] || wget -nc $fileurl
    if [ ! -e "${fileurl##*/}" ];then
        echo "${fileurl##*/} download failed"
        kill -9 $$
    fi
}

function err_exit {
    echo 
    echo 
    uname -m
    [ -f /etc/redhat-release ] && cat /etc/redhat-release
    echo -e "\033[31m----Install Error: $1 -----------\033[0m"
    echo
    echo -e "\033[0m"
    echo
    exit
}

function error {
    echo -e "\033[31m ERROR: $1 \033[0m"
    exit
}

function file_cp {
    #[ -f $2 ] && mv $2 ${2}$(date +%Y%m%d%H)
    cd $IN_PWD/conf
    [ -f $1 ] && cp -f $1 $2
}

function file_cpv {
    cd $IN_PWD/conf
    [ -f $1 ] && cp -f $1 $2
}

function file_rm {
    [ -f $1 ] && rm -f $1
}

function file_bk {
    [ -f $1 ] && mv $1 ${1}_$(date +%Y%m%d%H)
}

function Checkinitd {
    [ -f /etc/init.d/$1 ] && rm -f /etc/init.d/$1
    [ $R7 == 1 ] && cp -f /www/wdlinux/init.d/$1 /etc/init.d/$1 || ln -s /www/wdlinux/init.d/$1 /etc/init.d/$1
}

function wdcpinitd {
    [ -f /etc/init.d/wdcp ] && rm -f /etc/init.d/wdcp
    if [ $R7 == 1 ];then
	cp -f /www/wdlinux/wdcp/wdcp.sh /etc/init.d/wdcp
    else
	ln -s /www/wdlinux/wdcp/wdcp.sh /etc/init.d/wdcp
    fi
}

function lanmp_in_finsh {
    echo
    echo
    echo
    echo -e "      \033[31mCongratulations ,lanmp,wdCP install is complete"
    echo -e "      visit http://ip"
    echo -e "      wdCP http://ip:8080"
    echo -e "      more infomation please visit http://www.wdlinux.cn/bbs/\033[0m"
    echo
}

function wdcp_in_finsh {
    echo
    echo
    echo
    echo -e "      \033[31mconfigurations, wdcp install is complete"
    echo -e "      visit http://ip:8080"
    echo -e "      more infomation please visit http://www.wdlinux.cn/bbs/\033[0m"
    echo
}

