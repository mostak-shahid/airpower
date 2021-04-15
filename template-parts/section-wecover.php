<?php 
global $airpower_options; 
$class = $airpower_options['sections-wecover-class'];
$title = $airpower_options['sections-wecover-title'];
$content = $airpower_options['sections-wecover-content'];
$select = $airpower_options['sections-wecover-select'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_wecover', $page_details ); 
?>
<section id="section-wecover" class="<?php if(@$airpower_options['sections-wecover-background-type'] == 1) echo @$airpower_options['sections-wecover-background'] . ' ';?><?php if(@$airpower_options['sections-wecover-color-type'] == 1) echo @$airpower_options['sections-wecover-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
		<?php do_action( 'action_before_wecover', $page_details ); ?>
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
					<?php foreach( $select as $post_id ) : ?>
                        <?php                        
                        $image_id = get_post_meta( $post_id, '_airpower_page_section_image', true );
                        $icon_id = get_post_meta( $post_id, '_airpower_page_section_icon', true );
                        ?>
					    <div class="col-lg-4 wow fadeInLeft">
                            <div class="type-wrapper text-center" data-target="type-<?php echo $post_id ?>">
                                <?php if ($image_id) : ?>
                                    <div class="img-part">
                                    <img src="<?php echo aq_resize($image_id,330,240,true);?>" alt="<?php echo get_the_title($post_id) ?>" width="330" height="240" class="img-fluid img-type-feature">
                                    </div>
                                <?php endif; ?>
                                <div class="hover-part">
                                <?php if ($icon_id) : ?>
                                    <div class="icon-part bg-theme-yellow d-inline-block">
                                    <img src="<?php echo aq_resize($icon_id,45,45,true);?>" alt="<?php echo get_the_title($post_id) ?>" width="45" height="45" class="img-fluid img-type-icon">
                                    </div>
                                <?php endif; ?>
                                <h3 class="title-part"><?php echo get_the_title($post_id)?></h3>
                                </div>
                            </div>
					    </div>
					<?php endforeach;?>
					</div>
					<div class="post-wrapper">
					    <?php
                        $n = 0;
                        foreach( $select as $post_id ) :
                            $args = array(
                                'post_type'=>'page',
                                'post_parent' => $post_id,
                                'posts_per_page' => 5,
                            );
                            $query = new WP_Query( $args );
                            if ( $query->have_posts() ) : ?>
                                <div id="type-<?php echo $post_id?>" class="row type-posts <?php if(!$n) echo 'active' ?>">
                                <?php while ( $query->have_posts() ) : $query->the_post();?>
                                    <?php $service_icon = carbon_get_the_post_meta( 'service_icon' ); ?>
                                    <div class="col mt-4">
                                        <div class="type-post-wrapper text-center bg-theme-yellow position-relative">  
                                            <?php if ($icon_id) : ?>
                                                <?php $icon_id = get_post_meta( get_the_ID(), '_airpower_page_section_icon', true );?>
                                                <img src="<?php echo aq_resize($icon_id,45,45,true);?>" alt="<?php echo get_the_title($post_id) ?>" width="45" height="45" class="img-fluid img-type-post-icon">
                                            <?php endif; ?>                                          
                                            <div <?php post_class()?>><h4 class="type-posts-title text-white"><?php echo get_the_title()?></h4></div>
                                        </div>
                                        <a href="<?php echo get_the_permalink() ?>" class="hidden-link">Read More</a>
                                    </div>
                                <?php endwhile;?>
                                </div>
                            <?php endif;?>
                            <?php wp_reset_postdata();?>
                            <?php $n++?>
                        <?php endforeach;?>
					</div>
					
				<?php endif; ?>
		<?php do_action( 'action_after_wecover', $page_details ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_wecover', $page_details  ); ?>