FROM php:8.4-apache

# Instalar tudo em linhas diretas sem barras para evitar erros de sintaxe de quebra de linha
RUN apt-get update && apt-get install -y libpq-dev libzip-dev libicu-dev zip unzip git
RUN docker-php-ext-configure intl && docker-php-ext-install pdo pdo_pgsql zip intl
RUN a2enmod rewrite

# Configurar o Apache para a pasta public do Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html

# Permissões totais nas pastas necessárias
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-intl

EXPOSE 80

# Comando de inicialização direto
CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && apache2-foreground
