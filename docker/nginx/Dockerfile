FROM nginx:stable

RUN apt-get update
ADD ./site.conf /etc/nginx/conf.d/default.conf
CMD ["nginx", "-g", "daemon off;"]