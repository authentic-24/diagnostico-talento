FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Establece directorio de trabajo
WORKDIR /var/www/html

# Copia primero composer.json y composer.lock (para usar cache de capas)
COPY composer.json composer.lock ./

# Instala dependencias PHP (sin dev para producción)
RUN composer install --no-dev --optimize-autoloader

# Ahora copia el resto del código
COPY . .

# Da permisos a storage y bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Habilita mod_rewrite
RUN a2enmod rewrite

# Configura el DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Cambia el puerto de Apache al que Cloud Run espera
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 8080
