if(typeof $j == "undefined") {
  var $j = jQuery.noConflict();
}
var weather = new Object();

weather.htmlDomId = null;

weather = {
  init : function (htmlDomId) {
  	this.htmlDomId = htmlDomId;
      this.getWeather();
  },
  getWeather : function() {
        $j.getScript("http://fw.qq.com:80/ipaddress", function() {
          if(typeof IPData != "undefined") {
            YoyoSite.Cookie.set("current_ip", IPData[2]+','+IPData[3]);
          }
        });
    weather.c();
  },
  c : function() {
    $j.getScript("http://minisite.qq.com/js/j.minisite.weather.js", function () {
      var province = null;
      var city = null;
      var ipAddress = YoyoSite.Cookie.get("current_ip");

      if (ipAddress != null) {
        try {
          var ipAddressArr = ipAddress.split(",");
          province = ipAddressArr[0];
          city =ipAddressArr[1];
        } catch (e) { }
      }

      var geo  = new Object();
      geo = {
        defaultCity: MiniSite.Weather.defaultCity,
        city: MiniSite.Weather.city
      }
	
      if (typeof geo.city[province] != "undefined") {
        if (typeof geo.city[province][city]  != "undefined") {
          var _city_ = geo.city[province][city];
        } else if (typeof geo.city[province]["_"]  != "undefined") {
          var _city_ = geo.city[province]["_"];
        } else {
          var _city_ = geo.defaultCity;
        }
      } else {
        var _city_ = geo.defaultCity;
      }

      $j.getScript("http://weather.news.qq.com/inc/minisite_"+_city_+".js", function() {
        $j("#"+weather.htmlDomId).html(__minisite__weather__);
      });

    });
  }
}


YoyoSite = new Object();

YoyoSite.Cookie = {
set: function(name, value, expires, path, domain)
     {
	     var exp  = new Date();    //new Date("December 31, 9998");
	     days = 1;
	     exp.setTime(exp.getTime() + days*24*60*60*1000);
	     document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
     },

get: function(name)
     {
	     var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));

	     if (arr != null)
	     {
		     return unescape(arr[2]);

	     }

	     return null;
     },

clear: function(name, path, domain)
       {
	       if (this.get(name))
	       {
		       document.cookie = name + "=" +
			       ((path) ? "; path=" + path : "; path=/") +
			       ((domain) ? "; domain=" + domain : "") +
			       ";expires=Fri, 02-Jan-1970 00:00:00 GMT";
	       }
       }
};

