<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('dashboard_model','product_model'));
    }
    
    /**
     * This is default function
     * @param --
     * @return --
     * @author PAV [Last Edited : 03/02/2018]
    */
	public function index(){
		if ((!$this->session->userdata('logged_in'))) {
            $this->session->set_flashdata('error', 'Please login to continue!');
            redirect(base_url(), 'refresh');
        }
        $data['title'] = 'Dashboard';
        $data['companyArr'] = $this->dashboard_model->get_all_details(TBL_COMPANY,array('is_delete' => 0,'status' => 'active'))->result_array();
        $data['yearArr'] = $this->dashboard_model->get_all_details(TBL_YEAR,array('is_delete' => 0))->result_array();
        $this->template->load('default', 'login/dashboard', $data);
	}

    /**
     * When change in make dropdown of dashboard
     * @param --
     * @return Object (Json Format)
     * @author PAV [Last Edited : 03/02/2018]
    */
    public function change_make_get_ajax(){
        $make_id = $this->input->post('id');
        $modelArr = $this->product_model->get_all_details(TBL_MODEL,array('make_id'=>$make_id,'status'=>'active','is_delete'=>0),array(array('field'=>'name','type'=>'asc')))->result_array();
        $option = "<option></option>";
        foreach($modelArr as $k => $v){
            $option.="<option value='".$v['id']."'>".$v['name']."</option>";
        }
        echo json_encode($option);
        die;
    }

    /**
     * Get all the transponder details on the basis of make, model, year
     * @param --
     * @return Object (Json Format)
     * @author PAV [Last Edited : 03/02/2018]
    */
    public function get_transponder_details(){
        $make_id = $this->input->post('_make_id');
        $model_id = $this->input->post('_model_id');
        $year_id = $this->input->post('_year_id');
        $condition = array(
            't.make_id'   => $make_id,
            't.model_id'  => $model_id,
            't.year_id'   => $year_id
        );
        $transponder_result = $this->dashboard_model->get_transponder_details($condition)->row_array();
        $table_body = $div_part_list = '';
        if(!empty($transponder_result)){
            $table_body ='<tbody>';
            $table_body.='<tr><td><b>Make</b></td><td>'.$transponder_result['make_name'].'</td></tr>';
            $table_body.='<tr><td><b>Model</b></td><td>'.$transponder_result['model_name'].'</td></tr>';
            $table_body.='<tr><td><b>Year</b></td><td>'.$transponder_result['year_name'].'</td></tr>';
            $table_body.='<tr><td><b>Transponder Equipped</b></td><td>'.ucfirst($transponder_result['transponder_equipped']).'</td></tr>';
            $table_body.='<tr><td><b>Key Type</b></td><td>'.str_replace('_', ' ', join(', ', array_map('ucfirst', explode(',', $transponder_result['key_value'])))).'</td></tr>';
            $table_body.='<tr><td><b>MVP System</b></td><td>'.$transponder_result['mvp_system'].'</td></tr>';
            $table_body.='<tr><td><b>Dongle</b></td><td>'.$transponder_result['dongle'].'</td></tr>';
            $table_body.='<tr><td><b>Pincode Required</b></td><td>'.ucfirst($transponder_result['pincode_required']).'</td></tr>';
            $table_body.='<tr><td><b>Pincode Reading Available</b></td><td>'.$transponder_result['pincode_reading_available'].'</td></tr>';
            $table_body.='<tr><td><b>Key Onboard Progaming</b></td><td>'.$transponder_result['key_onboard_progaming'].'</td></tr>';
            $table_body.='<tr><td><b>Remote Onboard Progaming</b></td><td>'.$transponder_result['remote_onboard_progaming'].'</td></tr>';
            $table_body.='<tr><td><b>IIco</b></td><td>'.$transponder_result['iico'].'</td></tr>';
            $table_body.='<tr><td><b>JMA</b></td><td>'.$transponder_result['jma'].'</td></tr>';
            $table_body.='<tr><td><b>Keyline</b></td><td>'.$transponder_result['keyline'].'</td></tr>';
            $table_body.='<tr><td><b>Strattec Non-Remote Key</b></td><td>'.$transponder_result['strattec_non_remote_key'].'</td></tr>';
            $table_body.='<tr><td><b>Strattec Remote Key</b></td><td>'.$transponder_result['strattec_remote_key'].'</td></tr>';
            $table_body.='<tr><td><b>OEM Non-Remote Key</b></td><td>'.$transponder_result['oem_non_remote_key'].'</td></tr>';
            $table_body.='<tr><td><b>OEM Remote Key</b></td><td>'.$transponder_result['oem_remote_key'].'</td></tr>';
            $table_body.='<tr><td><b>Other Non-Remote Key</b></td><td>'.$transponder_result['other_non_remote_key'].'</td></tr>';
            $table_body.='<tr><td><b>FCC ID#</b></td><td>'.$transponder_result['fcc_id'].'</td></tr>';
            $table_body.='<tr><td><b>Code Series</b></td><td>'.$transponder_result['code_series'].'</td></tr>';
            $table_body.='<tr><td><b>Chip ID</b></td><td>'.$transponder_result['chip_ID'].'</td></tr>';
            $table_body.='<tr><td><b>Transponder Re-Use</b></td><td>'.$transponder_result['transponder_re_use'].'</td></tr>';
            $table_body.='<tr><td><b>Max No of Keys</b></td><td>'.$transponder_result['max_no_of_keys'].'</td></tr>';
            $table_body.='<tr><td><b>Key Shell</b></td><td>'.$transponder_result['key_shell'].'</td></tr>';
            $table_body.='<tr><td><b>Cloneable Chip</b></td><td>'.$transponder_result['cloneable_chip'].'</td></tr>';
            $table_body.='<tr><td><b>Decoders and Readers</b></td><td>'.$transponder_result['decoders_readers'].'</td></tr>';
            $table_body.='<tr><td><b>Tumbler Information</b></td><td>'.$transponder_result['tumbler_info'].'</td></tr>';
            $table_body.='<tr><td><b>Notes</b></td><td>'.$transponder_result['notes'].'</td></tr>';
            $transponder_result['field_name'] = rtrim($transponder_result['field_name'],':-:');
            if($transponder_result['field_name']!=''){
                $field_name_Arr = explode(':-:', $transponder_result['field_name']);
                $field_value_Arr = explode(':-:', $transponder_result['field_value']);
                foreach($field_name_Arr as $k => $v){
                    $table_body.='<tr><td><b>'.ucwords($v).'</b></td><td>'.$field_value_Arr[$k].'</td></tr>';
                }
            }
            $table_body.='</tbody>';
            $parts_no_Arr = explode(':-:', $transponder_result['parts_no']);
            $parts_id_Arr = explode(':-:', $transponder_result['parts_id']);
            $parts_stock_Arr = explode(':-:', $transponder_result['qty_on_hand']);
            $vendor_name_Arr = explode(':-:', $transponder_result['vendor_name']);

            $part_list_Arr = [];
            foreach($vendor_name_Arr as $k => $v){
                if($parts_stock_Arr[$k]>0){
                    $part_list_Arr[$v][] = '<a href="javascript:void(0);" class="btn_home_item_view" title="View" id="'.base64_encode($parts_id_Arr[$k]).'"><span class="label label-success" style="margin:3px;font-size:12px;font-family:monospace;">'.$parts_no_Arr[$k].'</span></a>';
                }else{
                    $part_list_Arr[$v][] = '<a href="javascript:void(0);" class="btn_home_item_view" title="View" id="'.base64_encode($parts_id_Arr[$k]).'"><span class="label label-danger" style="margin:3px;font-size:12px;font-family:monospace;">'.$parts_no_Arr[$k].'</span></a>';
                }
            }

            $vendor_name = '';
            $cnt = 0;
            foreach($part_list_Arr as $k => $v){
                if($vendor_name!=$k){
                    if($cnt>0){ $div_part_list.='<hr style="border-top: 2px solid #ddd;margin: 10px 0;">'; }
                    $vendor_name = $k;
                    $div_part_list.= '<h5 style="margin-bottom:0px">'.$k.'</h5>';
                    $cnt++;
                }
                foreach($v as $key => $value){
                    $div_part_list.= $value;
                }
            }
            // foreach($parts_no_Arr as $k => $v){
            //     if($parts_stock_Arr[$k]>0){
            //         $div_part_list.='<a href="javascript:void(0);" class="btn_home_item_view" title="View" id="'.base64_encode($parts_id_Arr[$k]).'"><span class="label label-success" style="margin:3px;font-size:12px;letter-spacing:1px;font-family:monospace;">'.$v.'</span></a>';
            //     }else{
            //         $div_part_list.='<a href="javascript:void(0);" class="btn_home_item_view" title="View" id="'.base64_encode($parts_id_Arr[$k]).'"><span class="label label-danger" style="margin:3px;font-size:12px;letter-spacing:1px;font-family:monospace;">'.$v.'</span></a>';
            //     }
                
            // }
        }else{
            $table_body = '<tbody>';
            $table_body.= '<tr><td class="text-center"><h1 style="font-weight: 500 !important;color: #b5b3b3 !important;">No Such Data Found.</h1></td></tr>';
            $div_part_list = 'No Data Exists';
        }
        $result = array(
            'table_body'    => $table_body,
            'div_part_list' => $div_part_list
        );
        echo json_encode($result);
        exit;
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */