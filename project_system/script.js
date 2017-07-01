$(document).ready(function(){
	ModalHide();
});
function ModalHide(){
	$(".blackout").hide();
}
function AddTask(){
	$(".add-task").show();
}
function TaskDetail(){
	$(".task-detail").show();
}
function AddProject(){
	$(".add-project").show();
}
$(document).click(function(e){
	if ($(e.target).parents().filter('div.blackout:visible').length != 1 && !$(e.target).hasClass('link-toggle-popup')) {
		$('div.blackout').hide();
	}
});


//$(document)
//	.on('click', '.modal__btn-close', function(e){ $('div.blackout').hide(); })
//	.on('click', '.modal', function(e){ return false; })
//	.on('click', '.blackout', function(e){ $('div.blackout').hide(); })
//;