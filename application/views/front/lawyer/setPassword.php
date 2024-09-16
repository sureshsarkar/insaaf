<style>
    .set_pass_eye {
    position: absolute;
    top: 30px;
    right: 40px;
    /* z-index: 9999; */
}
</style>
<section>
    <div class="container">
        <div class="setpassword" style="padding:15% 0%;">
            <div class="row">
                <div class="col-md-3 "></div>
                <div class="col-md-6">
                   <form action="<?=base_url()?>lawyer_account/updatepass" method="POST">
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" id="SetNewPassLawyer" name="password" placeholder="Enter New Password"><span ><i class="bi bi-eye-fill set_pass_eye"></i></span>
                            <input type="hidden" class="form-control" id="exampleInputPassword1" name="id" value="<?= $_SESSION['id'] ?>" placeholder="Enter New Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</section>
<script>
    var state=false;
$(".set_pass_eye").click(function(){
    $(this).toggleClass("bi bi-eye-slash-fill");
    if(state){
        document.getElementById("SetNewPassLawyer").setAttribute("type","password");
       state=false;
    }
    else{
        document.getElementById("SetNewPassLawyer").setAttribute("type","text");
        state=true;
    }
});
</script>