=== Finance Calculator ===
Contributors: butterflymedia
Tags: finance, calculator, loans, ppp, payment protection, repayments, mortgage
Requires at least: 5.0
Tested up to: 5.7
Stable tag: 2.1.7
Requires PHP: 7.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

**Note:** Upgrading from `1.x` to `2.x` will automatically deactivate the plugin. Head over to your **Plugins** section and reactivate it.

Finance Calculator is a drop-in form for users to calculate indicative repayments. It can be implemented on a page or a post. It contains a real-time AJAX calculation option, which degrades gracefully on older browsers and uses a button to calculate repayments.

The plugin also contains an application form which sends a message to a specified email address.

The calculator features payment protection, and 12 to 60 months calculation.

The plugin can be used for car purchases or payments, real estate and big loans calculations.

Check the [official homepage](https://getbutterfly.com/wordpress-plugins/ "getButterfly") for feedback and support.

== Installation ==

1. Upload to your plugins folder, usually `wp-content/plugins/`
2. Activate the plugin on the plugin screen.
3. Configure the plugin.

== Frequently Asked Questions ==

= How do I add the form to a post or page? =

You need to add the `[finance_calculator]` or the `[loan_calculator]` shortcode to the body of the post/page.

== Screenshots ==

1. Front-end form
2. Front-end form
3. Shortcodes
3. Plugin settings

== Changelog ==

= 2.1.7 =
* FIX: Fixed PHP 8 issue with string to array conversion
* FIX: Fixed issue with duplicate field
* UPDATE: Updated PHP requirements
* UPDATE: Updated WordPress compatibility
* UPDATE: Added block editor form preset (columns)

= 2.1.6 =
* UPDATE: Updated form structure
* UPDATE: Updated dashboard/settings UI
* UPDATE: Removed dashboard/settings CSS
* UPDATE: Started form refactoring by using arrays

= 2.1.5 =
* FEATURE: Added 72 month period
* UPDATE: Updated WordPress compatibility

= 2.1.4 =
* UPDATE: Updated PHP requirements
* UPDATE: Updated WordPress compatibility

= 2.1.3 =
* UPDATE: Removed Google+ integration
* UPDATE: Updated PHP requirements
* UPDATE: Updated WordPress compatibility

= 2.1.2 =
* UPDATE: Removed hardcoded styling (allow theme to style form fields)
* UPDATE: Removed getButterfly logo
* UPDATE: Removed empty folder

= 2.1.1 =
* UPDATE: Updated WordPress compatibility

= 2.1.0 =
* FIX: Fixed date of birth year going forward to 2000 only
* FIX: Fixed several fields maxlength
* UPDATE: Added bank sort code field
* UPDATE: Added time with bank field

= 2.0.2 =
* FIX: Fixed wrong function name (admin style assets)

= 2.0.1 =
* FIX: Fixed copyright name
* FIX: Fixed wrong version number
* UPDATE: Updated JavaScript file name

= 2.0.0 =
* FIX: Added missing option init
* UPDATE: Updated plugin name for internationalization
* UPDATE: Updated screenshots
* UPDATE: UI tweaks
* UPDATE: Added finance application option (show/hide)
* UPDATE: Added basic form styling (optional)
* SECURITY: Better server security

= 1.7.2 =
* UPDATE: Updated settings panel

= 1.7.1 =
* FIX: Removed hardcoded calculator description
* FIX: Removed an eval() expression
* UPDATE: Updated readme.txt
* UPDATE: Removed author credit (it's not good practice)

= 1.7 =
* UPDATE: Compatibility/authorship update

= 1.6.3 =
* UPDATE: Removed old donation link
* UPDATE: Updated WordPress compatibility

= 1.6.2 =
* UPDATE: Allowed decimals for finance rates

= 1.6.1 =
* UPDATE: Updated old links
* UPDATE: Updated license

= 1.6.0 =
* FIX: Removed unused/broken function to change mail sender
* FIX: Removed textdomain loading as per WordPress 4.6+ specifications

= 1.5.7 =
* UPDATE: Updated WordPress compatibility
* UPDATE: Updated author links

= 1.5.6 =
* UPDATE: Updated WordPress compatibility

= 1.5.5 =
* UPDATE: Updated WordPress version
* UPDATE: Updated translations (default plurals)
* UPDATE: Updated plugin URL
* UPDATE: Added help and support links
* SECURITY: Sanitized options
* FIX: Fixed empty variable

= 1.5.3 =
* Added better email headers

= 1.5.2 =
* Added donate link
* Added license link

= 1.5.1 =
* Tested compatibility with WordPress 3.8-beta-1

= 1.5 =
* Added a loan calculator
* Changed slug name due to conflict with other themes and plugins
* Changed option saving method

= 1.4.2 =
* Added default values for finance rate and currency
* Added translation engine (the plugin is now translatable, en_US and en_GB are included)
* Updated default options (WordPress specific code)
* Updated options form with HTML5 valid fields
* Updated plugin name and description for less ambiguity
* Fixed some English phrases and typos
* Removed page title due to duplication (both page title and form title are the same)
* Removed Javascript minification due to low ratio (14%) and potential conflict with caching plugins
* Removed occupations dropdown and replaced with text input (better for language locales)

= 1.4.1 =
* Added price option (shortcode parameter)
* Removed a useless JS line and calculation
* Tested with WordPress 3.5

= 1.4 =
* Added variable/modifiable finance rate
* Added author credit option
* Validated compatibility with version 3.4

= 1.3.7 =
* Updated author links
* Validated compatibility with version 3.3

= 1.3.6 =
* Updated author links
* Small backend UI changes

= 1.3.5 =
* Changed author URL address

= 1.3.4 =
* Fixed a large string issue in occupations list
* Fixed a URL/directory detection function (replaced with WordPress specific function)
* Fixed several typos
* Removed several unused parameters
* Removed a deprecated capability function

= 1.3.3 =
* Changed name of email sender in application form instead of using the default "wordpress@yourdomain.com" (thanks @RedBlood)
* Changed email headers to be actually sent as text/html

= 1.3.2 =
* Added a new plugin path detection and fixed some more WordPress configurations
* Users can now override the default finance rate in the shortcode

= 1.3.1 =
* Fixed a wrong path issue

= 1.3 =
* Updated the readme.txt file in the /docs/ folder with more information
* Fixed XHTML code which invalidated strictness
* Tested the plugin with WordPress 3.1
* Removed old PHP code from index.php
* Removed an invalid attribute from the occupations list

= 1.2 =
* Added uninstall function
* Added license file
* Fixed screenshot order
* Rewritten the readme.txt file for consistency

= 1.1 =
* Added new features
* Added administration section
* Added possibility of modifiying rates and application email.
* Fixed typos
* Optimized scripts

= 1.0 =
* First release
