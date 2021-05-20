FROM php:7.4-apache
RUN apt-get update && apt-get upgrade -y
RUN apt install zip unzip -y
RUN docker-php-ext-install mysqli
EXPOSE 80

COPY conf_server/php.ini /usr/local/etc/php/php.ini
COPY conf_server/apache.conf /usr/local/apache2/conf/httpd.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
WORKDIR /var/www/html/
COPY composer.sh .
COPY composer.json .
COPY composer.lock .
RUN chmod +x composer.sh
RUN ./composer.sh