<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/single-style.css">
    <title>Відправка форми</title>
</head>
<body>
<?php
if (isset($_POST['ima']) && isset($_POST['tel'])){
    
    $ima = $_POST['ima'];
    $tel = $_POST['tel'];
    
    
    $db_host = "localhost"; 
    $db_user = "mnhadgof"; 
    $db_password = "rQ97xLa5b6"; 
    $db_base = 'mnhadgof_gurt.muzgurt'; 
    $db_table = "log"; 
    
    try {
        
        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        
        $db->exec("set names utf8");
        
        $data = array( 'ima' => $ima, 'tel' => $tel ); 
        ?>
        <div class="block_text_php">
            <div class="text_php">
                <?php
                    
                    function validate_mobile($tel){
                        return preg_match("/^(\+38)?0[0-9]{9}$/", $tel);
                    }
                    
                    if(validate_mobile($tel) == 1){

                        $query = $db->prepare("INSERT INTO $db_table (`name`, `tel`) values (:ima, :tel)");
                        $query->execute($data);
                    }else{
                
                    ?>
                    <div class="img_single_php">
                        <img src="icon/krest.png" alt="Гурт на весілля">
                    </div>

                    <?php
                    echo "Не правильний формат номеру телефону. Ви будете переадресовані на головну сторінку впродовж" . "</br>" . "5 секунд";
                    echo '<meta http-equiv="refresh" content="5; url=index.php">';
                    exit();
                    }
                    
                ?>
            </div>
        </div>
        <?php               
                
    } catch (PDOException $e) {
        
        print "Помилка!: " . $e->getMessage() . "<br/>";
    }
    ?>
    <div class="block_text_php">
        <div class="txt_php">
            <?php
            if($query == true){
                ?>
                <div class="img_single_php2">
                    <img src="icon/galka.png" alt="Музичний гурт">
                </div>
                <?php
                echo "Замовлення дзвінка успішне! Очікуйте дзвінка впродовж робочого дня.";
                echo '<meta http-equiv="refresh" content="6; url=index.php">';
            
            }
            ?>
        </div>
    </div>
    <?php
    exit();
}
?>
</body>
</html>