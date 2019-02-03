<?php

namespace App\Date;




Class Month{

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months =['Janvier','Février','Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;
    /**
     * [__construct description]
     * @param int le mois compris entre 1 et 12
     * @param int $year  L'année
     */
    public function __construct( ?int $month = null, ?int $year = null)
{
    if ($month === null || $month < 1 || $month >12) {
        $month = intval(date('m'));

    }
    if ($year === null || $month < 1 || $month >12){
        $year = intval(date('Y'));
    }

    if ($month < 1 || $month> 12) {


    }
    if ($year <1970) {

    }
    $this->month = $month;
    $this->year = $year;
 }
/**
 * Renvoie le premier jour du mois
 * @return DateTime [description]
 */
 public function getStartingDay(): \DateTime {
     return new \DateTime("{$this->year}-{$this->month}-01");
 }
/**
 *retourne le mois en toute lettre (ex: janvier 2019)
 * @return string [description]
 */
 public function toString() : string {
    return $this->months[$this->month - 1] . ' ' . $this->year;
}
/**
 * renvoie le nombre de semaine dans le mois
 * @return int [description]
 */
public function getWeeks (): int {
$start = $this->getStartingDay();
$end = (clone $start)->modify('+1 month -1 day');
$weeks = intval($end->format('W'))-intval($start->format('W'))+1;
if ($weeks < 0) {
    $weeks = intval($end->format('W'));

}
return $weeks;
}
public function withinMonth (\DateTime $date): bool
{
 return $this->getStartingDay ()  ->format('Y-m') === $date->format ('Y-m');
}


public function nextMonth (): Month
{
    $month = $this->month + 1;
    $year =$this->year;
    if ($month >12) {
        $month =1;
        $year += 1;
    }
    return new Month($month, $year);
}

public function previousMonth(): Month
{
    $month = $this->month - 1;
    $year = $this->year ;
    if ($month <1) {

        $month =12;
        $year -= 1;
    }
    return new Month($month, $year);
}
}
?>
