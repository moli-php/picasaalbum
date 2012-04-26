<?php
class frontPageDetail extends Controller_Front
{
    protected function run($aArgs)
    {
        $oModelContents = new modelContents();
        $aContents = $oModelContents->getContents($aArgs['idx']);

        $aContents['date_created'] = date('Y-m-d H:i:s', $aContents['date_created']);

    	$this->assign('subject', $aContents['subject']);
    	$this->assign('contents', $aContents['contents']);
    	$this->assign('date_created', $aContents['date_created']);
    }
}
