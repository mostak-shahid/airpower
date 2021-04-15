<?php 
global $airpower_options; 
$class = $airpower_options['sections-cta-class'];
$title = $airpower_options['sections-cta-title'];
$content = $airpower_options['sections-cta-content'];
$shortcode = $airpower_options['sections-cta-shortcode'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_cta', $page_details ); 
?>
<section id="section-cta" class="<?php if(@$airpower_options['sections-cta-background-type'] == 1) echo @$airpower_options['sections-cta-background'] . ' ';?><?php if(@$airpower_options['sections-cta-color-type'] == 1) echo @$airpower_options['sections-cta-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
		<?php do_action( 'action_before_cta', $page_details ); ?>
                    <?php if ($title) : ?>				
                        <div class="title-wrapper text-center wow fadeInDown">
                            <h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
                        </div>
                    <?php endif; ?>
                    <?php if ($content) : ?>				
                        <div class="content-wrapper text-center wow fadeInUp"><?php echo do_shortcode( $content ) ?></div>
                    <?php endif; ?>            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php if ($shortcode) : ?>				
                        <div class="shortcode-wrapper text-center wow fadeInUp"><?php echo do_shortcode( $shortcode ) ?></div>
                    <?php endif; ?>                    
                </div>
            </div>
		<?php do_action( 'action_after_cta', $page_details ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_cta', $page_details  ); ?>