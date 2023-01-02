<h1 align="center">People As A Brand</h1>

## IMPORTANT NOTE
Please note that to get a migration of cities, countries, and states.
Please run the following 
<p>
    <code>php artisan db:seed</code> <br/> 
    <code>php artisan migrate --seed --seeder=TitleSeeder</code> <br/> 
    <code>php artisan passport:install</code> <br/> 
    <code>php artisan serve</code> <br/> 
</p>
Note to self: As a result of <code>FK</code> - foreign key the <code>cities table</code> is the parent key with a reference at <code>users table</code><br/>

## Tasks from MVP

### Back End

- [x] Sync Profession and Template Model for Central DB and Tenant DB.
- [ ] Dev Client Dashboard endpoints.
- [ ] Rem: Setup Mailgun account for PaaB (production)
- [ ] Cropper for images upload
- [x] Authenticate tenant on redirect to tenant settings
- [ ] Template: Upload template thumbnail (resitrict image dimensions to 512px(W) by 345px(H))
- [x] Template: Get thumbnail by professionId
- [x] Template: Get single template
- [x] Tenancy: Attach Template to tenancy
- [x] Tenancy: Insert and update data for webiste
- [x] Tenancy: CHange Template for website
- [ ] ...

### Front End
- [ ] dev mobile view for all Auth
- [ ] dev client dashboard components
- [x] dev make nav a component
- [x] Template: Display all templates
- [x] Template: Display templates by professionId
- [x] Template: Preview single template
- [x] Website: User attach Template to website
- [x] Website: Edit default data for website
- [ ] ...
