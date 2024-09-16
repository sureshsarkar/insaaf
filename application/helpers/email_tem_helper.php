<?php if(!defined('BASEPATH')) exit('No direct script access allowed');




function get_email_temp($heading,$content){

    $templete='
    <table width="100%">
	<tbody>
		<tr>
			<td align="center" width="700">
				<table width="700" style="border:1px solid #000;padding:0px;margin:0px">
					<tbody>
						<tr>
							<td>
								<table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px" width="100%">
									<tbody>
								
										<tr>
											<td style="padding-top:0px;padding-bottom:0px;margin:0px;vertical-align:middle;background-color:#202327"
												valign="middle" width="100%">
												<table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"width="100%">
													<tbody>
                                                  
														<tr>
															<td style=" padding-left: 12px;">&nbsp;</td>

															<td style="padding-top:0px;padding-bottom:0px;margin:0px;vertical-align:middle" valign="middle" width="46%">
																<table style="padding:0px;margin:0px" width="100%">
																	<tbody>
																		<tr>
																			<td align="left" style="padding-left:0px;margin:0px;color:#ffffff;font-size:30px;line-height:36px;font-weight:bold" valign="middle">
                                                                            <span><img src="https://insaaf99.com/assets/images/insaaf_logo.png" alt="Logo" style="width:70px;"></span>
                                                                              <br>
																				<span style="color: #ff6b02;font-family:Montserrat, sans-serif;">
																					Insaaf99
																				</span>
																				<br>
																			</td>
																		</tr>
																		<tr>
																			<td align="left" style="padding-left:0px;margin:0px;color:#ffffff;font-size:20px;line-height:24px; font-family: Montserrat, sans-serif;" valign="middle">
																				We Believe That Right Information Helps You Make Better Decisions.
																			</td>
																		</tr>
																		<tr>
																			<td align="left" style="padding-top:20px; font-family:Montserrat, sans-serif;" valign="middle"></td>
																		</tr>
																	</tbody>
																</table>
															</td>
															<td style="padding-top:0px;padding-bottom:0px;margin:0px"
																width="54%">
																<table style="padding:0px;margin:0px" width="100%">
																	<tbody>
																		<tr>
																			<td align="left" style="padding:0px;margin:0px"><img alt="Header" src="https://insaaf99.com/assets/images/unnamed-1.jpg" width="100%" tabindex="0"></td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td style="padding-left:10px">&nbsp;</td>
											<!-- dinamic content start  -->
											<td style="padding-top:26px;margin:0px;width:100%" valign="top">
												<table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"width="100%">
													<tbody>
														<tr>
															<td style="padding-right: 10px;padding-top:0px;margin-bottom:50px"
																valign="top" width="100%">
																<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-top:0px;margin:0px"
																				valign="top" width="100%">
																				<table align="left" border="0"cellpadding="0" cellspacing="0" width="100%">
																					<tbody>
																						<tr>
																							<td align="left" style="
                                                                                              box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
																								padding-bottom: 10px;
																								color: #000000;
																								font-size: 16px;
																								font-family: Montserrat, sans-serif;
																								background: #ffffff;
																								padding-top: 10px;">
																								'.$heading.'
																						   </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																		<tr>
																			<td style="padding-top:0px;margin:0px"
																				valign="top" width="50%">
																				<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #d0d0d0;padding: 10px;table-layout:fixed;width:100%;">
																					<tbody>
																						'.$content.'
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
											<!-- dinamic content end  -->
										</tr>
									</tbody>
								</table>

								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td style="padding-left:50px">&nbsp;</td>
											<td style="margin:0px;padding-top:35px" valign="top" width="100%">
											</td>
										</tr>
									</tbody>
								</table>
								<table cellpadding="0" cellspacing="0" width="100%" style="text-align:center;">
									<tbody>
										<tr>
											<td align="center" style="border-top: 1px solid #d0d0d0;
											text-align: center;
											padding-right: 20px;
											padding-left: 20px;
											font-size: 12px;
											padding-top: 12px;
											padding-bottom: 12px;
											background: #e7e7e7;
											border-bottom: 1px solid #d0d0d0;
											font-family: Montserrat, sans-serif;">
											Connect with lawyers online in India for legal advice. We provide seamless lawyer consultation, document services and other legal solutions.Talk to	our consultants now.</td>
										</tr>
										<tr>
										</tr>
									</tbody>
								</table>
								<table cellpadding="0" cellspacing="0" width="100%" style="text-align:center;padding-top: 5px;">
									<tbody>
										<tr>
											<td style="font-size:20px; font-weight:700;text-align:center; font-family: Montserrat, sans-serif; padding-right: 20px;padding-left: 20px;">
												Connect:
											</td>
										</tr>
										<tr>
											<td align="center" style="font-size:12px;text-align:center; font-family: Montserrat, sans-serif; padding-right: 20px;padding-left: 20px;padding-top: 8px;">
												Land-Line: 1800-212-9001
											</td>
										</tr>
										<tr>
											<td align="center" style="font-size:12px;text-align:center; font-family: Montserrat, sans-serif; padding-right: 20px;padding-left: 20px;padding-top: 8px;">
												Mobile:+91-9953536391
											</td>
										</tr>
										<tr>
											<td align="center"
												style="font-size:12px;text-align:center; font-family: Montserrat, sans-serif; padding-right: 20px;padding-left: 20px;padding-top: 8px;">
												Email: contact@insaaf99.com
											</td>
										</tr>
									</tbody>
								</table>
								<table cellpadding="0" cellspacing="0" width="100%"
									style="text-align:center;padding-top: 10px; table-layout:fixed;">
									<tbody>
										<tr>
											<td align="left" style="font-size:10px;font-family: Montserrat, sans-serif; padding-right: 20px;">
												<a href="https://insaaf99.com/privacy-policy" style="color:blue;"> Privacy Policy</a>,
											    <a href="https://insaaf99.com/terms-condition" style="color:blue;"> Terms of Use</a>
										   </td>
											<td align="right">
												<ul style="list-style: none;float: right; display: flex; margin: 0; padding-right:0px;">
													<li><a href="https://www.facebook.com/insaaf99"><img src="https://insaaf99.com/assets/images/insaaf_facebook.png" style="width: 18px; padding:2px;"></a></li>
													<li><a href="https://www.instagram.com/insaaf_99"><img src="https://insaaf99.com/assets/images/insaaf_insta.png" style="width: 18px; padding:2px;"></a></li>
													<li><a href="https://www.linkedin.com/company/insaaf99"><img src="https://insaaf99.com/assets/images/insaaf_linkedin.png" style="width: 18px; padding:2px;"></a></li>
													<li><a href="https://api.whatsapp.com/send?phone=+919953536391&text=Hi%20%0D%0A,%20Insaaf99%20https://insaaf99.com/"><img src="https://insaaf99.com/assets/images/insaaf_whatsapp.png" style="width: 18px; padding:2px;"></a></li>
													<li><a href="https://twitter.com/insaaf_99"><img src="https://insaaf99.com/assets/images/insaaf_twitter.png" style="width: 18px; padding:2px;"></a></li>
													<li><a href="https://www.youtube.com/@insaaf99"><img src="https://insaaf99.com/assets/images/insaaf_youtube.png" style="width: 18px; padding:2px;"></a></li>
												</ul>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
';



    return $templete;


}

