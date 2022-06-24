<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

class Api extends RestController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model', 'model');
	}

	public function pegawai_get()
	{
		$nip = $this->get('nip');
		if ($nip !== null) {
			$data = $this->model->pegawaiByNip($nip);
			if ($data) {
				$this->response([
					'status' => true,
					'data' => $data
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'NIP tidak ditemukan'
				], RestController::HTTP_NOT_FOUND); 
			}
		} else {
			$this->response([
				'status' => false,
				'message' => 'NIP Kosong'
			], RestController::HTTP_BAD_REQUEST); 
		}
	}

	public function pegawai_put()
	{
		$nip = $this->put('nip');

		if ($nip !== null) {

			$data = array(
				'no_wa' => $this->put('no_wa'),
				'nama_foto' => $this->put('nama_foto'),
			);

			$data = $this->model->update($data, $nip);
			if ($data) {
				$this->response([
					'status' => true,
					'message' => 'Data berhasil diubah'
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'Data Gagal diubah'
				], RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response([
				'status' => false,
				'message' => 'NIP Kosong'
			], RestController::HTTP_BAD_REQUEST);
		}
	}
}
