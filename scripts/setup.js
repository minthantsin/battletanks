/*-------- Setup & Initialization --------*/

TankImages = new ImageLibrary();
TankImages.add('light-turret-blue', 'images/tanks/light-turret-blue.png');
TankImages.add('light-turret-red', 'images/tanks/light-turret-red.png');
TankImages.add('light-chassis', 'images/tanks/light-chassis.png');
TankImages.add('jagdpanther_turret', 'images/tanks/jagdpanther_turret.png');
TankImages.add('jagdpanther_chassis', 'images/tanks/jagdpanther_chassis.png');
TankImages.add('m4_sherman_turret', 'images/tanks/m4_sherman_turret.png');
TankImages.add('m4_sherman_chassis', 'images/tanks/m4_sherman_chassis.png');

PowerUpImages = new ImageLibrary();
PowerUpImages.add('random', 'images/powerups/random.png');
PowerUpImages.add('rapid-fire', 'images/powerups/rapid-fire.png');
PowerUpImages.add('haste', 'images/powerups/haste.png');
PowerUpImages.add('faster-projectile', 'images/powerups/faster-projectile.png');
PowerUpImages.add('increased-armor', 'images/powerups/increased-armor.png');
PowerUpImages.add('increased-damage', 'images/powerups/increased-damage.png');
PowerUpImages.add('aphotic-shield', 'images/powerups/aphotic-shield.png');
PowerUpImages.add('reactive-armor', 'images/powerups/reactive-armor.png');
PowerUpImages.add('regeneration', 'images/powerups/regeneration.png');
PowerUpImages.add('ammo', 'images/powerups/ammo.png');

DestructibleImages = new ImageLibrary();
DestructibleImages.add('brick_explosive', 'images/destructibles/brick-explosive.png');
DestructibleImages.add('wall_rubber', 'images/destructibles/wall-rubber.png');
DestructibleImages.add('heavy_rubber', 'images/destructibles/heavy-rubber.png');
DestructibleImages.add('concrete', 'images/destructibles/concrete.png');
DestructibleImages.add('riveted_iron', 'images/destructibles/riveted-iron.png');

AttachmentImages = new ImageLibrary();
AttachmentImages.add('increased-damage', 'images/attachments/turret/increased-damage.png');
AttachmentImages.add('increased-armor', 'images/attachments/chassis/increased-armor.png');

EditorImages = new ImageLibrary();
EditorImages.add('starting-point', 'images/editor/starting-point.png');


backgroundMusic = new Audio('sounds/bgm.wav');
backgroundMusic.loop = true;
backgroundMusic.volume = 0.15;
backgroundMusic.load();

fireSound         = new SoundPool(20);
explodeSound      = new SoundPool(20);
d_explodeSound    = new SoundPool(20);
d_destroyedSound  = new SoundPool(10);
t_destroyedSound  = new SoundPool(10);
t_destroyedSound2 = new SoundPool(10);
t_destroyedSound3 = new SoundPool(10);
pick_powerupSound = new SoundPool(20);

fireSound.init('turret_fire');
explodeSound.init('explosion');
d_explodeSound.init('d_explosion');
d_destroyedSound.init('d_destroyed');
t_destroyedSound.init('tank_destroyed');
t_destroyedSound2.init('tank_destroyed2');
t_destroyedSound3.init('tank_destroyed3');
pick_powerupSound.init('pick-powerup');

// the default map
testmap = new Map('default');
testmap.destructibles.push(['brick_explosive', 300, 200]);
testmap.destructibles.push(['wall_rubber', 332, 200]);
testmap.destructibles.push(['wall_rubber', 364, 200]);
testmap.destructibles.push(['concrete', 396, 200]);
testmap.destructibles.push(['riveted_iron', 428, 200]);
testmap.startingPoints.push(new StartingPoint(100, 100));
testmap.startingPoints.push(new StartingPoint(400, 300));
testmap.startingPoints.push(new StartingPoint(500, 300));
testmap.startingPoints.push(new StartingPoint(720, 362));

maps.push(testmap);
current_map = maps[0];

function checkReadyState() {
    if (backgroundMusic.readyState === 4 ) {
        window.clearInterval(checkAudio);
        backgroundMusic.play();
    }
}