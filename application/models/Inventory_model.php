<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends MY_Model {

    /**
     * It will get all the records of departments for ajax datatable
     * @param  : $condition - array
     * @return : Object
     * @author PAV [Last Edited : 03/02/2018]
     */
	public function get_departments_data($type){
		$columns = ['d.id', 'd.name', 'd.description', 't.is_delete'];
        $keyword = $this->input->get('search');
        $this->db->select('d.*');
        $this->db->where(array(
            'd.is_delete' => 0
        ));
        if (!empty($keyword['value'])) {
            $where = '(d.name LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.description LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR DATE_FORMAT(d.modified_date, "%m-%d-%Y %I:%i %p") LIKE "%' . $keyword['value'] . '%")';
            $this->db->where($where);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        if ($type == 'count') {
            $query = $this->db->get(TBL_DEPARTMENTS . ' d');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_DEPARTMENTS . ' d');
            return $query;
        }
	}

    /**
     * It will get all the records of vendor for ajax datatable
     * @param  : $type - string
     * @return : Object
     * @author PAV [Last Edited : 20/02/2018]
     */
	public function get_vendors_data($type){
		$columns = ['v.id', 'v.name', 'v.contact_person', 'v.description', 'v.is_delete'];
        $keyword = $this->input->get('search');
        $this->db->select('v.*');
        $this->db->where(array(
            'v.is_delete' => 0
        ));
        if (!empty($keyword['value'])) {    
            $where = '(v.name LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.description LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.contact_person LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.contact_no LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR DATE_FORMAT(v.modified_date, "%m-%d-%Y %I:%i %p") LIKE "%'.$keyword['value'].'%")';
            $this->db->where($where);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        if ($type == 'count') {
            $query = $this->db->get(TBL_VENDORS . ' v');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_VENDORS . ' v');
            return $query;
        }
	}

    /**
     * It will get all the records of items for ajax datatable
     * @param  : $type - string
     * @return : Object
     * @author PAV [Last Edited : 20/02/2018]
     */
	public function get_items_data($type){
		$columns = ['i.id', 'i.part_no', 'd.name', 'v.name', 'i.new_unit_cost', 'i.qty_on_hand', 'i.is_delete'];
        $keyword = $this->input->get('search');
        $this->db->select('i.*,d.name as dept_name, v.name as pref_vendor_name');
        $this->db->where(array(
            'i.is_delete' => 0
        ));
        if (!empty($keyword['value'])){
            $where = '(i.part_no LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR i.internal_part_no LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR d.name LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.name LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR i.preferred_vendor_part LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR i.new_unit_cost LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR i.description LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR DATE_FORMAT(i.modified_date, "%m-%d-%Y %I:%i %p") LIKE "%'.$keyword['value'].'%")';
            $this->db->where($where);
        }
        $this->db->join(TBL_DEPARTMENTS.' as d','i.department_id=d.id','left');
        $this->db->join(TBL_VENDORS.' as v','i.preferred_vendor=v.id','left');
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        if ($type == 'count') {
            $query = $this->db->get(TBL_ITEMS . ' i');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_ITEMS . ' i');
            return $query;
        }
	}

    /**
     * It will get all the records of item bu its id.
     * @param  : $id - Int
     * @return : Object
     * @author PAV [Last Edited : 03/02/2018]
     */
    public function get_item_details($id=''){
        $this->db->select('i.*,v.name as pref_vendor_name');
        $this->db->from(TBL_ITEMS.' as i');
        $this->db->join(TBL_VENDORS.' as v','i.preferred_vendor=v.id and v.is_delete=0','left');
        if($id!=''){
            $this->db->where('i.id',$id);
        }
        $this->db->where(array(
            'i.is_delete'   => 0
        ));
        $this->db->order_by('i.part_no','ASC');
        return $this->db->get();
    }
}

/* End of file Inventory_model.php */
/* Location: ./application/models/Inventory_model.php */