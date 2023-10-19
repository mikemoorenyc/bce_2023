<?php
extract($args);
?>



<div class="pw-form-check">
    <form class="pw-form font-sans" data-postid="<?=$post_id;?>">
        <h1>Password Required</h1>
        <p class="pw-form-info">You can request the password by contacting me. <a href="<?=$link;?>">See contact options</a>.</p>
        <div class="pw-form-input before-block">
            <label for="password"><span>Enter Password</span></label>
            <input id="password" type="text" name="password" /> 
            <div class="errorIcon"><? include get_template_directory()."/assets/svgs/prohibition.svg" ?></div>
        </div>
        <div class="pw-form-error-text">&nbsp;</div>
        <button class="pw-form-submit-button before-block">Submit</button>
    </form>
    <div class="pw-checking-state font-sans">
        I&rsquo;m checking to see if you have access to this post <span class="dot1">🙊</span><span class="dot2">🙉</span><span class="dot3">🙈</span>    
    </div>
</div>