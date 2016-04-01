$(document).ready(function(){
	$("nav > p").not($('a')).click(function(){
		$(this).next('div').slideToggle(100);
	});
	$('nav > p > a').click(function(e){
		e.stopPropagation();
	});
	$('.sidebar').perfectScrollbar();

	$('.main-content').intabs({
        tab_element: '.panel-tab li a',
        current_class: 'active'
    });
    var all_checked = false;
    $(":checkbox").click(function() {
        var table = $(this).parents("table");
        if($(this).attr("class") === "table-all") {
            table.find(":checkbox").prop("checked", !all_checked);
            all_checked = !all_checked;
        }
        else {
            table.find(":checkbox[class!=table-all]").each(function (i) {
                if(!$(this).is(":checked")) {
                    table.find(".table-all").prop("checked", false);
                    all_checked = false;
                    return false;
                }
                $(".table-all").prop("checked", true);
                all_checked = true;
            });
        }
    });

    //点击alert隐藏
    $('body').on('click', '.alert-close,.message-close', function(){
        $(this).closest('.alert,.message-line').hide("fast").remove();
    });
    $('.message-wrap').on('click', '.message', function(){
        $(this).hide("fast").remove();
    });

    $(document).on($.modal.AJAX_SEND, function(){
        progressBar.reset();
        progressBar.start();
    });
    $(document).on($.modal.AJAX_COMPLETE, function(){
        progressBar.stop();
    });
});
//显示一个message
window.show_message = function(content, type){
    var type = arguments[1] ? arguments[1] : 'primary';
    var html = '<div class="message message-' + type + '" style="display:block">' + content + '</div>'
    $('.message-wrap').prepend(html);
}
//显示一个alert
window.show_alert = function(content, position, type, isClose){
    var position = arguments[1] ? arguments[1] : 'body';
    var type = arguments[2] ? arguments[2] : 'primary';
    var isClose = arguments[3] === false ? false : true;
    var html = '<div class="alert alert-' + type + '">';
    if(isClose){
        html += '<p class="alert-close"><i class="fa fa-times"></i></p>';
    }
    html += content +'</div>';
    $(position).prepend(html);
}
var progressBarOptions = {
    id: 'top-progress-bar',
    color: '#F44336',
    height: '2px',
    duration: 0.5
}
window.progressBar = new ToProgress(progressBarOptions);