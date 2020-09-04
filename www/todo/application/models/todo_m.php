<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * todo 모델
 *
 * @author Jongwon Byun <advisor@cikorea.net>
 * @version 1.0
 */
class todo_m extends CI_Model //(1)
{
    function __construct()
    {
        parent::__construct();
    }

	/**
	 * todo 조회
	 */
    function get_view($id)
    {
    	$sql = "SELECT * FROM items WHERE id='".$id."'";

		$query = $this->db->query($sql);

     	//내용 반환
	    $result = $query->row();

    	return $result;
    }
    
   	  /**
	 * etc get yumi
	 */
    function get_yumi()
    {
        
       	$sql = "SELECT * FROM yumi ORDER BY main_key"; //(2)
		$query = $this->db->query($sql); //(3)
		$result = $query->result(); //(4)

    	return $result;
    }
 	  
       /**
	 * etc get ben
	 */
    function get_ben()
    {
        
       	$sql = "SELECT * FROM ben_study ORDER BY main_key"; //(2)
		$query = $this->db->query($sql); //(3)
		$result = $query->result(); //(4)

    	return $result;
    }
   	/**
	 * uncleben get search
	 */
    function get_search()
    {
    	//echo "Key: " . $key;
        
        //$sql = "SELECT * FROM sentences WHERE (korean LIKE '".$key."') or (english LIKE '".$key."')";
       	$sql = "SELECT * FROM sentences"; //(2)
		
		$query = $this->db->query($sql); //(3)

		$result = $query->result(); //(4)

    	return $result;
    }
    
    
	/**
	 * uncleben get sentences 
	 */
    function get_sentences()
    {
	
		$sql = "SELECT * FROM sentences"; //(2)
		
		$query = $this->db->query($sql); //(3)

		$result = $query->result(); //(4)

    	return $result;
    }
    
   	 /**
	 * uncleben get rank 
	 */
    function get_rank()
    {
	
		$sql = "SELECT * FROM user"; //(2)
		
		$query = $this->db->query($sql); //(3)

		$result = $query->result(); //(4)

    	return $result;
    }
    
	/**
	 * todo 목록 가져오기
	 */
    function get_list()
    {
		$sql = "SELECT * FROM items";   //(2)
	
		//$sql = "SELECT * FROM sentences"; //(2)
		
		$query = $this->db->query($sql); //(3)

		$result = $query->result(); //(4)

    	return $result;
    }

	/**
	 * todo 입력
	 */
	function insert_todo($content, $created_on, $due_date)
 	{
		$sql = "INSERT INTO items (content, created_on, due_date) VALUES ('".$content."', '".$created_on."', '".$due_date."')";

		$query = $this->db->query($sql);
 	}

	/**
	 * todo 삭제
	 */
	function delete_todo($id)
 	{
		$sql = "DELETE FROM items WHERE id ='".$id."'";

		$query = $this->db->query($sql);
 	}
}

/* End of file todo_m.php */
/* Location: ./application/models/todo_m.php */