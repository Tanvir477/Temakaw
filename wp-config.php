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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'temakaw' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '1s@=>+n#Se_.I<x5]X(Fy[Tx^CVB{c2{EXu^8GKsv:0;70G;.+^X?6G*ln^&6tBk' );
define( 'SECURE_AUTH_KEY',  'fp$ah.]F)/tVcFpP-]dq5kp^~0t>dQaNF_?hu_v*5cWb(E7KuQ>9[2;VLzaH`>CB' );
define( 'LOGGED_IN_KEY',    '`#1@<U:,y,zA;JiCB@5,@d{FaSIUOnT f1[zY>=hx{Z)aeS9bh&byt1u0y_]aRAZ' );
define( 'NONCE_KEY',        'v{cf4.n#:hlO4o0}-:@NIZz%,0YJYr|Z^n5,l;X=Q.j.x0;(3Rq]jE:fi!5?$(PK' );
define( 'AUTH_SALT',        'xoUW@@UPv`~UY_}tH}(>VHJ,b 6c?qG$=veWQ:K|,<HRT3.Ljhl,^$@z~:;0X/k:' );
define( 'SECURE_AUTH_SALT', '0)R9EzEhLPi-!,X%:{4g(|As=M (@inJDR*@+#Enyy`A2g._|oM(hE?;6XH$8Geg' );
define( 'LOGGED_IN_SALT',   'QZ5YhiX;~vxo%|=G@N6`EyGC777kG]mbIc{Yf9mq?Pzf*aw$u77!P&amwt6Q`-V%' );
define( 'NONCE_SALT',       'bz+L]@-u)ed4@#dsb?E?h6bxkzvaMJD4#Jl]cGwD4^Mhyq~*{z1H+ j7aNJ!uxF0' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
