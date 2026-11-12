FROM dunglas/frankenphp:1-php8.4-bookworm AS base

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && install-php-extensions intl zip pdo_sqlite

WORKDIR /app

FROM base AS dependencies

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

COPY . .
RUN mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        bootstrap/cache \
    && composer dump-autoload --no-dev --classmap-authoritative

FROM base AS runtime

COPY --from=dependencies --chown=www-data:www-data /app /app
COPY --chown=www-data:www-data Caddyfile /etc/frankenphp/Caddyfile

RUN setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp \
    && chown -R www-data:www-data /config/caddy /data/caddy

ENV PORT=80 \
    APP_ENV=production \
    APP_DEBUG=false \
    APP_KEY=base64:eZg2Q8fP9rW1vX4yZ8q0mK3lO6pT2wS5vY8uI1oN4m0= \
    ADMIN_USERNAME=admin \
    ADMIN_PASSWORD=baliguard2026 \
    LOG_CHANNEL=stderr \
    CACHE_STORE=array \
    SESSION_DRIVER=cookie \
    QUEUE_CONNECTION=sync \
    FILESYSTEM_DISK=local \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/tmp/balisafety.sqlite

USER www-data

CMD ["sh", "-c", "touch \"$DB_DATABASE\" && php artisan migrate --force && php artisan db:seed --force && exec frankenphp run --config /etc/frankenphp/Caddyfile"]
