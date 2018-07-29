FROM nginx

MAINTAINER Achilles Creative Media

RUN apt-get update && apt-get -y install \
	vim

ADD ./docker/nginx/config/nginx.conf /etc/nginx/conf.d/default.conf

# BUILD CONTEXT NEEDS TO BE THE ROOT OF THE PROJECT!
COPY www /var/www

WORKDIR /var/www