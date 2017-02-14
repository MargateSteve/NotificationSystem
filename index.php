<?php

/**
* Include the config file
**/
require_once 'src/config.php';

/**
* Display php errors. Uncomment to use
**/
// ini_set('display_errors', 'ON');

/**
* Connect to the database and assign it to a variable called $db
* When communicating with the database, we can now use $db->
**/
$db = DB::dbConnect();


$_SESSION['user'] = (isset($_GET['user'])) ? $_GET['user'] : '';
?>


<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Notification System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">


</head>

<body>

<h1>Notification System</h1>
<p class="lead">Ajax notification system</p>

<?php

echo isset($_SESSION['user']) ? $_SESSION['user'] : '';

?>


<button class="checknow btn btn-primary">Check</button>


 <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){

        (function () {

            var poll = function() {
                $.ajax({
                type: 'GET',
                url: 'poll.php?checknew=true',
                dataType: 'json',


                success: function(response) {


                    console.log(response.unread);
                    console.log(response.sent_time);
                    console.log(response.sender);
                    console.log(response.message);



                    if(response.success=='true') {

                        $('body').append('<div class="alert alert-warning notification-'+response.notification+'">'+response.sent_time+'<br>'+response.sender+'<br>'+response.message+'<br><button class="btn btn-primary dismiss" data-notification="'+response.notification+'">Dismiss</button></div>');

                    } else {

                    
                    }
  
                }

            });

        };

        setInterval(function(){
            poll();
        }, 2000);

    })();

    
        

        $(document).on('click', '.dismiss', function () {
        console.log('Button Clicked');

        var notification = $(this).attr("data-notification");
     console.log('Att:'+notification);
        $.ajax({
                type: 'GET',
                url: 'poll.php?dismiss='+notification,
                dataType: 'json',


                success: function(response) {




                    if(response.success=='true') {
                        console.log('response.success:'+response.success);

                        $('div.alert.notification-'+notification).remove();

                    } else {

                    
                    }
  
                }

            });
        return false;
    });
});
</script>
</body>
</html>

