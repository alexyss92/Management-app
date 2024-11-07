    <?php
        // https://training.alessandradiaspro.com/gestione/index.php
        // setActivePage("index.php"); In questo caso, stripos() restituisce 41
        // if(val) se val=0 -> false, val !=0 true 
        function setActivePage($pageName) {
            if (stripos($_SERVER['REQUEST_URI'], $pageName) ) {
                echo ' active" aria-current="page"';
            } else {
                echo '"';
            }
        } 

        function setActiveItem($pageName) {
            if (stripos($_SERVER['REQUEST_URI'], $pageName) ) {
                echo ' active" aria-current="true"';
            } else {
                echo '"';
            }
        } 
    ?>
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="images/logo.png" style="width: 50px;" class="rounded-pill" alt="logo" title="Se clicchi qui andrai nell'homepage">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link<?php setActivePage("index.php"); ?> href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?php setActivePage("clienti.php"); ?> href="clienti.php">Clienti</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?php setActivePage("progetti.php"); ?> href="progetti.php">Progetti</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?php setActivePage("attivita.php"); ?> href="attivita.php">Attività</a>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Sottomenù A</a></li>
                    <li><a class="dropdown-item" href="#">Sottomenù B</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sottomenù C</a></li>
                </ul>
              </li>
            </ul>
            
            <form action="cerca.php" method="post" class="d-flex">
              <input id="cerca" name="cerca" type="text" class="form-control me-2" placeholder="Cerca" required>
              <button class="btn btn-primary" type="submit">Cerca</button>
            </form>
        </div>

      </div>
    </nav>