


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Owh!!!!</title>

    <style>
@import url(https://fonts.googleapis.com/css?family=Lato:900|Creepster);
html {

	width: 100%;
	height: 100%;
	background-size: cover;
	background-repeat: no-repeat;

	background: #000000;

	background: -webkit-gradient(linear, left top, right bottom, color-stop(68%, #000000), color-stop(75%, #ff0000), color-stop(81%, #cccccc), color-stop(81%, #cccccc), color-stop(91%, #111111), color-stop(95%, #000000), color-stop(95%, #000000));
	background: -webkit-linear-gradient(-45deg, #000000 68%, #ff0000 75%, #cccccc 81%, #cccccc 81%, #111111 91%, #000000 95%, #000000 95%);
	background: -webkit-linear-gradient(315deg, #000000 68%, #ff0000 75%, #cccccc 81%, #cccccc 81%, #111111 91%, #000000 95%, #000000 95%);
	background: linear-gradient(135deg, #000000 68%, #ff0000 75%, #cccccc 81%, #cccccc 81%, #111111 91%, #000000 95%, #000000 95%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000', GradientType=1 );
  
/* IE6-9 fallback on horizontal gradient */


}
body {
	width: 100%;
	height: 100%;
	background: -webkit-repeating-linear-gradient(103deg, #ff0000, rgba(255, 0, 0, 0.7) 1px, #ff0000 2px, transparent 6px, transparent 150px);
	background: repeating-linear-gradient(-13deg, #ff0000, rgba(255, 255, 255, 0.7) 1px, #ff0000 2px, transparent 6px, transparent 150px);
	margin: 0;
}
.grid {
	width: 100%;
	height: 100%;
	background: -webkit-repeating-linear-gradient(45deg, #ff0000, rgba(255, 0, 0, 0.7) 1px, #ff0000 2px, transparent 6px, transparent 150px);
	background: repeating-linear-gradient(45deg, #ff0000, rgba(255, 255, 255, 0.7) 1px, #ff0000 2px, transparent 6px, transparent 150px);
}
.Absolute-Center {
	margin: auto;
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
}
.container {
	position: relative;
	width: 500px;
	margin: auto;
	text-align: center;
	padding-top: 10%;
}

/* counter-reset  */

body {
	counter-reset: littledevil 0;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	overflow: hidden;
	width: 100%;
	height: 100%;
	margin: 0;
}
/*hide checkbox*/
input {
	position: fixed;
	left: -10px;
	top: -10px;
}
/*play area*/
.wrapper {
	height: 100%;
	width: 100%;
	position: absolute;
	cursor: crosshair;
}
/*count dead minions*/
.input-demon:checked {
	counter-increment: littledevil;
}
.sum {
	position: fixed;
	width: 100%;
	text-align: center;
	bottom: 30px;
	height: auto;
	font-size: 18px;
	font-weight: bold;
	font-family: Lato;
	color: #fff;
	letter-spacing: 3px;
	text-transform: uppercase;
}
/*print to screen dead minion total*/
.sum:after {
	content: counter(littledevil);
}
.input-demon ~ .minion {
	opacity: 0;
	-webkit-transition: 0.3s cubic-bezier(0, .43, 1, 0);
	transition: 0.3s cubic-bezier(0, .43, 1, 0);
	-webkit-animation: move 8s infinite alternate;
	animation: move 8s infinite alternate;
}
.input-demon1:not(:checked) ~ .minion1, .input-demon2:not(:checked) ~ .minion2, .input-demon3:not(:checked) ~ .minion3, .input-demon4:not(:checked) ~ .minion4, .input-demon5:not(:checked) ~ .minion5, .input-demon6:not(:checked) ~ .minion6, .input-demon7:not(:checked) ~ .minion7, .input-demon8:not(:checked) ~ .minion8 {
	opacity: 1;
}
.input-demon1:checked ~ .minion1 span, .input-demon2:checked ~ .minion2 span, .input-demon3:checked ~ .minion3 span, .input-demon4:checked ~ .minion4 span, .input-demon5:checked ~ .minion5 span, .input-demon6:checked ~ .minion6, .input-demon7:checked ~ .minion7 span, .input-demon8:checked ~ .minion8 span {
	display: block;
}
/*----------- 
Flying Minions */


.minion {
	position: absolute;
	left: 0;
	cursor: crosshair;
	background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/191814/devil_compressed.gif);
	width: 191px;
	height: 144px;
	z-index: 2;
}
.minion>span {
	display: none;
	position: absolute;
	z-index: 2;
	text-align: center;
	color: rgba(255,252,252,0.5);
	font-weight: bolder;
	width: 100px;
	height: 100px;
}
.minion>span:before {
	content: "☠";
	font-size: 150px;
}
/* Uncomment and add your minions for targeted content messages.  

.minion1>span:before {
	content: "Can't Kill the Dead";

*/


.minion1 {
	top: 10%;
	-webkit-animation-delay: -2s!important;
	animation-delay: -2s!important;
	-webkit-transform: scale(0.9);
	-ms-transform: scale(0.9);
	transform: scale(0.9);
}
.minion2 {
	top: 20%;
	-webkit-animation-delay: -4s!important;
	animation-delay: -4s!important;
	-webkit-transform: scale(0.8);
	-ms-transform: scale(0.8);
	transform: scale(0.8);
}
.minion3 {
	top: 30%;
	-webkit-animation-delay: -3s!important;
	animation-delay: -3s!important;
	-webkit-transform: scale(1.25);
	-ms-transform: scale(1.25);
	transform: scale(1.25);
}
.minion4 {
	top: 40%;
	-webkit-animation-delay: -8s!important;
	animation-delay: -8s!important;
	-webkit-transform: scale(1);
	-ms-transform: scale(1);
	transform: scale(1);
}
.minion5 {
	top: 50%;
	-webkit-animation-delay: -16s!important;
	animation-delay: -16s!important;
	-webkit-transform: scale(0.9);
	-ms-transform: scale(0.9);
	transform: scale(0.9);
}
.minion6 {
	top: 60%;
	-webkit-animation-delay: -9s!important;
	animation-delay: -9s!important;
	-webkit-transform: scale(1.3);
	-ms-transform: scale(1.3);
	transform: scale(1.3);
}
.minion7 {
	top: 70%;
	-webkit-animation-delay: -6s!important;
	animation-delay: -6s!important;
	-webkit-transform: scale(1);
	-ms-transform: scale(1);
	transform: scale(1);
}
.minion8 {
	top: 80%;
	-webkit-animation-delay: -12s!important;
	animation-delay: -12s!important;
	-webkit-transform: scale(0.7);
	-ms-transform: scale(0.7);
	transform: scale(0.7);
}
 @-webkit-keyframes move {
0% {
left:0%;
}
20% {
left:20%;
top:50%;
}
40% {
top:30%;
left:60%;
}
60% {
top:80%;
left:80%;
}
80% {
top:10%;
left:20%;
}
100% {
top:30%;
left:20%;
}
}
 @keyframes move {
0% {
left:0%;
}
20% {
left:20%;
top:50%;
}
40% {
top:30%;
left:60%;
}
60% {
top:80%;
left:80%;
}
80% {
top:10%;
left:20%;
}
100% {
top:30%;
left:20%;
}
}
/* Page Stying  */
h1  {
		z-index: 1;
	font-size: 10vw;
	color: #ff0000;
	padding-top: 25%;
	font-family: 'Creepster', cursive;
	letter-spacing: 10px;
	text-shadow: 5px 3px 0px #000;
	margin: auto;
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	-webkit-transform: rotate(-13deg);
	-ms-transform: rotate(-13deg);
	transform: rotate(-13deg);
	text-align: center;
	width: 100%;
	letter-spacing: 10px;
  -webkit-text-stroke-width: 1px;
   -webkit-text-stroke-color: black;
}

h2  {
		z-index: 2;
	font-size: 7vw;
	color: grey;
	padding-left:17%;
	padding-top: 45%;
	font-family: 'Creepster', cursive;
	letter-spacing: 10px;
	text-shadow: 5px 3px 0px #000;
	margin: auto;
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	text-align: center;
	width: 100%;
	letter-spacing: 10px;
  -webkit-text-stroke-width: 1px;
   -webkit-text-stroke-color: black;
}

    </style>
  </head>
  <body>



            <div class="wrapper">
  
                <div class="grid">
                    <div class="container">
                        <h2 class="killer">Page Not Found</h1>
                        <h1 class="demon">DEMON</h2>

                    </div>
                </div>
                <input class="input-demon input-demon1" type="radio" id="demon1">
                <input class="input-demon input-demon2" type="radio" id="demon2">
                <input class="input-demon input-demon3" type="radio" id="demon3">
                <input class="input-demon input-demon4" type="radio" id="demon4">
                <input class="input-demon input-demon5" type="radio" id="demon5">
                <input class="input-demon input-demon6" type="radio" id="demon6">
                <input class="input-demon input-demon7" type="radio" id="demon7">
                <input class="input-demon input-demon8" type="radio" id="demon8">
                <label for="demon1" class="minion minion1"><span></span></label>
                <label for="demon2" class="minion minion2"><span></span></label>
                <label for="demon3" class="minion minion3"><span></span></label>
                <label for="demon4" class="minion minion4"><span></span></label>
                <label for="demon5" class="minion minion5"><span></span></label>
                <label for="demon6" class="minion minion6"><span></span></label>
                <label for="demon7" class="minion minion7"><span></span></label>
                <label for="demon8" class="minion minion8"><span></span></label>
                <div class="sum">Minions Destroyed: </div>
            </div>
            
            

</body>
</html>