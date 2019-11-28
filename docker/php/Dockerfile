FROM php:7.2-fpm

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev libpng-dev libxml2-dev unzip && \
        pecl install xdebug-2.6.1 && \
        docker-php-ext-enable xdebug

RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql mbstring zip gd soap calendar bcmath

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

ADD custom.ini /usr/local/etc/php/php.ini

RUN mkdir -m 777 /tmp/.composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp/.composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer global require hirak/prestissimo && chmod 777 -R /tmp/.composer

ENV TZ Europe/Chisinau
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
