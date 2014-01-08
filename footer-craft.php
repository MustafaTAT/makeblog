<?php
/**
 * The generic footer template for Craft posts.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
?>
				<div class="footer-ad" style="padding-top:30px;">
				
					<div class="" style="width:728px; margin:0 auto;">

						<!-- Beginning Sync AdSlot 4 for Ad unit header ### size: [[728,90]]  -->
						<div id='div-gpt-ad-664089004995786621-4'>
							<script type='text/javascript'>
								googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-4')});
							</script>
						</div>
						<!-- End AdSlot 4 -->
						
					</div>

				</div>
			
			</div>

		</div>

		<section id="footer" class="new-footer">
			<div class="container">
				<div class="row">
					<div class="span12 logo" >
						<img src="<?php bloginfo('stylesheet_directory'); ?>/img/craft-logo1.png" alt="MAKE">
						<a href="http://make-digital.com/" target="_blank"><div class="sprite sprite-digital-book-foot"></div></a>
						<h5><a href="http://make-digital.com/" target="_blank">Read Digital Edition</a></h5>
						<a href="http://www.makershed.com/" target="_blank"><div class="sprite sprite-makershed_footer1"></div></a> 
						<h5><a href="http://www.makershed.com/" target="_blank">Shop Maker Shed</a></h5>
					</div>
					<div class="clear"></div>
				</div>
				<div class="row">
					<div class="span3 trending">
						<h5>Trending Topics</h5>
						<?php echo wp_kses_post( stripslashes( make_get_cap_option( 'hot_topics' ) ) ); ?>
					<!-- END span trending -->
					</div>
					<div class="span3 newsletter">
						<h5>Get our Newsletters</h5>  
						<form action="http://makermedia.createsend.com/t/r/s/jrsydu/" method="post" id="subForm">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Sign up to receive exclusive content and offers.</label>
									<div class="controls">
										<label for="MAKENewsletter">
										<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter" /> MAKE Newsletter
										</label>
										<label for="MakerFaireNewsletter">
										<input type="checkbox" name="cm-ol-jjuruj" id="MakerFaireNewsletter" /> Maker Faire Newsletter
										</label>
										<label for="MakerShed-MasterList">
										<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList" /> Maker Shed
										</label> 
										<label for="MarketWireNewsletter">
										<input type="checkbox" name="cm-ol-jrsydu" id="MAKEMarketWirenewsletter" /> Maker Pro Newsletter
										</label> 
									<!-- END controls -->
									</div>
								<!-- control-group -->
								</div>
								<div class="input-append control-group email-area">
									<input class="span2" id="appendedInputButton" name="cm-jrsydu-jrsydu" id="jrsydu-jrsydu" type="text" placeholder="Enter your email">
									<button type="submit" class="btn" value="Subscribe">JOIN</button>
								<!-- control-group email-area -->
								</div>
							</fieldset>
						</form>
					<!-- END span newsletter -->
					</div>
					<div class="span3 about-us">
						<h5>About <a href="http://makermedia.com">Maker Media</a></h5>
						<div class="about-column-01">
							<ul>
								<li><a href="http://makezine.com/help/index.html">Help</a></li>
								<li><a href="http://makermedia.com/contact-us/">Contact</a></li>
								<li><a href="http://www.makezine.com/go/subscribe2make">Subscribe</a></li>
								<li><a href="http://makermedia.com/work-with-us/advertising/">Advertise</a></li> 
								<li><a href="http://makermedia.com/privacy/">Privacy</a></li>
							</ul>
						<!-- END span about-column-01 --></div>
						<div class="about-column-02">
							<ul>
								<li><a href="http://makermedia.com" target="_blank">About Us</a></li>
								<li><a href="http://makezine.com/faq/index.html">FAQ</a></li>
								<li><a href="http://makezine.com/forums/">Forums</a></li>
								<li><a href="http://makezine.com/contribute/">Write for MAKE</a></li>
							</ul>
						<!-- END span about-column-02 -->
						</div>
						<div class="clearfix"></div>
						<div class="soc_icons">
							<a class="sprite sprite-twitter"  href="http://twitter.com/make" title="Twitter" target="_blank"></a>
							<a class="sprite sprite-youtube" href="http://youtube.com/make" title="Youtube" target="_blank"></a>
							<a class="sprite sprite-pinterest" href="http://pinterest.com/makemagazine/" title="Pinterest" target="_blank"></a>
							<a class="sprite sprite-flickr" href="http://www.flickr.com/groups/make/" title="Flickr" target="_blank"></a>
							<a class="sprite sprite-facebook" href="http://facebook.com/makemagazine" title="Facebook" target="_blank"></a>
							<a class="sprite sprite-stumbleupon" href="http://www.stumbleupon.com/to/stumble/stumblethru:makezine.com?utm_source=Makezine&amp;utm_medium=StumbleThru&amp;utm_campaign=StumbleThruButton" title="Stumbleupon" target="_blank"></a>
							<a class="sprite sprite-instagram" href="http://www.instagram.com/makemagazine" title="Instagram" target="_blank"></a>
							<a class="sprite sprite-google-plus" href="https://google.com/+MAKE/" title="Google+" target="_blank"></a>
						<!-- END socialArea -->
						</div> 
					<!-- END span3 about-us -->
					</div>
					<div class="span3 subscribe">
						<a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M**NEWB">
							<img src="<?php bloginfo('stylesheet_directory'); ?>/img/footer-make-cover.jpg" alt="MAKE Magazine Cover" width="115" height="163" id="mag-cover">
						</a>
						<div class="sprite sprite-arrow-footer"></div>
						<h5>Subscribe<br /> to MAKE!</h5>
						<p class="p_footer">Get the print and digital versions when you subscribe</p>
						<hr />
					<!-- END span subscribe -->
					</div>
				<!-- END MAIN row (main) -->
				</div>
				<?php echo make_copyright_footer(); ?>	
			<!-- END container -->
			</div>
		<!-- END new-footer -->
		</section>
	
	</div>


		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script>jQuery(".entry-content:odd").addClass('odd');</script>

		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=216859768380573";
			fjs.parentNode.insertBefore(js, fjs);
			}
		(document, 'script', 'facebook-jssdk'));
		</script>

		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".scroll").click(function(event){
				//prevent the default action for the click event
				event.preventDefault();
		 
				//get the full url - like mysitecom/index.htm#home
				var full_url = this.href;
		 
				//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
				var parts = full_url.split("#");
				var trgt = parts[1];
		 
				//get the top offset of the target anchor
				var target_offset = jQuery("#"+trgt).offset();
				var target_top = target_offset.top;
		 
				//goto that anchor by setting the body scroll top to anchor top
				jQuery('html, body').animate({scrollTop:target_top - 30}, 1000);
			});
		});
		</script>

		<script type="text/javascript">
			setTimeout(function(){var a=document.createElement("script");
			var b=document.getElementsByTagName("script")[0];
			a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2533.js?"+Math.floor(new Date().getTime()/3600000);
			a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
		</script>


		<?php wp_footer(); ?>
	</body>
</html>
