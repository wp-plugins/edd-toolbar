=== Easy Digital Downloads Toolbar ===
Contributors: daveshine, deckerweb
Donate link: http://genesisthemes.de/en/donate/
Tags: toolbar, adminbar, admin bar, easy digital downloads, digital downloads, downloads, e-downloads, administration, resources, links, deckerweb, ddwtoolbar
Requires at least: 3.3
Tested up to: 3.4-beta3
Stable tag: 1.1

This plugin adds useful admin links and resources for the Easy Digital Downloads plugin to the WordPress Toolbar / Admin Bar.

== Description ==

= Have Quicker Access to Your Digital Downloads - Time Saver! =
This **small and lightweight plugin extension** just adds a lot [Easy Digital Downloads](http://wordpress.org/extend/plugins/easy-digital-downloads/) plugin related resources to your toolbar / admin bar. Also links to all setting/ tab pages of the plugin are added making life administrators a lot easier. So you might just switch from the fontend of your site to 'Payment History' or to the 'Add new Download' page etc.

= General Features =
* Free Extension for ["Easy Digital Downloads"](http://wordpress.org/extend/plugins/easy-digital-downloads/) - all plugin settings are hooked in!
* Access your stuff from one place in the toolbar on backend and frontend, without much scrolling... in other words: manage your digital downloads even more easily :-)
* Plugin options under "Misc" settings in "Easy Digital Downloads": you can deactivate the Resources links group. (since v1.1)
* Alternate main Icon with 11 additional colored/alternate icons included :) (changeable via filters)
* Plus 4 filters included to change wording/tooltip and icon of the main item - for more info [see FAQ section here](http://wordpress.org/extend/plugins/edd-toolbar/faq/)
* For custom "branding" or special needs a few sections like the "Resource links group" could be hidden from displaying via your active theme/child theme - for more info [see FAQ section here](http://wordpress.org/extend/plugins/edd-toolbar/faq/)
* Supporting all official *Easy Digital Downloads* sites, so just the whole ecosystem for this plugin :)
* Fully internationalized! Real-life tested and developed with international users in mind!
* Fully WPML compatible!
* Fully Multisite compatible, you can also network-enable it if ever needed (per site use is recommended).
* Tested with WordPress versions 3.3.1, 3.3.2 and 3.4-beta1-3 - also in debug mode (no stuff there, ok? :)
* Link to downloadable German language packs - only displayed when German locales are active (de_DE, de_AT, de_CH, de_LU)
* *NOTE:* I would be happy to add more language/locale specific resources and more useful third-party links - just contact me!

As the name suggests this plugin is **intended towards webmasters and administrators**. The new toolbar / admin bar entries will only be displayed if the current user has the WordPress cabability of `edit_posts`. (Note: I am open for suggestions here if this should maybe changed to a more suitable capability.)

= Localization =
* English (default) - always included
* German - always included
* .pot file (`edd-toolbar.pot`) for translators is also always included :)
* *Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)*

