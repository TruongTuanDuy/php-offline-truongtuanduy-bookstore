<?php
include_once(MODULE_PATH . 'admin/views/toolbar.php');
include_once 'submenu/index.php';

// COLUMN
$columnPost		= @$this->arrParam['filter_column'];
$orderPost		= @$this->arrParam['filter_column_dir'];
$lblName 		= Helper::cmsLinkSort('Name', 'username', $columnPost, $orderPost);
$lblStatus		= Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
$lblDelivery		= Helper::cmsLinkSort('Delivery', 'delivery', $columnPost, $orderPost);
$lblFinish		= Helper::cmsLinkSort('Finish', 'finish', $columnPost, $orderPost);
$lblDate	= Helper::cmsLinkSort('Date', 'date', $columnPost, $orderPost);
$lblID			= Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

// SELECT
$arrStatus			= array('default' => '- Select Status -', 1 => 'Publish',  0 => 'Unpublish');
$selectboxStatus	= @Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, $this->arrParam['filter_state']);

// Pagination
$paginationHTML		= $this->pagination->showPagination(URL::createLink('admin', 'cart', 'index'));

// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);

?>
<div id="system-message-container"><?php echo $strMessage; ?></div>

<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm">
			<!-- FILTER -->
			<fieldset id="filter-bar">
				<div class="filter-search fltlft">
					<label class="filter-search-lbl" for="filter_search">Filter:</label>
					<input type="text" name="filter_search" id="filter_search" value="<?php echo @$this->arrParam['filter_search']; ?>">
					<button type="submit" name="submit-keyword">Search</button>
					<button type="button" name="clear-keyword">Clear</button>
				</div>
				<div class="filter-select fltrt">
					<?php echo $selectboxStatus; ?>
				</div>
			</fieldset>
			<div class="clr"> </div>

			<table class="adminlist" id="modules-mgr">
				<!-- HEADER TABLE -->
				<thead>
					<tr>
						<th width="1%"><input type="checkbox" name="checkall-toggle"></th>
						<th class="title"><?php echo $lblName; ?></th>
						<th width="10%"><?php echo $lblStatus; ?></th>
						<th width="10%"><?php echo $lblDelivery; ?></th>
						<th width="10%"><?php echo $lblFinish; ?></th>
						<th width="10%"><?php echo $lblDate; ?></th>
						<th width="1%" class="nowrap"><?php echo $lblID; ?></th>
					</tr>
				</thead>
				<!-- FOOTER TABLE -->
				<tfoot>
					<tr>
						<td colspan="10">
							<!-- PAGINATION -->
							<div class="container">
								<?php echo $paginationHTML; ?>
							</div>
						</td>
					</tr>
				</tfoot>
				<!-- BODY TABLE -->
				<tbody>
					<?php
					if (!empty($this->Items)) {
						$i = 0;
						foreach ($this->Items as $key => $value) {
							$id 		= $value['id'];
							$ckb		= '<input type="checkbox" name="cid[]" value="' . $id . '">';
							$name		= $value['username'];
							$row		= ($i % 2 == 0) ? 'row0' : 'row1';
							$status		= Helper::cmsStatus($value['status'], URL::createLink('admin', 'cart', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);
							$delivery		= Helper::cmsDelivery($value['delivery'], URL::createLink('admin', 'cart', 'ajaxDelivery', array('id' => $id, 'delivery' => $value['delivery'])), $id);
							$finish		= Helper::cmsFinish($value['finish'], URL::createLink('admin', 'cart', 'ajaxFinish', array('id' => $id, 'finish' => $value['finish'])), $id);
							$date		= $value['date'];
							$linkEdit	= URL::createLink('admin', 'cart', 'form', array('id' => $id));

							echo  '<tr class="' . $row . '">
		                                	<td class="center">' . $ckb . '</td>
		                                	<td><a href="' . $linkEdit . '">' . $name . '</a></td>
			                                <td class="center">' . $status . '</td>
			                                <td class="center">' . $delivery . '</td>
			                                <td class="center">' . $finish . '</td>
			                                <td class="center">' . $date . '</td>
			                                <td class="center">' . $id . '</td>
			                            </tr>';
							$i++;
						}
					}
					?>
				</tbody>
			</table>

			<div>
				<input type="hidden" name="filter_column" value="username">
				<input type="hidden" name="filter_page" value="1">
				<input type="hidden" name="filter_column_dir" value="asc">
			</div>
		</form>

		<div class="clr"></div>
	</div>
</div>
</div>