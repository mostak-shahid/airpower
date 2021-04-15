<?php 
global $airpower_options; 
$subtitle = $airpower_options['sections-banner-subtitle'];
$title = $airpower_options['sections-banner-title'];
$link = $airpower_options['sections-banner-link'];
$select = $airpower_options['sections-banner-select'];
$slides = $airpower_options['sections-banner-details'];
$shortcode = $airpower_options['sections-banner-shortcode'];
$n = 1;
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_before_banner', $page_details );
?>
<section id="section-banner">
    <div class="container-fluid">
        <?php do_action( 'action_before_banner_loop', $page_details ); ?>
        <div class="row justify-content-end">
            <div class="col-xl-11">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="static-content-wrapper"> 
                            <?php if ($subtitle) : ?>				
                                <div class="subtitle-wrapper wow fadeInDown"><?php echo do_shortcode( $subtitle ) ?></div>
                            <?php endif; ?>                                               
                            <?php if ($title) : ?>				
                                <div class="title-wrapper wow fadeInUp">
                                    <h2 class="banner-title"><?php echo do_shortcode( $title ); ?></h2>				
                                </div>
                            <?php endif; ?>
                            <?php if ($link['text_field_1'] && $link['text_field_2']) : ?>				
                                <div class="link-wrapper wow fadeInUp"><a href="<?php echo esc_url(do_shortcode($link['text_field_2'])) ?>" class="btn btn-theme-blue"><?php echo do_shortcode($link['text_field_1']) ?></a></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">	
                        <?php if ($select == 'shortcode' ) : ?>
                            <?php echo do_shortcode( $shortcode ); ?>
                        <?php else : ?>
                            <div <?php if ( $select == 'banner' ) echo 'class="static-banner"'; else echo 'id="section-banner-owl" class="owl-carousel owl-theme"';   ?>>
                                <?php foreach ($slides as $slide) : ?>
                                    <div class="wrapper">
                                        <?php echo wp_get_attachment_image( $slide["attachment_id"], 'full', false, array( 'class' => 'img-fluid img-banner', 'alt' => $alt_tag['inner'] . strip_tags(do_shortcode( $slide["title"] )) )) ?>
                                        <?php do_action( 'action_before_banner_content', $page_details ); ?>
                                        <div class="banner-content">
                                                <div class="banner-text">
                                                    <?php if ($slide["title"]) : ?>
                                                    <h2 class="banner-title"><?php echo do_shortcode( $slide["title"] ) ?></h2>
                                                    <?php endif; ?>
                                                    <?php if ($slide["description"]) : ?>
                                                    <div class="banner-desc">
                                                        <?php echo do_shortcode(  $slide["description"] )?>					
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if($slide["link_url"] AND $slide["link_title"]) : ?>
                                                        <a class="btn btn-outline-light rounded-0 mt-3" href="<?php echo do_shortcode( $slide["link_url"] ) ?>" <?php if ($slide["target"]) echo 'target="_blank"'; ?>><?php echo do_shortcode( $slide["link_title"] )?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>	
                                        <?php do_action( 'action_after_banner_content', $page_details ); ?>
                                        <?php if ($select == 'banner' AND $n==1) break; $n++; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

	
                    </div>
                </div>
            </div>
        </div>
        <?php do_action( 'action_after_banner_loop', $page_details ); ?>
    </div>
</section>
<?php do_action( 'action_after_banner', $page_details ); ?>