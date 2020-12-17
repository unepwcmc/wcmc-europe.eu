## Local setup

1. Download [Local](https://localwp.com/)
1. Create a new site called 'IUCN-UA' in Local
1. Install Plugins via WordPress [admin interface](http://proteus-partners.local/wp-admin/plugin-install.php)
- Advanced Custom Fields
- Block Lab
- Content Blocks (Custom Post Widget)
- Custom Post Type UI
- Custom Taxonomy Order
- Post Types Order
- Query Monitor
- Widget Options
4. Activate all plugins that you have just added
5. Post Types Order will need setting up - just change all dropdowns to Hide and then click Save Settings
6. Go to CPT UI > Tools and paste in the Post Types and Taxonomies (Get these from another developer or production site)
7. Get a copy of the uploads folder from another developer or the Production server and paste the files into public/content/uploads
8. Get the content XML from another developer or from Production by going to the WordPress [admin interface](http://proteus-partners.local/wp-admin/plugin-install.php) > Tools > Export and exporting all data
9. [Install the WordPress importer](http://proteus-partners.local/wp-admin/import.php)
10. Import the content XML file
11. Settings > Reading - Change Your homepage displays: A Static page, set Homepage: index, Save Changes
12. Appearance > Widgets - Drag 4 Content blocks into After Content and update settings to:
- Content Block to Display: Quote Carousel
- Hide/Show: Show on checked pages
- Misc: tick Home/Front
- Post types: tick About Proteus, Join, Proteus for consulants, Why Proteus?, Samples

- Content Block to Display: Partners
- Hide/Show: Show on checked pages
- Misc: tick Home/Front
- Post types: tick About Proteus, Join, Proteus for consulants, Why Proteus?, Samples

- Content Block to Display: Homepage Split
- Hide/Show: Show on checked pages
- Misc: tick Home/Front
- Post types: tick About Proteus, Join, Proteus for consulants, Why Proteus?, Samples

- Content Block to Display: CTA Block
- Hide/Show: Show on checked pages
- Misc: tick Home/Front
- Post types: tick About Proteus, Proteus for consulants, Why Proteus?, Samples

13. Appearance > Menus
- Select a menu to edit: footer
- Display location: tick Footer Menu

- Select a menu to edit: primary
- Display location: tick Primary Menu, Mobile Menu

14. Run 'gulp' in new terminal window at root directory of theme

15. Navigate to `localhost:3000`

## Deploy to Staging
1.

## Deploy to Production
1.

---

## wp-deploy

Capistrano powered WordPress deployment.

---

This repository utilises the Capistrano 3 framework to help the deployment and successful launch of a WordPress based website.

### Features

That sounds fancy, but what does it actually do?

- **Install WordPress**: WordPress is created at a git submodule* and installed based on your pre-defined configuration.
- **Environment based git deployment**: Clone an entire repository (from anywhere) to the server. Have separate environments to deploy to? (think: production/staging) We've got you covered.
- **Deployment rollbacks**: Realised you deployed a version thats going to break the site? Run a command to revert your changes to the previous version.
- **Push/Pull database with correct URLs**: Override the environment's database and run a 'search and replace' through the database to make sure the URLs are correct for that environment.
- **Push/Pull uploads**: Update you entire uploads directory from local to <environment> or vice versa.
- **Update WordPress**: Update your version of WordPress with ease, straight from the Command Line.
- **Configuration templates**: Need specific attributes within your `.htaccess` or `wp-config.php`? The templates are designed for this in mind and allow you to do this on an environment by environment basis.
- **Setup permissions**: Make sure your uploads and `.htaccess` files are readable from the get-go.

### Requirements

- **Git > v1.7.3**: Git is used to pull down the website from your Git hosting and therefore is a mandatory requirement.
- **SSH access**: For wp-deploy (or Capistrano in general) to work you need SSH access both between your local machine and your remote server, and between your local machine and your Git hosting (Github, Bitbucket, CodebaseHQ, etc) account.
- **Bundler**: As WP-Deploy comes with various different Ruby Dependencies, Bundler is used to make quick work of the installation process. Here's the [link](http://bundler.io/)
- **WP-CLI (greater than 0.22.0)**: WP-Deploy also requires the automation of WordPress functions directly in the Command Line. As these functions are required on all environments (local, staging and production servers), we make use of the WordPress Command Line Interface. You can check out the [documentation](http://wp-cli.org/#install) on how to get this setup.

In addition, as this is powered by WordPress, you'll also need to follow [WordPress' requirements](https://codex.wordpress.org/Hosting_WordPress).

### Unsupported/Untested tech

Some of the following tech is more untested than anything else. This could be due to time constraints or unfamiliarity with the software:

- Nginx
- Git (lower than version 1.7.3)
- WP-CLI (lower than version 0.22.0)
- Capistrano 3.8 or lower.
- Another shell besides Bash/Zsh for local development
- WordPress Multisite

Want to support these? Create a fork of the project, let us know and once vetted we'll happily provide a link in here to your project.

### Installation

Take a look at the [Installation Guide](https://github.com/Mixd/wp-deploy/wiki/Installation).

### Usage

Take a look at the [Usage Guide](https://github.com/Mixd/wp-deploy/wiki/Usage).

### FAQ

Take a look at the [Frequently Asked Questions](https://github.com/Mixd/wp-deploy/wiki/FAQ).

### Contributing

Take a look at the [Contributing guide](https://github.com/Mixd/wp-deploy/wiki/Contributing)

### Credits

This project is developed by the [Mixd](http://www.mixd.co.uk) team. Like it? Hate it? Let us know on [Twitter](http://twitter.com/mixd).
