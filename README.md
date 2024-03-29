# Irisnet API Client

The Irisnet API Client allows you to add AI functionality to WordPress, that can help you to block or blur user content in real-time.

<img alt="irisnet logo" src="https://irisnet.de/wp-content/uploads/2020/04/irisnet_logo.svg" width="40%">

## How to Install

### From the WordPress.org Plugin Directory

The official Irisnet API Client for WordPress can be found here: https://wordpress.org/plugins/irisnet-api/

Alternatively you can install the plugin from your WordPress instance. From your WordPress admin panel, go to `Plugins > Add New` and type `irisnet` in the `search plugins` text field. The Irisnet API Client will appear in the results. Click `install now` to install the plugin.

### From this repository
Go to the releases section of the repository and download the most recent release. Then, from your WordPress admin panel, go to `Plugins > Add New` and click the `Upload Plugin` button at the top.

### From source
`npm`, `composer` and `git` are required to execute the following script from a unix based system.

```shell script
git clone https://github.com/irisnet-ai/irisnet-api-client.git && \
cd irisnet-api-client/ && \
npm install && \
composer install --no-dev && \
rm -rf `find . -type d -name ".git*"` node_modules src && \
rm .gitignore composer.* gulpfile.js README.md build.xml phpcs.xml package* && \
cd ../ && \
zip -r irisnet-api-client.zip irisnet-api-client && \
rm -rf irisnet-api-client
```

The script above will create a WordPress ready install package in the directory you are currently in. Use this zip file to install the plugin as explained above.

## How to use
From your WordPress admin panel go to `Plugins -> Installed Plugins` and scroll down the list until you find `Irisnet API Client`. You will need to activate the plugin to use it. Then click on Irisnet API in the left menu.

### Licenses
To make use of the plugin you need to add a valid license key. From the `Irisnet Dashboard` click on `Manage Licenses` in the `Licenses` pane. From there go to the `Add New License` tab and enter the license key in the text box. Make sure to turn the `Active` switch on and save. 

>A license key can be obtained here: [irisnet.de](https://irisnet.de/subscribe)

### Rules
Rules can be added in order to customize the the AI settings. Depending on your needs you might want to deny user uploads that contain nudity or illegal symbols. All this can be configured as one or more rule sets. Go to `Irisnet API -> Rules` and click to the `Add New Rule` tab. From here you can add a name (which can later be referenced) and a description. Follow the on screen instructions to setup your rule set for the AI to follow.

Once saved, you are redirected to the list of all rules with name, description and cost (*learn more about cost [here](https://irisnet.de/subscribe/#faq)*). From here you can also `Edit` or `Delete` the listed rules. From the `Add New Rule` tab you can add further rules that can differ from each other, so that you can implement the different rules (by name) for any case that you need.

### Dashboard
The dashboard gives you a quick overview on the currently used licenses and rules, as well as some quick links to related places.

#### Example Usage
The `Example Usage` tab gives you some examples on how to integrate the AI prediction to your WordPress site. Choose the one that best fits your case and then go from there.

#### Documentation
The `Documentation` tab shows you the functionality that is added with this plugin. Use the documented method calls to add the functionality as required.

### Contributing
If you want to contribute to our project or have an idea for improvement leave an improvement issue or contact us on [irisnet.de](https://irisnet.de).