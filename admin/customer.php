<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cs = new customer();
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){
        echo "<script>window.location ='inbox.php'</script>";
    }else{
        $id = $_GET['customerid'];
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>THÔNG TIN KHÁCH HÀNG</h2>
                
                <?php
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){

                ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>Họ tên:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>SĐT:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thành phố:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Quốc tịch:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['country'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Mã:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="catName" class="medium" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>