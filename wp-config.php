<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'clearview_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qwe!0Y5b|v4H+g6)^Oe|Y-UoU7uwXdFJUi^=,j0?m|6aF),lf3:6T7*~|G~Gy8X[');
define('SECURE_AUTH_KEY',  '~]loH>_EOx*5yA{=#GWX:I{AJ5Fp%,8,2]_xnpJes;Al)VtM7G6T2|Oq/B!pD46K');
define('LOGGED_IN_KEY',    'CA}{CTdI,as>?H&v{8-bIX&wEqiMT>8y;#`HZF,)r820qr{e]7V+,[8Q|30AY7U*');
define('NONCE_KEY',        '/wuosMs@AP+T@#L%]!zvd8E^ya,zhh}Fkd0Wn+cm$-2L>+gZhuXbKqA$|+)2!]km');
define('AUTH_SALT',        '=)z0fa*D;]-+`RA94nKU+jSEvBw!9NEo`4PQ+^!ZzX;|Mea!Ky:.V4P(CnO{mU#W');
define('SECURE_AUTH_SALT', 'its{|z-Zk0-<zmO-C{Y&5X~Z;n{b=BDg1[D%!M)GN=+Qx_Z6jV;joJtB%:w>|urW');
define('LOGGED_IN_SALT',   'P`QF0pp`%fIXKbh*>.T (]K213M=5E=(Iw_5FcJ9i8G c,Y|vZ1a9m#Dk>B Tz$0');
define('NONCE_SALT',       'BE<*^mSI.ENX+oU|O|ZxgpWcSP^$k(XY@RS>QE]L,X)}-pb<y4yB/J$-A~J=mdHw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
