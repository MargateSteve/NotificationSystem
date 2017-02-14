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

$error = false;

if($_POST) {

    

    if(!$_POST['message'] || empty($_POST['user'])) {
        $error = true;
    } else {

        $query_insert = $db->insert(
            'notifications',
            array(
                'FIELDS'=>array(
                'sender' => $_SESSION['user'] ,
                'message' => $_POST['message']
                )
            )
        );


        foreach ($_POST['user'] as $value) {
            $query_insert = $db->insert(
                'notification_user',
                array(
                    'FIELDS'=>array(
                    'message' => $db ->insertId () ,
                    'user' => $value
                    )
                )
            );

        }

    }

}
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

if($error) { 
    echo 'Not Posted';
} else {
    echo 'Posted';
}
print_r($_POST);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="post">
        
                <textarea name="message" id="" cols="30" rows="3"></textarea>
                <div class="checkbox">
                  <label>
                    <input name="user[]" type="checkbox" value="1">
                    User 1
                  </label>
                </div>
                <div class="checkbox disabled">
                  <label>
                    <input name="user[]" type="checkbox" value="2">
                    User 2
                  </label>
                </div>
                <div class="checkbox disabled">
                  <label>
                    <input name="user[]" type="checkbox" value="3">
                    User 3
                  </label>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>


        </div><!-- /.col-xs-12 -->
    </div><!-- /.row -->
</div><!-- /.container -->



<?php



?>
</body>
</html>

