# WP2Static

A WordPress plugin for static site generation and deployment.

**Latest: WP2Static joins Strattic, the leading WordPress to headless and static site end-to-end publishing platform!**

Strattic is generously keeping the WP2Static plugin available and maintained for open source users!

[Read Announcement](https://www.strattic.com/wp2static-joins-strattic/)

## Installation options

 - from this source code `git clone https://github.com/wp2static/wp2static.git` (run `composer install` afterwards)
 - via [Composer](https://github.com/composer/composer) `composer require wp2static/wp2static`
 - get installer zip from [wp2static.com](https://wp2static.com/download/)
 - [compile your own installer zip from source code](https://wp2static.com/compiling-from-source/)


## [Docs](https://wp2static.com)

## [Support Forum](https://staticword.press/c/wordpress-static-site-generators/wp2static/)

### Contributing

[See `CONTRIBUTING.md`](./CONTRIBUTING.md)

### Testing

WP2Static includes various types of code quality and functionality tests.

Tests are defined as Composer scripts within the `composer.json` file.

`composer run-script test` will run the main linting, static analysis and unit tests. It will not run code coverage by default. To run code coverage, use `composer run-script coverage`, this will require XDebug installed.

`composer run-script test-integration` will run end to end tests. This requires that you have the `nix-shell` command available from [NixOS](https://nixos.org/download.html). More info on the intgration tests can be found in the README within the `integration-tests` directory.

You can run individual test stages by specifying any of the defined scripts within `composer.json` with a command like `composer run-script phpunit`. You can pass arguments, such as to skip slow external request making phpunit tests, run `composer run-script phpunit -- --exclude-group ExternalRequests`.

Continuous Integration is provided by GitHub Actions, which run code quality, unit and end to end tests.

### Compiling
Compiling from source code
I make a point to keep the source code to my projects open source, available to all and with no restrictions on how you may use them.

For WP2Static’s core WordPress plugin and complimentary add-ons, these are currently hosted on the GitHub website. If you’re blocked from accessing GitHub for any reason, please reach out to me via the support forum and I’ll send you a copy of the source.

Find the source code for WP2Static and other projects within my GitHub profile.

For my WordPress plugins, I use the great Composer dependency manager to help organize code. In conjunction with some thin shell scripts, I also provide an easy way to build/compile zip installers of each plugin, which may be a preferred installation method for you..

Building zip installers of plugins
acquire the source code
ensure Composer is installed
from the source code directory, run composer install
from same directory, run composer build ZIP_NAME, where ZIP_NAME is a friendly name, such as wp2static-addon-s3.
If all goes well, this will put a zip file for easy installation of the plugin into your $HOME/Downloads directory. You can now install this to your WordPress site via the dashboard’s Plugins > Add Plugins > Upload Plugin area.

I don’t want to have to compile the plugin from source code!
Please make a donation to Leon, this project’s maintainer, for access to pre-compiled, easy to install zip files.

Already donated or have a license?

I got an error when activating WP2Static!
Looks like you’re trying to activate WP2Static from source code, without compiling it first. Please see https://wp2static.com/compiling-from-source for assistance.

Seeing the above error when trying to activate the plugin? This usually means that the dependent libraries haven’t been installed by Composer. If you were trying to build the plugin yourself via source code, please retry the steps above. If you want to just run the plugin in-place, you can try running just composer install from within the source code’s directory and trying to activate again.


