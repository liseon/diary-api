<?php
try {
    // open connection to MongoDB server
    $conn = new Mongo();

    // access database
    $db = $conn->test;

    // access collection
    $collection = $db->items;
    $findParams = array(
        "quantity" => '{$gt: 9}',
        "price" => '{$lt: 1}',
    );

    // execute query
    // retrieve all documents
    $cursor = $collection->find($findParams);

    // iterate through the result set
    // print each document
    echo $cursor->count() . ' document(s) found. \r\n';
    foreach ($cursor as $obj) {
        echo 'Name: ' . $obj['name'] . '\r\n';
        echo 'Quantity: ' . $obj['quantity'] . '\r\n';
        echo 'Price: ' . $obj['price'] . '\r\n';
        echo '<br/>';
    }

    // disconnect from server
    $conn->close();
} catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
}
?>