!function(t){t.fn.cardtable=function(a){var s,d=this,e={headIndex:0},n=t.extend({},e,a)
return s=a&&a.headIndex?a.headIndex:1,d.each(function(){var a=t(this)
if(!a.hasClass("stacktable")){var s=t(this).prop("class"),d=t("<div></div>")
"undefined"!=typeof n.myClass&&d.addClass(n.myClass)
var e,l,h,i,r,c=""
a.addClass("stacktable large-only"),e=a.find("caption").clone(),l=a.find("tr").eq(0),a.find("tbody tr").each(function(){h="",i="",r=t(this).prop("class"),t(this).find("td,th").each(function(a){""!==t(this).html()&&(i+='<tr class="'+r+'">',i+=l.find("td,th").eq(a).html()?'<td class="st-key">'+l.find("td,th").eq(a).html()+"</td>":'<td class="st-key"></td>',i+='<td class="st-val '+t(this).prop("class")+'">'+t(this).html()+"</td>",i+="</tr>")}),c+='<table class=" '+s+' stacktable small-only"><tbody>'+h+i+"</tbody></table>"}),a.find("tfoot tr td").each(function(a,d){""!==t.trim(t(d).text())&&(c+='<table class="'+s+' stacktable small-only"><tbody><tr><td>'+t(d).html()+"</td></tr></tbody></table>")}),d.prepend(e),d.append(t(c)),a.before(d)}})},t.fn.stacktable=function(a){var s,d=this,e={headIndex:1},n=t.extend({},e,a)
return s=a&&a.headIndex?a.headIndex:1,d.each(function(){var a=t(this).prop("class"),d=t('<table class="'+a+' stacktable small-only"><tbody></tbody></table>')
"undefined"!=typeof n.myClass&&d.addClass(n.myClass)
var e,l,h,i,r,c,o=""
e=t(this),e.addClass("stacktable large-only"),l=e.find("caption").clone(),h=e.find("tr").eq(0),e.find("tr").each(function(a){i="",r="",c=t(this).prop("class"),0===a?o+='<tr class=" '+c+' "><th class="st-head-row st-head-row-main" colspan="2">'+t(this).find("th,td").eq(s).html()+"</th></tr>":(t(this).find("td,th").each(function(a){a===s?i='<tr class="'+c+'"><th class="st-head-row" colspan="2">'+t(this).html()+"</th></tr>":""!==t(this).html()&&(r+='<tr class="'+c+'">',r+=h.find("td,th").eq(a).html()?'<td class="st-key">'+h.find("td,th").eq(a).html()+"</td>":'<td class="st-key"></td>',r+='<td class="st-val '+t(this).prop("class")+'">'+t(this).html()+"</td>",r+="</tr>")}),o+=i+r)}),d.prepend(l),d.append(t(o)),e.before(d)})},t.fn.stackcolumns=function(a){var s=this,d={},e=t.extend({},d,a)
return s.each(function(){var a=t(this),s=a.find("tr").eq(0).find("td,th").length
if(!(3>s)){var d=t('<table class="stacktable small-only"></table>')
"undefined"!=typeof e.myClass&&d.addClass(e.myClass),a.addClass("stacktable large-only")
for(var n=t("<tbody></tbody>"),l=1;s>l;)a.find("tr").each(function(a){var s=t("<tr></tr>")
0===a&&s.addClass("st-head-row st-head-row-main")
var d=t(this).find("td,th").eq(0).clone().addClass("st-key"),e=l
if(t(this).find("*[colspan]").length){var h=0
t(this).find("td,th").each(function(){var a=t(this).attr("colspan")
return a?(a=parseInt(a,10),e-=a-1,h+a>l&&(e+=h+a-l-1),h+=a):h++,h>l?!1:void 0})}var i=t(this).find("td,th").eq(e).clone().addClass("st-val").removeAttr("colspan")
s.append(d,i),n.append(s)}),++l
d.append(t(n)),a.before(d)}})}}(jQuery)

