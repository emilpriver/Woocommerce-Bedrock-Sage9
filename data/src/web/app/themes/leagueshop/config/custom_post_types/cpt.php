<?php 
/**
 * Custom Post Types
 */

if ( ! function_exists( 'create_post_type' ) ) :

  function create_post_type() {

    $cpts = array(
      array(
        'value' => 'streamers',
        'label' =>  'Streamers'
      ),
      array(
        'value' => 'designers',
        'label' => 'Designers'
      )
    );

    foreach($cpts as $item):
      register_post_type( $item['value'], 
          array(
            'labels' => array(
                'name' => __( $item['label'] ), 
                'singular_name' => __( $item['label'] ), 
            ),
            'show_in_rest' => true,
            'public' => true,
            'supports' => array ( 'title', 'thumbnail'), 
            'taxonomies' => array( 'category', 'post_tag' ), 
            'hierarchical' => true,
            'rewrite' => array ( 'slug' => __( $item['value'] ) ) 
          )
      );
    endforeach;

  }

  add_action( 'init', 'create_post_type' );

endif; 
