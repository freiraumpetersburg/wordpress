FROM quay.io/aboutsource/wordpress:php7.4-apache

RUN apt-get update && apt-get upgrade -y

COPY wp-cli.yml .
COPY config/ ./config
COPY vendor/ ./vendor
COPY application/ ./application
