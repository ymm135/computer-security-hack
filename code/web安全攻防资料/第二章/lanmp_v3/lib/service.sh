# start services
function start_srv {
    [ -f $conf_inf ] && return
    echo
    echo "starting..."
    service mysqld restart
    if [ $SERVER == "nginx" ]; then
        service nginxd start
    elif [ $SERVER == "na" -o $SERVER_ID == 4 ]; then
        service httpd start
        service nginxd start
    else
        service httpd start
    fi
    service memcached start
    service wdcp start
    service pureftpd start
    if [ $R7 == 1 ];then
	systemctl stop firewalld.service
	systemctl disable firewalld.service
	systemctl restart iptables.service
	systemctl enable iptables.service
    fi
    /sbin/iptables -I INPUT -p tcp -m tcp --dport 20000:20500 -m state --state NEW -j ACCEPT
    /sbin/iptables -I INPUT -p tcp --dport 80 -j ACCEPT
    /sbin/iptables -I INPUT -p tcp --dport 21 -j ACCEPT
    /sbin/iptables -I INPUT -p tcp --dport 8080 -j ACCEPT
    if [ $OS_RL == 2 ]; then
        [ -d /etc/sysconfig ] || mkdir -p /etc/sysconfig
        iptables-save > /etc/sysconfig/iptables
    else
        service iptables save
    fi
}