function getClientRegistartionTemp($clientName){
     $templeteData ='
	 <table cellpadding="0" cellspacing="0" width="100%">
	 <tbody>
		 <tr>
			 <td>
				 <table cellpadding="0" cellspacing="0" width="700" style="margin: auto; border:1px solid #e4e4e4;">
					 <tbody>
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700">
									 <tbody>
										 <tr>
											 <td align="left">
												 <img src="https://insaaf99.com/temfiles/welcomeimg.jpg" style="width: 700px; text-align: center;">
 
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:20px;padding-right:20px;padding-left:20px;">
									 <tbody>
										 <tr>
											 <td align="left">
												 <p style="font-size: 18px; font-family: roboto;">Dear <b>'.$clientName.'</b></p>
												 <p style="font-size: 18px; font-family: roboto;">It gives us immense
													 pleasure to take you onboard.</p>
												 <p style="font-size: 18px; font-family: roboto;">Now in order to get
													 you started in this exciting journey you are requested to kindly
													 complete your Profile.</p>
												 <p style="font-size: 18px; font-family: roboto;">We at Insaaf99.com
													 provide Online Consultation from our associated Lawyers who have got
													 expertise in their fields.</p>
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
 
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:50px;padding-right:20px;padding-left:20px;">
									 <tbody>
										 <tr align="center" style="padding-top:50px;">
											 <td align="center">
												 <div style="width: 150px; border: 1px solid #f0bd3e;padding: 14px;">
													 <img src="https://insaaf99.com/temfiles/01.jpg" style="width: 100px;">
													 <p style="font-weight: 700;font-family: roboto;">Ask A Query</p>
												 </div>
											 </td>
											 <td align="center">
												 <div style="width: 150px; border: 1px solid #f0bd3e;padding: 14px;">
													 <img src="https://insaaf99.com/temfiles/02.jpg" style="width: 100px;">
													 <p style="font-weight: 700;font-family: roboto;">Consult With
														 Lawyer</p>
												 </div>
											 </td>
											 <td align="center">
												 <div style="width: 150px; border: 1px solid #f0bd3e;padding: 14px;">
													 <img src="https://insaaf99.com/temfiles/03.jpg" style="width: 100px;">
													 <p style="font-weight: 700;font-family: roboto;">Documentation
													 </p>
												 </div>
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:40px;padding-bottom:40px;padding-right:20px;padding-left:20px;">
									 <tbody>
										 <tr>
											 <td align="center">
												 <p style="  width: 80%;
												 padding: 1rem;
												 background: #f0bd3e;
												 font-size: 24px;
												 margin: auto;
												 font-family: roboto;">Or you may book your consultation only at <span
														 style="font-size: 30px; font-weight:700;">Rs.99/-</span></p>
 
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:0px;padding-bottom:5px;padding-right:20px;padding-left:20px;">
									 <tbody>
										 <tr>
											 <td align="left	">
												 <p style=" font-size: 18px; font-family: roboto;">We at Insaaf99.com
													 also provide Documentation services, where you may get your Legal
													 Paper work drafted from our Veterans, who have got vast Experience
													 in their field.For more info:</p>
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
 
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:0px;padding-right:20px;padding-left:20px;">
									 <tbody>
										 <tr>
											 <td align="left	">
												 <p
													 style=" font-size: 18px; font-family: roboto; margin-bottom: 0;margin-top: 0px;">
													 Please visit our Website www.insaaf99.com</p>
												 <p
													 style=" font-size: 18px; font-family: roboto;margin-bottom: 0;margin-top: 0px;">
													 And Download our app</p>
 
												 <p
													 style=" font-size: 18px; font-family: roboto;margin-bottom: 0;margin-top: 0px;">
													 Team Insaaf99</p>
												 <a href="https://play.google.com/store/apps/details?id=com.insaaf99">
													 <img src="https://insaaf99.com/assets/images/play__store__insaaf.png"
														 style="width:150px; margin-top: 0px;">
												 </a>
 
											 </td>
											 <td align="left">
 
												 <img src="https://insaaf99.com/assets/images/insaaf-app-download.png"
													 style="width:150px;">
											 </td>
 
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:0px;padding-bottom:40px;padding-right:20px;padding-left:20px;">
									 <tbody>
										 <tr>
											 <td align="center" style="background: #e0e0e0;">
												 <p style="font-size: 30px; font-weight: 700; font-family: roboto;">Contact Us:</p>
											 </td>
										 </tr>
										 <tr>
											 <td align="center">
												 <p style="font-size: 15px; margin-bottom:0px;margin-top:15px;font-family: roboto;">
													 Land-Line:1800-212-9001</p>
 
												 <p style="font-size: 15px; margin-bottom:0px;margin-top:0px; font-family: roboto;">Mobile:
													 +91-9953536391</p>
												 <p style="font-size: 15px; margin-bottom:0px;margin-top:0px; font-family: roboto;">Email: <a
														 href="mailto:contact@insaaf99.com">contact@insaaf99.com</a></p>
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
 
						 <tr>
							 <td>
								 <table cellpadding="0" cellspacing="0" width="700"
									 style="padding-top:0px;padding-bottom:20px;padding-right:20px;padding-left:20px;border-bottom: 10px solid #f0bd3e;">
									 <tbody>
										 <tr valign="left">
											 <td valign="left">
												 <a href="https://insaaf99.com/terms-condition"
													 style="color:#000;font-family: roboto;">Privacy Policy</a>
												 <a href="https://insaaf99.com/privacy-policy" style="color:#000;font-family: roboto;">Terms
													 of Use</a>
											 </td>
											 <td align="right">
												 <ul
													 style="list-style:none;float:right;display:flex;margin:0;padding-right:0px">
													 <li><a href="https://www.facebook.com/insaaf99"><img
																 src="https://ci5.googleusercontent.com/proxy/qDaWvRXxLP-eX-DRwPwxIqMM7PHudVJsrmpffskBMU3MZZczoH02os7EQTmvcqOKsPSOeJjN6aIw-HWshRcJYTJ5XA6FfU8qrg=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_facebook.png"
																 style="width:18px;padding:2px" class="CToWUd"
																 data-bit="iit"></a></li>
													 <li><a href="https://www.instagram.com/insaaf_99/"><img
																 src="https://ci3.googleusercontent.com/proxy/KV1Fw-8DL5NMVT-0JiTpDUuSCi5r9pjHjKAwCeen6nZPC2kFXO5a1w7TTMcP6PiAPVDAShSJuO9plq55nCUbvlBkSFYdow=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_insta.png"
																 style="width:18px;padding:2px" class="CToWUd"
																 data-bit="iit"></a></li>
													 <li><a href="https://www.linkedin.com/company/insaaf99/"><img
																 src="https://ci4.googleusercontent.com/proxy/7YQTQ_Dfns3ufZ84XJSmDqhshrN1_AdIOSoIH_InVzwTzv5SDLWrf3eictEHotjo4VTnHxGlSOBYtm_lMIMmuzRN3wniGSN-nQ=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_linkedin.png"
																 style="width:18px;padding:2px" class="CToWUd"
																 data-bit="iit"></a></li>
													 <li><a href="https://api.whatsapp.com/send?phone=+919953536391&text=Hi%20%0D%0A,%20Insaaf99%20https://insaaf99.com/"><img
																 src="https://ci5.googleusercontent.com/proxy/W3ttI_b2sAyPI8CFvic8OJs88oJm9rzkX_8oJC6VxAskrMW0t9Ge8gziDveDEtL2Z6ukd73FyictjR7ItpKwZJ9K1EVquTE5EA=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_whatsapp.png"
																 style="width:18px;padding:2px" class="CToWUd"
																 data-bit="iit"></a></li>
													 <li><a
															 href="https://twitter.com/insaaf_99"><img
																 src="https://ci6.googleusercontent.com/proxy/jQQDvT4jNa_LobsgtvJH0zSF2RVtG-Vq34dF4ZnfMUnRh-KvXmSLbQxIZ2G2dzimI57VKGpBZLnLomaSLfwAdgum237Y-M3j=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_twitter.png"
																 style="width:18px;padding:2px" class="CToWUd"
																 data-bit="iit"></a></li>
													 <li><a href="https://www.youtube.com/@insaaf99"><img src="https://ci4.googleusercontent.com/proxy/pLQOqW0eh2DGMcLVT3-gEGpX7cx1XpDmouJTcLCAjDIHq_N-zX8wm1bLeRRlrowcI0hV_O-uHujdeb4ghFbyBfwdunW9vhgU=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_youtube.png" style="width:18px;padding:2px" class="CToWUd" data-bit="iit"></a></li>
												 </ul>
 
											 </td>
										 </tr>
									 </tbody>
								 </table>
							 </td>
						 </tr>
					 </tbody>
				 </table>
			 </td>
		 </tr>
	 </tbody>
 </table>
	 ';
   return $templeteData ;
}



