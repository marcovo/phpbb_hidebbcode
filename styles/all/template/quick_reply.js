$(document).ready(function (e) {
	// If we are on viewtopic and parts of posts are hidden, we'll need to refresh the page if a post is submitted through AJAX (QuickReply)
	$('#qr_postform').on('ajax_submit_success', function (e) {
		location.reload(true);
	});
});
