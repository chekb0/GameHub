# Usar la imagen oficial de PHP
FROM php:8.1-fpm

# Instalación de dependencias necesarias para Laravel y Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Composer
RUN composer install

# Ejecutar comandos de Laravel (key:generate y migrate)
RUN php artisan key:generate
RUN php artisan migrate

# Exponer el puerto donde correrá la app
EXPOSE 8080

# Comando para arrancar el servidor de Laravel
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]
