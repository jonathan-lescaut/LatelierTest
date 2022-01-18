<?php
/**
 * Template Name: Page avec bannière
 */
?>

<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<h1><?= the_title() ?></h1>


<?= the_content()?>
<p>Ici la bannière</p>
        
        <?php endwhile; endif; ?> 
                            
<?php get_footer() ?>