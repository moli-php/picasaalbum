<?php var_dump($aSettings);?>
<hr>
<?php 
$username = explode("|",$aSettings[username]);


?>
<form class="picasaAlbumSettings" id="picasaAlbumSettings" name="picasaAlbumSettings" method="post">
<table class="">
	<colgroup>
		<col width="180px" />
		<col width="*" />
	</colgroup>
	<tr>
		<td>Picasa Username</td>
		<td colspan="2"><input type="text" name="picasa_username" id="picasa_username" value="<?php echo $username[0];?>" size="50" fw-filter="isFill"/>&nbsp;&nbsp;<a href="#">Don't have account?</a></td>
	</tr>
	<tr>
		<td>View Type</td>
		<td ><label for="picasa_view">Picasa Albums </label><input type="radio" name="picasa_view" value="0" <?php if($aSettings['show_type'] == 0||$aSettings['show_type'] == ""){echo "checked";} ?>/><img src="" width="150" height="100"/></td>
		<td ><label for="picasa_view">Picasa Slideshow </label><input type="radio" name="picasa_view" value="1" <?php if($aSettings['show_type'] == 1){echo "checked";} ?>/><img src="/_sdk/img/picasaalbum/settings/slideshow.gif" width="150" height="100"/></td>
	</tr>
	<tr>
		<td>Manage Album</td>
		<td colspan="2">
		<label for="picasa_showtype">Show all albums </label><input type="radio" name="picasa_showtype" value="0" <?php if($aSettings['album_type'] == 0 || $aSettings['album_type'] == ""){echo "checked";} ?> />
		<label for="picasa_showtype">Show per album </label><input type="radio" name="picasa_showtype" value="1"/ <?php if($aSettings['album_type'] == 1){echo "checked";} ?> />&nbsp;&nbsp;
		<span id="albumSelect_holder">
		<?php 
		if($aSettings['album_type'] == 1)
		{
			$options = "<select id='albumSelect'>";
			$albums = json_decode($aSettings['albums']);
			$album_ids = explode(",",$albums->album_ids);
			$album_text = explode(",",$albums->album_text);
			foreach($album_ids as $key => $val){
				$selected = $album_ids[$key] == $aSettings['album_selected'] ? "selected" : "";
				$options .= "<option value='".$album_ids[$key]."' ".$selected.">".$album_text[$key]."</option>";
			}
			$options .= "</select>";
			echo $options;
		}
		?>
		
		</span>
		</td>
	</tr>
	<tr <?php if($aSettings['show_type'] == 0){echo "style='display:none;'";}elseif($aSettings['show_type'] == ""){echo "style='display:none;'";} ?>>
		<td>Slidesshow Size</td>
		<td colspan="2">
		<label for="picasa_slideSize">Default </label><input type="radio" name="picasa_slideSize" value="0" <?php if($aSettings['size_option'] == 0||$aSettings['size_option'] == ""){echo "checked";} ?>/>&nbsp;&nbsp;
		<label for="picasa_slideSize">Medium </label><input type="radio" name="picasa_slideSize" value="1" <?php if($aSettings['size_option'] == 1){echo "checked";} ?>/>&nbsp;&nbsp;
		<label for="picasa_slideSize">Large </label><input type="radio" name="picasa_slideSize" value="2"<?php if($aSettings['size_option'] == 2){echo "checked";} ?>/>&nbsp;&nbsp;
		<label for="picasa_slideSize">Custom </label><input type="radio" name="picasa_slideSize" value="3"<?php if($aSettings['size_option'] == 3){echo "checked";} ?>/>&nbsp;&nbsp;
		<span class="slide_custom_holder" <?php if($aSettings['size_option'] == 3){echo "style='display:visible'"; $size = explode("|",$aSettings[size]);}else{echo "style='display:none;'";} ?>>
		<label for="picasa_width">Width </label><input type="text" size="3" id="picasa_width" maxlength="4" value="<?php echo $size[0];?>"/>&nbsp;&nbsp;
		<label for="picasa_height">Height </label><input type="text" size="3" id="picasa_height" maxlength="4" value="<?php echo $size[1];?>"/>&nbsp;&nbsp;
		</span>
		</td>
	</tr>

</table>

<div class="tbl_lb_wide_btn">
    <a href="#" id="ButtonSave" class="btn_apply btn_settings" title="Save changes">Save</a>
    <a href="#" id="ButtonReset" class="add_link btn_settings" title="Reset to default">Reset to Default</a>
   <input type="hidden" id="seq" value="<?php echo $seq;?>" />
</div>
</form>