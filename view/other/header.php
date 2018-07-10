<header>	
	<nav class="navbar navbar-inverse justify-content-center row bg-light " >			
		<ul class="nav justify-content-end row col col-lg-4" >
				<li class="nav-item"><a class="nav-link active text-dark" href="index.php?action=other&amp;direction=presentation">Presentation</a></li>
				<li class="nav-item"><a class="nav-link active text-dark" href="index.php?action=other&amp;direction=team">Team</a></li>
				<li class="nav-item"><a class="nav-link active text-dark" href="index.php?action=other&amp;direction=ranking">Ranking</a></li>
		</ul>
		<a class="navbar-brand" href="index.php">
			<img src="public/image/logo.png" alt="Logo" id="logoSI" >
		</a>
		<ul class="nav row col col-lg-4">
			<li class="nav-item"><a class="nav-link active text-dark" href="index.php?action=forum">Forum</a></li>	  				
		<?php headerLinksChoices()?>
            <li class="nav-item"><a class="nav-link active text-dark" href="index.php?action=game&amp;direction=create">Create puzzles</a></li>
        </ul>
	</nav>
</header>

<?php
function headerLinksChoices(){
	if (isset($_SESSION['admin'])) {
		if($_SESSION['admin'] == 1){
			headerAdmin(); //when administrator is connect
		}else{ 
			headerUser(); //when user is connect
		}
	}else{ 
		headerNoneConnect(); //when nobody is connect
	}
}

function headerAdmin(){
	?>
		<li class="nav-item">
			<a class="nav-link active text-dark" href="index.php?action=backoffice">Back office</a>
		</li>
	<?php
}

function headerUser(){
	?>
		<li class="nav-item">
			<a class="nav-link active text-dark" href="index.php?action=users&amp;direction=logOut">Log out</a>
		</li>
	<?php
}

function headerNoneConnect(){
	?>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle active text-dark" data-toggle="dropdown" href="#">Sign in</a>
            <div class="dropdown-menu">
            	<a href="index.php?action=users&amp;direction=inscription" class="dropdown-item">Register</a>
            	<a href="index.php?action=users&amp;direction=connection" class="dropdown-item">Sign in</a>
            </div>             
	    </li>
	<?php
} 