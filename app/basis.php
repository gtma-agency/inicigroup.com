<?php

include('cpts/staff.php');
include('cpts/project.php');

add_action('wp_enqueue_scripts', function(){
	wp_enqueue_script('masonry');

}, 100);

if ( $_SERVER['HTTP_HOST'] !== 'inicigroup.local' ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
}

/**
 * Replace metabox title with field group title if defined.
 */
add_filter( 'acf/get_field_groups', function ( $field_groups ) {
	return array_map( function ( $a ) {
		$a['title'] = preg_replace( '/\[(.*)\]/i', '', $a['title'] );

		return $a;
	}, $field_groups );
} );

add_filter( 'acf/load_field/name=background_color', 'select_background_color_options' );

function select_background_color_options( $field ) {
	$field['choices'] = [
		'none'    => 'None',
		'primary' => 'Primary',
		'white'   => 'White',
		'dark'    => 'Dark',
		'light'   => 'Light',
	];

	return $field;
}

add_post_type_support( 'page', 'excerpt' );

/**
 * @param $field
 *
 * @return mixed
 */
function select_form_options( $field ) {
	$forms = RGFormsModel::get_forms( null, 'title' );

	$output = [];
	foreach ( $forms as $form ) {
		$output[ $form->id ] = $form->title;
	}

	$field['choices'] = $output;

	return $field;
}

if ( class_exists( 'GFForms' ) ) {
	add_filter( 'acf/load_field/name=select_a_form', 'select_form_options' );
}

add_filter( 'get_the_archive_title', function ( $title ) {
	$title = '';

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_search() ) {
		$title = 'Search';
	} elseif ( is_404() ) {
		$title = '';
	}

	return $title;
} );

/**
 * Style Gravity forms with Bootstrap CSS
 */
add_filter( 'gform_field_container', 'add_bootstrap_container_class', 10, 6 );
function add_bootstrap_container_class( $field_container, $field, $form, $css_class, $style, $field_content ) {
	$id       = $field->id;
	$field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";

	return '<li id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</li>';
}

/**
 * Enable option to hide form input label
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Helper Functions
 */

/**
 *
 * Get either the url, or an array of image data
 *
 * @param mixed $img attachment id or object
 * @param string $size
 *
 * @TODO Make the output a consistent array
 *
 * @return mixed
 */
function get_image( $img, $size = 'full' ) {
	if ( ! $img ) {
		return;
	}

	if ( is_int( $img ) ) {
		return wp_get_attachment_image_src( $img, $size )[0];
	}

	return [
		'url'     => $size === 'full' ? $img['url'] : $img['sizes'][ $size ],
		'lqip'    => $img['sizes']['lqip'] ?? '',
		'alt'     => $img['alt'] ?? '',
		'caption' => $img['caption'] ?? '',
		'height'  => $size === 'full' ? $img['height'] : $img['sizes'][ $size . '-height' ] ?? '',
		'width'   => $size === 'full' ? $img['width'] : $img['sizes'][ $size . '-width' ] ?? '',
	];
}

/**
 *
 * Format section titles for consistent output
 *
 * @param $title
 * @param $classes
 *
 * @return string
 */
function show_block_heading( $title, $classes = '' ) {
	return $title ? "<h2 class='section-heading $classes'>$title</h2>" : '';
}

/**
 *
 * Format section titles for consistent output
 *
 * @param $title
 * @param $classes
 *
 * @return string
 */
function show_block_title( $title, $classes = '' ) {
	return $title ? "<h3 class='section-title $classes'>$title</h3>" : '';
}

/**
 *
 * format the color for use as a css class
 *
 * @param null $color
 *
 * @return string
 */
function get_color( $color = null ) {
	return $color ? 'bg-' . $color : 'bg-None';
}

/**
 *
 * Format the WordPress Gallery and add Bootstrap Grid support
 *
 */
