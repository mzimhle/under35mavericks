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
define('DB_NAME', 'undercwp_wp319');

/** MySQL database username */
define('DB_USER', 'undercwp_wp319');

/** MySQL database password */
define('DB_PASSWORD', 'xk0qS7r58P');

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
define('AUTH_KEY',         '4eiobdrlxqhmyqphbccrpojykqxlfrgm5fvryzzoxlzwjddhsrni1hqjkczjp77b');
define('SECURE_AUTH_KEY',  'nk8onyctuqnbb4rp5lsn0lr4tnpea6lyn1dcm6o3gq4vbjffiz5qjurcgr9ne9ag');
define('LOGGED_IN_KEY',    'paqwtu6oj1h7iauydtxwat0sojjncmsppz07ts8wqir9co2iizaq9euzlsui3rcd');
define('NONCE_KEY',        'dusfwtutkra2yjpasah2ycaeh3p6cjpa2dvdgdkrakrcgoeoqorld2zxc0085bew');
define('AUTH_SALT',        'rua1chxdxt0hhifvdjkc14gjj3jqrr4ley7pjuay7wjpyyaw7nqjjj1waoefeenz');
define('SECURE_AUTH_SALT', 'iuezs3jroici4yh4kuv7xyqegnhx8sdis1jusojowonews5ds4oyxvdqtiu2ihxq');
define('LOGGED_IN_SALT',   'wtwvvorpjnvfewhmezqdu5dhmgedcfhni1fqctkzlsz4fadl3omq4lrfuaxtbvhf');
define('NONCE_SALT',       'puialkpgopndprkhn4o6qvmdqhrtzgbulcrubokgrfplz68h88e7fbhbwt8cddl1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mav_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', '');

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
