<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * todo controller.
 *
 * @author Jongwon, Byun <advisor@cikorea.net>
 */
class Main extends CI_Controller {  //Clase name is same as file name. 

 	function __construct()
	{
		parent::__construct();
		$this->load->database();     
        $this->load->model('todo_m');   //load todo model. 
		$this->load->helper('url');
	}

	/**
	 * 주소에서 메소드가 생략되었을 때 실행되는 기본 메소드
	 */
	public function index()
	{
		$this->lists();
	}
	/**
	 * Uncleben Sentences by level
	 */
	public function sentences()  //(7)
	{
		$data['list'] = $this->todo_m->get_sentences(); //(8)

		$this->load->view('todo/sentences_v', $data); //(9)
	}

    /**
	 * Uncleben rank
	 */
	public function rank()  //(7)
	{
		$data['list'] = $this->todo_m->get_rank(); //(8)

		$this->load->view('todo/rank_v', $data); //(9)
	}

	/**
	 * Uncleben search
	 */
	function search()
 	{
    
        //$key = isset($_GET['key']) ? $_GET['key'] : NULL;

 		$data['list'] = $this->todo_m->get_search();

 		//view 호출
 		$this->load->view('todo/search_v', $data);
 	}
  
    /**
	 * etc
	 */
	function yumi()
 	{
    
 

 		$data['yumi'] = $this->todo_m->get_yumi();
 		//view 호출
 		$this->load->view('todo/yumi_v', $data);
 	}
    
     /**
	 * etc
	 */
	function ben()
 	{
    
 

 		$data['ben'] = $this->todo_m->get_ben();
 		//view 호출
 		$this->load->view('todo/ben_v', $data);
 	}
    
    
	/**
	 * todo 조회
	 */
	function view()
 	{
 		//todo 번호에 해당하는 데이터 가져오기
		$id = $this->uri->segment(3);

 		$data['views'] = $this->todo_m->get_view($id);

 		//view 호출
 		$this->load->view('todo/view_v', $data);
 	}

	/**
	 * todo 목록
	 */
	public function lists()  //(7)
	{
		$data['list'] = $this->todo_m->get_list(); //(8)

		$this->load->view('todo/list_v', $data); //(9)
	}

	/**
	 * todo 입력
	 */
	function write()
 	{
		if ( $_POST )
  		{
			//글쓰기 POST 전송시

	  		$content = $this->input->post('content', TRUE);
			$created_on = $this->input->post('created_on', TRUE);
			$due_date = $this->input->post('due_date', TRUE);

	  		$this->todo_m->insert_todo($content, $created_on, $due_date);

			redirect('/main/lists/');

			exit;
  		}
  		else
  		{
	 		//쓰기폼 view 호출
	 		$this->load->view('todo/write_v');
		}
 	}

	/**
	 * todo 삭제
	 */
	function delete()
 	{
 		//게시물 번호에 해당하는 게시물 삭제
		$id = $this->uri->segment(3);

 		$this->todo_m->delete_todo($id);

 		redirect('/main/lists/');
 	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */