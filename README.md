Lelesys.Plugin.Forum
====================

This plugin adds forum to your TYPO3 Neos based websites. You can create categorised forums to have posts in it. Each post can have many replies or even replies to replies.

##### This package is an offshoot version from a big project where a special forum was built. We will work hard to add more features in this. Stay tuned!

Quick start
-----------
* Change directory to your Neos installation root directory

* Install package via composer

```
composer require lelesys/plugin-forum:1.0.*@alpha
```

* Run Flow migrations

```
./flow doctrine:migrate
```

* include the plugin's Stylesheet to your own one's where you add other stylesheets of the site.

```
<link rel="stylesheet" href="{f:uri.resource(path: 'Styles/Forum.css', package: 'Lelesys.Plugin.Forum')}" media="all" />
```
* include the plugin's Javascripts to your own one's where you add other javascripts of the site.

```
<script src="{f:uri.resource(package:'Lelesys.Plugin.Forum', path: 'JavaScript/jquery.validate.min.js')}"></script>
<script src="{f:uri.resource(package:'Lelesys.Plugin.Forum', path: 'JavaScript/forum.js')}"></script>
```
* Add following in top level Configuration/Routes.yaml just after the TYPO3 Neos route for captcha to work.
```
-
  name: 'Flow'
  uriPattern: '<FlowSubroutes>'
  defaults:
    '@format': 'html'
  subRoutes:
    FlowSubroutes:
      package: TYPO3.Flow

```
Usage
-----

* Create a page called as Forum in your website tree.
* Create a child document node of type Forum Category (e.g. TYPO3) under the Forum page.
* Create a child document node of type Forum (e.g. Neos) under the TYPO3 category.
* Add content node of type (Forums) in the content area of the Forum page.
* Categories will be listed on the Forum page and then you can navigate to each individual forum and make posts.