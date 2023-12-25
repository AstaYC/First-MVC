<?php 
namespace App\Models;
use App\Models\conection;


class Offers {


    private $db;
    public $error;

    public function __construct()
    {      
        // Get an instance of the Database class
        $this->db = conection::getInstance()->getConnection();
    }
        
    public function insertJobOffer($title, $description, $company, $location,$filename) {
            $sql = "INSERT INTO job_offers (title, description, company, location,img) VALUES ('$title', '$description', '$company', '$location','$filename')";
            
            if ($this->db->query($sql)) {
                return true;
            } else {
                $this->error="Error executing query: " . $this->db->error;
                return false;
            }
        }
        // ......................................................getAllJobOffers
        public function getAllJobOffers() {
            $sql = "SELECT * FROM job_offers";
            $result = $this->db->query($sql);
    
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        }
        // ......................................................deleteOffer
        public function deleteOffer($id){
            $del_req  = "DELETE FROM job_offers WHERE id =$id";
            $del_result = $this->db->query($del_req);
            if ($del_result){
                return true;
            }
            else {
                return false;
            }
        }
        // ......................................................updateOffer
    
        public function updateOffer($title, $description, $company, $location,$filename,$id){
            $update_sql = "UPDATE job_offers SET title = '$title', description = '$description', company = '$company', location = '$location', img = '$filename' WHERE id = $id";
            $update_result = $this->db->query($update_sql);
            if ($update_result){
                return true;
            }
            else {
                return false;
            }
        }
        // ......................................................getJobOffer
        
        public function getJobOffer($id) {
            $upsql = "SELECT * FROM job_offers WHERE id =$id";
            $upresult = $this->db->query($upsql);
    
            if ($upresult->num_rows > 0) {
                return $upresult->fetch_assoc();
            } else {
                return [];
            }
        }
        // ......................................................searchOffer
        public function searchOffer($search){
            $S_sql = "SELECT * FROM job_offers WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR company LIKE '%$search%' OR location LIKE '%$search%'";
            $S_result = $this->db->query($S_sql);
            if ($S_result->num_rows > 0) {
                return $S_result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        }
    }// -----------------------------------------------------------------------------------------------------------------</ CLOSE CLASS >
    