<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'jeandiorama2024');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Py^v0*X2n!fj8S@/~/v#HV+NtcsvH8T<[uIFK0H-S%7)Lr!{Qs0-K?xRE-hsb]5S');
define('SECURE_AUTH_KEY',  '~|9;>3RZ7vcjXQ. Z&`8[wpb}d`*Bsjw4l}qvx[lj|w1GcFi,lLRR.JoDL!`#UM6');
define('LOGGED_IN_KEY',    '>[`-d7L!evvhZomc-/G7|n-tTyN$,1hdjNO0gXk Rw?-5If V= :Uv!2Bpdh9^TK');
define('NONCE_KEY',        'ZQduY$5x!H)_L{S>kt&M6O|^@-@?~B-28Bz)U19q-3_(JP|Tz|Xv]AY%+%)H(qy9');
define('AUTH_SALT',        '[Z@)1BX|Xl->@4~EG3 3Ow<4`K2|:;`HWKJ9NN9K^|$=[i?Q5Tk=)~4xfTjljs@<');
define('SECURE_AUTH_SALT', '~x.q0f.RP?g^Crs><#h}(>qqpmmg^NdF7dQmG9%VxC,j8^-YPet0V|5I[,~bem#b');
define('LOGGED_IN_SALT',   'tu/]$JYW%-_W+rb{&V$Ch@bU.Lhh2JH??mKh29aA|y|BAl;:JsfGQY?f[~;XXw(T');
define('NONCE_SALT',       'yUt![/UR1)C+fCOD>^^Gc*KplZBBazu3+#CgnL(eE=H$+IB!%S#sc<}FfQ,CaVMI');

/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
