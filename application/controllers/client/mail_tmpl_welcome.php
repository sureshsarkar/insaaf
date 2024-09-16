<?php

$welcomeTemplate = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vaibhav Laxmi Jewellers</title>
</head>
<body>
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" bgcolor="#f9fafc" style="background-color:rgb(249,250,252); width: 800px;  margin:auto; padding-top: 30px;	">
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" bgcolor="#f9fafc" style="background-color:rgb(249,250,252); width: 800px;   padding: 0px 40px 10px 40px; margin:auto;">
 <tbody>
 	<tr style="text-align:center;">
 		<td>
 			<img src="'.base_url().'/assets/images/front_logo/logo1.png" style="width: 8%;">
 		</td>
 	</tr>
  <tr style="">
 	<td>
 		
    <img src="'.base_url().'/assets/images/welcome.png">
 	</td>
   </tr>

   <tr style="font-family: poppins; font-size: 14px;">
    <td>
     <p style="margin-top:30px;"> Dear '.ucfirst($orderData->fname).',</p>
     <p>Thany You for Your order </p>
     <p>Here is a snapshot on Vaibhav Laxmi Jewellers which will give you a brief understanding about the company and its services. </p>
     
    </td>
   </tr>
   
  </tbody>
 </table>
 
</table>
 <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" bgcolor="#f9fafc" style="background-color:rgb(249,250,252); width: 800px;     padding: 0px 40px 10px 40px; margin:auto;">
 <tbody>
  <tr style="text-align: center; font-family:poppins;">
  	<td>Follow us on :</td>
  </tr>

  <tr>
  	<td style="text-align: center;">
  		<ul style="list-style: none; display: inline-flex; text-align: center; padding: 0; margin-bottom: 0;">
  			<li><a href="https://www.facebook.com/Trufedu-103078142257900/"><img src="https://trufedu.com/wp-content/uploads/2021/12/facebook.png" style="width: 40px; margin:10px;"></a></li>
  			<li><a href=" https://instagram.com/trufedu_?utm_medium=copy_link"><img src="https://trufedu.com/wp-content/uploads/2021/12/insta.png" style="width: 40px; margin:10px;"></a></li>
  			<li><a href="https://www.linkedin.com/company/trufedu"><img src="https://trufedu.com/wp-content/uploads/2021/12/linkdin.png" style="width: 40px; margin:10px;"></a></li>
  			<li><a href="https://twitter.com/trufedu?s=21"><img src="https://trufedu.com/wp-content/uploads/2021/12/twitter.png" style="width: 40px; margin:10px;"></a></li>
  		</ul>
  	</td>
  </tr>
  <tr style="border-bottom: 1px solid #000;">
  	<td style="text-align: center; font-family:poppins">
  		<p style="margin-top:0;">for updates on offers, discounts, new features etc.</p>
  		<p style="height: 1.5px; width:100%; background: #8f8f8f;"></p>
  	</td>
  </tr>


	  <tr>
	  	<td style="text-align:center; font-family: poppins; font-size:24px;">
	  		<p style="color:#010345;font-weight: 700; margin-bottom:0px;">Vaibhav Laxmi Jewellers</p>
	  		<p style="margin-top:0px;font-size: 18px;">#683, Pocket B2, Loknayakpuram, Delhi-110041.</p>
	  	</td>
	  </tr>

	  <tr>
	  	<td style="text-align: center;"> 
	  		<span style="font-family: poppins; padding-bottom:40px;"><a href="https://trufedu.com/data-privacy-policy/" style="color:#010345;">Privacy Policy</a></span>
	  		<span style="font-family: poppins; padding-bottom:40px;"><a href="https://trufedu.com/terms-conditions/" style="color:#010345;">Terms Of Use</a></span>
	  	</td>
	  </tr>
 </tbody>
</table>
 </body>
</html>';
?>
