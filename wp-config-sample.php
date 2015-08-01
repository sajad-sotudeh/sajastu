<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'wpdata');

/** MySQL database username */
define('DB_USER', 'sajastu');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_general_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[k[ ^a6+YWVLPe1.XFhXWz+E,Z$7ex),.<)Kc+gu q;*{a.E|Rq_^R}*zd[DVTl_');
define('SECURE_AUTH_KEY',  'KXiE|S4jU#|JMe{SP3mK]~H|WuXKP=4[-`ByvVtk3I(1(N!VT5v>TBlHt6;rI1-5');
define('LOGGED_IN_KEY',    'rp3ff$cGU-rR(t!?!JcN@_L*/F+v?38)LD-/E ij*IR6|(3%i*f,A+f1:+B/t;+B');
define('NONCE_KEY',        '._2}<#=WZ`84.#ee;e;cO9:<E-dzcov*7$J3chH94gk;A3:*#%bboq,lJs{|@G-#');
define('AUTH_SALT',        '6Tw9)t]hNVZJYt<IWeQ2rMmr<ubRb#ZbI7&S7EN`M9Y~V___yID+&hUVn~C2g`]!');
define('SECURE_AUTH_SALT', '&dpu|_N~z[SAz $*`uHKDFJv/Cw}{&PQR|$tX_j$2,5Ry>8Ma[P}GNqHq$4KV|bf');
define('LOGGED_IN_SALT',   '2uD5-<Xci}0{7!,2#;]qpyQJiY>T>@lCt{Su&^nDse[jW5#8M)t|,v}B?;/1bIlJ');
define('NONCE_SALT',       'wP})LK9zGa0R[^QDhdT/yZwSVtF:-O?! BPW|7{vdf,h|!(/VS)0#CR-!MG7flC~');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
