<div id="top"></div>

<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="http://smartemailing.cz">
    <img src="https://www.smartemailing.cz/wp-content/uploads/2020/09/Logo_SmartEmailing.svg" alt="Logo" height="50">
  </a>

<h3 align="center">Smart Emailing PHP Client Library v3</h3>

  <p align="center">
    The <span style="color: darkred">UnOfficial</span> (maybe one day) PHP library for using the <a href="https://app.smartemailing.cz/docs/api/v3/index.html" target="_blank"> SmartEmailing v3 API</a>.
    <br />
    <a href="https://app.smartemailing.cz/docs/api/v3/index.html"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/keltuo/php-smart-emailing/examples">Examples</a>
    ·
    <a href="https://github.com/keltuo/php-smart-emailing/issues">Report Bug</a>
    ·
    <a href="https://github.com/keltuo/php-smart-emailing/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li>
      <a href="#tests">Tests</a>
      <ul>
        <li><a href="#basic-usage">Basic usage</a></li>
        <li><a href="#how-to-set-up-php-storm-for-run-test-via-docker">How to set up PHP storm for Run test via docker</a></li>
      </ul>
    </li>
    <li>
      <a href="#api-coverage-tree">Api Coverage Tree</a>
      <ul>
        <li><a href="#smartemailing-doc-api-v3">SmartEmailing Doc API V3</a></li>
      </ul>
    </li>
    <li><a href="#todo">ToDo - report bugs</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

<!-- GETTING STARTED -->
## Getting Started

Before using this library, you must have a valid API Key.
To get an API Key, please log in to your SmartEmailing account.

### Installation
This library requires PHP 8 and higher.

The recommended way to install the SmartEmailing PHP Library is through composer.

```
# Install Composer
curl -sS https://getcomposer.org/installer | php
```


```
composer require keltuo/php-smartemailing
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
use SmartEmailing\SmartEmailing;
```

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

```php
use SmartEmailing\SmartEmailing;
// Create an Api instance with your username and apiKey.
$sm = new SmartEmailing('username', 'api-key');

// Call shortcut method for request Contacts
$sm->contacts()
    ->getList()->getData();

```
_For more examples, please refer to the [Documentation](https://app.smartemailing.cz/docs/api/v3/index.html)_

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- Tests -->
## Tests

In project is Docker Compose file, which support PHP8-cli and composer image.

### Basic usage

Download composer dependecy and run Unit Tests
```bash
docker-compose up
```

### How to set up PHP storm for Run test via docker
[link]

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- Api coverage -->
## Api coverage tree

#### SmartEmailing Doc API V3
https://app.smartemailing.cz/docs/api/v3/index.html
- Tests <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Aliveness test
    - GET Login test
    - POST Login test
- Contactlists <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Count of added contacts in list
    - Create new Contactlist
    - Distribution of Contactlist
    - Get Contactlists
    - Get single Contactlist
    - Truncate Contactlist
    - Update Contactlist
- Customfields <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Create new Customfield
    - Delete Customfield
    - Get Customfield values
    - Get Customfields
    - Get single Customfield
- Automation <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Trigger event
- Contacts <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Change e-mail address of single contact
    - Forget contact
    - Get Contacts
    - Get single Contact
- Contacts in lists <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Get all Contacts in list
    - Get confirmed Contacts in list
    - Get unsubscribed Contacts in list
- Custom campaigns <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Send bulk custom SMS
    - Send bulk custom emails
    - Send transactional emails
- Customfield Options <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Create new Customfield option
    - Delete Customfield option
    - Get Customfield options
    - Get single Customfield option
    - Update Customfield option
- E shops <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Add Placed order
    - Import orders in bulk
- Emails <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Create e-mail from template
    - Create new E-mail
    - Get E-mails
    - Get confirmation emails
    - Get single E-mail
- Generic collections *TODO*
    - Bulk upsert items
    - Delete item
- Exchange collections *TODO*
    - Get items
    - Get single item
- Generic events *TODO*
    - Bulk upsert events
    - Delete event
    - Get events
    - Get single event
- Import <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Import contacts
- Newsletter <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Create newsletter
- Processing purposes <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Create new Processing purpose
    - Get Processing purpose connections
    - Get Processing purposes
    - Revoke Processing purpose connection
- Scoring <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Scoring result history for all contacts
- Stats <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Get campaign sent stats
    - Get newsletter stats summaries
- Transactional emails <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Get transactional email ids
- Web Forms <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Get all Web Form ids and names
    - Get single Web Form structure
- Webhooks <a href="">Code Examples</a> | <a href="" target="_blank">Api DOC</a>
    - Create new Webhook
    - Delete Webhook
    - Get Webhooks


<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ToDo -->
## ToDo

See the [open issues](https://github.com/keltuo/php-smartemailing/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Lukas Paiskr - [@keltuo](https://twitter.com/keltuo) - lukas@pasysdev.cz

Project Link: [https://github.com/keltuo/php-smartemailing](https://github.com/keltuo/php-smartemailing)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/keltuo/php-smartemailing.svg?style=for-the-badge
[contributors-url]: https://github.com/keltuo/php-smartemailing/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/keltuo/php-smartemailing.svg?style=for-the-badge
[forks-url]: https://github.com/keltuo/php-smartemailing/network/members
[stars-shield]: https://img.shields.io/github/stars/keltuo/php-smartemailing.svg?style=for-the-badge
[stars-url]: https://github.com/keltuo/php-smartemailing/stargazers
[issues-shield]: https://img.shields.io/github/issues/keltuo/php-smartemailing.svg?style=for-the-badge
[issues-url]: https://github.com/keltuo/php-smartemailing/issues
[license-shield]: https://img.shields.io/github/license/keltuo/php-smartemailing.svg?style=for-the-badge
[license-url]: https://github.com/keltuo/php-smartemailing/blob/main/LICENSE
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/lukaspaiskr
