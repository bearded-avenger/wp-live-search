=== WP Live Search ===
Contributors: nphaskins
Author URI: http://nickhaskins.com
Plugin URI: http://nickhaskins.com/wpls
Tags: search, live search
Requires at least: 3.5.1
Tested up to: 4.2.1
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A super light-weight live search plugin that utilizes the WP REST API.

== Description ==

WP Live Search is a search plugin for WordPress that returns results as the user types for what they are looking. It currently supports posts with plans to expand to post types.

This is very much a working prototype, so please log any issues you find on the Github repo below.

[https://github.com/bearded-avenger/wp-live-search](https://github.com/bearded-avenger/wp-live-search)

== Installation ==

1. Navigate to 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `wp-live-search.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `aesop-core.zip`
2. Extract the `wp-live-search` directory to your computer
3. Upload the `wp-live-search` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

== Frequently Asked Questions ==

= What is required for this to work? =
The WP REST API plugin (the official one) from the WordPress REST API Team.

= Does it support featured images? =
In progress.

= Does it support showing content? =
In progress.

= How do I work it? =
It's a shortcode. Add [wp_search] to a page. Working on template functions for themers.

== Screenshots ==


== Changelog ==

= 0.3 =
* featured image support
* renamed to WP Live Search

= 0.2 =
* added some styles
* added a loading indicator
* added option to set entries text
* misc fixes



