#!/bin/sh
webroot="/usr/share/nginx/www"
cntDistFiles=$(find /configuration/local -name '*.dist' 2>/dev/null | wc -l)


# if number of dist files in configuration/local doesn't match with total number of files in folder => development env
if [ "$(find /configuration/local -type f 2>/dev/null | wc -l)" != "$cntDistFiles" ]
then
    # checking if folder /opt/configuration exists ensures we run following code only once
    if [ ! -d /opt/configuration ]
    then
        #configure local environment
        mkdir -p /opt/configuration

        cp /configuration/local/* /opt/configuration

        if [ -f /opt/configuration/20-xdebug.ini ]
        then
            apt-get -y install php-xdebug
            mv /opt/configuration/20-xdebug.ini /etc/php/7.0/fpm/conf.d/20-xdebug.ini
        fi
    fi
fi

if [ ! -d $webroot/vendor ]
then
    cd $webroot && composer install
fi

chown -R www-data:www-data $webroot
chmod -R 775 $webroot

cd $webroot && php bin/console server:run 0.0.0.0:8001

supervisord -n | /usr/bin/tee /tmp/supervisor.log
