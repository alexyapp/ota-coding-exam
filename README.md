1. Run `cp .env.example .env`.
2. Install dependencies by running `composer install`.
3. Start Laravel Sail by running `./vendor/bin/sail up -d`.
4. Run the migrations `./vendor/bin/sail artisan migrate`.
5. Run `./vendor/bin/sail artisan key:generate`
6. Run `./vendor/bin/sail db:seed` to seed the database with sample data. This will also create one moderator user and one job seeker user.
7. Run `npm install && npm run dev`.
8. The login credentials for the moderator and job seeker users can be found in the .env.example file although not advisable to be storing them there but for convenience.
9. Run `./vendor/bin/sail artisan schedule:run` to start the scheduler which handles imports from https://mrge-group-gmbh.jobs.personio.de/xml each hour or manually run the importer by running `./vendor/bin/sail artisan app:fetch-job-listings`.
10. Enter `laravel.test/dashboard` in your browser to access the site.
11. I'm using Mailtrap for the email notification requirement. There should be no additional set up required on your end as long as all the defaults in the .env.example file are kept. To login to the mailtrap account I've set up for this coding exam, head to https://mailtrap.io/ and use `yapalexnabua+mailtrap@gmail.com` for the email and `password` as the password. From here, you should be able to receive emails when creating a job ad using a user that has no prior published job ads.
12. Note: I've kept the QUEUE_CONNECTION as `database` and didn't use the `ShouldQueue` interface on the `NotifyModerators` listener and `SubmitJobAdForApproval` notifcation to simplify things but I am aware that queueing in a production environment and using something like `redis` to store queued jobs would be ideal to prevent users to have to wait for all those processes to finish when they submit the create job ad form.
13. Note: You may need to install Docker and PHP 8.
14. Note: You may need to run `sail artisan scout:import "App\Models\JobAd"`