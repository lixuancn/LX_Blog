/**
 * JQ上传组件
 */

jQuery.fn.extend({
	upload:function(data){
		var upUrl = '/admin.php/upFiles/show';
		var actionUrl = data.action!=undefined ? data.action : "/admin.php/upFiles/save";
		var field = data.field;
		var path = data.path!=undefined ? data.path : 'app';
		this.each(function(){
			var dom = $(this);
			var domId = dom.attr('id');
			dom.after("<iframe style='display:none' src='"+upUrl+"'></iframe>");
			var iframe = dom.next('iframe');
			dom.bind('click', function(){
				iframe.contents().find('form').attr('action', actionUrl);
				iframe.contents().find('#field').attr('value', field);
				iframe.contents().find('#path').attr('value', path);
				iframe.contents().find('#dom').attr('value', domId);
				iframe.contents().find('#file').trigger('click');
			}).end();
		});
	}
});

/*
var re=function(data){}
$(document).ready(function(){
	re=function(data){
		data = eval(data);
		var dom = $('#' + data.dom);
		var field = $('#' + data.field);
		field.attr('value', data.url);
		dom.next('iframe').get(0).src = dom.next('iframe').get(0).src;
	}
});
*/
