<?php

global $pagebuilder;

if (isset($pagebuilder['settings']['layout-sidebars']) && $pagebuilder['settings']['layout-sidebars'] == "right-sidebar") {
echo "    <div class='right-sidebar-block span3'>
            <aside class='sidebar'>";
              dynamic_sidebar( (isset($pagebuilder['settings']['selected-sidebar-name']) ? $pagebuilder['settings']['selected-sidebar-name'] : "Default") );
    echo "  </aside>
          </div>
    ";
}

?>