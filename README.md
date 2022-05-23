# How to use WordPress HTTP API to make remote requests
## Fetch your 10 latests Gists and display them using a shortcode.

This repository is a basic WordPress plugin created to illustrate a tutorial about remote requests and HTTP calls in a WordPress environment.

Its main function is to:
- fetch the latest 10 gists of a GitHub user,
- save these gists in the option table,
- display this list of gists via a shortcode.

### Usage
Use the following shortcode anywhere in a page/post content:

```
[gists user="username" amount="10"]
```

…to display the last 10 Gists from the GitHub `username` user account.


[Read the blog post →](https://mosaika.fr/fonctions-http-api-wordpress/)