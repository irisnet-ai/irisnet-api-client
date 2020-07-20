<img alt="irisnet logo" src="https://www.irisnet.de/wp-content/uploads/2020/04/irisnet_logo.svg" width="40%">

# Irisnet API Plugin

This Irisnet API Plugin is a base plugin to use the AI functionality in Wordpress.


#### Create installable plugin zip file from this repository (shell) 

```shell script
git clone http://bitbucket.minick.x/scm/ir/irisnet-api-plugin.git && \
cd irisnet-api-plugin/ && \
npm install && \
composer install --no-dev && \
rm -rf .git node_modules src && \
rm .gitignore composer.* gulpfile.js README.md package* && \
cd ../ && \
zip -r irisnet-api-plugin.zip irisnet-api-plugin && \
rm -rf irisnet-api-plugin
```