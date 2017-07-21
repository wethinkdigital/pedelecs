<?php if(!is_page_template ( 'template-section-landing.php' )){
			include(TEMPLATEPATH.'/views/include-purplebar.php');
		} ?>

</div> <!-- close #sitewrapper-inner -->
</div> <!-- close #sitewrapper -->

<div class="clear"></div>

<div id="footer" class="shadowgrad-down" style="margin-top: -220px;">

	<div class="stage">
	
		<div id="newsletter_signup" class="fl palegrey">
		    <?php include(TEMPLATEPATH.'/views/block-front-footer-form.php'); ?>
		</div>
		
		<div id="advertise_cta" class="fr palegrey">
			<h5 class="purple">Want to advertise on Pedelecs?</h5>
			<p>In an expanding industry, Pedelecs offers advertisers a mix of returning & first time visitors looking to purchase their first electric bike. Grow your business here with our highly targeted readership.</p>
			<a href="/advertising"><input type="button" class="purplegrad fr" value="Find out more" /></a>
		</div>
		
		<div class="clear"></div>

		<div class="legal">
			<p>&copy; Copyright Pedelecs. <a href="https://www.ibecreative.co.uk/cambridge-web-design" title="Cambridge web design" target="_blank">Web design</a> by <a href="https://www.ibecreative.co.uk" title="Web design" target="_blank">IBE</a> <a href="/legal">Legal.</a></p>
		</div>

	</div>

</div>



<?php wp_footer(); ?>

	<script>
		$(function(){
			$('.newstiles').isotope({
			  	masonry: {
				  	itemSelector : '.newsitem',
				  	columnWidth: 323
			  	}
			});
		});
	</script>
	

	 	<script>
		$(window).load(function(){
			$('#newstiles').isotope({
			  	masonry: {
				  	itemSelector : '.newsitem'
			  	}
			});
		});
	</script>



 	<script>
		$(window).load(function(){
			$('#looptiles').isotope({
			  	masonry: {
				  	itemSelector : '.loopitem'
			  	}
			});
		});
	</script>

 	<script>
		$(window).load(function(){
			$('.masonry').isotope({
			  	masonry: {
				  	itemSelector : '.tile',
			  	}
			});
		});
	</script>
	
	<script>
		$(window).load(function(){
			$('#jargon').isotope({
			  	masonry: {
				  	itemSelector : '.jargon-item'
          		}
			});;
		});
	</script>


  	<!-- Cufon -->	
	<!--
<script type="text/javascript">
			Cufon.replace('h1, h2, h3, h4, h5, h6, .section-more, .compare_tab, #comparetable .header, ul.tabs, ul.brands');				
			Cufon.replace('nav#main', { ignore: {
				p: true
				}
			});
			Cufon.now();
	</script>
-->

	<script>
		jQuery(function(){
			jQuery('#features').PedelecsSlider();
			$('.masonry').masonry({
				itemSelector: '.tile',
				columnWidth: 475
			});
		});
	</script>
	
	<div class="clear"></div>
	
	<?php if($_GET['debug']) {
    	    $bike_stock = get_user_meta(25,'bike_stock');
    	    echo '<pre>'; print_r($bike_stock); echo '</pre>';
	    }
	   ?>

</body>
</html>