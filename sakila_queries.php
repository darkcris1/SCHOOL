<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakila";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$queries = array(
    "1a"=>"SELECT first_name, last_name from actor;",
    "1b"=>"Select upper(concat(first_name,' ',last_name)) as 'Actor Name' from actor;",
    "2a"=>"select actor_id, first_name, last_name from actor where first_name like 'Joe';",
    "2b"=>"select first_name, last_name from actor where last_name like '%GEN%';",
    "2c"=>"select first_name, last_name from actor where last_name like '%LI%' order by last_name, first_name;",
    "2d"=>"select country_id, country from country where country in ('Afghanistan', 'Bangladesh', 'China');",
    "3a"=>"select last_name as 'Last Name', count(last_name) as 'Last Name Count' from actor group by last_name;",
    "4b"=>"select last_name as 'Last Name', count(last_name) as 'Last Name Count' from actor group by last_name having count(last_name) > 1;",
    "6a"=>"select s.first_name as 'First Name', s.last_name as 'Last Name', a.address as 'Address' from staff as s join address as a  ON a.address_id = s.address_id;",
    "6b"=>"select concat(s.first_name,' ',s.last_name) as 'Staff Member', sum(p.amount) as 'Total Amount' from payment as p join staff as s on p.staff_id = s.staff_id where payment_date like '2005-08%' group by p.staff_id;",
    "6c"=>"select f.title as 'Film', count(fa.actor_id) as 'Number of Actors' from film as f join film_actor as fa on f.film_id = fa.film_id group by f.title;",
    "6d"=>"select f.title as Film, count(i.inventory_id) as 'Inventory Count' from film as f join inventory as i on f.film_id = i.film_id where f.title = 'Hunchback Impossible' group by f.film_id;",
    "6e"=>"select concat(c.first_name,' ',c.last_name) as 'Customer Name', sum(p.amount) as 'Total Paid' from payment as p join customer as c on p.customer_id = c.customer_id group by p.customer_id;",
    "7a"=>"select f.title from film as f where f.language_id = (select language_id from language where name = 'English') and f.title like 'K%' or 'Q%' ;",
    "7b"=>"select CONCAT(first_name,' ',last_name) as 'Actors in Alone Trip' from actor where actor_id in  (select actor_id from film_actor where film_id =  (select film_id from film where title = 'Alone Trip'));",
    "7c"=>"select concat(c.first_name,' ',c.last_name) as 'Name', c.email as 'E-mail' from customer as c join address as a on c.address_id = a.address_id join city as cy on a.city_id = cy.city_id join country as ct on ct.country_id = cy.country_id where ct.country = 'Canada';",
    "7d"=>"select f.title as 'Movie Title' from film as f join film_category as fc on fc.film_id = f.film_id join category as c on c.category_id = fc.category_id where c.name = 'Family';",
    "7e"=>"select f.title as 'Movie', count(r.rental_date) as 'Times Rented' from film as f join inventory as i on i.film_id = f.film_id join rental as r on r.inventory_id = i.inventory_id group by f.title order by count(r.rental_date) desc;",
    "7f"=>"select store as 'Store', total_sales as 'Total Sales' from sales_by_store;",
    "7g"=>"select s.store_id as 'Store ID', c.city as 'City', cy.country as 'Country' from store as s join address as a on a.address_id = s.address_id join city as c on c.city_id = a.city_id join country as cy on cy.country_id = c.country_id order by s.store_id;",
    "7h"=>"select c.name as 'Film', sum(p.amount) as 'Gross Revenue' from category as c join film_category as fc on fc.category_id = c.category_id join inventory as i on i.film_id = fc.film_id join rental as r on r.inventory_id = i.inventory_id join payment as p on p.rental_id = r.rental_id group by c.name order by sum(p.amount) desc limit 5;",
    "8b"=>"SELECT * FROM top_5_genre_revenue;",
);

$paramsQuery = $_GET['query']; 
// Execute queries and generate HTML
$html = "";
if ($paramsQuery != "") {
    $result = $conn->query($queries[$paramsQuery]);
    
    $html .= "<h3 class='mt-3'>Query: $paramsQuery</h3>";
    
    if ($result->num_rows > 0) {
        $html .= "<table class='table'><tr>";
        
        // Output table headers
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            $html .= "<th>{$field->name}</th>";
        }
        $html .= "</tr>";
        
        // Output table rows
        while ($row = $result->fetch_assoc()) {
            $html .= "<tr>";
            foreach ($row as $value) {
                $html .= "<td>$value</td>";
            }
            $html .= "</tr>";
        }
        
        $html .= "</table>";
    } else {
        $html .= "No results found.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/newsfeed.css">
    <title>Sakila queries</title>
</head>

<body x-data="Post()">
  <?php include 'components/header.php' ?>
    <div class="container py-5">
        <div class="row">
    
            <div class="col-md-6 mx-auto py-2">
                <h2>Sakila</h2>

                <form action="" method="GET">
                    <select 
                        class="form-control"
                        name="query"
                        value="<?php echo $_GET['query']; ?>"
                        id="<?php echo $queryKey; ?>" name="<?php echo $queryKey; ?>">
                        <?php foreach($queries as $queryKey => $queryValue): ?>
                            <?php if ($queryKey == $paramsQuery ) { ?>
                                <option 
                                    selected
                                    value="<?php echo $queryKey; ?>">
                                    <?php echo $queryKey; ?>"
                                    <?php echo $queryValue; ?>
                                </option>
                            <?php } else { ?>
                                <option 
                                    value="<?php echo $queryKey; ?>">
                                    <?php echo $queryKey; ?>"
                                    <?php echo $queryValue; ?>
                                </option>
                            <?php }  ?>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-primary mt-2">
                        Submit
                    </button>
                </form>
                <?php echo $html; ?>"
            </div>
    </div>
</body>

</html>