<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'bloghenkel');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jZo-gkRpLqG$!+o}>Bwz^mJ80I.`t^SE7r3x< 8,lo>t79|52`B|Y.94nh^PQ/|&');
define('SECURE_AUTH_KEY',  'oJd&*S8cl/0Gx`i;c7O2bfn>Yw&@x>n9 |}mWEHc3t[r`d._]7/#|%Cs(y*Y|$bZ');
define('LOGGED_IN_KEY',    'NhOq!Y3gfg%k<K4_R.SerHVH_Q-Hd3oQbK]f#P_QB{},tc-|7SCH23x?>QYS;mC-');
define('NONCE_KEY',        'MX516Ch>-Eg8yg&/YSc?6pOy|yl|KBPq:Bs$K+q,`y=1>>;N[MrP2(_F+u>X#[m/');
define('AUTH_SALT',        'Yl|_oHWM].41L+H^#7:DguFVkdhub|_+7u>EhT1wN d|%7mETfoUHNUK_#ZuzJp_');
define('SECURE_AUTH_SALT', '<P&+z02avcHFNiv2/eTq-Gju]8PBY(+PxPh:+j++Zsf72r oEXad8IcnDCa1i$r{');
define('LOGGED_IN_SALT',   'cFr:XS+HOqT? A0lcp[Ijn^ap45CA:oFfU6y8gEG^>->UFT.*p2,jy`Ta-HNHP1v');
define('NONCE_SALT',       'yYd$B@YL&T}.BbLSeBR/04~J+bEk}pK(eg:0)/+nMb5wYoZ}w0B?UO+J$ilrnGSE');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
