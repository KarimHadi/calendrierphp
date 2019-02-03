

    <?php

    require 'C:\wamp64\www\calendrierphp\src\bootstrap.php';
    require 'C:\wamp64\www\calendrierphp\src\Date\month.php';
    require 'C:\wamp64\www\calendrierphp\src\Date\Events.php';
    $pdo = get_pdo();
    $events = new Calendar\Events($pdo);
    $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $start =$month->getStartingDay();
    $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
    $weeks =$month->getWeeks();
    $end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . 'days');
    $events =$events->getEventsBetweenByDay($start, $end);
    require 'C:\wamp64\www\calendrierphp\views\header.php';

    ?>

    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <H1><?= $month->toString(); ?></h1>
    <div>
     <a href="/calendrierphp/idea/public/calendrier.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary ">&lt;</a>
     <a href="/calendrierphp/idea/public/calendrier.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year ?>" class="btn btn-primary ">&gt;</a>
    </div>
    </div>


    <table class="calendar calendar--<?= $weeks; ?>weeks">
        <?php for ($i = 0; $i < $weeks; $i++): ?>
            <tr>
                <?php
                 foreach($month->days as $k => $day):
                 $date = (clone $start)->modify("+" . ($k + $i *7) . " days");
                 $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                     ?>
                <td class="<?= $month->withinMonth($date) ? '' : 'calendar_othermonth'; ?>">
                    <?php if ($i===0): ?>
                    <div class="calendar_week"><?= $day; ?></div>
                <?php endif;?>
                    <div class="calendar_day"><?= $date->format('d'); ?></div>
                    <?php foreach($eventsForDay as $event): ?>
                        <div class="calendar_event">
                            <?= (new DateTime($event['start']))->format('H:i') ?> - <a href="http://localhost/calendrierphp/idea/public/event.php?id=<?= $event['id'];
                            ?>"><?= h($event['name']); ?></a>
                        </div>
                    <?php endForeach; ?>

                </td>
            <?php endForeach; ?>
            </tr>

        <?php endfor; ?>
    </table>
<?php require 'C:\wamp64\www\calendrierphp\views\footer.php'; ?>
