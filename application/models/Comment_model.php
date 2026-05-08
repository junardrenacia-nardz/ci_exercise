<?php
class Comment_model extends CI_Model {
    public function get_comments($ticket_id) {
        $this->db->order_by("c.comment_id", "ASC");
        $this->db->select("CONCAT('UID-', LPAD(c.user_id, 5, '0')) as user_id, c.comment_id, c.comment, e.first_name, e.last_name, e.gender, d.department_name, c.comment_created_at");
        $this->db->from("comments c");
        $this->db->join("users u", "u.user_id = c.user_id", 'left');
        $this->db->join("employees e", "e.employee_id = u.employee_id", 'left');
        $this->db->join("departments d", "d.department_id = e.department_id", 'left');
        $this->db->where("ticket_id", $ticket_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_comment_attachments($ticket_id, $comment_id = FALSE) {
        $this->db->select('c.comment_id as main_id, e.first_name, e.last_name, ca.comment_id, ca.attachment, ca.orig_name');
        $this->db->from("comments c");
        $this->db->join("comment_attachments ca", 'ca.comment_id = c.comment_id', 'left');
        $this->db->join("users u", "u.user_id = c.user_id", 'left');
        $this->db->join("employees e", "e.employee_id = u.employee_id", 'left');
        if ($comment_id) {
            $this->db->where(["c.ticket_id" => $ticket_id, 'ca.comment_id' => $comment_id]);
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->where("c.ticket_id", $ticket_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_comment($fileNames, $ticket_id, $user_id) {
        $this->db->trans_start();

        $commentData = [
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
            'comment' => $this->input->post('comment')
        ];

        $this->db->insert("comments", $commentData);

        $comment_id = $this->db->insert_id();

        foreach ($fileNames as $file) {
            $attachmentData = [
                'comment_id' => $comment_id,
                'attachment' => $file['encryptedName'],
                'orig_name' => $file['origName']
            ];

            $this->db->insert("comment_attachments", $attachmentData);
        }

        $this->db->trans_complete();

        // CHECK IF SUCCESS
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }
}