<?php

$GLOBALS['tenant_id'] = $_REQUEST['tenant_id'];
include _PATH.'instance/front/controller/define_settings.inc.php';
$agent_numbers = $_REQUEST['agent_numbers'];
$dealId = _e($_REQUEST['dealId'], '0');
$phone_value = urlencode($_REQUEST['phone_value']);
$cur_agent = $_REQUEST['cur_agent'];
$_SESSION['REQUEST'] = array("tenant_id"=> $GLOBALS['tenant_id'] ,"agent_numbers"=> $agent_numbers , "dealId" => $dealId , "phone_value" => $phone_value, "cur_agent" => $cur_agent);

$status = qs("select * from deal_sid where tenant_id='".$GLOBALS['tenant_id']."' AND status = 'A' AND deal_id = '{$dealId}'  ");
if(count($status) > 0 ){
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Say>Call is already accepted by Other Agent.</Say>
        </Response>
        <?php
	die;
}

qu("deal_sid", array("status" => 'A'), "sid='" . $_REQUEST['CallSid'] . "'");


$apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);

$account_sid = $GLOBALS['ACCOUNT_SID'];
$auth_token = $GLOBALS['AUTH_TOKEN'];
include _PATH . "/Services/Twilio.php";
$client = new Services_Twilio($account_sid, $auth_token);

// call first
$data = q("select * from deal_sid where tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='{$dealId}' AND status!='C' AND sid!='{$_REQUEST['CallSid']}'");
qu("deal_sid", array("status" => 'R'), "tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='{$dealId}' AND status!='C' AND sid !='{$_REQUEST['CallSid']}'");

if (count($data) > 0) {
	foreach ($data as $each_data) {
		//echo "hanging up {$each_data['sid']} <br />\r\n";
		//sleep(1);
		$status = qs("select * from deal_sid where sid = '{$each_data['sid']}' ");
		
		if($status != 'A'){
			$call = $client->account->calls->get($each_data['sid']);
			$call->update(array(
				"Status" => "completed"
			));
		}
	}
}

$deal_data = $apiPD->getDealInfo($dealId); //$deal_data = $apiPD->getDealInfo('5232'); //Test Mode
//$deal_data = $apiPD->getDealInfo('5232');
$deal_data = json_decode($deal_data);
//$agent_name = ($deal_data->data->user_id->name);
$deal_amount = str_replace('&', ' and ', ($deal_data->data->value));
$deal_currency = str_replace('&', ' and ', ($deal_data->data->currency));
$organization = str_replace('&', ' and ', ($deal_data->data->org_name));
$Person = str_replace('&', ' and ', ($deal_data->data->person_name));

if(isset($deal_data->data->org_id->value)){
    $org_data = $apiPD->getOrganizationInfo($deal_data->data->org_id->value);
    $org_data = json_decode($org_data, "true");
    if (isset($org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'])) {
        $deal_amount = $org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'];
    }
    if($deal_amount=='' || $deal_amount==0){
        $deal_amount = 0;
    }
}
$agent_name = '';
$agent_detail = qs("select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND phone like '%".$cur_agent."%'");
if(isset($agent_detail)){
    $agent_name = $agent_detail['name'];
}
    
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

<Response>    
    <Gather timeout="10" action="<?= _U; ?>ConnectingCustomer" method="GET" numDigits="1">
        <Say>Hey  <?= $agent_name; ?>, You  have received  Incoming  Lead. 
                The Name  of  person  is  <?= $Person; ?> from  Organization  <?= $organization ?>. 
                Requires Loan  Of  <?= $deal_amount; ?> <?= $deal_currency; ?>. </Say>
            <Say>Press 1 to continue.  Press 2 to Repeat.  Press any other key to hangup</Say>	
    </Gather>
    <Gather timeout="5" action="<?= _U; ?>ConnectingCustomer" method="GET" numDigits="1">        
        <Say>You had not press any key.</Say>
        <Say>Please Press 1 to continue.  Press 2 to Repeat.  Press any other key to hangup</Say>	
    </Gather>
    <Redirect method="POST"><?= _U."ConnectingCustomer"; ?></Redirect>
</Response>
<?php
die;
?>