[A plugin from deckerweb.de and GenesisThemes](http://genesisthemes.de/en/)

= Feedback =
* I am open for your suggestions and feedback - Thank you for using or trying out one of my plugins!
* Drop me a line [@deckerweb](http://twitter.com/#!/deckerweb) on Twitter
* Follow me on [my Facebook page](http://www.facebook.com/deckerweb.service)
* Or follow me on [+David Decker](http://deckerweb.de/gplus) on Google Plus ;-)

= More =
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/users/daveshine/)
* Tip: [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)

== Installation ==

1. Upload the entire `edd-toolbar` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Look at your toolbar / admin bar and enjoy using the new links there :)
4. Go and manage your digital downloads even more easily :)

**Note:** It's not required to also have the "Easy Digital Downloads" plugin installed but without it this toolbar plugin makes absolutely no sense! -- I recommend to use my plugin with ["Easy Digital Downloads"](http://wordpress.org/extend/plugins/easy-digital-downloads/) v1.0.1.1 or higher.

**Own translation/wording:** For custom and update-secure language files please upload them to `/wp-content/languages/edd-toolbar/` (just create this folder) - This enables you to use fully custom translations that won't be overridden on plugin updates. Also, complete custom English wording is possible with that, just use a language file like `edd-toolbar-en_US.mo/.po` to achieve that (for creating one see the tools on "Other Notes").

== Frequently Asked Questions ==

= Does this plugin work with the latest WP version and also older versions? =
Yes, this plugin works really fine with the latest WordPress 3.3+ including latest 3.4-beta!
And sorry, it DOES NOT work with older WordPress versions so please update your install if you haven't done yet :).

= How are new resources being added to the admin bar? =
Just drop me [@deckerweb](http://twitter.com/deckerweb) or Pippin Williamson [@pippinsplugins](http://twitter.com/pippinsplugins) a note via Twitter or via our contact pages and we'll add the link if it is useful for admins/ webmasters and the Easy Digital Downloads plugin ecosystem.

= Is this plugin Multisite compatible? =
Yes, it is! :) Works really fine in Multisite invironment - here I just recommend to activate on a per site basis so to load things only where and when needed.

= In Multisite, could I "network enable" this plugin? =
Yes, you could. -- However, it doesn't make much sense. The plugin is intented for a per site use as the admin links refer to the special settings for that certain site/blog. So if you have a Multisite install with 5 sites but only 3 would run "Easy Digital Downloads" then the other 2 sites will only see support links in the Toolbar / Admin Bar... I guess, you got it? :)

Though intended for a per site use it could make some sense in such an edge case: if all of the sites in Multisite use Easy Digital Downloads. This might be the case if you use Multisite for multilingual projects, especially via that awesome plugin: http://wordpress.org/extend/plugins/multilingual-press/

= Why is there no admin settings page to this plugin? =
This plugin has NO settings page because I believe it's just not neccessarry. All customizing could be done via filters, constants and regular WordPress user roles & capabilities. As the plugin is indended for a admin/ webmaster use that's the way to go. This way we can save the overhaul of an options panel/settings page, additional database storing & requests, uninstall routines and such. End result: a lightweight system that just works and saves clicks & time :-).

= Can certain sections be removed? =
Yes, this is possible! You can remove the following sections: "Resources link group" at the bottom (all items), "German language stuff" (all items) and "Translations resources" (all items)

To achieve this add one, some or all of the following constants to your current theme's/child theme's `functions.php` or similar file:
`
/** Easy Digital Downloads Toolbar: Remove Resource Items */
define( 'EDDTB_RESOURCES_DISPLAY', FALSE );

/** Easy Digital Downloads Toolbar: Remove German Language Items */
define( 'EDDTB_DE_DISPLAY', FALSE );

/** Easy Digital Downloads Toolbar: Remove Translations Items */
define( 'EDDTB_TRANSLATIONS_DISPLAY', FALSE );
`

= Can the the whole toolbar entry be removed, especially for certain users? =
Yes, that's also possible! This could be useful if your site has special user roles/capabilities or other settings that are beyond the default WordPress stuff etc. For example: if you want to disable the display of any "Easy Digital Downloads Toolbar" items for all user roles of "Editor" please use this code:
`
/** Easy Digital Downloads Toolbar: Remove all items for "Editor" user role */
if ( current_user_can( 'editor' ) ) {
	define( 'EDDTB_DISPLAY', FALSE );
}
`

To hide only from the user with a user ID of "2":
`
/** Easy Digital Downloads Toolbar: Remove all items for user ID 2 */
if ( 2 == get_current_user_id() ) {
	define( 'EDDTB_DISPLAY', FALSE );
}
`

To hide items only in frontend use this code:
`
/** Easy Digital Downloads Toolbar: Remove all items from frontend */
if ( ! is_admin() ) {
	define( 'EDDTB_DISPLAY', FALSE );
}
`

In general, use this constant do hide any "Easy Digital Downloads Toolbar" items:
`
/** Easy Digital Downloads Toolbar: Remove all items */
define( 'EDDTB_DISPLAY', FALSE );
`

= Available Filters to Customize More Stuff =
All filters are listed with the filter name in bold and the below additional info, helper functions (if available) as well as usage examples.

**eddtb_filter_capability_all**

* Default value: `edit_theme_options`
* 4 Predefined helper functions:
 * `__eddtb_admin_only` -- returns `'administrator'` role -- usage:
`
add_filter( 'eddtb_filter_capability_all', '__eddtb_admin_only' );
`
 * `__eddtb_role_editor` -- returns `'editor'` role -- usage:
