/* License http://www.gnu.org/licenses/gpl.html GNU/GPL */


(function (d) {
    var a = function () {};
    d.extend(a.prototype, {
        name: "accordionMenu",
        options: {
            display: null,
            collapseall: false,
            toggler : "li.level1 div.toggler",
            submenu : "ul.level2",
            arrow   : "li.level1 div.toggler span.arrow"
        },
        initialize: function (a, b) {
            var b = d.extend({}, this.options, b),
                c = a.find(b.toggler),
                r = a.find(b.arrow);

            r.each(function (h) {
                var a = d(this),
                    c = a.parent().next(b.submenu).wrap("<div>").parent();
                
                c.data("height", c.height());
                a.parent().hasClass("active") || h == b.display ? c.show() : c.hide().css("height", 0);

                a.bind("click", function () {
                    f(h)
                })
            });
            var f = function (b) {

                var a = d(r.get(b)).parent(),
                    e = d([]);
                
                a.hasClass("active") && (e = a, a = d([]));
                b.collapseall && (e = c.filter(".active"));

                a.next().stop().show().animate({
                    height: a.next().data("height")
                });
                e.next().stop().animate({
                    height: 0
                }, function () {
                    e.next().hide()
                });

                a.addClass("active").parent().addClass("active");
                e.removeClass("active").parent().removeClass("active")
            }
        }
    });
    d.fn[a.prototype.name] = function () {
        var g = arguments,
            b = g[0] ? g[0] : null;
        return this.each(function () {
            var c = d(this);
            if (a.prototype[b] && c.data(a.prototype.name) && b != "initialize") c.data(a.prototype.name)[b].apply(c.data(a.prototype.name), Array.prototype.slice.call(g, 1));
            else if (!b || d.isPlainObject(b)) {
                var f = new a;
                a.prototype.initialize && f.initialize.apply(f, d.merge([c], g));
                c.data(a.prototype.name, f)
            } else d.error("Method " + b + " does not exist on jQuery." + a.name)
        })
    }
})(jQuery);