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
define('DB_NAME', 'coolbet');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'vImVH>;&cIYX*`QI:=Rt8a7Dw?kD(_PXi|7kCD:So}/?K1MR)M<Sft4-%}pDeQ;v');
define('SECURE_AUTH_KEY',  ':g9p64;&SLmO%9}Gh{?mXk0r<F,R}:]I9+uf.ks9DY)d_?t+{8z4sA}=[L&:p@zD');
define('LOGGED_IN_KEY',    'GzNrLu@)Em/,f!Zn(a&?uXK.m#f]SGXm!Poz#AU]jF@b[eN.iB5buBf_D`(`5QeJ');
define('NONCE_KEY',        'wV3vMwBxa|z/[/yhs(YS&.L8,NWM>YvJ_3kemv>-$nu_QRnK0y].azRf8E!m!o|m');
define('AUTH_SALT',        'LD>lBnD3x&Ed4|U/%~Ms^h=)QJ++h>^+hF|KGhU1_4pcFZOu_oj|Ebnc/7TK)8)G');
define('SECURE_AUTH_SALT', 'seEneWB=PwS%IP%iev<8M6r|0PmIa5c@j} ?T=I$|]]prRsifq3Pd;=/{ueKzDhF');
define('LOGGED_IN_SALT',   '*V<-9hxr9r*bs-l)ER3RC(;?5b,mNolI57S_$DFJ:}i#]7dms1F0aF17$}k;56N;');
define('NONCE_SALT',       ':6.^toUG]hPs4g6 .q!$2LX?.kZ#9?koC3OT$6l|gf[6,%s$Y B}2X-GCksc~cd/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cb_';

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
