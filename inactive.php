<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<meta charset="utf-8">
	<title>Inactivity Detected</title>
	<link rel="stylesheet" type="text/css" href="admin/materialize/css/materialize.min.css">
	<style type="text/css">
		@font-face{
		src:url('font/ubuntu_font.ttf');
		font-family:ubuntu;
		}
		h1{
			font-family: arial;
			font-size:50px;
			text-align: center;
			color:red;
		}
		p{
			font-family:ubuntu;
			font-size:20px;
			color:red;
			text-align: center;
		}
		.button{
			text-align: center;
			margin-top: 5%;
		}
		.accessbtn{
			text-decoration: none;
			font-family:ubuntu;
			font-size:20px;
			color:white;
			background-color: #7f5a83;
			background-image: linear-gradient(315deg, #7f5a83 0%, #0d324d 74%);
			padding:20px;
			border-radius: 30px;
			opacity: 0.7;
		}
		.header{
			margin-top:-1%;
			/*margin-bottom: -5%;*/
		}
		body{
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			font-family:ubuntu;
			display:flex-box;
		}
		.gradText{
			background: #121FCF;
			background: -webkit-radial-gradient(circle farthest-corner at center center, #121FCF 0%, #CF1512 52%);
			background: -moz-radial-gradient(circle farthest-corner at center center, #121FCF 0%, #CF1512 52%);
			background: radial-gradient(circle farthest-corner at center center, #121FCF 0%, #CF1512 52%);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-size:40px;
			font-weight: bold;
			}
			caption{
				font-weight:bold;
				font-size:20px;
			}
		center{
			font-weight: bold;
			font-size:20px;
		}
		table{
			font-size:12px;
		}

		div::-webkit-scrollbar {
		  width: 0.5em;
		}
		 
		div::-webkit-scrollbar-track {
		  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		 
		div::-webkit-scrollbar-thumb {
		  background-color: blue;
		  /*outline: 1px solid blue;*/
		}

		body::-webkit-scrollbar {
		  width: 0.5em;
		}
		 
		body::-webkit-scrollbar-track {
		  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		 
		body::-webkit-scrollbar-thumb {
		  background-color: blue;
		  /*outline: 1px solid blue;*/
		}

		* {box-sizing: border-box;}

img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
		
		
	</style>

</head>
<body class="snowflake">
	<div class="header">
		<center><img src="img/andono.png" class="responsive-img" id="logo" style="width:300px;"></center>
	</div>

	<h2 class="center">To all Production JR. Staff/ Staff ,  you may now use the IRCS System to register IRCS QR CODE (NO NEED TO ANDON) . </h2>
	<!-- NOTE -->
	<div class="row">
		<div class="col s12">
			<h4 class="center">NOTE: CCTV, Setup and Office concerns are not included in ANDON System!</h4>
			<h4 class="center red-text">NOTE: IF THE ANDON PROBLEM IS UNMATCH WITH THE PRODUCTION ACTUAL PROBLEM, THE TECHNICIAN AUTOMATICALLY ENDS THE ANDON AND REQUEST IT FOR RE-ENTRY WITH CORRECT DETAILS.</h4>
			<center>Ang hindi tamang detalye ng pag andon ay hindi pinapayagan, may karapatan ang mga technician na i-end ang Andon na itinawag sa kanila na may maling detalye at magrequest ng re-entry na may tamang detalye.</center>
		</h4>

	
		</div>
	</div>
	<div class="row gradText">
		<h5 class="center">MACHINE PROBLEM REFERENCE</h5>
	</div>
	<!-- TEXT -->
	<div class="row">
		<div class="col s4">
			<center class="green-text">EQD</center>
			<!-- SEARCH -->
			<div class="input-field">
				<input type="text" name="" id="eqd_search"><label>Search EQD</label>
			</div>
			<!-- TABLE -->
			<div style="height:500px;overflow: auto;" class="z-depth-5">
				<table class="centered">
				<thead>
					<!-- <th>Category</th> -->
					<th>Machine</th>
					<th>Concern</th>
				</thead>
				<tbody id="eqd_data"></tbody>
			</table>
			</div>
		</div>
		<!-- PE -->
		<div class="col s4">
			<center class="red-text">PE</center>
			<div class="input-field">
					<input type="text" name="" id="pe_search"><label>Search PE</label>
				</div>
			<div style="height:500px;overflow: auto;" class="z-depth-5">
				<table class="centered">
				<thead>
					<!-- <th>Category</th> -->
					<th>Machine</th>
					<th>Concern</th>
				</thead>
				<tbody id="pe_data"></tbody>
			</table>
			</div>
		</div>
		<!-- IT -->
		<div class="col s4">
			<center class="blue-text">IT</center>
			<div class="input-field">
				<input type="text" name="" id="it_search"><label>Search IT</label>
			</div>
			<div style="height:500px;overflow: auto;" class="z-depth-5">
			<table class="centered">
				<thead>
					<!-- <th>Category</th> -->
					<th>Machine</th>
					<th>Concern</th>
				</thead>
				<tbody id="it_data"></tbody>
			</table>
		</div>
		</div>
	</div>
	<!--TEXT END-->
		<button class="modal-trigger" id="showBtn" data-target="modal-notif" style="display:none;"></button>
		<!-- MODAL -->
		<div class="modal" id="modal-notif">
		<div class="modal-footer"><button class="btn-flat modal-close" style="font-size:20px;font-weight:bold;">&times;</button></div>
			<div class="modal-content">
			
			<!-- <div class="row">
			<div class="col s12">
				<img src="img/covid19.png" alt="" srcset="" class="responsive-img center">
			</div>
			</div>
			</div> -->
			<div class="slideshow-container">


<div class="mySlides fade">

  <img src="img/1.png" style="width:100%;">

</div>

<div class="mySlides fade">

  <img src="img/2.png" style="width:100%;">

</div>
<div class="mySlides fade">

  <img src="img/covid19.png" style="width:100%;">

</div>

<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 


</div>
</div>
		</div>
		</div>
		

	<!-- LINK -->
	<div class="row button" style="display:none;">
		<a href="index.php" class="accessbtn pulse">Access the Andon System</a>
	</div>

	<script type="text/javascript" src="admin/materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="admin/materialize/js/materialize.min.js"></script>
	<script type="text/javascript">
		localStorage.clear();
		$(document).ready(function(){
			$('#logo').show(1000);
			$('.button').fadeIn(1000);
			$('#sleep').fadeIn(1000);
			$('.modal').modal();
			eqd_ref();
			pe_ref();
			it_ref();
			
			setTimeout(() => {
				$('#showBtn').click();
			}, 10000);
					

		// FILTER EQD
		$("#eqd_search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#eqd_data tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		// FILTER PE
		$("#pe_search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#pe_data tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		// FILTER IT
		$("#it_search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#it_data tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});

});


function eqd_ref(){
	$.ajax({
		url :'admin/processor/inactive_view.php',
		type:'POST',
		cache:false,
		data:{
			method: 'eqd_view'
		},success:function(response){
			// console.log(response);
			$('#eqd_data').html(response);
		}
	});
}

function pe_ref(){
$.ajax({
	url :'admin/processor/inactive_view.php',
	type:'POST',
	cache:false,
	data:{
		method: 'pe_view'
	},success:function(response){
		// console.log(response);
		$('#pe_data').html(response);
	}
});
}

function it_ref(){
	$.ajax({
		url :'admin/processor/inactive_view.php',
		type:'POST',
		cache:false,
		data:{
			method: 'it_view'
		},success:function(response){
			// console.log(response);
			$('#it_data').html(response);
		}
	});
}

document.addEventListener("keypress", function(x){
	if(x.keyCode == 32){
		location.replace("../andon_system/index.php");
	}
});


//transition slideshow
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 10000); // Change image every 10 seconds
}

</script>
</body>
</html>
