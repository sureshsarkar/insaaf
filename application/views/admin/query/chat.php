<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">


        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">


                    <section class="content-header chng_cls_for_whist">
                        <h1>
                            <a href="<?= base_url("admin/query")?>"><i class="fa fa-chevron-circle-left"></i></a>
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
                                <form action="#" class="" style="display: flex;" id="chatInputForm">
                                    <textarea style="overflow-y: hidden;" type="text" name="message" id="chatInput"
                                        class="inputBox input-field" placeholder="Type a message here..."
                                        autocomplete="off"></textarea>
                                    <button type="submit" class="boxBtn" id="sendButton"><i
                                            class="bi bi-telegram h4"></i></button>
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
var myId = "182";
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
                    window.location.href = "<?= base_url('admin/query/chat/')?>" + tempChatArr[
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
    var url = "<?php echo base_url('admin/query/close_query'); ?>";
    var chatId = "<?= $chatId?>";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: chatId
        },
        success: function(returnVal) {
            //alert(returnVal);
            window.location.href = "<?= base_url('admin/query/chat/')?>" + chatId;
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