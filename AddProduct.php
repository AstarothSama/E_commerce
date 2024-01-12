<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Product - E-commerce Site</title>
	

</head>
<body>
	<style>

form {
  display: flex;
  flex-direction: column;
  width: 400px;
  padding: 20px;
  background-color: darkblue;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  color: white;
}

h1 {
  font-size: 3vh;
  text-align: center;
  margin-bottom: 20px;
  color: darkblue;
}

label {
  font-weight: bold;
  font-size: 2vh;
  margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
textarea {
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size: 1em;
}

textarea {
  height: 100px;
}

button {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}

input[type="file"] {
  margin-bottom: 20px;
}

input[type="file"]::-webkit-file-upload-button {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

input[type="file"]::-webkit-file-upload-button:hover {
  background-color: #3e8e41;
}


	</style>
	
		<h1>Add Product</h1>
		<form  method="post" enctype="multipart/form-data" action="../products_add.php" style=" font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">

			<label for="product-name">Product Name</label><br>
			<input type="text" id="product-name" name="product-name" required><br>

			<label for="product-image">Product Image</label><br>
			<input type="file" id="product-image" name="product-image" accept="image/*" required><br>

			<label for="product-price">Product Price</label><br>
      <div class="input-container">
			<input type="text" id="product-price" name="product-price" min="0" pattern="^\d+(\.\d{1,2})?$" required>
      <span class="currency">TND</span>
    
    </div><br><br>

    <style>
   .currency {
    display: inline-block;
    margin-left: -2.5em;
    margin-top: 0.5em;
    color: black;
  }
  .input-container {
    position: relative;
  }
  #product-price {
    padding-right: 3.5em;
  }
</style>


<label for="auction-end-time">Auction End Time:</label><br>
<input type="datetime-local" id="auction-end-time" name="auction_end_time" required>

			<label for="product-description">Product Description</label><br>
			<textarea id="product-description" name="product-description" required></textarea><br>

			<button>Add</button>
		</form>
    
	
  

</body>
</html>

