<?php

$all_tenants = q("select * from admin_users where is_active='1'");
foreach($all_tenants as $each_tenant):
    $GLOBALS['tenant_id'] = $each_tenant['id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
        
    if(!isset($conf_data['CALL_REDIAL_TIME']) || $conf_data['CALL_REDIAL_TIME']<1){
        $conf_data['CALL_REDIAL_TIME']=1;
    }
    $calls = q("select distinct(deal_id) as deal_id,tenant_id from agent_call_dialed where id>8831 AND tenant_id='{$GLOBALS['tenant_id']}' AND is_received='0' AND  DATE(`created_at`) = CURDATE() AND created_at<=NOW() - INTERVAL {$conf_data['CALL_REDIAL_TIME']} MINUTE order by id desc limit 0,10");
     
    foreach ($calls as $each_call) {
        $is_received = qs("select count(*) as is_received from agent_call_dialed where tenant_id='{$GLOBALS['tenant_id']}' AND is_received='1' AND deal_id='" . $each_call['deal_id'] . "'");
        if ($is_received['is_received'] == 0) {
            $is_voice_call = qs("select count(*) as is_voice_call from voice_call where tenant_id='{$GLOBALS['tenant_id']}' AND deal_id='" . $each_call['deal_id'] . "'");
            if ($is_voice_call['is_voice_call'] == 0) {
                $last_agent_call_dial = q("select * from agent_call_dialed where tenant_id='{$GLOBALS['tenant_id']}' AND deal_id='" . $each_call['deal_id'] . "' order by id desc");
                d($last_agent_call_dial);
                $count = count($last_agent_call_dial);
                if ($count > 9) {
                    echo "Deal Id: " . $each_call['deal_id'];
                    echo "<div style='color:black;'>We are reach at maximum trial.<br><br></div>";
                }elseif ($last_agent_call_dial[0]['is_aborted'] == '1') {
                    echo "Deal Id: " . $each_call['deal_id'];
                    echo "<div style='color:black;'>We are already aborted this call.<br><br></div>";
                } else {
                    $category = $last_agent_call_dial[0]['category'];
                    $cat_count = 0;
                    $is_aborted = '0';
                    foreach ($last_agent_call_dial as $each_dial) {
                        if ($each_dial['category'] == $category) {
                            $cat_count++;
                        }
                    }
                    echo "count: " . $cat_count;
                    echo "<br>Deal Id: " . $each_call['deal_id'];
                    echo "<br>Category to call: " . $category;
                    echo $category . "-------";
                    if ($cat_count == 3 && $category == 'A') {
                        $category = 'B';
                    } elseif ($cat_count == 3 && $category == 'B') {
                        $category = 'C';
                    } elseif ($cat_count == 3 && $category == 'C') {
                        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "We had tried 3 times call for group-C for deal_id: ".$each_call['deal_id']);                        
                        continue;
                    }
                    if ($category != 'A' && $category != 'B' && $category != 'C') {
                        $category = 'A';
                    }
                    $query = "select count(*) as count from agent_call_dialed where tenant_id='{$GLOBALS['tenant_id']}' AND deal_id='" . $each_call['deal_id'] . "' AND  DATE(`created_at`) = CURDATE() AND created_at>NOW() - INTERVAL {$conf_data['CALL_REDIAL_TIME']} MINUTE order by created_at desc";
                    $last_call = qs($query);
                    echo $query;
                    d($last_call);
                    if ($last_call['count'] > 0) {
                        echo "call in progress";
                        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "we can try only after 5 minutes deal_id: ".$each_call['deal_id']);                        
                        continue;
                    } else {
                        echo "call need to dial";
                        echo "<Br>" . $last_agent_call_dial[0]['customer_phone'];
                        $apiCall = new callWebhook();
                        $all_agent_arr_unique = explode(",", $last_agent_call_dial[0]['agent_numbers']);
                        $new_agent_numbers = array();
                        foreach ($all_agent_arr_unique as $each_value) {                        
                                $new_agent_numbers[] = $each_value;
                        }
                        d($new_agent_numbers);
                        $apiCall->callNow($last_agent_call_dial[0]['customer_phone'], $new_agent_numbers, $each_call['deal_id'], "1", $category);
                        break;
                    }
                }
            } else {
                echo "Deal Id: " . $each_call['deal_id'];
                echo "<div style='color:black;'>Call In Voice Mail.<br><br></div>";
            }
        } else {
            echo "Deal Id: " . $each_call['deal_id'];
            echo "<div style='color:green;'>Call Already received by agent.<br><br></div>";
        }
    }
endforeach;
die;
?>