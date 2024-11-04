<?php

// Define the table headers
$headers = array(
    'ID',
    'Name',
    'Description',
    'Quantity',
    'Price',
    'Status',
);

// Define the table rows
$rows = array();
foreach ($products as $product) {
    $rows[] = array(
        $product['id'],
        $product['name'],
        $product['description'],
        $product['quantity'],
        $product['price'],
        $product['status'],
    );
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 80%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"], input[type="number"], textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
    }

    input[type="file"] {
        margin-bottom: 20px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #3e8e41;
    }
</style>

<table>
    <thead>
        <tr>
            <?php foreach ($headers as $header) : ?>
                <th><?php echo $header; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row) : ?>
            <tr>
                <?php foreach ($row as $cell) : ?>
                    <td><?php echo $cell; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form action="<?php echo base_url('product/add'); ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">

    <label for="price">Price:</label>
    <input type="number" name="price" id="price">

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image">

    <input type="submit" value="Add Product">
</form>