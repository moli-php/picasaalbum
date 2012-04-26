<?php
class frontPageList extends Controller_Front
{
    protected function run($aArgs)
    {
        require_once('builder/builderInterface.php');
        usbuilder()->init($this, $aArgs);

        $aOption['seq'] = $this->getSequence();
        $aOption['search_keyword'] = usbuilder()->getParam('search_keyword');

        $oModelContents = new modelContents();
        $aContentsList = $oModelContents->getContentsList($aOption);

        for($i=0;$i<count($aContentsList);++$i) {
            $aContentsList[$i]['date_created'] = date('Y-m-d H:i:s', $aContentsList[$i]['date_created']);
        }

        $this->loopFetch($aContentsList);
        $iResultCount = count($aContentsList);

        if ($iResultCount == 0) $this->fetchClear();
    }
}
