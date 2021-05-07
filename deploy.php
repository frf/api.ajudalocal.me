<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/slack.php';

// Project name
set('application', 'api-ajudalocal');

// Project repository
    set('repository', 'git@github.com:frf/api.ajudalocal.me.git');

set('slack_webhook', 'https://hooks.slack.com/services/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');
set('slack_title', 'Application: {{application}}');
set('slack_text', '_{{user}}_ deploying branch: `{{branch}}` to *https://{{hostname}}*');
set('slack_success_text', 'Deploy *{{hostname}}* successful');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

// Hosts
host('104.131.170.111')
    ->hostname('104.131.170.111')
    ->user('ajudalocal')
    ->set('deploy_path', '/var/www/ajudalocal');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('supervisor:execute', function () {
    run('sudo killall -q supervisord ');
    run('/usr/bin/supervisord -c /var/www/ajudalocal/shared/supervisor.conf ');
});

task('supervisor:upload', function() {
    upload('supervisor.conf', '/var/www/ajudalocal/shared/supervisor.conf');
});

task('deploy', [
    'supervisor:upload',
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:optimize:clear',
    'deploy:symlink',
    'artisan:migrate',
    'deploy:unlock',
    'cleanup',
]);

before('deploy', 'slack:notify');
after('success', 'slack:notify:success');
before('deploy', 'slack:notify');

after('deploy', 'success');
after('deploy', 'supervisor:execute');

after('success', 'slack:notify:success');
after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'slack:notify:failure');