!function(t){t.fn.cardtable=function(a){var s,d=this,e={headIndex:0},n=t.extend({},e,a)
return s=a&&a.headIndex?a.headIndex:0,d.each(function(){var a=t(this)
if(!a.hasClass("stacktable")){var s=t(this).prop("class"),d=t("<div></div>")
"undefined"!=typeof n.myClass&&d.addClass(n.myClass)
var e,l,h,i,r,c=""
a.addClass("stacktable large-only"),e=a.find("caption").clone(),l=a.find("tr").eq(0),a.find("tbody tr").each(function(){h="",i="",r=t(this).prop("class"),t(this).find("td,th").each(function(a){""!==t(this).html()&&(i+='<tr class="'+r+'">',i+=l.find("td,th").eq(a).html()?'<td class="st-key">'+l.find("td,th").eq(a).html()+"</td>":'<td class="st-key"></td>',i+='<td class="st-val '+t(this).prop("class")+'">'+t(this).html()+"</td>",i+="</tr>")}),c+='<table class=" '+s+' stacktable small-only"><tbody>'+h+i+"</tbody></table>"}),a.find("tfoot tr td").each(function(a,d){""!==t.trim(t(d).text())&&(c+='<table class="'+s+' stacktable small-only"><tbody><tr><td>'+t(d).html()+"</td></tr></tbody></table>")}),d.prepend(e),d.append(t(c)),a.before(d)}})},t.fn.stacktable2=function(a){var s,d=this,e={headIndex:0},n=t.extend({},e,a)
return s=a&&a.headIndex?a.headIndex:0,d.each(function(){var a=t(this).prop("class"),d=t('<table class="'+a+' stacktable small-only"><tbody></tbody></table>')
"undefined"!=typeof n.myClass&&d.addClass(n.myClass)
var e,l,h,i,r,c,o=""
e=t(this),e.addClass("stacktable large-only"),l=e.find("caption").clone(),h=e.find("tr").eq(0),e.find("tr").each(function(a){i="",r="",c=t(this).prop("class"),0===a?o+='<tr class=" '+c+' "><th class="st-head-row st-head-row-main" colspan="2">'+t(this).find("th,td").eq(s).html()+"</th></tr>":(t(this).find("td,th").each(function(a){a===s?i='<tr class="'+c+'"><th class="st-head-row" colspan="2">'+t(this).html()+"</th></tr>":""!==t(this).html()&&(r+='<tr class="'+c+'">',r+=h.find("td,th").eq(a).html()?'<td class="st-key">'+h.find("td,th").eq(a).html()+"</td>":'<td class="st-key"></td>',r+='<td class="st-val '+t(this).prop("class")+'">'+t(this).html()+"</td>",r+="</tr>")}),o+=i+r)}),d.prepend(l),d.append(t(o)),e.before(d)})},t.fn.stackcolumns=function(a){var s=this,d={},e=t.extend({},d,a)
return s.each(function(){var a=t(this),s=a.find("tr").eq(0).find("td,th").length
if(!(3>s)){var d=t('<table class="stacktable small-only"></table>')
"undefined"!=typeof e.myClass&&d.addClass(e.myClass),a.addClass("stacktable large-only")
for(var n=t("<tbody></tbody>"),l=1;s>l;)a.find("tr").each(function(a){var s=t("<tr></tr>")
0===a&&s.addClass("st-head-row st-head-row-main")
var d=t(this).find("td,th").eq(0).clone().addClass("st-key"),e=l
if(t(this).find("*[colspan]").length){var h=0
t(this).find("td,th").each(function(){var a=t(this).attr("colspan")
return a?(a=parseInt(a,10),e-=a-1,h+a>l&&(e+=h+a-l-1),h+=a):h++,h>l?!1:void 0})}var i=t(this).find("td,th").eq(e).clone().addClass("st-val").removeAttr("colspan")
s.append(d,i),n.append(s)}),++l
d.append(t(n)),a.before(d)}})}}(jQuery)

$('.resp').stacktable();
$('.resp2').stacktable2();