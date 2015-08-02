<?php
/*
 * Made by Viktor Verebelyi @viktorgino vviktor2@gmail.com
 * All rights reserverd, altough if you can read this you can pretty much do whatever you want with it, its not like I care.
 * If this code is useful for you please bump me. My email address is my PayPal address and I drunk at least 2-3 beers while doing this, so I'd appreciate if you'd buy me an other one
 * 
 */


if (!defined('ABSPATH'))
    exit;
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title><?php wcdn_document_title(); ?></title>

        <?php
        // wcdn_head hook
        do_action('wcdn_head');
        ?>
        <style type="text/css">
            @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
            @media print  
            {
                body{
                    zoom:80%;
                }
                div{
                    page-break-inside: avoid;
                }
            }
            body, h1, h2, h3, h4, h5, h6{
                font-family: 'Bree Serif', serif;
            }
            .panel-body i{
                font-size:1.5em;
                background:#333333;
                color:#ffffff;
                padding:10px;
                border-radius:25px;
                text-align:center;
                margin:3px;
            }

            .panel-default,.panel-heading,.table-bordered,.table-bordered > thead > tr > th,.table-bordered > tbody > tr > td,.table-bordered > thead > tr > th,.panel-info,.panel-info > .panel-heading,.panel-default > .panel-heading{
                border-color:#000000;
            }  
            img{
                height:200px;
                width: auto;
            }
            @page  
            { 
                size: auto;
                margin: 2mm 2mm 2mm 2mm;  
            }
        </style>
    </head>

    <body class="<?php echo wcdn_get_template_type(); ?>">

        <div id="container">

            <?php
            // wcdn_head hook
            do_action('wcdn_before_page');
            ?>

            <div id="page">