#!/bin/bash

#grant permission to files inside wcdTest folder
#sudo chmod -R 777 /home/ubuntu/var/www/wcdTest

#Grant permission to files in required folder
# sudo chown -R www-data.www-data /var/www/whitecoatdomain/storage
# sudo chown -R www-data.www-data /var/www/whitecoatdomain/bootstrap/cache
# sudo chown -R www-data.www-data /var/www/whitecoatdomain/public
# sudo chown -R www-data.www-data /var/www/whitecoatdomain/public/media/tenants

# sudo chmod -R 775 storage
# sudo chmod -R 775 bootstrap/cache
# sudo chmod -R 775 public
# sudo chmod -R 775 public/media/tenants

#install all composer packages
# composer install
echo 'App starting' 

#Run migration
sudo php artisan migrate

#start all JS packages for VueJS
npm run prod

