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
define('DB_NAME', 'DB2341140');

/** MySQL database username */
define('DB_USER', 'U2341140');

/** MySQL database password */
define('DB_PASSWORD', '72p339dgWZLIoDDkY');

/** MySQL hostname */
define('DB_HOST', 'rdbms.strato.de:');

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
define('AUTH_KEY',         'Qm&qcw@n5zgaD(hFSwJVsS5CR9%rXixv)nle8ginwWnRF93qfyI^1N!O)MHrhG79');
define('SECURE_AUTH_KEY',  'RupclnW8h&xOn97z(2Wx80NTjjMAsPGVEQQsvDGh2MT7VwzZVNB7Q#7&9n6KHPWY');
define('LOGGED_IN_KEY',    'GHojZDUHx7p!k0C&zz*^0l1DNSqVf0MCU1z@DTth3FaDGtV8W%i0EaH5t8oD6xnC');
define('NONCE_KEY',        'FtzhdopOWe3HSzC%K#F@W!#t8SiEVC1ScZ6pODbsm5NzUH%i9MwQ78**gggUE^rB');
define('AUTH_SALT',        'IaEtDuLH&jGdaJeWeqpHzTlF1QXJPdAbparWyhMv6YqeR&KuTL(v6Y#mCIGg@77a');
define('SECURE_AUTH_SALT', 'Fp9^L9YZUVb(MRWWBJOnK(jcnX4XUay@smDz#gQ0SNJJ2tBvUy#^%e&AOqY3&FP%');
define('LOGGED_IN_SALT',   'sUmvvQf*Td!zr**yrwPROvj(NDG6mF!IoE@WMHfjUmXYFAi3r***#eEi75Fw8rsK');
define('NONCE_SALT',       'bHTik*XibGd)CKg3xPVde2b!pM(e&SMuT1rq7MjCn(l@USjhJ^539BZb!Nm3^(o^');
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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );
?>
