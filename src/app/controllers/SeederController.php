<?php

require_once APP_DIR . 'seeder/Seeder.php';

class SeederController {
    public function seed() {
        $seeder = new Seeder();
        $seeder->seed();
    }
    
    public function seedRebuild() {
        $seeder = new Seeder(true);
        $seeder->seed();
    }
}
