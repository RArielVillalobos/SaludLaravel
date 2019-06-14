<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableSeeder::class);
        $this->call(SocialWorkTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(NursesTableSeeder::class);

        $this->call(PatientsTableSeeder::class);
        $this->call(EpisodeStateTableSeeder::class);
        $this->call(EpisodesTableSeeder::class);

        $this->call(NursingShiftTableSeeder::class);
        $this->call(MedicalShiftTableSeeder::class);
        $this->call(PsychologystShiftTableSeeder::class);
        $this->call(KinesiologyShiftTableSeeder::class);
        $this->call(HighTypeTableSeeder::class);



    }
}
