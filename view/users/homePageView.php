<?php $title = 'Sick IT home page'; ?>

<?php ob_start(); ?>
<body class="bg-light">
	<section class="container">	
		<div id="carouselNimp" class="carousel slide"  data-ride="carousel">
<!--  Petit points du bas qui redirigent vers les slides correspondantes -->
			<ol class="carousel-indicators">	
					<li data-target="#carouselNimp" data-slide-to="0" class="active"></li>
					<li data-target="#carouselNimp" data-slide-to="1" ></li>		
			</ol>
			<!--  Contenu des slides -->			
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="public/image/pr.png" width="842" height="631">
					<div class="carousel-caption d-none d-md-block">															
					</div>
				</div>
				<!--  slide avec l'image -->
				<div class="carousel-item ">
					<img class="d-block w-100" src="public/image/principale.png" width="842" height="631">
				</div>

			</div>
			<!-- Contrôle flèche gauche -->
			<a class="carousel-control-prev" href="#carouselNimp" data-slide="prev" role="button">
				<span class="carousel-control-prev-icon" ></span>
				<span class="sr-only">previous</span>
			</a>
			<!-- Contrôle avec les flèches gauche et droite -->
			<a class="carousel-control-next" href="#carouselNimp" data-slide="next" role="button">
				<span class="carousel-control-next-icon"></span>
				<span class="sr-only">Next</span> 
			</a>
		</div>
	</section>
	<section class="container pb-3 pt-4" style="background-color: rgba(0,0,0,0);">
		<div id="block1" class="d-flex justify-content-center" style="background-color: rgba(0,0,0,0.3);">
			<?php showGame(); ?>			
		</div>		
	</section>	
	<script type="text/javascript" src="public/js/jsGaming/algoLose.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoCreate.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoVar.js"></script>
	<script type="text/javascript" src="public/js/welcomeGame.js"></script>
</body>

<?php 
	function showGame(){
	if(isset($_SESSION['login']) && !empty($_SESSION['login'])){ ?>
		<a type="button" class="w-100 p-2 btn btn-danger btn-lg text-light" id="buttonJouer" onclick="welcome();">PLAY !</a>
	<?php }else{ ?>
		<a type="button" class="w-100 p-2 btn btn-danger btn-lg text-light" id="buttonJouer" href="index.php?action=game">PLAY !</a>
<?php	}
	}
 ?>

<?php $content = ob_get_clean(); ?>

<?php require('view/users/template.php'); ?>