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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'kH^Us?$hfH!QtPd-6@E%n2LOe#6?3An-oG[Jibde^<J NqXoaHJ?FJZ6iO,3kiV;' );
define( 'SECURE_AUTH_KEY',   '}$#kyh$+8L4}i!O|VnX^;]Mz65q4 P:w~rmAmagM74Z]O}qb7SIG(sIpcOI!fTCB' );
define( 'LOGGED_IN_KEY',     'SrvWJG^iri;OSYEkl1:j!EC]>.U7h,xkv>eta`m#@Iq?N(?8Jvh&8I$?$x9-&FnG' );
define( 'NONCE_KEY',         '%5@hjD[mz^&H:<qK}DX~eK,JP-)?4{&LnCpWe![/O+Bpd)XVd|6>`Ln>J4VMJa~&' );
define( 'AUTH_SALT',         '8T0=Oz7RKmr17@n2dQB=,,AhT@I4+O6?@y)Zb4c_QsJ+F3e+Uy@7-+,Pd54r-rmg' );
define( 'SECURE_AUTH_SALT',  '#/x<]7}*484C>m,iL`!-=~kC;~Q8ZWvGf&ztJlZ3$|~RZb(M<huhSnKb1 pj@uL@' );
define( 'LOGGED_IN_SALT',    'n~n)ZV@zF{(dL{H]eAK:S`#4 $JT{AHU<7xKGj5S>7./DxH&f[xZ?zom]ko3DOqr' );
define( 'NONCE_SALT',        ' B0%L G3Sw+9w.URejv<ODkDYeK;b*t:6!VHU;R=I0g4/?8q_+o~dXgo]Icu}cY7' );
define( 'WP_CACHE_KEY_SALT', '$kv+)4Ox.$J_`cJLe-vv,%sC&iI];QGKYpDb%HB9%R(G}pQ3C|xK f5ED7C8wTFd' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
