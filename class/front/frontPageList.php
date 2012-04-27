<?php
class frontPageList extends Controller_Front
{
    protected function run($aArgs)
    {
        require_once('builder/builderInterface.php');
        require_once('rss/picasaxml.class.php');
        usbuilder()->init($this, $aArgs);
        $picasa = new picasaxml();
        $this->importCSS(__CLASS__);
        $seq = $this->getSequence();
        $sHtml = "";
        $aSettings = common()->modelSettings()->getSettings($seq);
        $count = common()->modelSettings()->getCount($seq);
        $username = explode("|",$aSettings[0][username]);
        
        $aData = $picasa->manage_album($username[1],$aSettings[0][album_selected]);
        
     if($aSettings[0][show_type] == 0){
     	
     	
     	if($aSettings[0][album_selected]){
			
     		$sHtml .= "<div class='picasaHolderList'>";
			$sHtml .= "<h2 class='head_title'>Selected Album</h2>";
			$sHtml .= "<div class='selectedalbum'>";
	     	foreach($aData as $val){
	     		$sHtml .= "<div class='title'><span>Title:</span> ".$val['title']."</div>";
	     		$sHtml .= "<div class='image'>".$val['image']."</div>";
	     	}
	     	$sHtml .= "</div>";
			$sHtml .= "</div>";
	     	
     	}else{
				
     			$sHtml .= "<div class='picasaHolderList '>";
				$sHtml .= "<h2 class='head_title'>All Albums</h2>";
				$sHtml .= "<div class='allalbums'>";
     		foreach($aData as $val){
     			$sHtml .= "<div class='title'><span>Title:</span><a href='".$val['link']."'> ".$val['title']."</a></div>";
     			$sHtml .= "<div class='number'><span>Number of Photos in Album:</span> <span class='count'> (".$val['photos_count'].")</span></div>";
     			$sHtml .= "<div class='image'>".$val['image']."</div>";
     		}
     			$sHtml .= "</div>";
				$sHtml .= "</div>";
     			
     	}
     }elseif($aSettings[0][show_type] == 1){
     	$aSize = explode("|",$aSettings[0][size]);
     	$sHtml .= $picasa->slideshow($username[1], $aSize, $aSettings[0][album_selected]);
     }
    
       $this->assign('sHtml',$sHtml);
      $this->writeJS($this->picasaalbumJs());

    }
    
    
    public function picasaalbumJs()
    {
    	$sJs = '
    
    	sdk_Module("'.usbuilder()->getModuleSelector().'").ready(function($M) {
    
    		$M(".picasaHolderList a").click(function(){
	    		var href = $M(this).attr(\'href\');
				window.open(href);
				return false;
	    		
    		});
    	});';
    	return $sJs;
    }
}
