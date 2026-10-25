
<?php
// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Please submit the tutoring request form.");
}

// Get the submitted form values
$course = trim($_POST["course"] ?? "");
$topic = trim($_POST["topic"] ?? "");
$preferredDate = $_POST["preferreddate"] ?? "";
$preferredTime = $_POST["preferredtime"] ?? "";

// Allowed options
$allowedCourses = ["IS 6465", "IS 6495", "IS 6570"];
$allowedTimes = ["Morning", "Afternoon", "Evening"];

// Store validation errors
$errors = [];

// Validate course
if (!in_array($course, $allowedCourses, true)) {
    $errors[] = "Please select a valid course.";
}

// Validate topic
if ($topic === "") {
    $errors[] = "Topic is required.";
} elseif (mb_strlen($topic) > 120) {
    $errors[] = "Topic must be 120 characters or fewer.";
}

// Validate preferred time
if (!in_array($preferredTime, $allowedTimes, true)) {
    $errors[] = "Please select a valid preferred time.";
}

// Validate preferred date
$date = DateTimeImmutable::createFromFormat(
    "!Y-m-d",
    $preferredDate
);

$dateErrors = DateTimeImmutable::getLastErrors();

if (
    !$date ||
    ($dateErrors !== false &&
        ($dateErrors["warning_count"] > 0 ||
         $dateErrors["error_count"] > 0)) ||
    $date->format("Y-m-d") !== $preferredDate
) {
    $errors[] = "Please enter a valid date.";
} elseif ($date < new DateTimeImmutable("today")) {
    $errors[] = "Preferred date cannot be in the past.";
}

// Safely display text in HTML
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoring Request Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>
<main class="container py-5">

<?php if (!empty($errors)): ?>

    <h1>Request could not be submitted</h1>

    <ul class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <li><?= escape($error) ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="request-form.html" class="btn btn-primary">
        Back to Form
    </a>

<?php else: ?>

    <h1>Request received</h1>

    <p><strong>Course:</strong> <?= escape($course) ?></p>
    <p><strong>Topic:</strong> <?= escape($topic) ?></p>
    <p><strong>Preferred Date:</strong> <?= escape($preferredDate) ?></p>
    <p><strong>Preferred Time:</strong> <?= escape($preferredTime) ?></p>
    <p><strong>Status:</strong> Pending review</p>

    <a href="request-form.html" class="btn btn-primary">
        Submit Another Request
    </a>

<?php endif; ?>

</main>
</body>
</html>
