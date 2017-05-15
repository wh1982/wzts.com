<?php
// require_once './jd/JdClient.php';
require_once 'JdSdk.php';

$c = new JdClient();

$c->appKey = "963452078B47F5076D7075801CC9078F";

$c->appSecret = "14a9aa6100cb4dfbb56ac5e1d5348380";

$c->accessToken = "05455a8d-bf36-479d-8629-41737febb0ef";

$c->serverUrl = "http://103.235.242.85/jdcloud/index.php";
				

$req = new PopAfsSoaRefundapplyQueryPageListRequest();

/*$req->setIds( "jingdong" ); 
$req->setStatus( 123 ); 
$req->setOrderId( "jingdong" ); 
$req->setBuyerId( "jingdong" ); 
$req->setBuyerName( "jingdong" ); 
$req->setApplyTimeEnd( "jingdong" ); 
$req->setCheckTimeEnd( "jingdong" ); 
$req->setCheckTimeStart( "jingdong" ); */
// $req->setApplyTimeStart( "jingdong" ); 
$req->setPageIndex( 1 ); 
$req->setPageSize( 50 );

$resp = $c->execute($req, $c->accessToken);
print(json_encode($resp));

