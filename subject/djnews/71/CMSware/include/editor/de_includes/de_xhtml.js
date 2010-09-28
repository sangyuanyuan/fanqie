/* Copyright Interspire Pty Ltd */

function getXHTML(content) {
	var h = new HTML();

	h.setParam('tags', aTags);
	h.setParam('emptyattributes', aEmptyAttributes);
	h.setParam('emptytags', aEmptyTags);
	h.setParam('nonestedtags', aNoNestedTags);
	h.setParam('removeemptytags', aRemoveEmptyTags);
	h.setParam('entities', aEntities);
	h.setParam('requiredattributes', aRequiredAttributes);
	h.setParam('requiredattributesvalues', aRequiredAttributesValues);

	return h.toXHTML(content)
}

function HTML(sHTML) {
  sHTML != null ? this.sHTML = sHTML : this.sHTML = '';

  this.aEmptyAttributes = new Array();  
  this.aTags = new Array();
  this.aTypes = new Array();
  this.aTagNames = new Array();
  this.aNoNestedTags = new Array();
  this.aRemoveEmptyTags = new Array();
  this.aEntities = new Array();
  this.aRequiredAttributes = new Array();
  this.aRequiredAttributesValues = new Array();

  this.toXHTML = function (sHTML) {
    var a = new Array();
    a = this.toArray(sHTML);
    var il = a.length;
    
    var sTagName;
    var iTagType;
    var aItem;

    var aStack        = new Array();
    var aRet          = new Array();
    var aTemp         = new Array();
    var aTempNoNested = new Array();
    var add = '';
    var bCheckNoNested = false;
    for (var i = 0; i < il; i++) {
      aItem = a[i];
      iTagType = this.aTypes[i];
      sTagName = this.aTagNames[i];
      switch (iTagType) {
        case 0: // Open Tag
          /*if (aTempNoNested[sTagName] == 1) {
            aTempNoNested == 0;
            aRet[aRet.length] = "</" + sTagName + ">";
            aStack.length--;
            bCheckNoNested = false;
          }
          if (this._in_array(sTagName, this.aNoNestedTags) == true && bCheckNoNested == true) {
            aTempNoNested[sTagName] = 1;
          }*/
          aStack[aStack.length] = aItem;
          aRet[aRet.length]     = aItem + add;
          break;
        case 1: // Close Tag
          if (aTempNoNested[sTagName] == 1) {
            aTempNoNested[sTagName] = 0;
            bCheckNoNested = false;
          }
          aTemp.length = 0; // Clear the aTemp Array
          var bStop = true;
          // Check if the expected tag exists in aStack. If not, the tag is never opened
          // and will be ignored
          for (var j = 0; j < aStack.length; j++) {
            if (sTagName == this.tagName(aStack[j])) {
              bStop = false;
            }
          }
          if (bStop == true) {
            break;
          }
          var iStackLength = aStack.length
          for (var j = iStackLength - 1; j > -1; j--) {
            var sStackName = this.tagName(aStack[j]);
            if (sStackName == sTagName) {
              // The expected tag is found...
              aRet[aRet.length] = "</" + sStackName + ">" + add;
              if (this._in_array(sStackName, aFlushAfter)) {
                aTemp.length = 0;
              }
              aStack.length = aStack.length - 1;
              var iTempLength = aTemp.length;
              for (var k = 0; k < iTempLength; k++) {
                aRet[aRet.length] = aTemp[k] + add;
                aStack[aStack.length] = aTemp[k];
              }
              break;
            }
            aRet[aRet.length] = "</" + sStackName + ">" + add;
            aTemp[aTemp.length] = aStack[j];
            aStack.length = aStack.length - 1;
          }
          break;
        case 2: // Empty Tag
          aRet[aRet.length]     = aItem + add;
          break;
        case 3: // Ordinary Text
        case 4: // Ordinary Text
          aRet[aRet.length]     = aItem + add;
      }
    }
    iStackLength = aStack.length;
    for (var i = iStackLength - 1; i > -1; i--) {
      var sTempName = this.tagName(aStack[i]);
      aRet[aRet.length] = "</" + sTempName + ">";
    }

    var sRet = aRet.join("");

    // Remove all unnecessary tags
    var rl = this.aRemoveEmptyTags.length;
    for (i = 0; i < rl; i++) {
// Some bugs, don't know now what's causing it...

      //sRet = this.removeEmptyTag(this.aRemoveEmptyTags[i], sRet);
    }
    //sRet = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n" + sRet;
    return (sRet);

  }

  /**
   * Removes tags from a string
   *
   * @access public
   * @param  string  -  s     -  The tag to remove
   * @param  string  -  code  -  The input string
   * @return string
   *
   * @author Jorgen Horstink <jorgen@webstores.nl>
   * @time   30 minutes
   */
  this.removeEmptyTag = function(s, code) {
    RegExp.multiline = true;
    var re = new RegExp("<" + s + "([^>])*><\/" + s + ">", "i");

    while (code.match(re)) {
      code = code.replace(re, "");
    }
    return (code);
  }

  /**
   * Parses a HTML String an splits it into pieces
   *
   * @access public
   * @param  sHTML  -  The HTML String
   * @return array
   *
   * @explain: Okey, I admit, this code is very hard to understand, but it's very fast and well-programmed.
   * As the functionname says, this function converts a HTML string into an array. But that's not the only
   * thing this function does. It also makes several mistakes and improvements to the HTML:
   *   - It converts every Tag attribute into something like: attribute="value", ie:
   *     <b class=  test>test</b> becomes: <b class="test">test</b>
   *   - It splits on every HTML tag
   *   - It corrects empty attribute tags like: noshade, ie: <hr noshade> becomes: <hr noshade"noshade">
   *   - It corrects empty tags. IE: <img src=test.gif> becomes: <img src="test.gif" />
   *   - It corrects HTML entities, IE: &nbsp; becomes:   enz...
   *
   * @author Jorgen Horstink <jorgen@webstores.nl>
   * @time 28-08-2003 => 6 hours
   *       29-08-2003 => 3 hours Performance tuning
   */
  this.toArray = function (sHTML) {
    // If the sHTML param is set, set the global class variable: this.sHTML
    if (sHTML != null) {
      this.sHTML = sHTML;
    }

    var i;
    var il = this.sHTML.length;                                                // The length of the HTML string
    var sc;                                                                    // The current character
    var iMode = 0;                                                             // The current mode: 0 => inText, 1 => inTag, 2 => inAttribute, 3 => inScript, 4 => inScriptText, 5 => fixAttribute
    var bInEscape = false;
    var bAddEndSlash = false;
    var aRet = new Array();
    var aType = new Array();
    var aTagNames = new Array();
    var aTempRequired = new Array();
    var sRequired = '';
    var bSetRequired = true;
    var bAltExists = false;
    var sAttributeChar = '';
    if (this.sHTML.substr(0, 1) == "<") {
      var ci = -1;
    } else {
      var ci = 0;
      aType[ci] = 3;
      aTagNames[ci] = '';
      aRet[ci] = '';
    }
    for (var i = 0; i < il; i++) {
      sc = this.sHTML.substr(i, 1);
      switch (sc) {
        case "<":
          var sTagName = this.tagName(this.sHTML.substr(i, 12));               // Retrieve the tag name, only use a substring length of 12, because a tag is never longer than 12 chars.
          // Check if it's a HTML comment block, if so, walk till you find the close comment tag
          if (this.sHTML.substr(i+1, 3) == "!--") {
            t = i + 3;
            if (aRet[ci] != '') {
              ci++;
            }
            aRet[ci] = "<!--";
            aType[ci] = 3; // Comment
            while (this.sHTML.substr(t, 3) != "-->" && t < il) {
              t++;
              aRet[ci] += this.sHTML.substr(t, 1);
            }
            aRet[ci] += "->";
            i = t + 2;
            break;
          }

          if (iMode == 0) {
            if (sTagName == 'script') {
              iMode = 3;
              if (aRet[ci] != '') {
                ci++;
              }
              i += 6;
              aTagNames[ci] = 'script';
              aType[ci] = 0; // Open Tag
              aRet[ci] = '<script';
              break;
            }
            if (this._in_array(sTagName, this.aTags)) {
              iMode = 1;
              sRequired = '';
              bSetRequired = true;
              if (aRet[ci] != '') {
                ci++;
              }
              if (this.sHTML.substr(i + 1, 1) == "/") {
                aType[ci] = 1; // Close Tag
              } else {
                if (this._in_array(sTagName, this.aEmptyTags)) {
                  aType[ci] = 2; // Empty Tag
                  bAddEndSlash = true;
                } else {
                  aType[ci] = 0; // Open Tag
                }
              }
              aTagNames[ci] = sTagName;
              aRet[ci] = sc;
              break;
            } else {
              aRet[ci] += "<";
            }
            break;
          }
          if (iMode == 2 || iMode == 3) {
            aRet[ci] += sc;
            break;
          }
          if (iMode == 4) {
            if (sTagName == 'script') {
              iMode = 1;
              if (aRet[ci] != '') {
                ci++;
              }
              aType[ci] = 1; // Close Tag
              aTagNames[ci] = 'script';
              aRet[ci] = '</script';
              i += 7;
              break;
            } else {
              aRet[ci] += sc;
            }
          }
          break;
        case ">":
          if (iMode == 0) {
            aRet[ci] += ">";
            break;
          }

          if (iMode == 1) {
            iMode = 0;
            if (bAddEndSlash == false) {
              if (this._in_array(sRequired, this.aRequiredAttributes)) {
                aRet[ci] += " " + this.aRequiredAttributes[sRequired] + "=\"" + this.aRequiredAttributesValues[sRequired] + "\"";
                sRequired = '';
                bSetRequired = true;
              }
              aRet[ci] += ">";
            } else {
              if (this.sHTML.substr(i - 1, 1) == "/") {
                aRet[ci] = aRet[ci].substr(0, aRet[ci].length - 1);
                if (this._in_array(sRequired, this.aRequiredAttributes)) {
                  aRet[ci] += " " + this.aRequiredAttributes[sRequired] + "=\"" + this.aRequiredAttributesValues[sRequired] + "\"";
                  sRequired = '';
                  bSetRequired = true;
                }
                aRet[ci] += "/>";
              } else {
                if (this._in_array(sRequired, this.aRequiredAttributes)) {
                  aRet[ci] += " " + this.aRequiredAttributes[sRequired] + "=\"" + this.aRequiredAttributesValues[sRequired] + "\"";
                  sRequired = '';
                  bSetRequired = true;
                }
                aRet[ci] += "/>";
              }
              bAddEndSlash = false;
            }
            if (aRet[ci] != '') {
              ci++;
            }
            aType[ci] = 3; // Text
            aRet[ci] = '';
            break;
          }
          if (iMode == 2 || iMode == 4) {
            aRet[ci] += sc;
          }
          if (iMode == 3) {
            iMode = 4;
            aRet[ci] += sc;
            if (aRet[ci] != '') {
              ci++;
            }
            aType[ci] = 3; // CDATA
            aRet[ci] = '';
            break;
          }
          if (iMode == 5) {
            iMode = 0;
            aRet[ci] += "\"";
            if (this._in_array(sRequired, this.aRequiredAttributes)) {
              aRet[ci] += " " + this.aRequiredAttributes[sRequired] + "=\"" + this.aRequiredAttributesValues[sRequired] + "\" ";
              sRequired = '';
              bSetRequired = true;
            }
            if (bAddEndSlash == false) {
              aRet[ci] += ">";
            } else {
              aRet[ci] += "/>";
            }
            if (aRet[ci] != '') {
              ci++;
            }
            aType[ci] = 3; // Text
            aRet[ci] = '';
            break;
          }
          break;
        case "\"":

        case "'":
          if (iMode == 0) {
            if (sc == "'") {
              // aRet[ci] += "'";
				aRet[ci] += sc;
              break;
            } else {
			  aRet[ci] += sc;
              // aRet[ci] += """;
              break;
            }
          }
          if (iMode == 1) {
            sAttributeChar = sc;
            iMode = 2;
            aRet[ci] += sc;
            break;
          }
          if (iMode == 2) {
            if (bInEscape == true) {
              bInEscape = false;
              aRet[ci] += sc;
              break;
            } else {
              aRet[ci] += sc;
              if (sAttributeChar == sc) {
                iMode = 1;
              }
              break;
            }
          }
          if (iMode == 4 || iMode == 3) {
            aRet[ci] += sc;
          }
          break;
        case "\\":
          aRet[ci] += sc;
          //if (iMode == 2) {
          //  bInEscape = true;
          //  aRet[ci] += sc;
         // }
          break;
        case " ":
          if (iMode == 5) {
            iMode = 1;
            aRet[ci] += "\"" + sc;
            break;
          }
          aRet[ci] += sc;
          break;
        case "&":
          var t = 1;
          var nc = this.sHTML.charCodeAt(i+t);
          while (((nc > 96 && nc < 123) || (nc > 64 && nc < 91) || (nc > 47 && nc < 58)) && t < il) {
            t++;
            nc = this.sHTML.charCodeAt(i+t);
          }
          var nw = this.sHTML.substr(i, t).toLowerCase();
          nw += ";";
          if (this._in_array(nw, aEntities)) {
            aRet[ci] += aEntities[nw];
            i = i + nw.length - 1;
            break;
          } else {
            if (iMode == 4) {
              aRet[ci] += "&";
            } else {
              aRet[ci] += "&";
            }
          }
          //aRet[ci] += "&";
          break;
        case "=": // Fix an attribute if there are no " or ' used...
          if (iMode == 1) {
            var t = 1;
            var nc = this.sHTML.charCodeAt(i+t);
            while (nc == 32) {
              t++;
              nc = this.sHTML.charCodeAt(i+t);
            }
            i += t - 1;
            if (nc != 34 && nc != 39) {
              aRet[ci] += sc + "\"";
              iMode = 5;
              break;
            }
          }
          aRet[ci] += sc;
          break;
        default:
          if (bInEscape == true) {
            bInEscape = false;
          }

          if (iMode == 1) {
            var t = 1;
            var nc = this.sHTML.charCodeAt(i+t);
            while (((nc > 96 && nc < 123) || (nc > 64 && nc < 91) || (nc > 47 && nc < 58)) && t < il) {
              t++;
              nc = this.sHTML.charCodeAt(i+t);
            }
            var nw = this.sHTML.substr(i, t).toLowerCase();

            if (this._in_array(aTagNames[ci], this.aRequiredAttributes) && (aType[ci] == 0 || aType[ci] == 2)) {
              if (bSetRequired == true) {
                sRequired = aTagNames[ci];
              }
              if (this.aRequiredAttributes[aTagNames[ci]] == nw) {
                sRequired = '';
                bSetRequired = false;
              }
            }

            if (this._in_array(nw, this.aEmptyAttributes)) {
              aRet[ci] = aRet[ci] + nw + "=\"" + nw + "\"";
              i = i + nw.length - 1;
              break;
            } else {
              aRet[ci] = aRet[ci] + nw;
              i = i + nw.length - 1;
              break;
            }
          }

          if (iMode == 3) {
            aRet[ci] += sc.toLowerCase();
          } else {
            aRet[ci] += sc;
          }
          break;
      }
    }
    this.aTypes = aType;
    this.aTagNames = aTagNames;
    return (aRet);
  }  

  /**
   * Filter the tag name from a string
   *
   * @access public
   * @param  string  -  s  -  The input string
   * @return string
   *
   * @author Jorgen Horstink <jorgen@webstores.nl>
   * @time   27-08-2003 => 10 minutes
   *         28-08-2003 => 10 minutes => I made some speed improvements
   */
  this.tagName = function (s) {
    var t = 1;
    // If the second char is a slash, remove that slash from the string
    if (s.charCodeAt(1) == 47) {
      s = "<" + s.substr(2);
    }
    
    var c  = s.charCodeAt(t);
    var sl = s.length;
    while (((c > 96 && c < 123) || (c > 64 && c < 91) || (c > 47 && c < 58)) && t < sl) {
      t++;
      c = s.charCodeAt(t);
    }
    return (s.substr(1, t - 1).toLowerCase());
  }

  /**
   * Sets a parameter for the Class
   *
   * @access public
   * @param  sType   -  The name of the param to set
   * @param  sValue  -  The value of that param
   * @return void
   *
   * @author Jorgen Horstink
   * @time:  28-08-2003 => 5 minutes
   */
  this.setParam = function (sType, sValue) {
    switch (sType.toLowerCase()) {
      case 'html':
        this.sHTML = sValue;
        break;
      case 'emptyattributes':
        this.aEmptyAttributes = sValue;
        break;
      case 'tags':
        this.aTags = sValue;
        break;
      case 'emptytags':
        this.aEmptyTags = sValue;
        break;
      case 'nonestedtags':
        this.aNoNestedTags = sValue;
        break;
      case 'removeemptytags':
        this.aRemoveEmptyTags = sValue;
        break;
      case 'entities':
        this.aEntities = sValue;
        break;
      case 'requiredattributes':
        this.aRequiredAttributes = sValue;
        break;
      case 'requiredattributesvalues':
        this.aRequiredAttributesValues = sValue;
        break;
    }
  }

  /**
   * Gets a parameter from the Class
   *
   * @access public
   * @param  sType   -  The name of the param to retrieve
   * @return mixed
   *
   * @author Jorgen Horstink
   * @time:  28-08-2003 => 5 minutes
   */
  this.getParam = function (sType) {
    switch (sType.toLowerCase()) {
      case 'html':
        return (this.sHTML);        
    }
  }

  ///////////////////////
  // Private functions //
  ///////////////////////

  /**
   * Checks whether or not a value exists in an Array
   *
   * @access public
   * @param  string  -  needle    -  The string to search for
   * @param  array   -  haystack  -  The Array where to look in
   * @return boolen
   *
   * @author Jorgen Horstink <jorgen@webstores.nl>
   * @time   27-08-2003 => 5 minutes
   */
  
  /* Old function that is 25% slower!
  this._in_array = function (needle, haystack) {
    var il = haystack.length;
    for (var i = 0; i < il; i++) {
      if (needle == haystack[i]) {
        // The needle is found in the Array, so return true
        return (true);
      }
    }
    // The needle is not found, so return False
    return (false);
  }*/
  
  this._in_array = function (needle, haystack) {
    return (haystack[needle] != null);
  }
}
