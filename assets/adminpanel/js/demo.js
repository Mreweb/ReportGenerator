/**
 * jquery.filterTable
 *
 * This plugin will add a search filter to tables. When typing in the filter,
 * any rows that do not contain the filter will be hidden.
 *
 * Utilizes bindWithDelay() if available. https://github.com/bgrins/bindWithDelay
 *
 * @version v1.5.7
 * @author Sunny Walker, swalker@hawaii.edu
 * @license MIT
 */
!function($){var e=$.fn.jquery.split("."),t=parseFloat(e[0]),i=parseFloat(e[1]);t<2&&i<8?($.expr[":"].filterTableFind=function(e,t,i){return $(e).text().toUpperCase().indexOf(i[3].toUpperCase().replace(/"""/g,'"').replace(/"\\"/g,"\\"))>=0},$.expr[":"].filterTableFindAny=function(e,t,i){var n=i[3].split(/[\s,]/),r=[];return $.each(n,function(e,t){var i=t.replace(/^\s+|\s$/g,"");i&&r.push(i)}),!!r.length&&function(e){var t=!1;return $.each(r,function(i,n){if($(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g,'"').replace(/"\\"/g,"\\"))>=0)return t=!0,!1}),t}},$.expr[":"].filterTableFindAll=function(e,t,i){var n=i[3].split(/[\s,]/),r=[];return $.each(n,function(e,t){var i=t.replace(/^\s+|\s$/g,"");i&&r.push(i)}),!!r.length&&function(e){var t=0;return $.each(r,function(i,n){$(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g,'"').replace(/"\\"/g,"\\"))>=0&&t++}),t===r.length}}):($.expr[":"].filterTableFind=jQuery.expr.createPseudo(function(e){return function(t){return $(t).text().toUpperCase().indexOf(e.toUpperCase().replace(/"""/g,'"').replace(/"\\"/g,"\\"))>=0}}),$.expr[":"].filterTableFindAny=jQuery.expr.createPseudo(function(e){var t=e.split(/[\s,]/),i=[];return $.each(t,function(e,t){var n=t.replace(/^\s+|\s$/g,"");n&&i.push(n)}),!!i.length&&function(e){var t=!1;return $.each(i,function(i,n){if($(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g,'"').replace(/"\\"/g,"\\"))>=0)return t=!0,!1}),t}}),$.expr[":"].filterTableFindAll=jQuery.expr.createPseudo(function(e){var t=e.split(/[\s,]/),i=[];return $.each(t,function(e,t){var n=t.replace(/^\s+|\s$/g,"");n&&i.push(n)}),!!i.length&&function(e){var t=0;return $.each(i,function(i,n){$(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g,'"').replace(/"\\"/g,"\\"))>=0&&t++}),t===i.length}})),$.fn.filterTable=function(e){var t={autofocus:!1,callback:null,containerClass:"filter-table",containerTag:"p",filterExpression:"filterTableFind",hideTFootOnFilter:!1,highlightClass:"alt",ignoreClass:"",ignoreColumns:[],inputSelector:null,inputName:"",inputType:"search",label:"Filter:",minChars:1,minRows:8,placeholder:"search this table",preventReturnKey:!0,quickList:[],quickListClass:"quick",quickListClear:"",quickListGroupTag:"",quickListTag:"a",visibleClass:"visible"},i=function(e){return e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/</g,"&lt;").replace(/>/g,"&gt;")},n=$.extend({},t,e),r=function(e,t){var i=e.find("tbody");if(""===t||t.length<n.minChars)i.find("tr").show().addClass(n.visibleClass),i.find("td").removeClass(n.highlightClass),n.hideTFootOnFilter&&e.find("tfoot").show();else{var r=i.find("td");if(i.find("tr").hide().removeClass(n.visibleClass),r.removeClass(n.highlightClass),n.hideTFootOnFilter&&e.find("tfoot").hide(),n.ignoreColumns.length){var a=[];n.ignoreClass&&(r=r.not("."+n.ignoreClass)),a=r.filter(":"+n.filterExpression+'("'+t+'")'),a.each(function(){var e=$(this),t=e.parent().children().index(e);$.inArray(t,n.ignoreColumns)===-1&&e.addClass(n.highlightClass).closest("tr").show().addClass(n.visibleClass)})}else n.ignoreClass&&(r=r.not("."+n.ignoreClass)),r.filter(":"+n.filterExpression+'("'+t+'")').addClass(n.highlightClass).closest("tr").show().addClass(n.visibleClass)}n.callback&&n.callback(t,e)};return this.each(function(){var e=$(this),t=e.find("tbody"),a=null,l=null,s=null,c=!0;if("TABLE"===e[0].nodeName&&t.length>0&&(0===n.minRows||n.minRows>0&&t.find("tr").length>=n.minRows)&&!e.prev().hasClass(n.containerClass)){if(n.inputSelector&&1===$(n.inputSelector).length?(s=$(n.inputSelector),a=s.parent(),c=!1):(a=$("<"+n.containerTag+" />"),""!==n.containerClass&&a.addClass(n.containerClass),a.prepend(n.label+" "),s=$('<input type="'+n.inputType+'" placeholder="'+n.placeholder+'" name="'+n.inputName+'" />'),n.preventReturnKey&&s.on("keydown",function(e){if(13===(e.keyCode||e.which))return e.preventDefault(),!1})),n.autofocus&&s.attr("autofocus",!0),$.fn.bindWithDelay?s.bindWithDelay("keyup",function(){r(e,$(this).val())},200):s.bind("keyup",function(){r(e,$(this).val())}),s.bind("click search input paste blur",function(){r(e,$(this).val())}),c&&a.append(s),n.quickList.length>0||n.quickListClear){if(l=n.quickListGroupTag?$("<"+n.quickListGroupTag+" />"):a,$.each(n.quickList,function(e,t){var r=$("<"+n.quickListTag+' class="'+n.quickListClass+'" />');r.text(i(t)),"A"===r[0].nodeName&&r.attr("href","#"),r.bind("click",function(e){e.preventDefault(),s.val(t).focus().trigger("click")}),l.append(r)}),n.quickListClear){var o=$("<"+n.quickListTag+' class="'+n.quickListClass+'" />');o.html(n.quickListClear),"A"===o[0].nodeName&&o.attr("href","#"),o.bind("click",function(e){e.preventDefault(),s.val("").focus().trigger("click")}),l.append(o)}l!==a&&a.append(l)}c&&e.before(a)}})}}(jQuery);




