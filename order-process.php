<?php

//Hanterar beställningen




if($_SERVER['REQUEST_METHOD'] == 'POST'):

    require_once 'db.php';
    require_once 'header.php';
    
    // Hämta och rensa data från POST-Arrayen
    $film_id = htmlspecialchars($_POST['film_id']);
    $price = htmlspecialchars($_POST['price']);
    $customer_id = htmlspecialchars($_POST['customer_id']);

   //print_r('$_POST');

   //kontrollera att kunden finns i db
   $sql= "SELECT*FROM customers WHERE id=:id";
   $stmt= $db->prepare($sql);
   $stmt->bindParam(':id', $customer_id);
   $stmt->execute();



//om kunden saknas fel meddelande
if($stmt->rowCount() == 0) {
    $message= "<div class='alert alert-warning'>
    OBS! Felaktigt kundnummer!</div>";
} 

else { // Ja kunden finns i databasen. 
    $row= $stmt->fetch(PDO::FETCH_ASSOC);
    $name= htmlspecialchars($row['name']);
    $email= htmlspecialchars($row['email']);

    // Skapa ett meddelande med info om beställningen
    $message= "<div class='alert alert-success'>
    <h3>Tack $name</h3>
    <p>Vi kommer att skicka en länk till</p>
    <p>$email</p>
    </div>";

    $sql= "INSERT INTO orders(movie, customer) VALUES(:movie, :customer)";
$stmt= $db->prepare($sql);
$stmt->bindParam(':movie', $film_id);
$stmt->bindParam(':customer', $customer_id);
$stmt->execute();
}

echo $message;



    require_once 'footer.php';


endif;




