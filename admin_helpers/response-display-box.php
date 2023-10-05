<?php

function create_contact_response() {

    $the_post = get_post($_GET["post"]) ;
    
    if(!$the_post || $the_post->post_type != "contact-responses") {
      //  return; 
    }
    //var_dump($the_post);
    add_meta_box("contact_response","response",function($the_post) {
       
        ?>
        <div id="response-container">
          
           <?= $the_post->post_content;?>
           <?php
            //Attached Files
            $files = [];
            $id = $the_post->ID;
            $doc_file = wp_upload_dir()["basedir"]."/submitted_docs";
            if(is_dir($doc_file)) {
              $doc_dir =  new DirectoryIterator($doc_file);
              
              foreach ($doc_dir as $file) {
                
                  if ($file->isFile()) {
                    $fname = $file->getFilename();
                    
                    if(strpos($fname, strval( $id)) === 0) {
                  
                      $files[] = $fname;
                    }
                  }
              }
             
            }
            if(count($files)){
              ?>
                <b>Attached Files</b>
                <ul>
                  <?php
                  foreach($files as $f) {
                   
                    ?>
                      <li><a href="<?=admin_url("admin-ajax.php"); ?>?action=download_file&id=<?=$f;?>" target="_blank"><?= str_replace($id."_", "",$f);?></a></li>
                    <?php
                  }

                  ?>

                </ul>
              <?php
            }
           ?>
           
        </div>
        <?php
    },"contact-responses","normal","high",[$the_post]
       
        
    );
    
}
add_action("add_meta_boxes", "create_contact_response");

?>