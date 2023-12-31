<?php

/**
 * Function to register control and setting
 */
function catch_corporate_register_option( $wp_customize, $option ) {

	// Initialize Setting.
	$wp_customize->add_setting( $option['name'], array(
		'sanitize_callback'  => $option['sanitize_callback'],
		'default'            => isset( $option['default'] ) ? $option['default'] : '',
		'transport'          => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
		'theme_supports'     => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
		'description_hidden' => isset( $option['description_hidden'] ) ? $option['description_hidden'] : 0,
	) );

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}

/**
 * Alphabetically sort theme options sections
 *
 * @param  wp_customize object $wp_customize wp_customize object.
 */
function catch_corporate_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'catch_corporate_' ) && 'catch_corporate_important_links' !== $section_key ) {
			$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority = $priority++;
	}
}
add_action( 'customize_register', 'catch_corporate_sort_sections_list', 99 );

/**
 * Returns an array of visibility options for featured sections
 *
 * @since 1.0.0
 */
function catch_corporate_section_visibility_options() {
	$options = array(
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'catch-corporate' ),
		'entire-site' => esc_html__( 'Entire Site', 'catch-corporate' ),
		'disabled'    => esc_html__( 'Disabled', 'catch-corporate' ),
	);

	return apply_filters( 'catch_corporate_section_visibility_options', $options );
}

/**
 * Returns an array of featured content options
 *
 * @since 1.0.0
 */
function catch_corporate_sections_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'catch-corporate' ),
		'layout-two'   => esc_html__( '2 columns', 'catch-corporate' ),
		'layout-three' => esc_html__( '3 columns', 'catch-corporate' ),
		'layout-four'  => esc_html__( '4 columns', 'catch-corporate' ),
	);

	return apply_filters( 'catch_corporate_sections_layout_options', $options );
}

/**
 * Returns an array of layout options for portfolio
 *
 * @since 1.0.0
 */
function catch_corporate_portfolio_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'catch-corporate' ),
		'layout-two'   => esc_html__( '2 columns', 'catch-corporate' ),
		'layout-three' => esc_html__( '3 columns', 'catch-corporate' ),
		'layout-four'  => esc_html__( '4 columns', 'catch-corporate' ),
		'layout-five'  => esc_html__( '5 columns', 'catch-corporate' ),
	);

	return apply_filters( 'catch_corporate_portfolio_layout_options', $options );
}

/**
 * Returns an array of section types
 *
 * @since 1.0.0
 */
function catch_corporate_section_type_options() {
	$options = array(
		'post'     => esc_html__( 'Post', 'catch-corporate' ),
		'page'     => esc_html__( 'Page', 'catch-corporate' ),
		'category' => esc_html__( 'Category', 'catch-corporate' ),
		'custom'   => esc_html__( 'Custom', 'catch-corporate' ),
	);

	return apply_filters( 'catch_corporate_section_type_options', $options );
}

/**
 * Returns an array of color schemes registered for catchresponsive.
 *
 * @since 1.0.0
 */
function catch_corporate_get_pagination_types() {
	$pagination_types = array(
		'default' => esc_html__( 'Default(Older Posts/Newer Posts)', 'catch-corporate' ),
		'numeric' => esc_html__( 'Numeric', 'catch-corporate' ),
	);

	return apply_filters( 'catch_corporate_get_pagination_types', $pagination_types );
}

/**
 * Generate a list of all available post array
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function catch_corporate_generate_post_array( $post_type = 'post' ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   => -1,
		)
	);

	$output['0']= esc_html__( '-- Select --', 'catch-corporate' );

	foreach ( $posts as $post ) {
		$output[ $post->ID ] = ! empty( $post->post_title ) ? $post->post_title : sprintf( __( '#%d (no title)', 'catch-corporate' ), $post->ID );
	}

	return $output;
}