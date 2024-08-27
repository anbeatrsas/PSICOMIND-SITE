
<?php 

    include "admin/acesso_com.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSICOMIND - Página Cliente</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/areaCliente.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/1a91a6d3b2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


</head>
<body>
    
    <section id="nav-bar">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button type="button" class="greeting-button disabled">
                            Olá, <?php echo ($_SESSION['nome_cliente']); ?>!
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="minhaConsulta.php">CONSULTAS</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="admin/logout.php">
                    <i class="fa-solid fa-sign-out-alt"></i>
                    <span class="sr-only">Logout</span>
                </a>
            </li>
                    </ul>
                </div>
            </nav>

    </section>

    <!-- banner section ---------------------------------->
     <section id="banner">

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="promo-title">Olá! <?php echo($_SESSION['nome_cliente']); ?> venha reservar sua consulta agora. </p>
                    <p>Agende sua consulta agora e comece sua jornada para um bem-estar mental completo.</p>
                    <button id="signup">
                        <a href="consulta.php">Agende sua consulta aqui!</a> 
                            <span class="material-symbols-outlined">
                                arrow_right_alt
                            </span>
                    </button>
                </div>
                    <div class="col-md-6 text-center">
                        <img src="images/agendamento.png" class="img-fluid">
                    </div> 
            </div>
        </div>
        
        <img src="images/wave1.png" class="bottom-img" alt="">
     </section>