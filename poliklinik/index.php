<?php
include_once("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <title>Sistem Informasi Poliklinik</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='styleku.css'>
	<!-- <link rel="icon" type="image/png" href="images/icons/aplogo.ico"/> -->
	
</head>
<body translate="no">
<body class="hero-anime">	
<div class="container text text-left">    
</br></div>
	<div class="navigation-wrap bg-light start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
					<div class="container-fluid">
    <a class="navbar-brand" href="#">
      Sistem Informasi Poliklinik
    </a>		
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="index.php">Home</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Data Master</a>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="dokter.php" target="scs_body">Dokter</a>
										<a class="dropdown-item" href="pasien.php" target="scs_body">Pasien</a>
                    <a class="dropdown-item" href="obat.php" target="scs_body">Obat</a>
									</div>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="periksa.php">Periksa</a>
								</li>
							</ul>
						</div>
					</nav>		
				</div>
			</div>
		</div>
	</div>

	<div class="section full-height">
			<div class="section">
				<!-- <div class="container">
					<div class="row">
						<div class="col-12"> -->
					<iframe name="scs_body" height="1000px" width="1350px" frameborder="0"></iframe>
					<!-- <iframe name="scs_body" src=""style="width: 1400px; height: 300px;" frameborder="0"></iframe> -->
					</div>		
				</div>		
			</div>
			<!-- <div class="section mt-5">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div id="switch">
								<div id="circle"></div>
							</div>
						</div>	
					</div>		
				</div>			
			</div> -->
		</div>
	</div>
	<div class="my-5 py-5">
	</div>

</body>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>

      <script id="rendered-js" >
/* Please ❤ this if you like it! */


(function ($) {"use strict";

  $(function () {
    var header = $(".start-style");
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 10) {
        header.removeClass('start-style').addClass("scroll-on");
      } else {
        header.removeClass("scroll-on").addClass('start-style');
      }
    });
  });

  //Animation

  $(document).ready(function () {
    $('body.hero-anime').removeClass('hero-anime');
  });

  //Menu On Hover

  $('body').on('mouseenter mouseleave', '.nav-item', function (e) {
    if ($(window).width() > 750) {
      var _d = $(e.target).closest('.nav-item');_d.addClass('show');
      setTimeout(function () {
        _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
      }, 1);
    }
  });

  //Switch light/dark

//   $("#switch").on('click', function () {
//     if ($("body").hasClass("dark")) {
//       $("body").removeClass("dark");
//       $("#switch").removeClass("switched");
//     } else
//     {
//       $("body").addClass("dark");
//       $("#switch").addClass("switched");
//     }
//   });

})(jQuery);
//# sourceURL=pen.js
    </script>

  
</body>

</html>
<?php