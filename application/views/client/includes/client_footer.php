


<style>
.formInnerGIF {
    display: none;
}
</style>

<!-- model for send Query start -->
<div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="formInnerGIF " id="loaderAreaCon">
                    <div class="row">
                        <div class="col-md-12 text-center py-5">
                            <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt="" width="20%">
                        </div>
                    </div>
                </div>

                <form role="form" class="Form_Class" action="<?php echo base_url() ?>client/Client_query/Send_document"
                    method="post" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Document</label>
                        <input type="file" class="form-control" id="document" name="case_file"
                            placeholder="Enter email">
                    </div>
                    <?php if(!empty($case_category1)){?>
                    <div class="form-group">
                        <label for="text">Your Case Type</label>
                        <select name="case_cat_id" value="" id="case_cat_id" class="form-control" required>
                            <?php foreach($case_category1 as $case_cat){ ?>
                            <option value="<?php echo $case_cat->id ?>"><?php echo $case_cat->name;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label for="text">Enter Your Query</label>
                        <textarea type="text" name="message" class="form-control" placeholder=" Enter Your Query"
                            required> </textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="client_Id" value="<?php echo $_SESSION['id']?>">
                        <input type="hidden" name="client_name" value="<?php echo $_SESSION['name']?>">
                        <input type="hidden" name="client_email" value="<?php echo $_SESSION['email']?>">
                        <input type="hidden" name="client_phone" value="<?php echo $_SESSION['phone']?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary _btn_click">Send Query</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- model for send Query end  -->


<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Admin System | Version 1.0
    </div>
    All rights reserved.
</footer>







<!-- jQuery UI 1.11.2 -->
<!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.2 JS -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>



<script type="text/javascript">
var windowURL = window.location.href;
pageURL = windowURL; //.substring(0, windowURL.lastIndexOf('/'));

var x = $('a[href="' + pageURL + '"]');
x.addClass('active');
x.parent().addClass('active');
var y = $('a[href="' + windowURL + '"]');
y.addClass('active');
y.parent().addClass('active');
</script>
<!-- js for multiple image upload -->


<script type="text/javascript">
function convertToSlug(str) {

    str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();
    str = str.replace(/^\s+|\s+$/gm, '');
    str = str.replace(/\s+/g, '-');
    return str;
}




//I added event handler for the file upload control to access the files properties.
document.addEventListener("DOMContentLoaded", init, false);

//To save an array of attachments
var AttachmentArray = [];

//counter for attachment array
var arrCounter = 0;

//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;

//un ordered list to keep attachments thumbnails
var ul = document.createElement("ul");
ul.className = "thumb-Images";
ul.id = "imgList";

function init() {
    //add javascript handlers for the file upload event
    document
        .querySelector("#files")
        .addEventListener("change", handleFileSelect, false);
}

//the handler for file upload event
function handleFileSelect(e) {
    //to make sure the user select file/files
    if (!e.target.files) return;

    //To obtaine a File reference
    var files = e.target.files;

    // Loop through the FileList and then to render image files as thumbnails.
    for (var i = 0, f;
        (f = files[i]); i++) {
        //instantiate a FileReader object to read its contents into memory
        var fileReader = new FileReader();

        // Closure to capture the file information and apply validation.
        fileReader.onload = (function(readerEvt) {
            return function(e) {
                //Apply the validation rules for attachments upload
                ApplyFileValidationRules(readerEvt);

                //Render attachments thumbnails.
                RenderThumbnail(e, readerEvt);

                //Fill the array of attachment
                FillAttachmentArray(e, readerEvt);
            };
        })(f);

        // Read in the image file as a data URL.
        // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
        // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
        fileReader.readAsDataURL(f);
    }
    document
        .getElementById("files")
        .addEventListener("change", handleFileSelect, false);
}

//To remove attachment once user click on x button
jQuery(function($) {
    $("div").on("click", ".img-wrap .close", function() {
        var id = $(this)
            .closest(".img-wrap")
            .find("img")
            .data("id");

        //to remove the deleted item from array
        var elementPos = AttachmentArray.map(function(x) {
            return x.FileName;
        }).indexOf(id);
        if (elementPos !== -1) {
            AttachmentArray.splice(elementPos, 1);
        }

        //to remove image tag
        $(this)
            .parent()
            .find("img")
            .not()
            .remove();

        //to remove div tag that contain the image
        $(this)
            .parent()
            .find("div")
            .not()
            .remove();

        //to remove div tag that contain caption name
        $(this)
            .parent()
            .parent()
            .find("div")
            .not()
            .remove();

        //to remove li tag
        var lis = document.querySelectorAll("#imgList li");
        for (var i = 0;
            (li = lis[i]); i++) {
            if (li.innerHTML == "") {
                li.parentNode.removeChild(li);
            }
        }
    });
});

//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt) {
    //To check file type according to upload conditions
    if (CheckFileType(readerEvt.type) == false) {
        alert(
            "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, You can only upload jpg/png/gif files"
        );
        e.preventDefault();
        return;
    }

    //To check file Size according to upload conditions
    /*  if (CheckFileSize(readerEvt.size) == false) {
        alert(
          "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB"
        );
        e.preventDefault();
        return;
      }
    */
    //To check files count according to upload conditions
    if (CheckFilesCount(AttachmentArray) == false) {
        if (!filesCounterAlertStatus) {
            filesCounterAlertStatus = true;
            alert(
                "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
            );
        }
        e.preventDefault();
        return;
    }
}

//To check file type according to upload conditions
function CheckFileType(fileType) {
    if (fileType == "image/jpeg") {
        return true;
    } else if (fileType == "image/png") {
        return true;
    } else if (fileType == "image/gif") {
        return true;
    } else {
        return false;
    }
    return true;
}

//To check file Size according to upload conditions
/*function CheckFileSize(fileSize) {
  if (fileSize < 300000) {
    return true;
  } else {
    return false;
  }
  return true;
}*/

//To check files count according to upload conditions
function CheckFilesCount(AttachmentArray) {
    //Since AttachmentArray.length return the next available index in the array,
    //I have used the loop to get the real length
    var len = 0;
    for (var i = 0; i < AttachmentArray.length; i++) {
        if (AttachmentArray[i] !== undefined) {
            len++;
        }
    }
    //To check the length does not exceed 10 files maximum
    if (len > 9) {
        return false;
    } else {
        return true;
    }
}

//Render attachments thumbnails.
function RenderThumbnail(e, readerEvt) {
    var li = document.createElement("li");
    ul.appendChild(li);
    li.innerHTML = ['<div class="img-wrap"> <span class="close">&times;</span>' + '<img class="thumb" src="', e.target
        .result, '" title="', escape(readerEvt.name),
        '" data-id="',
        readerEvt.name,
        '"/>' + "</div>"
    ].join("");

    var div = document.createElement("div");
    div.className = "FileNameCaptionStyle";
    li.appendChild(div);
    div.innerHTML = [readerEvt.name].join("");
    document.getElementById("Filelist").insertBefore(ul, null);
}

//Fill the array of attachment
function FillAttachmentArray(e, readerEvt) {
    AttachmentArray[arrCounter] = {
        AttachmentType: 1,
        ObjectType: 1,
        FileName: readerEvt.name,
        FileDescription: "Attachment",
        NoteText: "",
        MimeType: readerEvt.type,
        Content: e.target.result.split("base64,")[1],
        FileSizeInBytes: readerEvt.size
    };
    arrCounter = arrCounter + 1;
}
</script>


<!-- color picker -->


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
<script src="https://rawgit.com/buberdds/angular-bootstrap-colorpicker/master/js/bootstrap-colorpicker-module.js">
</script>




<!-- Send Query to admin by client to support -->
<script>
$(document).ready(function() {
    var v = '';
    $(".__query_676676").val(v);

    $(".__click_query89").click(function() {

        var value = $(".__query_676676").val();

        if (value == "") {

            $(".msg").css("display", "block");
            $(".msg").html(
                "<div class='red__88'>Please Enter your query ! </div>"
            );

            setInterval(function() {
                $(".msg").css("display", "none");
            }, 5000);
            return false;
        }

        return true;
    });
});
</script>

<Script>
'use strict';

angular.module('colorApp', ['colorpicker.module'])

    .controller('MainCtrl', ['$scope', function($scope) {

        $scope.hexPicker = {
            color: ''
        };

        $scope.rgbPicker = {
            color: ''
        };

        $scope.rgbaPicker = {
            color: ''
        };

        $scope.nonInput = {
            color: ''
        };

        $scope.resetColor = function() {
            $scope.hexPicker = {
                color: '#00a65a'
            };
        };

        $scope.resetRBGColor = function() {
            $scope.rgbPicker = {
                color: 'rgb(0,166,90)'
            };
        };

        $scope.resetRBGAColor = function() {
            $scope.rgbaPicker = {
                color: 'rgb(0,166,90,1)'
            };
        };

        $scope.resetNonInputColor = function() {
            $scope.nonInput = {
                color: '#00a65a'
            };
        };

    }]);
$(document).ready(function() {

    /* code for country state */
    $(".country").change(function() {

        var countryid = $(this).children("option:selected").val();

        //   countryid  =   $(this).filter(':selected').val();

        var listtype = $(this).attr('data-listtype');
        var columnName = $(this).attr('data-columnName');
        var bindId = $(this).attr('data-bindId');
        var dataArr = {
            "listtype": listtype,
            "columnName": columnName,
            "bindId": bindId
        };
        getlist(countryid, dataArr);

    });

    $(".state").change(function() {
        var stateid = $(this).children("option:selected").val();
        var listtype = $(this).attr('data-listtype');
        var columnName = $(this).attr('data-columnName');
        var bindId = $(this).attr('data-bindId');
        var dataArr = {
            "listtype": listtype,
            "columnName": columnName,
            "bindId": bindId
        };
        getlist(stateid, dataArr);

    });

    function getlist(id, dataArr) {
        $.ajax({
            url: "<?php echo base_url('checkout/getList'); ?>",
            method: "POST",
            data: {
                id: id,
                dataArr: dataArr
            },
            success: function(data) {
                $("#" + dataArr['bindId']).html(data);
                $("#" + dataArr['bindId']).css('display', 'block');
                if (dataArr['bindId'] == 'state') {
                    $('.delete').css('display', 'block');
                } else {
                    $(".city_del").css('display', 'block');
                }
            }
        });
    }
    $(".colorpicker").click(function() {
        var colorCode = $("#colorCode").val();
        // 2. Rate the color using NTC
        var ntcMatch = ntc.name(colorCode);
        $("#name").val(ntcMatch[1]);
    });
});
</Script>


<!-- end -->


<script>
// Alert massage
$(function() {
    setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function() {
            $(this).remove();
        });
    }, 5000);
});
</script>

<script>
$(document).ready(function() {
    $("._btn_click").click(function() {
        $(".formInnerGIF").show();
        $(".Form_Class").hide();
    })
});
</script>

<script>
$(document).ready(function() {
    //  Request Call form Data
    $("#RequestCall").click(function() {

        var categoryId = "<?php echo $sub_sub_category_data->id?>";

        if (categoryId == "") {
            alert("No Category Selected");
            return false;
        }

        if (categoryId != "") {
            var con = confirm("Are you sure, you want to request a call?");
            if (con == true) {
                $.ajax({
                    url: "<?php echo base_url('client/Documentation/requesrCall')?>",
                    type: "POST",
                    data: {
                        categoryId: categoryId
                    },
                    success: function(responce) {
                        $(".containerBox").addClass('hidden');
                        $(".detailsCon").addClass('hidden');
                        $(".welcomeDiv").removeClass('hidden');

                    }
                });
            }
        }
    });
});
</script>

<?php if(!isset($chat_hide)){ ?>
<!-- twak to chat Live Chat start -->
<!-- <script type="text/javascript">
var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
(function() {
    var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/62d900ce37898912e95ee14c/1g8fqmamo';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
})();
</script> -->
<!-- Live Chat end -->
<?php } ?>

</body>

</html>