(function($,window,document,undefined){var pluginName="table2excel",defaults={exclude:".noExl",name:"Table2Excel",filename:"table2excel",fileext:".xls",exclude_img:true,exclude_links:true,exclude_inputs:true,preserveColors:false};function Plugin(element,options){this.element=element;this.settings=$.extend({},defaults,options);this._defaults=defaults;this._name=pluginName;this.init()}Plugin.prototype={init:function(){var e=this;var utf8Heading='<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';e.template={head:'<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">'+utf8Heading+"<head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>",sheet:{head:"<x:ExcelWorksheet><x:Name>",tail:"</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>"},mid:"</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>",table:{head:"<table>",tail:"</table>"},foot:"</body></html>"};e.tableRows=[];var additionalStyles="";var compStyle=null;$(e.element).each(function(i,o){var tempRows="";$(o).find("tr").not(e.settings.exclude).each(function(i,p){additionalStyles="";if(e.settings.preserveColors){compStyle=getComputedStyle(p);additionalStyles+=(compStyle&&compStyle.backgroundColor?"background-color: "+compStyle.backgroundColor+";":"");additionalStyles+=(compStyle&&compStyle.color?"color: "+compStyle.color+";":"")}tempRows+="<tr style='"+additionalStyles+"'>";$(p).find("td,th").not(e.settings.exclude).each(function(i,q){additionalStyles="";if(e.settings.preserveColors){compStyle=getComputedStyle(q);additionalStyles+=(compStyle&&compStyle.backgroundColor?"background-color: "+compStyle.backgroundColor+";":"");additionalStyles+=(compStyle&&compStyle.color?"color: "+compStyle.color+";":"")}var rc={rows:$(this).attr("rowspan"),cols:$(this).attr("colspan"),flag:$(q).find(e.settings.exclude)};if(rc.flag.length>0){tempRows+="<td> </td>"}else{tempRows+="<td";if(rc.rows>0){tempRows+=" rowspan='"+rc.rows+"' "}if(rc.cols>0){tempRows+=" colspan='"+rc.cols+"' "}if(additionalStyles){tempRows+=" style='"+additionalStyles+"'"}tempRows+=">"+$(q).html()+"</td>"}});tempRows+="</tr>"});if(e.settings.exclude_img){tempRows=exclude_img(tempRows)}if(e.settings.exclude_links){tempRows=exclude_links(tempRows)}if(e.settings.exclude_inputs){tempRows=exclude_inputs(tempRows)}e.tableRows.push(tempRows)});e.tableToExcel(e.tableRows,e.settings.name,e.settings.sheetName)},tableToExcel:function(table,name,sheetName){var e=this,fullTemplate="",i,link,a;e.format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p]})};sheetName=typeof sheetName==="undefined"?"Sheet":sheetName;e.ctx={worksheet:name||"Worksheet",table:table,sheetName:sheetName};fullTemplate=e.template.head;if($.isArray(table)){Object.keys(table).forEach(function(i){fullTemplate+=e.template.sheet.head+sheetName+i+e.template.sheet.tail})}fullTemplate+=e.template.mid;if($.isArray(table)){Object.keys(table).forEach(function(i){fullTemplate+=e.template.table.head+"{table"+i+"}"+e.template.table.tail})}fullTemplate+=e.template.foot;for(i in table){e.ctx["table"+i]=table[i]}delete e.ctx.table;var isIE=navigator.appVersion.indexOf("MSIE 10")!==-1||(navigator.userAgent.indexOf("Trident")!==-1&&navigator.userAgent.indexOf("rv:11")!==-1);if(isIE){if(typeof Blob!=="undefined"){fullTemplate=e.format(fullTemplate,e.ctx);fullTemplate=[fullTemplate];var blob1=new Blob(fullTemplate,{type:"text/html"});window.navigator.msSaveBlob(blob1,getFileName(e.settings))}else{txtArea1.document.open("text/html","replace");txtArea1.document.write(e.format(fullTemplate,e.ctx));txtArea1.document.close();txtArea1.focus();sa=txtArea1.document.execCommand("SaveAs",true,getFileName(e.settings))}}else{var blob=new Blob([e.format(fullTemplate,e.ctx)],{type:"application/vnd.ms-excel"});window.URL=window.URL||window.webkitURL;link=window.URL.createObjectURL(blob);a=document.createElement("a");a.download=getFileName(e.settings);a.href=link;document.body.appendChild(a);a.click();document.body.removeChild(a)}return true}};function getFileName(settings){return(settings.filename?settings.filename:"table2excel")}function exclude_img(string){var _patt=/(\s+alt\s*=\s*"([^"]*)"|\s+alt\s*=\s*'([^']*)')/i;return string.replace(/<img[^>]*>/gi,function myFunction(x){var res=_patt.exec(x);if(res!==null&&res.length>=2){return res[2]}else{return""}})}function exclude_links(string){return string.replace(/<a[^>]*>|<\/a>/gi,"")}function exclude_inputs(string){var _patt=/(\s+value\s*=\s*"([^"]*)"|\s+value\s*=\s*'([^']*)')/i;return string.replace(/<input[^>]*>|<\/input>/gi,function myFunction(x){var res=_patt.exec(x);if(res!==null&&res.length>=2){return res[2]}else{return""}})}$.fn[pluginName]=function(options){var e=this;e.each(function(){if(!$.data(e,"plugin_"+pluginName)){$.data(e,"plugin_"+pluginName,new Plugin(this,options))}});return e}})(jQuery,window,document);


