var the_widget_dragged;
(function(e) {
    function t(e, t, i) {
        return e > t && t + i > e
    }
    e.widget("ui.droppable", {
        version: "1.10.4",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function() {
            var t, i = this.options,
                s = i.accept;
            this.isover = !1, this.isout = !0, this.accept = e.isFunction(s) ? s : function(e) {
                return e.is(s)
            }, this.proportions = function() {
                return arguments.length ? (t = arguments[0], undefined) : t ? t : t = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }
            }, e.ui.ddmanager.droppables[i.scope] = e.ui.ddmanager.droppables[i.scope] || [], e.ui.ddmanager.droppables[i.scope].push(this), i.addClasses && this.element.addClass("ui-droppable")
        },
        _destroy: function() {
            for (var t = 0, i = e.ui.ddmanager.droppables[this.options.scope]; i.length > t; t++) i[t] === this && i.splice(t, 1);
            this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption: function(t, i) {
            "accept" === t && (this.accept = e.isFunction(i) ? i : function(e) {
                return e.is(i)
            }), e.Widget.prototype._setOption.apply(this, arguments)
        },
        _activate: function(t) {
            var i = e.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", t, this.ui(i))
        },
        _deactivate: function(t) {
            var i = e.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), i && this._trigger("deactivate", t, this.ui(i))
        },
        _over: function(t) {
            var i = e.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", t, this.ui(i)))
        },
        _out: function(t) {
            var i = e.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", t, this.ui(i)))
        },
        _drop: function(t, i) {
            var s = i || e.ui.ddmanager.current,
                n = !1;
            return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                var t = e.data(this, "ui-droppable");
                return t.options.greedy && !t.options.disabled && t.options.scope === s.options.scope && t.accept.call(t.element[0], s.currentItem || s.element) && e.ui.intersect(s, e.extend(t, {
                    offset: t.element.offset()
                }), t.options.tolerance) ? (n = !0, !1) : undefined
            }), n ? !1 : this.accept.call(this.element[0], s.currentItem || s.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", t, this.ui(s)), this.element) : !1) : !1
        },
        ui: function(e) {
            return {
                draggable: e.currentItem || e.element,
                helper: e.helper,
                position: e.position,
                offset: e.positionAbs
            }
        }
    }), e.ui.intersect = function(e, i, s) {
        if (!i.offset) return !1;
        var n, a, o = (e.positionAbs || e.position.absolute).left,
            r = (e.positionAbs || e.position.absolute).top,
            h = o + e.helperProportions.width,
            l = r + e.helperProportions.height,
            u = i.offset.left,
            c = i.offset.top,
            d = u + i.proportions().width,
            p = c + i.proportions().height;
        switch (s) {
            case "fit":
                return o >= u && d >= h && r >= c && p >= l;
            case "intersect":
                return o + e.helperProportions.width / 2 > u && d > h - e.helperProportions.width / 2 && r + e.helperProportions.height / 2 > c && p > l - e.helperProportions.height / 2;
            case "pointer":
                return n = (e.positionAbs || e.position.absolute).left + (e.clickOffset || e.offset.click).left, a = (e.positionAbs || e.position.absolute).top + (e.clickOffset || e.offset.click).top, t(a, c, i.proportions().height) && t(n, u, i.proportions().width);
            case "touch":
                return (r >= c && p >= r || l >= c && p >= l || c > r && l > p) && (o >= u && d >= o || h >= u && d >= h || u > o && h > d);
            default:
                return !1
        }
    }, e.ui.ddmanager = {
        current: null,
        droppables: {
            "default": []
        },
        prepareOffsets: function(t, i) {
            var s, n, a = e.ui.ddmanager.droppables[t.options.scope] || [],
                o = i ? i.type : null,
                r = (t.currentItem || t.element).find(":data(ui-droppable)").addBack();
            e: for (s = 0; a.length > s; s++)
                if (!(a[s].options.disabled || t && !a[s].accept.call(a[s].element[0], t.currentItem || t.element))) {
                    for (n = 0; r.length > n; n++)
                        if (r[n] === a[s].element[0]) {
                            a[s].proportions().height = 0;
                            continue e
                        }
                    a[s].visible = "none" !== a[s].element.css("display"), a[s].visible && ("mousedown" === o && a[s]._activate.call(a[s], i), a[s].offset = a[s].element.offset(), a[s].proportions({
                        width: a[s].element[0].offsetWidth,
                        height: a[s].element[0].offsetHeight
                    }))
                }
        },
        drop: function(t, i) {
            var s = !1;
            return e.each((e.ui.ddmanager.droppables[t.options.scope] || []).slice(), function() {
                this.options && (!this.options.disabled && this.visible && e.ui.intersect(t, this, this.options.tolerance) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], t.currentItem || t.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))
            }), s
        },
        dragStart: function(t, i) {
            t.element.parentsUntil("body").bind("scroll.droppable", function() {
                t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, i)
            })
        },
        drag: function(t, i) {
            t.options.refreshPositions && e.ui.ddmanager.prepareOffsets(t, i), e.each(e.ui.ddmanager.droppables[t.options.scope] || [], function() {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var s, n, a, o = e.ui.intersect(t, this, this.options.tolerance),
                        r = !o && this.isover ? "isout" : o && !this.isover ? "isover" : null;
                    r && (this.options.greedy && (n = this.options.scope, a = this.element.parents(":data(ui-droppable)").filter(function() {
                        return e.data(this, "ui-droppable").options.scope === n
                    }), a.length && (s = e.data(a[0], "ui-droppable"), s.greedyChild = "isover" === r)), s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)))
                }
            })
        },
        dragStop: function(t, i) {
            t.element.parentsUntil("body").unbind("scroll.droppable"), t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, i)
        }
    }
})(jQuery);
var wpWidgets;
! function(a) {
    wpWidgets = {
        init: function() {
            var b, c, d = this,
                e = a(".widgets-chooser"),
                f = e.find(".widgets-chooser-sidebars"),
                g = a("div.widgets-sortables"),
                h = !("undefined" == typeof isRtl || !isRtl);
            a("#widgets-right .sidebar-name").click(function() {
                var b = a(this),
                    c = b.closest(".widgets-holder-wrap");
                c.hasClass("closed") ? (c.removeClass("closed"), b.parent().sortable("refresh")) : c.addClass("closed")
            }), a("#widgets-left .sidebar-name").click(function() {
                a(this).closest(".widgets-holder-wrap").toggleClass("closed")
            }), a(document.body).bind("click.widgets-toggle", function(b) {
                var c, d, e, f, g, i = a(b.target),
                    j = {
                        "z-index": 100
                    };
                i.parents(".widget-top").length && !i.parents("#available-widgets").length ? (c = i.closest("div.widget"), d = c.children(".widget-inside"), e = parseInt(c.find("input.widget-width").val(), 10), f = c.parent().width(), d.is(":hidden") ? (e > 250 && e + 30 > f && c.closest("div.widgets-sortables").length && (g = c.closest("div.widget-liquid-right").length ? h ? "margin-right" : "margin-left" : h ? "margin-left" : "margin-right", j[g] = f - (e + 30) + "px", c.css(j)), d.slideDown(1050,"easeOutQuint")) : d.slideUp(1050,"easeOutQuint", function() {
                    c.attr("style", "")
                }), b.preventDefault()) : i.hasClass("widget-control-save") ? (wpWidgets.save(i.closest("div.widget"), 0, 1, 0), b.preventDefault()) : i.hasClass("widget-control-remove") ? (wpWidgets.save(i.closest("div.widget"), 1, 1, 0), b.preventDefault()) : i.hasClass("widget-control-close") && (wpWidgets.close(i.closest("div.widget")), b.preventDefault())
            }), g.children(".widget").each(function() {
                var b = a(this);
                wpWidgets.appendTitle(this), b.find("p.widget-error").length && b.find("a.widget-action").trigger("click")
            }), a("#widget-list").children(".widget").draggable({
                connectToSortable: "div.widgets-sortables",
                handle: "> .widget-top > .widget-title",
                distance: 2,
                helper: "clone",
                zIndex: 100,
                containment: "document",
                start: function(b, e) {
                    var f = a(this).find(".widgets-chooser");
                    e.helper.find("div.widget-description").hide(), c = this.id, f.length && (a("#wpbody-content").append(f.hide()), e.helper.find(".widgets-chooser").remove(), d.clearWidgetSelection())
                },
                stop: function() {
                    b && a(b).hide(), b = ""
                }
            }), g.sortable({
                placeholder: "widget-placeholder",
                items: "> .widget",
                handle: "> .widget-top > .widget-title",
                cursor: "move",
                distance: 2,
                containment: "document",
                start: function(b, c) {
                    var d, e = a(this),
                        f = e.parent(),
                        g = c.item.children(".widget-inside");
                    "block" === g.css("display") && (g.hide(), a(this).sortable("refreshPositions")), f.hasClass("closed") || (d = c.item.hasClass("ui-draggable") ? e.height() : 1 + e.height(), e.css("min-height", d + "px"))
                },
                stop: function(d, e) {
                    var f, g, h, i, j, k, l = e.item,
                        m = c;
					
                    return l.hasClass("deleting") ? (wpWidgets.save(l, 1, 0, 1), void l.remove()) : (f = l.find("input.add_new").val(), g = l.find("input.multi_number").val(), l.attr("style", "").removeClass("ui-draggable"), c = "", f && ("multi" === f ? (l.html(l.html().replace(/<[^<>]+>/g, function(a) {
                        return a.replace(/__i__|%i%/g, g)
                    })), l.attr("id", m.replace("__i__", g)), g++, a("div#" + m).find("input.multi_number").val(g)) : "single" === f && (l.attr("id", "new-" + m), b = "div#" + m), wpWidgets.save(l, 0, 0, 1), l.find("input.add_new").val(""), a(document).trigger("widget-added", [l])), h = l.parent(), h.parent().hasClass("closed") && (h.parent().removeClass("closed"), i = h.children(".widget"), i.length > 1 && (j = i.get(0), k = l.get(0), j.id && k.id && j.id !== k.id && a(j).before(l))), void(f ? l.find("a.widget-action").trigger("click") : wpWidgets.saveOrder(h.attr("id"))))
                },
                activate: function() {
                    a(this).parent().addClass("widget-hover")
                },
                deactivate: function() {
                    a(this).css("min-height", "").parent().removeClass("widget-hover")
                },
                receive: function(b, c) {
                    var d = a(c.sender);
                    return this.id.indexOf("orphaned_widgets") > -1 ? void d.sortable("cancel") : void(d.attr("id").indexOf("orphaned_widgets") > -1 && !d.children(".widget").length && d.parents(".orphan-sidebar").slideUp(400, function() {
                        a(this).remove()
                    }))
                }
            }).sortable("option", "connectWith", "div.widgets-sortables"), a("#available-widgets").droppable({
                tolerance: "pointer",
                accept: function(b) {
                    return "widget-list" !== a(b).parent().attr("id")
                },
                drop: function(b, c) {
                    c.draggable.addClass("deleting"), a("#removing-widget").hide().children("span").html("")
                },
                over: function(b, c) {
                    c.draggable.addClass("deleting"), a("div.widget-placeholder").hide(), c.draggable.hasClass("ui-sortable-helper") && a("#removing-widget").show().children("span").html(c.draggable.find("div.widget-title").children("h4").html())
                },
                out: function(b, c) {
                    c.draggable.removeClass("deleting"), a("div.widget-placeholder").show(), a("#removing-widget").hide().children("span").html("")
                }
            }), a("#widgets-right .widgets-holder-wrap").each(function(b, c) {
                var d = a(c),
                    e = d.find(".sidebar-name h3").text(),
                    g = d.find(".widgets-sortables").attr("id"),
                    h = a('<li tabindex="0">').text(a.trim(e));
                0 === b && h.addClass("widgets-chooser-selected"), f.append(h), h.data("sidebarId", g)
            }), a("#available-widgets .widget .widget-title").on("click.widgets-chooser", function() {
                var b = a(this).closest(".widget");
                b.hasClass("widget-in-question") || a("#widgets-left").hasClass("chooser") ? d.closeChooser() : (d.clearWidgetSelection(), a("#widgets-left").addClass("chooser1"), b.addClass("widget-in-question0").children(".widget-description").after(e), e.slideDown(1050,"easeOutQuint", function() {
                    f.find(".widgets-chooser-selected").focus()
                }), f.find("li").on("focusin.widgets-chooser", function() {
                    f.find(".widgets-chooser-selected").removeClass("widgets-chooser-selected"), a(this).addClass("widgets-chooser-selected")
                }))
            }), e.on("click.widgets-chooser", function(b) {
                var c = a(b.target);
                c.hasClass("button-primary") ? (d.addWidget(e), d.closeChooser()) : c.hasClass("button-secondary") && d.closeChooser()
            }).on("keyup.widgets-chooser", function(b) {
                b.which === a.ui.keyCode.ENTER ? a(b.target).hasClass("button-secondary") ? d.closeChooser() : (d.addWidget(e), d.closeChooser()) : b.which === a.ui.keyCode.ESCAPE && d.closeChooser()
            })
        },
        saveOrder: function(b) {
            var c = {
                action: "widgets-order",
                savewidgets: a("#_wpnonce_widgets").val(),
				csrf_minetoken_name:$.cookie('csrf_minecookie_name'),
                sidebars: []
            };
            b && a("#" + b).find(".spinner:first").css("display", "inline-block"), 
			a("div.widgets-sortables").each(function() {
                a(this).sortable && 
				(c["sidebars[" + a(this).attr("id") + "]"] = a(this).sortable("toArray").join(","))
				_widgets = new Array();
				for(k=0;k < $("#"+a(this).attr("id")).children(".widget").length;k++){
					_widget = $("#"+a(this).attr("id")).children(".widget").eq(k);
					_widgets.push(_widget.find(".widget-type").eq(0).val()+"&#"+_widget.find(".widget-id").eq(0).val());
				}
				c["sidebars[" + a(this).attr("id") + "]"] = _widgets.join(",")
            }),
			 a.post(ajaxurl, c, function() {
                a(".spinner").hide();
            })
        },
        save: function(b, c, d, e) {
			the_widget_dragged = b;
            var f, g = b.closest("div.widgets-sortables").attr("id"),
                h = b.find("form").serialize();
            b = a(b), a(".spinner", b).show(), f = {
                action: "save-widget",
				csrf_minetoken_name:$.cookie('csrf_minecookie_name'),
                savewidgets: a("#_wpnonce_widgets").val(),
                sidebar: g
            }, c && (f.delete_widget = 1), h += "&" + a.param(f), a.post(ajaxurl, h, function(f) {
				the_widget_dragged.find(".widget-id").eq(0).val(f);
                var g;
                c ? (a("input.widget_number", b).val() || (g = a("input.widget-id", b).val(), a("#available-widgets").find("input.widget-id").each(function() {
					
                    a(this).val() === g && a(this).closest("div.widget").show()
                })), d ? (e = 0, b.slideUp(1050,"easeOutQuint", function() {
                    a(this).remove(), wpWidgets.saveOrder()
                })) : b.remove()) : (a(".spinner").hide(), f && f.length > 2 && (wpWidgets.appendTitle(b), a(document).trigger("widget-updated", [b]))), e && wpWidgets.saveOrder()
            })
        },
        appendTitle: function(b) {
            var c = a('input[id*="-title"]', b).val() || "";
            c && (c = ": " + c.replace(/<[^<>]+>/g, "").replace(/</g, "&lt;").replace(/>/g, "&gt;")), a(b).children(".widget-top").children(".widget-title").children().children(".in-widget-title").html(c)
        },
        close: function(a) {
            a.children(".widget-inside").slideUp(1050,"easeOutQuint", function() {
                a.attr("style", "")
            })
        },
        addWidget: function(b) {
            var c, d, e, f, g, h, i, j = b.find(".widgets-chooser-selected").data("sidebarId"),
                k = a("#" + j);
            c = a("#available-widgets").find(".widget-in-question").clone(), d = c.attr("id"), e = c.find("input.add_new").val(), f = c.find("input.multi_number").val(), c.find(".widgets-chooser").remove(), "multi" === e ? (c.html(c.html().replace(/<[^<>]+>/g, function(a) {
                return a.replace(/__i__|%i%/g, f)
            })), c.attr("id", d.replace("__i__", f)), f++, a("#" + d).find("input.multi_number").val(f)) : "single" === e && (c.attr("id", "new-" + d), a("#" + d).hide()), k.closest(".widgets-holder-wrap").removeClass("closed"), k.append(c), k.sortable("refresh"), wpWidgets.save(c, 0, 0, 1), c.find("input.add_new").val(""), a(document).trigger("widget-added", [c]), g = a(window).scrollTop(), h = g + a(window).height(), i = k.offset(), i.bottom = i.top + k.outerHeight(), (g > i.bottom || h < i.top) && a("html, body").animate({
                scrollTop: i.top - 130
            }, 200), window.setTimeout(function() {
                c.find(".widget-title").trigger("click")
            }, 250)
        },
        closeChooser: function() {
            var b = this;
            a(".widgets-chooser").slideUp(200, function() {
				
                a("#wpbody-content").append(this), b.clearWidgetSelection()
            })
        },
        clearWidgetSelection: function() {
            a("#widgets-left").removeClass("chooser"), a(".widget-in-question").removeClass("widget-in-question")
        }
    }, a(document).ready(function() {
        wpWidgets.init()
    })
}(jQuery);
jQuery(document).ready(function (){	
	jQuery("span.spinner").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
});