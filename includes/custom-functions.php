<?php
include_once('crud.php');

class custom_functions
{
    protected $db;
    function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }

    public function validate_image($file, $is_image = true)
        {
            if (function_exists('finfo_file')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $type = finfo_file($finfo, $file['tmp_name']);
            } else if (function_exists('mime_content_type')) {
                $type = mime_content_type($file['tmp_name']);
            } else {
                $type = $file['type'];
            }
            $type = strtolower($type);
            if ($is_image == false) {
                if (!in_array($type, array('text/plain'))) {
                    return true;
                } else {
                    return false;
                }
            } else if ($is_image == true) {
                if (!in_array($type, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if (!in_array($type, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        function users_rows_count($table, $field = '*')
    {
        
        // Total count
        
        $sql = "SELECT COUNT(" . $field . ") as total FROM " . $table;
        $this->db->sql($sql);
        $res = $this->db->getResult();
        foreach ($res as $row)
            return ($row['total'] != "") ? $row['total'] : 0;
            
    }
    function products_my_rows_count($table,$id, $field = '*')
    {
        
        // Total count
        
        $sql = "SELECT COUNT(" . $field . ") as total FROM " . $table ." WHERE id=" . $id;
        $this->db->sql($sql);
        $res = $this->db->getResult();
        foreach ($res as $row)
            return ($row['total'] != "") ? $row['total'] : 0;
            
    }
}
