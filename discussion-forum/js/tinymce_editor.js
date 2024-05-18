
function startEditor(id) {
	tinymce.init({
		selector: "textarea#"+id,
		plugins: [
			"code ",
			"paste"
		],
		toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code ",
		menubar:false,
		statusbar: false,
		content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
		height: 200	
	});
}


$( document ).ready(function() {
	startEditor('message');	
	$(document).on('submit','#posts', function(event){		
		var formData = $(this).serialize();
		$.ajax({
                url: "action.php",
                method: "POST",              
                data: formData,
				dataType:"json",
                success: function(data) {					
					var html = $("#postHtml").html();					
					html = html.replace(/USERNAME/g, data.name);
					html = html.replace(/POSTDATE/g, data.post_date);
					html = html.replace(/POSTMESSAGE/g, data.message);
					html = html.replace(/POSTID/g, data.post_id);
					$(".posts").append(html).fadeIn('slow');
					tinymce.get('message').setContent('');
                }
        });		
		return false;
	});
	
	
	$('#postLsit').on('click','[id^=edit_]', function(event){
		var messageId = $(this).attr('id');
		var topicId = $(this).attr('data-topic-id');
		messageId = messageId.replace(/edit_/g, '');
		messageId = parseInt(messageId);
		tinymce.execCommand("mceRemoveEditor", true, messageId);
		startEditor(messageId);	
		setTimeout(function() {
			tinymce.get(messageId).setContent($("#post_message_"+messageId).html());
		}, 100);
		$("#editSection_"+messageId).removeClass('hidden');	
		$("#button_section_"+messageId).addClass('hidden');		
	});
	
	$('#postLsit').on('click','[id^=cancel_]', function(event){
		var messageId = $(this).attr('id');
		messageId = messageId.replace(/cancel_/g, '');
		tinymce.execCommand("mceRemoveEditor", true, messageId);
		$("#editSection_"+messageId).addClass('hidden');
		$("#button_section_"+messageId).removeClass('hidden');		
	});
	
	$('#postLsit').on('click','[id^=save_]', function(event){		
		var messageId = $(this).attr('id');
		messageId = messageId.replace(/save_/g, '');
		messageId = parseInt(messageId);	
		var postMessage = tinymce.get(messageId).getContent();	
		tinymce.execCommand("mceRemoveEditor", true, messageId);					
		var action = 'update';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{post_id:messageId, message:postMessage, action:action},
			dataType:"json",
			success:function(data){	
				var html = $("#postEditHtml").html();				
				if(html) {
					html = html.replace(/USERNAME/g, data.name);
					html = html.replace(/POSTDATE/g, data.post_date);
					html = html.replace(/POSTMESSAGE/g, data.message);
					html = html.replace(/POSTID/g, data.post_id);
					$("#postRow_"+messageId).html(html);				
					$("#editSection_"+messageId).addClass('hidden');
					$("#button_section_"+messageId).removeClass('hidden');	
				}				
			}
		});		
	});
	
});