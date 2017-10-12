<?php
// Constantes
define('SITE_NAME', 'Santuário de Canindé'); // nome do site
define('SITE_URL', 'http://www.santuariodecaninde.com'); // site url
define('SITE_TEMPLATEURL', '/wp/wp-content/themes/scaninde');
define('SITE_STYLESHEET', '/wp/wp-content/themes/scaninde/style.css');


// Include de functions para Personalização do Admin
require( dirname( __FILE__ ) . '/includes/functions-admin.php' );


// Include de functions para uso no Site (Breadcrumb, paginacao, etc)
require( dirname( __FILE__ ) . '/includes/functions-site.php' );


// Include de functions para uso no Front Page
require( dirname( __FILE__ ) . '/includes/functions-site-fp.php' );
?>