
<?php
// Part 1: Indexed Array
$timeSlots = ["Morning", "Afternoon", "Evening"];

// Part 2: Associative Array
$request = [
    "course" => "IS 6465",
    "topic" => "Help understanding PHP arrays",
    "status" => "Pending review"
];

// Part 3: Multidimensional Array
$requests = [
    [
        "student" => "Alex",
        "course" => "IS 6465",
        "status" => "Pending review"
    ],
    [
        "student" => "Jordan",
        "course" => "IS 6495",
        "status" => "Approved"
    ]
];

// Part 4: Courses Array
$courses = ["IS 6465", "IS 6495", "IS 6570"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 3 - PHP Arrays</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>
<main class="container py-5">

    <h1>Lab 3: PHP Arrays</h1>

    <h2>1. Indexed Array</h2>
    <p>First time slot: <?= htmlspecialchars($timeSlots[0]) ?></p>
    <p>Second time slot: <?= htmlspecialchars($timeSlots[1]) ?></p>

    <h2>2. Associative Array</h2>
    <p>Topic: <?= htmlspecialchars($request["topic"]) ?></p>

    <h2>3. Multidimensional Array</h2>
    <ul>
        <?php foreach ($requests as $item): ?>
            <li>
                Student: <?= htmlspecialchars($item["student"]) ?>,
                Course: <?= htmlspecialchars($item["course"]) ?>,
                Status: <?= htmlspecialchars($item["status"]) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>4. Courses Using foreach</h2>
    <label for="course">Available Courses:</label>
    <select id="course" class="form-select">
        <?php foreach ($courses as $course): ?>
            <option value="<?= htmlspecialchars($course) ?>">
                <?= htmlspecialchars($course) ?>
            </option>
        <?php endforeach; ?>
    </select>

</main>
</body>
</html>
