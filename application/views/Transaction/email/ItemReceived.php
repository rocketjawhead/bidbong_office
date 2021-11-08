<!DOCTYPE html>
<html>
<head>
	<title>Item Received</title>
	<style>
	* {
	  box-sizing: border-box;
	}
	.columnOrder {
	  float: left;
	  width: 25%;
	  padding: 10px;
	  height: 100px; /* Should be removed. Only for demonstration */
	}
	.columnCheckout {
	  float: left;
	  width: 33.3%;
	  padding: 10px;
	  height: 100px; /* Should be removed. Only for demonstration */
	}
	.column10 {
	  float: left;
	  width: 10%;
	  padding: 10px;
	  height: 150px; /* Should be removed. Only for demonstration */
	}
	.column20 {
	  float: left;
	  width: 20%;
	  padding: 10px;
	  height: 150px; /* Should be removed. Only for demonstration */
	}
	.column30 {
	  float: left;
	  width: 30%;
	  padding: 10px;
	  height: 150px; /* Should be removed. Only for demonstration */
	}
	.column20Total {
	  float: left;
	  width: 20%;
	  padding: 10px;
	  height: 80px; /* Should be removed. Only for demonstration */
	}
	.column30Total {
	  float: left;
	  width: 30%;
	  padding: 10px;
	  height: 80px; /* Should be removed. Only for demonstration */
	}
	.column30garis {
	  float: left;
	  width: 30%;
	  padding: 10px;
	  height: 10px; /* Should be removed. Only for demonstration */
	}
	.column40 {
	  float: left;
	  width: 40%;
	  padding: 10px;
	  height: 150px; /* Should be removed. Only for demonstration */
	}
	.column40garis {
	  float: left;
	  width: 40%;
	  padding: 10px;
	  height: 10px; /* Should be removed. Only for demonstration */
	}
	.row:after {
	  content: '';
	  display: table;
	  clear: both;
	}
	</style>
</head>
<body style='background-image: url("<?php echo base_url()?>assets/email/bg_email.jpg");background-repeat: no-repeat;
    background-size: 100% 100%;'>
<center><img style='height: 100px;width: 100px;' src='<?php echo base_url()?>assets/bidbong_logo.png'></center>
<center>
	<p>Hi User, Thank you for shopping at Bidbong. Based on the information we have, your order<br/> has been successfully received. We hope you are satisfied with our services.</p>
	<br/>
	<img style='height: 160px;width: 50%;' src='<?php echo base_url()?>assets/payment/item_received.jpg'>
</center>


<center>
<div class='row' style='width: 600px;'>
  <div class='columnOrder'>
  	<center>
  		<p style='color: #A09FAA;'>Order Date</p>
    	<p><b>12 Dec 2020</b></p>	
  	</center>
  </div>
  <div class='columnOrder'>
  	<center>
  		<p style='color: #A09FAA;'>Order Number</p>
    	<p><b>#1234567890</b></p>	
  	</center>
  </div>
  <div class='columnOrder'>
  	<center>
  		<p style='color: #A09FAA;'>Payment Method</p>
    	<p><b>Visa/MC/Amex</b></p>	
  	</center>
  </div>
  <div class='columnOrder'>
  	<center>
  		<p style='color: #A09FAA;'>Destination</p>
    	<p><b>Planet Earth</b></p>	
  	</center>
  </div>
</div>
</center>




<br/><br/><br/>
<hr/>
<div class='row'>
  <div class='column30'></div>
  <div class='column10'>
  	<div>
	  <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='https://d2pa5gi5n2e1an.cloudfront.net/webp/global/images/product/laptops/ASUS_Laptop_E410MA/ASUS_Laptop_E410MA_L_1.jpg' alt=''>
	</div>
  </div>
  <div class='column20'>
  	<p>asdads asdjasndjasdsa asdnjsadnsa asjdnjasndas </p>
  	<p style='color: #A09FAA;'>Qty: 1</p>
  </div>
  <div class='column10'>
  	<p style='text-align: right;'>$ 3000</p>
  </div>
  <div class='column30'></div>
</div>
<hr/>
<div class='row'>
  <div class='column30Total'></div>
  <div class='column20Total'>
  	<p>Sub Total</p>
  	<p>Shipping Cost</p>
  </div>
  <div class='column20Total'>
  	<p style='text-align: right;'>$ 3000</p>
  	<p style='text-align: right;'>$ 3000</p>	
  </div>
  <div class='column30Total'></div>
</div>
<div class='row'>
  <div class='column30garis'></div>
  <div class='column40garis'>
  	<hr/>
  </div>
  <div class='column30garis'></div>
</div>
<div class='row'>
  <div class='column30Total'></div>
  <div class='column20Total'>
  	<p>Total</p>
  </div>
  <div class='column20Total'>
  	<p style='text-align: right;'>$ 3000</p>	
  </div>
  <div class='column30Total'></div>
</div>

<div style='background: rgba(196, 196, 196, 0.25);margin: auto;padding: 10px;'>
	<center><p>Contact Us Contact@BidBong.com | +44 33 01 33 25 19 <br/>© 2021 bidbong.com - All Rights Reserved</p></center>
</div>
</body>
</html>