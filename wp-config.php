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
define('DB_NAME', 'test_db1');

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
define('AUTH_KEY',         '?tqZd-9wr8]~l=f 8aSSq 4,q8@|T.7Z<bf:FX~a1UG{m(6xJ;suS/-Np}PQ/4t8');
define('SECURE_AUTH_KEY',  'EoS$}d]MQyz4n=(_WYi 6/TUs,kQZmGrfQr|8a,sA@nm4|nH72+M4-1qgF?HoX9,');
define('LOGGED_IN_KEY',    'B~2%N#29|D.Nb9-oO*3}8:a*.K[9,nQu5pm8Ui0;IRq=$n$NO!-t<RTx!Lha_u[M');
define('NONCE_KEY',        '+O,gb:l,$(/%oxVs-:68t+4%m:i:+^Y|AbE<n`^%=9yIA]%BNytG?hteR/r6TyMJ');
define('AUTH_SALT',        '/OJv>B,X/:+K]T;?/4.u`MPr_3MvTxr~TMEqG$h;u{{c.D^SLhHx^.kK?sXfAZRB');
define('SECURE_AUTH_SALT', 'z}]N9v3D%vb#@@OG53LHgijg7|H2mU~Grh3602)>Hw^]~.7F$.dBl7%+iX#gv?g9');
define('LOGGED_IN_SALT',   'LF+]c[eY/4Cl{Wdk8ClJ)zvIPzVND<P[Cw6cY%(@#/!%/^UaVsu?_U/IxiL4#ph3');
define('NONCE_SALT',       'Vu[r5vWFDzuq$Ad+V$BW]bD:$-i3TYa&!_)d8gHG`t2RZ~sEf9|5h?NLia+PT)/M');

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
