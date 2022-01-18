

(function($) {
	$('.search-form').autocomplete({
		source: function(request, response) {
			$.ajax({
				dataType: 'json',
				url: AutocompleteSearch.ajax_url,
				data: {
					term: request.term,
					action: 'autocompleteSearch',
					security: AutocompleteSearch.ajax_nonce,
				},
				success: function(data) {
					response(data);
				}
			});
		},
		select: function(event, ui) {
			window.location.href = ui.item.link;
		},
	});
})(jQuery);