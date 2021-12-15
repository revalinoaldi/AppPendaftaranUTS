<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranModel extends CI_Model {

	public function show($where='')
	{
		$this->db->select('*');
		$this->db->from('pendaftaran');
		if (@$where) {
			$this->db->where($where);
		}
		return $this->db->get();
	}	

	public function insert($object)
	{
		$this->db->insert('pendaftaran', $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function upload($filename)
	{
		$config['upload_path'] = './Dokumen/';
		$config['allowed_types'] = 'jpg|png|jpeg|psf';
		$config['max_size']  = '2048';
		$config['min_size']  = '1';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['remove_spaces'] = TRUE;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $filename;
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('gambar')){
			$return = array(
				'result' 	=> 'success', 
				'file'		=>	$this->upload->data(),
				'error' 	=> 	''
			);

			// $this->uploadthumb($return['file']);
			return $return;
		}
		else{
			$return = array(
				'result'	=> 'failed', 
				'file'		=>'', 
				'error'		=>$this->upload->display_errors()
			);
			return $return;
		}
	}

}

/* End of file PendaftaranModel.php */
/* Location: ./application/models/PendaftaranModel.php */