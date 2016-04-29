<?php
class Users_model extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
     
    public function new_user_check($data)
    {

        $query = $this->db->get_where('users', array( 'facebook_id' => $data['facebook_id'] ));

        $count = $query->num_rows();

        if ($count === 0)
        {
            $this->db->insert('users', $data);
        }
    }

    public function get_registered_users($group_id)
    {
        $query = $this->db->query("SELECT * FROM `users` INNER JOIN `members` ON members.user_id = users.user_id WHERE group_id = $group_id");

        return $query->result();
    }

    public function get_user_id($fb_id)
    {
        $where = array('facebook_id' => $fb_id);

        $query = $this->db->select('user_id')->from('users')->where($where)->get();

        return $query->row();       
    }

        public function get_user($user_id)
        {
            $query = $this->db->get_where('users', array('user_id' => $user_id));

            return $query->row();
        }


    //groups

    public function new_group($data,$member)
    {
        $this->db->insert('groups', $data);

        $members = array
        (
            'group_id' => mysql_insert_id(),
            'user_id' => $member
        );

        $_SESSION['group-selected'] = mysql_insert_id();

        $this->db->insert('members', $members);
    }

    public function get_groups($user_id)
    {
        $query = $this->db->query("SELECT * FROM `groups` INNER JOIN `members` ON members.group_id = groups.group_id WHERE user_id = $user_id");

        return $query->result();
    }       

    public function get_group($group_id)
    {
        $query = $this->db->query("SELECT * FROM `groups` WHERE group_id = $group_id");

        return $query->row();
    }

        public function get_members($group_id)
        {
            $query = $this->db->query("SELECT * FROM `users` INNER JOIN `members` ON members.user_id = users.user_id WHERE group_id = $group_id");

            return $query->result();
        }

    public function new_invite($data)
    {
        $this->db->insert('invites', $data);
    }

        public function check_invites($id)
        {
            $query = $this->db->query("SELECT * FROM `invites` WHERE facebook_id = $id");

            return $query->result();
        }

            public function get_invite($id)
            {
                $query = $this->db->query("SELECT * FROM `invites` WHERE invite_id = $id");

                return $query->row();
            }

    public function accept_invite($data)
    {
        $this->db->insert('members', $data);
    } 
        public function remove_invite($id)
        {
            $this->db->delete('invites', array('invite_id' => $id));
        }     
}
?>