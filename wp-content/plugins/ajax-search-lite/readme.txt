﻿=== Ajax Search Lite ===
Contributors: wpdreams
Donate link: http://wp-dreams.com
Tags: search, better wordpress search, search plugin, relevance search, widget, Post, ajax search, search filter, wp ajax search, custom fields search, better search, ajax search plugin, wp search, wp search plugin, filter, relevant search plugin, wordpress search, Live Search, shortcode, google, autocomplete, suggest, woocommerce, woocommerce search, product, product search, custom search, ajax, suggest, autosuggest, search autocomplete, live, plugin, sidebar, product tag search, products, woocommerce tag search, WooCommerce Plugin, shop, search by sku, relevant search, highlight, term, image, custom search, ecommerce, Predictive Search, search product, shop, typehead, suggest, instant-search
Requires at least: 3.5
Tested up to: 4.7
Stable tag: 4.7.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A powerful ajax search engine for WordPress. Add a live search form to your site with filters. Custom post types, custom fields, categories supported

== Description ==

Ajax Search Lite - is a live search plugin for WordPress. This responsive live search engine, which will boost your user experience by providing a user friendly ajax powered search form - an ajax live search. You can filter the results with the category and post type filter boxes as well. Google autocomplete and keyword suggestions also included.

Very smooth animations with mobile device support and regular updates. Use Ajax Search Lite as a replacement for the default WordPress search with a better looking, more efficient search engine.
Fine-tune the user experience by providing a powerful ajax search plugin to your visitors. It will rock your site! Supports custom post types and custom fields and more. Boost your site search engine with this custom built live search engine.

