<?php include _PATH."instance/front/controller/common_search.inc.php";?>
<div class="uk-section section-sub-nav uk-padding-remove-bottom">
    <div class="uk-container">
        <div uk-grid>
            <div class="uk-width-2-3">
                <ul class="uk-breadcrumb uk-visible">
                    <li><a href="<?php echo _U ?>home">Home</a></li>
                    <li><span>App-Out Sequence</span></li>
                </ul>
            </div>
            <div class="uk-width-1-3">
                <div class="uk-margin">
                    <form class="uk-search uk-search-default">
                        <a href="" class="uk-search-icon-flip" uk-search-icon></a>
                        <input id="autocomplete" class="uk-search-input" type="search" autocomplete="off" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <div class="border-top"></div>
    </div>
</div>

<div class="uk-section uk-section-small uk-padding-remove-bottom section-content">
    <div class="uk-container uk-position-relative">
        <div uk-grid>
            <div class="uk-width-3-4">
                <article class="uk-article">
                    <header>
                        <h1 id='appout_sequence' class="uk-article-title uk-margin-bottom">App-Out Sequence</h1>                        
                    </header>
                    <div class="entry-content uk-margin-medium-top">
                        <p class="uk-text-lead">When deals comes into the 'app-out' stage, App-Out Sequence sends sms and emails to customer on specific time. sequence can be  <a href="<?php echo _U ?>article_seq_basic#sequence_hold">hold for specific time</a> or <a href="<?php echo _U ?>article_seq_basic#sequence_start_stop">stop permanently</a>. </p>
                        <h2 id='appout_seq_sms_time'>SMS timing for initial sequence</h2>
                        <table style="width:100%;text-align: center;">
                            <tr>
                                <th>#</th>
                                <th style='width: 300px;'>Day</th>
                                <th>Time</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Day 1</td>
                                <td>when deal comes into 'app-out' stage</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Day 1</td>
                                <td>after 2 hours</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Day 2</td>
                                <td>08:53 AM</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Day 3</td>
                                <td>02:13 PM</td>
                            </tr>
                        </table>                                                                  
                        <h2 id='appout_seq_email_time'>Email timing for initial sequence</h2>
                        <table style="width:100%;text-align: center;">
                            <tr>
                                <th>#</th>
                                <th style='width: 300px;'>Day</th>
                                <th>Time</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Day 1</td>
                                <td>when deal comes into 'app-out' stage</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Day 2</td>
                                <td>07:42 AM</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Day 3</td>
                                <td>01:36 PM</td>
                            </tr>
                        </table>
                       
                    </div>

              
                    <div class="reply uk-margin-medium-top border-top padding-top">
                        <h3 class="uk-margin-medium-bottom">Leave a Comment</h3>
                        <form class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-2">
                                <input class="uk-input" type="text" placeholder="Name">
                            </div>
                            <div class="uk-width-1-2">
                                <input class="uk-input" type="email" placeholder="Email">
                            </div>
                            <div class="uk-width-1-1">
                                <textarea class="uk-textarea" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="uk-width-1-1">
                                <button class="uk-button uk-button-primary uk-width-1-1 uk-width-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
            <div class="uk-width-1-4">
                <div uk-sticky="offset: 100" class="scrollspy uk-sticky uk-active uk-card uk-card-small uk-card-body uk-padding-remove-top uk-visible">
                    <h3 class="uk-card-title">Table of Contents</h3>
                    <ul class="uk-nav uk-nav-default" uk-scrollspy-nav="closest: li; scroll: true; offset: 30">
                        <li><a href="#appout_sequence">App-Out Sequence</a></li>
                        <li><a href="#appout_seq_sms_time">SMS sequence timing</a></li>
                        <li><a href="#appout_seq_email_time">Email sequence timing</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>