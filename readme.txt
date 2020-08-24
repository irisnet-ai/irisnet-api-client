=== Irisnet API Client ===
Contributors: irisnet
Tags: ai, artificial intelligence, irisnet, porn blocker, youth protection, AI privacy protection, content moderation, moderation ai, image moderation, nudity blocker
Requires at least: 5.1
Requires PHP: 7.1
Tested up to: 5.5
Stable tag: 1.0.2
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

The Plugin allows your developer to easily add AI functionality, that blocks or blurs unwanted images in real-time. 

== Description ==
The Plugin allows your developer to easily add AI functionality, that blocks or blurs unwanted images in real-time.
This allows you to automatically protect your users from unwanted erotic content and illegal symbols, by interacting with the AI through the irisnet API.

Many sites make use of user generated content and have challenges to provide the necessary youth protection. 
No matter if you have a gallery that your visitors can upload to or if you just want to protect the upload field from your contact form. 
This is where irisnet AI can help you to reduces your manual moderation effort drastically.

All you need to do is install the plugin, configure the rules through the plugin admin panel and add the necessary code to check the uploaded images. 
Use the integrated code examples to find the best solution for your case.
After that all of the user uploaded images can be blocked, if it does not adhere to your configured rules.

== Installation ==
1. You can install this plugin from the WordPress Plugin Directory,
  or manually [download the plugin](https://github.com/irisnet-ai/irisnet-api-client/releases) and upload it through the 'Plugins > Add New' menu in WordPress
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get a [free](https://www.irisnet.de/kasse?add-to-cart=26542) or paid API license key at https://www.irisnet.de/prices
4. From the 'Irisnet Dashboard' click on 'Manage Licenses' in the Licenses pane. From there go to the 'Add New License' tab and enter the license key in the text box. Make sure to turn the 'Active' switch on and save.

== How to Use ==

= Rules =

Rules can be added in order to customize the the AI settings. Depending on your needs you might want to deny user uploads that contain nudity or illegal symbols. 
All this can be configured as one or more rule sets. Go to Irisnet API -> Rules and click to the Add New Rule tab. From here you can add a name (which can later be referenced) and a description. 
Follow the on screen instructions to setup your rule set for the AI to follow.

Once saved, you are redirected to the list of all rules with name, description and cost (learn more about cost here). From here you can also Edit or Delete the listed rules. 
From the Add New Rule tab you can add further rules that can differ from each other, so that you can implement the different rules (by name) for any case that you need.

= Dashboard =

The dashboard gives you a quick overview on the currently used licenses and rules, as well as some quick links to related places.

= Example Usage =

The Example Usage tab gives you some examples on how to integrate the AI prediction to your WordPress site. Choose the one that best fits your case and then go from there.

= Documentation =

The Documentation tab shows you the functionality that is added with this plugin. Use the documented method calls to add the functionality as required.

== Frequently asked questions ==

= To whom is the offer addressed? =

Our services are initially aimed at all those service providers on the Internet, that want to protect themselves from warnings and who want to keep their platform clean from unwanted content or to encourage their users to design their content in accordance with the rules of the platform. 

= How does it work? =

We provide our customers with an API, with which control parameters can be sent and then media can be uploaded to have them checked for the previously sent control parameters. 
The result follows in real time and transmitted in XML or JSON format (your choice). If desired, a greyed out image can also be downloaded from the AI. See our documentation for detailed information. 

= Are uploaded images saved on the server? =

The images uploaded by the customer are not saved permanently. However, these must be temporarily available during analysis by the artificial intelligence. 
However, the uploaded files are always session-bound and will be permanently deleted at the latest after the session has ended. In addition, a session is automatically ended after 30 minutes of inactivity by the customer. 

== Screenshots ==

1. Irisnet Dashboard
2. Example Usages
3. Rules
4. Licenses

== Upgrade Notice ==

= 1.0 =
First official release of the Irisnet API Client for WordPress

== Changelog ==

= 1.0.1 =
Initial release.
