# Используем образ PHP с Apache
FROM php:7.4-apache

# Установка дополнительных пакетов, необходимых для работы Imagick
RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
# Копируем исходный код приложения в директорию /var/www/html в контейнере
COPY . /var/www/html

RUN chmod -R 755 /var/www/html

# Указываем рабочую директорию
WORKDIR /var/www/html

# Команда для выполнения PHP скрипта перед запуском Apache

CMD php convertImages.php && apachectl -D FOREGROUND