<?php
function mos_home_url_replace($data) {
    $replace_fnc = str_replace('home_url()', home_url(), $data);
    $replace_br = str_replace('{{home_url}}', home_url(), $replace_fnc);
    return $replace_br;
}
function mos_get_terms ($taxonomy = 'category') {
    global $wpdb;
    $output = array();
    $all_taxonomies = $wpdb->get_results( "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id", ARRAY_A);

    foreach ($all_taxonomies as $key => $value) {
        if ($value["taxonomy"] == $taxonomy) {
            $output[] = $value;
        }
    }
    return $output;
}

function get_formadable_form_list () {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'formidable/formidable.php' ) ) {
        global $wpdb;
        $results = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."frm_forms` WHERE `status`!='trash' AND `is_template`='0'" );
        $forms = array('0' => 'Select a Form');
        foreach ($results as $result) {
            $forms[$result->id] = $result-> name;       
        }
        return $forms;
    } 
    return false;
}
//$terms = mos_get_terms ("testimonial-category");
/*Variables*/
$template_parts = array(
    'Enabled'  => array(
        'content' => 'Content Section',
    ),
    'Disabled' => array(
        'banner' => 'Home Banner',
        'wecover' => 'We Cover',
        'about' => 'About',
        'cta' => 'Call to Action',
        'showcase' => 'Showcase',
        'testimonial' => 'Testimonial',        
    ),
);
/*Variables*/