function run() {
    // var image = document.getElementById('background');
    // image.onload = function() {
    //     var engine = new RainyDay({
    //         image: this
    //     });
    //     engine.rain([ [1, 2, 8000] ]);
    //     engine.rain([ [3, 3, 0.88], [5, 5, 0.9], [6, 2, 1] ], 100);
    // };
    // image.crossOrigin = 'anonymous';
    // image.src = 'img/N7ETzFO.jpg';
    var image = document.getElementById('background');
    image.onload = function() {
        var engine = new RainyDay({
            image: this
        });
        engine.rain(
            [
                [1, 0, 20],         // add 20 drops of size 1...
                [3, 3, 1]           // ... and 1 drop of size from 3 - 6 ...
            ],
            100);
    };
                    // ... every 100ms
    image.crossOrigin = 'anonymous';

    image.src = 'img/N7ETzFO.jpg';
}
