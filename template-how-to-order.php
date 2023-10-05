<?php /*** Template Name: How to order page */?>
<?php include_once "header.php";?>

<div class="how-to-layout">
<div id="contact-form-container"></div>
    <div class="how-to-copy"><?php $page_copy=get_the_content();include "partials/components/copy_section.php";?></div>
    <div class="how-to-info">
    <?php 
    function info_section($title, $copy) {
        if(!$title) {
            return; 
        }
        if(!$copy) {
            return; 
        }
        ?>
        <div class="how-to-info-section">
            <div class="title"><?=$title;?>:</div>
           <div class="copy"> <?=$copy;?> </div>
        </div>
        <?php
    }
    ?>
    <?php 
    $address = get_post_meta($post->ID, "address",true);
    $address_link = get_post_meta($post->ID, "address_link",true);
    if($address) {
        $address_link = ($address_link)? "<a href={$address_link} target=_blank>{$address}</a>" : $address;
        info_section("Physical Address", "<address>".get_bloginfo("name")."<br/>{$address_link}</address>");
    }
    $hours = get_post_meta($post->ID, "shop_hours",true);
    if($hours) {
        info_section("Shop Hours", nl2br($hours));
    }
    $email = get_post_meta($post->ID, "email_address",true);
    if($email) {
        info_section("Email Address", "<a href=mailto:{$email}>{$email}</a>");
    }
    ?>

    
    </div>
    <div class="contact-form">
        <div class="copy_section"><h2><?= get_post_meta($post->ID, "contact_form_header",true) ?: "Contact Form";?></h2></div>
        
    </div>

</div>
<?php include_once "footer.php";?>