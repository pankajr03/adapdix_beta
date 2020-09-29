<?php
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
get_header(); 

 // $gs_member_breadcrumb = gs_team_getoption('gs_member_breadcrumb', 'gs_team_settings', 'on');
 // if ( 'on' ==  $gs_member_breadcrumb ) :
 // 	if (class_exists('breadcrumb')) $obj = new breadcrumb; $obj-> tj_breadcrumb();
 // endif;
?>

<div class="container gs-single-container">
	<div class="row clearfix gs_team" id="gs_team_single">

		<?php while ( have_posts() ) : the_post(); 

		$gs_team_id = get_post_thumbnail_id();
		$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
		$team_thumb = $gs_team_url[0];
		$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);

		$gs_tm_meta = get_post_meta( get_the_id() );
		$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
		$gs_social = get_post_meta( get_the_id(), 'gs_social', true);
		$gs_skill = get_post_meta(get_the_id(), 'gs_skill', true);
		$gs_address = get_post_meta( get_the_id(), '_gs_address', true );
		$gs_email = get_post_meta( get_the_id(), '_gs_email', true );
		$gs_land = get_post_meta( get_the_id(), '_gs_land', true );
		$gs_cell = get_post_meta( get_the_id(), '_gs_cell', true );
		$gs_company = get_post_meta( get_the_id(), '_gs_com', true );
		$terms_gender = get_the_terms( get_the_id(), 'team_gender' );
		$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');

		$gs_member_nxt_prev = gs_team_getoption('gs_member_nxt_prev', 'gs_team_settings', 'on');

		$gs_teamcom_meta = gs_team_getoption('gs_teamcom_meta', 'gs_team_level_settings', 'Company');
		$gs_teamadd_meta = gs_team_getoption('gs_teamadd_meta', 'gs_team_level_settings', 'Address');
		$gs_teamlandphone_meta = gs_team_getoption('gs_teamlandphone_meta', 'gs_team_level_settings', 'Land Phone');
		$gs_teamcellPhone_meta = gs_team_getoption('gs_teamcellPhone_meta', 'gs_team_level_settings', 'Cell Phone');
		$gs_teamemail_meta = gs_team_getoption('gs_teamemail_meta', 'gs_team_level_settings', 'Email');
		$gs_teamlocation_meta = gs_team_getoption('gs_teamlocation_meta', 'gs_team_level_settings', 'Location');
		$gs_teamlanguage_meta = gs_team_getoption('gs_teamlanguage_meta', 'gs_team_level_settings', 'Language');
		$gs_teamspecialty_meta = gs_team_getoption('gs_teamspecialty_meta', 'gs_team_level_settings', 'Specialty');
		$gs_teamgender_meta = gs_team_getoption('gs_teamgender_meta', 'gs_team_level_settings', 'Gender');
		
	?>
		<div itemscope="" itemtype="http://schema.org/Person"> <!-- Start sehema -->
		<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="gs_member_img">
			<?php if ( has_post_thumbnail() ) : ?>
	            <img src="<?php echo $team_thumb; ?>" alt="<?php echo $gs_team_alt; ?>" itemprop="image"/>
	       	<?php else : ?> 
		       		<img src="<?php echo GSTEAM_FILES_URI; ?>/assets/img/no_img.png" class=""/>
		    <?php endif; ?>
		    <div class="gstm-details">
		       <?php  if(!empty($gs_company)){ ?>
		        	<div class="gs-member-company"><span class="levels"><?php echo $gs_teamcom_meta; ?> </span> <span class="level-info-company">: <?php echo $gs_company; ?></span></div>
		        <?php } ?>

		       <?php  if(!empty($gs_address)){  ?>
		        	<div class="gs-member-address"><span class="levels"><?php echo $gs_teamadd_meta; ?></span> <span class="level-info-address"> : <?php echo $gs_address; ?></span></div>
		       <?php } ?>

		       <?php  if(!empty($gs_land)){ ?> 
		        	<div class="gs-member-lphon"><span class="levels"><?php echo $gs_teamlandphone_meta; ?></span> <span class="level-info-lphon"> : <?php echo $gs_land ;?></span></div>
		       <?php } ?>

		       <?php  if(!empty($gs_cell)){ ?>
		        	<div class="gs-member-cphon"><span class="levels"><?php echo $gs_teamcellPhone_meta; ?></span> <span class="level-info-cphon">: <?php echo $gs_cell; ?></span></div>
		       <?php } ?>

		       <?php  if(!empty($gs_email)){ ?>
		        	<div class="gs-member-email"><span class="levels"><?php echo $gs_teamemail_meta; ?></span> <span class="level-info-email">: <?php echo $gs_email; ?></span></div>
		        <?php } ?>

		        
		        <?php if(!empty( gsteam_location() )) { ?>
		        	<div class="gs-member-loc"><span class="levels"><?php echo $gs_teamlocation_meta; ?></span> <span class="level-info-loc"> : <?php echo gsteam_location(); ?></span></div>
		        <?php } ?>

		        <?php if(!empty( gsteam_language() ) ) {  ?>
		        	<div class="gs-member-lang"><span class="levels"><?php echo $gs_teamlanguage_meta; ?> </span> <span class="level-info-lang">: <?php echo gsteam_language(); ?></span></div>
		        <?php } ?>

		        <?php if(!empty( gsteam_specialty() ) ) {  ?>
		        	<div class="gs-member-specialty"><span class="levels"><?php echo $gs_teamspecialty_meta; ?></span> <span class="level-info-specialty"> : <?php echo gsteam_specialty(); ?></span></div>
		        <?php } ?>

		        <?php if(!empty( $terms_gender[0]->name ) ) { ?>
		          <div class="gs-member-gender"><span class="levels"><?php echo $gs_teamgender_meta; ?></span> <span class="level-info-gender"> : <?php echo $terms_gender[0]->name; ?></span></div>
		        <?php } ?>
	        </div>
	    </div>

		<div class="gs_member_details gs-tm-sicons">
			<h1 class="gs-sin-mem-name" itemprop="name"><?php the_title(); ?></h1>
			<div class="gs-sin-mem-desig" itemprop="jobtitle"><?php echo $designation; ?></div>

			<div itemscope itemtype="http://schema.org/Organization"> <!-- social links -->
	        	<ul class="gs-team-social">
	            	<?php 
	            	if(!empty($gs_social)){
	            		foreach ($gs_social as $key => $value) {

		            		if($value['icon']=='envelope'){
		            			$link=!empty($value['link']) ? 'mailto:'.$value['link'] :'#';
		            		} else{
		            			$link=!empty($value['link']) ? $value['link'] :'#';
		            		}
		            ?>
							<li><a class ="<?php echo $value['icon'] ?>"href="<?php echo $link ?>" target="<?php echo $gs_tm_link_tar ?>" itemprop="sameAs"><i class="fa fa-<?php echo $value['icon']?>"></i></a></li>
					<?php	} // end foreach
	            	} ?>  <!-- end if -->
	            </ul>
			</div> <!-- end social links -->
			<p class="gs-member-desc" itemprop="description"><?php the_content(); ?></p>
			
			<div class="member-skill">
				<?php
		        if(!empty($gs_skill)){
		        	foreach ($gs_skill as  $value) {
		        		if ( !empty( $value['percent'] ) ) {
		        			$gstm_percent = $value['percent']; ?>	
		        			
				        	<span class="progressText"><b><?php echo $value['skill'] ?></b></span>
				        	<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $gstm_percent ?>%;"></div>
					            <span class="progress-completed"><?php echo $gstm_percent ?>%</span>
					        </div>
			    	<?php } } } ?>
	        </div>
		</div>
		
		</div> <!-- end col -->
		</div> <!-- end sehema -->
	
		<?php endwhile; ?>

		<?php if ( 'on' ==  $gs_member_nxt_prev ) : ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="prev-next-navigation">
                    <?php previous_post_link( '<div class="previous">%link</div>', '%title' );  ?>
                    <?php next_post_link( '<div class="next">%link</div>', '%title' );  ?>
                </div>
            </div>
        <?php endif; ?>

	</div> <!-- end row -->
</div> <!-- end container -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>