<?php 
global $airpower_options;
if (is_home()) $page_id = get_option( 'page_for_posts' );
else $page_id = get_the_ID();

$from_theme_option = $airpower_options['archive-page-sections'];
$from_page_option = get_post_meta( $page_id, '_airpower_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
unset($sections['content']);
?><?php get_header() ?>
<section id="archive" class="page-content <?php if(@$airpower_options['sections-content-background-type'] == 1) echo @$airpower_options['sections-content-background'] . ' ';?><?php if(@$airpower_options['sections-content-color-type'] == 1) echo @$airpower_options['sections-content-color'];?>">
	<div class="content-wrap">
		<div class="container">
			<?php if ( have_posts() ) :?>
				<div id="blogs" class="row">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-lg-6 mb-30">
                            <div <?php post_class() ?>>
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) :
                                    the_post_thumbnail( 'medium_large', ['class' => 'img-fluid mb-4'] );
                                    endif;?>
                                </a>
                                <h2 class="header"><a href="<?php echo get_the_permalink(); ?>" class="text-dark"><?php echo get_the_title() ?></a></h2>
                                <div class="content">
                                    <p><?php echo wp_trim_words( strip_shortcodes(get_the_content()), 55, '...' ) ?></p>
                                    <a class="btn btn-theme-blue btn-readmore" href="<?php echo get_the_permalink(); ?>">Read More</a>
                                </div>
                            </div>						
							<?php //get_template_part( 'content', get_post_format() ) ?>
						</div>
					<?php endwhile;?>						
				</div>
				<div class="pagination-wrapper">
				<?php
					the_posts_pagination( array(
						'show_all' => false,
						'screen_reader_text' => " ",
						'prev_text'          => 'Prev',
						'next_text'          => 'Next',
					) );
				?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>			
		</div>	
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>