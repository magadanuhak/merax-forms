FROM alpine:3.9 as base

# Install packages
RUN apk --no-cache add \
    php7 \
    php7-fpm \
    php7-opcache \
    php7-pdo_mysql \
    php7-json \
    php7-openssl \
    php7-curl \
    php7-iconv \
    php7-fileinfo \
    php7-soap \
    php7-simplexml \
    php7-exif \
    php7-zip \
    php7-session \
    php7-zlib \
    php7-xml \
    php7-phar \
    php7-intl \
    php7-dom \
    php7-xmlreader \
    php7-ctype \
    php7-mbstring \
    php7-gd \
    php7-tokenizer \
    php7-bcmath \
    supervisor \
    curl && \
    rm -rf /var/cache/apk/*

# Configure PHP-FPM
COPY deploy/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY deploy/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

FROM base as builder

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
    composer global require hirak/prestissimo

COPY composer.json composer.lock /app/
WORKDIR /app/
RUN composer install  \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts \
    --no-dev

COPY . ./
RUN composer dump-autoload --optimize && \
	php artisan route:cache

FROM base

# Install packages
RUN apk --no-cache add nginx && \
	rm -rf /var/cache/apk/*

# Configure nginx
COPY deploy/nginx.conf /etc/nginx/nginx.conf

# Configure supervisord
COPY deploy/supervisord.conf /etc/supervisor/conf.d/supervisor.conf

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /run && \
    chown -R nobody.nobody /var/lib/nginx && \
    chown -R nobody.nobody /var/tmp/nginx && \
    chown -R nobody.nobody /var/log/nginx

# Setup document root
RUN mkdir -p /var/www/html

ENV SUPERCRONIC_URL=https://github.com/aptible/supercronic/releases/download/v0.1.9/supercronic-linux-amd64 \
    SUPERCRONIC=supercronic-linux-amd64 \
    SUPERCRONIC_SHA1SUM=5ddf8ea26b56d4a7ff6faecdd8966610d5cb9d85

RUN curl -fsSLO "$SUPERCRONIC_URL" \
 && echo "${SUPERCRONIC_SHA1SUM}  ${SUPERCRONIC}" | sha1sum -c - \
 && chmod +x "$SUPERCRONIC" \
 && mv "$SUPERCRONIC" "/usr/local/bin/${SUPERCRONIC}" \
 && ln -s "/usr/local/bin/${SUPERCRONIC}" /usr/local/bin/supercronic

# Switch to use a non-root user from here on
USER nobody

# Add application
WORKDIR /var/www/html
COPY --chown=nobody --from=builder /app ./
COPY --chown=nobody .env.staging .env

# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=5s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
