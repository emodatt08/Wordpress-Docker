# AppsMo Docker Wordpress App
Has all AppsMo plugins and themes in a docker container


## Installation
* Clone the Repository

Build the images and start the services:
```
docker-compose up -d --build
```

## Helper scripts
Added wp-cli so you can run commands like:
$ docker-compose run --rm wp user list  --- to get all users
$ docker-compose run --rm wp plugin install wordpress-seo --- to install wordpress seo plugin
$ docker-compose run --rm wp plugin activate wordpress-seo --- to activate wordpress seo plugin