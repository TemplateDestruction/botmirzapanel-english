<?php
date_default_timezone_set('Asia/Tehran');
require_once '../config.php';
require_once '../botapi.php';
require_once '../panels.php';
require_once '../functions.php';
$ManagePanel = new ManagePanel();
$stmt = $pdo->prepare("SELECT * FROM invoice WHERE status = 'active' AND name_product = 'usertest' LIMIT 10");
$stmt->execute();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $resultt  = trim($result['username']);
    $marzban_list_get = select("marzban_panel","*","name_panel",$result['Service_location'],"select");
    $get_username_Check = $ManagePanel->DataUser($result['Service_location'],$result['username']);
    if (!in_array($get_username_Check['status'],['active','on_hold','Unsuccessful','disabled'])) {
        $ManagePanel->RemoveUser($result['Service_location'],$resultt);
        update("invoice","status","disabled","username",$resultt);
        $Response = json_encode([
            'inline_keyboard' => [
                [
                    ['text' => "🛍 خرید سرویس", 'callback_data' => 'buy'],
                ],
            ]
        ]);
        $textexpire = "Hello dear user,  
Your test service with the username $resultt has expired.  
We hope you had a great experience with the ease and speed of our service. If you were satisfied with your test service, you can purchase your own dedicated service and enjoy unrestricted internet with the highest quality 😉🔥  

🛍 To purchase a high-quality service, you can use the button below.";
        sendmessage($result['id_user'], $textexpire, $Response, 'HTML');
    }
}
