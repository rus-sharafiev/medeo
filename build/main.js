(()=>{"serviceWorker"in navigator&&window.addEventListener("load",async()=>{try{let e=await navigator.serviceWorker.register("sw.js");console.log("Service worker registered! \u{1F60E}",e)}catch(e){console.log("\u{1F625} Service worker registration failed: ",e)}});window.location.hash!=""?(t=window.location.hash.split("#"),$("main").load("search.php",{id:t[1]})):window.location.pathname=="/"?$("main").load("start_page.php"):window.location.pathname=="/%D0%9A%D0%9E%D0%9D%D0%A2%D0%90%D0%9A%D0%A2%D0%AB"?d():(i=window.location.pathname.split(/[_/]+/),path_stings={},path_stings.cat=decodeURI(i[1]),i[2]!=null&&(path_stings.subcat=decodeURI(i[2])),$("main").load("search.php",path_stings));var t,i;$(window).scroll(function(){$("#mobile-menu").css("display")=="none"?$(this).scrollTop()>120?$("header").addClass("top blur"):$("header").removeClass("top blur"):$(this).scrollTop()>65?$("header").addClass("top blur"):$("header").removeClass("top blur")});$("#search").focus(function(){$("#mobile-menu").css("display")!="none"?$("#before-header, header, main, footer").addClass("blured"):$("#before-header, header, nav, main, footer").addClass("blured"),$("body").css("overflow","hidden"),$(".search-box").addClass("search-box-focus"),$(".search-delete-text").hide(),$(this).attr("placeholder","\u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435, \u043A\u0430\u0442\u0435\u0433\u043E\u0440\u0438\u044F \u0438\u043B\u0438 \u043A\u0430\u0442\u0430\u043B\u043E\u0436\u043D\u044B\u0439 \u043D\u043E\u043C\u0435\u0440")});$("#search").blur(function(){setTimeout(function(){$("#search").data("focus")?$("#search").focus().removeData("focus"):($("nav").hasClass("opened")||($("#mobile-menu").css("display")!="none"?$("#before-header, header, main, footer").removeClass("blured"):$("#before-header, header, nav, main, footer").removeClass("blured")),$("body").css("overflow","overlay"),$(".search-box").removeClass("search-box-focus"),$("#search").val("").attr("placeholder","\u041F\u043E\u0438\u0441\u043A \u043F\u043E \u043A\u0430\u0442\u0430\u043B\u043E\u0433\u0443"),$("#ac").hide().html(""),$("#mobile-search").removeClass("active"))},100)});$("#searchform").submit(function(){if(event.preventDefault(),document.querySelector("#searchform").reportValidity()){$("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");var e=$("#search").val();$("main").load("search.php",{q:e},function(){$(".active").removeClass("active"),$("#search").blur().val("")})}});$(".search-submit-button").click(function(){document.querySelector("#searchform").reportValidity()?$("#search").submit():$("#search").data("focus",!0)});$(".search-delete-text").click(function(){$("#search").data("focus",!0).val(""),$(".search-delete-text").hide(),$("#ac").hide().html("")});$("#search").keyup(function(e){switch(e.which){case 37:break;case 39:break;case 38:break;case 40:break;case 13:break;default:var a=$(this).val();if(a.length>2){$("#ac").show(),$("#ac").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");var s=$(this).val();$("#ac").load("ac.php",{q:s})}else $("#ac").hide().html("");$("#search").val()==""?$(".search-delete-text").hide():$(".search-delete-text").show();return}e.preventDefault()});$("#logo, #medeo, #mobile-home").click(function(){$(".active").removeClass("active"),$(this).addClass("active"),$("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>"),$("main").load("start_page.php"),history.pushState(null,"","/"),$("nav").removeClass("opened"),$("#before-header, header, main, footer").removeClass("blured"),$("body").css("overflow","overlay")});$("nav > div > div:first-child").click(function(){$(".nav-active").removeClass("nav-active"),$(".active").removeClass("active"),$(this).parent().addClass("nav-active"),$("#mobile-menu").css("display")!="none"&&$("#mobile-nav").addClass("active")});$("nav > div > div:last-child > div > div:first-child").click(function(){if($(".active").removeClass("active"),$("#mobile-menu").css("display")=="none"){$(this).addClass("active"),$("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");var e=$(this).text();$("main").load("search.php",{cat:e}),history.pushState({cat:e},"","/"+e)}else $(this).parent().addClass("active"),$("#mobile-nav").addClass("active")});$("nav > div > div:last-child > div > div:last-child > div").click(function(){$(".active").removeClass("active"),$(this).parent().parent().children().first().addClass("active"),$("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");var e=$(this).text(),a=$(this).parent().parent().children().first().text();$("main").load("search.php",{subcat:e,cat:a}),history.pushState({subcat:e,cat:a},"","/"+a+"_"+e),$(this).parent().removeClass("active"),$("nav").removeClass("opened"),$("#before-header, header, main, footer").removeClass("blured"),$("body").css("overflow","overlay")});function d(){$("main").load("contacts.html",function(){$.getScript("https://api-maps.yandex.ru/2.1/?apikey=793bffb9-d244-43e3-bc32-d42a596d4374&lang=ru_RU",function(){ymaps.ready(e);function e(){var a=new ymaps.Map("map",{center:[55.833398,49.049641],controls:["zoomControl"],zoom:16}),s=new ymaps.GeoObject({geometry:{type:"Point",coordinates:[55.834735,49.049587]},properties:{iconContent:"MEDEO"}},{preset:"islands#darkBlueStretchyIcon"});a.geoObjects.add(s)}})})}$("#contacts, #mobile-contacts").click(function(){$(".active").removeClass("active"),$(this).addClass("active"),$("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>"),d(),history.pushState(null,"","/\u041A\u041E\u041D\u0422\u0410\u041A\u0422\u042B"),$("nav").removeClass("opened"),$("#before-header, header, main, footer").removeClass("blured"),$("body").css("overflow","overlay")});$("#mobile-search").click(function(){$(".search-box").hasClass("search-box-focus")||($("#search").focus(),$(".active").removeClass("active"),$(this).addClass("active"),$("nav").removeClass("opened"))});$("#mobile-nav").click(function(){$("nav").hasClass("opened")?($(".active").removeClass("active"),$("nav").removeClass("opened"),$("#before-header, header, main, footer").removeClass("blured"),$("body").css("overflow","overlay")):($(".active").removeClass("active"),$(this).addClass("active"),$("nav").addClass("opened"),$("#before-header, header, main, footer").addClass("blured"),$("body").css("overflow","hidden"))});window.onpopstate=function(){$(".active").removeClass("active"),history.state!=null?($("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>"),$("main").load("search.php",history.state)):window.location.pathname=="/%D0%9A%D0%9E%D0%9D%D0%A2%D0%90%D0%9A%D0%A2%D0%AB"?d():($("main").html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>"),$("main").load("start_page.php"))};})();