$.ajaxSetup({
	'headers': {
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	}
})

//文章审核操作
$(".post-audit").click(function(event){
	var target = $(event.target);
	var post_id = target.attr('post-id');
	var data = target.attr('post-action-status');
	$.ajax({
		url : "/admin/posts/" + post_id + "/status",
		method : 'POST',
		data : {'status':data},
		dataType : 'json',
		success : function(e){
			if(e.error != 0){
				alert('审核失败');
				return;
			}else{
				window.location.reload();			
			}
		}
	});
});

//删除专题操作
$('.resource-delete').click(function(event){
	if(confirm('确定执行删除操作吗？') == false){
		return;
	}
	var target = $(event.target);
	var url = target.attr('delete-url');
	$.ajax({
		url : url,
		method : 'POST',
		data : {'_method':'DELETE'},
		dataType : 'json',
		success : function(e){
			if(e.error != 0){
				alert('专题删除失败');
				return;
			}else{
				window.location.reload();
			}
		}
	})
});