FROM php:7-fpm

MAINTAINER Achilles Creative Media

RUN apt-get update && apt-get -y install \
	git \
	g++ \
	libcurl4-gnutls-dev \
	libicu-dev \
	libmcrypt-dev \
	libpq-dev \
	libxml2-dev \
	mysql-client \
	unzip \
	zlib1g-dev \
	vim

RUN git clone -b 3.1.4 https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
	&& docker-php-ext-install curl intl json mbstring mcrypt pdo pdo_pgsql pdo_mysql mysqli redis xml \
	&& apt-get autoremove && apt-get autoclean \
	&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN echo 'date.timezone="Europe/Amsterdam"' >> /usr/local/etc/php/conf.d/date.ini \
	&& echo 'session.save_path = "/tmp"' >> /usr/local/etc/php/conf.d/session.ini

# BUILD CONTEXT NEEDS TO BE THE ROOT OF THE PROJECT!
COPY www /var/www

WORKDIR /var/www