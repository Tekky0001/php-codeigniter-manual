<?php
    class Post_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        public function get_posts($post_status = FALSE){
            
            //get all posts in array
            if($post_status===FALSE){
                $query = $this->db->query("SELECT * FROM posts ORDER BY id DESC");
                return $query->result_array();
            }
            //get posts where post_status is either 'approved' or 'requesting'
            $query = $this->db->query("SELECT * FROM posts WHERE post_status = '".$post_status."' ORDER BY id DESC");
            
            return $query->result_array();
        }
        public function get_posts_by_id($id){
            $query = $this->db->query("SELECT * FROM posts WHERE id = '".$id."' ORDER BY id DESC");
            return $query->result_array();
        }
        public function search_posts($device,$post_status){
            $query = $this->db->query("SELECT * FROM posts WHERE device = '".$device."' 
            AND post_status = '".$post_status."' ORDER BY id DESC");
            return $query->result_array();
        }
        public function create_post($post_file,$post_status){
            $data = array(
                'title'=>$this->input->post('title'),
                'user_id'=>$this->session->userdata('user_id'),
                'device'=>strtolower($this->input->post('device')),
                'body'=>$this->input->post('body'),
                'upload_file' => $post_file,
                'post_status'=> $post_status
            );
            
            return $this->db->insert('posts',$data);
        }
        public function delete_post($id){
            $this->db->where('id',$id);
            $this->db->delete('posts');
            return true;
        }
        
        public function approve_post($id){
            $data = array(
                'post_status'=>'approved'
            );
            $this->db->where('id',$id);
            return $this->db->update('posts',$data);
        }
    }