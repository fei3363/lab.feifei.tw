FROM php:7.0.30-apache
RUN docker-php-ext-install mysqli

RUN adduser --disabled-password --gecos '' flagisetcpasswd
RUN set -ex \
    && a2enmod include cgid \
    && sed -i 's/Options -Indexes/Options -Indexes +Includes/' /etc/apache2/conf-enabled/docker-php.conf
    
