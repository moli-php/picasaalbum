<?php
class installSequenceDelete
{
    function run($aArgs)
    {
        $bResult = common()->modelSettings()->deleteContentsBySeq($aArgs['seq']);
        if ($bResult !== false) {
            return true;
        } else {
            return false;
        }
    }
}