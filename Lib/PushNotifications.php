<?php



class PushNotifications
{

    public static function getNotificationBodyData($to,$title,$body,$type,$user_id="",$image="", $username="")
    {
        # only data body, notification must be handeled by client


        /*********************************START NOTIFICATION******************************/

        $notification['to'] = $to;


        $notification['data']['title'] = $title;
        $notification['data']['body'] = $body;
        $notification['data']['user_id'] = $user_id;
        $notification['data']['image'] = $image;
        $notification['data']['name'] = $username;
        $notification['data']['badge'] = "1";
        $notification['data']['sound'] = "default";
        $notification['data']['icon'] = "";
        $notification['data']['type'] = $type;

        return $notification;
    }


    public static function getNotificationBody($to,$title,$body,$type,$user_id="",$image="", $username="")
    {
        # both data and notification body

        # appStatus background -> notificatoin Auto
        # appStatus forground -> notification Manual

        /*********************************START NOTIFICATION******************************/

        $notification['to'] = $to;


        $notification['notification']['title'] = $title;
        $notification['notification']['body'] = $body;
        $notification['notification']['user_id'] = $user_id;
        $notification['notification']['image'] = $image;
        $notification['notification']['name'] = $username;
        $notification['notification']['badge'] = "1";
        $notification['notification']['sound'] = "default";
        $notification['notification']['icon'] = "";
        $notification['notification']['type'] = $type;

        $notification['data']['title'] = $title;
        $notification['data']['body'] = $body;
        $notification['data']['user_id'] = $user_id;
        $notification['data']['image'] = $image;
        $notification['data']['name'] = $username;
        $notification['data']['badge'] = "1";
        $notification['data']['sound'] = "default";
        $notification['data']['icon'] = "";
        $notification['data']['type'] = $type;

        return $notification;
        
    }


    public static function send($data,$debug = false)
    {
        $key = FIREBASE_PUSH_NOTIFICATION_KEY;

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            //"api-key: ".API_KEY." ",
            "Authorization: key = ".$key,
        ];
        
        $url = "https://fcm.googleapis.com/fcm/send";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $return = curl_exec($ch);
          
        
        $curl_error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($debug){
            $echo = "Params => ". json_encode($data)."<br> Response => ".$return;
            echo $echo;
        }
        try {
            $json = json_decode($return, true);
            if(isset($json['success']) && $json['success'] == 1){
                $output = array(
                    'code' => 200,
                    'msg' => "success"
                );
            }else{
                $output = array(
                    'code' => 201,
                    'msg' => "error"
                );
            }
        } catch (\Throwable $th) {
            $output = array(
                'code' => 201,
                'msg' => "success"
            );
        }

        return $output;

    }

}

?>