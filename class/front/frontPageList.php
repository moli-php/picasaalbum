<?php
class frontPageList extends Controller_Front
{
    protected function run($aArgs)
    {
        require_once('builder/builderInterface.php');
        require_once('rss/picasaxml.class.php');
        usbuilder()->init($this, $aArgs);
        $picasa = new picasaxml();
        $seq = $this->getSequence();
     
        
        $count = common()->modelSettings()->getCount($seq);
       if($count > 0){
       	$aData = common()->modelSettigns()->
       	
       	
       }
//         $aOption['search_keyword'] = usbuilder()->getParam('search_keyword');

//         $oModelContents = new modelContents();
//         $aContentsList = $oModelContents->getContentsList($aOption);

//         for($i=0;$i<count($aContentsList);++$i) {
//             $aContentsList[$i]['date_created'] = date('Y-m-d H:i:s', $aContentsList[$i]['date_created']);
//         }

//         $this->loopFetch($aContentsList);
//         $iResultCount = count($aContentsList);

//         if ($iResultCount == 0) $this->fetchClear();
    }
}
