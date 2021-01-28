<?php 

class TL_Coming_Soon_Public_Settings {

  private $plugin_name;
  private $version;
  private $plugin_slug;

  public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $this->plugin_slug = 'tl-coming-soon';

  }

  /**
   * -------------------------------------------------------------------------------
   * Load preview page
   * -------------------------------------------------------------------------------
  **/

  function tlcs_load_preview_page()
  { 
      $this->tlcs_load_public_page();
  }

  /**
   * -------------------------------------------------------------------------------
   * Load public page
   * -------------------------------------------------------------------------------
  **/

  public function tlcs_load_public_page()
  { ?><!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <title>
            <?php if ( !empty( get_option('tlcs_design_options')['title'] ) ): ?>
              <?php echo esc_attr( get_option('tlcs_design_options')['title'] ); ?>
            <?php else: ?>
                <?php _e( 'TL Coming Soon - Maintenance Mode & Under Construction', $this->plugin_slug ); ?>
            <?php endif ?>
          </title>
          <?php if ( isset( get_option('tlcs_general_options')['noindex_meta'] ) ): ?>
            <meta name="robots" content="noindex,nofollow">
          <?php endif ?>

          <?php if ( !empty( get_option('tlcs_design_options')['favicon'] ) ): ?>
          <link rel="icon" href="<?php echo esc_url( get_option('tlcs_design_options')['favicon'] ); ?>" />
          <?php endif ?>

          <?php if( in_array('contact-form-7/wp-contact-form-7.php', apply_filters('active_plugins', get_option('active_plugins'))) ): ?>
            <link href="<?php echo esc_url( plugins_url() ); ?>/contact-form-7/includes/css/styles.css" rel="stylesheet" media="all" />
          <?php endif ?>
          
          <!-- Bootstrap Core -->
          <link href="<?php echo esc_url( plugins_url( 'public/assets/css/bootstrap.min.css', dirname(__FILE__) ) ); ?>" rel="stylesheet">
         
          <!-- Font Awesome -->
          <link rel="stylesheet" href="<?php echo esc_url( plugins_url( 'public/assets/fonts/css/all.min.css', dirname(__FILE__) ) ); ?>">

          <!-- Contdown CSS -->
          <link href="<?php echo esc_url( plugins_url( 'public/assets/css/soon.min.css', dirname(__FILE__) ) ); ?>" rel="stylesheet">
          
          <!-- Siding contnent -->
          <link href="<?php echo esc_url( plugins_url( 'public/assets/css/pushy.min.css', dirname(__FILE__) ) ); ?>" rel="stylesheet">
          
          <!-- Main CSS -->
          <link href="<?php echo esc_url( plugins_url( 'public/assets/css/templates/', dirname(__FILE__) ) ); ?><?php echo isset( get_option('tlcs_template_options')['template'] ) ? get_option('tlcs_template_options')['template'] : 'forest'; ?>.css" rel="stylesheet">
          
          <!-- Main CSS -->
          <link href="<?php echo esc_url( plugins_url( 'public/assets/css/main.css', dirname(__FILE__) ) ); ?>" rel="stylesheet">

          <!-- Media CSS -->
          <link href="<?php echo esc_url( plugins_url( 'public/assets/css/media.css', dirname(__FILE__) ) ); ?>" rel="stylesheet">

          <!-- Google Analytics  -->
          <?php if ( !empty( get_option('tlcs_general_options')['google_analytics'] ) ): ?>
            <script>
              (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
              ga('create', '<?php echo get_option('tlcs_general_options')['google_analytics']; ?>', 'auto');
              ga('send', 'pageview');
            </script>
          <?php endif ?>

          <?php if ( !empty( get_option('tlcs_general_options')['insert_header_code'] ) ):
                echo get_option('tlcs_general_options')['insert_header_code'];
          endif ?>
          
          <?php if ( !empty( get_option('tlcs_design_options')['background'] ) ): ?>

              <!-- Begin::Solid and Gradient background type -->
              <?php if ( get_option('tlcs_design_options')['background']['type'] == 'solid_color' && !empty( get_option('tlcs_design_options')['background']['solid_color'] ) ): ?>
                
                <style>.background-wrapper{background:<?php echo esc_url( get_option('tlcs_design_options')['background']['solid_color'] ) ?>;}</style>
              
              <?php elseif( get_option('tlcs_design_options')['background']['type'] == 'gradient_color' && !empty( get_option('tlcs_design_options')['background']['gradient_color'] ) ): ?>

                <style>
                  .background-wrapper {
                    background: <?php echo get_option('tlcs_design_options')['background']['gradient_color']['first'] ?>;
                    background: -moz-linear-gradient(<?php echo get_option('tlcs_design_options')['background']['gradient_color']['position'] ?>, <?php echo get_option('tlcs_design_options')['background']['gradient_color']['first'] ?>, <?php echo get_option('tlcs_design_options')['background']['gradient_color']['second'] ?>);
                    background: -webkit-linear-gradient(<?php echo get_option('tlcs_design_options')['background']['gradient_color']['position'] ?>, <?php echo get_option('tlcs_design_options')['background']['gradient_color']['first'] ?>, <?php echo get_option('tlcs_design_options')['background']['gradient_color']['second'] ?>);
                    background: linear-gradient(<?php echo get_option('tlcs_design_options')['background']['gradient_color']['position'] ?>, <?php echo get_option('tlcs_design_options')['background']['gradient_color']['first'] ?>, <?php echo get_option('tlcs_design_options')['background']['gradient_color']['second'] ?>);
                  }
                </style>
                <!-- End::Solid and Gradient background type -->
              <?php else: ?>

                <!-- Begin::Solid and Gradient overlay type -->
                <?php if ( get_option('tlcs_design_options')['background']['overlay']['type'] == 'solid_color' ): ?>

                  <style>
                    .background-overlay{
                      background:<?php echo esc_url( get_option('tlcs_design_options')['background']['overlay']['solid_color'] ) ?>;
                      opacity: <?php echo (isset( get_option('tlcs_design_options')['background']['overlay']['opacity'] ) ? get_option('tlcs_design_options')['background']['overlay']['opacity'] : 0 ) ?>;
                    }
                  </style>

                <?php elseif( get_option('tlcs_design_options')['background']['overlay']['type'] == 'gradient_color' ): ?>

                  <style>
                    .background-overlay{
                      background: <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['first'] ?>;
                      background: -moz-linear-gradient(<?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['position'] ?>, <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['first'] ?>, <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['second'] ?>);
                      background: -webkit-linear-gradient(<?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['position'] ?>, <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['first'] ?>, <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['second'] ?>);
                      background: linear-gradient(<?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['position'] ?>, <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['first'] ?>, <?php echo get_option('tlcs_design_options')['background']['overlay']['gradient_color']['second'] ?>);
                      opacity: <?php echo (isset( get_option('tlcs_design_options')['background']['overlay']['opacity'] ) ? get_option('tlcs_design_options')['background']['overlay']['opacity'] : 0 ) ?>;
                    }
                  </style>

                <?php endif ?>
                <!-- End::Solid and Gradient overlay type -->

                  <!-- Begin::others background type -->
                  <?php if ( get_option('tlcs_design_options')['background']['type'] == 'single_image' ): ?>
                    
                    <?php if ( !empty( get_option('tlcs_design_options')['background']['single_image'] ) ): ?>
                      
                      <style>
                        .background-wrapper{
                            background: url(<?php echo (isset( get_option('tlcs_design_options')['background']['single_image'] ) ? get_option('tlcs_design_options')['background']['single_image'] : '' ) ?>);
                            filter: blur(<?php echo (isset( get_option('tlcs_design_options')['background']['overlay']['blur'] ) ? esc_attr( get_option('tlcs_design_options')['background']['overlay']['blur'] ) : 0); ?>px);
                            background-size: cover;
                            background-attachment: fixed;
                            background-position: center center;
                            background-repeat: no-repeat;
                        }
                      </style>

                    <?php else: ?>

                      <style>
                        .background-wrapper{
                            filter: blur(<?php echo (isset( get_option('tlcs_design_options')['background']['overlay']['blur'] ) ? esc_attr( get_option('tlcs_design_options')['background']['overlay']['blur'] ) : 0); ?>px);
                        }
                      </style>

                    <?php endif ?>


                  <?php elseif ( get_option('tlcs_design_options')['background']['type'] == 'image_slider' && !empty( get_option('tlcs_design_options')['background']['image_slider'] ) ): ?>

                    <style>
                      .background-wrapper{
                          filter: blur(<?php echo (isset( get_option('tlcs_design_options')['background']['overlay']['blur'] ) ? esc_attr( get_option('tlcs_design_options')['background']['overlay']['blur'] ) : 0); ?>px);
                      }
                    </style>

                  <?php elseif ( get_option('tlcs_design_options')['background']['type'] == 'pattern' && !empty( get_option('tlcs_design_options')['background']['pattern'] ) ): ?>

                    <style>
                      .background-wrapper{
                          background: url(<?php echo (isset( get_option('tlcs_design_options')['background']['pattern'] ) ? get_option('tlcs_design_options')['background']['pattern'] : '' ) ?>);
                          background-attachment: fixed;
                          background-position: center center;
                          background-repeat: repeat;
                      }
                    </style>

                  <?php elseif ( get_option('tlcs_design_options')['background']['type'] == 'video' && !empty( get_option('tlcs_design_options')['background']['video'] ) ): ?>

                    <style>
                      .background-video{
                          filter: blur(<?php echo (isset( get_option('tlcs_design_options')['background']['overlay']['blur'] ) ? esc_attr( get_option('tlcs_design_options')['background']['overlay']['blur'] ) : 0); ?>px);
                      }
                    </style>

                  <?php endif ?>
                  <!-- End::others background type -->

              <?php endif ?>
            
          <?php endif ?>

          <?php if ( !empty( get_option('tlcs_general_options')['custom_css'] ) ): ?>
            <style>
             <?php echo get_option('tlcs_general_options')['custom_css']; ?>
            </style>
          <?php endif ?>

        </head>

        <body>

           <?php if ( get_option('tlcs_design_options')['background']['type'] == 'video' && !empty( get_option('tlcs_design_options')['background']['video'] ) ): ?>
             
             <?php if( preg_match('/.*\.mp4.*/', get_option('tlcs_design_options')['background']['video'], $matchMP4) ): ?>
               <video id="background_video" loop muted></video>
              <style>
                .background-wrapper{background:transparent;}
                #background_video {
                  position: fixed;
                  top: 50%; 
                  left: 50%;
                  transform: translate(-50%, -50%);
                  object-fit: cover;
                  height: 100%; 
                  width: 100%;
                }
              </style>
             <?php endif ?>
           
           <?php endif ?>

          <?php if ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'particles' ): ?>
            
            <div id="particles-js"></div>
         
          <?php elseif( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] =='polygonal' ): ?>

            <div id="background-container" class="background-container">
              <div id="background-output" class="background-output"></div>
            </div> 

          <?php endif ?>

          <nav class="pushy pushy-left">
          
            <!-- Begin::About us -->
            <div class="inblock about">
              <div class="container">
                  <?php if ( !empty( get_option('tlcs_design_options')['more_info']['headline'] ) ): ?>
                    <div class="col-12 title">
                      <h2><?php echo esc_attr( get_option('tlcs_design_options')['more_info']['headline'] ); ?></h2>
                    </div>
                  <?php endif ?>

                  <?php if ( !empty( get_option('tlcs_design_options')['more_info']['content'] ) ): ?>
                    <div class="col-12 content">
                      <p><?php echo do_shortcode( stripslashes( get_option('tlcs_design_options')['more_info']['content'] ) ); ?></p>
                    </div>
                  <?php endif ?>

              </div>
            </div>
            <!-- End::About us -->
          </nav>

          <!-- Site Overlay -->
          <div class="site-overlay"></div>

          <!-- Begin::content -->
          <div class="content-wrapper<?php echo (empty( get_option('tlcs_design_options')['logo'] ) ? ' no-logo' : '') ?>">
            
              <div class="container">

                <div class="vcentr">

                  <!-- Template 13 -->
                  <div class="borders">
                    <div class="col-12">

                      <?php 
                        if ( !empty( get_option('tlcs_design_options')['logo'] ) ):
                            $logo = get_option( 'tlcs_design_options' )['logo'];
                            echo '<img src="' . esc_url($logo) .'" class="logo" alt="' . __( 'Logo', $this->plugin_slug ) . '">';
                        endif 
                      ?>
                      
                      <?php if ( !empty( get_option('tlcs_design_options')['headline'] ) ): ?>
                        <h1><?php echo esc_attr( get_option('tlcs_design_options')['headline'] ); ?></h1>
                      <?php endif ?>
                      
                      <!--Countdown-->

                      <?php if ( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'forest' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-scale-max="xs" 
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>"
                              data-layout="group label-uppercase label-big" 
                              data-format="d,h,m,s" 
                              data-face="slot slide down fast" 
                              data-visual="ring invert progressgradient-cafa00_009100 width-thick gap-2">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'cosmos' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-scale-max="xs" 
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group label-uppercase label-small" 
                              data-format="d,h,m,s" 
                              data-face="matrix dot-round slide right">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'particles' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group label-lowercase label-small" 
                              data-format="d,h,m,s" 
                              data-face="flip color-dark corners-sharp" 
                              data-scale-max="s">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'polygonal' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-scale-max="xs" 
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group" 
                              data-format="d,h,m,s" 
                              data-separator="." 
                              data-face="slot slide">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'cloud' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-scale-max="xs" 
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group label-hidden" 
                              data-format="d,h,m,s" 
                              data-separator="." 
                              data-reflect="false" 
                              data-face="slot slide">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == '3dbox' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-scale-max="xs" 
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group label-uppercase label-small" 
                              data-format="d,h,m,s" 
                              data-face="matrix slide up">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'medical' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group label-lowercase label-small" 
                              data-format="d,h,m,s" 
                              data-face="flip color-dark corners-sharp" 
                              data-scale-max="s">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'creative' ) ): ?> 
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="inline" 
                              data-scale-max="s" 
                              data-format="d,h,m,s" 
                              data-padding="false" 
                              data-face="slot slide down faster">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'sport' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="inline" 
                              data-scale-max="fill" 
                              data-format="d,h,m,s" 
                              data-face="slot">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'wedding' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group tight label-small" 
                              data-scale-max="m" 
                              data-format="d,h,m,s" 
                              data-separator=":" 
                              data-face="text">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'restaurant' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="inline" 
                              data-scale-max="xl" 
                              data-format="d,h,m,s" 
                              data-face="slot">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'pacman' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="inline" 
                              data-scale-max="xl" 
                              data-format="d,h,m,s" 
                              data-face="slot">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'building' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="inline" 
                              data-scale-max="s" 
                              data-format="d,h,m,s" 
                              data-padding="false" 
                              data-face="slot slide down faster">
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'seminar' ) ): ?>
                        
                        <div class="soon" 
                              id="soon-sep" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-scale-max="l" 
                              data-separator="." 
                              data-layout="group label-hidden" 
                              data-face="slot slide down" 
                              data-reflect="false">
                              <span class="soon-placeholder"></span>
                        </div>
                      
                      <?php elseif( !empty( get_option('tlcs_general_options')['countdown'] ) && ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'app' ) ): ?>
                        
                        <div class="soon" 
                              id="my-soon-counter" 
                              data-labels-days="<?php echo !empty( get_option('tlcs_translation_options')['days'] ) ? get_option('tlcs_translation_options')['days'] : 'Days'; ?>"
                              data-labels-hours="<?php echo !empty( get_option('tlcs_translation_options')['hours'] ) ? get_option('tlcs_translation_options')['hours'] : 'Hours'; ?>"
                              data-labels-minutes="<?php echo !empty( get_option('tlcs_translation_options')['minutes'] ) ? get_option('tlcs_translation_options')['minutes'] : 'Minutes'; ?>"
                              data-labels-seconds="<?php echo !empty( get_option('tlcs_translation_options')['seconds'] ) ? get_option('tlcs_translation_options')['seconds'] : 'Seconds'; ?>"
                              data-due="<?php echo date('Y-m-d\TH:i:s' . wp_timezone_string(), strtotime( get_option('tlcs_general_options')['countdown'] ) ); ?>" 
                              data-layout="group label-lowercase label-small" 
                              data-format="d,h,m,s" 
                              data-face="flip color-dark corners-sharp" 
                              data-scale-max="s">
                        </div>
                      
                      <?php endif ?>
                      

                      <?php if ( !empty( get_option('tlcs_design_options')['content'] ) ): ?>

                      <span class="descr"><?php echo get_option('tlcs_design_options')['content'] ?></span>  
                      
                      <?php endif ?>


                      <?php if ( !empty( get_option('tlcs_design_options')['more_info']['show_button'] ) && get_option('tlcs_design_options')['more_info']['show_button'] == 1 ): ?>

                        <button type="button"class="button btnwhite menu-btn"><?php echo !empty( get_option('tlcs_translation_options')['more_info'] ) ? get_option('tlcs_translation_options')['more_info'] : 'More Info'; ?></button>

                      <?php endif ?>

                      
                      <?php if ( !empty( get_option('tlcs_design_options')['subscribe']['show_button'] ) && get_option('tlcs_design_options')['subscribe']['show_button'] == 1 ): ?>
                        
                        <a href="javascript:void(0)" class="button btndark" data-toggle="modal" data-target="#subscribeModal"><?php echo !empty( get_option('tlcs_translation_options')['notify_me'] ) ? get_option('tlcs_translation_options')['notify_me'] : 'Notify me'; ?></a>
                        
                      <?php endif ?>
                      
                      
                      <ul class="social">
                        
                        <?php if ( !empty( get_option('tlcs_social_options')['facebook'] ) ): ?>
                          
                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['facebook'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['twitter'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['twitter'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Twitter"><i class="fab fa-twitter"></i></a></li>
                        
                        <?php endif ?>
                        
                        <?php if( !empty( get_option('tlcs_social_options')['instagram'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['instagram'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Instagram"><i class="fab fa-instagram"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['youtube'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['youtube'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Youtube"><i class="fab fa-youtube"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['linkedin'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['linkedin'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> LinkedIn"><i class="fab fa-linkedin"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['skype'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['skype'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Skype"><i class="fab fa-skype"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['github'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['github'] ); ?>" data-toggle="tooltip" title="<?php ?> Github"><i class="fab fa-github"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['behance'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['behance'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Behance"><i class="fab fa-behance"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['dribble'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['dribble'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Dribble"><i class="fab fa-dribbble"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['flickr'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['flickr'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Flickr"><i class="fab fa-flickr"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['pinterest'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['pinterest'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Pinterest"><i class="fab fa-pinterest"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['tumblr'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['tumblr'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Tumblr"><i class="fab fa-tumblr"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['vimeo'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['vimeo'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Vimeo"><i class="fab fa-vimeo"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['vk'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['vk'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> VK"><i class="fab fa-vk"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['telegram'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['telegram'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Telegram"><i class="fab fa-telegram"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['whatsapp'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['whatsapp'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> WhatsApp"><i class="fab fa-whatsapp"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['email'] ) ): ?>

                          <li><a href="mailto:<?php echo esc_attr( get_option('tlcs_social_options')['email'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> Email"><i class="far fa-envelope"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['phone'] ) ): ?>

                          <li><a href="tel:<?php echo esc_attr( get_option('tlcs_social_options')['phone'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['call_now'] ) ? get_option('tlcs_translation_options')['call_now'] : 'Call now'; ?>"><i class="fas fa-phone"></i></a></li>
                        
                        <?php endif ?>

                        <?php if( !empty( get_option('tlcs_social_options')['rss'] ) ): ?>

                          <li><a href="<?php echo esc_url( get_option('tlcs_social_options')['rss'] ); ?>" data-toggle="tooltip" title="<?php echo !empty( get_option('tlcs_translation_options')['follow'] ) ? get_option('tlcs_translation_options')['follow'] : 'Follow us on'; ?> RSS"><i class="fas fa-rss"></i></a></li>
                        
                        <?php endif ?>

                      </ul>

                    </div>
                  </div>

                </div>
  
              </div>

              <?php if ( !empty( get_option('tlcs_design_options')['footer'] ) ): ?>
                <div class="footer-copyright">
                    Powered by WordPress | <a href="https://wordpress.org/plugins/tl-coming-soon">TL Coming Soon</a> Plugin by <a href="https://themeluxury.com">ThemeLuxury</a>
                </div>
              <?php else: ?>
                <div class="footer-copyright">
                   <?php echo get_option('tlcs_design_options')['footer']; ?>
                </div>
              <?php endif ?>

          </div>
          <!-- End::content -->  

          <div class="background-wrapper"></div>
          <?php if ( get_option('tlcs_design_options')['background']['type'] == 'video' ) : ?>
            <div class="background-video">
              <div class="background-overlay"></div>
            </div>
          <?php else: ?>
            <div class="background-overlay"></div>
          <?php endif ?>
          <!-- End::background -->
          
          <?php if( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'pacman' ): ?>
            <div class="game">
                <div id="pacman"></div>
            </div>
          <?php endif ?>

          <!-- Begin::subscribeModal -->
          <div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModal" aria-hidden="true">
              <div class="dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="subs">
                    <div class="bordic">
                      <div class="form-content">
                        <h3><i><?php echo !empty( get_option('tlcs_translation_options')['subform_headline'] ) ? get_option('tlcs_translation_options')['subform_headline'] : 'Notify me when its ready'; ?></i><span><?php echo !empty( get_option('tlcs_translation_options')['subform_description'] ) ? get_option('tlcs_translation_options')['subform_description'] : 'Our website is under construction, we are working very hard to give you.'; ?></span></h3>
                        
                        <form method="post" id="<?php echo (isset(get_option('tlcs_design_options')['subscribe']['service']) && get_option('tlcs_design_options')['subscribe']['service'] != 'feedburner' ? 'subscribe_form' : 'subscribe_form_feedburner') ?>">

                           <div class="input-group">
                            
                            <div class="icomail"> 
                              <i class="fas fa-envelope"></i>
                              <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo !empty( get_option('tlcs_translation_options')['enter_email'] ) ? get_option('tlcs_translation_options')['enter_email'] : 'Enter your email'; ?>" required="required">
                            </div>

                            <div class="input-group-append">
                              <button class="input-group-text btndark" type="submit">
                                <span class="d-none d-sm-inline-block mr-1"><?php echo !empty( get_option('tlcs_translation_options')['send'] ) ? get_option('tlcs_translation_options')['send'] : 'Send'; ?></span>
                                <span id="faLoading"><i class="fas fa-paper-plane"></i></span>
                              </button>
                            </div>

                          </div>
                          <?php if ( get_option('tlcs_design_options')['subscribe']['service'] == 'feedburner' ): ?>
                            <input type="hidden" id="feedburner_username" name="feedburner_username" value="<?php echo get_option('tlcs_design_options')['subscribe']['feedburner']['username'] ?>">
                          <?php endif ?>
                          <input type="hidden" id="service" name="service" value="<?php echo get_option('tlcs_design_options')['subscribe']['service'] ?>">
                        
                        </form>

                        <div id="alert-success" class="alert alert-success mt-3 d-none"></div>
                        <div id="alert-error" class="alert alert-danger mt-3 d-none"></div>

                      </div>
                    </div>
                    <span class="tlcs_close_button_modal"><i class="fas fa-times"></i></span>
                  </div>
              </div>
            </div>
          </div>
          <!-- End::subscribeModal -->

          <!-- jQuery core -->
          <script src="<?php echo esc_url( includes_url( '/js/jquery/jquery.js' ) ); ?>"></script>
          <!-- Popper core -->
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/popper.min.js', dirname(__FILE__) ) ); ?>"></script>
          <!-- Bootstrap core -->
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/bootstrap.min.js', dirname(__FILE__) ) ); ?>"></script>
          <!-- Side content -->
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/pushy.min.js', dirname(__FILE__) ) ); ?>"></script>
          <!-- Countdown core -->
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/soon.min.js', dirname(__FILE__) ) ); ?>"></script>

          <!-- Begin::video settings -->
          <?php if ( get_option('tlcs_design_options')['background']['type'] == 'video' && !empty( get_option('tlcs_design_options')['background']['video'] ) ): ?>

            <?php $checkVideoType = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', get_option('tlcs_design_options')['background']['video'], $id); ?>
            
            <?php if ( $checkVideoType ): ?>
              <!-- EasyBackground core -->
              <script src="<?php echo esc_url( plugins_url( 'public/assets/js/easyBackground.min.js', dirname(__FILE__) ) ); ?>"></script>
              <script>
                jQuery(document).ready(function($) {
                        'use strict';
                        $('.background-video').easyBackground({
                            effect: 'video',
                            video: 'youtube:<?php echo $id[1] ?>',
                            wrapNeighbours: true,
                            overlay: 'none'
                        });
                    });
              </script>

            <?php elseif( preg_match('/.*\.mp4.*/', get_option('tlcs_design_options')['background']['video'], $matchMP4 ) ): ?>
              <!-- Bvideo core -->
              <script src="<?php echo esc_url( plugins_url( 'public/assets/js/bideo.min.js', dirname(__FILE__) ) ); ?>"></script>
              <script>
                (function () {

                  var bv = new Bideo();
                  bv.init({
                    videoEl: document.querySelector('#background_video'),
                    container: document.querySelector('body'),
                    resize: true,
                    isMobile: window.matchMedia('(max-width: 768px)').matches,
                    src: [
                      {
                        src: '<?php echo esc_url(get_option('tlcs_design_options')['background']['video']); ?>',
                        type: 'video/mp4'
                      }
                    ]
                  });
                  
                }());
              </script>

            <?php endif ?>

          <?php endif ?>
          <!-- End::video settings -->

          <!-- Begin::slideshow settings -->
          <?php if ( get_option('tlcs_design_options')['background']['type'] == 'image_slider' && !empty( get_option('tlcs_design_options')['background']['image_slider'] ) ): ?>
            <script src="<?php echo esc_url( plugins_url( 'public/assets/js/easyBackground.min.js', dirname(__FILE__) ) ); ?>"></script>
            <script type="text/javascript">
              jQuery(document).ready(function($) {
                      'use strict';
                      $('.background-wrapper').easyBackground({
                          effect: 'slideshow',
                          duration: <?php echo get_option('tlcs_design_options')['background']['image_slider']['duration'] ?>,
                          slides: [
                            <?php 
                            $html = '';
                              foreach (get_option('tlcs_design_options')['background']['image_slider']['data'] as $value) {
                                $html .= "'";
                                $html .= $value;
                                $html .= "', ";
                              }
                              echo $html;
                            ?>
                          ],
                          wrapNeighbours: true,
                          overlay: 'false'
                      });
                  });
            </script>
          <?php endif ?>
          <!-- End::slideshow settings -->

          <?php if ( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'particles' ): ?>
            
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/particles.min.js', dirname(__FILE__) ) ); ?>"></script>
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/particle-init.min.js', dirname(__FILE__) ) ); ?>"></script>
         
          <?php elseif( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'polygonal' ): ?>

          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/flat-surface-shader.js', dirname(__FILE__) ) ); ?>"></script>
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/shader.js', dirname(__FILE__) ) ); ?>"></script>

          <?php elseif( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == '3dbox' ): ?>

          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/Three.js', dirname(__FILE__) ) ); ?>"></script>
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/Detector.js', dirname(__FILE__) ) ); ?>"></script>
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/orto.js', dirname(__FILE__) ) ); ?>"></script>
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/isometric.js', dirname(__FILE__) ) ); ?>"></script>

          <?php elseif( !empty( get_option('tlcs_template_options')['template'] ) && get_option('tlcs_template_options')['template'] == 'pacman' ): ?>

          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/pacman.js', dirname(__FILE__) ) ); ?>"></script>
          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/modernizr.min.js', dirname(__FILE__) ) ); ?>"></script>

          <?php endif ?>

          <?php if ( !empty( get_option('tlcs_general_options')['insert_footer_code'] ) ):
                echo get_option('tlcs_general_options')['insert_footer_code'];
          endif ?>

          <?php do_action( 'tlcs_subscribe_form_ajax') ?>

          <script src="<?php echo esc_url( plugins_url( 'public/assets/js/subscribe-form.js', dirname(__FILE__) ) ); ?>"></script>

          <?php if( in_array('contact-form-7/wp-contact-form-7.php', apply_filters('active_plugins', get_option('active_plugins'))) ): ?>
            <script id="contact-form-7-js-extra">
              var wpcf7 = {"apiSettings":{"root":"<?php echo esc_url( home_url( '/' ) ); ?>wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"}};
            </script>
            <script src="<?php echo esc_url( plugins_url() ); ?>/contact-form-7/includes/js/scripts.js" id="contact-form-7-js"></script>
          <?php endif ?>

        </body>

        </html>

  <?php }

}