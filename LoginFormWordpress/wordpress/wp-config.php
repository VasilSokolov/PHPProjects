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
define('DB_NAME', 'login2');

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
define('AUTH_KEY',         'IFFo _7;G)7HTN.tYZbdF-[K_xQdz6$eGUn@bBR]Fr+C@YcJx0aFA1`n(MXqH#x`');
define('SECURE_AUTH_KEY',  'ys+C1_Uulv#DU&2J8|LoMHCyQ!4.fHRS50dI.DlGQJZqka%} ZnHM<Af*G 7ZCf~');
define('LOGGED_IN_KEY',    'o@H?Ijb)uPW.{banoZ75@GFz]zJTg+|d[O18Nj$sqwp@SNCwg! m`M^sZF`H<7>l');
define('NONCE_KEY',        '5*D>yvPUH>{rb5AR;+~]&y=0=HD;C6ItGtI}|^)x|MRYHk>Qv:ww,w@]c$mHC#01');
define('AUTH_SALT',        'lcw &^5n}@il`X&^IHU*a/KtP&eztNWqmY8mfXRi>tTpBxJOxzg*p4-US$oV5kE*');
define('SECURE_AUTH_SALT', ',b+41/yxAhg:n.1-{9X,/fqL3Q$pQ5}*Q9nb>QGnx]P},7X 1`v0/G%#i[ VYdV7');
define('LOGGED_IN_SALT',   '8dBiG#p9OU:b&2uPygrp|R%i/v93(.CG/W~`_|F!?L;X&.3`D|1Dj/b&1t/ZNbK6');
define('NONCE_SALT',       'L0C.Yk~lto<Sl>t!|-ZH[tZ]S:t]WPz?y.Yw52h2!0 tbDY.cNblcmgKPY|y#.Sy');

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
