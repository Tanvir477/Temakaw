<?php
/**
 * Featured Content options
 *
 * @package Catch_Corporate
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_corporate_featured_content_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
    catch_corporate_register_option( $wp_customize, array(
            'name'              => 'catch_corporate_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Corporate_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for Catch Corporate Theme, go %1$shere%2$s', 'catch-corporate' ),
                '<a href="javascript:wp.customize.section( \'catch_corporate_featured_content\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_corporate_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'catch-corporate' ),
			'panel' => 'catch_corporate_theme_options',
		)
	);

		$action = 'install-plugin';
		$slug   = 'essential-content-types';

		$install_url = wp_nonce_url(
		    add_query_arg(
		        array(
		            'action' => $action,
		            'plugin' => $slug
		        ),
		        admin_url( 'update.php' )
		    ),
		    $action . '_' . $slug
		);

	// Add note to ECT Featured Content Section
	 catch_corporate_register_option( $wp_customize, array(
            'name'              => 'catch_corporate_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Corporate_Note_Control',
            'active_callback'   => 'catch_corporate_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'catch-corporate' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_corporate_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	catch_corporate_register_option( $wp_customize, array(
			'name'              => 'catch_corporate_featured_content_option',
			'default'           => 'disabled',
			'active_callback'   => 'catch_corporate_is_ect_featured_content_active',
			'sanitize_callback' => 'catch_corporate_sanitize_select',
			'choices'           => catch_corporate_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-corporate' ),
			'section'           => 'catch_corporate_featured_content',
			'type'              => 'select',
		)
	);

	$type['featured-content'] = esc_html__( 'Custom Post Type', 'catch-corporate' );

    catch_corporate_register_option( $wp_customize, array(
            'name'              => 'catch_corporate_featured_content_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Corporate_Note_Control',
            'active_callback'   => 'catch_corporate_is_featured_content_active',
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-corporate' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_corporate_featured_content',
            'type'              => 'description',
        )
    );

	catch_corporate_register_option( $wp_customize, array(
			'name'              => 'catch_corporate_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'catch_corporate_sanitize_number_range',
			'active_callback'   => 'catch_corporate_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'catch-corporate' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Featured Content', 'catch-corporate' ),
			'section'           => 'catch_corporate_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'catch_corporate_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_corporate_register_option( $wp_customize, array(
				'name'              => 'catch_corporate_featured_content_cpt_' . $i,
				'sanitize_callback' => 'catch_corporate_sanitize_post',
				'active_callback'   => 'catch_corporate_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'catch-corporate' ) . ' ' . $i ,
				'section'           => 'catch_corporate_featured_content',
				'type'              => 'select',
                'choices'           => catch_corporate_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'catch_corporate_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_corporate_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since 1.0.0
	*/
	function catch_corporate_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_corporate_featured_content_option' )->value();

		return ( catch_corporate_is_ect_featured_content_active( $control ) &&  catch_corporate_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_corporate_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Shop Spot 1.0
    */
    function catch_corporate_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'catch_corporate_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Shop Spot 1.0
    */
    function catch_corporate_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;