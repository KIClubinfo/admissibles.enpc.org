FROM php:7.4-apache as base
RUN apt-get update && apt-get upgrade -y
RUN apt install zip unzip -y
RUN docker-php-ext-install mysqli
EXPOSE 80

COPY conf_server/php.ini /usr/local/etc/php/php.ini
COPY conf_server/apache.conf /usr/local/apache2/conf/httpd.conf

WORKDIR /var/www/html/

RUN apt update && apt upgrade -y
RUN apt install python3 python3-pip -y
COPY ./solver/requirements.txt ./solver/requirements.txt
RUN pip install -r ./solver/requirements.txt

COPY composer_install.sh .
COPY composer.json .
COPY composer.lock .
RUN chmod +x composer_install.sh
RUN ./composer_install.sh
RUN php composer.phar install

FROM base as production

WORKDIR /var/www/html/
COPY . .
