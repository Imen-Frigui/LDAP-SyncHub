<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use LdapRecord\Models\Entry;

class ImportUsersToLdap extends Command
{
    protected $signature = 'ldap:import-users';
    protected $description = 'Import users from MySQL to LDAP';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $entry = new Entry([
                'cn' => $user->first_name . ' ' . $user->last_name,
                'sn' => $user->last_name,
                'givenName' => $user->first_name,
                'mail' => $user->email,
                'uid' => $user->username,
                'userPassword' => $user->password,
                'objectClass' => ['inetOrgPerson', 'organizationalPerson', 'person', 'top'],
            ]);

            $entry->setDn("uid={$user->username},ou=users,dc=example,dc=com");

            try {
                $entry->save();
                $this->info("Successfully imported user: {$user->username}");
            } catch (\Exception $e) {
                $this->error("Failed to import user: {$user->username}, error: " . $e->getMessage());
            }
        }
    }
}

