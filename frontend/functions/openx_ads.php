<?php
function boxad_1_func( $atts, $content = null ) {

return '<script type="text/javascript"><!--//<![CDATA[
   var m3_u = (location.protocol=="https:"?"https://www.pedelecs.co.uk/adverts/www/delivery/ajs.php":"http://www.pedelecs.co.uk/adverts/www/delivery/ajs.php");
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ",";
   document.write ("<scr"+"ipt type="text/javascript" src=""+m3_u);
   document.write ("?zoneid=16");
   document.write ("&amp;cb=" + m3_r);
   if (document.MAX_used != ",") document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? "&amp;charset="+document.charset : (document.characterSet ? "&amp;charset="+document.characterSet : ""));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write (""><\/scr"+"ipt>");
//]]>--></script><noscript><a href="http://www.pedelecs.co.uk/adverts/www/delivery/ck.php?n=a0602499&amp;cb=INSERT_RANDOM_NUMBER_HERE" target="_blank"><img src="http://www.pedelecs.co.uk/adverts/www/delivery/avw.php?zoneid=16&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a0602499" border="0" alt="" /></a></noscript>';


}

add_shortcode( 'boxad_1', 'boxad_1_func' );

?>