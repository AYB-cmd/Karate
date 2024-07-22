<div class="content-container">
    <div class="submenu-left">
        <h3>Settings</h3>       
        <hr>
        <h4>Select category:</h4>
        <ul class="list-nav">
        	<a href="index.php?mod=settings&sub=client"> <li <?php echo $active = ($sub == 'class' || $sub == '') ? 'class="active"' : '' ;?>> Client Management</li></a>
        	
          
        </ul>
    </div>

    <div class="managesvcs-content">`
        <?php
            switch($sub){
   
                default:
                    require_once 'datatable/sub/index.php';
                break;	
            }
        ?>
    </div>
</div>
 