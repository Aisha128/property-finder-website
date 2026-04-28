<?php
session_start();

// user must be logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// only handle post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $propertyId = $_POST["property_id"];
    $rating = $_POST["rating"];
    $comment = trim($_POST["comment"]);
    $username = $_SESSION["username"];

    // simple server-side validation
    if ($comment == "" || $rating < 0 || $rating > 10) {
        header("Location: property.php?id=" . $propertyId);
        exit();
    }

    // read existing reviews
    $data = file_get_contents("data/reviews.json");
    $reviews = json_decode($data, true);

    // if file is empty
    if (!is_array($reviews)) {
        $reviews = [];
    }

    // add new review
    $newReview = [
        "property_id" => (int)$propertyId,
        "username" => $username,
        "rating" => (int)$rating,
        "comment" => $comment
    ];

    $reviews[] = $newReview;

    // save back to json
    file_put_contents("data/reviews.json", json_encode($reviews, JSON_PRETTY_PRINT));

    // go back to the same property page
    header("Location: property.php?id=" . $propertyId);
    exit();
}
?>