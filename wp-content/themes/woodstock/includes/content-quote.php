<?php
    $tdl_options = woodstock_global_var();
    $quote = get_field('tdl_quote_text');
    $author = get_field('tdl_quote_author');

    $blog_with_sidebar = "";
    if ( (isset($tdl_options['tdl_single_blog_layout'])) && ($tdl_options['tdl_single_blog_layout'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];   
?>

<div class="row">
            
	<?php if ( $blog_with_sidebar == "yes" ) : ?>
        <div class="large-12 columns">
    <?php else : ?>
        <div class="large-8 large-centered columns without-sidebar">
    <?php endif; ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <header class="entry-header">
                
                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail(array(130,130)); ?>
                </div>
                <?php endif; ?>
        
            </header><!-- .entry-header -->
            
            <div class="entry-content">

            <?php 
             echo '<blockquote>';
                echo '<p><span class="quote-left"></span>';
                    echo esc_attr($quote);
                echo '<span class="quote-right"></span></p>';
                if ($author)
                    echo '<cite>' . $author . '</cite>';
            echo '</blockquote>';           

             ?>           
                <?php
                if( ($post->post_excerpt) && (!is_single()) ) {
                    the_excerpt();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e('Continue reading &rarr;', 'woodstock'); ?></a>
                <?php
                } else {
                    the_content( esc_html__( 'Continue reading &rarr;', 'woodstock' ) );
                }
                ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'woodstock' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
            </div><!-- .entry-content -->
        
            <?php if ( is_single() ) : ?>
                 <?php if ( (isset($tdl_options['tdl_blog_sharing_options'])) && ($tdl_options['tdl_blog_sharing_options'] == "1" ) ) : ?>
                    <?php woodstock_share(); ?>
                <?php endif; ?>           
			
                <footer class="entry-meta">
                    
                    <?php woodstock_entry_meta(); echo "."; ?>
                    <?php edit_post_link( esc_html__( 'Edit', 'woodstock' ), '<div class="edit-link">', '</div>' ); ?>
                    
                </footer><!-- .entry-meta -->
    
            <?php else : ?>
            
                <div class="post_header_date"><?php woodstock_post_header_entry(); ?></div>
                    
            <?php endif; ?>
            
        </article><!-- #post -->

    </div><!-- .columns -->
</div><!-- .row -->
