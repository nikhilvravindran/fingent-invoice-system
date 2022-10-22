<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	
	public function __construct() {
        parent::__construct();
	}
	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('add-invoice');
		$this->load->view('include/footer');
	}

	public function generate_invoice(){

		$data['invoiceItems']=json_decode($this->input->post('invoice_json'),true);
		$data['invoiceValues']=json_decode($this->input->post('final_details'),true);
		$data['invoice']=$invoice='invoice'.time();
		
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
		'format' => 'A4-L',
		'orientation' => 'L']);
        $html = $this->load->view('genpdf_view',$data,true);
        $mpdf->WriteHTML(html_entity_decode($html));
		$file='invoice/'.$invoice.'.pdf';
		$mpdf->Output($file,'F');
		echo $file;

	}
}
