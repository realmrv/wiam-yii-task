# Wiam Yii2 test task

## Requirements

- Docker
- Docker Compose

## Installation

### Auto

1. `chmod 775 deploy.sh`
2. `./deploy.sh`

### Manual

Yii2 docs [link](https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/start-installation.md#installing-using-docker) for detail

1. `docker compose run --rm backend composer install`
2. `docker compose run --rm backend php /app/init`
3. `docker compose up -d`
4. `docker compose run --rm backend yii migrate`

Access it in your browser by opening

- frontend: http://127.0.0.1:20080
- backend: http://127.0.0.1:21080/random-image-decision?permanent-token=xyz123
