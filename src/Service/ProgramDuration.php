<?php

namespace App\Service;
use App\Entity\Program;

class ProgramDuration
{
    public function calculate(Program $program): string
    {
        $result = 0;

        foreach ($program->getSeasons() as $season) {
            foreach ($season->getEpisodes() as $episode)
                $result += $episode->getDuration();
        }

        $days = floor($result / 60 / 24);
        $hours = floor(($result - ($days * 24 * 60)) / 60);
        $minutes = $result - (($days * 24 * 60) + ($hours * 60));

        return  $days . ' jours, ' . $hours . ' heures, ' . $minutes . ' minutes';
    }
}
