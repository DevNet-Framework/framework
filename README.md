# DevNet Framework
This dependency is the main repository of **DevNet Framework**, and it includes the following packages:
- [devnet/core](https://github.com/DevNet-Framework/core) a runtime and base class library that is essential for all DevNet applications and packages.
- [devnet/cli](https://github.com/DevNet-Framework/cli) a command-line interface tool, for creating console applications and managing DevNet projects.
- [devnet/web](https://github.com/DevNet-Framework/web) a collection of web components that helps to create modern web applications and web APIs.
- [devnet/entity](https://github.com/DevNet-Framework/entity) an object-relational mapping system that helps to manipulate databases in an object-oriented way.

## Requirements
- [PHP](https://www.php.net/) version 8.1 or higher
- [Composer](https://getcomposer.org/) version 2.0 or higher

## Installation
You can install DevNet Framework in your project, by running the following command in the terminal:

```bash
composer require devnet/framework
```

You can install DevNet Framework globally in your system, by run the following command in the terminal:
```
composer global require devnet/framework
```

>**Note:** when you install composer in Linux operating system, please do not forget to add composer/vendor/bin into the system environment variables inside the file .bashrc like this:  
>`echo 'export PATH="$PATH:$HOME/.config/composer/vendor/bin"' >> ~/.bashrc`

## Documentation
Full documentation on how to use **DevNet Framework** is available at [devnet-framework.github.io](https://devnet-framework.github.io)

## License
This library is licensed under the MIT license. See [License File](https://github.com/DevNet-Framework/framework/blob/master/LICENSE) in the root folder for more information.
