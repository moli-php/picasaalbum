<?php
class picasaxml
{
	public function get_userid($user="")
	{
		$userId = $this->rss_picasa($user);
		$userId =  (string)$userId->link[1]->attributes()->href;
		$userId = explode("/",$userId);
		$num =  count($userId)-1;
		return $userId[$num];
	}
	
	private function rss_picasa($username,$album="")
	{
		if(isset($album) && $album != ""){
			$url = "http://picasaweb.google.com/data/feed/base/user/".$username."/albumid/".$album."?hl=en_US";
		}else{
			$url = "http://picasaweb.google.com/data/feed/base/user/".$username;
		}
	//return $url;
		$curl = $this->download_page($url) or exit('error');
	
		$rss = new SimpleXMLElement($curl);
		return $rss;
	
	}
	
	private function download_page($path)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$path);
		curl_setopt($ch, CURLOPT_FAILONERROR,1);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$retValue = curl_exec($ch);
		curl_close($ch);
	
		return $retValue;
	}
	
	public function picasa_getrss($user)
	{
		$rss = $this->rss_picasa($user);
	
		foreach($rss->entry as $val){
			$aData['getAlbumId'] = $val->link[0]->attributes();
			$aData['getAlbumText'] = $val->link[1]->attributes();
			$len = strpos($aData['getAlbumId']['href'], "?") - strrpos($aData['getAlbumId']['href'],"/");
	
			$aData['albumText'] = substr($aData['getAlbumText']['href'],strrpos($aData['getAlbumText']['href'],"/")+1,strlen($aData['getAlbumText']['href']) );
			$aData['albumId'] = substr($aData['getAlbumId']['href'],strrpos($aData['getAlbumId']['href'], "/")+1,$len-1);
			$aData2[] = array('albumText' => $aData['albumText'],'albumId' => $aData['albumId']);
	
		}
	
		return $aData2;
	
	}
	
	
	public function manage_album($user,$album="")
	{
	
	  $rss = $this->rss_picasa($user,$album);
	
		foreach($rss->entry as $val){
		
			$img = (string)$val->summary;
			$title = (string)$val->title;
			$link = $val->link[1]->attributes();

			preg_match_all('/Number of Photos in Album:/',$img, $pos, PREG_OFFSET_CAPTURE);
			preg_match_all('/<br/',$img, $pos2, PREG_OFFSET_CAPTURE,$pos[0][0][1]);

			$image = substr($img, strpos($img,"<a"),strpos($img,"</a>")-34 );
			$len = $pos2[0][0][1]-$pos[0][0][1]+56;
			$count = substr($img, $pos[0][0][1]+56,$len-119);
			
		
			$aData[] = array('title'=>$title,'image'=> $image,'photos_count'=>$count,'link'=>$link->href);
	
		
		}
	return $aData;
	
	}
	
	public function slideshow($user,$size,$album="")
	{
		if($album == ""){
			$embed = '<embed type="application/x-shockwave-flash" src="https://picasaweb.google.com/s/c/bin/slideshow.swf" width="'.$size[0].'" height="'.$size[1].'" flashvars="host=picasaweb.google.com&hl=en_US&feat=flashalbum&RGB=0x000000&feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2F'.$user.'%3Falt%3Drss%26kind%3Dphoto%26access%3Dpublic%26psc%3DF%26q%26uname%3D'.$user.'" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
		}else{
			$embed = '<embed type="application/x-shockwave-flash" src="https://picasaweb.google.com/s/c/bin/slideshow.swf" width="'.$size[0].'" height="'.$size[1].'" flashvars="host=picasaweb.google.com&hl=en_US&feat=flashalbum&RGB=0x000000&feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2F'.$user.'%2Falbumid%2F'.$album.'%3Falt%3Drss%26kind%3Dphoto%26hl%3Den_US" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
		}
		
		return $embed;
		
	}
	
	
}