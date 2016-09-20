#!/usr/bin/sh
# after install, disable all performance stuff and provide standard developer UX pattern
drush @elmsln en devel,context_ui,field_ui,views_ui,environment_indicator --y
drush @elmsln vset preprocess_css 0 --y
drush @elmsln vset preprocess_js 0 --y
drush @elmsln vset admin_menu_dropdown_default 0 --y
