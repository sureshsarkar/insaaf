<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">


        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <section class="content-header">
                        <h1>
                            <a href="<?= base_url("lawyer/query")?>"><i class="fa fa-chevron-circle-left"></i></a>
                            &nbsp;&nbsp;&nbsp;<?= isset($dbData)?"Chat with - Client":"New Chat" ?>
                        </h1>
                    </section>
                </div><!-- /.box-header -->

                <!-- body start-->
                <div class="box-body">
                    <div class="row">
                        <!-- lawyer details container-->

                        <div class="col-sm-6" style="height:65vh">

                            <?php if(!isset($dbData)){
                                    echo '<div class="text-center"><p>New Query</p></div>';
                                }else{ ?>

                            <div class="p-3 bg-white rounded-xl max-w-lg hover:shadow">

                                <div class="flex justify-between w-full">
                                    <div class="row">

                                        <div class="col-md-4">
                                          <div class="for_jdjjflf__chat">

                                            <img src="https://insaaf99.com/<?= $dbData->image?>" width="150"
                                                class="rounded-lg">
                                          </div>
                                        </div>
                                        <!-- detials sub div-->
                                        <div class="col-md-8">
                                            <div class="for_nec_fghd">
                                            <h4><u><span>Associate Client</span></u></h4>
                                            <!-- name-->
                                            <div class="mr-3">
                                                <p>
                                                    <label
                                                        class="text-gray-400 block titleHeading"><b>Client</b></label>
                                                    <span class="font-bold text-black text-xl">:
                                                        <?php echo trim($dbData->fname)." ".trim($dbData->lname) ?></span>
                                                </p>
                                            </div>
                                            <!-- lawyer_unique_id -->
                                            <div class="mr-3">
                                                <p>
                                                    <label class="text-gray-400 block titleHeading"><b>Client
                                                            ID</b></label>
                                                    <span class="font-bold text-black text-xl">:
                                                        <?php echo $dbData->client_unique_id ?></span>
                                                </p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                                }?>
                        </div>

                        <!-- Chat Section -->
                        <div class="col-sm-6">

                            <section class="chat-area chatSec">
                                <div class="chat-box scrolling-element">
                                    <!-- chat conversation box-->
                                    <div class="chatTextCon" id="chatCon">
                                    </div>
                                </div>

                                <!-- input section -->
                                <?php if($dbData->chat_status == 0){?>
                                <form action="#" class="" id="chatInputForm">
                                    <input type="text" name="message" id="chatInput" class="inputBox input-field"
                                        placeholder="Type a message here..." autocomplete="off">
                                    <button type="submit" class="boxBtn" id="sendButton"><i
                                            class="fa fa-telegram"></i></button>
                                </form>

                                <!--    buttun for ClosedQuerry  -->

                                <div class="row">

                                    <div class="col-md-12">
                                        <div id="visible"> <i class="fa fa-plus-circle _moreinf"></i></div>
                                        <div id="invisible" class="main__plus">
                                            <div class="___dashboad__flex_vtx">
                                                <a href="javascript:void(0)"
                                                    class="btn close__vtx_query btnCloseQuery">Close Query</a>
                                                <a href="<?= base_url('client/create_case?action=lawyer_call&u='.$dbData->id.'&chat_id='.$chatId)?>"
                                                    class=" select__vtx_query" target="_blank">Select Lawyer to Book
                                                    a slot</a>


                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="text-danger w-100">Chat Closed. Closed By <b
                                        class="text-danger"><?= $dbData->closed_by?></b></div>
                                <?php } ?>
                                <!-- End  buttun for ClosedQuerry  -->

                            </section>



                        </div>
                    </div>
                    <!-- body End-->

                </div>
            </div>
    </section>
                                </div>


    <!-- Get Databse List -->

    <script type="text/javascript">
    window.chatOpenStatus = "<?= ($dbData->chat_status == 1)?false:true?>";
    window.chatId = "<?php echo (isset($chatId) && !empty($chatId) )?$chatId:''?>";
    var myId = "<?php echo $_SESSION['id'] ?>";
    var chatArr;
    window.lastChatId = '';
    window.msg = '';
    $(document).ready(function() {
        if (window.chatId != '') {
            _refresh();
        }

    });





    async function _refresh() {
        var url = "<?= base_url('chat_refresh/chat_refresh') ?>";
        var msg = window.msg;
        window.msg = '';

        await $.ajax({
            url: url,
            type: 'POST',
            data: {
                chatId: window.chatId,
                userType: "lawyer",
                msg: msg,
                userId: myId,
                latChatId: window.lastChatId
            },
            success: function(result) {
                console.log(result);
                if (result == 'no_have_new') {
                    //console.log("no have new")    ;
                } else {
                    //console.log("new");
                    tempChatArr = JSON.parse(result);

                    if (typeof tempChatArr['new_query'] !== "undefined") {
                        window.location.href = "<?= base_url('lawyer/query/chat/')?>" + tempChatArr[
                            'chatId'];
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
                            val['msg'] =
                                '<div class=""><h5 class="chat_heading">Book a slot for video consultation</h5><p><label class="lHead"> Lawyer ID </label> : ' +
                                tempArr['unique_id'] +
                                '</p><p><label class="lHead"> Lawyer </label> : ' + tempArr[
                                    'Lawer'] +
                                '</p><p><label class="lHead"> Experience </label> : ' + tempArr[
                                    'experience'] +
                                '</p><p><label class="lHead"> Meeting At </label> : ' + tempArr[
                                    'php_dateTime'] +
                                '</p><div><a href="#" class="btn btn-sm btn-primary" >Book Now</a></div></div>';
                            //<p><label class="lHead"> Practice </label> : '+tempArr['practice_area']+'</p>
                            // console.log(tempArr);
                        }

                        $("#chatCon").append('<div class="chat ' + type +
                            '"><div class="details"><p>' + val['msg'] +
                            '<br/><span class="dt" >' + val['dateAt'] + '</span> ' + check +
                            '</p></div></div>');
                        lastId = val['id'];
                    });
                    window.lastChatId = lastId;

                }
            }
        });

        // refresh page again    
        setTimeout(() => {
            if (window.chatOpenStatus) {
                _refresh();
            }

        }, "1000")
    }




    // setTimeout()





    $("#chatInputForm").submit(function() {
        submitMsg();
        return false;
    });
    $("#sendButton").click(function() {
        submitMsg();
    });

    function submitMsg() {
        var msg = $("#chatInput").val();
        $("#chatInput").val('');
        if (msg != '') {
            window.msg = msg;
        }
        if (window.chatId == '') {
            //save function call for new conversation
            _refresh();
        }
    }



    // CLOSE QUERY ===============================
    $(".btnCloseQuery").click(function() {
        var url = "<?php echo base_url('lawyer/query/close_query'); ?>";
        var chatId = "<?= $chatId?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: chatId
            },
            success: function(returnVal) {
                //alert(returnVal);
                window.location.href = "<?= base_url('lawyer/query/chat/')?>" + chatId;
            }
        });
    });
    </script>






    <!-- bookslotinformationscript -->


    <script>
    $(function() {
        $("#visible").click(function() {
            $("#invisible").toggleClass("show");
        });
    });
    </script>











    <style type="text/css">
    .main__plus {
        display: none;
    }

    .show {
        display: block !important;
        z-index: 99999999999;
    }

    .___dashboad__flex_vtx a {
        display: inline-flex;
    }

    .___dashboad__flex_vtx {
        position: absolute;
        top: -10px;
        left: 40px;

    }

    .close__vtx_query {
        background: #ff9100;
        color: #fff;
        padding: 5px;
    }
    .close__vtx_query:hover {
        color: #fff;
    }

    .select__vtx_query {
        background: #1a243f;
        color: #fff;
        padding: 6px;
    }
    .select__vtx_query:hover {
        color: #fff !important;
    }

    div#visible i {
        color: white;
    }

    /*----------------------------*/


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
        max-height: 400px;
        overflow-y: scroll;
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
      background: #bdc3c7;
      background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);
      background: linear-gradient(to right, #409fff, #43009d); 
        color: white;
        border-radius: 18px 18px 0 18px;
        padding: 8px 16px;
        box-shadow: 0 0 32px rgb(0 0 0 / 8%),
            0rem 16px 16px -16px rgb(0 0 0 / 10%);
            font-weight: 500;

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
      background: #c94b4b;
    background: -webkit-linear-gradient(to right, #4b134f, #c94b4b);
    background: linear-gradient(to right, #df7ee5, #000000);
    color: white;
    font-weight: 500;
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
        border-radius: 5px 0 0 5px;
    }

    .boxBtn {
        color: #fff;
        width: 55px;
        height: 45px;
        border: none;
        outline: none;
        background: #1a243f;
        font-size: 19px;
        cursor: pointer;
        opacity: 0.7;
        /*  pointer-events: none;*/
        border-radius: 0 5px 5px 0;
        transition: all 0.3s ease;
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
            padding: 0px;
        }

        .chat-area form input {
            height: 40px;
            width: calc(100% - 48px);
        }

        .chat-area form button {
            width: 45px;
        }
    }

    div::-webkit-scrollbar {
        width: 10px;
    }

    div::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }

    div::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
    }

    .for_jdjjflf__chat img{
      border-radius: 50%;
    width: 180px;
    height: 180px;
    object-fit: cover;
    }
    .for_nec_fghd h4 u span {
    font-weight: 700;
    color: #1a243f;
    border-bottom: none;
    text-decoration: none;
    font-size: 17px;
}
.for_nec_fghd {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 158px;
}
    </style>