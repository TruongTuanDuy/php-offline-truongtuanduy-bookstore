<?php
include_once(MODULE_PATH . 'admin/views/toolbar.php');
include_once 'submenu/index.php';

// Input
$dataForm 		= @$this->arrParam['form'];
$inputCode		= @Helper::cmsInput('text', 'form[code]', 'code', $dataForm['code'], 'inputbox required', 40);
$inputOrdering	= @Helper::cmsInput('text', 'form[ordering]', 'ordering', $dataForm['ordering'], 'inputbox', 40);
$inputValue	= @Helper::cmsInput('text', 'form[value]', 'value', $dataForm['value'], 'inputbox', 40);
$inputToken		= Helper::cmsInput('hidden', 'form[token]', 'token', time());
$selectStatus	= @Helper::cmsSelectbox('form[status]', null, array('default' => '- Select status -', 1 => 'Publish', 0 => 'Unpublish'), $dataForm['status'], 'width: 150px');
// $selectValue	= @Helper::cmsSelectbox('form[link]', null, array('default' => '- Select rss acp -', 1 => 'Yes', 0 => 'No'), $dataForm['link'], 'width: 150px');

$inputID		= '';
$rowID			= '';
if (isset($this->arrParam['id'])) {
	$inputID	= Helper::cmsInput('text', 'form[id]', 'id', $dataForm['id'], 'inputbox readonly');
	$rowID		= Helper::cmsRowForm('ID', $inputID);
}
// Row
$rowCode		= Helper::cmsRowForm('Code', $inputCode, true);
$rowOrdering	= Helper::cmsRowForm('Ordering', $inputOrdering);
$rowStatus		= Helper::cmsRowForm('Status', $selectStatus);
$rowValue	= Helper::cmsRowForm('Value', $inputValue);

// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container"><?php echo $strMessage . @$this->errors; ?></div>
<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
			<!-- FORM LEFT -->
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php echo $rowCode . $rowStatus . $rowValue . $rowOrdering . $rowID; ?>
					</ul>
					<div class="clr"></div>
					<div>
						<?php echo $inputToken; ?>
					</div>
				</fieldset>
			</div>
			<div class="clr"></div>
			<div>
			</div>
		</form>
		<div class="clr"></div>
	</div>
</div>