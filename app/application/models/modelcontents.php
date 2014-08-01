<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelContents extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function getRows($where='', $limit='', $order=' ORDER BY sequence')
	{
		$query = $this->db->query("SELECT * FROM contents $where $order $limit");
        return $query->result_array();
	}	

	public function getRow($content)
	{
		$query = $this->db->query("SELECT * FROM contents ".$this->get_where($content)." LIMIT 1 ");
		return $query->row();
	}

	public function getField($field, $content){
		$query = $this->db->query("SELECT $field FROM contents ".$this->get_where($content)." LIMIT 1 ");
		$array = $query->row();
		return $array->$field;
	}

	public function get_reasons($id){
		$query = $this->db->query("SELECT * FROM content_reason WHERE id_content = '".$id."' ORDER BY id");
        return $query->result_array();
	}

	public function get_reason($id,$field)
	{
		$query = $this->db->query("SELECT $field FROM content_reason WHERE id = '".$id."' LIMIT 1 ");
		$array = $query->row();
		return $array->$field;
	}

	public function get_types($where=''){
		$query = $this->db->query("SELECT * FROM content_type $where ORDER BY id");
        return $query->result_array();
	}	

	public function get_joined_types(){
		$query = $this->db->query("
			SELECT a.id AS id, a.name AS name 
			FROM content_type a JOIN contents b ON a.id = b.id_type  
			GROUP BY a.id  
			ORDER BY a.id
		");
        return $query->result_array();
	}

	private function get_where($content){
		if (is_numeric($content))
			$where = " WHERE id = '".$content."' ";
		elseif (is_string($content))
			$where = " WHERE LOWER(title) LIKE '".str_replace('-', ' ', utf8_decode ($content))."' ";

		return $where;
	}

	public function insert($data)
	{
		return $this->db->insert('contents', $data) ? 1 : 0;
	}

	public function update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('contents', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('contents');
	}
}