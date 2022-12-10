<h1 align="center">People As A Brand</h1>

## IMPORTANT NOTE
Please note that to get a migration of cities, countries, and states.
Please run the following 
<p>
    <code>php artisan db:seed</code> <br/> 
    <code>php artisan migrate --seed --seeder=TitleSeeder</code>
</p>
Note to self: As a result of <code>FK</code> - foreign key the <code>cities table</code> is the parent key with a reference at <code>users table</code><br/>

## Tasks from MVP

### Back End

- [x] Sync Profession and Template Model for Central DB and Tenant DB.
- [ ] Dev Client Dashboard endpoints.
- [ ] Rem: Setup Mailgun account for PaaB (production)
- [ ] Template: Upload template thumbnail (resitrict image dimensions to 512px(W) by 345px(H))
- [ ] Template: Get thumbnail by professionId
- [ ] Template: Get single template
- [ ] Tenancy: Attach Template to tenancy
- [ ] Tenancy: Insert and update data for webiste
- [ ] Tenancy: CHange Template for website
- [ ] ...

### Front End
- [ ] dev mobile view for all Auth
- [ ] dev client dashboard components
- [ ] dev make nav a component
- [ ] Template: Display all templates
- [ ] Template: Display templates by professionId
- [ ] Template: Preview single template
- [ ] Website: User attach Template to website
- [ ] Website: Edit default data for website
- [ ] ...
