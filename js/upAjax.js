/*
 * upAjax
 * Kleines Plugin zum einfachen aufruf von PHP Funktionen vom Client aus mit dem XMLHttpRequest Objekt Level 2
 *
 * @author Lennart Sommerfeld
 * @copyright (c) 2014 Lennart Sommerfeld
 * @link http://lennart-sommerfeld.de
 * @version 1.0
 */
 
XMLHttpRequest.prototype.targetFunction = '';
XMLHttpRequest.prototype.targetFunctionPara = '';
XMLHttpRequest.prototype.sendDataObjekt = [];

XMLHttpRequest.prototype.setTargetFunctionName = function(value){
    this.targetFunction = value;
};

XMLHttpRequest.prototype.setParameter = function( value){
    this.sendDataObjekt.push(value);
};

XMLHttpRequest.prototype.sendData = function(target){
    this.open('POST',target+'?EasyAjaxJSONString='+this.targetFunction);
    this.setRequestHeader("Content-type","application/x-www-form-urlencoded; charset=utf-8");
    this.send('EasyAjaxData=' + JSON.stringify(this.sendDataObjekt));
};

XMLHttpRequest.prototype.formData = null;

XMLHttpRequest.prototype.setFormData = function(formData){
    this.formData = formData;
};

XMLHttpRequest.prototype.sendFormData = function(target){
    this.open('POST',target+'?EasyAjaxJSONForm='+this.targetFunction);
    this.send(this.formData);
};
