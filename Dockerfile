FROM php:7.0.30-apache

RUN docker-php-ext-install mysqli
RUN adduser --disabled-password --gecos '' flagisetcpasswd
RUN set -ex     && a2enmod include cgid     && sed -i 's/Options -Indexes/Options -Indexes +Includes/' /etc/apache2/conf-enabled/docker-php.conf

COPY config/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY flag/.xmlflag /etc/.xmlflag
COPY flag/.desflag /etc/.desflag
COPY flag/.lfiflag /etc/.lfiflag
COPY www/ /var/www/html/
COPY www/git_backup.tar.gz /tmp/git_backup.tar.gz
RUN mkdir -p /var/www/html/.git     && tar xzf /tmp/git_backup.tar.gz -C /var/www/html/.git     && rm /tmp/git_backup.tar.gz
