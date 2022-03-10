#weengine install function
function wee_ins {
    local IN_LOG=$LOGPATH/${logpre}_weeng_install.log
    echo
    echo "installing weeng..."
    cd $IN_SRC
    fileurl=${DL_URL}/files/site/we7.tar.gz && filechk
    mkdir -p /www/web/we7/public_html
    tar -zxvf we7.tar.gz -C /www/web/we7/public_html
    rm -f /www/web/we7/public_html/index.html
    sqlrootpwd="wdlinux.cn"
    mysql="/www/wdlinux/mysql/bin/mysql"
    pwd=$(expr substr "$(echo $RANDOM | md5sum)" 1 8)
    $mysql -uroot -p"$sqlrootpwd" -e "CREATE database we7db DEFAULT CHARACTER SET UTF8;"
    $mysql -uroot -p"$sqlrootpwd" -e "grant SELECT, INSERT, UPDATE, DELETE, CREATE,DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, SHOW VIEW on we7db.* to 'we7'@'localhost' identified by '$pwd';"
    /www/wdlinux/php/bin/php -f /www/web/we7/public_html/install-cli.php we7@$pwd@localhost@we7db
    chown -R www.www /www/web/we7/public_html
}

