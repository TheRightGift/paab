<h1 align="center">White Coat Domain</h1>

## IMPORTANT NOTE
Please note that to get a migration of cities, countries, and states.
Please run the following 
<p>
    <code>php artisan db:seed</code> <br/> 
    <code>php artisan migrate --seed --seeder=GeneralSeeder</code> <br/> 
    <code>php artisan passport:install</code> <br/> 
    <code>php artisan serve</code> <br/> 
</p>
<p>
    When claiming site, handle from backend is changed to  eg. <strong>{tenantDomain}.localhost:8000/?token={tokenObtained}</strong> instead of <strong>https://whitecoatdomain.com/getstarted?token={token}&physician={tenant_id}</strong> crucial when passing url to claim button on email.
</p>
Note to self: As a result of <code>FK</code> - foreign key the <code>cities table</code> is the parent key with a reference at <code>users table</code><br/>
<b>IMPORTANT</b><p>For <strong>Stripe</strong> get 'api' keys for webhook and secret and rerun <code> php artisan cashier:webhook</code> to reconfigure for the inputted 'api</p>
<p>These events should be enabled for webhook events - <code>customer.deleted
customer.subscription.created
customer.subscription.deleted
customer.subscription.updated
customer.updated
invoice.payment_action_required
invoice.payment_succeeded</code></p>

<p>Replace "vendor/stancl/tenancy/src/Resolvers/DomainTenantResolver.php" with content of "DomainTenantResolver.php" in root folder</p>

<strong>NOTE</strong><p>Remember to change <code> APP_ENV </code> to <code> 'production' </code> and <code> APP_DEBUG </code> to <code> false </code></p>

## Tasks 

- [ ] Integrate company stripe account
- [x] Develop Domain module (API endpoints)
- [x] Setup and test TSL (both for central and for tenants)
- [x] Increase AWS EC2 from tmicro to tLarge or tXLarge
- [x] Setup 2 instances of app
- [ ] Change session from file to db
- [ ] Setup NGINX Load Balancer for 2 app instances
- [x] Namesilo: purchase domain from namesilo
- [x] AWS: create Route53 Hosted zone
- [x] AWS: Update Hosted zone's A-record records
- [x] AWS: get value of NS record (4nameserver IPs)
- [x] Namesilo:change domain nameservers to point to AWS 
- [x] integrate interest to admin client creation
- [x] remove "additional academic ..." from physician account registration
- [x] Replace "additional academic ..." with interests
- [ ] Add payment to physiciandomain.com/settings. If not paid, disable setting paths and inform to pay.
- [ ] physiciandomain.com/settings: indicate payment status and provide button for payment initiaition of failure
- [ ] Integrate WCD stripe account
- [ ] Redesign "Edit your website" button. make wider, background color (darkbkue)

