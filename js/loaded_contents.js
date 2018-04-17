

function Load_external_content()
{
	$('#external_page_content_displayer').load('reply.php').hide().fadeIn(1000);
}
setInterval('Load_external_content()', 3000);