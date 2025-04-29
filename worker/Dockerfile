FROM php:8.2-cli

ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=$USER_UID

# Install Supervisor
RUN apt-get update && apt-get install -y supervisor

RUN apt-get update && apt-get install -y \
    curl \
    default-mysql-client \
    libjpeg-dev \
    libmagickwand-dev \
    libmcrypt-dev \
    libonig-dev \
    libpng-dev \
    libxslt1-dev \
    libzip-dev \
    sudo \
    unzip \
    vim \
    zip \
    openssh-client \
    git

# Install the php-extension-installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Make the script executable
RUN chmod +x /usr/local/bin/install-php-extensions

# Now install PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    pdo_pgsql \
    gd \
    intl \
    zip \
    xdebug \
    opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -rf composer-setup.php

# Create app directory
RUN mkdir /app

# Add user and group, and set permissions for required folders
RUN groupadd --gid $USER_GID $USERNAME \
    && useradd -s /bin/bash --uid $USER_UID --gid $USER_GID -m $USERNAME \
    && chown -R $USER_UID:$USER_GID /app

# Switch to the non-root user
USER $USERNAME

# Changing Workdir
WORKDIR /app