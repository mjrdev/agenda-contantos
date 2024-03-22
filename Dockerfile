# Use a imagem oficial do PHP 8.1
FROM php:8.1-fpm

# Atualize os pacotes e instale as dependências necessárias
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        libonig-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        unzip \
        git \
        curl \
        libxml2-dev
    && docker-php-ext-install pdo_mysql zip gd exif pcntl bcmath soap opcache intl

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Defina o diretório de trabalho como o diretório do aplicativo Laravel
WORKDIR /var/www/

# Copie o arquivo de configuração do PHP
COPY ./docker/php.ini /usr/local/etc/php/

COPY . .

RUN cp .env.example .env && composer install && php artisan key:generate

RUN npm install && npm run build
# Expose port 9000 to Docker
EXPOSE 9000

# Execute o PHP-FPM
CMD ["php-fpm"]
