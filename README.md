pifmstation
===========

PiFM Music Station is a web application that use pifm and pifmplay.
It allows user to create his own music station with all songs as a playlist.

You can turn on/off radio on the frequency you want then pause/resume/stop or go to the next track.

Requirements :

You need an apache web server (or nginx) with PHP to run the web application.
Put all your songs (mp3 files only) into the "music" folder located in the "pifmplay" folder.

Installation :

First install npm modules with 

```javascript
npm install
```

then install bower components with

```javascript
bower install
```

Finaly, run grunt defaut task to perform a wiredep simple task

```javascript
grunt
```

It's ready! You can now have access to the webpage with the Raspberry PI IP Adress or domain name.

Usage preview

<a href="https://dl.dropboxusercontent.com/s/hcu43ozd4xrqnww/pifmstation_v3.gif"></a>
