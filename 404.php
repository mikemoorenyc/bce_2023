<?php require_once "header.php";?>
<?php get_template_part("components/landing_header","",array("title" => "404 page not found 🤔") )?>
<div class="content-centerer grid-layout">
    <div class="contact-copy-layout">
        <div class="copy-area copy-area-reading-sectioncopy-area copy-area-reading-section">
            The page you're looking for doesn't exist. <a href="<?=get_home_url();?>">Go back to homepage</a>?
        </div>

    </div>


</div>
<?php require_once "footer.php";?>