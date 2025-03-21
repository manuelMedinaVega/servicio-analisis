FROM composer:latest

ENV COMPOSERUSER=analisis
ENV COMPOSERGROUP=analisis

RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}