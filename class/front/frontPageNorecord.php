<?php
class frontPageNorecord extends Controller_Front
{
    protected function run($aArgs)
    {
        $oModelContents = new modelContents();
        $iResultCount = $oModelContents->getResultCount($aOption);

        if ($iResultCount > 0) $this->fetchClear();
    }
}
