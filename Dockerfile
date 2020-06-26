FROM quay.io/aboutsource/wordpress:php7.4-apache

COPY wp-cli.yml .
COPY config/ ./config
COPY vendor/ ./vendor
COPY application/ ./application
