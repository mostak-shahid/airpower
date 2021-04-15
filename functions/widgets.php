<?php
//Add widgets area
function airpower_widgets_init(){
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Sidebar for Post', 'airpower'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'sidebar-page',
		'name' => __('Sidebar for Page', 'airpower'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));
	register_sidebar(array(
		'id' => 'sidebar-service',
		'name' => __('Sidebar for Service', 'airpower'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));
	register_sidebar(array(
		'id' => 'sidebar-shop',
		'name' => __('Sidebar for Shop', 'airpower'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_1',
		'name' => __('Footer Column 1', 'airpower'),
		'description' => __('Add widgets here to appear in your Footer Column 1', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_2',
		'name' => __('Footer Column 2', 'airpower'),
		'description' => __('Add widgets here to appear in your Footer Column 2', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_3',
		'name' => __('Footer Column 3', 'airpower'),
		'description' => __('Add widgets here to appear in your Footer Column 3', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_4',
		'name' => __('Footer Column 4', 'airpower'),
		'description' => __('Add widgets here to appear in your Footer Column 4', 'airpower'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );	
	if( is_plugin_active( 'formidable/formidable.php' ) ) {
		register_widget( 'Mos_Formadable_Form' );	
	}	

}
add_action('widgets_init', 'airpower_widgets_init');
class Mos_Formadable_Form extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mos-formadable-form', // Base ID
			__( 'Mos Formidable Form' ), // Name
			array( 
				'description' => __( 'Formadable Form widgets with custom heading' ), 
				'classname' => 'widget_mos_formadable_form'
			) // Args
		);
	}
	public function widget( $args, $instance ) {
		?>
		<?php echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
			<div class="widget_mos_formadable_form_unit">
				<h6>Get A Free Quote Or</h6>
				<h2 class="form-title">Call Us On <?php echo do_shortcode("[phone index=1]") ?></h2>
				<?php if ($instance['form']) : ?>
				<div class="form-container">
						<?php echo FrmFormsController::get_form_shortcode( array( 'id' => $instance['form'], 'title' => false, 'description' => false ) ); ?>
				</div>
				<?php endif; ?>

			</div>
		<?php echo $args['after_widget'] ?>
<?php
	}
	public function form( $instance ) {
		?>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo __( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>">
			</p>
		</div>
		<div>
			<p>
			<?php $forms = get_formadable_form_list();?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>"><?php echo __( 'Form:' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form' ) ); ?>" >
			<?php foreach ($forms as $key => $value) : ?>
				<option value="<?php echo $key ?>" <?php selected( $instance['form'], $key ) ?>><?php echo $value ?></option>
			<?php endforeach; ?>
			</select>			
			</p>
		</div>
		<?php 
	}
	//Save form data into database *Necessary if you want to modify the input values
	// public function update( $new_instance, $old_instance ) {
	// 	$instance = array();
	// 	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	// 	$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
	// 	$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';

	// 	return $instance;
	// }

}