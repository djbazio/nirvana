<head>
  <meta charset="UTF-8">
  <title> 
      <?php $__env->startSection('title'); ?>
          <?php echo e(settings('site_name')); ?>

      <?php echo $__env->yieldSection(); ?>
  </title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <script src="/assets/js-core/modernizr.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo e(elixir('base.css')); ?>">
  <link rel="stylesheet" href="/assets/css-core/custom.css">
  <?php if(app()->getLocale() == 'ar'): ?>
  <link rel="stylesheet" href="/assets/css-core/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="/assets/css-core/theme-rtl.css">
  <?php endif; ?>
  <link href="<?php echo asset('img/favicon.ico'); ?>" rel="icon" type="image/gif" sizes="16x16">
  <script src="<?php echo e(elixir('vendor.js')); ?>"></script>
  <style type="text/css">
    #header-logo .logo-content-big {
        <?php if(settings('site_logo')): ?>
          background: url(<?php echo json_encode(asset('uploads/site/'. settings('site_logo'))); ?>) left 50% no-repeat;
        <?php endif; ?>
    }

    .logo-content-small {
        background: url(<?php echo json_encode(asset('img/small-logo-white.png')); ?>) left 50% no-repeat;
        left: 10px !important;
        width: 50px !important;
    }

    @media  only screen and (max-width: 870px) {
    .logo-content-small {
        left: 75px !important;
      }
    }

    /*loader one css start*/
    #loader {
      width: 100px;
      height: 100px; 
      -webkit-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);  
      position: absolute;
      top: 20%;
      left: 50%; 
    }

    .a {
      width: 90px;
      height: 90px;
      border: 1px solid #d1ccc0;  
      position: absolute;
      border-radius: 50%;
      border-bottom: 1px solid #164A7F;
      border-top: 1px solid #164A7F;
      -webkit-animation: spin-right 2s linear infinite;
      animation: spin-right 2s linear infinite;
    }

    .b {
      width: 80px;
      height: 80px;
      border: 1px solid #d1ccc0; 
      border-radius: 50%;
      margin: 5px 5px; 
      border-bottom: 1px solid #164A7F;
      border-top: 1px solid #164A7F;
      -webkit-animation: spin-left 1s linear infinite;
      animation: spin-left 2s linear infinite;
    }

    .c {
      width: 70px;
      height: 70px;
      position: absolute;
      border: 1px solid #d1ccc0; 
      border-radius: 50%;
      margin: -82px 10px; 
      border-bottom: 1px solid #164A7F;
      border-top: 1px solid #164A7F;
      -webkit-animation: spin-right 2s linear infinite;
      animation: spin-right 2s linear infinite;
    }

    .d {
      width: 60px;
      height: 60px;
      position: absolute;
      border: 1px solid #d1ccc0; 
      border-radius: 50%;
      margin: -77px 15px; 
      border-bottom: 1px solid #164A7F;
      border-top: 1px solid #164A7F; /*16a085*/
      -webkit-animation: spin-left 1s linear infinite;
      animation: spin-left 1s linear infinite;
    }

    @keyframes  spin-left {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(-360deg); }
    }

    @keyframes  spin-right {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>

   <script type="text/javascript">
        $(window).load(function(){
            setTimeout(function() {
                $('#loading').fadeOut( 400, "linear" );
            }, 300);
        });
    </script>

</head>
