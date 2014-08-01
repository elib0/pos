<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	
	Developed by Websarrollo team
	info@websarrollo.com
	Version 1.0
	May 2014 
	Valencia, Venezuela
	
 */

class Content extends CI_Controller {

	private $data;
	private $language;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->model('Services');
		$this->load->model('Customers');
		$this->load->model('ModelContents');
		//$this->language = 'general'; 
	}

	//home page
	public function index()
	{	
		$this->data = array(
			'blog_summary' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' " , " LIMIT 3"),
			'hosting_summary' => $this->Services->getPlans(" WHERE id_service = '1'"," LIMIT 3",false),
			'domains_summary' => $this->Services->getPlans(" WHERE id_service = '2' AND id IN ('6', '7', '8', '9', '10', '29', '31', '146', '148', '149')",' LIMIT 10',false),
			'index' => '1'
		);

		//wpanel session
		if ($this->session->userdata('wp-user'))
			$this->data['wp_user'] = $this->session->userdata('wp-user');
		
		$this->load->layout('home_summary',$this->data);
	}

	//control all view in the system
	public function body($content)
	{
		$this->load->model('ModelContents');	
		$body = $this->ModelContents->getRow($content);

		if ($body->id_type=='3') {	
			$this->data = array(
				'content' => $body,
				'is_post' => true,
				'more_posts' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' ", " LIMIT 5")
			);
			
		}else{
			switch ($body->id) { 

				case '2': //customers
					$this->data = array(
						'content' => $body,
						'gallery' => $this->Customers->get_portafolio(" WHERE id_status = '1' ")
					);
				break;

				case '4': //domains
					$this->data = array(
						'content' => $body,
						'domains_costs' => $this->Services->getDomainsPlans(" WHERE p.`type` like 'domain%' and p.`msetupfee` <> 0 ",' LIMIT 10',false),
						'language' =>$this->lang->load('domains', $this->session->userdata('ws-language'))
					);
					if (isset($_POST['txtDomain']) && trim($_POST['txtDomain'])!=''){ 
						$this->load->model('Whois');
						$this->Whois->lookup(trim($_POST['txtDomain']));
						$this->data['whois'] = array(
							'out' => $this->Whois->get_out(),
							'available' => $this->Whois->get_available(),
							'error' => $this->Whois->get_error(),
							'domain' => $this->Whois->get_domain(),
							'tld' => $this->Whois->get_tld_domain(),
							'price' => numberFormat($this->Services->get_domain_price($this->Whois->get_tld_domain()))
						);
					}
				break;

				case '5': //hosting
					$this->data = array(
						'content' => $body,
						'plans' => $this->Services->getPlans(" WHERE id_service = '1'","",true),
						'wadmin' => 'http://www.websarrollo.com/wadmin/cart.php'
					);
				break;

				case '13': //contact
					$this->data = array(
						'content' => $body,
						'reasons' => $this->ModelContents->get_reasons($body->id),
						'language' =>$this->lang->load('support', $this->session->userdata('ws-language'))
					);
				break;

				case '17': //content list
					$this->data = array(
						'content' => $body,
						'contents_list' => $this->ModelContents->getRows(" WHERE is_view = '0' AND id_type!='3' AND id_status='1' "),
						'list_type' => $this->ModelContents->get_types(" WHERE id IN ('1','2','3')"),
						'wp_user' => $this->session->userdata('wp-user')
					);
				break;

				default:
					$this->data = array(
						'content' => $body
					);
				break;
			}

			$this->data['is_post'] = false;
		}

		//wpanel session
		if ($this->session->userdata('wp-user')) 
			$this->data['wp_user'] = $this->session->userdata('wp-user');		
		
		if ($body->is_view==1){
			if (isset($this->data['wadmin'])&&$this->data['wadmin']!=''){
				redirect($this->data['wadmin']);
			}else{
				$this->load->layout($body->body, $this->data, explode('-',$body->jsLibraries));	
			}
			
		}else{
			$this->load->layout('content', $this->data, explode('-',$body->jsLibraries));
		}
	}

	//manage form to edit a exists content
	public function manage($content)
	{
		$body = $this->ModelContents->getRow('contenidos');
		$this->data = array(
			'content' => $body,
			'wp_user' => $this->session->userdata('wp-user'),
			'type_list' => $this->ModelContents->get_types()
		);

		if ($content!="")
			$this->data['info'] = $this->ModelContents->getRow($content);
			
		$this->load->layout($body->body, $this->data, explode('-',$body->jsLibraries));
	}	

	//manage form to add new content
	public function add()
	{ 
		$this->data = array(
			'new' => 1,
			'content' => $this->ModelContents->getRow('contenidos'),
			'wp_user' => $this->session->userdata('wp-user'),
			'type_list' => $this->ModelContents->get_types(" WHERE id IN ('1','2','3')")
		);	

		$this->load->layout('wpanel/contents', $this->data, array('ckeditor/ckeditor.js','wpanel/contents.js'));
	}

	//update content in DB
	public function update()
	{
		$path = 'img/contents/';
		$tmp_error = '';
		$error = '';

		new_directory($path);

		if ($_FILES['icon']['error']==0){ //icon validation
			if (!upload_file($path, 'icon', $tmp_error, $photo)){
				$error = 'Error icon upload:'.$tmp_error;
				$tmp_error = '';
			}else{
				@unlink($this->input->post('old_icon'));
				$update['icon'] = $path.$photo['file_name'];
					resize_image($update['icon'], 45, 45);
			}
		}

		if ($_FILES['image']['error']==0){ //image validation
			if (!upload_file($path, 'image', $tmp_error, $photo)){
				$error .= trim($tmp_error)!='' ? ',  Error image upload: '.$tmp_error : 'Error image upload: '.$tmp_error;
				$tmp_error = '';
			}else{
				@unlink($this->input->post('old_image'));
				$update['image'] = $path.$photo['file_name'];
				resize_image($update['image'], 450);
			}
		}

		if ($error!=''){ // if the image didn't upload
			echo json_encode(array(
				'out' => 'notOk',
				'title' => 'Error',
				'message' => 'Hubo un error al momento de subir una de las imagenes: '.$error
			));
		}else{ // if everything is ok 
			$update['id_status'] = $this->input->post('cboStatus');
			$update['id_type'] = $this->input->post('cboType');
			$update['title'] = $this->input->post('txtTitulo');
			$update['text_small'] = $this->input->post('txtSmallText');
			$update['summary'] = $this->input->post('summary');
			$update['body'] = $this->input->post('body');
			$update['author'] = $this->input->post('txtAuthor');
			$update['date'] = date('Y-m-d h:m:s');
			
			$this->ModelContents->update($update, $this->input->post('id')); //query update
			
			echo json_encode(array(
				'out' => 'ok',
				'title' => 'Exito!',
				'message' => 'El contenido ha sido actualizado exitosamente.',
				'url' => site_url().'/content/body/listado-de-contenidos'
			));
		}
	}

	//insert new content in DB
	public function insert()
	{  
		$insert = array(
			'id_type' => $this->input->post('cboType'),
			'id_status' => $this->input->post('cboStatus'),
			'title' => $this->input->post('txtTitulo'),
			'text_small' => $this->input->post('txtSmallText'),
			'summary' => $this->input->post('summary'),
			'body' => $this->input->post('body'),
			'author' => $this->input->post('txtAuthor'),
			'date' => date('Y-m-d h:m:s')
		);

		if ($this->ModelContents->insert($insert)){

			$path = 'img/contents/';
			$tmp_error = '';
			$error = '';
			$id = $this->db->insert_id();

			if ($_FILES['icon']['error']==0){ //icon validation
				if (!upload_file($path, 'icon', $tmp_error, $photo)){
					$error = '* Icon: '.$tmp_error.'<br><br>';
					$tmp_error = '';
				}else{
					$update['icon'] = $path.$photo['file_name'];
					resize_image($update['icon'], 45, 45);
					$tmp_error = '';
				}
			}

			if ($_FILES['image']['error']==0){ //image validation
				if (!upload_file($path, 'image', $tmp_error, $photo)){
					$error .= '* Image: '.$tmp_error.'<br><br>';
					$tmp_error = '';
				}else{
					$update['image'] = $path.$photo['file_name'];
					resize_image($update['image'], 450);
				}
			}

			$this->ModelContents->update($update, $id); //query update

			if ($error!=''){
				$this->data = array(
					'out' => 'notOk',
					'title' => 'Error en upload de im&aacute;genes',
					'message' => $error.'<br>Puedes solucionar este error desde la secci&oacute;n editar contenidos.'
				);
			}else{
				$this->data = array(
					'out' => 'ok',
					'title' => 'Exito!',
					'message' => 'El contenido ha sido insertado exitosamente.',
					'url' => site_url().'/content/body/listado-de-contenidos'
				);
			}//error

		}else{

			$this->data = array(
				'out' => 'notOk',
				'title' => 'Error',
				'message' => 'Hubo un error al momento de insertar el registro, favor intente nuevamente.<br><br>Si el problema persiste comuniquese con el administrador'
			);

		} //query insert





		echo json_encode($this->data);
	}

	//delete contents from content list view
	public function delete($id)
	{
		$content = $this->ModelContents->getRow($id);

		unlink($content->icon);
		unlink($content->image);

		$this->ModelContents->delete($id);

		echo json_encode(array(
			'out' => 'ok'
		));
	}

	//this method is called when the combo box is changed (content list view, option 17 in body method)
	public function ajax_grid($id) 
	{
		$ci = get_instance();

		$this->data = array(
			'contents_list' => $this->ModelContents->getRows(" WHERE is_view = '0' AND id_type = '".$id."' AND id_status='1' ", ' LIMIT 20', $order=' ORDER BY sequence'),
			'wp_user' => $this->session->userdata('wp-user'),
			'config' => $ci->config->item('websarrollo')
		);

		$this->load->view("wpanel/ajax/contents_list", $this->data);
	} 

}
?>