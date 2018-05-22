<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends MY_Model {
	
	public function get_transponder_report($condition){
		extract($condition);
		$this->db->select('t.*,c.name as make_name,m.name as model_name,y.name as year_name,i.qty_on_hand');
		$this->db->from(TBL_TRANSPONDER.' as t');
		$this->db->join(TBL_COMPANY.' as c','t.make_id=c.id and c.is_delete=0 and c.status="active"','left');
		$this->db->join(TBL_MODEL.' as m','t.model_id=m.id and m.is_delete=0 and m.status="active"','left');
		$this->db->join(TBL_YEAR.' as y','t.year_id=y.id and y.is_delete=0','left');
		$this->db->join(TBL_TRANSPONDER_ITEMS.' as ti','t.id=ti.transponder_id','left');
        $this->db->join(TBL_ITEMS.' as i','ti.items_id=i.id','left');
		if(!empty($condition)){
			if(isset($keyword) && $keyword!=''){
				$this->db->group_start();
					$this->db->like('y.name',$keyword);
					$this->db->or_like('c.name',$keyword);
					$this->db->or_like('m.name',$keyword);
				$this->db->group_end();
			}
			if(isset($strattec_non_remote_key) && $strattec_non_remote_key!=''){
				$this->db->where('i.part_no',$strattec_non_remote_key);
			}
			if(isset($status) && $status!='all'){
				$this->db->where('t.status',$status);
			}
		}
		$this->db->where('t.is_delete',0);
		$this->db->group_by('t.id');
		$this->db->order_by('make_name');
		return $this->db->get();
	}
}

/* End of file Reports.php */
/* Location: ./application/models/Reports.php */