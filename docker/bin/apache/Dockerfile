FROM php:7.4.22-apache

# Install required librares
RUN apt -y update --fix-missing
RUN apt -y install nano mc wget htop zip git iputils-ping libxml2-dev

# Install Symfony, Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Install xdebug
RUN pecl install xdebug-2.9.1 \
    && docker-php-ext-enable xdebug

# Install zip
RUN apt -y install libzip-dev \
    && docker-php-ext-install zip

# Install intl
RUN apt -y install libicu-dev \
    && docker-php-ext-install -j$(nproc) intl

# Install gd
RUN apt -y install libpng-dev \
    && docker-php-ext-install gd


# Cleaning APT
RUN apt -y autoremove

# Enable apache modules
RUN a2enmod rewrite headers

# Add user
ARG developer_name
ARG developer_uid
RUN useradd -m ${developer_name} -s /bin/bash -u ${developer_uid}

WORKDIR /var/www/html/webapp