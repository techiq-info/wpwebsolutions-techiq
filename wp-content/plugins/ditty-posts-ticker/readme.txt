=== Ditty Posts Ticker ===
Contributors: metaphorcreations
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FUZKZGAJSBAE6
Tags: ticker, posts, posts ticker, rotator, data rotator, lists, data
Requires at least: 4.0
Tested up to: 4.5.2
Stable tag: /trunk/
License: GPL2

Ditty Posts Ticker is a multi-functional posts display plugin.

== Description ==

Ditty Posts Ticker is a multi-functional posts display plugin. Easily add any posts to your site either through shortcodes, direct functions, or in a custom Ditty News Ticker Widget.

#### There are 3 default ticker modes

* **Scroll Mode** - Scroll the ticker data left, right, up or down
* **Rotate Mode** - Rotate through the ticker data
* **List Mode** - Display your ticker data in a list

[**View samples of each mode.**](http://dittynewsticker.com/ditty-posts-ticker/)

== Installation ==

1. Upload `ditty-posts-ticker` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create tickers by going to **News Tickers > Add New**
4. Insert your tickers by copying and pasting the provided shortcode into another post.
5. Optionally, insert your tickers by copying and pasting the direct function code directly into your theme or plugin.

[**View full help documentation.**](http://dittynewsticker.com/mc/ditty-posts-ticker-doc/)

== Frequently Asked Questions ==

= Are there any settings I need to configure? =

Each individual Ticker post has multiple settings to customize.

[**View full help documentation.**](http://dittynewsticker.com/mc/ditty-posts-ticker-doc/)

== Screenshots ==

== Changelog ==

= 2.1.0 =
* Added EDD Licensing & auto-updating
* Removed TGM Plugin Activation
* Added Meta Query args to the Advanced Args section

= 2.0.6 =
* Created custom query var to query posts

= 2.0.5 =
* Set TGM Plugin Activation to load after theme_setup to account for outdated versions loaded in themes

= 2.0.4 =
* Small change to how WP_Query is called to get posts

= 2.0.3 =
* Added custom field parameters to Query args options
* Added wp_query filter "mtphr_dnt_posts_query_args"

= 2.0.2 =
* Added pagination query parameters to advanced query settings

= 2.0.1 =
* Added ability to convert custom fields into links

= 2.0.0 =
* Added TGM Plugin Activation
* Added custom field integration
* Updated metabox for new admin page layout
* Updated plugin update checker
* Updated default post display template
* Updated wp_query parsing

= 1.1.3 =
* Modified wp_query code to fix bug in specific scenarios

= 1.1.2 =
* mtphr_dnt_types filter now used on front and back end

= 1.1.1 =
* Added default settings for Post arrangement
* Stripped shortcodes from excerpts

= 1.1.0 =
* Added post display templates for easier customization in themes
* Added check for 'ditty_posts_ticker_templates' theme support
* Added Hebrew language files

= 1.0.15 =
* Resolved issue with post titles and WPML

= 1.0.14 =
* Added Italian translation

= 1.0.13 =
* Added post id css class to each post
* Added taxonomy term css classes to each post

= 1.0.12 =
* Modified to allow for custom excerpts

= 1.0.11 =
* Fixed bug when trying to use post format filter without having the "advanced args" enabled

= 1.0.10 =
* Modified excerpt length code for longer excerpts

= 1.0.9 =
* Modified excerpt more field to allow for html
* Removed remnants of post paging variables

= 1.0.8 =
* Fixed class output of post ticks contents

= 1.0.7 =
* Updated metabox code & display
* Add post format option
* Removed pagination as that is now included within the list mode settings
* Auto update of old pagination settings to list mode settings
* Remove old navigation/pagination rendering code
* Updated Ditty News Ticker check for Multi-site

= 1.0.6 =
* Added custom plugin activation for Ditty News Ticker.
* Added class to read more link.

= 1.0.5 =
* Converted to new auto-updater.
* Fixed localization script.

= 1.0.4 =
* Modified filters.
* Set default post limit to -1.

= 1.0.2 =
* Fixed issue with displaying shortcodes with 'Post content'.
* Added 'Link to post' option for excerpts.
* Added 'Excerpt more' option for excerpts.
* Changed 'Advanced args' toggle to 'Advanced options'.
* Moved the 'Paged list' options down to the bottom under 'Advanced options'.

= 1.0.1 =
* Added 'languages' folder for localization.
* Added 'Full Size' option for post thumbnails.
* Added 'Post content' option in the 'Post arrangement' field.
* Added 'Link to post' option for title and thumbnail.
* Added filters for all post assets.
* Added filter for post tick.

= 1.0.0 =
* Initial upload of Ditty Posts Ticker.

== Upgrade Notice ==

Added EDD Licensing & auto-updating & removed TGM Plugin activation