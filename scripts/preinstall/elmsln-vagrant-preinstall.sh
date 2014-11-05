#!/bin/bash
cd /var/www
sudo mkdir elmsln
sudo git clone https://github.com/btopro/elmsln.git
sudo chown -R $USER:$USER elmsln
cd /var/www/elmsln
git pull origin crazystuff
cat ~/legacy/scripts/preinstall/$1/values.sh | sudo bash /var/www/elmsln/scripts/install/root/elmsln-preinstall.sh
# need to destroy the .drush directory so we can test this function too
sudo rm -rf ~/.drush
bash /var/www/elmsln/scripts/install/users/elmsln-admin-user.sh
# run the installer
bash /var/www/elmsln/scripts/install/elmsln-install.sh
drush sa
drush @online cc drush
drush @online status
