<?php

use App\Module;
use App\Resource;
use App\Skill;
use App\Track;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $tracks = [
            [
                'name' => 'New to Programming',
            ],
            [
                'name' => 'Frontend Developers',
            ],
            [
                'name' => 'WordPress Developers',
            ],
        ];

        foreach ($tracks as $track) {
            factory(Track::class)->create(['name' => $track['name']]);
        }

        // Seed a few modules
        $modules = [
            [
                'name' => 'Build a basic web site',
                'skills' => [
                    'Write HTML',
                    'Write CSS',
                ],
                'resources' => [
                    'Intro to HTML at CSS-tricks' => 'https://www.yay.com/',
                    'Intro to CSS at CSS-tricks' => 'https://www.superyay.com/',
                ],
            ],
            [
                'name' => 'Basic terminal and version control',
                'skills' => [
                    'Navigate, open, and create files',
                    'Create git repos',
                    'Create git branches',
                ],
                'resources' => [
                    'Intro to Git at Tower' => 'https://www.tower.com/',
                    'Intro to Git branching at Gitlab' => 'https://www.superyay.com/',
                ],
            ],
            [
                'name' => 'Eloquent for WordPress Developers',
                'skills' => [
                    'Make models',
                    'Make migrations',
                    'Migrate and relate one-to-many',
                ],
                'resources' => [
                    'Eloquent for WP people Or Something' => 'https://www.superyay.com/',
                    'Advanced Eloquent' => 'https://www.yay.com/',
                ],
            ],
            [
                'name' => 'Eloquent for non-WordPress Developers',
                'skills' => [
                    'Make models',
                    'Make migrations',
                    'Migrate and relate one-to-many',
                ],
                'resources' => [
                    'Intro to Eloquent' => 'https://www.yay.com/',
                    'Advanced Eloquent' => 'https://www.yay.com/',
                ],
            ],
        ];

        $tracks = Track::all();

        foreach ($modules as $module) {
            $eloquentModule = Module::create([
                'name' => $module['name'],
            ]);

            // Attach to track
            $eloquentModule->tracks()->save($tracks->random());

            // Seed skills
            foreach ($module['skills'] as $skill) {
                factory(Skill::class)->create([
                    'name' => $skill,
                    'module_id' => $eloquentModule->id,
                ]);
            }

            // Seed resources
            foreach ($module['resources'] as $name => $url) {
                factory(Resource::class)->create([
                    'name' => $name,
                    'url' => $url,
                    'module_id' => $eloquentModule->id,
                ]);
            }
        }

        factory(User::class)->create([
            'email' => 'matt@tighten.co',
            'password' => bcrypt('password'),
        ]);
    }
}
