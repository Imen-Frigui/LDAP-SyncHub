
<?php
/*
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use LdapRecord\Connection;
use App\Models\LdapUser;

class SyncUsersToLdap extends Command
{
    protected $signature = 'sync:ldap-users';
    protected $description = 'Sync MySQL users to LDAP';

    public function handle()
    {
        $users = DB::table('users')->select('id', 'name', 'email', 'password')->get();

        foreach ($users as $user) {
            $dn = "uid={$user->id},ou=users,dc=example,dc=com";
            $attributes = [
                'cn' => $user->name,
                'sn' => $user->name,
                'mail' => $user->email,
                'userPassword' => $user->password,
            ];

            try {
                $this->info("LDAP Connection successfully retrieved.");

                // Use the LDAP facade to get the connection
                //$ldapConnection = Ldap::getConnection();
                $ldapConnection = app(Connection::class);


                // Query for an existing entry
                $entry = $ldapConnection->query()->where('dn', $dn)->first();

                if ($entry) {
                    $entry->update($attributes);
                    $this->info("User {$user->id} updated successfully.");
                } else {
                    // Create a new LDAP entry
                    $ldapUser = new LdapUser();
                    $ldapUser->setDn($dn);
                    $ldapUser->fill($attributes);
                    $ldapUser->save();

                    $this->info("User {$user->id} synced successfully.");
                }
            } catch (\Exception $e) {
                $this->error("Error syncing user {$user->id}: {$e->getMessage()}");
            }
        }
    }
}*/

