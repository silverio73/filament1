FROM php:8.4-apache

# Instalar dependências do sistema e extensões PHP necessárias para o Laravel/Postgres/Filament
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql zip intl

# Ativar módulo rewrite do Apache (essencial para as rotas do Laravel)
RUN a2enmod rewrite

# Mudar a raiz do Apache para a pasta 'public' do Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar os arquivos do projeto para o container
COPY . /var/www/html

# Definir permissões para as pastas do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Executar a instalação das dependências
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-intl

# Expor a porta padrão que a Render usa
EXPOSE 80

# Comando para rodar o Apache e executar as migrações ao iniciar
CMD php artisan migrate --force && apache2-foreground
