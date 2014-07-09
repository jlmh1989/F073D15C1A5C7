/*
 * jsNotifications v0.7
 * The simplest way to show cross-browser notifications using JavaScript
 * Copyright (c) 2012 Cali Rojas <juancarlosr@msn.com>
 * MIT License (see mit-license.txt)
 * 
 * Credits:
 * jsNotifications includes Gritter for jQuery by Jordan Boesch <http://www.boedesign.com/>
 * 
 * Visit http://www.lewebmonster.com for cool stuff (in spanish)
 * 
 */

var jsNotificationsStart={
	getCurrentPath:function(){
		var objScriptsList=document.getElementsByTagName('script');
		var objCurrentScript=objScriptsList[objScriptsList.length-1];
		var strScriptPath=objCurrentScript.src.replace(/\/script\.js$/, '/');
		strScriptPath=strScriptPath.substring(strScriptPath.indexOf('/', 1)+1,
		strScriptPath.lastIndexOf('/')).replace('/'+window.location.hostname,'');
		
		return strScriptPath;
	},
	currentPath:''
}
jsNotificationsStart.currentPath=jsNotificationsStart.getCurrentPath();

var jsNotifications=function(objOptions){
	if(typeof objOptions==='undefined') objOptions=new Object();
	var strIconsDefaultPath=(typeof objOptions.iconsFolder==='undefined')?'':objOptions.iconsFolder;
	if(strIconsDefaultPath=='') strIconsDefaultPath=jsNotificationsStart.currentPath+'/img/';
	
	this.title=(typeof objOptions.title==='undefined')?'':objOptions.title;
	this.errorIcon=(typeof objOptions.errorIcon==='undefined')?strIconsDefaultPath+'error.png':objOptions.errorIcon;
	this.infoIcon=(typeof objOptions.infoIcon==='undefined')?strIconsDefaultPath+'info.png':objOptions.infoIcon;
	this.warningIcon=(typeof objOptions.warningIcon==='undefined')?strIconsDefaultPath+'warning.png':objOptions.warningIcon;
	this.okIcon=(typeof objOptions.okIcon==='undefined')?strIconsDefaultPath+'ok.png':objOptions.okIcon;
	this.showAlerts=(typeof objOptions.showAlerts==='undefined')?true:objOptions.showAlerts;
	this.autoCloseTime=(typeof objOptions.autoCloseTime==='undefined')?5000:parseInt(objOptions.autoCloseTime)*1000;
};

jsNotifications.prototype={
	isAvailable:function(){
		return window.webkitNotifications;
	},
	canShow:function(){
		if(this.isAvailable()){
			if(this.getStatus()==0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	},
	show:function(strIcon,strMessage,blnSticky,strTitle){
		var blnSticky=(typeof blnSticky==='undefined')?false:blnSticky;
		var strTitle=(typeof strTitle==='undefined')?this.title:strTitle;
		
		switch(strIcon.toLowerCase()){
			case 'error':
				strIcon=this.errorIcon;
				break;
			case 'warning':
				strIcon=this.warningIcon;
				break;
			case 'ok':
				strIcon=this.okIcon;
				break;
			case 'info':
			default:
				strIcon=this.infoIcon;
		}
		
		if(this.canShow()){
			var wknNotification = window.webkitNotifications.createNotification(strIcon,
			strTitle,strMessage);
			
			wknNotification.show();
			
			if(this.autoCloseTime>0){
				if(!blnSticky){
					setTimeout(function(){
						wknNotification.cancel();
					},this.autoCloseTime);
				}
			}
		}else{
			if(typeof jQuery==='undefined'){
				if(this.showAlerts) alert(strMessage);
			}else{
				if(typeof $.gritter==='undefined'){
					if(this.showAlerts) alert(strMessage);
				}else{
					$.gritter.add({
						title: strTitle,
						text: strMessage,
						image: strIcon,
						sticky: ((blnSticky)?true:(this.autoCloseTime!=0)?false:true),
						time: this.autoCloseTime
					});
				}
			}
		}
	},
	showHTML:function(strURL,blnSticky){
		var blnSticky=(typeof blnSticky==='undefined')?false:blnSticky;
		
		if(this.canShow()){
			var wknNotification = window.webkitNotifications.createHTMLNotification(strURL);
			
			wknNotification.show();
			
			if(this.autoCloseTime>0){
				if(!blnSticky){
					setTimeout(function(){
						wknNotification.cancel();
					},this.autoCloseTime);
				}
			}
		}else{
			var blnSticky=(typeof blnSticky==='undefined')?false:blnSticky;
			
			if(typeof jQuery==='undefined'){
				if(this.showAlerts) window.open(strURL);
			}else{
				if(typeof $.gritter==='undefined'){
					if(this.showAlerts) window.open(strURL);
				}else{
					var $objHTML=$('<div/>');
					$objHTML.load(strURL,function(){
						$.gritter.add({
							title: this.title,
							text: $objHTML.html(),
							sticky: ((blnSticky)?true:(this.autoCloseTime!=0)?false:true),
							time: this.autoCloseTime
						});
					});
				}
			}
		}
	},
	getStatus:function(){
		return window.webkitNotifications.checkPermission();
	},
	requestPermission:function(fntCallback){
		if(typeof fntCallback=='undefined'){
			window.webkitNotifications.requestPermission();
		}else{
			window.webkitNotifications.requestPermission(fntCallback);
		}
	}
};