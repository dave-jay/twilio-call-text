<div class="MyPageHeader">
    Email Sequence Settings
    <div style="float: right;">
        <?php
                $call_status = qs("select *,value as seq_status from config where `key` = 'EMAIL_SEQUENCE_STATUS' AND  tenant_id='{$_SESSION['user']['tenant_id']}'");
                if (strtolower($call_status['seq_status']) != "on") {
                    $status_img = "<i class='fa fa-exclamation-triangle'></i> OFF";
                    $current_status = "off";
                    $current_style="background-color:#CC1E1E";
                }else{
                    $status_img = "<i class='fa fa fa-check'></i> ON";
                    $current_status = "on";
                    $current_style="background-color:#39891D";
                }
                ?>
                    <div style="font-size: 14px; float: left; padding-top: 15px; color: rgb(110, 86, 86);">Email Sequence &nbsp;</div>
                    <div style="cursor:pointer;float: left; color: white; margin-top: 15px; font-family: verdana; width: 57px; padding: 2px 0px 5px; text-align: center;font-size: 13px;<?php print $current_style; ?>" id="call_status_img_email_seq" onclick="changeEmailSequenceStatus('<?= $current_status; ?>')"><?= $status_img; ?></div>
    </div>
    <div style="clear:both;"></div>
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="my_box first_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day1 Email</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day1_1" data-type="fixed" id="rd_day1_1_sent_fixed" name="rd_day1_1_sent" value="fixed" <?php echo $data['day1_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day1_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day1_1" data-type="dynamic" id="rd_day1_1_sent_dynamic" name="rd_day1_1_sent" value="dynamic" <?php echo $data['day1_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day1_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day1_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day1_1_sent" id="day1_1_sent" value="<?php echo $data['day1_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day1_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day1_1_sent_dynamic_time" id="day1_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day1_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day1_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day1_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day1_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day1_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day1_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Subject</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <input type="text" class="form-control valid" id="day1_1_sent_sub" name="day1_1_sent_sub" aria-invalid="false" value="<?php echo $data['day1_1_sent']['email_subject']; ?>" />
                        </div>  

                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Content</label>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8">
                            <textarea class="form-control valid" id="day1_1_sent_email" name="day1_1_sent_email" aria-invalid="false"><?php echo $data['day1_1_sent']['email_text']; ?></textarea>
                        </div>  

                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day2 Email</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day2_1" data-type="fixed" id="rd_day2_1_sent_fixed" name="rd_day2_1_sent" value="fixed" <?php echo $data['day2_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day2_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day2_1" data-type="dynamic" id="rd_day2_1_sent_dynamic" name="rd_day2_1_sent" value="dynamic" <?php echo $data['day2_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day2_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day2_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day2_1_sent" id="day2_1_sent" value="<?php echo $data['day2_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day2_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day2_1_sent_dynamic_time" id="day2_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day2_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day2_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day2_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day2_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day2_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day2_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Subject</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <input type="text" class="form-control valid" id="day2_1_sent_sub" name="day2_1_sent_sub" aria-invalid="false" value="<?php echo $data['day2_1_sent']['email_subject']; ?>" />
                        </div>  

                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Content</label>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8">
                            <textarea class="form-control valid" id="day2_1_sent_email" name="day2_1_sent_email" aria-invalid="false"><?php echo $data['day2_1_sent']['email_text']; ?></textarea>
                        </div>  

                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day3 Email</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day3_1" data-type="fixed" id="rd_day3_1_sent_fixed" name="rd_day3_1_sent" value="fixed" <?php echo $data['day3_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day3_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day3_1" data-type="dynamic" id="rd_day3_1_sent_dynamic" name="rd_day3_1_sent" value="dynamic" <?php echo $data['day3_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day3_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day3_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day3_1_sent" id="day3_1_sent" value="<?php echo $data['day3_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day3_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day3_1_sent_dynamic_time" id="day3_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day3_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day3_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day3_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day3_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day3_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day3_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Subject</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <input type="text" class="form-control valid" id="day3_1_sent_sub" name="day3_1_sent_sub" aria-invalid="false" value="<?php echo $data['day3_1_sent']['email_subject']; ?>" />
                        </div>  

                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Content</label>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8">
                            <textarea class="form-control valid" id="day3_1_sent_email" name="day3_1_sent_email" aria-invalid="false"><?php echo $data['day3_1_sent']['email_text']; ?></textarea>
                        </div>  

                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day4 Email</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day4_1" data-type="fixed" id="rd_day4_1_sent_fixed" name="rd_day4_1_sent" value="fixed" <?php echo $data['day4_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day4_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day4_1" data-type="dynamic" id="rd_day4_1_sent_dynamic" name="rd_day4_1_sent" value="dynamic" <?php echo $data['day4_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day4_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day4_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day4_1_sent" id="day4_1_sent" value="<?php echo $data['day4_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day4_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day4_1_sent_dynamic_time" id="day4_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day4_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day4_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day4_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day4_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day4_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day4_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Subject</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <input type="text" class="form-control valid" id="day4_1_sent_sub" name="day4_1_sent_sub" aria-invalid="false" value="<?php echo $data['day4_1_sent']['email_subject']; ?>" />
                        </div>  

                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Content</label>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8">
                            <textarea class="form-control valid" id="day4_1_sent_email" name="day4_1_sent_email" aria-invalid="false"><?php echo $data['day4_1_sent']['email_text']; ?></textarea>
                        </div>  

                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day5 Email</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day5_1" data-type="fixed" id="rd_day5_1_sent_fixed" name="rd_day5_1_sent" value="fixed" <?php echo $data['day5_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day5_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day5_1" data-type="dynamic" id="rd_day5_1_sent_dynamic" name="rd_day5_1_sent" value="dynamic" <?php echo $data['day5_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day5_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day5_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day5_1_sent" id="day5_1_sent" value="<?php echo $data['day5_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day5_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day5_1_sent_dynamic_time" id="day5_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day5_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day5_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day5_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day5_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day5_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day5_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Subject</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <input type="text" class="form-control valid" id="day5_1_sent_sub" name="day5_1_sent_sub" aria-invalid="false" value="<?php echo $data['day5_1_sent']['email_subject']; ?>" />
                        </div>  

                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">Email Content</label>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8">
                            <textarea class="form-control valid" id="day5_1_sent_email" name="day5_1_sent_email" aria-invalid="false"><?php echo $data['day5_1_sent']['email_text']; ?></textarea>
                        </div>  

                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>


            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="<?php echo $pipedriver_api_key['value']; ?>" name="hid_api_key" id="hid_api_key">
                <input type="hidden" value="<?php echo $pipedriver_api_key['id']; ?>" name="hid_is_edit" id="hid_is_edit">
                <input type="hidden" value="<?php echo $first_time; ?>" name="is_first_time" id="is_first_time">
                <?php if ($first_time == 1): ?>
                    <button id="btn_submit" class="btn green-btn" type="submit">Save & Continue</button>
                <?php else: ?>
                    <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
                <?php endif; ?>
                <input id="btn_cancel" type="button" class="btn white-btn" value="Cancel">
            </div>
        </form>
    </div>
    <script>
        $("#userForm").validate({
            rules: {
                txt_api_key: "required"
            },
            messages: {
                txt_api_key: "Please enter api key"

            }
        });

        $("#btn_cancel").click(function () {
            $("#txt_api_key").val($("#hid_api_key").val());
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
        .my_box{
            border: 1px solid #1294d5; border-radius: 4px; margin-bottom: 10px;
        }
        .my_box_heading{
            padding: 6px; overflow: auto; background-color: #1294d5; color: white;cursor:pointer;
        }
        .my_box_body{
            padding-top: 14px;display: none;
        }
    </style>


</div>

