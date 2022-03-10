# wdcp install function
function wdcp_ins {
    [ -f $wdcp_inf ] && return
    cd $IN_SRC
    fileurl=$WDCP_URL && filechk
    fileurl=$PHPMYADMIN_URL && filechk
    mkdir -p /www/wdlinux/wdcp/{logs,data,tmp,rewrite,conf}
    tar zxvf phpmyadmin4.tar.gz -C /www/web/default
    pma=$(expr substr "$(echo $RANDOM | md5sum)" 1 8)
    cp -pR /www/web/default/phpmyadmin4 /www/wdlinux/wdcp/phpmyadmin
    mv /www/web/default/phpmyadmin4 /www/web/default/pma_${pma}
    tar zvxf wdcp_${WDCP_VER}_${BIT}.tar.gz -C /www/wdlinux/wdcp
    cd /www/wdlinux/wdcp
    ln -sf bin/wdcp_${WDCP_VER}_${BIT} wdcp
    chown root.root bin favicon.ico html static shell conf -R
    chmod 700 data shell bin conf
    [ $APA_ID == 2 ] && touch conf/apa24.conf
    if [ $OS_RL == 2 ];then
    file_cp wdcp.sh-ubuntu /www/wdlinux/wdcp/wdcp.sh
    ln -sf /www/wdlinux/wdcp/wdcp.sh /etc/init.d/wdcp
    update-rc.d -f wdcp defaults
    update-rc.d -f wdcp enable 235
    else
    wdcpinitd
    chkconfig --add wdcp
    chkconfig --level 35 wdcp on
    fi
    echo "pma_"${pma} > /www/wdlinux/wdcp/conf/phpmyadmin.conf
    mrpw="/www/wdlinux/wdcp/conf/mrpw.conf"
    echo "wdlinux.cn" > $mrpw && chmod 600 $mrpw
    chmod 600 conf/*.conf
    echo $SERVER_ID > /www/wdlinux/wdcp/conf/eng.conf
    file_cp public_html.tar.gz /www/wdlinux/wdcp/data/
    file_cp dz7_apache.conf /www/wdlinux/wdcp/rewrite/
    file_cp dz7_nginx.conf /www/wdlinux/wdcp/rewrite/
    file_cp dzx32_apache.conf /www/wdlinux/wdcp/rewrite/
    file_cp dzx32_nginx.conf /www/wdlinux/wdcp/rewrite/
    touch $wdcp_inf
}

