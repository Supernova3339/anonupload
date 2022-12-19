FROM php:7.4-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql

RUN apt-get update

# 6. User

ARG uid
RUN useradd -G www-data,root -u  -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser && \
    chown -R devuser /home/devuser/.composer/

# 1. development packages
RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    nano \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    neofetch \
    g++

# 2. apache configs + document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-configure gd && docker-php-ext-install gd

RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    exif \
    pdo_mysql 

# 5. composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["apache2ctl", "-D", "FOREGROUND"]
