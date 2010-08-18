//// PHProxy v0.6 2010
//// http://phpr0xi.blogspot.com
function New_Wind0w() {document.PHProxy.target = (document.PHProxy.target == '_blank') ? '_top' : '_blank';}
////
function PR0XY_G0(){
	string = document.PHProxy.elements[0].value.replace(/^\s+|\s+$/g, '');
	if (!string) {return false;}
	url = (string.indexOf('://') < 0) ? 'http://' + string : string;
	document.PHProxy.elements[0].value = R0T13(BS64_ENC0DE(url));
	document.PHProxy.submit ();
	document.PHProxy.elements[0].value = string;
	return false;}
////
function G00GLE(){
	str = document.PHProxy.elements[0].value.replace(/^\s+|\s+$/g, '');
	if (!str) {return;}
	google = "http://www.google.com/search?q=" + str;
	document.PHProxy.elements[0].value = R0T13(BS64_ENC0DE(google));
	document.PHProxy.submit ();
	document.PHProxy.elements[0].value = str;}

//// Base64 encode/decode - http://www.webtoolkit.info
var key_Str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
function BS64_ENC0DE(input){
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
		input = UTf8_ENC0DE(input);
		while (i < input.length){
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
			if (isNaN(chr2))
			enc3 = enc4 = 64;
			else if (isNaN(chr3))
			enc4 = 64;
			output = output +
			this.key_Str.charAt(enc1) + this.key_Str.charAt(enc2) +
			this.key_Str.charAt(enc3) + this.key_Str.charAt(enc4);}
			return output;}
////
function UTf8_ENC0DE(string){
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
		for (var n = 0; n < string.length; n++) {
			var c = string.charCodeAt(n);
			if (c < 128) {utftext += String.fromCharCode(c);}
			else if((c > 127) && (c < 2048))
			{utftext += String.fromCharCode((c >> 6) | 192);
			utftext += String.fromCharCode((c & 63) | 128);}
			else {utftext += String.fromCharCode((c >> 12) | 224);
			utftext += String.fromCharCode(((c >> 6) & 63) | 128);
			utftext += String.fromCharCode((c & 63) | 128);}}
			return utftext;}
////
var alpha1 = 'ZYXWVUTSRQPONMLKJIHGFEDCBAzyxwvutsrqponmlkjihgfedcba';
var alpha2 = 'nopqrstuvwxyzabcdefghijklmNOPQRSTUVWXYZABCDEFGHIJKLM';
function R0T13(str){
	var newStr = '';
    var curLet, curLetLoc;
    for (var i = 0; i < str.length; i++)
    {curLet = str.charAt(i);
    curLetLoc = alpha1.indexOf(curLet);
    newStr += (curLetLoc < 0) ? curLet : alpha2.charAt(curLetLoc);}
    return newStr;}
////
function miniform(url){
document.writeln("<style type=\"text/css\">.pmfclass {margin: 0;padding: 0;border: 0;width: none;height: none;text-decoration: none;font-size: 9pt;font-family: Tahoma, Arial, sans-serif;align: none;text-align: none;direction: ltr;font-weight: normal;background-image: none;background-color: #F2F3F7;color: #333333;letter-spacing: none;}</style>");
document.writeln("<div id=\"110011\" class=\"pmfclass\" style=\"text-align: center;border-bottom: 1px solid #D9D9D9;position: fixed;top: 0;left: 0;right: 0;bottom: none;\">");
document.writeln("<form method=\"GET\" name=\"PHProxy\" class=\"pmfclass\" onsubmit=\"return PR0XY_G0();\">Address :");
document.writeln(' [<input class=\"pmfclass\" type=\"text\" style=\"width: 68%;\" name=\"a\" value="' + url + '">] ');
document.writeln(" <input type=\"button\" class=\"pmfclass\" value=\"[Go]\" name=\"go\" onclick=\"PR0XY_G0();\"> ");
document.writeln(" <input type=\"button\" class=\"pmfclass\" value=\"[Google]\" name=\"google\" onclick=\"G00GLE()\"> ");
document.writeln(" <label class=\"pmfclass\">[<input type=\"checkbox\" class=\"pmfclass\" onclick=\"New_Wind0w ();\">New window]</label> ");
document.writeln(" <a id=\"pmfhref\" class=\"pmfclass\" style=\"color: #FF0000;cursor: pointer;\" onclick=\"document.getElementById (110011).style.display= 'none'\" title=\"Hide mini form\"> &nbsp; &nbsp; X</a></form></div>");}