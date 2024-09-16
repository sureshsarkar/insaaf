<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">
        <!-- left column -->
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box pb-2">
                        <div class="box-header">
                            <section class="content-header">
                                <h1>
                                    <a href="<?= base_url("client/query")?>"><i class="bi bi-arrow-left"></i></a>
                                    &nbsp;&nbsp;&nbsp;<?= isset($lawyer)?"Chat with - Lawyer":"<span class='titleMessage' >Send Query</span> <small>(First query <b>Free</b>)</small> " ?>
                                </h1>
                            </section>
                        </div><!-- /.box-header -->

                        <!-- body start-->
                        <div class="box-body">
                            <div class="row">
                                <?php if(!isset($lawyer)){?>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="themebox text-center">

                                                <!-- progress page -->
                                                <div class="for_bg_color_cont_us progressCon hidden">
                                                    <div class="row py-5">
                                                        <div class="col-md-12 text-center">
                                                            <img src="<?= base_url('assets/images/progress.gif')?>"
                                                                width="130">
                                                            <br /><br />
                                                            <p class="text-success">Sending....</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end progress con -->

                                                <!-- message con-->
                                                <div class="messageCon hidden firstBox py-5">
                                                    <img src="<?= base_url('assets/images/success.png')?>" width="100">
                                                    <h1 class="text-success">Thank you for contacting us!</h1>
                                                    <div>
                                                        <h3>Your query will be answered within 48 hours<br /><span
                                                                class="dt"></span> </h3>
                                                    </div>
                                                    <a href="<?= base_url('client/create_case') ?>"
                                                        class="mb-1 btn btn-success"><i class="bi bi-person"></i>
                                                        Consult a lawyer</a>
                                                    <a href="<?= base_url('client/dashboard') ?>"
                                                        class="mb-1 btn btn-primary"><i class="bi bi-house"></i>
                                                        Home</a>
                                                    <a href="<?= base_url('client/documentation') ?>"
                                                        class="mb-1 btn btn-warning"> <i
                                                            class="bi bi-file-earmark-text"></i> Documentation</a>
                                                </div>

                                                <!-- form container-->
                                                <form action="" class="px-4" id="chatInputForm_1">
                                                    <textarea placeholder="Write your query, brief description" rows="5"
                                                        name="message" id="chatInput"
                                                        class="form-control message232 messageText" value=""></textarea>
                                                    <br />

                                                    <button type="submit" class="btn btn-success pull-right "
                                                        id="sendButton">Send</button>
                                                </form>
                                                <!--// form container-->
                                            </div>


                                        </div>
                                        <!-- <div class="col-md-4">
                                            <img src="<?= base_url('assets/images/query.png') ?>" class="img-fluid" >
                                        </div> -->
                                    </div><!-- end row-->
                                </div><!-- end col- 6-->
                                <?php     }else{ ?>
                                <?php if(isset($lawyer) && !empty($lawyer)){?>
                                <div class="col-sm-6" style="height:65vh">
                                    <div class="p-3 bg-white rounded-xl max-w-lg hover:shadow">
                                        <!-- hide for some reason-->
                                        <div
                                            class="flex justify-between w-full <?= (isset($firsMessage) && $firsMessage)?'hidden':'' ?> ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <img src="https://insaaf99.com/<?= $lawyer->image?>" width="150"
                                                        class="rounded-lg">
                                                </div>
                                                <!-- detials sub div-->
                                                <div class="col-sm-8">
                                                    <h4><u><span>Associate Lawyer</span></u></h4>
                                                    <!-- name-->
                                                    <div class="mr-3">
                                                        <p>
                                                            <label
                                                                class="text-gray-400 block titleHeading"><b>Lawyer</b></label>
                                                            <span class="font-bold text-black text-xl">:
                                                                <?php echo trim($lawyer->fname)." ".trim($lawyer->lname) ?></span>
                                                        </p>
                                                    </div>
                                                    <!-- lawyer_unique_id -->
                                                    <div class="mr-3">
                                                        <p>
                                                            <label class="text-gray-400 block titleHeading"><b>Lawyer
                                                                    ID</b></label>
                                                            <span class="font-bold text-black text-xl">:
                                                                <?php echo $lawyer->lawyer_unique_id ?></span>
                                                        </p>
                                                    </div>


                                                    <!-- experience -->
                                                    <div class="mr-3">
                                                        <p>
                                                            <label
                                                                class="text-gray-400 block titleHeading"><b>Experience</b></label>
                                                            <span class="font-bold text-black text-xl">:
                                                                <?php echo $lawyer->experience ?></span>
                                                        </p>
                                                    </div>

                                                    <!-- practice_area -->
                                                    <div class="mr-3">
                                                        <p>
                                                            <label class="text-gray-400 block titleHeading"><b>Practice
                                                                    Area</b></label>
                                                            <span class="font-bold text-black text-xl">:
                                                                <?php echo $lawyer->practice_area ?></span>
                                                        </p>
                                                    </div>

                                                    <!-- enrolement_no -->
                                                    <div class="mr-3">
                                                        <p>
                                                            <label class="text-gray-400 block titleHeading"><b>Enrolement
                                                                    No.</b></label>
                                                            <span class="font-bold text-black text-xl">:
                                                                <?php echo $lawyer->enrolement_no ?></span>
                                                        </p>
                                                    </div>

                                                    <!-- enrolement_no -->
                                                    <div class="mr-3">
                                                        <p>
                                                            <label class="text-gray-400 block titleHeading"><b>Bar
                                                                    Councle</b></label>
                                                            <span class="font-bold text-black text-xl">:
                                                                <?php echo $lawyer->bar_councle?></span>
                                                        </p>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <!-- // hidden area-->
                                        <!-- Convrsationarea message -->

                                        <!-- // hidden area-->
                                    </div>

                                    <?php } }?>
                                </div>

                                <!-- Chat Section -->
                                <?php if(isset($lawyer)){ ?>
                                <div class="col-sm-6">
                                    <section class="chat-area chatSec">
                                        <div class="chat-box scrolling-element ___scrollchat">
                                            <!-- chat conversation box-->
                                            <div class="chatTextCon" id="chatCon">
                                                <h2 class="_massagescreen">start new conversations</h2>
                                            </div>
                                        </div>

                                        <!-- input section -->
                                        <?php if(isset($lawyer->chat_status) && $lawyer->chat_status == 1){?>
                                        <div class="text-danger w-100">Chat Closed. Closed By <b
                                                class="text-danger"><?= $lawyer->closed_by?></b></div>
                                        <?php }else{ ?>

                                        <div class="chatTextArea">
                                            <form action="#" class="" id="chatInputForm" style="display: flex;">
                                                <textarea type="text" name="message" id="chatInput"
                                                    class="inputBox input-field" placeholder="Type a message here..."
                                                    autocomplete="off"></textarea>
                                                <button type="submit" class="boxBtn" id="sendButton"><i
                                                        class="fa fa-telegram"></i></button>

                                            </form>
                                        </div>

                                        <?php } ?>



                                    </section>
                                </div>
                                <!-- end chat section-->
                                <?php }  ?>
                            </div>
                            <!-- body End-->
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>

