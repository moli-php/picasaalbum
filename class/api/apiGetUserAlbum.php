<?php
class apiGetUserAlbum extends Controller_Api
{
	
	protected function post($aArgs)
	{
		require_once('builder/builderInterface.php');
		require_once('rss/picasaxml.class.php');
		usbuilder()->init($this, $aArgs);
		
		$picasa = new picasaxml();
		return $picasa->picasa_getrss($aArgs['username']);
		
			
	}
	
	
	
	
}