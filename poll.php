<?php

require_once 'src/config.php';

$db = DB::dbConnect();

$form_data = array(); //Pass back the data to `form.php`

if (isset($_GET['checknew'])) {
    # code...

    $query_check_unread = $db->select(
        'notification_user',
        array(
            'WHERE'=>array(
                'user' => array("=", $_SESSION['user']),
                'sent' => array("!=", '0000-00-00 00:00:00'),
                'dismissed' => array("=", '0000-00-00 00:00:00')
            ),
                'ORDER'=>array(
                    'id ASC'
                ),
                'LIMIT'=> 1

        )
    );


   

    $form_data['unread'] = $query_check_unread->count ();

    if (!$query_check_unread->count ()) {

        


        $query_check_new = $db->select(
        'notification_user',
            array(
                'WHERE'=>array(
                    'user' => array("=", $_SESSION['user']),
                    'sent' => array("=", '0000-00-00 00:00:00'),
                    'dismissed' => array("=", '0000-00-00 00:00:00')
                ),
                    'ORDER'=>array(
                        'id ASC'
                    ),
                    'LIMIT'=> 1

            )
        );


        

        $form_data['new'] = $query_check_new->count ();

        if ($query_check_new->count ()) {

            $notification = $query_check_new->getRows('one');

            $query_get_details = $db->select(
            'notifications',
                array(
                    'WHERE'=>array(
                        'id' => array("=", $notification->message)
                    )

                )
            );

            $details = $query_get_details->getRows('one');

            $form_data['notification'] = $notification->id;
            $form_data['message'] = $details->message;
            $form_data['sender'] = $details->sender;
            $form_data['sent_time'] = $details->sent_time;


            $query_update = $db->update(
                'notification_user',
                array(
                    'FIELDS'=>array(
                        'sent' => date('Y-m-d H:i:s'),
                        ),
                    'WHERE'=>array(
                        'id' => array("=", $notification->id),
                    )
                )
            );
            $form_data['success'] = 'true';
        }


    }

} 

if (isset($_GET['dismiss'])) {
    $query_update = $db->update(
                'notification_user',
                array(
                    'FIELDS'=>array(
                        'dismissed' => date('Y-m-d H:i:s'),
                        ),
                    'WHERE'=>array(
                        'id' => array("=", $_GET['dismiss']),
                    )
                )
            );
            $form_data['success'] = 'true';
}

/*
if ($query_update) {
    $form_data['success'] = 'true';
} else {
    $form_data['success'] = 'false';
} */


echo json_encode($form_data);