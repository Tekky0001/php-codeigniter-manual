<?php  
    class User_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        public function register($enc_password){
            //user data array
            $data = array(
                'name'=> $this->input->post('name'),
                'email'=> $this->input->post('email'),
                'username'=> $this->input->post('username'),
                'role'=>'user',
                'password'=> $enc_password,
                'status'=>'unban'
            );
            //Insert user
            return $this->db->insert('users',$data);
        }
        public function login($username, $password){
            //validate
            $this->db->where('username', $username);
            $this->db->where('password',$password);
            $result = $this->db->get('users');
            if($result->num_rows()==1){
                return $result->row(0)->id;
            }
            else{
                return false;
            }
        }
        public function check_username_exists($username){
            //get array in users table where array of username matches $username
            $query = $this->db->get_where('users',array('username'=>$username));
            if(empty($query->row_array())){
                return true;
            }
            else{
                return false;
            }
        }
        public function check_email_exists($email){
            $query = $this->db->get_where('users',array('email'=>$email));
            if(empty($query->row_array())){
                return true;
            }
            else{
                return false;
            }
        }
        public function get_users($id=FALSE){
            if($id != FALSE){
                $query = $this->db->query("SELECT * FROM users WHERE id = $id");
                return $query->result_array();
            }
            $query = $this->db->query("SELECT * FROM users ORDER BY id DESC");
            return $query->result_array();
        }
        public function unban_user($id){
            $data = array(
                'status'=>'unban'
            );
            $this->db->where('id',$id);
            return $this->db->update('users',$data);
        }
        public function ban_user($id){
            $data = array(
                'status'=>'ban'
            );
            $this->db->where('id',$id);
            return $this->db->update('users',$data);
        }
        public function delete_user($id){
            $this->db->where('id',$id);
            $this->db->delete('users');
            return true;
        }
    }