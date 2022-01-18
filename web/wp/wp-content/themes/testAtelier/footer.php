
<?php wp_footer() ?>

<footer>
    <?= wp_nav_menu(['theme_location' => 'footer',
                         'container' => false,
                         'menu_class' => 'navbar-nav me-auto'
                        ]);?>
</body>
</footer>

</html>