</div>
<!-- Get Databse List -->

<script type="text/javascript">
window.chatOpenStatus = "<?= (isset($lawyer->chat_status) && $lawyer->chat_status == 1)?false:true?>";
window.chatId = "<?php echo (isset($chatId) && !empty($chatId) )?$chatId:''?>";
var myId = "<?php echo $_SESSION['id'] ?>";
var chatArr;
window.lastChatId = '';
window.refreshStatus = true;
window.msg = '';
$(document).ready(function() {
    if (window.chatId != '') {
        _refresh();
    }

});

var firstConversation = '<?= (isset($firsMessage) && $firsMessage)?true:false?>';


async function _refresh() {
    if (window.refreshStatus == false) {
        return false;
    }
    var url = "<?= base_url('chat_refresh/chat_refresh') ?>";
    var msg = window.msg;
    window.msg = '';
    await $.ajax({
        url: url,
        type: 'POST',
        data: {
            chatMessage: 1,
            chatId: window.chatId,
            userType: "client",
            msg: msg,
            userId: myId,
            latChatId: window.lastChatId
        },
        success: function(result) {
            //console.log(result);
            if (result == 'no_have_new') {
                //console.log("no have new")    ;
            } else {
                //console.log("new");
                tempChatArr = JSON.parse(result);

                if (typeof tempChatArr['new_query'] !== "undefined") {
                    //window.location.href = "<?= base_url('client/query/chat/')?>"+tempChatArr['chatId'];
                    window.refreshStatus = false;
                    return false;
                }
                $("#chatCon").html("");
                var lastId = '';
                $.each(tempChatArr, function(id, val) {
                    var type = (myId == val['user_id']) ? 'outgoing' : 'incoming';
                    var check = '';
                    if (myId == val['user_id'] && val['seen'] == 1) {
                        check = '<i class="bi bi-check2-all"></i>';
                    } else if (myId == val['user_id'] && val['seen'] == 0) {
                        check = '<i class="bi bi-check2"></i>';
                    }

                    // check if book now exist in chat
                    if (val['msg'].includes("--complete_slot--")) {
                        var temp = val['msg'].replace("--complete_slot--", "");
                        // base64 decode 
                        let dec = atob(temp);
                        var tempArr = JSON.parse(dec);
                        var slug = "<?= base_url('client/query/slot_book/')?>" + val['id'];
                        val['msg'] =
                            '<div class=""><h5 class="chat_heading">Book a slot for video consultation</h5><p><label class="lHead"> Lawyer ID </label> : ' +
                            tempArr['unique_id'] +
                            '</p><p><label class="lHead"> Lawyer </label> : ' + tempArr[
                                'Lawer'] +
                            '</p><p><label class="lHead"> Experience </label> : ' +
                            tempArr['experience'] +
                            '</p><p><label class="lHead"> Meeting At </label> : ' + tempArr[
                                'php_dateTime'] + '</p><div><a href="' + slug +
                            '" class="btn btn-sm btn-primary" >Book Now</a></div></div>';
                        //<p><label class="lHead"> Practice </label> : '+tempArr['practice_area']+'</p>
                        console.log(tempArr);
                    }
                    window.chatOpenStatus = (val['status'] == 0) ? true : false;
                    $("#chatCon").append('<div class="chat ' + type +
                        '"><div class="details"><p>' + val['msg'] +
                        '<br/><span class="dt" >' + val['dateAt'] + '</span> ' + check +
                        '</p></div></div>');
                    lastId = val['id'];
                });

                if (firstConversation) {

                    $("#chatCon").append(
                        '<div class="chat incoming "><div class="details"><p>Thank you for submitting your query. We will contact you in 48 Hours!!<br/><span class="dt" ></span> </p></div></div>'
                    );
                    $("#chatCon").append(
                        '<a href="<?= base_url('client/create_case') ?>" class="mb-1 btn btn-success"><i class="bi bi-person"></i> Consult with lawyer</a>&nbsp;'
                    );
                    $("#chatCon").append(
                        '<a href="<?= base_url('client/dashboard') ?>" class="mb-1 btn btn-primary"><i class="bi bi-house"></i> Home</a>&nbsp'
                    );
                    $("#chatCon").append(
                        '<a href="<?= base_url('client/documentation') ?>" class="mb-1 btn btn-warning"> <i class="bi bi-file-earmark-text"></i> Documentation</a>'
                    );
                }
                window.lastChatId = lastId;

            }
        }
    });

    // refresh page again    
    setTimeout(() => {
        if (window.chatOpenStatus) {
            _refresh();
        } else {
            $("#chatInputForm").remove();
            $(".chatTextArea").html("<p style='color:white;'>Your query closed.</p>");
        }
    }, "100")
}

