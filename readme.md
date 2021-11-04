# AppsMo Docker Wordpress App
Has all AppsMo plugins and themes in a docker container


## Installation
* Clone the Repository

Build the images and start the services:
```
docker-compose up -d --build
```

## Helper scripts
Added wp-cli so commands like "$ docker-compose run --rm wp user list" can be used to get all users