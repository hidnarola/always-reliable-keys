<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('product_model','reports_model'));
	}

	/**
     * Displaying data of transponder
     * @param --
     * @return --
     * @author PAV [Last Edited : 03/02/2018]
     */
	public function get_transponder_report(){
		$data['title'] = 'Reports - Transponder';
		$condition = array();
		$data['dataArr'] = $this->reports_model->get_transponder_report($condition)->result_array();
		$this->template->load('default', 'admin/reports/transponder', $data);
	}

	/**
     * Used to do get transponder's reports data by ajax as per filtration
     * @param --
     * @return Json data
     * @author PAV [Last Edited : 03/02/2018]
     */
	public function get_transponder_report_ajax(){
		$txt_search 		= htmlentities($this->input->post('txt_search'));
		$txt_strattec_part 	= htmlentities($this->input->post('txt_strattec_part'));
		$txt_status 		= htmlentities($this->input->post('txt_status'));
		$condition = array();
		$condition['keyword'] = $txt_search;
		$condition['strattec_non_remote_key'] = $txt_strattec_part; 
		$condition['status'] = $txt_status;

		$dataArr = $this->reports_model->get_transponder_report($condition)->result_array();
		//echo $this->db->last_query();
		$tbl_body = '';
		foreach($dataArr as $k => $v){
			if($v['qty_on_hand']>0){ 
				$ava = '<span class="label bg-success-400">IN STOCK</span>'; 
			} else { 
				$ava = '<span class="label bg-danger-400">OUT OF STOCK</span>'; 
			}
			$cnt = $k+1;
			$tbl_body.= '<tr>';
			$tbl_body.= '<td>'.$cnt.'</td>';
	        $tbl_body.= '<td>'.$v['year_name'].'</td>';
	        $tbl_body.= '<td>'.$v['make_name'].' '.$v['model_name'].'</td>';
	        $tbl_body.= '<td>'.$ava.'</td>';
	        $tbl_body.= '</tr>';
		}
		echo json_encode($tbl_body);
		die;
	}

}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */