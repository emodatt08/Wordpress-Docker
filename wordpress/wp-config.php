<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'sadat' );

/** MySQL database password */
define( 'DB_PASSWORD', 'secret' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{}5/$tY,Ponyg]|n! dz`:o,`7LGp)Zq=ZFi$F2dkxqHH,_-0&7t.6ZKx`sF< >m' );
define( 'SECURE_AUTH_KEY',  'M?=otz>[qV4;o :s[`)HS=WCgD@LbKyq 0m$j|0d;^:_z<8l}}xs]A^Td}GHaP4B' );
define( 'LOGGED_IN_KEY',    '+V>TGvw=4Ypkl9)dpd_D>Mcn-?>QR4VKVFdG^Ig4(@~(v1k1<u|QXcv(/:QzI;FV' );
define( 'NONCE_KEY',        'ra}k?>i|wcmU,8Mu}S o8)B)jc`zt2(TiH<HI6c.-z!s;Gcgu8zknRP(2Uc+Ve,=' );
define( 'AUTH_SALT',        'z4&.^I)SF[-vTpH}{DC{vSO don]UD.t,;#b:ba0G,HtsnIwLO)i#4tjMJ-7iJa6' );
define( 'SECURE_AUTH_SALT', 'YD]D(;$~A+TdV*sWpB+6a4cGt{H|c+M|IxkVQg=L~1[itw-]yX%kvr$Qj[IE9{r.' );
define( 'LOGGED_IN_SALT',   'aI]2^]ILS%:1$S+A3m=.AB_vf|.k`xQ$|/p~wSppU;xgK~GYp@mox,I$_igE,rdN' );
define( 'NONCE_SALT',       ';:.GUUHa~];=y*q=r;S.je=A,0m4uQ94i_Ewq8jhd`2^AV4 )$&7*soX(k1gJ!#%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
