<?php

if ($_REQUEST['doUpdateAgent']) {
    $agent_id = _escape($_REQUEST['doUpdateAgent']);
    $value = _escape($_REQUEST['value']);

    if ($value) {
        qu('pd_users', array("phone" => $value), " id = '{$agent_id}'  ");
    }

    die;
}

$agents = q("select * From pd_users ");

_cg("page_title", "Pipedrive Agents List");
$jsInclude = "agents.js.php";
