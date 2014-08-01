<!DOCTYPE html>
<html class="no-js" lang="es">
  <head>
    <title><?=$config['title']?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="megR7PQIQHvI8ydvSNkgqT8p_5c5if0DEWDW07KjcwM">

    <meta name="y_key" content="64b257ab4f44157c">

    <meta name="msvalidate.01" content="FB4B7175129315197834C7A527DDAAF3">

    <meta name="description" content="<?=$config['description']?>">

    <meta name="author" content="<?=$config['author']?>">

    <meta name="copyright" content="<?=$config['copyright']?>">

    <meta name="keywords" lang="en" content="<?=$config['keywords']?>" />

    <meta name="reply-to" content="<?=$config['contact'][1]?>">

    <link rel="stylesheet" href="<?=base_url()?>css/foundation.min.css" />

    <link rel="stylesheet" href="<?=base_url()?>css/style.min.css">
    
    <script src="<?=base_url()?>js/vendor/modernizr.min.js"></script>

    <link rel="shortcut icon" href="http://websarrollo.com/img/favicon.ico" type="image/x-icon">
    
</head>
<body>

<div class="fixed">

<nav class="top-bar" data-topbar data-options="is_hover: true">

    <ul class="title-area">
        <li class="name">
            <h1>
                <img src="<?=base_url()?>img/logo.png" class="logo" alt="Websarrollo" title="<?=$language->line('header_altLogo')?>" onclick="redirect('<?=$config['domain']?>')" >
                <!-- <small><?=$companyInfo->slogan?></small> -->
            </h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href=""><span>Menu</span></a></li>
    </ul>

    <ul>
        <section class="top-bar-section">
            
                <ul class="right">
                <!-- <li class="has-form">
                  <div class="row collapse">
                  
                    <div class="large-8 small-9 columns">
                      <input type="text" name="txtDomain" placeholder="¿ Qué dominio deseas comprar ?" class="imput-domains">
                    </div>
                    <div class="large-4 small-3 columns">
                      <a href="#" class="button radius postfix">Buscar</a>
                    </div>
                   
                  </div>
                </li> -->

                    <li>
                        <a href="<?=$config['domain']?>"><img src="<?=base_url()?>img/home.png" alt="Principal" width="25" height="25" >&nbsp;<?=$language->line('header_home')?></a>
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a href="<?=base_url().'wadmin/'?>" target="_blank"><img src="<?=base_url()?>img/lock.png" alt="clientes" width="25" height="25" >&nbsp;<?=$language->line('header_signIn')?></a>
                    </li>   

                    <li class="divider"></li>

                    <li>
                        <a href="<?=base_url().'wadmin/register.php'?>" target="_blank"><img src="<?=base_url()?>img/user.png" alt="registro" width="25" height="25" >&nbsp;<?=$language->line('header_signUp')?></a>
                    </li>   

                    <li class="divider"></li>

                    <li>
                        <a href="<?=$config['domain']?>/content/body/contactenos" width="25" height="25" ><img src="<?=base_url()?>img/mail.png" alt="contacto">&nbsp;<?=$language->line('header_support')?></a>
                    </li>   

                  <!--   <li class="divider"></li>

                    <li class="has-dropdown not-click">
                        <a href="#"><img src="<?=base_url()?>img/world.png" alt="idioma" width="25" height="25" >&nbsp;Idioma</a>
                        <ul class="dropdown">
                            <li>
                                <a href="#">Espa&ntilde;ol</a>
                            </li>
                            <li>
                                <a href="#">English</a>
                            </li>
                        </ul>
                    </li> -->
                    
                     <?php if (isset($wp_user) && $wp_user['id']!=''){ ?>
                        <li class="divider"></li>
                        <li class="has-dropdown not-click">
                            <a href="#"><img src="<?=base_url()?>img/wpanel.png" alt="wpanel" width="25" height="25" >&nbsp;<?=$language->line('header_manage')?></a>
                            <ul class="dropdown">
                                <li>
                                    <a href="<?=$config['domain'].'/content/body/listado-de-contenidos'?>"><?=$language->line('header_contents')?></a>
                                </li>
                                <li>
                                    <a href="<?=$config['domain'].'/wpanel/logout/'?>"><?=$language->line('header_logOut')?></a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>

                </ul>
        </section>

    </ul>
</nav>

</div>
<?php if (!empty($index)){ ?>
<div class="row bannerTop_box" >
    <ul class="bannerTop" data-orbit data-options="bullets:false; pause_on_hover: false; timer_speed: 3000; slide_number: true; slide_number_text: de; timer: true">
        <li>
                <img src="<?=base_url()?>img/orbit/1.jpg" alt="banner" />
                <div class="orbit-caption"><?=$language->line('header_orbit_slide01')?></div> 
            </li> 
                    <li>
                <img src="<?=base_url()?>img/orbit/2.jpg" alt="banner" />
                <div class="orbit-caption"><?=$language->line('header_orbit_slide02')?></div> 
            </li> 
                    <li>
                <img src="<?=base_url()?>img/orbit/3.jpg" alt="banner" />
                <div class="orbit-caption"><?=$language->line('header_orbit_slide03')?></div> 
            </li> 
                    <li>
                <img src="<?=base_url()?>img/orbit/4.jpg" alt="banner" />
                <div class="orbit-caption"><?=$language->line('header_orbit_slide04')?></div> 
            </li> 
                    <li>
                <img src="<?=base_url()?>img/orbit/5.jpg" alt="banner" />
                <div class="orbit-caption"><?=$language->line('header_orbit_slide05')?></div> 
            </li> 
                    <li>
                <img src="<?=base_url()?>img/orbit/6.jpg" alt="banner" />
                <div class="orbit-caption"><?=$language->line('header_orbit_slide06')?></div> 
            </li> 
    </ul>
    <hr>
</div>
<?php } ?>

<div class="row">
    <div class="large-9 columns" role="content" id="middle">