FROM php:8.1-fpm

ENV TZ=Europe/Moscow
RUN apt-get update && apt-get install -y --force-yes \
        default-libmysqlclient-dev  \
        libxml2-dev \
        libc-client-dev libkrb5-dev libpng-dev \
        screen \
        git \
        unoconv \
        gnupg \
        libzip-dev \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql soap zip gd intl opcache \
    && docker-php-ext-enable mysqli pdo pdo_mysql soap	zip gd intl opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN echo "include=/usr/local/etc/php/conf.d/docker-php-ext-xdebug-custom.ini" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN mkdir -m a+wxr /var/log/xdebug \
    && touch /var/log/xdebug/xdebug.log \
    && chmod a+rw /var/log/xdebug/xdebug.log

CMD ["php-fpm"]

