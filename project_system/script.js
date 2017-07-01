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