`
add_filter( 'eddtb_filter_capability_all', '__eddtb_role_editor' );
`
 * `__eddtb_cap_manage_options` -- returns `'manage_options'` capability -- usage:
`
add_filter( 'eddtb_filter_capability_all', '__eddtb_cap_manage_options' );
`
 * `__eddtb_cap_edit_theme_options` -- returns `'edit_theme_options'` capability -- usage:
`
add_filter( 'eddtb_filter_capability_all', '__eddtb_cap_edit_theme_options' );
`
 * `__eddtb_cap_install_plugins` -- returns `'install_plugins'` capability -- usage:
`
add_filter( 'eddtb_filter_capability_all', '__eddtb_cap_install_plugins' );
`
* Another example:
`
add_filter( 'eddtb_filter_capability_all', 'custom_eddtb_capability_all' );
/**
 * Easy Digital Downloads Toolbar: Change Main Capability
 */
function custom_eddtb_capability_all() {
	return 'activate_plugins';
}
`
--> Changes the capability to `activate_plugins`

**eddtb_filter_main_icon**

* Default value: Easy Digital Downloads default logo graphic like in its official website
* 11 Predefined helper functions for the 11 included colored/alternate icons, returning special colored icon values - the helper function always has this name: `__eddtb_colornamehere_icon()` this results in the following filters ready for usage:
`
add_filter( 'eddtb_filter_main_icon', '__eddtb_blue_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_brown_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_gray_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_green_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_khaki_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_orange_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_pink_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_red_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_turquoise_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_yellow_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_alternate_icon' );

add_filter( 'eddtb_filter_main_icon', '__eddtb_theme_images_icon' );
`
--> Where the 2nd to last "alternate" icon returns the same icon as in the left-hand EDD menu!

--> Where the last helper function returns the icon file (`icon-eddtb.png`) found in your current theme's/child theme's `images` subfolder

* Example for using with current theme/child theme:
`
add_filter( 'eddtb_filter_main_icon', 'custom_eddtb_main_icon' );
/**
 * Easy Digital Downloads Toolbar: Change Main Icon
 */
function custom_eddtb_main_icon() {
	return get_stylesheet_directory_uri() . '/images/custom-icon.png';
}
`
--> Uses a custom image from your active child theme's `/images/` folder
--> Recommended dimensions are 16px x 16px

**eddtb_filter_main_icon_display**

* Returning the CSS class for the main item icon
* Default value: `icon-edd` (class is: `.icon-edd`)
* 1 Predefined helper function:
 * `__eddtb_no_icon_display()` -- usage:
`
add_filter( 'eddtb_filter_main_icon_display', '__eddtb_no_icon_display' );
`
 * This way you can REMOVE the icon!
* Another example:
`
add_filter( 'eddtb_filter_main_icon_display', 'custom_eddtb_main_icon_display_class' );
/**
 * Easy Digital Downloads Toolbar: Change Main Icon CSS Class
 */
function custom_eddtb_main_icon_display_class() {
	return 'your-custom-icon-class';
}
`
--> You then have to define CSS rules in your `custom.css` file or your child theme/skin stylesheet for your own custom class `.your-custom-icon-class`

**eddtb_filter_main_item**

* Default value: "Downloads"
* Example code for your `functions.php` file or similar file:
`
add_filter( 'eddtb_filter_main_item', 'custom_eddtb_main_item' );
/**
 * Easy Digital Downloads Toolbar: Change Main Item Name
 */
function custom_eddtb_main_item() {
	return __( 'Your custom main item', 'your-theme-textdomain' );
}
`

**eddtb_filter_main_item_tooltip**

* Default value: "Easy Digital Downloads"
* Example code for your `functions.php` file or similar file:
`
add_filter( 'eddtb_filter_main_item_tooltip', 'custom_eddtb_main_item_tooltip' );
/**
 * Easy Digital Downloads Toolbar: Change Main Item Name's Tooltip
 */
function custom_eddtb_main_item_tooltip() {
	return __( 'Your custom main item tooltip', 'your-theme-textdomain' );
}
`

**eddtb_filter_edd_name**

* Default value: "EDD"
* Used for some items within toolbar links to enable proper branding
* Change things like in the other examples/principles shown above

