<?php
class frontPageSearch extends Controller_Front
{
    protected function run($aArgs)
    {
        require_once('builder/builderInterface.php');
        usbuilder()->init($this, $aArgs);

        $sResultUrl = $this->_getResultUrl();

        $this->assign('class_search_keyword', 'class_search_keyword');
        $this->assign('class_search_button', 'class_search_button');

        $this->writeJs('
        	sdk_Module("'.usbuilder()->getModuleSelector().'").ready(function($M) {
                $M(".class_search_keyword").val("'.usbuilder()->getParam('search_keyword').'");
                $M(".class_search_button").click(function() {
                    location.href = "'.$sResultUrl.'" + $M(".class_search_keyword").val();
                });
            });
        ');
    }

    /**
     * Get result url
     *
     * @var String
     * @return String
     */
    private function _getResultUrl()
    {
        $sNamespace = $this->getOption('block_group');
        $sParamName = usbuilder()->getParamKey('search_keyword');

        $aParseUrl = parse_url($_SERVER['REQUEST_URI']);
        parse_str($aParseUrl['query'], $aParseQuery);

        $aParamExcept = $this->_getParamExcept($sParamName, $sNamespace);

        if(count($aParseQuery)) {
            foreach ($aParseQuery as $sKey => $mVal) {
                if(in_array($sKey, $aParamExcept) == true) {
                    continue;
                } else {
                    $aQueryString[] =  $sKey . '=' . $mVal;
                }
            }
            if (is_array($aQueryString)) $sQueryString = join('&', $aQueryString);
        }

        $sResultUrl = ($this->getOption('result_url')) ? $this->getOption('result_url') : $aParseUrl['path'];

        if($sQueryString) {
            $sUrl = $sResultUrl . '?' . $sQueryString . '&' . $sParamName . '=';
        } else {
            $sUrl = $sResultUrl . '?' . $sParamName . '=';
        }

        return $sUrl;
    }

    /**
     * Get except param
     *
     * @return Array
     */
    private function _getParamExcept($sParamName, $sNamespace)
    {
        $aParamExcept[] = $sParamName;
        $aParamExcept[] = usbuilder()->getParamKey() . 'page';
        $aParamExcept[] = usbuilder()->getParamKey() . 'category';
        $aParamExcept[] = usbuilder()->getParamKey() . 'archive';
        $aParamExcept[] = usbuilder()->getParamKey() . 'release';

        return $aParamExcept;
    }
}
