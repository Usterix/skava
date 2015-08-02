Skava
=======================
Skava is something that i made for a couple of reasons, the first was to help with my learning of OOP and the second was to aid in my development of WordPress Themes. Most of the classes here you may find useless but i hope that you may find some of this at least interesting.


Getting Started
===============
To get started using this all you have to do is install this as a plugin and then you can instantly begin using it in your code.




Menu System
===========

- Register Menu location for wordpress
------------------------------------

The below code allows you to register a wordpress menu location. The first argument is the display name of the location and the second argument is the id by which you want to be able to reference and call that location.

~~~php
Skava\Menu::CreateLocation('Display Name', 'location_id');
~~~

- Printing out Menus
------------------
To output a newly created menu into your them using skava you will need to call the static `register()` method inside of the menu class like so.



~~~php
Skava\Menu::register() 
~~~

After that you can chain methods that will pass in the different option you want like so

~~~php
Skava\Menu::register()
		->setThemeLocation('main-menu')
		->render();
~~~
###A list of all the methods is below.

- `setThemeLocation()` Defines theme location to pull from

- `setMenu()` Defines the menu you wish to display

- `setContainer()` Defines the container to use for the menu. it accepts either `<div>` or `<nav>`

- `setContainerClass()` Defines the class to use on the container element

- `setContainerID()` Defines the the ID to use on the container element

- `setMenuClass()` Defines the class that will be applied to the menu `<ul>`

- `setMenuID()` Defines the ID that will be applied to the menu `<ul>`

- `setMenuEcho()` This is a boolean that tells the class whether or not to echo the menu

- `setFallbackCB()` Sets a callback function to use as a callback in case the menu defined is not found.

- `setBefore()` Sets the text to output before the `<a>` tags in the menu.

- `setAfter()` Sets the text to output after the A tags in the menu.

- `setLinkBefore()` Sets the text to output before the link text.

- `setLinkAfter()` Sets the text to output after the link text.

- `setItemsWrap()` Sets the item wraps for the menu items.

- `setDepth()` Sets the depth of the menu.

- `setWalker()` Sets the Custom walker object to use (Note: You must pass an actual object to use, not a string)

- `render()` Renders the menu using the configuration options available above.

Asset Registration
==================
This is most likely gonna be one of the features that you dont find useful but this is a feature for registering and using stylesheets and scripts in your wordpress theme. This is just a wrapper around the already existing WordPress theme registration however i feel like mine looks cleaner.

Below is an example taken straight from the functions file of one of my themes. This code will need to go inside of a function that is then in turn called by `add_action()`

Both the Style and the Script class extend a base Asset class which does some bootstrapping to figure out the theme or stylsheet directory automatically based on whether you're in a child them or not so that you wont have to make multiple calls to `get_theme_directory_uri()` in your code.

~~~php

//StyleSheet
Skava\Style::register()->setName('theme-main-css')->setPath('/assets/css/main.css')->add();

//JS
Skava\Script::register()->setName('theme-main-js')->setPath('/assets/js/main.js')->add();

~~~
I find that the above code works for most instances however below is all of the options that you can pass into this. All but one of the methods applies to both Styles and Scripts i will organize them below.

###Styles & Scripts
- `register()`(required) this is the static method that must be called to instantiate the class for use. you must call this each time however the class will only be instantiated once due to the use of a singleton design pattern and this saves on compile since you only make one instance of the class that all subsequent registrations use.
- `setPath()`(required) This is the method used to set the path to the script or stylesheet. this path is reltive to the theme root or the stylesheet root depending upon whether or not you are using a child theme.
- `setName()`(required) this is the id for the style or script. This must be Unique so you cannot have two CSS or JS files with the same id.
- `setDeps()`(optional) Array of the handles of all the registered scripts that this script depends on, that is the scripts that must be loaded before this script. This parameter is only required when the script with the given $handle has not been already registered. Default handles are all in lower case.
- `setVer()`(optional) String specifying the script version number, if it has one, which is concatenated to the end of the path as a query string. If no version is specified or set to false, then WordPress automatically adds a version number equal to the current version of WordPress you are running. If set to null no version is added. This parameter is used to ensure that the correct version is sent to the client regardless of caching, and so should be included if a version number is available and makes sense for the script.
- `setType()`(optional) This says what type of script/style you're including. There are two possible options. Local and External. Local stylesheets would be those located in the theme file structure such as the style.css. External stylesheets would be those located on other servers that need to be fetched via URL such as Google Fonts. 

####Styles Only
- `setMedia()`(optional) String specifying the media for which this stylesheet has been defined. Examples: 'all', 'screen', 'handheld', 'print'. See this list for the full range of valid CSS-media-types.

####Scripts Only
- `setFooter()`  (optional) Normally, scripts are placed in <head> of the HTML document. If this parameter is true, the script is placed before the </body> end tag. This requires the theme to have the wp_footer() template tag in the appropriate place.
