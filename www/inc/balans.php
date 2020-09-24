<?php 
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>
<a href="/account/withdraw.html" class="your_gold">
	<div>¬ы имеете <?=floor($user_data['money_b']);?> золото дл€ покупок </div>
	<div class="clear"></div>
	---------------------------------
	<div class="clear"></div>
	<span><div id="resources_GOD"><?=floor($user_data['money_p']);?> золото дл€ вывода</div></span>
</a>