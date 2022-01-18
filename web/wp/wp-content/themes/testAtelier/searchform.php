<form class="d-flex" action="<?= esc_url(home_url('/')); ?>">
        <input name="s" class="form-control me-2 search-form" type="search" placeholder="Ex : 4546843541567541" aria-label="Search" value="<?= get_search_query(); ?>">
        <button class="btn btn-success" type="submit">Rechercher</button>
</form>