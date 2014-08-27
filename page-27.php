<?php
  get_header();
  the_post();

  /* LOAD PAGE BUILDER ARRAY */
  $pagebuilder = gt3_get_theme_pagebuilder( get_the_ID() );
  $pf = get_post_format();
  if ( empty( $pf ) ) $pf = "text";
  $pfIcon = gt3_get_pf_icon( $pf );
  $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
  gt3_the_pb_custom_bg_and_color( $pagebuilder );
  $current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];
  $replace_title = array( '_', '-' );
?>

<div class="content_wrapper antibody_content_wrapper">
  <div id="dvLoading" class="antibody-load"><img src="<?php bloginfo( 'template_directory' );?>/img/loader.gif" /><br/><span>... Building Table ...</span></div>

  <?php if ( $pagebuilder['settings']['show_breadcrumb_area'] !== "no" && gt3_get_theme_option( "show_breadcrumb_area" ) !== "no" ) { ?>
      <div class="page_title_block">
          <div class="container">
              <h1 class="title"><?php the_title(); ?></h1>
              <?php gt3_the_breadcrumb(); ?>
          </div>
      </div>
  <?php } ?>
  <div class="container">
    <div class="content_block <?php echo $pagebuilder['settings']['layout-sidebars'] ?> row">
      <div class="fl-container <?php echo ( $pagebuilder['settings']['layout-sidebars'] == "right-sidebar" ) ? "span9" : "span12"; ?>">
        <div class="row-fluid">
          <div class="posts-block">
            <div class="contentarea">
              <?php
                echo '<div class="row-fluid"><div class="span12">';
                the_content( __( 'Read more!', 'theme_localization' ) );
                echo '</div><div class="clear"></div></div>';

                wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages', 'theme_localization' ) . ': </span>', 'after' => '</div>' ) );
              ?>
            </div>
          </div>
          <div class='shortcode_tabs'>
            <div class="row-fluid">
              <div class='span12 search_form_wrap'>
                <div class="all_heads_cont">      
                  <div class="shortcode_tab_item_title expand_yes " id="antibody-head-active" whatopen=""><a>Antibody Characteristics</a></div>            
                  <div class="shortcode_tab_item_title  inactive" id="antigen-head-inactive" whatopen=""><a>Antigen Characteristics</a></div>
                  
                </div>
              </div>
              <div class="row-fluid">
                <div class='search_form'>
                  <form id='ih_search_form' class='ih_search_form'>
                    <div class="span12">
                      <div class="span12 search-bar">
                        <span class="clearable"><input id='search_input' class='search_input_antibody' data-swplive="true" value='' type='text'  ><span class="icon_clear">X</span></span>
                        <div class="search-select search-select-antibody">
                          <select name="search_option" id="search_option" class="search-option-antibody">
                            <option value="comment"><span>General</span></option>                                  
                            <option value="isbt"><span>ISBT</span></option>
                            <option value="blood"><span>Blood Group</span></option>
                            <!--<option value="antigen" id="option-antigen"><span>Antigen</span></option>--> 
                            <option value="antibody" id="option-antibody"><span>Antibody</span></option> 
                          </select>
                          <!-- <ul class="search-option">
                            <li class="search-option-init" data-value="isbt">ISBT</li>
                            <li class="search-option-hidden" data-value="isbtno">ISBT No.</li>
                            <li class="search-option-hidden" data-value="blood">Blood Group</li>
                            <li class="search-option-hidden" data-value="antigen">Antigen</li> 
                            <li class="search-option-hidden" data-value="antibody">Antibody</li> 
                            <li class="search-option-hidden search-option-last" data-value="comment">Comment</li> 
                          </ul> -->
                        </div>
                        <a id='submit_search' class='search_submit_antibody icon-search' href="javascript:void(0)"><!--<i class="icon-search icon-3x"></i>--></a>
                        
                        <!--<h3><a id='advance_search' class='search_advance icon-serach adv-search-link-antibody' href="javascript:void(0)">Advanced Search <span>[+]</span></a></h3>-->
                     
                      </div>

                    </div>

                    <!--<div class="span12 advance-search-wrap">
                      <div id="adv-search" class='advance_search'>
                        <div class='antibody-adv-search span6'>                          
                          <div class="adv-search-col">
                            <div class="filter-block">                              
                              <h6>IMMUNOGLOBULIN CLASS:</h6>                              
                              <div class="filter-smallblock advance-block-left">
                                <span class="filter-subtitle">IgM</span>
                                <span class="select-wrap">
                                  <select name="igm" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                              <div class="filter-smallblock advance-block-left">
                                <span class="filter-subtitle">IgG</span>
                                <span class="select-wrap">
                                  <select name="igg" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                            </div>
                            <div class="filter-block advance-block-clear">                             
                              <h6>COMPLEMENT BINDING:</h6>
                              <div class="filter-smallblock advance-block-left">                                
                                <span class="select-wrap">
                                  <select name="complement_binding" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select> 
                                </span>                             
                              </div>
                            </div>
                            <div class="filter-block">                              
                              <h6>CLINICAL SIGNIFICANCE:</h6>                              
                              <div class="filter-smallblock advance-block-left">
                                <span class="filter-subtitle">HTR</span>
                                <span class="select-wrap">
                                  <select name="htr" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                              <div class="filter-smallblock advance-block-left">
                                <span class="filter-subtitle">HDFN</span>
                                <span class="select-wrap">
                                  <select name="hdfn" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="adv-search-col">
                            <div class="filter-block"> 
                              <h6>% COMPATIBLE (CAUCASIAN):</h6>
                              <div class="filter-smallblock">                                
                                <div id="caucasian_slider" class = "search-slider"></div>
                              </div>                         
                            </div>
                            <div class="filter-block">                              
                              <h6>SERLOGICAL CHARACTERISTICS:</h6>                              
                              <div class="filter-smallblock">
                                <span class="filter-subtitle">THERMAL RANGE (<sup>o</sup>C):</span>
                                <div id="thermal_slider" class = "search-slider"></div>
                              </div>
                              <div class="filter-smallblock advance-block-left">
                                <span class="filter-subtitle">SALINE</span>
                                <span class="select-wrap">
                                  <select name="saline" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                              <div class="filter-smallblock advance-block-left">
                                <span class="filter-subtitle">IAT</span>
                                <span class="select-wrap">
                                  <select name="iat" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                            </div>              
                            <div class="filter-block advance-block-clear">                                                            
                              <h6>SUITABLE ELUTION METHODS:</h6>
                              <div class="filter-smallblock advance-block-left">                                
                                <span class="select-wrap">
                                  <select name="elution" class="adv-search-select">
                                    <option value="">Unknown</option>
                                    <option value="Heat">Heat Lui Freeze-Thaw</option>
                                    <option value="Acid Glycine">Acid Glycine Organic Solvents Digitonin</option>
                                    <option value="no">No Published Data</option>
                                  </select>
                                </span>
                              </div>
                            </div>  
                          </div>                      
                        </div>
                        <div class="antigen-adv-search span6">                          
                          <div class="adv-search-col">
                            <div class="filter-block">
                              <h6>ANTIGEN DESTROYED BY PAPAIN:</h6>
                              <div class="filter-smallblock advance-block-left">                                
                                <span class="select-wrap">
                                  <select name="papain">
                                    <option value="">Unknown</option>
                                    <option value="Yes">Yes</option>
                                    <option value="no">No</option>                                    
                                  </select>
                                </span>
                              </div>
                            </div>
                            <div class="filter-block">
                              <h6>ANTIGEN STRUCTURE:</h6>
                              <div class="filter-smallblock advance-block-left">                                
                                <span class="select-wrap">
                                  <select name="structure">
                                    <option value="">Unknown</option>
                                    <option value="Carbohydrate">Carbohydrate</option>
                                    <option value="Glycoproteins">Glycoproteins</option>
                                    <option value="Glycophorin">Glycophorin</option>
                                    <option value="Protein">Protein</option>
                                  </select>
                                </span>
                              </div>
                            </div>
                            <div class="filter-block">
                              <h6>ANTIGEN PRESENCE ON CORD CELL:</h6>
                              <div class="filter-smallblock advance-block-left">                                
                                <span class="select-wrap">
                                  <select name="cord">
                                    <option value="">Unknown</option>
                                    <option value="yes">Yes</option>
                                    <option value="absent">No</option>
                                  </select>
                                </span>
                              </div>
                            </div>                           
                          </div>
                          <div class="adv-search-col">
                            <div class="filter-block">
                              <h6>RBC ANTIGEN FREQUENCY (%):</h6>
                              <div class="filter-smallblock">
                                <span class="filter-subtitle">ASIAN</span>
                                <div id="asian_slider" class = "search-slider"></div>
                              </div>
                              <div class="filter-smallblock">
                                <span class="filter-subtitle">CAUCASIAN</span>
                                <div id="antibody_caucasian_slider" class = "search-slider"></div>
                              </div>
                            </div>
                            <div class="filter-block">
                              <h6>ISBT ANTIGEN NO.(PER RBC)</h6>
                              <div class="filter-smallblock advance-block-left">                                
                                <span class="select-wrap">
                                  <select name="isbtno">
                                    <option value="">Unknown</option>
                                    <option value="Yes">Yes</option>
                                    <option value="no">No</option>                                   
                                  </select>
                                </span>
                              </div>
                            </div>
                          </div>                    
                      
                        </div>
                        <div class="span12 advance-search-button">
                          <a id='adv_submit_search' class='search_submit' href="javascript:void(0)">SUBMIT</a>
                          <a id='clear_search' class='search_submit' href="#">CLEAR</a>
                        </div>
                      </div>
                    </div>-->
                  </form>
                </div>
                <div class="result result-antibody">NO RESULT FOUND</div>
              </div>
            </div>
            <div id="space"></div>
            <div class='row-fluid'>
              <div class='span12 def_header antibody antibody-header'>
                <div class='header-container'>
                  <h1>ISBT SYMBOL</h1>
                  <div class='sub_def_header'>
                      <h3>(BLOOD GROUP SYSTEM NAME)
                          <SPAN>[No. OF ANTIGENS]</SPAN>
                      </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class='row-fluid element-container'>
              <div class='shortcode_tab_item_body'>
                        <!-- antibody root wrap -->
                        <div class='antibody_root_wrap root_wrap'>
                            <div class="column-width-isotope"></div>                            
                            <div class="grid_spacer"></div>
                            <?php
                              $antibody_cat_slug = 'antibody-root';
                              $antibody_cat = get_category_by_slug( $antibody_cat_slug );
                              $children_cat = get_categories( 'child_of='.$antibody_cat->cat_ID );
                              $children_cat = sort_cat_by_isbtno( $children_cat );
                              foreach ( $children_cat as $child_cat ) {

                                if ( function_exists( 'get_terms_meta' ) ) {
                                  $blood_grp_name = get_terms_meta( $child_cat->cat_ID, 'blood-group-name' );
                                  $blood_grp_isbtno = get_terms_meta( $child_cat->cat_ID, 'isbtno' );
                                  $antigen_count = get_terms_meta( $child_cat->cat_ID, 'antigen_count' );

                                }
                            ?>

                                <div id="<?php echo 'id-antibody-'.str_replace(' ','-',strtolower( $child_cat->name ));?>" class='antibody_outer_wrap grid_wrap'>
                                    <div class='antibody_info_wrap hero_info_wrap'>
                                        <div class='isbt_name isbtno isbt number' data-search='isbtno isbt number' data-value='<?php echo ltrim( $blood_grp_isbtno[0], '0' ) ;?> <?php echo $blood_grp_isbtno[0] ;?>'>
                                            <?php if (!empty($blood_grp_isbtno[0])) { ?>
                                            <div class='isbt_root'>
                                                ISBT No.<h4><?php echo $blood_grp_isbtno[0];?></h4>
                                            </div>
                                            <? } ?>
                                            <div class='blood_grp_hero_name blood group name' data-search='blood group name' data-value='<?php echo strtolower( $child_cat->name );?>'>
                                                <h1 ><?php echo $child_cat->name;?></h1>
                                                <div class='name_sub'>
                                                    <span class='blood_grp_full_name  blood group full name' data-search='blood group full name' data-value='<?php echo strtolower( $blood_grp_name[0] );?>'>
                                                        <?php echo $blood_grp_name[0];?></span>
                                                       <?php if (!empty($antigen_count[0])) { ?>
                                                        <span class='antigen_count'>[<?php echo $antigen_count[0];?>]</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="controls">
                                              <a class='full_expand icon-right-arrow' href="javascript:void(0)"><span class="hide-text">&rsaquo;</span></a>
                                              <a class='close_all icon-cross' href="javascript:void(0)"><!--<i class="icon-stack"></i>--><span class="hide-text">X</span></a>
                                            </div>
                                        </div>
                                        <div class='info_display_wrap'><div class='disp_name'></div><div class='disp_text'></div></div>
                                        
                                          <div class='sub_antibody_wrap sub_wrap'>
                                              <div class='grid_spacer_single_element'></div>
                                              <?php $args = array( 'category' => $child_cat->cat_ID, 'posts_per_page' => 30 );

                                                $myposts = get_posts( $args );

                                                $myposts = sort_antibody_posts_by_rank( $myposts );
                                              ?>
                                              <div class="row-fluid">
                                                <?php
                                                  foreach ( $myposts as $one_post ) {
                                                  $meta_group = get_group( 'post_2', 1, $one_post->ID );
                                                ?>
                                             
                                                <div id="<?php echo sanitize_title( $one_post->post_title );?>"  class='singleElement float-right antibody_wrap post_<?php echo $one_post->ID;?> <?php echo strtolower( str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) ) );?>' data-search='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>' data-value='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>

                                                  <a href="<?php echo '#id-antibody-'.str_replace(' ','-',strtolower( $child_cat->name ));?>"><div class='blood_group_name' data-value='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>
                                                    <span><?php echo $meta_group['antibody_antibody_name'][1];?></span><strong class="hide-text">&rsaquo;</strong><i class="icon-right-arrow arrow-red"></i></div></a>
                                                  <div class='blood_group_attr'>
                                                    <div class='immuno_class_wrap'>
                                                      <div class='desc_title'>IMMUNOGLOBULIN CLASS:</div>
                                                      <div class='desc_text'>
                                                          <ul>
                                                            <li><span class='immunoglobulin igm' data-search='immunoglobulin igm' data-value='<?php echo $meta_group['antibody_igm'][1];?>'>IgM: <?php echo $meta_group['antibody_igm'][1];?></span></li>
                                                            <li><span class='immunoglobulin igg' data-search='immunoglobulin igg' data-value='<?php echo $meta_group['antibody_igg'][1];?>'>IgG: <?php echo $meta_group['antibody_igg'][1];?></span></li>
                                                          </ul>
                                                          
                                                          
                                                      </div>
                                                  </div>
                                                  <div class='complement_binding' data-search='complement_binding' data-value='<?php echo $meta_group['antibody_complement_binding'][1];?>'><span class='desc_title'>Complement Binding:</span>
                                                  </div>
                                                  <div class="desc_text"> 
                                                    <ul>
                                                      <li>
                                                        <span class=''><?php echo $meta_group['antibody_complement_binding'][1];?></span>
                                                      </li>
                                                    </ul>
                                                  </div>

                                                  <div class='clinical_significance_wrap'>
                                                      <div class='clinical_title desc_title'>CLINICAL SIGNIFICANCE:</div>
                                                      <div class='clinical_text desc_text'>
                                                          <ul>
                                                            <li>
                                                              <div class='htr' data-search='htr' data-value='<?php echo $meta_group['antibody_htr'][1];?>'>HTR: <?php echo $meta_group['antibody_htr'][1];?></div>
                                                            </li>
                                                            <li>
                                                              <div class='hdfn' data-search='hdfn' data-value='<?php echo $meta_group['antibody_hdfn'][1];?>'>HDFN: <?php echo $meta_group['antibody_hdfn'][1];?></div>
                                                            </li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  <div class='antibody_compati compatible caucasian' data-search='compatible caucasian' data-value='<?php echo $meta_group['antibody_caucasian'][1];?>'>
                                                    <span class='desc_title'>% COMPATIBLE (CAUCASIAN):</span>
                                                  </div>
                                                  <div class="desc_text">
                                                    <ul>
                                                      <?php if (!is_numeric(substr($meta_group['antibody_caucasian'][1],1))) { ?>
                                                            <li>
                                                              <span class=''><?php echo $meta_group['antibody_caucasian'][1];?></span>
                                                            </li>
                                                            <?php } else { ?>
                                                            <li>
                                                              <span class=''><?php echo $meta_group['antibody_caucasian'][1];?>%</span>
                                                            </li>
                                                            <?php } ?>
                                                    </ul>
                                                  </div>

                                                  <div class='sero_wrap'>
                                                      <div class='sero_title desc_title'>SEROLOGICAL CHARACTERISTICS:</div>
                                                      <div class='sero_text desc_text'>
                                                        <ul>
                                                          <?php if ( (!is_numeric($meta_group['antibody_thermal_range_min'][1])) || (!is_numeric($meta_group['antibody_thermal_range_max'][1]) ) ) { ?>
                                                          <li>
                                                            <div class='thermal twoTemp temperature degree degrees min max minimum maximum' >
                                                              <span class=''>THERMAL RANGE: No Published Data</span>                         
                                                            </div>
                                                          </li>
                                                          <?php } elseif ( $meta_group['antibody_thermal_range_min'][1] != $meta_group['antibody_thermal_range_max'][1] ) {?>
                                                          <li>
                                                            <div class='thermal twoTemp temperature degree degrees min max minimum maximum' data-search='thermal temperature degree degrees min max minimum maximum' data-value='<?php echo $meta_group['antibody_thermal_range_min'][1];?> <?php echo $meta_group['antibody_thermal_range_max'][1];?>' data-tempRangeMin='<?php echo $meta_group['antibody_thermal_range_min'][1];?>' data-tempRangeMax='<?php echo $meta_group['antibody_thermal_range_max'][1];?>'>
                                                              <span class=''>THERMAL RANGE: </span>
                                                              <span class=''>
                                                                  <?php echo $meta_group['antibody_thermal_range_min'][1];?> - <?php echo $meta_group['antibody_thermal_range_max'][1];?><sup>o</sup>C
                                                              </span>
                                                            </div>
                                                          </li>
                                                          <?php }else {?>
                                                          <li>
                                                            <div class='thermal oneTemp temperature degree degrees min max minimum maximum' data-search='thermal temperature degree degrees min max minimum maximum' data-value='<?php echo $meta_group['antibody_thermal_range_max'][1];?>' data-tempRange='<?php echo $meta_group['antibody_thermal_range_max'][1];?>'>
                                                              <span class=''>THERMAL RANGE </span>
                                                              <span class=''><?php echo $meta_group['antibody_thermal_range_max'][1];?><sup>o</sup>C</span>
                                                            </div>
                                                          </li>
                                                          <?php }?>
                                                          <li>
                                                            <div class='saline' data-search='saline' data-value='<?php echo $meta_group['antibody_saline'][1];?>'><span class=''>SALINE: </span><span class=''><?php echo $meta_group['antibody_saline'][1];?></span></div>
                                                          </li>
                                                          <li>
                                                            <div class='iat' data-search='iat' data-value='<?php echo $meta_group['antibody_iat'][1];?>'><span class=''>IAT: </span><span class=''><?php echo $meta_group['antibody_iat'][1];?></span></div>
                                                          </li>
                                                        </ul>
                                                      </div>
                                                  </div>

                                                  <div class='elution methods method' data-search='elution methods method' data-value='<?php echo $meta_group['antibody_suitable_elution_methods'][1];?>'><span class='desc_title'>SUITABLE ELUTION METHODS: </span>
                                                  </div>
                                                  <div class='desc_text'>
                                                    <ul>
                                                      <li>
                                                        <?php echo $meta_group['antibody_suitable_elution_methods'][1];?>
                                                      </li>
                                                    </ul>
                                                  </div>
                                                  
                                                  <div class='anti_comment_wrap comment antibody-comment'>
                                                      <div class='desc_title'>
                                                          Antibody Comments <!--<span class="comment-symbol">[+]</span>-->
                                                      </div>
                                                      <div class='desc_text search comment-content' data-value="<?php echo $meta_group['antibody_comments'][1];?>">
                                                          <?php echo $meta_group['antibody_comments'][1];?>
                                                      </div>

                                                  </div>
                                                </div>
                                              </div>
                                              <?php }?>
                                          </div>
                                       
                                    </div>
                                </div>
                                <!-- outer wrap end -->
                                <?php } ?>
                            </div>
                            <!-- antibody root wrap end -->
                            <div class='clear'></div>
                            <div class="row-fluid">
                              <div class='def_header antibody antibody-other antibody-other-header'>
                                  <div class='header-container'>
                                    <h1>OTHER BLOOD GROUP SERIES, COLLECTIONS AND ASSOCIATED ANTIGENS</h1>
                                    <div class='sub_def_header'>
                                        <h3>(BLOOD GROUP SYSTEM NAME)
                                            <SPAN>[No. OF ANTIGENS]</SPAN>
                                        </h3>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="clear"><!-- ClearFix --></div>
                            <!-- antibody other root wrap  start -->
                            <div class="row-fluid">
                              <div class='antibody_other_root_wrap root_wrap'>
                                  <div class="column-width-isotope"></div>
                                  <div class="grid_spacer grid_spacer_outer"></div>
                                  <?php
                                    $antigen_cat_slug = 'antibody-other';
                                    $antigen_cat = get_category_by_slug( $antigen_cat_slug );
                                    $children_cat = get_categories( 'child_of='.$antigen_cat->cat_ID );
                                    $children_cat = sort_other_cat_by_rank( $children_cat );
                                    foreach ( $children_cat as $child_cat ) {

                                      if ( function_exists( 'get_terms_meta' ) ) {
                                        $blood_grp_name = get_terms_meta( $child_cat->cat_ID, 'blood-group-name' );
                                        $blood_grp_isbtno = get_terms_meta( $child_cat->cat_ID, 'isbtno' );
                                        $antigen_count = get_terms_meta( $child_cat->cat_ID, 'antigen_count' );
                                        $curr_rank = get_terms_meta($child_cat->cat_ID, 'other-group-series-rank');
                                      }

                                  ?>

                                      <div id="<?php echo 'id-antibody-other-'.str_replace(' ','-',strtolower( $child_cat->name ));?>" class='antibody_other_outer_wrap grid_wrap'>
                                          <div class='antibody_info_wrap hero_info_wrap'>
                                              <div class='isbt_name isbtno isbt number' data-search='isbtno isbt number' data-value='<?php echo $blood_grp_isbtno[0];?>'>
                                                  <span class="rank"><?php printf('%04d',$curr_rank[0]) ?></span>
                                                  <?php if (!empty($blood_grp_isbtno[0])) { ?>
                                                      <div class='isbt_root' data-searchable='yes' data-isbt='<?php echo $blood_grp_isbtno[0];?>'>
                                                        ISBT No.<h4><?php echo $blood_grp_isbtno[0];?></h4>
                                                      </div>
                                                  <? }  ?>
                                                      
                                                  <div class='blood_grp_hero_name blood group name' data-search='blood group name' data-value='<?php echo strtolower( $child_cat->name );?>'>
                                                      <h1 ><?php echo $child_cat->name;?></h1>
                                                      <div class='name_sub'>
                                                          <span class='blood_grp_full_name blood group full name' data-search='blood group full name' data-value='<?php echo strtolower( $blood_grp_name[0] );?>'>
                                                              <?php echo $blood_grp_name[0];?></span>
                                                              
                                                               <?php if (!empty($antigen_count[0])) { ?> 
                                                                <span class='antigen_count'>[<?php echo $antigen_count[0];?>]</span>
                                                              <? } ?>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="controls">
                                                    <a class='full_expand icon-right-arrow' href="javascript:void(0)"><span class="hide-text">&rsaquo;</span></a>
                                                    <a class='close_all icon-cross' href="javascript:void(0)"><span class="hide-text">X</span></a>
                                                  </div>
                                              </div>
                                              <div class='info_display_wrap'><div class='disp_name'></div><div class='disp_text'></div></div>
                                              
                                                <div class='sub_antibody_wrap sub_wrap'>
                                                    <div class='grid_spacer_single_element'></div>
                                                    <?php $args = array( 'category' => $child_cat->cat_ID, 'posts_per_page' => 30 );

                                                      $myposts = get_posts( $args );

                                                      $myposts = sort_antibody_posts_by_rank( $myposts );

                                                      foreach ( $myposts as $one_post ) {
                                                        $meta_group = get_group( 'post_2', 1, $one_post->ID );

                                                    ?>

                                                     <div id="<?php echo sanitize_title( $one_post->post_title );?>"  class='singleElement antibody_wrap post_<?php echo $one_post->ID;?> <?php echo strtolower( str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) ) );?>' data-search='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>' data-value='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>

                                                        <a href="<?php echo '#id-antibody-other-'.str_replace(' ','-',strtolower( $child_cat->name ));?>"><div class='blood_group_name' data-value='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>
                                                          <span><?php echo $meta_group['antibody_antibody_name'][1];?></span><strong class="hide-text">&rsaquo;</strong><i class="icon-right-arrow arrow-red"></i></div></a>
                                                        <div class='blood_group_attr'>
                                                          <div class='immuno_class_wrap'>
                                                            <div class='desc_title'>Immunoglobulin Class:</div>
                                                            <div class='desc_text'>
                                                                <!--<div class='immunoglobulin igm' data-search='immunoglobulin igm' data-value='<?php echo $meta_group['antibody_igm'][1];?>'>IgM</span><span class='desc_text'><?php echo $meta_group['antibody_igm'][1];?></span></div>
                                                                <div class='immunoglobulin igg' data-search='immunoglobulin igg' data-value='<?php echo $meta_group['antibody_igg'][1];?>'><span class='desc_title'>IgG</span><span class='desc_text'><?php echo $meta_group['antibody_igg'][1];?></span></div>-->
                                                                <ul>
                                                                  <li><span class='immunoglobulin igm' data-search='immunoglobulin igm' data-value='<?php echo $meta_group['antibody_igm'][1];?>'>IgM: <?php echo $meta_group['antibody_igm'][1];?></span></li>
                                                                  <li><span class='immunoglobulin igg' data-search='immunoglobulin igg' data-value='<?php echo $meta_group['antibody_igg'][1];?>'>IgG: <?php echo $meta_group['antibody_igg'][1];?></span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class='complement_binding' data-search='complement_binding' data-value='<?php echo $meta_group['antibody_complement_binding'][1];?>'><span class='desc_title'>Complement Binding:</span><!--<span class='desc_text'><?php echo $meta_group['antibody_complement_binding'][1];?></span>-->
                                                        </div>
                                                        <div class="desc_text"> 
                                                          <ul>
                                                            <li>
                                                              <span class=''><?php echo $meta_group['antibody_complement_binding'][1];?></span>
                                                            </li>
                                                          </ul>
                                                        </div>

                                                        <div class='clinical_significance_wrap'>
                                                            <div class='clinical_title desc_title'>Clinical Significance:</div>
                                                            <div class='clinical_text desc_text'>
                                                                <!--<div class='htr' data-search='htr' data-value='<?php echo $meta_group['antibody_htr'][1];?>'><span class='desc_title'>HTR</span><span class='desc_text'><?php echo $meta_group['antibody_htr'][1];?></span></div>
                                                                <div class='hdfn' data-search='hdfn' data-value='<?php echo $meta_group['antibody_hdfn'][1];?>'><span class='desc_title'>HDFN</span><span class='desc_text'><?php echo $meta_group['antibody_hdfn'][1];?></span></div>-->
                                                                <ul>
                                                                  <li>
                                                                    <div class='htr' data-search='htr' data-value='<?php echo $meta_group['antibody_htr'][1];?>'>HTR: <?php echo $meta_group['antibody_htr'][1];?></div>
                                                                  </li>
                                                                  <li>
                                                                    <div class='hdfn' data-search='hdfn' data-value='<?php echo $meta_group['antibody_hdfn'][1];?>'>HDFN: <?php echo $meta_group['antibody_hdfn'][1];?></div>
                                                                  </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class='antibody_compati compatible caucasian' data-search='compatible caucasian' data-value='<?php echo $meta_group['antibody_caucasian'][1];?>'><span class='desc_title'>% Compatible (Caucasian):</span><!--<span class='desc_text'><?php echo $meta_group['antibody_caucasian'][1];?>%</span>-->
                                                        </div>
                                                        <div class="desc_text">
                                                          <ul>
                                                            <?php if (!is_numeric($meta_group['antibody_caucasian'][1])) { ?>
                                                            <li>
                                                              <span><?php echo $meta_group['antibody_caucasian'][1];?></span>
                                                            </li>
                                                            <?php } else { ?>
                                                            <li>
                                                              <span class=''><?php echo $meta_group['antibody_caucasian'][1];?>%</span>
                                                            </li>
                                                            <?php } ?>
                                                          </ul>
                                                        </div>
                                                        <div class='sero_wrap'>
                                                            <div class='sero_title desc_title'>Serological Characteristics:</div>
                                                            <!--<div class='sero_text'>
                                                                <?php if ( $meta_group['antibody_thermal_range_min'][1] != $meta_group['antibody_thermal_range_max'][1] ) {?>
                                                                    <div class='thermal twoTemp temperature degree degrees min max minimum maximum' data-search='thermal temperature degree degrees min max minimum maximum' data-value='<?php echo $meta_group['antibody_thermal_range_min'][1];?> <?php echo $meta_group['antibody_thermal_range_max'][1];?>' data-tempRangeMin='<?php echo $meta_group['antibody_thermal_range_min'][1];?>' data-tempRangeMax='<?php echo $meta_group['antibody_thermal_range_max'][1];?>'><span class='desc_title'>Thermal Range</span><span class='desc_text'><?php echo $meta_group['antibody_thermal_range_min'][1];?> - <?php echo $meta_group['antibody_thermal_range_max'][1];?><sup>0</sup>C</span></div>
                                                                <?php }else {?>
                                                                    <div class='thermal oneTemp temperature degree degrees min max minimum maximum' data-search='thermal temperature degree degrees min max minimum maximum' data-value='<?php echo $meta_group['antibody_thermal_range_max'][1];?>' data-tempRange='<?php echo $meta_group['antibody_thermal_range_max'][1];?>'><span class='desc_title'>Thermal Range</span><span class='desc_text'><?php echo $meta_group['antibody_thermal_range_max'][1];?><sup>o</sup>C</span></div>
                                                                <?php }?>

                                                                <div class='saline' data-search='saline' data-value='<?php echo $meta_group['antibody_saline'][1];?>'><span class='desc_title'>Saline</span><span class='desc_text'><?php echo $meta_group['antibody_saline'][1];?></span></div>
                                                                <div class='iat' data-search='iat' data-value='<?php echo $meta_group['antibody_iat'][1];?>'><span class='desc_title'>IAT</span><span class='desc_text'><?php echo $meta_group['antibody_iat'][1];?></span></div>
                                                            </div>-->
                                                            <div class='sero_text desc_text'>
                                                              <ul>
                                                                <?php if ( (!is_numeric($meta_group['antibody_thermal_range_min'][1])) || (!is_numeric($meta_group['antibody_thermal_range_max'][1]) ) ) { ?>
                                                                <li>
                                                                  <div class='thermal twoTemp temperature degree degrees min max minimum maximum' >
                                                                    <span class=''>THERMAL RANGE: No Published Data</span>                         
                                                                  </div>
                                                                </li>
                                                                <?php } elseif ( $meta_group['antibody_thermal_range_min'][1] != $meta_group['antibody_thermal_range_max'][1] ) {?>
                                                                <li>
                                                                  <div class='thermal twoTemp temperature degree degrees min max minimum maximum' data-search='thermal temperature degree degrees min max minimum maximum' data-value='<?php echo $meta_group['antibody_thermal_range_min'][1];?> <?php echo $meta_group['antibody_thermal_range_max'][1];?>' data-tempRangeMin='<?php echo $meta_group['antibody_thermal_range_min'][1];?>' data-tempRangeMax='<?php echo $meta_group['antibody_thermal_range_max'][1];?>'>
                                                                    <span class=''>THERMAL RANGE: </span>
                                                                    <span class=''><?php echo $meta_group['antibody_thermal_range_min'][1];?> - <?php echo $meta_group['antibody_thermal_range_max'][1];?><sup>o</sup>C</span>
                                                                  </div>
                                                                </li>
                                                                <?php }else {?>
                                                                <li>
                                                                  <div class='thermal oneTemp temperature degree degrees min max minimum maximum' data-search='thermal temperature degree degrees min max minimum maximum' data-value='<?php echo $meta_group['antibody_thermal_range_max'][1];?>' data-tempRange='<?php echo $meta_group['antibody_thermal_range_max'][1];?>'>
                                                                    <span class=''>THERMAL RANGE: </span>
                                                                    <span class=''><?php echo $meta_group['antibody_thermal_range_max'][1];?><sup>o</sup>C</span>
                                                                  </div>
                                                                </li>
                                                                <?php }?>
                                                                <li>
                                                                  <div class='saline' data-search='saline' data-value='<?php echo $meta_group['antibody_saline'][1];?>'><span class=''>SALINE: </span><span class=''><?php echo $meta_group['antibody_saline'][1];?></span></div>
                                                                </li>
                                                                <li>
                                                                  <div class='iat' data-search='iat' data-value='<?php echo $meta_group['antibody_iat'][1];?>'><span class=''>IAT: </span><span class=''><?php echo $meta_group['antibody_iat'][1];?></span></div>
                                                                </li>
                                                              </ul>
                                                            </div>
                                                        </div>

                                                        <div class='elution methods' data-search='elution methods' data-value='<?php echo $meta_group['antibody_suitable_elution_methods'][1];?>'><span class='desc_title'>Suitable Elution Methods:</span><!--<span class='desc_text'><?php echo $meta_group['antibody_suitable_elution_methods'][1];?></span>-->
                                                        </div>
                                                        <div class='desc_text'>
                                                          <ul>
                                                            <li>
                                                              <?php echo $meta_group['antibody_suitable_elution_methods'][1];?>
                                                            </li>
                                                          </ul>
                                                        </div>

                                                        <div class='anti_comment_wrap comment antibody-comment'>
                                                            <div class='desc_title comment'>
                                                                Antibody Comments <!--<span class="comment-symbol">[+]</span>-->
                                                            </div>
                                                            <div class='desc_text search comment-content' data-value="<?php echo $meta_group['antibody_comments'][1];?>">
                                                               <?php echo $meta_group['antibody_comments'][1];?>
                                                           </div>

                                                       </div>
                                                   </div>
                                                </div>
                                             
                                             <?php }?>
                                         </div>
                                     </div>

                                     <?php } ?>

                                 </div>
                              </div>
                            </div>
                            <!-- antibody other root wrap close -->

                    <div class="clear"><!-- ClearFix --></div>
          <div class='shortcode_tab_item_body'>
                <!-- antigen root wrap -->
                <div class='antigen_root_wrap root_wrap'>
                  <div class="column-width-isotope"></div>
                  <div class="grid_spacer"></div>
                  <?php
                    $antigen_cat_slug = 'antigen-root';
                    $antigen_cat = get_category_by_slug( $antigen_cat_slug );
                    $children_cat = get_categories( 'child_of='.$antigen_cat->cat_ID );
                    $children_cat = sort_cat_by_isbtno( $children_cat );
                    foreach ( $children_cat as $child_cat ) {

                      if ( function_exists( 'get_terms_meta' ) ) {
                        $blood_grp_name = get_terms_meta( $child_cat->cat_ID, 'blood-group-name' );
                        $blood_grp_isbtno = get_terms_meta( $child_cat->cat_ID, 'isbtno' );
                        $antigen_count = get_terms_meta( $child_cat->cat_ID, 'antigen_count' );
                      }
                  ?>
                  <div id="<?php echo 'id-antigen-'.str_replace(' ','-',strtolower( $child_cat->name ));?>" class='antigen_outer_wrap grid_wrap'>
                    <div class='antigen_info_wrap hero_info_wrap'>
                      <div class='isbtno isbt number' data-search='isbtno isbt number' data-value='<?php echo strtolower( ltrim( $blood_grp_isbtno[0], '0' ) );?> <?php echo strtolower( $blood_grp_isbtno[0] );?>'>
                        <div class='isbt_root'>
                          <span>ISBT No.</span><h4><?php echo $blood_grp_isbtno[0];?></h4>
                        </div>
                        <div class='blood_grp_hero_name blood group name' data-search='blood group name' data-value='<?php echo strtolower( $child_cat->name );?>'>
                          <h1 ><?php echo $child_cat->name;?></h1>
                          <div class='name_sub'>
                            <span class='blood_grp_full_name blood group full name' data-search='blood group full name' data-value='<?php echo strtolower( $blood_grp_name[0] );?>'>
                              <?php echo $blood_grp_name[0];?></span>
                              <?php if (!empty($antigen_count[0])) { ?>
                                <span class='antigen_count'>[<?php echo $antigen_count[0];?>]</span>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="controls">
                        <a class='full_expand icon-right-arrow' href="javascript:void(0)"><span class="hide-text">&rsaquo;</span></a>
                        <a class='close_all icon-cross' href="javascript:void(0)"><span class="hide-text">X</span></a>
                      </div>
                      <!--<a class='full_expand' href="javascript:void(0)">EXP</a>
                      <a class='close_all' href="javascript:void(0)">X</a>-->
                    </div>
                    <div class='info_display_wrap'>
                      <div class='disp_name'></div>
                      <div class='disp_text'></div>
                    </div>
                    <div class='sub_antigen_wrap sub_wrap'>
                      <div class='grid_spacer_single_element'></div>
                      <?php $args = array( 'category' => $child_cat->cat_ID, 'posts_per_page' => 30 );
                        $myposts = get_posts( $args );
                        $myposts = sort_antigen_posts_by_isbtno( $myposts );
                        foreach ( $myposts as $one_post ) {
                          $meta_group = get_group( 'post_1', 1, $one_post->ID );
                      ?>
                      <div id="<?php echo sanitize_title( $one_post->post_title );?>"  class='singleElement antigen_wrap post_<?php echo $one_post->ID;?> <?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>' data-value='antigen <?php echo str_replace( '-', ' ', sanitize_title( $one_post->post_title ) );?>' data-search='antigen <?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>
                        <a href="<?php echo '#id-antigen-'.str_replace(' ','-',strtolower( $child_cat->name ));?>"><div class='blood_group_name' data-value='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>
                          <span><?php echo $meta_group['antigen_meta_antigen_name'][1];?></span><strong class="hide-text">&rsaquo;</strong><i class="icon-right-arrow arrow-green"></i></div></a>
                        <div class='blood_group_attr'>
                          <div class='isbtno isbt_antigen_no number' data-search='isbtno isbt_antigen_no number' data-value='<?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?>'><span class='desc_title'>ISBT NO.</span><!--<span class='desc_text'><?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?></span>-->
                          </div>
                          <div class="desc_text">
                            <ul>
                              <li><?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?></li>
                            </ul>
                          </div>
                            <div class='rbc_freq_wrap'>
                              <div class='rbc_freq_title desc_title'>RBC Antigen Frequency (%)</div>
                              <div class='rbc_freq_text desc_text'>
                                <ul>
                                  <li><div class='antigen_caucasian caucasian rbc frequency' data-search='caucasian rbc frequency' data-value='<?php echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1];?>'>CAUCASIAN: <?php if ((strcspn($meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1],'0123456789')) != (strlen($meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1]))) {echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1].'%';} else { echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1];} ?></div></li>
                                  <li>
                                    <div class='asian rbc frequency' data-search='asian rbc frequency' data-value='<?php echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1];?>'>ASIAN: <?php if ((strcspn($meta_group['antigen_meta_asian_rbc_antigen_frequency'][1], '0123456789')) != (strlen($meta_group['antigen_meta_asian_rbc_antigen_frequency'][1]))) { echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1].'%'; } else { echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1]; } ?></div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <div class='adult_site_wrap'>
                            <div class='adult_site_title Adult Antigen Site No desc_title' data-search='adult antigen site no number' data-value='<?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?>'>
                              Adult Antigen Site No. (per RBC)
                            </div>
                            <div class='adult_site_text desc_text'>
                              <ul>
                                <li><span data-value='<?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?>'><?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?></span></li>
                              </ul>
                            </div>
                          </div>
                          <div class='anti_cord_wrap presence cord cells' data-search='presence cord cells' data-value='<?php echo $meta_group['antigen_meta_antigen_presence_on_cord_cells'][1];?>'>
                            <div class='anti_cord_title desc_title'>
                                Antigen Presence on Cord Cells
                            </div>
                            <div class='anti_cord_text desc_text'>
                              <ul> 
                                <li><span><?php echo $meta_group['antigen_meta_antigen_presence_on_cord_cells'][1];?></span></li>
                              </ul>
                            </div>
                          </div>
                          <div class='anti_struct_wrap structure' data-search='structure' data-value='<?php echo $meta_group['antigen_meta_antigen_structure'][1];?>'>
                              <div class='anti_struct_title desc_title'>
                                Antigen Structure
                              </div>
                              <div class='anti_struct_text desc_text'>
                                <ul>
                                  <li><span ><?php echo $meta_group['antigen_meta_antigen_structure'][1];?></span></li>
                                </ul>
                              </div>
                          </div>
                          <div class='anti_papain_wrap destroyed papain' data-search='destroyed papain' data-value='<?php echo $meta_group['antigen_meta_antigen_destroyed_by_papain'][1];?>'>
                            <div class='anti_papain_title desc_title'>
                              Antigen Destroyed By Papain
                            </div>
                            <div class='anti_papain_text desc_text'>
                              <ul> 
                                <li><span><?php echo $meta_group['antigen_meta_antigen_destroyed_by_papain'][1];?></span></li>
                              </ul>
                            </div>
                          </div>
                          <div class='anti_comment_wrap comment antigen-comment'>
                            <div class='desc_title'>
                                Antigen Comments  <!--<span class="comment-symbol">[+]</span>-->
                            </div>
                            <div class='desc_text search comment-content' data-value = "<?php echo $meta_group['antigen_meta_antigen_comments'][1];?>">
                               <?php echo $meta_group['antigen_meta_antigen_comments'][1];?>
                            </div>
                          </div>
                       </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <div class='clear'></div>
                <div class="row-fluid">
                  <div class='def_header antigen antigen-other antigen-other-header'>
                    <div class='header-container'>
                      <h1>OTHER BLOOD GROUP SERIES, COLLECTIONS AND ASSOCIATED ANTIGENS</h1>
                      <div class='sub_def_header'>
                        <h3>(BLOOD GROUP SYSTEM NAME)
                          <SPAN>[No. OF ANTIGENS]</SPAN>
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clear"><!-- ClearFix --></div>

                <!-- antigen other root wrap -->
                <div class='antigen_other_root_wrap root_wrap'>
                  <div class="column-width-isotope"></div>
                  <div class="grid_spacer grid_spacer_outer"></div>
                  <?php
                    $antigen_cat_slug = 'antigen-other';
                    $antigen_cat = get_category_by_slug( $antigen_cat_slug );
                    $children_cat = get_categories( 'child_of='.$antigen_cat->cat_ID );
                    $children_cat = sort_other_cat_by_rank( $children_cat );
                    foreach ( $children_cat as $child_cat ) {

                      if ( function_exists( 'get_terms_meta' ) ) {
                        $blood_grp_name = get_terms_meta( $child_cat->cat_ID, 'blood-group-name' );
                        $blood_grp_isbtno = get_terms_meta( $child_cat->cat_ID, 'isbtno' );
                        $antigen_count = get_terms_meta( $child_cat->cat_ID, 'antigen_count' );
                        $curr_rank = get_terms_meta($child_cat->cat_ID, 'other-group-series-rank');
                      }
                  ?>
                  <div id="<?php echo 'id-antigen-other-'.str_replace(' ','-',strtolower( $child_cat->name ));?>" class='antigen_other_outer_wrap grid_wrap'>
                    <div class='antigen_info_wrap hero_info_wrap'>
                      <div class='isbtno isbt number' data-search='isbtno isbt number' data-value='<?php echo strtolower( $blood_grp_isbtno[0] );?>'>
                        <span class="rank"><?php printf('%04d',$curr_rank[0]) ?></span>
                        <?php if (!empty($blood_grp_isbtno[0])) { ?>
                        <div class='isbt_root'>
                          ISBT No.<h4><?php echo $blood_grp_isbtno[0];?></h4>
                        </div>
                        <? } ?>
                        <div class='blood_grp_hero_name blood group name' data-search='blood group name' data-value='<?php echo strtolower( $child_cat->name );?>'>
                          <h1 ><?php echo $child_cat->name;?></h1>
                          <div class='name_sub'>
                            <span class='blood_grp_full_name blood group full name' data-search='blood group full name' data-value='<?php echo strtolower( $blood_grp_name[0] );?>'>
                            <?php echo $blood_grp_name[0];?></span>
                            <?php if (!empty($antigen_count[0])) { ?>
                              <span class='antigen_count'>[<?php echo $antigen_count[0];?>]</span>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="controls">
                        <a class='full_expand icon-right-arrow' href="javascript:void(0)"><span class="hide-text">&rsaquo;</span></a>
                        <a class='close_all icon-cross' href="javascript:void(0)"><span class="hide-text">X</span></a>
                      </div>
                      <!--<a class='full_expand' href="javascript:void(0)">EXP</a>
                      <a class='close_all' href="javascript:void(0)">X</a>-->
                    </div>
                    <div class='info_display_wrap'>
                    <div class='disp_name'></div>
                    <div class='disp_text'></div>
                  </div>
                  <div class='sub_antigen_wrap sub_wrap'>
                    <div class='grid_spacer_single_element'></div>
                    <?php $args = array( 'category' => $child_cat->cat_ID, 'posts_per_page' => 30 );
                      $myposts = get_posts( $args );
                      $myposts = sort_other_posts_by_rank( $myposts );
                      foreach ( $myposts as $one_post ) {
                        $meta_group = get_group( 'post_1', 1, $one_post->ID );
                    ?>
                    <div id="<?php echo sanitize_title( $one_post->post_title );?>"  class='singleElement antigen_wrap post_<?php echo $one_post->ID;?> <?php echo strtolower( str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) ) );?>' data-value='antigen <?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>' data-search='antigen <?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>
                      <a href="<?php echo '#id-antigen-other-'.str_replace(' ','-',strtolower( $child_cat->name ));?>"><div class='blood_group_name' data-value='<?php echo str_replace( $replace_title, ' ', sanitize_title( $one_post->post_title ) );?>'>
                        <span><?php echo $meta_group['antigen_meta_antigen_name'][1];?></span><strong class="hide-text">&rsaquo;</strong><i class="icon-right-arrow arrow-green"></i>
                      </div></a>
                      <div class='blood_group_attr'>
                        <div class='isbtno isbt_antigen_no number' data-search='isbtno isbt_antigen_no number' data-value='<?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?>'><span class='desc_title'>ISBT NO.</span><!--<span class='desc_text'><?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?></span>-->                          
                        </div>
                        <div class="desc_text">
                          <ul>
                            <li><?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?></li>
                          </ul>
                        </div>
                        <div class='rbc_freq_wrap'>
                          <div class='rbc_freq_title desc_title'>RBC Antigen Frequency (%)</div>
                          <div class='rbc_freq_text desc_text'>
                                <ul>
                                  <li><div class='antigen_caucasian caucasian rbc frequency' data-search='caucasian rbc frequency' data-value='<?php echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1];?>'>CAUCASIAN: <?php if ((strcspn($meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1],'0123456789')) != (strlen($meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1]))) {echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1].'%';} else { echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1];}?></div></li>
                                  <li>
                                    <div class='asian rbc frequency' data-search='asian rbc frequency' data-value='<?php echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1];?>'>ASIAN: <?php if ((strcspn($meta_group['antigen_meta_asian_rbc_antigen_frequency'][1], '0123456789')) != (strlen($meta_group['antigen_meta_asian_rbc_antigen_frequency'][1]))) { echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1].'%'; } else { echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1]; } ?></div>
                                  </li>
                                </ul>
                          </div>
                          </div>
                        <div class='adult_site_wrap'>
                          <div class='adult_site_title Adult Antigen Site No desc_title' data-search='adult antigen site no number' data-value='<?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?>'>
                              Adult Antigen Site No. (per RBC)
                          </div>
                          <div class='adult_site_text desc_text'>
                              <ul>
                                <li><span data-value='<?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?>'><?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?></span></li>
                              </ul>
                            </div>
                        </div>
                        <div class='anti_cord_wrap presence cord cells' data-search='presence cord cells' data-value='<?php echo $meta_group['antigen_meta_antigen_presence_on_cord_cells'][1];?>'>
                          <div class='anti_cord_title desc_title'>
                              Antigen Presence on Cord Cells
                          </div>
                          <div class='anti_cord_text desc_text'>
                            <ul> 
                              <li><span><?php echo $meta_group['antigen_meta_antigen_presence_on_cord_cells'][1];?></span></li>
                            </ul>
                          </div>
                        </div>
                        <div class='anti_struct_wrap structure' data-search='structure' data-value='<?php echo $meta_group['antigen_meta_antigen_structure'][1];?>'>
                          <div class='anti_struct_title desc_title'>
                            Antigen Structure
                          </div>
                          <div class='anti_struct_text desc_text'>
                            <ul>
                              <li><span ><?php echo $meta_group['antigen_meta_antigen_structure'][1];?></span></li>
                            </ul>
                          </div>
                        </div>
                        <div class='anti_papain_wrap destroyed papain' data-search='destroyed papain' data-value='<?php echo $meta_group['antigen_meta_antigen_destroyed_by_papain'][1];?>'>
                          <div class='anti_papain_title desc_title'>
                            Antigen Destroyed By Papain
                          </div>
                          <div class='anti_papain_text desc_text'>
                            <ul> 
                              <li><span><?php echo $meta_group['antigen_meta_antigen_destroyed_by_papain'][1];?></span></li>
                            </ul>
                          </div>
                        </div>
                        <div class='anti_comment_wrap comment antigen-comment'>
                          <div class='desc_title'>
                            Antigen Comments <!--<span class="comment-symbol">[+]</span>-->
                          </div>
                          <div class='desc_text search comment-content' data-value = "<?php echo $meta_group['antigen_meta_antigen_comments'][1];?>">
                            <?php echo $meta_group['antigen_meta_antigen_comments'][1];?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
              </div><!-- end antibody other wrap-->

            </div>
                    
                           <!-- shortcode tabs end -->
                        </div>
                       <!-- .contentarea -->
                    </div>
                    <?php get_sidebar( 'left' ); ?>
                </div>
            </div>
            <div class="clear"><!-- ClearFix --></div>
          </div>
          <div class="clear"><!-- ClearFix --></div>
        </div>
  </div><!-- .container -->
</div><!-- .content_wrapper -->

 <?php get_footer(); ?>
