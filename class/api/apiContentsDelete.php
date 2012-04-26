<?php
class apiContentsDelete extends Controller_Api
{
    protected function post($aArgs)
    {
        require_once('builder/builderInterface.php');
        usbuilder()->init($this, $aArgs);

        $aIdx = explode(',', $aArgs['idx']);
		$bResult = common()->modelContents()->deleteContents($aIdx);

		if ($bResult !== false) {
            $sResult = 'true';
	    } else {
	        $sResult = 'false';
	    }

        return $sResult;
	}
}