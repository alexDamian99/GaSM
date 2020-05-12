<?php
require_once 'Database.php';

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
                    ['id' => $row['id'], 'type' => $row['type'], 'location' => $row['location'], 'date' => $row['date'], 'user' => $row['user']]
                );
            }
        }
        $stmt->close();
        return $activeReports;
    }

}
