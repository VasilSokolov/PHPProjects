<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'login_form');

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
define('AUTH_KEY',         'qj0/Syr|uwuuR.Xy4Q+#Aq.!#QH}goGL1TOOYztK|+O/->/`QL5 f|yh-SA-j7fp');
define('SECURE_AUTH_KEY',  'c;kS*4oJczmP~O]#lE;>QfrszcyYrG`PWCHx<pq)AWp>;4Nsov[5fh*C,MuK^1l_');
define('LOGGED_IN_KEY',    ']*gmHqytQ]L^PRi+3!LD2vZ1`Z0*-NQD+ZlPjug?MFU^CA$@6eK!>)e.pA47KM6I');
define('NONCE_KEY',        'y68R;KzUz/9( $|IY8[`*KUUAk:k[oe8SvDXqCl5H)4E[@mB_0H`ZlsX_GLiTI_x');
define('AUTH_SALT',        '2`R&c.QVdAKg5G$AHVVEg/T9jP|X$iQUJo$[]GV5x9lp4wd@qK0L^D^|8r&_|(]T');
define('SECURE_AUTH_SALT', '*)vd><?o!|vhh0Ul@;xCy_@q|sbp{8<.Tn<oIUY$,UD&/S[&+-XzlKuQg42:DyUe');
define('LOGGED_IN_SALT',   '2Uy(2/A<L5BKfA-B0*sVDOLOBsZ<7phlLpFWQqW8>&mOr9X?E`Rhyd_B,;4I7ca8');
define('NONCE_SALT',       'Rd`ja}Jfj_`v;VehBce[dhka!LXW[m-mPi(I-52e%u}P.9iy)#`K-VPuj%ma9.eD');

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
