<?php  
    class Complaint_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_post_with_complaints(){
            $query = $this->db->query("SELECT posts.id, posts.title, posts.upload_file, complaints.description, 
            complaints.complain_time, users.username 
            FROM posts INNER JOIN complaints ON complaints.post_id = posts.id INNER JOIN users 
            ON users.id = complaints.from_user_id ORDER BY posts.id DESC");
            return $query->result_array();
        }
        public function create_complaint($desc, $post_id, $user_id){
            $data = array(
                'description'=>$desc,
                'post_id'=> $post_id,
                'from_user_id'=> $user_id
            );
            return $this->db->insert('complaints',$data);
        }
    }
?>