<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/webs/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
//define('DB_NAME', 'webs_wp380');
define('DB_NAME', 'webs_wp2904');

/** MySQL database username */
//define('DB_USER', 'webs_wp380');
define('DB_USER', 'webs_wpusr');

/** MySQL database password */
//define('DB_PASSWORD', 'Sp488P!)3V');
define('DB_PASSWORD', 'dMFJqWoRX3xo');

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
define('AUTH_KEY',         'fgqobarhxphtrshag1sys84jx0v8kr3mjuv2nxcoroozlipb3sbrb5ircrpkcavz');
define('SECURE_AUTH_KEY',  'eh8okedb36jjf6yquqtgyyxb69jfnrpgjggsflacy3l8ohmfj9z6mld55anpx1q5');
define('LOGGED_IN_KEY',    'x3ijgwt6es7iwnl59qqxdvpalzyce9h0xhjiixm1vgzx1ugxelxums1tjssrqyd4');
define('NONCE_KEY',        'e07labvrh3wvawadxdpkoyz5qvvpklkhcitcbbm117sqg4x45ra3xh1opi8ggucy');
define('AUTH_SALT',        'sokgfyqyaruhjeelta05mdwcd0nnkijkbgctdjn54v1rpbjekkvkrtkqczj4wvwo');
define('SECURE_AUTH_SALT', 'rcaha2b2bhckgx5guo7c54me1sxbr5yqu0vvbctjuvm6anizisweixds9piupvhe');
define('LOGGED_IN_SALT',   'eui3l0pbiddyvamcgxol5vqgqaa6bqgtuhrdfsmgihg7uhxj5yimspakxcexn8wr');
define('NONCE_SALT',       'mmtua9ccbqqfyzwa0itmh3vh1mb8lh8o3xc7ziegikpoijwslcicvtwkpmxe78sq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

define( 'WP_AUTO_UPDATE_CORE', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
