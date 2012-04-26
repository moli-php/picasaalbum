<?php
class apiSettingsSave extends Controller_Api
{
	
	protected function post($aArgs)
	{
		require_once('builder/builderInterface.php');
		require_once('rss/picasaxml.class.php');
		usbuilder()->init($this, $aArgs);
	
		$picasa = new picasaxml();
		$oModel = new modelSettings();
		$result =  $picasa->get_userId($aArgs['username']);
		$aArgs[userId] = $result;
		if($result !== false){
       		return $oModel->execInsert($aArgs);
		}else{
			return false;
		}
			
	}
	
	
	
	
}