FROM poupou/alpine-nginx-php8.0fpm:latest
LABEL maintainer="Intergo Interactive Ltd. <inquiries@intergo.com.cy>"

##########################################################################
# Install dependencies
RUN apk update && apk upgrade && apk add -U --no-cache \
    sqlite openssh-client git \
    php7-sqlite3 php7-pdo_sqlite php7-bcmath php7-redis php7-simplexml php7-sockets \
    php7-soap php7-apcu \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

RUN composer self-update --2

RUN touch /tmp/xdebug.log && chmod 776 /tmp/xdebug.log

#APPLY APCU SETTINGS
RUN echo "apc.enable_cli=1" >> /etc/php8/php.ini
RUN echo "apc.shm_size=128M" >> /etc/php8/php.ini

WORKDIR /var/www

# Installing Appoptics APM agent
RUN curl -sSO https://files.appoptics.com/appoptics-php.sh
RUN sh appoptics-php.sh --service-key=MYiS8h--cBSVYU1pEmbne20EcWiP5FSU65AEJSH3ugSzzAsmNa4aK-kCoI8cnn-1YCdic6U:local-valentinos-smsto