<?php 
    class Users extends CI_Controller{
        public function register(){
            $data['title'] = 'Sign Up';

            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('username','Username','required|callback_check_username_exists');
            $this->form_validation->set_rules('email','Email','required|callback_check_email_exists');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('password2','Confirm Password','matches[password]');

            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/register',$data);
                $this->load->view('templates/footer');
            }
            else{
                //Encrypt password
                $enc_password = md5($this->input->post('password'));
                $this->user_model->register($enc_password);
                //Set message
                $this->session->set_flashdata('user_registered', 'You are now registered and can log in.');
                redirect('posts');
            }
        }
         //log in user
         public function login(){
            $data['title'] = 'Sign In';
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('captcha','Captcha','required');
            
            $vals = array(
                'word'          => '',
                'img_path'      => './captcha-images/',
                'img_url'       => base_url().'captcha-images/',
                'font_path'     => './path/to/fonts/texb.ttf',
                'img_width'     => '200',
                'img_height'    => 60,
                'expiration'    => 10200,
                'word_length'   => 5,
                'font_size'     => 16,
                'img_id'        => 'Imageid',
                'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        
                // White background and border, black text and red grid
                'colors'        => array(
                        'background' => array(255, 255, 255),
                        'border' => array(255, 255, 255),
                        'text' => array(0, 0, 0),
                        'grid' => array(255, 40, 40)
                    )
                );
            $cap = create_captcha($vals);
            $data['captcha_image'] = $cap['image'];
            //print_r("cap word: ".$cap['word']);
            
            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/login',$data);
                $this->load->view('templates/footer');
                //when it first run the login form, save captcha word, which prevent it from 
                //creating a new captcha word when submitting the form. 
                $this->session->set_userdata('captchaword', $cap['word']);
            }
            else{

                //Get username
                $username = $this->input->post('username');
                //Get and encrypt the password
                $password = md5($this->input->post('password'));
                //Get input captcha text
                $captcha_text = $this->input->post('captcha');

                $save_cap = $this->session->userdata('captchaword');
                //check if captcha is matched
                if( $captcha_text !== $save_cap){
                    $this->session->set_flashdata('captcha_invalid', 'Captcha is invalid.');
                    redirect('users/login');
                }
                //Login user by checking if the id is existed
                $user_id = $this->user_model->login($username,$password);
                if($user_id){
                    //Check if the user is banned or not;
                    $user = $this->user_model->get_users($user_id);
                    if($user[0]['status']=='ban'){
                        $this->session->set_flashdata('user_status', 'You are banned.');
                        redirect('users/login');
                    }
                    //Create session
                    $user_data = array(
                        'user_id'=>$user_id,
                        'username'=>$username,
                        'logged_in'=>true
                        
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in.');
                    redirect('posts');
                }
                else{
                    //Set message
                    $this->session->set_flashdata('login_failed', 'Login is invalid.');
                    redirect('users/login');
                }

            }
        }
        public function logout(){
            //Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            //Set message
            $this->session->set_flashdata('user_loggedout', 'You are now logged out.');
            redirect('users/login');

        }
        //check if username exists
        public function check_username_exists($username){
            $this->form_validation->set_message('check_username_exists', 
            'That username is taken. Please choose a different one.');
            if($this->user_model->check_username_exists($username)){
                return true;
            }
            else{
                return false;
            }
        }
        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists', 
            'That email is taken. Please choose a different one.');
            if($this->user_model->check_email_exists($email)){
                return true;
            }
            else{
                return false;
            }
        }

        public function userlist(){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $data['title'] = 'User Lists';
            $data['users'] = $this->user_model->get_users();
            $this->load->view('templates/header');
            $this->load->view('users/userlist',$data);
            $this->load->view('templates/footer');
        }
        public function unbanuser($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $this->user_model->unban_user($id);
            redirect('users/userlist');
        }
        public function banuser($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $this->user_model->ban_user($id);
            redirect('users/userlist');
        }
        public function deleteuser($id){
            //Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //check if it is a user
            if($this->session->userdata('user_id')!=1){
                redirect('posts');
            }
            $this->user_model->delete_user($id);
            //Set message
            $this->session->set_flashdata('user_deleted', 'A user is deleted.');
            
            redirect('users/userlist');
        }
    }
?>