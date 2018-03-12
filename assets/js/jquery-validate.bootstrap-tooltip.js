/**
 * @preserve
 * jQuery Validation Bootstrap Tooltip extention v0.10.2
 *
 * https://github.com/Thrilleratplay/jQuery-Validation-Bootstrap-tooltip
 *
 * Copyright 2016 Tom Hiller
 * Released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 */
!function(a){var b=0,c=0;a.extend(!0,a.validator,{prototype:{defaultShowErrors:function(){var d=this,e=a.fn.tooltip.Constructor.VERSION;e&&(e=e.split("."),b=parseInt(e[0]),c=parseInt(e[1])),a.each(this.errorList,function(e,f){if(3===b&&c>=3){var g=a(f.element);void 0!==g.data("bs.tooltip")?g.data("bs.tooltip").options.title=f.message:g.tooltip(d.applyTooltipOptions(f.element,f.message)),a(f.element).removeClass(d.settings.validClass).addClass(d.settings.errorClass).tooltip("show")}else a(f.element).removeClass(d.settings.validClass).addClass(d.settings.errorClass).tooltip(4===b?"dispose":"destroy").tooltip(d.applyTooltipOptions(f.element,f.message)).tooltip("show");d.settings.highlight&&d.settings.highlight.call(d,f.element,d.settings.errorClass,d.settings.validClass)}),a.each(d.validElements(),function(c,e){a(e).removeClass(d.settings.errorClass).addClass(d.settings.validClass).tooltip(4===b?"dispose":"destroy"),d.settings.unhighlight&&d.settings.unhighlight.call(d,e,d.settings.errorClass,d.settings.validClass)})},applyTooltipOptions:function(c,d){var e;e=4===b?a.fn.tooltip.Constructor.Default:3===b?a.fn.tooltip.Constructor.DEFAULTS:a.fn.tooltip.defaults;var f={animation:a(c).data("animation")||e.animation,html:a(c).data("html")||e.html,placement:a(c).data("placement")||e.placement,selector:a(c).data("selector")||e.selector,title:a(c).attr("title")||d,trigger:a.trim("manual "+(a(c).data("trigger")||"")),delay:a(c).data("delay")||e.delay,container:a(c).data("container")||e.container};return this.settings.tooltip_options&&this.settings.tooltip_options[c.name]&&a.extend(f,this.settings.tooltip_options[c.name]),this.settings.tooltip_options&&this.settings.tooltip_options._all_&&a.extend(f,this.settings.tooltip_options._all_),f}}})}(jQuery);
