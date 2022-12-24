<?php
namespace App\Trait;

use App\Notifications\Tenants\SettingsNotifier;
use App\Models\User;
trait ServiceNotifier {
    public function settingschangeNotify() {
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        (new User)->forceFill([
            'email' => tenant()->user->email,
        ])->notify(new SettingsNotifier($hostname));
    }
}
?>