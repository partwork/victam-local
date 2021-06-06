<section class="chat-bot-section">
    <img class="chat-bot" src="<?php echo base_url(); ?>application/assets/shared/img/chat_bot.png" width="60" height="60">
    <div class="chatbot-card-wrapper" id="ccw">
        <div class="chatbot-inner-card-wrapper">
            <h6 class="chat-bot-title-box">
                <span>Let's chat - We are online</span>
                <i class="fa fa-times float-right chat-close" aria-hidden="true"></i>
            </h6>

            <div class="conversation-section">
            <ul class="chat-wrapper">
                <li class="from-chat-content-wrap">
                    <img class="from-chat-bot-img" src="<?php echo base_url(); ?>application/assets/shared/img/chat_bot.png">
                    <div class="from-chat">
                        <p class="m-0">Welcome to our site, if you need help simply reply to this message, we are online and ready to help.</p>
                    </div>
                </li>
                <li class="from-chat-content-wrap">
                    <img class="from-chat-bot-img" src="<?php echo base_url(); ?>application/assets/shared/img/chat_bot.png">
                    <div class="from-chat">
                        <p class="m-0">What are you looking for? Please make a selection from below.</p>
                    </div>
                </li>
            </ul>
            <div class="p-3">
                <a class="navigation-option-wrap " href="<?php echo base_url(); ?>events">Events</a>
                <a class="navigation-option-wrap " href="<?php echo base_url(); ?>e/AdvertiseController">Advertisement</a>
                <a class="navigation-option-wrap " href="<?php echo base_url(); ?>who_Is_Who">Companies</a>
                <a class="navigation-option-wrap " href="<?php echo base_url(); ?>match_making">Find Suppliers</a>
                <a class="navigation-option-wrap " href="<?php echo base_url(); ?>forums">Forums</a>
                <a class="navigation-option-wrap " href="<?php echo base_url(); ?>jobs">Jobs</a>
            </div>
            

            <div class="p-3" id="conversation">
            </div>
            </div>
        </div>
        <div class="write-section">
            <form id="chatform" onsubmit="return pushChat();">
                <input type="text" class="form-control" id="wisdom" placeholder="Say Something..(max 20 char)">
                <button type="submit" class="btn send-btn"><i class="fa fa-paper-plane-o" aria-hidden="true" onclick="return pushChat();"></i></button>
            </form>
        </div>
    </div>
</section>

<script>
    // set the focus to the input box
    document.getElementById("wisdom").focus();

    // Initialize the Amazon Cognito credentials provider
    AWS.config.region = 'us-east-1'; // Region
    AWS.config.credentials = new AWS.CognitoIdentityCredentials({
        // Provide your Pool Id here
        IdentityPoolId: 'us-east-1:02755ff1-5263-46a2-af25-fbbd41cf96f0',
        RoleArn: 'arn:aws:iam::511603444393:role/Cognito_dev_victam_lexUnauth_Role',
        AccountId: '511603444393' // your AWS account ID
    });

    AWS.config.credentials.get(function(err) {
        // if (err) console.log(err);
        // else console.log(AWS.config.credentials);
    });
    var lexruntime = new AWS.LexRuntime();
    var lexUserId = 'chatbot-demo' + Date.now();
    var sessionAttributes = {};

    function pushChat() {
        // if there is text to be sent...
        var wisdomText = document.getElementById('wisdom');
        if (wisdomText && wisdomText.value && wisdomText.value.trim().length > 0) {

            // disable input to show we're sending it
            var wisdom = wisdomText.value.trim();
            wisdomText.value = '...';
            wisdomText.locked = true;

            // send it to the Lex runtime
            var params = {
                botAlias: '$LATEST',
                botName: 'navigation_bot',
                inputText: wisdom,
                userId: lexUserId,
                sessionAttributes: sessionAttributes
            };
            showRequest(wisdom);
            lexruntime.postText(params, function(err, data) {
                if (err) {
                    showError('Error:  ' + err.message + ' (see console for details)')
                }
                if (data) {
                    // capture the sessionAttributes for the next cycle
                    sessionAttributes = data.sessionAttributes;
                    // show response and/or error/dialog status
                    showResponse(data);
                }
                // re-enable input
                wisdomText.value = '';
                wisdomText.locked = false;
            });
        }
        // we always cancel form submission
        return false;
    }

    function showRequest(daText) {
        var conversationDiv = document.getElementById('conversation');
        var requestPara = document.createElement("P");
        requestPara.className = 'from-chat-request';
        requestPara.appendChild(document.createTextNode(daText));
        conversationDiv.appendChild(requestPara);
        conversationDiv.scrollTop = conversationDiv.scrollHeight;
    }

    function showError(daText) {
        var conversationDiv = document.getElementById('conversation');
        var errorPara = document.createElement("P");
        errorPara.className = 'lexError';
        errorPara.appendChild(document.createTextNode(daText));
        conversationDiv.appendChild(errorPara);
        conversationDiv.scrollTop = conversationDiv.scrollHeight;
    }

    function showResponse(lexResponse) {
        var conversationDiv = document.getElementById('conversation');
        var responsePara = document.createElement("P");
        responsePara.className = 'from-chat-response';
        if (lexResponse.message) {
            responsePara.appendChild(document.createTextNode(lexResponse.message));
            responsePara.appendChild(document.createElement('br'));
        }
        if (lexResponse.dialogState === 'ReadyForFulfillment') {
            responsePara.appendChild(document.createTextNode(
                'Ready for fulfillment'));
            // TODO:  show slot values
        } else {
            responsePara.appendChild(document.createTextNode(
                '(' + lexResponse.dialogState + ')'));
        }
        conversationDiv.appendChild(responsePara);


        if (lexResponse.responseCard.genericAttachments[0]) {
            let subMenuArr = lexResponse.responseCard.genericAttachments[0].buttons;

            subMenuArr.forEach(function(item, index) {
                var subMenu = document.getElementById("conversation");
                var aTag = document.createElement('a');
                aTag.className = 'navigation-option-wrap';
                let href = "events/online-events";
                aTag.setAttribute('href', item.value);
                aTag.innerText = item.text;
                subMenu.appendChild(aTag);
            });
        }


        // var subMenu = document.getElementById("conversation");
        // var aTag = document.createElement('a');
        // aTag.className = 'navigation-option-wrap';
        // let href = "events/online-events";
        // aTag.setAttribute('href', href);
        // aTag.innerText = "link text";
        // subMenu.appendChild(aTag);


        conversationDiv.scrollTop = conversationDiv.scrollHeight;
    }
</script>