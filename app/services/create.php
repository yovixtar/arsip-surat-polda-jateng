<?php
/*
	 * PROSES Tambah  
	 */
class create
{
	protected $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	function add_arsip_surat($data)
	{
		$sql = 'INSERT INTO arsip_surat (substansi_id, sumber_surat_id, nomor_surat, pelapor, polres_id, jenis_masalah, status_penyelesaian, keterangan, tanggal_surat, bukti, created_at) VALUES (?,?,?,?,?,?,?,?,?,?, now() )';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	
	function add_substansi($substansi)
	{
		$data[] = $substansi;

		$sql = 'INSERT INTO substansi (name) VALUES(?)';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	function add_sumber_surat($sumber_surat)
	{
		$data[] = $sumber_surat;

		$sql = 'INSERT INTO sumber_surat (name) VALUES(?)';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	function add_polres($polres)
	{
		$data[] = $polres;

		$sql = 'INSERT INTO polres (name) VALUES(?)';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
}
