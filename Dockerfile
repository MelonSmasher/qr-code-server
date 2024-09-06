FROM jkaninda/laravel-php-fpm:8.3-alpine
LABEL authors="melon"

# install dependencies
RUN set -ex \
  && apk --no-cache add \
        nodejs \
        npm \
        ldb-dev \
        libldap \
        openldap-dev \
        pcre-dev \
        $PHPIZE_DEPS

RUN pecl install redis
RUN docker-php-ext-install ldap
RUN docker-php-ext-enable redis ldap

COPY . /var/www/html

VOLUME /var/www/html/storage

RUN composer install

RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/html
