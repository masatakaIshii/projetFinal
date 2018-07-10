<?php require_once('controller/game/algoControl.php'); ?>
<nav class="sidebar nav flex-column p-0 col-auto" id="navGame" >
		<h2 class="text-light font-weight-bold text-center pt-3 pb-2"><?=$nameUser['login'];?></h2> 
		<div class="dropdown-divider pb-4"></div>
		<?php GameSidebar($tab,$tab2,$srcImg); ?>
		<div style="height: 40px;"></div>
		<div class="dropdown-divider" id="separate"></div>
		<div class="row pl-5">		
			<img src="public/image/surrend.png" class="surrend" id="imgGame">
			<p class="text-center text-danger font-weight-bold pt-2 pl-3 pr-3" id="surrend">Surrend</p>
		</div>
</nav>
