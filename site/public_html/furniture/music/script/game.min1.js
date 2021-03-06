var ENGINE = {
    Loader: function (a) {
        this.progress = this.count = this.total = 0;
        this.callbacks = [];
        this.loading = !1;
        this.layer = a;
    },
};
ENGINE.Loader.prototype = {
    add: function () {
        this.loading = !0;
        this.count++;
        this.total++;
        this.layer.clear();
        this.layer
            .fillStyle("rgba(255, 255, 255, 1)")
            .font("bold 42px Arial")
            .fillText("Carregando: " + (this.total - this.count) / this.total + " %", 315, 330);
    },
    image: function (a) {
        var b = this;
        a.addEventListener("load", function () {
            b.onItemReady();
        });
        a.addEventListener("error", function () {
            b.onItemError(this.src);
        });
        this.add();
    },
    audio: function (a) {
        var b = this;
        a.addEventListener("canplaythrough", function () {
            b.onItemReady();
        });
        a.addEventListener("error", function () {
            b.onItemError(this.src);
        });
        this.add();
    },
    foo: function (a) {
        var b = this;
        this.add();
        setTimeout(function () {
            b.onItemReady();
        }, a);
    },
    ready: function (a) {
        this.loading ? this.callbacks.push(a) : a();
    },
    onItemReady: function () {
        this.count--;
        this.progress = (this.total - this.count) / this.total;
        this.layer.clear();
        this.layer
            .fillStyle("rgba(255, 255, 255, 1)")
            .font("bold 42px Arial")
            .fillText("Carregando: " + 100 * this.progress + " %", 320, 320);
        if (0 >= this.count) {
            this.loading = !1;
            for (var a = 0; a < this.callbacks.length; a++) this.callbacks[a]();
            this.callbacks = [];
            this.total = 0;
        }
    },
    onItemError: function (a) {
        console.log("unable to load ", a);
    },
};
ENGINE.Sprites = function (a) {
    this.sprites = { data: [] };
    this.sprites.data.buttons = [
        { filename: "bar-bg.png", frame: { x: 2, y: 2, w: 26, h: 256 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 26, h: 256 }, sourceSize: { w: 26, h: 256 } },
        { filename: "bar.png", frame: { x: 30, y: 2, w: 26, h: 247 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 26, h: 247 }, sourceSize: { w: 26, h: 247 } },
        { filename: "button-e.png", frame: { x: 58, y: 2, w: 23, h: 28 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 23, h: 28 }, sourceSize: { w: 23, h: 28 } },
        { filename: "button-q.png", frame: { x: 83, y: 2, w: 23, h: 28 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 23, h: 28 }, sourceSize: { w: 23, h: 28 } },
        { filename: "button-r.png", frame: { x: 108, y: 2, w: 23, h: 28 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 23, h: 28 }, sourceSize: { w: 23, h: 28 } },
        { filename: "button-w.png", frame: { x: 133, y: 2, w: 23, h: 28 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 23, h: 28 }, sourceSize: { w: 23, h: 28 } },
        { filename: "green-bottom.png", frame: { x: 158, y: 2, w: 92, h: 45 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 92, h: 45 }, sourceSize: { w: 92, h: 45 } },
        { filename: "green-hit.png", frame: { x: 252, y: 2, w: 106, h: 162 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 106, h: 162 }, sourceSize: { w: 106, h: 162 } },
        { filename: "green.png", frame: { x: 360, y: 2, w: 69, h: 67 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 69, h: 67 }, sourceSize: { w: 69, h: 67 } },
        { filename: "instruction.png", frame: { x: 431, y: 2, w: 252, h: 205 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 252, h: 205 }, sourceSize: { w: 252, h: 205 } },
        { filename: "line.png", frame: { x: 2, y: 260, w: 431, h: 499 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 431, h: 499 }, sourceSize: { w: 431, h: 499 } },
        { filename: "orange-bottom.png", frame: { x: 435, y: 260, w: 92, h: 45 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 92, h: 45 }, sourceSize: { w: 92, h: 45 } },
        { filename: "orange-hit.png", frame: { x: 529, y: 260, w: 106, h: 162 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 106, h: 162 }, sourceSize: { w: 106, h: 162 } },
        { filename: "orange.png", frame: { x: 637, y: 260, w: 69, h: 67 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 69, h: 67 }, sourceSize: { w: 69, h: 67 } },
        { filename: "pts.png", frame: { x: 708, y: 260, w: 262, h: 51 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 262, h: 51 }, sourceSize: { w: 262, h: 51 } },
        { filename: "purple-bottom.png", frame: { x: 2, y: 761, w: 92, h: 45 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 92, h: 45 }, sourceSize: { w: 92, h: 45 } },
        { filename: "purple-hit.png", frame: { x: 96, y: 761, w: 106, h: 162 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 106, h: 162 }, sourceSize: { w: 106, h: 162 } },
        { filename: "purple.png", frame: { x: 204, y: 761, w: 69, h: 67 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 69, h: 67 }, sourceSize: { w: 69, h: 67 } },
        { filename: "ready.png", frame: { x: 275, y: 761, w: 118, h: 151 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 118, h: 151 }, sourceSize: { w: 118, h: 151 } },
        { filename: "red-bottom.png", frame: { x: 395, y: 761, w: 92, h: 45 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 92, h: 45 }, sourceSize: { w: 92, h: 45 } },
        { filename: "red-hit.png", frame: { x: 489, y: 761, w: 106, h: 162 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 106, h: 162 }, sourceSize: { w: 106, h: 162 } },
        { filename: "red.png", frame: { x: 597, y: 761, w: 69, h: 67 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 69, h: 67 }, sourceSize: { w: 69, h: 67 } },
        { filename: "restart.png", frame: { x: 668, y: 761, w: 175, h: 52 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 175, h: 52 }, sourceSize: { w: 175, h: 52 } },
        { filename: "star.png", frame: { x: 845, y: 761, w: 14, h: 14 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 14, h: 14 }, sourceSize: { w: 14, h: 14 } },
        { filename: "start.png", frame: { x: 2, y: 925, w: 175, h: 61 }, rotated: !1, trimmed: !1, spriteSourceSize: { x: 0, y: 0, w: 175, h: 61 }, sourceSize: { w: 175, h: 61 } },
    ];
};
ENGINE.Sprites.prototype = {
    fetch: function (a) {
        return this.sprites.data[a];
    },
};
ENGINE.Assets = function (a) {
    this.loader = a;
    this.paths = { images: "/furniture/music/assets/images/", audio: "/furniture/music/assets/audio/" };
    this.data = { images: [], sprites: [], audio: [] };
};
ENGINE.Assets.prototype = {
    image: function (a) {
        return this.data.images[a];
    },
    audio: function (a) {
        return this.data.audio[a];
    },
    sprite: function (a) {
        return { image: this.data.images[a], data: this.data.sprites[a] };
    },
    addImages: function (a) {
        for (var b = 0; b < a.length; b++) this.addImage(a[b]);
    },
    addSprites: function (a, b) {
        this.addImage(a);
        for (var c = 0; c < b.length; c++) this.addSprite(b[c], a);
    },
    addImage: function (a) {
        var b = new Image();
        this.loader.image(b);
        var c = a.match(/(.*)\..*/)[1];
        this.data.images[c] = b;
        b.src = this.paths.images + a;
    },
    addSprite: function (a, b) {
        var c = {},
            d = a.filename.match(/(.*)\..*/)[1];
        c.frame = a.frame;
        c.image = b.match(/(.*)\..*/)[1];
        c.rotated = a.rotated;
        this.data.sprites[d] = c;
    },
    addAudio: function (a) {
        var b = new Audio();
        this.loader.audio(b);
        var c = a.match(/(.*)\..*/)[1];
        this.data.audio[c] = b;
        b.src = this.paths.audio + a;
    },
};
ENGINE.Application = function (a) {
    var b = this;
    _.extend(this, a);
    this.layer = cq(632, 660);
    this.loader = new ENGINE.Loader(this.layer);
    this.sprites = new ENGINE.Sprites();
    this.assets = new ENGINE.Assets(this.loader);
    eveline(this);
    this.layer.appendTo("body");
    this.oncreate();
    this.loader.ready(function () {
        b.onready();
    });
};
ENGINE.Application.prototype = {
    dispatch: function (a) {
        this.scene && this.scene[arguments[0]] && this.scene[arguments[0]].apply(this.scene, Array.prototype.slice.call(arguments, 1));
    },
    selectScene: function (a) {
        this.dispatch("onleave");
        this.scene = a;
        this.dispatch("onenter");
    },
    onstep: function (a) {
        this.dispatch("onstep", a);
    },
    onrender: function (a) {
        this.dispatch("onrender", a);
    },
    onkeydown: function (a) {
        this.dispatch("onkeydown", a);
    },
    onmousedown: function (a, b) {
        this.dispatch("onmousedown", a, b);
    },
};
ENGINE.Scene = function (a) {
    _.extend(this, a);
    if (this.oncreate) this.oncreate();
};
ENGINE.Scene.prototype = { onenter: function () {}, onleave: function () {}, onrender: function () {}, onstep: function () {} };
ENGINE.Collection = function (a) {
    this.parent = a;
    this.index = 0;
    this.dirty = !1;
};
ENGINE.Collection.prototype = [];
_.extend(ENGINE.Collection.prototype, {
    add: function (a, b) {
        var c = new a(_.extend({ collection: this, index: this.index++ }, b));
        this.push(c);
        return c;
    },
    clean: function () {
        for (var a = 0, b = this.length; a < b; a++) this[a]._remove && (this.splice(a--, 1), b--);
    },
    wipe: function () {
        for (var a = 0, b = this.length; a < b; a++) this.splice(a--, 1), b--;
    },
    step: function (a) {
        this.dirty &&
            ((this.dirty = !1),
            this.clean(),
            this.sort(function (a, c) {
                return (a.zIndex | 0) - (c.zIndex | 0);
            }));
    },
    call: function (a) {
        for (var b = Array.prototype.slice.call(arguments, 1), c = 0, d = this.length; c < d; c++) this[c][a] && this[c][a].apply(this[c], b);
    },
    apply: function (a, b) {
        for (var c = 0, d = this.length; c < d; c++) this[c][a] && this[c][a].apply(this[c], b);
    },
});
ENGINE.List = function (a) {
    _.extend(
        this,
        {
            song: "1000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0100 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0100 0000 0000 0000 0000 1000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0100 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0100 0000 0000 0000 0000 1000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0100 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0100 0000 0000 0000 0000 1000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0100 0000 1000 0000 0000 0000 0010 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0000 0001 0000 0000 0000 0010 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0100 0000 0000 0000 0010 0000 0000 0100 0000 0000 0000 0000 1000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0000 0000 0000 0000 0100 0000 0010 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0100 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0000 0000 0000 0000 0100 0000 0010 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0010 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0100 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0001 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 1000 0000 0000 0000 0100 0000 0000 0000 0100 0000 0000 0000".split(
                " "
            ),
            bar: 0,
            lastBarUsed: 0,
        },
        a
    );
};
ENGINE.List.prototype = {
    barUsed: function (a) {
        this.lastBarUsed = a;
    },
    nextBar: function () {
        this.bar += 1;
    },
    getNotes: function (a) {
        if (a <= this.song.length) return this.song[a];
    },
    reset: function () {
        this.bar = this.lastBarUsed = 0;
    },
};
var app = new ENGINE.Application({
    width: 632,
    height: 660,
    oncreate: function () {
        this.assets.addSprites("sprites.png", this.sprites.fetch("buttons"));
        this.assets.addImage("bg.jpg");
        this.assets.addImage("logo.png");
        this.assets.addAudio("ratatat.mp3");
    },
    onready: function () {
        this.layer.drawImage(this.assets.image("bg"), 0, 0);
        this.selectScene(this.intro);
    },
});
ENGINE.Button = function (a) {
    _.extend(this, { x: 0, y: 0, image: app.assets.image("sprites"), map: app.assets.sprite("green").data, speed: 3 }, a);
};
ENGINE.Button.prototype = {
    step: function (a) {
        this.y += (a / 4) * 1;
        this.y > app.height + 30 && (this.remove(), this.chain.miss());
    },
    render: function (a) {
        app.layer
            .save()
            .translate(this.x, this.y)
            .drawImage(this.image, this.map.frame.x, this.map.frame.y, this.map.frame.w, this.map.frame.h, -this.map.frame.w / 2, -this.map.frame.h / 2, this.map.frame.w, this.map.frame.h)
            .restore();
    },
    remove: function () {
        this._remove = !0;
        this.collection.dirty = !0;
    },
};
ENGINE.ControlButton = function (a) {
    _.extend(this, { moved: !1, oldY: 0, opacity: 0, fadeout: !1 }, a);
};
ENGINE.ControlButton.prototype = new ENGINE.Button();
ENGINE.ControlButton.prototype.constructor = ENGINE.ControlButton;
_.extend(ENGINE.ControlButton.prototype, {
    step: function (a) {
        this.moved && this.y > this.oldY ? (this.y -= 5) : (this.moved = !1);
        1 > this.opacity && !this.fadeout ? (this.opacity += 0.1) : this.fadeout && 0.05 < this.opacity && (this.opacity -= 0.05);
    },
    bounce: function () {
        this.moved || ((this.oldY = this.y), (this.y += 10), (this.moved = !this.moved));
    },
    render: function (a) {
        app.layer
            .save()
            .globalAlpha(this.opacity)
            .translate(this.x, this.y)
            .drawImage(this.image, this.map.frame.x, this.map.frame.y, this.map.frame.w, this.map.frame.h, -this.map.frame.w / 2, -this.map.frame.h / 2, this.map.frame.w, this.map.frame.h)
            .restore();
    },
});
ENGINE.Static = function (a) {
    _.extend(this, { x: app.width / 2, y: app.height / 2, opacity: 1, image: app.assets.image("sprites"), map: app.assets.sprite("start").data, offset: 0, fadein: !1, fadeout: !1, onlytext: !1 }, a);
};
ENGINE.Static.prototype = {
    step: function (a) {
        1 > this.opacity && this.fadein ? ((this.opacity += 0.01), (this.offset -= this.offset * this.opacity)) : 0.01 < this.opacity && this.fadeout && ((this.opacity -= 0.01), (this.offset -= 2));
        this.onlytext && (this.width = app.layer.fillStyle("#fff").font("bold 20px Arial").measureText(this.text).width);
    },
    render: function (a) {
        this.onlytext
            ? app.layer
                  .fillStyle("rgba(255, 255, 255, " + this.opacity + ")")
                  .font("bold 20px Arial")
                  .fillText(this.text, app.width / 2 - this.width / 2, this.y + 14 - this.offset)
            : (app.layer
                  .save()
                  .globalAlpha(this.opacity)
                  .translate(this.x, this.y - this.offset)
                  .drawImage(this.image, this.map.frame.x, this.map.frame.y, this.map.frame.w, this.map.frame.h, -this.map.frame.w / 2, -this.map.frame.h / 2, this.map.frame.w, this.map.frame.h)
                  .restore(),
              this.text &&
                  app.layer
                      .fillStyle("rgba(255, 255, 255, " + this.opacity + ")")
                      .font("bold 40px Arial")
                      .fillText(this.text, app.width / 2 - 12, this.y + 30));
    },
};
ENGINE.HitButton = function (a) {
    _.extend(this, { alpha: 0 }, a);
};
ENGINE.HitButton.prototype = new ENGINE.Button();
ENGINE.HitButton.prototype.constructor = ENGINE.HitButton;
_.extend(ENGINE.HitButton.prototype, {
    step: function (a) {
        0.1 < this.alpha && (this.alpha -= 0.1);
    },
    render: function (a) {
        app.layer
            .save()
            .globalAlpha(this.alpha)
            .translate(this.x - 5, this.y - 40)
            .drawImage(this.image, this.map.frame.x, this.map.frame.y, this.map.frame.w, this.map.frame.h, -this.map.frame.w / 2, -this.map.frame.h / 2, this.map.frame.w, this.map.frame.h)
            .restore();
    },
    makeVisible: function () {
        this.alpha = 1;
    },
});
ENGINE.Score = function (a) {
    _.extend(this, { x: app.width / 2, y: 103, score: 0, width: 0, image: app.assets.image("sprites"), offset: 50, opacity: 0, fadeout: !1 }, a);
};
ENGINE.Score.prototype = {
    step: function (a) {
        this.width = app.layer.fillStyle("#fff").font("bold 42px Arial").measureText(this.score).width;
        1 > this.opacity && !1 == this.fadeout ? ((this.opacity += 0.01), (this.offset -= this.offset * this.opacity)) : 0 < this.offset && (this.offset -= 5);
    },
    render: function (a) {
        app.layer
            .save()
            .translate(this.x, this.y - this.offset)
            .globalAlpha(this.opacity)
            .drawImage(this.image, this.map.frame.x, this.map.frame.y, this.map.frame.w, this.map.frame.h, -this.map.frame.w / 2, -this.map.frame.h / 2, this.map.frame.w, this.map.frame.h)
            .restore();
        app.layer
            .fillStyle("rgba(255, 255, 255, " + this.opacity + ")")
            .font("bold 42px Arial")
            .fillText(this.score, app.width / 2 - this.width / 2, this.y + 14 - this.offset);
    },
    increase: function (a) {
        this.score += 1 * a;
    },
};
ENGINE.Chain = function (a) {
    _.extend(
        this,
        {
            x: 561,
            y: 236,
            image: app.assets.image("sprites"),
            mapbg: app.assets.sprite("bar-bg").data,
            fill: app.assets.sprite("bar").data,
            star: app.assets.sprite("star").data,
            multiplier: 1,
            combo: 0,
            offset: 50,
            opacity: 0,
            fadeout: !1,
        },
        a
    );
};
ENGINE.Chain.prototype = {
    increase: function () {
        this.combo += 1;
        0 == this.combo % 10 && 0 < this.combo && (this.multiplier += 1);
    },
    miss: function () {
        this.multiplier = 1;
        this.combo = 0;
    },
    step: function (a) {
        this.width = app.layer.fillStyle("#fff").font("bold 20px Arial").measureText(this.score).width;
        1 > this.opacity && !this.fadeout ? ((this.opacity += 0.01), (this.offset -= this.offset * this.opacity)) : 0.05 < this.opacity && this.fadeout && (this.opacity -= 0.05);
    },
    render: function (a) {
        app.layer
            .save()
            .globalAlpha(this.opacity)
            .drawImage(this.image, this.mapbg.frame.x, this.mapbg.frame.y, this.mapbg.frame.w, this.mapbg.frame.h, this.x + this.offset, this.y, this.mapbg.frame.w, this.mapbg.frame.h)
            .restore();
        app.layer
            .save()
            .globalAlpha(this.opacity)
            .drawImage(
                this.image,
                this.fill.frame.x,
                this.fill.frame.y + this.fill.frame.h - (this.fill.frame.h / 10) * ((this.combo % 10) + 1),
                this.fill.frame.w,
                (this.fill.frame.h / 10) * ((this.combo % 10) + 1),
                this.x + this.offset,
                this.y + 12 + this.fill.frame.h - (this.fill.frame.h / 10) * ((this.combo % 10) + 1),
                this.fill.frame.w,
                (this.fill.frame.h / 10) * ((this.combo % 10) + 1)
            )
            .restore();
        app.layer
            .save()
            .globalAlpha(this.opacity)
            .drawImage(this.image, this.star.frame.x, this.star.frame.y, this.star.frame.w, this.star.frame.h, this.x - 5 + this.offset, this.y + this.mapbg.frame.h + 20, this.star.frame.w, this.star.frame.h)
            .restore();
        app.layer
            .fillStyle("rgba(255, 255, 255, " + this.opacity + ")")
            .font("bold 20px Arial")
            .fillText(this.multiplier, this.x + this.offset + 20, this.y + this.mapbg.frame.h + 35);
    },
};
app.intro = new ENGINE.Scene({
    oncreate: function () {
        this.entities = new ENGINE.Collection(this);
    },
    onenter: function () {
        this.startButton = this.entities.add(ENGINE.Static);
    },
    onrender: function (a) {
        app.layer.clear();
        app.layer.drawImage(app.assets.image("bg"), 0, 0);
        this.entities.call("render", a);
        app.layer.drawImage(app.assets.image("logo"), 42, 18);
    },
    onmousedown: function (a, b, c) {
        a > this.startButton.x - this.startButton.map.frame.w / 2 &&
            a < this.startButton.x + this.startButton.map.frame.w / 2 &&
            b > this.startButton.y - this.startButton.map.frame.h / 2 &&
            b < this.startButton.y + this.startButton.map.frame.h / 2 &&
            app.selectScene(app.game);
    },
    onleave: function () {
        this.entities.wipe();
    },
});
app.game = new ENGINE.Scene({
    oncreate: function () {
        this.entities = new ENGINE.Collection(this);
        this.notes = new ENGINE.Collection(this);
        this.list = new ENGINE.List();
    },
    onenter: function () {
        var a = this;
        this.music = app.assets.audio("ratatat");
        this.music.play();
        this.score = this.entities.add(ENGINE.Score, { map: app.assets.sprite("pts").data });
        this.entities.add(ENGINE.Static, { map: app.assets.sprite("line").data, offset: 20, opacity: 0, y: 400, offset: 20, fadein: !0 });
        this.instruction = this.entities.add(ENGINE.Static, { map: app.assets.sprite("instruction").data, fadein: !0, opacity: 0, offset: 10 });
        this.timer = this.entities.add(ENGINE.Static, { map: app.assets.sprite("ready").data, opacity: 0, text: "3" });
        this.delayfunction(this.instruction, { fadein: !1, fadeout: !0, y: app.height / 2 + 200, offset: 200 }, 7e3);
        for (var b = 0; 4 > b; b++) 3 != b ? this.delayfunction(this.timer, { opacity: 1, text: 3 - b }, 8200 + 1e3 * b) : this.delayfunction(this.timer, { opacity: 0 }, 8200 + 1e3 * b);
        this.chain = this.entities.add(ENGINE.Chain);
        a.orangeControl = this.createControlButton(163, 615, a.getColor(0));
        a.greenControl = this.createControlButton(263, 615, a.getColor(1));
        a.redControl = this.createControlButton(363, 615, a.getColor(2));
        a.purpleControl = this.createControlButton(463, 615, a.getColor(3));
        for (var c = ["q", "w", "e", "r"], b = 0; 4 > b; b++) this.entities.add(ENGINE.Static, { map: app.assets.sprite("button-" + c[b]).data, opacity: 0, x: 160 + 100 * b, y: 640, fadein: !0 });
        setTimeout(function () {
            a.createNote();
        }, 11500);
    },
    delayfunction: function (a, b, c) {
        setTimeout(function () {
            _.extend(a, b);
        }, c);
    },
    createControlButton: function (a, b, c) {
        return this.entities.add(ENGINE.ControlButton, { x: a, y: b, map: app.assets.sprite(c + "-bottom").data, color: c, hit: this.entities.add(ENGINE.HitButton, { x: a, y: b, map: app.assets.sprite(c + "-hit").data }) });
    },
    checkPress: function (a) {
        a.bounce();
        for (var b = 0; 3 > b; b++)
            this.notes[b] && 570 < this.notes[b].y && 620 > this.notes[b].y && this.notes[b].color == a.color && (a.hit.makeVisible(), this.notes[b].remove(), this.score.increase(this.chain.multiplier), this.chain.increase());
    },
    createNote: function () {
        if (this.list.bar < this.list.song.length) {
            var a = this.list.getNotes(this.list.bar).split("");
            for (n = 0; 4 > n; n++)
                1 == a[n] &&
                    (this.notes.add(ENGINE.Button, { x: 159 + 100 * n, y: -15 * (this.list.bar - this.list.lastBarUsed), map: app.assets.sprite(this.getColor(n)).data, color: this.getColor(n), chain: this.chain }),
                    this.list.barUsed(this.list.bar));
            this.list.nextBar();
        } else _.last(this.notes).y >= app.height && app.selectScene(app.results);
    },
    getColor: function (a) {
        var b;
        switch (a) {
            case 0:
                b = "orange";
                break;
            case 1:
                b = "green";
                break;
            case 2:
                b = "red";
                break;
            case 3:
                b = "purple";
        }
        return b;
    },
    onstep: function (a) {
        0 < this.notes.length && 0 < _.last(this.notes).y ? this.createNote() : this.list.bar == this.list.song.length && 0 == this.notes.length && app.selectScene(app.results);
        this.entities.step(a);
        this.notes.step(a);
        this.entities.call("step", a);
        this.notes.call("step", a);
    },
    onrender: function (a) {
        app.layer.clear();
        app.layer.drawImage(app.assets.image("bg"), 0, 0);
        this.entities.call("render", a);
        this.notes.call("render", a);
        app.layer.drawImage(app.assets.image("logo"), 42, 18);
    },
    onkeydown: function (a) {
        "q" == a && this.checkPress(this.orangeControl);
        "w" == a && this.checkPress(this.greenControl);
        "e" == a && this.checkPress(this.redControl);
        "r" == a && this.checkPress(this.purpleControl);
    },
    onleave: function () {
        app.score = this.score.score;
        this.music.pause();
        this.music.currentTime = 0;
        this.list.reset();
        this.entities.wipe();
        this.notes.wipe();
    },
});
app.results = new ENGINE.Scene({
    oncreate: function () {
        this.entities = new ENGINE.Collection(this);
    },
    onenter: function () {
        this.entities.add(ENGINE.Static, { x: app.width / 2, y: 265, text: "Seu Resultado foi:", onlytext: !0, opacity: 0, offset: 60, fadein: !0 });
        this.entities.add(ENGINE.Chain, { opacity: 1, offset: 0, fadeout: !0 });
        this.score = this.entities.add(ENGINE.Score, { map: app.assets.sprite("pts").data, offset: 190, y: 323, opacity: 1, score: app.score });
        for (var a = ["orange", "green", "red", "purple"], b = 0; 4 > b; b++) this.entities.add(ENGINE.ControlButton, { x: 100 * b + 163, y: 615, map: app.assets.sprite(a[b] + "-bottom").data, color: a[b], fadeout: !0, opacity: 1 });
        a = ["q", "w", "e", "r"];
        for (b = 0; 4 > b; b++) this.entities.add(ENGINE.Static, { map: app.assets.sprite("button-" + a[b]).data, x: 160 + 100 * b, y: 640, fadeout: !0 });
        this.restartButton = this.entities.add(ENGINE.Static, { map: app.assets.sprite("restart").data, fadein: !0, opacity: 0, offset: 20, y: app.height / 2 + 65 });
    },
    onstep: function (a) {
        this.entities.step(a);
        this.entities.call("step", a);
    },
    onrender: function (a) {
        app.layer.clear();
        app.layer.drawImage(app.assets.image("bg"), 0, 0);
        this.entities.call("render", a);
        app.layer.drawImage(app.assets.image("logo"), 42, 18);
    },
    onmousedown: function (a, b, c) {
        a > this.restartButton.x - this.restartButton.map.frame.w / 2 &&
            a < this.restartButton.x + this.restartButton.map.frame.w / 2 &&
            b > this.restartButton.y - this.restartButton.map.frame.h / 2 &&
            b < this.restartButton.y + this.restartButton.map.frame.h / 2 &&
            app.selectScene(app.game);
    },
    onleave: function () {
        this.entities.wipe();
    },
});
