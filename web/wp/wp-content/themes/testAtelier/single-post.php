<?php get_header() ?>


<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        <h1><?= the_title() ?></h1>
        <p>
            <img src="<?=the_post_thumbnail_url()?>?>" alt="img" style="width:100%; height:auto;">
        </p>
        

        <?= the_content()?>
        
        <?php endwhile; endif; ?> 


                            
<?php get_footer() ?>