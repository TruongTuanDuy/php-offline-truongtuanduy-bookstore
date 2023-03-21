<?php
class StudentModel extends Model
{

	private $_columns = array('id', 'fullname', 'score', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');
	private $_userInfo;

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_STUDENT);

		$userObj 			= Session::get('user');
		$this->_userInfo 	= $userObj['info'];
	}

	public function countItem($arrParam, $option = null)
	{

		$query[]	= "SELECT COUNT(`id`) AS `total`";
		$query[]	= "FROM `$this->table`";
		$query[]	= "WHERE `id` > 0";

		// FILTER : KEYWORD
		if (!empty($arrParam['filter_search'])) {
			$keyword	= '"%' . $arrParam['filter_search'] . '%"';
			$query[]	= "AND `fullname` LIKE $keyword";
		}

		// FILTER : STATUS
		if (isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default') {
			$query[]	= "AND `status` = '" . $arrParam['filter_state'] . "'";
		}

		// FILTER : STUDENT ACP
		if (isset($arrParam['filter_score']) && $arrParam['filter_score'] != 'default') {
			$query[]	= "AND `score` = '" . $arrParam['filter_score'] . "'";
		}

		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);
		return $result['total'];
	}

	public function listItem($arrParam, $option = null)
	{
		$query[]	= "SELECT `id`, `fullname`, `score`, `status`, `ordering`, `created`, `created_by`, `modified`, `modified_by`";
		$query[]	= "FROM `$this->table`";
		$query[]	= "WHERE `id` > 0";

		// FILTER : KEYWORD
		if (!empty($arrParam['filter_search'])) {
			$keyword	= '"%' . $arrParam['filter_search'] . '%"';
			$query[]	= "AND `fullname` LIKE $keyword";
		}

		// FILTER : STATUS
		if (isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default') {
			$query[]	= "AND `status` = '" . $arrParam['filter_state'] . "'";
		}

		// FILTER : STUDENT ACP
		if (isset($arrParam['filter_score']) && $arrParam['filter_score'] != 'default') {
			$query[]	= "AND `score` = '" . $arrParam['filter_score'] . "'";
		}

		// SORT
		if (!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir'])) {
			$column		= $arrParam['filter_column'];
			$columnDir	= $arrParam['filter_column_dir'];
			$query[]	= "ORDER BY `$column` $columnDir";
		} else {
			$query[]	= "ORDER BY `id` DESC";
		}

		// PAGINATION
		$pagination			= $arrParam['pagination'];
		$totalItemsPerPage	= $pagination['totalItemsPerPage'];
		if ($totalItemsPerPage > 0) {
			$position	= ($pagination['currentPage'] - 1) * $totalItemsPerPage;
			$query[]	= "LIMIT $position, $totalItemsPerPage";
		}

		$query		= implode(" ", $query);

		// echo '<h3 style="color:red">' . $query . '</h3>';
		$result		= $this->fetchAll($query);
		return $result;
	}

	public function changeStatus($arrParam, $option = null)
	{
		if ($option['task'] == 'change-ajax-status') {
			$status 		= ($arrParam['status'] == 0) ? 1 : 0;
			$modified_by	= $this->_userInfo['username'];
			$modified		= date('Y-m-d', time());
			$id		= $arrParam['id'];
			$query	= "UPDATE `$this->table` SET `status` = $status, `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` = '" . $id . "'";
			$this->query($query);

			$result = array(
				'id'		=> $id,
				'status'	=> $status,
				'link'		=> URL::createLink('admin', 'student', 'ajaxStatus', array('id' => $id, 'status' => $status))
			);
			return $result;
		}

		if ($option['task'] == 'change-ajax-student-acp') {
			$score 	= ($arrParam['score'] == 0) ? 1 : 0;
			$modified_by	= $this->_userInfo['username'];
			$modified		= date('Y-m-d', time());
			$id			= $arrParam['id'];
			$query		= "UPDATE `$this->table` SET `score` = $score, `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` = '" . $id . "'";
			$this->query($query);

			$result = array(
				'id'		=> $id,
				'score'	=> $score,
				'link'		=> URL::createLink('admin', 'student', 'ajaxACP', array('id' => $id, 'score' => $score))
			);
			return $result;
		}

		if ($option['task'] == 'change-status') {
			$status 		= $arrParam['type'];
			$modified_by	= $this->_userInfo['username'];
			$modified		= date('Y-m-d', time());
			if (!empty($arrParam['cid'])) {
				$ids		= $this->createWhereDeleteSQL($arrParam['cid']);
				$query		= "UPDATE `$this->table` SET `status` = $status, `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` IN ($ids)";
				$this->query($query);
				Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->affectedRows() . ' phần tử được thay đổi trạng thái!'));
			} else {
				Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muỗn thay đổi trạng thái!'));
			}
		}
	}

	public function deleteItem($arrParam, $option = null)
	{
		if ($option == null) {
			if (!empty($arrParam['cid'])) {
				$ids		= $this->createWhereDeleteSQL($arrParam['cid']);
				$query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
				$this->query($query);
				Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->affectedRows() . ' phần tử được xóa!'));
			} else {
				Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muỗn xóa!'));
			}
		}
	}

	public function infoItem($arrParam, $option = null)
	{
		if ($option == null) {
			$query[]	= "SELECT `id`, `fullname`, `score`, `status`, `ordering`";
			$query[]	= "FROM `$this->table`";
			$query[]	= "WHERE `id` = '" . $arrParam['id'] . "'";
			$query		= implode(" ", $query);
			$result		= $this->fetchRow($query);
			return $result;
		}
	}

	public function saveItem($arrParam, $option = null)
	{

		if ($option['task'] == 'add') {
			$arrParam['form']['created']	= date('Y-m-d', time());
			$arrParam['form']['created_by']	= $this->_userInfo['username'];
			$data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
			return $this->lastID();
		}
		if ($option['task'] == 'edit') {
			$arrParam['form']['modified']	= date('Y-m-d', time());
			$arrParam['form']['modified_by'] = $this->_userInfo['username'];
			$data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
			$this->update($data, array(array('id', $arrParam['form']['id'])));
			Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
			return $arrParam['form']['id'];
		}
	}

	public function ordering($arrParam, $option = null)
	{
		if ($option == null) {
			if (!empty($arrParam['order'])) {
				$i = 0;
				$modified_by	= $this->_userInfo['username'];
				$modified		= date('Y-m-d', time());
				foreach ($arrParam['order'] as $id => $ordering) {
					$i++;
					$query	= "UPDATE `$this->table` SET `ordering` = $ordering, `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` = '" . $id . "'";
					$this->query($query);
				}
				Session::set('message', array('class' => 'success', 'content' => 'Có ' . $i . ' phần tử được thay đỏi  ordering!'));
			}
		}
	}
}
