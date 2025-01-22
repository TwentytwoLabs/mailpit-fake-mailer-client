Mailpit fake mailer
================

This package provide [Mailpit](https://github.com/axllent/mailpit) support for TwentytwoLabs's [BehatFakeMailerExtension](https://github.com/TwentytwoLabs/behat-fake-mailer-extension)

## Installation

To install the package, use composer:

```
composer require twentytwo-labs/mailpit-fake-mailer-client
```

## Usage

In your `behat.yaml`

```yaml
default:
  suites:
    # your suite configuration here
  extensions:
   TwentytwoLabs\BehatFakeMailerExtension:
      base_url: http://localhost:8025 # optional, defaults to 'http://localhost:8025'
      client: 'mailpit'
```
