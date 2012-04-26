
<form class="picasaalbumSettings" id="picasaalbumSettings" name="picasaalbumSettings" method="post">
<table class="">
	<colgroup>
		<col width="180px" />
		<col width="*" />
	</colgroup>
	<tr>
		<td>Picasa Username</td>
		<td colspan="2"><input type="text" name="fusername" id="fusername" />&nbsp;&nbsp;<a href="">Don't have account?</a></td>
	</tr>
	<tr>
		<td>View Type</td>
		<td ><label for="fview">Picasa Albums </label><input type="radio" name="fview" id="fview" value="albums" /><img src="" width="150" height="100"/></td>
		<td ><label for="fview">Picasa Slideshow </label><input type="radio" name="fview" id="fview" value="slideshow" /><img src="/_sdk/img/picasaalbum/settings/slideshow.gif" width="150" height="100"/></td>
	</tr>
	<tr>
		<td>Manage Album</td>
		<td colspan="2">
		<label for="falbumtype">Show all albums </label><input type="radio" name="fshowtype" value="all_album"/>
		<label for="falbumtype">Show per album </label><input type="radio" name="fshowtype" value="per_album"/>&nbsp;&nbsp;<select class="albumSelect" style="display:none;">></select>
		</td>
	</tr>
	<tr>
		<td>Slidesshow Size</td>
		<td colspan="2">
		<label for="falbumtype">Default </label><input type="radio" name="fslideSize" value="size_default"/>&nbsp;&nbsp;
		<label for="falbumtype">Medium </label><input type="radio" name="fslideSize" value="size_medium"/>&nbsp;&nbsp;
		<label for="falbumtype">Large </label><input type="radio" name="fslideSize" value="size_large"/>&nbsp;&nbsp;
		<label for="falbumtype">Custom </label><input type="radio" name="fslideSize" value="size_custom"/>&nbsp;&nbsp;
		<span class="slide_custom_holder" style="display:none;">
		<label for="falbumtype">Width </label><input type="text" size="3" name="fwidth" maxlength="4" />&nbsp;&nbsp;
		<label for="falbumtype">Height </label><input type="text" size="3" name="fheight" maxlength="4" />&nbsp;&nbsp;
		</span>
		</td>
	</tr>

</table>

<div class="tbl_lb_wide_btn">
    <a href="#" id="ButtonSave" class="btn_apply btn_settings" title="Save changes">Save</a>

    <a href="#" id="ButtonReset" class="add_link btn_settings" title="Reset to default">Reset to Default</a>
   
</div>
</form>