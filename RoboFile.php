<?php

use \Robo\Tasks;
use \coverallskit\robo\loadTasks as CoverallsKitTasks;

class RoboFile extends Tasks
{
    use PeridotTasks;
    use CoverallsKitTasks;

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configureBy('.coveralls.toml')
            ->run();

        return $result;
    }

}
