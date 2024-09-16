<!-- Lowyer lawyer regiration  Modal   start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="swing-top-fwd" style="font-family: Playfair Display;color:#04367d">Lawyer Registration</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="needs-validation lawyer_register" action="<?=base_url()?>Lawyer_account/register"method="post">
               <div class="accordion" id="accordionExample">
                <div class="card formInnerCon" id="formAreaCon" >
                     <div id="collapseOne" class="show collapse biiling_details_bg " aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        <div class="Register" style=" color:red;"> </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="firstName">First </label>
                                 <input type="text" class="form-control new_control" maxlength="25" id="firstName" placeholder="" name="fname" value="" required="">
                                 <div class="invalid-feedback">
                                    Valid first name is required.
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label for="lastName">Last name</label>
                                 <input type="text" class="form-control new_control" maxlength="25" name="lname" id="lastName" placeholder="" value="" required="">
                                 <div class="invalid-feedback">
                                    Valid last name is required.
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="email">Email <span class="text-muted">*</span></label>
                                 <input type="email" class="form-control new_control" maxlength="128" name="email" id="email" value="" required="required">
                                 <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label for="mobile">Mobile</label>
                                 <input type="text" class="form-control new_control" maxlength="10" id="mobile" name="mobile" value="9511060074">
                                 <div class="invalid-feedback">
                                    Please Enter valid mobile number
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="password">Password <span class="text-muted">*</span></label>
                                 <input type="password" class="form-control new_control" maxlength="255" name="password" id="password" value="" required="required">
                                 <div class="invalid-feedback">
                                    Please enter a valid password address for shipping updates.
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="formInnerCon container hidden" id="loaderAreaCon" >
                     <div class="Row">
                        <div class="col-sm-12 text-center py-3">
                              <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt="" width="20%">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer" style="justify-content:flex-start!important;">
                     <button type="submit" class="btn btn-primary" style="background-color:#04367d;color:white;">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Lowyer Resistration model end-->