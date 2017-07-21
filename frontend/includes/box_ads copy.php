<?php 

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );

$ads_from = (get_post_meta(get_the_id(), '_inherit_ads', TRUE ) ? get_post_meta(get_the_id(), '_inherit_ads', TRUE ) : get_the_id() );

$i=0; while($i < 6) { ?>

<div class="boxad fl" <?php if($i==5) { echo 'style="margin: 0px"'; } ?> >

	<?php if(get_post_meta($ads_from, '_boxad_'.$i, TRUE )) {  // box ad has manual override ?> 
	
	<script type='text/javascript'><!--//<![CDATA[
	   var m3_u = (location.protocol=='https:'?'https://www.pedelecs.co.uk/revive-adserver/www/delivery/ajs.php':'http://www.pedelecs.co.uk/revive-adserver/www/delivery/ajs.php');
	   var m3_r = Math.floor(Math.random()*99999999999);
	   if (!document.MAX_used) document.MAX_used = ',';
	   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
	   document.write ("?what=<?php echo (get_post_meta($ads_from, '_boxad_0', TRUE )); ?>");
	   document.write ('&amp;cb=' + m3_r);
	   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
	   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
	   document.write ("&amp;loc=" + escape(window.location));
	   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
	   if (document.context) document.write ("&context=" + escape(document.context));
	   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
	   document.write ("'><\/scr"+"ipt>");
	//]]>--></script><noscript><a href='http://www.pedelecs.co.uk/revive-adserver/www/delivery/ck.php?n=a25f2152&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.pedelecs.co.uk/revive-adserver/www/delivery/avw.php?what=999&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a25f2152' border='0' alt='' /></a></noscript>
	
	<?php } else { // default loading script ?>
	
		<script type='text/javascript'><!--// <![CDATA[
		OA_show('boxad_<?php echo $i; ?>');
		// ]]> --></script>
		
	<?php }?>

</div>
<?php $i++; } ?>


<div class="clear"></div>