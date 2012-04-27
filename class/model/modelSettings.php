<?php
class modelSettings extends Model
{
	
	public function execInsert($aArgs)
	{
		 if($this->getCount($aArgs[iSeq]) > 0){
			$this->execDelete($aArgs[iSeq]);
		} 
		$sSql = "INSERT INTO picasaalbum_settings (seq,username,show_type,album_type,album_selected,size_option,size,albums) VALUES('$aArgs[iSeq]','$aArgs[username]|$aArgs[userId]','$aArgs[view_type]','$aArgs[manage_album]','$aArgs[album_selected]','$aArgs[size_option]','$aArgs[picasa_size]','$aArgs[albums]')";
		return $this->query($sSql);
	}
	
	public function getCount($seq)
	{
		$sQuery = "SELECT count(*) as count FROM picasaalbum_settings WHERE seq = ".$seq;
		$mResult = $this->query($sQuery);
		return $mResult[0]['count'];
	}
	
	public function execDelete($seq)
	{
		$sSql = "DELETE FROM picasaalbum_settings WHERE seq = ".$seq;
		return $this->query($sSql);
	}
	
	public function getSettings($seq)
	{
		$sSql = "SELECT * FROM picasaalbum_settings WHERE seq = ".$seq;
		return $this->query($sSql);
		
	}
	
	public function deleteContentsBySeq($aSeq)
	{
		$sSeqs = implode(',', $aSeq);
		$sQuery = "DELETE FROM picasaalbum_settings WHERE seq IN($sSeqs)";
		$mResult = $this->query($sQuery);
		return $mResult;
	}
	

}