/*!
 * StickyTableHeaders 0.1.24 (2018-01-14 23:29)
 * MIT licensed
 * Copyright (C) Jonas Mosbech - https://github.com/jmosbech/StickyTableHeaders
 */
!function(e,i,t){"use strict";var o="stickyTableHeaders",n=0,d={fixedOffset:0,leftOffset:0,marginTop:0,objDocument:document,objHead:"head",objWindow:i,scrollableArea:i,cacheHeaderHeight:!1,zIndex:3};e.fn[o]=function(t){return this.each(function(){var l=e.data(this,"plugin_"+o);l?"string"==typeof t?l[t].apply(l):l.updateOptions(t):"destroy"!==t&&e.data(this,"plugin_"+o,new function(t,l){var a=this;a.$el=e(t),a.el=t,a.id=n++,a.$el.bind("destroyed",e.proxy(a.teardown,a)),a.$clonedHeader=null,a.$originalHeader=null,a.cachedHeaderHeight=null,a.isSticky=!1,a.hasBeenSticky=!1,a.leftOffset=null,a.topOffset=null,a.init=function(){a.setOptions(l),a.$el.each(function(){var i=e(this);i.css("padding",0),a.$originalHeader=e("thead:first",this),a.$clonedHeader=a.$originalHeader.clone(),i.trigger("clonedHeader."+o,[a.$clonedHeader]),a.$clonedHeader.addClass("tableFloatingHeader"),a.$clonedHeader.css({display:"none",opacity:0}),a.$originalHeader.addClass("tableFloatingHeaderOriginal"),a.$originalHeader.after(a.$clonedHeader),a.$printStyle=e('<style type="text/css" media="print">.tableFloatingHeader{display:none !important;}.tableFloatingHeaderOriginal{position:static !important;}</style>'),a.$head.append(a.$printStyle)}),a.$clonedHeader.find("input, select").attr("disabled",!0),a.updateWidth(),a.toggleHeaders(),a.bind()},a.destroy=function(){a.$el.unbind("destroyed",a.teardown),a.teardown()},a.teardown=function(){a.isSticky&&a.$originalHeader.css("position","static"),e.removeData(a.el,"plugin_"+o),a.unbind(),a.$clonedHeader.remove(),a.$originalHeader.removeClass("tableFloatingHeaderOriginal"),a.$originalHeader.css("visibility","visible"),a.$printStyle.remove(),a.el=null,a.$el=null},a.bind=function(){a.$scrollableArea.on("scroll."+o,a.toggleHeaders),a.isWindowScrolling||(a.$window.on("scroll."+o+a.id,a.setPositionValues),a.$window.on("resize."+o+a.id,a.toggleHeaders)),a.$scrollableArea.on("resize."+o,a.toggleHeaders),a.$scrollableArea.on("resize."+o,a.updateWidth)},a.unbind=function(){a.$scrollableArea.off("."+o,a.toggleHeaders),a.isWindowScrolling||(a.$window.off("."+o+a.id,a.setPositionValues),a.$window.off("."+o+a.id,a.toggleHeaders)),a.$scrollableArea.off("."+o,a.updateWidth)},a.debounce=function(e,i){var t=null;return function(){var o=this,n=arguments;clearTimeout(t),t=setTimeout(function(){e.apply(o,n)},i)}},a.toggleHeaders=a.debounce(function(){a.$el&&a.$el.each(function(){var i,t,n,d=e(this),l=a.isWindowScrolling?isNaN(a.options.fixedOffset)?a.options.fixedOffset.outerHeight():a.options.fixedOffset:a.$scrollableArea.offset().top+(isNaN(a.options.fixedOffset)?0:a.options.fixedOffset),s=d.offset(),r=a.$scrollableArea.scrollTop()+l,c=a.$scrollableArea.scrollLeft(),f=a.isWindowScrolling?r>s.top:l>s.top;f&&(t=a.options.cacheHeaderHeight?a.cachedHeaderHeight:a.$clonedHeader.height(),n=(a.isWindowScrolling?r:0)<s.top+d.height()-t-(a.isWindowScrolling?0:l)),f&&n?(i=s.left-c+a.options.leftOffset,a.$originalHeader.css({position:"fixed","margin-top":a.options.marginTop,top:0,left:i,"z-index":a.options.zIndex}),a.leftOffset=i,a.topOffset=l,a.$clonedHeader.css("display",""),a.isSticky||(a.isSticky=!0,a.updateWidth(),d.trigger("enabledStickiness."+o)),a.setPositionValues()):a.isSticky&&(a.$originalHeader.css("position","static"),a.$clonedHeader.css("display","none"),a.isSticky=!1,a.resetWidth(e("td,th",a.$clonedHeader),e("td,th",a.$originalHeader)),d.trigger("disabledStickiness."+o))})},0),a.setPositionValues=a.debounce(function(){var e=a.$window.scrollTop(),i=a.$window.scrollLeft();!a.isSticky||e<0||e+a.$window.height()>a.$document.height()||i<0||i+a.$window.width()>a.$document.width()||a.$originalHeader.css({top:a.topOffset-(a.isWindowScrolling?0:e),left:a.leftOffset-(a.isWindowScrolling?0:i)})},0),a.updateWidth=a.debounce(function(){if(a.isSticky){a.$originalHeaderCells||(a.$originalHeaderCells=e("th,td",a.$originalHeader)),a.$clonedHeaderCells||(a.$clonedHeaderCells=e("th,td",a.$clonedHeader));var i=a.getWidth(a.$clonedHeaderCells);a.setWidth(i,a.$clonedHeaderCells,a.$originalHeaderCells),a.$originalHeader.css("width",a.$clonedHeader.width()),a.options.cacheHeaderHeight&&(a.cachedHeaderHeight=a.$clonedHeader.height())}},0),a.getWidth=function(t){var o=[];return t.each(function(t){var n,d=e(this);if("border-box"===d.css("box-sizing")){var l=d[0].getBoundingClientRect();n=l.width?l.width:l.right-l.left}else if("collapse"===e("th",a.$originalHeader).css("border-collapse"))if(i.getComputedStyle)n=parseFloat(i.getComputedStyle(this,null).width);else{var s=parseFloat(d.css("padding-left")),r=parseFloat(d.css("padding-right")),c=parseFloat(d.css("border-width"));n=d.outerWidth()-s-r-c}else n=d.width();o[t]=n}),o},a.setWidth=function(e,i,t){i.each(function(i){var o=e[i];t.eq(i).css({"min-width":o,"max-width":o})})},a.resetWidth=function(i,t){i.each(function(i){var o=e(this);t.eq(i).css({"min-width":o.css("min-width"),"max-width":o.css("max-width")})})},a.setOptions=function(i){a.options=e.extend({},d,i),a.$window=e(a.options.objWindow),a.$head=e(a.options.objHead),a.$document=e(a.options.objDocument),a.$scrollableArea=e(a.options.scrollableArea),a.isWindowScrolling=a.$scrollableArea[0]===a.$window[0]},a.updateOptions=function(e){a.setOptions(e),a.unbind(),a.bind(),a.updateWidth(),a.toggleHeaders()},a.init()}(this,t))})}}(jQuery,window);