**Live Demo**
[http://wp-dreams.com/demo/ajax-search-lite/](http://wp-dreams.com/demo/ajax-search-lite/)

Facebook: https://www.facebook.com/pages/WPDreams/383702515034741

Twitter: https://twitter.com/ernest_marcinko

**Features List:**

* Search in posts and pages
* Search in custom post types
* Search in title, description, excerpt and custom fields
* Custom Filter boxes (checkbox filters) for categories and post types
* WPML and Qtranslate compatible
* 8 built in templates
* Retina ready vectorized SVG and CSS3 icons
* Category and post exclusions
* Frontend search settings boxes
* Images in search results
* Fully ajax powered
* 40+ options on the backend
* Caches images for faster response time
* Performance Options
* Google analytics integration
* Primary and Secondary ordering options
* Highly compatible and responsive

Homepage: [wp-dreams.com](http://wp-dreams.com)

Pro version Demo:  [Ajax Search Pro](http://demo.wp-dreams.com/?product=ajax_search_pro)

**Pro version fetures v4.10.3 (2017.03.15):**

* Frontend Demo: [Ajax Search Pro](http://demo.wp-dreams.com/?product=ajax_search_pro)
* The search now can affect the default WordPress search results
* Search in BuddyPress, BBPress, JigoShop, Woocommerce
* Search in BuddyPress activity feed, users and group names
* Search result grouping by categories or post types
* Responsive design
* Search in custom fields
* Advanced caching technology - image precaching, search phrase caching
* Category selectors on the frontend – It’s now possible to filter the posts by categories
* Post grouping by category or post type!
* Search in comments
* 100+ Themes - Fully configurable and editable - with theme customizer & preview window
* 4 layouts: Vertical, Horizontal, Polaroid and Isotopic (with pagination)
* 400+ Admin options                                                    
* Google keyword suggestions and autocomplete
* Compatibility options and features
* Caching options & Search statistics
* Keyword Highlighting & more...
* Full features list: [Full Features List](http://wp-dreams.com/demo/wp-ajax-search-pro/full-features-list/)

== Installation ==

1. Upload `ajax-search-lite` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the shortcode from the settings into your template or post-page

== Frequently asked questions ==

= After an update, the plugin stopped working, why? =

It's most likely a cache related issue. Make sure to clear all website cache, including page, minify, browser and CDN as well.

= The images are not showing, what is wrong? =

The search parses the first image from the post/page content. Most likely there 
is no image in post.

= When I type in something, the search wheel is spinning, but nothing happens =

It is most likely, that another plugin or the template is throwing errors while the
ajax request is generated. Disabling all the plugins one by one can help you rule out which plugin
is creating the issue.

= I disabled all the plugins but the search wheel is still spinning to infinity, nothing happens =

You should contact me on the support forum with your website url. I will check your website
and will let you know what to do.


== Screenshots ==

1. Ajax Search Lite in action - 2 themes
2. Administrator area - nice and smooth

== Changelog ==

= 4.7.3 =
* Better context finder
* Custom field options updated to ajax, to prevent issues
* Results page orderby and order query variables respect
* WooCommerce results page price filter and ordering respect
* Mobile device related fixes
* Ajax page loading related fixes
* Custom field based filtering optimizations

= 4.7.2 =
* Featured image source size is adjustable
* Shortcode now functions as menu item
* WooCommerce catalog visibility is now respected
* Mobile bugfix: double tap issue
* WPML translation issue fix

= 4.7.1 =
* Default character count to trigger set to 0
* Node.js and Require.js module loading disabled, as not neccessary.
* Curvy themes, background is white, changed to transparent

= 4.7.0 =
* FROM action tag removed
* qtranslateX comppatibility functions
* Override bugfix, where it was enabled even if disabled
* asl_results execution fix, where it was executed two times, instead of one
* more results link override fix, where it redirected only, without override
* New redirection options for Magnifier and Enter events
* Custom redirection URI scheme option
* Polylang string translations support
* asl_custom_fonts filter to access font inclusions
* asl_layout_in_form action to access form
* GET method is now the default for override
* Session is removed, using COOKIES instead, yumm
* asl_active query variable removed for POST requests

= 4.6.6 =
* Scroll script is now possible to turn off
* Better scroll script compatibility and namespace
* Polylang compatibility implemented
* Image width and height issue solved
* Permalinkg name search implemented
* Fixed an issue with string encodings

= 4.6.5 =
* Category exclusions for objects without assigned terms fix
* WooCommerce form override is now possible (if supported)
* Additional init method for redundancy (window.load)
* Init data moved to div attributes instead of content
* Scrollbar updated to latest version
* Font import removed, using wp_enqueue_style() instead

= 4.6.4 =
* Keyword logic option added (OR, AND)
* Checkbox layout changed to flex
* Allow search in all custom fields option
* Settings no longer hide when search is triggered

= 4.6.3 =
* Session related fixes and optimizations
* Bakc-end script fixes

= 4.6.2 =
* Keyword highlighting implemented
* IE11 back-end fixes
* Removed unused and deprecated files 
* W3C style validation related fix

= 4.6.1 =
* Mobile close button fix
* Mobile keyboard behavior fix 
* QtranslateX compatibility fix
* Initialization fix
* Better back-end script loading
* Debug information fixed

= 4.6.0 =
* Core reworked to a much better structure
* Visual Composer bugfix
* Better shortcode stripping algo
* More performant context finder
* imagecache.class.php file removal
* Animations have been replaced with CSS3 animations
* Primary and Secondary ordering implemented
* Placeholder WPML string translation ready
* Private custom fields are displayed on the back-end now
* Option saving returns to the parent tab
* Search box and results override
* Ajax detection initializer
* Javascript sources & initialization switch
* Width and Margin option
* Results position and width fix for low bar widths

= 4.5.5 =
* New menu: Compatibility Options
* Compatibility allowing to force case sensitive, insensitive, UTF8 and UNICODE queries
* Excerpt search fixed
* CSS fixes, including a placeholder fix
* A new escaping method, supporting more characters

= 4.5.4 =
* Autocomplete and Keyword suggestions introduced
* Keyboard navigation fixes
* 3 new curvy styles
* Animation and navigation fixes

= 4.5.1 =
* Scripts are moved to the footer by default
* Inline scripts removed, using JS files for initialization
* Description context option introduced
* A CSS fix for title display
* An image parsing fix

= 4.5 =
* New menus: Performance Options and Support
* JSON responses transformed into HTML
* Input focusing after clicking on close button
* Added an option to control the facet change event
* Custom Ajax Handler implemented
* Image cropping disabled, added an option to control it
* Debug data gathering for more effective support
* Some scrolling issues fixes
* A category and term related bug fixed

= 4.0 =
* Major Query optimizations
* Scrolling calculation and experience fixes
* CSS fixes for older IE browsers
* Input elements changed to flex layout
* Bugs fixed where input would resize to 0 pixels
* Term exclusion is now possible by ID
* Mobile search and type fix
* WooCommerce product variation Title and URL fixes

= 3.11 =
* WPML compatibility fix
* A possible security issue fix

= 3.1 =
* Updated engine with full UTF8 charset support
* Languages like chinese, persian are now searchable
* Language files added

= 3.06 =
* Fixed long label names in frontend settings dropdown
* Title and description substrings at word endings
* Removed an unneccessary CSS rule
* Fixed a bug with custom post type names

= 3.05 =
* Hotfix for disabled categories

= 3.0 =
* Fully reworked from version 1.7
* Added 30+ more options & much nicer options panel
* Brand new themes: Simple, Classic and Underline
* Google analytics integration
* Now possible to search custom post types
* Possible to search custom fields and excerpts
* Possible to exclude categories and posts by ID-s
* Possible to change image sources and set a default image
* Possible to add custom field and category selectors to the frontend

= 1.7 =
* Reworked the admin section
* New template: metro blue

= 1.6 =
* Removed an unnecessary link

= 1.5 =
* Stripping shortcodes from results content

= 1.4 =
* Security fix

= 1.3 =
* 2 brand new themes!
* Very stable custom built javascript
* Stabilised frontend and backend
* All compatibility issues fixed

= 1.2 =
* Search widget added
* Multisite fix

= 1.1 =
* Disappear bugfix
* WordPress 3.5 compatible


== Upgrade notice ==
* Nothing to say here :)


== Plugin website ==

`http://wp-dreams.com`