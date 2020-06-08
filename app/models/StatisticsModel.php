<?php
require_once('Database.php');

class StatisticsModel
{
    private $conn;
    private $errors = [];
    private $success = [];
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConn();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getStatisticsData()
    {
        $activeReports = [];
        $stmt = $this->conn->prepare('SELECT * FROM reports');
        $stmt->execute();
        $res = $stmt->get_result(); 
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push(
                    $activeReports,
                    ['id' => $row['id'], 'type' => $row['type'], 'location' => $row['location'], 'date' => $row['date']]
                );
            }
        }
        $stmt->close();
        return $activeReports;
    }

    public function getExportTypes() {
        $query = "Select * from export_types where id = 1";
        $get_stmt = $this->conn->prepare($query);
        $get_stmt->execute();
        $types = mysqli_fetch_assoc($get_stmt->get_result());
        return $types;
    }

    public function updateTypes($types) {
        $query = "Update export_types set html = ?, pdf = ?, csv = ? where id = 1";
        $insert_stmt = $this->conn->prepare($query);
        $html = (in_array("html", $types))?1:0;
        $pdf = (in_array("pdf", $types))?1:0;
        $csv = (in_array("csv", $types))?1:0;
        $insert_stmt->bind_param("iii", $html, $pdf, $csv);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

}
