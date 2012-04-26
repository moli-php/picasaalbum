<?php
class modelContents extends Model
{
    function getTableName()
    {
        return strtolower(APP_ID) . '_' . 'contents';
    }

    function getContentsList($aOption)
    {
		$sQuery = "SELECT
			*
			FROM " . $this->getTableName() . "
	 	";

		if ($aOption['seq']) {
    		$sQuery .= " WHERE seq = " . $aOption['seq'];
    		if ($aOption['search_keyword']) $sQuery .= " AND subject LIKE '%" . $aOption['search_keyword'] . "%'";
		} else {
    		if ($aOption['search_keyword']) $sQuery .= " WHERE subject LIKE '%" . $aOption['search_keyword'] . "%'";
		}

		$sQuery .= " ORDER BY date_created DESC;";

		if ($aOption['limit']) $sQuery .= " Limit $aOption[offset], $aOption[limit]";

		$mResult = $this->query($sQuery);
		return $mResult;
    }

    function getContents($iIdx)
    {
		$sQuery = "SELECT
		*
		FROM " . $this->getTableName() . "
		";
		$sQuery .= " WHERE idx = $iIdx";

		$mResult = $this->query($sQuery);

		return $mResult[0];
    }

    function insertContents($aData)
    {
		$sQuery = "INSERT
    		INTO " . $this->getTableName() . "
    		(seq, subject, contents, date_created)
    		 VALUES('".$aData['seq']."', '".$aData['subject']."', '".$aData['contents']."', ".$aData['date_created']."
    		 );
		";

		$mResult = $this->query($sQuery);

		return $mResult;
    }

    function getResultCount($aOption)
    {
		$sQuery = "SELECT
    		count(*) as count
    		FROM " . $this->getTableName() . "
    		WHERE seq = " . $aOption['seq'] . "
		";

		$mResult = $this->query($sQuery);

		return $mResult[0]['count'];
    }

	function insertSetting()
	{
		$sQuery;
		$mResult = $this->query($sQuery);
		return $mResult;
	}

	function deleteContents($aIdx)
	{
	    $sIdxs = implode(',', $aIdx);
        $sQuery = "Delete from " . $this->getTableName() . " where idx in($sIdxs)";
        $mResult = $this->query($sQuery);
        return $mResult;
	}

	function deleteContentsBySeq($aSeq)
	{
	    $sSeqs = implode(',', $aSeq);
        $sQuery = "Delete from " . $this->getTableName() . " where seq in($sSeqs)";
        $mResult = $this->query($sQuery);
        return $mResult;
	}

    function getSeqCount()
    {
        $sQuery = "SELECT seq, count(seq) AS value FROM " . $this->getTableName() . " GROUP BY seq ORDER BY seq asc;";
        return $this->query($sQuery);
    }
}