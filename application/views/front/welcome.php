<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Event snippet for Welcome Form conversion page -->
    <script>
    gtag('event', 'conversion', {
        'send_to': 'AW-11082875812/w8l6CNzYmYoYEKSH3aQp'
    });
    </script>

    <style>
    @media only screen and (max-width: 1200px) {
        .for_pod_full_body {
            background: black;
            height: auto !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-top: 25px;
            padding-bottom: 25px;
        }

        .odkkfjgjg {
            margin-top: 15px !important;
        }
    }

    .odkkfjgjg img {
        width: 100%;
    }

    .for_pod_full_body {
        background: #d3ddff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .odkkfjgjg {
        text-align: center;
        margin: auto;
        display: flex;
        flex-direction: column;
        height: 500px;
        border: 1px solid #d3d3d3;
        justify-content: center;
        border-radius: 20px;
    }

    .for-eor_plfkkgj {
        box-shadow: 0px 2px 4px 2px #dddddd;
        padding: 11px;
        border-radius: 20px;
        background: #f7f7f7;
    }

    h2.for_texgdffp_dec {
        padding-left: 11px;
        color: white;
        font-weight: 600;
        text-align: start;
        font-size: 26px;
    }

    .flkgkgfdjooflgk {
        height: 270px;
        justify-content: center;
        display: flex;
        flex-direction: column;
    }

    .dkfi_skidlf a {
        color: gray;
        text-decoration: none;
    }

    .dkfi_skidlf {
        text-align: end;
        margin-right: 19px;
        margin-top: 9px;
    }

    .sub_title_smap_smal {
        text-align: start;
        padding: 11px;
        color: gray;
    }

    .for_ssdjkoof i {
        color: white;
    }

    .for_ssdjkoof {
        text-align: end;
        margin-right: 25px;
        font-size: 34px;
    }

    .for_skip_img p {
        color: white;
        font-size: 18px;
    }

    .for_skip_img {
        text-align: center;
        margin-top: 60px;
        margin-bottom: 35px;
        font-size: 20px;
    }

    .for_fnq_welcom {
        text-align: end;

        margin-bottom: 15px;

    }

    .for_fnq_welcom img {
        width: 10%;
    }

    .for_fnq_welcom button {
        background: #6eb102;
        color: white;
        border: 1px solid #343b96;
        font-weight: 600;
    }
    </style>
</head>

<body>
    <div class="for_pod_full_body">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-12 text-center">
                <?php if(isset($_GET['s']) && !empty($_GET['s'])){?>
                    <img src="<?= base_url('assets/images/success.png')?>" width="100">
                    <br /><br />
                    <?php echo '<h2 class="text-success text-center"> '.$_GET['s'].'</h2>';?>
                    <?php }elseif(isset($_GET['f']) && !empty($_GET['f'])){?>
                        <img src="<?= base_url('assets/images/failed.webp')?>" width="100">
                    <br /><br />
                    <?php echo '<h2 class="text-danger text-center"> '.$_GET['f'].'</h2>';?>
                    <?php }elseif(isset($_GET['ss']) && !empty($_GET['ss'])){?>
                    <img src="<?= base_url('assets/images/success.png')?>" width="100">
                    <br /><br />
                    <?php echo '<h2 class="text-success text-center"> '.$_GET['ss'].'</h2>';?>
                    <?php }elseif(isset($_GET['ff']) && !empty($_GET['ff'])){?>
                        <img src="<?= base_url('assets/images/failed.webp')?>" width="100">
                    <br /><br />
                    <?php echo '<h2 class="text-danger text-center"> '.$_GET['ff'].'</h2>';?>
                    <?php }else{?>
                        <img src="<?= base_url('assets/images/success.png')?>" width="100">
                    <br /><br />
                    <h2 class="text-success text-center">Thank you for contacting us. Our Expert will answer you shortly!</h2>
                    <?php }?>
                    <br />
                    <a href="<?= base_url() ?>" class="btn btn-primary"><i class="bi bi-house"></i> Go Home</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>