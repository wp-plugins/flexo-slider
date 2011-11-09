=== flexoslider===

Plugin Name: flexoslider
Contributors: flexostudio
Tags:gallery, slider, pics, images
Author: Grigor Grigorov, Mariela Stefanova, Flexo Studio Team
Plugin URI: http://www.flexostudio.com/wordpress-plugins-flexo-utils.html
Description:
Version: 1.0006 
Stable tag:1.0006
Requires at least:3.0.5
Tested up to: 3.0.5


NextGen gallery as a slider

== Description ==

This plugin displays the pictures from the selected NextGen gallery as a slider. 
There is an option to insert the content into  desired post or by display function 
to put the  slider to the  chosen location in your site

There is admin panel, which allows you to set the slider option as you wish 
- the effect, speed, size, etc. See at  Screenshots .

== Installation ==

1.	Download.
2.	Unzip.
3.	Upload to the plugins directory.
4.	Activate the plugin.
5.	Have a nice work.

== How to use ==


1. Generate a code with the desired settings in the admin panel, 
you must copy and paste the code in the desired location in the content of the post see Screenshots.


2. Generate a code with the desired settings in the admin panel, you must copy the code and assign it 
to  a variable which with to call the filter function

Example: insert the code to the chosen location in to the page code
$cont=" [flexoslider  GalleryID='1' effect='random' animSpeed='1000' pauseTime='1000' width='930' height='260' img_link ='true' img_title ='true' img_nav ='false' max_br ='2' order ='random' pause ='false' nav_arrow ='true']";
echo flexoslider::filter($cont);  ?>

== Screenshots ==

1. screenshot-1.jpeg
2. screenshot-2.jpeg