$("#sendButton").click(function() {

    var tempMsg = $("#chatInput").val();
    if (tempMsg.length < 1) {
        alert("Write your query.");
        return false;
    } else if (tempMsg.length < 10) {
        alert("Write your query minimum 10 word !");
        return false;
    } else {
        submitMsg();
        $("#chatInputForm_1").remove();
        $(".progressCon").removeClass("hidden");
        setTimeout(function() {
            thanks_screen();
        }, 2000);



    }

});

$("#chatInputForm").submit(function() {
    $("#chatInputForm").remove();
    $(".progressCon").removeClass("hidden");
    submitMsg();
    setTimeout(function() {
        thanks_screen();
    }, 2000);

    return false;
});


// $("#sendButton").click(function(){
//         submitMsg();                
// });

function submitMsg() {
    var tempMsg = $("#chatInput").val();
    $("#chatInput").val('');
    if (tempMsg != '') {
        window.msg = tempMsg;
    }
    if (window.chatId == '') {
        //save function call for new conversation
        _refresh();
    }
}


function thanks_screen() {
    $(".progressCon").addClass("hidden");
    $(".titleMessage").text("Query sent");
    $(".messageCon").removeClass("hidden");
    window.refreshStatus = false;
}
</script>





<style type="text/css">
.mb-1 {
    margin-bottom: 5px;
}

._massagescreen {

    position: relative;
    top: -185px;
    left: 52px;
    font-size: 20px;
}

/*---------------------------*/

.chat_heading {
    border-bottom: 1px solid #c7c7c7;
    font-size: 12px;
    font-weight: 700;
}

.lHead {
    width: 60px;
    font-size: 12px;
}

