docker compose run --rm backend composer install
docker compose run --rm backend php /app/init --env=Development --overwrite=All --delete=All
docker compose up -d
sleep 5
docker compose run --rm backend yii migrate/up --interactive 0
