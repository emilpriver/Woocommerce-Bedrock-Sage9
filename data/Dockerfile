# Pull Composer image from DockerHub
FROM composer:1.8.5 as build-stage-0

# Copy src and install Composer dependencies
COPY /src /composer
WORKDIR /composer
RUN composer install
WORKDIR /composer/web/app/themes/leagueshop
RUN composer install

# Pull Node image from DockerHub
FROM node:10.16.0-stretch as build-stage-1

# Copy from build stage 0 and install Yarn dependencies
COPY --from=build-stage-0 /composer /yarn
WORKDIR /yarn/web/app/themes/leagueshop
RUN yarn install
RUN yarn build:production

# Pull Alpine image from DockerHub
FROM alpine:3.9.4

# Copy from build stage 1, save in /var/www and set permissions
COPY --from=build-stage-1 /yarn /var/www/html
WORKDIR /var/www
RUN chown -R 82:82 html