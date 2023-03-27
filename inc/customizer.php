<?php 

/**
 * Fancy Lab Theme Customizer
 *
 * @package Fancy Lab
 */

//This adds in the ability for the user to modify the copyright section themselves.
// wp-admin - appearance - customize - Now there's a section called Copyright Settings. Inside it the field we created for the copyright information will be available.
//The customizer adds in data into wcc_options -- theme_mods_fancy-lab(aka theme name).
function fancy_lab_customizer( $wp_customize ){

// https://developer.wordpress.org/themes/customize-api/customizer-objects/#controls

	// Copyright Section

	$wp_customize->add_section(
		'sec_copyright', array(
			'title'			=> 'Copyright Settings',
			'description'	=> 'Copyright Section'
		)
	);

    // Field 1 - Copyright Text Box
    $wp_customize->add_setting(
        'set_copyright', array(
            'type'					=> 'theme_mod',
            'default'				=> '',
            'sanitize_callback'		=> 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'set_copyright', array(
            'label'			=> 'Copyright',
            'description'	=> 'Please, add your copyright information here',
            'section'		=> 'sec_copyright',
            'type'			=> 'text' // you could also choose checkbox, select, textarea, radio, etc.
        )
    );

}
add_action( 'customize_register', 'fancy_lab_customizer' );