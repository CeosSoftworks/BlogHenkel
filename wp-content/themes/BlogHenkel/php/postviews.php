<?php
/**
 * Retorna os posts mais visitados no website.
 * 
 * @global wpdb $wpdb Objeto de conexão com o banco de dados do Wordpress 
 * @param string $mode Tipo de postagens a serem recuperadas.
 * @param type $limit Limite de postagens a serem recuperadas.
 * @return WP_Post[] Posts mais visitados.
 */

function get_most_viewed_obj($mode = '', $limit = 10) {
		global $wpdb;
		$views_options = get_option('views_options');
		$where = '';
		$temp = '';
		$output = array();
    
		if(!empty($mode) && $mode != 'both') {
			if(is_array($mode)) {
				$mode = implode("','",$mode);
				$where = "post_type IN ('".$mode."')";
			} else {
				$where = "post_type = '$mode'";
			}
		} else {
			$where = '1=1';
		}
    
		$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");
		if($most_viewed) {
      foreach($most_viewed as $item) {
        array_push($output, $item);
      }
    }
    
    return $output;
}
