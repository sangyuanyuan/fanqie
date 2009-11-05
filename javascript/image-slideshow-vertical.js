	var arrowImageHeight = 35;	// Height of arrow image in pixels;
	var displayWaitMessage=true;	// Display a please wait message while images are loading?
	//Download by http://www.codefans.net
	var previewImage = false;
	var previewImageParent = false;
	var slideSpeed = 0;
	var previewImagePane = false;
	var slideEndMarker = false;
	var galleryContainer = false;
	var imageGalleryCaptions = new Array();
	function getTopPos(inputObj)
	{		
	
	  var returnValue = inputObj.offsetTop;
	  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetTop;
	  return returnValue;
	}
	
	function getLeftPos(inputObj)
	{

	  var returnValue = inputObj.offsetLeft;
	  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetLeft;
	  return returnValue;
	}
		
	function showPreview(newSrc,imageIndex)
	{
		if(!previewImage){
			var images = document.getElementById('previewPane').getElementsByTagName('IMG');
			if(images.length>0){
				previewImage = images[0];
			}else{
				previewImage = document.createElement('IMG');
				document.getElementById('previewPane').appendChild(previewImage);	
			}
			
			
		}
		if(displayWaitMessage){
			document.getElementById('waitMessage').style.display='inline';
		}
		document.getElementById('largeImageCaption').style.display='none';
		previewImage.onload = function() { hideWaitMessageAndShowCaption(imageIndex-1); };				
		previewImage.src = newSrc;
		
	}
	function hideWaitMessageAndShowCaption(imageIndex)
	{
		document.getElementById('waitMessage').style.display='none';	
		document.getElementById('largeImageCaption').innerHTML = imageGalleryCaptions[imageIndex];
		document.getElementById('largeImageCaption').style.display='block';
		
	}	
	function initSlide(e)
	{
		if(document.all)e = event;
		
		if(this.src.indexOf('over')<0)this.src = this.src.replace('.gif','-over.gif');
		
		slideSpeed = e.clientY + Math.max(document.body.scrollTop,document.documentElement.scrollTop) - getTopPos(this);
		if(this.src.indexOf('down')>=0){
			slideSpeed = (slideSpeed)*-1;	
		}else{
			slideSpeed = arrowImageHeight - slideSpeed;
		}
		slideSpeed = Math.round(slideSpeed * 10 / arrowImageHeight);
	}
	
	function stopSlide()
	{		
		slideSpeed = 0;
		this.src = this.src.replace('-over','');
	}
	
	function slidePreviewPane()
	{
		if(slideSpeed!=0){
			var topPos = previewImagePane.style.top.replace(/[^\-0-9]/g,'')/1;	
		
			if(slideSpeed<0 && slideEndMarker.offsetTop<(previewImageParent.offsetHeight - topPos)){
				slideSpeed=0;
			
			}
			topPos = topPos + slideSpeed;
			if(topPos>0)topPos=0;

		 	previewImagePane.style.top = topPos + 'px';
	 	
		}
	 	setTimeout('slidePreviewPane()',30);		
	}
	
	function revealThumbnail()
	{
		this.style.filter = 'alpha(opacity=100)';
		this.style.opacity = 1;
	}
	
	function hideThumbnail()
	{
		this.style.filter = 'alpha(opacity=50)';
		this.style.opacity = 0.5;
	}
	
	function initGalleryScript()
	{
		previewImageParent = document.getElementById('theImages');
		previewImagePane = document.getElementById('theImages').getElementsByTagName('DIV')[0];
		previewImagePane.style.top = '0px';
		galleryContainer  = document.getElementById('galleryContainer');
		var images = previewImagePane.getElementsByTagName('IMG');
		for(var no=0;no<images.length;no++){
			images[no].onmouseover = revealThumbnail;
			images[no].onmouseout = hideThumbnail;
		}	
		slideEndMarker = document.getElementById('slideEnd');
		
		document.getElementById('arrow_up_image').onmousemove = initSlide;
		document.getElementById('arrow_up_image').onmouseout = stopSlide;
		
		document.getElementById('arrow_down_image').onmousemove = initSlide;
		document.getElementById('arrow_down_image').onmouseout = stopSlide;
		var divs = previewImageParent.getElementsByTagName('DIV');
		for(var no=0;no<divs.length;no++){
			if(divs[no].className=='imageCaption')imageGalleryCaptions[imageGalleryCaptions.length] = divs[no].innerHTML;
		}		
		slidePreviewPane();
		
	}
	
	
	window.onload = initGalleryScript;