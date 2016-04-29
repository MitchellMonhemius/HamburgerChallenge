<?php
class Burgers_model extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
     
    function add_burger($data)
    {
        $this->db->insert('burgers', $data);
        $_SESSION['burger_id'] = mysql_insert_id();
    }

        function add_ingredient($data)
        {
            $this->db->insert('ingredients', $data);
        }

            function add_vote($data)
            {
                $this->db->insert_batch('votes', $data);
            }

    public function get_burgers($user_id)
    {
        $query = $this->db->get_where('burgers', array('user_id' => $user_id));

        return $query->result();  
    }

    public function get_burger($burger_id)
    {
        $query = $this->db->get_where('burgers', array('burger_id' => $burger_id));

        return $query->row();  
    }

        public function get_ingredients($burger_id)
        {
            $query = $this->db->get_where('ingredients', array('burger_id' => $burger_id));

            return $query->result();  
        }

    public function get_vote_types()
    {
        $query = $this->db->query("SELECT * FROM `vote_types`");

        return $query->result();  
    }

        public function get_votes($id)
        {
            $query = $this->db->query("SELECT * FROM `votes` WHERE user_id = $id->user_id");

            return $query->result();  
        }


    public function get_burgers_by_group($group_id)
    {
        $query = $this->db->query("SELECT * FROM `burgers` WHERE group_id = $group_id");

        return $query->result();
    }

        public function get_burger_score($id)
        {
            $query = $this->db->query("SELECT * FROM `votes` WHERE burger_id = $id");

            return $query->result();  
        }

            public function get_group_from_burger($burger_id)
            {
                $query = $this->db->query("SELECT group_id FROM `burgers` WHERE burger_id = $burger_id");

                return $query->result();  
            }
}
?>