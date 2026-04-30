<?php
class Comment_model extends CI_Model {
    public function get_comments($ticket_id) {
        $this->db->order_by("c.comment_id", "ASC");
        $this->db->select("c.user_id, c.comment, e.first_name, e.last_name, e.gender, d.department_name");
        $this->db->from("comments c");
        $this->db->join("users u", "u.user_id = c.user_id", 'left');
        $this->db->join("employees e", "e.employee_id = u.employee_id", 'left');
        $this->db->join("departments d", "d.department_id = e.department_id", 'left');
        $this->db->where("ticket_id", $ticket_id);
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
