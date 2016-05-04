# Grav Feed Us Plugin

![FeedUs](assets/readme_1.png)

`Feed Us` is a [Grav](http://github.com/getgrav/grav) plugin and allows to import entries from feeds (RSS, ATOM, XML, JSON) and dislay data on your pages.

Currently, this plugin supports only __RSS__ feed types. Enabling is very simple. just install this plugin in the `/user/plugins/` folder in your Grav install. By default, the plugin is enabled and provides some default values.

# Installation

Installing the Feed Us plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file. 

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install feed-us

This will install the Feed Us plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/feed-us`.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `feed-us`. You can find these files either on [GitHub](https://github.com/orx57/grav-plugin-feed-us) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/feed-us

>> NOTE: This plugin requires PHP [SimpleXML extension](https://secure.php.net/manual/en/book.simplexml.php). As modular component for Grav which requires [Grav](http://github.com/getgrav/grav), the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) plugins, and a theme to be installed in order to operate.

# Usage

# Roadmap

- Support more feed types (ATOM, XML, JSON)
- Ability to import multiple feeds

Have a suggestion? I'd love to hear about it! [Make a suggestion](https://github.com/orx57/grav-plugin-feed-us/issues)