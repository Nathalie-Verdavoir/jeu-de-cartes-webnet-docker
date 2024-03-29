FROM php:7.4.29-apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
EXPOSE 8000
RUN apt update

RUN apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip
WORKDIR /var/www
RUN docker-php-ext-install intl 
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo 
RUN docker-php-ext-install pdo_mysql
RUN pecl install apcu
RUN docker-php-ext-enable apcu
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
COPY . .

# Dossier de travail

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony


WORKDIR /var/www
#RUN composer update
RUN rm -rf vendor composer.lock && composer install

CMD symfony server:start

