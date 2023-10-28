<?php
/*
	 * PROSES Tambah  
	 */
class update
{
	protected $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	function update_akun($username_old, $password_old, $username_new, $password_new)
	{
		$data[] = $username_new;
		$data[] = $password_new;
		$data[] = $username_old;
		$data[] = $password_old;

		$sql = 'UPDATE users SET username = ?, password = md5(?) WHERE username = ? and password = md5(?)';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	function update_signature($name, $nrp, $id)
	{
		$sql = 'UPDATE signature SET name = ?, nrp = ? WHERE id = ?';
		$row = $this->db->prepare($sql);
		$row->execute(array($name, $nrp, $id));
	}
	function update_arsip_surat_with_bukti($data)
	{
		$sql = 'UPDATE arsip_surat SET substansi_id = ?, sumber_surat_id = ?, nomor_surat = ?, pelapor = ?, polres_id = ?, jenis_masalah = ?, status_penyelesaian = ?, keterangan = ?, tanggal_surat = ?,  bukti = ?, updated_at = now() WHERE id = ?';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	function update_arsip_surat_no_bukti($data)
	{
		$sql = 'UPDATE arsip_surat SET substansi_id = ?, sumber_surat_id = ?, nomor_surat = ?, pelapor = ?, polres_id = ?, jenis_masalah = ?, status_penyelesaian = ?, keterangan = ?, tanggal_surat = ?, updated_at = now() WHERE id = ?';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	function update_bukti_arsip_surat_by_id($data)
	{
		$sql = 'UPDATE arsip_surat SET bukti = ? WHERE id = ?';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
	function update_deleted_arsip_surat($data)
	{
		$sql = 'UPDATE arsip_surat SET deleted_at = now() WHERE id = ?';
		$row = $this->db->prepare($sql);
		$row->execute($data);
	}
}
