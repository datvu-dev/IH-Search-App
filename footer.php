  </div><!-- .main_wrapper -->
	
	<?php if (gt3_get_theme_option("footer_widgets_area") == "on") { ?>
    <div class="pre_footer">
        <div class="container">
            <div>
              <img src="<?php bloginfo( 'template_directory' );?>/img/footer_logo.jpg" />
            </div>
            <div class="footer-block footer-reference">
                <h6>BIBLIOGRAPHY</h6>
                <p>Brecher ME. American Associaton of Blood Banks Technical Manual. 15<sup>th</sup> Ed. Bethesda, Maryland 2005. <br> Klein HG, Anstee DJ. Mollison's Blood Tranfusion in Clinical Medicine. 
                11<sup>th</sup> Ed. Blackwell 2005. <br>
                Reid ME, Lomas-Francis C. The Blood Group Antigen Facts Book. 2<sup>nd</sup> Ed. Academic Press. London 2004. <br>Daniels G. Human Blood Groups. 
                2<sup>nd</sup> Ed. Blackwell Science, UK 202.<br>
             
                Daniels G, et al. The Clinical Significance of Blood Group Antibodies. <em>Transfusion Medicine.</em> 2002; 12: 287-295.<br>
                Henry SM, Oriol R, Samuelsson BE: Lewis histo-blood group system and associated secretory phentypes. Vox Sang 1995; 69:166-182
                  <br>Schenkel-Brunner H. Human Blood Groups, Chemical and Biochemical Basis of Antigens Specificty. 2<sup>nd</sup> Ed. Springer Wien. New York 2000. <strong>
                </p>
            </div>
            <div class="footer-block footer-reference">
                <h6>ADDITIONAL REFERENCES 2014</h6>
                
                <p>ISBT Committee on Terminology for Red Cell Surface Antigens <a href="http://ibgrl.blood.co.uk/isbt%20pages/ISBT%20Terminology%20Pages/Terminology%20Home%20Page.htm" target="_blank">website</a> (accessed June 2014)<br>
ISBT Blood group allele terminology <a href="http://www.isbtweb.org/working-parties/red-cell-immunogenetics-and-blood-group-terminology/blood-group-terminology/blood-group-allele-terminology/" target="_blank">website</a> (accessed June 2014)
<br>
NCBI Blood Group Antigen Gene Mutation Database (dbRBC) <a href="http://www.ncbi.nlm.nih.gov/projects/gv/rbc/xslcgi.fcgi?cmd=bgmut/systems" target="_blank">website</a> (accessed June 2014)<br>
Daniels G. Human Blood Groups. 3rd Ed  Wiley-Blackwell, Chichester, UK  2013 <br>
Svensson L, Rydberg L, de Mattos LC, Henry SM. Blood group A1 and A2 revisited: an immunochemical analysis. Vox Sang 2008;96:56-61.<br/><br/>Reviewed by Rosemary Sparrow, Transfusion Science Consultant, Monash University.</p>
            </div>
            <div class="footer-block glossary">              
                <div class = "glossary-block"><strong>ISBT</strong><span>International Society of Blood Transfusion</span></div>
                <div class = "glossary-block"><strong>IAT</strong><span>Indirect Antiglobulin Test</span></div>
                <div class = "glossary-block"><strong>RBC</strong><span>Red Blood Cell</span></div>
                <div class = "glossary-block"><strong>HDFN</strong><span>Haemolytic Disease of the Foetus and Newborn</span></div>
                <div class = "glossary-block"><strong>HTR</strong><span>Haemolytic Transfusion Reactions</div>
              
            </div>
            <div class="footer-block">
              <p><strong>Note:</strong> bioCSL do not recommend the use of organic solution elution methods due the fume hazard.</p>
            </div>
            <div class="footer-block copyright">
              <p>© bioCSL™ 63 Poplar Road, Parkville Victoria 3052. ABN: 26 160 735 035. bioCSL™ is a trademark of CSL Limited. All rights reserved. AUS/IHBC/0814/0001. Date of preparation: August 2014.<br><strong>P</strong> : <a>1800 008 275</a> <strong>F</strong> : <a>03 9389 1646</a> <strong>E</strong> : <a href="mailto:ih@biocsl.com.au">ih@biocsl.com.au</a> <strong>W</strong> : <a href="http://www.biocsl.com.au" target="_blank">www.biocsl.com.au</a></p>
            </div>
            <aside id="footer_bar" class="row">
				    <?php get_sidebar('footer'); ?>
            </aside>
        </div>
    </div><!-- .pre_footer -->
	<?php } ?>
    
  <!--<div>
      <div class="footer_line container">
      	<div class="copyright"><?php gt3_the_theme_option("copyright"); ?></div>
        <div class="clear"></div>
      </div>
  </div>-->
    
	<?php 
    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);

  if (count($matches)>1){
    //Then we're using IE
    $version = $matches[1];

    switch(true){
      case ($version < 8):
        //IE 8 or under!?>
        <script type="text/javascript" src='wp-includes/js/jquery/jquery.js?ver=1.11.0'></script>
        <?break;
      case ($version == 8):
        //IE 8 !?>
        <script type="text/javascript" src='<?php bloginfo('template_url'); ?>/js/isotope.pkgd.min.js'></script>
        <script src="<?php bloginfo('template_url'); ?>/custom_scripts.js"></script>
        <?break;
      case ($version > 8):
        //IE9!
        gt3_the_theme_option("code_before_body"); wp_footer();
        ?>
        <script src="<?php bloginfo('template_url'); ?>/custom_scripts.js"></script><?php
        break;
      default:
        //You get the idea
        gt3_the_theme_option("code_before_body"); wp_footer();?>
        <script src="<?php bloginfo('template_url'); ?>/custom_scripts.js"></script><?php
        break;
    }
  }else{
    ?>
    <script type="text/javascript" src='<?php bloginfo('template_url'); ?>/js/isotope.pkgd.min.js'></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/custom_scripts.js"></script>
    <?
  }

    //gt3_the_theme_option("code_before_body"); wp_footer(); ?>
  
<div id='script_add'></div>
    
<!--[if gt IE 8]> 
  <script src="<?php bloginfo('template_url'); ?>/custom_scripts_ie7.js"></script>
<![endif]-->
   
    <!--[if lt IE 8]>
      <script src="<?php bloginfo('template_url'); ?>/custom_scripts_ie7.js"></script>
    <![endif]-->
</body>
</html>