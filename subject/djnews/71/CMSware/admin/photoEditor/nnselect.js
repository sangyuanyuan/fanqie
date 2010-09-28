
var nn_undefined;

function nn_isNull(object) {
  return nn_undefined == object || object == null;
}


var nn_THREE_YEARS_IN_MILLIS = (1000 * 60 * 60 * 24 * 365 * 3);
var nn_waitForCookieFunctor = null;

/* public */ function nn_Cookie(name) {

  /* public */
  this.setCookie = nn_Cookie_setCookie;
  this.getCookie = nn_Cookie_getCookie;
  this.expireCookie = nn_Cookie_expireCookie;
  this.registerCallbackForWhenCookieExists = nn_Cookie_registerCallbackForWhenCookieExists;

  /* private */
  this.m_name = name;
}

/* private */ function nn_Cookie_getExpirationDate(expireDate) {
  if (!nn_isNull(expireDate)) {
    return expireDate;
  } else {
    return new Date(new Date().getTime() + nn_THREE_YEARS_IN_MILLIS);
  }
}

/* private */ function nn_Cookie_getExpirationDateAsString(expireDate) {
  return nn_Cookie_getExpirationDate(expireDate).toGMTString();
}

/* public */ function nn_Cookie_setCookie(name, value, expireDate, domain) {
  var cookieDescription = name + "=" + escape(value);
  cookieDescription += "; path=/";
  cookieDescription += "; expires=" + nn_Cookie_getExpirationDateAsString(expireDate);
  if (!nn_isNull(domain)) {
    cookieDescription += "; domain=" + escape(domain);
  }
  document.cookie = cookieDescription;
}

/* public */ function nn_Cookie_getCookie(name) {
  var key = name + "=";
  var startOfCookie = document.cookie.indexOf("; " + key);
  if (-1 != startOfCookie) {
    startOfCookie += 2;
  } else if (0 == document.cookie.indexOf(key)) {
    startOfCookie = 0;
  } else {
    return null;
  }
  var endOfCookie = document.cookie.indexOf(";", startOfCookie);
  if (endOfCookie == -1) {
    endOfCookie = document.cookie.length;
  }
  var value = document.cookie.substring(startOfCookie + key.length, endOfCookie);
  return unescape(value);
}

/* public */ function nn_Cookie_expireCookie(name, domain) {
  var expiredTime = new Date(new Date().getTime() - 1);
  nn_Cookie_setCookie(name, "", expiredTime, domain);
}

/* public */ function nn_Cookie_registerCallbackForWhenCookieExists(callback) {
  nn_waitForCookieFunctor = new nn_WaitForCookieFunctor(this.m_name, callback);
  nn_waitForCookieFunctor.execute();
}

/* private */ function nn_WaitForCookieFunctor(cookieName, callback) {

  /* public */
  this.execute = nn_WaitForCookieFunctor_execute;

  /* private */
  this.m_cookieName = cookieName;
  this.m_callback = callback;
}

/* private */ function nn_WaitForCookieFunctor_execute() {
  nn_waitForCookieFunctor = this;
  if (!nn_isNull(nn_Cookie_getCookie(this.m_cookieName))) {
    this.m_callback();
  } else {
    setTimeout("nn_waitForCookieFunctor.execute()", 500);
  }
}

var nn_domainSuffixes = [ "com", "net", "org", "biz", "info", "gov", "edu", "mil" ];

function nn_arrayContains(nn_array, nn_token) {
  for (var nn_i = 0; nn_i < nn_array.length; nn_i++) {
    if (nn_array[nn_i] == nn_token) {
      return 1;
    }
  }
  return 0;
}

function nn_removePort(nn_domain) {
  var nn_colonIndex = nn_domain.lastIndexOf(':');
  if (nn_colonIndex > 0) {
    return  nn_domain.substring(0, nn_colonIndex);
  }
  return nn_domain;
}

function nn_getMinimumDomain(nn_domain) {
  if (nn_isNull(nn_domain)) {
    return null;
  }

  nn_domain = nn_domain.toLowerCase();
  nn_domain = nn_removePort(nn_domain);

  var nn_index = nn_domain.length;
  while (3 < nn_index && nn_domain.charAt(nn_index - 3) == '.') {
    nn_index -= 3;
  }

  var nn_previousIndex = nn_index;
  nn_index = nn_domain.lastIndexOf('.', nn_index - 1);
  var nn_token = nn_domain.substring(nn_index + 1, nn_previousIndex);
  if (nn_arrayContains(nn_domainSuffixes, nn_token)) {
    nn_previousIndex = nn_index;
    nn_index = nn_domain.lastIndexOf('.', nn_index - 1);
  }

  if (nn_index == -1 || nn_domain.charAt(nn_index) == '.') {
    nn_index ++;
  }
  if (nn_index == nn_previousIndex) {
    return nn_domain;
  }
  return nn_domain.substring(nn_index);
}


var nn_DATE_THROTTLE_COOKIE_NAME = "nnselect";
var nn_ONE_DAY_IN_MILLIS = 1000 * 60 * 60 * 24;

