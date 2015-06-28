        enchant();

        window.onload = function(){
            var game = new Game(800, 360);
            game.fps = 20; 
            //使用する画像のプレロード
            game.preload('./img/sheetMaru.png'); 
            game.preload('./img/sheetDanpy.png');
            game.preload('./img/sheetRabin.png');
            game.preload('./img/sheetSammy.png');
            game.preload('./img/sheetSyldra.png');
            game.preload('./img/sheetPiyoliita.png');
            game.preload('./img/sheetMeruro.png');

            game.onload = function(){
            //スプライトシートの使用領域を指定
            var course = new Sprite(800, 100);
            var start = new Sprite(20, 100);
            var goal = new Sprite(20, 100);
            var maru = new Sprite(24, 24);
            var danpy = new Sprite(24, 24);
            var rabin = new Sprite(24, 24);
            var sammy = new Sprite(24, 24);
            var syldra = new Sprite(24, 24);
            var piyoliita = new Sprite(24, 24);
            var meruro = new Sprite(24, 24);

            //画像/初期フレーム/描写位置を指定
            //スタートライン
            start.x = 25;
            start.y = 25;
            start.backgroundColor = "rgba(102,255,153, 1)";
            //ゴールライン
            goal.x = 750;
            goal.y = 25;
            goal.backgroundColor = "rgba(102,255,153, 1)";
            //レースコース
            course.x = 25;
            course.y = 25;
            course.backgroundColor = "rgba(232, 174, 67, 1)";
            //まる
            maru.image = game.assets['./img/sheetMaru.png'];
            maru.frame = 4;
            maru.x = 25;
            maru.y = 30;
            //ダンピィ
            danpy.image = game.assets['./img/sheetDanpy.png'];
            danpy.frame = 4;
            danpy.x = 25;
            danpy.y = 40;
            //ラビン
            rabin.image = game.assets['./img/sheetRabin.png'];
            rabin.frame = 4;
            rabin.x = 25;
            rabin.y = 50;
            //サミー
            sammy.image = game.assets['./img/sheetSammy.png'];
            sammy.frame = 4;
            sammy.x = 25;
            sammy.y = 60;
            //シルドラ
            syldra.image = game.assets['./img/sheetSyldra.png'];
            syldra.frame = 4;
            syldra.x = 25;
            syldra.y = 70;
            //ピヨリータ
            piyoliita.image = game.assets['./img/sheetPiyoliita.png'];
            piyoliita.frame = 4;
            piyoliita.x = 25;
            piyoliita.y = 80;
            //メルロ
            meruro.image = game.assets['./img/sheetMeruro.png'];
            meruro.frame = 4;
            meruro.x = 25;
            meruro.y = 90;
            //コースの描写
            game.rootScene.addChild(course);
            //スタートラインの描写
            game.rootScene.addChild(start);
            //ゴールラインの描写
            game.rootScene.addChild(goal);
            //各キャラクターの描写
            game.rootScene.addChild(maru);
            game.rootScene.addChild(danpy);
            game.rootScene.addChild(rabin);
            game.rootScene.addChild(sammy);
            game.rootScene.addChild(syldra);
            game.rootScene.addChild(piyoliita);
            game.rootScene.addChild(meruro);

            //背景色の指定
            game.rootScene.backgroundColor  = '#7ecef4';
                    //その他変数
                    var i = 0;
                    var maxSpeed = 4;
                    var goalLine = 750;
                    var order = new Array();
                    var order_i = 0;
             // シーンに「毎フレーム実行イベント」を追加します。
             game.rootScene.addEventListener(Event.ENTER_FRAME, function() {
                if(i>250){
                    maxSpeed = 8;
                };
                if(maru.frame!=0){
                    maru.x += Math.floor(Math.random () * maxSpeed);
                    if(maru.frame==4){maru.frame=5}else{maru.frame=4};
                };
                if(maru.x >=goalLine){maru.frame=0;order[order_i]="イヌのマル";order_i++;};


                if(danpy.frame!=0){
                    danpy.x += Math.floor(Math.random () * maxSpeed);
                    if(danpy.frame==4){danpy.frame=5}else{danpy.frame=4};
                };
                if(danpy.x >=goalLine){danpy.frame=0;order[order_i]="パンダのダンピィ";order_i++;};


                if(rabin.frame!=0){
                    rabin.x += Math.floor(Math.random () * maxSpeed);
                    if(rabin.frame==4){rabin.frame=5}else{rabin.frame=4};
                };
                if(rabin.x >=goalLine){rabin.frame=0;order[order_i]="ウサギのラビン";order_i++;};


                if(sammy.frame!=0){
                    sammy.x += Math.floor(Math.random () * maxSpeed);
                    if(sammy.frame==4){sammy.frame=5}else{sammy.frame=4};
                };
                if(sammy.x >=goalLine){sammy.frame=0;order[order_i]="ハムスターのサミィー";order_i++;};


                if(syldra.frame!=0){
                   syldra.x += Math.floor(Math.random () * maxSpeed);
                   if(syldra.frame==4){syldra.frame=5}else{syldra.frame=4};
               };
               if(syldra.x >=goalLine){syldra.frame=0;order[order_i]="ドラゴンのシルドラ";order_i++;};


               if(piyoliita.frame!=0){
                piyoliita.x += Math.floor(Math.random () * maxSpeed);
                if(piyoliita.frame==4){piyoliita.frame=5}else{piyoliita.frame=4};
            };
            if(piyoliita.x >=goalLine){piyoliita.frame=0;order[order_i]="ヒヨコのピヨリータ";order_i++;};


            if(meruro.frame!=0){
                meruro.x += Math.floor(Math.random () * maxSpeed);
                if(meruro.frame==4){meruro.frame=5}else{meruro.frame=4};
            };
            if(meruro.x >=goalLine){meruro.frame=0;order[order_i]="ヒツジのメルロ";order_i++;};
            if(order_i==6){
                var a = order[3];
            var text = new Label(a);
game.rootScene.addChild(text);}
            i++;
        });

    };

    game.start();
};
