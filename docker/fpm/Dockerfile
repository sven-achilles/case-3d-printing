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

RUN docker-php-ext-install curl intl json mbstring pdo pdo_pgsql pdo_mysql mysqli xml \
	&& apt-get autoremove && apt-get autoclean \
	&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN echo 'date.timezone="Europe/Amsterdam"' >> /usr/local/etc/php/conf.d/date.ini \
	&& echo 'session.save_path = "/tmp"' >> /usr/local/etc/php/conf.d/session.ini

WORKDIR /var/www