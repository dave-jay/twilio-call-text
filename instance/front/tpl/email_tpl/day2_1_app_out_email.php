<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                I want to make sure that you received the application I sent over. Our goal was to have your application in and processed ASAP. Once processed I can work on an approval that will really help you grow your business.
            </p>            
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                Please complete the application and send in the requested documents so I can help you take your business to the next level. We have a lot of clients so the sooner I have your complete application in front of one of my underwriters the better. 
            </p>      
            <?php $email_type = 'app_out'; ?>
            <?php include _PATH . 'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>