<?php 
global $airpower_options; 
$class = $airpower_options['sections-about-class'];
$title = $airpower_options['sections-about-title'];
$content = $airpower_options['sections-about-content'];
$link = $airpower_options['sections-about-link'];
$media = $airpower_options['sections-about-media'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_about', $page_details ); 
?>
<section id="section-about" class="<?php if(@$airpower_options['sections-about-background-type'] == 1) echo @$airpower_options['sections-about-background'] . ' ';?><?php if(@$airpower_options['sections-about-color-type'] == 1) echo @$airpower_options['sections-about-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
		<?php do_action( 'action_before_about', $page_details ); ?>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">                    
                    <?php if ($title) : ?>				
                        <div class="title-wrapper wow fadeInDown">
                            <h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
                        </div>
                    <?php endif; ?>
                    <?php if ($content) : ?>				
                        <div class="content-wrapper wow fadeInUp"><?php echo do_shortcode( $content ) ?></div>
                    <?php endif; ?>
                    <?php if ($link['text_field_1'] && $link['text_field_2']) : ?>				
                        <div class="link-wrapper wow fadeInUp"><a href="<?php echo esc_url(do_shortcode($link['text_field_2'])) ?>" class="btn btn-theme-blue"><?php echo do_shortcode($link['text_field_1']) ?></a></div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <?php if($media) : ?>
                        <?php $image_alt = get_post_meta($media['id'], '_wp_attachment_image_alt', TRUE); ?>
                        <img src="<?php echo aq_resize(wp_get_attachment_url($media['id']),540,704,true) ?>" alt="<?php echo $image_alt ?>" class="img-fluid img-abouut" width="540" height="704">
                    <?php endif?>
                </div>
            </div>
		<?php do_action( 'action_after_about', $page_details ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_about', $page_details  ); ?>