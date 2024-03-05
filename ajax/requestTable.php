<?php
include '../database/index.php';
$dept = $_POST['dept'];
$prod = $_POST['prod'];
if (empty($dept) && empty($prod)) {
    $sql = "SELECT listId, line,jigName, jigLocation, lineStatus, category, machineName, machineNo, process, problem, operatorName, department,status, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest, confirm_by  FROM tblandonrequest";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if ($res['status'] == 'pending') {
            // IF PENDING STATUS FETCH DEPT
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            // IT FINAL
            if ($res['department'] == 'IT') {
                echo "<tr style='cursor:pointer;background-color:#4d6dff;color:white;height:10px;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD INITIAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:#2cf216;color:black;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD FINAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#0b9e1f;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE FINAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#fa5007;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE INITIAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:red;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            } else {
                // CONFIRMED
                echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
        } elseif ($res['status'] == 'confirm') {
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
            echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
            echo "<td>" . $res['problem'] . "</td>";
            echo "<td>" . $res['operatorName'] . "</td>";
            echo "<td>" . $res['department'] . "</td>";
            echo "<td>" . $res['timeRequest'] . "</td>";
            echo "<td>" . $res['confirm_by'] . "</td>";
            echo "</tr>";
        }
    }
} elseif (empty($prod) && !empty($dept)) {
    $sql = "SELECT listId, line, category, machineName, machineNo, process, problem,jigName, jigLocation, lineStatus, operatorName, department,status, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest, confirm_by  FROM tblandonrequest WHERE department = '$dept'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if ($res['status'] == 'pending') {
            // IF PENDING STATUS FETCH DEPT
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            if ($res['department'] == 'IT') {
                echo "<tr style='cursor:pointer;background-color:#4d6dff;color:white;height:10px;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD INITIAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:#2cf216;color:black;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD FINAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#0b9e1f;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE INITIAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:red;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE FINAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#fa5007;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            } else {
                if ($res['machineNo'] == 'N/A') {
                    $res['machineNo'] = '';
                }
                if ($res['process'] == 'N/A') {
                    $res['process'] = '';
                }
                echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
        } elseif ($res['status'] == 'confirm') {
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
            echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
            echo "<td>" . $res['problem'] . "</td>";
            echo "<td>" . $res['operatorName'] . "</td>";
            echo "<td>" . $res['department'] . "</td>";
            echo "<td>" . $res['timeRequest'] . "</td>";
            echo "<td>" . $res['confirm_by'] . "</td>";
            echo "</tr>";
        }
    }
}
// IF DEPT EMPTY AND PROD NOT EMPTY
elseif (empty($dept) && !empty($prod)) {
    $sql = "SELECT listId, line, category, machineName, machineNo, process, problem,jigName, jigLocation, lineStatus, operatorName, department,status, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest, confirm_by  FROM tblandonrequest WHERE category = '$prod'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if ($res['status'] == 'pending') {
            // IF PENDING STATUS FETCH DEPT
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            if ($res['department'] == 'IT') {
                echo "<tr style='cursor:pointer;background-color:#4d6dff;color:white;height:10px;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD INITIAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:#2cf216;color:black;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD FINAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#0b9e1f;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE INITIAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:red;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE FINAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#fa5007;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            } else {
                if ($res['machineNo'] == 'N/A') {
                    $res['machineNo'] = '';
                }
                if ($res['process'] == 'N/A') {
                    $res['process'] = '';
                }
                echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
        } elseif ($res['status'] == 'confirm') {
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
            echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
            echo "<td>" . $res['problem'] . "</td>";
            echo "<td>" . $res['operatorName'] . "</td>";
            echo "<td>" . $res['department'] . "</td>";
            echo "<td>" . $res['timeRequest'] . "</td>";
            echo "<td>" . $res['confirm_by'] . "</td>";
            echo "</tr>";
        }
    }
}

// BOTH FIELDS WERE FILL
else {
    $sql = "SELECT listId, line, category, machineName, machineNo, process, problem,jigName, jigLocation, lineStatus, operatorName, department,status, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest, confirm_by  FROM tblandonrequest WHERE department = '$dept' AND category = '$prod'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if ($res['status'] == 'pending') {
            // IF PENDING STATUS FETCH DEPT
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            if ($res['department'] == 'IT') {
                echo "<tr style='cursor:pointer;background-color:#4d6dff;color:white;height:10px;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD INITIAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:#2cf216;color:black;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // EQD FINAL
            elseif ($res['department'] == 'EQD' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#0b9e1f;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE INITIAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Initial') {
                echo "<tr style='cursor:pointer;background-color:red;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
            // PE FINAL
            elseif ($res['department'] == 'PE' && $res['category'] == 'Final') {
                echo "<tr style='cursor:pointer;background-color:#fa5007;color:white;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] ."/" . $res['jigLocation'] . "/" . $res['jigName'] . "/" . $res['lineStatus'] . "/" . $res['process'] ."</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            } else {
                if ($res['machineNo'] == 'N/A') {
                    $res['machineNo'] = '';
                }
                if ($res['process'] == 'N/A') {
                    $res['process'] = '';
                }
                echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
                echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
                echo "<td>" . $res['problem'] . "</td>";
                echo "<td>" . $res['operatorName'] . "</td>";
                echo "<td>" . $res['department'] . "</td>";
                echo "<td>" . $res['timeRequest'] . "</td>";
                echo "<td>" . $res['confirm_by'] . "</td>";
                echo "</tr>";
            }
        } elseif ($res['status'] == 'confirm') {
            if ($res['machineNo'] == 'N/A') {
                $res['machineNo'] = '';
            }
            if ($res['process'] == 'N/A') {
                $res['process'] = '';
            }
            echo "<tr style='cursor:pointer;background-color:yellow;' onclick='clickRequest(&quot;" . $res['listId'] . "&quot;)'>";
            echo "<td>" . $res['line'] . "/" . $res['machineName'] . " " . $res['machineNo'] . "/" . $res['process'] . "</td>";
            echo "<td>" . $res['problem'] . "</td>";
            echo "<td>" . $res['operatorName'] . "</td>";
            echo "<td>" . $res['department'] . "</td>";
            echo "<td>" . $res['timeRequest'] . "</td>";
            echo "<td>" . $res['confirm_by'] . "</td>";
            echo "</tr>";
        }
    }
}

?>