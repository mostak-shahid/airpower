<?php 
global $airpower_options; 
$class = $airpower_options['sections-showcase-class'];
$title = $airpower_options['sections-showcase-title'];
$content = $airpower_options['sections-showcase-content'];
$select = $airpower_options['sections-showcase-select'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_showcase', $page_details ); 
?>
<section id="section-showcase" class="<?php if(@$airpower_options['sections-showcase-background-type'] == 1) echo @$airpower_options['sections-showcase-background'] . ' ';?><?php if(@$airpower_options['sections-showcase-color-type'] == 1) echo @$airpower_options['sections-showcase-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
		<?php do_action( 'action_before_showcase', $page_details ); ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper text-center wow fadeInDown">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper text-center wow fadeInUp"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php if (sizeof($select)) : ?>				
					<div class="select-wrapper row">
                        <?php foreach( $select as $post_id) : ?>
                            <?php if (has_post_thumbnail($post_id)) : ?>
                                <div class="col-lg-4 mb-30 wow fadeInLeft">
                                    <div class="showcase-unit position-relative">
                                        <?php $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE); ?>
                                        <img src="<?php echo aq_resize(get_the_post_thumbnail_url($post_id),350,330,true) ?>" alt="<?php echo $image_alt?>" class="img-fluid img-showcase" width="350" height="330">
                                        <h4 class="showcase-title text-center smooth"><?php echo get_the_title($post_id)?></h4>
                                        <a href="<?php echo get_the_permalink($post_id)?>" class="hidden-link">Read More...</a>
                                    </div>
                                </div>
                            <?php endif?>
                        <?php endforeach;?>
					</div>
				<?php endif; ?>
		<?php do_action( 'action_after_showcase', $page_details ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_showcase', $page_details  ); ?>