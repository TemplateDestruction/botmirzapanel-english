<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'text.php';
$setting = select("setting", "*");
$admin_ids = select("admin", "id_admin",null,null,"FETCH_COLUMN");
//-----------------------------[  text panel  ]-------------------------------
$sql = "SHOW TABLES LIKE 'textbot'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
$datatextbot = array(
    'text_usertest' => '',
    'text_Purchased_services' => '',
    'text_support' => '',
    'text_help' => '',
    'text_start' => '',
    'text_bot_off' => '',
    'text_dec_info' => '',
    'text_dec_usertest' => '',
    'text_fq' => '',
    'text_account' => '',
    'text_sell' => '',
    'text_Add_Balance' => '',
    'text_Discount' => '',
    'text_Tariff_list' => '',

);
if ($table_exists) {
    $textdatabot = select("textbot", "*",null ,null ,"fetchAll");
    $data_text_bot = array();
    foreach ($textdatabot as $row) {
        $data_text_bot[] = array(
            'id_text' => $row['id_text'],
            'text' => $row['text']
        );
    }
    foreach ($data_text_bot as $item) {
        if (isset($datatextbot[$item['id_text']])) {
            $datatextbot[$item['id_text']] = $item['text'];
        }
    }
}
$keyboard = [
    'keyboard' => [
        [['text' => $datatextbot['text_sell']],['text' => $datatextbot['text_usertest']]],
        [['text' => $datatextbot['text_Purchased_services']],['text' => $datatextbot['text_Tariff_list']]],
        [['text' => $datatextbot['text_account']],['text' => $datatextbot['text_Add_Balance']]],
        [['text' => "👥 Referral System"]],
        [['text' => $datatextbot['text_support']], ['text' => $datatextbot['text_help']]],
    ],
    'resize_keyboard' => true
];
if(in_array($from_id,$admin_ids)){
    $keyboard['keyboard'][] = [
        ['text' => "Admin"]
    ];
}
$keyboard  = json_encode($keyboard);


