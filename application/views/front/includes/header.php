<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <title><?= isset($title)?$title:'Insaaf99 the legal solutions' ?> </title>
    <meta name="keyword" content="<?= isset($keywords)?$keywords:'Insaaf99 the legal solutions' ?>">
    <meta name="description"
        content="<?= isset($description)?$description:'Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.' ?>">
    <meta name="og:url" content="<?= isset($og_url)?$og_url:'' ?>">
    <meta name="og:image" content="<?= isset($og_image)?$og_image:'' ?>">
    <meta name="og:title" content="<?= isset($og_title)?$og_title:'' ?>">
    <meta name="og:description" content="<?= isset($og_description)?$og_description:'' ?>">
    <meta name="og:site_name" content="<?= isset($og_site_name)?$og_site_name:'' ?>">
    <meta name="twitter:card" content="<?= isset($twitter_card)?$twitter_card:'' ?>">
    <meta name="twitter:title" content="<?= isset($twitter_title)?$twitter_title:'' ?>">
    <meta name="twitter:description" content="<?= isset($twitter_description)?$twitter_description:'' ?>">

    <link rel="canonical" href="<?= isset($canonical)?$canonical:'' ?>" />
    <link rel="icon" type="image/x-icon" href="<?php echo base_url()?>assets/images/fevicon.png">
    <!-- owl -->

    <!-- end -->
    <!-- Personal csss -->
    <?php 
    $segment0 = $this->uri->segment(1);
    $segment1 = $this->uri->segment(1);
    $segment2 = $this->uri->segment(1);
    $segment3 = $this->uri->segment(3);
    if(isset($segment3) && ($segment3 == "trademark" || $segment3 =="msme" || $segment3 =="online-gst-registration")){?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/innercss.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css">

    <?php }elseif(isset($segment2) && $segment2 == "specialization"){?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/innercss.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrapinner.min.css">

    <?php }elseif(isset($segment0) && $segment0 == "newhome"){?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">

    <?php }elseif(isset($segment1) && $segment1 == "start-up" || $segment1 == "documentation"){?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/innercss.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrapinner.min.css">

    <?php }elseif(isset($page) && $page == "ppc-mobile"){?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/mobilehome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/ppc-style.css">
    <?php }else{?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">
    <?php }
    ?>
    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

    <!-- Disclaimer start -->

    <!-- shecema script -->
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "image": "https://insaaf99.com/assets/images/law_logo.webp",
        "name": "insaaf99",
        "address": "https://insaaf99.com/",
        "logo": "https://insaaf99.com/assets/images/law_logo.webp",
        "url": "https://insaaf99.com/",
        "telephone": "+91-9953536391"
    }
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-249083622-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-249083622-1');
    </script>
</head>

<body>