<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    body {
        background-color: #000;
    }

    #game-screen {
        border: 1px solid grey;
        cursor: crosshair;
    }
    
    html, body {
        width:  100%;
        height: 100%;
        margin: 0px;
    }
    
    .big-title {
        font-family: Arial;
        font-size: 96px;
        color: #fff;
        font-weight: bold;
        text-shadow: 0px 3px 2px rgba(150, 150, 150, 1);
    }
    
    #health-bar,
    #current-health,
    #current-health-anim,
    #hNum    {
        width: 1024px;
        height: 20px;
        position: relative;
    }
    
    #external-hud {
        display: none;
    }
    
    #health-bar {
        border: 1px solid black;
        z-index: 1;
    }
    
    #hNum {
        font-family: 'Arial Narrow';
        text-align: center;
        top: -20px;
        z-index: 1000;
    }
    
    #current-health {
        background-color: #66CD00;
        z-index: 100;
    }
    
    #current-health-anim {
        background-color: grey;
        z-index: 10;
    }
    
    #combat-log {
        height: 100px;
        width: 1024px;
        font-family: Consolas, Arial;
        font-size: 11px;
        text-align: left;
        overflow: scroll;
        border: 1p solid grey;
        display: none;
    }
    
    #canvas-wrap {
        position: relative;
        text-align: center;
    }
    
    .overlay {
        position: absolute;
        width: 1026px;
        height: 610px;
        background-color: rgba(0, 0, 0, 0.75);
        top: 0;
        left: 0;
        display: none;
    }
    
    #main-menu {
        background: url('images/background/battle.jpg');
        opacity: 1.0;
    }
    
    .menu-btn {
        width: 200px;
        margin: 12px auto;
        padding: 12px 18px;
        text-align: center;
        background-color: red;
        color: #fff;
        font-family: Arial;
        font-weight: bold;
        font-size: 24px;
        cursor: pointer;
        transition: box-shadow 0.15s;
    }
    
    .menu-txt {
        width: 200px;
        margin: 12px auto;
        padding: 12px 18px;
        text-align: center;
        color: #fff;
        font-family: Arial;
        font-weight: normal;
        font-size: 24px;
    }
    
    .stat-title {
        width: 200px;
        margin: 12px auto;
        padding: 6px 18px;
        text-align: center;
        color: #fff;
        font-family: Arial;
        font-weight: bold;
        font-size: 16px;
    }
    
    .stat-txt {
        width: 200px;
        margin: 2px auto;
        padding: 2px 18px;
        text-align: left;
        color: #fff;
        font-family: Consolas, "Lucida Console", Monaco, monospace;
        font-weight: bold;
        font-size: 12px;
    }
    
    .menu-btn-container {
        width: 200px;
        position: absolute;
        left: 50%;
        top: 50%;
        
    }
    
    #progress {
        text-align: center;
        font-family: Arial;
    }
    
    #progress-bar {
        width: 300px;
        height: 20px;
        position: absolute;
        left: 362px;
        top: 284px;
    }
    
    #progress-text {
        margin-top: 260px;
        color: #fff;
    }
    
    #progress-text-done {
        color: #fff;
        font-size: 12px;
        margin-top: 32px;
    }
    
    .ui_input,
    #map-name,
    #map-name-ex {
        font-size: 16px;
        width: 208px;
        padding: 12px;
        height: 30px;
        margin: 0 auto;
    }
    
    .flip-vertical {
        -moz-transform: scaleY(-1);
        -webkit-transform: scaleY(-1);
        -o-transform: scaleY(-1);
        transform: scaleY(-1);
        -ms-filter: flipv; /*IE*/
        filter: flipv; /*IE*/
    }
    
    #editor-ui {
        display: none;
        text-align: center;
    }
    
    .placeable-icon {
        cursor: pointer;
        border: 3px solid black;
        transition: border 0.2s;
    }
    
    .placeable-icon:hover {
        border: 3px solid white;
    }
    
    .mbc-6 {
        margin: -254px 0 0 -100px;
    }
    
    .mbc-5 {
        margin: -212px 0 0 -100px;
    }
    
    .mbc-4 {
        margin: -170px 0 0 -100px;
    }
    
    .mbc-3 {
        margin: -128px 0 0 -100px;
    }
    
    .mbc-2 {
        margin: -84px 0 0 -100px; <!-- offset for menus with 2 items -->
    }
    
    .mbc-1 {
        margin: -42px 0 0 -100px;
    }
    
    .menu-btn:hover {
        -webkit-box-shadow: 0px 0px 25px rgba(255, 255, 255, 1);
        -moz-box-shadow:    0px 0px 25px rgba(255, 255, 255, 1);
        box-shadow:         0px 0px 25px rgba(255, 255, 255, 1);
    }
    
    #canvas-ui-wrap {
        position: absolute;
        width: 1026px;
        height: 700px;
        top: 50%;
        left: 50%;
        margin-top: -350px;
        margin-left: -513px;
    }
    
    #tank-select {
        position: absolute;
        width: 420px;
        padding: 12px;
        left: 50%;
        top: 60px;
        margin-left: -210px;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    #tank-info-wrapper {
        width: 100%;
        height: 40px;
        clear: both;
        overflow: hidden;
        font-family: Arial;
        font-size: 14px;
        color: #fff;
        font-weight: bold;
    }
    
    #tank-name {
        width: 280px;
        height: 24px;
        padding-top: 6px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        float: left;
    }
    
    #tank-next,
    #tank-prev {
        width: 60px;
        height: 24px;
        padding-top: 6px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        float: right;
        cursor: pointer;
    }
    
    #tank-next:hover,
    #tank-prev:hover {
        background-color: #fff;
        color: #000;
    }
    
    #tank-is-wrapper {
        width: 100%;
        clear: both;
        overflow: hidden;
    }
    
    #tank-img {
        width: 150px;
        height: 150px;
        float: left;
        background-color: #000;
    }
    
    #tank-chassis-img,
    #tank-turret-img {
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    #tank-chassis-img {
        -webkit-animation:spin 22s linear infinite;
        -moz-animation:spin 22s linear infinite;
        animation:spin 22s linear infinite;
    }
    
    #tank-turret-img {
        -webkit-animation:spin 16s linear infinite;
        -moz-animation:spin 16s linear infinite;
        animation:spin 16s linear infinite;
    }
    
    @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
    @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
    @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
    
    #tank-stats {
        width: 255px;
        height: 150px;
        float: right;
    }
    
    .ts-bar {
        margin-top: 5px;
        width: 100%;
        height: 32px;
        font-family: Arial;
        font-size: 10px;
        text-align: left;
        color: #fff;
    }
    
    #ts-firepower,
    #ts-armor,
    #ts-mobility,
    #ts-firingrate {
        height: 16px;
        width: 0;
        background-color: #fff;
        color: red;
    }
    
    #map-select-wrapper {
        position: absolute;
        left: 390px;
        top: 300px;
    }
    
    #start-battle-ok {
        position: absolute;
        left: 50%;
        top: 360px;
        margin-left: -100px;
    }
    
    #minimap,
    #minimap-bg {
        pointer-events: none;
        position: absolute;
        top: 1px;
        left: 1px;
        border: 1px solid #000;
        opacity: 0.5;
        display: visible;
    }
    
    #map-properties-screen {
        text-align: left;
        font-family: Arial;
        font-size: 12px;
        color: #fff;
        background-color: 
    }
