<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tygodniowy Harmonogram Pracy</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <style>
    body
    {
        background-color:lightblue;
        text-align: center;
    }
    h1
    {
        text-shadow: 4px 4px 6px rgba(66, 68, 90, 1);
    }
    table
    {
        border: 1px solid; 
        margin: 15px; 
        box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1); 
        font-size: 45px; 
        height: 500px; 
        float:left;
        width: 20%; 
    }
    th
    {
        border-bottom: 5px solid;
    }
</style>
    <h1>Tygodniowy Harmonogram pracy</h1>
    <form action="index.php" method="get">
        <input type="date" name="data">
        <input type="number" name="columns" placeholder="Szerokość kolumn">
        <input type="checkbox" name="descripts">
        <label for="descripts">Wyświetlaj opisy</label>
        <select name="choosen">
            <option>data</option>
            <option>imie</option>
            <option>nazwisko</option>
        </select>
        <input type="submit">
    </form>
<div class="tabelka">

<?php
if(isset($_GET['choosen'])&&isset($_GET['columns']))
{
$conn = mysqli_connect('localhost', 'root', '', 'harmonogram');
$filter = $_GET["choosen"];
$width = $_GET["columns"];
if(!empty($_GET['data']))
{
    $data = $_GET['data'];
    $query = "SELECT * FROM praca WHERE data='$data'";
}
else
{
    $query = "SELECT * FROM praca ORDER BY $filter DESC";
}
$columns = $_GET['columns'];
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc())
    {
        echo "<table style='width:".$columns."%'>";
        echo "<tr>"."<th>".$row["$filter"]."</th>"."</tr>";

        if($filter!="imie")
        {
        echo "<tr>";
        echo "<td>".$row["imie"]."</td>";
        echo "</tr>";
        }
        if($filter!="nazwisko")
        {
        echo "<tr>";
        echo "<td>".$row["nazwisko"]."</td>";
        echo "</tr>";
        }

        if($filter!="data")
        {
        echo "<tr>";
        echo "<td>".$row["data"]."</td>";
        echo "</tr>";  
        }
        if(isset($_GET['descripts']))
        {
        echo "<tr>";
        echo "<td>".$row["opis"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
    }
} 
else {
    echo "Brak wyników";
}
$conn->close();
}
?>
</div>
</body>
</html>