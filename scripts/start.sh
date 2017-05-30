#!/bin/sh
webroot="/usr/share/nginx/www"


#configure local environment
if [ -d /configuration/local ] && [ "$(ls -A /configuration/local)" ] && [ ! -d /opt/configuration ]
then
    mkdir -p /opt/configuration
    cp /configuration/local/* /opt/configuration

    if [ -f /opt/configuration/20-xdebug.ini ]
    then
        apt-get -y install php-xdebug
        mv /opt/configuration/20-xdebug.ini /etc/php/7.0/cli/conf.d/20-xdebug.ini
    fi
fi


if [ ! -d $webroot ]; then

    mkdir -p $webroot
    #cp -r /site/* $webroot/
	mkdir -p /var/log/nginx
	mkdir -p /var/log/mysql

	# Set file permissions
	chown -R www-data:www-data $webroot
	chmod -R 775 $webroot
fi

cd $webroot && php bin/console server:run 0.0.0.0:8001

supervisord -n | /usr/bin/tee /tmp/supervisor.log
