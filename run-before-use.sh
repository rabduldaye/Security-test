#!/bin/bash

#If this program fails with "something something ^M" run `dos2unix run-before-use.sh`.

if [[ $1 == "config" ]] || [[ ! -d 'vendor' ]]; then
  cp .env.example .env
  composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
  npm install && npm run dev
  php artisan key:generate
fi

if [[ $1 == "restart" ]]; then
  sudo service nginx restart
  echo "restarting nginx"
fi

tput sgr0; echo "Clearing config."
php artisan config:clear
echo "Clearing and seeding database."
php artisan migrate:fresh --seed --force
echo "Resetting routes"
php artisan route:list &> /dev/null
if [[ $? -eq 0 ]]
then
  tput setaf 2; echo "Complete."
else
  tput setaf 1; echo "Error! Re-run `php artisan route:list` for details"
fi
tput sgr0