</style>
<style type="text/css" src="css/style.css"></style>
<script type="text/javascript" src="scripts/jquery-2.1.0.min.js"></script>
</head>
<body>
<div id="canvas-ui-wrap">
    <div id="canvas-wrap" onselectstart="return false;">
        <canvas id="game-screen" width="1024" height="608" oncontextmenu="return false;"></canvas>
        <canvas id="minimap-bg" width="228" height="228"></canvas>
        <canvas id="minimap" width="228" height="228"></canvas>
        
        <div id="progress" class="overlay">
            <div id="progress-text">Loading Assets...</div>
            <progress id="progress-bar" value="0" max="100"></progress>
            <div id="progress-text-done">...</div>
        </div>
        
        <div id="main-menu" class="overlay">
            <span class="big-title">Battle Tanks</span>
            <div class="menu-btn-container mbc-2">
                <div id="start-game" class="menu-btn">START GAME</div>
                <div id="map-builder" class="menu-btn">MAP BUILDER</div>
            </div>
        </div>
        
        <div id="pause-menu" class="overlay">
            <div class="menu-btn-container mbc-2">
                <div class="menu-btn main-menu">MAIN MENU</div>
                <div class="menu-btn continue-game">CONTINUE</div>
            </div>
        </div>
        
        <div id="editor-menu" class="overlay">
            <div class="menu-btn-container mbc-5">
                <div class="menu-btn main-menu">MAIN MENU</div>
                <div id="map-properties" class="menu-btn">PROPERTIES</div>
                <div id="save-map" class="menu-btn">SAVE MAP</div>
                <div id="import-map" class="menu-btn">IMPORT MAP</div>
                <div id="export-map" class="menu-btn">EXPORT MAP</div>
                <div class="menu-btn continue-game">CONTINUE</div>
            </div>
        </div>
        
        <div id="map-properties-screen" class="overlay">
            <form>
                <fieldset>
                    <legend style="font-weight: bold">TIMED EVENTS</legend>
                    <div style="text-align: right">
                        <input id="te-new" type="button" value="New Event">
                        <input id="te-remove-all" type="button" value="Clear Events">
                    </div>
                    <hr>
                    <div id="timed-event-container">
                    </div>
                </fieldset>
            </form>
            <div class="menu-btn continue-game" style="position: absolute; bottom: 10px; right: 20px">CONTINUE</div>
        </div>
        
        <div id="game-over-screen" class="overlay">
            <div class="menu-btn-container mbc-4">
                <div class="menu-txt" id="mt-title">GAME OVER!</div>
                <div class="stat-title">STATISTICS:</div>
                <div class="stat-txt" >Shots fired -------- <span id="stat-sf"></span></div>
                <div class="stat-txt" >Hits --------------- <span id="stat-h"></span></div>
                <div class="stat-txt" >Tanks Spawned ------ <span id="stat-ts"></span></div>
                <div class="stat-txt" >Tanks Destroyed ---- <span id="stat-td"></span></div>
                <div class="stat-txt" >Damage Dealt ------- <span id="stat-dd"></span></div>
                <div class="stat-txt" >Damage Taken ------- <span id="stat-dt"></span></div>
                <div class="menu-btn main-menu">MAIN MENU</div>
            </div>
        </div>
        
        <div id="prompt-pre-game-settings" class="overlay">
                <div id="tank-select">
                    <div id="tank-info-wrapper">
                        <div id="tank-name"></div>
                        <div id="tank-next">NEXT</div>
                        <div id="tank-prev">PREV</div>
                    </div>
                    <div id="tank-is-wrapper">
                        <div id="tank-img">
                            <div id="tank-chassis-img">
                                <div id="tank-turret-img"></div>
                            </div>
                        </div>
                        <div id="tank-stats">
                            <div class="ts-bar">FIREPOWER<div id="ts-firepower"></div></div>
                            <div class="ts-bar">RATE OF FIRE<div id="ts-firingrate"></div></div>
                            <div class="ts-bar">ARMOR<div id="ts-armor"></div></div>
                            <div class="ts-bar">MOBILITY<div id="ts-mobility"></div></div>
                        </div>
                    </div>
                </div>
                <div id="map-select-wrapper">
                    <span style="color: white; font-family: Arial">MAP: </span>
                    <select id="map-select" style="width: 232px; padding: 8px 4px; margin-bottom: 12px;">
                    </select>
                </div>
                <div id="start-battle-ok" class="menu-btn">START BATTLE!</div>
        </div>
        
        <div id="prompt-map-name" class="overlay">
            <div class="menu-btn-container mbc-2">
                <input id="map-name" type="text" value="" placeholder="Map Name" />
                <div id="save-map-ok" class="menu-btn">OK</div>
            </div>
        </div>
        
        <div id="prompt-map-name-export" class="overlay">
            <div class="menu-btn-container mbc-2">
                <input id="map-name-ex" type="text" value="" placeholder="Map Name" />
                <div id="save-map-ex-ok" class="menu-btn">OK</div>
            </div>
        </div>
        
        <div id="prompt-map-import" class="overlay">
            <div class="menu-btn-container mbc-2">
                <input id="map-string" class="ui_input" type="text" value="" placeholder="Map String" />
                <div id="import-map-ok" class="menu-btn">IMPORT</div>
            </div>
        </div>
    </div>
    
    <div id="external-hud">
        <div id="health-bar">
            <div id="current-health-anim">
                <div id="current-health">
                </div>  
            </div>
            <div id="hNum">
            </div>
        </div>
    </div>
    
    <div id="combat-log"></div>
    <div id="editor-ui"></div>
</div>

<!-- Ok, let's start unloading our Javascript payload -->
<script type="text/javascript" src="scripts/init.js"></script>
<script type="text/javascript" src="scripts/util.js"></script>
<script type="text/javascript" src="scripts/viewport.js"></script>
<script type="text/javascript" src="scripts/stat.js"></script>
<script type="text/javascript" src="scripts/canvas.js"></script>
<script type="text/javascript" src="scripts/global.js"></script>
<script type="text/javascript" src="scripts/tank.js"></script>
<script type="text/javascript" src="scripts/projectile.js"></script>
<script type="text/javascript" src="scripts/destructible.js"></script>
<script type="text/javascript" src="scripts/vfx.js"></script>
<script type="text/javascript" src="scripts/powerup.js"></script>
<script type="text/javascript" src="scripts/blueprint.js"></script>
<script type="text/javascript" src="scripts/map.js"></script>
<script type="text/javascript" src="scripts/setup.js"></script>
<script type="text/javascript" src="scripts/load.js"></script>
<script type="text/javascript" src="scripts/listener.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>
</body>
</html>