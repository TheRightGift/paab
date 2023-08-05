<?php

namespace App\Http\Controllers\Tenants;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Tenants\Bio;
use Illuminate\Http\Request;
use App\Models\Tenants\General;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Mail\NotifyTenantOfIncomingMail;
use App\Models\Tenants\Mail as TenantsMail;

class MailController extends Controller
{
    public function interceptor(Request $request) {
        $body = $request->getContent();
        return $this->processInterceptor($body);
    }
    #TODO:Delete MX on Route53 and emailforward alias and retest 

    public function processInterceptor($data) {
        $contents = json_decode($data);
        $tenants = new Tenant();
        $users = new User();
        $to = $contents->to->text;
        $emailParts = explode('@', $to);
        $domain = $emailParts[1];
        $tenant = $tenants->where('domainName', 'LIKE', "%$domain%")->first();
        if (!empty($tenant)) {
            $user = $users->find($tenant->user_id);
            $userMail = $user->email;
            Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

            DB::connection('mysql')->reconnect();
            DB::setDatabaseName($tenant->tenancy_db_name);
            $datum = [
                'to' => $to,
                'toHtml' => $contents->to->html,
                'bodyAsHtml' => $contents->html,
                'textAsHtml' => $contents->textAsHtml,
                'text' => $contents->text,
                'fromAsHtml' => $contents->from->html,
                'from' => $contents->from->text,
                'subject' => $contents->subject,
                'created_at' => $contents->date
            ];
            $userData = DB::table('mails')->insert($datum);
            Mail::to($userMail, new NotifyTenantOfIncomingMail($domain, $user));
            Log::info($userData);
            if ($userData) {
                return response()->json(['status' => 'OK']);
            }
        } else {
            return response()->json('OK');
        }
        // Get the contents of the mail and check the to address
        // Compare with tenant table and check against the $tenant->domainName
        // If any matches 
        // Get the id and prefix with tenant{tenantID}
        // Switch to Database
        // Create the data from the mail to the database
        // Send a message to the tenant email with a link to the email inbox
        // return done if ok
    }

    public function getMails() {
        $tenancies = new Tenant();
        $tenant = $tenancies->find(tenant('id'));
        $template_id = $tenant->template->id;
        $template = $tenant->template->title;
        $templateCSS = $tenant->template->styleFile;
        $tenantID = strtolower(tenant('id'));

        $bioTB = Bio::first();
        $pageTitles = General::first();
        $pageTitle = (!empty($pageTitles) ? $pageTitles->title : $bioTB !== null) ? 'Dr '.$bioTB->firstname.' '.$bioTB->lastname : null;
        
        $mails = TenantsMail::all();

        return view('websites.mails', compact('mails', 'templateCSS', 'template_id', 'tenantID', 'pageTitle', 'template', 'bioTB'));
    }
}
