// This code can hotswap local pages
// Requires server to support prepending /raw to strip out headers/footers
$(document).ready(function() {
	$('a[href^="/"]').click(function(event) {
		event.preventDefault();
		$.ajax({
			url: '/raw' + $(event.target).attr('href')
		}).done(
			function(data, status){
				$('.main').html(data);
			}
		).fail(
			function() {
				window.location.assign($(event.target).attr('href'));
			}
		);
	});
});
