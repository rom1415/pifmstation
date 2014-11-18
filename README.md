pifmstation
===========

PiFM Music Station is a web application that use pifm and pifmplay.
It allows user to create his own music station with all songs as a playlist.

You can turn on/off radio on the frequency you want then pause/resume/stop or go to the next track.

Requirements :

You need an apache web server (or nginx) with PHP to run the web application.
Create a "music" folder into pifmplay folder and put all your songs in it (mp3 files only)

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

<img src="https://dl.dropboxusercontent.com/s/7s37ps1kb0dfig7/pifmstation.gif"></img>
