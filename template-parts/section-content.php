<?php 
global $airpower_options; 
$class = $airpower_options['sections-content-class'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
$sidebar = get_post_meta(get_the_ID(), '_airpower_sidebar', true);
do_action( 'action_avobe_content', $page_details ); 
?>
<section id="page" class="page-content <?php if(@$airpower_options['sections-content-background-type'] == 1) echo @$airpower_options['sections-content-background'] . ' ';?><?php if(@$airpower_options['sections-content-color-type'] == 1) echo @$airpower_options['sections-content-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
			<?php do_action( 'action_before_content', $page_details  ); ?>
					<?php if ( have_posts() ) :?>
						<?php while ( have_posts() ) : the_post(); ?>
						    <?php if ($sidebar == 'on') : ?>						    
                                <div class="row">
                                    <div class="col-lg-8"><?php get_template_part( 'content', 'page' ) ?></div>
                                    <div class="col-lg-4"><?php get_sidebar( 'page' ); ?></div>
                                </div>
                            <?php else : ?>
                                <?php get_template_part( 'content', 'page' ) ?>
						    <?php endif?>
						<?php endwhile;?>	
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif;?>
			<?php do_action( 'action_after_content', $page_details  ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_content', $page_details  ); ?>