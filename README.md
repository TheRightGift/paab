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
    When claiming site, handle from backend is changed to  eg. <strong>{tenantDomain}.localhost:8000/?token={tokenObtained}</strong> instead of <strong>http://127.0.0.1:8000/auth/claim?claimable=drjohndoe&mail=johndoe@gmail.com</strong> crucial when passing url to claim button on email.
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

<strong>NOTE</strong><p>Remember to change <code> APP_ENV </code> to <code> 'production' </code> and <code> APP_DEBUG </code> to <code> false </code></p>

## Tasks from MVP

### Back End

- [x] Sync Profession and Template Model for Central DB and Tenant DB.
- [x] Dev Client Dashboard endpoints.
- [x] Rem: Setup AWS SES for mailables
- [ ] Cropper for images upload
- [x] Authenticate tenant on redirect to tenant settings
- [ ] Template: Upload template thumbnail (resitrict image dimensions to 512px(W) by 345px(H))
- [x] Template: Get thumbnail by professionId
- [x] Template: Get single template
- [x] Tenancy: Attach Template to tenancy
- [x] Tenancy: Insert and update data for webiste
- [x] Tenancy: CHange Template for website
- [ ] All Dashboards: Add a domain lookup and doamin name suggestion
- [ ] Website: Add a domain lookup and doamin name suggestion
- [ ] ...

### Front End
- [ ] dev mobile view for all Auth
- [x] dev client dashboard components
- [x] dev make nav a component
- [x] Template: Display all templates
- [x] Template: Display templates by professionId
- [x] Template: Preview single template
- [x] Website: User attach Template to website
- [x] Website: Edit default data for website
- [ ] ...
