<p align="center">
  <img src="https://camo.githubusercontent.com/d2233d262b76ca06329b0d799bcd6a6ca9407230/687474703a2f2f617474656e64697a652e776562736974652f6173736574732f696d616765732f6c6f676f2d6461726b2e706e67" alt="Attendize" />
  <img style='border: 1px solid #444;' src="https://camo.githubusercontent.com/f971154821cf19038707fef3c548a91c21d5ac4f/68747470733a2f2f7777772e617474656e64697a652e636f6d2f696d616765732f73637265656e73686f74732f73637265656e312e504e47"/>
</p>

## This branch **will** get force pushes and rebases, until I use it production!

# Attendize 

Open-source ticket selling and event management platform

![Dependabot Status](https://api.dependabot.com/badges/status?host=github&repo=publicarray/Attendize)
[![phpunit](https://github.com/publicarray/Attendize/workflows/Attendize/badge.svg)](https://github.com/publicarray/Attendize/actions)

> Please report bugs here: https://github.com/Attendize/Attendize/issues. Detailed bug reports are more likely to be looked at. Simple creating an issue and saying "it doesn't work" is not useful. Providing some steps to reproduce your problem as well as details about your operating system, PHP version etc can help. <br />

> Take a look http://www.attendize.com/troubleshooting.html and follow the http://www.attendize.com/getting_started.html guide to make sure you have configured attendize correctly.  

Documentation Website: http://www.attendize.com<br />
Demo Event Page: http://attendize.website/e/799/attendize-test-event-w-special-guest-attendize<br />
Demo Back-end Demo: http://attendize.website/signup<br />

*Attendize* is an open-source event ticketing and event management application built using the Laravel PHP framework. Attendize was created to offer event organisers a simple solution to managing general admission events, without paying extortionate service fees.

### Current Features (v1.X.X)
---
 - Beautiful mobile friendly event pages
 - Easy attendee management - Refunds, Messaging etc.
 - Data export - attendees list to XLS, CSV etc.
 - Generate print friendly attendee list
 - Ability to manage unlimited organisers / events
 - Manage multiple organisers 
 - Real-time event statistics
 - Customizable event pages
 - Multiple currency support
 - Quick and easy checkout process
 - Customizable tickets - with QR codes, organiser logos etc.
 - Fully brandable - Have your own logos on tickets etc.
 - Affiliate tracking
    - track sales volume / number of visits generated etc.
 - Widget support - embed ticket selling widget into existing websites / WordPress blogs
 - Social sharing 
 - Support multiple payment gateways - Stripe, PayPal & Coinbase so far, with more being added
 - Support for offline payments
 - Refund payments - partial refund & full refunds
 - Ability to add service charge to tickets
 - Messaging - eg. Email all attendees with X ticket
 - Public event listings page for organisers
 - Ability to ask custom questions during checkout
 - Browser based QR code scanner for door management
 - Elegant dashboard for easy management.
### Contribution
---
Feel free to fork and contribute. If you are unsure about adding a feature create a Github issue to ask for Feedback. Read the [contribution guidelines](http://www.attendize.com/contributions.html)

### Submitting an issue
If you are creating an issue/bug report for Attendize please let us know the following.
1. The version of Attendize you are using. e.g. master branch or release tag.
2. Are you running Attendize in Docker or using a Virtual Machine.
3. What version or Operating System are you using. e.g. Ubuntu 14.04
4. The version of PHP you are using. e.g PHP 7.1
5. Are you using Attendize with Nginx or Apache.
6. Steps to reproduce the bug.

### Installation
---
To get developing straight away use the [Pre-configured Docker Environment](http://www.attendize.com/getting_started.html#running-attendize-in-docker-for-development)<br />
To do a manual installation use the [Manual Installation Steps](http://www.attendize.com/getting_started.html#manual-installation)

```bash
composer install --no-dev
yarn
yarn grunt deploy
php artisan serve # or with valet `valet open`
# start your db: `brew services start mariadb`
# open http://127.0.0.1:8000 in your browser
```

### Testing

To run the application tests, you can run the following from your project root:

```sh
# If the testing db does not exist yet, please create it
touch database/database.sqlite
# Run the test suite
./vendor/bin/phpunit
```

This will run the feature tests that hits the database using the `sqlite` database connection.

### Troubleshooting
---
If you are having problems please read the [troubleshooting guide](http://www.attendize.com/troubleshooting.html) 

License
---

Attendize is open-sourced software licensed under the Attribution Assurance License. See [http://www.attendize.com/license.html](http://www.attendize.com/license.html) for further details. We also have white-label license options available.

Contributors
---
* Jeremy Quinton ([Github](https://github.com/jeremyquinton))
* Sam Bell ([Github](https://github.com/samdb))
* Sebastian Schmidt ([Github](https://github.com/publicarray))
* Brett B ([Github](https://github.com/bretto36))
* G0dLik3 ([Github](https://github.com/G0dLik3))
* Honoré Hounwanou ([Github](http://github.com/mercuryseries))
* James Campbell ([Github](https://github.com/jncampbell))
* JapSeyz ([Github](https://github.com/JapSeyz))
* Mark Walet ([Github](https://github.com/markwalet))
* Etienne Marais ([Github](https://github.com/etiennemarais))
