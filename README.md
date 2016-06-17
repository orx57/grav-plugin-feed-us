# Grav Feed Us Plugin

`Feed Us` is a [Grav](http://github.com/getgrav/grav) plugin that allows to import entries from feeds (RSS, ATOM, XML, JSON) and dislay data on your pages.

Currently, this plugin supports only __RSS__ and __ATOM__ (since v0.1.3) feed type.

# Roadmap

- Support more feed types (XML, JSON)
- Support more item attributes (content, image,...)
- Ability to import multiple feeds

Have a suggestion? I'd love to hear about it! [Make a suggestion](https://github.com/orx57/grav-plugin-feed-us/issues)

# Demo

- [Feed Us Test Page](http://demo.orx57.net/grav/feed-us-test-page)

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

To use this plugin you simply need to include a function in your template file or in page with Twig variables processing such as:

```
{{ feedus_rss() }}
```

This will be converted into the feed as follows:

```
<ul>
    <li><a href="{{ post.link }}" target="_blank">{{ post.title }}</a></li>
    <li><a href="{{ post.link }}" target="_blank">{{ post.title }}</a></li>
    ...
</ul>
```

# Config Defaults

If you need to override some plugin default values, the best practise is to copy the [feed-us.yaml](feed-us.yaml) file into your `users/config/plugins/` folder (create it if it doesn't exist), and then modify there. This will override the default settings.

```
enabled: true
feed_url: https://getgrav.org/blog.rss
```

# Updating

As development for the Feed Us plugin continues, new versions may become available that add additional features and functionality, improve compatibility with newer Grav releases, and generally provide a better user experience. Updating Feed Us is easy, and can be done through Grav's GPM system, as well as manually.

## GPM Update (Preferred)

The simplest way to update this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm). You can do this with this by navigating to the root directory of your Grav install using your system's Terminal (also called command line) and typing the following:

    bin/gpm update feed-us

This command will check your Grav install to see if your Feed Us plugin is due for an update. If a newer release is found, you will be asked whether or not you wish to update. To continue, type `y` and hit enter. The plugin will automatically update and clear Grav's cache.

## Manual Update

Manually updating Feed Us is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/feed-us` directory.
* Downalod the new version of the Feed Us plugin from either [GitHub](https://github.com/orx57/grav-plugin-feed-us) or [GetGrav.org](http://getgrav.org/downloads/plugins#extras).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `feed-us`.
* Clear the Grav cache. The simplest way to do this is by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
