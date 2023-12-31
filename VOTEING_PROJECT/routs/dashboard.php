<?php
session_start();
if (!isset($_SESSION["userdata"]['id'])) {
    header("Location: ../"); 
    exit();
}
$userdata = $_SESSION['userdata'] ?? []; 
$groupdata=$_SESSION['groupdata'] ?? []; 
$photoPath = isset($userdata['photo']) ? '../uploads/' . $userdata['photo'] : ''; 
$name=$userdata['name'];
$mobile=$userdata['mobile'];
$address=$userdata['address'];
if ($_SESSION['userdata']['status'] == 0) {
    $status = "Not voted";
} else {
    $status = "Voted";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        #mainsection {
            display: flex;
            flex-direction: row;
        }
        #profile
        {
            height: 40%;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        #group {
        margin: 20px;
        padding: 20px;
        width: 100%;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        overflow-y: auto; 
        max-height: 400px; 
    }
        #profileimage {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        height: 150px; 
        width: 150px;
        border-radius: 50%; 
        margin:5px; 
       
        }
        #groupimage {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        height: 100px; 
        width: 100px;
        border-radius: 5px; 
        margin-right: 10px; 
        float: right;
    }
        b {
            color: #555;
        }

    
        #back,
        #logout,
        button {
            margin: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #logout:hover,
        #back:hover,
        button:active {
            background-color: #45a049;
        }
        button:active {
            background-color: #3e8e41;
        }
        #back {
            float: left;
        }
        #logout {
            float: right;
        }
        #group div {
            margin-bottom: 20px;
        }
        #group b {
            display: block;
            margin-top: 10px;
        }
        #votebtn {
        margin-top: 10px; 
        padding: 8px 16px;
        background-color: #008CBA; 
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #votebtn:hover {
        background-color: #005f6b; 
    }

    #votebtn:active {
        background-color: #004d57; 
    }
    #voted,button{
        margin: 10px;
            padding: 8px 16px;
            background-color: #808080;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
    }
    </style>
</head>
<body>
<a href="../"><button id="back">Back </button></a>
   <a href="../api/logout.php"><button id="logout">Logout</button>
   </a> 
    <h1>Online Voting System</h1>
    <hr>
    <div id="mainsection">
        <div id="profile">
            <img src="<?= $photoPath ?>" alt="profile picture" height="200px" width="200px" id="profileimage"><br><br>
            <b>Name:</b><?php echo $name;?><br><br>
            <b>Mobile:</b><?php echo $mobile;?><br><br>
            <b>Address:</b><?php echo $address;?><br><br>
            <b>Status:</b><?php echo $status;?><br><br>
        </div>
        <div id="group">
    <?php
    if ($groupdata) {
        foreach ($groupdata as $group) {
            $groupimage = isset($group['photo']) ? '../uploads/' . $group['photo'] : '';
            ?>
           
           <div>
                <img src="<?= $groupimage ?>" alt="Group image" id="groupimage">
                <b>Group Name: <?= $group['groupname'] ?></b>
                <b>Votes: <?= $group['votes'] ?></b>
                <form action="../api/vote.php" method="post">
                    <input type="hidden" name="gvotes" value="<?php echo $group['votes'] ?>">
                    <input type="hidden" name="gid" value="<?php echo $group['id'] ?>">
                    <?php
                    if ($_SESSION['userdata']['status'] == 0) {
                        echo '<input type="submit" name="votebtn" value="vote" id="votebtn">';
                    } else {
                        echo '<button disabled name="votebtn" id="voted" value="vote" >Voted</button>';
                    }
                    ?>
                </form>
            </div>
            <hr>
            <?php
        }
    } else {
      
    }
    ?>
</div>
    </div>
</body>
</html>
