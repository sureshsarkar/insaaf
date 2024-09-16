<div class="row"  style="padding: 10px 20px; margin-top: 40px;">
	<div class="col-md-12" >
		<h4>Following are the associate Lawyers who have expertise in the <?= $catData->name?> field. One of them will contact on the slot selected by you.</h4>
	</div><br/>
	   <div class="row">
          		<?php 
          		if(!empty($all_lawyer)){
          		foreach($all_lawyer as $lawyer){ ?>
          			<?php 
          				$lawyer_class = '';
          				$case_cat_array = json_decode($lawyer->category);
          				foreach($case_cat_array as $case_cat){
          					$lawyer_class .= ' lawyer_div_'.$case_cat;
          				}
          			?>
               <div class="col-md-4 col-6 law_div <?php echo $lawyer_class; ?>">
                    <div class="d-flex __space_work">
					  <div class=" __save_bg"><img src="<?=base_url()?>assets/images/defult_image.png" class="img-fluid"></div>
					  <div class="Head_name">
						<h4> <b> <?php echo $lawyer->fname." ".$lawyer->lname; ?></b></h4>
						<div class="d-flex  forhdhdh_clint ">
							<div class="For_Wind_ins"><b>Lawyer id</b></div>
							<div class=""> : <?php echo $lawyer->lawyer_unique_id; ?></div>
						</div>
						<div class="d-flex  forhdhdh_clint ">
							<div class="For_Wind_ins"><b>Experience</b></div>
							<div class=""> : <?php echo $lawyer->experience; ?></div>
						</div>
						<div class="d-flex  forhdhdh_clint ">
							<div class="For_Wind_ins"><b>Bar Council </b></div>
							<div class="new_eldiidp"> : <?php echo $lawyer->bar_councle; ?></div>
						</div>
						<div class="inline__flex">
							<!-- <div class="pop_maine">
								<a href="#popup_<?php echo $lawyer->id; ?>" class=""><button class="button_news">View</button></a>
							</div> -->
							<div id="popup_<?php echo $lawyer->id; ?>" class="overlayop">
								<div class="popup Name_cnhte">
									<a class="close" href="#">&times;</a>
									<p><i class="fa fa-user" aria-hidden="true"></i><b><?php echo $lawyer->fname." ".$lawyer->lname; ?></b></p>
									<div class="bo_design">
										<div class="d-flex  forhdhdh_clint flex-row">
											<div class="chng_cls"><b>Lowyer id</b></div>
											<div class=""> : <?php echo $lawyer->lawyer_unique_id; ?></div>
										</div>
										<div class="d-flex  forhdhdh_clint flex-row">
											<div class="chng_cls"><b>Email id</b></div>
											<div class=""> : <?php echo $lawyer->email; ?></div>
										</div>
										<div class="d-flex  forhdhdh_clint flex-row">
											<div class="chng_cls"><b>Experience</b></div>
											<div class=""> : <?php echo $lawyer->experience; ?></div>
										</div>
										<div class="d-flex  forhdhdh_clint flex-row">
											<div class="chng_cls"><b>Bar Councle</b></div>
											<div class=""> : <?php echo $lawyer->bar_councle; ?></div>
										</div>
										<div class="d-flex  forhdhdh_clint flex-row">
											<div class="chng_cls"><b>Practice Area</b></div>
											<div class=""> : <?php echo $lawyer->practice_area; ?> </div>
										</div>
										
									</div>
									<span class="open_top"><b>Lawyer Case Categories</b></span class="open_top">
									<div class="checkbox_under">
										<?php 
											foreach($case_cat_array as $case_cat2){
					          					$get_cat = $this->db->get_where('case_category', ['id'=> $case_cat2])->row();
										?>
										<div class="form-check form-check-inline">
											<i class="fa fa-check-circle-o" aria-hidden="true"></i>
											<label class="form-check-label for_chchek_colr"><?php echo $get_cat->name; ?></label>  
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<!-- <div class="for_nextdjijdf">
								<a href="<?php echo base_url('client/create_case/ajax3/'.base64_encode($lawyer->id)); ?>"><button>Select</button></a>
							</div>  -->
						</div>
					  </div>
					</div>
          </div>
              <?php } ?>
           </div><br/>   
           <div class="col-md-12 text-center ">
           		<a href="<?php echo base_url('client/create_case/ajax3/') ?>" class="btn btn-primary btnNext " >Next &nbsp; <i class="bi bi-arrow-right"></i> </a>
           </div>   
            <?php }else{ ?>
              	<div class="container">
              		<div class="row">
              			<div class="col-md-12 py-3">
              				 <p>No have lawyer in this category!!</p>
              			</div>
              		</div>
              		
              	</div>
              <?php } ?>
       </div>