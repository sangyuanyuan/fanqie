<?php
	include_once(dirname(__FILE__)."/../lib/xspace_api.php");
	function &get_baby_album($uid){
		global $bloger;
		if(!is_object($bloger)){
			 $bloger = Bloger::find($uid);
			 if($bloger){
			 	return $bloger->baby_album;
			 }
		}
	}
	
	function create_baby_album($uid,$username,$subject,$image_path,$message='',$ip='127.0.0.1'){
		$table = new table_class('blog_spaceitems');
		$table->catid = 110;
		$table->uid = $uid;
		$table->username = $username;
		$table->type = 'image';
		$table->subject = $subject;
		$table->dateline = time();
		$table->lostpost = time();
		$table->viewnum = 0;
		$table->replynum = 0;
		$table->trackbacknum = 0;
		$table->goodrate = 0;
		$table->badrate = 0;
		$table->digest = 0;
		$table->top = 0;
		$table->allowreply = 1;
		$table->hash = '';
		$table->folder = 1;
		$table->hasattach = 1;
		$table->grade = 0;
		$table->gid = 0;
		$table->gdigest = 0;
		$table->password = '';
		$table->styletitle = '';
		$table->picid = 0;
		$table->key_field = 'itemid';
		if(!$table->save()) return false;
		$image = new table_class('blog_spaceimages');
		$image->itemid = $table->itemid;
		$image->message = $message;
		$image->image = $image_path;
		$image->imagenum = 1;
		$image->relativetags = 'a:0:{}';
		$image->relativeitemids = '';
		$image->postip = $ip;
		$image->customfieldid = 0;
		$image->customfieldtext = 'a:0:{}';
		$image->includetags = '';
		$image->remoteurl = '';
		$image->bgmusic = '';
		$image->save(); 
		$attach = new table_class('blog_attachments');
		$attach->itemid = $table->itemid;
		$attach->isavailable = 1;
		$attach->type = 'image';
		$attach->catid = 110;
		$attach->uid = $uid;
		$attach->dateline = time();
		$attach->postip = $ip;
		$attach->customfieldid = 0;
		$attach->filename = '';
		$attach->subject = $subject;
		$attach->attachtype = 'jpg';
		$attach->isimage = 1;
		$attach->filepath = $image_path;
		$attach->thumbpath = $image_path;
		$attach->downloads = 0;
		$attach->hash = '';
		$attach->key_field = 'aid';
		return $attach->save(); 
		
	}