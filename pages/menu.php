<?php
    //require_once('identifier.php');
?>

<nav class="navbar navbar-inverse navbar-fixed-top">

	<div class="container-fluid">
	
		<div class="navbar-header">
		
			<a href="../index.php" class="navbar-brand">Geassuce</a>
			
		</div>
		
		<ul class="nav navbar-nav">
					
			<li><a href="fournisseurs.php">
                    <i class="fa fa-vcard"></i>
                    &nbsp Fournisseurs
                </a>
            </li>
			
			<li><a href="marches.php">
                    <i class="fa fa-tags"></i>
                    &nbsp Marchés
                </a>
            </li>
			
			<li><a href="policeAssurance.php">
                        <i class="fa fa-users"></i>
                        &nbsp Police d'Assurance
                    </a>
                </li>
					
				<li><a href="Utilisateurs.php">
                        <i class="fa fa-users"></i>
                        &nbsp Users
                    </a>
                </li>
				
				
		</ul>
		
		
		<ul class="nav navbar-nav navbar-right">
					
			<li>
				<a href="editerUtilisateur.php?id=<?php echo $_SESSION['user']['iduser'] ?>">
                    <i class="fa fa-user-circle-o"></i>
					<?php echo  ' '.$_SESSION['user']['login']?>
				</a> 
			</li>
			
			<li>
				<a href="seDeconnecter.php">
                    <i class="fa fa-sign-out"></i>
					&nbsp Se déconnecter
				</a>
			</li>
							
		</ul>
		
	</div>
</nav>
