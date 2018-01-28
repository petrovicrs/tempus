FROM ubuntu:16.04

# Make sure logs are getting send to stdout directly
ENV PYTHONUNBUFFERED 1
# Make nano work in the containers
ENV TERM xterm
# Let the conatiner know that there is no tty
ENV DEBIAN_FRONTEND noninteractive

# Run updates
RUN rm -rf /var/lib/apt/lists/*
RUN apt-get update
RUN apt-get -y upgrade

# Basic requirements
RUN apt-get -y install cron-apt curl git nano netcat python-setuptools unzip

# Install symphony
RUN mkdir -p /usr/local/bin
RUN curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
RUN chmod a+x /usr/local/bin/symfony

# WordPress dependencies
RUN apt-get update && apt-get -y --allow-unauthenticated install mysql-client nginx php7.0-fpm php7.0-cli php7.0-common php7.0-mysql php7.0-curl php7.0-gd\
 php7.0-intl php7.0-mcrypt php7.0-xmlrpc php7.0-xsl php7.0-json php7.0-opcache php7.0-readline php7.0-xml php7.0-mbstring

# Nginx config
RUN sed -i -e"s/keepalive_timeout\s*65/keepalive_timeout 2/" /etc/nginx/nginx.conf
RUN sed -i -e"s/keepalive_timeout 2/keepalive_timeout 2;\n\tclient_max_body_size 100m/" /etc/nginx/nginx.conf
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# PHP-FPM config
RUN mkdir -p /run/php
RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = 100M/g" /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/post_max_size\s*=\s*8M/post_max_size = 100M/g" /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf
RUN sed -i -e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" /etc/php/7.0/fpm/pool.d/www.conf
RUN sed -i -e "s/;listen.mode = 0660/listen.mode = 0750/g" /etc/php/7.0/fpm/pool.d/www.conf
RUN find /etc/php/7.0/cli/conf.d/ -name "*.ini" -exec sed -i -re 's/^(\s*)#(.*)/\1;\2/g' {} \;

# Nginx site config
ADD ./conf/nginx-site.conf /etc/nginx/sites-available/default

# Supervisor config
RUN /usr/bin/easy_install supervisor
RUN /usr/bin/easy_install supervisor-stdout
ADD ./conf/supervisord.conf /etc/supervisord.conf

# Wordpress initialization and startup script
ADD ./scripts/start.sh /start.sh
RUN chmod 755 /start.sh

ADD . /usr/share/nginx/www
ADD ./configuration /configuration

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#
## Local development config
#ADD ./configuration /configuration

CMD ["/bin/bash", "/start.sh"]