$keyboardPanel = json_encode([
    'inline_keyboard' => [
        [['text' => $datatextbot['text_Discount'] ,'callback_data' => "Discount"]],
    ],
    'resize_keyboard' => true
]);
$keyboardadmin = json_encode([
    'keyboard' => [
        [['text' => "📊 Bot Statistics"]],
        [['text' => "✏️ Panel Management"], ['text' => "🖥 Add Panel"]],
        [['text' => "🔑 Test Account Settings"]],
        [['text' => "🏬 Store Section"], ['text' => "💵 Finance"]],
        [['text' => "👨‍🔧 Admin Section"], ['text' => "📝 Bot Text Settings"]],
        [['text' => "👤 User Services"], ['text' => "👁‍🗨 Search User"], ['text' => "📨 Send Message"]],
        [['text' => "👥 Referral Settings"]],
        [['text' => "📚 Education Section"], ['text' => "⚙️ Settings"]],
        [['text' => $textbotlang['users']['backhome']]]
    ],
    'resize_keyboard' => true
]);
$keyboardpaymentManage = json_encode([
    'keyboard' => [
        [['text' => "💳 Offline Gateway Settings"]],
        [['text' => "💵 NowPayment Settings"], ['text' => "💎 Fiat & Crypto Gateway"]],
        [['text' => "🔵 Agha Payment Gateway"], ['text' => "🔴 Perfect Money Gateway"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$CartManage = json_encode([
    'keyboard' => [
        [['text' => "💳 Set Card Number"]],
        [['text' => "🔌 Offline Gateway Status"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$alsat = json_encode([
    'keyboard' => [
        [['text' => "Set Merchant"], ['text' => "AllSat Gateway Status"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$aqayepardakht = json_encode([
    'keyboard' => [
        [['text' => "Set Merchant for Agha Payment"], ['text' => "Agha Payment Gateway Status"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$NowPaymentsManage = json_encode([
    'keyboard' => [
        [['text' => "🧩 NowPayments API"]],
        [['text' => "🔌 NowPayments Gateway Status"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$admin_section_panel =  json_encode([
    'keyboard' => [
        [['text' => "👨‍💻 Add Admin"], ['text' => "❌ Remove Admin"]],
        [['text' => "📜 View Admin List"]],
        [['text' => "🏠 Back to Management Menu"]],
    ],
    'resize_keyboard' => true
]);
$keyboard_usertest =  json_encode([
    'keyboard' => [
        [['text' => "➕ Limit Test Account Creation for Everyone"]],
        [['text' => "⏳ Test Service Duration"], ['text' => "💾 Test Account Data Limit"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$setting_panel =  json_encode([
    'keyboard' => [
        [['text' => "🕚 Cron Job Settings"]],
        [['text' => "⚙️ Feature Status"]],
        [['text' => "📣 Report Channel Settings"], ['text' => "📯 Channel Settings"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$PaySettingcard = select("PaySetting", "ValuePay", "NamePay", 'Cartstatus',"select")['ValuePay'];
$PaySettingnow = select("PaySetting", "ValuePay", "NamePay", 'nowpaymentstatus',"select")['ValuePay'];
$PaySettingdigi = select("PaySetting", "ValuePay", "NamePay", 'digistatus',"select")['ValuePay'];
$PaySettingaqayepardakht = select("PaySetting", "ValuePay", "NamePay", 'statusaqayepardakht',"select")['ValuePay'];
$PaySettingperfectmoney = select("PaySetting", "ValuePay", "NamePay", 'status_perfectmoney',"select")['ValuePay'];
$step_payment = [
    'inline_keyboard' => []
];
if($PaySettingcard == "oncard"){
    $step_payment['inline_keyboard'][] = [
        ['text' => "💳 Card to Card", 'callback_data' => "cart_to_offline"],
    ];
}
if($PaySettingnow == "onnowpayment"){
    $step_payment['inline_keyboard'][] = [
        ['text' => "💵 NowPayments Payment", 'callback_data' => "nowpayments" ]
    ];
}
if($PaySettingdigi == "ondigi"){
    $step_payment['inline_keyboard'][] = [
        ['text' => "💎 Foreign Currency (Rial) Payment Gateway", 'callback_data' => "iranpay" ]
    ];
}
if($PaySettingaqayepardakht == "onaqayepardakht"){
    $step_payment['inline_keyboard'][] = [
        ['text' => "🔵 Aghaye Pardakht Gateway", 'callback_data' => "aqayepardakht" ]
    ];
}
if($PaySettingperfectmoney == "onperfectmoney"){
    $step_payment['inline_keyboard'][] = [
        ['text' => "🔴 Perfect Money Gateway", 'callback_data' => "perfectmoney" ]
    ];
}
$step_payment['inline_keyboard'][] = [
    ['text' => "❌ Close List", 'callback_data' => "closelist" ]
];
$step_payment = json_encode($step_payment);
$User_Services = json_encode([
    'keyboard' => [
        [['text' => "🛍 View User Orders"]],
        [['text' => "❌ Delete User Service"], ['text' => "👥 Mass Recharge"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$keyboardhelpadmin = json_encode([
   'keyboard' => [
        [['text' => "📚 Add Tutorial"], ['text' => "❌ Delete Tutorial"]],
        [['text' => "✏️ Edit Tutorial"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$shopkeyboard = json_encode([
    'keyboard' => [
        [['text' => "🛍 Add Product"], ['text' => "❌ Delete Product"]],
        [['text' => "🛒 Add Category"], ['text' => "❌ Delete Category"]],
        [['text' => "✏️ Edit Product"]],
        [['text' => "➕ Set Extra Volume Price"]],
        [['text' => "🎁 Create Gift Code"], ['text' => "❌ Delete Gift Code"]],
        [['text' => "🎁 Create Discount Code"], ['text' => "❌ Delete Discount Code"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$confrimrolls = json_encode([
    'keyboard' => [
        [['text' => "✅ I Accept the Rules"]],
    ],
    'resize_keyboard' => true
]);
$request_contact = json_encode([
    'keyboard' => [
        [['text' => "☎️ Send Phone Number", 'request_contact' => true]],
        [['text' => $textbotlang['users']['backhome']]]
    ],
    'resize_keyboard' => true
]);
$sendmessageuser = json_encode([
    'keyboard' => [
        [['text' => "✉️ Send to All"], ['text' => "📤 Forward to All"]],
        [['text' => "✍️ Send Message to a User"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$Feature_status = json_encode([
    'keyboard' => [
        [['text' => "Account Information Viewing"]],
        [['text' => "Test Account Feature"], ['text' => "Tutorial Feature"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$channelkeyboard = json_encode([
    'keyboard' => [
        [['text' => "📣 Set Mandatory Join Channel"]],
        [['text' => "🔑 Enable/Disable Channel Lock"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$backuser = json_encode([
    'keyboard' => [
        [['text' => $textbotlang['users']['backhome']]]
    ],
    'resize_keyboard' => true,
    'input_field_placeholder' => "Click the button below to return"
]);
$backadmin = json_encode([
    'keyboard' => [
        [['text' => "🏠 Return to Management Menu"]]
    ],
    'resize_keyboard' => true,
    'input_field_placeholder' =>"Click the button below to return."
]);
$stmt = $pdo->prepare("SHOW TABLES LIKE 'marzban_panel'");
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
$namepanel = [];
if ($table_exists) {
    $stmt = $pdo->prepare("SELECT * FROM marzban_panel");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $namepanel[] = [$row['name_panel']];
    }
    $list_marzban_panel = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    foreach ($namepanel as $button) {
        $list_marzban_panel['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $list_marzban_panel['keyboard'][] = [
        ['text' => "🏠 Return to Management Menu"]
    ];
    $json_list_marzban_panel = json_encode($list_marzban_panel);
}
$sql = "SHOW TABLES LIKE 'help'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
if ($table_exists) {
    $help = [];
    $stmt = $pdo->prepare("SELECT * FROM help");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $help[] = [$row['name_os']];
    }
    $help_arr = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    foreach ($help as $button) {
        $help_arr['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $help_arr['keyboard'][] = [
        ['text' => $textbotlang['users']['backhome']],
    ];
    $json_list_help = json_encode($help_arr);
}

$users = select("user", "*", "id", $from_id,"select");
if ($users == false) {
    $users = array();
    $users = array(
        'step' => '',
    );
}
$stmt = $pdo->prepare("SELECT * FROM marzban_panel WHERE status = 'activepanel'");
$stmt->execute();
$list_marzban_panel_users = ['inline_keyboard' => []];
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($users['step'] == "getusernameinfo") {
        $list_marzban_panel_users['inline_keyboard'][] = [
            ['text' => $result['name_panel'], 'callback_data' => "locationnotuser_{$result['id']}"]
        ];
    }
    else{
        $list_marzban_panel_users['inline_keyboard'][] = [['text' => $result['name_panel'], 'callback_data' => "location_{$result['id']}"]
        ];
    }
}
$list_marzban_panel_users['inline_keyboard'][] = [
    ['text' => $textbotlang['users']['backhome'], 'callback_data' => "backuser"],
];
$list_marzban_panel_user = json_encode($list_marzban_panel_users);

$list_marzban_panel_usertest = [
    'inline_keyboard' => [],
];
$stmt = $pdo->prepare("SELECT * FROM marzban_panel WHERE statusTest = 'ontestshowpanel'");
$stmt->execute();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $list_marzban_panel_usertest['inline_keyboard'][] = [['text' => $result['name_panel'], 'callback_data' => "locationtests_{$result['id']}"]
    ];
}
$list_marzban_panel_usertest['inline_keyboard'][] = [
    ['text' => $textbotlang['users']['backhome'], 'callback_data' => "backuser"],
];
$list_marzban_usertest = json_encode($list_marzban_panel_usertest);
$textbot = json_encode([
    'keyboard' => [
        [['text' => "Set Start Message"], ['text' => "Purchased Service Button"]],
        [['text' => "Test Account Button"], ['text' => "FAQ Button"]],
        [['text' => "📚 Training Button Text"], ['text' => "☎️ Support Button Text"]],
        [['text' => "Increase Balance Button"], ['text' => "⚖️ Law Text"]],
        [['text' => "Buy Subscription Button Text"], ['text' => "Tariff List Button Text"]],
        [['text' => "Tariff List Description Text"]],
        [['text' => "User Account Button Text"]],
        [['text' => "📝 Set Mandatory Membership Description Text"]],
        [['text' => "📝 Set FAQ Description Text"]],
        [['text' => "🏠 Return to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'protocol'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
if ($table_exists) {
    $getdataprotocol = select("protocol", "*",null ,null ,"fetchAll");
    $protocol = [];
    foreach($getdataprotocol as $result)
    {
        $protocol[] = [['text'=>$result['NameProtocol']]];
    }
    $protocol[] = [['text' => "🏠 Return to Management Menu"]];
    $keyboardprotocollist = json_encode(['resize_keyboard'=>true,'keyboard'=> $protocol]);
}
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'product'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
if ($table_exists) {
    $product = [];
    $stmt = $pdo->prepare("SELECT * FROM product WHERE Location = :Location OR Location = '/all'");
    $stmt->bindParam(':Location', $text, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $product[] = [$row['name_product']];
    }
    $list_product = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    $list_product['keyboard'][] = [
        ['text' => "🏠 Return to Management Menu"],
    ];
    foreach ($product as $button) {
        $list_product['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $json_list_product_list_admin = json_encode($list_product);
}
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'Discount'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
if ($table_exists) {
    $Discount = [];
    $stmt = $pdo->prepare("SELECT * FROM Discount");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $Discount[] = [$row['code']];
    }
    $list_Discount = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    $list_Discount['keyboard'][] = [
        ['text' => "🏠 Return to Management Menu"],
    ];
    foreach ($Discount as $button) {
        $list_Discount['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $json_list_Discount_list_admin = json_encode($list_Discount);
}
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'DiscountSell'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$table_exists = count($result) > 0;
$namepanel = [];
if ($table_exists) {
    $DiscountSell = [];
    $stmt = $pdo->prepare("SELECT * FROM DiscountSell");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $DiscountSell[] = [$row['codeDiscount']];
    }
    $list_Discountsell = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    $list_Discountsell['keyboard'][] = [
        ['text' => "🏠 Return to Management Menu"],
    ];
    foreach ($DiscountSell as $button) {
        $list_Discountsell['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $json_list_Discount_list_admin_sell = json_encode($list_Discountsell);
}
$payment = json_encode([
    'inline_keyboard' => [
        [['text' => "💰 Payment and Receive Service", 'callback_data' => "confirmandgetservice"]],
        [['text' => "🎁 Enter Discount Code", 'callback_data' => "aptdc"]],
        [['text' => $textbotlang['users']['backhome'] ,  'callback_data' => "backuser"]]
    ]
]);
$change_product = json_encode([
    'keyboard' => [
        [['text' => "Price"], ['text' => "Volume"], ['text' => "Time"]],
        [['text' => "Product Name"], ['text' => "Category"]],
        ['text' => "🏠 Return to Management Menu"],
    ],
    'resize_keyboard' => true
]);

$keyboardprotocol = json_encode([
    'keyboard' => [
        [['text' => "vless"],['text' => "vmess"],['text' => "trojan"]],
        [['text' => "shadowsocks"]],
        ['text' => "🏠 Return to Management Menu"],
    ],
    'resize_keyboard' => true
]);
$MethodUsername = json_encode([
    'keyboard' => [
        [['text' => "Username + Number in Order"]],
        [['text' => "Numeric ID + Random Letters and Numbers"]],
        [['text' => "Custom Username"]],
        [['text' => "Custom Text + Random Number"]],
        [['text' => "🏠 Return to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$optionMarzban = json_encode([
    'keyboard' => [
        [['text' => "🔌 Panel Connection Status"], ['text' => "👁‍🗨 Panel Display Status"]],
        [['text' => "🎁 Test Account Status"], ['text' => "⚙️ Configure Protocol & Inbound"]],
        [['text' => "✍️ Panel Name"], ['text' => "❌ Delete Panel"]],
        [['text' => "🔗 Edit Panel Address"], ['text' => "👤 Edit Username"]],
        [['text' => "🔐 Edit Password"]],
        [['text' => "💡 Username Creation Method"]],
        [['text' => "🔗 Send Subscription Link"], ['text' => "⚙️ Send Configuration"]],
        [['text' => "⏳ First Connection Capability"]],
        [['text' => "🏠 Return to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$optionMarzneshin = json_encode([
    'keyboard' => [
        [['text' => "🔌 Panel Connection Status"], ['text' => "👁‍🗨 Panel Display Status"]],
        [['text' => "🎁 Test Account Status"]],
        [['text' => "✍️ Panel Name"], ['text' => "❌ Delete Panel"]],
        [['text' => "🔗 Edit Panel Address"], ['text' => "👤 Edit Username"]],
        [['text' => "🔐 Edit Password"], ['text' => "⚙️ Service Settings"]],
        [['text' => "💡 Username Creation Method"], ['text' => "⏳ First Connection Capability"]],
        [['text' => "🔗 Send Subscription Link"], ['text' => "⚙️ Send Configuration"]],
        [['text' => "🏠 Return to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$optionX_ui_single = json_encode([
    'keyboard' => [
        [['text' => "🔌 Panel Connection Status"], ['text' => "👁‍🗨 Panel Display Status"]],
        [['text' => "🎁 Test Account Status"]],
        [['text' => "✍️ Panel Name"], ['text' => "❌ Delete Panel"]],
        [['text' => "💡 Username Creation Method"]],
        [['text' => "🔐 Edit Password"], ['text' => "👤 Edit Username"]],
        [['text' => "🔗 Edit Panel Address"], ['text' => "💎 Set Inbound ID"]],
        [['text' => "🔗 Send Subscription Link"], ['text' => "⚙️ Send Configuration"]],
        [['text' => "🔗 Subscription Link Domain"]],
        [['text' => "🏠 Return to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$supportoption = json_encode([
    'inline_keyboard' => [
        [
            ['text' => "⁉️ Frequently Asked Questions", 'callback_data' => "fqQuestions"],
        ],
        [
            ['text' => "🎟 Send Message to Support", 'callback_data' => "support"],
        ],
    ]
]);
$perfectmoneykeyboard = json_encode([
    'keyboard' => [
        [['text' => "Set Wallet Number"], ['text' => "Set Account Number"]],
        [['text' => "Set Account Password"], ['text' => "Perfect Money Status"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$affiliates =  json_encode([
    'keyboard' => [
        [['text' => "🎁 Referral Status"]],
        [['text' => "🧮 Set Referral Percentage"]],
        [['text' => "🏞 Set Referral Banner"]],
        [['text' => "🎁 Commission After Purchase"], ['text' => "🎁 Receive Gift"]],
        [['text' => "🌟 Startup Gift Amount"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$typepanel =  json_encode([
    'keyboard' => [
        [['text' => "marzban"],['text' => "x-ui_single"]],
        [['text' => "marzneshin"],['text' => "alireza"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$keyboardcronjob =  json_encode([
    'keyboard' => [
        [['text' => 'Enable Cron Test'], ['text' => 'Disable Cron Test']],
        [['text' => 'Enable Cron Data Usage'], ['text' => 'Disable Cron Data Usage']],
        [['text' => 'Enable Cron Time'], ['text' => 'Disable Cron Time']],
        [['text' => 'Enable Cron Deletion'], ['text' => 'Disable Cron Deletion']],
        [['text' => "Account Deletion Time"]],
        [['text' => "🏠 Back to Management Menu"]]
    ],
    'resize_keyboard' => true
]);
$helpedit =  json_encode([
    'keyboard' => [
        [['text' => "Edit Name"], ['text' => "Edit Description"]],
        [['text' => "Edit Media"]],
        [['text' => "🏠 Back to Management Menu"], ['text' => "▶️ Back to Previous Menu"]]
    ],
    'resize_keyboard' => true
]);
function KeyboardCategory(){
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM category");
    $stmt->execute();
    $list_category = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $list_category['keyboard'][] = [['text' =>$row['remark']]];
    }
    $list_category['keyboard'][] = [
        ['text' => "🏠 Return to Management Menu"],
    ];
    return json_encode($list_category);
}
function KeyboardCategorybuy($callback_data,$location){
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM category");
    $stmt->execute();
    $list_category = ['inline_keyboard' => [],];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmts = $pdo->prepare("SELECT * FROM product WHERE (Location = :location OR Location = '/all') AND category = :category");
        $stmts->bindParam(':location', $location, PDO::PARAM_STR);
        $stmts->bindParam(':category', $row['id'], PDO::PARAM_STR);
        $stmts->execute();
        if($stmts->rowCount() == 0)continue;
        $list_category['inline_keyboard'][] = [['text' =>$row['remark'],'callback_data' => "categorylist_".$row['id']]];
    }
    $list_category['inline_keyboard'][] = [
        ['text' => "🏠 Back to Previous Menu", "callback_data" => $callback_data],
    ];
    return json_encode($list_category);
}
function KeyboardProduct($location,$backdata,$MethodUsername, $categoryid = null){
    global $pdo,$textbotlang;
    $query = "SELECT * FROM product WHERE (Location = :location OR Location = '/all') ";
    if($categoryid != null){
        $query.= "AND category = '$categoryid'";
    }
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
    $stmt->execute();
    $product = ['inline_keyboard' => []];
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($MethodUsername == "نام کاربری دلخواه") {
            $product['inline_keyboard'][] = [
                ['text' => $result['name_product'], 'callback_data' => "prodcutservices_" . $result['code_product']]
            ];
        } else {
            $product['inline_keyboard'][] = [
                ['text' => $result['name_product'], 'callback_data' => "prodcutservice_{$result['code_product']}"]
            ];
        }
    }
    $product['inline_keyboard'][] = [
        ['text' => $textbotlang['users']['backmenu'], 'callback_data' => $backdata]
    ];

    return json_encode($product);
}
