<?php include 'includes/header.php'; ?>

<section>
    <h2>Find Your Perfect Home</h2>
    <form action="search.php" method="get">
        <label for="search">Search for your home:</label>
        <input type="text" id="search" name="query" placeholder="Enter property name or location">
        <button type="submit">Search</button>
    </form>
</section>

<section>
<h2>Featured Properties</h2>

<?php
$data = file_get_contents("data/properties.json");
$properties = json_decode($data, true);
?>

<?php foreach ($properties as $property): ?>

<article>
    <img src="<?php echo $property['slider_images'][0]['file']; ?>" width="200">

    <h3><?php echo $property['name']; ?></h3>
    <p>Location: <?php echo $property['location']; ?></p>
    <p>Price: <?php echo $property['price']; ?></p>
    <p>Recommendation Score: <?php echo $property['score']; ?>/10</p>

    <a href="property.php?id=<?php echo $property['id']; ?>">View Details</a>
</article>

<?php endforeach; ?>

</section>

<?php include 'includes/footer.php'; ?>