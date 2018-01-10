<?php

//---------------------------------------------------//
//---- BASIC WORDPRESS SUPPORT ----------------------//
//---------------------------------------------------//

// Featured Images
add_theme_support( 'post-thumbnails' );

//---------------------------------------------------//
//---- ENQUEUE SCRIPTS AND STYLES -------------------//
//---------------------------------------------------//

function jordan_scripts() {
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/compiled_css/main.style.css' , false, filemtime( get_template_directory() . '/compiled_css/main.style.css' ), 'screen' );
    wp_enqueue_style( 'aos_style', get_template_directory_uri() . '/aos/aos.css' , false, filemtime( get_template_directory() . '/aos/aos.css' ), 'screen' );
	wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/font-awesome/font-awesome.min.css' , false, filemtime( get_template_directory() . '/font-awesome/font-awesome.min.css' ), 'screen' );
    wp_enqueue_script( 'aos_script', get_template_directory_uri() . '/aos/aos.js', array('jquery'), filemtime( get_template_directory() . '/aos/aos.js' ), false );
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/main.js', array('jquery'), filemtime( get_template_directory() . '/js/main.js' ), false );
}
add_action( 'wp_enqueue_scripts', 'jordan_scripts' );

//---------------------------------------------------//
//---- PAGE SLUG BODY CLASS -------------------------//
//---------------------------------------------------//

function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_name;
	}
	return $classes;
}

add_filter( 'body_class', 'add_slug_body_class' );

//---------------------------------------------------//
//---- REGISTER CUSTOM POST TYPES ------------------//
//--------------------------------------------------//

function case_study_custom_post_type() {
  $labels = [
    'name'               => _x( 'Case Studies', 'post type general name' ),
    'singular_name'      => _x( 'Case Study', 'post type singular name' ),
    'add_new'            => _x( 'Add New Case Study', '' ),
    'add_new_item'       => __( 'Add New Case Study' ),
    'edit_item'          => __( 'Edit Case Study' ),
    'new_item'           => __( 'New Case Study' ),
    'all_items'          => __( 'All Case Studies' ),
    'view_item'          => __( 'View Case Study' ),
    'search_items'       => __( 'Search Case Studies' ),
    'not_found'          => __( 'No case studies found' ),
    'not_found_in_trash' => __( 'No case studies found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Case Studies',
 ];
  $args = [
    'labels'        => $labels,
    'description'   => 'Holds our Case Study information',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => [ 'title', 'editor', 'thumbnail', 'order', 'page-attributes' ],
    'has_archive'   => true,
    'rewrite' => [ 'slug' => 'case-study' ],
    'hierarchical' => false,
  ];
  register_post_type( 'case-study', $args ); 
  flush_rewrite_rules();
}
add_action( 'init', 'case_study_custom_post_type' );

//---------------------------------------------------//
//---- CUSTOM ORDER CASE STUDIES --------------------//
//--------------------------------------------------//

function custom_order_case_studies($query) {
  if ( !is_admin() && $query->is_main_query() ) {

    if (is_post_type_archive('case-study')) {
      $query->set('orderby', 'date' );
      $query->set('order', 'ASC' );
    }

  }
}

add_action('pre_get_posts','custom_order_case_studies');

//-------------------------------------//
//---- ADVANCED CUSTOM FIELDS ---------//
//-------------------------------------//

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_case-study-fields',
        'title' => 'Case Study Fields',
        'fields' => array (
            array (
                'key' => 'field_58ae0845c9826a',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'textarea',
                'instructions' => 'Add the project title.',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array (
                'key' => 'field_58ae0808cca123',
                'label' => 'Tagline',
                'name' => 'tagline',
                'type' => 'text',
                'instructions' => 'Enter the tagline',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_58ae0808c98a33',
                'label' => 'Role',
                'name' => 'role',
                'type' => 'text',
                'instructions' => 'Enter the role played.',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_58ae0808c98a34',
                'label' => 'Date Completed',
                'name' => 'date_completed',
                'type' => 'text',
                'instructions' => 'Enter the completion date',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_58ae0808c9827',
                'label' => 'Short Name',
                'name' => 'short_name',
                'type' => 'text',
                'instructions' => 'Enter the short name',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'short name',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_58ae0823c9828',
                'label' => 'Brand Primary Color',
                'name' => 'brand_primary_color',
                'type' => 'color_picker',
                'instructions' => 'Add the brand\'s primary color.',
                'required' => 0,
                'default_value' => '',
            ),
            array (
                'key' => 'field_58ae0823c98ab',
                'label' => 'Color Two',
                'name' => 'color_two',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'default_value' => '',
            ),
            array (
                'key' => 'field_58ae0823c98ac',
                'label' => 'Color Three',
                'name' => 'color_three',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'default_value' => '',
            ),
            array (
                'key' => 'field_58ae0823c98ad',
                'label' => 'Color Four',
                'name' => 'color_four',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'default_value' => '',
            ),
            array (
                'key' => 'field_58ae0845c9829',
                'label' => 'Project Info',
                'name' => 'project_info',
                'type' => 'wysiwyg',
                'instructions' => 'Add the main project info.',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array (
                'key' => 'field_58ae087ec982a',
                'label' => 'Info Background Logo',
                'name' => 'info_background_logo',
                'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_58ae088fc982b',
                'label' => 'Mockup Image',
                'name' => 'mockup_image',
                'type' => 'image',
                'required' => 0,
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_58af87aa9bb3e',
                'label' => 'Tools',
                'name' => 'tools',
                'type' => 'checkbox',
                'choices' => array (
                    'css' => 'CSS',
                    'html' => 'HTML',
                    'javascript' => 'Javascript',
                    'sass' => 'Sass',
                    'git' => 'Git',
                    'creative-cloud' => 'Creative Suite',
                    'angular' => 'Angular.js',
                    'react' => 'React.js',
                    'wordpress' => 'Wordpress',
                    'drupal' => 'Drupal',
                    'vue' => 'Vue.js',
                    'knockout' => 'Knockout.js',
                ),
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_58ae0845a34d9',
                'label' => 'Responsibilities',
                'name' => 'responsibilities',
                'type' => 'wysiwyg',
                'instructions' => 'Add additional responsibilities.',
                'required' => 0,
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array (
                'key' => 'field_58af97a934d9s',
                'label' => 'Related Project',
                'name' => 'related_project',
                'type' => 'post_object',
                'post_type' => array (
                    0 => 'case-study',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'case-study',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
}
