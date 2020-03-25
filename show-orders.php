<?php

require_once 'header.php';

require_once 'db.php';



$sql= "SELECT
        O.id AS Ordernummer,
        C.name AS Kund,
        F.title AS Filmtitel,
        O.date AS Orderdatum
FROM
        orders AS O,
        customers AS C,
        movies AS F
WHERE 
        O.movie = F.id
        AND 
        O.customer = C.id";

$stmt= $db->prepare($sql);
$stmt->execute();

echo"<table class='table'>";
echo"<tr>
<th>Ordernummer</th>
<th>Orderdatum</th>
<th>Kund</th>
<th>Filmtitel</th>
</tr>";

while($row= $stmt->fetch(PDO::FETCH_ASSOC)):
    $Ordernummer= htmlspecialchars($row['Ordernummer']);
    $Orderdatum= htmlspecialchars($row['Orderdatum']);
    $Kund= htmlspecialchars($row['Kund']);
    $Filmtitel= htmlspecialchars($row['Filmtitel']);
    echo "<tr>
    <td>$Ordernummer</td>
    <td>$Orderdatum</td>
    <td>$Kund</td>
    <td>$Filmtitel</td>
    </tr>";

endwhile;

echo'</table>';



require_once 'footer.php';

