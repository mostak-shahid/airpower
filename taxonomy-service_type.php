<?php 
global $airpower_options;
$from_theme_option = $airpower_options['general-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_airpower_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
$taxonomy = get_queried_object();
$image_id = carbon_get_term_meta( $taxonomy->term_id, 'service_type_image' );
//var_dump($term = get_term( $taxonomy->term_id,  ))description
?>
<?php get_header() ?>
<?php 
 
$class = $airpower_options['sections-content-class'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_content', $page_details ); 
?>
<section id="page" class="page-content <?php if(@$airpower_options['sections-content-background-type'] == 1) echo @$airpower_options['sections-content-background'] . ' ';?><?php if(@$airpower_options['sections-content-color-type'] == 1) echo @$airpower_options['sections-content-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
			<?php do_action( 'action_before_content', $page_details  ); ?>
                <div class="row">
                    <div class="col-lg-9">
                        <?php if ($image_id) : ?>
                            <div class="img-part mb-4">                           
                                <?php $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);?>
                                <img src="<?php echo wp_get_attachment_url($image_id);?>" alt="<?php echo $image_alt ?>" class="img-fluid img-service-type">
                            </div>
                        <?php endif;?>
                        <div class="text-part">                            
					        <?php echo $taxonomy->description?>                        
                        </div>
                    </div>
                    <div class="col-lg-3">					    
                        <?php if ( is_active_sidebar( 'sidebar-service' ) ) : ?>
                            <?php dynamic_sidebar( 'sidebar-service' ); ?>
                        <?php endif; ?>                       
                    </div>
                </div>
			<?php do_action( 'action_after_content', $page_details  ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_content', $page_details  ); ?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>