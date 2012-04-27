<?php 
class adminPageSettings extends Controller_Admin
{
	protected function run($aArgs)
	{
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		usbuilder()->validator(array('form' => 'picasaAlbumSettings'));
		$oModel = new modelSettings();
		
		$aSettings = $oModel->getSettings($aArgs[seq]);
		$this->assign('seq',$aArgs[seq]);
		$this->assign('aSettings',$aSettings[0]);
		$this->importCSS(__CLASS__);
		$this->importJS(__CLASS__);
		
		$this->view(__CLASS__);
	}


	
	
}