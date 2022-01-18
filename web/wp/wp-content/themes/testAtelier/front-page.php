<?php get_header() ?>

<?php while (have_posts()) : the_post() ?>

    <div class="container-fluid section1">

        <div class="content">

            <h1><?= get_field('titre') ?></h1>
            <div class="text">
                <?= get_field('texte') ?>
            </div>

            <div class="searchBloc">

                <div class="sousSearchBloc">

                    <div class="sous-titre">
                        <div class="sous-titre-lien">
                            <a href="#"><?= get_field('sous-titre1') ?></a>
                        </div>
                        <div class="sous-titre-lien">
                            <a href="#"><?= get_field('sous-titre2') ?></a>
                        </div>
                        <div class="sous-titre-lien">
                            <a href="#"><?= get_field('sous-titre3') ?></a>

                        </div>
                    </div>

                    <div class="conseil">
                        <?= get_field('conseil-recherche') ?> <span class="rond">?</span>
                    </div>

                    <div class="search">
                        <?= get_search_form() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- <a href="<?= get_post_type_archive_link('post') ?>">Voir les dernières actualités</a> -->
    </div>

    <div class="container-fluid section2">

        <div class="titreSection2"><?= get_field('titre-carrousel') ?></div>
        <div class="textSection2"><?= get_field('text-carrousel') ?></div>



        <div class="owl-carousel blocCaroussel">
            <?php
            $array = get_field('caroussel');
            foreach ($array as $key => $value) { ?>
                <img class="imgCaroussel" src="../../../../app/uploads/2022/01/<?= $array[$key]['filename'] ?>" alt="logo-caroussel">
            <?php } ?>
        </div>

        <div class="boutonSection2"><?= get_field('bouton-carrousel') ?></div>

    </div>



<?php endwhile; ?>



<?php get_footer() ?>