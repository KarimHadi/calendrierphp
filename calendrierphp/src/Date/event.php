<?php

namespace Calendar;

class Events {

 public function getEventsBetween (\DateTime $Start, \DateTime $end) : array  {
     $pdo= new \PDO('mysql:host=localhost;dbname=calendrier', 'root' , '', [
        \PDO::ATTR_ERRMODE=> \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC

    ]);
    $sql = "SELECT * FROM evenement WHERE start BETWEEN '{$Start->format('Y-m-d 00:00:00')}' AND
    '{$end->format('Y-m-d 23:59:59')}'";
    $statement = $pdo->query($sql);
    $results= $statement->fetchAll();
     return $results;

 }


 public function getEventsBetweenByDay (\DateTime $start, \DateTime $end) : array {
     $events= $this->getEventsBetween($start, $end);
     $days= [];
     foreach($events as $event) {
         $date =explode( ' ', $event['start'])[0];
         if (!isset($days[$date])) {
             $days[$date]=[$event];
         } else {
             $days[$date][]= $event;
         }
     }
         return $days;
     }

}
 ?>
