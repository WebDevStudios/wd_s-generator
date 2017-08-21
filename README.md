# [wd_s](https://github.com/WebDevStudios/wd_s) Theme Generator

An easy way to spin-up a new WordPress theme. [https://wdunderscores.com/](https://wdunderscores.com/)

## Pre-Installation
Basic knowledge of the command line and the following dependencies are required to use wd_s:

* Node/NPM
* Gulp CLI

```bash
npm install -g gulp-cli
```

## Install Instructions

1) Visit [https://wdunderscores.com/](https://wdunderscores.com/) and answer questions

2) Click "Generate"

3) The script will do a find-replace and give you a .zip file

4) Download, extract, and place your new theme into:

```bash
/wp-content/themes
```

5) In the WordPress dashboard, activate your new theme

## Post Installation

1) From the command line, change directories to your new theme directory

```bash
cd /sites/foo-client/wp-content/themes/foo-theme
```

2) Install Node dependencies

```bash
npm install
```
![Install and Gulp](https://dl.dropbox.com/s/cj1p6xjz51cpckq/wd_s-install.gif?dl=0)

You are now ready to use wd_s! To get started developing, check out the [Gulp commands](https://github.com/WebDevStudios/wd_s/blob/master/README.md#gulp-tasks).

## Changes
Anytime a commit is pushed to the `master` branch on [wd_s](https://github.com/WebDevStudios/wd_s/), Jenkins automatically deploys the updated to code to the generator.

## Support
Please use this repository's [issues](https://github.com/gregrickaby/wd_s-generator/issues) to file any tickets with the generator. If you have an issue with wd_s itself, file an [issue](https://github.com/WebDevStudios/wd_s/issues) there.

## Contributing
Contributions are welcome. Please fork and create a [pull request](https://github.com/gregrickaby/wd_s-generator/pulls).

## Credits
This generator is based on Automattic's [underscores.me](https://github.com/Automattic/underscores.me).