# Étape 1 : image PHP officielle avec extensions utiles
FROM php:8.2-cli

# Étape 2 : Installer les dépendances système
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip


# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Créer le dossier de travail
WORKDIR /var/www

# Étape 5 : Copier le code de l'app dans le conteneur
COPY . .

# Étape 6 : Installer les dépendances Laravel
RUN composer install

# Étape 7 : Donner les bons droits
RUN chmod -R 755 /var/www && chown -R www-data:www-data /var/www

# Étape 8 : Lancer le serveur Laravel (port 8000)
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
