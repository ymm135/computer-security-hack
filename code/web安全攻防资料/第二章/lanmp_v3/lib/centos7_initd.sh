#!/bin/bash
grep -q 'release 7' /etc/redhat-release && R7=1 || R7=0
[ $R7 == 0 ] && exit

function Checkinitd {
	[ -f /etc/rc.d/init.d/$1 ] && rm -f /etc/rc.d/init.d/$1 && cp -f /www/wdlinux/init.d/$1 /etc/rc.d/init.d/$1
}
function Checkwdcp {
	[ -f /www/wdlinux/wdcp/wdcp.sh ] && rm -f /etc/rc.d/init.d/wdcp && cp -f /www/wdlinux/wdcp/wdcp.sh /etc/rc.d/init.d/wdcp
}

Checkinitd httpd
Checkinitd nginxd
Checkinitd pureftpd
Checkinitd memcached
Checkwdcp
echo "Check Ok"
reboot
echo
