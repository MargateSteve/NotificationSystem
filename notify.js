$(document).ready(function($) {
	
	 (function () {
            var poll = function() {
                $.ajax({
                type: 'GET',
                url: '/scripts/ajax/notification-poll.php?checknew=true',
                dataType: 'json',
                success: function(response) {
			console.log ('Unread  ' + response.unread);
			console.log ('New ' + response.new);
			console.log ('UnreadID ' + response.unreadID);
			
			if(response.success=='true') {
			    
			    
                        $('body').append('<div class="notify-u notification-'+response.notification+'" style="display:none"><p><b>'+response.sent_time+' : '+response.sender+'</b></p><p>'+response.message+'</p><button class="btn btn-sm btn-primary dismiss" data-notification="'+response.notification+'">Dismiss</button></div>');
						$(".notify-u").slideToggle();
                        clearInterval(pollInterval);
                    } else {
                    
                    }
  
                }
            });
        };
        pollInterval = setInterval(function(){
            poll();
        }, 4000);   
             $(document).on('click', '.dismiss', function () {
        console.log('Button Clicked');
        var notification = $(this).attr("data-notification");
     console.log('Att:'+notification);
        $.ajax({
                type: 'GET',
                url: '/scripts/ajax/notification-poll.php?dismiss='+notification,
                dataType: 'json',
                success: function(response) {
                    if(response.success=='true') {
                        console.log('response.success:'+response.success);
						
		
							
							$('div.notify-u.notification-'+notification).slideToggle(500);
							
								setTimeout(function() {
									$('div.notify-u.notification-'+notification).remove();
								}, 2500);
						    
					
				
  
  
						//$('div.notify-u.notification-'+notification).delay(1500).slideDown(1500).remove().delay(1500);
                        //$('div.notify-u.notification-'+notification).remove();
                        pollInterval = setInterval(function(){
            poll();
        }, 4000);
                    } else {
                    
                    }
  
                }
            });
        return false;
    });
    })();
		
});
