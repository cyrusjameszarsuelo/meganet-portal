(function($) {

	"use strict";

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			$this.find('.dropdown-menu').removeClass('show');
	});

})(jQuery);

Pusher.logToConsole = true;
const pusher = new Pusher('047b0eba82853a25a0ce', {
    cluster: 'ap1'
});


var channel = pusher.subscribe('mention');
channel.bind('mention-event', function(data) {
	let notification = `<a class="dropdown-item notification show" style="margin: 15px 0px;" href="/our-business-and-subsidiaries">Someone mentioned you in the banner: "${data.message}" </a>`;
  $('.notification').prepend(notification);
});