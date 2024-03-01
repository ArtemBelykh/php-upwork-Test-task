FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
    
COPY . /var/www/html

RUN chmod -R 755 /var/www/html


WORKDIR /var/www/html

CMD php convertImages.php && apachectl -D FOREGROUND
