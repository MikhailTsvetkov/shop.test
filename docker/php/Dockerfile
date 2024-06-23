FROM php:8.3.8-fpm-alpine3.20 AS runtime

# Install runtime packages
RUN apk add --no-cache --upgrade \
        freetype \
        icu \
        libintl \
        libjpeg-turbo \
        libpng \
        libzip \
        openssl-dev \
        tzdata \
        libzip-dev \
        vim \
        nano \
        libxslt-dev

ENV PHP_REDIS_VERSION=6.0.2
ENV XDEBUG_VERSION=3.3.2

# Install php modules
RUN apk add --no-cache --virtual .build-deps \
        autoconf \
        curl-dev \
        freetype-dev \
        g++ \
        gcc \
        icu-dev \
        icu-libs \
        libjpeg-turbo-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        jpeg-dev  \
        libpng-dev \
        make \
        oniguruma-dev \
        zlib-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        calendar \
        curl \
        exif \
        gd \
        intl \
        mbstring \
        opcache \
        pcntl \
        pdo \
        pdo_mysql \
        xml \
        zip \
        xsl

RUN apk add --no-cache --update linux-headers

RUN  pecl install \
        redis-$PHP_REDIS_VERSION \
        xdebug-$XDEBUG_VERSION \
    && apk del .build-deps \
    && docker-php-ext-enable redis && docker-php-ext-enable xdebug && docker-php-ext-enable xsl

RUN echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Setup working directory
WORKDIR /var/www

FROM runtime AS composer

# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

FROM composer AS dev

RUN apk add --no-cache --virtual .build-deps \
        autoconf \
        gcc \
        g++ \
        make \
    && apk del .build-deps


FROM composer AS builder


FROM runtime AS release

COPY php.ini $PHP_INI_DIR/conf.d/zz-fine-tuning.ini

CMD ["php-fpm"]

COPY --chown=www-data:www-data --from=builder /var/www /var/www
