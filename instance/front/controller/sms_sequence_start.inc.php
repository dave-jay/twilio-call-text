<?php
$need_to_start_data = qs("select * from active_campaign_contact where need_to_start='1' order by created_at desc");
if(!empty($need_to_start_data)){
    if(time()>(strtotime($need_to_start_data['need_to_start_time']))){
        qi('active_campaign_log', _escapeArray(array("log" => "SMS:One new deal found")));    
        qu("active_campaign_contact",array("need_to_start"=>"0"),"id='{$need_to_start_data['id']}'");            
    }else{
        echo "please wait for ".((strtotime($need_to_start_data['modified_at'])+60)-time())." sec";
        die;
    }
}else{
    echo "no new deal is coming";
    die;
}
echo "1";
//Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
$apiPD = new apiPipeDrive();
$deal_info = $apiPD->getDealInfo($need_to_start_data['last_deal_id']);
echo "<br>2";
$deal_info = json_decode($deal_info, TRUE);
$tag = $agent = $deal_amount  = $fname = $lname = $email = $org = $pipedrive_id = $pipedrive_stage = '';
$agent_id = $agent_linkedin_link = $agent_phone = '';
$phone = $need_to_start_data['phone'];
$phone2 = $need_to_start_data['alternate_phone'];
$active_campaign_contact_id = $need_to_start_data['id'];
echo "<br>3";
$mobile_number_found = $need_to_start_data['is_mobile_number'];
if (isset($deal_info['data']['id'])) {
    $name = explode(" ", $deal_info['data']['person_id']['name']);
    $fname = $name[0];
    if (count($name) > 2) {
        array_shift($name);
        $lname = implode(" ", $name);
    } else {
        $lname = $name[1];
    }
    foreach ($deal_info['data']['person_id']['email'] as $each) {
        if (isset($each['value']) && $each['value'] != '') {
            $email = $each['value'];
            break;
        }
    }    
    $org = $deal_info['data']['org_id']['name'];
    $org_id = $deal_info['data']['org_id']['value'];
    $agent = $deal_info['data']['user_id']['name'];
    $agent_id = $deal_info['data']['user_id']['value'];
    $deal_amount = $deal_info['data']['value'];
    $pipedrive_id = $deal_info['data']['id'];
    $pipedrive_stage = $deal_info['data']['stage_id'];
} else {
    qi('active_campaign_log', array("log" => "Add: Deal info not found. " . json_decode($data)));
    die;
}
echo "<br>4";
$org_data = $apiPD->getOrganizationInfo($org_id);
$org_data = json_decode($org_data, "true");
if (isset($org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'])) {
    $deal_amount = $org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'];
}
if($deal_amount=='' || $deal_amount==0){
    $deal_amount = 50000;
}
$deal_amount = number_format($deal_amount);

echo "<br>5";
$stage_data = $apiPD->getAllStage();
$stage_data = json_decode($stage_data, "true");
$stage = array();

if (isset($stage_data['data'])) {
    foreach ($stage_data['data'] as $each_stage) {
        $stage[$each_stage['id']] = $each_stage; //'order_nr','name'
    }
}
$tag = $ac_data['tags'] = ac_tag_generate($stage[$pipedrive_stage]['name']);
if ($agent_id != '' && $agent_id != "990918") {
    $agent_data = qs("select * from pd_users where pd_id='{$agent_id}'");
} else {
    $agent_data = qs("select * from pd_users where is_default='1'");
}
echo "<br>6";
$agent = $agent_data['name'];
$stage_mapping_arr = json_decode(STAGE_MAPPING, true);
$campaing_class = new Campaign();
$campaing_class::$contact_email = $email;
$campaing_class::$contact_fname = $fname;
$campaing_class::$contact_lname = $lname;
$campaing_class::$contact_phone = formatPhone($phone, 6);
$campaing_class::$contact_org = $org;
$campaing_class::$tag = trim($tag, ",");

$campaing_class::$SEQUENCE_STATUS = "NEW";
$campaing_class::$PIPEDRIVE_ID = $pipedrive_id;
$campaing_class::$PIPEDRIVE_STAGE = $stage[$pipedrive_stage]['name'];
$campaing_class::$AGENT_NAME = $agent;
$campaing_class::$DEAL_AMOUNT = $deal_amount;
$campaing_class::$ALTERNATE_PHONE = formatPhone($phone2, 6);
$campaing_class::$PIPEDRIVE_DEAL_LINK = "https://sprout2.pipedrive.com/deal/" . $pipedrive_id;
if (!empty($agent_data)) {
    $campaing_class::$AGENT_PHONE = formatPhone($agent_data['phone']);
    $campaing_class::$AGENT_ROLE = $agent_data['role'];
    $campaing_class::$AGENT_LINKEDIN_LINK = "<a href='{$agent_data['linkedin_link']}'><img alt='My LinkedIn Profile' src='http://sprout.img-us10.com/public/332ea34c4e46abd2f2d3c65e788c4f22.png?r=761035395' /></a>";
}
try {
    //$data_camp = $campaing_class->pushContact($stage_mapping_arr[$pipedrive_stage]['ac_list_id']);
} catch (Exception $e) {
    
}
echo "<br>7";
if (isset($data_camp->success) && ($data_camp->success || $data_camp->success == '1')) {
    $active_campaign_contact_id = qu('active_campaign_contact', array("campaign_contact_id" => $data_camp->subscriber_id), "id='{$active_campaign_contact_id}'");
    qi('active_campaign_log', _escapeArray(array("log" => "Active Campaign Contact Id: " . $data_camp->subscriber_id . "<br>Message:" . $data_camp->result_message)));
} else {
    qi('active_campaign_log', _escapeArray(array("log" => "Active campaign error. " . json_encode($data_camp) . " Deal:" . $deal_info['data']['id'])));
}
echo "<br>8";
$use_of_fund[1] = 'Advertising & Marketing';
$use_of_fund[2] = 'Additional Location';
$use_of_fund[3] = 'Buyout a Partner';
$use_of_fund[4] = 'Equipment';
$use_of_fund[5] = 'Supplies/Inventory';
$use_of_fund[6] = 'Start a New Business';
$use_of_fund[7] = 'Hiring Additional Staff';
$use_of_fund[8] = 'Get Through a Slow Period';
$use_of_fund[9] = 'Remodeling Location';
$use_of_fund[10] = 'Have In The Bank';
$use_of_fund[41] = 'Working Capital';

$org_for = 'Working Capital';
if (isset($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44'])) {
    $org_for = $use_of_fund[$org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44']];
}
echo "<br>9";
if ($mobile_number_found == 1) {
    $sms_seq_data = qs("select * from sms_sequence where last10phone='" . last10Char($phone) . "'");
    if (!empty($sms_seq_data)) {
        qd("sms_sequence", "id='{$sms_seq_data['id']}'");
    }
    $time_zone_arr = getTimeZoneByPhone($phone, "1");
    qi("sms_sequence", array("phone" => $phone, "deal_amount" => $deal_amount, "last10phone" => last10Char($phone), "state_code" => $time_zone_arr['state_code'], "state" => $time_zone_arr['state'], "area_code" => $time_zone_arr['area_code'], "timezone" => $time_zone_arr['timezone'], "last_deal_id" => $pipedrive_id, "day1_1_sent" => "1"));
    $deal_detail['e585bd988070d2bdfb2af36d968521c3f9aa949a'] = 'ON';
    $apiPD->modifyDeal($pipedrive_id, $deal_detail);
    echo "<br>10";
    $agent_arr = explode(" ", $agent);
    $agent = $agent_arr[0];
    $message = "Hi " . trim($fname) . ", it's {$agent} from Sprout. I just received your request for funding for your business {$org}. and I should be able to get you the $" . $deal_amount . " that you requested for {$org_for}. Can you chat for 2 minutes now to discuss?";
    $note_data['deal_id'] = $pipedrive_id;
    $note_data['content'] = "Welcome Text was sent on " . formatPhone($phone, 4) . ".<br><br>Text: {$message}";
    $data = $apiPD->createNote($note_data);
    $note_data['content'] = "SMS Sequence is executing on {$time_zone_arr['timezone']} Timezone. <br>Customer State: {$time_zone_arr['state']} ({$time_zone_arr['state_code']})<br>Area Code: {$time_zone_arr['area_code']}";
    $data = $apiPD->createNote($note_data);
    $apiCall = new callWebhook();
    echo "<br>11";
    $apiCall->messageNow($phone, $message, "2");
    qi('active_campaign_log', _escapeArray(array("log" => "Trying to message sending on " . formatPhone($phone, 4))));
}
die;
?>