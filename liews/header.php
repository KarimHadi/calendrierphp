
<!Doctype HTML>

<html>


<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/calendrierphp/idea/public/css/calendar.css">
 <title><?= isset($title) ? h($title) : 'Mon calendrier'; ?></title>

</head>
<body>

    <nav class="navbar navbar-dark bg-primary mb-3">
          <a href="/calendrierphp/idea/public/calendrier.php" class="navbar-brand">Mon calendrier</a>
    </nav>
