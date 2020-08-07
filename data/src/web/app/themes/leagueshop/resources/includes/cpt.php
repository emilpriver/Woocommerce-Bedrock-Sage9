<?php 

// Register Custom post Types
if ( ! function_exists( 'create_post_type' ) ) :

    function create_post_type() {
        
        // Streamers Custom post type
        register_post_type( 'streamers', 
            array(
                'labels' => array(
                    'name' => __( 'Streamers' ), 
                    'singular_name' => __( 'Streamers' ), 
                ),
                'show_in_rest' => true,
                'public' => true,
                'supports' => array ( 'title', 'thumbnail'), 
                'taxonomies' => array(), 
                'hierarchical' => true,
                'rewrite' => array ( 'slug' => __( 'streamers' ) ) 
            )
        );

        // Designers custom post types
        register_post_type( 'designers', 
            array(
                'labels' => array(
                    'name' => __( 'Designers' ), 
                    'singular_name' => __( 'Designers' ), 
                ),
                'show_in_rest' => true,
                'public' => true,
                'supports' => array ( 'title', 'thumbnail'), 
                'taxonomies' => array(), 
                'hierarchical' => true,
                'rewrite' => array ( 'slug' => __( 'designers' ) ) 
            )
        );
    
    }
    add_action( 'init', 'create_post_type' );
    
endif;