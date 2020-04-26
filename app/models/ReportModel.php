<?php

class ReportModel
{
    private $conn;

    public function __construct()
    {
        require_once 'Database.php';
        $this->conn = Database::getInstance()->getConn();
    }

    public function doReport($type, $location, $date, $user)
    {
        $insStmt = $this->conn->prepare('INSERT INTO reports (type, location, date, user) VALUES(?,?,?,?)');
        $insStmt->bind_param('isss', $type, $location, $date, $user);

        $insStmt->execute();
        $insStmt->close();
    }

    public function getActiveReports()
    {
        $activeReports = [];
        $getStmt = $this->conn->query('SELECT * FROM reports');
        if ($getStmt->num_rows > 0) {
            while ($row = $getStmt->fetch_assoc()) {
                array_push(
                    $activeReports,
                    ['id' => $row['id'], 'type' => $row['type'], 'location' => $row['location'], 'date' => $row['date'], 'user' => $row['user']]
                );
            }
        }
        return $activeReports;
    }

    public function deleteReport($id)
    {
        $delStmt = $this->conn->prepare('DELETE FROM reports WHERE ID=?');
        $delStmt->bind_param('i', $id);

        $delStmt->execute();
        $delStmt->close();
    }
}
