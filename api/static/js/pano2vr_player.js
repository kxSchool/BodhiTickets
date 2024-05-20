//////////////////////////////////////////////////////////////////////
// Pano2VR 5.2.3/15990 HTML5/CSS3 & WebGL Panorama Player           //
// Trial License: For evaluation only!                              //
// (c) 2017, Garden Gnome Software, http://ggnome.com               //
//////////////////////////////////////////////////////////////////////

function G() {
    var m = "perspective", k = ["Webkit", "Moz", "O", "ms", "Ms"], g;
    for (g = 0; g < k.length; g++)
        "undefined" !== typeof document.documentElement.style[k[g] + "Perspective"] && (m = k[g] + "Perspective");
    "undefined" !== typeof document.documentElement.style[m] ? "webkitPerspective"in document.documentElement.style ? (m = document.createElement("style"),
    k = document.createElement("div"),
    g = document.head || document.getElementsByTagName("head")[0],
    m.textContent = "@media (-webkit-transform-3d) {#ggswhtml5{height:5px}}",
    g.appendChild(m),
    k.id = "ggswhtml5",
    document.documentElement.appendChild(k),
    g = 5 === k.offsetHeight,
    m.parentNode.removeChild(m),
    k.parentNode.removeChild(k)) : g = !0 : g = !1;
    return g
}
function N() {
    var m;
    if (m = !!window.WebGLRenderingContext)
        try {
            var k = document.createElement("canvas");
            k.width = 100;
            k.height = 100;
            var g = k.getContext("webgl");
            g || (g = k.getContext("experimental-webgl"));
            m = !!g
        } catch (b) {
            m = !1
        }
    return m
}
var __extends = this && this.__extends || function(m, k) {
    function g() {
        this.constructor = m
    }
    for (var b in k)
        k.hasOwnProperty(b) && (m[b] = k[b]);
    m.prototype = null === k ? Object.create(k) : (g.prototype = k.prototype,
    new g)
}
, ggP2VR;
(function(m) {
    var k = function() {
        function b(a) {
            this.g = null;
            this.Ef = this.fk = this.yb = !1;
            this.mb = this.Da = this.va = 0;
            this.f = 70;
            this.Sa = 0;
            this.autoplay = this.Hf = !1;
            this.id = "";
            this.j = this.pan = 0;
            this.g = a;
            this.Tc = this.Ac = 100;
            this.ld = 1
        }
        b.prototype.Db = function(a) {
            var d;
            if (d = a.getAttributeNode("id"))
                this.id = d.nodeValue.toString();
            if (d = a.getAttributeNode("pan"))
                this.pan = Number(d.nodeValue);
            if (d = a.getAttributeNode("tilt"))
                this.j = Number(d.nodeValue)
        }
        ;
        b.prototype.Al = function(a) {
            var d = ""
              , c = this.g
              , b = !0;
            if (c.Lf) {
                var f = new m.ra(0,0,-100);
                f.va(-this.j * Math.PI / 180);
                f.Da(this.pan * Math.PI / 180);
                f.Da(-c.pan.c * Math.PI / 180);
                f.va(c.j.c * Math.PI / 180);
                f.mb(c.N.c * Math.PI / 180);
                .01 <= f.z && (b = !1)
            }
            c.sc && (d += "perspective(" + a + "px) ");
            d = d + ("translate3d(0px,0px," + a + "px) ") + ("rotateZ(" + c.N.c.toFixed(10) + "deg) ");
            d += "rotateX(" + c.j.c.toFixed(10) + "deg) ";
            d += "rotateY(" + (-c.pan.c).toFixed(10) + "deg) ";
            d += "rotateY(" + this.pan.toFixed(10) + "deg) ";
            d += "rotateX(" + (-this.j).toFixed(10) + "deg) ";
            a = 1E4;
            var f = this.a.videoWidth
              , l = this.a.videoHeight;
            if (0 == f || 0 == l)
                f = 640,
                l = 480;
            0 < this.Ac && (f = this.Ac);
            0 < this.Tc && (l = this.Tc);
            0 < f && 0 < l && (this.a.width = f,
            this.a.height = l,
            this.a.style.width = f + "px",
            this.a.style.height = l + "px");
            0 < this.f && (a = f / (2 * Math.tan(this.f / 2 * Math.PI / 180)));
            d += "translate3d(0px,0px," + (-a).toFixed(10) + "px) ";
            d += "rotateZ(" + this.mb.toFixed(10) + "deg) ";
            d += "rotateY(" + (-this.Da).toFixed(10) + "deg) ";
            d += "rotateX(" + this.va.toFixed(10) + "deg) ";
            this.ld && 1 != this.ld && (d += "scaleY(" + this.ld + ") ");
            d += "translate3d(" + -f / 2 + "px," + -l / 2 + "px,0px) ";
            this.a.style[c.Va + "Origin"] = "0% 0%";
            this.yb && (d = "",
            1 == this.Sa && (d += "scale(" + Math.min(c.m.width / f, c.m.height / l) + ") "),
            d += "translate3d(" + -f / 2 + "px," + -l / 2 + "px,0px) ");
            this.en != d && (this.en = d,
            this.a.style[c.Va] = d,
            this.a.style.visibility = b ? "visible" : "hidden",
            this.Ef && this.fk == this.yb && (this.a.style[c.Rc] = "all 0s linear 0s"),
            this.fk = this.yb)
        }
        ;
        b.prototype.gl = function() {
            this.a && (this.a.style.visibility = "hidden")
        }
        ;
        b.prototype.we = function() {
            var a = this.g;
            a.Z ? (this.a.style.left = a.m.width / 2 + "px",
            this.a.style.top = a.m.height / 2 + "px") : (this.a.style.left = a.margin.left + a.m.width / 2 + "px",
            this.a.style.top = a.margin.top + a.m.height / 2 + "px")
        }
        ;
        return b
    }();
    m.cp = k;
    var g = function(b) {
        function a(a) {
            b.call(this, a);
            this.Si = this.Qg = this.ef = this.ia = !1;
            this.pf = this.xb = null;
            this.me = this.og = 0;
            this.Bh = this.Ri = this.oe = !1;
            this.url = [];
            this.loop = 0;
            this.level = 1;
            this.xc = 0;
            this.mode = 1;
            this.Mj = 10;
            this.Fh = this.Ab = 0;
            this.ka = 1;
            this.Ic = this.wc = this.vc = this.Hc = 0
        }
        __extends(a, b);
        a.prototype.jl = function() {
            this.ia && this.Bh ? this.Bh = !1 : (!this.ia && this.g.Lf && (this.vd(),
            this.addElement()),
            0 == this.loop ? this.ia ? (this.xb = null,
            this.Lc()) : this.a.play() : 0 < this.Oc ? (this.Oc--,
            this.ia || (this.a.currentTime = 0),
            this.Qg && (this.Sc && 0 == this.Sc.gain.value || 0 == this.mc.gain.value && 0 == this.pc.gain.value && 0 == this.nc.gain.value && 0 == this.oc.gain.value) || (this.ia ? (this.xb = null,
            this.Lc()) : this.a.play())) : this.ia && (this.xb = null,
            this.oe = !1))
        }
        ;
        a.prototype.Rh = function() {
            var a = this.g.Ha;
            a && (this.ia || (this.source = a.createMediaElementSource(this.a)),
            2 == this.mode || 3 == this.mode || 5 == this.mode ? (this.De = a.createChannelSplitter(2),
            this.mc = a.createGain(),
            this.nc = a.createGain(),
            this.oc = a.createGain(),
            this.pc = a.createGain(),
            this.sf = a.createChannelMerger(2),
            this.ia || this.source.connect(this.De),
            this.De.connect(this.mc, 0),
            this.De.connect(this.nc, 0),
            this.De.connect(this.oc, 1),
            this.De.connect(this.pc, 1),
            this.mc.connect(this.sf, 0, 0),
            this.nc.connect(this.sf, 0, 1),
            this.oc.connect(this.sf, 0, 0),
            this.pc.connect(this.sf, 0, 1),
            this.sf.connect(a.destination)) : (this.Sc = a.createGain(),
            this.ia || this.source.connect(this.Sc),
            this.Sc.connect(a.destination)))
        }
        ;
        a.prototype.ig = function() {
            var a = this.g.Ha;
            this.yb || this.Si || (this.mc.gain.setValueAtTime(this.Hc, a.currentTime),
            this.pc.gain.setValueAtTime(this.Ic, a.currentTime),
            this.nc.gain.setValueAtTime(this.vc, a.currentTime),
            this.oc.gain.setValueAtTime(this.wc, a.currentTime))
        }
        ;
        a.prototype.Kh = function() {
            var a = this.g
              , c = this.g.Ha;
            if (this.a || this.ia) {
                var b, f = this.pan - a.pan.c;
                for (b = this.j - a.j.c; -180 > f; )
                    f += 360;
                for (; 180 < f; )
                    f -= 360;
                var l = this.xc
                  , h = this.Mj;
                0 == h && (h = .01);
                0 > h && (h = a.f.c);
                this.Fb || (this.Fb = new m.ra,
                this.Fb.Oj(this.pan, this.j));
                0 != this.mode && 1 != this.mode || !c || this.Sc && this.Sc.gain.setValueAtTime(this.level * a.W * this.ka, c.currentTime);
                if (2 == this.mode && c) {
                    var x = .5 * Math.cos(f * Math.PI / 180) + .5;
                    this.Hc = Math.sqrt(x) * this.ka * this.level * a.W;
                    this.Ic = Math.sqrt(x) * this.ka * this.level * a.W;
                    this.vc = Math.sqrt(1 - x) * this.ka * this.level * a.W;
                    this.wc = Math.sqrt(1 - x) * this.ka * this.level * a.W;
                    this.ig()
                }
                if (3 == this.mode) {
                    0 > f ? f < -this.Ab ? f += this.Ab : f = 0 : f = f > this.Ab ? f - this.Ab : 0;
                    x = this.level;
                    b = Math.abs(b);
                    b = b < this.Fh ? 0 : b - this.Fh;
                    var A = 1 - b / h;
                    if (Math.abs(f) > h || 0 > A) {
                        var g = x * l * a.W;
                        c ? (this.Hc = g * this.ka,
                        this.Ic = g * this.ka,
                        this.wc = this.vc = 0,
                        this.ig()) : this.a.volume = x * l * a.W
                    } else if (g = 1 - Math.abs(f / h),
                    c) {
                        var k = x * (l + (1 - l) * A * g) * a.W
                          , g = x * l * a.W;
                        0 <= f ? (this.Hc = k * this.ka,
                        this.Ic = g * this.ka) : (this.Hc = g * this.ka,
                        this.Ic = k * this.ka);
                        2 * Math.abs(f) < h ? (g = 1 - Math.abs(2 * f) / h,
                        k = x * (l + (1 - l) * A * g) * a.W,
                        g = .5 * x * (1 - l) * A * (1 - g) * a.W,
                        0 <= f ? (this.Ic = k * this.ka,
                        this.wc = g * this.ka,
                        this.vc = 0) : (this.Hc = k * this.ka,
                        this.vc = g * this.ka,
                        this.wc = 0)) : (g = 1 - (Math.abs(2 * f) - h) / h,
                        k = .5 * x * (1 - l) * A * g * a.W,
                        0 <= f ? (this.wc = k * this.ka,
                        this.vc = 0) : (this.vc = k * this.ka,
                        this.wc = 0));
                        this.ig()
                    } else
                        this.a.volume = x * (l + (1 - l) * A * g) * a.W
                }
                4 == this.mode && (Math.abs(f) < this.Ab && Math.abs(b) < this.Fh ? this.ef || (this.ef = !0,
                this.Oc = this.loop - 1,
                this.ia ? this.oe || this.Lc() : this.a.play()) : this.ef = !1);
                5 == this.mode && (b = 180 * Math.acos(a.fi.qh(this.Fb)) / Math.PI,
                b < this.Ab ? c ? (this.Hc = this.level * a.W * this.ka,
                this.Ic = this.level * a.W * this.ka,
                this.wc = this.vc = 0,
                this.ig()) : this.a.volume = this.level * a.W : c ? b < this.Ab + h ? (0 > f ? f = f > -this.Ab ? 0 : f + this.Ab : f = f < this.Ab ? 0 : f - this.Ab,
                k = 1 - Math.max(b - this.Ab, 0) / h,
                g = Math.max(1 - Math.abs(f) * Math.cos(this.j * Math.PI / 180) / h, 0),
                0 < f ? (this.Hc = this.level * (k * (1 - this.xc) + this.xc) * a.W * this.ka,
                this.Ic = this.level * (k * g * (1 - this.xc) + this.xc) * a.W * this.ka,
                this.vc = 0,
                this.wc = this.level * k * (1 - g) * a.W * this.ka) : (this.Hc = this.level * (k * g * (1 - this.xc) + this.xc) * a.W * this.ka,
                this.Ic = this.level * (k * (1 - this.xc) + this.xc) * a.W * this.ka,
                this.vc = this.level * k * (1 - g) * a.W * this.ka,
                this.wc = 0),
                this.ig()) : (k = this.level * this.xc * a.W,
                this.Hc = k * this.ka,
                this.Ic = k * this.ka,
                this.wc = this.vc = 0) : (b -= this.Ab,
                this.a.volume = b < h && 0 < h ? this.level * (l + (1 - l) * (1 - Math.abs(b / h))) * a.W : l * a.W));
                6 == this.mode && (b = 180 * Math.acos(a.fi.qh(this.Fb)) / Math.PI,
                Math.abs(b) < this.Ab ? this.ef || (this.ef = !0,
                this.Oc = this.loop - 1,
                this.ia ? this.oe || this.Lc() : this.a.play()) : this.ef = !1)
            }
        }
        ;
        a.prototype.Cj = function() {
            var a = this;
            a.xb = this.g.Ha.createBufferSource();
            a.xb.addEventListener("ended", function() {
                a.jl()
            }, !1);
            2 == a.mode || 3 == a.mode || 5 == a.mode ? a.xb.connect(a.De) : a.xb.connect(a.Sc)
        }
        ;
        a.prototype.Nn = function(a) {
            var c = this
              , b = this.g.Ha;
            c.Cj();
            this.g.L("createBufferSoundSource()");
            b.decodeAudioData(a, function(a) {
                c.pf = a;
                c.xb.buffer = a;
                c.g.L("audio Data decoded");
                c.Ri && (c.Lc(),
                c.Ri = !1)
            })
        }
        ;
        a.prototype.Lc = function() {
            var a = this.g.Ha
              , c = this.me;
            this.pf ? (null == this.xb && (this.Cj(),
            this.xb.buffer = this.pf),
            this.og = a.currentTime - c,
            this.me = 0,
            this.oe = !0,
            this.Bh = !1,
            this.xb.start(0, c),
            this.g.L("buffer Source started")) : (this.g.L("bufferSoundPlay() -> no audio buffer -> playWhenReady"),
            this.Ri = !0)
        }
        ;
        a.prototype.Yh = function() {
            var a = this.g.Ha.currentTime - this.og;
            this.Ce();
            this.me = a
        }
        ;
        a.prototype.Ce = function() {
            this.xb && this.oe && (this.Bh = !0,
            this.xb.disconnect(),
            this.xb.stop(0),
            this.xb = null);
            this.og = this.me = 0;
            this.oe = !1
        }
        ;
        a.prototype.cm = function() {
            var a = this.g.Ha;
            return this.me ? this.me : this.og ? a.currentTime - this.og : 0
        }
        ;
        a.prototype.dm = function(a) {
            this.Ce();
            this.me = a;
            this.Lc()
        }
        ;
        a.prototype.addElement = function() {
            var a = -1
              , c = this
              , b = this.g
              , f = this.g.Ha;
            try {
                for (var l = !1, h = 0; h < b.S.length; h++)
                    b.S[h].id == c.id && (a = h,
                    null == b.S[h].a && !b.S[h].ia || b.S[h].url.join() != c.url.join() || b.S[h].loop != c.loop || b.S[h].mode != c.mode || (l = !0));
                if (l)
                    b.L("Keep playing " + c.id);
                else {
                    if (0 <= a) {
                        var x = b.S[a];
                        if (null != x.a || x.ia)
                            if (f && b.Ea.enabled)
                                b.Ea.sg.push(x),
                                1 != b.B.Na && 2 != b.B.Na && b.Ea.mi(x);
                            else {
                                try {
                                    x.ia ? x.Yh() : x.a.pause()
                                } catch (g) {
                                    b.L(g)
                                }
                                try {
                                    x.vd()
                                } catch (g) {
                                    b.L(g)
                                }
                            }
                    }
                    if (f && b.Kd && (2 == this.mode || 3 == this.mode || 5 == this.mode)) {
                        if (0 < c.url.length) {
                            c.ia = !0;
                            c.Rh();
                            var A = new XMLHttpRequest;
                            A.open("GET", b.Wb(c.url[0]), !0);
                            A.responseType = "arraybuffer";
                            A.onload = function() {
                                c.Nn(A.response)
                            }
                            ;
                            A.send();
                            c.Qg = !1
                        }
                    } else {
                        c.a = document.createElement("audio");
                        c.a.crossOrigin = b.crossOrigin;
                        c.a.setAttribute("class", "ggmedia");
                        b.Ne && c.a.setAttribute("id", b.Ne + c.id);
                        for (h = 0; h < c.url.length; h++)
                            l = void 0,
                            l = document.createElement("source"),
                            "" != c.url[h] && "#" != c.url[h] && (l.crossOrigin = b.crossOrigin,
                            l.setAttribute("src", b.Wb(c.url[h])),
                            c.a.appendChild(l));
                        c.a.volume = c.level * b.W;
                        0 < c.a.childNodes.length && (b.U.appendChild(c.a),
                        c.a.addEventListener("ended", function() {
                            c.jl()
                        }, !1),
                        f && (c.Rh(),
                        c.Qg = !1,
                        0 == c.loop && c.source.mediaElement && (c.source.mediaElement.loop = !0)))
                    }
                    1 <= c.loop && (c.Oc = c.loop - 1);
                    0 <= a ? b.S[a] = c : b.S.push(c);
                    1 != c.mode && 2 != c.mode && 3 != c.mode && 5 != c.mode || !(0 <= c.loop) || f && b.Ea.enabled || (c.ia || (c.a.autoplay = !0),
                    c.autoplay = !0);
                    0 == c.mode && 0 <= c.loop && (c.autoplay = !0);
                    c.Kh()
                }
            } catch (g) {
                this.g.L(g)
            }
        }
        ;
        a.prototype.vd = function() {
            try {
                this.g.L("Remove Snd:" + this.id),
                this.ia || (this.g.U.removeChild(this.a),
                this.a = null)
            } catch (a) {
                this.g.L(a)
            }
        }
        ;
        a.prototype.Db = function(a) {
            b.prototype.Db.call(this, a);
            var c;
            (c = a.getAttributeNode("url")) && this.url.push(c.nodeValue.toString());
            if (c = a.getAttributeNode("level"))
                this.level = Number(c.nodeValue);
            if (c = a.getAttributeNode("loop"))
                this.loop = Number(c.nodeValue);
            if (c = a.getAttributeNode("mode"))
                this.mode = Number(c.nodeValue);
            if (c = a.getAttributeNode("field"))
                this.Mj = Number(c.nodeValue);
            if (c = a.getAttributeNode("ambientlevel"))
                this.xc = Number(c.nodeValue);
            if (c = a.getAttributeNode("pansize"))
                this.Ab = Number(c.nodeValue);
            if (c = a.getAttributeNode("tiltsize"))
                this.Fh = Number(c.nodeValue);
            for (a = a.firstChild; a; )
                "source" == a.nodeName && (c = a.getAttributeNode("url")) && this.url.push(c.nodeValue.toString()),
                a = a.nextSibling
        }
        ;
        return a
    }(k);
    m.Tl = g;
    g = function(b) {
        function a(a) {
            b.call(this, a);
            this.poster = "";
            this.mb = this.Da = this.va = 0;
            this.f = 50;
            this.Sa = 0;
            this.$c = this.Hf = !1
        }
        __extends(a, b);
        a.prototype.Uc = function() {
            1 != this.Sa && 4 != this.Sa || this.Ff(!this.yb);
            2 == this.Sa && this.g.Ok(this.id)
        }
        ;
        a.prototype.Ff = function(a) {
            var c = this.g
              , b = c.Ha;
            if (1 == this.Sa || 4 == this.Sa)
                if (this.yb = a,
                this.g.wb)
                    (c = c.ha) && c.activateSound(this.id, this.yb ? 1 : 0);
                else {
                    if (this.yb)
                        this.a.play(),
                        this.a.style.zIndex = (c.zg + 8E4).toString(),
                        this.a.style[this.g.Rc] = "all 1s ease 0s",
                        c.ne(this.id);
                    else {
                        this.a.style.zIndex = c.zg.toString();
                        this.a.style[this.g.Rc] = "all 1s ease 0s";
                        this.Si = !0;
                        var f = this;
                        setTimeout(function() {
                            f.Si = !1
                        }, 1E3)
                    }
                    if (b && (2 == this.mode || 3 == this.mode || 5 == this.mode)) {
                        var b = b.currentTime
                          , l = this.mc.gain.value
                          , h = this.pc.gain.value
                          , x = this.nc.gain.value
                          , g = this.oc.gain.value;
                        this.yb ? (this.mc.gain.linearRampToValueAtTime(l, b),
                        this.mc.gain.linearRampToValueAtTime(this.level * c.W, b + 1),
                        this.pc.gain.linearRampToValueAtTime(h, b),
                        this.pc.gain.linearRampToValueAtTime(this.level * c.W, b + 1),
                        this.nc.gain.linearRampToValueAtTime(x, b),
                        this.nc.gain.linearRampToValueAtTime(0, b + 1),
                        this.oc.gain.linearRampToValueAtTime(g, b),
                        this.oc.gain.linearRampToValueAtTime(0, b + 1)) : (this.mc.gain.linearRampToValueAtTime(l, b),
                        this.mc.gain.linearRampToValueAtTime(this.Hc, b + 1),
                        this.pc.gain.linearRampToValueAtTime(h, b),
                        this.pc.gain.linearRampToValueAtTime(this.Ic, b + 1),
                        this.nc.gain.linearRampToValueAtTime(x, b),
                        this.nc.gain.linearRampToValueAtTime(this.vc, b + 1),
                        this.oc.gain.linearRampToValueAtTime(g, b),
                        this.oc.gain.linearRampToValueAtTime(this.wc, b + 1))
                    }
                    this.Ef = !0;
                    this.g.Bl()
                }
            2 == this.Sa && (a ? this.g.ne(this.id) : this.g.Qi(this.id))
        }
        ;
        a.prototype.Gf = function() {
            this.Ef = !1;
            this.a.style[this.g.Rc] = "none"
        }
        ;
        a.prototype.Vo = function() {
            0 == this.loop ? this.a.play() : 0 < this.Oc ? (this.Oc--,
            this.a.currentTime = 0,
            this.a.play()) : this.tk = !1
        }
        ;
        a.prototype.Db = function(a) {
            b.prototype.Db.call(this, a);
            var c;
            if (c = a.getAttributeNode("poster"))
                this.poster = String(c.nodeValue);
            if (c = a.getAttributeNode("rotx"))
                this.va = Number(c.nodeValue);
            if (c = a.getAttributeNode("roty"))
                this.Da = Number(c.nodeValue);
            if (c = a.getAttributeNode("rotz"))
                this.mb = Number(c.nodeValue);
            if (c = a.getAttributeNode("fov"))
                this.f = Number(c.nodeValue);
            if (c = a.getAttributeNode("width"))
                this.Ac = Number(c.nodeValue);
            if (c = a.getAttributeNode("height"))
                this.Tc = Number(c.nodeValue);
            this.ld = (c = a.getAttributeNode("stretch")) ? Number(c.nodeValue) : 1;
            if (c = a.getAttributeNode("clickmode"))
                this.Sa = Number(c.nodeValue);
            if (c = a.getAttributeNode("handcursor"))
                this.Hf = 1 == Number(c.nodeValue)
        }
        ;
        a.prototype.addElement = function() {
            var a = this
              , c = this.g;
            try {
                a.a = document.createElement("video");
                a.a.setAttribute("class", "ggmedia");
                a.a.crossOrigin = c.crossOrigin;
                a.a.hidden = !0;
                c.Ne && a.a.setAttribute("id", c.Ne + a.id);
                if (c.wg)
                    a.a.setAttribute("webkit-playsinline", "webkit-playsinline"),
                    a.a.setAttribute("style", "display: none; max-width:none;");
                else if (a.a.setAttribute("style", "max-width:none;pointer-events:none;"),
                a.a.setAttribute("webkit-playsinline", "webkit-playsinline"),
                1 == a.Sa || 4 == a.Sa)
                    a.a.addEventListener(c.Hl(), function() {
                        a.Gf()
                    }, !1),
                    a.a.addEventListener("transitionend", function() {
                        a.Gf()
                    }, !1);
                var b;
                for (b = 0; b < a.url.length; b++) {
                    var f;
                    f = document.createElement("source");
                    f.crossOrigin = c.crossOrigin;
                    f.setAttribute("src", c.Wb(a.url[b]));
                    a.a.appendChild(f)
                }
                "" != a.poster && (a.a.poster = c.Wb(a.poster),
                0 > a.loop && (a.a.b = "none"));
                a.a.volume = a.level * c.W;
                1 <= a.loop && (a.Oc = a.loop - 1);
                (1 == a.mode || 2 == a.mode || 3 == a.mode || 5 == a.mode) && 0 <= a.loop && (a.a.autoplay = !0,
                a.tk = !0,
                a.autoplay = !0);
                c.J.push(this);
                c.wg ? c.U.appendChild(a.a) : (a.a.style.position = "absolute",
                a.Ac && (a.a.width = a.Ac),
                a.Tc && (a.a.height = a.Tc),
                c.C.appendChild(a.a),
                a.Rh());
                a.a.onclick = function() {
                    a.Uc()
                }
                ;
                a.a.addEventListener("ended", function() {
                    a.Vo()
                }, !1)
            } catch (l) {
                c.L(l)
            }
        }
        ;
        a.prototype.registerElement = function(a, c) {
            this.$c = !0;
            this.a = c;
            this.id = a;
            this.level = 1;
            this.g.J.push(this)
        }
        ;
        a.prototype.vd = function() {
            var a = this.g;
            a.wg && (a.H.deleteTexture(this.hc),
            this.hc = 0,
            a.U.removeChild(this.a));
            a.Cl && a.C.removeChild(this.a);
            this.a = null
        }
        ;
        return a
    }(g);
    m.al = g;
    g = function(b) {
        function a(a) {
            b.call(this, a);
            this.url = "";
            this.mb = this.Da = this.va = 0;
            this.f = 50;
            this.Sa = 0;
            this.Hf = !1;
            this.Tc = this.Ac = 100;
            this.ld = 1
        }
        __extends(a, b);
        a.prototype.Db = function(a) {
            b.prototype.Db.call(this, a);
            var c;
            if (c = a.getAttributeNode("url"))
                this.url = c.nodeValue.toString();
            if (c = a.getAttributeNode("rotx"))
                this.va = Number(c.nodeValue);
            if (c = a.getAttributeNode("roty"))
                this.Da = Number(c.nodeValue);
            if (c = a.getAttributeNode("rotz"))
                this.mb = Number(c.nodeValue);
            if (c = a.getAttributeNode("fov"))
                this.f = Number(c.nodeValue);
            if (c = a.getAttributeNode("width"))
                this.Ac = Number(c.nodeValue);
            if (c = a.getAttributeNode("height"))
                this.Tc = Number(c.nodeValue);
            this.ld = (c = a.getAttributeNode("stretch")) ? Number(c.nodeValue) : 1;
            if (c = a.getAttributeNode("clickmode"))
                this.Sa = Number(c.nodeValue);
            if (c = a.getAttributeNode("handcursor"))
                this.Hf = 1 == Number(c.nodeValue);
            for (a = a.firstChild; a; )
                "source" == a.nodeName && (c = a.getAttributeNode("url")) && (this.url = c.nodeValue.toString()),
                a = a.nextSibling
        }
        ;
        a.prototype.Gf = function() {
            this.Ef = !1;
            this.a.style[this.g.Rc] = "none"
        }
        ;
        a.prototype.Uc = function() {
            1 !== this.Sa && 4 !== this.Sa || this.Ff(!this.yb)
        }
        ;
        a.prototype.Ff = function(a) {
            var c = this.g;
            if (1 === this.Sa || 4 === this.Sa)
                this.yb = a,
                this.g.wb ? (a = this.g.ha) && a.activateSound(this.id, this.yb ? 1 : 0) : (this.a.style.zIndex = this.yb ? (c.zg + 8E4).toString() : c.zg.toString(),
                this.a.style[c.Rc] = "all 1s ease 0s",
                this.Ef = !0,
                c.wl())
        }
        ;
        a.prototype.addElement = function() {
            var a = this
              , c = this.g;
            try {
                a.a = document.createElement("img");
                a.a.setAttribute("style", "-webkit-user-drag:none; max-width:none; pointer-events:none;");
                a.a.setAttribute("class", "ggmedia");
                a.a.hidden = !0;
                c.Ne && a.a.setAttribute("id", c.Ne + a.id);
                a.a.ondragstart = function() {
                    return !1
                }
                ;
                if (1 === a.Sa || 4 === a.Sa)
                    a.a.addEventListener(c.Hl(), function() {
                        a.Gf()
                    }, !1),
                    a.a.addEventListener("transitionend", function() {
                        a.Gf()
                    }, !1);
                a.a.setAttribute("src", c.Wb(a.url));
                a.Ac && (a.a.width = a.Ac);
                a.Tc && (a.a.height = a.Tc);
                c.Xa.push(a);
                a.a.style.position = "absolute";
                a.Uc && (a.a.onclick = function() {
                    a.Uc()
                }
                );
                c.C.appendChild(a.a)
            } catch (b) {
                c.L("Error addimage:" + b)
            }
        }
        ;
        a.prototype.vd = function() {
            this.g.C.removeChild(this.a);
            this.a = null
        }
        ;
        return a
    }(k);
    m.Rl = g;
    k = function(b) {
        function a(a) {
            b.call(this, a);
            this.alpha = this.zj = 50;
            this.type = 0;
            this.color = 16777215
        }
        __extends(a, b);
        a.prototype.Db = function(a) {
            b.prototype.Db.call(this, a);
            var c;
            if (c = a.getAttributeNode("blinding"))
                this.zj = Number(c.nodeValue);
            if (c = a.getAttributeNode("alpha"))
                this.alpha = Number(c.nodeValue);
            if (c = a.getAttributeNode("type"))
                this.type = Number(c.nodeValue);
            if (c = a.getAttributeNode("color"))
                this.color = 1 * Number(c.nodeValue)
        }
        ;
        return a
    }(k);
    m.Sl = k;
    k = function() {
        function b(a) {
            this.type = "empty";
            this.il = this.id = this.target = this.description = this.title = this.url = "";
            this.Nh = 100;
            this.Xg = 20;
            this.Ph = !1;
            this.a = null;
            this.gb = this.na = this.j = this.pan = 0;
            this.Sb = a.w.Sb;
            this.Pb = a.w.Pb;
            this.Rb = a.w.Rb;
            this.Ob = a.w.Ob;
            this.Me = a.w.Me;
            this.xg = []
        }
        b.prototype.Ie = function() {
            this.id = this.id;
            this.pan = this.pan;
            this.tilt = this.j;
            this.url = this.url;
            this.target = this.target;
            this.title = this.title;
            this.description = this.description;
            this.skinid = this.il;
            this.obj = this.a
        }
        ;
        b.prototype.Db = function(a) {
            var d;
            if (d = a.getAttributeNode("url"))
                this.url = d.nodeValue.toString();
            if (d = a.getAttributeNode("target"))
                this.target = d.nodeValue.toString();
            if (d = a.getAttributeNode("title"))
                this.title = d.nodeValue.toString();
            if (d = a.getAttributeNode("description"))
                this.description = d.nodeValue.toString();
            if (d = a.getAttributeNode("id"))
                this.id = d.nodeValue.toString();
            if (d = a.getAttributeNode("skinid"))
                this.il = d.nodeValue.toString();
            if (d = a.getAttributeNode("width"))
                this.Nh = Number(d.nodeValue);
            if (d = a.getAttributeNode("height"))
                this.Xg = Number(d.nodeValue);
            if (d = a.getAttributeNode("wordwrap"))
                this.Ph = 1 == Number(d.nodeValue);
            d = a.getAttributeNode("pan");
            this.pan = 1 * (d ? Number(d.nodeValue) : 0);
            d = a.getAttributeNode("tilt");
            this.j = 1 * (d ? Number(d.nodeValue) : 0);
            if (d = a.getAttributeNode("bordercolor"))
                this.Sb = 1 * Number(d.nodeValue);
            if (d = a.getAttributeNode("backgroundcolor"))
                this.Pb = 1 * Number(d.nodeValue);
            if (d = a.getAttributeNode("borderalpha"))
                this.Rb = 1 * Number(d.nodeValue);
            if (d = a.getAttributeNode("backgroundalpha"))
                this.Ob = 1 * Number(d.nodeValue);
            if (d = a.getAttributeNode("handcursor"))
                this.Me = 1 == Number(d.nodeValue);
            for (a = a.firstChild; a; ) {
                if ("vertex" == a.nodeName) {
                    var c = {
                        pan: 0,
                        j: 0
                    };
                    d = a.getAttributeNode("pan");
                    c.pan = 1 * (d ? Number(d.nodeValue) : 0);
                    d = a.getAttributeNode("tilt");
                    c.j = 1 * (d ? Number(d.nodeValue) : 0);
                    this.xg.push(c)
                }
                a = a.nextSibling
            }
            this.Ie()
        }
        ;
        return b
    }();
    m.dh = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g(b, a) {
            this.x = b;
            this.y = a
        }
        g.prototype.Ya = function(b, a) {
            this.x = b;
            this.y = a
        }
        ;
        g.prototype.nd = function(b, a, d) {
            var c = a.y - b.y;
            this.x = b.x + (a.x - b.x) * d;
            this.y = b.y + c * d
        }
        ;
        g.prototype.bm = function(b, a, d, c, e) {
            var f;
            f = new g;
            f.nd(b, d, e);
            b = new g;
            b.nd(d, c, e);
            d = new g;
            d.nd(c, a, e);
            a = new g;
            a.nd(f, b, e);
            f = new g;
            f.nd(b, d, e);
            b = new g;
            b.nd(a, f, e);
            this.x = b.x;
            this.y = b.y
        }
        ;
        g.prototype.Vh = function(b, a, d, c, e) {
            var f = new g
              , l = .5
              , h = .25;
            do {
                f.bm(b, a, d, c, l);
                var x = f.x - e
                  , l = 0 < x ? l - h : l + h
                  , h = h / 2
            } while (.01 < Math.abs(x));this.x = f.x;
            this.y = f.y
        }
        ;
        return g
    }();
    m.kc = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g(b, a, d, c, e) {
            this.x = b;
            this.y = a;
            this.z = d;
            this.cd = c;
            this.Fb = e
        }
        g.prototype.Ya = function(b, a, d, c, e) {
            this.x = b;
            this.y = a;
            this.z = d;
            this.cd = c;
            this.Fb = e
        }
        ;
        g.prototype.toString = function() {
            return "(" + this.x + "," + this.y + "," + this.z + ") - (" + this.cd + "," + this.Fb + ")"
        }
        ;
        g.prototype.va = function(b) {
            var a = Math.sin(b);
            b = Math.cos(b);
            var d = this.y
              , c = this.z;
            this.y = b * d - a * c;
            this.z = a * d + b * c
        }
        ;
        g.prototype.Sn = function() {
            var b = this.y;
            this.y = -this.z;
            this.z = b
        }
        ;
        g.prototype.Rn = function() {
            var b = this.y;
            this.y = this.z;
            this.z = -b
        }
        ;
        g.prototype.Da = function(b) {
            var a = Math.sin(b);
            b = Math.cos(b);
            var d = this.x
              , c = this.z;
            this.x = b * d + a * c;
            this.z = -a * d + b * c
        }
        ;
        g.prototype.Tn = function() {
            var b = this.x;
            this.x = -this.z;
            this.z = b
        }
        ;
        g.prototype.mb = function(b) {
            var a = Math.sin(b);
            b = Math.cos(b);
            var d = this.x
              , c = this.y;
            this.x = b * d - a * c;
            this.y = a * d + b * c
        }
        ;
        g.prototype.Zk = function() {
            var b = this.x;
            this.x = -this.y;
            this.y = b
        }
        ;
        g.prototype.pe = function(b) {
            return this.va(b * Math.PI / 180)
        }
        ;
        g.prototype.cg = function(b) {
            return this.Da(b * Math.PI / 180)
        }
        ;
        g.prototype.vh = function(b) {
            return this.mb(b * Math.PI / 180)
        }
        ;
        g.prototype.clone = function() {
            return new g(this.x,this.y,this.z,this.cd,this.Fb)
        }
        ;
        g.prototype.length = function() {
            return Math.sqrt(this.x * this.x + this.y * this.y + this.z * this.z)
        }
        ;
        g.prototype.normalize = function() {
            var b = this.length();
            0 < b && (b = 1 / b,
            this.x *= b,
            this.y *= b,
            this.z *= b)
        }
        ;
        g.prototype.qh = function(b) {
            return this.x * b.x + this.y * b.y + this.z * b.z
        }
        ;
        g.prototype.Oj = function(b, a) {
            var d;
            d = Math.cos(a * Math.PI / 180);
            this.x = d * Math.sin(b * Math.PI / 180);
            this.y = Math.sin(a * Math.PI / 180);
            this.z = d * Math.cos(b * Math.PI / 180)
        }
        ;
        g.prototype.Yl = function() {
            return 180 * Math.atan2(-this.x, -this.z) / Math.PI
        }
        ;
        g.prototype.Zl = function() {
            return 180 * Math.asin(this.y / this.length()) / Math.PI
        }
        ;
        g.prototype.nd = function(b, a, d) {
            this.x = b.x * d + a.x * (1 - d);
            this.y = b.y * d + a.y * (1 - d);
            this.z = b.z * d + a.z * (1 - d);
            this.cd = b.cd * d + a.cd * (1 - d);
            this.Fb = b.Fb * d + a.Fb * (1 - d)
        }
        ;
        return g
    }();
    m.ra = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g() {
            this.cl()
        }
        g.prototype.cl = function() {
            this.Xb = 1;
            this.$b = this.Zb = this.Yb = 0;
            this.ac = 1;
            this.dc = this.cc = this.bc = 0;
            this.ec = 1
        }
        ;
        g.prototype.clone = function(b) {
            this.Xb = b.Xb;
            this.Yb = b.Yb;
            this.Zb = b.Zb;
            this.$b = b.$b;
            this.ac = b.ac;
            this.bc = b.bc;
            this.cc = b.cc;
            this.dc = b.dc;
            this.ec = b.ec
        }
        ;
        g.prototype.io = function(b) {
            var a = Math.cos(b);
            b = Math.sin(b);
            this.Xb = 1;
            this.$b = this.Zb = this.Yb = 0;
            this.ac = a;
            this.bc = -b;
            this.cc = 0;
            this.dc = b;
            this.ec = a
        }
        ;
        g.prototype.jo = function(b) {
            var a = Math.cos(b);
            b = Math.sin(b);
            this.Xb = a;
            this.Yb = 0;
            this.Zb = b;
            this.$b = 0;
            this.ac = 1;
            this.bc = 0;
            this.cc = -b;
            this.dc = 0;
            this.ec = a
        }
        ;
        g.prototype.ko = function(b) {
            var a = Math.cos(b);
            b = Math.sin(b);
            this.Xb = a;
            this.Yb = -b;
            this.Zb = 0;
            this.$b = b;
            this.ac = a;
            this.dc = this.cc = this.bc = 0;
            this.ec = 1
        }
        ;
        g.prototype.eo = function(b) {
            this.io(b * Math.PI / 180)
        }
        ;
        g.prototype.fo = function(b) {
            this.jo(b * Math.PI / 180)
        }
        ;
        g.prototype.ho = function(b) {
            this.ko(b * Math.PI / 180)
        }
        ;
        g.prototype.pe = function(b) {
            this.Ec || (this.Ec = new g,
            this.Ld = new g);
            this.Ec.eo(b);
            this.Ld.clone(this);
            this.multiply(this.Ec, this.Ld)
        }
        ;
        g.prototype.cg = function(b) {
            this.Ec || (this.Ec = new g,
            this.Ld = new g);
            this.Ec.fo(b);
            this.Ld.clone(this);
            this.multiply(this.Ec, this.Ld)
        }
        ;
        g.prototype.vh = function(b) {
            this.Ec || (this.Ec = new g,
            this.Ld = new g);
            this.Ec.ho(b);
            this.Ld.clone(this);
            this.multiply(this.Ec, this.Ld)
        }
        ;
        g.prototype.multiply = function(b, a) {
            this.Xb = b.Xb * a.Xb + b.Yb * a.$b + b.Zb * a.cc;
            this.Yb = b.Xb * a.Yb + b.Yb * a.ac + b.Zb * a.dc;
            this.Zb = b.Xb * a.Zb + b.Yb * a.bc + b.Zb * a.ec;
            this.$b = b.$b * a.Xb + b.ac * a.$b + b.bc * a.cc;
            this.ac = b.$b * a.Yb + b.ac * a.ac + b.bc * a.dc;
            this.bc = b.$b * a.Zb + b.ac * a.bc + b.bc * a.ec;
            this.cc = b.cc * a.Xb + b.dc * a.$b + b.ec * a.cc;
            this.dc = b.cc * a.Yb + b.dc * a.ac + b.ec * a.dc;
            this.ec = b.cc * a.Zb + b.dc * a.bc + b.ec * a.ec
        }
        ;
        g.prototype.vn = function(b) {
            var a, d, c;
            a = b.x;
            d = b.y;
            c = b.z;
            b.x = a * this.Xb + d * this.Yb + c * this.Zb;
            b.y = a * this.$b + d * this.ac + c * this.bc;
            b.z = a * this.cc + d * this.dc + c * this.ec
        }
        ;
        return g
    }();
    m.Ml = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    m.T = {
        create: function(k) {
            var g;
            "undefined" != typeof Float32Array ? g = new Float32Array(16) : g = Array(16);
            k && (g[0] = k[0],
            g[1] = k[1],
            g[2] = k[2],
            g[3] = k[3],
            g[4] = k[4],
            g[5] = k[5],
            g[6] = k[6],
            g[7] = k[7],
            g[8] = k[8],
            g[9] = k[9],
            g[10] = k[10],
            g[11] = k[11],
            g[12] = k[12],
            g[13] = k[13],
            g[14] = k[14],
            g[15] = k[15]);
            return g
        },
        set: function(k, g) {
            g[0] = k[0];
            g[1] = k[1];
            g[2] = k[2];
            g[3] = k[3];
            g[4] = k[4];
            g[5] = k[5];
            g[6] = k[6];
            g[7] = k[7];
            g[8] = k[8];
            g[9] = k[9];
            g[10] = k[10];
            g[11] = k[11];
            g[12] = k[12];
            g[13] = k[13];
            g[14] = k[14];
            g[15] = k[15];
            return g
        },
        Jd: function(k) {
            k[0] = 1;
            k[1] = 0;
            k[2] = 0;
            k[3] = 0;
            k[4] = 0;
            k[5] = 1;
            k[6] = 0;
            k[7] = 0;
            k[8] = 0;
            k[9] = 0;
            k[10] = 1;
            k[11] = 0;
            k[12] = 0;
            k[13] = 0;
            k[14] = 0;
            k[15] = 1;
            return k
        },
        multiply: function(k, g, b) {
            b || (b = k);
            var a = k[0]
              , d = k[1]
              , c = k[2]
              , e = k[3]
              , f = k[4]
              , l = k[5]
              , h = k[6]
              , x = k[7]
              , A = k[8]
              , n = k[9]
              , m = k[10]
              , p = k[11]
              , u = k[12]
              , t = k[13]
              , v = k[14];
            k = k[15];
            var q = g[0]
              , w = g[1]
              , B = g[2]
              , z = g[3]
              , y = g[4]
              , C = g[5]
              , D = g[6]
              , E = g[7]
              , F = g[8]
              , H = g[9]
              , I = g[10]
              , J = g[11]
              , K = g[12]
              , L = g[13]
              , M = g[14];
            g = g[15];
            b[0] = q * a + w * f + B * A + z * u;
            b[1] = q * d + w * l + B * n + z * t;
            b[2] = q * c + w * h + B * m + z * v;
            b[3] = q * e + w * x + B * p + z * k;
            b[4] = y * a + C * f + D * A + E * u;
            b[5] = y * d + C * l + D * n + E * t;
            b[6] = y * c + C * h + D * m + E * v;
            b[7] = y * e + C * x + D * p + E * k;
            b[8] = F * a + H * f + I * A + J * u;
            b[9] = F * d + H * l + I * n + J * t;
            b[10] = F * c + H * h + I * m + J * v;
            b[11] = F * e + H * x + I * p + J * k;
            b[12] = K * a + L * f + M * A + g * u;
            b[13] = K * d + L * l + M * n + g * t;
            b[14] = K * c + L * h + M * m + g * v;
            b[15] = K * e + L * x + M * p + g * k;
            return b
        },
        translate: function(k, g, b) {
            var a = g[0]
              , d = g[1];
            g = g[2];
            if (!b || k == b)
                return k[12] = k[0] * a + k[4] * d + k[8] * g + k[12],
                k[13] = k[1] * a + k[5] * d + k[9] * g + k[13],
                k[14] = k[2] * a + k[6] * d + k[10] * g + k[14],
                k[15] = k[3] * a + k[7] * d + k[11] * g + k[15],
                k;
            var c = k[0]
              , e = k[1]
              , f = k[2]
              , l = k[3]
              , h = k[4]
              , x = k[5]
              , A = k[6]
              , n = k[7]
              , m = k[8]
              , p = k[9]
              , u = k[10]
              , t = k[11];
            b[0] = c;
            b[1] = e;
            b[2] = f;
            b[3] = l;
            b[4] = h;
            b[5] = x;
            b[6] = A;
            b[7] = n;
            b[8] = m;
            b[9] = p;
            b[10] = u;
            b[11] = t;
            b[12] = c * a + h * d + m * g + k[12];
            b[13] = e * a + x * d + p * g + k[13];
            b[14] = f * a + A * d + u * g + k[14];
            b[15] = l * a + n * d + t * g + k[15];
            return b
        },
        scale: function(k, g, b) {
            var a = g[0]
              , d = g[1];
            g = g[2];
            if (!b || k == b)
                return k[0] *= a,
                k[1] *= a,
                k[2] *= a,
                k[3] *= a,
                k[4] *= d,
                k[5] *= d,
                k[6] *= d,
                k[7] *= d,
                k[8] *= g,
                k[9] *= g,
                k[10] *= g,
                k[11] *= g,
                k;
            b[0] = k[0] * a;
            b[1] = k[1] * a;
            b[2] = k[2] * a;
            b[3] = k[3] * a;
            b[4] = k[4] * d;
            b[5] = k[5] * d;
            b[6] = k[6] * d;
            b[7] = k[7] * d;
            b[8] = k[8] * g;
            b[9] = k[9] * g;
            b[10] = k[10] * g;
            b[11] = k[11] * g;
            b[12] = k[12];
            b[13] = k[13];
            b[14] = k[14];
            b[15] = k[15];
            return b
        },
        rotate: function(k, g, b, a) {
            var d = b[0]
              , c = b[1];
            b = b[2];
            var e = Math.sqrt(d * d + c * c + b * b);
            if (!e)
                return null;
            1 != e && (e = 1 / e,
            d *= e,
            c *= e,
            b *= e);
            var f = Math.sin(g)
              , l = Math.cos(g)
              , h = 1 - l;
            g = k[0];
            var e = k[1]
              , x = k[2]
              , A = k[3]
              , n = k[4]
              , m = k[5]
              , p = k[6]
              , u = k[7]
              , t = k[8]
              , v = k[9]
              , q = k[10]
              , w = k[11]
              , B = d * d * h + l
              , z = c * d * h + b * f
              , y = b * d * h - c * f
              , C = d * c * h - b * f
              , D = c * c * h + l
              , E = b * c * h + d * f
              , F = d * b * h + c * f
              , d = c * b * h - d * f
              , c = b * b * h + l;
            a ? k != a && (a[12] = k[12],
            a[13] = k[13],
            a[14] = k[14],
            a[15] = k[15]) : a = k;
            a[0] = g * B + n * z + t * y;
            a[1] = e * B + m * z + v * y;
            a[2] = x * B + p * z + q * y;
            a[3] = A * B + u * z + w * y;
            a[4] = g * C + n * D + t * E;
            a[5] = e * C + m * D + v * E;
            a[6] = x * C + p * D + q * E;
            a[7] = A * C + u * D + w * E;
            a[8] = g * F + n * d + t * c;
            a[9] = e * F + m * d + v * c;
            a[10] = x * F + p * d + q * c;
            a[11] = A * F + u * d + w * c;
            return a
        },
        ym: function(k, g, b, a, d, c, e) {
            e || (e = m.T.create());
            var f = g - k
              , l = a - b
              , h = c - d;
            e[0] = 2 * d / f;
            e[1] = 0;
            e[2] = 0;
            e[3] = 0;
            e[4] = 0;
            e[5] = 2 * d / l;
            e[6] = 0;
            e[7] = 0;
            e[8] = (g + k) / f;
            e[9] = (a + b) / l;
            e[10] = -(c + d) / h;
            e[11] = -1;
            e[12] = 0;
            e[13] = 0;
            e[14] = -(c * d * 2) / h;
            e[15] = 0;
            return e
        },
        perspective: function(k, g, b, a, d) {
            k = b * Math.tan(k * Math.PI / 360);
            g = k * g;
            return m.T.ym(-g, g, -k, k, b, a, d)
        },
        ip: function(k, g, b, a, d, c, e) {
            e || (e = m.T.create());
            var f = g - k
              , l = a - b
              , h = c - d;
            e[0] = 2 / f;
            e[1] = 0;
            e[2] = 0;
            e[3] = 0;
            e[4] = 0;
            e[5] = 2 / l;
            e[6] = 0;
            e[7] = 0;
            e[8] = 0;
            e[9] = 0;
            e[10] = -2 / h;
            e[11] = 0;
            e[12] = -(k + g) / f;
            e[13] = -(a + b) / l;
            e[14] = -(c + d) / h;
            e[15] = 1;
            return e
        }
    }
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g(b) {
            this.da = m.T.create();
            this.cb = m.T.create();
            this.Vc = 0;
            this.Ua = [];
            this.Nf = !1;
            this.fj = this.ri = this.Wi = 1;
            this.Fe = 1E6;
            this.Jg = [!1, !1, !1, !1, !1, !1];
            this.Ah = !1;
            this.ji = [];
            this.tj = 8;
            this.on = new m.Ml;
            this.Fd = [];
            this.g = b;
            if (b.Kd || b.Zg)
                b.qg = 2
        }
        g.prototype.Kf = function() {
            var b = this.g.H;
            if (b) {
                var a = b.createShader(b.FRAGMENT_SHADER);
                b.shaderSource(a, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec2 vTextureCoord;\n\t\t\t\t\tuniform sampler2D uSampler;\n\t\t\t\t\tvoid main(void) {\n\t\t\t\t\t\tgl_FragColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));\n\t\t\t\t\t}");
                b.compileShader(a);
                b.getShaderParameter(a, b.COMPILE_STATUS) || (console && console.log(b.getShaderInfoLog(a)),
                alert(b.getShaderInfoLog(a)),
                a = null);
                var d = b.createShader(b.VERTEX_SHADER);
                this.zc(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nattribute vec3 aVertexPosition;\n\t\t\t\tattribute vec2 aTextureCoord;\n\t\t\t\tuniform mat4 uMVMatrix;\n\t\t\t\tuniform mat4 uPMatrix;\n\t\t\t\tuniform float uZoffset;\n\t\t\t\tvarying vec2 vTextureCoord;\n\t\t\t\tvoid main(void) {\n\t\t\t\t\tgl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);\n\t\t\t\t\tgl_Position.z += uZoffset;\n\t\t\t\t\tvTextureCoord = aTextureCoord;\n\t\t\t\t}");
                this.F = b.createProgram();
                this.Pe(this.F, d, a);
                this.F.$ = b.getAttribLocation(this.F, "aVertexPosition");
                b.enableVertexAttribArray(this.F.$);
                this.F.wa = b.getAttribLocation(this.F, "aTextureCoord");
                b.enableVertexAttribArray(this.F.wa);
                this.F.Nd = b.getUniformLocation(this.F, "uPMatrix");
                this.F.Yf = b.getUniformLocation(this.F, "uMVMatrix");
                this.F.Ze = b.getUniformLocation(this.F, "uSampler");
                this.F.Qh = b.getUniformLocation(this.F, "uZoffset");
                a = b.createShader(b.VERTEX_SHADER);
                this.zc(a, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nattribute vec3 aVertexPosition;\n\t\t\t\tuniform vec2 uCanvasDimensions;\n\t\t\t\tvoid main(void) {\n\t\t\t\t\tvec2 pointNorm = (aVertexPosition.xy / uCanvasDimensions) * 2.0 - vec2(1.0, 1.0);\n\t\t\t\t\tgl_Position = vec4(pointNorm.x, pointNorm.y * -1.0, 0.0, 1.0);\n\t\t\t\t}");
                d = b.createShader(b.FRAGMENT_SHADER);
                this.zc(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nuniform vec3 uColor;\n\t\t\t\tuniform float uAlpha;\n\t\t\t\tvoid main(void) {\n\t\t\t\t\tgl_FragColor = vec4(uColor, uAlpha);\n\t\t\t\t}");
                this.td = b.createProgram();
                this.Pe(this.td, a, d);
                this.td.$ = b.getAttribLocation(this.td, "aVertexPosition");
                b.enableVertexAttribArray(this.td.$);
                d = b.createShader(b.VERTEX_SHADER);
                this.zc(d, "precision highp float;\n\t\t\t\tattribute vec3 aVertexPosition;\n\t\t\t\tvarying vec2 vTextureCoord;\n\t\t\t\tuniform vec2 uCanvasDimensions;\n\t\t\t\tuniform vec4 uRect;\n\t\t\t\tvoid main(void) {\n\t\t\t\t\tvec2 pos = vec2(uRect.x + uRect.z*aVertexPosition.x,uRect.y + uRect.w*aVertexPosition.y);\n\t\t\t\t\tvec2 pointNorm = (pos / uCanvasDimensions) * 2.0 - vec2(1.0, 1.0);\n\t\t\t\t\tgl_Position = vec4(pointNorm.x, pointNorm.y * -1.0, 1.0, 1.0);\n\t\t\t\t\tvTextureCoord.s=aVertexPosition.x;\n\t\t\t\t\tvTextureCoord.t=1.0-aVertexPosition.y;\n\t\t\t\t}");
                a = b.createShader(b.FRAGMENT_SHADER);
                this.zc(a, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec2 vTextureCoord;\n\t\t\t\tuniform sampler2D uSampler;\n\t\t\t\tvoid main(void) {\n\t\t\t\t\tgl_FragColor = texture2D(uSampler,vTextureCoord);\n\t\t\t\t}");
                this.xf = b.createProgram();
                this.Pe(this.xf, d, a)
            }
        }
        ;
        g.prototype.Yg = function() {
            var b = this.g, a = b.H, d, c;
            a ? (d = a.createShader(a.FRAGMENT_SHADER),
            c = this.wi(13),
            this.zc(d, c),
            c = a.createShader(a.VERTEX_SHADER),
            this.zc(c, "precision highp float;\nattribute vec3 aVertexPosition;\nuniform vec2 uCanvasDimensions;\nvarying vec2 dst;\nuniform vec2 dstSize;\nuniform float zOffset;\nvoid main(void) {\n vec2 pointNorm = (aVertexPosition.xy / uCanvasDimensions) * 2.0 - vec2(1.0, 1.0);\n gl_Position = vec4(pointNorm.x, pointNorm.y * -1.0, zOffset, 1.0);\n dst.x= -1.0 + 2.0*((aVertexPosition.x + 0.5) / uCanvasDimensions.x);\n dst.y= (-1.0 * uCanvasDimensions.y + 2.0*(aVertexPosition.y + 0.5)) / uCanvasDimensions.x;\n}\n"),
            this.Tk = a.createProgram(),
            this.Pe(this.Tk, c, d),
            d = a.createShader(a.FRAGMENT_SHADER),
            c = this.wi(4),
            this.zc(d, c),
            c = a.createShader(a.VERTEX_SHADER),
            this.zc(c, "precision highp float;\nattribute vec3 aVertexPosition;\nuniform vec2 uCanvasDimensions;\nvarying vec2 dst;\nuniform vec2 dstSize;\nuniform float zOffset;\nvoid main(void) {\n vec2 pointNorm = (aVertexPosition.xy / uCanvasDimensions) * 2.0 - vec2(1.0, 1.0);\n gl_Position = vec4(pointNorm.x, pointNorm.y * -1.0, zOffset, 1.0);\n dst.x= -1.0 + 2.0*((aVertexPosition.x + 0.5) / uCanvasDimensions.x);\n dst.y= (-1.0 * uCanvasDimensions.y + 2.0*(aVertexPosition.y + 0.5)) / uCanvasDimensions.x;\n}\n"),
            this.Uk = a.createProgram(),
            this.Pe(this.Uk, c, d),
            d = a.createShader(a.FRAGMENT_SHADER),
            c = this.wi(b.o.format),
            this.zc(d, c),
            c = a.createShader(a.VERTEX_SHADER),
            this.zc(c, "precision highp float;\nattribute vec3 aVertexPosition;\nuniform vec2 uCanvasDimensions;\nvarying vec2 dst;\nuniform vec2 dstSize;\nvoid main(void) {\n vec2 pointNorm = (aVertexPosition.xy / uCanvasDimensions) * 2.0 - vec2(1.0, 1.0);\n gl_Position = vec4(pointNorm.x, pointNorm.y * -1.0, 0.0, 1.0);\n dst.x= -1.0 + 2.0*((aVertexPosition.x + 0.5) / uCanvasDimensions.x);\n dst.y= (-1.0 * uCanvasDimensions.y + 2.0*(aVertexPosition.y + 0.5)) / uCanvasDimensions.x;\n}\n"),
            this.Vk = a.createProgram(),
            this.Pe(this.Vk, c, d),
            this.sh || (this.sh = a.createBuffer())) : this.g.L("No WebGL to initRemapShader!")
        }
        ;
        g.prototype.zc = function(b, a) {
            var d = this.g.H;
            d.shaderSource(b, a);
            d.compileShader(b);
            d.getShaderParameter(b, d.COMPILE_STATUS) || (console && console.log(d.getShaderInfoLog(b)),
            O && alert(d.getShaderInfoLog(b)))
        }
        ;
        g.prototype.Pe = function(b, a, d) {
            var c = this.g.H;
            c.attachShader(b, a);
            c.attachShader(b, d);
            c.linkProgram(b);
            c.getProgramParameter(b, c.LINK_STATUS) || (alert("Could not initialise shader program"),
            console && console.log(c.getError()));
            c.useProgram(b)
        }
        ;
        g.prototype.wi = function(b) {
            var a = this.g, d;
            d = "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\n#define M_PI 3.14159265358979323846\nvarying vec2 dst;\nuniform vec2 srcScale;\nuniform vec2 srcOffset;\nuniform float rectDstDistance;\nuniform float fisheyeDistance;\nuniform float stereoDistance;\nuniform float directionBlend;\nuniform mat4 matRotate; // = mat4( 1.0,0.0,0.0,0.0, 0.0,1.0,0.0,0.0, 0.0,0.0,1.0,0.0, 0.0,0.0,0.0,1.0 );\nconst float rectSrcDistance = 1.0;\nuniform vec2 tonemap;\n";
            d = (13 == b ? d + "uniform samplerCube cubeTexture;" : d + "uniform sampler2D tileTexture;\n") + "void main()\n{\n";
            d += "vec4 direction;\n";
            d += "vec2 src;\n";
            d += "vec2 srcCord;\n";
            d += "vec2 texc;\n";
            var c = this.ck(a.xa());
            a.xa() != a.fc && 0 != a.fc ? (a = this.ck(a.fc),
            d += "vec4 direction1,direction2;\n",
            d += c.replace("direction=", "direction1="),
            d += a.replace("direction=", "direction2="),
            d += "direction=normalize(mix(direction1, direction2,1.0-directionBlend));\n") : d += c;
            d += "direction=direction*matRotate;\n";
            13 == b && (d += "direction.z=-direction.z;",
            d += "gl_FragColor = textureCube(cubeTexture, direction.xyz);");
            4 == b && (d += "float iz=1.0/(direction.z * rectSrcDistance);\n",
            d += "src.x=-direction.x*iz;\n",
            d += "src.y= direction.y*iz;\n",
            d += "texc=src * srcScale + srcOffset;\n",
            d += "if (",
            d += "(direction.z<0.0) && ",
            d += "(texc.x>=0.0) && (texc.x<=1.0) && (texc.y>=0.0) && (texc.y<=1.0)) {\n",
            d += "  gl_FragColor = texture2D(tileTexture, texc);\n",
            d += "} else {\n",
            d += "  discard;\n",
            d += "}\n");
            1 == b && (d += "src.x=atan(float(-direction.x), float(-direction.z));",
            d += "src.y=asin(direction.y);\n",
            d += "texc=src * srcScale + srcOffset;\n",
            d += "gl_FragColor = texture2D(tileTexture, texc);\n");
            14 == b && (d += "vec2 cf;\n",
            d += "if ((direction.z<0.0) && (direction.z<=-abs(direction.x)) && (direction.z<=-abs(direction.y))) {\n",
            d += "  src.x=-direction.x/direction.z;\n",
            d += "  src.y=+direction.y/direction.z;\n",
            d += "  cf.x=1.0;cf.y=3.0;\n",
            d += "}\n",
            d += "if ((direction.x>=0.0) && (direction.x>=abs(direction.y)) && (direction.x>=abs(direction.z))) {\n",
            d += "  src.x=+direction.z/direction.x;\n",
            d += "  src.y=-direction.y/direction.x;\n",
            d += "  cf.x=3.0;cf.y=3.0;\n",
            d += "}\n",
            d += "if ((direction.z>=0.0) && (direction.z>=abs(direction.x)) && (direction.z>=abs(direction.y))) {\n",
            d += "  src.x=-direction.x/direction.z;\n",
            d += "  src.y=-direction.y/direction.z;\n",
            d += "  cf.x=5.0;cf.y=3.0;\n",
            d += "}\n",
            d += "if ((direction.x<=0.0) && (direction.x<=-abs(direction.y)) && (direction.x<=-abs(direction.z))) {\n",
            d += "  src.x=+direction.z/direction.x;\n",
            d += "  src.y=+direction.y/direction.x;\n",
            d += "  cf.x=1.0;cf.y=1.0;\n",
            d += "}\n",
            d += "if ((direction.y>=0.0) && (direction.y>=abs(direction.x)) && (direction.y>=abs(direction.z))) {\n",
            d += "  src.x=+direction.x/direction.y;\n",
            d += "  src.y=-direction.z/direction.y;\n",
            d += "  cf.x=5.0;cf.y=1.0;\n",
            d += "}\n",
            d += "if ((direction.y<=0.0) && (direction.y<=-abs(direction.x)) && (direction.y<=-abs(direction.z))) {\n",
            d += "  src.x=-direction.x/direction.y;\n",
            d += "  src.y=-direction.z/direction.y;\n",
            d += "  cf.x=3.0;cf.y=1.0;\n",
            d += "}\n",
            d += "texc.x=(cf.x+src.x*srcScale.x) / 6.0;\n",
            d += "texc.y=(cf.y+src.y*srcScale.y) / 4.0;\n",
            d += "gl_FragColor = texture2D(tileTexture, texc);\n");
            return d += "}\n"
        }
        ;
        g.prototype.ck = function(b) {
            var a = "";
            switch (b) {
            case 4:
                a += "direction.x=dst.x*rectDstDistance;\ndirection.y=dst.y*rectDstDistance;\ndirection.z=-1.0;\n";
                break;
            case 12:
                a += "float r,ph,ro;\nr=length(dst.xy)*0.5;\nro=atan(float(dst.x),float(-dst.y));\nph=r / fisheyeDistance;\ndirection.x= sin(ph) * sin(ro);\ndirection.y=-sin(ph) * cos(ro);\ndirection.z=-cos(ph);\n";
                break;
            case 9:
                a += "float n;\nvec2 ind;\nind=dst*stereoDistance;\nn=1.0 + ind.x*ind.x + ind.y*ind.y;\ndirection.x=2.0*ind.x/n;\ndirection.y=2.0*ind.y/n;\ndirection.z=(n-2.0)/n;\n"
            }
            return a + "direction.w=0.0;\ndirection=normalize(direction);\n"
        }
        ;
        g.prototype.lk = function(b) {
            var a, d, c, e, f = this.g, l = this.g.H;
            this.ei = l.createBuffer();
            l.bindBuffer(l.ARRAY_BUFFER, this.ei);
            var h = [-1, -1, 1, 1, -1, 1, 1, 1, 1, -1, 1, 1];
            for (a = 0; 12 > a; a++)
                2 > a % 3 && (h[a] *= b);
            l.bufferData(l.ARRAY_BUFFER, new Float32Array(h), l.STATIC_DRAW);
            this.Zd = l.createBuffer();
            l.bindBuffer(l.ARRAY_BUFFER, this.Zd);
            var x = [1, 0, 0, 0, 0, 1, 1, 1];
            l.bufferData(l.ARRAY_BUFFER, new Float32Array(x), l.STATIC_DRAW);
            this.Nc = l.createBuffer();
            l.bindBuffer(l.ELEMENT_ARRAY_BUFFER, this.Nc);
            var g = [0, 1, 2, 0, 2, 3];
            l.bufferData(l.ELEMENT_ARRAY_BUFFER, new Uint16Array(g), l.STATIC_DRAW);
            var h = []
              , g = []
              , x = []
              , k = new m.ra;
            for (b = 0; 6 > b; b++) {
                c = b % 3;
                e = 3 > b ? 1 : 0;
                for (d = 0; 4 > d; d++) {
                    k.x = -1;
                    k.y = -1;
                    k.z = 1;
                    for (a = 0; a < d; a++)
                        k.Zk();
                    x.push((0 > k.x ? .33 : 0) + .33 * c, (0 > k.y ? 0 : .5) + .5 * e);
                    if (4 > b)
                        for (a = 0; a < b; a++)
                            k.Tn();
                    else
                        5 == b ? k.Sn() : k.Rn();
                    h.push(k.x, k.y, k.z)
                }
                a = 4 * b;
                g.push(0 + a, 1 + a, 2 + a, 0 + a, 2 + a, 3 + a)
            }
            f.o.rj = l.createBuffer();
            l.bindBuffer(l.ARRAY_BUFFER, f.o.rj);
            l.bufferData(l.ARRAY_BUFFER, new Float32Array(h), l.STATIC_DRAW);
            f.o.Ch = l.createBuffer();
            l.bindBuffer(l.ARRAY_BUFFER, f.o.Ch);
            l.bufferData(l.ARRAY_BUFFER, new Float32Array(x), l.STATIC_DRAW);
            f.o.Ci = l.createBuffer();
            l.bindBuffer(l.ELEMENT_ARRAY_BUFFER, f.o.Ci);
            l.bufferData(l.ELEMENT_ARRAY_BUFFER, new Uint16Array(g), l.STATIC_DRAW);
            this.gn = l.createBuffer();
            this.fn = l.createBuffer()
        }
        ;
        g.prototype.yi = function(b) {
            var a = this;
            return function() {
                try {
                    if (b.yn)
                        return;
                    var d = a.g.H;
                    d.pixelStorei(d.UNPACK_FLIP_Y_WEBGL, 1);
                    var c = !1;
                    null != b.ie && b.ie.complete ? b.gk || (d.bindTexture(d.TEXTURE_2D, b),
                    d.texImage2D(d.TEXTURE_2D, 0, d.RGBA, d.RGBA, d.UNSIGNED_BYTE, b.ie),
                    c = b.gk = !0) : null != b.Te && b.Te.complete && (d.bindTexture(d.TEXTURE_2D, b),
                    d.texImage2D(d.TEXTURE_2D, 0, d.RGBA, d.RGBA, d.UNSIGNED_BYTE, b.Te),
                    c = !0);
                    c && (b.loaded = !0);
                    d.bindTexture(d.TEXTURE_2D, null);
                    d.pixelStorei(d.UNPACK_FLIP_Y_WEBGL, 0)
                } catch (e) {
                    a.g.L(e)
                }
                a.g.update(2)
            }
        }
        ;
        g.prototype.mk = function() {
            var b, a, d = this.g, c = d.H;
            if (this.Ua)
                for (; 0 < this.Ua.length; )
                    c.deleteTexture(this.Ua.pop());
            this.Ua = [];
            for (var e = 0; 6 > e; e++)
                a = c.createTexture(),
                this.Vc++,
                a.Te = null,
                a.ie = null,
                a.gk = !1,
                c.bindTexture(c.TEXTURE_2D, a),
                c.texImage2D(c.TEXTURE_2D, 0, c.RGB, 1, 1, 0, c.RGB, c.UNSIGNED_BYTE, null),
                c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MIN_FILTER, c.LINEAR),
                c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE),
                c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE),
                d.Ge[e] && (b = new Image,
                b.crossOrigin = d.crossOrigin,
                b.src = d.Wb(d.Ge[e]),
                a.Te = b,
                b.addEventListener && b.addEventListener("load", this.yi(a), !1),
                d.Gb.push(b)),
                this.Ua.push(a);
            for (e = 0; 6 > e; e++)
                d.Kg[e] && (b = new Image,
                b.crossOrigin = d.crossOrigin,
                b.src = d.Wb(d.Kg[e]),
                b.addEventListener ? b.addEventListener("load", this.yi(this.Ua[e]), !1) : b.onload = this.yi(this.Ua[e]),
                this.Ua[e].ie = b,
                d.Gb.push(b));
            for (e = 0; e < d.J.length; e++)
                d.J[e].$c || (d.J[e].hc = c.createTexture(),
                d.Vc++,
                c.bindTexture(c.TEXTURE_2D, d.J[e].hc),
                c.texImage2D(c.TEXTURE_2D, 0, c.RGB, 1, 1, 0, c.RGB, c.UNSIGNED_BYTE, null),
                c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MIN_FILTER, c.LINEAR),
                c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE),
                c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE));
            d.o.hc = c.createTexture();
            d.Vc++;
            c.bindTexture(c.TEXTURE_2D, d.o.hc);
            c.texImage2D(c.TEXTURE_2D, 0, c.RGB, 1, 1, 0, c.RGB, c.UNSIGNED_BYTE, null);
            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MIN_FILTER, c.LINEAR);
            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE);
            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE);
            c.bindTexture(c.TEXTURE_2D, null)
        }
        ;
        g.prototype.ap = function() {
            var b = this.g;
            if (b.m.width != b.C.offsetWidth || b.m.height != b.C.offsetHeight)
                b.m.width = b.C.offsetWidth,
                b.m.height = b.C.offsetHeight;
            b.de && (b.Bc(0),
            b.dd());
            if (b.H) {
                var a = b.H;
                this.Ih();
                a.clear(a.DEPTH_BUFFER_BIT);
                a.useProgram(this.F);
                this.kg(0);
                a.uniform1i(this.F.Ze, 0);
                a.enableVertexAttribArray(this.F.$);
                a.enableVertexAttribArray(this.F.wa);
                a.bindBuffer(a.ARRAY_BUFFER, this.Zd);
                a.vertexAttribPointer(this.F.wa, 2, a.FLOAT, !1, 0, 0);
                a.activeTexture(a.TEXTURE0);
                a.bindBuffer(a.ELEMENT_ARRAY_BUFFER, this.Nc);
                a.uniform1f(this.F.Qh, 1E-4);
                a.vertexAttribPointer(this.F.$, 3, a.FLOAT, !1, 0, 0);
                m.T.Jd(this.cb);
                m.T.perspective(b.Jb(), b.jb.width / b.jb.height, .1, 100, this.cb);
                a.uniformMatrix4fv(this.F.Nd, !1, this.cb);
                for (b = 0; 6 > b; b++)
                    this.kg(b),
                    a.bindBuffer(a.ARRAY_BUFFER, this.ei),
                    a.vertexAttribPointer(this.F.$, 3, a.FLOAT, !1, 0, 0),
                    a.bindBuffer(a.ARRAY_BUFFER, this.Zd),
                    a.vertexAttribPointer(this.F.wa, 2, a.FLOAT, !1, 0, 0),
                    6 <= this.Ua.length && this.Ua[b].loaded && (a.activeTexture(a.TEXTURE0),
                    a.bindTexture(a.TEXTURE_2D, this.Ua[b]),
                    a.bindBuffer(a.ELEMENT_ARRAY_BUFFER, this.Nc),
                    a.uniform1i(this.F.Ze, 0),
                    a.uniformMatrix4fv(this.F.Yf, !1, this.da),
                    a.uniformMatrix4fv(this.F.Nd, !1, this.cb),
                    a.drawElements(a.TRIANGLES, 6, a.UNSIGNED_SHORT, 0))
            }
        }
        ;
        g.prototype.Ih = function() {
            var b = this.g;
            if (b.h.Ve && 6 < b.h.Ve.length) {
                var a = parseInt(b.h.Ve);
                b.H.clearColor((a >> 16 & 255) / 255, (a >> 8 & 255) / 255, (a >> 0 & 255) / 255, 1)
            }
        }
        ;
        g.prototype.kg = function(b) {
            var a = this.g;
            m.T.Jd(this.da);
            m.T.rotate(this.da, -a.N.c * Math.PI / 180, [0, 0, 1]);
            m.T.rotate(this.da, -a.j.c * Math.PI / 180, [1, 0, 0]);
            m.T.rotate(this.da, (180 - a.pan.c) * Math.PI / 180, [0, 1, 0]);
            a.Ca && (m.T.rotate(this.da, -a.Ca.pitch * Math.PI / 180, [1, 0, 0]),
            m.T.rotate(this.da, a.Ca.N * Math.PI / 180, [0, 0, 1]));
            4 > b ? m.T.rotate(this.da, -Math.PI / 2 * b, [0, 1, 0]) : m.T.rotate(this.da, Math.PI / 2 * (5 == b ? 1 : -1), [1, 0, 0])
        }
        ;
        g.prototype.Eo = function(b) {
            var a = this;
            return function() {
                a.ji.push(b)
            }
        }
        ;
        g.prototype.qm = function(b) {
            this.g.za = !0;
            this.g.Pc = !0;
            b.loaded = !0;
            b.Xi = 0;
            b.Pd = 0;
            var a = this.g.H;
            this.Jj();
            a.pixelStorei(a.UNPACK_FLIP_Y_WEBGL, 1);
            if (null != b.h && b.h.complete) {
                b.bb = a.createTexture();
                this.g.Vc++;
                a.bindTexture(a.TEXTURE_2D, b.bb);
                try {
                    a.texImage2D(a.TEXTURE_2D, 0, a.RGBA, a.RGBA, a.UNSIGNED_BYTE, b.h)
                } catch (d) {
                    a.texImage2D(a.TEXTURE_2D, 0, a.RGBA, 1, 1, 0, a.RGBA, a.UNSIGNED_BYTE, new Uint8Array([128, 128, 128, 250])),
                    this.g.L(d)
                }
            }
            this.g.update(2)
        }
        ;
        g.prototype.Jj = function() {
            this.g.Fa && this.g.Fa--;
            0 == this.g.Fa && this.g.O && this.g.O.ggLoadedLevels && this.g.O.ggLoadedLevels()
        }
        ;
        g.prototype.rm = function() {
            if (0 < this.ji.length) {
                var b = this.ji.shift();
                this.qm(b)
            }
        }
        ;
        g.prototype.wn = function(b) {
            var a = this;
            return function() {
                a.g.za = !0;
                a.g.Pc = !0;
                var d = a.g.h;
                try {
                    if (null != b && b.complete) {
                        var c = d.I[d.I.length - 1]
                          , e = d.Ka;
                        c.height = c.width = b.width - 2 * e;
                        c.M = c.ea = 1;
                        for (var f = 0; 6 > f; f++) {
                            var l = new m.Id;
                            l.K = document.createElement("canvas");
                            a.g.Z ? (l.K.width = c.width + 2 * e,
                            l.K.height = c.height + 2 * e) : (l.K.width = d.G + 2 * e,
                            l.K.height = d.G + 2 * e);
                            l.Oa = l.K.getContext("2d");
                            l.K.style[a.g.Va + "Origin"] = "0% 0%";
                            l.K.style.overflow = "hidden";
                            l.K.style.position = "absolute";
                            l.h = b;
                            var h = c.width + 2 * e
                              , x = c.height + 2 * e;
                            l.Oa && l.Oa.drawImage(b, 0, f * x, h, x, 0, 0, h, x);
                            if (a.g.Z && a.g.H) {
                                var g = a.g.H;
                                g.pixelStorei(g.UNPACK_FLIP_Y_WEBGL, 1);
                                l.bb = g.createTexture();
                                a.g.Vc++;
                                g.bindTexture(g.TEXTURE_2D, l.bb);
                                try {
                                    g.texImage2D(g.TEXTURE_2D, 0, g.RGBA, g.RGBA, g.UNSIGNED_BYTE, l.K)
                                } catch (k) {
                                    a.g.L(k)
                                }
                                g.bindTexture(g.TEXTURE_2D, null);
                                g.pixelStorei(g.UNPACK_FLIP_Y_WEBGL, 0)
                            }
                            a.g.Gc && (l.K.Hd = -1,
                            a.g.C.insertBefore(l.K, a.g.C.firstChild));
                            c.V[f] = l
                        }
                        c.loaded = !0
                    }
                } catch (k) {
                    a.g.L(k)
                }
                a.g.update(2)
            }
        }
        ;
        g.prototype.sl = function(b) {
            var a = this;
            return function() {
                a.g.za = !0;
                a.g.Pc = !0;
                a.Jj();
                b.h = null
            }
        }
        ;
        g.prototype.Zo = function() {
            var b = this.g
              , a = b.h
              , d = b.h.I;
            b.de && (b.Bc(0),
            b.dd());
            if (b.H) {
                var c = b.H;
                c.useProgram(this.F);
                this.Ih();
                c.clear(c.DEPTH_BUFFER_BIT);
                c.enable(c.DEPTH_TEST);
                m.T.Jd(this.cb);
                m.T.perspective(b.Jb(), b.jb.width / b.jb.height, .1, 100, this.cb);
                c.uniformMatrix4fv(this.F.Nd, !1, this.cb);
                b.yl();
                b.Ii();
                var e = b.ni(), f;
                for (f = d.length - 1; f >= e; ) {
                    var l = d[f]
                      , h = 1;
                    f == d.length - 1 && 0 == a.Ka && (h = a.G / (a.G - .5));
                    for (var x = 0; 6 > x; x++) {
                        var g;
                        g = this.g.hb.ab[x];
                        var k = g.Re;
                        if (g.qc && 0 < k.hf && 0 < k.yg && 0 < k.scale || l.cache) {
                            g.za = !1;
                            var r;
                            g.Be[f] || (g.Be[f] = {
                                Wa: 0,
                                rb: 0,
                                tb: 0,
                                ub: 0
                            });
                            r = g.Be[f];
                            l.cache ? (r.Wa = 0,
                            r.rb = 0,
                            r.tb = l.M - 1,
                            r.ub = l.ea - 1) : b.dk(l, k, r);
                            for (var k = !0, p = r.rb; p <= r.ub; p++)
                                for (var u = r.Wa; u <= r.tb; u++) {
                                    var t = u + p * l.M + x * l.M * l.ea
                                      , v = l.V[t];
                                    v || (v = l.V[t] = new m.Id);
                                    this.Og() ? v.h || (v.Pd ? v.Pd-- : (this.ih(v, l, b.se(x, f, u, p)),
                                    b.za = !0)) : this.g.uc++;
                                    if (v.bb) {
                                        if (!v.Le) {
                                            t = .5 * f + 1;
                                            v.Le = c.createBuffer();
                                            c.bindBuffer(c.ARRAY_BUFFER, v.Le);
                                            var q = [-1, -1, 1, 1, -1, 1, 1, 1, 1, -1, 1, 1];
                                            q[3] = u * a.G - a.Ka;
                                            q[0] = Math.min((u + 1) * a.G, l.width) + a.Ka;
                                            q[7] = p * a.G - a.Ka;
                                            q[1] = Math.min((p + 1) * a.G, l.height) + a.Ka;
                                            q[4] = q[1];
                                            q[6] = q[3];
                                            q[9] = q[0];
                                            q[10] = q[7];
                                            for (var w = 0; 12 > w; w++)
                                                q[w] = 0 == w % 3 ? h * t * (-2 * q[w] / l.width + 1) : 1 == w % 3 ? h * t * (-2 * q[w] / l.height + 1) : t;
                                            c.bufferData(c.ARRAY_BUFFER, new Float32Array(q), c.STATIC_DRAW)
                                        }
                                    } else
                                        k = !1;
                                    v.visible = g.qc
                                }
                            r.Fi = k
                        }
                    }
                    f--
                }
                for (x = 0; 6 > x; x++)
                    if (g = b.hb.ab[x],
                    g.qc)
                        for (k = g.Re,
                        this.kg(x),
                        c.uniform1i(this.F.Ze, 0),
                        c.uniformMatrix4fv(this.F.Nd, !1, this.cb),
                        c.uniformMatrix4fv(this.F.Yf, !1, this.da),
                        c.enableVertexAttribArray(this.F.$),
                        c.enableVertexAttribArray(this.F.wa),
                        c.bindBuffer(c.ARRAY_BUFFER, this.Zd),
                        c.vertexAttribPointer(this.F.wa, 2, c.FLOAT, !1, 0, 0),
                        c.activeTexture(c.TEXTURE0),
                        c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, this.Nc),
                        c.useProgram(this.F),
                        f = e; f <= d.length - 1; ) {
                            l = d[f];
                            if (g.qc && 0 < k.hf && g.Be[f] && 0 <= g.Be[f].Wa) {
                                r = g.Be[f];
                                for (p = r.rb; p <= r.ub; p++)
                                    for (u = r.Wa; u <= r.tb; u++)
                                        t = u + p * l.M + x * l.M * l.ea,
                                        (v = l.V[t]) && v.bb && (c.uniform1f(this.F.Qh, 1E-4 * (u % 2 + p % 2 * 2)),
                                        c.bindBuffer(c.ARRAY_BUFFER, v.Le),
                                        c.vertexAttribPointer(this.F.$, 3, c.FLOAT, !1, 0, 0),
                                        c.bindTexture(c.TEXTURE_2D, v.bb),
                                        c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MAG_FILTER, c.LINEAR),
                                        c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MIN_FILTER, c.LINEAR),
                                        c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE),
                                        c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE),
                                        c.drawElements(c.TRIANGLES, 6, c.UNSIGNED_SHORT, 0)),
                                        v.visible = g.qc;
                                r.Fi && (f = d.length)
                            }
                            f++
                        }
                this.Yi();
                b.Pc = !1
            }
        }
        ;
        g.prototype.Og = function() {
            return this.g.Fa < this.g.qg
        }
        ;
        g.prototype.ih = function(b, a, d) {
            var c = this.g;
            c.Bi++;
            b.h = new Image;
            b.Xi++;
            b.Pd = 1 << b.Xi;
            b.h.onload = this.Eo(b);
            b.h.onerror = this.sl(b);
            b.h.onabort = this.sl(b);
            b.h.crossOrigin = c.crossOrigin;
            b.h.setAttribute("src", d);
            c.L("load " + d);
            a.cache && c.Gb.push(b.h);
            0 == this.g.Fa && c.O && c.O.ggReLoadedLevels && c.O.ggReLoadedLevels();
            this.g.Fa++
        }
        ;
        g.prototype.Gl = function() {
            var b = this.g
              , a = b.h;
            b.de && (b.Bc(0),
            b.dd());
            if (b.H) {
                var d = b.H;
                this.Ih();
                O && d.clearColor(.2, 0, 0, 1);
                d.clear(d.DEPTH_BUFFER_BIT);
                d.disable(d.DEPTH_TEST);
                d.disable(d.CULL_FACE);
                d.bindBuffer(d.ARRAY_BUFFER, this.sh);
                var c = [0, 0];
                c[2] = b.m.width;
                c[3] = 0;
                c[4] = b.m.width;
                c[5] = b.m.height;
                c[6] = 0;
                c[7] = b.m.height;
                d.bufferData(d.ARRAY_BUFFER, new Float32Array(c), d.STATIC_DRAW);
                this.g.uc = 0;
                if (!this.rc || this.Nf)
                    0 < a.I.length ? this.om() : this.pm();
                b.o.Xc ? this.En() : (d.enable(d.DEPTH_TEST),
                d.depthRange(0, 1),
                d.depthFunc(d.LESS),
                this.Ah = !1,
                0 < a.I.length && this.$o(),
                this.rc && !this.Ah && this.Dn())
            }
        }
        ;
        g.prototype.qo = function(b, a, d, c, e, f, l) {
            var h = this.g
              , g = h.h
              , k = h.m
              , n = d * g.G / a.width
              , r = (d + 1) * g.G / a.width;
            d = c * g.G / a.height;
            a = (c + 1) * g.G / a.height;
            1 < r && (e *= 2,
            r = 1);
            1 < a && (e *= 2,
            a = 1);
            e = Math.min(this.tj, e);
            var r = (r - n) / e
              , p = (a - d) / e;
            c = a = 0;
            var u, t, g = {
                x: 0,
                y: 0
            }, v = {
                x: 0,
                y: 0
            }, q = 0;
            b.Wg = 0;
            var w = h.Zf
              , B = new m.ra
              , z = this.on;
            z.cl();
            4 > f ? z.cg(-90 * f) : z.pe(5 == f ? 90 : -90);
            h.Ca && (z.vh(h.Ca.N),
            z.pe(-h.Ca.pitch));
            z.cg(-h.pan.c);
            z.pe(h.j.c);
            z.vh(h.N.c);
            for (f = 0; f <= e; f++)
                for (var y = 0; y <= e; y++)
                    u = 2 * (n + y * r) - 1,
                    t = 2 * (d + f * p) - 1,
                    B.x = 1 * u,
                    B.y = 1 * t,
                    B.z = -1,
                    B.normalize(),
                    z.vn(B),
                    u = this.ak(B, g, h.xa()),
                    0 != h.fc && 1 > w && (u = u && this.ak(B, v, h.fc),
                    g.x = g.x * w + v.x * (1 - w),
                    g.y = g.y * w + v.y * (1 - w)),
                    u ? -1E10 < g.x && 1E10 > g.x && -1E10 < g.y && 1E10 > g.y ? -2 < g.x && 2 > g.x && -2 < g.y && 2 > g.y && (a += g.x,
                    c += g.y,
                    q++) : g.x = NaN : g.x = NaN,
                    b.Wc[b.Wg++] = g.x,
                    b.Wc[b.Wg++] = g.y;
            0 < q ? (a /= q,
            c /= q) : l = 0;
            for (d = 0; d < b.Wg; d += 2)
                g.x = b.Wc[d],
                g.y = b.Wc[d + 1],
                h = g.x - a,
                n = g.y - c,
                g.x += h * l,
                g.y += n * l,
                b.Wc[d] = k.width / 2 + g.x * k.width / 2,
                b.Wc[d + 1] = k.height / 2 - g.y * k.width / 2;
            this.ro(b, e)
        }
        ;
        g.prototype.ak = function(b, a, d) {
            var c = !0;
            switch (d) {
            case 0:
            case 4:
                d = 1 / (b.z * this.Wi);
                a.x = -b.x * d;
                a.y = b.y * d;
                0 < b.z && (c = !1);
                break;
            case 9:
                1 == b.z && (c = !1);
                d = 1 / ((1 - b.z) * this.fj);
                a.x = b.x * d;
                a.y = -b.y * d;
                break;
            case 12:
                if (d = Math.sqrt(b.x * b.x + b.y * b.y),
                0 == d)
                    a.x = 0,
                    a.y = 0;
                else {
                    var e = 2 * this.ri * Math.acos(-b.z) / d;
                    if (2 < d)
                        return !1;
                    a.x = e * b.x;
                    a.y = -e * b.y
                }
            }
            return c
        }
        ;
        g.prototype.ro = function(b, a) {
            for (var d = this.g, c = [], e, f = b.md = 0; f < a; f++)
                for (var l = 0; l < a; l++) {
                    c[0] = f + l * (a + 1);
                    c[1] = f + 1 + l * (a + 1);
                    c[2] = f + (l + 1) * (a + 1);
                    c[3] = f + 1 + (l + 1) * (a + 1);
                    e = !0;
                    for (var h = 0; 4 > h; h++)
                        isNaN(b.Wc[2 * c[0]]) && (e = !1);
                    if (e) {
                        for (var g = !1, k = !1, n = !1, m = !1, h = 0; 4 > h; h++) {
                            var p = b.Wc[2 * c[h]];
                            p < d.m.width && (k = !0);
                            0 <= p && (g = !0);
                            p = b.Wc[2 * c[h] + 1];
                            p < d.m.height && (n = !0);
                            0 <= p && (m = !0)
                        }
                        if (e = e && k && g && n && m)
                            b.ge[b.md++] = c[0],
                            b.ge[b.md++] = c[3],
                            b.ge[b.md++] = c[2],
                            b.ge[b.md++] = c[0],
                            b.ge[b.md++] = c[1],
                            b.ge[b.md++] = c[3]
                    }
                }
        }
        ;
        g.prototype.$o = function() {
            var b = this.g
              , a = b.h
              , d = b.h.I;
            b.de && (b.Bc(0),
            b.dd());
            if (b.H) {
                var c = b.H
                  , e = this.Uk;
                c.useProgram(e);
                this.mj(e);
                c.enable(c.CULL_FACE);
                c.cullFace(c.FRONT);
                c.enable(c.DEPTH_TEST);
                m.T.Jd(this.cb);
                m.T.perspective(b.Jb(), b.jb.width / b.jb.height, .1, 100, this.cb);
                c.uniformMatrix4fv(c.getUniformLocation(e, "uPMatrix"), !1, this.cb);
                this.g.uc = 0;
                b.Ii();
                var f = b.ni(), l, h = 0;
                l = d.length - 1;
                for (var g = {}, k = d[l]; k.Ue && 0 < l; )
                    l--,
                    k = d[l];
                for (var n = l, r = n, p = 0; 6 > p; p++)
                    for (var u = 0; u < k.ea; u++)
                        for (var t = 0; t < k.M; t++) {
                            var v = t + u * k.M + p * k.M * k.ea;
                            g[v] = 1
                        }
                for (; l >= f; ) {
                    var q = {}
                      , k = d[l]
                      , w = null;
                    0 < l && (w = d[l - 1]);
                    var B;
                    B = !0;
                    for (var z in g)
                        if (g.hasOwnProperty(z)) {
                            var v = Number(z), y = k.V[v], p = Number(Math.floor(v / (k.M * k.ea))), u = Math.floor((v - p * k.M * k.ea) / k.M), t = Math.floor(v - (u * k.M + p * k.M * k.ea)), C;
                            if (6 <= p)
                                console.log("Grrr...");
                            else if (C = this.g.hb.ab[p],
                            C.za = !1,
                            y || (y = k.V[v] = new m.Id,
                            b.L("create " + v)),
                            this.qo(y, k, t, u, Math.max(1, this.tj >> n - l), p, -(0 != b.fc) ? .3 : .1),
                            y.visible = 0 < y.md || k.cache,
                            y.fh = 3,
                            y.Sf = Date.now(),
                            y.visible && !y.bb && (B = !1,
                            this.Og() ? y.h || (y.Pd ? y.Pd-- : (this.ih(y, k, b.se(p, l, t, u)),
                            b.za = !0)) : this.g.uc++),
                            w && (y.visible || w.cache)) {
                                var y = (t * a.G + 1) / k.width
                                  , t = Math.min(1, (t + 1) * a.G - 1 / k.width)
                                  , D = (u * a.G + 1) / k.height
                                  , u = Math.min(1, (u + 1) * a.G - 1 / k.height)
                                  , v = a.G / w.width;
                                C = a.G / w.height;
                                var E = D
                                  , D = Math.floor(D * w.height / a.G);
                                do {
                                    var F = y
                                      , H = Math.floor(y * w.width / a.G);
                                    do {
                                        var I = H + D * w.M + p * w.M * w.ea;
                                        H < w.M && D < w.ea ? q[I] = 1 : b.L("Grrrr");
                                        H++;
                                        F += v
                                    } while (F < t);D++;
                                    E += C
                                } while (E < u)
                            }
                        }
                    B && (r = l,
                    20 > b.f.c && l < this.Fe && (this.Ah = !0));
                    g = q;
                    l--
                }
                this.Yi();
                c.uniform1i(c.getUniformLocation(e, "tileTexture"), 0);
                c.activeTexture(c.TEXTURE0);
                l = f;
                for (f = -1; l <= Math.min(r, this.Fe - 1); ) {
                    k = d[l];
                    for (z in k.V)
                        if (k.V.hasOwnProperty(z)) {
                            g = Number(z);
                            y = k.V[g];
                            p = Math.floor(g / (k.M * k.ea));
                            u = Math.floor((g - p * k.M * k.ea) / k.M);
                            t = Math.floor(g - (u * k.M + p * k.M * k.ea));
                            f != p && (f = p,
                            this.Jh(p, e));
                            if (h > b.je) {
                                b.L("Excided painted tiles");
                                this.Ah = !1;
                                break
                            }
                            y.bb && (g = p = a.G,
                            t == k.M - 1 && (p = k.width - a.G * t),
                            u == k.ea - 1 && (g = k.height - a.G * u),
                            p = (p + 2 * a.Ka) / a.G,
                            g = (g + 2 * a.Ka) / a.G,
                            c.bindTexture(c.TEXTURE_2D, y.bb),
                            c.uniform2f(c.getUniformLocation(e, "uCanvasDimensions"), b.m.width, b.m.height),
                            n = c.getUniformLocation(e, "srcScale"),
                            c.uniform2f(n, .5 * k.width / a.G / p, .5 * k.height / a.G / g),
                            n = c.getUniformLocation(e, "srcOffset"),
                            c.uniform2f(n, (.5 * k.width + a.Ka - a.G * t) / a.G / p, -(.5 * k.height + a.Ka - a.G * u) / a.G / g + 1),
                            n = c.getUniformLocation(e, "zOffset"),
                            c.uniform1f(n, (l + 1) / (d.length + 5)),
                            p = c.getAttribLocation(e, "aVertexPosition"),
                            c.disableVertexAttribArray(0),
                            c.disableVertexAttribArray(1),
                            c.disableVertexAttribArray(2),
                            c.enableVertexAttribArray(p),
                            c.activeTexture(c.TEXTURE0),
                            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MAG_FILTER, c.LINEAR),
                            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_MIN_FILTER, c.LINEAR),
                            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE),
                            c.texParameteri(c.TEXTURE_2D, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE),
                            c.bindBuffer(c.ARRAY_BUFFER, this.gn),
                            c.vertexAttribPointer(p, 2, c.FLOAT, !1, 0, 0),
                            c.bufferData(c.ARRAY_BUFFER, new Float32Array(y.Wc), c.DYNAMIC_DRAW),
                            c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, this.fn),
                            c.bufferData(c.ELEMENT_ARRAY_BUFFER, new Uint16Array(y.ge), c.DYNAMIC_DRAW),
                            c.drawElements(c.TRIANGLES, y.md, c.UNSIGNED_SHORT, 0),
                            h++)
                        }
                    l++
                }
                c.disable(c.CULL_FACE);
                c.cullFace(c.FRONT_AND_BACK);
                b.Pc = !1
            }
        }
        ;
        g.prototype.Jh = function(b, a) {
            var d = this.g
              , c = d.H;
            m.T.Jd(this.cb);
            m.T.Jd(this.da);
            m.T.rotate(this.da, d.N.c * Math.PI / 180, [0, 0, 1]);
            m.T.rotate(this.da, d.j.c * Math.PI / 180, [1, 0, 0]);
            m.T.rotate(this.da, -d.pan.c * Math.PI / 180, [0, 1, 0]);
            d.Ca && (m.T.rotate(this.da, -d.Ca.pitch * Math.PI / 180, [1, 0, 0]),
            m.T.rotate(this.da, d.Ca.N * Math.PI / 180, [0, 0, 1]));
            4 > b ? m.T.rotate(this.da, -Math.PI / 2 * b, [0, 1, 0]) : m.T.rotate(this.da, Math.PI / 2 * (5 == b ? 1 : -1), [1, 0, 0]);
            c.uniformMatrix4fv(c.getUniformLocation(a, "matRotate"), !1, this.da)
        }
        ;
        g.prototype.En = function() {
            var b = this.g;
            if (b.H) {
                var a = b.H, d, c = this.Vk;
                a.useProgram(c);
                this.Jh(0, c);
                a.uniform2f(a.getUniformLocation(c, "uCanvasDimensions"), b.m.width, b.m.height);
                1 == b.o.format && (d = a.getUniformLocation(c, "srcScale"),
                a.uniform2f(d, -.5 / Math.PI, (b.o.ti ? -1 : 1) / Math.PI));
                14 == b.o.format && (d = a.getUniformLocation(c, "srcScale"),
                a.uniform2f(d, 1 - 2 * b.o.ze / (b.o.width / 3), 1 - 2 * b.o.ze / (b.o.height / 2)));
                d = a.getUniformLocation(c, "srcOffset");
                a.uniform2f(d, .5, .5);
                this.mj(c);
                d = a.getUniformLocation(c, "cubeTexture");
                a.uniform1i(d, 0);
                d = a.getAttribLocation(c, "aVertexPosition");
                a.disableVertexAttribArray(0);
                a.disableVertexAttribArray(1);
                a.disableVertexAttribArray(2);
                a.enableVertexAttribArray(d);
                a.bindBuffer(a.ARRAY_BUFFER, this.sh);
                a.vertexAttribPointer(d, 2, a.FLOAT, !1, 0, 0);
                a.activeTexture(a.TEXTURE0);
                a.bindTexture(a.TEXTURE_2D, b.o.hc);
                a.texParameteri(a.TEXTURE_2D, a.TEXTURE_WRAP_S, a.CLAMP_TO_EDGE);
                a.texParameteri(a.TEXTURE_2D, a.TEXTURE_WRAP_T, a.CLAMP_TO_EDGE);
                a.texParameteri(a.TEXTURE_2D, a.TEXTURE_MIN_FILTER, a.LINEAR);
                a.texParameteri(a.TEXTURE_2D, a.TEXTURE_MAG_FILTER, a.LINEAR);
                a.bindBuffer(a.ELEMENT_ARRAY_BUFFER, this.Nc);
                a.drawElements(a.TRIANGLES, 6, a.UNSIGNED_SHORT, 0)
            }
        }
        ;
        g.prototype.mj = function(b) {
            var a = this.g
              , d = a.H
              , c = this.g.m
              , e = c.width / c.height;
            switch (a.f.mode) {
            case 1:
                e = 1;
                break;
            case 2:
                e = c.width / Math.sqrt(c.width * c.width + c.height * c.height);
                break;
            case 3:
                4 * c.height / 3 < c.width && (e = 4 / 3)
            }
            c = d.getUniformLocation(b, "rectDstDistance");
            this.Wi = Math.tan(Math.min(a.f.c, 179) / 2 * Math.PI / 180) * e;
            d.uniform1f(c, this.Wi);
            c = d.getUniformLocation(b, "fisheyeDistance");
            this.ri = 180 / (a.f.c * Math.PI * e);
            d.uniform1f(c, this.ri);
            c = d.getUniformLocation(b, "stereoDistance");
            this.fj = Math.tan(Math.min(a.f.c, 359) / 4 * Math.PI / 180) * e;
            d.uniform1f(c, this.fj);
            c = d.getUniformLocation(b, "directionBlend");
            d.uniform1f(c, a.Zf)
        }
        ;
        g.prototype.Dn = function() {
            var b = this.g
              , a = b.H
              , d = this.Tk;
            a.useProgram(d);
            a.enable(a.DEPTH_TEST);
            this.Jh(0, d);
            a.uniform2f(a.getUniformLocation(d, "uCanvasDimensions"), b.m.width, b.m.height);
            b = a.getUniformLocation(d, "srcScale");
            a.uniform2f(b, 1, 1);
            b = a.getUniformLocation(d, "srcOffset");
            a.uniform2f(b, 0, 0);
            b = a.getUniformLocation(d, "zOffset");
            a.uniform1f(b, .9999);
            this.mj(d);
            this.Jh(0, d);
            b = a.getUniformLocation(d, "cubeTexture");
            a.uniform1i(b, 0);
            d = a.getAttribLocation(d, "aVertexPosition");
            a.disableVertexAttribArray(0);
            a.disableVertexAttribArray(1);
            a.disableVertexAttribArray(2);
            a.enableVertexAttribArray(d);
            a.bindBuffer(a.ARRAY_BUFFER, this.sh);
            a.vertexAttribPointer(d, 2, a.FLOAT, !1, 0, 0);
            a.activeTexture(a.TEXTURE0);
            a.bindTexture(a.TEXTURE_CUBE_MAP, this.rc);
            a.texParameteri(a.TEXTURE_CUBE_MAP, a.TEXTURE_WRAP_S, a.CLAMP_TO_EDGE);
            a.texParameteri(a.TEXTURE_CUBE_MAP, a.TEXTURE_WRAP_T, a.CLAMP_TO_EDGE);
            a.texParameteri(a.TEXTURE_CUBE_MAP, a.TEXTURE_MIN_FILTER, a.LINEAR);
            a.texParameteri(a.TEXTURE_CUBE_MAP, a.TEXTURE_MAG_FILTER, a.LINEAR);
            a.bindBuffer(a.ELEMENT_ARRAY_BUFFER, this.Nc);
            a.drawElements(a.TRIANGLES, 6, a.UNSIGNED_SHORT, 0)
        }
        ;
        g.prototype.pm = function() {
            for (var b = this.g, a = b.H, d = [1, 3, 5, 4, 0, 2], c = !0, e = !0, f = !1, l = 0; 6 > l; l++)
                this.Ua[l].ie.complete ? this.Jg[l] || (f = !0) : c = !1,
                this.Ua[l].Te.complete || (e = !1);
            if (e || c)
                if (!e || c || !this.rc || f) {
                    l = Math.round(b.ic / b.cf);
                    e = (b.ic - l) / 2;
                    b.L("paint cube single - isMain: " + c + " overlap: " + e);
                    this.Fe = 0;
                    this.rc || (this.rc = a.createTexture());
                    b.Vc++;
                    a.bindTexture(a.TEXTURE_CUBE_MAP, this.rc);
                    a.texParameteri(a.TEXTURE_CUBE_MAP, a.TEXTURE_WRAP_S, a.CLAMP_TO_EDGE);
                    a.texParameteri(a.TEXTURE_CUBE_MAP, a.TEXTURE_WRAP_T, a.CLAMP_TO_EDGE);
                    a.pixelStorei(a.UNPACK_FLIP_Y_WEBGL, 1);
                    f = document.createElement("canvas");
                    f.width = l;
                    f.height = l;
                    for (var h = f.getContext("2d"), l = 0; 6 > l; l++) {
                        var g = d[l];
                        this.Ua[g].ie.complete ? this.Jg[g] || (h.drawImage(this.Ua[g].ie, -e, -e),
                        a.texImage2D(a.TEXTURE_CUBE_MAP_POSITIVE_X + l, 0, a.RGBA, a.RGBA, a.UNSIGNED_BYTE, f),
                        this.Jg[g] = !0) : (h.drawImage(this.Ua[g].Te, -e, -e, b.ic, b.ic),
                        a.texImage2D(a.TEXTURE_CUBE_MAP_POSITIVE_X + l, 0, a.RGBA, a.RGBA, a.UNSIGNED_BYTE, f))
                    }
                    this.Nf = !c
                }
        }
        ;
        g.prototype.om = function() {
            var b = this.g, a = this.g.h, d = b.h.I, c = b.H, e, f;
            e = d.length - 1;
            if (!(0 > e)) {
                d[e].Ue && e--;
                var l = 512;
                b.Mf && (l = 256);
                !b.Ye && 2 <= b.devicePixelRatio && (l = 512);
                for ((f = c.getParameter(c.MAX_CUBE_MAP_TEXTURE_SIZE)) && f < l && (l = f); 0 < e && d[e - 1].width <= l; )
                    e--;
                var h, l = d[e];
                if (0 != l.M && (f = e,
                h = this.lm(e),
                this.Nf && h && (this.Nf = !1),
                h || (e = d.length - 1,
                l = d[e],
                h || (l.Ue ? (h = l.loaded,
                this.Gi(e - 1) && (--e,
                h = !0)) : h = this.Gi(e)),
                this.Nf = !0),
                this.Gi(f),
                h && this.Fe > e)) {
                    l = d[e];
                    b.L("paint cube level " + e);
                    this.Fe = e;
                    d = b.h.Ka;
                    e = 0 < d || 1 < l.M || 1 < l.ea;
                    var g;
                    if (e) {
                        var k = document.createElement("canvas");
                        k.width = l.width;
                        k.height = l.height;
                        2048 > l.width && (1500 < l.width ? (k.width = 2048,
                        k.height = 2048) : 700 < l.width ? (k.width = 1024,
                        k.height = 1024) : (k.width = 512,
                        k.height = 512));
                        g = k.getContext("2d")
                    }
                    this.rc = c.createTexture();
                    b.Vc++;
                    c.bindTexture(c.TEXTURE_CUBE_MAP, this.rc);
                    c.texParameteri(c.TEXTURE_CUBE_MAP, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE);
                    c.texParameteri(c.TEXTURE_CUBE_MAP, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE);
                    c.pixelStorei(c.UNPACK_FLIP_Y_WEBGL, 1);
                    f = [1, 3, 5, 4, 0, 2];
                    h = k.width / l.width;
                    for (var a = a.G, n = 0; 6 > n; n++) {
                        for (var m = 0; m < l.ea; m++)
                            for (var p = 0; p < l.M; p++) {
                                var u = p + m * l.M + f[n] * l.M * l.ea
                                  , t = l.V[u]
                                  , v = t.h;
                                t.K && (v = t.K);
                                v ? e ? g.drawImage(v, h * (p * a - d), h * (m * a - d), h * v.width, h * v.height) : c.texImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + n, 0, c.RGBA, c.RGBA, c.UNSIGNED_BYTE, v) : (b.L("WTF?!"),
                                b.L(u),
                                b.L(t))
                            }
                        e && c.texImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + n, 0, c.RGBA, c.RGBA, c.UNSIGNED_BYTE, k)
                    }
                }
            }
        }
        ;
        g.prototype.Gi = function(b) {
            var a = this.g
              , d = a.h.I[b];
            if (0 == d.M)
                return !1;
            var c = !0;
            d.cache = !0;
            for (var e = 0; 6 > e; e++)
                for (var f = 0; f < d.ea; f++)
                    for (var l = 0; l < d.M; l++) {
                        var h = l + f * d.M + e * d.M * d.ea
                          , g = d.V[h];
                        g || (g = d.V[h] = new m.Id);
                        this.Og() ? g.h || (g.Pd ? g.Pd-- : (this.ih(g, d, a.se(e, b, l, f)),
                        a.za = !0)) : this.g.uc++;
                        g.bb || (c = !1,
                        a.za = !0)
                    }
            c && (d.loaded = !0);
            return c
        }
        ;
        g.prototype.lm = function(b) {
            b = this.g.h.I[b];
            if (0 == b.M)
                return !1;
            for (var a = 0; 6 > a; a++)
                for (var d = 0; d < b.ea; d++)
                    for (var c = 0; c < b.M; c++) {
                        var e = b.V[c + d * b.M + a * b.M * b.ea];
                        if (!e || !e.bb)
                            return !1
                    }
            return b.loaded = !0
        }
        ;
        g.prototype.ready = function() {
            return null != this.rc
        }
        ;
        g.prototype.Yi = function() {
            for (var b = this.g, a = b.h.I, d = b.H, c = Date.now(), e = a.length - 1; 0 <= e; e--) {
                var f = a[e];
                if (!f.cache)
                    for (var l in f.V)
                        if (f.V.hasOwnProperty(l)) {
                            var h = f.V[l];
                            0 < h.fh && h.fh--;
                            h.visible || 0 < h.fh ? (h.visible && (h.Sf = c),
                            h = this.Fd.indexOf(h),
                            -1 !== h && this.Fd.splice(h, 1)) : -1 === this.Fd.indexOf(h) && (h.level = f,
                            this.Fd.push(h))
                        }
            }
            if (this.Fd.length > 1.1 * b.ql)
                for (this.Fd.sort(function(a, c) {
                    return c.Sf - a.Sf
                }); this.Fd.length > b.ql; )
                    h = this.Fd.pop(),
                    h.bb && (d.deleteTexture(h.bb),
                    b.Vc--,
                    h.bb = 0),
                    h.h = null,
                    h.Le && (d.deleteBuffer(h.Le),
                    h.Le = 0),
                    l = h.level.V.indexOf(h),
                    b.L("delete " + l + " " + (c - h.Sf)),
                    delete h.level.V[l]
        }
        ;
        g.prototype.To = function() {
            var b = this.g;
            if (b.H) {
                var a = this.g.H;
                a.disable(a.DEPTH_TEST);
                var d;
                for (d = 0; d < b.J.length; d++) {
                    var c = b.J[d];
                    if (!c.$c) {
                        m.T.Jd(this.da);
                        m.T.rotate(this.da, -b.N.c * Math.PI / 180, [0, 0, 1]);
                        m.T.rotate(this.da, -b.j.c * Math.PI / 180, [1, 0, 0]);
                        m.T.rotate(this.da, (180 - b.pan.c) * Math.PI / 180, [0, 1, 0]);
                        m.T.rotate(this.da, c.pan * Math.PI / 180, [0, 1, 0]);
                        m.T.rotate(this.da, -c.j * Math.PI / 180, [1, 0, 0]);
                        m.T.translate(this.da, [0, 0, 1]);
                        m.T.rotate(this.da, c.mb * Math.PI / 180, [0, 0, 1]);
                        m.T.rotate(this.da, -c.Da * Math.PI / 180, [0, 1, 0]);
                        m.T.rotate(this.da, c.va * Math.PI / 180, [1, 0, 0]);
                        var e = Math.tan(c.f / 2 * Math.PI / 180)
                          , f = c.Ud;
                        f || (f = 16 / 9);
                        m.T.scale(this.da, [e, e / f, 1]);
                        m.T.translate(this.da, [0, 0, -1]);
                        a.bindBuffer(a.ARRAY_BUFFER, this.ei);
                        a.vertexAttribPointer(this.F.$, 3, a.FLOAT, !1, 0, 0);
                        a.bindBuffer(a.ARRAY_BUFFER, this.Zd);
                        a.vertexAttribPointer(this.F.wa, 2, a.FLOAT, !1, 0, 0);
                        a.activeTexture(a.TEXTURE0);
                        a.bindTexture(a.TEXTURE_2D, c.hc);
                        a.texParameteri(a.TEXTURE_2D, a.TEXTURE_MAG_FILTER, a.LINEAR);
                        a.texParameteri(a.TEXTURE_2D, a.TEXTURE_MIN_FILTER, a.LINEAR);
                        a.texParameteri(a.TEXTURE_2D, a.TEXTURE_WRAP_S, a.CLAMP_TO_EDGE);
                        a.texParameteri(a.TEXTURE_2D, a.TEXTURE_WRAP_T, a.CLAMP_TO_EDGE);
                        a.bindBuffer(a.ELEMENT_ARRAY_BUFFER, this.Nc);
                        a.uniform1i(this.F.Ze, 0);
                        a.uniformMatrix4fv(this.F.Yf, !1, this.da);
                        a.uniformMatrix4fv(this.F.Nd, !1, this.cb);
                        a.drawElements(a.TRIANGLES, 6, a.UNSIGNED_SHORT, 0)
                    }
                }
                a.enable(a.DEPTH_TEST)
            }
        }
        ;
        g.prototype.So = function() {
            var b = this.g, a;
            if (b.m.width != b.C.offsetWidth || b.m.height != b.C.offsetHeight)
                b.m.width = b.C.offsetWidth,
                b.m.height = b.C.offsetHeight;
            b.de && (b.Bc(0),
            b.dd());
            if (b.H) {
                var d = b.H;
                d.useProgram(this.F);
                m.T.Jd(this.cb);
                m.T.perspective(b.Jb(), b.jb.width / b.jb.height, .1, 100, this.cb);
                d.uniformMatrix4fv(this.F.Nd, !1, this.cb);
                this.kg(0);
                d.uniform1i(this.F.Ze, 0);
                d.uniformMatrix4fv(this.F.Nd, !1, this.cb);
                d.uniformMatrix4fv(this.F.Yf, !1, this.da);
                d.enableVertexAttribArray(this.F.$);
                d.enableVertexAttribArray(this.F.wa);
                d.bindBuffer(d.ARRAY_BUFFER, this.Zd);
                d.vertexAttribPointer(this.F.wa, 2, d.FLOAT, !1, 0, 0);
                d.activeTexture(d.TEXTURE0);
                d.bindBuffer(d.ELEMENT_ARRAY_BUFFER, this.Nc);
                d.uniform1f(this.F.Qh, 1E-4);
                d.vertexAttribPointer(this.F.$, 3, d.FLOAT, !1, 0, 0);
                d.bindTexture(d.TEXTURE_2D, b.o.hc);
                for (a = 0; 1 > a; a++)
                    this.kg(0),
                    d.bindBuffer(d.ARRAY_BUFFER, b.o.rj),
                    d.vertexAttribPointer(this.F.$, 3, d.FLOAT, !1, 0, 0),
                    d.bindBuffer(d.ARRAY_BUFFER, b.o.Ch),
                    d.vertexAttribPointer(this.F.wa, 2, d.FLOAT, !1, 0, 0),
                    d.activeTexture(d.TEXTURE0),
                    d.bindBuffer(d.ELEMENT_ARRAY_BUFFER, b.o.Ci),
                    d.uniform1i(this.F.Ze, 0),
                    d.uniformMatrix4fv(this.F.Yf, !1, this.da),
                    d.uniformMatrix4fv(this.F.Nd, !1, this.cb),
                    d.drawElements(d.TRIANGLES, 36, d.UNSIGNED_SHORT, 0)
            }
        }
        ;
        g.prototype.Ro = function() {
            var b = this.g
              , a = b.H
              , d = b.o;
            if (0 < b.J.length)
                for (var c = 0; c < b.J.length; c++) {
                    var e = b.J[c];
                    if (!e.$c && e.tk && e.Vg != e.a.currentTime && (e.Vg = e.a.currentTime,
                    !e.Ud && 0 < e.a.videoHeight && (e.Ud = e.a.videoWidth / e.a.videoHeight),
                    b.wg))
                        try {
                            e.hc && (a.bindTexture(a.TEXTURE_2D, e.hc),
                            a.texImage2D(a.TEXTURE_2D, 0, a.RGB, a.RGB, a.UNSIGNED_BYTE, e.a),
                            b.update())
                        } catch (l) {
                            b.L(l)
                        }
                }
            if (d.a && (c = Number(d.a.currentTime),
            d.Vg != c)) {
                d.Vg = c;
                try {
                    var f = 0 < d.a.readyState;
                    b.Lf && d.Xc && (f = f && 0 < d.a.currentTime);
                    d.hc && d.bh && f && (d.Xc = !0,
                    d.width = d.a.videoWidth,
                    d.height = d.a.videoHeight,
                    a.pixelStorei(a.UNPACK_FLIP_Y_WEBGL, b.o.ti),
                    a.bindTexture(a.TEXTURE_2D, d.hc),
                    a.texImage2D(a.TEXTURE_2D, 0, a.RGB, a.RGB, a.UNSIGNED_BYTE, d.a),
                    d.pl = !0,
                    b.update())
                } catch (l) {
                    b.L(l)
                }
            }
        }
        ;
        g.prototype.Lk = function() {
            var b, a, d = this.g, c = this.g.H;
            d.sa.style.visibility = "hidden";
            d.w.Qf != d.w.mode && (d.w.Qf = d.w.mode);
            if ((0 <= d.w.mode || 0 < d.w.fb.length) && !d.B.rg) {
                var e = 1;
                0 >= d.w.mode && (e = 0);
                3 == d.w.mode && (e = d.w.na);
                for (b = 0; b < d.P.length; b++) {
                    var f = d.P[b];
                    if ("poly" == f.type) {
                        var l = f.Od
                          , h = e;
                        2 == d.w.mode && (h = f.na);
                        var g = d.w.fb.indexOf(f.id);
                        -1 != g && (h = d.w.Eb[g]);
                        if (0 < l.length) {
                            g = [];
                            for (a = 0; a < l.length; a++)
                                g.push(l[a].gc),
                                g.push(l[a].Cb),
                                g.push(0);
                            c.useProgram(this.td);
                            c.enable(c.BLEND);
                            c.blendFuncSeparate(c.SRC_ALPHA, c.ONE_MINUS_SRC_ALPHA, c.SRC_ALPHA, c.ONE);
                            c.disable(c.DEPTH_TEST);
                            l = c.createBuffer();
                            c.bindBuffer(c.ARRAY_BUFFER, l);
                            c.bufferData(c.ARRAY_BUFFER, new Float32Array(g), c.STATIC_DRAW);
                            c.uniform2f(c.getUniformLocation(this.td, "uCanvasDimensions"), d.m.width, d.m.height);
                            l = c.getUniformLocation(this.td, "uColor");
                            a = f.Sb;
                            c.uniform3f(l, (a >> 16 & 255) / 255, (a >> 8 & 255) / 255, (a & 255) / 255);
                            var k = c.getUniformLocation(this.td, "uAlpha");
                            c.uniform1f(k, f.Rb * h);
                            c.vertexAttribPointer(this.td.$, 3, c.FLOAT, !1, 0, 0);
                            c.drawArrays(c.LINE_LOOP, 0, g.length / 3);
                            a = f.Pb;
                            c.uniform3f(l, (a >> 16 & 255) / 255, (a >> 8 & 255) / 255, (a & 255) / 255);
                            c.uniform1f(k, f.Ob * h);
                            c.enable(c.STENCIL_TEST);
                            c.clearStencil(0);
                            c.clear(c.STENCIL_BUFFER_BIT);
                            c.colorMask(!1, !1, !1, !1);
                            c.stencilFunc(c.ALWAYS, 1, 1);
                            c.stencilOp(c.INCR, c.INCR, c.INCR);
                            c.drawArrays(c.TRIANGLE_FAN, 0, g.length / 3);
                            c.colorMask(!0, !0, !0, !0);
                            c.stencilFunc(c.EQUAL, 1, 1);
                            c.stencilOp(c.ZERO, c.ZERO, c.ZERO);
                            c.drawArrays(c.TRIANGLE_FAN, 0, g.length / 3);
                            c.disable(c.BLEND);
                            c.enable(c.DEPTH_TEST);
                            c.disable(c.STENCIL_TEST);
                            c.useProgram(this.F)
                        }
                    }
                }
            }
        }
        ;
        g.prototype.lj = function() {
            var b = this.g
              , a = b.h;
            if (b.m.width != b.C.offsetWidth || b.m.height != b.C.offsetHeight)
                b.m.width = b.C.offsetWidth,
                b.m.height = b.C.offsetHeight;
            b.de && (b.Bc(0),
            b.dd());
            if (b.H) {
                var d = b.H;
                this.Ih();
                d.clear(d.COLOR_BUFFER_BIT | d.DEPTH_BUFFER_BIT);
                d.disable(d.DEPTH_TEST);
                d.disable(d.CULL_FACE);
                d.useProgram(this.xf);
                var c = d.getUniformLocation(this.xf, "uRect");
                d.uniform2f(d.getUniformLocation(this.xf, "uCanvasDimensions"), b.m.width, b.m.height);
                d.activeTexture(d.TEXTURE0);
                var e;
                d.bindBuffer(d.ELEMENT_ARRAY_BUFFER, this.Nc);
                e = d.getAttribLocation(this.xf, "aVertexPosition");
                d.disableVertexAttribArray(0);
                d.disableVertexAttribArray(1);
                d.disableVertexAttribArray(2);
                d.enableVertexAttribArray(e);
                d.bindBuffer(d.ARRAY_BUFFER, this.Zd);
                d.vertexAttribPointer(e, 2, d.FLOAT, !1, 0, 0);
                b.uc = 0;
                var f, l;
                l = 100 / b.f.c;
                f = a.width / a.height;
                e = b.m.height * l * f;
                l *= b.m.height;
                f = (b.pan.c / 100 / f - .5) * e + b.m.width / 2;
                for (var h = (b.j.c / 100 - .5) * l + b.m.height / 2, g, k, n, r = 0; a.I.length >= r + 2 && a.I[r + 1].width > e; )
                    r++;
                var p, u;
                u = [];
                for (p = a.I.length - 1; p >= r; ) {
                    var t = a.I[p], v;
                    t.cache ? (v = {
                        Wa: 0,
                        rb: 0
                    },
                    v.tb = t.M - 1,
                    v.ub = t.ea - 1) : (v = {},
                    g = -h / l * (t.height / b.h.G),
                    k = (-f + b.m.width) / e * (t.width / b.h.G),
                    n = (-h + b.m.height) / l * (t.height / b.h.G),
                    v.Wa = Math.min(Math.max(0, Math.floor(-f / e * (t.width / b.h.G))), t.M - 1),
                    v.rb = Math.min(Math.max(0, Math.floor(g)), t.ea - 1),
                    v.tb = Math.min(Math.max(0, Math.floor(k)), t.M - 1),
                    v.ub = Math.min(Math.max(0, Math.floor(n)), t.ea - 1));
                    u[p] = v;
                    var q = !0;
                    for (k = v.rb; k <= v.ub; k++)
                        for (g = v.Wa; g <= v.tb; g++) {
                            n = g + k * t.M;
                            var w = t.V[n];
                            w || (w = new m.Id,
                            t.V[n] = w);
                            this.Og() ? w.h || (this.ih(w, t, b.se(0, p, g, k)),
                            b.za = !0) : this.g.uc++;
                            w.h && w.h.complete || (q = !1);
                            w.visible = !0
                        }
                    v.Fi = q;
                    p--
                }
                for (p = a.I.length - 1; p >= r; ) {
                    t = a.I[p];
                    if (u[p] && 0 <= u[p].Wa)
                        for (v = u[p],
                        k = v.rb; k <= v.ub; k++)
                            for (g = v.Wa; g <= v.tb; g++)
                                n = g + k * t.M,
                                (w = t.V[n]) && w.h && w.h.complete && (d.uniform4f(c, f + (-a.Ka + a.G * g) * e / t.width, h + (-a.Ka + a.G * k) * l / t.height, w.h.width * e / t.width, w.h.height * l / t.height),
                                w && w.bb && (d.bindBuffer(d.ELEMENT_ARRAY_BUFFER, this.Nc),
                                d.bindTexture(d.TEXTURE_2D, w.bb),
                                d.texParameteri(d.TEXTURE_2D, d.TEXTURE_MAG_FILTER, d.LINEAR),
                                d.texParameteri(d.TEXTURE_2D, d.TEXTURE_MIN_FILTER, d.LINEAR),
                                d.texParameteri(d.TEXTURE_2D, d.TEXTURE_WRAP_S, d.CLAMP_TO_EDGE),
                                d.texParameteri(d.TEXTURE_2D, d.TEXTURE_WRAP_T, d.CLAMP_TO_EDGE),
                                d.drawElements(d.TRIANGLES, 6, d.UNSIGNED_SHORT, 0)));
                    p--
                }
                this.Yi()
            }
        }
        ;
        g.prototype.th = function() {
            var b = this.g.H;
            if (b && this.Ua)
                for (; 0 < this.Ua.length; ) {
                    var a = this.Ua.pop();
                    a.yn = !0;
                    b.deleteTexture(a)
                }
            this.rc && (b.deleteTexture(this.rc),
            this.rc = null);
            this.Fe = 1E6;
            this.Jg = [!1, !1, !1, !1, !1, !1]
        }
        ;
        return g
    }();
    m.Ul = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        return function() {
            this.Re = {
                yf: 1,
                zf: 1,
                Uf: 0,
                Vf: 0,
                hf: 0,
                yg: 0,
                scale: 1
            };
            this.qc = !0;
            this.Be = []
        }
    }()
      , g = function() {
        function b() {
            var a;
            this.ab = Array(6);
            for (a = 0; 6 > a; a++)
                this.ab[a] = new k
        }
        b.prototype.mm = function(a, d, c, b) {
            for (var f = 0; 6 > f; f++) {
                var l;
                if (l = this.ab[f]) {
                    var h;
                    h = [];
                    h.push(new m.ra(-1,-1,-1,0,0));
                    h.push(new m.ra(1,-1,-1,1,0));
                    h.push(new m.ra(1,1,-1,1,1));
                    h.push(new m.ra(-1,1,-1,0,1));
                    for (var g = 0; g < h.length; g++)
                        4 > f ? h[g].Da(-Math.PI / 2 * f) : h[g].va(Math.PI / 2 * (4 === f ? -1 : 1)),
                        b && (h[g].mb(b.N * Math.PI / 180),
                        h[g].va(-b.pitch * Math.PI / 180)),
                        h[g].Da(-a * Math.PI / 180),
                        h[g].va(d * Math.PI / 180),
                        h[g].mb(c * Math.PI / 180);
                    l.qc = 0 < h.length
                }
            }
        }
        ;
        return b
    }();
    m.Ql = g
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    m.Pl = function() {
        return function() {
            this.I = [];
            this.Ve = "0x000000";
            this.Pk = !1;
            this.Ck = this.Bk = .4;
            this.G = 512;
            this.Ka = 1;
            this.Ei = 0;
            this.Dk = "";
            this.Xk = this.height = this.width = 0
        }
    }();
    m.Kk = function() {
        return function() {
            this.height = this.width = 0;
            this.Ue = this.cache = !1;
            this.ea = this.M = 0;
            this.loaded = !1;
            this.V = []
        }
    }();
    m.Id = function() {
        return function() {
            this.loaded = this.visible = !1;
            this.Pd = this.Xi = 0;
            this.Wc = [];
            this.Wg = 0;
            this.ge = [];
            this.fh = this.Sf = this.md = 0
        }
    }()
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    m.Kl = function() {
        return function(k, g) {
            this.g = k;
            this.ya = g;
            var b, a, d = this.__div = document.createElement("div");
            b = document.createElement("img");
            b.setAttribute("src", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA5xJREFUeNqclmlIVFEUx997TjrplFQW2WKBBSYtRFlpWUILSSsRZRQIBdGHCFqIoKIvQRsUFRJC9LEgaSFbMMpcWi1pLzOLsjItKms0U5t5/c/wH7nc5o2jF374xrv87z33nHOPaRsRtbFgDpgJxoD+wATfwDNQDK6CyrCr5OcbhgiGIRsUAZt4QTWoIFXgp9JfAhY7rgdBl8NeBoLDYBloA+dBOagFTcDHcVEgDgwBGWA+OAcugvXgvb5wKMGJoAAMp9BpUA96EBf/Btsf8BI8AWfAErAcpHHDZeriliY2AVwDg8AucAQ0Ag+I4XhTm2Oxz8PT46KMbTx5EZjuJDgAnAVusJUm9DhYwalFcc59sIXXIaceFkowDySBPTRPL20xm+b7zYXa+N3CPrWJ6GuwGySA40HLBHc/GywFhbS5R1lEBrZy7FQwiSaX9pmnqeAYt+KUcew7BVZw/QKTq0ocpYPVvDOXItZCk2xgDIZqL8BR8Ab0VDbr4yZOgLeIwzQx6WiQxcCt1+6sld66L4yYtFSwF4yg2dU7/cEwGW9YVkAwmycp1dzdpvgm0DcCh4kHmxWzBls0uBX4qqmZJ4KzePm1IeJLgjmlC16aDKZpp5Q168B3o6wsSwTHgU+MIUs74RSj6y1d+212HKimJlUE+tFRfJpYtOKNXWmJTASqWf2Bu/R6+4TKHOrOzG4IhptjWgHbGkZvepQ6SQK7oRuCXzjX1DJavBEX1ygfT8FgBqpfm1zRDcEKbR2bsZlkJCdXieB1ZhZ5YtqVgXIPN+m9kbY6hpdb+d9fPncJRmZmqQheZkemJmgxyxykl3XWJEkcAl7N21s7PDcl5ZJ0PAa3wVwmWtVbZafPwQ7wLozYB7ATPNJO56d/LAikP9u+66KNJS1d4IOZp7wU0hfLukUyzgwm70T2N/DOxIy/eFdqawa5DL2NEGwP5k15Ja4woz9glvcomd9NzyvkFcQo5gomaLfm5c0svnKZ2k7q7+FauvR2MJKZR3+sY5WgtvkdG6JyELGhNHMTXyGfLviRJ5Tcd4Dlhle7086Sgp8CqVxDkn4OqHaqacr5ekjy3Q/W0FRNNGmoMtamdzdxsytZC0lqXKhEgWPVVgImg2NgFT1MHOoOk3yLEtgWN5TEOYvoIFI1rGM19//2wpAD7imF7lfwENwAxaASNCj90pcLLKdC2Iyw1M9gnEplMEp5kOU1f8WwKGJm8oUr9f8JMAAVMDM6HSDa9QAAAABJRU5ErkJggg%3D%3D");
            b.setAttribute("style", "position: absolute;width: 28px; height: 28px;top: -14px;left: -14px; " + k.Ja + "user-select: none;");
            b.ondragstart = function() {
                return !1
            }
            ;
            d.appendChild(b);
            b = "position:absolute;" + (k.Ja + "user-select: none;");
            b += k.Ja + "touch-callout: none;";
            b += k.Ja + "tap-highlight-color: rgba(0,0,0,0);";
            k.qd && !k.Z && (b += k.Ja + "transform: translateZ(9999999px);");
            d.setAttribute("style", b);
            d.onclick = function() {
                k.$e(g);
                k.Pi(g.url, g.target)
            }
            ;
            var c = k.w.jj;
            c.enabled && (a = document.createElement("div"),
            b = "position:absolute;top:\t 20px;",
            b = c.Ph ? b + "white-space: pre-wrap;" : b + "white-space: nowrap;",
            b += k.Ja + "transform-origin: 50% 50%;",
            a.setAttribute("style", b + "visibility: hidden;overflow: hidden;padding: 0px 1px 0px 1px;font-size: 13px;"),
            a.style.color = this.g.fa(c.kj, c.ij),
            c.background ? a.style.backgroundColor = this.g.fa(c.Pb, c.Ob) : a.style.backgroundColor = "transparent",
            a.style.border = "solid " + this.g.fa(c.Sb, c.Rb) + " " + c.Xh + "px",
            a.style.borderRadius = c.Wh + "px",
            a.style.textAlign = "center",
            0 < c.width ? (a.style.left = -c.width / 2 + "px",
            a.style.width = c.width + "px") : a.style.width = "auto",
            a.style.height = 0 < c.height ? c.height + "px" : "auto",
            a.style.overflow = "hidden",
            a.innerHTML = g.title,
            d.onmouseover = function() {
                0 == c.width && (a.style.left = -a.offsetWidth / 2 + "px");
                a.style.visibility = "inherit"
            }
            ,
            d.onmouseout = function() {
                a.style.visibility = "hidden"
            }
            ,
            d.appendChild(a))
        }
    }()
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    m.yc = function() {
        return function() {
            this.Yd = this.Xd = this.Jc = this.Wd = this.vb = this.type = this.nb = this.value = this.time = 0
        }
    }();
    m.Ek = function() {
        return function() {
            this.Lo = this.Xl = this.length = 0
        }
    }();
    m.uk = function() {
        return function() {}
    }()
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g(b) {
            this.g = b;
            this.enabled = !1;
            this.Dg = 1;
            this.Ae = 0;
            this.type = "crossdissolve";
            this.Nb = this.Na = this.tc = 0;
            this.jf = 5;
            this.Td = 1;
            this.kf = !1;
            this.re = this.qe = this.ej = 0;
            this.zd = 70;
            this.Jl = 0;
            this.ob = this.Il = 1;
            this.Bg = this.Ag = .5;
            this.Vd = this.Oh = this.jh = this.eh = !1;
            this.hi = 1
        }
        g.prototype.Kf = function() {
            var b = this.g.H
              , a = b.createShader(b.VERTEX_SHADER);
            b.shaderSource(a, "attribute vec3 aVertexPosition;\nattribute vec2 aTextureCoord;\nvarying vec2 vTextureCoord;\nuniform bool uZoomIn;\nuniform float uZoomFactor;\nuniform vec2 uZoomCenter;\nvoid main(void) {\n\t gl_Position = vec4(aVertexPosition, 1.0);\n\t if(!uZoomIn) {\n\t \n\t   vTextureCoord = aTextureCoord;\n\t }\n\t else {\n\t   vTextureCoord = (aTextureCoord - vec2(0.5, 0.5)) * (1.0/uZoomFactor) + uZoomCenter;\n\t }\n}\n");
            b.compileShader(a);
            b.getShaderParameter(a, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(a)),
            a = null);
            var d = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec2 vTextureCoord;\nuniform float uAlpha;\nuniform sampler2D uSampler;\nvoid main(void) {\n vec4 textureColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));\n gl_FragColor = vec4(textureColor.x, textureColor.y, textureColor.z, uAlpha);\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            this.ma = b.createProgram();
            b.attachShader(this.ma, a);
            b.attachShader(this.ma, d);
            b.linkProgram(this.ma);
            b.getProgramParameter(this.ma, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.ma.$ = b.getAttribLocation(this.ma, "aVertexPosition");
            b.enableVertexAttribArray(this.ma.$);
            this.ma.wa = b.getAttribLocation(this.ma, "aTextureCoord");
            b.enableVertexAttribArray(this.ma.wa);
            d = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec2 vTextureCoord;\nuniform float uColorPercent;\nuniform float uAlpha;\nuniform vec3 uDipColor;\nuniform sampler2D uSampler;\nvoid main(void) {\n vec4 textureColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));\n gl_FragColor = vec4(textureColor.x * (1.0 - uColorPercent) + uDipColor.x * uColorPercent, textureColor.y * (1.0 - uColorPercent) + uDipColor.y * uColorPercent, textureColor.z * (1.0 - uColorPercent) + uDipColor.z * uColorPercent, uAlpha);\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            this.Ra = b.createProgram();
            b.attachShader(this.Ra, a);
            b.attachShader(this.Ra, d);
            b.linkProgram(this.Ra);
            b.getProgramParameter(this.Ra, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.Ra.$ = b.getAttribLocation(this.Ra, "aVertexPosition");
            b.enableVertexAttribArray(this.Ra.$);
            this.Ra.wa = b.getAttribLocation(this.Ra, "aTextureCoord");
            b.enableVertexAttribArray(this.Ra.wa);
            d = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec2 vTextureCoord;\nuniform bool uRound;\nuniform float uRadius;\nuniform vec2 uRectDim;\nuniform vec2 uIrisCenter;\nuniform float uSoftEdge;\nuniform sampler2D uSampler;\nvoid main(void) {\n float alpha = 0.0;\n vec4 textureColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));\n if (uRound) {\n\t  vec2 diff = uIrisCenter - gl_FragCoord.xy;\n\t   float distFromCenter = sqrt( (diff.x * diff.x) + (diff.y * diff.y) );\n\t   if (distFromCenter > uRadius) {\n      alpha = 1.0;\n    } else {\n      alpha = 1.0 - ((uRadius - distFromCenter) / uSoftEdge);\n    };\n }\n else {\n    float alphaFromLeft = 1.0 - ((gl_FragCoord.x -(uIrisCenter.x - uRectDim.x)) / uSoftEdge);\n    float alphaFromRight = 1.0 - (((uIrisCenter.x + uRectDim.x) - gl_FragCoord.x) / uSoftEdge);\n    float alphaFromTop = 1.0 - ((gl_FragCoord.y -(uIrisCenter.y - uRectDim.y)) / uSoftEdge);\n    float alphaFromBottom = 1.0 - (((uIrisCenter.y + uRectDim.y) - gl_FragCoord.y) / uSoftEdge);\n    alpha = max(max(alphaFromLeft, alphaFromRight), max(alphaFromTop, alphaFromBottom));\n }\n gl_FragColor = vec4(textureColor.x, textureColor.y, textureColor.z, alpha);\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            this.Ga = b.createProgram();
            b.attachShader(this.Ga, a);
            b.attachShader(this.Ga, d);
            b.linkProgram(this.Ga);
            b.getProgramParameter(this.Ga, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.Ga.$ = b.getAttribLocation(this.Ga, "aVertexPosition");
            b.enableVertexAttribArray(this.Ga.$);
            this.Ga.wa = b.getAttribLocation(this.Ga, "aTextureCoord");
            b.enableVertexAttribArray(this.Ga.wa);
            d = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec2 vTextureCoord;\nuniform float uPercent;\nuniform int uDirection;\nuniform vec2 uCanvasDimensions;\nuniform float uSoftEdge;\nuniform sampler2D uSampler;\nvoid main(void) {\n vec4 textureColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));\n float alpha = 0.0;\n if (uDirection == 1) {\n\t if (gl_FragCoord.x > uPercent) {\n    alpha = 1.0; \n  } else {\n    alpha = 1.0 - ((uPercent - gl_FragCoord.x) / uSoftEdge);\n  }\n }\n if (uDirection == 2) {\n\t if (gl_FragCoord.x < uCanvasDimensions.x - uPercent) {\n    alpha = 1.0; \n  } else {\n    alpha = 1.0 - ((gl_FragCoord.x - (uCanvasDimensions.x - uPercent)) / uSoftEdge);\n  }\n }\n if (uDirection == 3) {\n\t if (gl_FragCoord.y < uCanvasDimensions.y - uPercent) {\n    alpha = 1.0; \n  } else {\n    alpha = 1.0 - ((gl_FragCoord.y - (uCanvasDimensions.y - uPercent)) / uSoftEdge);\n  }\n }\n if (uDirection == 4) {\n\t if (gl_FragCoord.y > uPercent) {\n    alpha = 1.0; \n  } else {\n    alpha = 1.0 - ((uPercent - gl_FragCoord.y) / uSoftEdge);\n  }\n }\n gl_FragColor = vec4(textureColor.x, textureColor.y, textureColor.z, alpha);\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            this.Ma = b.createProgram();
            b.attachShader(this.Ma, a);
            b.attachShader(this.Ma, d);
            b.linkProgram(this.Ma);
            b.getProgramParameter(this.Ma, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.Ma.$ = b.getAttribLocation(this.Ma, "aVertexPosition");
            b.enableVertexAttribArray(this.Ma.$);
            this.Ma.wa = b.getAttribLocation(this.Ma, "aTextureCoord");
            b.enableVertexAttribArray(this.Ma.wa)
        }
        ;
        g.prototype.Bc = function() {
            var b = this.g.H;
            if (!b)
                return !1;
            if (this.Mb = b.createFramebuffer()) {
                b.bindFramebuffer(b.FRAMEBUFFER, this.Mb);
                this.Mb.width = 1024;
                this.Mb.height = 1024;
                this.ve = b.createTexture();
                b.bindTexture(b.TEXTURE_2D, this.ve);
                b.texParameteri(b.TEXTURE_2D, b.TEXTURE_MIN_FILTER, b.LINEAR);
                b.texParameteri(b.TEXTURE_2D, b.TEXTURE_MAG_FILTER, b.LINEAR);
                b.texImage2D(b.TEXTURE_2D, 0, b.RGBA, this.Mb.width, this.Mb.height, 0, b.RGBA, b.UNSIGNED_BYTE, null);
                var a = b.createRenderbuffer();
                b.bindRenderbuffer(b.RENDERBUFFER, a);
                b.renderbufferStorage(b.RENDERBUFFER, b.DEPTH_COMPONENT16, this.Mb.width, this.Mb.height);
                b.framebufferTexture2D(b.FRAMEBUFFER, b.COLOR_ATTACHMENT0, b.TEXTURE_2D, this.ve, 0);
                b.framebufferRenderbuffer(b.FRAMEBUFFER, b.DEPTH_ATTACHMENT, b.RENDERBUFFER, a);
                b.bindTexture(b.TEXTURE_2D, null);
                b.bindRenderbuffer(b.RENDERBUFFER, null);
                b.bindFramebuffer(b.FRAMEBUFFER, null);
                this.eb = b.createBuffer();
                b.bindBuffer(b.ARRAY_BUFFER, this.eb);
                b.bufferData(b.ARRAY_BUFFER, new Float32Array([-1, -1, 0, 1, -1, 0, -1, 1, 0, 1, 1, 0]), b.STATIC_DRAW);
                this.eb.Dc = 3;
                this.eb.Md = 4;
                this.We = b.createBuffer();
                b.bindBuffer(b.ARRAY_BUFFER, this.We);
                b.bufferData(b.ARRAY_BUFFER, new Float32Array([0, 0, 1, 0, 0, 1, 1, 1]), b.STATIC_DRAW);
                return !0
            }
            return !1
        }
        ;
        g.prototype.Mk = function(b) {
            var a = this.g.H
              , d = this.g.jb;
            if (this.Ad) {
                a.useProgram(this.ma);
                a.bindBuffer(a.ARRAY_BUFFER, this.eb);
                a.vertexAttribPointer(this.ma.$, this.eb.Dc, a.FLOAT, !1, 0, 0);
                a.bindBuffer(a.ARRAY_BUFFER, this.We);
                a.vertexAttribPointer(this.ma.wa, 2, a.FLOAT, !1, 0, 0);
                a.enableVertexAttribArray(this.ma.$);
                a.enableVertexAttribArray(this.ma.wa);
                a.activeTexture(a.TEXTURE0);
                a.bindTexture(a.TEXTURE_2D, this.ve);
                var d = 1 + (this.ob - 1) * b
                  , c = a.getUniformLocation(this.ma, "uAlpha");
                a.uniform1f(c, 1);
                c = a.getUniformLocation(this.ma, "uZoomIn");
                a.uniform1i(c, 1);
                var c = a.getUniformLocation(this.ma, "uZoomCenter")
                  , e = .5 + (this.Ag - .5) * Math.sqrt(b)
                  , f = .5 + (this.Bg - .5) * Math.sqrt(b);
                0 > e - .5 / d && (e = .5 / d);
                0 > f - .5 / d && (f = .5 / d);
                1 < e + .5 / d && (e = 1 - .5 / d);
                1 < f + .5 / d && (f = 1 - .5 / d);
                a.uniform2f(c, e, f);
                e = a.getUniformLocation(this.ma, "uZoomFactor");
                a.uniform1f(e, d);
                a.uniform1i(a.getUniformLocation(this.ma, "uSampler"), 0);
                a.drawArrays(a.TRIANGLE_STRIP, 0, this.eb.Md);
                a.useProgram(this.g.la.F)
            } else {
                this.g.ug();
                a.blendFuncSeparate(a.SRC_ALPHA, a.ONE_MINUS_SRC_ALPHA, a.SRC_ALPHA, a.ONE);
                a.enable(a.BLEND);
                a.disable(a.DEPTH_TEST);
                e = .5 + (this.Ag - .5);
                f = .5 + (this.Bg - .5);
                0 > e - .5 / this.ob && (e = .5 / this.ob);
                0 > f - .5 / this.ob && (f = .5 / this.ob);
                1 < e + .5 / this.ob && (e = 1 - .5 / this.ob);
                1 < f + .5 / this.ob && (f = 1 - .5 / this.ob);
                if ("crossdissolve" == this.type)
                    a.useProgram(this.ma),
                    a.bindBuffer(a.ARRAY_BUFFER, this.eb),
                    a.vertexAttribPointer(this.ma.$, this.eb.Dc, a.FLOAT, !1, 0, 0),
                    a.bindBuffer(a.ARRAY_BUFFER, this.We),
                    a.vertexAttribPointer(this.ma.wa, 2, a.FLOAT, !1, 0, 0),
                    a.activeTexture(a.TEXTURE0),
                    a.bindTexture(a.TEXTURE_2D, this.ve),
                    c = a.getUniformLocation(this.ma, "uAlpha"),
                    a.uniform1f(c, 1 - b),
                    c = a.getUniformLocation(this.ma, "uZoomIn"),
                    a.uniform1i(c, 1 == this.Na || 2 == this.Na ? 1 : 0),
                    c = a.getUniformLocation(this.ma, "uZoomCenter"),
                    a.uniform2f(c, e, f),
                    e = a.getUniformLocation(this.ma, "uZoomFactor"),
                    a.uniform1f(e, this.ob),
                    a.uniform1i(a.getUniformLocation(this.ma, "uSampler"), 0);
                else if ("diptocolor" == this.type)
                    a.useProgram(this.Ra),
                    a.bindBuffer(a.ARRAY_BUFFER, this.eb),
                    a.vertexAttribPointer(this.Ra.$, this.eb.Dc, a.FLOAT, !1, 0, 0),
                    a.bindBuffer(a.ARRAY_BUFFER, this.We),
                    a.vertexAttribPointer(this.Ra.wa, 2, a.FLOAT, !1, 0, 0),
                    a.activeTexture(a.TEXTURE0),
                    a.bindTexture(a.TEXTURE_2D, this.ve),
                    a.uniform1f(a.getUniformLocation(this.Ra, "uColorPercent"), Math.min(2 * b, 1)),
                    c = a.getUniformLocation(this.Ra, "uAlpha"),
                    a.uniform1f(c, 1 - Math.max(2 * (b - .5), 0)),
                    a.uniform3f(a.getUniformLocation(this.Ra, "uDipColor"), (this.Ae >> 16 & 255) / 255, (this.Ae >> 8 & 255) / 255, (this.Ae & 255) / 255),
                    c = a.getUniformLocation(this.Ra, "uZoomIn"),
                    a.uniform1i(c, 1 == this.Na || 2 == this.Na ? 1 : 0),
                    c = a.getUniformLocation(this.Ra, "uZoomCenter"),
                    a.uniform2f(c, e, f),
                    e = a.getUniformLocation(this.Ra, "uZoomFactor"),
                    a.uniform1f(e, this.ob),
                    a.uniform1i(a.getUniformLocation(this.Ra, "uSampler"), 0);
                else if ("irisround" == this.type || "irisrectangular" == this.type) {
                    a.useProgram(this.Ga);
                    a.bindBuffer(a.ARRAY_BUFFER, this.eb);
                    a.vertexAttribPointer(this.Ga.$, this.eb.Dc, a.FLOAT, !1, 0, 0);
                    a.bindBuffer(a.ARRAY_BUFFER, this.We);
                    a.vertexAttribPointer(this.Ga.wa, 2, a.FLOAT, !1, 0, 0);
                    a.activeTexture(a.TEXTURE0);
                    a.bindTexture(a.TEXTURE_2D, this.ve);
                    var l;
                    1 == this.Na || 2 == this.Na ? l = c = .5 : (c = this.Ag,
                    l = this.Bg);
                    var h = c * d.width
                      , g = l * d.height
                      , h = Math.max(h, d.width - h)
                      , g = Math.max(g, d.height - g);
                    "irisround" == this.type ? a.uniform1f(a.getUniformLocation(this.Ga, "uRadius"), (Math.sqrt(h * h + g * g) + this.tc) * b) : (h > g ? (g = d.height / d.width * h + this.tc,
                    h += this.tc) : (h = d.width / d.height * g + this.tc,
                    g += this.tc),
                    a.uniform2f(a.getUniformLocation(this.Ga, "uRectDim"), h * b, g * b));
                    b = a.getUniformLocation(this.Ga, "uSoftEdge");
                    a.uniform1f(b, this.tc);
                    a.uniform1i(a.getUniformLocation(this.Ga, "uRound"), "irisround" == this.type ? 1 : 0);
                    a.uniform2f(a.getUniformLocation(this.Ga, "uIrisCenter"), c * d.width, l * d.height);
                    c = a.getUniformLocation(this.Ga, "uZoomIn");
                    a.uniform1i(c, 1 == this.Na || 2 == this.Na ? 1 : 0);
                    c = a.getUniformLocation(this.Ga, "uZoomCenter");
                    a.uniform2f(c, e, f);
                    e = a.getUniformLocation(this.Ga, "uZoomFactor");
                    a.uniform1f(e, this.ob);
                    a.uniform1i(a.getUniformLocation(this.Ga, "uSampler"), 0)
                } else if ("wipeleftright" == this.type || "wiperightleft" == this.type || "wipetopbottom" == this.type || "wipebottomtop" == this.type || "wiperandom" == this.type)
                    a.useProgram(this.Ma),
                    a.bindBuffer(a.ARRAY_BUFFER, this.eb),
                    a.vertexAttribPointer(this.Ma.$, this.eb.Dc, a.FLOAT, !1, 0, 0),
                    a.bindBuffer(a.ARRAY_BUFFER, this.We),
                    a.vertexAttribPointer(this.Ma.wa, 2, a.FLOAT, !1, 0, 0),
                    a.activeTexture(a.TEXTURE0),
                    a.bindTexture(a.TEXTURE_2D, this.ve),
                    a.uniform1f(a.getUniformLocation(this.Ma, "uPercent"), 3 > this.hi ? b * (d.width + this.tc) : b * (d.height + this.tc)),
                    b = a.getUniformLocation(this.Ma, "uSoftEdge"),
                    a.uniform1f(b, this.tc),
                    a.uniform1i(a.getUniformLocation(this.Ma, "uDirection"), this.hi),
                    a.uniform2f(a.getUniformLocation(this.Ma, "uCanvasDimensions"), d.width, d.height),
                    c = a.getUniformLocation(this.Ma, "uZoomIn"),
                    a.uniform1i(c, 1 == this.Na || 2 == this.Na ? 1 : 0),
                    c = a.getUniformLocation(this.Ma, "uZoomCenter"),
                    a.uniform2f(c, e, f),
                    e = a.getUniformLocation(this.Ma, "uZoomFactor"),
                    a.uniform1f(e, this.ob),
                    a.uniform1i(a.getUniformLocation(this.Ma, "uSampler"), 0);
                a.drawArrays(a.TRIANGLE_STRIP, 0, this.eb.Md);
                a.useProgram(this.g.la.F);
                a.disable(a.BLEND);
                a.enable(a.DEPTH_TEST)
            }
        }
        ;
        return g
    }();
    m.Nl = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g(b) {
            this.sg = [];
            this.g = b;
            this.enabled = !1;
            this.nb = 2;
            this.Fj = !1
        }
        g.prototype.mi = function(b) {
            if (2 == b.mode || 3 == b.mode || 5 == b.mode) {
                var a = this.g.Ha.currentTime
                  , d = b.pc.gain.value
                  , c = b.nc.gain.value
                  , e = b.oc.gain.value;
                b.mc.gain.linearRampToValueAtTime(b.mc.gain.value, a);
                b.mc.gain.linearRampToValueAtTime(0, a + this.nb);
                b.pc.gain.linearRampToValueAtTime(d, a);
                b.pc.gain.linearRampToValueAtTime(0, a + this.nb);
                b.nc.gain.linearRampToValueAtTime(c, a);
                b.nc.gain.linearRampToValueAtTime(0, a + this.nb);
                b.oc.gain.linearRampToValueAtTime(e, a);
                b.oc.gain.linearRampToValueAtTime(0, a + this.nb)
            } else
                a = this.g.Ha.currentTime,
                b.Sc.gain.linearRampToValueAtTime(b.Sc.gain.value, a),
                b.Sc.gain.linearRampToValueAtTime(0, a + this.nb);
            b.Qg = !0;
            setTimeout(function() {
                b.vd()
            }, 1E3 * this.nb + 5)
        }
        ;
        g.prototype.Ao = function() {
            for (var b = 0; b < this.g.S.length; b++) {
                var a = this.g.S[b];
                this.g.Cc(a.id) || 4 == a.mode || 6 == a.mode || (a.ia ? a.Lc() : (a.a.play(),
                a.a.currentTime = 0))
            }
        }
        ;
        g.prototype.vm = function() {
            for (var b = (this.g.Ha.currentTime - this.xo) / this.nb, b = Math.min(1, b), a = 0; a < this.g.S.length; a++) {
                var d = this.g.S[a];
                this.g.Cc(d.id) && 1 > d.ka && (d.ka = b)
            }
            1 == b && clearInterval(this.wo)
        }
        ;
        return g
    }();
    m.Ol = k
}
)(ggP2VR || (ggP2VR = {}));
(function(m) {
    var k = function() {
        function g(b) {
            this.Tf = [];
            this.Mc = null;
            this.Kb = [];
            this.Hb = [];
            this.Lb = [];
            this.cj = !0;
            this.g = b;
            this.nm()
        }
        g.prototype.Kf = function() {
            var b = this.g.H
              , a = b.createShader(b.VERTEX_SHADER);
            b.shaderSource(a, "attribute vec3 aVertexPosition;\nvoid main(void) {\n gl_Position = vec4(aVertexPosition, 1.0);\n}\n");
            b.compileShader(a);
            b.getShaderParameter(a, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(a)),
            a = null);
            var d = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec4 vColor;\nuniform vec2 uCanvasDimensions;\nuniform vec2 uFlareCenterPosition;\nuniform float uBlindingValue;\nuniform float uAspectRatio;\nvoid main(void) {\n float canvasDiag = sqrt( (uCanvasDimensions.x * uCanvasDimensions.x) + (uCanvasDimensions.y * uCanvasDimensions.y) );\n vec2 diff = uFlareCenterPosition - gl_FragCoord.xy;\n diff.y = diff.y * uAspectRatio;\n float distFromFlarePoint = sqrt( (diff.x * diff.x) + (diff.y * diff.y) );\n float factor = (distFromFlarePoint / canvasDiag) / 10.0;\n gl_FragColor = vec4(1.0, 1.0, 1.0, pow(((1.0 - factor) * 0.8) * uBlindingValue, 2.0));\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            this.Qb = b.createProgram();
            b.attachShader(this.Qb, a);
            b.attachShader(this.Qb, d);
            b.linkProgram(this.Qb);
            b.getProgramParameter(this.Qb, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.Qb.$ = b.getAttribLocation(this.Qb, "aVertexPosition");
            b.enableVertexAttribArray(this.Qb.$);
            d = b.createShader(b.VERTEX_SHADER);
            a = b.createShader(b.VERTEX_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nattribute vec3 aVertexPosition;\nvarying vec4 vColor;\nuniform vec2 uCirclePosition;\nuniform float uCircleRadius;\nuniform vec2 uCanvasDimensions2;\nuniform float uAspectRatio;\nvoid main(void) {\n vec2 circleOnScreen = aVertexPosition.xy * uCircleRadius + uCirclePosition;\n circleOnScreen.y = circleOnScreen.y / uAspectRatio;\n vec2 circleNorm = (circleOnScreen / uCanvasDimensions2) * 2.0 - vec2(1.0, 1.0);\n gl_Position = vec4(circleNorm.x, circleNorm.y, 0.0, 1.0);\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            b.shaderSource(a, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nattribute vec3 aVertexPosition;\nvarying vec4 vColor;\nuniform vec2 uCirclePosition;\nuniform float uCircleRadius;\nuniform vec2 uCanvasDimensions2;\nuniform float uAspectRatio;\nvoid main(void) {\n vec2 circleOnScreen = aVertexPosition.xy * uCircleRadius + uCirclePosition;\n circleOnScreen.y = circleOnScreen.y / uAspectRatio;\n vec2 circleNorm = (circleOnScreen / uCanvasDimensions2) * 2.0 - vec2(1.0, 1.0);\n gl_Position = vec4(circleNorm.x, circleNorm.y, 0.0, 1.0);\n}\n");
            b.compileShader(a);
            b.getShaderParameter(a, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(a)),
            d = null);
            var c = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(c, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec4 vColor;\nuniform vec2 uCircleTexturePosition;\nuniform vec3 uCircleColor;\nuniform float uCircleRadius;\nuniform float uCircleAlpha;\nuniform float uCircleSoftness;\nuniform float uAspectRatio;\nvoid main(void) {\n vec2 diff = uCircleTexturePosition - gl_FragCoord.xy;\n diff.y = diff.y * uAspectRatio;\n float distFromCircleCenter = sqrt( (diff.x * diff.x) + (diff.y * diff.y) );\n float softnessDistance = uCircleRadius * (1.0 - uCircleSoftness);\n if (distFromCircleCenter > uCircleRadius)\n {\n\t  gl_FragColor = vec4(uCircleColor, 0.0);\n }\n else if (distFromCircleCenter <= (softnessDistance))\n {\n\t  float factor = distFromCircleCenter / softnessDistance;\n\t  gl_FragColor = vec4(uCircleColor, pow((1.0 - (0.2 * factor)) * uCircleAlpha, 1.8));\n }\n else\n {\n\t  float factor = (distFromCircleCenter - softnessDistance) / (uCircleRadius - softnessDistance);\n\t  gl_FragColor = vec4(uCircleColor, pow((0.8 - (0.8 * factor)) * uCircleAlpha, 1.8));\n }\n}\n");
            b.compileShader(c);
            b.getShaderParameter(c, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(c)),
            c = null);
            this.oa = b.createProgram();
            b.attachShader(this.oa, d);
            b.attachShader(this.oa, c);
            b.linkProgram(this.oa);
            b.getProgramParameter(this.oa, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.oa.$ = b.getAttribLocation(this.oa, "aVertexPosition");
            b.enableVertexAttribArray(this.oa.$);
            d = b.createShader(b.FRAGMENT_SHADER);
            b.shaderSource(d, "#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\nvarying vec4 vColor;\nuniform vec2 uRingTexturePosition;\nuniform float uRingRadius;\nuniform float uRingAlpha;\nuniform float uAspectRatio;\nuniform sampler2D uSampler;\nvoid main(void) {\n vec2 diff = uRingTexturePosition - gl_FragCoord.xy;\n diff.y = diff.y * uAspectRatio;\n float distFromRingCenter = sqrt( (diff.x * diff.x) + (diff.y * diff.y) );\n float factor = distFromRingCenter / uRingRadius;\n if (distFromRingCenter > uRingRadius)\n {\n\t gl_FragColor = vec4(1.0, 1.0, 1.0, 0.0);\n }\n else\n {\n vec4 textureColor = texture2D(uSampler, vec2(factor / uAspectRatio, 0.5));\n gl_FragColor = vec4(textureColor.x, textureColor.y, textureColor.z, uRingAlpha);\n }\n}\n");
            b.compileShader(d);
            b.getShaderParameter(d, b.COMPILE_STATUS) || (alert(b.getShaderInfoLog(d)),
            d = null);
            this.lb = b.createProgram();
            b.attachShader(this.lb, a);
            b.attachShader(this.lb, d);
            b.linkProgram(this.lb);
            b.getProgramParameter(this.lb, b.LINK_STATUS) || alert("Could not initialise shaders");
            this.lb.$ = b.getAttribLocation(this.lb, "aVertexPosition")
        }
        ;
        g.prototype.Bc = function() {
            var b = this.g.H;
            this.kd = b.createBuffer();
            b.bindBuffer(b.ARRAY_BUFFER, this.kd);
            b.bufferData(b.ARRAY_BUFFER, new Float32Array([-1, -1, 0, 1, -1, 0, 1, 1, 0, -1, 1, 0]), b.STATIC_DRAW);
            this.kd.Dc = 3;
            this.kd.Md = 4;
            this.Je = b.createBuffer();
            b.bindBuffer(b.ARRAY_BUFFER, this.Je);
            for (var a = [0, 0, 0], d = 2 * Math.PI / 6, c = Math.PI / 180 * 35, e = 1, f = c; f <= c + 2 * Math.PI; f += d)
                a.push(Math.sin(f)),
                a.push(-Math.cos(f)),
                a.push(0),
                e++;
            b.bufferData(b.ARRAY_BUFFER, new Float32Array(a), b.STATIC_DRAW);
            this.Je.Dc = 3;
            this.Je.Md = e;
            this.Yk = b.createTexture();
            b.bindTexture(b.TEXTURE_2D, this.Yk);
            b.texParameteri(b.TEXTURE_2D, b.TEXTURE_MIN_FILTER, b.LINEAR);
            b.texParameteri(b.TEXTURE_2D, b.TEXTURE_MAG_FILTER, b.LINEAR);
            b.texParameteri(b.TEXTURE_2D, b.TEXTURE_WRAP_S, b.CLAMP_TO_EDGE);
            b.texParameteri(b.TEXTURE_2D, b.TEXTURE_WRAP_T, b.CLAMP_TO_EDGE);
            a = document.createElement("canvas");
            a.width = 100;
            a.height = 1;
            d = a.getContext("2d");
            d.width = 100;
            d.height = 1;
            c = d.createLinearGradient(0, 0, 100, 0);
            c.addColorStop(0, this.g.fa(16777215, 0));
            c.addColorStop(.88, this.g.fa(0, 0));
            c.addColorStop(.9, this.g.fa(16654848, 1));
            c.addColorStop(.92, this.g.fa(16776448, 1));
            c.addColorStop(.94, this.g.fa(4849466, 1));
            c.addColorStop(.96, this.g.fa(131071, 1));
            c.addColorStop(.98, this.g.fa(8190, 1));
            c.addColorStop(1, this.g.fa(0, 0));
            d.fillStyle = c;
            d.fillRect(0, 0, 100, 1);
            b.texImage2D(b.TEXTURE_2D, 0, b.RGBA, b.RGBA, b.UNSIGNED_BYTE, a)
        }
        ;
        g.prototype.Qn = function() {
            for (; 0 < this.Tf.length; )
                this.Tf.pop()
        }
        ;
        g.prototype.nm = function() {
            var b = []
              , a = []
              , d = []
              , c = {
                l: 14,
                alpha: .2,
                color: 11390415,
                i: .27
            };
            b.push(c);
            c = {
                l: 20,
                alpha: .25,
                color: 11390415,
                i: .4
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .2,
                color: 12442332,
                i: .6
            };
            b.push(c);
            c = {
                l: 15,
                alpha: .2,
                color: 11390415,
                i: .8
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .2,
                color: 12442332,
                i: 1.5
            };
            b.push(c);
            c = {
                l: 15,
                alpha: .2,
                color: 11390415,
                i: 1.8
            };
            b.push(c);
            c = {
                l: 8,
                alpha: .2,
                color: 12575203,
                u: .8,
                i: .7
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .4,
                color: 12575203,
                u: .5,
                i: 1.6
            };
            a.push(c);
            c = {
                l: 5,
                alpha: .4,
                color: 12575203,
                u: .6,
                i: .9
            };
            a.push(c);
            c = {
                l: 8,
                alpha: .3,
                color: 12575203,
                u: .4,
                i: 1.1
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 30,
                alpha: .3,
                color: 11390415,
                i: .5
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 11390415,
                i: 1
            };
            b.push(c);
            c = {
                l: 20,
                alpha: .3,
                color: 11390415,
                i: 1.3
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 11390415,
                i: 1.5
            };
            b.push(c);
            c = {
                l: 15,
                alpha: .3,
                color: 11390415,
                i: 1.8
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 15506856,
                u: .8,
                i: .7
            };
            a.push(c);
            c = {
                l: 20,
                alpha: .5,
                color: 15506856,
                u: .5,
                i: 1.6
            };
            a.push(c);
            c = {
                l: 5,
                alpha: .5,
                color: 15506856,
                u: .6,
                i: .9
            };
            a.push(c);
            c = {
                l: 60,
                alpha: .4,
                color: 15506856,
                u: .2,
                i: 1.1
            };
            a.push(c);
            d.push({
                l: 220,
                alpha: .035,
                i: 2
            });
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 30,
                alpha: .5,
                color: 15465727,
                i: .5
            };
            b.push(c);
            c = {
                l: 40,
                alpha: .28,
                color: 15726842,
                i: .8
            };
            b.push(c);
            c = {
                l: 25,
                alpha: .32,
                color: 15726842,
                i: 1.1
            };
            b.push(c);
            c = {
                l: 15,
                alpha: .25,
                color: 15726842,
                i: 1.35
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .28,
                color: 15465727,
                i: 1.65
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .45,
                color: 15465727,
                u: .8,
                i: .7
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .5,
                color: 15465727,
                u: .4,
                i: .9
            };
            a.push(c);
            c = {
                l: 40,
                alpha: .4,
                color: 15465727,
                u: .3,
                i: .38
            };
            a.push(c);
            c = {
                l: 50,
                alpha: .4,
                color: 15465727,
                u: .5,
                i: 1.25
            };
            a.push(c);
            c = {
                l: 18,
                alpha: .2,
                color: 15465727,
                u: .5,
                i: 1.25
            };
            a.push(c);
            c = {
                l: 10,
                alpha: .34,
                color: 15726842,
                u: .8,
                i: 1.5
            };
            a.push(c);
            c = {
                l: 38,
                alpha: .37,
                color: 15465727,
                u: .3,
                i: -.5
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 16,
                alpha: .5,
                color: 16363159,
                i: .1
            };
            b.push(c);
            c = {
                l: 26,
                alpha: .3,
                color: 16091819,
                i: .32
            };
            b.push(c);
            c = {
                l: 29,
                alpha: .2,
                color: 16091819,
                i: 1.32
            };
            b.push(c);
            c = {
                l: 20,
                alpha: .18,
                color: 16363159,
                i: 1.53
            };
            b.push(c);
            c = {
                l: 27,
                alpha: .13,
                color: 16425092,
                i: 1.6
            };
            b.push(c);
            c = {
                l: 20,
                alpha: .1,
                color: 16091819,
                i: 1.75
            };
            b.push(c);
            c = {
                l: 12,
                alpha: .45,
                color: 16312238,
                u: .45,
                i: .2
            };
            a.push(c);
            c = {
                l: 8,
                alpha: .25,
                color: 16434209,
                u: .7,
                i: .33
            };
            a.push(c);
            c = {
                l: 9,
                alpha: .25,
                color: 16091819,
                u: .4,
                i: .7
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .2,
                color: 16091819,
                u: .4,
                i: .85
            };
            a.push(c);
            c = {
                l: 60,
                alpha: .23,
                color: 16091819,
                u: .55,
                i: 1.05
            };
            a.push(c);
            c = {
                l: 37,
                alpha: .1,
                color: 16091819,
                u: .55,
                i: 1.22
            };
            a.push(c);
            c = {
                l: 10,
                alpha: .25,
                color: 16363159,
                u: .65,
                i: 1.38
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .2,
                color: 16434209,
                u: .5,
                i: 1.45
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .2,
                color: 16416033,
                u: .5,
                i: 1.78
            };
            a.push(c);
            c = {
                l: 6,
                alpha: .18,
                color: 16434209,
                u: .45,
                i: 1.9
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .14,
                color: 16766514,
                u: .45,
                i: 2.04
            };
            a.push(c);
            c = {
                l: 30,
                alpha: .14,
                color: 16766514,
                u: .8,
                i: .04
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 9,
                alpha: .3,
                color: 14346999,
                u: .3,
                i: .3
            };
            a.push(c);
            c = {
                l: 5,
                alpha: .5,
                color: 14148072,
                u: .8,
                i: .6
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .37,
                color: 14346999,
                u: .66,
                i: .8
            };
            a.push(c);
            c = {
                l: 45,
                alpha: .2,
                color: 14346999,
                u: .36,
                i: 1.2
            };
            a.push(c);
            c = {
                l: 13,
                alpha: .2,
                color: 14346999,
                u: .36,
                i: 1.23
            };
            a.push(c);
            c = {
                l: 11,
                alpha: .2,
                color: 14148072,
                u: .36,
                i: 1.28
            };
            a.push(c);
            c = {
                l: 27,
                alpha: .16,
                color: 14346999,
                u: .36,
                i: 1.55
            };
            a.push(c);
            c = {
                l: 6,
                alpha: .36,
                color: 14148072,
                u: .8,
                i: 1.7
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 24,
                alpha: .2,
                color: 15186464,
                i: .2
            };
            b.push(c);
            c = {
                l: 7,
                alpha: .26,
                color: 15186464,
                i: .35
            };
            b.push(c);
            c = {
                l: 23,
                alpha: .18,
                color: 15186464,
                i: .65
            };
            b.push(c);
            c = {
                l: 13,
                alpha: .2,
                color: 15186464,
                i: .8
            };
            b.push(c);
            c = {
                l: 11,
                alpha: .15,
                color: 15186464,
                i: 1.4
            };
            b.push(c);
            c = {
                l: 15,
                alpha: .11,
                color: 15451904,
                i: 1.6
            };
            b.push(c);
            c = {
                l: 6,
                alpha: .45,
                color: 15579138,
                u: .45,
                i: .22
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .3,
                color: 15451904,
                u: .25,
                i: .4
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .2,
                color: 15451904,
                u: .25,
                i: .45
            };
            a.push(c);
            c = {
                l: 65,
                alpha: .17,
                color: 15186464,
                u: .25,
                i: .5
            };
            a.push(c);
            c = {
                l: 5,
                alpha: .45,
                color: 15579138,
                u: .45,
                i: .88
            };
            a.push(c);
            c = {
                l: 140,
                alpha: .18,
                color: 15579138,
                u: .32,
                i: .95
            };
            a.push(c);
            c = {
                l: 12,
                alpha: .22,
                color: 15579138,
                u: .32,
                i: 1.1
            };
            a.push(c);
            c = {
                l: 8,
                alpha: .32,
                color: 15451904,
                u: .72,
                i: 1.2
            };
            a.push(c);
            c = {
                l: 55,
                alpha: .2,
                color: 15451904,
                u: .45,
                i: 1.33
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .3,
                color: 15451904,
                u: .25,
                i: 1.42
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 16,
                alpha: .4,
                color: 10933495,
                i: .32
            };
            b.push(c);
            c = {
                l: 14,
                alpha: .3,
                color: 11007484,
                i: .36
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 4037331,
                i: .58
            };
            b.push(c);
            c = {
                l: 14,
                alpha: .22,
                color: 8835068,
                i: .68
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .27,
                color: 11007484,
                i: .82
            };
            b.push(c);
            c = {
                l: 11,
                alpha: .27,
                color: 10867450,
                i: 1
            };
            b.push(c);
            c = {
                l: 9,
                alpha: .2,
                color: 6158332,
                i: 1.05
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .17,
                color: 10867450,
                i: 1.78
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 4037331,
                i: -.23
            };
            b.push(c);
            c = {
                l: 8,
                alpha: .45,
                color: 8835068,
                u: .45,
                i: .175
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .4,
                color: 12574715,
                u: .55,
                i: .46
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .3,
                color: 10867450,
                u: .35,
                i: .5
            };
            a.push(c);
            c = {
                l: 60,
                alpha: .37,
                color: 4031699,
                u: .75,
                i: .75
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .25,
                color: 4031699,
                u: .25,
                i: .75
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .2,
                color: 6158332,
                u: .25,
                i: .9
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .45,
                color: 8835068,
                u: .45,
                i: 1.3
            };
            a.push(c);
            c = {
                l: 32,
                alpha: .22,
                color: 8835068,
                u: .75,
                i: 1.62
            };
            a.push(c);
            c = {
                l: 9,
                alpha: .45,
                color: 4031699,
                u: .65,
                i: 1.6
            };
            a.push(c);
            c = {
                l: 8,
                alpha: .25,
                color: 4031699,
                u: .65,
                i: 1.83
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .4,
                color: 12574715,
                u: .55,
                i: -.18
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 16,
                alpha: .4,
                color: 16389120,
                i: .32
            };
            b.push(c);
            c = {
                l: 26,
                alpha: .22,
                color: 16389120,
                i: .4
            };
            b.push(c);
            c = {
                l: 26,
                alpha: .25,
                color: 16389120,
                i: .65
            };
            b.push(c);
            c = {
                l: 18,
                alpha: .3,
                color: 16389120,
                i: 1.23
            };
            b.push(c);
            c = {
                l: 14,
                alpha: .26,
                color: 16389120,
                i: 1.33
            };
            b.push(c);
            c = {
                l: 17,
                alpha: .18,
                color: 16389120,
                i: 1.7
            };
            b.push(c);
            c = {
                l: 30,
                alpha: .16,
                color: 16389120,
                i: 2.15
            };
            b.push(c);
            c = {
                l: 100,
                alpha: .25,
                color: 16389120,
                u: .22,
                i: 1.45
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .5,
                color: 15628151,
                u: .3,
                i: 1.5
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .5,
                color: 15628151,
                u: .3,
                i: 1.52
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .5,
                color: 16389120,
                u: .3,
                i: 1.745
            };
            a.push(c);
            c = {
                l: 9,
                alpha: .22,
                color: 16389120,
                u: .3,
                i: 1.8
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 16,
                alpha: .4,
                color: 10933495,
                i: .32
            };
            b.push(c);
            c = {
                l: 14,
                alpha: .3,
                color: 11007484,
                i: .36
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 4037331,
                i: .58
            };
            b.push(c);
            c = {
                l: 14,
                alpha: .22,
                color: 8835068,
                i: .68
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .27,
                color: 11007484,
                i: .82
            };
            b.push(c);
            c = {
                l: 11,
                alpha: .27,
                color: 10867450,
                i: 1
            };
            b.push(c);
            c = {
                l: 9,
                alpha: .2,
                color: 6158332,
                i: 1.05
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .17,
                color: 10867450,
                i: 1.78
            };
            b.push(c);
            c = {
                l: 10,
                alpha: .3,
                color: 4037331,
                i: -.23
            };
            b.push(c);
            c = {
                l: 8,
                alpha: .45,
                color: 8835068,
                u: .45,
                i: .175
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .4,
                color: 12574715,
                u: .55,
                i: .46
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .3,
                color: 10867450,
                u: .35,
                i: .5
            };
            a.push(c);
            c = {
                l: 60,
                alpha: .37,
                color: 4031699,
                u: .75,
                i: .75
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .25,
                color: 4031699,
                u: .25,
                i: .75
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .2,
                color: 6158332,
                u: .25,
                i: .9
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .45,
                color: 8835068,
                u: .45,
                i: 1.3
            };
            a.push(c);
            c = {
                l: 32,
                alpha: .22,
                color: 8835068,
                u: .75,
                i: 1.62
            };
            a.push(c);
            c = {
                l: 9,
                alpha: .45,
                color: 4031699,
                u: .65,
                i: 1.6
            };
            a.push(c);
            c = {
                l: 8,
                alpha: .25,
                color: 4031699,
                u: .65,
                i: 1.83
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .4,
                color: 12574715,
                u: .55,
                i: -.18
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 16,
                alpha: .4,
                color: 16389120,
                i: .32
            };
            b.push(c);
            c = {
                l: 26,
                alpha: .22,
                color: 16389120,
                i: .4
            };
            b.push(c);
            c = {
                l: 26,
                alpha: .25,
                color: 16389120,
                i: .65
            };
            b.push(c);
            c = {
                l: 18,
                alpha: .3,
                color: 16389120,
                i: 1.23
            };
            b.push(c);
            c = {
                l: 14,
                alpha: .26,
                color: 16389120,
                i: 1.33
            };
            b.push(c);
            c = {
                l: 17,
                alpha: .18,
                color: 16389120,
                i: 1.7
            };
            b.push(c);
            c = {
                l: 30,
                alpha: .16,
                color: 16389120,
                i: 2.15
            };
            b.push(c);
            c = {
                l: 100,
                alpha: .25,
                color: 16389120,
                u: .22,
                i: 1.45
            };
            a.push(c);
            c = {
                l: 7,
                alpha: .5,
                color: 15628151,
                u: .3,
                i: 1.5
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .5,
                color: 15628151,
                u: .3,
                i: 1.52
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .5,
                color: 16389120,
                u: .3,
                i: 1.745
            };
            a.push(c);
            c = {
                l: 9,
                alpha: .22,
                color: 16389120,
                u: .3,
                i: 1.8
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d);
            b = [];
            a = [];
            d = [];
            c = {
                l: 24,
                alpha: .2,
                color: 15186464,
                i: .2
            };
            b.push(c);
            c = {
                l: 7,
                alpha: .26,
                color: 15186464,
                i: .35
            };
            b.push(c);
            c = {
                l: 23,
                alpha: .18,
                color: 15186464,
                i: .65
            };
            b.push(c);
            c = {
                l: 13,
                alpha: .2,
                color: 15186464,
                i: .8
            };
            b.push(c);
            c = {
                l: 11,
                alpha: .15,
                color: 15186464,
                i: 1.4
            };
            b.push(c);
            c = {
                l: 15,
                alpha: .11,
                color: 15451904,
                i: 1.6
            };
            b.push(c);
            c = {
                l: 6,
                alpha: .45,
                color: 15579138,
                u: .45,
                i: .22
            };
            a.push(c);
            c = {
                l: 3,
                alpha: .3,
                color: 15451904,
                u: .25,
                i: .4
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .2,
                color: 15451904,
                u: .25,
                i: .45
            };
            a.push(c);
            c = {
                l: 65,
                alpha: .17,
                color: 15186464,
                u: .25,
                i: .5
            };
            a.push(c);
            c = {
                l: 5,
                alpha: .45,
                color: 15579138,
                u: .45,
                i: .88
            };
            a.push(c);
            c = {
                l: 140,
                alpha: .18,
                color: 15579138,
                u: .32,
                i: .95
            };
            a.push(c);
            c = {
                l: 12,
                alpha: .22,
                color: 15579138,
                u: .32,
                i: 1.1
            };
            a.push(c);
            c = {
                l: 8,
                alpha: .32,
                color: 15451904,
                u: .72,
                i: 1.2
            };
            a.push(c);
            c = {
                l: 55,
                alpha: .2,
                color: 15451904,
                u: .45,
                i: 1.33
            };
            a.push(c);
            c = {
                l: 4,
                alpha: .3,
                color: 15451904,
                u: .25,
                i: 1.42
            };
            a.push(c);
            this.Kb.push(b);
            this.Hb.push(a);
            this.Lb.push(d)
        }
        ;
        g.prototype.Bn = function() {
            if (this.cj) {
                var b = this.g.H, a, d, c, e = new m.ra(0,0,-100), f = this.g.hd(), l, h;
                if (this.g.Z)
                    l = this.g.jb.width,
                    h = this.g.jb.height,
                    this.g.B.rg && (l = this.g.B.Mb.width,
                    h = this.g.B.Mb.height);
                else {
                    this.R || (this.R = this.Mc.getContext("2d"));
                    if (this.R.width !== this.g.m.width || this.R.height !== this.g.m.height)
                        this.R.width = this.g.m.width,
                        this.R.height = this.g.m.height;
                    this.R.clear ? this.R.clear() : this.R.clearRect(0, 0, this.Mc.width, this.Mc.height);
                    l = this.R.width;
                    h = this.R.height
                }
                var g = Math.sqrt(l * l + h * h)
                  , k = g / 800;
                for (d = 0; d < this.Tf.length; d++) {
                    var n = this.Tf[d];
                    e.Ya(0, 0, -100);
                    e.va(-n.j * Math.PI / 180);
                    e.Da(n.pan * Math.PI / 180);
                    e.Da(-this.g.pan.c * Math.PI / 180);
                    e.va(this.g.j.c * Math.PI / 180);
                    e.mb(this.g.N.c * Math.PI / 180);
                    var r = !1;
                    if (-.01 > e.z) {
                        var p, u;
                        u = -f / e.z;
                        p = e.x * u;
                        u *= e.y;
                        Math.abs(p) < l / 2 + 100 && Math.abs(u) < h / 2 + 100 && (r = !0,
                        p += l / 2,
                        u += h / 2)
                    }
                    if (r) {
                        this.g.Z && (b.blendFunc(b.SRC_ALPHA, b.DST_ALPHA),
                        b.enable(b.BLEND),
                        b.disable(b.DEPTH_TEST));
                        var r = l / 2
                          , t = h / 2;
                        c = Math.sqrt((r - p) * (r - p) + (t - u) * (t - u));
                        var v = g / 2
                          , t = l > h ? l : h
                          , r = n.zj / 100 * ((v - c) / v);
                        0 > r && (r = 0);
                        if (this.g.Z) {
                            b.useProgram(this.Qb);
                            b.bindBuffer(b.ARRAY_BUFFER, this.g.B.eb);
                            b.vertexAttribPointer(this.Qb.$, this.g.B.eb.Dc, b.FLOAT, !1, 0, 0);
                            var q = b.getUniformLocation(this.Qb, "uCanvasDimensions");
                            b.uniform2f(q, b.drawingBufferWidth, b.drawingBufferHeight);
                            b.uniform2f(b.getUniformLocation(this.Qb, "uFlareCenterPosition"), b.drawingBufferWidth / l * p, h - b.drawingBufferHeight / h * u);
                            b.uniform1f(b.getUniformLocation(this.Qb, "uBlindingValue"), r);
                            q = b.getUniformLocation(this.Qb, "uAspectRatio");
                            b.uniform1f(q, this.g.B.rg ? b.drawingBufferWidth / b.drawingBufferHeight : b.drawingBufferWidth / b.drawingBufferHeight / (l / h));
                            b.drawArrays(b.TRIANGLE_STRIP, 0, this.g.B.eb.Md)
                        } else
                            q = this.R.createRadialGradient(p, u, 1, p, u, t),
                            q.addColorStop(0, "rgba(255, 255, 255, " + r + ")"),
                            q.addColorStop(.5, "rgba(255, 255, 255, " + .8 * r + ")"),
                            q.addColorStop(1, "rgba(255, 255, 255, " + .6 * r + ")"),
                            this.R.fillStyle = q,
                            this.R.fillRect(0, 0, this.R.width, this.R.height);
                        if (0 != Number(n.type) && !this.g.B.rg) {
                            var r = l / 2 - p
                              , t = h / 2 - u
                              , w = 1
                              , B = Number(n.type) - 1;
                            c < .35 * v && (w = c / (.35 * v),
                            w *= w);
                            c > .7 * v && (w = (v - c) / (.3 * v));
                            w *= n.alpha / 100;
                            if (0 < this.Kb[B].length)
                                for (c = 0; c < this.Kb[B].length; c++) {
                                    var z = this.Kb[B][c]
                                      , v = z.l * k;
                                    a = z.alpha * w;
                                    0 > a && (a = 0);
                                    var y = z.color;
                                    if (8 == B || 9 == B || 10 == B)
                                        y = n.color;
                                    if (this.g.Z)
                                        b.useProgram(this.oa),
                                        b.bindBuffer(b.ARRAY_BUFFER, this.Je),
                                        b.vertexAttribPointer(this.oa.$, this.Je.Dc, b.FLOAT, !1, 0, 0),
                                        q = b.getUniformLocation(this.oa, "uCanvasDimensions2"),
                                        b.uniform2f(q, b.drawingBufferWidth, b.drawingBufferHeight),
                                        b.uniform2f(b.getUniformLocation(this.oa, "uCirclePosition"), b.drawingBufferWidth / l * (p + r * z.i), b.drawingBufferWidth / l * (h - (u + t * z.i))),
                                        b.uniform2f(b.getUniformLocation(this.oa, "uCircleTexturePosition"), b.drawingBufferWidth / l * (p + r * z.i), h - (u + t * z.i)),
                                        b.uniform1f(b.getUniformLocation(this.oa, "uCircleRadius"), v),
                                        b.uniform3f(b.getUniformLocation(this.oa, "uCircleColor"), (y >> 16 & 255) / 255, (y >> 8 & 255) / 255, (y & 255) / 255),
                                        b.uniform1f(b.getUniformLocation(this.oa, "uCircleAlpha"), a),
                                        b.uniform1f(b.getUniformLocation(this.oa, "uCircleSoftness"), .1),
                                        q = b.getUniformLocation(this.oa, "uAspectRatio"),
                                        b.uniform1f(q, b.drawingBufferWidth / b.drawingBufferHeight / (l / h)),
                                        b.drawArrays(b.TRIANGLE_FAN, 0, this.Je.Md);
                                    else {
                                        this.R.save();
                                        this.R.translate(p + r * z.i, u + t * z.i);
                                        q = this.R.createRadialGradient(0, 0, 1, 0, 0, 1.1 * v);
                                        q.addColorStop(0, this.g.fa(y, a));
                                        q.addColorStop(.65, this.g.fa(y, .9 * a));
                                        q.addColorStop(.8, this.g.fa(y, .7 * a));
                                        q.addColorStop(1, this.g.fa(y, .2 * a));
                                        this.R.beginPath();
                                        var y = 2 * Math.PI / 6
                                          , z = Math.PI / 180 * 35
                                          , C = !0;
                                        for (a = z; a <= z + 2 * Math.PI; a += y)
                                            C ? (this.R.moveTo(v * Math.sin(a), v * Math.cos(a)),
                                            C = !1) : this.R.lineTo(v * Math.sin(a), v * Math.cos(a));
                                        this.R.closePath();
                                        this.R.fillStyle = q;
                                        this.R.fill();
                                        this.R.restore()
                                    }
                                }
                            if (0 < this.Hb[B].length)
                                for (c = 0; c < this.Hb[B].length; c++) {
                                    z = this.Hb[B][c];
                                    v = z.l * k;
                                    a = z.alpha * w;
                                    0 > a && (a = 0);
                                    y = z.color;
                                    if (8 == B || 9 == B || 10 == B)
                                        y = n.color;
                                    this.g.Z ? (b.useProgram(this.oa),
                                    b.bindBuffer(b.ARRAY_BUFFER, this.kd),
                                    b.vertexAttribPointer(this.oa.$, this.kd.Dc, b.FLOAT, !1, 0, 0),
                                    q = b.getUniformLocation(this.oa, "uCanvasDimensions2"),
                                    b.uniform2f(q, b.drawingBufferWidth, b.drawingBufferHeight),
                                    q = b.getUniformLocation(this.oa, "uCirclePosition"),
                                    b.uniform2f(q, b.drawingBufferWidth / l * (p + r * z.i), b.drawingBufferWidth / l * (h - (u + t * z.i))),
                                    q = b.getUniformLocation(this.oa, "uCircleTexturePosition"),
                                    b.uniform2f(q, b.drawingBufferWidth / l * (p + r * z.i), h - (u + t * z.i)),
                                    q = b.getUniformLocation(this.oa, "uCircleRadius"),
                                    b.uniform1f(q, v),
                                    b.uniform3f(b.getUniformLocation(this.oa, "uCircleColor"), (y >> 16 & 255) / 255, (y >> 8 & 255) / 255, (y & 255) / 255),
                                    b.uniform1f(b.getUniformLocation(this.oa, "uCircleAlpha"), a),
                                    b.uniform1f(b.getUniformLocation(this.oa, "uCircleSoftness"), z.u),
                                    q = b.getUniformLocation(this.oa, "uAspectRatio"),
                                    b.uniform1f(q, b.drawingBufferWidth / b.drawingBufferHeight / (l / h)),
                                    b.drawArrays(b.TRIANGLE_FAN, 0, this.kd.Md)) : (this.R.save(),
                                    this.R.translate(p + r * z.i, u + t * z.i),
                                    q = this.R.createRadialGradient(0, 0, 1, 0, 0, v),
                                    q.addColorStop(0, this.g.fa(y, a)),
                                    q.addColorStop(1 - z.u, this.g.fa(y, .8 * a)),
                                    q.addColorStop(1, this.g.fa(y, 0)),
                                    this.R.beginPath(),
                                    this.R.arc(0, 0, v, 0, 2 * Math.PI, !1),
                                    this.R.closePath(),
                                    this.R.fillStyle = q,
                                    this.R.fill(),
                                    this.R.restore())
                                }
                            if (0 < this.Lb[B].length)
                                for (c = 0; c < this.Lb[B].length; c++)
                                    n = this.Lb[B][c],
                                    v = n.l * k,
                                    a = n.alpha * w,
                                    0 > a && (a = 0),
                                    this.g.Z ? (b.useProgram(this.lb),
                                    b.activeTexture(b.TEXTURE0),
                                    b.bindTexture(b.TEXTURE_2D, this.Yk),
                                    b.bindBuffer(b.ARRAY_BUFFER, this.kd),
                                    b.vertexAttribPointer(this.lb.$, this.kd.Dc, b.FLOAT, !1, 0, 0),
                                    q = b.getUniformLocation(this.lb, "uCanvasDimensions2"),
                                    b.uniform2f(q, l, h),
                                    q = b.getUniformLocation(this.lb, "uCirclePosition"),
                                    b.uniform2f(q, p + r * n.i, h - (u + t * n.i)),
                                    q = b.getUniformLocation(this.lb, "uRingTexturePosition"),
                                    b.uniform2f(q, b.drawingBufferWidth / l * (p + r * n.i), h - (u + t * n.i)),
                                    q = b.getUniformLocation(this.lb, "uCircleRadius"),
                                    b.uniform1f(q, v),
                                    b.uniform2f(b.getUniformLocation(this.lb, "uRingPosition"), p + r * n.i, h - (u + t * n.i)),
                                    b.uniform1f(b.getUniformLocation(this.lb, "uRingRadius"), v),
                                    b.uniform1f(b.getUniformLocation(this.lb, "uRingAlpha"), a),
                                    q = b.getUniformLocation(this.lb, "uAspectRatio"),
                                    b.uniform1f(q, b.drawingBufferWidth / b.drawingBufferHeight / (l / h)),
                                    b.uniform1i(b.getUniformLocation(this.lb, "uSampler"), 0),
                                    b.drawArrays(b.TRIANGLE_FAN, 0, this.kd.Md)) : (this.R.save(),
                                    this.R.translate(p + r * n.i, u + t * n.i),
                                    q = this.R.createRadialGradient(0, 0, 0, 0, 0, v),
                                    q.addColorStop(0, this.g.fa(16777215, 0)),
                                    q.addColorStop(.88, this.g.fa(0, 0)),
                                    q.addColorStop(.9, this.g.fa(16654848, a)),
                                    q.addColorStop(.92, this.g.fa(16776448, a)),
                                    q.addColorStop(.94, this.g.fa(4849466, a)),
                                    q.addColorStop(.96, this.g.fa(131071, a)),
                                    q.addColorStop(.98, this.g.fa(8190, a)),
                                    q.addColorStop(1, this.g.fa(0, 0)),
                                    this.R.beginPath(),
                                    this.R.arc(0, 0, v, 0, 2 * Math.PI, !1),
                                    this.R.closePath(),
                                    this.R.fillStyle = q,
                                    this.R.fill(),
                                    this.R.restore())
                        }
                        this.g.Z && (b.useProgram(this.g.la.F),
                        b.disable(b.BLEND),
                        b.enable(b.DEPTH_TEST))
                    }
                }
            }
        }
        ;
        return g
    }();
    m.Ll = k
}
)(ggP2VR || (ggP2VR = {}));
var O = !1;
(function(m) {
    var k = function() {
        return function() {
            this.f = this.j = this.pan = 0
        }
    }()
      , g = function() {
        function b(a, d) {
            this.pan = {
                c: 0,
                Pa: 0,
                min: 0,
                max: 360,
                d: 0,
                Oi: 0,
                gd: 0
            };
            this.j = {
                c: 0,
                Pa: 0,
                min: -90,
                max: 90,
                d: 0,
                gd: 0
            };
            this.N = {
                c: 0,
                Pa: 0,
                min: -180,
                max: 180,
                d: 0
            };
            this.lc = {
                pan: 0,
                j: -90,
                N: 0,
                f: 170,
                Bb: 9
            };
            this.f = {
                c: 70,
                Pa: 70,
                min: 1,
                Xf: 0,
                max: 170,
                Ji: 360,
                Ki: 270,
                Se: 0,
                d: 0,
                mode: 0,
                ml: 0,
                Hj: 0
            };
            this.Ca = {
                N: 0,
                pitch: 0
            };
            this.m = {
                width: 10,
                height: 10
            };
            this.kb = 0;
            this.fi = new m.ra;
            this.crossOrigin = "anonymous";
            this.Za = this.oh = 4;
            this.Vc = this.zg = this.Zf = this.fc = 0;
            this.Y = {
                start: {
                    x: 0,
                    y: 0
                },
                ca: {
                    x: 0,
                    y: 0
                },
                sd: {
                    x: 0,
                    y: 0
                },
                c: {
                    x: 0,
                    y: 0
                },
                ba: {
                    x: 0,
                    y: 0
                }
            };
            this.X = {
                ib: !1,
                Nj: 0,
                startTime: 0,
                start: {
                    x: 0,
                    y: 0
                },
                ca: {
                    x: 0,
                    y: 0
                },
                sd: {
                    x: 0,
                    y: 0
                },
                c: {
                    x: 0,
                    y: 0
                },
                ba: {
                    x: 0,
                    y: 0
                }
            };
            this.pi = !0;
            this.ua = {
                enabled: !0,
                ca: {
                    x: 0,
                    y: 0
                },
                ba: {
                    x: 0,
                    y: 0
                },
                Zi: 0,
                f: {
                    active: !1,
                    Vb: 0
                }
            };
            this.o = {
                src: [],
                ze: 4,
                width: 640,
                height: 480,
                Xc: !1,
                bh: !1,
                nl: !1,
                be: "loop",
                a: HTMLVideoElement = null,
                pl: !1,
                hc: WebGLTexture = null,
                rj: WebGLBuffer = null,
                Ch: WebGLBuffer = null,
                Ci: WebGLBuffer = null,
                format: 1,
                Vg: 0,
                ti: 1
            };
            this.he = 0;
            this.ha = this.sa = this.Aa = this.U = this.Tb = this.$a = this.C = null;
            this.ee = "pano";
            this.si = "flashcontainer";
            this.gi = "";
            this.control = null;
            this.Gb = [];
            this.za = !1;
            this.vf = 1;
            this.O = null;
            this.Bd = this.nf = this.If = !1;
            this.lf = 0;
            this.fd = .02;
            this.Th = 0;
            this.Uh = !1;
            this.Sh = this.Cg = this.mf = this.ye = this.xj = 0;
            this.zb = "";
            this.Xe = this.sc = !1;
            this.ph = 0;
            this.Kg = [];
            this.Ge = [];
            this.cf = this.ic = 1;
            this.qf = 1024;
            this.Ye = !1;
            this.je = 200;
            this.Fa = 0;
            this.qg = 5;
            this.uc = 0;
            this.ql = 50;
            this.Bi = this.rl = 0;
            this.s = {
                enabled: !1,
                timeout: 5,
                active: !1,
                pg: !1,
                speed: .4,
                Eh: 0,
                mh: 0,
                Ni: !0,
                pj: !1,
                ed: !1,
                yj: !1,
                Li: !1,
                hj: !1,
                startTime: 0,
                rd: 0,
                Rg: !1,
                Lg: !1,
                hh: 0
            };
            this.v = {
                active: !1,
                xe: !1,
                speed: .1,
                pan: 0,
                j: 0,
                N: 0,
                f: 70,
                zd: 70,
                yk: 0,
                Ak: 0,
                zk: 0,
                xk: 0,
                Bb: 0,
                bg: 0,
                Di: 0,
                oj: !1,
                Mi: !1,
                wj: 0,
                vj: 0
            };
            this.Qa = null;
            this.gf = {};
            this.qj = {};
            this.Mg = [];
            this.w = {
                mode: 1,
                Qf: -1,
                na: 0,
                gb: 0,
                Kc: .05,
                Sb: 255,
                Rb: 1,
                Pb: 255,
                Ob: .3,
                Me: !0,
                jj: {
                    enabled: !0,
                    width: 180,
                    height: 20,
                    kj: 0,
                    ij: 1,
                    background: !0,
                    Pb: 16777215,
                    Ob: 1,
                    Sb: 0,
                    Rb: 1,
                    Wh: 3,
                    Xh: 1,
                    Ph: !0
                },
                fb: [],
                Eb: [],
                Fc: [],
                zh: []
            };
            this.ta = null;
            this.P = [];
            this.S = [];
            this.J = [];
            this.Xa = [];
            this.te = [];
            this.La = [];
            this.Ia = [];
            this.W = 1;
            this.la = this.Dd = this.Ed = null;
            this.wf = {};
            this.addListener = function(a, d) {
                (this.wf[a] = this.wf[a] || []).push(d)
            }
            ;
            this.tl = function(a, d) {
                var b = this.wf[a], l, h;
                if (b)
                    for (h = 0,
                    l = b.length; h < l; h++)
                        b[h].apply(null, d)
            }
            ;
            this.removeEventListener = function(a, d) {
                var b = this.wf[a];
                if (b) {
                    var l, h;
                    h = 0;
                    for (l = b.length; h < l; h++)
                        if (b[h] === d) {
                            1 === l ? delete this.wf[a] : b.splice(h, 1);
                            break
                        }
                }
            }
            ;
            this.h = new m.Pl;
            this.An = {
                target: 0,
                current: 0,
                Kc: .01,
                sm: 2,
                ki: 0,
                Ng: !1,
                am: !1
            };
            this.margin = {
                left: 0,
                top: 0,
                right: 0,
                bottom: 0
            };
            this.A = {
                Qe: !1,
                Hi: !1,
                sb: !1,
                Yc: !1,
                od: !0,
                nk: !1,
                kl: 1,
                $k: !1,
                ii: !0,
                uf: !0,
                Ig: !1,
                Jf: !1,
                bl: !0,
                sensitivity: 8
            };
            this.Wf = [];
            this.Pc = !0;
            this.qa = {
                x: 0,
                y: 0
            };
            this.wg = this.wb = this.vg = this.Gc = this.Z = !1;
            this.Lh = this.Cl = !0;
            this.Ai = !1;
            this.de = !0;
            this.zi = !1;
            this.Ja = this.Cd = "";
            this.Rc = "transition";
            this.Va = "transform";
            this.jd = "perspective";
            this.Lj = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYBgeACDAAADIAAE3iTbkAAAAAElFTkSuQmCC";
            this.jb = {
                width: 0,
                height: 0
            };
            this.Rj = new m.ra;
            this.Qj = new m.ra;
            this.Sj = new m.ra;
            this.Tj = new m.ra;
            this.Pj = new m.ra;
            this.Of = !1;
            this.wk = this.Ub = "";
            this.sj = [];
            this.Hh = [];
            this.Mf = this.rk = this.Zg = this.sk = this.Kd = this.pk = this.$i = this.qd = this.Lf = this.qk = !1;
            this.Mh = !0;
            this.uh = this.$g = !1;
            this.jk = [];
            this.devicePixelRatio = 1;
            this.ga = this.B = null;
            this.Gg = !1;
            this.Ea = null;
            this.qb = {
                enabled: !1,
                speed: 1,
                wd: !1,
                oi: !0
            };
            this.Jk = !1;
            this.hb = new m.Ql;
            this.nj = !1;
            this.tf = function(a, d) {
                if (0 == a.length)
                    return a;
                var b, l, h, g, k, n, r, p;
                p = [];
                b = d.qh(a[0]) - 0;
                for (g = 0; g < a.length; g++) {
                    n = g;
                    r = g + 1;
                    r == a.length && (r = 0);
                    l = d.qh(a[r]) - 0;
                    if (0 <= b && 0 <= l)
                        p.push(a[n]);
                    else if (0 <= b || 0 <= l)
                        h = l / (l - b),
                        0 > h && (h = 0),
                        1 < h && (h = 1),
                        k = new m.ra,
                        k.nd(a[n], a[r], h),
                        0 > b || p.push(a[n]),
                        p.push(k);
                    b = l
                }
                return p
            }
            ;
            this.dj = 0;
            this.gh = -1;
            this.Df = function(a) {
                return a ? a.pageX || a.pageY ? {
                    x: a.pageX,
                    y: a.pageY
                } : a.clientX || a.clientY ? {
                    x: a.clientX + document.body.scrollLeft + document.documentElement.scrollLeft,
                    y: a.clientY + document.body.scrollTop + document.documentElement.scrollTop
                } : a.touches && a.touches[0] ? {
                    x: a.touches[0].pageX,
                    y: a.touches[0].pageY
                } : {
                    x: 0,
                    y: 0
                } : {
                    x: 0,
                    y: 0
                }
            }
            ;
            this.lh = 1;
            this.wm = this.Sg = this.vk = this.li = this.Vi = this.rh = 0;
            this.ce = !0;
            this.pb = new m.dh(this);
            this.pb.Me = !1;
            this.Kj();
            this.$e(this.pb);
            this.checkLoaded = this.Gb;
            this.isLoaded = !1;
            d && d.hasOwnProperty("useFlash") && d.useFlash && (this.wb = !0,
            this.Z = this.Gc = !1,
            d.hasOwnProperty("flashPlayerId") ? this.ee = d.flashPlayerId : this.ee = "pano",
            d.hasOwnProperty("flashContainerId") ? this.si = d.flashContainerId : this.si = a + "flash");
            this.pa();
            this.wb || (this.Ba = new m.Ll(this));
            this.Ej(a);
            this.$l();
            this.userdata = this.gf = this.Pg();
            this.emptyHotspot = this.pb;
            this.mouse = this.qa;
            this.B = new m.Nl(this);
            this.Ea = new m.Ol(this);
            this.la = new m.Ul(this)
        }
        b.prototype.di = function() {
            this.B.enabled = this.ga.enabled;
            this.B.type = this.ga.type;
            this.B.Na = this.ga.zoomin;
            this.B.Nb = this.ga.zoomout;
            this.B.Dg = this.ga.blendtime;
            this.B.kf = this.ga.zoomoutpause;
            this.B.jf = this.ga.zoomfov;
            this.B.Td = this.ga.zoomspeed;
            this.B.Ae = this.ga.blendcolor;
            this.B.tc = this.ga.softedge;
            this.ga = null
        }
        ;
        b.prototype.mo = function(a) {
            this.ga = {};
            this.ga.enabled = !0;
            this.ga.type = this.B.type;
            this.ga.zoomin = this.B.Na;
            this.ga.zoomout = this.B.Nb;
            this.ga.blendtime = this.B.Dg;
            this.ga.zoomoutpause = this.B.kf;
            this.ga.zoomfov = this.B.jf;
            this.ga.zoomspeed = this.B.Td;
            this.ga.blendcolor = this.B.Ae;
            this.ga.softedge = this.B.tc;
            if (a.hasOwnProperty("type")) {
                var d = a.type;
                if ("cut" == d || "crossdissolve" == d || "diptocolor" == d || "irisround" == d || "irisrectangular" == d || "wipeleftright" == d || "wiperightleft" == d || "wipetopbottom" == d || "wipebottomtop" == d || "wiperandom" == d)
                    this.ga.type = d
            }
            a.hasOwnProperty("before") && (d = Number(a.before),
            0 == d || 2 == d) && (this.ga.zoomin = d);
            a.hasOwnProperty("after") && (d = Number(a.after),
            0 == d || 2 == d || 3 == d || 4 == d) && (this.ga.zoomout = d);
            a.hasOwnProperty("transitiontime") && (d = Number(a.transitiontime),
            0 <= d && 50 >= d && (this.ga.blendtime = d));
            a.hasOwnProperty("waitfortransition") && (this.ga.zoomoutpause = 1 == a.waitfortransition);
            a.hasOwnProperty("zoomedfov") && (d = Number(a.zoomedfov),
            .01 <= d && 50 >= d && (this.ga.zoomfov = d));
            a.hasOwnProperty("zoomspeed") && (d = Number(a.zoomspeed),
            .01 <= d && 99 >= d && (this.ga.zoomspeed = d));
            a.hasOwnProperty("dipcolor") && (this.ga.blendcolor = a.dipcolor);
            a.hasOwnProperty("softedge") && (a = Number(a.softedge),
            0 <= a && 1E3 >= a && (this.ga.softedge = a));
            this.Gg || this.di()
        }
        ;
        b.prototype.ad = function(a, d, c) {
            var b = d ? Number(d) : 0;
            if (0 != a && 4 != a && 12 != a && 9 != a)
                this.Zc("Unsupported projection type: " + a);
            else if (d && 0 !== b && 4 !== b && 12 !== b && 9 !== b)
                this.Zc("Unsupported projection2 type: " + b);
            else if (a == b && (b = 0),
            this.Zf = c ? Number(c) : 1,
            this.Za != a || this.fc != b)
                this.Za = a,
                this.fc = b,
                this.la.Yg()
        }
        ;
        b.prototype.xa = function() {
            return 0 == this.Za ? 4 : this.Za
        }
        ;
        b.prototype.$h = function(a, d) {
            if (0 != a && 4 != a && 12 != a && 9 != a)
                this.Zc("Unsupported projection type: " + a);
            else if (this.Z || 0 == a || 4 == a || this.Zc("Projection changes require WebGL!"),
            this.xa() != a) {
                var c = {};
                c.pan = this.pan.c;
                c.tilt = this.j.c;
                c.fov = this.f.c;
                c.projection = a;
                c.timingFunction = 3;
                c.speed = d;
                var b = this.Cf(a);
                c.fov = Math.min(b, c.fov);
                this.kh(c)
            }
        }
        ;
        b.prototype.Kj = function() {
            var a;
            this.devicePixelRatio = window.devicePixelRatio || 1;
            this.qk = navigator.userAgent.match(/(MSIE)/g) ? !0 : !1;
            this.Lf = navigator.userAgent.match(/(Firefox)/g) ? !0 : !1;
            if (this.qd = navigator.userAgent.match(/(Safari)/g) ? !0 : !1)
                a = navigator.userAgent.indexOf("Safari"),
                this.xd = navigator.userAgent.substring(a + 7),
                a = navigator.userAgent.indexOf("Version"),
                -1 != a && (this.xd = navigator.userAgent.substring(a + 8)),
                this.xd = this.xd.substring(0, this.xd.indexOf(" ")),
                this.xd = this.xd.substring(0, this.xd.indexOf(".")),
                this.$i = !0;
            if (this.pk = navigator.userAgent.match(/(Chrome)/g) ? !0 : !1)
                this.qd = !1;
            this.Kd = navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? !0 : !1;
            this.sk = navigator.userAgent.match(/(iPhone|iPod)/g) ? !0 : !1;
            this.Zg = navigator.userAgent.match(/(android)/i) ? !0 : !1;
            this.rk = navigator.userAgent.match(/(IEMobile)/i) ? !0 : !1;
            this.Mf = this.Kd || this.Zg || this.rk;
            /iP(hone|od|ad)/.test(navigator.platform) && (a = navigator.appVersion.match(/OS (\d+)_(\d+)_?(\d+)?/),
            this.jk = [parseInt(a[1], 10), parseInt(a[2], 10), parseInt(a[3] || "0", 10)]);
            this.$g = !window.requestAnimationFrame;
            a = ["Webkit", "Moz", "O", "ms", "Ms"];
            var d;
            this.Ja = "";
            this.Rc = "transition";
            this.Va = "transform";
            this.jd = "perspective";
            for (d = 0; d < a.length; d++)
                "undefined" !== typeof document.documentElement.style[a[d] + "Transform"] && (this.Ja = "-" + a[d].toLowerCase() + "-",
                this.Rc = a[d] + "Transition",
                this.Va = a[d] + "Transform",
                this.jd = a[d] + "Perspective");
            this.Ai = G();
            this.Z = N();
            this.Gc = this.Ai;
            this.Z && (this.Gc = !1);
            this.sc = !0;
            this.Xe = !1;
            if (this.Kd || this.Zg)
                this.dl(80),
                this.qg = 2;
            this.Zc("Pano2VR player - Prefix:" + this.Ja + ", " + (this.Ai ? "CSS 3D available" : "CSS 3D not available") + ", " + (this.Z ? "WebGL available" : "WebGL not available"));
            O && this.L("Pano2VR Debug version!");
            try {
                window.AudioContext = window.AudioContext || window.webkitAudioContext,
                this.Ha = new AudioContext
            } catch (c) {
                this.Ha = null
            }
            this.qd && (!this.$i || 9 > Number(this.xd)) && (this.Ha = null);
            this.Mh = this.sk ? this.qd && this.$i && 10 <= Number(this.xd) ? !0 : !1 : !0
        }
        ;
        b.prototype.L = function(a) {
            if (O) {
                var d = document.getElementById("debug");
                d && (d.innerHTML = a.toString() + "<br />");
                window.console && window.console.log(a)
            }
        }
        ;
        b.prototype.Zc = function(a) {
            var d = document.getElementById("debug");
            d && (d.innerHTML = a + "<br />");
            window.console && window.console.log(a)
        }
        ;
        b.prototype.dl = function(a) {
            this.je = a
        }
        ;
        b.prototype.Vn = function(a) {
            this.crossOrigin = a
        }
        ;
        b.prototype.Xn = function(a) {
            this.Ne = a
        }
        ;
        b.prototype.Sm = function() {
            return this.ph
        }
        ;
        b.prototype.Un = function(a) {
            this.Cd = a
        }
        ;
        b.prototype.Am = function() {
            return this.Cd
        }
        ;
        b.prototype.Hm = function() {
            return this.Mf
        }
        ;
        b.prototype.Fm = function() {
            return this.s.active
        }
        ;
        b.prototype.Yn = function(a) {
            this.Mf = !!a
        }
        ;
        b.prototype.Tg = function() {
            return this.isLoaded
        }
        ;
        b.prototype.hd = function() {
            return 1 * this.m.height / (2 * Math.tan(Math.PI / 180 * (this.Jb() / 2)))
        }
        ;
        b.prototype.fl = function(a, d) {
            this.isFullscreen && (a = window.innerWidth,
            d = window.innerHeight);
            var c = a - this.margin.left - this.margin.right
              , b = d - this.margin.top - this.margin.bottom;
            if (!(10 > c || 10 > b)) {
                var f = window.devicePixelRatio || 1;
                this.Ye && (f = 1);
                this.C.style.width = c + "px";
                this.C.style.height = b + "px";
                this.C.style.left = this.margin.left + "px";
                this.C.style.top = this.margin.top + "px";
                if (this.Z)
                    try {
                        this.$a && (this.$a.style.position = "absolute",
                        this.$a.style.display = "inline",
                        this.$a.style.width = c + "px",
                        this.$a.style.height = b + "px",
                        this.$a.width = c * f,
                        this.$a.height = b * f),
                        this.H && (this.jb.width = c * f,
                        this.jb.height = b * f,
                        this.H.viewport(0, 0, this.H.drawingBufferWidth, this.H.drawingBufferHeight))
                    } catch (l) {
                        alert(l)
                    }
                this.Tb && (this.Tb.style.width = a + "px",
                this.Tb.style.height = d + "px",
                this.Tb.width = a,
                this.Tb.height = d);
                this.Aa && (this.Aa.style.width = a + "px",
                this.Aa.style.height = d + "px",
                this.sa.style.width = a + "px",
                this.sa.style.height = d + "px",
                this.sa.width = a,
                this.sa.height = d,
                this.sa.style.left = this.margin.left + "px",
                this.sa.style.top = this.margin.top + "px",
                this.O && this.O != this.Aa && (this.O.style.width = a + "px",
                this.O.style.height = d + "px"));
                this.Ba && (c = this.Ba.Mc,
                c.style.width = a + "px",
                c.style.height = d + "px",
                c.width = a,
                c.height = d,
                c.style.left = this.margin.left + "px",
                c.style.top = this.margin.top + "px");
                this.If && (this.za = !0);
                c = this.C.offsetWidth;
                b = this.C.offsetHeight;
                if (this.m.width != c || this.m.height != b)
                    this.m.width = c,
                    this.m.height = b;
                this.Uo();
                this.O && this.O.ggUpdateSize && this.O.ggUpdateSize(a, d)
            }
        }
        ;
        b.prototype.we = function() {
            this.nj = !0
        }
        ;
        b.prototype.dd = function() {
            this.fl(this.Ed.offsetWidth, this.Ed.offsetHeight)
        }
        ;
        b.prototype.dn = function() {
            var a = {
                width: 0,
                height: 0
            };
            a.width = this.m.width;
            a.height = this.m.height;
            return a
        }
        ;
        b.prototype.fe = function() {
            var a = {
                x: 0,
                y: 0
            }
              , d = this.C;
            if (d.offsetParent) {
                do
                    a.x += d.offsetLeft,
                    a.y += d.offsetTop,
                    d = d.offsetParent;
                while (d)
            }
            return a
        }
        ;
        b.prototype.lo = function(a) {
            this.Qa = a
        }
        ;
        b.prototype.$n = function(a, d, c, b) {
            this.margin.left = a;
            this.margin.top = d;
            this.margin.right = c;
            this.margin.bottom = b;
            this.Qa = this.skinObj;
            this.we()
        }
        ;
        b.prototype.im = function(a) {
            0 == a && (this.A.od = !1);
            1 == a && (this.A.od = !0);
            2 == a && (this.A.od = this.A.od ? !1 : !0)
        }
        ;
        b.prototype.bn = function() {
            return 1 == this.A.od ? 1 : 0
        }
        ;
        b.prototype.Bj = function(a, d) {
            this.w.mode = 1 == d && 0 < this.w.mode ? 0 : Math.round(a);
            this.update();
            this.ha && (this.ha.changePolygonMode(a, d),
            this.ha.update())
        }
        ;
        b.prototype.hl = function(a) {
            var d = this.w.fb.indexOf(a);
            -1 == d ? (this.w.fb.push(a),
            this.w.Eb.push(0),
            this.w.Fc.push(1)) : this.w.Fc[d] = 1;
            this.update()
        }
        ;
        b.prototype.hk = function(a) {
            var d = this.w.fb.indexOf(a);
            -1 != d && (this.w.Fc[d] = 0,
            this.w.zh.push(a),
            this.update())
        }
        ;
        b.prototype.Go = function(a) {
            var d = this.w.fb.indexOf(a);
            -1 == d || -1 != d && 0 == this.w.Fc[d] ? this.hl(a) : this.hk(a);
            this.update()
        }
        ;
        b.prototype.gm = function(a, d, c, b, f) {
            for (var l = 0; l < this.P.length; l++) {
                var h = this.P[l];
                "poly" != h.type || h.id != a && "" != a || (h.Pb = d,
                h.Ob = c,
                h.Sb = b,
                h.Rb = f)
            }
            "" == a && (this.w.Pb = d,
            this.w.Ob = c,
            this.w.Sb = b,
            this.w.Rb = f);
            this.update()
        }
        ;
        b.prototype.em = function(a) {
            this.Ba && (this.Ba.cj = 0 == a ? !0 : 1 == a ? !1 : !this.Ba.cj,
            this.update())
        }
        ;
        b.prototype.Um = function() {
            return this.w.mode
        }
        ;
        b.prototype.jm = function() {}
        ;
        b.prototype.cn = function() {
            return 0
        }
        ;
        b.prototype.kk = function(a, d, c) {
            a = Math.atan2(a + 1, c);
            var b = Math.atan2(d + 1, c);
            d = Math.sin(a);
            c = Math.sin(b);
            a = Math.cos(a);
            b = Math.cos(b);
            this.Rj.Ya(0, 0, -1);
            this.Qj.Ya(a, 0, -d);
            this.Sj.Ya(-a, 0, -d);
            this.Tj.Ya(0, b, -c);
            this.Pj.Ya(0, -b, -c)
        }
        ;
        b.prototype.ci = function(a) {
            a = this.tf(a, this.Rj);
            a = this.tf(a, this.Qj);
            a = this.tf(a, this.Sj);
            a = this.tf(a, this.Tj);
            return a = this.tf(a, this.Pj)
        }
        ;
        b.prototype.vl = function(a) {
            if (!this.sc && this.nn != a) {
                this.nn = a;
                var d;
                d = this.margin.left + this.m.width / 2 + "px ";
                d += this.margin.top + this.m.height / 2 + "px ";
                this.Aa.style[this.jd] = a + "px";
                this.Aa.style[this.jd + "Origin"] = d;
                this.C.style[this.jd] = a + "px";
                this.C.style[this.jd + "Origin"] = d
            }
        }
        ;
        b.prototype.to = function() {
            return this.B.ue || this.B.Ad || this.Z && (4 != this.Za || 0 != this.fc) ? !1 : !0
        }
        ;
        b.prototype.tg = function() {
            var a, d = new m.ra(0,0,-100), c = this.hd(), b, f, l;
            f = 100 / this.f.c;
            l = this.h.width / this.h.height;
            b = this.m.height * f * l;
            f *= this.m.height;
            for (var h = this.to(), g = 0; g < this.P.length; g++) {
                var k = this.P[g], n, r;
                "point" == k.type && (r = !1,
                2 == this.kb ? (a = (this.pan.c - k.pan) / 100 / l * b,
                n = (this.j.c - k.j) / 100 * f,
                Math.abs(a) < this.m.width / 2 + 500 && Math.abs(n) < this.m.height / 2 + 500 && (r = !0)) : (d.Ya(0, 0, -100),
                d.va(-k.j * Math.PI / 180),
                d.Da(k.pan * Math.PI / 180),
                d.Da(-this.pan.c * Math.PI / 180),
                d.va(this.j.c * Math.PI / 180),
                d.mb(this.N.c * Math.PI / 180),
                .01 > d.z ? (n = -c / d.z,
                a = d.x * n,
                n *= d.y,
                Math.abs(a) < this.m.width / 2 + 500 && Math.abs(n) < this.m.height / 2 + 500 && (r = !0)) : n = a = 0),
                k.gc = a + this.m.width / 2,
                k.Cb = n + this.m.height / 2,
                k.a && k.a.__div && ("none" != k.a.__div.style[this.Rc] && (k.a.__div.style[this.Rc] = "none"),
                k.a.ggUse3d ? (this.sc || this.vl(c),
                k.a.__div.style.width = "1px",
                k.a.__div.style.height = "1px",
                a = "",
                this.sc && (a += "perspective(" + c + "px) "),
                a += "translate3d(0px,0px," + c + "px) ",
                a += "rotateZ(" + this.N.c.toFixed(10) + "deg) ",
                a += "rotateX(" + this.j.c.toFixed(10) + "deg) ",
                a += "rotateY(" + (-this.pan.c).toFixed(10) + "deg) ",
                a += "rotateY(" + k.pan.toFixed(10) + "deg) ",
                a += "rotateX(" + (-k.j).toFixed(10) + "deg) ",
                a += "translate3d(0px,0px," + (-1 * k.a.gg3dDistance).toFixed(10) + "px) ",
                k.a.__div.style[this.Va + "Origin"] = "0% 0%",
                k.a.__div.style[this.Va] = a,
                k.a.__div.style.left = this.margin.left + this.m.width / 2 + "px",
                k.a.__div.style.top = this.margin.top + this.m.height / 2 + "px") : r && h ? (k.a.__div.style.left = this.margin.left + a + this.m.width / 2 + "px",
                k.a.__div.style.top = this.margin.top + n + this.m.height / 2 + "px") : (k.a.__div.style.left = "-1000px",
                k.a.__div.style.top = "-1000px")));
                if ("poly" == k.type) {
                    var p = [];
                    if (2 == this.kb)
                        for (k.Od = [],
                        r = 0; r < k.xg.length; r++)
                            n = k.xg[r],
                            a = (this.pan.c - n.pan) / 100 / l * b,
                            n = (this.j.c - n.j) / 100 * f,
                            a += this.margin.left + this.m.width / 2,
                            n += this.margin.top + this.m.height / 2,
                            k.Od.push({
                                gc: a,
                                Cb: n
                            });
                    else {
                        for (r = 0; r < k.xg.length; r++)
                            n = k.xg[r],
                            d.Ya(0, 0, -100),
                            d.va(-n.j * Math.PI / 180),
                            d.Da(n.pan * Math.PI / 180),
                            d.Da(-this.pan.c * Math.PI / 180),
                            d.va(this.j.c * Math.PI / 180),
                            d.mb(this.N.c * Math.PI / 180),
                            p.push(d.clone());
                        p = this.ci(p);
                        if (0 < p.length)
                            for (r = 0; r < p.length; r++)
                                d = p[r],
                                .1 > d.z ? (n = -c / d.z,
                                a = this.m.width / 2 + d.x * n,
                                n = this.m.height / 2 + d.y * n) : n = a = 0,
                                d.gc = a,
                                d.Cb = n;
                        k.Od = p
                    }
                }
            }
        }
        ;
        b.prototype.Bm = function() {
            for (var a = [], d = 0; d < this.P.length; d++) {
                var c = this.P[d];
                "point" == c.type && c.a && c.a.__div && a.push(c.a.__div)
            }
            return a
        }
        ;
        b.prototype.fa = function(a, d) {
            a = Number(a);
            isNaN(d) && (d = 0);
            0 > d && (d = 0);
            1 < d && (d = 1);
            return "rgba(" + (a >> 16 & 255) + "," + (a >> 8 & 255) + "," + (a & 255) + "," + d + ")"
        }
        ;
        b.prototype.Cn = function() {
            var a, d;
            if (this.sa && (this.w.Qf != this.w.mode && (this.w.Qf = this.w.mode,
            this.sa.style.visibility = 0 < this.w.mode ? "inherit" : "hidden"),
            0 <= this.w.mode || 0 < this.w.fb.length)) {
                this.aa || (this.aa = this.sa.getContext("2d"));
                if (this.aa.width != this.m.width || this.aa.height != this.m.height)
                    this.aa.width = this.m.width,
                    this.aa.height = this.m.height;
                this.aa.clear ? this.aa.clear() : this.aa.clearRect(0, 0, this.sa.width, this.sa.height);
                var c = 1;
                0 >= this.w.mode && (c = 0);
                3 == this.w.mode && (c = this.w.na);
                for (a = 0; a < this.P.length; a++) {
                    d = this.P[a];
                    var b = c;
                    if ("poly" == d.type) {
                        var f = d.Od;
                        2 == this.w.mode && (b = d.na);
                        var l = this.w.fb.indexOf(d.id);
                        -1 != l && (b = this.w.Eb[l]);
                        this.aa.fillStyle = this.fa(d.Pb, d.Ob * b);
                        this.aa.strokeStyle = this.fa(d.Sb, d.Rb * b);
                        if (0 < f.length) {
                            this.aa.beginPath();
                            for (d = 0; d < f.length; d++)
                                b = f[d],
                                0 == d ? this.aa.moveTo(b.gc, b.Cb) : this.aa.lineTo(b.gc, b.Cb);
                            this.aa.closePath();
                            this.aa.stroke();
                            this.aa.fill()
                        }
                    }
                }
            }
        }
        ;
        b.prototype.ik = function(a, d, c) {
            var b, f, l = !1;
            b = 0;
            for (f = a.length - 1; b < a.length; f = b++) {
                var h = a[b];
                f = a[f];
                h.Cb > c != f.Cb > c && d < (f.gc - h.gc) * (c - h.Cb) / (f.Cb - h.Cb) + h.gc && (l = !l)
            }
            return l
        }
        ;
        b.prototype.bi = function(a, d) {
            var c = -1;
            if ((0 <= this.w.mode || 0 < this.w.fb.length) && this.jn())
                for (var b = 0; b < this.P.length; b++) {
                    var f = this.P[b];
                    "poly" == f.type && f.Od && 0 < f.Od.length && (-1 != this.w.mode || -1 != this.w.fb.indexOf(f.id)) && this.ik(f.Od, a, d) && (c = b,
                    f.gc = a,
                    f.Cb = d)
                }
            return 0 <= c ? this.P[c] : !1
        }
        ;
        b.prototype.jn = function() {
            return 4 == this.xa() && 0 == this.fc
        }
        ;
        b.prototype.Jb = function() {
            var a = 0
              , d = this.xa()
              , c = this.m;
            switch (this.f.mode) {
            case 0:
                a = this.f.c / 2;
                break;
            case 1:
                a = 4 == d ? 180 * Math.atan(c.height / c.width * Math.tan(this.f.c / 2 * Math.PI / 180)) / Math.PI : c.height / c.width * this.f.c / 2;
                break;
            case 2:
                a = Math.sqrt(c.width * c.width + c.height * c.height);
                a = 4 == d ? 180 * Math.atan(c.height / a * Math.tan(this.f.c / 2 * Math.PI / 180)) / Math.PI : c.height / a * this.f.c / 2;
                break;
            case 3:
                a = 4 * c.height / 3 > c.width ? this.f.c / 2 : 4 == d ? 180 * Math.atan(4 * c.height / (3 * c.width) * Math.tan(this.f.c / 2 * Math.PI / 180)) / Math.PI : 4 * c.height / (3 * c.width) * (this.f.c / 2)
            }
            return 2 * a
        }
        ;
        b.prototype.Dm = function(a, d) {
            a || (a = this.Jb());
            d || (d = this.xa());
            return 4 == d ? 180 * Math.atan(this.Ud() * Math.tan(a / 2 * Math.PI / 180)) / Math.PI : a * this.Ud()
        }
        ;
        b.prototype.Ud = function() {
            return this.m.width / this.m.height
        }
        ;
        b.prototype.jg = function(a) {
            a /= 2;
            var d, c = this.xa();
            switch (this.f.mode) {
            case 0:
                this.f.c = 2 * a;
                break;
            case 1:
                a = 4 == c ? 180 * Math.atan(this.m.width / this.m.height * Math.tan(a * Math.PI / 180)) / Math.PI : this.m.width / this.m.height * a;
                this.f.c = 2 * a;
                break;
            case 2:
                d = Math.sqrt(this.m.width * this.m.width + this.m.height * this.m.height);
                a = 4 == c ? 180 * Math.atan(d / this.m.height * Math.tan(a * Math.PI / 180)) / Math.PI : d / this.m.height * a;
                this.f.c = 2 * a;
                break;
            case 3:
                4 * this.m.height / 3 > this.m.width || (d = 3 * this.m.width / (4 * this.m.height),
                a = 4 == c ? 180 * Math.atan(d * Math.tan(a * Math.PI / 180)) / Math.PI : d * a),
                this.f.c = 2 * a
            }
        }
        ;
        b.prototype.Hg = function() {
            var a = new k;
            a.pan = this.pan.c;
            a.j = this.j.c;
            a.f = this.f.c;
            this.Ee(a);
            this.Ee(a);
            this.Ee(a);
            this.pan.c = a.pan;
            this.j.c = a.j;
            this.f.c = a.f
        }
        ;
        b.prototype.Ee = function(a) {
            var d, c, b = this.m.width / this.m.height;
            if (2 == this.kb) {
                0 < this.f.Xf && (d = this.ic,
                this.h.I && 0 < this.h.I.length && (d = this.h.I[0].height),
                this.f.min = 100 * this.m.height / (d * this.f.Xf));
                c = a.f / 2;
                d = c * b;
                var f = this.h.width / this.h.height * 50
                  , b = this.A.bl ? 2 * Math.min(50, f / b) : 2 * Math.max(50, f / b);
                a.f < this.f.min && (a.f = this.f.min);
                a.f > b && (a.f = b);
                50 < c ? a.j = 0 : (50 < a.j + c && (a.j = 50 - c),
                -50 > a.j - c && (a.j = -50 + c));
                d > f ? a.pan = 0 : (a.pan + d > f && (a.pan = f - d,
                this.s.active && (this.s.speed = -this.s.speed,
                this.pan.d = 0)),
                a.pan - d < -f && (a.pan = -f + d,
                this.s.active && (this.s.speed = -this.s.speed,
                this.pan.d = 0)))
            } else {
                0 < this.f.Xf && (d = this.ic,
                this.h.I && 0 < this.h.I.length && (d = this.h.I[0].height),
                this.f.min = 360 * Math.atan2(this.m.height / 2, d / 2 * this.f.Xf) / Math.PI);
                a.f < this.f.min && (a.f = this.f.min);
                var f = this.f.max
                  , l = 179;
                c = this.Jb() / 2;
                d = b * c;
                4 == this.xa() ? d = 180 * Math.atan(b * Math.tan(c * Math.PI / 180)) / Math.PI : 9 == this.xa() ? (f = this.f.Ki,
                l = 355) : 12 == this.xa() && (f = this.f.Ji,
                l = 360);
                this.Z || (f = Math.max(160, f));
                a.f > f && (a.f = f);
                12 == this.xa() && (2 * d > l && (a.f = l / b),
                c = this.Jb() / 2,
                2 * c > l && (a.f = l),
                c = this.Jb() / 2,
                d = b * c);
                2 * c > this.j.max - this.j.min && 180 > this.j.max - this.j.min && (c = (this.j.max - this.j.min) / 2,
                this.jg(2 * c));
                90 > this.j.max ? a.j + c > this.j.max && (a.j = this.j.max - c) : a.j > this.j.max && (a.j = this.j.max);
                -90 < this.j.min ? a.j - c < this.j.min && (a.j = this.j.min + c) : a.j < this.j.min && (a.j = this.j.min);
                b = this.pan.max - this.pan.min;
                if (359.99 > b) {
                    var f = 90
                      , l = Math.tan(c * Math.PI / 180)
                      , h = Math.tan((Math.abs(a.j) + c) * Math.PI / 180)
                      , h = Math.sqrt(h * h + 1) / Math.sqrt(l * l + 1);
                    c = 180 * Math.atan(h * Math.tan(d * Math.PI / 180)) / Math.PI;
                    2 * c > b && (h = Math.tan(b * Math.PI / 360) / Math.tan(d * Math.PI / 180),
                    b = h * Math.sqrt(l * l + 1),
                    h = Math.sqrt(b * b - 1),
                    f = 180 / Math.PI * Math.atan(h));
                    a.pan + c > this.pan.max && (a.pan = this.pan.max - c,
                    this.s.active && (this.s.speed = -this.s.speed,
                    this.pan.d = 0));
                    a.pan - c < this.pan.min && (a.pan = this.pan.min + c,
                    this.s.active && (this.s.speed = -this.s.speed,
                    this.pan.d = 0));
                    a.j + d > f && (a.j = f - d);
                    a.j - d < -f && (a.j = -f + d)
                }
            }
        }
        ;
        b.prototype.update = function(a) {
            void 0 === a && (a = 0);
            this.za = !0;
            a && (this.vf = Math.max(1 * a, this.vf))
        }
        ;
        b.prototype.Im = function() {
            return this.ha ? !!this.ha.isTileLoading : 0 < this.Fa || 0 < this.uc
        }
        ;
        b.prototype.ug = function() {
            var a = Date.now(), d;
            this.wb ? this.ha && (this.No(),
            2 === this.kb ? (this.Hg(),
            this.tg()) : 0 === this.kb && (d = this.hd(),
            this.kk(this.m.width / 2, this.m.height / 2, d),
            this.tg())) : 2 === this.kb ? (this.tg(),
            this.Z ? (this.la.lj(),
            this.la.Lk()) : this.lj()) : 0 === this.kb && (!this.Z || 4 == this.Za && 0 == this.fc ? (d = this.hd(),
            this.kk(this.m.width / 2, this.m.height / 2, d),
            this.tg(),
            this.wg ? this.la.To() : this.Cl && this.Bl(),
            this.wl(),
            this.Z ? (this.o.Xc ? 14 == this.o.format ? this.la.So() : this.la.Gl() : 0 < this.h.I.length ? this.la.Zo() : this.la.ap(),
            this.la.Lk()) : (this.Gc ? 0 < this.h.I.length ? this.Qo() : this.Po() : this.vg && this.Mo(),
            this.Cn()),
            this.Ba && this.Ba.Bn()) : (this.la.Gl(),
            this.tg(),
            this.hn()));
            d = Date.now();
            50 < d - a ? (this.L("Time between frames: " + (d - a)),
            this.Ye || (2 < this.dj ? (this.Ye = !0,
            this.L("disabling HighDPI rendering"),
            this.dd()) : this.dj++)) : this.dj = 0;
            this.If && this.h.Xk++
        }
        ;
        b.prototype.Po = function() {
            var a = !1;
            if (this.m.width != this.C.offsetWidth || this.m.height != this.C.offsetHeight)
                this.m.width = this.C.offsetWidth,
                this.m.height = this.C.offsetHeight,
                this.C.style[this.Va + "OriginX"] = this.m.width / 2 + "px",
                this.C.style[this.Va + "OriginY"] = this.m.height / 2 + "px",
                a = !0;
            var d = Math.round(this.hd());
            this.Rf == d && !a || this.sc || (this.Rf = d,
            this.C.style[this.jd] = d + "px");
            this.hb.mm(this.pan.c, this.j.c, this.N.c, this.Ca);
            for (a = 0; 6 > a; a++) {
                var c, b;
                if (c = this.hb.ab[a])
                    b = "",
                    this.sc ? (b += "translate3d(" + this.m.width / 2 + "px," + this.m.height / 2 + "px,0px) ",
                    b += "perspective(" + d + "px) ",
                    b += "translate3d(0px,0px," + d + "px) ") : b += "translate3d(" + this.m.width / 2 + "px," + this.m.height / 2 + "px," + d + "px) ",
                    b += "rotateZ(" + Number(this.N.c).toFixed(10) + "deg) ",
                    b += "rotateX(" + Number(this.j.c).toFixed(10) + "deg) ",
                    b += "rotateY(" + Number(-this.pan.c).toFixed(10) + "deg) ",
                    c.ek && (b += c.ek,
                    c.qc || (b = "translate3d(-10px,-10px,0px) scale(0.001,0.001)"),
                    c.K.style[this.Va] = b)
            }
        }
        ;
        b.prototype.Mo = function() {
            this.Hg();
            var a;
            this.Tb && (a = this.Tb.getContext("2d"));
            if (this.m.width !== this.C.offsetWidth || this.m.height !== this.C.offsetHeight)
                this.m.width = this.C.offsetWidth,
                this.m.height = this.C.offsetHeight;
            if (a) {
                var d = a.canvas.width / 2
                  , c = a.canvas.height / 2
                  , b = a.createRadialGradient(d, c, 5, d, c, Math.max(d, c));
                b.addColorStop(0, "#333");
                b.addColorStop(1, "#fff");
                a.rect(0, 0, a.canvas.width, a.canvas.height);
                a.fillStyle = b;
                a.fill();
                a.fillStyle = "#f00";
                a.font = "20px Helvetica";
                a.textAlign = "center";
                a.fillText("Pan: " + this.pan.c.toFixed(1), d, c - 60);
                a.fillText("Tilt: " + this.j.c.toFixed(1), d, c - 30);
                a.fillText("Fov: " + this.f.c.toFixed(1), d, c + 0);
                a.fillText("Node: " + this.Xj(), d, c + 30);
                a.fillText("Title: " + this.gf.title, d, c + 60)
            }
        }
        ;
        b.prototype.No = function() {
            this.Hg();
            if (this.m.width !== this.C.offsetWidth || this.m.height !== this.C.offsetHeight)
                this.m.width = this.C.offsetWidth,
                this.m.height = this.C.offsetHeight;
            this.ha && this.ha.setPan && (this.ha.setPan(this.pan.c),
            this.ha.setTilt(this.j.c),
            this.ha.setFov(this.f.c))
        }
        ;
        b.prototype.lj = function() {
            this.sa.style.visibility = "inherit";
            this.aa || (this.aa = this.sa.getContext("2d"));
            if (this.aa.width != this.m.width || this.aa.height != this.m.height)
                this.aa.width = this.m.width,
                this.aa.height = this.m.height;
            this.aa.clear ? this.aa.clear() : this.aa.clearRect(0, 0, this.sa.width, this.sa.height);
            this.uc = 0;
            var a, d, c;
            d = 100 / this.f.c;
            c = this.h.width / this.h.height;
            var b = this.m.height * d * c;
            d *= this.m.height;
            a = (this.pan.c / 100 / c - .5) * b + this.m.width / 2;
            for (var f = (this.j.c / 100 - .5) * d + this.m.height / 2, l, h, g, k, n = 0; this.h.I.length >= n + 2 && this.h.I[n + 1].width > b; )
                n++;
            var r, p;
            p = [];
            for (r = this.h.I.length - 1; r >= n; ) {
                c = this.h.I[r];
                var u;
                if (c.cache)
                    u = {
                        Wa: 0,
                        rb: 0
                    },
                    u.tb = c.M - 1,
                    u.ub = c.ea - 1;
                else {
                    u = {};
                    var t = -f / d * (c.height / this.h.G);
                    l = (-a + this.m.width) / b * (c.width / this.h.G);
                    h = (-f + this.m.height) / d * (c.height / this.h.G);
                    u.Wa = Math.min(Math.max(0, Math.floor(-a / b * (c.width / this.h.G))), c.M - 1);
                    u.rb = Math.min(Math.max(0, Math.floor(t)), c.ea - 1);
                    u.tb = Math.min(Math.max(0, Math.floor(l)), c.M - 1);
                    u.ub = Math.min(Math.max(0, Math.floor(h)), c.ea - 1)
                }
                p[r] = u;
                var v = !0;
                for (h = u.rb; h <= u.ub; h++)
                    for (l = u.Wa; l <= u.tb; l++)
                        k = l + h * c.M,
                        t = c.V[k],
                        t || (t = new m.Id,
                        c.V[k] = t),
                        this.Fa < this.qg ? t.h || (this.Bi++,
                        t.h = new Image,
                        t.h.onload = this.Do(),
                        t.h.onerror = this.Dh(t),
                        t.h.onabort = this.Dh(t),
                        t.h.crossOrigin = this.crossOrigin,
                        t.h.setAttribute("src", this.se(0, r, l, h)),
                        c.cache && this.Gb.push(t.h),
                        0 == this.Fa && this.O && this.O.ggReLoadedLevels && this.O.ggReLoadedLevels(),
                        this.Fa++,
                        this.za = !0) : this.uc++,
                        t.h && t.h.complete || (v = !1),
                        t.visible = !0;
                u.Fi = v;
                r--
            }
            for (r = this.h.I.length - 1; r >= n; ) {
                c = this.h.I[r];
                if (p[r] && 0 <= p[r].Wa)
                    for (u = p[r],
                    h = u.rb; h <= u.ub; h++)
                        for (l = u.Wa; l <= u.tb; l++)
                            k = l + h * c.M,
                            (t = c.V[k]) || (t = c.V[k] = new m.Id),
                            t.h && t.h.complete && this.aa.drawImage(t.h, a + (-this.h.Ka + this.h.G * l) * b / c.width, f + (-this.h.Ka + this.h.G * h) * d / c.height, t.h.width * b / c.width, t.h.height * d / c.height),
                            t.visible = !0;
                r--
            }
            for (b = 0; b < this.h.I.length; b++)
                if (c = this.h.I[b],
                !c.cache)
                    for (g in c.V)
                        c.V.hasOwnProperty(g) && (t = c.V[g],
                        t.visible || (t.h = null,
                        delete c.V[g]));
            if (0 <= this.w.mode || 0 < this.w.fb.length)
                for (b = 1,
                0 >= this.w.mode && (b = 0),
                3 == this.w.mode && (b = this.w.na),
                g = 0; g < this.P.length; g++)
                    if (c = this.P[g],
                    a = b,
                    "poly" == c.type && (d = c.Od,
                    2 == this.w.mode && (a = c.na),
                    f = this.w.fb.indexOf(c.id),
                    -1 != f && (a = this.w.Eb[f]),
                    0 < d.length)) {
                        this.aa.fillStyle = this.fa(c.Pb, c.Ob * a);
                        this.aa.strokeStyle = this.fa(c.Sb, c.Rb * a);
                        this.aa.beginPath();
                        for (c = 0; c < d.length; c++)
                            a = d[c],
                            0 == c ? this.aa.moveTo(a.gc, a.Cb) : this.aa.lineTo(a.gc, a.Cb);
                        this.aa.closePath();
                        this.aa.stroke();
                        this.aa.fill()
                    }
            this.Pc = !1
        }
        ;
        b.prototype.Co = function(a) {
            var d = this;
            return function() {
                d.update();
                d.Pc = !0;
                a.loaded = !0;
                a.h && !a.K && d.C.appendChild(a.h);
                d.Fa && d.Fa--;
                0 == d.Fa && d.O && d.O.ggLoadedLevels && d.O.ggLoadedLevels();
                a.h && a.Oa && (a.Oa.drawImage(a.h, 0, 0),
                a.h = null)
            }
        }
        ;
        b.prototype.Do = function() {
            var a = this;
            return function() {
                a.za = !0;
                a.Pc = !0;
                a.Fa && a.Fa--;
                0 == a.Fa && a.O && a.O.ggLoadedLevels && a.O.ggLoadedLevels()
            }
        }
        ;
        b.prototype.Dh = function(a) {
            var d = this;
            return function() {
                d.za = !0;
                d.Pc = !0;
                d.Fa && d.Fa--;
                0 == d.Fa && d.O && d.O.ggLoadedLevels && d.O.ggLoadedLevels();
                a.h = null
            }
        }
        ;
        b.prototype.dk = function(a, d, c) {
            c.Wa = a.width / this.h.G * d.yf;
            c.rb = a.height / this.h.G * d.zf;
            c.tb = a.width / this.h.G * d.Uf;
            c.ub = a.height / this.h.G * d.Vf;
            c.Wa = Math.min(Math.max(0, Math.floor(c.Wa)), a.M - 1);
            c.rb = Math.min(Math.max(0, Math.floor(c.rb)), a.ea - 1);
            c.tb = Math.min(Math.max(0, Math.floor(c.tb)), a.M - 1);
            c.ub = Math.min(Math.max(0, Math.floor(c.ub)), a.ea - 1)
        }
        ;
        b.prototype.bo = function(a) {
            a = Math.round(a);
            this.sc = 0 < (a & 1);
            this.Xe = 0 < (a & 2);
            this.Lh = 0 < (a & 4);
            this.Ye = 0 < (a & 8);
            4096 <= a && (this.Gc = 0 < (a & 4096),
            this.Z = 0 < (a & 8192),
            this.vg = 0 < (a & 32768))
        }
        ;
        b.prototype.Xm = function() {
            var a = 0;
            this.sc && (a |= 1);
            this.Xe && (a |= 2);
            this.Lh && (a |= 4);
            this.Gc && (a |= 4096);
            this.Z && (a |= 8192);
            this.vg && (a |= 32768);
            return a
        }
        ;
        b.prototype.yl = function() {
            if (!(6 > this.hb.ab.length))
                for (var a = 0; 6 > a; a++) {
                    var d;
                    d = this.hb.ab[a];
                    var c;
                    c = [];
                    c.push(new m.ra(-1,-1,-1,0,0));
                    c.push(new m.ra(1,-1,-1,1,0));
                    c.push(new m.ra(1,1,-1,1,1));
                    c.push(new m.ra(-1,1,-1,0,1));
                    for (var b = 0; 4 > b; b++)
                        4 > a ? c[b].Da(-Math.PI / 2 * a) : c[b].va(Math.PI / 2 * (4 == a ? -1 : 1)),
                        this.Ca && (c[b].mb(this.Ca.N * Math.PI / 180),
                        c[b].va(-this.Ca.pitch * Math.PI / 180)),
                        c[b].Da(-this.pan.c * Math.PI / 180),
                        c[b].va(this.j.c * Math.PI / 180),
                        c[b].mb(this.N.c * Math.PI / 180);
                    c = this.ci(c);
                    d.qc = 0 < c.length;
                    if (d.qc) {
                        d = d.Re;
                        d.yf = c[0].cd;
                        d.Uf = c[0].cd;
                        d.zf = c[0].Fb;
                        d.Vf = c[0].Fb;
                        for (b = 1; b < c.length; b++)
                            d.yf = Math.min(d.yf, c[b].cd),
                            d.Uf = Math.max(d.Uf, c[b].cd),
                            d.zf = Math.min(d.zf, c[b].Fb),
                            d.Vf = Math.max(d.Vf, c[b].Fb);
                        d.hf = d.Uf - d.yf;
                        d.yg = d.Vf - d.zf;
                        d.scale = Math.max(d.hf, d.yg)
                    } else
                        d.Re.hf = -1,
                        d.Re.yg = -1
                }
        }
        ;
        b.prototype.Ii = function() {
            for (var a = 0; a < this.h.I.length; a++) {
                var d = this.h.I[a], c;
                for (c in d.V)
                    d.V.hasOwnProperty(c) && (d.V[c].visible = !1)
            }
        }
        ;
        b.prototype.ni = function() {
            for (var a = 0, d = Math.tan(Math.min(this.Jb(), 175) * Math.PI / 360), c = this.m.height / (2 * d), c = c * (1 + this.m.width / this.m.height * d / 2), c = c * Math.pow(2, 1 < this.devicePixelRatio ? this.h.Ck : this.h.Bk); this.h.I.length >= a + 2 && !this.h.I[a + 1].Ue && this.h.I[a + 1].width > c; )
                a++;
            return a
        }
        ;
        b.prototype.Qo = function() {
            var a = !1, d, c, b;
            if (this.m.width !== this.C.offsetWidth || this.m.height !== this.C.offsetHeight)
                this.m.width = this.C.offsetWidth,
                this.m.height = this.C.offsetHeight,
                this.C.style[this.Va + "OriginX"] = this.m.width / 2 + "px",
                this.C.style[this.Va + "OriginY"] = this.m.height / 2 + "px",
                a = !0;
            var f = Math.round(this.hd());
            if (this.Rf != f || a)
                this.Rf = f,
                this.sc || (this.C.style[this.jd] = f + "px",
                this.C.style[this.jd + "Origin"] = "50% 50%");
            this.uc = 0;
            if (0 < this.h.I.length) {
                this.yl();
                this.Ii();
                var l;
                l = "";
                for (d = 0; 6 > d; d++) {
                    var h;
                    h = this.hb.ab[d];
                    h.qc && (l = l + d + ",")
                }
                l = this.ni();
                var g;
                for (g = this.h.I.length - 1; g >= l; ) {
                    var a = this.h.I[g]
                      , k = 1;
                    g == this.h.I.length - 1 && 0 == this.h.Ka && (k = this.h.G / (this.h.G - 2));
                    for (d = 0; 6 > d; d++) {
                        h = this.hb.ab[d];
                        var n = h.Re;
                        if (h.qc && 0 < n.hf && 0 < n.yg && 0 < n.scale || a.cache) {
                            h.za = !1;
                            var r;
                            r = {};
                            a.cache ? (r.Wa = 0,
                            r.rb = 0,
                            r.tb = a.M - 1,
                            r.ub = a.ea - 1) : this.dk(a, n, r);
                            for (b = r.rb; b <= r.ub; b++)
                                for (c = r.Wa; c <= r.tb; c++) {
                                    var p = c + b * a.M + d * a.M * a.ea;
                                    (n = a.V[p]) || (n = a.V[p] = new m.Id);
                                    if (!n.K && this.Fa < this.qg) {
                                        if (0 < this.Hh.length) {
                                            n.K = this.Hh.shift();
                                            for (p = this.C.firstChild; p && p.Hd && (-1 == p.Hd || p.Hd >= g); )
                                                p = p.nextSibling;
                                            this.C.insertBefore(n.K, p);
                                            n.Oa = n.K.getContext("2d")
                                        } else if (this.rl < this.je) {
                                            this.rl++;
                                            n.K = document.createElement("canvas");
                                            n.K.width = this.h.G + 2 * this.h.Ka;
                                            n.K.height = this.h.G + 2 * this.h.Ka;
                                            n.Oa = n.K.getContext("2d");
                                            n.K.style[this.Va + "Origin"] = "0% 0%";
                                            n.K.style.overflow = "hidden";
                                            n.K.style.position = "absolute";
                                            for (p = this.C.firstChild; p && p.Hd && (-1 == p.Hd || p.Hd >= g); )
                                                p = p.nextSibling;
                                            this.C.insertBefore(n.K, p)
                                        }
                                        n.K && (this.Bi++,
                                        n.h = new Image,
                                        n.h.crossOrigin = this.crossOrigin,
                                        n.h.style[this.Va + "Origin"] = "0% 0%",
                                        n.h.style.position = "absolute",
                                        n.h.style.overflow = "hidden",
                                        n.K.Hd = g,
                                        n.h.onload = this.Co(n),
                                        n.h.onerror = this.Dh(n),
                                        n.h.onabort = this.Dh(n),
                                        n.h.setAttribute("src", this.se(d, g, c, b)),
                                        a.cache && this.Gb.push(n.h),
                                        0 == this.Fa && this.O && this.O.ggReLoadedLevels && this.O.ggReLoadedLevels(),
                                        this.Fa++,
                                        this.za = !0)
                                    } else
                                        this.uc++;
                                    if (n.K) {
                                        p = "";
                                        this.sc ? (p += "translate3d(" + this.m.width / 2 + "px," + this.m.height / 2 + "px,0px) ",
                                        p += " perspective(" + f + "px) ",
                                        p += "translate3d(0px,0px," + f + "px) ") : p += "translate3d(" + this.m.width / 2 + "px," + this.m.height / 2 + "px," + f + "px) ";
                                        p += "rotateZ(" + Number(this.N.c).toFixed(10) + "deg) ";
                                        p += "rotateX(" + Number(this.j.c).toFixed(10) + "deg) ";
                                        p += "rotateY(" + Number(-this.pan.c).toFixed(10) + "deg) ";
                                        this.Ca && (p += "rotateX(" + Number(-this.Ca.pitch).toFixed(10) + "deg) ",
                                        p += "rotateZ(" + Number(this.Ca.N).toFixed(10) + "deg) ");
                                        var p = 4 > d ? p + ("rotateY(" + -90 * d + "deg) ") : p + ("rotateX(" + (4 == d ? -90 : 90) + "deg) "), u;
                                        this.Xe ? (u = this.qf / this.h.G * (this.h.G / a.width) * (2 * g + 1),
                                        u = this.qd ? 2 / Math.tan(this.f.c * Math.PI / 360) * u : 2 * u,
                                        p += " scale(" + u * k * k + ")") : u = 1 / (k * k);
                                        p += " translate3d(" + (1 / k * c * this.h.G - this.h.Ka - a.width / 2) + "px,";
                                        p += 1 / k * b * this.h.G - this.h.Ka - a.width / 2 + "px,";
                                        p += -a.width * u / 2 + "px)";
                                        h.qc && (n.visible = !0,
                                        n.K ? n.K.style[this.Va] = p : n.h && (n.h.style[this.Va] = p))
                                    }
                                }
                        }
                    }
                    g--
                }
                for (f = 0; f < this.h.I.length; f++) {
                    var a = this.h.I[f], t;
                    for (t in a.V)
                        a.V.hasOwnProperty(t) && (n = a.V[t],
                        !n.visible && n.K && (a.cache ? (l = "translate3d(-10px,-10px,0px) scale(0.001,0.001)",
                        n.K ? n.K.style[this.Va] = l : n.h && (n.h.style[this.Va] = "")) : (n.Oa && n.Oa.clearRect(0, 0, n.Oa.canvas.width, n.Oa.canvas.height),
                        this.Hh.push(n.K),
                        n.K ? (l = "translate3d(-10px,-10px,0px) scale(0.001,0.001)",
                        n.K.style[this.Va] = l,
                        n.K.Hd = -1) : n.loaded && this.C.removeChild(n.h),
                        n.K = null,
                        n.h = null,
                        n.Oa = null,
                        delete a.V[t])))
                }
                this.Pc = !1
            }
        }
        ;
        b.prototype.wl = function() {
            var a = Math.round(this.hd());
            this.sc || this.vl(a);
            for (var d = 0; d < this.Xa.length; d++) {
                var c;
                c = this.Xa[d];
                c.Al(a);
                c.a.hidden = !1
            }
        }
        ;
        b.prototype.Bl = function() {
            for (var a = Math.round(this.hd()), d = 0; d < this.J.length; d++) {
                var c;
                c = this.J[d];
                c.$c || (c.Al(a),
                c.a.hidden = !1)
            }
        }
        ;
        b.prototype.hn = function() {
            for (var a = 0; a < this.Xa.length; a++) {
                var d;
                d = this.Xa[a];
                d.gl()
            }
            for (a = 0; a < this.J.length; a++)
                d = this.J[a],
                d.$c || d.gl()
        }
        ;
        b.prototype.Uo = function() {
            for (var a = 0; a < this.J.length; a++) {
                var d;
                d = this.J[a];
                d.$c || d.we()
            }
            for (a = 0; a < this.Xa.length; a++)
                d = this.Xa[a],
                d.we()
        }
        ;
        b.prototype.Bc = function(a) {
            this.de = !1;
            try {
                a ? this.$a = a : this.$a = document.createElement("canvas");
                var d = this.Ed.offsetWidth - this.margin.left - this.margin.right
                  , c = this.Ed.offsetHeight - this.margin.top - this.margin.bottom;
                if (100 > d || 100 > c)
                    c = d = 100;
                var b = window.devicePixelRatio || 1;
                this.Ye && (b = 1);
                this.C.style.width = d + "px";
                this.C.style.height = c + "px";
                this.$a.style.width = d + "px";
                this.$a.style.height = c + "px";
                this.$a.width = d * b;
                this.$a.height = c * b;
                this.$a.style.display = "none";
                this.$a.style.jp = "none";
                this.C.insertBefore(this.$a, this.C.firstChild);
                a = {
                    stencil: !0,
                    depth: !0
                };
                a.alpha = this.qd ? !0 : !1;
                this.Kd && 10 <= this.jk[0] && (a.antialias = !1,
                a.alpha = !1);
                this.H = this.$a.getContext("webgl", a);
                this.H || (this.H = this.$a.getContext("experimental-webgl", a));
                if (this.H) {
                    var f = this.H;
                    this.jb.width = d * b;
                    this.jb.height = c * b;
                    f.clearColor(0, 0, 0, 0);
                    f.enable(this.H.DEPTH_TEST);
                    f.viewport(0, 0, 500, 500);
                    f.clear(f.COLOR_BUFFER_BIT | f.DEPTH_BUFFER_BIT);
                    4096 <= f.getParameter(f.MAX_TEXTURE_SIZE) && !this.Mf && (this.je = 1 < b ? 4 * this.je : 2 * this.je);
                    this.L("Max tile cnt: " + this.je);
                    this.la.Kf();
                    this.la.Yg();
                    this.la.lk(this.cf);
                    this.la.mk();
                    this.B && (this.B.Kf(),
                    this.B.Bc());
                    this.Ba && (this.Ba.Kf(),
                    this.Ba.Bc())
                }
            } catch (l) {
                this.L(l)
            }
            this.H ? this.Z = !0 : alert("Could not initialise WebGL!")
        }
        ;
        b.prototype.Wb = function(a) {
            return a ? "{" == a.charAt(0) || "/" == a.charAt(0) || 0 < a.indexOf("://") || 0 == a.indexOf("javascript:") ? a : this.Cd + a : this.Cd
        }
        ;
        b.prototype.Qd = function(a, d, c) {
            var b = (new RegExp("%0*" + d,"i")).exec(a.toString());
            if (b) {
                var b = b.toString()
                  , f = c.toString();
                for (b.charAt(b.length - 1) != d && (f = (1 + c).toString()); f.length < b.length - 1; )
                    f = "0" + f;
                a = a.replace(b, f)
            }
            return a
        }
        ;
        b.prototype.se = function(a, d, c, b) {
            var f = this.h.Ei - 1 - d
              , l = this.h.Dk
              , h = "x";
            switch (a) {
            case 0:
                h = "f";
                break;
            case 1:
                h = "r";
                break;
            case 2:
                h = "b";
                break;
            case 3:
                h = "l";
                break;
            case 4:
                h = "u";
                break;
            case 5:
                h = "d"
            }
            for (var g = 0; 3 > g; g++)
                l = this.Qd(l, "c", a),
                l = this.Qd(l, "s", h),
                l = this.Qd(l, "r", d),
                l = this.Qd(l, "l", f),
                l = this.Qd(l, "x", c),
                l = this.Qd(l, "y", b),
                l = this.Qd(l, "v", b),
                l = this.Qd(l, "h", c);
            return this.Wb(l)
        }
        ;
        b.prototype.vi = function() {
            return this.pan.c
        }
        ;
        b.prototype.Qm = function() {
            return this.v.pan
        }
        ;
        b.prototype.Rm = function() {
            for (var a = this.pan.c; -180 > a; )
                a += 360;
            for (; 180 < a; )
                a -= 360;
            return a
        }
        ;
        b.prototype.Ug = function() {
            for (var a = this.pan.c - this.pan.Oi; -180 > a; )
                a += 360;
            for (; 180 < a; )
                a -= 360;
            return a
        }
        ;
        b.prototype.xh = function(a) {
            this.pa();
            isNaN(a) || (this.pan.c = Number(a));
            this.update()
        }
        ;
        b.prototype.aj = function(a) {
            this.pa();
            isNaN(a) || (this.pan.c = Number(a) + this.pan.Oi);
            this.update()
        }
        ;
        b.prototype.Eg = function(a, d) {
            isNaN(a) || (this.xh(this.vi() + a),
            d && (this.pan.d = a))
        }
        ;
        b.prototype.fm = function(a, d) {
            this.Eg(a * this.Gd(), d)
        }
        ;
        b.prototype.xi = function() {
            return this.j.c
        }
        ;
        b.prototype.Zm = function() {
            return this.v.j
        }
        ;
        b.prototype.yh = function(a) {
            this.pa();
            isNaN(a) || (this.j.c = Number(a));
            this.update()
        }
        ;
        b.prototype.Fg = function(a, d) {
            this.yh(this.xi() + a);
            d && (this.j.d = a)
        }
        ;
        b.prototype.hm = function(a, d) {
            this.Fg(a * this.Gd(), d)
        }
        ;
        b.prototype.co = function(a) {
            this.pa();
            isNaN(a) || (this.N.c = Number(a));
            this.update()
        }
        ;
        b.prototype.Ym = function() {
            return this.N.c
        }
        ;
        b.prototype.Bf = function() {
            return this.f.c
        }
        ;
        b.prototype.Cm = function() {
            return this.v.zd
        }
        ;
        b.prototype.dg = function(a) {
            this.pa();
            var d;
            switch (this.xa()) {
            case 4:
                d = 170;
                break;
            case 12:
                d = 360;
                break;
            case 9:
                d = 355;
                break;
            default:
                d = 170
            }
            2 == this.kb && (d = 9999999999);
            !isNaN(a) && 0 < a && a < d && (d = this.f.c,
            this.f.c = Number(a),
            d != this.f.c && this.update())
        }
        ;
        b.prototype.Aj = function(a, d) {
            this.dg(this.Bf() + a);
            d && (this.f.d = a)
        }
        ;
        b.prototype.rf = function(a, d) {
            if (!isNaN(a)) {
                var c;
                c = a / 90 * Math.cos(Math.min(this.f.c, 90) * Math.PI / 360);
                c = this.f.c * Math.exp(c);
                this.dg(c);
                d && (this.f.d = a)
            }
        }
        ;
        b.prototype.ao = function(a, d) {
            this.pa();
            isNaN(a) || (this.pan.c = a);
            isNaN(d) || (this.j.c = d);
            this.update()
        }
        ;
        b.prototype.hg = function(a, d, c) {
            this.pa();
            isNaN(a) || (this.pan.c = a);
            isNaN(d) || (this.j.c = d);
            isNaN(c) || this.dg(c);
            this.update()
        }
        ;
        b.prototype.Wn = function() {
            this.hg(this.pan.Pa, this.j.Pa, this.f.Pa)
        }
        ;
        b.prototype.Zn = function(a) {
            this.fg(a);
            this.gg(a);
            this.eg(a)
        }
        ;
        b.prototype.fg = function(a) {
            this.A.sb = a
        }
        ;
        b.prototype.eg = function(a) {
            this.A.Qe = a
        }
        ;
        b.prototype.gg = function(a) {
            this.A.Yc = a
        }
        ;
        b.prototype.moveTo = function(a, d, c, b, f, l) {
            this.pa();
            if ("_blank" !== a && "" !== a) {
                this.v.active = !0;
                this.v.xe = !1;
                this.v.oj = !1;
                var h = a.toString().split("/");
                1 < h.length && (a = Number(h[0]),
                b = Number(d),
                d = Number(h[1]),
                2 < h.length && (c = Number(h[2])));
                isNaN(a) ? this.v.pan = this.pan.c : this.v.pan = Number(a);
                isNaN(d) ? this.v.j = this.j.c : this.v.j = Number(d);
                !isNaN(c) && 0 < c && 180 > c ? this.v.f = Number(c) : this.v.f = this.f.c;
                this.v.speed = !isNaN(b) && 0 < b ? Number(b) : 1;
                isNaN(f) ? this.v.N = this.N.c : this.v.N = Number(f);
                void 0 !== l ? !a || 4 != l && 12 != l && 9 != l || (this.v.Bb = l) : this.v.Bb = this.Za
            }
        }
        ;
        b.prototype.kh = function(a) {
            this.pa();
            var d = 0
              , c = 0
              , b = 70
              , f = 4
              , l = 0
              , h = 1;
            a.hasOwnProperty("pan") && (d = Number(a.pan),
            this.v.pan = d);
            a.hasOwnProperty("tilt") && (c = Number(a.tilt),
            this.v.j = c);
            a.hasOwnProperty("fov") && (b = Number(a.fov),
            this.v.f = b);
            a.hasOwnProperty("projection") && (f = Number(a.projection),
            this.v.Bb = f);
            a.hasOwnProperty("timingFunction") && (l = Number(a.timingFunction));
            a.hasOwnProperty("speed") && (h = Number(a.speed));
            0 >= h ? (this.hg(d, c, b),
            this.ad(f)) : (a = new m.uk,
            a.Ta = "__AutoMove",
            a.lg = this.pan.c,
            a.ng = this.j.c,
            a.yd = this.f.c,
            a.mg = this.Za,
            a.Rd = d,
            a.Sd = c,
            a.bf = b,
            a.bd = f,
            a.He = !1,
            a.$d = !1,
            a.ae = !1,
            0 == l && (a.$d = !0),
            1 == l && (a.He = !0,
            a.$d = !0),
            2 == l && (a.ae = !0),
            a.speed = h,
            this.v.vj = this.D,
            this.D = this.Uj(a),
            this.v.wj = (new Date).getTime(),
            this.v.oj = !0,
            this.v.active = !0,
            this.v.xe = !1,
            this.v.pan = d,
            this.v.j = c,
            this.v.f = b,
            this.Bd = !1)
        }
        ;
        b.prototype.sn = function(a) {
            this.moveTo(this.pan.Pa, this.j.Pa, this.f.Pa, a)
        }
        ;
        b.prototype.tn = function(a, d) {
            var c = {};
            c.pan = this.pan.Pa;
            c.tilt = this.j.Pa;
            c.fov = this.f.Pa;
            c.projection = this.oh;
            c.timingFunction = d;
            c.speed = a;
            this.kh(c)
        }
        ;
        b.prototype.Wl = function(a, d, c, b) {
            var f = new m.dh(this);
            f.type = "point";
            f.pan = d;
            f.j = c;
            f.id = a;
            f.a = {};
            f.a.player = this;
            f.Ie();
            f.a.hotspot = f;
            f.a.__div = document.createElement("div");
            f.a.__div.appendChild(b);
            this.P.push(f);
            f.a.__div.style.position = "absolute";
            f.a.__div.style.left = "-1000px";
            f.a.__div.style.top = "-1000px";
            this.Aa.insertBefore(f.a.__div, this.Aa.firstChild);
            this.za = !0
        }
        ;
        b.prototype.Oo = function(a, b, c) {
            for (var e = 0; e < this.P.length; e++) {
                var f = this.P[e];
                f.id == a && (f.pan = b,
                f.j = c,
                f.Ie())
            }
            this.za = !0
        }
        ;
        b.prototype.Pn = function(a) {
            for (var b = -1, c, e = 0; e < this.P.length; e++)
                c = this.P[e],
                c.id == a && (b = e);
            -1 < b && (c = this.P.splice(b, 1).pop(),
            c.a && c.a.__div && this.Aa.removeChild(c.a.__div))
        }
        ;
        b.prototype.Tm = function() {
            for (var a = [], b = 0; b < this.P.length; b++) {
                var c = this.P[b];
                "point" == c.type && a.push(String(c.id))
            }
            return a
        }
        ;
        b.prototype.Em = function(a) {
            for (var b = 0; b < this.P.length; b++) {
                var c = this.P[b];
                if (c.id == a)
                    return b = {},
                    b.id = a,
                    b.pan = c.pan,
                    b.tilt = c.j,
                    c.a && c.a.__div && (b.div = c.a.__div),
                    b
            }
        }
        ;
        b.prototype.Fl = function(a, b) {
            this.Y.start.x = a;
            this.Y.start.y = b;
            this.Y.ca.x = a;
            this.Y.ca.y = b;
            this.ua.ca.x = a;
            this.ua.ca.y = b;
            this.Vi++;
            this.pan.gd = this.pan.c;
            this.j.gd = this.j.c
        }
        ;
        b.prototype.Dl = function(a, b) {
            var c = this.Jb();
            this.pan.gd += a * c / this.m.height;
            this.j.gd += b * c / this.m.height;
            this.pan.c = this.pan.gd;
            this.j.c = this.j.gd
        }
        ;
        b.prototype.El = function(a, b) {
            this.Y.c.x = a;
            this.Y.c.y = b;
            this.Y.ba.x = this.Y.c.x - this.Y.ca.x;
            this.Y.ba.y = this.Y.c.y - this.Y.ca.y;
            this.A.od && (this.Y.ca.x = this.Y.c.x,
            this.Y.ca.y = this.Y.c.y,
            this.update())
        }
        ;
        b.prototype.pa = function() {
            this.s.active && (this.s.active = !1,
            this.pan.d = 0,
            this.j.d = 0,
            this.f.d = 0);
            this.v.active && (this.v.active = !1,
            this.pan.d = 0,
            this.j.d = 0,
            this.f.d = 0);
            this.nf = this.v.xe = !1;
            this.s.Li = !1;
            this.fd = .02;
            this.lf = 0;
            this.s.ed && (this.s.ed = !1,
            this.s.enabled = this.s.yj);
            this.Oe = (new Date).getTime()
        }
        ;
        b.prototype.Jm = function() {
            return this.Oe
        }
        ;
        b.prototype.$j = function(a, b) {
            a || (a = this.qa.x,
            b = this.qa.y);
            var c = this.m.height / (2 * Math.tan(this.f.c * Math.PI / 360))
              , e = a - this.m.width / 2
              , f = b - this.m.height / 2
              , l = {};
            l.pan = 180 * Math.atan(e / c) / Math.PI;
            l.tilt = 180 * Math.atan(-f / Math.sqrt(e * e + c * c)) / Math.PI;
            return l
        }
        ;
        b.prototype.Vm = function(a, b) {
            var c, e;
            a || (a = this.qa.x,
            b = this.qa.y);
            if (2 === this.kb)
                e = this.f.c / this.m.height,
                c = -(a - this.m.width / 2) * e + this.pan.c,
                e = -(b - this.m.height / 2) * e + this.j.c;
            else {
                e = new m.ra(0,0,1);
                c = this.$j(a, b);
                e.pe(-c.tilt);
                e.cg(c.pan);
                e.pe(-this.j.c);
                e.cg(-this.pan.c);
                e.pe(-this.Ca.pitch);
                e.vh(this.Ca.N);
                for (c = e.Yl() - 180; -180 > c; )
                    c += 360;
                e = e.Zl()
            }
            var f = {};
            f.pan = c;
            f.tilt = e;
            return f
        }
        ;
        b.prototype.pd = function(a) {
            return a == this.control ? !0 : a && void 0 !== a.ggPermeable && 0 == a.ggPermeable ? !1 : a && a.ggType && ("container" == a.ggType || "cloner" == a.ggType || "timer" == a.ggType) ? !0 : !1
        }
        ;
        b.prototype.ai = function(a, b) {
            var c = this.hd(), e, f, l;
            for (e = 0; e < this.J.length + this.Xa.length; e++) {
                var h;
                h = e < this.J.length ? this.J[e] : this.Xa[e - this.J.length];
                if (h.yb)
                    return h
            }
            for (e = 0; e < this.J.length + this.Xa.length; e++)
                if (h = e < this.J.length ? this.J[e] : this.Xa[e - this.J.length],
                !h.$c) {
                    var g = [], k = new m.ra, n, r, p;
                    0 < h.f && (r = Math.tan(h.f / 2 * Math.PI / 180),
                    p = 0 < h.Ac ? r * h.Tc / h.Ac : r,
                    h.ld && 1 != h.ld && (p *= h.ld));
                    for (n = 0; 4 > n; n++) {
                        switch (n) {
                        case 0:
                            k.Ya(-r, -p, -1);
                            break;
                        case 1:
                            k.Ya(r, -p, -1);
                            break;
                        case 2:
                            k.Ya(r, p, -1);
                            break;
                        case 3:
                            k.Ya(-r, p, -1)
                        }
                        k.va(-h.j * Math.PI / 180);
                        k.Da(h.pan * Math.PI / 180);
                        k.Da(-this.pan.c * Math.PI / 180);
                        k.va(this.j.c * Math.PI / 180);
                        k.mb(this.N.c * Math.PI / 180);
                        g.push(k.clone())
                    }
                    g = this.ci(g);
                    if (0 < g.length) {
                        for (n = 0; n < g.length; n++)
                            k = g[n],
                            .1 > k.z ? (l = -c / k.z,
                            f = this.m.width / 2 + k.x * l,
                            l = this.m.height / 2 + k.y * l) : l = f = 0,
                            k.gc = f,
                            k.Cb = l;
                        if (this.ik(g, a, b))
                            return h
                    }
                }
            return null
        }
        ;
        b.prototype.ah = function() {
            return document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement && null != document.msFullscreenElement || document.fullScreen
        }
        ;
        b.prototype.rn = function(a) {
            this.xl(a);
            if (this.Qc)
                this.Qc.onclick();
            this.Dd = null;
            if (!this.A.sb) {
                a = a ? a : window.event;
                if ((a.which || 0 == a.which || 1 == a.which) && this.pd(a.target)) {
                    var b;
                    (b = this.ai(this.qa.x, this.qa.y)) && b.Uc && (this.Dd = b);
                    this.Fl(a.pageX, a.pageY);
                    this.X.ib = !0;
                    this.X.startTime = (new Date).getTime();
                    a.preventDefault();
                    this.pa()
                }
                this.Y.ba.x = 0;
                this.Y.ba.y = 0
            }
        }
        ;
        b.prototype.ff = function(a, b) {
            var c = this.w.jj;
            c.enabled && (this.ya != this.pb && 0 <= a && 0 <= b && "" != this.ya.title ? (this.ta.innerHTML = this.ya.title,
            this.ta.style.color = this.fa(c.kj, c.ij),
            c.background ? this.ta.style.backgroundColor = this.fa(c.Pb, c.Ob) : this.ta.style.backgroundColor = "transparent",
            this.ta.style.border = "solid " + this.fa(c.Sb, c.Rb) + " " + c.Xh + "px",
            this.ta.style.borderRadius = c.Wh + "px",
            this.ta.style.textAlign = "center",
            0 < c.width ? (this.ta.style.left = a - c.width / 2 + this.margin.left + "px",
            this.ta.style.width = c.width + "px") : (this.ta.style.width = "auto",
            this.ta.style.left = a - this.ta.offsetWidth / 2 + this.margin.left + "px"),
            this.ta.style.height = 0 < c.height ? c.height + "px" : "auto",
            this.ta.style.top = b + 25 + +this.margin.top + "px",
            this.ta.style.visibility = "inherit",
            this.ta.style.overflow = "hidden") : (this.ta.style.visibility = "hidden",
            this.ta.innerHTML = ""))
        }
        ;
        b.prototype.xl = function(a) {
            var b = this.fe();
            this.ah() ? (this.qa.x = a.pageX - this.margin.left,
            this.qa.y = a.pageY - this.margin.top) : (this.qa.x = a.pageX - b.x,
            this.qa.y = a.pageY - b.y);
            return b
        }
        ;
        b.prototype.$e = function(a) {
            a && null !== a && "object" == typeof a ? this.ya = a : this.ya = this.pb;
            this.ya.Ie && this.ya.Ie();
            this.hotspot = this.ya
        }
        ;
        b.prototype.qn = function(a) {
            a = a ? a : window.event;
            var b = this.xl(a);
            if (!this.A.sb) {
                this.s.active && (this.s.hh = (new Date).getTime());
                this.X.ib && (a.preventDefault(),
                (a.which || 0 == a.which || 1 == a.which) && this.El(a.pageX, a.pageY),
                this.pa());
                var c = !1;
                if (this.ya == this.pb || "poly" == this.ya.type) {
                    var e = this.pb;
                    0 < this.P.length && this.pd(a.target) && (e = this.bi(this.qa.x, this.qa.y));
                    this.wh(e);
                    this.ff(a.pageX - b.x, a.pageY - b.y);
                    0 != e && (c = !0)
                }
                a = null;
                c || (a = this.ai(this.qa.x, this.qa.y));
                this.s.Lg && (this.s.Lg = !1);
                this.Aa.style.cursor = this.ya != this.pb && this.ya.Me && c || a && a.Hf ? "pointer" : "default"
            }
        }
        ;
        b.prototype.wh = function(a) {
            !1 === a && (a = this.pb);
            this.ya != a && (this.ya != this.pb && (0 < this.w.mode && (this.ya.gb = 0),
            this.Qa && this.Qa.hotspotProxyOut && this.Qa.hotspotProxyOut(this.ya.id)),
            a != this.pb ? (this.$e(a),
            this.Qa && this.Qa.hotspotProxyOver && this.Qa.hotspotProxyOver(this.ya.id),
            0 < this.w.mode && (this.w.gb = 1,
            this.ya.gb = 1)) : (this.$e(this.pb),
            0 < this.w.mode && (this.w.gb = 0)),
            this.ha && this.ha.changeCurrentHotspot(this.ya.id))
        }
        ;
        b.prototype.pn = function(a) {
            a = a ? a : window.event;
            this.gh = -1;
            if (!this.A.sb && this.X.ib) {
                this.pa();
                a.preventDefault();
                this.X.ib = !1;
                a = (new Date).getTime();
                var b;
                b = Math.abs(this.Y.start.x - this.Y.ca.x) + Math.abs(this.Y.start.y - this.Y.ca.y);
                400 > a - this.X.startTime && 0 <= b && 20 > b && (this.Dd && this.Dd.Uc(),
                (b = this.bi(this.qa.x, this.qa.y)) && this.ul(b),
                b = Math.abs(this.Y.sd.x - this.Y.ca.x) + Math.abs(this.Y.sd.y - this.Y.ca.y),
                700 > a - this.Pf && 0 <= b && 20 > b ? (this.A.ii && this.Gh(),
                this.Pf = 0) : this.Pf = a,
                this.Y.sd.x = this.Y.ca.x,
                this.Y.sd.y = this.Y.ca.y)
            }
        }
        ;
        b.prototype.Fk = function(a) {
            if (!this.A.Yc && (a = a ? a : window.event,
            this.pd(a.target))) {
                var b = a.detail ? -1 * a.detail : a.wheelDelta / 40;
                this.A.nk && (b = -b);
                a.axis && (-1 == this.gh ? this.gh = a.axis : this.gh != a.axis && (b = 0));
                var c = 0 < b ? 1 : -1;
                a.wheelDeltaX && a.wheelDeltaY && Math.abs(a.wheelDeltaX) > Math.abs(a.wheelDeltaY) && (b = 0);
                0 != b && (this.rf(c * this.A.kl, !0),
                this.update());
                a.preventDefault();
                this.pa()
            }
        }
        ;
        b.prototype.Ko = function(a) {
            a || (a = window.event);
            var b = a.touches
              , c = this.fe();
            this.qa.x = b[0].pageX - c.x;
            this.qa.y = b[0].pageY - c.y;
            this.df = this.Dd = null;
            this.pi && (this.pi = !1,
            this.xm());
            if (!this.A.sb) {
                if (!this.X.ib && b[0]) {
                    this.X.startTime = (new Date).getTime();
                    this.X.start.x = b[0].pageX;
                    this.X.start.y = b[0].pageY;
                    this.X.ca.x = b[0].pageX;
                    this.X.ca.y = b[0].pageY;
                    this.jc = b[0].target;
                    if (this.pd(a.target)) {
                        var e;
                        (e = this.ai(this.qa.x, this.qa.y)) && e.Uc && (this.Dd = e);
                        if (e = this.bi(this.qa.x, this.qa.y))
                            this.L(e),
                            this.df = e,
                            this.wh(e),
                            e = this.Df(a),
                            this.ff(e.x - c.x, e.y - c.y);
                        this.Fl(b[0].pageX, b[0].pageY);
                        this.X.Nj = b[0].identifier;
                        this.X.ib = !0;
                        a.preventDefault();
                        this.pa()
                    }
                    if (this.jc) {
                        c = this.jc;
                        for (e = !1; c && c != this.control; ) {
                            if (c.onmouseover)
                                c.onmouseover();
                            c.onmousedown && !e && (c.onmousedown(),
                            e = !0);
                            c = c.parentNode
                        }
                        e && a.preventDefault()
                    }
                }
                1 < b.length && (this.X.ib = !1);
                !this.zi && 2 == b.length && b[0] && b[1] && (a = b[0].pageX - b[1].pageX,
                b = b[0].pageY - b[1].pageY,
                this.f.ml = Math.sqrt(a * a + b * b),
                this.f.Se = this.f.c);
                this.Y.ba.x = 0;
                this.Y.ba.y = 0
            }
        }
        ;
        b.prototype.xm = function() {
            this.Mh && this.o.a && (this.o.Xc || this.o.a.play(),
            this.o.a.muted = !1);
            if (this.Kd) {
                var a = this.Ha.createOscillator()
                  , b = this.Ha.createGain();
                a.frequency.value = 30;
                a.type = "sine";
                a.connect(b);
                b.connect(this.Ha.destination);
                b.gain.value = .01;
                a.start(0);
                setTimeout(function() {
                    a.stop()
                }, 1E4)
            }
            for (b = 0; b < this.S.length; b++) {
                var c = this.S[b];
                (!this.Cc(c.id) || c.ia) && 0 <= c.loop && c.autoplay && (c.ia && c.Ce(),
                this.ne(c.id, c.loop))
            }
            for (b = 0; b < this.J.length; b++)
                c = this.J[b],
                !this.Cc(c.id) && c.autoplay && this.Mh && this.ne(c.id, c.loop)
        }
        ;
        b.prototype.Jo = function(a) {
            a || (a = window.event);
            var b = a.touches
              , c = this.fe();
            this.qa.x = b[0].pageX - c.x;
            this.qa.y = b[0].pageY - c.y;
            if (!this.A.sb) {
                b[0] && (this.X.ca.x = b[0].pageX,
                this.X.ca.y = b[0].pageY);
                if (this.X.ib) {
                    a.preventDefault();
                    for (var e = 0; e < b.length; e++)
                        if (b[e].identifier == this.X.Nj) {
                            this.El(b[e].pageX, b[e].pageY);
                            break
                        }
                    this.df && (e = this.Df(a),
                    this.ff(e.x - c.x, e.y - c.y));
                    this.pa()
                }
                2 == b.length && b[0] && b[1] && (this.X.ib = !1,
                this.zi || (this.A.Yc || (c = b[0].pageX - b[1].pageX,
                b = b[0].pageY - b[1].pageY,
                this.f.Hj = Math.sqrt(c * c + b * b),
                this.ua.f.active = !0,
                this.ua.f.Vb = this.f.Se * Math.sqrt(this.f.ml / this.f.Hj),
                4 == this.xa() && this.ua.f.Vb > this.f.max && (this.ua.f.Vb = this.f.max),
                this.ua.f.Vb < this.f.min && (this.ua.f.Vb = this.f.min)),
                this.pa(),
                a.preventDefault()))
            }
        }
        ;
        b.prototype.Io = function(a) {
            var b, c = this.fe(), e = !1;
            if (!this.A.sb) {
                this.X.ib && this.pa();
                var f = (new Date).getTime(), l;
                b = Math.abs(this.X.start.x - this.X.ca.x) + Math.abs(this.X.start.y - this.X.ca.y);
                if (0 <= b && 20 > b) {
                    a.preventDefault();
                    e = !0;
                    this.pd(this.jc) && this.Dd && this.Dd.Uc();
                    if (this.jc)
                        for (b = this.jc,
                        l = !1; b && b != this.control; )
                            b.onclick && !l && (b.onclick(),
                            l = !0,
                            e = !1),
                            b = b.parentNode;
                    b = Math.abs(this.X.sd.x - this.X.ca.x) + Math.abs(this.X.sd.y - this.X.ca.y);
                    if (700 > f - this.Pf && 0 <= b && 20 > b) {
                        a.preventDefault();
                        if (this.pd(this.jc) && this.A.ii) {
                            var h = this;
                            setTimeout(function() {
                                h.Gh()
                            }, 1)
                        }
                        if (this.jc)
                            for (b = this.jc,
                            l = !1; b && b != this.control; )
                                b.ondblclick && !l && (b.ondblclick(),
                                l = !0,
                                e = !1),
                                b = b.parentNode;
                        this.Pf = 0
                    } else
                        this.Pf = f;
                    this.X.sd.x = this.X.ca.x;
                    this.X.sd.y = this.X.ca.y
                }
                if (this.jc)
                    for (a.preventDefault(),
                    b = this.jc,
                    l = !1; b && b != this.control; ) {
                        if (b.onmouseout)
                            b.onmouseout();
                        b.onmouseup && !l && (b.onmouseup(),
                        l = !0);
                        b = b.parentNode
                    }
                a = this.Df(a);
                this.ff(a.x - c.x, a.y - c.y);
                this.df && e && this.ul(this.df);
                this.jc = null;
                this.X.ib = !1;
                this.wh(this.pb);
                this.df = null
            }
        }
        ;
        b.prototype.Ho = function(a) {
            var b = this.fe();
            this.A.sb || (this.X.ib = !1);
            this.df = null;
            this.wh(this.pb);
            a = this.Df(a);
            this.ff(a.x - b.x, a.y - b.y)
        }
        ;
        b.prototype.kn = function() {
            return null != this.jc || this.X.ib
        }
        ;
        b.prototype.Gk = function(a) {
            !this.ke && window.MSGesture && (this.L("setup gesture"),
            this.ke = new MSGesture,
            this.ke.target = this.control);
            this.ke && this.ke.addPointer(a.pointerId)
        }
        ;
        b.prototype.Wj = function(a) {
            this.zi = !0;
            this.lh = 1;
            this.A.sb || this.A.Yc || (a.touches ? (this.jc = a.touches.target,
            this.pd(a.target) && (a.preventDefault(),
            this.f.Se = this.f.c,
            this.pa())) : (a.preventDefault(),
            this.f.Se = this.f.c,
            this.pa()))
        }
        ;
        b.prototype.zm = function(a) {
            this.A.sb || this.A.Yc || !this.pd(a.target) || (a.preventDefault(),
            this.ua.f.active = !0,
            this.ua.f.Vb = this.f.Se / Math.sqrt(a.scale),
            4 == this.xa() && this.ua.f.Vb > this.f.max && (this.ua.f.Vb = this.f.max),
            this.update(),
            this.pa())
        }
        ;
        b.prototype.un = function(a) {
            this.A.sb || this.A.Yc || (a.preventDefault(),
            1 != a.scale && (this.ua.f.active = !0,
            this.lh *= a.scale,
            this.ua.f.Vb = this.f.Se / Math.sqrt(this.lh),
            4 == this.xa() && this.ua.f.Vb > this.f.max && (this.ua.f.Vb = this.f.max),
            this.update(),
            this.pa()))
        }
        ;
        b.prototype.Vj = function(a) {
            this.A.sb || this.A.Yc || (this.ua.f.active = !1,
            a.preventDefault(),
            this.pa(),
            this.ke && this.ke.reset && this.ke.reset())
        }
        ;
        b.prototype.ln = function(a) {
            this.A.Qe || (this.isFullscreen && a.preventDefault(),
            this.he = a.keyCode,
            this.pa())
        }
        ;
        b.prototype.mn = function(a) {
            this.he && (this.he = 0,
            a.preventDefault(),
            this.pa())
        }
        ;
        b.prototype.zn = function() {
            this.he = 0
        }
        ;
        b.prototype.nh = function() {
            this.isFullscreen && (this.ah() || this.exitFullscreen(),
            this.ah() && (this.U.style.left = "0px",
            this.U.style.top = "0px"))
        }
        ;
        b.prototype.ul = function(a) {
            this.Qa && this.Qa.hotspotProxyClick && this.Qa.hotspotProxyClick(a.id);
            "" != a.url && (this.Pi(a.url, a.target),
            this.ff(-1, -1))
        }
        ;
        b.prototype.Gd = function() {
            return Math.min(1, 2 * Math.tan(Math.PI * Math.min(this.f.c, 90) / 360))
        }
        ;
        b.prototype.Nk = function() {
            var a = this;
            setTimeout(function() {
                a.Nk()
            }, 100);
            9 != a.rh || a.$g || window.requestAnimationFrame(function() {
                a.$f();
                a.Zc("restart recover timer")
            });
            10 < a.rh && 1 < a.Vi && (a.Zc("recover timer - disabling requestAnimationFrame"),
            a.$g = !0,
            a.$f());
            a.rh++
        }
        ;
        b.prototype.el = function(a) {
            var b = {
                ep: {
                    value: 0,
                    name: "pan"
                },
                fp: {
                    value: 1,
                    name: "tilt"
                },
                bp: {
                    value: 2,
                    name: "fov"
                }
            }, c = 0, e = 0, f = 0, l;
            for (l in b) {
                var h = b[l], g;
                for (g = Math.floor(a); !this.Ke(g, h.value) && 0 < g; )
                    g--;
                var k = this.Ke(g, h.value)
                  , n = this.Mm(k);
                if (n) {
                    g = new m.kc(k.time,k.value);
                    var r = new m.kc(n.time,n.value)
                      , p = (a - k.time) / (n.time - k.time);
                    if (0 != k.type || 0 != n.type && 3 != n.type)
                        if (3 == k.type)
                            g = k.value;
                        else {
                            var p = new m.kc
                              , u = new m.kc
                              , t = n.time - k.time;
                            0 == k.type ? u.Ya(k.time + .3 * t, k.value) : u.Ya(k.Xd, k.Yd);
                            0 == n.type || 3 == n.type ? p.Ya(n.time - .3 * t, n.value) : p.Ya(n.Wd, n.Jc);
                            k = new m.kc;
                            k.Vh(g, r, u, p, a);
                            g = k.y
                        }
                    else
                        k = new m.kc,
                        k.nd(g, r, p),
                        g = k.y
                } else
                    g = k.value;
                switch (h.value) {
                case 0:
                    h = this.pan.c;
                    if (this.Bd) {
                        if (2 != this.kb) {
                            for (; 360 < g; )
                                g -= 360;
                            for (; -360 > g; )
                                g += 360
                        }
                        c = g - h;
                        2 != this.kb && (180 < c && (c -= 360),
                        -180 > c && (c += 360));
                        this.pan.c = this.pan.c + c * this.fd
                    } else
                        this.pan.c = g;
                    break;
                case 1:
                    h = this.j.c;
                    this.Bd ? (e = g - h,
                    this.j.c = this.j.c + e * this.fd) : this.j.c = g;
                    break;
                case 2:
                    h = this.f.c,
                    this.Bd ? (f = g - h,
                    this.f.c = this.f.c + f * this.fd) : this.f.c = g
                }
            }
            b = this.xa();
            for (l = Math.floor(a); !this.Ke(l, 3) && 0 < l; )
                l--;
            l = this.Ke(l, 3);
            h = a - l.time;
            this.Bd && -1 != this.mf && this.Cg + this.Sh > a ? (b = this.Cf(this.mf),
            this.f.c > b ? this.Cg = a : (a = (a - this.Cg) / this.Sh,
            a = Math.min(1, a),
            this.ad(this.Za, this.mf, 1 - a))) : 0 == l.nb || h > l.nb - .3 ? this.ad(l.value) : (a = h / l.nb,
            this.ad(b, l.value, 1 - a));
            this.Bd && (c = Math.sqrt(c * c + e * e + f * f),
            .3 > c && (this.Bd = !1,
            this.fd = .02,
            this.lf = 0),
            0 < this.lf && c > this.lf && (this.fd += .01,
            this.fd = Math.min(this.fd, 1)),
            this.lf = c);
            this.update()
        }
        ;
        b.prototype.Fn = function(a) {
            var b, c = this.v.speed;
            this.v.Di && (c = c * (a.getTime() - this.v.Di) / 60,
            5 < c && (c = 5),
            .2 > c && (c = .2));
            this.v.Di = a.getTime();
            this.s.Rg && (this.la.ready() || 4 == this.Za) && this.Tg() && (this.s.Rg = !1,
            this.s.active = !0,
            this.qb.wd = !0,
            this.qb.oi = !1);
            if (this.v.active || 0 != this.v.Bb && this.la.ready()) {
                if (this.v.oj && "__AutoMove" == this.D.Ta)
                    if (b = a.getTime() - this.v.wj,
                    c = b / 100,
                    c >= this.D.length) {
                        if (this.Ia.splice(this.Ia.indexOf(this.D), 1),
                        this.v.active = !1,
                        this.D = this.v.vj,
                        this.v.Bb = 0,
                        b = this.s.ed,
                        this.hg(this.v.pan, this.v.j, this.v.f),
                        this.v.Mi && (this.v.Mi = !1,
                        this.s.Li = !0,
                        this.s.active = !0,
                        this.s.ed = b),
                        this.onMoveComplete)
                            this.onMoveComplete()
                    } else
                        this.el(c);
                else {
                    this.pan.d = this.v.pan - this.pan.c;
                    if (360 == this.pan.max - this.pan.min) {
                        for (; -180 > this.pan.d; )
                            this.pan.d += 360;
                        for (; 180 < this.pan.d; )
                            this.pan.d -= 360
                    }
                    this.j.d = this.v.j - this.j.c;
                    this.N.d = this.v.N - this.N.c;
                    this.f.d = this.v.f - this.f.c;
                    b = c * this.Gd();
                    var e = Math.sqrt(this.pan.d * this.pan.d + this.j.d * this.j.d + this.N.d * this.N.d + this.f.d * this.f.d)
                      , f = this.pan.c - this.v.yk
                      , g = this.j.c - this.v.Ak
                      , h = this.N.c - this.v.zk
                      , k = this.f.c - this.v.xk;
                    100 * Math.sqrt(f * f + g * g + h * h + k * k) < b && 0 == this.v.Bb && (this.v.xe = !0);
                    this.v.yk = this.pan.c;
                    this.v.Ak = this.j.c;
                    this.v.zk = this.N.c;
                    this.v.xk = this.f.c;
                    if (100 * e < b || this.v.xe) {
                        if (this.pan.d = 0,
                        this.j.d = 0,
                        this.N.d = 0,
                        this.f.d = 0,
                        this.v.active && (this.v.active = !1,
                        this.pan.c = this.v.pan,
                        this.j.c = this.v.j,
                        this.N.c = this.v.N,
                        this.f.c = this.v.f,
                        this.onMoveComplete))
                            this.onMoveComplete()
                    } else
                        e = e > 5 * b ? b / e : .2,
                        this.pan.d *= e,
                        this.j.d *= e,
                        this.f.d *= e;
                    this.pan.c += this.pan.d;
                    this.j.c += this.j.d;
                    this.N.c += this.N.d;
                    this.f.c += this.f.d;
                    0 != this.v.Bb && (this.v.Bb != this.Za ? (c = this.Cf(this.v.Bb),
                    this.Bf() > c ? (this.f.c += -Math.max((2.5 - 1.7 * Math.min(Math.sqrt(this.pan.d * this.pan.d + this.j.d * this.j.d + this.N.d * this.N.d) / b, 1)) * b, this.f.d) - this.f.d,
                    this.v.f = this.f.c) : (this.fc = this.Za,
                    this.Za = this.v.Bb,
                    this.L("New projection from Target:" + this.Za),
                    this.Zf = this.v.bg = 0,
                    this.la.Yg())) : 1 > this.v.bg ? (this.v.bg = Math.min(1, this.v.bg + .05 * c),
                    this.Zf = this.v.bg) : (this.fc = 0,
                    this.v.Bb = 0,
                    this.la.Yg()))
                }
                this.Oe = a.getTime();
                this.update()
            } else if (this.s.active) {
                b = a.getTime() - this.s.startTime;
                this.s.hh < this.s.startTime && (this.s.hh = this.s.startTime);
                if ((this.s.pj || this.s.ed || this.qb.wd) && 0 < this.Ia.length) {
                    c = b / 100;
                    e = !1;
                    if (this.zb != this.D.Ta) {
                        for (b = 0; b < this.Ia.length; b++)
                            if ("" == this.zb || "" != this.zb && this.Ia[b].Ta == this.zb) {
                                e = !0;
                                this.D = this.Ia[b];
                                this.zb = this.D.Ta;
                                break
                            }
                        !e && 0 < this.Ia.length && (e = !0,
                        this.D = this.Ia[0],
                        this.zb = this.D.Ta)
                    } else
                        e = !0;
                    if (e)
                        if (b = (f = this.o.a && this.o.Xc) && this.s.hj && !this.qb.wd,
                        this.nf) {
                            e = c;
                            if (b)
                                for (this.o.a.currentTime < this.xj && this.Uh && (this.Th++,
                                this.Uh = !1),
                                e = 10 * (this.Th * this.o.a.duration + this.o.a.currentTime),
                                this.xj = this.o.a.currentTime,
                                .05 > this.o.a.duration - this.o.a.currentTime && (this.Uh = !0); e >= 10 * this.ye; )
                                    e -= 10 * this.ye;
                            if (!f && c >= this.D.length || f && !b && c >= this.D.length || f && b && this.D.Ta != this.D.Ik && c >= this.D.length) {
                                this.nf = !1;
                                if (this.qb.wd) {
                                    this.qb.wd = !1;
                                    this.qb.oi = !0;
                                    this.s.active = this.B.Vd;
                                    this.Ia.splice(this.Ia.indexOf(this.D), 1);
                                    0 < this.Ia.length && (this.D = this.Ia[0]);
                                    this.zb = "";
                                    this.fg(this.B.jh);
                                    this.gg(this.B.Oh);
                                    this.eg(this.B.eh);
                                    this.B.Vd = !1;
                                    this.Oe = a.getTime();
                                    return
                                }
                                this.zb = this.D.Ik;
                                if (this.zb == this.D.Ta) {
                                    if (1 < this.La.length && 0 < this.s.mh) {
                                        if (this.s.Ni) {
                                            b = 1E3;
                                            do
                                                c = this.La[Math.floor(Math.random() * this.La.length)];
                                            while (b-- && c == this.Ub)
                                        } else
                                            c = this.Zj();
                                        this.le("{" + c + "}");
                                        this.s.startTime = a.getTime();
                                        this.nf = !1;
                                        this.s.active = !0;
                                        this.B.Vd = !0
                                    }
                                } else
                                    this.Of && this.D.Hk != this.Ub && (this.le("{" + this.D.Hk + "}"),
                                    this.B.enabled ? (this.s.active = !1,
                                    this.B.Vd = !0) : this.s.active = !0),
                                    this.s.startTime = a.getTime()
                            } else
                                this.el(e)
                        } else if (c = this.D.ja[0],
                        e = this.D.ja[1],
                        f = this.D.ja[2],
                        g = this.D.ja[3],
                        3 != g.vb && (g = 0),
                        this.s.Li || this.v.xe || this.qb.wd || b) {
                            if (this.nf = !0,
                            this.s.startTime = a.getTime(),
                            this.Bd = b) {
                                for (this.ye = this.Th = 0; this.ye < this.D.length / 10; )
                                    this.ye += this.o.a.duration;
                                e = 10 * this.o.a.currentTime;
                                for (b = Math.floor(e); !this.Ke(b, 3) && 0 < b; )
                                    b--;
                                b = this.Ke(b, 3);
                                b.value == this.Za ? this.mf = -1 : (this.mf = b.value,
                                this.Cg = e,
                                this.Sh = Math.max(5, b.time + b.nb - e))
                            }
                        } else {
                            b = this.s.ed;
                            h = {};
                            for (h.pan = c.value; 360 < h.pan; )
                                h.pan -= 360;
                            for (; -360 > h.pan; )
                                h.pan += 360;
                            h.tilt = e.value;
                            h.fov = f.value;
                            h.projection = g ? g.value : 4;
                            h.timingFunction = 3;
                            h.speed = 1;
                            this.v.Mi = !0;
                            this.kh(h);
                            this.s.active = !0;
                            this.s.ed = b
                        }
                } else if (0 < this.s.mh && this.Of && b >= 1E3 * this.s.mh) {
                    if (1 < this.La.length) {
                        if (this.s.Ni) {
                            b = 1E3;
                            do
                                c = this.La[Math.floor(Math.random() * this.La.length)];
                            while (b-- && c == this.Ub)
                        } else
                            b = this.La.indexOf(this.Ub),
                            b++,
                            b >= this.La.length && (b = 0),
                            c = this.La[b];
                        this.s.startTime = a.getTime();
                        this.s.rd = a.getTime();
                        this.s.timeout = 0;
                        this.le("{" + c + "}");
                        this.s.active = !0;
                        this.B.Vd = !0
                    }
                } else
                    b = a.getTime(),
                    e = c = 1E3 / 60,
                    0 != this.s.rd && (e = b - this.s.rd),
                    this.j.d = this.s.Eh * (0 - this.j.c) / 100,
                    this.f.d = this.s.Eh * (this.f.Pa - this.f.c) / 100,
                    this.pan.d = .95 * this.pan.d + -this.s.speed * this.Gd() * .05,
                    c = e / c,
                    this.pan.c += this.pan.d * c,
                    this.j.c += this.j.d * c,
                    this.f.c += this.f.d * c,
                    this.s.rd = b,
                    this.update();
                3E3 < a.getTime() - this.s.hh && !this.s.Lg && (this.Aa.style.cursor = "none",
                this.s.Lg = !0)
            } else
                !this.qb.oi && 1E3 < a.getTime() - this.Oe && (this.Ia.splice(this.Ia.indexOf(this.D), 1),
                this.D = this.Af(!1),
                this.zb = this.D.Ta,
                this.s.active = !1,
                this.s.Rg = !0),
                this.s.enabled && !this.X.ib && a.getTime() - this.Oe > 1E3 * this.s.timeout && (this.s.pg && this.Tg() || !this.s.pg) && (this.s.active = !0,
                this.s.startTime = a.getTime(),
                this.s.rd = 0,
                this.pan.d = 0,
                this.j.d = 0,
                this.f.d = 0),
                !this.ua.enabled || 0 != this.he || this.X.ib || 0 == this.pan.d && 0 == this.j.d && 0 == this.f.d || (this.pan.d *= .9,
                this.j.d *= .9,
                this.f.d *= .9,
                this.pan.c += this.pan.d,
                this.j.c += this.j.d,
                this.rf(this.f.d),
                1E-4 > this.pan.d * this.pan.d + this.j.d * this.j.d + this.f.d * this.f.d && (this.pan.d = 0,
                this.j.d = 0,
                this.f.d = 0),
                this.update())
        }
        ;
        b.prototype.Hn = function(a) {
            var b = this.B;
            if (b.Ad) {
                var c = a.getTime() - b.Jl
                  , c = c / (1E3 * b.Il);
                if (1 <= c) {
                    b.Ad = !1;
                    for (c = 0; c < this.Ea.sg.length; c++)
                        this.Ea.mi(this.Ea.sg[c]);
                    b.ej = a.getTime();
                    this.ol();
                    b.ue = !0;
                    0 == b.Nb || b.kf || (4 == b.Nb ? (this.D = this.Af(!0, b.qe, b.re, b.zd),
                    this.zb = this.D.Ta,
                    this.s.active = !0,
                    this.qb.wd = !0) : this.moveTo(b.qe, b.re, b.zd, b.Td, 0, b.bd))
                } else
                    b.Mk(c)
            } else
                b.ue && (c = a.getTime() - b.ej,
                c /= 1E3 * b.Dg,
                1 <= c ? (b.ue = !1,
                this.Oe = a.getTime(),
                this.update(),
                0 != b.Nb && b.kf && (4 == b.Nb ? (this.D = this.Af(!0, b.qe, b.re, b.zd),
                this.zb = this.D.Ta,
                this.s.active = !0,
                this.qb.wd = !0) : this.moveTo(b.qe, b.re, b.zd, b.Td, 0, b.bd)),
                4 != b.Nb && (this.fg(b.jh),
                this.gg(b.Oh),
                this.eg(b.eh),
                this.s.active = b.Vd,
                b.Vd = !1),
                this.s.rd = 0,
                this.ga && this.di(),
                this.Gg = !1) : b.Mk(c));
            b = this.An;
            b.am && (b.Ng ? a.getTime() - b.ki >= 1E3 * b.sm && (b.Ng = !1) : (b.current += b.Kc,
            0 > b.current && (b.current = 0,
            b.Kc = -b.Kc,
            b.Ng = !0,
            b.ki = a.getTime()),
            1 < b.current && (b.current = 1,
            b.Kc = -b.Kc,
            b.Ng = !0,
            b.ki = a.getTime())))
        }
        ;
        b.prototype.Ln = function() {
            var a, b = this.w;
            if (0 < b.fb.length) {
                for (a = 0; a < b.fb.length; a++)
                    b.Fc[a] != b.Eb[a] && (b.Fc[a] > b.Eb[a] ? (b.Eb[a] += .05,
                    b.Fc[a] < b.Eb[a] && (b.Eb[a] = b.Fc[a])) : (b.Eb[a] -= .05,
                    b.Fc[a] > b.Eb[a] && (b.Eb[a] = b.Fc[a],
                    -1 != b.zh.indexOf(b.fb[a]) && (b.zh.splice(b.zh.indexOf(b.fb[a]), 1),
                    b.fb.splice(a, 1),
                    b.Fc.splice(a, 1),
                    b.Eb.splice(a, 1)))));
                this.update()
            }
            if (2 == b.mode)
                for (a = 0; a < this.P.length; a++) {
                    var c = this.P[a];
                    "poly" == c.type && c.gb != c.na && (c.gb > c.na ? (c.na += b.Kc,
                    c.gb < c.na && (c.na = c.gb)) : (c.na -= b.Kc,
                    c.gb > c.na && (c.na = c.gb)),
                    this.update())
                }
            3 == b.mode && b.gb != b.na && (b.gb > b.na ? (b.na += b.Kc,
            b.gb < b.na && (b.na = b.gb)) : (b.na -= b.Kc,
            b.gb > b.na && (b.na = b.gb)),
            this.update())
        }
        ;
        b.prototype.Kn = function() {
            var a = this.ua;
            this.X.ib && (this.A.od ? (a.ba.x = .4 * (this.Y.ca.x - a.ca.x),
            a.ba.y = .4 * (this.Y.ca.y - a.ca.y),
            a.ca.x += a.ba.x,
            a.ca.y += a.ba.y) : (a.ba.x = .1 * -this.Y.ba.x * this.A.sensitivity / 8,
            a.ba.y = .1 * -this.Y.ba.y * this.A.sensitivity / 8),
            this.Dl(a.ba.x, a.ba.y),
            this.update());
            a.f.active && (this.Aj(.4 * (a.f.Vb - this.f.c)),
            .001 > Math.abs(a.f.Vb - this.f.c) / this.f.c && (a.f.active = !1),
            this.update());
            if (a.enabled && (0 != a.ba.x || 0 != a.ba.y) && !this.X.ib) {
                var b = .9 * (1 - a.Zi);
                a.ba.x = b * a.ba.x;
                a.ba.y = b * a.ba.y;
                .01 > a.ba.x * a.ba.x + a.ba.y * a.ba.y ? (a.ba.x = 0,
                a.ba.y = 0) : (this.Dl(a.ba.x, a.ba.y),
                this.update())
            }
        }
        ;
        b.prototype.Gn = function() {
            if (this.A.$k && this.A.od) {
                var a = new k;
                a.pan = this.pan.c;
                a.j = this.j.c;
                a.f = this.f.c;
                this.Ee(a);
                this.Ee(a);
                this.Ee(a);
                var b = a.pan - this.pan.c
                  , c = a.j - this.j.c
                  , a = a.f - this.f.c;
                if (0 != b || 0 != c || 0 != a) {
                    var e;
                    e = .2 + .9 * Math.min((Math.abs(b) + Math.abs(c) + Math.abs(a)) / Math.abs(Math.min(this.f.c, 100)) * .3, 1);
                    this.pan.c += b * e;
                    this.j.c += c * e;
                    this.f.c += a * e;
                    this.ua.Zi = .3;
                    this.update()
                } else
                    this.ua.Zi = 0
            } else
                this.Hg();
            if (2 != this.kb) {
                for (; 360 < this.pan.c; )
                    this.pan.c -= 360;
                for (; -360 > this.pan.c; )
                    this.pan.c += 360
            }
        }
        ;
        b.prototype.In = function() {
            if (0 != this.he) {
                var a = this.A.sensitivity / 8;
                switch (this.he) {
                case 37:
                case 65:
                    this.Eg(a * this.Gd(), !0);
                    break;
                case 38:
                case 87:
                    this.Fg(a * this.Gd(), !0);
                    break;
                case 39:
                case 68:
                    this.Eg(-a * this.Gd(), !0);
                    break;
                case 40:
                case 83:
                    this.Fg(-a * this.Gd(), !0);
                    break;
                case 43:
                case 107:
                case 16:
                case 81:
                    this.A.Hi || this.rf(-a, !0);
                    break;
                case 17:
                case 18:
                case 109:
                case 45:
                case 91:
                case 69:
                    this.A.Hi || this.rf(a, !0)
                }
                this.update()
            }
        }
        ;
        b.prototype.Jn = function() {
            if (!this.Tg() && this.If && 5 < this.h.Xk) {
                var a, b = 0, c = this.Gb.length;
                if (this.vg)
                    c = 50,
                    this.li < c && this.li++,
                    b = this.li;
                else
                    for (a = 0; a < c; a++)
                        (this.Gb[a].complete && this.Gb[a].src != this.Lj || "" == this.Gb[a].src) && b++;
                b == c ? (this.ph = 1,
                this.isLoaded = !0,
                this.O && this.O.ggLoaded && this.O.ggLoaded(),
                this.s.pg && this.s.enabled && !this.v.active && !this.B.Ad && (this.s.active = !0,
                this.s.startTime = (new Date).getTime(),
                this.s.rd = 0)) : this.ph = b / (1 * c)
            }
        }
        ;
        b.prototype.$f = function() {
            var a = this;
            a.uh || (a.$g ? setTimeout(function() {
                a.uh = !1;
                a.$f()
            }, 1E3 / 60) : window.requestAnimationFrame(function() {
                a.uh = !1;
                a.$f()
            }));
            a.uh = !0;
            this.Vi = this.rh = 0;
            var b = new Date;
            this.Sg++;
            120 <= this.Sg && (this.L("F/s: " + Math.round(1E3 * this.Sg / (b.getTime() - this.vk))),
            this.vk = b.getTime(),
            this.Sg = 0);
            this.Z && this.la.rm();
            this.wb && "" !== this.ee && !this.ha && document.hasOwnProperty(this.ee) && document[this.ee].setPan && 0 == this.wm-- && (this.ha = document[this.ee],
            this.Gc = this.Z = !1,
            this.sa && (this.sa.style.visibility = "hidden"),
            this.ha.setLocked(!0),
            this.ha.setSlaveMode(!0),
            this.ha.readConfigString(this.gi),
            this.Zc("Flash player '" + this.ee + "' connected."));
            this.nj && (this.dd(),
            this.nj = !1);
            this.Kn();
            this.In();
            this.Jn();
            this.Fn(b);
            this.Gn();
            this.Hn(b);
            this.la.Ro();
            (0 <= this.w.mode || 0 < this.w.fb.length) && this.Ln();
            this.Kh();
            this.za && (0 < this.vf ? this.vf-- : (this.za = !1,
            this.vf = 0),
            this.B.ue || this.B.Ad || this.ug())
        }
        ;
        b.prototype.Cf = function(a) {
            switch (a) {
            case 4:
                a = Math.min(110, this.f.max);
                break;
            case 12:
                a = Math.min(270, this.f.Ji);
                a = Math.min(360 * this.Ud(), a);
                a = Math.min(360 / this.Ud(), a);
                break;
            case 9:
                a = Math.min(270, this.f.Ki);
                break;
            default:
                a = 90
            }
            return a
        }
        ;
        b.prototype.zl = function() {
            var a = this;
            setTimeout(function() {
                a.af(!1)
            }, 10);
            setTimeout(function() {
                a.af(!1)
            }, 100)
        }
        ;
        b.prototype.Kh = function() {
            this.fi.Oj(this.pan.c, this.j.c);
            for (var a = 0; a < this.S.length + this.J.length; a++) {
                var b;
                if (a < this.S.length)
                    b = this.S[a];
                else if (b = this.J[a - this.S.length],
                b.$c)
                    continue;
                b.Kh()
            }
        }
        ;
        b.prototype.Ij = function(a) {
            var b = "", c, e, f, g, h, k = 0;
            a = a.replace(/[^A-Za-z0-9\+\/\=]/g, "");
            do
                c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(k++)),
                e = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(k++)),
                g = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(k++)),
                h = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(k++)),
                c = c << 2 | e >> 4,
                e = (e & 15) << 4 | g >> 2,
                f = (g & 3) << 6 | h,
                b += String.fromCharCode(c),
                64 != g && (b += String.fromCharCode(e)),
                64 != h && (b += String.fromCharCode(f));
            while (k < a.length);return b
        }
        ;
        b.prototype.so = function(a, b) {
            var c, e, f = this;
            if (0 != f.Wf.length || !f.A.Jf || f.A.uf || f.A.Ig)
                if (f.Qc)
                    f.Qc = null,
                    f.U.removeChild(f.Qc);
                else {
                    f.Qc = document.createElement("div");
                    var g = f.Qc;
                    c = "left: " + a + "px;" + ("top:\t " + b + "px;") + "z-index: 32000;";
                    c += "position:relative;";
                    c += "display: table;";
                    c += "background-color: white;";
                    c += "border: 1px solid lightgray;";
                    c += "box-shadow: 1px 1px 3px #333;";
                    c += "font-family: Verdana, Arial, Helvetica, sans-serif;";
                    c += "font-size: 9pt;";
                    c += "opacity : 0.95;";
                    g.setAttribute("style", c);
                    g.setAttribute("class", "gg_contextmenu");
                    c = document.createElement("style");
                    e = document.createTextNode(".gg_context_row:hover { background-color: #3399FF }");
                    c.type = "text/css";
                    c.styleSheet ? c.styleSheet.cssText = e.nodeValue : c.appendChild(e);
                    g.appendChild(c);
                    for (e = 0; e < f.Wf.length; e++) {
                        var h = f.Wf[e]
                          , k = document.createElement("div");
                        c = "text-align: left;";
                        c += "margin: 0;";
                        c += "padding: 5px 20px;";
                        c += "vertical-align: left;";
                        k.setAttribute("style", c);
                        k.setAttribute("class", "gg_context_row");
                        c = document.createElement("a");
                        c.href = h.url;
                        c.target = "_blank";
                        c.innerHTML = h.text;
                        c.setAttribute("style", "color: black; text-decoration: none;");
                        k.appendChild(c);
                        g.appendChild(k)
                    }
                    0 < f.Wf.length && (!f.A.Jf || f.A.uf || f.A.Ig) && g.appendChild(document.createElement("hr"));
                    if (f.A.Ig && f.Z) {
                        h = [];
                        h.push({
                            text: "Rectilinear Projection",
                            ag: 4
                        });
                        h.push({
                            text: "Stereographic Projection",
                            ag: 9
                        });
                        h.push({
                            text: "Fisheye Projection",
                            ag: 12
                        });
                        for (e = 0; e < h.length; e++) {
                            var k = h[e]
                              , m = document.createElement("div");
                            m.setAttribute("class", "gg_context_row");
                            c = "text-align: left;";
                            c += "margin: 0;";
                            c = f.Za == k.ag ? c + "padding: 5px 20px 5px 7px;" : c + "padding: 5px 20px;";
                            c += "vertical-align: left;";
                            c += "cursor: pointer;";
                            m.setAttribute("style", c);
                            m.onclick = function(a) {
                                return function() {
                                    f.$h(a, 1);
                                    f.update()
                                }
                            }(k.ag);
                            f.Za == k.ag ? m.innerHTML = "&#10687; " + k.text : m.innerHTML = k.text;
                            g.appendChild(m)
                        }
                        f.A.Jf && !f.A.uf || g.appendChild(document.createElement("hr"))
                    }
                    f.A.uf && (e = document.createElement("div"),
                    e.setAttribute("class", "gg_context_row"),
                    c = "text-align: left;margin: 0;padding: 5px 20px;",
                    c += "vertical-align: left;",
                    c += "cursor: pointer;",
                    e.setAttribute("style", c),
                    e.onclick = function() {
                        f.Gh()
                    }
                    ,
                    e.innerHTML = f.ah() ? "Exit Fullscreen" : "Enter Fullscreen",
                    g.appendChild(e));
                    c = "<<L>>" + String(f.Ja);
                    c = c.toUpperCase();
                    f.A.Jf && "U" == c.charAt(2) || (e = document.createElement("div"),
                    c = "text-align: left;margin: 0;padding: 5px 20px;",
                    c += "vertical-align: left;",
                    e.setAttribute("style", c),
                    e.setAttribute("class", "gg_context_row"),
                    c = document.createElement("a"),
                    c.href = f.Ij("aHR0cDovL3Bhbm8ydnIuY29tLw=="),
                    c.target = "_blank",
                    c.innerHTML = f.Ij("Q3JlYXRlZCB3aXRoIFBhbm8yVlI="),
                    c.setAttribute("style", "color: black; text-decoration: none;"),
                    e.appendChild(c),
                    g.appendChild(e));
                    f.U.insertBefore(f.Qc, f.U.firstChild);
                    g.onclick = function() {
                        f.Qc && (f.U.removeChild(f.Qc),
                        f.Qc = null)
                    }
                    ;
                    g.oncontextmenu = g.onclick
                }
        }
        ;
        b.prototype.$l = function() {
            var a = this, b;
            b = a.Aa;
            a.control = b;
            a.control = b;
            a.zl();
            setTimeout(function() {
                a.$f()
            }, 10);
            setTimeout(function() {
                a.Nk()
            }, 200);
            setTimeout(function() {
                a.we();
                a.ug()
            }, 10);
            b.addEventListener && (b.addEventListener("touchstart", function(b) {
                a.Ko(b)
            }, !1),
            b.addEventListener("touchmove", function(b) {
                a.Jo(b)
            }, !1),
            b.addEventListener("touchend", function(b) {
                a.Io(b)
            }, !1),
            b.addEventListener("touchcancel", function(b) {
                a.Ho(b)
            }, !1),
            b.addEventListener("pointerdown", function(b) {
                a.Gk(b)
            }, !1),
            b.addEventListener("MSPointerDown", function(b) {
                a.Gk(b)
            }, !1),
            b.addEventListener("MSGestureStart", function(b) {
                a.Wj(b)
            }, !1),
            b.addEventListener("MSGestureEnd", function(b) {
                a.Vj(b)
            }, !1),
            b.addEventListener("MSGestureChange", function(b) {
                a.un(b)
            }, !1),
            b.addEventListener("gesturestart", function(b) {
                a.Wj(b)
            }, !1),
            b.addEventListener("gesturechange", function(b) {
                a.zm(b)
            }, !1),
            b.addEventListener("gestureend", function(b) {
                a.Vj(b)
            }, !1),
            b.addEventListener("mousedown", function(b) {
                a.rn(b)
            }, !1),
            b.addEventListener("mousemove", function(b) {
                a.qn(b)
            }, !1),
            document.addEventListener("mouseup", function(b) {
                a.pn(b)
            }, !1),
            b.addEventListener("mousewheel", function(b) {
                a.Fk(b)
            }, !1),
            b.addEventListener("DOMMouseScroll", function(b) {
                a.Fk(b)
            }, !1),
            document.addEventListener("keydown", function(b) {
                a.ln(b)
            }, !1),
            document.addEventListener("keyup", function(b) {
                a.mn(b)
            }, !1),
            window.addEventListener("orientationchange", function() {
                a.zl()
            }, !1),
            window.addEventListener("resize", function() {
                a.we()
            }, !1),
            window.addEventListener("blur", function() {
                a.zn()
            }, !1),
            a.U.addEventListener("webkitfullscreenchange", function() {
                a.nh()
            }, !1),
            document.addEventListener("mozfullscreenchange", function() {
                a.nh()
            }, !1),
            window.addEventListener("webkitfullscreenchange", function() {
                a.nh()
            }, !1),
            document.addEventListener("MSFullscreenChange", function() {
                a.nh()
            }, !1));
            b.oncontextmenu = function(b) {
                void 0 === b && (b = window.event);
                if (b.target && !a.pd(b.target))
                    return !0;
                if (!b.ctrlKey) {
                    b = a.Df(b);
                    var d = a.fe();
                    a.so(b.x - d.x, b.y - d.y);
                    return !1
                }
                return !0
            }
        }
        ;
        b.prototype.uj = function() {
            for (var a = 0; a < this.P.length; a++)
                if ("point" == this.P[a].type && (this.Qa && this.Qa.addSkinHotspot ? (this.P[a].Ie(),
                this.P[a].a = new this.Qa.addSkinHotspot(this.P[a])) : this.P[a].a = new m.Kl(this,this.P[a]),
                this.P[a].a.__div.style.left = "-1000px",
                this.P[a].a.__div.style.top = "-1000px",
                this.P[a].a && this.P[a].a.__div)) {
                    var b = this.Aa.firstChild;
                    b ? this.Aa.insertBefore(this.P[a].a.__div, b) : this.Aa.appendChild(this.P[a].a.__div)
                }
        }
        ;
        b.prototype.Hl = function() {
            var a, b = document.createElement("fakeelement"), c = {
                OTransition: "oTransitionEnd",
                MSTransition: "msTransitionEnd",
                MozTransition: "transitionend",
                WebkitTransition: "webkitTransitionEnd",
                transition: "transitionEnd"
            };
            for (a in c)
                if (void 0 !== b.style[a])
                    return c[a]
        }
        ;
        b.prototype.Ib = function(a) {
            var b = [];
            a = new RegExp(a,"");
            for (var c = 0; c < this.S.length; c++)
                a.test(this.S[c].id) && b.push(this.S[c]);
            for (c = 0; c < this.J.length; c++)
                a.test(this.J[c].id) && b.push(this.J[c]);
            for (c = 0; c < this.Xa.length; c++)
                a.test(this.Xa[c].id) && b.push(this.Xa[c]);
            return b
        }
        ;
        b.prototype.Lm = function(a) {
            if ("_videopanorama" == a)
                return this.o.a;
            a = this.Ib(a);
            return 0 < a.length ? a[0].a : null
        }
        ;
        b.prototype.Sk = function(a, b) {
            for (var c = 0; c < this.J.length; c++)
                if (this.J[c].id == a)
                    return this.J[c].a = b,
                    this.J[c];
            c = new m.al(this);
            c.registerElement(a, b);
            return c
        }
        ;
        b.prototype.Cc = function(a) {
            if (this.wb) {
                var b = this.ha;
                if (b)
                    return b.isPlaying(a)
            } else {
                if ("_main" === a)
                    return !0;
                a = this.Ib(a);
                if (0 < a.length)
                    return a[0].ia ? a[0].oe : !a[0].a.ended && !a[0].a.paused
            }
            return !1
        }
        ;
        b.prototype.ne = function(a, b) {
            if (this.wb) {
                var c = this.ha;
                c && c.playSound(a, b)
            } else
                try {
                    for (var c = this.Ib(a), e = 0; e < c.length; e++) {
                        var f = c[e];
                        f.Oc = b && !isNaN(Number(b)) ? Number(b) - 1 : f.loop - 1;
                        -1 == f.Oc && (f.Oc = 1E7);
                        this.L(f.a);
                        this.Cc(a) && this.gj(a);
                        f.ia ? f.Lc() : f.a.play()
                    }
                } catch (g) {
                    this.L(g)
                }
        }
        ;
        b.prototype.Ok = function(a, b) {
            for (var c = this.Ib(a), e = 0; e < c.length; e++) {
                var f = c[e];
                this.Cc(f.id) ? this.Qi(f.id) : this.ne(f.id, b)
            }
        }
        ;
        b.prototype.Mn = function(a, b) {
            for (var c = this.Ib(a), e = 0; e < c.length; e++) {
                var f = c[e];
                this.Cc(f.id) ? this.gj(f.id) : this.ne(f.id, b)
            }
        }
        ;
        b.prototype.Qi = function(a) {
            if (this.wb) {
                var b = this.ha;
                b && b.pauseSound(a)
            } else
                try {
                    if ("_main" == a) {
                        for (b = 0; b < this.S.length; b++)
                            this.S[b].ia ? this.S[b].Yh() : this.S[b].a.pause();
                        for (b = 0; b < this.J.length; b++)
                            this.J[b].a.pause()
                    } else
                        for (var c = this.Ib(a), b = 0; b < c.length; b++) {
                            var e = c[b];
                            e.ia ? e.Yh() : e.a.pause()
                        }
                } catch (f) {
                    this.L(f)
                }
        }
        ;
        b.prototype.Vl = function(a, b) {
            for (var c = this.Ib(a), e = 0; e < c.length; e++) {
                var f = c[e];
                0 == b || 1 == b ? f.Ff && f.Ff(1 == b) : 2 == b && f.Uc && f.Uc()
            }
        }
        ;
        b.prototype.gj = function(a) {
            var b;
            if (this.wb)
                (b = this.ha) && b.stopSound(a);
            else
                try {
                    if ("_main" === a) {
                        for (b = 0; b < this.S.length; b++)
                            this.S[b].ia ? this.S[b].Ce() : (this.S[b].a.pause(),
                            this.S[b].a.currentTime = 0);
                        for (b = 0; b < this.J.length; b++)
                            this.J[b].a.pause(),
                            this.J[b].a.currentTime = 0
                    } else {
                        var c = this.Ib(a);
                        for (b = 0; b < c.length; b++) {
                            var e = c[b];
                            e.ia ? e.Ce() : e.a && e.a.pause && (e.a.pause(),
                            e.a.currentTime = 0,
                            this.Lf && (e.vd(),
                            e.addElement()))
                        }
                    }
                } catch (f) {
                    this.L(f)
                }
        }
        ;
        b.prototype.uo = function(a) {
            a = this.Ib(a);
            return 0 < a.length ? (a = a[0],
            a.ia ? a.cm() : a.a ? a.a.currentTime : 0) : 0
        }
        ;
        b.prototype.vo = function(a, b) {
            var c = this.Ib(a);
            0 < c.length && (c = c[0],
            c.ia ? (0 > b && (b = 0),
            b > c.pf.duration && (b = c.pf.duration - .1),
            c.dm(b)) : c.a && (0 > b && (b = 0),
            b > c.a.duration && (b = c.a.duration - .1),
            c.a.currentTime = b))
        }
        ;
        b.prototype.po = function(a, b) {
            if (this.wb) {
                var c = this.ha;
                c && c.setVolume(a, b)
            } else
                try {
                    var e = Number(b);
                    1 < e && (e = 1);
                    0 > e && (e = 0);
                    "_videopanorama" === a && this.o.a && (this.o.a.volume = e);
                    if ("_main" === a) {
                        this.W = e;
                        for (c = 0; c < this.S.length; c++)
                            this.S[c].a.volume = this.S[c].level * this.W;
                        for (c = 0; c < this.J.length; c++)
                            this.J[c].a.volume = this.J[c].level * this.W;
                        this.o.a && (this.o.a.volume = this.W)
                    } else {
                        var f = this.Ib(a);
                        this.L(f);
                        for (c = 0; c < f.length; c++) {
                            var g = f[c];
                            g.a && null != g.a.volume && (g.a.volume = e * this.W);
                            g.level = e
                        }
                    }
                } catch (h) {
                    this.L(h)
                }
        }
        ;
        b.prototype.km = function(a, b) {
            if (this.wb) {
                var c = this.ha;
                c && c.changeVolume(a, b)
            } else
                try {
                    var e;
                    "_videopanorama" === a && this.o.a && (this.o.a.volume = this.o.a.volume + Number(b));
                    if ("_main" === a) {
                        c = this.W;
                        c += Number(b);
                        1 < c && (c = 1);
                        0 > c && (c = 0);
                        this.W = c;
                        for (e = 0; e < this.S.length; e++)
                            this.S[e].a.volume = this.S[e].level * this.W;
                        for (e = 0; e < this.J.length; e++)
                            this.J[e].a.volume = this.J[e].level * this.W;
                        this.o.a && (this.o.a.volume = this.W)
                    } else {
                        var f = this.Ib(a);
                        for (e = 0; e < f.length; e++) {
                            var g = f[e]
                              , c = g.level
                              , c = c + Number(b);
                            1 < c && (c = 1);
                            0 > c && (c = 0);
                            g.level = c;
                            g.a && null != g.a.volume && (g.a.volume = c * this.W)
                        }
                    }
                } catch (h) {
                    this.L(h)
                }
        }
        ;
        b.prototype.ol = function() {
            try {
                for (var a = this, b = !1, c = !1, e = 0; e < this.S.length; e++) {
                    var f = this.S[e];
                    -1 == f.loop || this.Cc(f.id) || (this.Ha && this.Ea.enabled && 4 != f.mode && 6 != f.mode ? this.Ea.Fj ? (f.ia ? f.Lc() : (f.a.play(),
                    f.a.currentTime = 0),
                    f.ka = 0,
                    c = !0) : b = !0 : 4 == f.mode || 6 == f.mode || "_background" == f.id && this.Cc(f.id) || (f.ia ? f.Lc() : (f.a.play(),
                    f.a.currentTime && (f.a.currentTime = 0))))
                }
                b && setTimeout(function() {
                    a.Ea.Ao()
                }, 1E3 * this.Ea.nb);
                c && (this.Ea.xo = this.Ha.currentTime,
                this.Ea.wo = setInterval(function() {
                    a.Ea.vm()
                }, 10))
            } catch (g) {
                this.L(g)
            }
        }
        ;
        b.prototype.Wk = function() {
            for (var a; 0 < this.P.length; )
                a = this.P.pop(),
                a.a && (this.Aa.removeChild(a.a.__div),
                delete a.a),
                a.a = null
        }
        ;
        b.prototype.bj = function(a) {
            this.zg = a;
            0 != a ? this.U.style.zIndex = a.toString() : this.U.style.zIndex = "auto";
            this.Ba && this.Ba.Mc && (this.Ba.Mc.zIndex = (a + 4).toString());
            this.Aa.style.zIndex = (a + 4).toString();
            this.sa.style.zIndex = (a + 3).toString();
            this.ta.style.zIndex = (a + 5).toString();
            for (var b = 0; b < this.J.length + this.Xa.length; b++) {
                var c;
                c = b < this.J.length ? this.J[b] : this.Xa[b - this.J.length];
                c.a && (c.a.style.zIndex = (a + (c.yb ? 8E4 : 0)).toString())
            }
        }
        ;
        b.prototype.af = function(a) {
            var b = this.isFullscreen !== a;
            this.isFullscreen !== a && (this.isFullscreen = a,
            this.update(100));
            if (this.isFullscreen) {
                if (this.Lh)
                    try {
                        this.U.webkitRequestFullScreen ? this.U.webkitRequestFullScreen() : this.U.mozRequestFullScreen ? this.U.mozRequestFullScreen() : this.U.msRequestFullscreen ? this.U.msRequestFullscreen() : this.U.requestFullScreen ? this.U.requestFullScreen() : this.U.requestFullscreen && this.U.requestFullscreen()
                    } catch (c) {
                        this.L(c)
                    }
                this.U.style.position = "absolute";
                a = this.fe();
                this.U.style.left = window.pageXOffset - a.x + this.margin.left + "px";
                this.U.style.top = window.pageYOffset - a.y + this.margin.top + "px";
                this.bj(10);
                document.body.style.overflow = "hidden";
                b && this.O && this.O.ggEnterFullscreen && this.O.ggEnterFullscreen()
            } else {
                if (this.Lh)
                    try {
                        document.webkitIsFullScreen ? document.webkitCancelFullScreen() : document.mozFullScreen ? document.mozCancelFullScreen() : document.msExitFullscreen ? document.msExitFullscreen() : document.fullScreen && (document.cancelFullScreen ? document.cancelFullScreen() : document.exitFullscreen && document.exitFullscreen())
                    } catch (c) {
                        this.L(c)
                    }
                this.U.style.position = "relative";
                this.U.style.left = "0px";
                this.U.style.top = "0px";
                this.bj(0);
                document.body.style.overflow = "";
                b && this.O && this.O.ggExitFullscreen && this.O.ggExitFullscreen()
            }
            this.we()
        }
        ;
        b.prototype.Gh = function() {
            this.af(!this.isFullscreen)
        }
        ;
        b.prototype.um = function() {
            this.af(!0)
        }
        ;
        b.prototype.exitFullscreen = function() {
            this.af(!1)
        }
        ;
        b.prototype.Gm = function() {
            return this.isFullscreen
        }
        ;
        b.prototype.ll = function(a, b, c) {
            this.s.enabled = !0;
            this.s.active = !0;
            this.s.rd = 0;
            this.s.startTime = (new Date).getTime();
            a && 0 != a && (this.s.speed = a);
            b && (this.s.timeout = b);
            c && (this.s.Eh = c)
        }
        ;
        b.prototype.Bo = function() {
            this.s.active = !1;
            this.s.enabled = !1;
            this.s.ed = !1
        }
        ;
        b.prototype.Fo = function() {
            this.s.enabled = !this.s.active;
            this.s.active = this.s.enabled;
            this.s.rd = 0;
            this.s.enabled && (this.s.startTime = (new Date).getTime())
        }
        ;
        b.prototype.yo = function() {
            this.s.ed || (this.s.ed = !0,
            this.s.yj = this.s.enabled,
            this.ll())
        }
        ;
        b.prototype.Ej = function(a) {
            if (this.Ed = document.getElementById(a)) {
                this.Ed.innerHTML = "";
                this.U = document.createElement("div");
                this.U.onselectstart = function() {
                    return !1
                }
                ;
                O && this.U.setAttribute("id", "viewport");
                a = "top:\t0px;left: 0px;position:relative;-ms-touch-action: none;touch-action: none;text-align: left;" + (this.Ja + "user-select: none;");
                this.U.setAttribute("style", a);
                this.Ed.appendChild(this.U);
                this.C = document.createElement("div");
                a = "top:\t0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;-ms-touch-action: none;touch-action: none;" + (this.Ja + "user-select: none;");
                O && this.C.setAttribute("id", "viewer");
                this.C.setAttribute("style", a);
                this.U.appendChild(this.C);
                if (this.wb) {
                    var b = document.createElement("div");
                    a = "top:\t0px;left: 0px;width:  100%;height: 100%;overflow: hidden;position:absolute;-ms-touch-action: none;touch-action: none;" + (this.Ja + "user-select: none;");
                    b.setAttribute("id", this.si);
                    b.setAttribute("style", a);
                    this.C.appendChild(b)
                }
                this.Ba && (this.Ba.Mc = document.createElement("canvas"),
                O && this.Ba.Mc.setAttribute("id", "lensflarecanvas"),
                a = "top:\t0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;" + (this.Ja + "user-select: none;"),
                a += this.Ja + "pointer-events: none;",
                this.Ba.Mc.setAttribute("style", a),
                this.U.appendChild(this.Ba.Mc));
                this.Aa = document.createElement("div");
                O && this.Aa.setAttribute("id", "hotspots");
                a = "top:\t0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;";
                this.qk && (a += "background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7);");
                this.qd && !this.Z && (a += this.Ja + "transform: translateZ(9999999px);");
                a += this.Ja + "user-select: none;";
                this.Aa.setAttribute("style", a);
                this.U.appendChild(this.Aa);
                this.sa = document.createElement("canvas");
                O && this.sa.setAttribute("id", "hotspotcanvas");
                a = "top:\t0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;" + (this.Ja + "user-select: none;");
                a += this.Ja + "pointer-events: none;";
                this.sa.setAttribute("style", a);
                this.U.appendChild(this.sa);
                this.ta = document.createElement("div");
                O && this.ta.setAttribute("id", "hotspottext");
                this.ta.setAttribute("style", "top:\t0px;left: 0px;position:absolute;padding: 3px;visibility: hidden;");
                this.ta.innerHTML = " Hotspot text!";
                this.U.appendChild(this.ta);
                this.divSkin = this.O = this.Aa;
                this.bj(0)
            } else
                alert("container not found!")
        }
        ;
        b.prototype.Gj = function(a) {
            this.za = !0;
            return function() {
                a.Oa && (a.h && a.h.complete ? (a.loaded = !0,
                a.Oa.drawImage(a.h, 0, 0, a.width, a.height),
                a.h = null,
                a.ud = null) : a.ud && a.ud.complete && !a.loaded && (a.Oa.drawImage(a.ud, 0, 0, a.width, a.height),
                a.ud = null))
            }
        }
        ;
        b.prototype.Dj = function(a) {
            var b, c, e, f = 128;
            this.h.Ve && (this.C.style.backgroundColor = this.h.Ve.replace("0x", "#"));
            a ? (f = this.qf,
            this.cf = 1) : this.ic > f && (f = this.ic);
            for (e = 0; 6 > e; e++) {
                c = this.hb.ab[e];
                a ? (c.width = this.qf,
                c.height = this.qf) : (c.K = document.createElement("canvas"),
                c.K.width = this.ic,
                c.K.height = this.ic,
                c.width = this.ic,
                c.height = this.ic,
                c.Oa = c.K.getContext("2d"));
                b = "position:absolute;";
                b += "left: 0px;";
                b += "top: 0px;";
                b += "width: " + f + "px;";
                b += "height: " + f + "px;";
                a && (b += "outline: 1px solid transparent;");
                b += this.Ja + "transform-origin: 0% 0%;";
                b += "-webkit-user-select: none;";
                b += this.Ja + "transform: ";
                var g;
                g = "";
                var h = 1;
                this.Xe && (h = 100);
                g = 4 > e ? g + ("rotateY(" + -90 * e + "deg)") : g + ("rotateX(" + (4 == e ? -90 : 90) + "deg)");
                this.Xe && (g += " scale(" + h + ")");
                g += " translate3d(" + -f / 2 + "px," + -f / 2 + "px," + -f * h / (2 * this.cf) + "px)";
                b += g + ";";
                c.ek = g;
                a || (c.K.setAttribute("style", b),
                this.C.insertBefore(c.K, this.C.firstChild))
            }
            if (!a) {
                for (e = 0; 6 > e; e++)
                    c = this.hb.ab[e],
                    "" != this.Ge[e] && (c.ud = new Image,
                    c.ud.crossOrigin = this.crossOrigin,
                    c.ud.onload = this.Gj(c),
                    c.ud.setAttribute("src", this.Wb(this.Ge[e])),
                    this.Gb.push(c.ud));
                for (e = 0; 6 > e; e++)
                    c = this.hb.ab[e],
                    c.loaded = !1,
                    c.h = new Image,
                    c.h.crossOrigin = this.crossOrigin,
                    c.h.onload = this.Gj(c),
                    c.h.setAttribute("src", this.Wb(this.Kg[e])),
                    this.Gb.push(c.h)
            }
        }
        ;
        b.prototype.th = function() {
            var a;
            this.ua.ba.x = 0;
            this.ua.ba.y = 0;
            if (this.Gc) {
                for (a = 0; a < this.hb.ab.length; a++)
                    this.hb.ab[a].K && this.hb.ab[a].K.setAttribute && (this.hb.ab[a].K.setAttribute("src", this.Lj),
                    this.C.removeChild(this.hb.ab[a].K));
                if (this.h.I) {
                    for (a = 0; a < this.h.I.length; a++) {
                        var b = this.h.I[a], c;
                        for (c in b.V)
                            if (b.V.hasOwnProperty(c)) {
                                var e = b.V[c];
                                e.visible = !1;
                                e.K && (e.Oa && e.Oa.clearRect(0, 0, e.Oa.canvas.width, e.Oa.canvas.height),
                                this.Hh.push(e.K));
                                e.h && delete e.h;
                                e.bb && (this.H.deleteTexture(e.bb),
                                this.Vc--);
                                e.Oa = null;
                                e.K = null;
                                e.h = null
                            }
                        delete b.V
                    }
                    delete this.h.I;
                    this.h.I = null
                }
            }
            this.la.th();
            c = [];
            for (a = 0; a < this.J.length; a++)
                b = this.J[a],
                b.$c ? c.push(b) : b.vd();
            for (a = 0; a < this.Xa.length; a++)
                this.Xa[a].vd();
            this.w.Qf = -1;
            this.sa.style.visibility = "hidden";
            this.kb = 0;
            b = [];
            this.Ea.sg = [];
            for (a = 0; a < this.S.length; a++)
                if (e = this.S[a],
                0 == e.mode || 1 == e.mode)
                    b.push(e),
                    this.L("Keep in list " + e.id);
                else if (this.Ha && this.Ea.enabled && this.Cc(e.id))
                    this.Ea.sg.push(e),
                    1 != this.B.Na && 2 != this.B.Na && this.Ea.mi(e);
                else {
                    try {
                        e.ia ? e.Ce() : e.a.pause()
                    } catch (f) {
                        this.L(f)
                    }
                    e.vd()
                }
            this.S = b;
            this.J = c;
            this.Xa = [];
            this.o.a && (this.U.removeChild(this.o.a),
            this.o.a = null,
            a = this.Ib("_videopanorama"),
            0 < a.length && (a[0].a = null));
            this.o.Xc = !1;
            this.o.bh = !1
        }
        ;
        b.prototype.bk = function() {
            var a = 1
              , b = -1 != navigator.userAgent.indexOf("Mac");
            window.devicePixelRatio && b && (a = window.devicePixelRatio);
            return {
                Nh: screen.width * a,
                Xg: screen.height * a
            }
        }
        ;
        b.prototype.Yj = function() {
            var a = this.bk();
            return a.Nh > a.Xg ? a.Nh : a.Xg
        }
        ;
        b.prototype.Ui = function(a, b) {
            var c = (new DOMParser).parseFromString(a, "text/xml");
            this.gi = a;
            this.Rk(c, b);
            this.ha && (this.L("Apply to Flash player"),
            this.ha.readConfigString(this.gi),
            this.ha.setLocked(!0),
            this.ha.setSlaveMode(!0))
        }
        ;
        b.prototype.Qk = function(a, b, c) {
            try {
                var e;
                e = new XMLHttpRequest;
                e.open("GET", a, !1);
                e.send(null);
                if (e.responseXML) {
                    var f = a.lastIndexOf("/");
                    0 <= f && (this.Cd = a.substr(0, f + 1));
                    2 <= arguments.length && null != b && (this.Cd = b);
                    this.Ui(e.responseText, c)
                } else
                    alert("Error loading panorama XML")
            } catch (g) {
                alert("Error:" + g)
            }
        }
        ;
        b.prototype.On = function(a, b, c, e) {
            var f;
            f = new XMLHttpRequest;
            var g = this;
            f.onload = function(h) {
                if (4 <= f.readyState)
                    if (f.responseXML) {
                        var k = a.lastIndexOf("/");
                        0 <= k && (g.Cd = a.substr(0, k + 1));
                        3 <= arguments.length && null != c && (g.Cd = c);
                        g.Ui(f.responseText, e);
                        b && b()
                    } else
                        alert("Error loading panorama XML");
                else
                    console.error("Wrong state loading XML:" + f.statusText)
            }
            ;
            f.onerror = function() {
                console.error("Error loading XML:" + f.statusText)
            }
            ;
            f.open("GET", a, !0);
            f.send(null)
        }
        ;
        b.prototype.Zh = function(a) {
            var b = "";
            "{" == a.charAt(0) && (b = a.substr(1, a.length - 2));
            a = {
                oldNodeId: this.Ub,
                nodeId: b
            };
            this.tl("beforechangenodeid", a);
            "" != this.Ub && -1 == this.sj.indexOf(this.Ub) && this.sj.push(this.Ub);
            this.wk = this.Ub;
            this.Ub = b;
            this.L("change active node: " + b);
            this.Qa && this.Qa.changeActiveNode && this.Qa.changeActiveNode("{" + b + "}");
            this.tl("changenodeid", a)
        }
        ;
        b.prototype.Xj = function() {
            return this.Ub
        }
        ;
        b.prototype.Zj = function() {
            if (0 < this.La.length) {
                var a;
                a = this.La.indexOf(this.Ub);
                a++;
                a >= this.La.length && (a = 0);
                return this.La[a]
            }
            return ""
        }
        ;
        b.prototype.Wm = function() {
            if (0 < this.La.length) {
                var a;
                a = this.La.indexOf(this.Ub);
                a--;
                0 > a && (a = this.La.length - 1);
                return this.La[a]
            }
            return ""
        }
        ;
        b.prototype.Km = function() {
            return this.wk
        }
        ;
        b.prototype.xn = function(a) {
            return -1 != this.sj.indexOf(a)
        }
        ;
        b.prototype.Rk = function(a, b) {
            var c = a.firstChild;
            this.te = [];
            this.La = [];
            this.Mg = [];
            if ("tour" == c.nodeName) {
                this.Of = !0;
                var e = "", f;
                (f = c.getAttributeNode("start")) && (e = f.nodeValue.toString());
                this.hasOwnProperty("startNode") && this.startNode && (e = String(this.startNode),
                this.startNode = "");
                for (var g = c.firstChild, h = "", c = ""; g; ) {
                    if ("panorama" == g.nodeName) {
                        if (f = g.getAttributeNode("id"))
                            h = f.nodeValue.toString(),
                            "" == e && (e = h),
                            "" == c && (c = h),
                            this.te[h] = g,
                            this.La.push(h);
                        for (f = g.firstChild; f; ) {
                            if ("userdata" == f.nodeName) {
                                var k = this.Pg(f);
                                this.qj[h] = k;
                                k.customnodeid && (this.Mg[k.customnodeid] = h)
                            }
                            f = f.nextSibling
                        }
                    }
                    g = g.nextSibling
                }
                this.te.hasOwnProperty(e) || (g = this.Mg[e]) && (e = g);
                this.te.hasOwnProperty(e) || (this.Zc("Start node " + e + " not found!"),
                e = c);
                this.Ti(this.te[e], b);
                this.Zh("{" + e + "}")
            } else
                this.Of = !1,
                this.Ti(c, b),
                this.Zh(""),
                this.La.push("")
        }
        ;
        b.prototype.Ti = function(a, b) {
            this.Wk();
            this.Ba && this.Ba.Qn();
            this.$e(this.pb);
            this.th();
            this.Rf = 0;
            for (var c = a.firstChild, e, f, g = 0; c; ) {
                if ("view" == c.nodeName) {
                    if (e = c.getAttributeNode("fovmode"))
                        this.f.mode = Number(e.nodeValue);
                    e = c.getAttributeNode("pannorth");
                    this.pan.Oi = 1 * (e ? e.nodeValue : 0);
                    for (var h = c.firstChild; h; ) {
                        "start" == h.nodeName && (e = h.getAttributeNode("pan"),
                        this.pan.c = Number(e ? e.nodeValue : 0),
                        this.pan.Pa = this.pan.c,
                        e = h.getAttributeNode("tilt"),
                        this.j.c = Number(e ? e.nodeValue : 0),
                        this.j.Pa = this.j.c,
                        e = h.getAttributeNode("roll"),
                        this.N.c = Number(e ? e.nodeValue : 0),
                        this.N.Pa = this.N.c,
                        e = h.getAttributeNode("fov"),
                        this.f.c = Number(e ? e.nodeValue : 70),
                        this.f.Pa = this.f.c,
                        e = h.getAttributeNode("projection"),
                        this.oh = Number(e ? e.nodeValue : 4),
                        this.ad(this.oh));
                        "min" == h.nodeName && (e = h.getAttributeNode("pan"),
                        this.pan.min = 1 * (e ? e.nodeValue : 0),
                        e = h.getAttributeNode("tilt"),
                        this.j.min = 1 * (e ? e.nodeValue : -90),
                        e = h.getAttributeNode("fov"),
                        this.f.min = 1 * (e ? e.nodeValue : 5),
                        1E-20 > this.f.min && (this.f.min = 1E-20),
                        e = h.getAttributeNode("fovpixel"),
                        this.f.Xf = 1 * (e ? e.nodeValue : 0));
                        if ("max" == h.nodeName) {
                            e = h.getAttributeNode("pan");
                            this.pan.max = 1 * (e ? e.nodeValue : 0);
                            e = h.getAttributeNode("tilt");
                            this.j.max = 1 * (e ? e.nodeValue : 90);
                            e = h.getAttributeNode("fov");
                            this.f.max = 1 * (e ? e.nodeValue : 120);
                            180 <= this.f.max && (this.f.max = 179.9);
                            if (e = h.getAttributeNode("fovstereographic"))
                                this.f.Ki = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("fovfisheye"))
                                this.f.Ji = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("scaletofit"))
                                this.A.bl = 1 == e.nodeValue
                        }
                        if ("flyin" == h.nodeName) {
                            if (e = h.getAttributeNode("projection"))
                                this.lc.Bb = Number(e.nodeValue);
                            if (e = h.getAttributeNode("pan"))
                                this.lc.pan = parseFloat(e.nodeValue);
                            if (e = h.getAttributeNode("tilt"))
                                this.lc.j = parseFloat(e.nodeValue);
                            if (e = h.getAttributeNode("fov"))
                                this.lc.f = parseFloat(e.nodeValue)
                        }
                        h = h.nextSibling
                    }
                }
                if ("autorotate" == c.nodeName) {
                    if (e = c.getAttributeNode("speed"))
                        this.s.speed = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("delay"))
                        this.s.timeout = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("returntohorizon"))
                        this.s.Eh = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("nodedelay"))
                        this.s.mh = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("noderandom"))
                        this.s.Ni = 1 == e.nodeValue;
                    this.ce && (this.s.enabled = !0,
                    this.s.active = !1);
                    if (e = c.getAttributeNode("startloaded"))
                        this.s.pg = 1 == e.nodeValue,
                        this.s.pg && (this.s.active = !1);
                    if (e = c.getAttributeNode("useanimation"))
                        this.s.pj = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("syncanimationwithvideo"))
                        this.s.hj = 1 == e.nodeValue
                }
                if ("animation" == c.nodeName) {
                    if (e = c.getAttributeNode("syncanimationwithvideo"))
                        this.s.hj = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("useinautorotation"))
                        this.s.pj = 1 == e.nodeValue;
                    this.Ia = [];
                    for (h = c.firstChild; h; ) {
                        if ("clip" == h.nodeName) {
                            this.D = new m.Ek;
                            if (e = h.getAttributeNode("animtitle"))
                                this.D.gp = e.nodeValue.toString();
                            if (e = h.getAttributeNode("cliptitle"))
                                this.D.Ta = e.nodeValue.toString();
                            if (e = h.getAttributeNode("nodeid"))
                                this.D.hp = e.nodeValue.toString();
                            if (e = h.getAttributeNode("length"))
                                this.D.length = Number(e.nodeValue);
                            if (e = h.getAttributeNode("animtype"))
                                this.D.Xl = Number(e.nodeValue);
                            if (e = h.getAttributeNode("nextcliptitle"))
                                this.D.Ik = e.nodeValue.toString();
                            if (e = h.getAttributeNode("nextclipnodeid"))
                                this.D.Hk = e.nodeValue.toString();
                            if (e = h.getAttributeNode("transitiontype"))
                                this.D.Lo = Number(e.nodeValue);
                            var k = h.firstChild;
                            for (this.D.ja = []; k; ) {
                                if ("keyframe" == k.nodeName) {
                                    var A = new m.yc;
                                    if (e = k.getAttributeNode("time"))
                                        A.time = Number(e.nodeValue);
                                    if (e = k.getAttributeNode("value"))
                                        A.value = Number(e.nodeValue);
                                    if (e = k.getAttributeNode("transitiontime"))
                                        A.nb = Number(e.nodeValue);
                                    e = k.getAttributeNode("type");
                                    var n = 0;
                                    e && (A.type = Number(e.nodeValue),
                                    n = Number(e.nodeValue));
                                    if (e = k.getAttributeNode("property"))
                                        A.vb = Number(e.nodeValue);
                                    if (1 == n || 2 == n) {
                                        if (e = k.getAttributeNode("bezierintime"))
                                            A.Wd = Number(e.nodeValue);
                                        if (e = k.getAttributeNode("bezierinvalue"))
                                            A.Jc = Number(e.nodeValue);
                                        if (e = k.getAttributeNode("bezierouttime"))
                                            A.Xd = Number(e.nodeValue);
                                        if (e = k.getAttributeNode("bezieroutvalue"))
                                            A.Yd = Number(e.nodeValue)
                                    }
                                    this.D.ja.push(A)
                                }
                                k = k.nextSibling
                            }
                            this.zb == this.D.Ta && (e = this.D.ja,
                            this.hg(e[0].value, e[1].value, e[2].value));
                            this.Ia.push(this.D)
                        }
                        h = h.nextSibling
                    }
                }
                "input" == c.nodeName && (f || (f = c));
                if (f)
                    for (h = 0; 6 > h; h++)
                        e = f.getAttributeNode("prev" + h + "url"),
                        this.Ge[h] = e ? String(e.nodeValue) : "";
                "altinput" == c.nodeName && (h = 0,
                (e = c.getAttributeNode("screensize")) && (h = 1 * e.nodeValue),
                0 < h && h <= this.Yj() && h > g && (g = h,
                f = c));
                if ("control" == c.nodeName && this.ce) {
                    if (e = c.getAttributeNode("simulatemass"))
                        this.ua.enabled = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("rubberband"))
                        this.A.$k = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("locked"))
                        this.A.sb = 1 == e.nodeValue;
                    e && (this.A.Qe = 1 == e.nodeValue);
                    if (e = c.getAttributeNode("lockedmouse"))
                        this.A.sb = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("lockedkeyboard"))
                        this.A.Qe = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("lockedkeyboardzoom"))
                        this.A.Hi = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("lockedwheel"))
                        this.A.Yc = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("invertwheel"))
                        this.A.nk = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("speedwheel"))
                        this.A.kl = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("invertcontrol"))
                        this.A.od = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("sensitivity"))
                        this.A.sensitivity = 1 * e.nodeValue,
                        1 > this.A.sensitivity && (this.A.sensitivity = 1);
                    if (e = c.getAttributeNode("dblclickfullscreen"))
                        this.A.ii = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("contextfullscreen"))
                        this.A.uf = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("contextprojections"))
                        this.A.Ig = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("hideabout"))
                        this.A.Jf = 1 == e.nodeValue;
                    for (h = c.firstChild; h; )
                        "menulink" == h.nodeName && (k = {
                            text: "",
                            url: ""
                        },
                        e = h.getAttributeNode("text"),
                        k.text = e.nodeValue,
                        e = h.getAttributeNode("url"),
                        k.url = e.nodeValue,
                        this.Wf.push(k)),
                        h = h.nextSibling
                }
                if ("transition" == c.nodeName && this.ce) {
                    if (e = c.getAttributeNode("enabled"))
                        this.B.enabled = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("blendtime"))
                        this.B.Dg = e.nodeValue;
                    if (e = c.getAttributeNode("blendcolor"))
                        this.B.Ae = e.nodeValue.toString();
                    if (e = c.getAttributeNode("type"))
                        this.B.type = e.nodeValue.toString();
                    if (e = c.getAttributeNode("softedge"))
                        this.B.tc = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("zoomin"))
                        this.B.Na = e.nodeValue;
                    if (e = c.getAttributeNode("zoomout"))
                        this.B.Nb = e.nodeValue;
                    if (e = c.getAttributeNode("zoomfov"))
                        this.B.jf = e.nodeValue;
                    if (e = c.getAttributeNode("zoomspeed"))
                        this.B.Td = e.nodeValue;
                    if (e = c.getAttributeNode("zoomoutpause"))
                        this.B.kf = 1 == e.nodeValue
                }
                if ("soundstransition" == c.nodeName) {
                    if (e = c.getAttributeNode("enabled"))
                        this.Ea.enabled = 1 == e.nodeValue;
                    if (e = c.getAttributeNode("transitiontime"))
                        this.Ea.nb = 1 * e.nodeValue;
                    if (e = c.getAttributeNode("crossfade"))
                        this.Ea.Fj = 1 == e.nodeValue
                }
                if ("flyintransition" == c.nodeName) {
                    if (e = c.getAttributeNode("enabled"))
                        this.qb.enabled = 1 == e.nodeValue && this.Z;
                    if (e = c.getAttributeNode("speed"))
                        this.qb.speed = 1 * e.nodeValue
                }
                "userdata" == c.nodeName && (this.userdata = this.gf = this.Pg(c));
                if ("hotspots" == c.nodeName)
                    for (h = c.firstChild; h; ) {
                        if ("label" == h.nodeName && this.ce) {
                            k = this.w.jj;
                            if (e = h.getAttributeNode("enabled"))
                                k.enabled = 1 == e.nodeValue;
                            if (e = h.getAttributeNode("width"))
                                k.width = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("height"))
                                k.height = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("textcolor"))
                                k.kj = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("textalpha"))
                                k.ij = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("background"))
                                k.background = 1 == e.nodeValue;
                            if (e = h.getAttributeNode("backgroundalpha"))
                                k.Ob = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("backgroundcolor"))
                                k.Pb = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("border"))
                                k.Xh = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("bordercolor"))
                                k.Sb = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("borderalpha"))
                                k.Rb = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("borderradius"))
                                k.Wh = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("wordwrap"))
                                k.Ph = 1 == e.nodeValue
                        }
                        if ("polystyle" == h.nodeName && this.ce) {
                            if (e = h.getAttributeNode("mode"))
                                this.w.mode = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("bordercolor"))
                                this.w.Sb = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("backgroundcolor"))
                                this.w.Pb = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("borderalpha"))
                                this.w.Rb = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("backgroundalpha"))
                                this.w.Ob = 1 * e.nodeValue;
                            if (e = h.getAttributeNode("handcursor"))
                                this.w.Me = 1 == e.nodeValue
                        }
                        e = void 0;
                        "hotspot" == h.nodeName && (e = new m.dh(this),
                        e.type = "point",
                        e.Db(h),
                        this.P.push(e));
                        "polyhotspot" == h.nodeName && (e = new m.dh(this),
                        e.type = "poly",
                        e.Db(h),
                        this.P.push(e));
                        h = h.nextSibling
                    }
                if ("sounds" == c.nodeName || "media" == c.nodeName)
                    for (h = c.firstChild; h; )
                        "sound" != h.nodeName || this.Jk || (e = new m.Tl(this),
                        e.Db(h),
                        this.wb || e.addElement()),
                        "video" == h.nodeName && (e = new m.al(this),
                        e.Db(h),
                        this.wb || e.addElement()),
                        "image" == h.nodeName && (e = new m.Rl(this),
                        e.Db(h),
                        this.wb || e.addElement()),
                        "lensflare" == h.nodeName && this.Ba && (e = new m.Sl(this),
                        e.Db(h),
                        this.Ba.Tf.push(e)),
                        h = h.nextSibling;
                c = c.nextSibling
            }
            b && "" != b && (c = b.toString().split("/"),
            4 < c.length && this.ad(Number(c[4])),
            0 < c.length && (e = String(c[0]),
            "N" == e.charAt(0) ? this.aj(Number(e.substr(1))) : "S" == e.charAt(0) ? this.aj(-180 + Number(e.substr(1))) : this.xh(Number(e))),
            1 < c.length && this.yh(Number(c[1])),
            2 < c.length && this.dg(Number(c[2])));
            if (f) {
                for (h = 0; 6 > h; h++)
                    (e = f.getAttributeNode("tile" + h + "url")) && (this.Kg[h] = String(e.nodeValue)),
                    e = f.getAttributeNode("tile" + h + "url1");
                for (h = 0; 6 > h; h++)
                    (e = f.getAttributeNode("prev" + h + "url")) && (this.Ge[h] = String(e.nodeValue));
                if (e = f.getAttributeNode("tilesize"))
                    this.ic = 1 * e.nodeValue;
                if (e = f.getAttributeNode("canvassize"))
                    this.qf = Number(e.nodeValue);
                if (e = f.getAttributeNode("tilescale"))
                    this.cf = 1 * e.nodeValue;
                if (e = f.getAttributeNode("leveltileurl"))
                    this.h.Dk = e.nodeValue;
                if (e = f.getAttributeNode("leveltilesize"))
                    this.h.G = Number(e.nodeValue);
                if (e = f.getAttributeNode("levelbias"))
                    this.h.Bk = Number(e.nodeValue);
                if (e = f.getAttributeNode("levelbiashidpi"))
                    this.h.Ck = Number(e.nodeValue);
                e = f.getAttributeNode("overlap");
                this.Ca.N = 0;
                this.Ca.pitch = 0;
                e && (this.h.Ka = Number(e.nodeValue));
                if (e = f.getAttributeNode("levelingroll"))
                    this.Ca.N = Number(e.nodeValue);
                if (e = f.getAttributeNode("levelingpitch"))
                    this.Ca.pitch = Number(e.nodeValue);
                this.kb = 0;
                (e = f.getAttributeNode("flat")) && 1 == e.nodeValue && (this.kb = 2);
                e = f.getAttributeNode("width");
                this.h.width = 1 * (e ? e.nodeValue : 1);
                e = f.getAttributeNode("height");
                this.h.height = 1 * (e ? e.nodeValue : this.h.width);
                this.o.src = [];
                this.h.I = [];
                for (h = f.firstChild; h; ) {
                    if ("preview" == h.nodeName) {
                        if (e = h.getAttributeNode("color"))
                            this.h.Ve = e.nodeValue;
                        if (e = h.getAttributeNode("strip"))
                            this.h.Pk = 1 == e.nodeValue
                    }
                    if ("video" == h.nodeName) {
                        if (e = h.getAttributeNode("format"))
                            "3x2" == e.nodeValue && (this.o.format = 14),
                            "equirectangular" == e.nodeValue && (this.o.format = 1);
                        if (e = h.getAttributeNode("flipy"))
                            this.o.ti = Number(e.nodeValue);
                        if (e = h.getAttributeNode("startmuted"))
                            this.o.nl = 1 == e.nodeValue;
                        if (e = h.getAttributeNode("bleed"))
                            this.o.ze = Number(e.nodeValue);
                        if (e = h.getAttributeNode("endaction"))
                            this.o.be = String(e.nodeValue);
                        if (e = h.getAttributeNode("width"))
                            this.o.width = Number(e.nodeValue);
                        if (e = h.getAttributeNode("height"))
                            this.o.height = Number(e.nodeValue);
                        for (f = h.firstChild; f; )
                            "source" == f.nodeName && (e = f.getAttributeNode("url")) && this.o.src.push(e.nodeValue.toString()),
                            f = f.nextSibling
                    }
                    if ("level" == h.nodeName) {
                        f = new m.Kk;
                        e = h.getAttributeNode("width");
                        f.width = 1 * (e ? e.nodeValue : 1);
                        e = h.getAttributeNode("height");
                        f.height = 1 * (e ? e.nodeValue : f.width);
                        if (e = h.getAttributeNode("preload"))
                            f.cache = 1 == e.nodeValue;
                        if (e = h.getAttributeNode("preview"))
                            f.Ue = 1 == e.nodeValue;
                        f.M = Math.floor((f.width + this.h.G - 1) / this.h.G);
                        f.ea = Math.floor((f.height + this.h.G - 1) / this.h.G);
                        this.h.I.push(f)
                    }
                    h = h.nextSibling
                }
                this.h.Ei = this.h.I.length
            }
            this.vg && (this.Z = this.Gc = !1,
            this.Tb || (this.L("dummy rendering"),
            this.Tb = document.createElement("canvas"),
            this.Tb.width = 100,
            this.Tb.height = 100,
            this.Tb.id = "dummycanvas",
            this.C.appendChild(this.Tb)),
            this.dd());
            this.Z && this.H && (this.la.lk(this.cf),
            this.la.mk());
            this.Gc && (0 < this.h.I.length ? this.Dj(!0) : this.Dj(!1),
            this.Rf = 0);
            var r = this;
            0 < this.h.I.length && this.h.Pk && 0 == this.kb && (c = new Image,
            f = new m.Kk,
            f.Ue = !0,
            f.cache = !0,
            f.M = f.ea = 0,
            f.height = f.width = 0,
            this.h.I.push(f),
            c.crossOrigin = this.crossOrigin,
            c.onload = this.la.wn(c),
            c.setAttribute("src", this.se(6, this.h.Ei - 1, 0, 0)));
            if (0 < this.o.src.length && this.Z)
                if (this.Mh) {
                    this.o.a = document.createElement("video");
                    this.o.a.crossOrigin = this.crossOrigin;
                    this.o.a.setAttribute("style", "display:none; max-width:none;");
                    this.o.a.setAttribute("playsinline", "playsinline");
                    this.Kd && this.pi && this.o.nl && this.o.a.setAttribute("muted", "muted");
                    this.o.a.b = !0;
                    this.o.a.volume = this.W;
                    this.U.appendChild(this.o.a);
                    this.o.Xc = !1;
                    this.o.pl = !1;
                    this.o.a.oncanplay = function() {
                        if (!r.o.Xc) {
                            r.o.bh = !0;
                            var a, b, c, d, e, f, g = [], h = new m.ra, k = r.H, l = r.o.a.videoWidth / 3;
                            r.o.width = r.o.a.videoWidth;
                            r.o.height = r.o.a.videoHeight;
                            for (a = 0; 6 > a; a++)
                                for (c = a % 3 * l + r.o.ze,
                                e = c + l - 2 * r.o.ze,
                                f = 4,
                                3 > a && (f += l),
                                d = f + l - 2 * r.o.ze,
                                b = 0; 4 > b; b++) {
                                    h.x = -1;
                                    h.y = -1;
                                    h.z = 1;
                                    for (var n = 0; n < b; n++)
                                        h.Zk();
                                    g.push((0 < h.x ? c : e) / (3 * l), (0 < h.y ? d : f) / (2 * l))
                                }
                            k.bindBuffer(k.ARRAY_BUFFER, r.o.Ch);
                            k.bufferData(k.ARRAY_BUFFER, new Float32Array(g), k.STATIC_DRAW)
                        }
                    }
                    ;
                    "exit" == this.o.be ? this.o.a.onended = function() {
                        r.o.bh = !1;
                        r.o.Xc = !1;
                        r.U.removeChild(r.o.a);
                        r.o.a = null;
                        r.update()
                    }
                    : "stop" == this.o.be ? r.o.a.onended = function() {
                        r.update()
                    }
                    : "{" == this.o.be.charAt(0) ? this.o.a.onended = function() {
                        r.le(r.o.be, "$fwd")
                    }
                    : this.o.a.loop = !0;
                    for (h = 0; h < this.o.src.length; h++)
                        f = document.createElement("source"),
                        f.setAttribute("src", this.Wb(this.o.src[h])),
                        this.o.a.appendChild(f);
                    f = this.Ib("_videopanorama");
                    0 < f.length ? f[0].a = this.o.a : this.Sk("_videopanorama", this.o.a);
                    this.o.a.play()
                } else
                    "{" == this.o.be.charAt(0) && r.le(r.o.be, "$fwd");
            this.uj();
            this.B.Ad || this.ol();
            this.update();
            this.ce && (this.O && this.O.ggViewerInit && this.O.ggViewerInit(),
            this.qb.enabled && 0 == this.kb && this.Z && (this.ad(9),
            this.pan.c = this.lc.pan,
            this.j.c = this.lc.j,
            this.f.c = this.lc.f,
            this.Za = this.lc.Bb,
            this.D = this.Af(!1),
            this.pan.c = this.D.ja[0].value,
            this.j.c = this.D.ja[1].value,
            this.f.c = this.D.ja[2].value,
            3 == this.D.ja[3].vb && this.ad(this.D.ja[3].value),
            this.zb = this.D.Ta,
            this.B.jh = this.A.sb,
            this.B.Oh = this.A.Yc,
            this.B.eh = this.A.Qe,
            this.s.active = !1,
            this.s.Rg = !0));
            this.ce = !1;
            this.If = !0;
            this.dd()
        }
        ;
        b.prototype.Pi = function(a, b) {
            0 < a.length && (".xml" == a.substr(a.length - 4) || ".swf" == a.substr(a.length - 4) || "{" == a.charAt(0) ? this.le(this.Wb(a), b) : window.open(this.Wb(a), b))
        }
        ;
        b.prototype.zo = function() {
            this.If = this.isLoaded = !1;
            this.checkLoaded = this.Gb = [];
            this.ph = 0;
            this.O && this.O.ggReLoaded && this.O.ggReLoaded()
        }
        ;
        b.prototype.le = function(a, b) {
            if ("" != a && "{}" != a) {
                this.zo();
                this.Qa && this.Qa.hotspotProxyOut && this.Qa.hotspotProxyOut(this.ya.id);
                ".swf" == a.substr(a.length - 4) && (a = a.substr(0, a.length - 4) + ".xml");
                var c = "";
                b && (c = b.toString());
                c = c.replace("$cur", this.pan.c + "/" + this.j.c + "/" + this.f.c + "//" + this.xa());
                c = c.replace("$fwd", "N" + this.Ug() + "/" + this.j.c + "/" + this.f.c + "//" + this.xa());
                c = c.replace("$bwd", "S" + this.Ug() + "/" + this.j.c + "/" + this.f.c + "//" + this.xa());
                c = c.replace("$ap", String(this.pan.c));
                c = c.replace("$an", String(this.Ug()));
                c = c.replace("$at", String(this.j.c));
                c = c.replace("$af", String(this.f.c));
                c = c.replace("$ar", String(this.xa()));
                if ("" != c) {
                    var e = c.split("/");
                    3 < e.length && "" != e[3] && (this.startNode = e[3])
                }
                this.pa();
                if ("{" == a.charAt(0)) {
                    var e = a.substr(1, a.length - 2)
                      , f = this.Mg[e];
                    f && (e = f);
                    var f = this.B
                      , g = this.H;
                    if (this.te[e]) {
                        this.Gg = !0;
                        if (this.B.enabled && this.Z && this.B.Mb) {
                            f.ue || f.Ad || (f.jh = this.A.sb,
                            f.Oh = this.A.Yc,
                            f.eh = this.A.Qe,
                            this.fg(!0),
                            this.gg(!0),
                            this.eg(!0));
                            var h;
                            "wipeleftright" == f.type ? h = 1 : "wiperightleft" == f.type ? h = 2 : "wipetopbottom" == f.type ? h = 3 : "wipebottomtop" == f.type ? h = 4 : "wiperandom" == f.type && (h = Math.ceil(4 * Math.random()));
                            f.hi = h;
                            g.bindFramebuffer(g.FRAMEBUFFER, f.Mb);
                            g.viewport(0, 0, f.Mb.width, f.Mb.height);
                            g.clear(g.COLOR_BUFFER_BIT | g.DEPTH_BUFFER_BIT);
                            f.rg = !0;
                            this.ug();
                            f.rg = !1;
                            g.bindFramebuffer(g.FRAMEBUFFER, null);
                            g.viewport(0, 0, this.jb.width, this.jb.height);
                            h = new Date;
                            this.ya != this.pb ? (f.Ag = this.ya.gc / this.m.width,
                            f.Bg = 1 - this.ya.Cb / this.m.height) : (f.Ag = .5,
                            f.Bg = .5);
                            1 != f.Na && 2 != f.Na ? (f.ej = h.getTime(),
                            f.ue = !0) : (f.Jl = h.getTime(),
                            f.Ad = !0,
                            f.ob = Math.sin(this.Jb() / 2 * Math.PI / 180) / Math.sin(f.jf / 2 * Math.PI / 180),
                            f.ob = Math.max(f.ob, 1),
                            f.Il = 1 / f.Td * f.ob * .3)
                        }
                        this.Ti(this.te[e], c);
                        this.Zh(a);
                        f.enabled && this.Z && 0 != f.Nb && (f.qe = this.vi(),
                        f.re = this.xi(),
                        f.zd = this.Jb(),
                        f.bd = this.xa(),
                        1 == f.Nb || 3 == f.Nb ? this.jg(f.jf) : 2 == f.Nb ? this.jg(this.Bf() + (this.Bf() - f.jf)) : 4 == f.Nb && (this.ad(this.lc.Bb),
                        this.xh(this.lc.pan),
                        this.yh(this.lc.j),
                        this.jg(this.lc.f)),
                        f.kf || 1 == f.Na || 2 == f.Na || (4 == f.Nb ? (this.D = this.Af(!0, f.qe, f.re, f.zd),
                        this.zb = this.D.Ta,
                        this.s.active = !0,
                        this.qb.wd = !0) : this.moveTo(f.qe, f.re, f.zd, f.Td, 0, f.bd)));
                        this.ha && this.ha.openNext(a, c);
                        this.B.Ad || this.B.ue || (this.ga && this.di(),
                        this.Gg = !1)
                    } else {
                        this.Zc("invalid node id: " + e);
                        return
                    }
                } else
                    this.Qk(a, null, c);
                this.update(5)
            }
        }
        ;
        b.prototype.Nm = function() {
            return this.Of ? this.La.slice(0) : [""]
        }
        ;
        b.prototype.Pg = function(a) {
            var b, c;
            c = [];
            c.title = "";
            c.description = "";
            c.author = "";
            c.datetime = "";
            c.copyright = "";
            c.source = "";
            c.information = "";
            c.comment = "";
            c.latitude = 0;
            c.longitude = 0;
            c.customnodeid = "";
            c.tags = [];
            if (a && ((b = a.getAttributeNode("title")) && (c.title = b.nodeValue.toString()),
            (b = a.getAttributeNode("description")) && (c.description = b.nodeValue.toString()),
            (b = a.getAttributeNode("author")) && (c.author = b.nodeValue.toString()),
            (b = a.getAttributeNode("datetime")) && (c.datetime = b.nodeValue.toString()),
            (b = a.getAttributeNode("copyright")) && (c.copyright = b.nodeValue.toString()),
            (b = a.getAttributeNode("source")) && (c.source = b.nodeValue.toString()),
            (b = a.getAttributeNode("info")) && (c.information = b.nodeValue.toString()),
            (b = a.getAttributeNode("comment")) && (c.comment = b.nodeValue.toString()),
            (b = a.getAttributeNode("latitude")) && (c.latitude = Number(b.nodeValue)),
            (b = a.getAttributeNode("longitude")) && (c.longitude = Number(b.nodeValue)),
            (b = a.getAttributeNode("customnodeid")) && (c.customnodeid = b.nodeValue.toString()),
            b = a.getAttributeNode("tags"))) {
                a = b.nodeValue.toString().split("|");
                for (b = 0; b < a.length; b++)
                    "" == a[b] && (a.splice(b, 1),
                    b--);
                c.tags = a
            }
            return c
        }
        ;
        b.prototype.ui = function(a) {
            return a ? this.qj[a] ? this.qj[a] : this.Pg() : this.gf
        }
        ;
        b.prototype.Om = function(a) {
            a = this.ui(a);
            var b = [];
            "" != a.latitude && 0 != a.latitude && 0 != a.longitude && (b.push(a.latitude),
            b.push(a.longitude));
            return b
        }
        ;
        b.prototype.Pm = function(a) {
            return this.ui(a).title
        }
        ;
        b.prototype.Ke = function(a, b) {
            var c;
            for (c = 0; c < this.D.ja.length; c++)
                if (this.D.ja[c].time == a && this.D.ja[c].vb == b)
                    return this.D.ja[c];
            return !1
        }
        ;
        b.prototype.Mm = function(a) {
            var b, c = 1E5, e = a, f = !1;
            for (b = 0; b < this.D.ja.length; b++)
                this.D.ja[b].vb == a.vb && this.D.ja[b].time > a.time && this.D.ja[b].time < c && (e = this.D.ja[b],
                c = e.time,
                f = !0);
            return f ? e : !1
        }
        ;
        b.prototype.Af = function(a, b, c, e) {
            for (var f = 0; f < this.Ia.length; f++)
                if (this.Ia[f].Ta && 0 == this.Ia[f].Ta.indexOf("__FlyIn"))
                    return this.Ia[f];
            f = new m.uk;
            f.Ta = "__FlyIn";
            f.lg = this.pan.c;
            f.ng = this.j.c;
            f.yd = this.f.c;
            f.mg = this.Za;
            f.bd = this.oh;
            a ? (f.He = !1,
            f.$d = !1,
            f.speed = this.B.Td,
            f.Rd = b,
            f.Sd = c,
            f.bf = e) : (f.He = !0,
            f.$d = !0,
            f.speed = this.qb.speed,
            f.Rd = this.pan.Pa,
            f.Sd = this.j.Pa,
            f.bf = this.f.Pa);
            return this.Uj(f)
        }
        ;
        b.prototype.Uj = function(a) {
            var b = new m.Ek;
            b.Ta = a.Ta;
            b.ja = [];
            var c = a.mg != a.bd && -1 != a.bd
              , e = a.Rd - a.lg;
            if (360 == this.pan.max - this.pan.min) {
                for (; -360 > e; )
                    e += 360;
                for (; 360 < e; )
                    e -= 360
            }
            var f = a.Sd - a.ng
              , g = a.bf - a.yd
              , h = Math.round(Math.sqrt(e * e + f * f + g * g) / a.speed * .33);
            c && (h = Math.max(10, h));
            b.length = h;
            var k, A;
            a.ae && (k = Math.ceil(.7 * h),
            k = Math.min(15, k),
            k = Math.max(5, k),
            b.length = h + k,
            A = .33 * k);
            var n = a.bf
              , r = h
              , p = 0
              , u = h - 1;
            if (c) {
                var t = a.yd, v;
                4 == a.bd ? v = 120 : v = this.Cf(a.bd);
                var n = a.bf
                  , g = n - a.yd
                  , q = new m.kc(0,a.yd)
                  , w = new m.kc(h,n)
                  , B = new m.kc
                  , z = new m.kc;
                z.Ya(h / 3, a.yd + g / 3);
                B.Ya(2 * h / 3, n - g / 3);
                if (t > v)
                    for (; p <= h && t > v; )
                        t = new m.kc,
                        t.Vh(q, w, z, B, p),
                        t = t.y,
                        p++;
                else
                    p = 1;
                p >= .8 * h && (r = p = Math.round(.8 * h));
                0 == p && (p = 1);
                var y;
                4 == a.mg ? y = 120 : y = this.Cf(a.mg);
                v = a.bf;
                if (v > y)
                    for (; u > p && v > y; )
                        t = new m.kc,
                        t.Vh(q, w, z, B, u),
                        v = t.y,
                        u--
            }
            q = new m.yc;
            q.time = 0;
            q.vb = 0;
            q.value = a.lg;
            q.type = 1;
            q.Xd = h / 3;
            q.Yd = a.He ? a.lg : a.lg + e / 3;
            b.ja.push(q);
            q = new m.yc;
            q.time = 0;
            q.vb = 1;
            q.value = a.ng;
            q.type = 1;
            q.Xd = h / 3;
            q.Yd = a.He ? a.ng : a.ng + f / 3;
            b.ja.push(q);
            q = new m.yc;
            q.time = 0;
            q.vb = 2;
            q.value = a.yd;
            q.type = 1;
            q.Xd = h / 3;
            q.Yd = a.He ? a.yd : a.yd + g / 3;
            b.ja.push(q);
            q = new m.yc;
            q.time = 0;
            q.vb = 3;
            q.value = a.mg;
            q.type = 0;
            q.nb = 0;
            b.ja.push(q);
            c && (q = new m.yc,
            q.time = p,
            q.vb = 3,
            q.value = a.bd,
            q.type = 0,
            q.nb = u - p,
            b.ja.push(q));
            q = new m.yc;
            q.time = h;
            q.vb = 0;
            q.value = a.Rd;
            q.type = 1;
            q.Wd = 2 * h / 3;
            a.$d && !a.ae ? q.Jc = a.Rd : q.Jc = a.Rd - e / 3;
            a.ae && (q.Xd = h + A,
            q.Yd = q.value + A / h * e);
            b.ja.push(q);
            q = new m.yc;
            q.time = h;
            q.vb = 1;
            q.value = a.Sd;
            q.type = 1;
            q.Wd = 2 * h / 3;
            a.$d && !a.ae ? q.Jc = a.Sd : q.Jc = a.Sd - f / 3;
            a.ae && (q.Xd = h + A,
            q.Yd = q.value + A / h * f);
            b.ja.push(q);
            q = new m.yc;
            q.time = r;
            q.vb = 2;
            q.value = n;
            q.type = 1;
            q.Wd = 2 * r / 3;
            a.$d ? q.Jc = n : q.Jc = n - g / 3;
            b.ja.push(q);
            a.ae && (q = new m.yc,
            q.time = h + k,
            q.vb = 0,
            q.value = a.Rd,
            q.type = 1,
            q.Wd = h + k - A,
            q.Jc = a.Rd,
            b.ja.push(q),
            q = new m.yc,
            q.time = h + k,
            q.vb = 1,
            q.value = a.Sd,
            q.type = 1,
            q.Wd = h + k - A,
            q.Jc = a.Sd,
            b.ja.push(q));
            this.Ia.push(b);
            return b
        }
        ;
        b.prototype.Xo = function() {
            this.o.a && this.o.a.play()
        }
        ;
        b.prototype.Yo = function() {
            this.o.a && (this.o.a.pause(),
            this.o.a.currentTime = 0)
        }
        ;
        b.prototype.Wo = function() {
            this.o.a && this.o.a.pause()
        }
        ;
        b.prototype.oo = function(a) {
            this.o.a && (0 > a && (a = 0),
            a > this.o.a.duration && (a = this.o.a.duration - .1),
            this.o.a.currentTime = a,
            this.update())
        }
        ;
        b.prototype.an = function() {
            return this.o.a ? this.o.a.currentTime : 0
        }
        ;
        b.prototype.$m = function() {
            if (this.o.a)
                return this.o.a
        }
        ;
        b.prototype.no = function(a) {
            if (this.o.a) {
                var b = !this.o.a.paused && !this.o.a.ended
                  , c = this.o.a.currentTime;
                this.o.a.pause();
                isNaN(parseInt(a, 10)) ? this.o.a.src = String(a) : this.o.a.src = this.o.src[parseInt(a, 10)];
                b && (this.o.a.onloadedmetadata = function() {
                    this.currentTime = c;
                    this.play();
                    this.onloadedmetadata = null
                }
                );
                this.o.a.currentTime = c
            }
        }
        ;
        b.prototype.tm = function() {
            this.Jk = !0
        }
        ;
        return b
    }();
    m.b = g
}
)(ggP2VR || (ggP2VR = {}));
window.ggHasHtml5Css3D = G;
window.ggHasWebGL = N;
window.pano2vrPlayer = ggP2VR.b;
ggP2VR.b.prototype.readConfigString = ggP2VR.b.prototype.Ui;
ggP2VR.b.prototype.readConfigUrl = ggP2VR.b.prototype.Qk;
ggP2VR.b.prototype.readConfigUrlAsync = ggP2VR.b.prototype.On;
ggP2VR.b.prototype.readConfigXml = ggP2VR.b.prototype.Rk;
ggP2VR.b.prototype.openUrl = ggP2VR.b.prototype.Pi;
ggP2VR.b.prototype.openNext = ggP2VR.b.prototype.le;
ggP2VR.b.prototype.setMargins = ggP2VR.b.prototype.$n;
ggP2VR.b.prototype.addListener = ggP2VR.b.prototype.addListener;
ggP2VR.b.prototype.removeEventListener = ggP2VR.b.prototype.removeEventListener;
ggP2VR.b.prototype.detectBrowser = ggP2VR.b.prototype.Kj;
ggP2VR.b.prototype.initWebGL = ggP2VR.b.prototype.Bc;
ggP2VR.b.prototype.getPercentLoaded = ggP2VR.b.prototype.Sm;
ggP2VR.b.prototype.setBasePath = ggP2VR.b.prototype.Un;
ggP2VR.b.prototype.getBasePath = ggP2VR.b.prototype.Am;
ggP2VR.b.prototype.setViewerSize = ggP2VR.b.prototype.fl;
ggP2VR.b.prototype.getViewerSize = ggP2VR.b.prototype.dn;
ggP2VR.b.prototype.setSkinObject = ggP2VR.b.prototype.lo;
ggP2VR.b.prototype.changeViewMode = ggP2VR.b.prototype.im;
ggP2VR.b.prototype.getViewMode = ggP2VR.b.prototype.bn;
ggP2VR.b.prototype.changePolygonMode = ggP2VR.b.prototype.Bj;
ggP2VR.b.prototype.setPolygonMode = ggP2VR.b.prototype.Bj;
ggP2VR.b.prototype.getPolygonMode = ggP2VR.b.prototype.Um;
ggP2VR.b.prototype.showOnePolyHotspot = ggP2VR.b.prototype.hl;
ggP2VR.b.prototype.hideOnePolyHotspot = ggP2VR.b.prototype.hk;
ggP2VR.b.prototype.changePolyHotspotColor = ggP2VR.b.prototype.gm;
ggP2VR.b.prototype.toggleOnePolyHotspot = ggP2VR.b.prototype.Go;
ggP2VR.b.prototype.changeViewState = ggP2VR.b.prototype.jm;
ggP2VR.b.prototype.getViewState = ggP2VR.b.prototype.cn;
ggP2VR.b.prototype.setRenderFlags = ggP2VR.b.prototype.bo;
ggP2VR.b.prototype.getRenderFlags = ggP2VR.b.prototype.Xm;
ggP2VR.b.prototype.setMaxTileCount = ggP2VR.b.prototype.dl;
ggP2VR.b.prototype.getVFov = ggP2VR.b.prototype.Jb;
ggP2VR.b.prototype.setVFov = ggP2VR.b.prototype.jg;
ggP2VR.b.prototype.getHFov = ggP2VR.b.prototype.Dm;
ggP2VR.b.prototype.updatePanorama = ggP2VR.b.prototype.ug;
ggP2VR.b.prototype.isTouching = ggP2VR.b.prototype.kn;
ggP2VR.b.prototype.getIsMobile = ggP2VR.b.prototype.Hm;
ggP2VR.b.prototype.setIsMobile = ggP2VR.b.prototype.Yn;
ggP2VR.b.prototype.getIsAutorotating = ggP2VR.b.prototype.Fm;
ggP2VR.b.prototype.getIsLoaded = ggP2VR.b.prototype.Tg;
ggP2VR.b.prototype.getIsTileLoading = ggP2VR.b.prototype.Im;
ggP2VR.b.prototype.getLastActivity = ggP2VR.b.prototype.Jm;
ggP2VR.b.prototype.getPan = ggP2VR.b.prototype.vi;
ggP2VR.b.prototype.getPanNorth = ggP2VR.b.prototype.Ug;
ggP2VR.b.prototype.getPanDest = ggP2VR.b.prototype.Qm;
ggP2VR.b.prototype.getPanN = ggP2VR.b.prototype.Rm;
ggP2VR.b.prototype.setPan = ggP2VR.b.prototype.xh;
ggP2VR.b.prototype.setPanNorth = ggP2VR.b.prototype.aj;
ggP2VR.b.prototype.changePan = ggP2VR.b.prototype.Eg;
ggP2VR.b.prototype.changePanLog = ggP2VR.b.prototype.fm;
ggP2VR.b.prototype.getTilt = ggP2VR.b.prototype.xi;
ggP2VR.b.prototype.getTiltDest = ggP2VR.b.prototype.Zm;
ggP2VR.b.prototype.setTilt = ggP2VR.b.prototype.yh;
ggP2VR.b.prototype.changeTilt = ggP2VR.b.prototype.Fg;
ggP2VR.b.prototype.changeTiltLog = ggP2VR.b.prototype.hm;
ggP2VR.b.prototype.getFov = ggP2VR.b.prototype.Bf;
ggP2VR.b.prototype.getFovDest = ggP2VR.b.prototype.Cm;
ggP2VR.b.prototype.setFov = ggP2VR.b.prototype.dg;
ggP2VR.b.prototype.changeFov = ggP2VR.b.prototype.Aj;
ggP2VR.b.prototype.changeFovLog = ggP2VR.b.prototype.rf;
ggP2VR.b.prototype.getRoll = ggP2VR.b.prototype.Ym;
ggP2VR.b.prototype.setRoll = ggP2VR.b.prototype.co;
ggP2VR.b.prototype.setPanTilt = ggP2VR.b.prototype.ao;
ggP2VR.b.prototype.setPanTiltFov = ggP2VR.b.prototype.hg;
ggP2VR.b.prototype.setDefaultView = ggP2VR.b.prototype.Wn;
ggP2VR.b.prototype.setLocked = ggP2VR.b.prototype.Zn;
ggP2VR.b.prototype.setLockedMouse = ggP2VR.b.prototype.fg;
ggP2VR.b.prototype.setLockedKeyboard = ggP2VR.b.prototype.eg;
ggP2VR.b.prototype.setLockedWheel = ggP2VR.b.prototype.gg;
ggP2VR.b.prototype.moveTo = ggP2VR.b.prototype.moveTo;
ggP2VR.b.prototype.moveToEx = ggP2VR.b.prototype.kh;
ggP2VR.b.prototype.moveToDefaultView = ggP2VR.b.prototype.sn;
ggP2VR.b.prototype.moveToDefaultViewEx = ggP2VR.b.prototype.tn;
ggP2VR.b.prototype.addHotspotElements = ggP2VR.b.prototype.uj;
ggP2VR.b.prototype.playSound = ggP2VR.b.prototype.ne;
ggP2VR.b.prototype.playPauseSound = ggP2VR.b.prototype.Ok;
ggP2VR.b.prototype.playStopSound = ggP2VR.b.prototype.Mn;
ggP2VR.b.prototype.pauseSound = ggP2VR.b.prototype.Qi;
ggP2VR.b.prototype.activateSound = ggP2VR.b.prototype.Vl;
ggP2VR.b.prototype.soundGetTime = ggP2VR.b.prototype.uo;
ggP2VR.b.prototype.soundSetTime = ggP2VR.b.prototype.vo;
ggP2VR.b.prototype.isPlaying = ggP2VR.b.prototype.Cc;
ggP2VR.b.prototype.stopSound = ggP2VR.b.prototype.gj;
ggP2VR.b.prototype.setVolume = ggP2VR.b.prototype.po;
ggP2VR.b.prototype.changeVolume = ggP2VR.b.prototype.km;
ggP2VR.b.prototype.removeHotspots = ggP2VR.b.prototype.Wk;
ggP2VR.b.prototype.addHotspot = ggP2VR.b.prototype.Wl;
ggP2VR.b.prototype.updateHotspot = ggP2VR.b.prototype.Oo;
ggP2VR.b.prototype.removeHotspot = ggP2VR.b.prototype.Pn;
ggP2VR.b.prototype.setActiveHotspot = ggP2VR.b.prototype.$e;
ggP2VR.b.prototype.getPointHotspotIds = ggP2VR.b.prototype.Tm;
ggP2VR.b.prototype.getHotspot = ggP2VR.b.prototype.Em;
ggP2VR.b.prototype.setFullscreen = ggP2VR.b.prototype.af;
ggP2VR.b.prototype.toggleFullscreen = ggP2VR.b.prototype.Gh;
ggP2VR.b.prototype.enterFullscreen = ggP2VR.b.prototype.um;
ggP2VR.b.prototype.exitFullscreen = ggP2VR.b.prototype.exitFullscreen;
ggP2VR.b.prototype.getIsFullscreen = ggP2VR.b.prototype.Gm;
ggP2VR.b.prototype.startAutorotate = ggP2VR.b.prototype.ll;
ggP2VR.b.prototype.stopAutorotate = ggP2VR.b.prototype.Bo;
ggP2VR.b.prototype.toggleAutorotate = ggP2VR.b.prototype.Fo;
ggP2VR.b.prototype.startAnimation = ggP2VR.b.prototype.yo;
ggP2VR.b.prototype.createLayers = ggP2VR.b.prototype.Ej;
ggP2VR.b.prototype.removePanorama = ggP2VR.b.prototype.th;
ggP2VR.b.prototype.getScreenResolution = ggP2VR.b.prototype.bk;
ggP2VR.b.prototype.getMaxScreenResolution = ggP2VR.b.prototype.Yj;
ggP2VR.b.prototype.getNodeIds = ggP2VR.b.prototype.Nm;
ggP2VR.b.prototype.getNodeUserdata = ggP2VR.b.prototype.ui;
ggP2VR.b.prototype.getNodeLatLng = ggP2VR.b.prototype.Om;
ggP2VR.b.prototype.getNodeTitle = ggP2VR.b.prototype.Pm;
ggP2VR.b.prototype.getCurrentNode = ggP2VR.b.prototype.Xj;
ggP2VR.b.prototype.getNextNode = ggP2VR.b.prototype.Zj;
ggP2VR.b.prototype.getPrevNode = ggP2VR.b.prototype.Wm;
ggP2VR.b.prototype.getLastVisitedNode = ggP2VR.b.prototype.Km;
ggP2VR.b.prototype.getCurrentPointHotspots = ggP2VR.b.prototype.Bm;
ggP2VR.b.prototype.getPositionAngles = ggP2VR.b.prototype.Vm;
ggP2VR.b.prototype.getPositionRawAngles = ggP2VR.b.prototype.$j;
ggP2VR.b.prototype.nodeVisited = ggP2VR.b.prototype.xn;
ggP2VR.b.prototype.setElementIdPrefix = ggP2VR.b.prototype.Xn;
ggP2VR.b.prototype.videoPanoPlay = ggP2VR.b.prototype.Xo;
ggP2VR.b.prototype.videoPanoStop = ggP2VR.b.prototype.Yo;
ggP2VR.b.prototype.videoPanoPause = ggP2VR.b.prototype.Wo;
ggP2VR.b.prototype.getVideoPanoTime = ggP2VR.b.prototype.an;
ggP2VR.b.prototype.setVideoPanoTime = ggP2VR.b.prototype.oo;
ggP2VR.b.prototype.getVideoPanoObject = ggP2VR.b.prototype.$m;
ggP2VR.b.prototype.setVideoPanoSource = ggP2VR.b.prototype.no;
ggP2VR.b.prototype.getMediaObject = ggP2VR.b.prototype.Lm;
ggP2VR.b.prototype.registerVideoElement = ggP2VR.b.prototype.Sk;
ggP2VR.b.prototype.disableSoundLoading = ggP2VR.b.prototype.tm;
ggP2VR.b.prototype.setCrossOrigin = ggP2VR.b.prototype.Vn;
ggP2VR.b.prototype.setProjection = ggP2VR.b.prototype.ad;
ggP2VR.b.prototype.getProjection = ggP2VR.b.prototype.xa;
ggP2VR.b.prototype.changeProjection = ggP2VR.b.prototype.$h;
ggP2VR.b.prototype.changeProjectionEx = ggP2VR.b.prototype.$h;
ggP2VR.b.prototype.changeLensflares = ggP2VR.b.prototype.em;
ggP2VR.b.prototype.setTransition = ggP2VR.b.prototype.mo;
