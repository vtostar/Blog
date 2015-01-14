<?php
/**
 * Class+ Theme Customizer
 *
 * @package Class+
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function classPlus_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_setting(
		'classplus_favicon',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_setting(
		'classplus_copyright',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_setting(
		'classplus_main_color',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'classplus_favicon',
			array(
				'label' => __('Site favicon', 'twenty-theme'),
				'settings' => 'classplus_favicon',
				'section' => 'title_tagline'
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'classplus_copyright',
			array(
				'label' => __('Copyright', 'twenty-theme'),
				'settings' => 'classplus_copyright',
				'section' => 'title_tagline'
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'classplus_main_color',
			array(
				'label' => __('Main Color', 'twenty-theme'),
				'settings' => 'classplus_main_color',
				'section' => 'colors'
			)
		)
	);
}
add_action( 'customize_register', 'classPlus_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function classPlus_customize_preview_js() {
	wp_enqueue_script( 'classPlus_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'classPlus_customize_preview_js' );
