<?php
class installSequenceDelete
{
    function run($aArgs)
    {
        $bResult = common()->modelContents()->deleteContentsBySeq($aArgs['seq']);
        if ($bResult !== false) {
            return true;
        } else {
            return false;
        }
    }
}