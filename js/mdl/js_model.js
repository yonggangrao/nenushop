

function show_reply(parent, data)
{
	var html = '<li>';
	html +=  '回复' + data.username + '： '  + data.contents;
	html += '</li>';
	html += '<li class="li-other-info">';
	html += '<span class="span-other-info">' + data.time + '</span>';
	html += '</li>';
	parent.prepend(html);
}

function hide_reply_area($this)
{
	$this.parents('.action').remove();
}


function add_reply_area(parent)
{
	var ul_reply = parent.find('.ul-reply');

	if(ul_reply.length == 0)
	{
		var html = '<ul class="ul-reply"></ul>';
		parent.append(html);
	}
	ul_reply = parent.children('.ul-reply');
	var child = ul_reply.find('.textarea-reply');
	if(child.length > 0)
	{
		return false;
	}
	
	var li_reply = '<li class="action">';
		li_reply += '<textarea class="textarea-reply"></textarea>';
		li_reply += '<a href="javascript:void(0);" class="a-reply">提交</a>';
		li_reply += '<a href="javascript:void(0);" class="a-cancel">取消</a>';
		li_reply += '</li>';	
	ul_reply.prepend(li_reply);
	
	return true;
}



