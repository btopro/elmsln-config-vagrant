#!/usr/bin/sh
# specific for moving down to vagrant
# rewrite settings for the local version
# move the pulled down shared_settings.php so we don't lose it but it isn't active
mv /var/www/elmsln/config/shared/drupal-7.x/settings/shared_settings.php /var/www/elmsln/config/shared/drupal-7.x/settings/original_shared_settings.php
# copy in our shared settings that we need in order to forcibly override some things

# this is one of the only parts specific to vagrant
cp /var/www/elmsln-config-vagrant/shared/drupal-7.x/settings/shared_settings.php /var/www/elmsln/config/shared/drupal-7.x/settings/shared_settings.php
