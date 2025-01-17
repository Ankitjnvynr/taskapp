<?php
date_default_timezone_set("Asia/Kolkata");

$tableId = "todayTable";

$tod = new DateTime;
        // $today = strval($today);
        $today = $tod->format("y-m-d");
        $today1 = $tod->format("d-m-y");
        $today = isset($_POST['filter']) ? $_POST['filter'] : $today;
        $tableId = isset($_POST['filter']) ? "pastTable" : "todayTable";

        if (!isset($_POST['filter'])){
            echo '<p class="my-2"><span class="p-2 border border-primary rounded-2 my-2">Today (' . $today1 . ')</span> </p>';
            
        }

        $sr = 0;
        session_start();
        $user_id = $_SESSION['userId'];
        include("_db.php");
        $sql = "SELECT * FROM `tasks` WHERE `user_id` = '$user_id' AND `dt` = '$today' ORDER BY id DESC";

        $result = $conn->query($sql);

?>
<style>
    .container {
        cursor: pointer;
    }

    .container input {
        display: none;
    }

    .container svg {
        overflow: visible;
    }

    .path {
        fill: none;
        stroke: #0d6efd;
        stroke-width: 6;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: stroke-dasharray 0.5s ease, stroke-dashoffset 0.5s ease;
        stroke-dasharray: 241 9999999;
        stroke-dashoffset: 0;
    }

    .container input:checked~svg .path {
        stroke-dasharray: 70.5096664428711 9999999;
        stroke-dashoffset: -262.2723388671875;
    }
    .timing{
        /* position:absolute !important; */
        bottom:-15px;
        color:grey;
        font-size:0.8rem;
    }
</style>
<table id="<? echo $tableId;?>" class="table border border-primary rounded">
    <thead>
        <tr>
            <th scope="col">Sr</th>
            <th colspan="2" scope="col">Task <button class="copyButton btn btn-primary p-0 m-0" onclick="copyColumn(2)">Copy</button></th>
            <th class="text-center" scope="col">Status</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        while ($row = $result->fetch_assoc()) {
            $sr++;
            $task = $row["task"];
            $id = $row["id"];
            $fromtime = $row["fromtime"];
            $totime = $row["totime"];
            $status = $row["status"];
            // echo $row['dt']."<br>";
            if ($status == "Done") {
                $status = 'Checked';
            } else {
                $status = null;
            }
            // echo var_dump($status);
            // exit;
            echo '
            
            <tr>
                <th scope="row">' . $sr . '</th>
                <td style="position:relative !important;" id="task' . $id . '" colspan="2" class=" position-relative">
                <p >' . $task . '</p>  
                
                </td>

                <td class="text-center">
                <label class="container">
                    <input type="checkbox"  name="" onchange="changeStatus(this)" value="' . $id . '"  ' . $status . '>
                        <svg viewBox="0 0 64 64" height="1.3em" width="1.3em">
                             <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>
                        </svg>
                    </label>
                </td>
                <td >
                    
                    <button style="border:none !important;" data-value ="' . $id . '" onclick = deleteTask(this.dataset.value)  class="btn bg-white text-danger border border-none outline-none btn-danger p-0 my-1"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>
            ';
        }


        // <button style="border:none !important;" class="editBtn btn btn-primary bg-white text-primary border  border-none p-0 my-1" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-editid = "' . $id . ' "><i class="fa-solid fa-pen-to-square"></i></button>
        ?>


    </tbody>
</table>