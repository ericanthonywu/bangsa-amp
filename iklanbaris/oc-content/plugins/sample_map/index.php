<?php
/*
Plugin Name: Rollover Sample Map
Plugin URI: http://www.osclass.org/
Description: This Plugin displays a Rollover Sample Map.
Version: 1.0
Author: RajaSekar
Author URI: http://www.osclass.org/
Short Name: Rollover Sample Map
Plugin update URI: http://www.osclass.org/files/plugins
*/

function sample_map_menu() {
    echo '<h3><a href="#">Sample Map</a></h3>
    <ul>
        <li><a href="'.osc_admin_render_plugin_url("sample_map/help.php").'?section=types">&raquo; ' . __('F.A.Q. / Help', 'Aus Map') . '</a></li>
    </ul>';
}

function sample_map_head(){
echo '<script type="text/javascript" src="'.osc_base_url().'oc-content/plugins/sample_map/js/mapscript.js"></script>';
echo '<script>$(function() {
		$(".Map").maphilight();
	});</script>';
}
 function sample_map_configure() {
        osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/help.php') ;
    }

function sample_map(){
  echo '<img class="Map" src="'.osc_base_url().'oc-content/plugins/sample_map/images/map.jpeg" alt="Map" width="447" height="250" border="0" usemap="#Map">
<map name="Map">
 

<area shape="poly" coords="12,22,21,23,34,25,40,32,42,35,41,39,37,42,41,45,39,48,42,49,42,54,35,52,34,48,26,40,24,40,19,33,13,28" href="index.php?page=search&sRegion=Aceh DI" alt="DI Aceh" title="Aceh D.I." />
  <area shape="poly" coords="45,36,54,43,58,48,62,50,62,56,61,58,63,61,60,63,60,71,52,71,48,60,42,56,43,50,37,63,33,60,33,64,39,70,39,64,41,48,41,45,39,43" href="index.php?page=search&sRegion=Sumatera Utara" title="Sumatera Utara" value="sumut"/>
  <area shape="poly" coords="51,68,59,78,50,86,48,82,46,83,47,87,51,91,52,86,60,79,64,86,66,92,69,96,70,94,69,90,71,87,73,86,73,82,68,77,65,76,67,72,63,70" href="index.php?page=search&sRegion=Sumatera Barat" title="Sumatera Barat" value="sumbar" />
  <area shape="poly" coords="60,50,64,53,68,53,74,54,81,60,87,64,87,70,89,70,93,73,92,78,91,81,84,81,82,84,75,82,73,83,65,76,66,72,63,70,59,70,58,62,61,61,59,57" href="index.php?page=search&sRegion=Riau" title="Riau" value="riau"/>
  <area shape="poly" coords="94,68,97,76,98,86,102,86,104,67" href="index.php?page=search&sRegion=Kepulauan Riau" title="Kepulauan Riau" value="kepri" />
  <area shape="poly" coords="68,95,73,95,77,99,80,98,89,92,88,94,89,90,98,89,98,84,93,84,90,81,83,81,81,85,73,83,67,91" href="index.php?page=search&sRegion=Jambi" title="Jambi" value="jambi"/>
  <area shape="poly" coords="69,96,81,111,91,119,92,115,84,107,86,106,86,103,81,99,75,94" href="index.php?page=search&sRegion=bengkulu/" title="Bengkulu" value="bengkulu"/>
  <area shape="poly" coords="100,89,104,93,105,96,110,96,115,101,114,110,111,110,106,105,97,113,96,118,91,116,83,108,85,103,79,98,85,93,90,92,90,89" href="index.php?page=search&sRegion=Sumatera Selatan" title="Sumatera Selatan" value="sumsel"/>
  <area shape="poly" coords="109,94,114,96,122,105,123,103,133,103,133,105,139,106,139,101,133,100,132,103,124,103,124,100,119,95,116,90,112,90" href="index.php?page=search&sRegion=Bangka Belitung" title="Bangka Belitung" value="bangka-belitung"/>
  <area shape="poly" coords="89,123,101,133,102,130,105,131,107,131,108,130,111,131,113,130,113,114,109,113,105,108,96,115,94,120,91,119" href="index.php?page=search&sRegion=Lampung" title="Lampung" value="lampung"/>
  <area shape="poly" coords="106,139,118,142,120,138,122,132,118,130,116,134,111,134,110,137" href="index.php?page=search&sRegion=Banten"  title="Banten" value="banten" />
  <area shape="circle" coords="125,132,8" href="index.php?page=search&sRegion=Jakarta DKI"  title="DKI Jakarta" value="dki" />
  <area shape="poly" coords="89,161,86,149,124,129,128,134,108,162,116,161,116,177,35,179,30,177,30,161" href="index.php?page=search&sRegion=Jakarta DKI"  title="DKI Jakarta" value="dki" />
  <area shape="poly" coords="118,140,120,143,133,146,138,147,139,144,138,142,140,141,141,138,135,133,129,133,124,137,119,137" href="index.php?page=search&sRegion=Jawa Barat"  title="Jawa Barat" value="jabar" />
  <area shape="poly" coords="142,146,153,148,156,145,161,148,162,151,164,152,166,144,169,143,169,137,164,137,162,135,159,139,143,139,142,143" href="index.php?page=search&sRegion=Jawa Tengah"  title="Jawa Tengah" value="jateng" />
  <area shape="poly" coords="154,150,161,153,161,150,159,148,156,146" href="index.php?page=search&sRegion=Yogyakarta DI"  title="DI Yogyakarta" value="diy" />
  <area shape="poly" coords="166,152,186,153,196,156,195,153,195,147,182,145,180,142,190,141,192,139,177,139,176,137,169,137,168,143,164,145" href="index.php?page=search&sRegion=Jawa Timur"  title="Jawa Timur" value="jatim" />
  <area shape="poly" coords="195,153,199,155,202,158,204,155,206,153,202,150,195,150" href="index.php?page=search&sRegion=Bali"  title="Bali" value="bali" />
  <area shape="poly" coords="205,157,213,159,214,159,222,160,230,157,237,156,234,151,227,152,224,151,228,155,219,153,214,155,213,152,209,152,206,154" href="index.php?page=search&sRegion=Nusa Tenggara Barat"  title="Nusa Tenggara Barat" value="ntb"/>
  <area shape="poly" coords="236,163,242,167,248,172,254,170,246,163,247,158,256,159,267,158,273,154,278,154,278,155,281,154,283,153,284,155,285,155,285,153,289,153,289,154,295,154,294,151,288,151,287,153,282,153,278,151,277,154,273,154,274,150,270,154,267,156,265,153,261,155,252,151,243,154,247,158,243,163,238,163,290,161,283,165,281,172,274,176,276,177,282,172,288,170,295,165,291,162" href="index.php?page=search&sRegion=Nusa Tenggara Timur"  title="Nusa Tenggara Timur" value="ntt" />
  <area shape="poly" coords="191,61,196,61,208,33,222,33,228,39,224,40,225,43,230,51,230,56,238,65,231,67,226,72,226,77,220,86,214,91,217,96,216,99,208,94,206,88,206,83,203,80,205,75,200,75,199,68,190,70" href="index.php?page=search&sRegion=Kalimantan Timur"  title="Kalimantan Timur" value="kaltim" />
  <area shape="poly" coords="196,109,198,115,210,110,211,109,211,114,214,114,213,109,212,107,214,104,215,100,208,95,207,89,203,91,203,97,197,101" href="index.php?page=search&sRegion=Kalimantan Selatan"  title="Kalimantan Selatan" value="kalsel" />
  <area shape="poly" coords="161,102,169,102,170,107,181,105,187,105,188,107,195,107,196,99,199,98,202,95,202,89,206,88,205,83,202,79,204,75,199,75,198,68,185,69,185,77,175,80,170,81,163,87,165,97" href="index.php?page=search&sRegion=Kalimantan Tengah"  title="Kalimantan Tengah" value="kalteng" />
  <area shape="poly" coords="157,101,163,102,166,98,165,88,171,81,184,78,187,70,191,70,190,61,182,61,181,59,174,59,170,64,156,64,148,55,143,65,146,79,150,80,154,91,154,96" href="index.php?page=search&sRegion=Kalimantan Barat"  title="Kalimantan Barat" value="kalbar" />
  <area shape="poly" coords="241,105,246,105,246,99,250,100,248,94,248,87,246,83,242,94,239,97" href="index.php?page=search&sRegion=Sulawesi Barat"  title="Sulawesi Barat" value="sulbar" />
  <area shape="poly" coords="248,89,253,86,266,93,261,99,261,96,257,96,253,100,254,114,254,123,246,124,245,115,246,111,247,103" href="index.php?page=search&sRegion=Sulawesi Selatan"  title="Sulawesi Selatan" value="sulsel" />
  <area shape="poly" coords="259,100,258,104,263,110,264,116,266,122,269,121,268,117,271,116,271,121,275,125,278,121,278,113,279,110,276,110,271,106,272,101,265,94" href="index.php?page=search&sRegion=Sulawesi Tenggara"  title="Sulawesi Tenggara" value="sultengg" />
  <area shape="poly" coords="270,94,266,88,271,87,279,81,280,84,285,84,285,82,279,80,281,78,284,79,285,76,280,75,277,78,268,78,264,82,260,82,254,77,257,65,264,65,261,61,264,59,261,58,258,62,255,61,250,71,251,74,248,78,248,82,250,84,250,88,256,86" href="index.php?page=search&sRegion=Sulawesi Tengah"  title="Sulawesi Tengah" value="sulteng" />
  <area shape="poly" coords="262,64,265,67,279,67,275,62,266,60,262,59,262,63" href="index.php?page=search&sRegion=Gorontalo"  title="Gorontalo" value="gorontalo" />
  <area shape="poly" coords="273,60,277,66,290,67,299,57,299,54,314,30,316,32,315,26,314,26,313,31,301,51,298,53,289,60" href="index.php?page=search&sRegion=Sulawesi Utara"  title="Sulawesi Utara" value="sulut" />
  <area shape="poly" coords="291,91,310,89,320,86,320,87,326,86,326,84,323,84,328,78,330,79,326,73,326,66,334,68,329,63,333,60,333,56,332,45,329,46,329,50,332,50,333,55,330,56,326,58,325,52,326,49,319,58,322,62,322,70,324,72,325,77,320,74,319,77,323,80,317,85,311,88,299,87,291,86" href="index.php?page=search&sRegion=Maluku Utara"  title="Maluku Utara" value="malut" />
  <area shape="poly" coords="305,105,311,109,316,107,323,105,325,109,326,104,328,106,345,106,349,109,373,125,383,130,383,138,360,143,358,141,356,144,342,148,330,141,304,147,306,149,311,149,313,146,328,143,340,148,354,146,355,149,361,145,385,139,388,134,388,125,383,128,349,107,348,102,341,100,326,100,319,104,313,102,307,102" href="index.php?page=search&sRegion=Maluku"  title="Maluku" />
  <area shape="poly" coords="336,90,339,91,341,89,347,85,349,86,353,86,359,93,373,92,372,95,358,99,357,100,361,101,364,105,365,110,369,110,375,103,376,108,379,110,383,110,386,114,400,117,411,121,411,110,408,105,407,101,410,97,409,94,408,91,392,78,391,79,395,82,402,88,392,87,392,89,402,90,404,92,399,94,392,101,392,103,387,103,382,97,380,97,378,92,376,79,369,78,361,74,350,80,348,74,342,71,340,73,346,76,349,80,347,82,344,82,344,86" href="index.php?page=search&sRegion=Papua Barat"  title="Papua Barat" value="papua-barat" />
  <area shape="poly" coords="384,111,389,108,387,102,391,103,400,92,403,92,402,90,393,88,393,87,397,86,402,89,391,78,393,77,406,88,411,95,407,101,410,108,412,121,401,117,390,114" href="index.php?page=search&sRegion=Papua Barat"  title="Papua Barat" value="papua-tengah" />
  <area shape="poly" coords="412,123,417,123,421,136,420,138,424,141,421,142,413,150,424,151,427,149,434,149,444,158,443,96,438,93,431,93,413,85,408,88,411,94,407,100,411,109" href="index.php?page=search&sRegion=Papua Timur"  title="Papua Timur" value="papua-timur" /> 
 
</map>
';
}

osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'sample_map_configure');
// Admin menu
osc_add_hook('admin_menu', 'sample_map_menu');
// add javascript
osc_add_hook('header', 'sample_map_head') ;
?>