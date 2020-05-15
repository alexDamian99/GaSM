<?php

class ReportModel
{
    private $conn;

    public function __construct()
    {
        require_once('Database.php');
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
                    [
                        'id' => $row['id'], 'type' => $row['type'], 'location' => $row['location'], 'date' => $row['date'],
                        'user' => $row['user']
                    ]
                );
            }
        }
        $getStmt->close();

        return $activeReports;
    }

    public function deleteReport($id)
    {
        $delStmt = $this->conn->prepare('DELETE FROM reports WHERE id=?');
        $delStmt->bind_param('i', $id);
        $delStmt->execute();
        $delStmt->close();

        // also delete its kudos
        $delStmt = $this->conn->prepare('DELETE FROM reports_kudos WHERE report_id=?');
        $delStmt->bind_param('i', $id);
        $delStmt->execute();
        $delStmt->close();
    }

    public function getLikedReports($username)
    {
        $likedReports = [];
        $getStmt = $this->conn->prepare("SELECT report_id FROM reports_kudos WHERE action='like' AND user=?");
        $getStmt->bind_param('s', $username);
        $getStmt->execute();
        $results = $getStmt->get_result();
        while ($row = $results->fetch_assoc()) {
            array_push($likedReports, $row['report_id']);
        }
        $getStmt->close();
        return $likedReports;
    }

    public function getDislikedReports($username)
    {
        $dislikedReports = [];
        $getStmt = $this->conn->prepare("SELECT report_id FROM reports_kudos WHERE action='dislike' AND user=?");
        $getStmt->bind_param('s', $username);
        $getStmt->execute();
        $results = $getStmt->get_result();
        while ($row = $results->fetch_assoc()) {
            array_push($dislikedReports, $row['report_id']);
        }
        $getStmt->close();
        return $dislikedReports;
    }

    public function getTotalLikes()
    {
        $likes = [];
        $getStmt = $this->conn->query("SELECT report_id, count(*) AS likes FROM reports_kudos 
                                        WHERE action='like' GROUP BY report_id");
        if ($getStmt->num_rows > 0) {
            while ($row = $getStmt->fetch_assoc()) {
                $likes[$row['report_id']] = $row['likes'];
            }
        }
        $getStmt->close();
        return $likes;
    }

    public function getTotalDislikes()
    {
        $dislikes = [];
        $getStmt = $this->conn->query("SELECT report_id, count(*) AS dislikes FROM reports_kudos 
                                        WHERE action='dislike' GROUP BY report_id");
        if ($getStmt->num_rows > 0) {
            while ($row = $getStmt->fetch_assoc()) {
                $dislikes[$row['report_id']] = $row['dislikes'];
            }
        }
        $getStmt->close();
        return $dislikes;
    }

    public function getLikes($report_id)
    {
        $getStmt = $this->conn->prepare("SELECT count(*) AS likes FROM reports_kudos WHERE action='like' AND report_id=?");
        $getStmt->bind_param('s', $report_id);
        $getStmt->execute();
        $result = $getStmt->get_result();
        $getStmt->close();
        return $result->fetch_assoc()['likes'];
    }

    public function getDislikes($report_id)
    {
        $getStmt = $this->conn->prepare("SELECT count(*) AS dislikes FROM reports_kudos WHERE action='dislike' AND report_id=?");
        $getStmt->bind_param('s', $report_id);
        $getStmt->execute();
        $result = $getStmt->get_result();
        $getStmt->close();
        return $result->fetch_assoc()['dislikes'];
    }

    public function newAction($report_id, $action, $user)
    {
        if ($action == 'like' || $action == 'dislike') {
            $sql = "INSERT INTO reports_kudos VALUES ($report_id, '$action', '$user') ON DUPLICATE KEY UPDATE action='$action'";
        } else if ($action == 'unlike' || $action == 'undislike') {
            $sql = "DELETE FROM reports_kudos WHERE user='$user' AND report_id='$report_id'";
        }
        $this->conn->query($sql);
    }
}
