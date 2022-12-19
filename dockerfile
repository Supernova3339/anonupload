FROM php:7.4-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
                                   --with-png-dir=/usr/include/ --enable-gd-native-ttf \
    && docker-php-ext-install -j$(nproc) gd
CMD ["apache2ctl", "-D", "FOREGROUND"]
