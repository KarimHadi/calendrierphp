<?php

namespace Calendar;

class Events {

    private $pdo;

public function __construct(\PDO $pdo)
{
    $this->pdo = $pdo;
}

    public function getEventsBetween (\DateTime $start, \DateTime $end) : array  {
    $sql = "SELECT * FROM evenement WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND
    '{$end->format('Y-m-d 23:59:59')}'";
    $statement = $this->pdo->query($sql);
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


     public function find(int $id): \Calendar\Event {
        require  'C:\wamp64\www\calendrierphp\src\Date\Event.php';
        $statement = $this->pdo->query("SELECT * FROM evenement WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO ::FETCH_CLASS, \Calendar\Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception('Aucun résulat n\'a été trouvé');
        }
        return $result;

   }
}
