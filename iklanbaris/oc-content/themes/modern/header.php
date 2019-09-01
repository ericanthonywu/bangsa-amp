<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>

<!-- header -->

<div id="header">
<div class="redbar"></div>
<div class="wrapper">
  <div class="logobox kir">


   <a class="logolink" href="<?php echo osc_base_url() ; ?>">Tokobagus</a>    
  </div>

<div class="topmenu kan">

<a class="pasang-iklan kan" href="<?php echo osc_item_post_url_in_category() ; ?>"><i class="plus-med kir"></i><?php _e("Pasang Iklan Gratis", 'modern');?></a>
		 
     <?php if( osc_is_web_user_logged_in() ) { ?>

     <div class="login-box kan">
         <div class="kir">
         <a href="<?php echo osc_user_dashboard_url() ; ?>"><font color="#0076c4"><?php _e('Akun Saya', 'modern') ; ?></font></a>
        </div>
        <div class="verbar-bevel kir"></div>
        <div class="kir">
        <a href="<?php echo osc_user_logout_url() ; ?>"><font color="#0076c4"><?php _e('Logout', 'modern') ; ?></font></a>
        </div> 
    </div>
                 <?php } else { ?>
          	 <?php (osc_user_registration_enabled()) ?>

    <div class="login-box kan">
       <div class="kir">                    
       <a href="<?php echo osc_user_login_url(); ?>"><font color="#0076c4" ><?php _e('Login', 'modern') ; ?></font></a>
       </div>
      <div class="verbar-bevel kir"></div>
      <div class="kir">
      <a href="<?php echo osc_register_account_url() ; ?>"><font color="#0076c4"><?php _e('Daftar', 'modern'); ?></font></a>
      </div>
   </div>
   <?php  } ?>
</div>

<div class="horbar-bevel"></div>
<?php osc_current_web_theme_path('inc.search.php') ; ?>
<div class="clr"></div>
</div>

</div>
<div class="clear"></div>

<!-- /header -->
<!-- container -->

<div id="content">
<div class="wrapper">

<?php
    osc_show_widgets('header') ;

    $breadcrumb = osc_breadcrumb('&raquo;', false);
    if( $breadcrumb != '') { ?>
    <div class="breadcrumb">
        <?php echo $breadcrumb; ?>
        <div class="clr"></div>
    </div>
<?php
    }
?>


<div class="forcemessages-inline">
    <?php osc_show_flash_message(); ?>
<div id="flash_js"></div>

</div>