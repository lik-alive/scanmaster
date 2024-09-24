# ScanMaster

## Info

**Web service for a network document scanner**

The service provides online access to a shared folder of a network document scanner, making it extremely easy to download and share scanned documents. It also displays handy previews for graphic and PDF formats.

The service was deployed on the infrastructure of Image Processing Systems Institute, implemented into the workflow of Laboratory of Mathematical Methods of Image Processing and supported since 2022.

## Table of Contents
- [Features](#features)
  - [Common](#common)
  - [Functionality](#functionality)
- [Installation](#installation)
  - [Windows](#windows)
- [License](#license)

## Features

### Common
- Client: Laravel's Blade v1.4 + Bootstrap v5.1.3
- Server: Slim v4
- Mobile-friendly

### Functionality
- Previews for graphic formats (png, jpg, etc.)
- Automatically generated previews for PDF files
- Batch download
- File sharing
- Limited access

## Installation

### Windows

1. Create `.env`
   
2. Install Apache web server and PHP (e.g. XAMPP)  
https://sourceforge.net/projects/xampp/

3. Install Composer  
https://getcomposer.org/download/

4. Install ImageMagick  
https://imagemagick.org/script/download.php

5. Uncomment `extension=zip` line in `php.ini`

6. Install dependencies
```sh
composer install
```

7. Create `scans` directory in `/storage` and share it with the network document scanner

## License

MIT License