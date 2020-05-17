<?php
include_once "../loginsAdmin/mailJetKey.php";

function send_email_request($bod)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.mailjet.com/v3.1/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERPWD => getPublic().":".getPrivate(),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $bod,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Type: text/plain"
        ),
    ));
    $response = json_decode(curl_exec($curl));
    curl_close($curl);
    return property_exists($response->Messages[0], "Status");
}


function send_email($recipient, $name, $subject){
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => getEmail(),
                    'Name' => "Qariño Animal"
                ],
                'To' => [
                    [
                        'Email' => $recipient,
                        'Name' => $name
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => file_get_contents("_email.html")
            ]
        ]
    ];

    return send_email_request(json_encode($body));

}
function recieve_email($sender, $name, $subject){
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $sender,
                    'Name' => "Qariño Animal"
                ],
                'To' => [
                    [
                        'Email' => getEmail(),
                        'Name' => $name
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => file_get_contents("_email.html")
            ]
        ]
    ];

    return send_email_request(json_encode($body));

}

