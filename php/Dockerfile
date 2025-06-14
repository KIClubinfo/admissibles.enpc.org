FROM php:7.4-apache as base
RUN apt-get update
RUN apt-get upgrade -y
RUN apt install zip -y
RUN apt install unzip -y
RUN docker-php-ext-install mysqli
EXPOSE 80

COPY conf_server/php.ini /usr/local/etc/php/php.ini
COPY conf_server/apache.conf /usr/local/apache2/conf/httpd.conf

WORKDIR /var/www/html/

RUN apt update && apt upgrade -y
RUN apt install python3 -y
RUN apt install python3-pip -y
RUN apt install pipenv -y
COPY ./solver/requirements.txt ./solver/requirements.txt
RUN pip3 install -r ./solver/requirements.txt

COPY composer_install.sh .
COPY composer.json .

WORKDIR /opt

ADD https://packages.gurobi.com/9.5/gurobi9.5.1_linux64.tar.gz /opt
RUN tar xvfz /opt/gurobi9.5.1_linux64.tar.gz
ENV GUROBI_HOME="/opt/gurobi951/linux64"
ENV PATH="${GUROBI_HOME}/bin:${PATH}"
ENV LD_LIBRARY_PATH="${LD_LIBRARY_PATH}:${GUROBI_HOME}/lib"
COPY ./solver/gurobi.lic /opt/gurobi951/gurobi.lic
ENV GRB_LICENSE_FILE="/opt/gurobi951/gurobi.lic"

FROM base as production

WORKDIR /var/www/html/
COPY . .
