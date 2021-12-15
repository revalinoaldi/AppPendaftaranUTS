<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PendaftaranModel','daftar');
	}

	public function index()
	{
		$this->load->view('dashboard', '', FALSE);
	}

	public function action()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('bank', 'Nama Bank', 'trim|required');
		$this->form_validation->set_rules('tgl_transfer', 'Tanggal Transfer', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
		$this->form_validation->set_rules('an_bank', 'Atas Nama Bank', 'trim|required');
		// $this->form_validation->set_rules('gambar', 'Bukti Bayar', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
			$this->session->set_flashdata('notif', $alert);
			redirect('Dashboard','refresh');
		} else {
			$filename = 'bukti_'.str_replace('.', '', strtolower($this->input->post('nama'))).'_'.date('dmY',strtotime($this->input->post('tgl_transfer')));
			$upload = $this->daftar->upload($filename);
			if ($upload['result'] == 'success') {
				$dataIns = [
					'nama' => $this->input->post('nama'),
					'tempat_lahir' => $this->input->post('tmp_lahir'),
					'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tgl_lahir'))),
					'hp' => $this->input->post('no_hp'),
					'email' => $this->input->post('email'),
					'nominal' => $this->input->post('nominal'),
					'bank' => $this->input->post('bank'),
					'anbank' => $this->input->post('an_bank'),
					'tanggal_transfer' => date('Y-m-d', strtotime($this->input->post('tgl_transfer'))),
					'gambar' => $upload['file']['file_name']
				];

				$ins = $this->daftar->insert($dataIns);
				if ($ins) {
					// $a = $this->sendmail($dataIns['email'],'Test Uji Coba');
					$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Success Proses Save Record
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('notif', $alert);
					redirect('Dashboard','refresh');
				}else{
					$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Error!</strong> Error Proses Save Record, please try again!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('notif', $alert);
					redirect('Dashboard','refresh');
				}
			}else{
				$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Error!</strong> '.$upload['error'].'
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Dashboard','refresh');
			}
		}
	}

	public function sendmail($to,$subject)
	{

		$mail = new PHPMailer(true);

		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host       = 'smtp.googlemail.com';
			$mail->SMTPAuth   = true;
            $mail->Username   = 'farhan.aldiansyah245@gmail.com'; // ubah dengan alamat email Anda
            $mail->Password   = 'joey6661'; // ubah dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('farhan.aldiansyah245@gmail.com', 'Pendaftaran Online'); // ubah dengan alamat email Anda
            $mail->addReplyTo('farhan.aldiansyah245@gmail.com', 'Information'); // ubah dengan alamat email Anda
            $mail->addAddress($to);
            $mail->addCC('revalinoaldi@gmail.com');

            // Isi Email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $message = '<h1>Hellow this send data</h1>';
            $mail->Body    = $message;

            $mail->send();

   // Pesan Berhasil Kirim Email/Pesan Error

            return true;
        } catch (Exception $e) {
        	return false;
        }
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */