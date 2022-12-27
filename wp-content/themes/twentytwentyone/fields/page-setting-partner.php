<?php
add_action( 'admin_init', 'page_partner_register_settings' );
/* 
 * Register settings 
 */
function page_partner_register_settings() 
{
    register_setting( 
        'general', 
        'partner_id',
        'esc_html' // <--- Customize this if there are multiple fields
    );
    add_settings_section( 
        'site-guide', 
        '', 
        '__return_false', 
        'general' 
    );
    add_settings_field( 
        'partner_id', 
        'Page partner ID', 
        'page_partner_print_text_editor', 
        'general', 
        'site-guide' 
    );
}    
/* 
 * Print settings field content 
 */
function page_partner_print_text_editor($args) 
{
	$value = get_option( 'partner_id', '' );
    echo '<input type="text" id="partner_id" name="partner_id" value="'.$value.'"' ;
}