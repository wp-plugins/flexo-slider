=== Flexo Slider===

Plugin Name: flexo-slider
Contributors: flexostudio
Tags:gallery, slider, pics, images, NextGen
Author: Grigor Grigorov, Mariela Stefanova, Flexo Studio Team
Plugin URI: http://www.flexostudio.com/flexo-slider.html
Description:
Version: 1.0011
Stable tag:1.0011
Requires at least:3.0.5
Tested up to: 4.0.1


NextGen gallery as a slider

== Description ==

This plugin displays the pictures from the selected NextGen gallery as a slider. 
There is an option to insert the content into  desired post or by display function 
to put the  slider to the  chosen location in your site

There is admin panel, which allows you to set the slider option as you wish 
- the effect, speed, size, etc. See at  Screenshots .
You can see demo in the header of homepage in our website
http://www.flexostudio.com/flexo-slider.html
the following plugins are required: NextGen Gallery

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

== Changelog ==
= v.1.0010 =

*    Fix Bugs.

= v.1.0009 =

*    NEW Option - "Display Picture Description" -  show the description from Next Gen Gallery.
*    NEW Option - Display Picture from more then one gallery. If you want to view pictures from some galleries, write them separated by commas.
*    Fix Bug with random display of picture.
