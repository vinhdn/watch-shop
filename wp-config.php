<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'watchshop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'nb?#4 b12En5qCX6fi!E(!nM1Gk|qbw0tzgrb2aFD0f!&@Ci2-DJnC13Tr-u,TTT');
define('SECURE_AUTH_KEY',  'q[))CA`h}&M&&d9qL>;|f8YKSZ-]%W(. Tm.}N60f|8?|}Dp=^`5<tT.]lT9]i{4');
define('LOGGED_IN_KEY',    'k?(^|xpBFQ7y5RYLS*ZMlKQhf{St+,}GgyKMKrc~3b5`/RR`YIM9fW?}.)M}gG&V');
define('NONCE_KEY',        '_r<,8jjZ-Y:g3@=2B9ueHI;K#`Fl#@8QD6eq/T<my[[S(YPa?zThJ52gQ`%tejt0');
define('AUTH_SALT',        '/.xgeh h^p,jbSTiJyAW+$7D:JLC3]B7us+&XhJGjWaSuUfU?Yq[pF.&]}xI-3yk');
define('SECURE_AUTH_SALT', 'Y5!G*OI~fJ}]_QG&jb/q/!~gy/.d&ki[U3ZMeQ&7a_ 4e.GYK]8637nT&xrlM#Y;');
define('LOGGED_IN_SALT',   '?0AZ=a[lBb8!-wUGG>37BtH]H2<N4v*6uNB3Hl@PK9O#u9PX&}qZuD7&nDZ$8VXz');
define('NONCE_SALT',       'D1)h/&S*1_7%2r#,_0Ne85u:)1(g!#:}8hJ]|ms{[$6v,RqtqtxJrZ.G,700oq0P');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

set_time_limit(600);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
