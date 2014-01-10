$().ready(function(){
	$("input[name='op']").click(function(){
        $("input[name='op']").each(function(){
            if($(this).attr("checked")){ 
            	$("#listform").attr('action',$(this).val());
            }
        });
	});
	$("#check_button").click(function(){
		var chk = $("#check_button").attr("checked");
		$("#box table").find("input[name='ids[]']").each(function(){
    		if(chk) { 
        		$(this).attr("checked","checked");
        		$(this).parent().parent().css("background","#FFFFCC");
        	} else { 
            	$(this).removeAttr("checked");
            	$(this).parent().parent().css("background","#FFFFFF");
            }
		});
	});
	$("#box table").find("input[name='ids[]']").click(function(){
		if($(this).attr("checked")) $(this).parent().parent().css("background","#FFFFCC");
		else $(this).parent().parent().css("background","#FFFFFF");
	});
	
});