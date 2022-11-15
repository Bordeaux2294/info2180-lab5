<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt;

if (!isset($_GET["country"]))
 {
  $stmt = $conn->query("SELECT * FROM countries");
} 
else 
{
   $country = $_GET["country"];

  if(isset($_GET['lookup']) && $_GET['lookup'] == 'cities')
  {
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code=countries.code WHERE countries.name like '%$country%';");
  }

  else
   {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  }

}


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if(isset($_GET['lookup']) && $_GET['lookup'] == 'cities') { ?>
    <table>
      <tr>
        <th><?= 'Name'; ?></th>
        <th><?= 'District'; ?></th>
          <th><?= 'Population'; ?></th>
      </tr>
      <tbody>
        <?php foreach ($results as $row) : ?>
      <tr>
      <?php echo "<td>{$row['name']}</td>" ?>
      <?php echo "<td> {$row['district']}</td>" ?>
      <?php echo "<td> {$row['population']} </td>" ?>
      </tr>

    <?php endforeach; ?>
      </tbody>
    </table>
<?php } else
 {

   ?>
  <table>
        <tr>
          <th><?= 'Name'; ?></th>
          <th><?= 'Continent'; ?></th>
          <th><?= 'Independence'; ?></th>
          <th><?= 'Head of State'; ?></th>
        </tr>
    <?php foreach ($results as $row){ ?>
            <tr>
            <?php echo "<td>{$row['name']}</td>" ?>
            <?php echo "<td> {$row['continent']}</td>" ?>
            <?php echo "<td> {$row['independence_year']} </td>" ?>
            <?php echo "<td>{$row['head_of_state']}</td>" ?>
      
          </tr>
    <?php } ?>
    </table>

<?php } ?>