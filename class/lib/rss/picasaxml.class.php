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
	$user = $this->input->post('username');
	$album = $this->input->post('album');
	$rss = $this->rss_picasa($user,$album);
	
	foreach($rss->entry as $val){
	
		$img = (string)$val->summary;
		$title = (string)$val->title;
		preg_match_all('/#333333/',$img, $pos1, PREG_OFFSET_CAPTURE,320);
		preg_match_all('/<\/font>/',$img, $pos2, PREG_OFFSET_CAPTURE,$pos1[0][0][1]);
		preg_match_all('/<\/font>/',$img, $pos3, PREG_OFFSET_CAPTURE,$pos1[0][1][1]);
		$minus = ($pos2[0][0][1] - $pos1[0][0][1]) -9;
		$minus2 = ($pos3[0][0][1] - $pos1[0][1][1]);
		$image = substr($img, strpos($img,"<a"),strpos($img,"</a>")-34 );
		$date = substr($img, $pos1[0][0][1]+9,$minus);
		$count = substr($img, $pos1[0][1][1]+9,$minus2-9);
	
		$aData[] = array('title'=>$title,'image'=> $image,'date'=>$date,'photos_count'=>$count);
	
	
	}
	
	echo json_encode($aData);
	}
	
	
}