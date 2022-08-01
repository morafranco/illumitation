FROM alpine:3.16
ARG server_name

# trust this project public key to trust the packages.
RUN echo "https://dl.bintray.com/php-alpine/v3.16/php-8" >> /etc/apk/repositories

##### INSTALL BASIC LIBS #####
RUN apk --no-cache update && apk upgrade
RUN apk --no-cache add curl autoconf g++ file re2c make zlib-dev libtool pcre2-dev

##### INSTALL PHP #####
RUN apk --no-cache add php php-apache2
RUN apk --no-cache add \
        php8-curl php8-mbstring \
        php8-soap php8-xml php8-dom php8-openssl php8-json php8-tokenizer php8-xmlwriter php8-fileinfo php8-session

RUN sed -i 's/display_errors = Off/display_errors = On/' /etc/php8/php.ini        

##### CONFIGURE APACHE SERVER #####
RUN sed -i "s/#ServerName www.example.com:80/ServerName ${server_name}/" /etc/apache2/httpd.conf &&\
  sed -i '/LoadModule rewrite_module/s/^#//g' /etc/apache2/httpd.conf &&\
  sed -i 's#AllowOverride [Nn]one#AllowOverride All#' /etc/apache2/httpd.conf


RUN apk --no-cache add php8-phar php8-zlib
RUN mkdir /tmp/composer && cd /tmp/composer && php8 -r "copy('https://getcomposer.org/installer', '/tmp/composer/composer-setup.php');" 
RUN cd /tmp/composer &&  php8 composer-setup.php --install-dir=/usr/local/bin --filename=composer && php8 -r "unlink('composer-setup.php');" 

##### CLEANING IT UP #####
RUN rm -rfv /tmp/* /var/tmp/* /usr/share/doc/* /usr/share/man/*
#RUN rm -rfv /var/cache/apk/* /tmp/* /var/tmp/* /usr/share/doc/* /usr/share/man/*

COPY composer.lock composer.json /var/www/localhost/htdocs/

WORKDIR /var/www/localhost/htdocs

COPY . /var/www/localhost/htdocs

RUN composer install

RUN chown -R root:root \
        /var/www/localhost/htdocs/storage \
        /var/www/localhost/htdocs/bootstrap/cache

##### RUNNING APACHE #####
CMD  httpd -D FOREGROUND

