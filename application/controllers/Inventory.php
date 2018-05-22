<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('inventory_model'));
		controller_validation();
	}

	/**********************************************************
						Manage Items
	**********************************************************/
		/**
	     * Display All items 
	     * @param --
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function display_items(){
			$data['title'] = 'List of items';
			$this->template->load('default','admin/inventory/items_display',$data);
		}

		/**
	     * Get all the data of items for displaying in ajax datatable
	     * @param --
	     * @return Object (Json Format)
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function get_items_data(){
			$final['recordsTotal'] = $this->inventory_model->get_items_data('count');
            $final['redraw'] = 1;
            $final['recordsFiltered'] = $final['recordsTotal'];
            $items = $this->inventory_model->get_items_data('result')->result_array();
            $start = $this->input->get('start') + 1;
            foreach ($items as $key => $val) {
                $items[$key] = $val;
                $items[$key]['sr_no'] = $start++;
                $items[$key]['modified_date'] = date('m-d-Y h:i A', strtotime($val['modified_date']) + $_COOKIE['currentOffset']);
                $items[$key]['responsive'] = '';
            }
            $final['data'] = $items;
            echo json_encode($final);
            die;
		}

		/**
	     * Add items
	     * @param --
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function add_items(){
			$dept_Arr = $this->inventory_model->get_all_details(TBL_DEPARTMENTS,array('is_delete'=>0),array(array('field'=>'name','type'=>'asc')))->result_array();
			$vendor_Arr =  $this->inventory_model->get_all_details(TBL_VENDORS,array('is_delete'=>0),array(array('field'=>'name','type'=>'asc')))->result_array();
			$this->form_validation->set_rules('txt_item_part', 'Item Part', 'trim|required');
	        $this->form_validation->set_rules('txt_internal_part', 'Internal Part', 'trim|required');
	        $this->form_validation->set_rules('txt_department', 'Department', 'trim|required');
	        $this->form_validation->set_rules('txt_pref_vendor', 'Preffered Vendor', 'trim|required');
	        $this->form_validation->set_rules('txt_pref_vendor_part', 'Preffered Vendor Part', 'trim|required');
	        $this->form_validation->set_rules('txt_item_description', 'Item Description', 'trim|required');
	        if ($this->form_validation->run() == true) {
                $flag = 0;
                $item_image = '';
                if ($_FILES['image_link']['name'] != '') {
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['image_link']['name']);
                    $name = time().".".end($exts);

                    $config['upload_path'] = ITEMS_IMAGE_PATH;
                    $config['allowed_types'] = implode("|", $img_array);
                    $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image_link')) {
                        $flag = 1;
                        $data['item_image_validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $item_image = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
		        	$insertArr = array(
		        		'part_no'				=> htmlentities($this->input->post('txt_item_part')),
		        		'description'			=> htmlentities($this->input->post('txt_item_description')),
		        		'internal_part_no'		=> htmlentities($this->input->post('txt_internal_part')),
		        		'image'					=> $item_image,
		        		'department_id'			=> htmlentities($this->input->post('txt_department')),
		        		'preferred_vendor'		=> htmlentities($this->input->post('txt_pref_vendor')),
		        		'preferred_vendor_part' => htmlentities($this->input->post('txt_pref_vendor_part')),
		        		'preferred_vendor_cost_new'	=> htmlentities($this->input->post('txt_pref_vendor_cost_new')),
		        		'preferred_vendor_cost_refurbished' => htmlentities($this->input->post('txt_pref_vendor_cost_refurbished')),
		        		'secondary_vendor'		=> htmlentities($this->input->post('txt_sec_vendor')),
		        		'secondary_vendor_part' => htmlentities($this->input->post('txt_sec_vendor_part')),
		        		'secondary_vendor_cost_new'	=> htmlentities($this->input->post('txt_sec_vendor_cost_new')),
		        		'secondary_vendor_cost_refurbished' => htmlentities($this->input->post('txt_sec_vendor_cost_refurbished')),
		        		'part_location'			=> htmlentities($this->input->post('txt_part_location')),
		        		// 'new_unit_cost'			=> htmlentities($this->input->post('txt_new_unit_cost')),
		        		// 'refurbished_unit_cost' => htmlentities($this->input->post('txt_ref_unit_cost')),
		        		'new_retail_price'		=> htmlentities($this->input->post('txt_retial_price')),
						'refurbished_retail_price' => htmlentities($this->input->post('txt_ref_retial_price')),
						'msrp' 					=> htmlentities($this->input->post('txt_msrp')),
						'qty_on_hand' 			=> htmlentities($this->input->post('txt_in_stock')),
						'qty_on_order' 			=> htmlentities($this->input->post('txt_in_order')),
						'created_date' 			=> date('Y-m-d h:i:s')
		        	);
		        	$insert_id = $this->inventory_model->insert_update('insert',TBL_ITEMS,$insertArr);
		        	if($insert_id>0){
		                $this->session->set_flashdata('success', 'Data has been added successfully.');
		            } else {
		                $this->session->set_flashdata('error', 'Something went wrong! Please try again.');
		            }
		            redirect('inventory/items');
		        }
	        }

			$data = array(
				'title' 	=> 'Add Items',
				'dept_Arr'	=> $dept_Arr,
				'vendor_Arr'=> $vendor_Arr
			);
			$this->template->load('default','admin/inventory/items_add',$data);
		}

		/**
	     * Edit Items
	     * @param $id - String
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function edit_items($id=''){
			$record_id = base64_decode($id);
			$dept_Arr = $this->inventory_model->get_all_details(TBL_DEPARTMENTS,array('is_delete'=>0),array(array('field'=>'name','type'=>'asc')))->result_array();
			$vendor_Arr =  $this->inventory_model->get_all_details(TBL_VENDORS,array('is_delete'=>0),array(array('field'=>'name','type'=>'asc')))->result_array();
			$dataArr = $this->inventory_model->get_all_details(TBL_ITEMS,array('id'=>$record_id,'is_delete'=>0))->row_array();
			$this->form_validation->set_rules('txt_item_part', 'Item Part', 'trim|required');
	        $this->form_validation->set_rules('txt_internal_part', 'Internal Part', 'trim|required');
	        $this->form_validation->set_rules('txt_department', 'Department', 'trim|required');
	        $this->form_validation->set_rules('txt_pref_vendor', 'Preffered Vendor', 'trim|required');
	        $this->form_validation->set_rules('txt_pref_vendor_part', 'Preffered Vendor Part', 'trim|required');
	        $this->form_validation->set_rules('txt_item_description', 'Item Description', 'trim|required');
	        if ($this->form_validation->run() == true) {
	        	$flag = 0;
                $item_image = '';
                if ($_FILES['image_link']['name'] != '') {
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['image_link']['name']);
                    $name = time().".".end($exts);

                    $config['upload_path'] = ITEMS_IMAGE_PATH;
                    $config['allowed_types'] = implode("|", $img_array);
                    $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image_link')) {
                        $flag = 1;
                        $data['item_image_validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $item_image = $file_info['file_name'];
                    }
                }
                if ($flag != 1) {
		        	$updateArr = array(
		        		'part_no'			=> htmlentities($this->input->post('txt_item_part')),
		        		'description'		=> htmlentities($this->input->post('txt_item_description')),
		        		'internal_part_no'	=> htmlentities($this->input->post('txt_internal_part')),
		        		'department_id'		=> htmlentities($this->input->post('txt_department')),
		        		'preferred_vendor'		=> htmlentities($this->input->post('txt_pref_vendor')),
		        		'preferred_vendor_part' => htmlentities($this->input->post('txt_pref_vendor_part')),
		        		'preferred_vendor_cost_new'	=> htmlentities($this->input->post('txt_pref_vendor_cost_new')),
		        		'preferred_vendor_cost_refurbished' => htmlentities($this->input->post('txt_pref_vendor_cost_refurbished')),
		        		'secondary_vendor'		=> htmlentities($this->input->post('txt_sec_vendor')),
		        		'secondary_vendor_part' => htmlentities($this->input->post('txt_sec_vendor_part')),
		        		'secondary_vendor_cost_new'	=> htmlentities($this->input->post('txt_sec_vendor_cost_new')),
		        		'secondary_vendor_cost_refurbished' => htmlentities($this->input->post('txt_sec_vendor_cost_refurbished')),
		        		'part_location'			=> htmlentities($this->input->post('txt_part_location')),
		        		// 'new_unit_cost'		=> htmlentities($this->input->post('txt_new_unit_cost')),
		        		// 'refurbished_unit_cost' => htmlentities($this->input->post('txt_ref_unit_cost')),
		        		'new_retail_price'	=> htmlentities($this->input->post('txt_retial_price')),
						'refurbished_retail_price' => htmlentities($this->input->post('txt_ref_retial_price')),
						'msrp' 				=> htmlentities($this->input->post('txt_msrp')),
						'qty_on_hand' 		=> htmlentities($this->input->post('txt_in_stock')),
						'qty_on_order' 		=> htmlentities($this->input->post('txt_in_order')),
						'created_date' 		=> date('Y-m-d h:i:s')
		        	);
		        	if($item_image!=''){
		        		$updateArr['image'] = $item_image;
		        	}
		        	$this->inventory_model->insert_update('update',TBL_ITEMS,$updateArr,array('id'=>$record_id));
		            $this->session->set_flashdata('success', 'Data has been updated successfully.');
		            redirect('inventory/items');
		        }
	        }

			$data = array(
				'title' 	=> 'Add Items',
				'dept_Arr'	=> $dept_Arr,
				'vendor_Arr'=> $vendor_Arr,
				'dataArr'	=> $dataArr
			);
			$this->template->load('default','admin/inventory/items_add',$data);
		}

		/**
	     * Delete Items
	     * @param $id - String
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function delete_items($id=''){
			$record_id = base64_decode($id);
            $this->inventory_model->insert_update('update', TBL_ITEMS, array('is_delete' => 1), array('id' => $record_id));
            $this->session->set_flashdata('error', 'Item\'s data has been deleted successfully.');
            redirect('inventory/items');
		}

		/**
	     * Get Item's data by its ID
 	     * @param --
	     * @return HTML data
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function get_item_data_ajax_by_id(){
			$part_id = base64_decode($this->input->post('id'));
			$this->db->select('i.*,d.name as dept_name,v1.name as v1_name,v2.name as v2_name');
			$this->db->from(TBL_ITEMS.' AS i');
			$this->db->join(TBL_DEPARTMENTS.' AS d','i.department_id=d.id','left');
			$this->db->join(TBL_VENDORS.' AS v1','i.preferred_vendor=v1.id','left');
			$this->db->join(TBL_VENDORS.' AS v2','i.secondary_vendor=v2.id','left');
			$this->db->where('i.id',$part_id);
			$result = $this->db->get();
			$data['viewArr'] = $result->row_array();
			//$data['viewArr'] = $this->inventory_model->get_all_details(TBL_ITEMS,array('id'=>$part_id))->row_array();
			return $this->load->view('admin/partial_view/view_search_data', $data);
			die;
		}

	/**********************************************************
						Manage Departments
	**********************************************************/
		/**
	     * Display Departments
	     * @param --
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function display_departments(){
			$data['title'] = 'List of departments';
			$this->template->load('default','admin/inventory/department_display',$data);
		}

		/**
	     * Get Departments data and displaying in ajax datatable listing
	     * @param --
	     * @return Object (Json Format)
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function get_departments_data(){
			$final['recordsTotal'] = $this->inventory_model->get_departments_data('count');
            $final['redraw'] = 1;
            $final['recordsFiltered'] = $final['recordsTotal'];
            $departments = $this->inventory_model->get_departments_data('result')->result_array();
            $start = $this->input->get('start') + 1;
            foreach ($departments as $key => $val) {
                $departments[$key] = $val;
                $departments[$key]['sr_no'] = $start++;
                $departments[$key]['modified_date'] = date('m-d-Y h:i A', strtotime($val['modified_date']) + $_COOKIE['currentOffset']);
                $departments[$key]['responsive'] = '';
            }
            $final['data'] = $departments;
            echo json_encode($final);
            die;
		}

		/**
	     * Add Departments
	     * @param --
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function add_departments(){
			$data['title'] = 'Add departments';
			$this->form_validation->set_rules('txt_name', 'Name', 'trim|required');
	        $this->form_validation->set_rules('txt_desc', 'Description', 'trim|required');
	        if ($this->form_validation->run() == true) {
	        	$insertArr = array(
	        		'name'			=> htmlentities($this->input->post('txt_name')),
	        		'description' 	=> htmlentities($this->input->post('txt_desc'))
	        	);
	        	$insert_id = $this->inventory_model->insert_update('insert',TBL_DEPARTMENTS,$insertArr);
	        	if($insert_id>0){
	                $this->session->set_flashdata('success', 'Data has been added successfully.');
	            } else {
	                $this->session->set_flashdata('error', 'Something went wrong! Please try again.');
	            }
	            redirect('inventory/departments');
	        }
			$this->template->load('default','admin/inventory/department_add',$data);
		}

		/**
	     * Edit Departments
	     * @param $id - String
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function edit_departments($id=''){
			$record_id = base64_decode($id);
			$dataArr = $this->inventory_model->get_all_details(TBL_DEPARTMENTS,array('id'=>$record_id))->row_array();
			$this->form_validation->set_rules('txt_name', 'Name', 'trim|required');
	        $this->form_validation->set_rules('txt_desc', 'Description', 'trim|required');
	        if ($this->form_validation->run() == true) {
	        	$updateArr = array(
	        		'name'			=> htmlentities($this->input->post('txt_name')),
	        		'description' 	=> htmlentities($this->input->post('txt_desc'))
	        	);
	        	$this->inventory_model->insert_update('update',TBL_DEPARTMENTS,$updateArr,array('id'=>$record_id));
	        	$this->session->set_flashdata('success', 'Data has been updated successfully.');
	            redirect('inventory/departments');
	        }
	        $data = array(
	        	'title'		=> 'Edit departments',
	        	'dataArr' 	=> $dataArr
	        );
			$this->template->load('default','admin/inventory/department_add',$data);
		}

		/**
	     * Delete Departments
	     * @param $id - String
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function delete_departments($id){
			$record_id = base64_decode($id);
            $this->inventory_model->insert_update('update', TBL_DEPARTMENTS, array('is_delete' => 1), array('id' => $record_id));
            $this->session->set_flashdata('error', 'Departmanet\'s data has been deleted successfully.');
            redirect('inventory/departments');
		}

	/**********************************************************
						Manage Vendors
	**********************************************************/
		/**
	     * Display Vendors
	     * @param --
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function display_vendors(){
			$data['title'] = 'List of vendors';
			$this->template->load('default','admin/inventory/vendor_display',$data);
		}

		/**
	     * Get vendor's data and displaying in ajax datatable for listing
	     * @param --
	     * @return Object (Json format)
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function get_vendors_data(){
			$final['recordsTotal'] = $this->inventory_model->get_vendors_data('count');
            $final['redraw'] = 1;
            $final['recordsFiltered'] = $final['recordsTotal'];
            $vendors = $this->inventory_model->get_vendors_data('result')->result_array();
            $start = $this->input->get('start') + 1;
            foreach ($vendors as $key => $val) {
                $vendors[$key] = $val;
                $vendors[$key]['sr_no'] = $start++;
                $vendors[$key]['modified_date'] = date('m-d-Y h:i A', strtotime($val['modified_date']) + $_COOKIE['currentOffset']);
                $vendors[$key]['responsive'] = '';
            }
            $final['data'] = $vendors;
            echo json_encode($final);
		}

		/**
	     * Add Vendors
	     * @param --
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function add_vendors(){
			$data['title'] = 'Add vendors';
			$this->form_validation->set_rules('txt_name', 'Name', 'trim|required|max_length[150]');
	        $this->form_validation->set_rules('txt_desc', 'Description', 'trim|required');
	        $this->form_validation->set_rules('txt_contact_person', 'Contact Person', 'trim|required|max_length[150]');
	        $this->form_validation->set_rules('txt_contact_no', 'Contact No', 'trim|required|is_numeric');
	        if ($this->form_validation->run() == true) {
	        	$insertArr = array(
	        		'name'			=> htmlentities($this->input->post('txt_name')),
	        		'description' 	=> htmlentities($this->input->post('txt_desc')),
	        		'contact_person'=> htmlentities($this->input->post('txt_contact_person')),
	        		'contact_no' 	=> htmlentities($this->input->post('txt_contact_no')),
	        		'created_date'	=> date('Y-m-d H:i:s')
	        	);
	        	$insert_id = $this->inventory_model->insert_update('insert',TBL_VENDORS,$insertArr);
	        	if($insert_id>0){
	                $this->session->set_flashdata('success', 'Data has been added successfully.');
	            } else {
	                $this->session->set_flashdata('error', 'Something went wrong! Please try again.');
	            }
	            redirect('inventory/vendors');
	        }
			$this->template->load('default','admin/inventory/vendor_add',$data);
		}

		/**
	     * Edit vendors
	     * @param $id - String
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function edit_vendors($id=''){
			$record_id = base64_decode($id);
			$dataArr = $this->inventory_model->get_all_details(TBL_VENDORS,array('id'=>$record_id))->row_array();
			$this->form_validation->set_rules('txt_name', 'Name', 'trim|required');
	        $this->form_validation->set_rules('txt_desc', 'Description', 'trim|required');
	        $this->form_validation->set_rules('txt_contact_person', 'Contact Person', 'trim');
	        $this->form_validation->set_rules('txt_contact_no', 'Contact No', 'trim');
	        if ($this->form_validation->run() == true) {
	        	$updateArr = array(
	        		'name'			=> htmlentities($this->input->post('txt_name')),
	        		'description' 	=> htmlentities($this->input->post('txt_desc')),
	        		'contact_person'=> htmlentities($this->input->post('txt_contact_person')),
	        		'contact_no' 	=> htmlentities($this->input->post('txt_contact_no'))
	        	);
	        	$this->inventory_model->insert_update('update',TBL_VENDORS,$updateArr,array('id'=>$record_id));
	        	$this->session->set_flashdata('success', 'Data has been updated successfully.');
	            redirect('inventory/vendors');
	        }
	        $data = array(
	        	'title'		=> 'Edit Vendors',
	        	'dataArr' 	=> $dataArr
	        );
			$this->template->load('default','admin/inventory/vendor_add',$data);
		}

		/**
	     * Edit Vendors
	     * @param $id - String
	     * @return --
	     * @author PAV [Last Edited : 03/02/2018]
	    */
		public function delete_vendors($id){
			$record_id = base64_decode($id);
            $this->inventory_model->insert_update('update', TBL_VENDORS, array('is_delete' => 1), array('id' => $record_id));
            $this->session->set_flashdata('error', 'Vendor\'s data has been deleted successfully.');
            redirect('inventory/vendors');
		}


}

/* End of file Inventory.php */
/* Location: ./application/controllers/Inventory.php */