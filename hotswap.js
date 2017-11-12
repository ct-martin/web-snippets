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
				var pgTitle = $(event.target).attr('href').substr(1).replace("-", " ").split("/").reverse().join(" - ").replace(/\b[a-z]/g, function(ch) {return ch.toUpperCase();}).trim();
				if(pgTitle == "") pgTitle = 'Home';
				window.history.pushState({
					"html": data,
					"title": pgTitle
				},"", $(event.target).attr('href'));
				document.title = pgTitle + " | YOUR SITE NAME";
			}
		).fail(
			function() {
				window.location.assign($(event.target).attr('href'));
			}
		);
	});
	window.onpopstate = function(evt){
		if(evt.state){
			$('.main').html(evt.state.html);
			document.title = evt.state.title + " | YOUR SITE NAME";
		}
	};
});
