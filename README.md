# Mini-Framework Admin Dashboard

**Project made with**
- https://github.com/RicManByakugan/SurProject
- https://github.com/RicManByakugan/GSL
- https://github.com/RicManByakugan/CP2.0
- https://github.com/RicManByakugan/Agricode

**Base code** for creating administrative applications. This project provides a starting structure to quickly add new features (such as user management, product management, etc.) using PHP, MySQL, and AJAX for asynchronous data management.

## Existing Features

- **User Management (Personnel)**: Add, modify, delete, and update the connection statuses of administrative users.
- **Authentication**: Login system for administrators.
- **AJAX Data Transfer**: Update data without reloading the page.
- **Extensible Model**: Easy to add new modules like product management.

## Prerequisites

Make sure you have the following tools installed:

- **PHP** (version 5.5 or newer)
- **MySQL** (version 5.6 or newer)
- A local server like **XAMPP** or **WAMP**
- **Git** to clone the project
- **phpMyAdmin** for database management

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/RicManByakugan/php_socle.git
   ```

2. **Set up the database**:

   - Create a new database in MySQL using phpMyAdmin.
   - Import the provided SQL file in the repository (`admin.sql`). 

3. **Configure the database connection**:

   In the `config.php` file, set your MySQL database access information:

   ```php
   // config.php
   private $localhost = "localhost";
   private $password = "your_password";
   private $user = "your_username";
   private $dbname = "your_database_name";
   ```

4. **Launch the application**:

   Place the project files in the `htdocs` folder (if you are using XAMPP) or `www` (if you are using WAMP), then start the server.

   Access the project in your browser:

   ```
   http://localhost/php_socle/
   ```

## Project Structure

- **/model/**: Contains model classes for various entities (like `Personnel`).
- **/controller/**: Contains controllers that manage the application logic.
- **/view/**: Contains HTML/PHP files for display.
- **/content/**: Contains CSS, JS, and image files.
- **/data/**: Contains images useful for the database.
- **/config/**: Configuration file for the database.

## Usage

### Adding a Module

1. **Create a model**:
   Add a class in the `/models/` folder to represent the new entity (for example, `Product`).
   
   Example product model:

   ```php
   class Product {
       private $bdd;

       public function __construct($bdd) {
           $this->bdd = $bdd;
       }

       public function addProduct($name, $description, $price, $quantity) {
           $sql = "INSERT INTO product (productName, description, price, quantity) VALUES ('$name', '$description', $price, $quantity)";
           return $this->bdd->exec($sql);
       }
   }
   ```

2. **Create a controller**:
   Create a method in the controller that handles the business logic and retrieves data from the model.

   Example controller to add a product:

   ```php
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $name = $_POST['productName'];
       $description = $_POST['description'];
       $price = $_POST['price'];
       $quantity = $_POST['quantity'];
       
       $product = new Product($bdd);
       $product->addProduct($name, $description, $price, $quantity);
   }
   ```

3. **Add the view**:
   Create the HTML/PHP page with the form allowing the admin to add a product, using AJAX to send data without reloading the page.

   ```html
   <form id="addProductForm">
       <input type="text" name="productName" placeholder="Product Name">
       <input type="text" name="description" placeholder="Description">
       <input type="number" name="price" placeholder="Price">
       <input type="number" name="quantity" placeholder="Quantity">
       <button type="submit">Add Product</button>
   </form>

   <script>
       $('#addProductForm').on('submit', function(e) {
           e.preventDefault();
           $.ajax({
               type: 'POST',
               url: 'controller/productController.php',
               data: $(this).serialize(),
               success: function(response) {
                   alert('Product added successfully!');
               }
           });
       });
   </script>
   ```

## Contributing

Contributions are welcome! If you would like to add features or fix bugs, feel free to submit a pull request.