function basis_gallery( $output = '', $atts, $instance ) {
	if ( empty( $atts ) ) {
		return $output;
	}

	$columns = $atts['columns'];

	if ( strlen( $atts['columns'] ) < 1 || ! isset( $atts['columns'] ) || $columns > 12 ) {
		$columns = 3;
	}

	$col_class = 'col-sm-' . floor( 12 / $columns ); // floor(): not a great way to handle 5 columns, but good enough for now

	$return = '<div class="row gallery">';

	$image_ids = explode( ',', $atts['ids'] );
	foreach ( $image_ids as $key => $image_id ) {
		$image_url = get_image( (int) $image_id, $atts['size'] );
		$caption   = get_post( (int) $image_id );
		$return    .= '
            <div class="' . $col_class . '">
                <div class="gallery-image-wrap">
                    <a data-featherlight="' . $image_url . '" data-gallery="gallery" href="#">
                        <img src="' . $image_url . '" alt="" class="img-fluid">
                        <p class="wp-caption caption">' . $caption->post_excerpt . '</p>
                    </a>
                </div>
            </div>';
	}
	$return .= '</div>';

	return $return;
}

add_filter( 'post_gallery', 'basis_gallery', 99, 3 );

add_image_size( 'basis-admin-post-featured-image', 50, 50, true );
add_image_size( 'basis-announcement', 510, 340, true );
add_image_size( 'basis-flex', 420, 280, true );
add_image_size( 'basis-staff', 480, 720, true );
add_image_size( 'basis-project', 480, 330, true );

add_filter( 'manage_posts_columns', 'basis_add_post_admin_thumbnail_column', 2 );
add_filter( 'manage_pages_columns', 'basis_add_post_admin_thumbnail_column', 2 );

function basis_add_post_admin_thumbnail_column( $columns ) {
	return [ 'featured' => 'Featured Image' ] + $columns;
}

add_action( 'manage_posts_custom_column', 'basis_show_post_thumbnail_column', 5, 2 );
add_action( 'manage_pages_custom_column', 'basis_show_post_thumbnail_column', 5, 2 );

function basis_show_post_thumbnail_column( $columns, $id ) {
	switch ( $columns ) {
		case 'featured':
			if ( function_exists( 'the_post_thumbnail' ) ) {
				the_post_thumbnail( 'basis-admin-post-featured-image' );
			} else {
				echo 'not found';
			}
			break;
	}
}

add_action( 'admin_head', 'basis_column_width' );

function basis_column_width() {
	echo '<style type="text/css">';
	echo '.column-featured { text-align: center; width:110px; overflow:hidden }';
	echo '</style>';
}

function modify_staff_archive( $query ) {
	if ( (!is_admin() && $query->is_main_query() && is_post_type_archive( 'staff' )) OR ($query->is_main_query() && is_tax('department')) ) {
		$query->set( 'nopaging', 1 );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}
}

add_action( 'pre_get_posts', 'modify_staff_archive' );

function modify_project_archive( $query ) {
	if ( $query->is_main_query() && is_post_type_archive( 'project' ) ) {
		$query->set( 'nopaging', 1 );
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}

add_action( 'pre_get_posts', 'modify_project_archive' );

/**
 * Get taxonomies terms links.
 *
 * @see get_object_taxonomies()
 */
function single_taxonomy_terms_link( $post_id = '', $taxonomy_slug ) {

	$post_id = $post_id == '' ? $post_id : get_the_ID();

	if ( ! $post_id ) {
		return '';
	}

	$terms = get_the_terms( $post_id, $taxonomy_slug );

	if ( ! empty( $terms ) ) {
		return sprintf( '<a class="text-secondary d-block term-%3$s text-white" href="%1$s">%2$s</a>',
			esc_url( get_term_link( $terms[0]->slug, $taxonomy_slug ) ),
			esc_html( $terms[0]->name ), $taxonomy_slug
		);
	}
}
