enchant();

window.onload = function () {
    var game_ = new Game(800, 360); // ゲーム本体を準備すると同時に、表示される領域の大きさを設定しています。
    game_.fps = 20 // frames（フレーム）per（毎）second（秒）：ゲームの進行スピードを設定しています。
    game_.preload('./img/sheetMaru.png'); // pre（前）-load（読み込み）：ゲームに使う素材をあらかじめ読み込んでおきます。
    game_.preload('./img/sheetDanpy.png');
    game_.preload('./img/sheetRabin.png');
    game_.preload('./img/sheetSammy.png');
    game_.preload('./img/sheetSyldra.png');
    game_.preload('./img/sheetPiyoliita.png');
    game_.preload('./img/sheetMeruro.png');

        // 処理
                                   //スプライトシートの使用領域を指定
                                   var course = new Sprite(800, 100);
                                   var maru = new Sprite(24, 24);
                                   var danpy = new Sprite(24, 24);
                                   var rabin = new Sprite(24, 24);
                                   var sammy = new Sprite(24, 24);
                                   var syldra = new Sprite(24, 24);
                                   var piyoliita = new Sprite(24, 24);
                                   var meruro = new Sprite(24, 24);

        //画像/初期フレーム/描写位置を指定
        //レースコース
        course.x = 25;
        course.y = 25;
        course.backgroundColor = "rgba(232, 174, 67, 1)";
        //まる
        maru.image = game_.assets['./img/sheetMaru.png'];
        maru.frame = 4;
        maru.x = 30;
        maru.y = 30;
        //ダンピィ
        danpy.image = game_.assets['./img/sheetDanpy.png'];
        danpy.frame = 4;
        danpy.x = 30;
        danpy.y = 40;
        //ラビン
        rabin.image = game_.assets['./img/sheetRabin.png'];
        rabin.frame = 4;
        rabin.x = 30;
        rabin.y = 50;
        //サミー
        sammy.image = game_.assets['./img/sheetSammy.png'];
        sammy.frame = 4;
        sammy.x = 30;
        sammy.y = 60;
        //シルドラ
        syldra.image = game_.assets['./img/sheetSyldra.png'];
        syldra.frame = 4;
        syldra.x = 30;
        syldra.y = 70;
        //ピヨリータ
        piyoliita.image = game_.assets['./img/sheetPiyoliita.png'];
        piyoliita.frame = 4;
        piyoliita.x = 30;
        piyoliita.y = 80;
        //メルロ
        meruro.image = game_.assets['./img/sheetMeruro.png'];
        meruro.frame = 4;
        meruro.x = 30;
        meruro.y = 90;
        //コースの描写
        game_.rootScene.addChild(course);
        //各キャラクターの描写
        game_.rootScene.addChild(maru);
        game_.rootScene.addChild(danpy);
        game_.rootScene.addChild(rabin);
        game_.rootScene.addChild(sammy);
        game_.rootScene.addChild(syldra);
        game_.rootScene.addChild(piyoliita);
        game_.rootScene.addChild(meruro);

        //背景色の指定
        game_.rootScene.backgroundColor  = '#7ecef4';

        //その他変数
        var i = 0;
        var maxSpeed = 4;
        //var goalCharactarNum = 0;
         // シーンに「毎フレーム実行イベント」を追加します。
         rootScene.addEventListener(Event.ENTER_FRAME, function() {
         	if(i>250){
         		maxSpeed = 8;
         	};
         	maru.x += Math.floor(Math.random () * maxSpeed);
         	if(maru.frame==4){maru.frame=5}else{maru.frame=4};
            //if(maru.x ==750){var goalFlgMaru =1;goalCharactarNum++;};

            danpy.x += Math.floor(Math.random () * maxSpeed);
            if(danpy.frame==4){danpy.frame=5}else{danpy.frame=4};
            //if(maru.x ==750){var goalFlgDanpy =1;goalCharactarNum++;};

            rabin.x += Math.floor(Math.random () * maxSpeed);
            if(rabin.frame==4){rabin.frame=5}else{rabin.frame=4};
            //if(maru.x ==750){var goalFlgRabin =1;goalCharactarNum++;};

            sammy.x += Math.floor(Math.random () * maxSpeed);
            if(sammy.frame==4){sammy.frame=5}else{sammy.frame=4};
           // if(maru.x ==750){var goalFlgSammy =1;goalCharactarNum++;};

           syldra.x += Math.floor(Math.random () * maxSpeed);
           if(syldra.frame==4){syldra.frame=5}else{syldra.frame=4};
            //if(maru.x ==750){var goalFlgSyldra =1;goalCharactarNum++;};

            piyoliita.x += Math.floor(Math.random () * maxSpeed);
            if(piyoliita.frame==4){piyoliita.frame=5}else{piyoliita.frame=4};
            //if(maru.x ==750){var goalFlgpiyoliita =1;goalCharactarNum++;};

            meruro.x += Math.floor(Math.random () * maxSpeed);
            if(meruro.frame==4){meruro.frame=5}else{meruro.frame=4};
            //if(maru.x ==750){var goalFlgMeruro =1;goalCharactarNum++;};

            //エンドシーン移行
            //フレーム数
            i++;
        });
game_.start();
};