.chatSec {
    position: fixed;
    width: 310px;
    bottom: 0;
    right: 0;
    z-index: 9999;
    /* height: 450px; */
    padding: 12px 7px;
    border: 2px solid #354e87;
    border-radius: 15px 15px 0px 0px;
    background: linear-gradient(to right, #182848, #4b6cb7);
}

/*.scrolling-element{
  transform:;
  }
*/
/* Chat Area CSS Start */
.input-box {
    background: #e9b2b2;
}

.titleHeading {
    width: 100px;
}

.chatTextArea i {
    position: relative;
    top: 1px;
    right: -3px;
}





.details .dt {
    font-size: 10px;
}

.chat-area header {
    display: flex;
    align-items: center;
    padding: 18px 30px;
}

.chat-area header .back-icon {
    color: #333;
    font-size: 18px;
}

.chat-area header img {
    height: 45px;
    width: 45px;
    margin: 0 15px;
}

.chat-area header .details span {
    font-size: 17px;
    font-weight: 500;
}

.chat-box {
    display: flex;
    flex-direction: column-reverse;
    position: relative;
    min-height: 400px;
    max-height: 550px;
    overflow: auto;
    padding: 0px;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
        inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}

.chat-box .text {
    position: absolute;
    top: 45%;
    left: 50%;
    width: calc(100% - 50px);
    text-align: center;
    transform: translate(-50%, -50%);
}

.chat-box .chat {
    margin: 15px 0;
}

.chat-box .chat p {
    word-wrap: break-word;
}

.chat-box .outgoing {
    display: flex;
}

.chat-box .outgoing .details {
    margin-left: auto;
    max-width: calc(100% - 30px);
}

.outgoing .details {
    color: #000;
    background: #54f6ff;
    border-radius: 18px 18px 0 18px;
    padding: 8px 16px;
    box-shadow: 0 0 32px rgb(0 0 0 / 8%),
        0rem 16px 16px -16px rgb(0 0 0 / 10%);

}

.___scrollchat::-webkit-scrollbar {
    width: 0px !important;
}


.chat-box .incoming {
    display: flex;
    align-items: flex-end;
}

.chat-box .incoming img {
    height: 35px;
    width: 35px;
}

.chat-box .incoming .details {
    margin-right: auto;
    margin-left: 10px;
    max-width: calc(100% - 10px);
}

.incoming .details {
    background: #f0d4ff;
    color: #333;
    border-radius: 18px 18px 18px 0;


    padding: 8px 16px;
    box-shadow: 0 0 32px rgb(0 0 0 / 8%),
        0rem 16px 16px -16px rgb(0 0 0 / 10%);
}

.typing-area {
    padding: 18px 30px;
    display: flex;
    justify-content: space-between;
}

.inputBox {
    height: 45px;
    width: calc(100% - 58px);
    font-size: 16px;
    padding: 0 13px;
    border: 1px solid #e6e6e6;
    outline: none;
    border-radius: 10px;
    overflow: hidden;
}

#chatInputForm {
    margin-bottom: 0;
}

.boxBtn {
    font-size: 5rem;
    color: #f0ffee;
    width: 45px;
    height: 45px;
    border: none;
    outline: none;
    background: transparent;
    border-radius: 100%;
    font-size: 19px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.boxBtn i {
    font-size: 4rem;
    color: #fff;
}

.typing-area button.active {
    opacity: 1;
    pointer-events: auto;
}

/* Responive media query */
@media screen and (max-width: 450px) {

    .form,
    .users {
        padding: 20px;
    }

    .form header {
        text-align: center;
    }

    .form form .name-details {
        flex-direction: column;
    }

    .form .name-details .field:first-child {
        margin-right: 0px;
    }

    .form .name-details .field:last-child {
        margin-left: 0px;
    }

    .users header img {
        height: 45px;
        width: 45px;
    }

    .users header .logout {
        padding: 6px 10px;
        font-size: 16px;
    }

    :is(.users, .users-list) .content .details {
        margin-left: 15px;
    }

    .users-list a {
        padding-right: 10px;
    }

    .chat-area header {
        padding: 15px 20px;
    }

    .chat-box {
        min-height: 400px;
        padding: 10px 15px 15px 20px;
    }

    /* .chat-box .chat p{
    font-size: 15px;
  }*/
    .chat-box .outogoing .details {
        max-width: 230px;
    }

    .chat-box .incoming .details {
        max-width: 265px;
    }

    .incoming .details img {
        height: 30px;
        width: 30px;
    }

    .chat-area form {
        padding: 20px;
    }

    .chat-area form input {
        height: 40px;
        width: calc(100% - 48px);
    }

    .chat-area form button {
        width: 45px;
    }
}
</style>