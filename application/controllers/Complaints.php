<?php
    class Complaints extends CI_Controller{
        public function view(){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $data['title']= 'Complaints from users';
            $data['complaint_posts'] = $this->complaint_model->get_post_with_complaints();
            $this->load->view('templates/header');
            $this->load->view('complaints/index', $data);
            $this->load->view('templates/footer');
        }
        public function create($post_id){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //get post by $id;
            $data['posts'] = $this->post_model->get_posts_by_id($post_id);
            $data['title'] = 'Complain about a manual';
            $this->form_validation->set_rules('description', 'Description', 'required');
            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('complaints/create', $data);
                $this->load->view('templates/footer');
            }
            else{
                $desc = $this->input->post('description');
                $user_id = $this->session->userdata('user_id');
                $this->complaint_model->create_complaint($desc, $post_id, $user_id);
                //Set message
                $this->session->set_flashdata('complaint_submit', 'Your complaint has been sent.');
                redirect('posts');
            }
            
        }
    }
?>