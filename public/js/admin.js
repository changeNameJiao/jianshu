$.ajaxSetup({
	'headers': {
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	}
})
$(".post-audit").click(function(event){
	var target = $(event.target);
	var post_id = target.attr('post-id');
	var status = target.attr('post-action-status');
	$.ajax({
		url : "/admin/posts/" + post_id + "/status",
		method : 'POST',
		data : status,
		dataType : 'json',
		success : function(e){
			if(e.error !=0){
				alert('审核失败');
				return;
			}
			window.location.href('/admin/posts');
		}
	});
});