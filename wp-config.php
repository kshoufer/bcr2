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
//define('WP_CACHE', false); //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '' ); //Added by WP-Cache Manager
define('DB_NAME', 'bcr2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'XhDo5Ndq5U0kv9EgaNPvuHPHNxJXo6sTd0X5dytyQorqvLoX3m2a6avciSEVhOFH');
define('SECURE_AUTH_KEY',  'rrCNumDB8ZwnMoDf5lwro1pzo9M9FDaG14bke14WrtbLcuDeEcpKOSUE3bOd3Mee');
define('LOGGED_IN_KEY',    'lxeBHtPU1avprSOUZ2shYhKW813JLx08lBS39fE6FCNZUUtfLSjO8SLtkDYtx5z5');
define('NONCE_KEY',        '43FxtLjKh2Dv60imFpyf8ejCFK86Eqa7m5wyDfYllbNKrEqfFUWDx0Sdl4uBJDLT');
define('AUTH_SALT',        'Wim66YucH1WSoMlsQC7eBZtD3RPC5Qgs7GU8x2WVb0KlQgXqArUmcTnjbbM2ARBh');
define('SECURE_AUTH_SALT', 'L58B9aikI3PjsquvpRZJgOw3pPLq7eQwvGSJ3vIv6G7pkK729YZpIfUnusM7qYP5');
define('LOGGED_IN_SALT',   'GZWz3N18Kt7sHmKuNXHkXynq4QXFc2tbB13VmiZEG7dHpHyPQWuii0jRE7CCduMs');
define('NONCE_SALT',       'LkGyWVkX4OzNdtJgwNUrJcEGZK7sJPNFUi9mEasQfz5Rmm7KH3zmO5AE3h4EpZv2');

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
