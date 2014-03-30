<?php
try {
    // open connection to MongoDB server
//    $conn = new Mongo("mongodb://Opfdoker:apitest3@localhost:27017");
    $conn = new Mongo("mongodb://Opfdoker:apitest3@localhost:27017");

    // access database
    $db = $conn->xmain;

  //  $list = $conn->admin->command(array("listDatabases" => 1));

 //   print_r($list);

   //  access collection
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

    $memcache = new Memcache; // instantiating memcache extension class
    $memcache->connect("localhost",11211); // try 127.0.0.1 instead of localhost
    // if it is not working

    echo "<br />\nServer's version: " . $memcache->getVersion() . "<br />\n";

    // we will create an array which will be stored in cache serialized
    $testArray = array('horse', 'cow', 'pig');
    $tmp       = serialize($testArray);

    $memcache->add("key_123", $testArray, 0, 30);

    echo "Data from the cache:<br />\n";
    print_r($memcache->get("key_123"));

} catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
}