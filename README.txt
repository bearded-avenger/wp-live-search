=== WP Live Search ===
Contributors: nphaskins
Author URI: http://nickhaskins.com
Plugin URI: http://nickhaskins.com/wpls
Tags: search, live search
Requires at least: 3.5.1
Tested up to: 4.2.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A super light-weight live search plugin that utilizes the WP REST API.

== Description ==

WP Live Search (beta) is a search plugin for WordPress that returns results as the user types for what they are looking. It currently supports posts, pages, post types, including multiple post types, and design modes.  

This is very much a working prototype, so please log any issues you find on the Github repo below.  
[https://github.com/bearded-avenger/wp-live-search](https://github.com/bearded-avenger/wp-live-search)  

Here's some documentation.  
[http://bearded-avenger.github.io/wp-live-search/](http://bearded-avenger.github.io/wp-live-search/)  

Add the shortcode `[wp_live_search]` to a page or something. There's a few shortcode attributes that you can use, and are as follows:  

type=""  
Your choices are `posts` or `pages`. Defaults to `posts`. You can also pass `type,type` to search multiple post types. For example type="recipes,books"

multi=""  
By default this is turned off. Set this to true only if you're using multiple post types above.

placeholder=""  
The text displayed in the input. Defaults to `Search...`.

number=""  
Total search result to return. Default is 20

excerpt="true"  
Show the excerpt along with the title and featured image (if set)

compact="true"  
Makes a tiny WP Live Search for use in header widgets and such

dropdown="true"  
Display search results as a drop-down instead of pushing down the content around it

results=""  
The text displayed for the results. Defaults to `entries found`.

results_style="inside"  
Displays the "entries found" inside of the input area, useful for using in areas like header widgets where space is minimal.

target=""  
An optional target UL parent to send the search results to. Example `target="#someotherdiv"`.

---

Here are a couple examples:

Default Usage:  
`[wp_live_search]`

Use in Header Widget:  
`[wp_live_search compact="true" dropdown="true" results="found" results_style="inside"]`

Search through multiple post types:  
`[wp_live_search multi="true" type="posts,page"]`

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

= How do I work it? =
It's a shortcode. Add [wp_live_search] to a page. See above for some options.

= What is required for this to work? =
The WP REST API (V1) plugin (the official one) from the WordPress REST API Team.

= Does it support featured images? =
Yes

= Does it support showing content? =
Yes

= Does it support custom post types? =
Yes

= Can I use multiple on one page? =
No

= Can I disable the style sheet from loading? =
Yes just use `define('WPLS_DISABLE_STYLE', true)` and the CSS file will not load. However you will want to make sure you at least copy over .wpls--show and .wpls--hide. JS uses these classes for things and the search may not appear correctly without them.

= Can I override the display item? =
Yep! Just copy over the function from underscore-template.php (without the function exists) and drop it into any plugin. Note, pluggable functions wont run in a theme file, themes run too late, so this needs to be in a plugin file. From here you can modify the temlate as needed.

== Screenshots ==

1. basic design
2. compact mode

== Changelog ==

= 0.8 =
* added "dropdown" option mode for use in small spaces
* added "results_style" option for use in small spaces
* added "excerpt" option to show excerpt
* added five action hooks

= 0.7.1 =
* fixed target="" feature only receiving one search result

= 0.7 =
* fixed results being returned in reverse order
* added multiple post type support by using type="typeone,typetwo" multi="true"
* added an option to set the number of results returned
* added a "compact" mode option to that it can be used in places like a header widget
* improved styling

= 0.6 =
* added custom post type support

= 0.5 =
* added an option to specify a target div for the search results to be sent to
* replaced all inline js styles with CSS classes

= 0.4.1 =
* removed the search being closed when you click out
* added an icon that will clear the search

= 0.4 =
* dont allow empty values and spaces for search
* allow enter to search so long as nothing is empty
* added a template function
* added searchAction schema
* misc style improvements
* added a define to allow CSS file not be loaded
* returns 20 results for now until we work in pagination/lazy loading

= 0.3 =
* featured image support
* renamed to WP Live Search

= 0.2 =
* added some styles
* added a loading indicator
* added option to set entries text
* misc fixes



