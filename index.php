<?php

    include 'dbconnect.php';

    if(isset($_POST['btnsave'])){

        $pname = $_POST['txtname'];
        $price = $_POST['txtprice'];

        if(!empty($pname && $price)){
            $insert = $pdo->prepare("insert into tbl_product(productname,productprice) values ( :name,:price) ");

            $insert->bindParam(':name',$pname);
            $insert->bindParam(':price',$price);

            $insert->execute();

            if($insert->rowCount()){
                echo "Insert successful";
            }else{
                echo "Insert Fail";
            }
        }
    }


    // end of btn_save

    if(isset($_POST['btnupdate'])){
        $pname = $_POST['txtname'];
        $price = $_POST['txtprice'];
        $id = $_POST['txtid'];

        if(!empty($pname && $price)){
            $update = $pdo->prepare("update tbl_product set productname=:pname,productprice=:price where id=".$id);

            $update->bindParam(':pname',$pname);
            $update->bindParam(':price',$price);

            $update->execute();

            if($update->rowCount()){
                echo 'data update successfully';
            }else{
                echo 'update fail';
            }
        }else{
            echo 'data required';
        }
    }

    // end of btn_update

    if(isset($_POST['btndelete'])){
        $delete = $pdo->prepare("delete from tbl_product where id=".$_POST['btndelete']);
        $delete->execute();
        if($delete->rowCount()){
            echo 'Data Delete Successfully';
        }else{
            echo 'Delete Fail';
        }
   
    }


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> crud </title>
</head>
<body>
    <h2>PHP PDO CRUD OPERATIONS</h2>

    <form action="" method="post">
        <?php

            if(isset($_POST['btnedit'])){
                $select = $pdo->prepare("select * from tbl_product where id=".$_POST['btnedit']);
                $select->execute();
               
                if($select){
                    $row = $select->fetch(PDO::FETCH_OBJ);
                    //print_r($row);
                    echo '
                    <p>
                        <input type="text" name="txtname" placeholder="ProductName" value="'.$row->productname.'">
                    </p>
                    <p>
                        <input type="text" name="txtprice" placeholder="ProductPrice" value="'.$row->productprice.'">
                    </p>
                    <p>
                        <input type="hidden" name="txtid" value="'.$row->id.'">
                    </p>
                    <button type="submit" name="btnupdate">Update</button>
                    <button type="submit" name="btncancel">Cancel</button>
                    ';
                }
            }else{
                echo '
                    <p>
                        <input type="text" name="txtname" placeholder="ProductName">
                    </p>
                    <p>
                        <input type="text" name="txtprice" placeholder="ProductPrice">
                    </p>
                    <input type="submit" value="save" name="btnsave">
                ';
            }

        ?>

        <br> <br>
        <table id="producttable" border="1">
            <thead>
            <th>ID</th>
            <th>ProductName</th>
            <th>ProductPrice</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
            <?php

            $select = $pdo->prepare("select * from tbl_product");
            $select->execute();

            while ($row=$select->fetch(PDO::FETCH_OBJ)){
                echo
                    '
                <tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->productname.'</td>
                    <td>'.$row->productprice.'</td>
                    <td><button type="submit" value="'.$row->id.'" name="btnedit">EDIT</button></td>
                    <td><button type="submit" value="'.$row->id.'" name="btndelete">DELETE</button></td>
                </tr>
                ';
            }
            ?>
            </tbody>
        </table>

    </form>

</body>
</html>


