<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    /**
     * It will get all the records of transponder for ajax datatable
     * @param  : $condition - array
     * @return : Object
     * @author PAV [Last Edited : 03/02/2018]
     */
	public function get_transponder_details($condition){
        $this->db->select("t.*,c.name as make_name,c.id as make_id,m.name as model_name,y.name as year_name,GROUP_CONCAT(COALESCE(i.part_no,'') SEPARATOR ':-:') as parts_no,GROUP_CONCAT(COALESCE(i.id,'') SEPARATOR ':-:') as parts_id,GROUP_CONCAT(COALESCE(v.name,'') SEPARATOR ':-:') as vendor_name,GROUP_CONCAT(COALESCE(i.qty_on_hand,'') SEPARATOR ':-:') as qty_on_hand,GROUP_CONCAT(COALESCE(ta.field_name,'') SEPARATOR ':-:') as field_name,GROUP_CONCAT(COALESCE(ta.field_value,'') SEPARATOR ':-:') as field_value");
        $this->db->from(TBL_TRANSPONDER.' as t');
        $this->db->join(TBL_COMPANY.' as c','t.make_id=c.id and c.status="active" and c.is_delete=0','left');
        $this->db->join(TBL_MODEL.' as m','t.model_id=m.id and m.status="active" and m.is_delete=0','left');
        $this->db->join(TBL_YEAR.' as y','t.year_id=y.id and y.is_delete=0','left');
        $this->db->join(TBL_TRANSPONDER_ITEMS.' as ti','t.id=ti.transponder_id','left');
        $this->db->join(TBL_ITEMS.' as i','ti.items_id=i.id','left');
        $this->db->join(TBL_TRANSPONDER_ADDITIONAL.' as ta','t.id=ta.transponder_id','left');
        $this->db->join(TBL_VENDORS.' as v','i.preferred_vendor=v.id','left');
        $this->db->where(array(
            't.is_delete' => 0,
            't.status' => 'active',
        ));
        $this->db->where($condition);
        $this->db->having('parts_no!='.NULL);
        return $this->db->get();
    }
    
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */