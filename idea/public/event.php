

    <?php
    require 'C:\wamp64\www\calendrierphp\src\bootstrap.php';
    require  'C:\wamp64\www\calendrierphp\src\Date\Events.php';
        require 'C:\wamp64\www\calendrierphp\views\header.php';

    $pdo = get_pdo();

    $events = new Calendar\Events($pdo);
    if (!isset($_GET['id'])) {
        header('location: C:\wamp64\www\calendrierphp\idea\public\404.php');
    }

    try {
    $event = $events->find($_GET['id']);
} catch (\Exception $e) {
  e404();
}
    ?>
<h1><?= h($event->getName()); ?></h1>

<ul>
    <li>Date: <?= $event->getStart()->format('d/m/Y'); ?> </li>
    <li>Heure de démarrage: <?=  $event->getStart()->format('H:i'); ?> </li>
    <li>Heure de fin: <?=  $event->getEnd()->format('H:i'); ?> </li>
    <li>
        Description:<br>
         <?= h($event->getDescription());  ?>
     </li>
</ul>
    <?php require 'C:\wamp64\www\calendrierphp\views\footer.php'; ?>