function documentationEmailTemp($FormData,$categoryData,$grossPrice,$paymentLink){

	$DocumentationTemp ='
	<table
   style="width: 600px; margin: auto; font-family: math;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; padding-bottom: 20px;">
   <tr>
      <td bgcolor="#FFFFFF ">
         <div style="max-width: 600px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px;      ">

            <div style="background-color: #1a243f; padding: 5px 0px;">
			<div style="display:flex;">
               <img src="https://insaaf99.com/assets/images/law_logo.png" alt="" style=" height: 17%;   width: 17%;    margin-top: 10px;    padding-left: 18px; ">
			   
               <p style="
			   margin-left: 15px;
			   font-size: 50px;
			   color: #faad18;
			   margin-top: auto;
			   margin-bottom: auto;">INSAAF99</p></div>
            </div>
         </div>
      </td>
   </tr>
   <tr>
      <td style="    padding: 25px; background-color: white; text-align: justify;">
         <div class="contentstart">
            <p><strong> Dear <span style="color:green">'.$FormData['addtional']['first_name'].'</span></strong></p>
            <h4>Greeting of the Day</h4>
            <p>Great to see you applying for a <b>'.$FormData['addtional']['sub_sub_category_name'].'</b> I am
               Abhayraj and I will be your point of contact to guide you through the
               process.
            </p>
            
            <p>I have attached what the <b>'.$FormData['addtional']['sub_sub_category_name'].'</b> is all about. It has all the
               details below:
            </p>
            <h4>WHICH ONE DO YOU NEED? <span
                  style="background: #1a243f;color: white;padding:6px;font-weight:500;">'.$FormData['addtional']['sub_sub_category_name'].' ?</span></h4>
            <p>
			'.$categoryData['descreption'].'
            </p>
        
         
         </div>
      </td>
   </tr>
   <tr>
      <td style="    padding-left: 20px;padding-right: 20px;">
         <h4 style="background-color: #1a243f; color: white; text-align: center;">For more info: Contact Insaaf99.com
         </h4>
         <div style="line-height: 0; float: right;">
            <div style="justify-content: end;display: flex;font-family: auto;">
               <p style="width: 200px;">Our Professional Fee:</p>
               <p>Rs '.$categoryData['price'].'</p>
            </div>
            <div style="justify-content: end;display: flex;font-family: auto;">
			<p style="width: 200px;">('.$categoryData['discount'].'% Off)</p>
               <p><small> ₹'.$categoryData['save_price'].' Save</small></p>
            </div>
            <div style="justify-content: end;display: flex;font-family: auto;">
               <p style="width: 200px;"></p>
               <p><strong>Rs '.$categoryData['gross_price'].'</strong></p>
            </div>

            <div style="justify-content: end;display: flex;font-family: auto;">
               <p style="width: 200px;">GST ('.$categoryData['gst'].'%)</p>
               <p>Rs 486</p>
            </div>
            <div style="justify-content: end;display: flex;font-family: auto;">
               <div
                  style="justify-content: end;display: flex;color: green;border-top: 1px solid;border-bottom: 1px solid;">
                  <p style="width: 200px;">Gross Total</p>
                  <p>Rs '.$grossPrice.'</p>
               </div>
            </div>
      </td>
   </tr>

   <tr>
      <td style="    padding-left: 20px;padding-right: 20px; padding-top: 20px; line-height: 0.9;">
         <h4>Here is the link for the payment.</h4>
		 <a href="'.$paymentLink.'">'.$paymentLink.'</a>
         <p><small>(you can also find the above link for payment sent on your registered
               mobile number & email)
            </small></p>
         <p><small>Please feel free to reach out to me at the number below for any further
               doubts or clarifications.
            </small></p>
         <p>Looking forward to getting you The <b>'.$FormData['addtional']['sub_sub_category_name'].'</b> drafted soon!
         </p>
      </td>
   </tr>
   <tr>
      <td  valign="bottom" style="background-color: #1a243f; margin-top: 20px;">
         <div>
            <div
               style="  float: left;  color: white; width: 45%;padding-top: 3px; padding-left: 20px; line-height: 0.8;">
               <p>Thanks,</p>
               <p style="    padding: 0;margin-bottom: 10px;">Abhayraj Chauhan</p>
               <p style="margin: 0;">Business Advisor</p>
               <p>Call: <a href="#" style="text-decoration: none; color: white;">9953536391</a></p>
            </div>
            <div style="width:35%;padding-top: 40px;   display: flex; color: white;    align-items: end;">
				<ul style="list-style:none;float:right;display:flex;margin:0;padding-right:0px;top: 93px;right: 10px; margin-left:0;">
					<li style="    margin-left: 0;" ><a href="https://www.facebook.com/insaaf99"><img
								src="https://insaaf99.com/assets/images/insaaf_facebook.png"
								style="width:21px;padding:4px" class="CToWUd"
								data-bit="iit"></a></li>
					<li style="    margin-left: 0;"><a href="https://www.instagram.com/insaaf_99/"><img
								src="https://insaaf99.com/assets/images/insaaf_insta.png"
								style="width:21px;padding:4px" class="CToWUd"
								data-bit="iit"></a></li>
					<li style="    margin-left: 0;"><a href="https://www.linkedin.com/company/insaaf99/"><img
								src="https://insaaf99.com/assets/images/insaaf_linkedin.png"
								style="width:21px;padding:4px" class="CToWUd"
								data-bit="iit"></a></li>
					<li style="    margin-left: 0;"><a href="https://api.whatsapp.com/send?phone=+919953536391&text=Hi%20%0D%0A,%20Insaaf99%20https://insaaf99.com/"><img
								src="https://insaaf99.com/assets/images/insaaf_whatsapp.png"
								style="width:21px;padding:4px" class="CToWUd"
								data-bit="iit"></a></li>
					<li style="    margin-left: 0;"><a
							href="https://twitter.com/insaaf_99"><img
								src="https://insaaf99.com/assets/images/insaaf_twitter.png"
								style="width:21px;padding:4px" class="CToWUd"
								data-bit="iit"></a></li>
					<li style="    margin-left: 0;"><a href="https://www.youtube.com/@insaaf99"><img src="https://ci4.googleusercontent.com/proxy/pLQOqW0eh2DGMcLVT3-gEGpX7cx1XpDmouJTcLCAjDIHq_N-zX8wm1bLeRRlrowcI0hV_O-uHujdeb4ghFbyBfwdunW9vhgU=s0-d-e1-ft#https://insaaf99.com/assets/images/insaaf_youtube.png" style="width:21px;padding:4px" class="CToWUd" data-bit="iit"></a></li>
				</ul>
            </div>
         </div>
      </td>
   </tr>

</table>
	';

	return $DocumentationTemp;
}



?>