$(function () {
    skinChanger();
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll(true);
    setSettingListHeightAndScroll(true);
    $(window).resize(function () {
        setSkinListHeightAndScroll(false);
        setSettingListHeightAndScroll(false);
    });
    try {
        $(".date-picker").persianDatepicker();
        $('[data-mask]').each(function(){
            $(this).mask($(this).data('mask'));
        });
    }
    catch (e) {
        
    }
});
//Skin changer
function skinChanger() {
    $('.right-sidebar .demo-choose-skin li').on('click', function () {
        var $body = $('body');
        var $this = $(this);

        var existTheme = $('.right-sidebar .demo-choose-skin li.active').data('theme');
        $('.right-sidebar .demo-choose-skin li').removeClass('active');
        $body.removeClass('theme-' + existTheme);
        $this.addClass('active');

        $body.addClass('theme-' + $this.data('theme'));
    });
}
//Skin tab content set height and show scroll
function setSkinListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    if (!isFirstTime){
      $el.slimScroll({ destroy: true }).height('auto');
      $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}
//Setting tab content set height and show scroll
function setSettingListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    if (!isFirstTime){
      $el.slimScroll({ destroy: true }).height('auto');
      $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}
//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}
//Helper Functions For Ajax Calls
function UUID(){
    return'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g,function(c){
        var r=Math.random()*16|0,v=c=='x'?r:(r&0x3|0x8);return v.toString(16);
    }
    );
}

