<?php
    class RankingTable {
        private $players = array();

        public function __construct($playerNames) {
            foreach ($playerNames as $name) {
                $this->players[$name] = array(
                    'score' => 0,
                    'gamesPlayed' => 0,
                    'position' => 0
                );
            }
        }

        public function recordResult($playerName, $score) {
            if (isset($this->players[$playerName])) {
                $this->players[$playerName]['score'] += $score;
                $this->players[$playerName]['gamesPlayed']++;
            }
        }

        public function playerRank($rank) {
            uasort($this->players, function($a, $b) {
                if ($a['score'] != $b['score']) {
                    return $b['score'] - $a['score'];
                } elseif ($a['gamesPlayed'] != $b['gamesPlayed']) {
                    return $a['gamesPlayed'] - $b['gamesPlayed'];
                } else {
                    return $a['position'] - $b['position'];
                }
            });

            $playerKeys = array_keys($this->players);
            if (isset($playerKeys[$rank - 1])) {
                return $playerKeys[$rank - 1];
            }

            return null;
        }
    }

    $table = new RankingTable(array('Jan', 'Maks', 'Monika'));
    $table->recordResult('Jan', 2);
    $table->recordResult('Maks', 3);
    $table->recordResult('Monika', 5);
    echo $table->playerRank(1);
?>