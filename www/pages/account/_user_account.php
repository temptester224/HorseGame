<?PHP
$_OPTIMIZATION["title"] = "HORSE RACING";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
?>
	



<!DOCTYPE html>
<html>
    <head>
        <title>HORSE RACING</title>
        <link rel="stylesheet" href="/css/reset.css" type="text/css">
        <link rel="stylesheet" href="/css/main.css" type="text/css">
        <link rel="stylesheet" href="/css/orientation_utils.css" type="text/css">
        <link rel="stylesheet" href="/css/ios_fullscreen.css" type="text/css">
        <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/js/howler.min.js"></script>
        <script type="text/javascript" src="/js/screenfull.js"></script>
        <script type="text/javascript" src="/js/ios_fullscreen.js"></script>
        <script type="text/javascript" src="/js/platform.js"></script>
        <script type="text/javascript" src="/js/createjs-2015.11.26.min.js"></script>
        <script type="text/javascript" src="/js/ctl_utils.js"></script>
        <script type="text/javascript" src="/js/sprite_lib.js"></script>
        <script type="text/javascript" src="/js/settings.js"></script>
        <script type="text/javascript" src="/js/CGameSettings.js"></script>
        <script type="text/javascript" src="/js/CLang.js"></script>
        <script type="text/javascript" src="/js/CPreloader.js"></script>
        <script type="text/javascript" src="/js/CMain.js"></script>
        <script type="text/javascript" src="/js/CTextButton.js"></script>
        <script type="text/javascript" src="/js/CToggle.js"></script>
        <script type="text/javascript" src="/js/CGfxButton.js"></script>
        <script type="text/javascript" src="/js/CMenu.js"></script>
        <script type="text/javascript" src="/js/CGame.js"></script>
        <script type="text/javascript" src="/js/CInterface.js"></script>
        <script type="text/javascript" src="/js/CCreditsPanel.js"></script>
        <script type="text/javascript" src="/js/CBetPanel.js"></script>
        <script type="text/javascript" src="/js/CChipPanel.js"></script>
        <script type="text/javascript" src="/js/CSimpleBetPanel.js"></script>
        <script type="text/javascript" src="/js/CForecastPanel.js"></script>
        <script type="text/javascript" src="/js/CBetList.js"></script>
        <script type="text/javascript" src="/js/CFichesController.js"></script>
        <script type="text/javascript" src="/js/CButBet.js"></script>
        <script type="text/javascript" src="/js/CVector2.js"></script>
        <script type="text/javascript" src="/js/CMsgBox.js"></script>
        <script type="text/javascript" src="/js/CTrackBg.js"></script>
        <script type="text/javascript" src="/js/CHorse.js"></script>
        <script type="text/javascript" src="/js/CTweenController.js"></script>
        <script type="text/javascript" src="/js/CRankingGui.js"></script>
        <script type="text/javascript" src="/js/CArrivalPanel.js"></script>
        <script type="text/javascript" src="/js/CWinPanel.js"></script>
        <script type="text/javascript" src="/js/CLosePanel.js"></script>
        <script type="text/javascript" src="/js/CButStartRace.js"></script>
        <script type="text/javascript" src="/js/CAreYouSurePanel.js"></script>
        <script type="text/javascript" src="/js/CGate.js"></script>
        <script type="text/javascript" src="/js/CCTLText.js"></script>
        <script type="text/javascript" src="/js/CFicheBut.js"></script>

    </head>
    <body ondragstart="return false;" ondrop="return false;" >
        <div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
		
		 <script>

		 	<?	$db->Query("UPDATE db_users_b SET money_b = money_b + 'recharge' WHERE id = '$usid'");?>
		 
            $(document).ready(function () {
                var oMain = new CMain({
                    money:{!BALANCE_B!},           //USER MONEY
                    min_bet:1,           //MINIMUM BET
                    max_bet:100,         //MAXIMUM BET
                    win_occurrence:40,   //WIN OCCURRENCE
                    game_cash:{!BALANCE_B!},       //GAME CASH. STARTING MONEY THAT THE GAME CAN DELIVER.
                    chip_values:[1,5,10,25,50,100], //VALUE OF CHIPS
                    audio_enable_on_startup:false, //ENABLE/DISABLE AUDIO WHEN GAME STARTS 
                    show_credits:true, //SET THIS VALUE TO FALSE IF YOU DON'T TO SHOW CREDITS BUTTON
                    fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                    check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                    num_levels_for_ads: 2 //NUMBER OF TURNS PLAYED BEFORE AD SHOWING //
                            //////// THIS FEATURE  IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN./////////////////////////// 
                            /////////////////// YOU CAN GET IT AT: ///////////////////////////////////////////////////////// 
                            // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421///////////

                });
                
                $(oMain).on("recharge", function (evt) {
                    //INSERT HERE YOUR RECHARGE SCRIPT THAT RETURN MONEY TO RECHARGE
                    var iMoney = 100;
                    if(s_oBetPanel !== null){
                        s_oBetPanel.setMoney(iMoney);
                    }
                });
				
				

                
                $(oMain).on("start_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartSession();
                    }
                });

                $(oMain).on("end_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndSession();
                    }
                });
                
                $(oMain).on("bet_placed", function (evt, iTotBet) {
                        //...ADD YOUR CODE HERE EVENTUALLY
                });
                                
                $(oMain).on("save_score", function (evt, iScore) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeSaveScore({score: iScore});
                    }
                });

                $(oMain).on("show_interlevel_ad", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShowInterlevelAD();
                    }
                });

                $(oMain).on("share_event", function (evt, iScore) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShareEvent({img: TEXT_SHARE_IMAGE,
                            title: TEXT_SHARE_TITLE,
                            msg: TEXT_SHARE_MSG1 + iScore
                                    + TEXT_SHARE_MSG2,
                            msg_share: TEXT_SHARE_SHARE1
                                    + iScore + TEXT_SHARE_SHARE1});
                    }
                });

                if (isIOS()) {
                    setTimeout(function () {
                        sizeHandler();
                    }, 200);
                } else {
                    sizeHandler();
                }
            });
			
					

        </script>
        
		
		
       
        
        <div class="check-fonts">
            <p class="check-font-1">test 1</p>
            <p class="check-font-2">test 2</p>
            <p class="check-font-3">test 3</p>
        </div> 
        
        <canvas id="canvas" class='ani_hack' width="1216" height="832"> </canvas>
        <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
        <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>

    </body>
</html>