function nn_DateThrottle() {
  // public
  this.shouldThrottle = nn_DateThrottle_shouldThrottle;

  // private
  this.getOrCreate = nn_DateThrottle_getOrCreate;
  this.getCookie = nn_DateThrottle_getCookie;
  this.createCookie = nn_DateThrottle_createCookie;
  this.updateCookie = nn_DateThrottle_updateCookie;
  this.createCookieValue = nn_DateThrottle_createCookieValue;
  this.getRandomNumberBetween = nn_DateThrottle_getRandomNumberBetween;
  this.m_cookieName = nn_DATE_THROTTLE_COOKIE_NAME;
}

/* public */ function nn_DateThrottle_shouldThrottle() {
  var cookieValue = parseInt(this.getOrCreate());
  var now = new Date().getTime();
  var dateToStartSurvey = cookieValue + (nn_ONE_DAY_IN_MILLIS * 7);
  return (now < dateToStartSurvey);
}

/* private */ function nn_DateThrottle_getOrCreate() {
  var cookie = this.getCookie();
  if (cookie == null) {
    cookie = this.createCookie(); 
  }
  return cookie;
}

/* private */ function nn_DateThrottle_getCookie() {
  return nn_Cookie_getCookie(this.m_cookieName);
}

/* private */ function nn_DateThrottle_createCookie() {
  var now = new Date();
  var offset = nn_ONE_DAY_IN_MILLIS * -8;
  var cookieValue = this.createCookieValue(now, offset);
  nn_Cookie_setCookie(this.m_cookieName, cookieValue);
  return cookieValue;
}

/* private */ function nn_DateThrottle_updateCookie() {
  var now = new Date();
  var cookieValue = this.createCookieValue(now, 0);
  nn_Cookie_setCookie(this.m_cookieName, cookieValue);
  return cookieValue;
}

/* private */ function nn_DateThrottle_createCookieValue(date, offset) {
  var cookieValue = date.getTime() + offset;
  return cookieValue.toString();
}

/* private */ function nn_DateThrottle_getRandomNumberBetween(min, max) {
  var range = max - min;
  var number = Math.round(Math.random() * range) + min;
  return number;
}

function nn_survey() {
  var nn_dateThrottle = new nn_DateThrottle();
  if (!nn_dateThrottle.shouldThrottle()) {
    nn_dateThrottle.updateCookie();
    document.write("<iframe src='http://survey.nnselect.com/survey/is_panelist_137.html' name='nn_frame' height='0' width='0' scrolling='no' frameborder='0' marginWidth='0' marginHeight='0'></iframe>");
  }
}
var nn_V;
var nn_V_name = "nn_V";

function nn_waitForAndSetLocalCookie() {
  if (nn_isNull(nn_V)) {
    setTimeout("nn_waitForAndSetLocalCookie()", 1000);
  } else {
    nn_Cookie_setCookie(nn_V_name, nn_V, null, nn_getMinimumDomain(document.domain));
  }
}

function nn_loadContent(file) {
  var nn_scriptTag = document.getElementById("nn_load_script");
  var nn_head = document.getElementsByTagName("head").item(0);
  if(nn_scriptTag) {
    nn_head.removeChild(nn_scriptTag);
  }
  nn_script = document.createElement("script");
  nn_script.type = "text/javascript";
  nn_script.id = "nn_load_script";
  nn_script.src = file;
  nn_head.appendChild(nn_script);
}

function nn_buildPing(nn_extension) {
  var nn_now = new Date();
  var nn_title;
  if (nn_isNull(window.encodeURI)) {
     nn_title = escape(document.title);
  } else {
     nn_title = window.encodeURI(document.title);
  }
  var nn_pingUrl =
    "http://ping.nnselect.com/ping." + nn_extension +
    "?d=" + nn_now.getTime() +
    "&c=137" +
    "&u=" + escape(document.URL) +
    "&t=" + nn_title;
  return nn_pingUrl;
}

function nn_ping() {
  var nn_imageUrl = nn_buildPing("gif");
  if (document.images) {
    var nn_image = new Image();
    nn_image.src = nn_imageUrl;
  } else {
    document.write("<img src='" + nn_imageUrl + "' height='1' width='1'>");
  }
}

function nn_supportsSampling() {
  return navigator.userAgent.toLowerCase().indexOf("msie 6") != -1;
}

function nn_shouldSample(nn_cookieValue) {
  return ((parseInt(nn_cookieValue) % 4) == 0);
}

function nn_pingAndGetCookie() {
  nn_loadContent(nn_buildPing("js"));
  nn_waitForAndSetLocalCookie();
}

if (nn_supportsSampling()) {
  var nn_cookieValue = new nn_Cookie(nn_V_name).getCookie(nn_V_name);
  if (nn_isNull(nn_cookieValue)) {
    nn_pingAndGetCookie();
    nn_survey();
  } else if (nn_shouldSample(nn_cookieValue)) {
    nn_ping();
    nn_survey();
  }
} else {
  nn_ping();
  nn_survey();
}
