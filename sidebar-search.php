<?php
/**
 * The generic sidebar template
 *
 * We use this template for just about everything. 
 * // TODO: Consolidate the other files into this one using some conditionals.
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 */
?>
					
					<div class="span4 sidebar">

						<?php 

						$facets = WPCOM_elasticsearch()->get_search_facet_data();

						$current_filters = WPCOM_elasticsearch()->get_current_filters();

						var_dump( $current_filters );

						?>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
								</script>
							</div>
							<!-- End AdSlot 2 -->

						</div>

						<div class="new-dotw widget">

							<?php echo makershed_weekly_deal(); ?>

						</div>
						
						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 3 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-3'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
								</script>
							</div>
							<!-- End AdSlot 3 -->

						</div>

				</div>