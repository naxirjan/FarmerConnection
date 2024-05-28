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
define('DB_NAME', 'farmer_connection');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8889');

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
define('AUTH_KEY',         'k,k,ugGy--uH{h03pR>6]v5ot0kg5Z@9h6}|`vUQn:XI3,/3a0Q|Wq4=6YOYiiY!');
define('SECURE_AUTH_KEY',  'kG>s[$j=}QFfGv]=U,&nn(510Um1h81IR4#+t;7c{;3f5caedqiFZp|8 i3M*[$8');
define('LOGGED_IN_KEY',    '={RmNkx+fgKxpDUj`oM+G<~P922=Y+qI>af`*|}fZkok`fuOz0@+AxR1F*iw0AsG');
define('NONCE_KEY',        'd@M+%[W6bzQ?7afdkBDC.EcG|!;Ew/SJ<(id/E(y-8o_|WxKYAy!e]0&q(Yi^x<f');
define('AUTH_SALT',        '>wAu;kOsjPDCHqe=[kuDHzB,TNA-Pw=(I~8@3U Cap2/lEvW.iau%9tK4}ERbO3W');
define('SECURE_AUTH_SALT', '&*,TY$nfCWI>5)c^5F4F=[l;9)V,gf85Za.VE,P`S|m$lJ3ZCHhqNOYY1m TUl7;');
define('LOGGED_IN_SALT',   '?KX/&wQ2lNh3._Fa!FGZ3Jy_fLD_:O 1K|.dlZJ~rPgBN|g7a[qMRR 7/J5[s8,I');
define('NONCE_SALT',       'UTlm|d>Nsw31kk0bC]#o@:2(q}Q/7mMQB>0pY`e%*;,@[QA4kJ-x`r2[?Pk%#Rmg');

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

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