**eddtb_filter_edd_name_tooltip**

* Default value: "Easy Digital Downloads"
* Used for some items within toolbar links to enable proper branding
* Change things like in the other examples/principles shown above

**Final note:** If you don't like to add your customizations to your `functions.php` file or similar file of theme/child theme/skin you can also add them to a functionality plugin or an mu-plugin. This way you can also use this better for Multisite environments. In general you are then more independent from theme/child theme changes etc.

All the custom & branding stuff code above can also be found as a Gist on GitHub: https://gist.github.com/2392882 (you can also add your questions/ feedback there :)

== Screenshots ==

1. Easy Digital Downloads Toolbar in action - primary level (running with WordPress 3.3+ here)
2. Easy Digital Downloads Toolbar in action - a second level - add new download (running with WordPress 3.3+ here)
3. Easy Digital Downloads Toolbar in action - a second level - settings: payment gateways (running with WordPress 3.3+ here)
4. Easy Digital Downloads Toolbar in action - a third level - resources: support forums (running with WordPress 3.3+ here)
5. Easy Digital Downloads Toolbar in action - a third level - resources: documentation (running with WordPress 3.3+ here)
6. Easy Digital Downloads Toolbar in action - a secondary level - resources: plugin headquarters & stuff (running with WordPress 3.3+ here)
7. Easy Digital Downloads Toolbar in action - language specific links at the bottom - for German locales (running with WordPress 3.3+ here)
8. Easy Digital Downloads Toolbar in action - additional plugin settings under "Misc" in EDD settings - new option since plugin version 1.1+

== Changelog ==

= 1.1 (2012-04-22) =
* NEW: Added two options to the "Easy Digital Downloads > Settings > Misc" page: to easily remove the Resources & Languages/Translations resources items from the toolbar menu per checkbox option.
* NEW: Added link to "Downloads Archives" on frontend like: `http://yoursite.com/downloads/` to get quick access to your downlods listing. Note, also supports user-defined slug via `EDD_SLUG` constant (since EDD v1.0.3)!
* NEW: Added "Translations" sub-forum link to resources.
* NEW: Added more Documentation and Developer API resource links.
* NEW: Added link to free extensions in the official plugin repository.
* UPDATE: Restructured Support & Documentation resource links a bit for easier access.
* UPDATE: Minor code & documentation tweaks and improvements.
* UPDATE: Updated two existing screenshots and added one new (plugin settings).
* UPDATE: Updated/corrected readme.txt file.
* UPDATE: Updated German translations and also the .pot file for all translators!
* NEW: Added banner image on WordPress.org for better plugin branding :)

= 1.0 (2012-04-15) =
* Initial release

== Upgrade Notice ==

= 1.1 =
Several changes & improvements: Added plugin options to "Misc" settings in EDD. Added more resource links, and restructered some. Updated documentation, screenshots, readme as well as .pot plus German translations.

= 1.0 =
Just released into the wild.

== Translations ==

* English - default, always included
* German: Deutsch - immer dabei! [Download auch via deckerweb.de](http://deckerweb.de/material/sprachdateien/easy-digital-downloads-plugin/#edd-toolbar)
* For custom and update-secure language files please upload them to `/wp-content/languages/edd-toolbar/` (just create this folder) - This enables you to use fully custom translations that won't be overridden on plugin updates. Also, complete custom English wording is possible with that, just use a language file like `edd-toolbar-en_US.mo/.po` to achieve that (for creating one see the following tools).

*Note:* All my plugins are internationalized/ translateable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the awesome ["Codestyling Localization" plugin](http://wordpress.org/extend/plugins/codestyling-localization/) and for validating the ["Poedit Editor"](http://www.poedit.net/), which works fine on Windows, Mac and Linux.

== Additional Info ==
**Idea Behind / Philosophy:** Just a little leightweight plugin for all the Easy Digital Downloads plugin users out there to make their daily web admin life a bit easier. I'll try to add some plugin/extension support if it makes some sense in the future. So stay tuned :).

== Credits ==
**I owe huge thanks to Pippin Williamson from *PippinsPlugins.com* who had the original idea for this plugin.** He was absolutely helpful and supportive when creating this plugin. Just check out his awesome stuff and support his great work for WordPress!
