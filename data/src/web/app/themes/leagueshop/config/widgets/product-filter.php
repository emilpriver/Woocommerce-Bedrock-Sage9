<?php
/**
 * Custom ad widgets
 */

class product_filter_widget extends WP_Widget  {

    public function __construct() {
        $widget_options = array( 
          'classname' => 'sidebar_ad_widget',
          'description' => 'Woocommerce product filter',
        );
        parent::__construct( 'product_filter', 'Woocommerce product filter', $widget_options );
    }

    /**
     * Output in frontend
     */
    public function widget( $args, $instance ) { 
      $show_size = !empty( $instance['show_size'] ) ? $instance['show_size'] : true;
      $show_colors = !empty( $instance['show_colors'] ) ? $instance['show_colors'] : true;
      $show_cat = !empty( $instance['show_cat'] ) ? $instance['show_cat'] : true;
      ?> 
      <?php if($show_size == 'true'){ ?> 
        <div class="filter-col sizes-col">
          <div class="meta">
            <h3>Sizes</h3>
            <span>
              <box-icon name='down-arrow'></box-icon>
            </span>
          </div>
          <div class="wrapper sizes with-columns-selectors">
            <?php if(!empty(get_field('sizes','options'))):
              foreach(get_field('sizes','options') as $item): ?>
                <span data-active="false" class="block size-selector column" data-size="<?php echo $item['value']; ?>"> <?php echo $item['label']; ?></span>
              <?php endforeach; 
            endif ?>
          </div>
        </div>
      <?php } ?>
      <?php if($show_colors == 'true'){ ?> 
        <div class="filter-col color-col">
          <div class="meta">
            <h3>Colors</h3>
            <span>
              <box-icon name='down-arrow'></box-icon>
            </span>
          </div>
          <div class="wrapper with-columns-selectors colors">
            <?php if(!empty(get_field('colors','options'))):
              foreach(get_field('colors','options') as $item): ?>
                <span data-active="false" class="block color-selector column" data-color="<?php echo $item['color']; ?>"> <strong style="background: <?php echo $item['color']; ?>"></strong></span>
            <?php endforeach;
            endif; ?>
          </div>
        </div>
      <?php }; ?>
      <?php if($show_cat == 'true'){ ?> 
        <div class="filter-col categorys-col">
          <div class="meta">
            <h3>Categorys</h3>
            <span>
              <box-icon name='down-arrow'></box-icon>
            </span>
          </div>
          <div class="wrapper with-columns-selectors category">
            <?php 
            $terms = get_terms( array(
              'taxonomy' => 'product_cat',
              'hide_empty' => true,
            ));
            foreach($terms as $term){ ?>
              <span data-active="false" class="line cat-selector" data-cat="<?php echo $term->term_id; ?>"> <?php echo $term->name; ?></span>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    <?php }

    /**
     * Output for admin
     */
    public function form( $instance ) {
      $show_size = ! empty( $instance['show_size'] ) ? $instance['show_size'] : true;
      $show_colors = ! empty( $instance['show_colors'] ) ? $instance['show_colors'] : true;
      $show_cat = ! empty( $instance['show_cat'] ) ? $instance['show_cat'] : true;
      ?>
      <p>
        <span>Display Size filter?</span>
        <select name="<?php echo $this->get_field_name('show_size') ?>" class="widefat" > 
          <option value="true" <?php selected( $show_size, "true" ); ?>>Yes</option>
          <option value="false" <?php selected( $show_size, "false" ); ?>>No</option>
        </select>
      </p>  
      <p>
        <span>Display Colors filter?</span>
        <select name="<?php echo $this->get_field_name('show_colors') ?>" class="widefat" > 
          <option value="true" <?php selected( $show_colors, "true" ); ?>>Yes</option>
          <option value="false" <?php selected( $show_colors, "false" ); ?>>No</option>
        </select>
      </p> 
      <p>
        <span>Display Categorys filter?</span>
        <select name="<?php echo $this->get_field_name('show_cat') ?>" class="widefat" > 
          <option value="true" <?php selected( $show_cat, "true" ); ?>>Yes</option>
          <option value="false" <?php selected( $show_cat, "false" ); ?>>No</option>
        </select>
      </p>   
		<?php }

    /**
     * save
     */
    public function update( $new_instance, $old_instance ) {
		$instance = array();
    $instance['show_size'] = ( ! empty( $new_instance['show_size'] ) ) ? sanitize_text_field( $new_instance['show_size'] ) : '';
    $instance['show_colors'] = ( ! empty( $new_instance['show_colors'] ) ) ? sanitize_text_field( $new_instance['show_colors'] ) : '';
    $instance['show_cat'] = ( ! empty( $new_instance['show_cat'] ) ) ? sanitize_text_field( $new_instance['show_cat'] ) : '';
		return $instance;
	}

 }