<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'AutomotivePartsDistributor');
    define('DB_DSN', "mysql:host=".DB_HOST.";dbname=".DB_NAME);
    try{
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        // $insert_user = $pdo->prepare("INSERT INTO `users`(`username`, `password`, `email`, `mobile`, `address`, `gender`) VALUES (':username',':password',':email',':mobile',':address', ':gender')");
        // $insert_user = $pdo->prepare("INSERT INTO users(username, password, email, mobile, address, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_user = $pdo->prepare("INSERT INTO users(username, password, email, mobile, address, gender) VALUES (:username, :password, :email, :mobile, :address, :gender)");

        // $users = $pdo->query("SELECT * FROM users")->fetchAll();
        // echo "<br>";
        // print_r($users);
        // echo "<br>";
        // $count = count($users);
        // echo "<br>";
        // echo $count;

        $search_user = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");

        
        $brands = $pdo->query("SELECT DISTINCT brand FROM parts");
        $brands = $brands->fetchAll();
        
        $get_models = $pdo->prepare("SELECT DISTINCT model FROM parts WHERE brand = :brand");
        
        
        $parts = ['engine', 'brake', 'headlights', 'wheel/tyre'];

        $get_parts = $pdo->prepare("SELECT * FROM `parts` WHERE brand = :brand AND model = :model AND `type` = :part");

        $get_part = $pdo->prepare("SELECT * FROM parts WHERE id = :id LIMIT 1");
        
        $insert_part = $pdo->prepare("INSERT INTO carts(user_id, part_id, quantity) VALUES (:user_id, :part_id, 1)");

        $in_cart = $pdo->prepare("SELECT COUNT(*) AS count FROM carts WHERE user_id = :user_id AND part_id = :part_id");

        $get_cart_items = $pdo->prepare("SELECT * FROM parts WHERE id IN (SELECT part_id FROM carts WHERE user_id = :user_id)");

        $get_quantity = $pdo->prepare("SELECT quantity FROM carts WHERE user_id = ? AND part_id = ? LIMIT 1");

        $update_quantity = $pdo->prepare("UPDATE carts SET quantity = :quantity WHERE user_id = :user_id AND part_id = :part_id");

        $remove_item = $pdo->prepare("DELETE FROM carts WHERE user_id = :user_id AND part_id = :part_id");

        $get_cart_details = $pdo->prepare("SELECT parts.id AS id, parts.brand AS brand, parts.model AS model,parts.name AS name, parts.price AS price, parts.status AS status, carts.quantity AS quantity FROM carts INNER JOIN parts ON carts.part_id = parts.id WHERE carts.user_id = :user_id");

        $get_user = $pdo->prepare("SELECT username,address FROM users WHERE id = :id;");

        $remove_from_cart = $pdo->prepare("DELETE FROM carts WHERE user_id = :user_id");

        $add_sale = $pdo->prepare("INSERT INTO sales(user_id, part_id, quantity) VALUES (?, ?, ?)");

        $search_company = $pdo->prepare("SELECT * FROM company WHERE id = :cid AND password = :cpass");
        
        $manage_parts = $pdo->prepare("SELECT * FROM parts WHERE company_id = :company_id");
        
        $get_status = $pdo->prepare("SELECT * FROM parts WHERE id = :part_id");

        $change_request = $pdo->prepare("UPDATE parts SET request = :request WHERE id = :part_id");

        $change_status = $pdo->prepare("UPDATE `parts` SET `status` = :status WHERE `parts`.`id` = :part_id");
        
        $get_sale = $pdo->prepare("SELECT parts.id AS id, parts.name AS name, sales.quantity AS quantity, parts.price AS price FROM parts INNER JOIN sales ON parts.id = sales.part_id WHERE parts.company_id = :company_id");

        $search_admin = $pdo->prepare("SELECT * FROM admins WHERE name = :aname AND password = :apass");

        $count_users = $pdo->query("SELECT COUNT(*) AS count FROM users");
        $user_count = $count_users->fetch()->count;

        $distinct_parts_sold = $pdo->query("SELECT COUNT(DISTINCT part_id) AS count FROM sales");
        $distinct_parts_sold = $distinct_parts_sold->fetch()->count;

        $max_sale = $pdo->query("SELECT sales.part_id AS id, parts.brand AS brand, parts.model AS model, parts.name AS name, parts.price AS price, SUM(sales.quantity) AS quantity  FROM sales INNER JOIN parts ON sales.part_id = parts.id GROUP BY sales.part_id ORDER BY sales.quantity DESC  LIMIT 1");
        $max_sale_part = $max_sale->fetch();

        $get_sales = $pdo->prepare("SELECT parts.id AS id, parts.name AS name, sales.quantity AS quantity, parts.price AS price FROM parts INNER JOIN sales ON parts.id = sales.part_id WHERE parts.brand = :brand");
        
        $get_customers = $pdo->query("SELECT DISTINCT(sales.timestamp) AS timestamp, users.id AS id, users.username AS name, users.address AS address, users.mobile AS mobile FROM sales INNER JOIN users ON sales.user_id = users.id;");
        $customers = $get_customers->fetchAll();

        // $get_orders = $pdo->prepare("SELECT parts.brand AS brand, parts.model AS model, parts.name AS name, parts.price AS price, sales.quantity AS quantity FROM parts INNER JOIN sales ON parts.id = sales.part_id WHERE sales.user_id = :user_id");
        $get_orders = $pdo->prepare("SELECT parts.brand AS brand, parts.model AS model, parts.name AS name, parts.price AS price, sales.quantity AS quantity FROM parts INNER JOIN sales ON parts.id = sales.part_id WHERE sales.user_id = ? AND sales.timestamp = ?");
        // $get_orders = $pdo->prepare("SELECT parts.brand AS brand, parts.model AS model, parts.name AS name, parts.price AS price, sales.quantity AS quantity FROM parts INNER JOIN sales ON parts.id = sales.part_id WHERE sales.user_id = ? AND date_format('Y-m-d H:i:', sales.`timestamp`) = date_format('Y-m-d H:i:', ?)");

    }catch(PDOException $e){
        // echo $e;
        die("<script>alert('Cannot connect to database');</script>");
        // echo $e;
        // echo "<BR>";
        // var_dump($pdo);
    }
?>