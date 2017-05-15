<?php
echo '<meta chartset="utf-8" /><PRE>';
require_once 'TopSdk.php';
$c = new TopClient;
$c->appkey = '23140690';
$c->secretKey = 'b95807d5e8bf3b4ce2850eda6fb9f307';
$c->gatewayUrl = 'http://121.41.33.119/jst/index.php';
// $req = new TradeGetRequest;
// $req->setFields("tid,type,status,payment,orders");
$req = new TradeFullinfoGetRequest;
$req->setFields("tid,receiver_mobile,receiver_phone,receiver_name,created");
$req->setTid("11031349352206490");
$resp = $c->execute($req, '6102b292591ea95efb5d57019ea5c2075f52c11ada9816e1016143238');

$t = json_encode($resp);
echo $t;