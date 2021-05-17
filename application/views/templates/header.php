    <!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- style css  -->
        <title><?=$judul?></title>
    </head>
    <body onLoad =  "renderTime(), fixDate(), linkActive();" style="background-image: url(<?=base_url();?>assets/img/background4.jpeg); background-repeat:no-repeat; background-size: cover; height: 100%">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <!-- <div class="container"> -->
    <?php if ($this->session->has_userdata('resepsionis')): ?>
    <a class="navbar-brand " href="<?=base_url()?>home">Welcome, Resepsionist </a>
    <?php elseif ($this->session->has_userdata('instruktur')): ?>
    <a class="navbar-brand " href="<?=base_url()?>instruktur">Welcome, Instructor</a>
    <?php elseif ($this->session->has_userdata('owner')): ?>
    <a class="navbar-brand" href="<?=base_url()?>">Welcome, Owner</a>
    <?php endif;?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
        <?php if (!$this->session->has_userdata('instruktur')): ?>
        <li class="nav-item">
            <a class="nav-link <?=$active_home?>" href="<?=base_url()?>">Home <span class="sr-only">(current)</span></a>
        </li>

        <?php if (!$this->session->has_userdata('owner')): ?>
        <li class="nav-item">
            <a class="nav-link <?=$active_reg?>" href="<?=base_url()?>registrasi">Registration</a>
        </li>
        <?php endif;?>
        <li class="nav-item">
            <a class="nav-link <?=$active_mem?>" href="<?=base_url()?>member">Member</a>
        </li>
                <li class="nav-item">
            <a class="nav-link <?=$active_pro?>" href="<?=base_url()?>produk">Product</a>
        </li>
        <?php if (!$this->session->has_userdata('resepsionis')): ?>
        <li class="nav-item">
            <a class="nav-link <?=$active_his?>" href="<?=base_url()?>history">History</a>
        </li>
        <?php endif;?>
        <?php endif;?>
        </ul>
        </div>

    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
        <span class="navbar-brand" id = "clockDisplay"></span>
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>auth/logout">Logout</a>
        </li>
        </ul>
    </div>

    </div>
    <!-- </div> -->
    </nav>
    <br><br><br>

<!-- <div id = "clockDisplay" class="container"></div> -->
