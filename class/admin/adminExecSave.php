<?php

class adminExecSave extends Controller_AdminExec
{
	protected function run($aArgs)
	{
		
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		
		$oModel = new modelSettings();
		$starrating_star = ($aArgs[starrating_starsize] == "default") ? "default" : substr($aArgs[starrating_starsize], 0,2);
		$thumbs_size = ($aArgs[starrating_thumbsize] == "default") ? "default" : substr($aArgs[starrating_thumbsize], 0,2);
		$num_of_star = ($aArgs[starRating_numberOfStars] == "default")? "default" : $aArgs[starRating_numberOfStars];
		$aArgs[stars_setting] = '{"star":"'.$aArgs[starrating_star].'","star_size":"'.$starrating_star.'","number_of_star":"'.$num_of_star.'"}'; 
		$aArgs[thumbs_setting] = '{"thumbs":"'.$aArgs[starrating_thumb].'","thumbs_size":"'.$thumbs_size.'"}';

		$result = $oModel->execSave($aArgs);
	
		if($result !== false){
			usbuilder()->message('Saved succesfully', 'success');
		}else{
			usbuilder()->message('Save failed','warning');
		}
      
		$sUrl = usbuilder()->getUrl('adminPageSettings');
		$sJsMove = usbuilder()->jsMove($sUrl);
	}
	
}

