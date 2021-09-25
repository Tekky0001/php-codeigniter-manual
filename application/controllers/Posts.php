<?php
    class Posts extends CI_Controller{
        public function index(){
            $data['title']= 'Lastest Posts';
            
            $post_status = 'approved';
            $data['posts'] = $this->post_model->get_posts($post_status);
            
            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }
        public function request(){
            $data['title']= 'Requested Posts';
            //check if it is user, not allow
            if($this->session->userdata('user_id')!=1){
                redirect(posts);
            }
            else if($this->session->userdata('user_id')==1){
                $post_status = 'requesting';
                $data['posts'] = $this->post_model->get_posts($post_status);
            }
            $this->load->view('templates/header');
            $this->load->view('posts/request', $data);
            $this->load->view('templates/footer');
        }
        
        public function create(){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            
            $data['title'] = 'Upload Manual';
            
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');
            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('posts/create', $data);
                $this->load->view('templates/footer');
                
            }
            else{
                //upload file
                $config['upload_path'] = './assets/files/posts';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size'] = '90000';
                $config['max_width'] = '500';
                $config['max_height'] = '500';

                $this->load->library('upload',$config);
                if(!$this->upload->do_upload()){
                    $errors = array('error' => $this->upload->display_errors());
                    print_r($errors);
                    $post_file = 'nofile.pdf';
                }
                else{
                    $data = array('upload_data'=>$this->upload->data());
                    $post_file = $_FILES['userfile']['name'];
                }
                $post_status = 'approved';
                //if it is user's post
                if($this->session->userdata('user_id')!=1){
                    $post_status = 'requesting';
                    //Set message
                    $this->session->set_flashdata('post_requested', 'Your post has been sent for approval.');
                    $this->post_model->create_post($post_file,$post_status);
                    redirect('posts');
                }
                else{
                    //Set message
                    $this->session->set_flashdata('post_created', 'Your post has been created.');
                    $this->post_model->create_post($post_file,$post_status);
                    redirect('posts');
                }
                
            }
        }
        public function approve($id){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $this->post_model->approve_post($id);
            redirect('posts');
            
        }
        public function delete($id){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $this->post_model->delete_post($id);
            //Set message
            $this->session->set_flashdata('post_deleted', 'Post has been deleted.');
            
            redirect('posts');
        }
        public function search(){
            $data['title']= 'Search Posts';
            $post_status = 'approved';
            $device = strtolower($this->input->post('search'));
            $data['posts'] = $this->post_model->search_posts($device,$post_status);
            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }
        public function viewfile(){
            $fname = $this->uri->segment(3);
            $tofile= realpath("assets/files/posts/".$fname);
            header('Content-Type: application/pdf');
            readfile($tofile);
        }

    }
?>