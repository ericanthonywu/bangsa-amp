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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
<script>
$(document).ready(function() {
     $('#clickme').click(function() {
          $('#me').animate({
               height: 'toggle'
               }, 500
          );
     });
});
</script>
<script>
$(document).ready(function() {
     $('#clickmes').click(function() {
          $('#mes').animate({
               height: 'toggle'
               }, 500
          );
     });
});
</script>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>



        <div class="catico">
<h2 class="kir"><?php _e("Pilih Kategori", 'modern');?>
<span class="arrdot"></span>
</h2>
<div class="clr"></div>
                 <ul>
                  <?php osc_goto_first_category(); ?>
                    <?php $tak=0; while( osc_has_categories() && $tak < 12 ) { ?>
                            <a href="<?php echo osc_search_category_url() ; ?>">
                            <li>
                            <div class="icos <?php echo osc_category_slug() ; ?>"></div>
                             
                             <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></li></a>
                          
                            </a>
                                                         <?php $tak++;} ?>
                                                         <?php View::newInstance()->_erase('category') ; ?>
                 </ul>
                          <div id="me" class="location" style="display:none;">                       
                       
                          <?php $tak= 12 ; while( osc_has_categories() && $tak++ ) { ?>  
                          <ul>
                          <a href="<?php echo osc_search_category_url() ; ?>">
                          <li>
                            <div class="icos <?php echo osc_category_slug() ; ?>"></div>
                             
                             <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></li></a>                        
 
                         </a>
                          </ul>  
                          <?php } ?>
                          </div>

                          <strong><a id="clickme" href="javascript:toggleAndChangeText();" style="float:right; padding-right:10px; padding-top:20px;">Lihat semua kategori &#9660;</a></strong>

                  
                  <div class="empty"></div>

              
           


</div>
                   


<div class="maparea">

<h2 class="kir"><?php _e("Pilih Lokasi", 'modern');?>
<span class="arrdot"></span>
</h2>
<div class="clr"></div>
<div class="clr"></div>                   
<?php sample_map(); ?>
                    

<div class="empty"></div>

<h2 class="kir"><?php _e("Propinsi", 'modern');?>
<span class="arrdot"></span>
</h2>
<div class="horbar"></div>

                          <?php View::newInstance()->_exportVariableToView('list_regions', Search::newInstance()->listRegions('%%%%', '>=') ) ; ?>
                          <?php if(osc_count_list_regions() > 0 ) { ?>
                          <?php $tac= 0 ; while(osc_has_list_regions() && $tac < 9 ) { ?>  
                          <ul id="pilihprop-top" class="pilihprop">
                          <li ><a href="http://iklanbaris.bangsaonline.com/index.php?page=search&sRegion=<?php echo osc_list_region_name(); ?>"><?php echo osc_list_region_name() ; ?></a> </li>
                          </ul>  
                          <?php $tac++;} ?>
                          
                          <?php View::newInstance()->_erase('regions') ; ?>
                          
                          <div id="mes" class="location" style="display:none;">                       
                       
                          <?php $tac= 9 ; while(osc_has_list_regions() && $tac++ ) { ?>  
                          <ul id="pilihprop-top" class="pilihprop">
                          <li ><a href="http://iklanbaris.bangsaonline.com/index.php?page=search&sRegion=<?php echo osc_list_region_name(); ?>"><?php echo osc_list_region_name() ; ?></a> </li>
                          </ul>  
                          <?php } ?>
                          </div>

                          <strong><a id="clickmes" href="javascript:toggleAndChangeText();" style="float:right; padding-right:10px; padding-top:20px;">Lihat semua provinsi &#9660;</a></strong>



<?php } ?>

<div class="empty"></div>
  <a class="pasang-iklan-big kan" style="margin-right:120px;" href="<?php echo osc_item_post_url_in_category() ; ?>">Pasang Iklan Gratis</a>       
</div>







<div class="clr"></div>


        <?php osc_current_web_theme_path('footers.php') ; ?>

    </body>
</html>