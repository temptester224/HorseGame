<?php if(empty($_SESSION["user"])) {?>
        <ul>
            
            <li><a href="/about.html" <?=(isset($_GET["menu"]) && strtolower($_GET["menu"]) == "about") ? 'class="selected"' : False; ?>>
			<span class="fa fa-info-circle "></span> О проекте</a>
			</li>
            <li><a href="/news.html"<?=(isset($_GET["menu"]) && strtolower($_GET["menu"]) == "news") ? 'class="selected"' : False; ?>>
			<span class="fa fa-newspaper-o"></span> Последние новости</a>
			</li>
            <li><a href="/"<?=(isset($_GET["menu"]) && strtolower($_GET["menu"]) == "") ? 'class="selected"' : False; ?>>
			<span class="fa fa-fw fa-gamepad"></span> Игры <div class="new_label">Скоро!</div></a>
			</li>
            <li><a href="/otziv.html"<?=(isset($_GET["menu"]) && strtolower($_GET["menu"]) == "otziv") ? 'class="selected"' : False; ?>>
			<span class="fa fa-comments-o"></span> Отзывы</a>
			</li>
            <li><a href="/rules.html"<?=(isset($_GET["menu"]) && strtolower($_GET["menu"]) == "rules") ? 'class="selected"' : False; ?>>
			<span class="fa fa-edit"></span> Соглашение</a>
			</li>
            <li><a href="/contacts.html"<?=(isset($_GET["menu"]) && strtolower($_GET["menu"]) == "contacts") ? 'class="selected"' : False; ?>>
			<span class="fa fa-envelope"></span> Контакты</a>
			</li>
        </ul>
<?php } ?>
<div class="addthis">
    <div class="shares">
        <span displaytext="Facebook" class="st_facebook_large" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span class="stLarge" style="background-image: url(&quot;http://w.sharethis.com/images/facebook_32.png&quot;);"></span></span></span>
        <span displaytext="Tweet" class="st_twitter_large" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span class="stLarge" style="background-image: url(&quot;http://w.sharethis.com/images/twitter_32.png&quot;);"></span></span></span>
        <span displaytext="LinkedIn" class="st_linkedin_large" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span class="stLarge" style="background-image: url(&quot;http://w.sharethis.com/images/linkedin_32.png&quot;);"></span></span></span>
        <span displaytext="Pinterest" class="st_pinterest_large" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span class="stLarge" style="background-image: url(&quot;http://w.sharethis.com/images/pinterest_32.png&quot;);"></span></span></span>
        
        <script src="http://w.sharethis.com/button/buttons.js" type="text/javascript"></script>
        <script type="text/javascript">stLight.options({publisher: "ur-e6c288f8-ee4e-5b1f-6230-e4f9ecb840f0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        <div class="divider"></div>
    </div>
</div> 
            
      