function notify($title , $type , $time = 500 , $position = 'topLeft'){
    iziToast.show({
        theme: 'light',
        closeOnEscape: true,
        closeOnClick: true,
        progressBar: false,
        icon: 'icon-person',
        title: $title,
        color: $type,
        zindex: 9060,
        timeout: $time,
        position: $position
    });
}
function toggleLoader() {
    $(".page-loader-wrapper").fadeToggle();
}
function showLoader() {
    $(".page-loader-wrapper").fadeIn(100);
}
function hideLoader() {
    $(".page-loader-wrapper").fadeOut(100);
}
function isEmpty(value) {
    return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}
function hasNumber(value) {
    return /\d/.test(value);
}
function isNumber(value) {
    return $.isNumeric(value);
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function isDate(dateString) {
    var regEx = /^\d{4}\/\d{2}\/\d{2}$/;
    if(!dateString.match(regEx)) return false;  // Invalid format
    var d = new Date(dateString);
    if(Number.isNaN(d.getTime())) return false; // Invalid date
    return true;
}
function reloadPage($time = 4000) {
    setTimeout(function(){
        location.reload();
    } , $time);
}
function historyBack($time = 3000) {
    setTimeout(function(){
        window.history.back();
    } , $time);
}
function redirectPage($redirect , $time = 2000) {
    setTimeout(function(){
        window.location.href = $redirect;
    } , $time);
}
function toEnglishDigits(str) {
    var e = '۰'.charCodeAt(0);
    str = str.replace(/[۰-۹]/g, function (t) {
        return t.charCodeAt(0) - e;
    });
    e = '٠'.charCodeAt(0);
    str = str.replace(/[٠-٩]/g, function (t) {
        return t.charCodeAt(0) - e;
    });
    return str;
}

function jQFormSerializeArrToJson(formSerializeArr){
    var jsonObj = {};
    jQuery.map( formSerializeArr, function( n, i ) {
        jsonObj[n.name] = n.value;
    });

    return jsonObj;
}

$(document).ready(function(){
    setTimeout(function(){
        $('table').filterTable({
            'label': 'جستجو کنید',
            'placeholder': 'جستجو کنید',
            'minRows':4
        });

        $("table.sticky").stickyTableHeaders();


    } , 2000);
    $(".table-responsive").removeClass('table-responsive');
    $('.select-picker').selectpicker({
        'liveSearch' : true
    });

    $(function () {
        //Tooltip
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
        //Popover
        $('[data-toggle="popover"]').popover();
    })

});