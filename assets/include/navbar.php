<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#000000" role="navigation">
  <a class="navbar-brand" href="/admin/dashboard.php">
    <img src="/assets/images/pi.jpg" alt="Logo" style="width:40px;">
    πHTV
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/admin/dashboard.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/">Show <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/admin/programmazione/programmazione.php">Programmazione <span class="sr-only">(current)</span></a>
      </li>
      <li class="navbar-text">
        Benvenuto/a <b><i><?= $_SESSION['username']?></i></b>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Archivio
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/admin/elenco/elenco_presentazioni.php">Presentazioni</a>
          <a class="dropdown-item" href="/admin/elenco/elenco_slides.php">Slides</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/creazione/crea_slide.php"><i>Crea Slide</i><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/admin/autenticazione/logout.php"><i>Logout</i><span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav> 
<br>