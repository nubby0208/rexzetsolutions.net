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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_nqw89' );

/** MySQL database username */
define( 'DB_USER', 'wp_wo2q4' );

/** MySQL database password */
define( 'DB_PASSWORD', '1N@svK82W4^leZI~' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'Zr3|Ee4582Uf[!;pEAwdh9Un5[ej]6P5103%Zy:ip0x+3d58!K~Fj87A];+4|74K');
define('SECURE_AUTH_KEY', 'awd!b8;:_Q0aQe-&r*y06d6Mfp2@G/80lj0&z3Lh~@C5TE&kq9|f*C#vCouxchIS');
define('LOGGED_IN_KEY', '177R7z[Pc@N4QoSba+46FeSSFd2k+|su)EomwVB2g!591767])J7h[BC39N_o8wH');
define('NONCE_KEY', 'u)9PeFp(efPFp~l[1U*EO[_@9jBJeJrSduzpS+LshM*i9BTd~96z0yq86Di4XnhK');
define('AUTH_SALT', 'Re-Q38d0/4-%2%54:&+NO3R)(]Ym87~Tw0M49&pAJZ!*q%R[Qs!CX!#g/z/oRugu');
define('SECURE_AUTH_SALT', 'c+j4U(iw[%~-2dX~_y3A4H(!S@-i:fp2024:0l~z7@yP[I&4@+;5RmMU1SuA8V-9');
define('LOGGED_IN_SALT', '2FE!%c]0n&3a4cD%8pl1Y7y)5BV1%1@35LZSgo!_5_j5(tk[a3)j0]1_(F3yGktV');
define('NONCE_SALT', '3duHBq|Br-KWpXmT4HBD9O&omXtY~N9DlBQ2i#m57~zrxa0];8!#HYTrB26-*l7_');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'eqSHjpmD_';


define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
