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
                            <a href="<?= base_url("lawyer/query")?>"><i class="fa fa-chevron-circle-left"></i></a> &nbsp;&nbsp;&nbsp; Copy Code
                           </h1>
                        </section>
                    </div><!-- /.box-header -->

                    <!-- body start-->
                    <div class="box-body" style="height: 80vh;">
                        <div class="row">
                            <div class="col-md-8 offset-sm-2">
                                <textarea id="code" name="textArea" class="form-control" rows="8"><?= $code ?></textarea>
                                <br/>
                                <button class="btn btn-sm btn-primary" id="copyBtn" ><small><i class="fa fa-copy"></i> Copy</small></button>
                            </div>

                        </div>
                    </div>
                    <!-- body End-->
                    
                </div>
            </div>
        </section>


        <script>
            $("#copyBtn").click(function(){
                myFunction();
            });
            function myFunction() {
              var copyText = document.getElementById("code");
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
              $("#copyBtn").html('<small><i class="fa fa-copy"></i> Copied!</small>');
              setTimeout(function() {
                 $("#copyBtn").html('<small><i class="fa fa-copy"></i> Copy</small>');
                _fnDestrorySesson();     
              }, 1000);


            }

            // destroy session
            function _fnDestrorySesson(){
                var url = "<?php echo base_url('lawyer/query/copy_code_sess_distroy'); ?>";
                $.ajax(
                {
                    type:"POST",
                    url: url,
                    data: { action:'distroy'},
                    success:function(returnVal)
                    {
                        
                        window.top.close();
                    }
                });
              
            }
            </script>

         

